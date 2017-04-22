<?php 
	class Main extends CI_Controller {
		public function __construct() {
			parent::__construct();
			// load session library
			$this->load->library('session');
			// load helpers
			$this->load->helper('url');
			$this->load->model('mblog');
		}
		
		public function index() {
			$data['allblogs'] = $this->mblog->getAllBlogs()->result();
			$data['main_title'] = "IMPACCT Solutions";
			$data['main_message'] = "Payroll, Accounting, Compilation, Consultation, and Taxes";
			$data['header_title'] = "IMPACCT: Main Page";
			$data['headline'] = "Welcome";
			$data['include'] = 'main_index';
			$this->load->view('header', $data);
			$this->load->view('main_template', $data);
		}
	
		public function blogs($id) {
			//$this->load->model('mblog');
			//does this creaste an associative array?
			$data['allblogs'] = $this->mblog->getAllBlogs()->result();
			$blog = $this->mblog->getBlogById($id)->result();
			//var_dump ($blog);
			$data['main_title'] = "IMPACCT Solutions";
			$data['main_message'] = "Blogs and Notes";
			$data['header_title'] = "IMPACCT: Main Page";
			$data['headline'] = $blog[0]->title;
			//$data['title'] = $blog['title'];
			$data['body'] = $blog[0]->body;
			$data['picture'] = $blog[0]->picture_file_name;
			$data['include'] = 'blog_article';
		
			$this->load->view('header', $data);
			$this->load->view('main_template', $data);
		}
	
	/*
	function login() {
		$data['allblogs'] = $this->mblog->getAllBlogs()->result();
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == FALSE) {
            // display information for the view
			$data['main_title'] = "IMPACCT Solutions";
			$data['main_message'] = "Please Login";
			$data['header_title'] = "IMPACCT: Login";
			$data['headline'] = "Login form:";
			$data['include'] = 'main_loginform';
				
			$this->load->view('header', $data);
			$this->load->view('main_template', $data);
		} else {
			// form is validated 
			// call database function to find user
			$this->find_user();
		}
	}
	*/
	
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
		$salt = substr($modified_base64_string, 0, $length);
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
	
	function user_login() {
			if (isset($_POST['submit'])) {
				$data['username'] = $_POST['user_name'];
				//echo $_POST['user_name'];
				$data['password'] = $_POST['password'];
			} else {
				$data['username'] = "";
				$data['password'] = "";
			}
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$this->form_validation->set_rules('user_name', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			if ($this->form_validation->run() == FALSE) {
				// display information for the view
				$data['allblogs'] = $this->mblog->getAllBlogs()->result();
				$data['main_title'] = "IMPACCT Solutions";
				$data['main_message'] = "Please Login";
				$data['header_title'] = "IMPACCT Solutions login";
				$data['headline'] = "User Login form:";
				$data['include'] = 'main_userloginform';
				
				$this->load->view('header', $data);
				$this->load->view('main_template', $data);
			} else {
				// form is validated 
				// call database function to find user
				$this->get_user();
			}
		}
		
	function get_user() {
			$this->load->model('muser');
			$result = $this->muser->getUserByName($_POST['user_name']);
			$row = $result->row();
			//echo $row->hashed_password;
			if ($this->password_check($_POST['password'],$row->hashed_password)){
				//echo "user found";
				$_SESSION['user_id'] = $row->id;
				$_SESSION['user_name']=$row->user_name;
				//echo $row->id;
				if ($row->new_user) {
					redirect('accounting/disclaimer','refresh');
				} else {
				redirect('accounting/index','refresh');
				}
			} else {
				echo "user not found";
			}
		}	
		
	function admin_login() {
			if (isset($_POST['submit'])) {
				$data['username'] = $_POST['admin_name'];
				//echo $_POST['user_name'];
				$data['password'] = $_POST['password'];
			} else {
				$data['username'] = "";
				$data['password'] = "";
			}
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$this->form_validation->set_rules('user_name', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			if ($this->form_validation->run() == FALSE) {
				// display information for the view
				$data['allblogs'] = $this->mblog->getAllBlogs()->result();
				$data['main_title'] = "IMPACCT Solutions";
				$data['main_message'] = "Please Login";
				$data['header_title'] = "IMPACCT Solutions login";
				$data['headline'] = "Admin Login form:";
				$data['include'] = 'main_adminloginform';
				
				$this->load->view('header', $data);
				$this->load->view('main_template', $data);
			} else {
				// form is validated 
				// call database function to find user
				$this->get_admin();
			}
		}
		
	function get_admin() {
			$this->load->model('madmin');
			$result = $this->madmin->getadminByName($_POST['admin_name']);
			$row = $result->row();
			//echo $row->hashed_password;
			if ($this->password_check($_POST['password'],$row->hashed_password)){
				//echo "user found";
				$_SESSION['user_id'] = $row->id;
				$_SESSION['user_name']=$row->admin_name;
				//echo $row->id;
				redirect('admin/index','refresh');
			} else {
				echo "user not found";
			}
		}	
		
}
/* End of file main.php */
/* Location: ./system/application/controllers/main.php */
