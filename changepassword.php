<?php
include "include.php";
?>
<html>
	<center>
		<h1>Change password</h1>
		<form action="changepassword_backplane.php" method="POST">
			<h3>Current Password</h3>
			<input type="password" name="currpass">
			<h3>New Password</h3>
			<input type="password" name="newpass">
			<h3>New Password Verify</h3>
			<input type="password" name="newpassver"><br><br>
			<input type="submit" name="submit" value="Change">
		</form>
	</center>
 </html>