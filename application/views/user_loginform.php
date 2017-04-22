<?php echo validation_errors(); ?>
<?php echo form_open('user/login'); ?>
<h5>User name</h5>
<input type='text' name='user_name' value='<?php echo $username;?>' size='60' />

<h5>Password</h5>
<input type='password' name='password' value='<?php echo $password;?>' size='60' />
<br /><br />
<div><input type='submit' value='Submit' /></div>
