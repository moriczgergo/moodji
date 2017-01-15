<?php
include "include.php"
?>
<html>
	<body>
		<center>
			<h1>Registration</h1>
			<form action="login_backplane.php" method="POST">
				<h3>Username</h3>
				<input type="text" name="user">
				<h3>Password</h3>
				<input type="password" name="pass"><br><br>
				<input type="submit" name="submit" value="Login">
			</form>
		</center>
	</body>
</html>