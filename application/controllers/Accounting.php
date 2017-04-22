<?php 
	class Accounting extends CI_Controller {
		public function __construct() {
			parent::__construct();
			// load session library
			$this->load->library('session');
			// load helpers
			$this->load->helper('url');
		}
	  
		public function index() {
			if(!isset($_SESSION['user_id'])) {
				//logout if not logged in
				$this->logout();
			}
			$data['accounting_title'] = "IMPACCT Solutions";
			$data['accounting_message'] = "Welcome to IMPACCT Accounting, " . ucfirst($_SESSION['user_name']);
			$data['header_title'] = "IMPACCT: Accounting Home";
			$data['headline'] = "Accounting:";
			$data['include'] = 'accounting_index';
			$this->load->view('header', $data);
			$this->load->view('accounting_template', $data);
		}

		function logout() {
			$_SESSION['user_id'] = null;
			$_SESSION['user_name'] = null;
			redirect('main/index','refresh');
		}
			
		function gl() {
			if(!isset($_SESSION['user_id'])) {
				$this->logout();
			}
			$data['accounting_title'] = "IMPACCT Solutions";
			$data['accounting_message'] = "Welcome to IMPACCT Accounting". ucfirst($_SESSION['user_name']);
			$data['header_title'] = "IMPACCT: Accounting - General Ledger";
			$data['headline'] = "Accounting: General Ledger";
			$data['include'] = 'accounting_gl';
				
			$this->load->view('header', $data);
			$this->load->view('accounting_template', $data);
		}	
		
		function sales() {
			if(!isset($_SESSION['user_id'])) {
				$this->logout();
			}
			$data['accounting_title'] = "IMPACCT Solutions";
			$data['accounting_message'] = "Welcome to IMPACCT Accounting, ". ucfirst($_SESSION['user_name']);
			$data['header_title'] = "IMPACCT: Accounting - Sales";
			$data['headline'] = "Accounting: Sales";
			$data['include'] = 'accounting_sales';
				
			$this->load->view('header', $data);
			$this->load->view('accounting_template', $data);
		}
		
		function ar() {
			if(!isset($_SESSION['user_id'])) {
				$this->logout();
			}
			$data['accounting_title'] = "IMPACCT Solutions";
			$data['accounting_message'] = "Welcome to IMPACCT Accounting". ucfirst($_SESSION['user_name']);
			$data['header_title'] = "IMPACCT: Accounting - Accounts Receivable";
			$data['headline'] = "Accounting: Accounts Receivable";
			$data['include'] = 'accounting_ar';
				
			$this->load->view('header', $data);
			$this->load->view('accounting_template', $data);
		}
		
		function purchases() {
			if(!isset($_SESSION['user_id'])) {
				$this->logout();
			}
			$data['accounting_title'] = "IMPACCT Solutions";
			$data['accounting_message'] = "Welcome to IMPACCT Accounting". ucfirst($_SESSION['user_name']);
			$data['header_title'] = "IMPACCT: Accounting  - Purchases";
			$data['headline'] = "Accounting: Purchases";
			$data['include'] = 'accounting_purchases';
				
			$this->load->view('header', $data);
			$this->load->view('accounting_template', $data);
		}
		
		function ap() {
			if(!isset($_SESSION['user_id'])) {
				$this->logout();
			}
			$data['accounting_title'] = "IMPACCT Solutions";
			$data['accounting_message'] = "Welcome to IMPACCT Accounting". ucfirst($_SESSION['user_name']);
			$data['header_title'] = "IMPACCT: Accounting  - Accounts Payable";
			$data['headline'] = "Accounting: Accounts Payable";
			$data['include'] = 'accounting_ap';
				
			$this->load->view('header', $data);
			$this->load->view('accounting_template', $data);
		}
		
		function payroll() {
			if(!isset($_SESSION['user_id'])) {
				$this->logout();
			}
			$data['accounting_title'] = "IMPACCT Solutions";
			$data['accounting_message'] = "Welcome to IMPACCT Accounting". ucfirst($_SESSION['user_name']);
			$data['header_title'] = "IMPACCT: Accounting - Payroll";
			$data['headline'] = "Accounting: Payroll";
			$data['include'] = 'accounting_payroll';
				
			$this->load->view('header', $data);
			$this->load->view('accounting_template', $data);
		}
		
		function reports() {
			if(!isset($_SESSION['user_id'])) {
				$this->logout();
			}
			$data['accounting_title'] = "IMPACCT Solutions";
			$data['accounting_message'] = "Welcome to IMPACCT Accounting". ucfirst($_SESSION['user_name']);
			$data['header_title'] = "IMPACCT: Accounting - Reports";
			$data['headline'] = "Accounting: Reports";
			$data['include'] = 'accounting_reports';
				
			$this->load->view('header', $data);
			$this->load->view('accounting_template', $data);
		}
		
		function disclaimer_read(){
			if(!isset($_SESSION['user_id'])) {
				$this->logout();
			}
			if ($_POST['submit'] == "Cancel") {
				$this->logout();
			} else {
				//update new_user flag
				$id = $_SESSION['user_id'];
				$this->load->model('MUser','',TRUE);
				$current_user_data = $this->MUser->getUserById($id)->result();
				//var_dump($current_user_data);
				$updated_user_data = array('id'=>(int)$current_user_data[0]->id,
											'user_name'=>$current_user_data[0]->user_name,
											'hashed_password'=>$current_user_data[0]->hashed_password,
											'company_id'=>(int)$current_user_data[0]->company_id,
											'new_user'=>0);
				//var_dump($updated_user_data);							
				$this->MUser->updateuser($id, $updated_user_data);
				$this->index();
				
			} 
		}
		
		function disclaimer() {
			if(!isset($_SESSION['user_id'])) {
				$this->logout();
			}
			$this->load->helper('form');
			$data['accounting_title'] = "IMPACCT Solutions";
			$data['accounting_message'] = "Disclaimer";
			$data['header_title'] = "IMPACCT: Disclaimer";
			$data['headline'] = "Welcome to IMPACCT Solutions";
			$data['include'] = 'accounting_disclaimer';
			
			$this->load->view('header', $data);
			$this->load->view('accounting_template', $data);
		}
		
	}
/* End of file accounting.php */
/* Location: ./system/application/controllers/accounting.php */
?>