<?php 

class MCustomer extends CI_Model{
	
	public function __construct() {
		$this->load->database();
		if (!$this->db->table_exists('customer')) {
			$this->load->dbforge();
			// table does not exist ... create table
			$fields = array('id' => array( 'type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE ),
							'customer_name' => array( 'type' => 'VARCHAR', 'constraint' => '50', ),
							'fk_address_id' => array( 'type' =>'INT', 'constraint' => '11', ),
							'fk_phone_id' => array( 'type' =>'INT', 'constraint' => '11', ),
							'CRA_business_no' => array( 'type' => 'VARCHAR', 'constraint' => '15', ),
							'fiscal_year_end_date' => array( 'type' =>'DATE', ),
							'last_edit_date' => array( 'type' =>'DATE', ),
							'fk_employee_id' => array( 'type' =>'INT', 'constraint' => '11', ),
			);
			$this->dbforge->add_field($fields);
			$this->dbforge->add_key('id', TRUE);
			$this->dbforge->create_table('customer');
					
		}
	}
  
	// Create customer record in database
	function addCustomer($data) {
		$this->db->insert('customer', $data);
	}

	// Retrieve all customer records
	function listCustomer() {
		//SELECT * FROM customer
		return $this->db->get('customer');
	}
  
  // Retrieve one customer record
  function getCustomerById($id)
  {
    return $this->db->get_where('customer', array('id'=> $id));
  }
  
	function getCustomerByName($customer_name){
		$where_array = array(
            'customer_name' => $customer_name
              );
		$table_name = "customer";
		$limit = 1;
		//$offset = 0;
		$query = $this->db->get_where($table_name,$where_array,$limit);
		//var_dump ($query);
		return $query;
	}
  
  // Update one customer record
  function updateCustomer($id, $data)
  {
    $this->db->where('id', $id);
    $this->db->update('customer', $data); 
  }
  
  // Delete one user record
  function deleteCustomer($id) {
	$this->db->where('id', $id);
	$this->db->delete('customer'); 
  }
  
}

/* End of file mcustomer.php */
/* Location: ./system/application/models/mcustomer.php */