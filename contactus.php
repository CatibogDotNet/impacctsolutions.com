<?php include ("includes/header.php"); ?>
<?php include ("includes/menuhome.php"); ?>
<div class="clear"></div>
	<hr /> 
	<div id="title">Contact Us</div><br /><br />
	<hr />
	<div class="floatleft">	
		<p> Please send us a message by submitting your info: </p>
		<form name="contactform" method="post" action="contactform.php" style='font-size:16px'>
			First Name: <br /><input type="text" name="firstname" size="78"/>  <br />             
			Last Name: <br /><input type="text" name="lastname" size="78" /><br />
			email address: <br /><input type="email" name="email" size="78"/><br />
			Comments (max 255 chars): <br /><textarea type="text" name="comments" style='height:150px; width:494px' ></textarea><br />
			<input type="submit" name = "submit" value="Submit" /><br /><br />
		</form>
	</div>
	
	<div class="floatleft">
		<ul>
			<p id="contact">
				<span>Or contact us by other means at:<br></span>
				<span><br>Wilfredo Catibog</span>
				<span><br>IMPACCT Solutions - Business Development</span>
				<span><br>37 Albright Crescent, Richmond Hill, ON L4E 4Z4</span>
				<span><br>Email: wilfredo.catibog@gmail.com</span>
				<span><br>Tel: 289-809-1732</span>
				<span><br>Cell: 416-458-0640<br></span>
				<span><br>We appreciate your business!!!</span>
			</p>
		</ul>
	</div>
	<div>	
		<span style='position:relative; left:0px;top:0px;width:600px;height:450px'>
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2873.8115502313717!2d-79.45410890000002!3d43.92187550000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x882ad5ee0dbf470f%3A0x1223736ccc6ca4a9!2s37+Albright+Crescent%2C+Richmond+Hill%2C+ON+L4E!5e0!3m2!1sen!2sca!4v1414757608524" 
				width="600" height="450" frameborder="0" style="border:0" align="center">
			</iframe>
		</span>
	</div>
<?php include ("includes/footer.php"); ?>