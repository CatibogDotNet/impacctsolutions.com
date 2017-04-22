<body>
	<div id="header">
		<div id="banner_area">
			<img id="img" src="<?php
				echo base_url().'images/logoa.png">';
			?>
			<h1>
				<?php 
					echo $user_title;
				?>
			</h1>
			<h2>
				<?php 
					echo $user_message;
				?>
			</h2>
		</div>
	</div>
	<div id= "main">
		<div id="navigation" class="navigation">
			<?php 
			// nav bar
			echo ('<br />');
			echo ('<br />');
			echo anchor('user/index', 'Home');
			echo ('<br />');
			echo ('<br />');
			echo anchor('user/add', 'Add New User');
			echo ('<br />');
			echo anchor('user/listing', 'List All Users');
			echo ('<br />');
			echo ('<br />');
			echo anchor('admin/add', 'Add New Admin');
			echo ('<br />');
			echo anchor('admin/listing', 'List All Admin');
			echo ('<br />');
			echo ('<br />');
			echo anchor('user/logout', 'Logout');
			echo ('<br />');
			echo ('<br />');
			echo ('<br />');
			echo ('<br />');
			?>
		</div>
		<div id="page_area">
			<h1><?php echo $headline;?></h1>
			<?php $this->load->view($include);?>
		</div>
	</div>
	<?php 
		//$baseUrl = base_url(); 
		//var_dump($baseUrl); 
	?>
	<script src="<?php echo base_url() ?>js/jquery-3.0.0.min.js"></script>
	<script src="<?php echo base_url() ?>js/jquery-ui.min.js"></script>
	<script>var baseURL = "<?php echo base_url(); ?>";</script>
	<script src="<?php echo base_url().'js/impacct.js';?>"></script>
</body>
</html>