<?php

/*
  Plugin Name: PublishVault
  Plugin URI: http://publishvault.com
  Description: PublishVault
  Version: 1.3.4
  Author: PublishVault
  Author URI: http://publishvault.com/
 */
global $pluginDir;
$pluginDir = WP_PLUGIN_DIR . DIRECTORY_SEPARATOR . "publishvault" . DIRECTORY_SEPARATOR;
//include( "..\..\contentfu\application\libraries\encryption.php");
include( $pluginDir . "encryption.php");
/**
 * ContentFu Class
 */
class ContentFu {

	private $encryption;
	private $user;

	/**
	 * Constructor - Initialises plugin
	 *
	 */
	function __construct() {
		global $pluginDir;
		// Start the Communication Class
		//if (defined('BASEPATH')) {
		require_once('wp-updates-plugin.php');
		new WPUpdatesPluginUpdater_1224( 'http://wp-updates.com/api/2/plugin', plugin_basename(__FILE__));
		//}
		$ecnryption_params = array(
			"path" => $pluginDir,
			"openssl" => function_exists("openssl_public_encrypt")
		);
		$this->encryption = new Encryption($ecnryption_params);
		// Register the activation and deactivation routines
		register_activation_hook(__FILE__, array(&$this, "pluginInstalled"));
		register_deactivation_hook(__FILE__, array(&$this, "pluginUninstalled"));
		add_action( 'admin_menu', array(&$this , 'addContentfuSettingsMenu'));
		// Add Actions
		add_action('init', array(&$this, 'parseRequest') , 1);
		add_action('wp_head',  array(&$this , 'add_meta_tags') , 2 );
		add_action("add_meta_boxes", array(&$this, "add_custom_meta_tags_box") ) ;
		add_action("save_post", array(&$this, "save_custom_meta_tags_box"), 10, 3);
	}		

	/**
	 * Add menu in admin sidebar.
	 */
	public function addContentfuSettingsMenu(){
		$data = $_GET;
		if ( isset($_GET['params']) ) {
			//if ( preg_match("%<HEADER>(.*)</HEADER>%", urldecode( $_GET['params'] ), $message) ) {
				$return = extract(unserialize(base64_decode( $_GET['params'] )));
				extract($data);
			//}
		}
		if (isset($data['status']) && $data['status'] == 'connect' && isset($data['callbackUrl']) && $data['callbackUrl'] != '' ) {
			update_option( 'contentfu_master_key_active' , true );
			header("Location: ".$data['callbackUrl']."/secret-key/".get_option( 'contentfu_master_key' ));
			exit();
		}
		if (isset($data['status']) && $data['status'] == 'disconnect' && isset($data['callbackUrl']) && $data['callbackUrl'] != '' ) {
			update_option( 'contentfu_master_key_active' , null );
			header("Location: ".$data['callbackUrl']."/secret-key/".get_option( 'contentfu_master_key' ));
			exit();
		}
		if ( isset($data['status']) && isset($data['callbackUrl']) && $data['status'] == 'success' && isset($data['secret-key']) && $data['secret-key'] == get_option( 'contentfu_master_key' ) ) {
			update_option( 'contentfu_master_key_active' , true );
			wp_redirect( $data['callbackUrl'] ); exit;
		} elseif ( isset($data['disconnect']) && isset($data['callbackUrl']) && $data['disconnect'] == true ) {
			update_option('contentfu_master_key_active', null);
			wp_redirect( $data['callbackUrl'] ); exit;
		}
		add_menu_page('PublishVault Setting Page', 'PublishVault', 'administrator', 'publishvault', array(&$this , 'contentFuSettingsPage')  );
	}
	
	/**
	 * Set content in menu "Content Fu" section.
	 */
	public function contentFuSettingsPage(){
		include( plugin_dir_path( __FILE__ ) . '/templates/connection-form.php');
	}

	/**
	 * Return random sting with seting length
	 */
	function strRandom( $length = 16 ) {
		$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    return substr(str_shuffle(str_repeat($pool, 5)), 0, $length );
	}

	/**
	 * Plugin was activated
	 */
	function pluginInstalled() {
		/*$newpost = array( 
			"post_content"	=> '', 
			"post_title"	=> 'publishvault', 
			"post_author"	=> 1, 
			"post_type"		=> 'page', 
			"post_status"	=> 'publish'
		);*/
		$result = wp_insert_post($newpost, true);
		add_option( 'publishvault_page_id' , 1 );
		add_option( 'contentfu_master_key' , $this->strRandom(32) );
		add_option( 'contentfu_master_key_active' , null );
	}

	/**
	 * Plugin was deactivated
	 */
	function pluginUninstalled() {
		delete_option("contentfu_master_key");
		//wp_delete_post( get_option( 'publishvault_page_id' ) );
		delete_option( 'publishvault_page_id' );
		delete_option('contentfu_master_key_active');
		delete_option("contentfu_encryption_type");
	}

	function add_meta_tags() {
	    global $post;
	    if ( is_single() || is_page()) {
	    	if(get_post_meta($post->ID, "is_meta_tags", true)){
	    		if(get_post_meta($post->ID, "meta_tag_title", true) != ''){
	        		echo '<meta name="title" content="' . get_post_meta($post->ID, "meta_tag_title", true) . '" />' . "\n";
	    		}
	    		if(get_post_meta($post->ID, "meta_tag_description", true)){
	        		echo '<meta name="description" content="' . get_post_meta($post->ID, "meta_tag_description", true) . '" />' . "\n";
	    		}
	    	}
	    }
	}



	function custom_meta_tags_box_markup($object)
	{
		wp_nonce_field(basename(__FILE__), "meta-box-nonce");
	    ?>
	        <div>
	            <label for="meta-box-title" style='display:block; font-size:15px'><b>Meta Title</b></label>
	            <input name="meta_tag_title"  id="meta-box-title" type="text" style='width:50%;'  value="<?php echo get_post_meta($object->ID, "meta_tag_title", true); ?>">
	            <br>
	        </div>
	        <br>
	        <div>
	            <label for="meta-box-text" style='display:block; font-size:15px'><b>Meta Description</b></label>
	            <textarea name="meta_tag_description" id="meta-box-text" type="text" rows="5" cols="60"><?php echo get_post_meta($object->ID, "meta_tag_description", true); ?></textarea>
	            <br>
	        </div>
	        <br>
	        <div>
	        	<label for="meta-box-checkbox" ><b>Enable Meta Datas</b></label>
	        	<input name="is_meta_tags" type="checkbox" id="meta-box-checkbox" <?php echo get_post_meta($object->ID, "is_meta_tags", true) ? 'checked = "checked"' : '' ?> >
	        </div>
	    <?php  
	}

	function save_custom_meta_tags_box($post_id, $post, $update)
	{
	    if (!isset($_POST["meta-box-nonce"]) || !wp_verify_nonce($_POST["meta-box-nonce"], basename(__FILE__)))
	        return $post_id;

	    if(!current_user_can("edit_post", $post_id))
	        return $post_id;

	    if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
	        return $post_id;


	    $meta_tag_title = "";
	    $meta_tag_description = "";

	    if(isset($_POST["meta_tag_title"]))
	    {
	        $meta_tag_title = $_POST["meta_tag_title"];
	    }   
	    update_post_meta($post_id, "meta_tag_title", $meta_tag_title);

	    if(isset($_POST["meta_tag_description"]))
	    {
	        $meta_tag_description = $_POST["meta_tag_description"];
	    }   
	    update_post_meta($post_id, "meta_tag_description", $meta_tag_description);

	    $is_meta_tags = isset($_POST['is_meta_tags']) ? 1 : 0;  
	    update_post_meta($post_id, "is_meta_tags", $is_meta_tags);
	}



	function add_custom_meta_tags_box()
	{
	    add_meta_box("publishvault-meta-box", "Meta Tags Information (PublishVault Plugin)", array(&$this, "custom_meta_tags_box_markup") );
	}


	/**
	 *  Display a message
	 *
	 * @param type $message
	 */
	function displayMessage($message) {
		echo '<div id="message" style="width: 784px;"><p>' . $message . '</p></div>';
	}

	/**
	 *
	 * @param type $message
	 * @param type $value
	 */
	function debug($message, $value) {
		echo '<font size="1"><table class="xdebug-error" dir="ltr" border="1" cellspacing="0" cellpadding="1">';
		echo "<tr><th align='left' bgcolor='#f57900' colspan='5'><span style='background-color: #cc0000; color: #fce94f; font-size: x-large;'>( ! )</span> $message</th></tr>";
		echo "<tr><th align='left' bgcolor='#e9b96e' colspan='5'>Value</th></tr>";
		echo "<tr><td>";
		var_dump($value);
		echo "</td></tr>";
		echo "</table></font>";
	}

	/**
	 * Sends back response to calling program
	 *
	 * @param array $command - Command
	 * @param string $response - Message to send back
	 * @param bool $success  - Report success or failure
	 *
	 * exits with message
	 */
	private function response($command, $response = false, $success = true) {
		$return = array();

		$header_start = "<ERROR>";
		$header_end = "</ERROR>";
		$this->encryption->setCommand($command);
		if (empty($response) && strlen($response) == 0 && $response != NULL)
			$return = 'Empty response.';
		else if ($success) {
			$header_start = "<SUCCESS>";
			$header_end = "</SUCCESS>";
			if (get_option("contentfu_master_key")) {
				$enc_key = get_option("contentfu_master_key");
				$enc_type = get_option("contentfu_encryption_type");
			} else {
				$enc_key = "";
				$enc_type = $this->encryption->CF_NOENCRYPTION;
			}
			$return = $this->encryption->encrypt($response == NULL ? array() : (object) $response, $enc_key, $enc_type);
		} else {
			$return = $response;
		}

		if (!headers_sent()) {
			header('HTTP/1.0 200 OK');
			header('Content-Type: text/plain');
		}
		exit($header_start . $return . $header_end);
	}

	/**
	 * Entry function for plugin.
	 * Parses the post request. Authenticates user and if command match found runs
	 * correct function.
	 *
	 * return	- invalid response if command does not match
	 */
	function parseRequest() {
		if (!isset($HTTP_RAW_POST_DATA)) {
			$HTTP_RAW_POST_DATA = file_get_contents('php://input');
		}
		/*if (!get_option("contentfu_master_key")) {
			$this->response($this->encryption->resend, NULL);
		}*/
		//var_dump($HTTP_RAW_POST_DATA ); exit;
		$HTTP_RAW_POST_DATA = str_replace('%3C', '<', $HTTP_RAW_POST_DATA);
		$HTTP_RAW_POST_DATA = str_replace('%3E', '>', $HTTP_RAW_POST_DATA);
		$HTTP_RAW_POST_DATA = str_replace('%2F', '/', $HTTP_RAW_POST_DATA);

		if ( preg_match("%<HEADER>(.*)</HEADER>%", $HTTP_RAW_POST_DATA, $message) ) {
			//Data received
			$return = extract(unserialize(base64_decode($message[1])));
			extract($data);

			$key = array_search($command, $this->encryption->commands);
			// /exit( $key ,$command );
			if ($key) {
				$decrypted = $this->encryption->decrypt($return, $encryption, get_option("contentfu_master_key"));
				extract($decrypted);
				extract($result);
				if ( get_option('contentfu_master_key_active') == null || get_option("contentfu_master_key") != $contentfu_master_key ) {
					throw new Exception("Error Processing Request", false);
				}
				if (!get_option("contentfu_master_key") &&
					  $command != $this->encryption->reinit &&
					  $command != $this->encryption->init) {
					$this->response($this->encryption->resend, NULL);
				}
				switch ($command) {
					case $this->encryption->init:
						extract($data);
						if (function_exists("openssl_public_encrypt") && $publicKey != '') {
							add_option("contentfu_encryption_type", $this->encryption->CF_OPENSSL) or update_option("contentfu_encryption_type", $this->encryption->CF_OPENSSL);
							add_option("contentfu_master_key", $publicKey) or update_option("contentfu_master_key", $publicKey);
							$this->response($this->encryption->reply, array("publicKey" => $this->encryption->getPublicKey()));
						} elseif (class_exists("Aes") && $webpassword != '') {
							add_option("contentfu_encryption_type", $this->encryption->CF_AES) or update_option("contentfu_encryption_type", $this->encryption->CF_AES);
							add_option("contentfu_master_key", $webpassword) or update_option("contentfu_master_key", $webpassword);
							$this->response($this->encryption->reply, array("publicKey" => $webpassword));
						} else {
							$this->response($this->encryption->reply, "No Encryption found. Please contact your administrator.", false);
						}
						break;
					case $this->encryption->reinit:
						extract($data);
						add_option("contentfu_encryption_type", $encryption_type) or update_option("contentfu_encryption_type", $encryption_type);
						add_option("contentfu_master_key", $key) or update_option("contentfu_master_key", $key);
						$this->response($this->encryption->reinitconfirm, NULL);
						break;
					case $this->encryption->validate:
		//$this->user = $this->authenticate($login);
						if ($this->user) {
							$this->response($this->encryption->reply, array("success" => true));
						} else {
							$this->response($this->encryption->reply, "Invalid User/Password.", false);
						}
						break;
					default:
						if (method_exists($this, $this->encryption->$key)) {
							call_user_func(array(&$this, $this->encryption->$key), $data);
						} else {
							$this->response($this->encryption->reply, "Found command <strong>{$command}</strong> but cannot find associated function ({$this->encryption->$key}).", false);
						}
						break;
				}
			} else {
				$this->response($this->encryption->reply, "ContentFu Plugin - Invalid Command!", false);
			}
			
		}
	}

	private function cf_getCapabilities() {
		$num = extract(func_get_arg(0));
		switch ($type) {
			case "post":
				$this->response($this->encryption->reply, array("post_cap" => $this->postCapabilities()));
				break;
			case "page":
				$this->response($this->encryption->reply, array("page_cap" => $this->pageCapabilities()));
				break;
		}
	}

	/**
	 * Get Post/Page List
	 */
	private function cf_getList() {
		// $this->response($this->encryption->reply, "cf_getList");
		global $wpdb;
		//		if (!current_user_can('edit_posts'))
		//			$this->response($this->encryption->reply, __('This account does not have the user rights to view posts on this site.'), false);

		$num = extract(func_get_arg(0));
		// TODO
		//	$category = isset($args[5]) ? $args[5] : '';
		//	$order_by = isset($args[6]) ? $args[6] : 'post_date';
		//	$order = isset($args[7]) ? $args[7] : 'DESC';
		//	$post_status = isset($args[8]) ? $args[8] : 'publish';

		$page = isset($page) ? absint($page) - 1 : 0;
		$view = isset($view) ? absint($view) : 20;
		$post_type = isset($post_type) ? $post_type : "post";
		$post_status = isset($post_status) ? $post_status : array("publish", "future", "draft");

		do_action('xmlrpc_call', 'wp.getPostList');

		$count_query = "SELECT COUNT(*) as cnt, {$wpdb->posts}.post_title, {$wpdb->posts}.post_status, {$wpdb->posts}.post_date, {$wpdb->users}.display_name
			FROM {$wpdb->posts}
			LEFT JOIN {$wpdb->users} ON {$wpdb->users}.ID = {$wpdb->posts}.post_author
			WHERE {$wpdb->posts}.post_type = '$post_type' AND
			{$wpdb->posts}.post_status IN('" . implode("','", $post_status) . "')";

		// Get list of pages ids and titles
		$list_query = "SELECT
				{$wpdb->posts}.ID,
				{$wpdb->posts}.post_title,
				{$wpdb->posts}.post_content,
				{$wpdb->posts}.post_parent AS page_parent_id,
				{$wpdb->posts}.post_date,
				{$wpdb->posts}.post_status,
				{$wpdb->posts}.post_type,
				{$wpdb->users}.display_name,
				{$wpdb->users}.user_login";
		$list_query .= " FROM {$wpdb->posts}";
		$list_query .= " LEFT JOIN {$wpdb->users} ON {$wpdb->users}.ID = {$wpdb->posts}.post_author
				WHERE
				{$wpdb->posts}.post_type = '$post_type' AND
				{$wpdb->posts}.post_status IN('" . implode("','", $post_status) . "')";
		if ($search) {
			$list_query .= " AND {$search}";
		}
		$list_query .= " GROUP BY {$wpdb->posts}.ID";
		if ($order) {
			$list_query .= " ORDER BY $order";
		} else {
			$list_query .= " ORDER BY {$wpdb->posts}.post_title";
		}
		$list_query .= " LIMIT {$page}, {$view}";

		$posts_list = $wpdb->get_results($list_query, ARRAY_A);

		$total_count = $wpdb->get_results($count_query);
		if (($view * $page) > $total_count[0]->cnt) {
			$page = (int) ($total_count[0]->cnt / $view);
		}
		if ($search) {
			$count_query .= " AND {$search}";
		}
		$row_count = $wpdb->get_results($count_query);
		if (($view * $page) > $row_count[0]->cnt) {
			$page = (int) ($row_count[0]->cnt / $view);
		}

		$recent_posts = array();
		foreach ($posts_list as $entry) {
			$entry['meta_tag_title'] = get_post_meta($entry['ID'], "meta_tag_title", true);
			$entry['meta_tag_description'] = get_post_meta($entry['ID'], "meta_tag_description", true);
			$entry['is_meta_tags'] = get_post_meta($entry['ID'], "is_meta_tags", true);
			$categories = array();
			$catids = wp_get_post_categories($entry['ID']);
			foreach ($catids as $catid){
				$term = get_term_by("id", $catid, "category", ARRAY_A);
				$categories[$catid] = array(
					'name' => $term['name'] , 
					'cat_ID' => $catid , 
					'description' => $term['description'] ,
					'parent' => $term['parent']
				);
			}
			$post = (object) $entry;
			$post->categories = $categories;
			$post->permalink = get_permalink( $entry['ID'] );
			//$post = new stdClass();
			/*$post->post_date = $entry['post_date'];
			$post->userid = $entry['post_author'];
			$post->postid = (string) $entry['ID'];
			$post->title = $entry['post_title'];
			$post->post_status = $entry['post_status'];
			$post->display_name = $entry['display_name'] != '' ? $entry['display_name'] : $entry['user_login'];*/

			$recent_posts[] = $post;
		}

		$this->response($this->encryption->reply, array("total_count" => $total_count[0]->cnt, "row_count" => $row_count[0]->cnt, "pages" => $recent_posts));
	}

	/**
	 * Delete Post/Page
	 */
	private function cf_deletePost() {
		$num = extract(func_get_arg(0));

		if (!is_array($id)) {
			$id = array($id);
		}

		$errors = array();
		$count = 0;
		foreach ($id as $post_id) {
			if (!wp_delete_post($post_id)) {
				$errors[] = "Unable to delete Page/Post (ID = {$post_id})";
			} else {
				$post = get_post($post_id, ARRAY_A);
				$titles[] = $post['post_title'];
				$count++;
			}
		}
		if (empty($errors)) {
			$this->response($this->encryption->reply, array("count" => $count, "titles" => $titles));
		} else {
			$this->response($this->encryption->reply, implode("<br />", $errors), false);
		}
	}

	private function cf_newPost($args, $internal = false) {

		$num = extract(func_get_arg(0));
		if (func_num_args() > 1)
			$internal = func_get_arg(1);
		$post_type = isset($post_type) ? $post_type : "post";

		if (!is_array($post_category)) {
			$post_category = array($post_category);
		}

		$post_date_gmt = $post_date;
		$newpost = compact("post_date", "post_content", "post_title", "post_author", "tags_input", "post_category", "post_date_gmt", "post_type", "post_status");
		$post_meta_tags = compact("meta_tag_title", "meta_tag_description", 'is_meta_tags');
		$result = wp_insert_post($newpost, true);
		if($result){
			if(isset($post_meta_tags)){
				if(isset($post_meta_tags['meta_tag_title'])){
					update_post_meta($result, "meta_tag_title", $post_meta_tags['meta_tag_title']);
				}
				if(isset($post_meta_tags['meta_tag_description'])) {
					update_post_meta($result, "meta_tag_description", $post_meta_tags['meta_tag_description']);
				}
				$is_meta_tags = isset($_POST['is_meta_tags']) ? 1 : 0;
				update_post_meta($result, "is_meta_tags", $post_meta_tags['is_meta_tags']);
			}
		}
		if (is_wp_error($result))
			return $this->response($result->get_error_message(), false);

		if (!$internal) {
			if (!$result)
				return $this->response($this->encryption->reply, 'Sorry, your entry could not be posted. Unknown error.', false);

			$this->_attach_uploads($ID, $post_content);
			$this->response($this->encryption->reply, array("success" => true, "id" => $result));
		} else {
			return $result;
		}
	}

	private function cf_batchPost() {
		$num = extract(func_get_arg(0));
		$success = array();
		foreach ($articles as $key => $article) {
			$success[$key] = $this->cf_newPost($article, true);
		}
		$this->response($this->encryption->reply, array("success" => $success));
	}

	private function cf_getPost() {

		$num = extract(func_get_arg(0));

		$post = get_post($id, ARRAY_A);
		$categories = array();
		foreach (wp_get_post_categories($id) as $category) {
			$cat = get_category($category);
			$categories[] = $cat->cat_ID;
		}
		$tags = array();
		foreach (wp_get_post_tags($id) as $tag) {
			$tags[] = $tag->name;
		}
		$post['mt_keywords'] = implode(",", $tags);
		$post['categories'] = $categories;
		$post['permalink'] = get_permalink( $id );

		// Get Category List
		$category_list = $this->cf_getCategories(NULL, true);
		$cat_list = array();
		foreach ($category_list as $cat) {
			$cat_list[$cat->cat_ID] = $cat->name;
		}
		// Get User List
		$user_list = $this->cf_getUsers(NULL, true);
		$users = array();
		foreach ($user_list as $user_data) {
			if ($user_data->display_name != '') {
				$users[$user_data->ID] = $user_data->display_name;
			} else {
				$users[$user_data->ID] = $user_data->user_login;
			}
		}
		$this->response($this->encryption->reply, array("post" => $post, "categories" => $cat_list, "users" => $users, "tags" => $tags));
	}

	private function cf_updatePost() {

		$num = extract(func_get_arg(0));
		$postdata = wp_get_single_post($ID, ARRAY_A);
		if ($postdata) {
			$post_type = isset($post_type) ? $post_type : "post";
			$post_status = isset($post_status) ? $post_status : "draft";

			$post_date_gmt = $post_date;
			$newpost = compact("ID", "post_date", "post_content", "post_author", "post_title", "tags_input", "post_category", "post_date_gmt", "post_type", "post_status");
			$post_meta_tags = compact('meta_tag_title','meta_tag_description','is_meta_tags');
			global $allowedposttags;
			
			$allowedposttags['iframe'] = array('src' => array () , 'allowfullscreen' => array() , 'height' => array() , 'width' => array() , 'frameborder' => array() );
			define('CUSTOM_TAGS',true);
			$result = wp_update_post($newpost, true);
			if($result){
				$result = wp_update_post($newpost, true);
				if(isset($post_meta_tags)){
					if(isset($post_meta_tags['meta_tag_title'])){
						update_post_meta($ID, "meta_tag_title", $post_meta_tags['meta_tag_title']);
					}
					if(isset($post_meta_tags['meta_tag_description'])) {
						update_post_meta($ID, "meta_tag_description", $post_meta_tags['meta_tag_description']);
					}
					$is_meta_tags = isset($_POST['is_meta_tags']) ? 1 : 0;
					update_post_meta($ID, "is_meta_tags", $post_meta_tags['is_meta_tags']);
				}
			}

			define('CUSTOM_TAGS',false);

			if (is_wp_error($result))
				return $this->response($result->get_error_message(), false);

			if (!$result)
				return $this->response($this->encryption->reply, 'Sorry, your entry could not be edited. Unknown error.', false);

			$this->_attach_uploads($ID, $post_content);
			$this->response($this->encryption->reply, array("success" => true));
		} else {
			$this->response($this->encryption->reply, "Invalid post ID", false);
		}
	}

	private function _attach_uploads($post_ID, $post_content) {
		global $wpdb;

		// find any unattached files
		$attachments = $wpdb->get_results("SELECT ID, guid FROM {$wpdb->posts} WHERE post_parent = '0' AND post_type = 'attachment'");
		if (is_array($attachments)) {
			foreach ($attachments as $file) {
				if (strpos($post_content, $file->guid) !== false)
					$wpdb->update($wpdb->posts, array('post_parent' => $post_ID), array('ID' => $file->ID));
			}
		}
	}

	private function cf_getCategories($args, $internal = false) {

		$tax = get_taxonomy("category");
		$args = func_get_args();
		$view = 0;
		$page = 2147483648;
		if (is_array($args)) {
			if (!is_null($args[0]) && !is_string($args[0])) {
				$num = extract($args[0]);
				$view = isset($view) ? (int) $view : 20;
				$page = isset($page) ? (int) ($page - 1) : 0;
			}
		}
		$params = array(
			"offset" => $page,
			"number" => $view,
			"hide_empty" => 0
		);
		if($order) {
			$order_arr = explode($order);
			$params['orderby'] = $order_arr[0];
			$params['order'] = $order_arr[1];
		}
		$count = count(get_categories(array("hide_empty" => 0)));
		$categories = get_categories($params);
		if ($internal) {
			return $categories;
		} elseif ($categories) {
			$this->response($this->encryption->reply, array("categories" => $categories, "total_count" => $count, "row_count" => count($categories)));
		} else {
			$this->response($this->encryption->reply, "Unable to retrieve categories", false);
		}
	}

	private function cf_getCategory() {
		$num = extract(func_get_arg(0));

		$cat = get_category($id);
		if ($cat) {
			$this->response($this->encryption->reply, array("category" => $cat));
		} else {
			$this->response($this->encryption->reply, "Category not found.", fales);
		}
	}

	private function cf_editCategory() {
		$num = extract(func_get_arg(0));

		$cat = get_category($cat_ID);
		if (!is_wp_error($cat)) {
			$term = get_term_by("id", $cat_ID, "category", ARRAY_A);
			$data['name'] = $name;
			$data['slug'] = $term['slug'];
			$data['term_group'] = $term['term_group'];
			$data['term_taxomony_id'] = $term['term_taxomony_id'];
			$data['taxomony'] = $term['taxomony'];
			$data['description'] = $description;
			$data['parent'] = $parent;
			$data['count'] = $term['count'];
			$result = wp_update_term($term['term_id'], "category", $data);
			if (is_wp_error($result)) {
				$this->response($this->encryption->reply, "WP Error(" . $result->get_error_code() . "): " . $result->get_error_message(), false);
			} else {
				$this->response($this->encryption->reply, array("success" => true));
			}
		} else {
			$this->response($this->encryption->reply, "WP Error(" . $result->get_error_code() . "): " . $result->get_error_message(), false);
		}
	}

	private function cf_newCategory() {
		$num = extract(func_get_arg(0));

		$errors = array();
		$names = array();
		foreach ($categories as $key => $category) {
			if (is_array($category)) {
				$name = isset($category['name']) ? $category['name'] : $category[0];
				$new_category = array(
					'name' => $name,
					'slug' => '',
					'parent' => isset($category['parent']) ? $category['parent'] :-1,
					'description' => isset($category['description']) ? $category['description'] : ''
				);
			}
			$result = wp_insert_term($name, "category", $new_category);
			if (is_wp_error($result)) {
				$errors = $result;
			} else {
				$names[$key] = array( 'id' => $result['term_id'] , 'name' => $name );
			}
		}

		if (!empty($errors)) {
			$msg = "";
			foreach ($errors as $error) {
				$msg .= "WP Error(" . $error->get_error_code() . "): " . $error->get_error_message() . "<br />";
			}
			$this->response($this->encryption->reply, $msg, false);
		} else {
			$this->response($this->encryption->reply, array("success" => true, "id" => $names));
		}
	}

	private function cf_deleteCategories() {
		$num = extract(func_get_arg(0));

		foreach ($ids as $id) {
			$ret = wp_delete_category($id);
		}
		$this->response($this->encryption->reply, array("success" => true));
	}

	private function cf_getUsers($args, $internal = false) {
		$args = func_get_args();
		$options = array(
			"orderby" => "ID"
		);
		if (is_array($args) && !empty($args)) {
			if (!is_null($args[0]) && !is_string($args[0])) {
				$options = $args[0];
			}
		}
		$users = get_users($options);
		if ($internal) {
			return $users;
		} elseif ($users) {
			$this->response($this->encryption->reply, array("users" => $users));
		} else {
			$this->response($this->encryption->reply, "Unable to retrieve user list", false);
		}
	}

//	function get_custom_fields($post_id) {
//		$post_id = (int) $post_id;
//
//		$custom_fields = array();
//
//		foreach ((array) has_meta($post_id) as $meta) {
//			// Don't expose protected fields.
//			if (strpos($meta['meta_key'], '_wp_') === 0) {
//				continue;
//			}
//
//			$custom_fields[] = array(
//				"id" => $meta['meta_id'],
//				"key" => $meta['meta_key'],
//				"value" => $meta['meta_value']
//			);
//		}
//
//		return $custom_fields;
//	}
//
//	function cf_editCategory($args) {
//		global $wpdb;
//
//		$blogID = (int) $args[0];
//		$userName = $wpdb->escape($args[1]);
//		$passWord = $wpdb->escape($args[2]);
//		$tag_ID = (int) $args[3];
//
//		if (!$user = $this->CheckUserName($userName, $passWord)) {
//			return 'Bad login/pass combination.';
//		}
//		$tax = get_taxonomy("category");
//		if (!current_user_can($tax->cap->edit_terms))
//			return "You are not allowed to edit Categories";
//		return wp_update_term($tag_ID, "category", $args[4]);
//	}
//
////		function cf_getPagedPosts( $args ) {
////			$blogID = (int) $args[0];
////			$userName = $wpdb->escape($args[1]);
////			$passWord = $wpdb->escape($args[2]);
////			$data = $args[3];
////			$offSet = isset($data[3]) ? absint($data[3]) : 0;
////			$numberPosts = isset($data[4]) ? absint($data[4]) : 10;
////			$category = isset($data[5]) ? $data[5] : '';
////			$orderBy = isset($data[6]) ? $data[6] : 'post_date';
////			$order = isset($data[7]) ? $data[7] : 'DESC';
////			$postStatus = isset($data[8]) ? $data[8] : 'publish';
////
////			if( !$this->CheckUserName($userName, $passWord) ) {
////				return 'Bad login/pass combination.';
////			}
////
////			wp_set_current_user( $user->ID );
////			do_action('xmlrpc_call', 'wp.getPagedPosts');
////
////			$postArgs = array(
////				'numberofposts' => $numberPosts,
////				'offset' => $offSet,
////				'category' => $category,
////				'order_by' => $orderBy,
////				'order' => $order,
////				'post_type' => 'post',
////				'post_status' => $postStatus
////			);
////			return get_posts($postArgs);
////		}
//
//	function cf_uploadFile($args) {
//		global $wpdb;
//
//
//		$blogId = (int) $args[0];
//		$userName = $wpdb->escape($args[1]);
//		$passWord = $wpdb->escape($args[2]);
//		$postId = isset($args[3]) ? (int) $args[3] : 0;
//		$data = $args[4];
//		$name = sanitize_file_name($data['name']);
//		$type = $data['type'];
//		$bits = $data['bits'];
//
//		if (!$user = $this->CheckUserName($userName, $passWord)) {
//			return 'Bad login/pass combination.';
//		}
//		do_action('xmlrpc_call', 'metaWeblog.newMediaObject');
//
//		if (!current_user_can('upload_files')) {
//			return new IXR_Error(401, __('You are not allowed to upload files to this site.'));
//		}
//
//		if ($upload_err = apply_filters('pre_upload_error', false))
//			return new IXR_Error(500, $upload_err);
//
//		if (!empty($data['overwrite']) && ($data['overwrite'] == true)) {
//			// Get postmeta info on the object.
//			$old_file = $wpdb->get_row("
//					SELECT ID
//					FROM {$wpdb->posts}
//					WHERE post_title = '{$name}'
//						AND post_type = 'attachment'
//				");
//
//			// Delete previous file.
//			wp_delete_attachment($old_file->ID);
//
//			// Make sure the new name is different by pre-pending the
//			// previous post id.
//			$filename = preg_replace('/^wpid\d+-/', '', $name);
//			$name = "wpid{$old_file->ID}-{$filename}";
//		}
//
//		$upload = wp_upload_bits($name, NULL, $bits);
//		if (!empty($upload['error'])) {
//			return new IXR_Error(500, sprintf(__('Could not write file %1$s (%2$s)'), $name, $upload['error']));
//		}
//		// Construct the attachment array
//		// attach to post_id 0
//		$attachment = array(
//			'post_title' => $name,
//			'post_content' => '',
//			'post_type' => 'attachment',
//			'post_parent' => $postId,
//			'post_mime_type' => $type,
//			'guid' => $upload['url']
//		);
//
//		// Save the data
//		$id = wp_insert_attachment($attachment, $upload['file'], $postId);
//		wp_update_attachment_metadata($id, wp_generate_attachment_metadata($id, $upload['file']));
//
//		return apply_filters('wp_handle_upload', array('attachment_id' => $id, 'file' => $name, 'url' => $upload['url'], 'type' => $type), 'upload');
//	}
}

//register_activation_hook( __FILE__, "checkVersion");
if (is_admin() && version_compare(PHP_VERSION, '5', '<')) {

	/**
	 * @since 1.0.5.6
	 */
	function myeasy_min_reqs() {

		echo '<div class="error">'
		. '<h3>' . __('Warning! It is not possible to activate this plugin as it requires PHP5 and on this server the PHP version installed is: ', MEBAK_LOCALE)
		. '<b>' . PHP_VERSION . '</b></h3>'
		. '<h3><a href="http://www.php.net/releases/#v4" target="_blank">' . __('PHP4 was discontinued by the PHP development team on December, 31 2007 !!', MEBAK_LOCALE) . '</a>'
		. '</h3>'
		. '<p>' . __('For security reasons we <b>warmly suggest</b> that you contact your hosting provider and ask to update your account to PHP5.', MEBAK_LOCALE)
		. '</p>'
		. '<p>' . __('If they refuse for whatever reason we suggest to <b>change provider as soon as possible</b>.', MEBAK_LOCALE)
		. '</p>'
		. '</div>'
		;

		$plugins = get_option('active_plugins');
		$out = array();
		foreach ($plugins as $key => $val) {

			if ($val != 'publishvault/contentfu.php') {

				$out[$key] = $val;
			}
		}

		update_option('active_plugins', $out);
	}

	add_action('admin_head', 'myeasy_min_reqs');

	return;
}
$contentFu = new ContentFu();
?>