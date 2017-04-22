<?php 
	echo ('<br />');
	echo "Welcome to the Sales Module, " . ucfirst($_SESSION['user_name']); 
	echo ('<br />');
	echo ('<br />');
	echo "Please select one of the following:"; 
	echo ('<br />');
	echo ('<br />');
	echo anchor('sales/listingPos', 'Point of Sale Listing');
	//<a href="<?=site_url('main/index');>">Home</a>
	echo ('<br />');
	echo anchor('sales/invoice', 'Create an Invoice');
	echo ('<br />');
	echo anchor('sales/inquiry', 'Sales Inquiry');
	echo ('<br />');
	echo anchor('sales/pricing', 'Sales Pricing Control');
	echo ('<br />');
	echo anchor('sales/contracts', 'Sales Contracts');
	echo ('<br />');
	echo anchor('sales/orders', 'Sales Orders');
	echo ('<br />');
	echo anchor('sales/reports', 'Reports');
	echo ('<br />');
	echo ('<br />');
	echo ('<br />');
?>
