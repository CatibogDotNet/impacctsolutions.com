<?php 

class MSales extends CI_Model{
	
	public function __construct() {
		$this->load->database(); 
	}
  
	// Create sales record in database
	function addSales($data) {
		$this->db->insert('sales', $data);
	}

	// Retrieve all sales records
	function listSales() {
		//SELECT * FROM sales
		return $this->db->get('sales');
	}
  
  // Retrieve one sales record
  function getSalesById($id)
  {
    return $this->db->get_where('sales', array('id'=> $id));
  }
  
	function getSalesByName($sales_name){
		$where_array = array(
            'sales_name' => $sales_name
              );
		$table_name = "sales";
		$limit = 1;
		//$offset = 0;
		$query = $this->db->get_where($table_name,$where_array,$limit);
		//var_dump ($query);
		return $query;
	}
  
  // Update one user record
  function updateSales($id, $data)
  {
    $this->db->where('id', $id);
    $this->db->update('sales', $data); 
  }
  
  // Delete one user record
  function deleteSales($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('sales'); 
  }
  
}

/* End of file msales.php */
/* Location: ./system/application/models/msales.php */