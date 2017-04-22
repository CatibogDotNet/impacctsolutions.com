<?php 

class MAdmin extends CI_Model{
	
	public function __construct() {
		$this->load->database();
		if (!$this->db->table_exists('admin')) {
			$this->load->dbforge();
			// table does not exist ... create table
			$fields = array('id' => array( 'type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE ),
							'admin_name' => array( 'type' => 'VARCHAR', 'constraint' => '60', 'unique' => TRUE, ),
							'hashed_password' => array( 'type' =>'VARCHAR', 'constraint' => '60', ),
							'company_id' => array( 'type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'null' => TRUE, ),
			);
			$this->dbforge->add_field($fields);
			$this->dbforge->add_key('id', TRUE);
			$this->dbforge->create_table('admin');
					
		}
	}
  
	// Create admin record in database
	function addAdmin($data) {
		$this->db->insert('admin', $data);
	}

	// Retrieve all admin records
	function listAdmin() {
		//SELECT * FROM admin
		return $this->db->get('admin');
	}
  
  // Retrieve one admin record
  function getAdminById($id)
  {
    return $this->db->get_where('admin', array('id'=> $id));
  }
  
	function getAdminByNP($admin_name,$hashed_password){
		$where_array = array(
            'admin_name' => $admin_name,
            'hashed_password' => $hashed_password
              );
		$table_name = "admin";
		$limit = 1;
		//$offset = 0;
		$query = $this->db->get_where($table_name,$where_array,$limit);
		
		return $query;
	}
	
	function getAdminByName($admin_name){
		$where_array = array(
            'admin_name' => $admin_name
              );
		$table_name = "admin";
		$limit = 1;
		//$offset = 0;
		$query = $this->db->get_where($table_name,$where_array,$limit);
		//var_dump ($query);
		return $query;
	}
  
  // Update one admin record
  function updateAdmin($id, $data)
  {
    $this->db->where('id', $id);
    $this->db->update('admin', $data); 
  }
  
  // Delete one user record
  function deleteAdmin($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('admin'); 
  }
  
}

/* End of file madmin.php */
/* Location: ./system/application/models/madmin.php */