<?php

class Inventory extends CI_Controller {
	public function __construct() {
        parent::__construct();
		// load helpers
		$this->load->helper('url');
	}
	  
  function index()
  {
    // display information for the view
    $data['title'] = "Inventory Module";
    $data['headline'] = "Welcome to the Inventory Management System";
    $data['include'] = 'inventory_index';

    $this->load->view('inventory_template', $data);
  }

	function add() {
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('bar_code', 'Bar Code', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required');
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = "Add Inventory";
			$data['headline'] = "Add a New Inventory";
			$data['include'] = 'inventory_add';
			$this->load->view('inventory_template', $data);
		} else {
            $this->load->view('formsuccess');
        }
	}

	function create() {
		$this->load->helper('url');
		$this->load->model('MInventory','',TRUE);
		$this->MInventory->addInventory($_POST);
		redirect('inventory/listing','refresh');
	}

	function listing() {
		//Load \system\libraries\Table.php	
		$this->load->library('table');
    
		//Load mstudent.php and call listStudents() function
		$this->load->model('MInventory','',TRUE);
		$inventory_query = $this->MInventory->listInventory();

		// generate HTML table from query results
		$tmpl = array (
			'table_open' => '<table border="0" cellpadding="3" cellspacing="0">',
			'heading_row_start' => '<tr bgcolor="#66cc44">',
			'row_start' => '<tr bgcolor="#dddddd">' 
		);
		$this->table->set_template($tmpl); 
		$this->table->set_empty("&nbsp;"); 
		$this->table->set_heading('', 'Bar Code', 'Description', 'List Price', 'Qty On Hand');
		$table_row = array();
		foreach ($inventory_query->result() as $inventory) {
			$table_row = NULL;
			$table_row[] = '<span style="white-space: nowrap">' . 
			anchor('inventory/edit/' . $inventory->id, 'edit') . ' | ' .
			anchor('inventory/delete/' . $inventory->id, 'delete',
				"onClick=\" return confirm('Are you sure you want to '
				+ 'delete the record for $inventory->description?')\"") .
				'</span>';
			// replaced above :: $table_row[] = anchor('inventory/edit/' . $inventory->id, 'edit');
			$table_row[] = $inventory->bar_code;
			$table_row[] = $inventory->description;
			$table_row[] = $inventory->list_price;
			$table_row[] = $inventory->qty_on_hand;
			$this->table->add_row($table_row);
		}    
		$inventory_table = $this->table->generate();
		// generate HTML table from query results
		// replaced above :: $students_table = $this->table->generate($students_qry);
		// display information for the view
		$data['title'] = "Inventory Listing";
		$data['headline'] = "Inventory Listing";
		$data['include'] = 'inventory_listing';
		$data['data_table'] = $inventory_table;
		$this->load->view('inventory_template', $data);
	}
  
	function edit() {
		$this->load->helper('form');
		$id = $this->uri->segment(3);
		echo $id;
		$this->load->model('MInventory','',TRUE);
		$data['row'] = $this->MInventory->getInventory($id)->result();
		// display information for the view
		$data['title'] = "Edit Inventory";
		$data['headline'] = "Edit Inventory Information";
		$data['include'] = 'inventory_edit';
		$this->load->view('inventory_template', $data);
	}

	function update() {
		$this->load->model('MInventory','',TRUE);
		$this->MInventory->updateInventory($_POST['id'], $_POST);
		redirect('inventory/listing','refresh');
	}

	function delete() {
		$id = $this->uri->segment(3);
		$this->load->model('MInventory','',TRUE);
    $this->MInventory->deleteInventory($id);
    redirect('inventory/listing','refresh');
  }

}
/* End of file inventory.php */
/* Location: ./system/application/controllers/inventory.php */
