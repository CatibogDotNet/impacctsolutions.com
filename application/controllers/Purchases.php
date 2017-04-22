<?php 
	class Purchases extends CI_Controller {
		//private variables
				
		public function __construct() {
			parent::__construct();
			// load session library
			$this->load->library('session');
			// load helpers
			$this->load->helper('url');
			// load database
			$this->load->database();
			
			//read the last purchases record in the database
			
		}
	  
	function index() {
		if(!isset($_SESSION['user_id'])) {
			$this->logout();
		}
		// display information for the view
		$data['purchases_title'] = "IMPACCT Solutions";
		$data['purchases_message'] = "Please read the disclaimer";
		$data['header_title'] = "IMPACCT: Purchases Page";
		$data['headline'] = "Welcome to IMPACCT Solutions";
		$data['include'] = 'purchases_index';
			
		$this->load->view('header', $data);
		$this->load->view('purchases_template', $data);
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
		$data['purchases_title'] = "IMPACCT Solutions";
		$data['purchases_message'] = "By being on this page, you warrant that you have read the disclaimer";
		$data['header_title'] = "IMPACCT: POS Page";
		$data['headline'] = "Welcome to IMPACCT Solutions Point of Sale";
		$data['include'] = 'purchases_pos';
			
		$this->load->view('header', $data);
		$this->load->view('purchases_template', $data);
	}
	
	function createPos() {
			if(!isset($_SESSION['user_id'])) {
				$this->logout();
			}
			//edit this .....
			$this->load->helper('url');
			$this->load->model('MPos','',TRUE);
			$admin_data['admin_name']= $_POST['admin_name'];
			$hashed_password = $this->password_encrypt($_POST['password']);
			$admin_data['hashed_password']= $hashed_password;
			$this->MAdmin->addAdmin($admin_data);
			redirect('admin/listing','refresh');
		}
	
	function listingPos() {
			if(!isset($_SESSION['user_id'])) {
				$this->logout();
			}
			
			//Load \system\libraries\Table.php	
			$this->load->library('table');
    
			//Load mpos.php and call listPos() function to read all records
			$this->load->model('MPos','',TRUE);
			$pos_qry = $this->MPos->getAllPosH();

			// generate HTML table from query results
			$tmpl = array (
				'table_open' => '<table border="0" cellpadding="3" cellspacing="0">',
				'heading_row_start' => '<tr bgcolor="#66cc44">',
				'row_start' => '<tr bgcolor="#dddddd">' 
			);
			$this->table->set_template($tmpl); 
			$this->table->set_empty("&nbsp;"); 
			$this->table->set_heading('', 'Item', 'Price', 'Qty', 'Tax', 'Value');
			$table_row = array();
			foreach ($pos_qry->result() as $pos) {
				$table_row = NULL;
				$table_row[] = '<nobr>' . 
				anchor('pos/edit/' . $pos->id, 'edit') . ' | ' .
				anchor('pos/delete/' . $pos->id, 'delete',
					"onClick=\" return confirm('Are you sure you want to '
					+ 'delete the record for $pos->item?')\"") .
					'</nobr>';
				// replaced above :: $table_row[] = anchor('admin/edit/' . $admin->id, 'edit');
				$table_row[] = $pos->item;
				$table_row[] = $pos->price;
				$table_row[] = $pos->qty;
				$table_row[] = $pos->tax;
				$table_row[] = $pos->value;
      
				$this->table->add_row($table_row);
			}    

			$pos_table = $this->table->generate();
    
			// generate HTML table from query results
			// replaced above :: $students_table = $this->table->generate($students_qry);
    
			// display information for the view
			$data['admin_title'] = "IMPACCT: Admin Listing";
			$data['admin_message'] = "Testing...";
			$data['header_title'] = "IMPACCT Solutions";
			$data['headline'] = "Point of Sale Listing";
			$data['include'] = 'pos_listing';

			$data['data_table'] = $pos_table;
			$this->load->view('header', $data);
			$this->load->view('pos_template', $data);
		}
}
/* End of file purchases.php */
/* Location: ./system/application/controllers/purchases.php */
