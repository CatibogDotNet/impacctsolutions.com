<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">

<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />

<title><?php echo $title;?></title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() . "styles/impacct.css";?>">
	
</head>

<body>
	<div id="header">
		<div id="banner_area">
			<img id="img" src="<?php
				echo base_url().'images/logoa.png">';
			?>
			<h1>IMPACCT Solutions</h1>
			<h2>Please read the DISCLAIMER.</h2>
		</div>
	</div>
	<div id= "main">
		<div id="navigation" class="navigation">
			<?php 
			// nav bar
			echo anchor('main/index', 'Home');
			echo ('<br />');
			echo anchor('glaccounts/index', 'GL Accounts Home');
			//<a href="<?=site_url('student/index');>">Home</a>
			echo ('<br />');
			echo anchor('glaccounts/add', 'Add a New GL Account');
			echo ('<br />');
			echo anchor('glaccounts/listing', 'List All GL Accounts');
			?>
		</div>
		<div id="page_area">
			<h1><?php echo $headline;?></h1>
			<?php $this->load->view($include);?>
		</div>
	</div>	
</body>
</html>