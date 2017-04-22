<body>
	<div id="header">
		<div id="banner_area">
			<img id="img" src="<?php
				echo base_url().'images/logoa.png">';
			?>
			<h1>
				<?php 
					echo $purchases_title;
				?>
			</h1>
			<h2>
				<?php 
					echo $purchases_message;
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
				echo anchor('inventory/index', 'Inventory');
				//<a href="<?=site_url('main/index');>">Home</a>
				echo ('<br />');
				echo anchor('purchases/receiving', 'Receive a Shipment');
				echo ('<br />');
				echo anchor('purchases/inquiry', 'Purchases Inquiry');
				echo ('<br />');
				echo anchor('purchases/orders', 'Purchase Orders');
				echo ('<br />');
				echo anchor('purchases/reports', 'Reports');
				echo ('<br />');
				echo anchor('accounting/index', 'Accounting Home');
				echo ('<br />');
				echo anchor('purchases/logout', 'Log Out');
				echo ('<br />');
				echo anchor('purchases/disclaimer', 'Disclaimer');
				echo ('<br />');
				echo ('<br />');
			?>
		</div>
		<div id="page_area">
			<h2><?php echo $headline;?></h2>
			<?php $this->load->view($include);?>
		</div>
	</div>
	<?php 
		//$baseUrl = base_url(); 
		//var_dump($baseUrl); 
	?>
	<script src="<?php echo base_url() ?>js/jquery-3.0.0.min.js"></script>
	<script>var baseURL = "<?php echo base_url(); ?>";</script>
	<script src="<?php echo base_url().'js/impacct.js';?>"></script>
</body>
</html>