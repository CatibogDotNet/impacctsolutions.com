<?php 
	class Pos extends CI_Controller {
		//private variables
		private $transNo = 0;
		private $transDate = "";
		private $item = "";
		private $price = 0;
		
		
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
		$data['pos_title'] = "IMPACCT Solutions";
		$data['pos_message'] = "Please read the disclaimer";
		$data['header_title'] = "IMPACCT: Sales Page";
		$data['headline'] = "Welcome to IMPACCT Solutions";
		$data['include'] = 'pos_index';	
		$this->load->view('header', $data);
		$this->load->view('pos_template', $data);
	}
	
	function logout() {
		$_SESSION['user_id'] = null;
		$_SESSION['user_name'] = null;
		redirect('main/index','refresh');
	}
	
	function pos() {
		if(!isset($_SESSION['user_id'])) {
			$this->logout();
		}
		
		if(isset($_POST['submit'])){
			//process submitted data
			echo 'submit arrived';
		} else {
			//display current data by reading the last transaction on file
			
			
		} 
				
		$this->load->helper(array('form'));
		// display information for the view
		$data['pos_title'] = "IMPACCT Solutions";
		$data['pos_message'] = "By being on this page, you warrant that you have read the disclaimer";
		$data['header_title'] = "IMPACCT: POS Page";
		$data['headline'] = "Welcome to IMPACCT Solutions Point of Sale";
		$data['include'] = 'pos_pos';
			
		$this->load->view('header', $data);
		$this->load->view('pos_template', $data);
	}
	
	function create() {
			if(!isset($_SESSION['user_id'])) {
				$this->logout();
			}
			
			$this->load->helper('url');
			$this->load->model('MAdmin','',TRUE);
			$admin_data['admin_name']= $_POST['admin_name'];
			$hashed_password = $this->password_encrypt($_POST['password']);
			$admin_data['hashed_password']= $hashed_password;
			$this->MAdmin->addAdmin($admin_data);
			redirect('admin/listing','refresh');
		}
	
	function listing() {
			if(!isset($_SESSION['user_id'])) {
				$this->logout();
			}
			
			//Load \system\libraries\Table.php	
			$this->load->library('table');
    
			//Load madmin.php and call listAdmin() function
			$this->load->model('MAdmin','',TRUE);
			$admin_qry = $this->MAdmin->listAdmin();

			// generate HTML table from query results
			$tmpl = array (
				'table_open' => '<table border="0" cellpadding="3" cellspacing="0">',
				'heading_row_start' => '<tr bgcolor="#66cc44">',
				'row_start' => '<tr bgcolor="#dddddd">' 
			);
			$this->table->set_template($tmpl); 
			$this->table->set_empty("&nbsp;"); 
			$this->table->set_heading('', 'Admin Name', 'Hashed Password');
			$table_row = array();
			foreach ($admin_qry->result() as $admin) {
				$table_row = NULL;
				$table_row[] = '<nobr>' . 
				anchor('admin/edit/' . $admin->id, 'edit') . ' | ' .
				anchor('admin/delete/' . $admin->id, 'delete',
					"onClick=\" return confirm('Are you sure you want to '
					+ 'delete the record for $admin->admin_name?')\"") .
					'</nobr>';
				// replaced above :: $table_row[] = anchor('admin/edit/' . $admin->id, 'edit');
				$table_row[] = $admin->admin_name;
				$table_row[] = $admin->hashed_password;
      
				$this->table->add_row($table_row);
			}    

			$admin_table = $this->table->generate();
    
			// generate HTML table from query results
			// replaced above :: $students_table = $this->table->generate($students_qry);
    
			// display information for the view
			$data['admin_title'] = "IMPACCT: Admin Listing";
			$data['admin_message'] = "Testing...";
			$data['header_title'] = "IMPACCT Solutions";
			$data['headline'] = "Admin Listing";
			$data['include'] = 'admin_listing';

			$data['data_table'] = $admin_table;
			$this->load->view('header', $data);
			$this->load->view('admin_template', $data);
		}
}
/* End of file pos.php */
/* Location: ./system/application/controllers/pos.php */
