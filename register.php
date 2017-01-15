<?php
include "include.php";
?>
<html>
	<body>
		<center>
			<h1>Registration</h1>
			<form action="register_backplane.php" method="POST">
				<h3>Username</h3>
				<input type="text" name="user">
				<h3>Password</h3>
				<input type="password" name="pass">
				<h3>E-Mail</h3>
				<input type="text" name="mail"><br><br>
				<input type="submit" name="submit" value="Register">
			</form>
		</center>
	</body>
</html>