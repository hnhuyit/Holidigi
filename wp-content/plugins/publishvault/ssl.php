<?php

/**
 * Open SSL Class
 */
class Ssl {

	protected $privateKey;

	/**
	 * Magic function to retrieve class properties
	 *
	 * @param type $name
	 * @return type
	 */
	public function __get($name) {
		if (property_exists($this, $name)) {
			return $this->$name;
		} else {
			return false;
		}
	}

	/**
	 * Class constructor
	 */
	public function __construct($args) {
		if (is_array($args)) {
			extract($args);
		} else {
			$path = $args;
		}
		$fp = @fopen($path . "private.key", "r");
		if ($fp) {
			$privateKey = fread($fp, 8192);
			$this->privateKey = openssl_get_privatekey($privateKey);
			fclose($fp);
		} else {
			$this->privateKey = openssl_pkey_new(
					array(
						'private_key_bits' => 1024,
						'private_key_type' => OPENSSL_KEYTYPE_RSA,
					));
			openssl_pkey_export_to_file($this->privateKey, $path . 'private.key');
		}
	}

	/**
	 * Class Desctructor
	 */
	public function __destruct() {
		openssl_free_key($this->privateKey);
	}

	/**
	 *
	 * @param type $message
	 * @param type $encode
	 * @return type
	 */
	private function _base64Values(&$message, $encode = true) {
		foreach ($message as &$value) {
			if (is_array($value) || is_object($value)) {
				$value = $this->_base64Values($value, $encode);
			} else {
				$value = $encode ? base64_encode($value) : base64_decode($value);
			}
		}
		return $message;
	}

	/**
	 *
	 * @param type $message
	 * @param type $key
	 * @return type
	 */
	public function encrypt($message, $key) {
		if (is_array($message) || is_object($message)) {
			$message = serialize($this->_base64Values($message));
		}
		$encrypted = $this->publicEncrypt($message, $key);
		return base64_encode($encrypted);
	}

	/**
	 *
	 * @param type $message
	 * @return type
	 */
	public function decrypt($message) {
		$data_arr = @explode(":twd:", base64_decode($message));
		return $this->privateDecrypt($data_arr);
	}

	/**
	 *
	 * @return type
	 */
	public function getPublicKey() {
		$key = openssl_pkey_get_details($this->privateKey);
		return $key['key'];
	}

	/**
	 *
	 * @param type $msg
	 * @param type $key
	 * @return type
	 */
	private function publicEncrypt($msg, $key) {
		for ($i = 0; $i < strlen($msg); $i = $i + 64) {
			openssl_public_encrypt(substr($msg, $i, 64), $crypted, $key);
			$encrypted[] = $crypted;
		}
		return implode(":twd:", $encrypted);
	}

	/**
	 *
	 * @param type $encrypted
	 * @return type
	 */
	private function privateDecrypt($encrypted) {
		$decrypted = "";
		if (is_array($encrypted)) {
			foreach ($encrypted as $key => $value) {
				if (openssl_private_decrypt($value, $decrypt, $this->privateKey)) {
					$decrypted .= $decrypt;
				} else {
					die("<hr/>" . openssl_error_string());
				}
			}
			return $this->_base64Values(unserialize($decrypted), false);
		}
		return false;
	}

}

?>