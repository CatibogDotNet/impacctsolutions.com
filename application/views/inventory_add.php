<?php 
	echo validation_errors(); 
	echo form_open('inventory/create');

	// an array of the fields in the student table
	$field_array = array('bar_code','description','list_price','qty_on_hand');
	foreach($field_array as $field) {
		echo '<p>' . $field;
		echo form_input(array('name' => $field)) . '</p>';
	}

	// not setting the value attribute omits the submit from the $_POST array
	// this ensures that the submit button does not get included in the database INSERT
	// since the $_POST array will be INSERTed into the database.
	echo form_submit('', 'Add'); 
	echo form_close();
?>