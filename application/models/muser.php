<?php 
	class MUser extends CI_Model{
		public function __construct() {
			$this->load->database(); 
			if (!$this->db->table_exists('users')) {
			$this->load->dbforge();
			// table does not exist ... create table
			$fields = array('id' => array( 'type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE ),
							'user_name' => array( 'type' => 'VARCHAR', 'constraint' => '60', 'unique' => TRUE, ),
							'hashed_password' => array( 'type' =>'VARCHAR', 'constraint' => '60', ),
							'company_id' => array( 'type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'null' => TRUE, ),
							'new_user' => array( 'type' => 'TINYINT', 'constraint' => 1, 'null' => TRUE, ),
			);
			$this->dbforge->add_field($fields);
			$this->dbforge->add_key('id', TRUE);
			$this->dbforge->create_table('users');
					
		}
		}
		// Create user record in database
		function adduser($data) {
			$this->db->insert('users', $data);
		}

		// Retrieve all user records
		function listuser() {
			//SELECT * FROM user
			return $this->db->get('users');
		}
  
		// Retrieve one user record
		function getuserById($id) {
			return $this->db->get_where('users', array('id'=> $id));
		}
  
		function getuserByNP($user_name,$hashed_password){
			$where_array = array(
				'user_name' => $user_name,
				'hashed_password' => $hashed_password
				);
			$table_name = "users";
			$limit = 1;
			//$offset = 0;
			$query = $this->db->get_where($table_name,$where_array,$limit);
			return $query;
		}
	
		function getuserByName($user_name){
			$where_array = array(
				'user_name' => $user_name
            );
			$table_name = "users";
			$limit = 1;
			//$offset = 0;
			$query = $this->db->get_where($table_name,$where_array,$limit);
			//var_dump ($query);
			return $query;
		}
  
		// Update one user record
		function updateuser($id, $data) {
			$this->db->where('id', $id);
			$this->db->update('users', $data); 
		}
  
		// Delete one user record
		function deleteuser($id) {
			$this->db->where('id', $id);
			$this->db->delete('users'); 
		}
  
	}

/* End of file muser.php */
/* Location: ./system/application/models/muser.php */