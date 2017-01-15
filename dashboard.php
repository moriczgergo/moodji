<?php
include "include.php";
?>
<html>
	<body>
		<center>
			<h1>Dashboard</h1>
			<br>
			<h2>Set current mood:</h2>
			<form action="mood_backplane.php" method="POST">
				<input type="text" name="mood" maxlength="2" size="2"><br>
				<br>
				<input type="submit" name="submit" value="Set">
			</form>
		</center>
	</body>
</html>