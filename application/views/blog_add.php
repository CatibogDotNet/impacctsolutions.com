<?php 
	echo form_open('blog/create'); 
	echo '<p>' . 'Title';
	echo form_input('title', '') . '</p>';
	echo '<p>' . 'Position';
	echo form_input('position', '') . '</p>';
	
	echo '<p>' . 'Body';
	echo form_textarea('body', '') . '</p>';
	
	//not setting the value attribute omits the submit from the $_POST array
	echo form_submit('', 'Create'); 
	echo form_close();
	
	?>



