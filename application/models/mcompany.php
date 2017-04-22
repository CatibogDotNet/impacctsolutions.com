<?php 

class MCompany extends CI_Model{
	
	public function __construct() {
		$this->load->database();
		if (!$this->db->table_exists('company')) {
			$this->load->dbforge();
			// table does not exist ... create table
			$fields = array('id' => array( 'type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE ),
							'company_name' => array( 'type' => 'VARCHAR', 'constraint' => '50', ),
							'fk_address_id' => array( 'type' =>'INT', 'constraint' => '11', ),
							'fk_phone_id' => array( 'type' =>'INT', 'constraint' => '11', ),
							'CRA_business_no' => array( 'type' => 'VARCHAR', 'constraint' => '15', ),
							'fiscal_year_end_date' => array( 'type' =>'DATE', ),
							'last_edit_date' => array( 'type' =>'DATE', ),
							'fk_employee_id' => array( 'type' =>'INT', 'constraint' => '11', ),
			);
			$this->dbforge->add_field($fields);
			$this->dbforge->add_key('id', TRUE);
			$this->dbforge->create_table('company');
					
		}
	}
  
	// Create company record in database
	function addCompany($data) {
		$this->db->insert('company', $data);
	}

	// Retrieve all company records
	function listCompany() {
		//SELECT * FROM company
		return $this->db->get('company');
	}
  
  // Retrieve one company record
  function getCompanyById($id)
  {
    return $this->db->get_where('company', array('id'=> $id));
  }
  
	function getCompanyByName($company_name){
		$where_array = array(
            'company_name' => $company_name
              );
		$table_name = "company";
		$limit = 1;
		//$offset = 0;
		$query = $this->db->get_where($table_name,$where_array,$limit);
		//var_dump ($query);
		return $query;
	}
  
  // Update one company record
  function updateCompany($id, $data)
  {
    $this->db->where('id', $id);
    $this->db->update('company', $data); 
  }
  
  // Delete one user record
  function deleteCompany($id) {
	$this->db->where('id', $id);
	$this->db->delete('company'); 
  }
  
}

/* End of file mcompany.php */
/* Location: ./system/application/models/mcompany.php */