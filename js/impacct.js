var images = [], x = -1; 
var interval = 1000;
	images[0] = baseURL + 'images/logoa.png';
	images[1] = baseURL + 'images/logob.png';
	images[2] = baseURL + 'images/logoc.png';
	images[3] = baseURL + 'images/logod.png';
	images[4] = baseURL + 'images/logoe.png';
	images[5] = baseURL + 'images/logof.png';
	images[6] = baseURL + 'images/logog.png';
	images[7] = baseURL + 'images/logog.png';
	images[8] = baseURL + 'images/logog.png';
	images[9] = baseURL + 'images/logog.png';
	images[10] = baseURL + 'images/logog.png';
	images[11] = baseURL + 'images/logog.png';
	
	//console.log(baseURL);
	
/*
document.onclick = function() {
	alert ("You clicked somewhere in the document");
};
*/
var transNum = document.getElementById("transNumber").value;
document.getElementById("frmPos").onsubmit = function() {
	//validate values
	
}



var barCode = document.getElementById("bar_code");
barCode.onfocus = function() {
	if(barCode.value == "bar code") {
		barCode.value = "";
	}
};

barCode.onblur = function() {
	if(barCode.value == "") {
		barCode.value = "bar code";
	} else {
		//process new bar code data
		jQuery.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>" + "index.php/sales/get_barcode_submitted",
			dataType: 'json',
			data: {barcode: bar_code},
			success: function(res) {
				if (res) {
					// Show Entered Value
					jQuery("div#result").show();
					jQuery("div#value").html(res.username);
					jQuery("div#value_pwd").html(res.pwd);
				}
			}
		});
	}
	
};


setInterval(displayNextImage, interval);
function displayNextImage() {
    x = (x === images.length - 1) ? 0 : x + 1;
    document.getElementById("img").src = images[x];
}

$(document).ready(function() {
	displayNextImage();
});

/*
<html>
<head>
<title>CodeIgniter ajax post</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">

// Ajax post
$(document).ready(function() {
$(".submit").click(function(event) {
event.preventDefault();
var user_name = $("input#name").val();
var password = $("input#pwd").val();
jQuery.ajax({
type: "POST",
url: "<?php echo base_url(); ?>" + "index.php/ajax_post_controller/user_data_submit",
dataType: 'json',
data: {name: user_name, pwd: password},
success: function(res) {
if (res)
{
// Show Entered Value
jQuery("div#result").show();
jQuery("div#value").html(res.username);
jQuery("div#value_pwd").html(res.pwd);
}
}
});
});
});
</script>
</head>
<body>
<div class="main">
<div id="content">
<h2 id="form_head">Codelgniter Ajax Post</h2><br/>
<hr>
<div id="form_input">
<?php

// Form Open
echo form_open();

// Name Field
echo form_label('User Name');
$data_name = array(
'name' => 'name',
'class' => 'input_box',
'placeholder' => 'Please Enter Name',
'id' => 'name'
);
echo form_input($data_name);
echo "<br>";
echo "<br>";

// Password Field
echo form_label('Password');
$data_name = array(
'type' => 'password',
'name' => 'pwd',
'class' => 'input_box',
'placeholder' => '',
'id' => 'pwd'
);
echo form_input($data_name);
?>
</div>
<div id="form_button">
<?php echo form_submit('submit', 'Submit', "class='submit'"); ?>
</div>
<?php
// Form Close
echo form_close(); ?>
<?php

// Display Result Using Ajax
echo "<div id='result' style='display: none'>";
echo "<div id='content_result'>";
echo "<h3 id='result_id'>You have submitted these values</h3><br/><hr>";
echo "<div id='result_show'>";
echo "<label class='label_output'>Entered Name :<div id='value'> </div></label>";
echo "<br>";
echo "<br>";
echo "<label class='label_output'>Entered Password :<div id='value_pwd'> </div></label>";
echo "<div>";
echo "</div>";
echo "</div>";
?>
</div>
</div>
</body>
</html>
 */

