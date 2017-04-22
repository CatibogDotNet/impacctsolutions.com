<?php 

class MPos extends CI_Model{
	
	public function __construct() {
		$this->load->database();
		if (!$this->db->table_exists('pos')) {
			$this->load->dbforge();
			// table does not exist ... create table
			$fields = array('id' => array( 'type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE ),
							'trans_no' => array( 'type' => 'INT', 'constraint' => '11', 'unsigned' => TRUE, ),
							'fk_inventory_id' => array( 'type' =>'INT', 'constraint' => '11', ),
							'qty_sold' => array( 'type' =>'DOUBLE', ),
							'total_price' => array( 'type' => 'DOUBLE', ),
							'total_tax' => array( 'type' =>'DOUBLE', ),
							'last_edit_date' => array( 'type' =>'DATE', ),
							'fk_employee_id' => array( 'type' =>'INT', 'constraint' => '11', ),
			);
			$this->dbforge->add_field($fields);
			$this->dbforge->add_key('id', TRUE);
			$this->dbforge->create_table('pos');
					
		}
	}
  
	// Create POS record in database
	function addPos($data) {
		$this->db->insert('pos', $data);
	}

	// Retrieve all pos records
	function getAllPos() {
		//SELECT * FROM pos
		return $this->db->get('pos');
	}
    
	function getCountPos() {
		//get count
		return $this->db->count_all('pos');
	}
	
	// Retrieve one pos record by id
	function getPosById($id) {
		return $this->db->get_where('pos', array('id'=> $id));
	}
  
	// Retrieve one pos record by transaction number
	function getPosByTransNo($transNum) {
		return $this->db->get_where('pos', array('trans_no'=> $transNum));
	}
  
	// Update one pos record
	function updatePos($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('pos', $data); 
	}
    
  // Delete one pos record
  function deletePos($id) {
    $this->db->where('id', $id);
    $this->db->delete('pos'); 
  }
  
}

/* End of file mpos.php */
/* Location: ./system/application/models/mpos.php */