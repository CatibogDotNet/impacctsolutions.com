<?php 

class MBlog extends CI_Model{
	
	public function __construct() {
		$this->load->database(); 
		if (!$this->db->table_exists('blog')) {
			$this->load->dbforge();
			// table does not exist ... create table
			$fields = array('id' => array( 'type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, 'auto_increment' => TRUE ),
							'title' => array( 'type' => 'VARCHAR', 'constraint' => '50', 'unique' => TRUE, ),
							'body' => array( 'type' =>'TEXT', ),
							'position' => array( 'type' => 'INT', 'constraint' => 11, 'unsigned' => TRUE, ),
							'picture_file_name' => array( 'type' => 'VARCHAR', 'constraint' => 30, 'null' => TRUE, ),
			);
			$this->dbforge->add_field($fields);
			$this->dbforge->add_key('id', TRUE);
			$this->dbforge->create_table('blog');
		}
	}
  
	// Create POS record in database
	function addBlog($data) {
		$this->db->insert('blog', $data);
	}

	// Retrieve all blog records
	function getAllBlogs() {
		//SELECT * FROM blog ORDER_BY position
		$this->db->from('blog');
		$this->db->order_by("position", "desc");
		$query = $this->db->get(); 
		return $query;
		//->result();
		//return $this->db->get('blog');
	}
  
	function getAllBlogsWithoutBody() {
		//SELECT * FROM blog ORDER_BY position
		$this->db->select('position, desc');
		$this->db->from('blog');
		$this->db->order_by('position, desc');
		$query = $this->db->get(); 
		return $query;
		//->result();
		//return $this->db->get('blog');
	}
  
	function getBlogCount() {
		//count all records  
		return $this->db->count_all('blog');
	}
  
  // Retrieve one blog record
  function getBlogById($id) {
	//SELECT * from blog where id = $id;  
	return $this->db->get_where('blog', array('id' => $id));
	}
  
	function getBlogByTitle($title){
		$where_array = array(
            'blog_title' => $title);
		$table_name = "blog";
		$limit = 1;
		//$offset = 0;
		$query = $this->db->get_where($table_name,$where_array,$limit);
		//var_dump ($query);
		return $query;
	}
  
  // Update one user record
  function updateBlog($id, $data)
  {
    $this->db->where('id', $id);
    $this->db->update('blog', $data); 
  }
  
  // Delete one user record
  function deleteBlog($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('blog'); 
  }
  
}

/* End of file mblog.php */
/* Location: ./system/application/models/mblog.php */