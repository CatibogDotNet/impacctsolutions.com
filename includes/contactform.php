<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<title>Contact Us</title>
<link rel="stylesheet" type="text/css" href="../styles/impacct.css">
<script src="../script/rotateLogo.js"></script>
</head>
<body>
	<a name="top" />
	<noscript>
		For full functionality of this site it is necessary to enable JavaScript.
		Here are the <a href="http://www.enable-javascript.com/" target="_blank">
		instructions how to enable JavaScript in your web browser</a>.
	</noscript>
	<div class="header">
		<div class="floatleft" style='width:100px; height:100px' >
			<img width="100", height="100", id="img" src="images/logoa.png">
		</div>
		<div class="floatleft" style='height:100px; width:1000px'>
			<div class="floatleft" id="menu" >
				<ul style='style-list-type:none; font-size:16px'>
					<li><a href="index.html">Home</a></li>
					<li><a href="aboutus.html">About Us</a></li>
					<li><a href="contactus.html">Contact Us</a></li>
					
				</ul>
			</div>
		</div>
		
	<div class="clear"></div>
	<hr /> 
<?php 
	if ($_POST["submit"]) {
		if ($_POST["firstname"]) {
			echo "Your first name is ".$_POST["firstname"];
		}
		if ($_POST["lastname"]) {
			echo "Your last name is ".$_POST["lastname"];
		}
		
	}
	$emailTo="wilfredo.catibog@gmail.com";
	$subject="Sent by: ".$_POST["email"];
	$body=$_POST["comments"];
	$headers="From: impacctsolutions.com";
	if (mail($emailTo, $subject, $body, $headers)) {
		echo "Thank you.  Your email was sent successfully!";
	} else {
		echo "Mail was not sent!";
	}
?>
<script>startTimer()</script>
</body>
</html>