<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<title>Contact Form</title>
<link rel="stylesheet" type="text/css" href="styles/impacct.css">
<script src="script/rotateLogo.js"></script>
</head>
<body>
	<noscript>
		For full functionality of this site it is necessary to enable JavaScript.
		Here are the <a href="http://www.enable-javascript.com/" target="_blank">
		instructions how to enable JavaScript in your web browser</a>.
	</noscript>
	<div id="header">
		<div id="logo">
			<img width="100", height="100", id="img" src="images/logoa.png">
		</div>
		<div id="menublock">
			<div id="menu" >
				<ul>
					<li><a href="index.html">Home</a></li>
					<li><a href="aboutus.html">About Us</a></li>
					<li><a href="contactus.html">Contact Us</a></li>
					
				</ul>
			</div>
			<div id="title">Contact Form Processor</div>
		</div>
		
	<div class="clear"></div>
	<hr /> 
	
<?php 
	$okay = false;
	if ($_POST["submit"]) {
		echo "<p style='font-size:20px; font-type:Arial'>These are the data you entered: </p>";
		if ($_POST["firstname"]) {
			echo "<p style='font-size:20px; font-type:Arial'>Your first name is ".$_POST["firstname"]."</p>";
			if ($_POST["lastname"]) {
				echo "<p style='font-size:20px; font-type:Arial'>Your last name is ".$_POST["lastname"]."</p>";
				if ($_POST["email"]) {
					echo "<p style='font-size:20px; font-type:Arial'>Your email is ".$_POST["email"]."</p>";
					$okay=true;
				} else {
					echo "<p style='font-size:20px; font-type:Arial'>Please enter a valid email address</p>";}
					
			} else {
				echo "<p style='font-size:20px; font-type:Arial'>You must enter your last name</p>";}
				
		} else {
			echo "<p style='font-size:20px; font-type:Arial'>You must enter your first name</p>";
			}
	}
	if ($okay==true){
		$emailTo="wilfredo.catibog@gmail.com";
		$subject=$_POST["email"]." ".$_POST["firstname"]." ".$_POST["lastname"];
		$body=$_POST["comments"];
		$headers="From: ".$_POST["email"];
		if (mail($emailTo, $subject, $body, $headers)) {
			echo "<p style='font-size:20px; font-type:Arial'>Thank you.  Your email was sent successfully!</p>";
		} else {
			echo "<p style='font-size:20px; font-type:Arial'>Mail was not sent!</p>";
		}
	} else {
			echo "<p style='font-size:20px; font-type:Arial'>Please re-enter your message!</p>";
		}
?>
	
<script>startTimer()</script>
</body>
</html>