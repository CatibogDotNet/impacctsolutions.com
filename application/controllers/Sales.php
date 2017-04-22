<?php 
	class Sales extends CI_Controller {
		//private variables
		private $transNo = 0;
		private $subTotal = 0;
		private $transDate = "";
		private $item = "";
		private $price = 0;
		
		
		public function __construct() {
			parent::__construct();
			// load session library
			$this->load->library('session');
			// load helpers
			$this->load->helper('url');
			// load database
			$this->load->database();
			
			//read the last sales record in the database
			
		}
	  
	function index() {
		if(!isset($_SESSION['user_id'])) {
			$this->logout();
		}
		// display information for the view
		$data['sales_title'] = "IMPACCT Solutions";
		$data['sales_message'] = "Please read the disclaimer";
		$data['header_title'] = "IMPACCT: Sales Page";
		$data['headline'] = "Welcome to IMPACCT Solutions";
		$data['include'] = 'sales_index';
			
		$this->load->view('header', $data);
		$this->load->view('sales_template', $data);
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
			var_dump ($_POST['transNumber']);
			$data['trans_no'] = (int)$_POST['transNumber'];
			//var_dump ($_POST['submit']);	
			//process if Process Bar Code was clicked
			$data['subtotal'] = 0;
			$data['total_taxes'] = 0;
			$data['total'] = 0;	
			echo 'submit Complete Sale has arrived';
		} else {
			//initialize
			$this->load->model('mpos');
			$result = $this->mpos->getCountPos();
			$result = $result + 1;
			$data['trans_no'] = $result;
			$data['subtotal'] = 0;
			$data['total_taxes'] = 0;
			$data['total'] = 0;	
			$this->transNo = $result;
		} 
		
		//Load \system\libraries\Table.php	
		$this->load->library('table');
    
		//Load mpos.php and call getPosByTransNo() function to read all records for the particular transaction number
		$this->load->model('MPos','',TRUE);
		$pos_qry_result = $this->MPos->getPosByTransNo($this->transNo);
		var_dump ($pos_qry_result->result());

		
		$this->load->helper(array('form'));
		// display information for the view
		$data['sales_title'] = "IMPACCT Solutions";
		$data['sales_message'] = "Point of Sale";
		$data['header_title'] = "IMPACCT: POS Page";
		$data['headline'] = "Welcome to IMPACCT Solutions Point of Sale";
		$data['include'] = 'sales_pos';
			
		$this->load->view('header', $data);
		$this->load->view('sales_template', $data);
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
		
	function get_barcode_submitted() {
		echo "bar code submitted has arrived";
	}	
		
}
/* End of file sales.php */
/* Location: ./system/application/controllers/sales.php */
