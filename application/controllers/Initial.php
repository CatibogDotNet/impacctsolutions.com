<?php 
	class Initial extends CI_Controller {
		public function __construct() {
			parent::__construct();
			$this->index();
		}
		
	function index() {
		$this->create();
	}	
	function create() {
			$this->load->helper('url');
			$this->load->model('MAdmin','',TRUE);
			$admin_data['admin_name']= "wil";
			$hashed_password = $this->password_encrypt("wil");
			$admin_data['hashed_password']= $hashed_password;
			$this->MAdmin->addAdmin($admin_data);
			redirect('admin/listing','refresh');
	}
	
	function password_encrypt($password) {
		// Tells PHP to use Blowfish with a cost of 11
		$hash_format = "$2y$11$";
		// Blowfish salts should be 22 characters or more
		$salt_length = 22;
		//$salt = $this->generate_salt($salt_length);
		$unique_random_string = md5(uniqid(mt_rand(), true));

		// valid characters for a salt are [a-zA-Z0-9./]
		$base64_string = base64_encode($unique_random_string);

		// But not '+' which is valid in base64 encoding
		$modified_base64_string = str_replace('+', '.',$base64_string);

		//Truncate string to the correct length
		$salt = substr($modified_base64_string, 0, $salt_length);
		$format_and_salt = $hash_format . $salt;
		$hash = crypt($password, $format_and_salt);
		return $hash;
	}

	function generate_salt($length) {
		// Not 100% unique, not 100% random, but good enough for salt
		// MD5 returns 32 characters
		$unique_random_string = md5(uniqid(mt_rand(), true));

		// valid characters for a salt are [a-zA-Z0-9./]
		$base64_string = base64_encode($unique_random_string);

		// But not '+' which is valid in base64 encoding
		$modified_base64_string = str_replace('+', '.',$base64_string);

		//Truncate string to the correct length
		$salt = substr($modified_base64_string, 0, $length);
		return $salt;
	}

	function password_check($password, $existing_hash) {
		// existing has contains format and salt at start
		$hash = crypt($password, $existing_hash);
		if ($hash === $existing_hash) {
			return true;
		} else {
			return false;
		}
	}
}
/* End of file initial.php */
/* Location: ./system/application/controllers/initial.php */
