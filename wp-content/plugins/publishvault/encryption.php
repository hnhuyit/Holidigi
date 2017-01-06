<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Encryption {

	protected $CI;
	protected $path;
	protected $current_command;
	protected $current_enc_type;
	private $encryption_types = array(
		"CF_NOENCRYPTION" => 0,
		"CF_OPENSSL" => 1,
		"CF_AES" => 2
	);
	// Command List
	private $commands = array(
		"REPLY" => "cf_reply",
		"RESEND" => "cf_resend",
		"REINIT" => "cf_reinit",
		"REINITCONFIRM" => "cf_reInitConfirm",
		"INIT" => "cf_initialize",
		"VALIDATE" => "cf_validate",
		"GETLIST" => "cf_getList",
		"DELETEPOST" => "cf_deletePost",
		"NEWPOST" => "cf_newPost",
		"BATCHPOST" => "cf_batchPost",
		"GETPOST" => "cf_getpost",
		"UPDATEPOST" => "cf_updatePost",
		"GETCATEGORIES" => "cf_getCategories",
		"GETCATEGORY" => "cf_getCategory",
		"EDITCATEGORY" => "cf_editCategory",
		"NEWCATEGORY" => "cf_newCategory",
		"DELETECATEGORIES" => "cf_deleteCategories",
		"GETUSERS" => "cf_getUsers"
	);

	public function __get($name) {
		if (property_exists($this, $name)) {
			return $this->$name;
		} else {
			$name = strtoupper($name);
			if (array_key_exists($name, $this->commands)) {
				$this->current_command = $this->commands[$name];
				return $this->current_command;
			} elseif (array_key_exists($name, $this->encryption_types)) {
				$this->current_enc_type = $this->encryption_types[$name];
				return $this->current_enc_type;
			} else {
				return false;
			}
		}
	}

	public function __construct() {
		$func_get_args = func_get_args();
		$array_shift = array_shift($func_get_args);
		$args = extract($array_shift);
		$this->path = $path;
		if (defined('BASEPATH')) {
			// Inside CodeIgnitor so load it as a library
			$this->CI = &get_instance();
			// Check that OpenSSL is available the server
			if (function_exists("openssl_pkey_new")) {
				$this->CI->load->library("ssl", array("path" => $this->path));
			}
			$this->CI->load->library("aesctr");
		} else {
			// Loading via Plugin
			// Check SSL Available on server
			if (function_exists("openssl_pkey_new")) {
				require_once("ssl.php");
				$this->CI = new stdClass();
				$this->CI->ssl = new Ssl(array("path" => $this->path));
				$this->current_enc_type = $this->CF_OPENSSL;
			} else {
				// User AESCTR Encryption if SSL not available
				require_once('aesctr.php');
				$this->CI->aesctr = new Aesctr();
			}
		}
	}

	// Class Helper Functions
	public function setCommand($command) {
		$this->current_command = $command;
	}

	public function getPublicKey() {
		return $this->CI->ssl->getPublicKey();
	}

	public function encrypt($message, $key, $enc_type) {
		$data['command'] = $this->current_command;
		if ($enc_type == $this->CF_OPENSSL) {
			// Do OpenSSL Encryption
			$data['data'] = $this->CI->ssl->encrypt($message, $key);
		} elseif ($enc_type == $this->CF_AES) {
			// Do AES Encryption
			$data['data'] = $this->CI->aesctr->encrypt(serialize($message), $key, 256);
		} else {
			// No Ecnryption
			$data['data'] = $message;
		}
		$data['encryption'] = $enc_type;
		return base64_encode(serialize($data));
	}

	public function decrypt($encrypted, $enc_type, $key = false) {
		if ($enc_type == $this->CF_OPENSSL) {
			// Do OpenSSL Encryption
			$result = $this->CI->ssl->decrypt($encrypted);
		} elseif ($enc_type == $this->CF_AES) {
			// Do AES Encryption
			$result = unserialize($this->CI->aesctr->decrypt($encrypted, $key, 256));
		} else {
			// No Encryption
			$result = $encrypted;
		}
		return array("result" => $result, "encryption" => $enc_type);
	}

}

?>
