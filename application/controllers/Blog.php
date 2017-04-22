<?php 
	class Blog extends CI_Controller {
		public function __construct() {
			parent::__construct();
			// load session library
			$this->load->library('session');
			// load helpers
			$this->load->helper('url');
		}
	  
		function index() {
			if(!isset($_SESSION['user_id'])) {
				$this->logout();
			}
			
			// display information for the view
			$data['blog_title'] = "IMPACCT Solutions";
			$data['blog_message'] = "Please read the disclaimer";
			$data['header_title'] = "IMPACCT Solutions index";
			$data['headline'] = "Welcome to IMPACCT Solutions";
			$data['include'] = 'blog_index';
			
			$this->load->view('header', $data);
			$this->load->view('blog_template', $data);
		}

			
		function listing() {
			if(!isset($_SESSION['user_id'])) {
				$this->logout();
			}
			
			//Load \system\libraries\Table.php	
			$this->load->library('table');
    
			//Load mblog.php and call listAdmin() function
			$this->load->model('MBlog','',TRUE);
			$blog_qry = $this->MBlog->getAllBlogs();

			// generate HTML table from query results
			$tmpl = array (
				'table_open' => '<table border="0" cellpadding="3" cellspacing="0">',
				'heading_row_start' => '<tr bgcolor="#66cc44">',
				'row_start' => '<tr bgcolor="#dddddd">' 
			);
			$this->table->set_template($tmpl); 
			$this->table->set_empty("&nbsp;"); 
			$this->table->set_heading('', 'Blog Title', 'Position', 'Picture');
			$table_row = array();
			foreach ($blog_qry->result() as $blog) {
				$table_row = NULL;
				$table_row[] = '<nobr>' . 
				anchor('blog/edit/' . $blog->id, 'edit') . ' | ' .
				anchor('blog/delete/' . $blog->id, 'delete',
					"onClick=\" return confirm('Are you sure you want to '
					+ 'delete the record for $blog->title?')\"") .
					'</nobr>';
				// replaced above :: $table_row[] = anchor('blog/edit/' . $blog->id, 'edit');
				$table_row[] = $blog->title;
				$table_row[] = $blog->position;
				$table_row[] = $blog->picture_file_name;
				$this->table->add_row($table_row);
			}    

			$blog_table = $this->table->generate();
    
			// generate HTML table from query results
			    
			// display information for the view
			$data['blog_title'] = "IMPACCT: Blogs Listing";
			$data['blog_message'] = "Testing...";
			$data['header_title'] = "IMPACCT Solutions";
			$data['headline'] = "Blog Listing";
			$data['include'] = 'blog_listing';

			$data['data_table'] = $blog_table;
			$this->load->view('header', $data);
			$this->load->view('blog_template', $data);
		}
	
		function add() {
			if(!isset($_SESSION['user_id'])) {
				$this->logout();
			}
			
			$this->load->helper('form');
    
			// display information for the view
			$data['blog_title'] = "IMPACCT: Add Blog";
			$data['blog_message'] = "Blog message";
			$data['header_title'] = "IMPACCT Solutions";
			$data['headline'] = "Add a New Blog";
			$data['include'] = 'blog_add';
		
			$this->load->view('header', $data);
			$this->load->view('blog_template', $data);
		}
	
		function select() {
			if(!isset($_SESSION['user_id'])) {
				$this->logout();
			}
			
			$this->load->helper('form');
			$id = $this->uri->segment(3);
			echo $id;
			//to do stuff
			
		}

		function edit() {
			if(!isset($_SESSION['user_id'])) {
				$this->logout();
			}
			
			$this->load->helper('form');
			$id = $this->uri->segment(3);
			//echo $id;
			$this->load->model('MBlog','',TRUE);
			$data['row'] = $this->MBlog->getBlogById($id)->result();
			// display information for the view
			$data['blog_title'] = "Blog: Edit Blog";
			$data['blog_message'] = "Blog message";
			$data['header_title'] = "IMPACCT Solutions";
			$data['headline'] = "Edit Blog Information";
			$data['include'] = 'blog_edit';
		
			$this->load->view('header', $data);
			$this->load->view('blog_template', $data);
		}
		
		function update() {
			if(!isset($_SESSION['user_id'])) {
				$this->logout();
			}
			
			$this->load->model('MBlog','',TRUE);
			$this->MBlog->updateBlog($_POST['id'], $_POST);
			redirect('blog/listing','refresh');
		}
	
		function create() {
			if(!isset($_SESSION['user_id'])) {
				$this->logout();
			}
			
			$this->load->helper('url');
			$this->load->model('MBlog','',TRUE);
			$blog_data['title']= $_POST['title'];
			$blog_data['body']= $_POST['body'];
			$this->MBlog->addBlog($blog_data);
			redirect('blog/listing','refresh');
		}
	
		function delete() {
			if(!isset($_SESSION['user_id'])) {
				$this->logout();
			}
			
			$id = $this->uri->segment(3);
    
			$this->load->model('MBlog','',TRUE);
			$this->MBlog->deleteBlog($id);
			redirect('blog/listing','refresh');
		}
	
		function get_blog() {
			if(!isset($_SESSION['user_id'])) {
				$this->logout();
			}
			
			$this->load->model('mblog');
			$result = $this->mblog->getBlogByName($_POST['blog_name']);
			$row = $result->row();
			//echo $row->hashed_password;
			if ($this->password_check($_POST['password'],$row->hashed_password)){
				//echo "blog found";
				$_SESSION['blog_id'] = $row->id;
				$_SESSION['blog_name']=$row->blog_name;
				//echo $row->id;
				redirect('accounting/index','refresh');
			} else {
				echo "blog not found";
			}
		}
	
		function logout() {
			$_SESSION['user_id'] = null;
			$_SESSION['user_name'] = null;
			redirect('main/index','refresh');
		}
	}
/* End of file blog.php */
/* Location: ./system/application/controllers/blog.php */
?>
