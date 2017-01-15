<?php
include "include.php";
?>
<html>
	<center>
		<h1>Change e-mail</h1>
		<form action="changeemail_backplane.php" method="POST">
			<h3>Current E-mail</h3>
			<input type="text" name="currmail">
			<h3>New E-mail</h3>
			<input type="text" name="newmail"><br><br>
			<input type="submit" name="submit" value="Change">
		</form>
	</center>
 </html>