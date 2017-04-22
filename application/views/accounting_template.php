<body>
	<div id="header">
		<div id="banner_area">
			<img id="img" src="<?php
				echo base_url().'images/logoa.png">';
			?>
			<h1>
				<?php 
					echo $accounting_title;
				?>
			</h1>
			<h2>
				<?php 
					echo $accounting_message;
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
			echo ('<br />');
			echo anchor('accounting/index', 'Home');
			//<a href="<?=site_url('main/index');>">Home</a>
			echo ('<br />');
			echo ('<br />');
			echo anchor('accounting/gl', 'General Ledger');
			echo ('<br />');
			echo anchor('accounting/ar', 'Accounts Receivable');
			echo ('<br />');
			echo anchor('accounting/ap', 'Accounts Payable');
			echo ('<br />');
			echo anchor('accounting/payroll', 'Payroll');
			echo ('<br />');
			echo anchor('inventory/index', 'Inventory');
			echo ('<br />');
			echo anchor('sales/index', 'Sales');
			echo ('<br />');
			echo anchor('purchases/index', 'Purchases');
			echo ('<br />');
			
			echo anchor('accounting/reports', 'Reports');
			echo ('<br />');
			echo ('<br />');
			echo anchor('accounting/logout', 'Log Out');
			echo ('<br />');
			echo ('<br />');
			echo anchor('accounting/disclaimer', 'Disclaimer');
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
	<script>var baseURL = "<?php echo base_url(); ?>";</script>
	<script src="<?php echo base_url().'js/impacct.js';?>"></script>
</body>
</html>