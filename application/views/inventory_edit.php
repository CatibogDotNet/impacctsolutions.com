<?php 

echo form_open('inventory/update');

echo form_hidden('id', $row[0]->id);

// an array of the fields in the Inventory table
$field_array = array('bar_code','description','list_price','qty_on_hand');
foreach($field_array as $field_name)
{
  echo '<p>' . $field_name;
  echo form_input($field_name, $row[0]->$field_name) . '</p>';
}

// not setting the value attribute omits the submit from the $_POST array
echo form_submit('', 'Update'); 

echo form_close();

?>