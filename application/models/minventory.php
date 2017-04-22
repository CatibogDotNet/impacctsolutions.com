<?php 

class MInventory extends CI_Model{

  // Create inventory record in database
  function addInventory($data)
  {
    $this->db->insert('inventory', $data);
  }

  // Retrieve all inventory records
	function listInventory() {
		
		//SELECT * FROM inventory
		return $this->db->get('inventory');
	}
  
  // Retrieve one inventory record
  function getInventory($id)
  {
    return $this->db->get_where('inventory', array('id'=> $id));
  }
  
  // Update one inventory record
  function updateInventory($id, $data)
  {
    $this->db->where('id', $id);
    $this->db->update('inventory', $data); 
  }
  
  // Delete one inventory record
  function deleteInventory($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('inventory'); 
  }
  
}

/* End of file minventory.php */
/* Location: ./system/application/models/minventory.php */