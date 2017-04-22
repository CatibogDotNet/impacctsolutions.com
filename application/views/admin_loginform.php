<?php echo validation_errors(); ?>

<?php echo form_open('admin/get_admin'); ?>

<h5>Admin name</h5>
<input type="text" name="admin_name" value="" size="60" />

<h5>Password</h5>
<input type="password" name="password" value="" size="60" />
<br /><br />
<div><input type="submit" value="Submit" /></div>



