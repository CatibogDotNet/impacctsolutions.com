<?php 
	class User extends CI_Controller {
		public function __construct() {
			parent::__construct();
			// load session library
			$this->load->library('session');
			// load helpers
			$this->load->helper('url');
		}
	  
		function index() {
			if(!isset($_SESSION['user_id'])) {
				$this->logout();
			}
			
			// display information for the view
			$data['user_title'] = "IMPACCT Solutions";
			$data['user_message'] = "Please read the disclaimer";
			$data['header_title'] = "IMPACCT Solutions index";
			$data['headline'] = "Welcome to IMPACCT Solutions";
			$data['include'] = 'user_index';
			
			$this->load->view('header', $data);
			$this->load->view('user_template', $data);
		}

		function login() {
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
				$data['user_title'] = "IMPACCT Solutions";
				$data['user_message'] = "Please Login";
				$data['header_title'] = "IMPACCT Solutions login";
				$data['headline'] = "User Login form:";
				$data['include'] = 'user_loginform';
				
				$this->load->view('header', $data);
				$this->load->view('user_template', $data);
			} else {
				// form is validated 
				// call database function to find user
				$this->get_user();
			}
				
		}
	
		function listing() {
			if(!isset($_SESSION['user_id'])) {
				$this->logout();
			}
			
			//Load \system\libraries\Table.php	
			$this->load->library('table');
    
			//Load muser.php and call listAdmin() function
			$this->load->model('MUser','',TRUE);
			$user_qry = $this->MUser->listUser();

			// generate HTML table from query results
			$tmpl = array (
				'table_open' => '<table border="0" cellpadding="3" cellspacing="0">',
				'heading_row_start' => '<tr bgcolor="#66cc44">',
				'row_start' => '<tr bgcolor="#dddddd">' 
			);
			$this->table->set_template($tmpl); 
			$this->table->set_empty("&nbsp;"); 
			$this->table->set_heading('', 'User Name', 'Company', 'New User?' );
			$table_row = array();
			foreach ($user_qry->result() as $user) {
				$table_row = NULL;
				$table_row[] = '<nobr>' . 
				anchor('user/edit/' . $user->id, 'edit') . ' | ' .
				anchor('user/delete/' . $user->id, 'delete',
					"onClick=\" return confirm('Are you sure you want to '
					+ 'delete the record for $user->user_name?')\"") .
					'</nobr>';
				// replaced above :: $table_row[] = anchor('user/edit/' . $user->id, 'edit');
				$table_row[] = $user->user_name;
				$table_row[] = $user->company_id;
				$table_row[] = $user->new_user;
				$this->table->add_row($table_row);
			}    

			$user_table = $this->table->generate();
    
			// generate HTML table from query results
			// replaced above :: $students_table = $this->table->generate($students_qry);
    
			// display information for the view
			$data['user_title'] = "IMPACCT: Users Listing";
			$data['user_message'] = "Testing...";
			$data['header_title'] = "IMPACCT Solutions";
			$data['headline'] = "User Listing";
			$data['include'] = 'user_listing';

			$data['data_table'] = $user_table;
			$this->load->view('header', $data);
			$this->load->view('user_template', $data);
		}
	
		function add() {
			if(!isset($_SESSION['user_id'])) {
				$this->logout();
			}
			
			$this->load->helper('form');
    
			// display information for the view
			$data['user_title'] = "IMPACCT: Add User";
			$data['user_message'] = "User message";
			$data['header_title'] = "IMPACCT Solutions";
			$data['headline'] = "Add a New User";
			$data['include'] = 'user_add';
		
			$this->load->view('header', $data);
			$this->load->view('user_template', $data);
		}
	
		function select() {
			if(!isset($_SESSION['user_id'])) {
				$this->logout();
			}
			
			$this->load->helper('form');
			$id = $this->uri->segment(3);
			echo $id;
			//to do stuff
			
		}

		function edit() {
			if(!isset($_SESSION['user_id'])) {
				$this->logout();
			}
			
			$this->load->helper('form');
			$id = $this->uri->segment(3);
			echo $id;
			$this->load->model('MUser','',TRUE);
			$data['row'] = $this->MUser->getUserById($id)->result();

			// display information for the view
			$data['user_title'] = "User: Edit User";
			$data['user_message'] = "User message";
			$data['header_title'] = "IMPACCT Solutions";
			$data['headline'] = "Edit User Information";
			$data['include'] = 'user_edit';
		
			$this->load->view('header', $data);
			$this->load->view('user_template', $data);
		}
		
		function update() {
			if(!isset($_SESSION['user_id'])) {
				$this->logout();
			}
			
			$this->load->model('MUser','',TRUE);
			$this->MUser->updateUser($_POST['id'], $_POST);
			redirect('user/listing','refresh');
		}
		
		function create() {
			if(!isset($_SESSION['user_id'])) {
				$this->logout();
			}
			
			$this->load->helper('url');
			$this->load->model('MUser','',TRUE);
			$user_data['user_name']= $_POST['user_name'];
			$hashed_password = $this->password_encrypt($_POST['password']);
			$user_data['hashed_password']= $hashed_password;
			$this->MUser->addUser($user_data);
			redirect('user/listing','refresh');
		}
	
		function delete() {
			if(!isset($_SESSION['user_id'])) {
				$this->logout();
			}
			
			$id = $this->uri->segment(3);
    
			$this->load->model('MUser','',TRUE);
			$this->MUser->deleteUser($id);
			redirect('user/listing','refresh');
		}
	
		function get_user() {
			if(!isset($_SESSION['user_id'])) {
				$this->logout();
			}
			
			$this->load->model('muser');
			$result = $this->muser->getUserByName($_POST['user_name']);
			$row = $result->row();
			//echo $row->hashed_password;
			if ($this->password_check($_POST['password'],$row->hashed_password)){
				//echo "user found";
				$_SESSION['user_id'] = $row->id;
				$_SESSION['user_name']=$row->user_name;
				//echo $row->id;
				redirect('accounting/index','refresh');
			} else {
				echo "user not found";
			}
		}
	
	
		function password_encrypt($password) {
			// Tells PHP to use Blowfish with a cost of 11
			$hash_format = "$2y$11$";
			// Blowfish salts should be 22 characters or more
			$salt_length = 22;
			$salt = $this->generate_salt($salt_length);
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
				echo "password checked";
				return true;
			} else {
				echo "password failed";
				return false;
			}
		}
		
		
		function logout() {
			$_SESSION['user_id'] = null;
			$_SESSION['user_name'] = null;
			redirect('main/index','refresh');
		}
	}
/* End of file user.php */
/* Location: ./system/application/controllers/user.php */
?>