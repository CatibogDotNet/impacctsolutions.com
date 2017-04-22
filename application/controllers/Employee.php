<?php 
	class Employee extends CI_Controller {
		public function __construct() {
			parent::__construct();
			// load session library
			$this->load->library('session');
			// load helpers
			$this->load->helper('url');
		}
	  
		function index() {
			//check to see if session has been set 
			if (isset($_SESSION['employee_id'])) {
				// display information for the view
				$data['employee_title'] = "IMPACCT Solutions";
				$data['employee_message'] = "Please read the disclaimer";
				$data['header_title'] = "IMPACCT Solutions index";
				$data['headline'] = "Welcome to IMPACCT Solutions";
				$data['include'] = 'employee_index';
			
				$this->load->view('header', $data);
				$this->load->view('employee_template', $data);
			} else {
				// go to public site
				$this->login();
			}
		}

		function login() {
			if (isset($_POST['submit'])) {
				$data['employeename'] = "test";
				//$_POST['employee_name'];
				//echo $_POST['employee_name'];
				$data['password'] = $_POST['password'];
			} else {
				$data['employeename'] = "";
				$data['password'] = "";
			}
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$this->form_validation->set_rules('employee_name', 'Employeename', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			if ($this->form_validation->run() == FALSE) {
				// display information for the view
				$data['employee_title'] = "IMPACCT Solutions";
				$data['employee_message'] = "Please Login";
				$data['header_title'] = "IMPACCT Solutions login";
				$data['headline'] = "Employee Login form:";
				$data['include'] = 'employee_loginform';
				
				$this->load->view('header', $data);
				$this->load->view('employee_template', $data);
			} else {
				// form is validated 
				// call database function to find employee
				$this->get_employee();
			}
				
		}
	
		function listing() {
			//Load \system\libraries\Table.php	
			$this->load->library('table');
    
			//Load memployee.php and call listAdmin() function
			$this->load->model('MEmployee','',TRUE);
			$employee_qry = $this->MEmployee->listEmployee();

			// generate HTML table from query results
			$tmpl = array (
				'table_open' => '<table border="0" cellpadding="3" cellspacing="0">',
				'heading_row_start' => '<tr bgcolor="#66cc44">',
				'row_start' => '<tr bgcolor="#dddddd">' 
			);
			$this->table->set_template($tmpl); 
			$this->table->set_empty("&nbsp;"); 
			$this->table->set_heading('', 'Employee Name', 'Hashed Password');
			$table_row = array();
			foreach ($employee_qry->result() as $employee) {
				$table_row = NULL;
				$table_row[] = '<nobr>' . 
				anchor('employee/edit/' . $employee->id, 'edit') . ' | ' .
				anchor('employee/delete/' . $employee->id, 'delete',
					"onClick=\" return confirm('Are you sure you want to '
					+ 'delete the record for $employee->employee_name?')\"") .
					'</nobr>';
				// replaced above :: $table_row[] = anchor('employee/edit/' . $employee->id, 'edit');
				$table_row[] = $employee->employee_name;
				$table_row[] = $employee->hashed_password;
      
				$this->table->add_row($table_row);
			}    

			$employee_table = $this->table->generate();
    
			// generate HTML table from query results
			// replaced above :: $students_table = $this->table->generate($students_qry);
    
			// display information for the view
			$data['employee_title'] = "IMPACCT: Employees Listing";
			$data['employee_message'] = "Testing...";
			$data['header_title'] = "IMPACCT Solutions";
			$data['headline'] = "Employee Listing";
			$data['include'] = 'employee_listing';

			$data['data_table'] = $employee_table;
			$this->load->view('header', $data);
			$this->load->view('employee_template', $data);
		}
	
		function add() {
			$this->load->helper('form');
    
			// display information for the view
			$data['employee_title'] = "IMPACCT: Add Employee";
			$data['employee_message'] = "Employee message";
			$data['header_title'] = "IMPACCT Solutions";
			$data['headline'] = "Add a New Employee";
			$data['include'] = 'employee_add';
		
			$this->load->view('header', $data);
			$this->load->view('employee_template', $data);
		}
	
		function edit() {
			$this->load->helper('form');
			$id = $this->uri->segment(3);
			echo $id;
			$this->load->model('MEmployee','',TRUE);
			$data['row'] = $this->MEmployee->getEmployeeById($id)->result();

			// display information for the view
			$data['employee_title'] = "Employee: Edit Employee";
			$data['employee_message'] = "Employee message";
			$data['header_title'] = "IMPACCT Solutions";
			$data['headline'] = "Edit Employee Information";
			$data['include'] = 'employee_edit';
		
			$this->load->view('header', $data);
			$this->load->view('employee_template', $data);
		}

		function update() {
			$this->load->model('MEmployee','',TRUE);
			$this->MEmployee->updateEmployee($_POST['id'], $_POST);
			redirect('employee/listing','refresh');
		}
	
		function create() {
			$this->load->helper('url');
			$this->load->model('MEmployee','',TRUE);
			$employee_data['employee_name']= $_POST['employee_name'];
			$hashed_password = $this->password_encrypt($_POST['password']);
			$employee_data['hashed_password']= $hashed_password;
			$this->MEmployee->addEmployee($employee_data);
			redirect('employee/listing','refresh');
		}
	
		function delete() {
			$id = $this->uri->segment(3);
    
			$this->load->model('MEmployee','',TRUE);
			$this->MEmployee->deleteEmployee($id);
			redirect('employee/listing','refresh');
		}
	
		function get_employee() {
			$this->load->model('memployee');
			$result = $this->memployee->getEmployeeByName($_POST['employee_name']);
			$row = $result->row();
			echo $row->hashed_password;
			if ($this->password_check($_POST['password'],$row->hashed_password)){
				//echo "employee found";
				$_SESSION['employee_id'] = $row->id;
				$_SESSION['employee_name']=$row->employee_name;
				//echo $row->id;
				redirect('accounting/index','refresh');
			} else {
				echo "employee not found";
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
	
	}
/* End of file employee.php */
/* Location: ./system/application/controllers/employee.php */
?>
