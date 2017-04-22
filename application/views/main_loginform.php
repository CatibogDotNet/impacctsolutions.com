<?php echo validation_errors(); ?>

<?php echo form_open('main/login'); ?>
<?php
	if (isset($_POST['username'])) {
		$uvalue = $_POST['username'];
	} else {
		$uvalue = '';
	}
	if (isset($_POST['password'])) {
		$pvalue = $_POST['password'];
	} else {
		$pvalue = '';
	}
?>
<h3>Username</h3>
<input type="text" name="username" value="<?php 
	echo $uvalue; ?>" size="60" />

<h3>Password</h3>
<input type="password" name="password" value="<?php 
	echo $pvalue; ?>" size="60" />

<div><input type="submit" value="Submit" /></div>



