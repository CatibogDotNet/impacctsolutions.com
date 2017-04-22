<?php 
	class MEmployee extends CI_Model{
		public function __construct() {
			$this->load->database(); 
			if (!$this->db->table_exists('employee')) {
			$this->load->dbforge();
			// table does not exist ... create table
			$fields = array('id' => array( 'type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE ),
							'SIN' => array( 'type' => 'VARCHAR', 'constraint' => '9', 'unique' => TRUE, ),
							'last_name' => array( 'type' => 'VARCHAR', 'constraint' => '20', ),
							'first_name' => array( 'type' => 'VARCHAR', 'constraint' => '20', ),
							'middle_name' => array( 'type' => 'VARCHAR', 'constraint' => '20', ),
							'user_type' => array( 'type' => 'VARCHAR', 'constraint' => '5', ),
							'fk_rate_id' => array( 'type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, ),
							'fk_addr_id' => array( 'type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, ),
							'fk_dept_id' => array( 'type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, ),
							'fk_supervisor_id' => array( 'type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, ),
							'fk_job_id' => array( 'type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, ),
							'TD1code' => array( 'type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, ),
							'last_edit_date' => array( 'type' => 'DATE', ),
							'fk_edit_by' => array( 'type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, ),
			);
			$this->dbforge->add_field($fields);
			$this->dbforge->add_key('id', TRUE);
			$this->dbforge->create_table('employee');
		}
		}
		// Create employee record in database
		function addemployee($data) {
			$this->db->insert('employee', $data);
		}

		// Retrieve all employee records
		function listemployee() {
			//SELECT * FROM employee
			return $this->db->get('employee');
		}
  
		// Retrieve one employee record
		function getemployeeById($id) {
			return $this->db->get_where('employee', array('id'=> $id));
		}
  
		function getemployeeByNP($employee_name,$hashed_password){
			$where_array = array(
				'employee_name' => $employee_name,
				'hashed_password' => $hashed_password
				);
			$table_name = "employee";
			$limit = 1;
			//$offset = 0;
			$query = $this->db->get_where($table_name,$where_array,$limit);
			return $query;
		}
	
		function getemployeeByName($employee_name){
			$where_array = array(
				'employee_name' => $employee_name
            );
			$table_name = "employee";
			$limit = 1;
			//$offset = 0;
			$query = $this->db->get_where($table_name,$where_array,$limit);
			//var_dump ($query);
			return $query;
		}
  
		// Update one employee record
		function updateemployee($id, $data) {
			$this->db->where('id', $id);
			$this->db->update('employee', $data); 
		}
  
		// Delete one employee record
		function deleteemployee($id) {
			$this->db->where('id', $id);
			$this->db->delete('employee'); 
		}
  
	}

/* End of file memployee.php */
/* Location: ./system/application/models/memployee.php */