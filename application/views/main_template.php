<body>
	<div id="header">
		<div id="banner_area">
			<img id="img" src="<?php
				echo base_url().'images/logoa.png">';
				?>
			<h1>
				<?php 
					echo $main_title;
				?>
			</h1>
			<h2>
				<?php 
					echo $main_message;
				?>
			</h2>
		</div>
	</div>
	<div id= "main">
		<div id="navigation" class="navigation">
			<?php 
			
				// nav bar
				echo '<br />';
				echo ('<br />');
				echo anchor('main/index', 'Home');
				//same as -->  <a href="<?=site_url('main/index');>">Home</a>
				//var_dump($allblogs);
				echo ('<br />');
				foreach($allblogs as $blogitem){
					//var_dump($blogitem->id);
					echo anchor('main/blogs/' . $blogitem->id, $blogitem->title);
					echo '<br >';
				}
				echo ('<br />');
				echo ('<br />');
				echo 'Accounting:';
				echo ('<br />');
				echo anchor('main/user_login', 'User Login');
				echo ('<br />');
				echo anchor('main/admin_login', 'Admin Login');
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