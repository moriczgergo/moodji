<?php
include "include.php";
include "mysql.php";
session_start();

$conn = new mysqli($sqlserv, $sqluser, $sqlpass, $sqldata);

if ($conn->connect_error) {
	printError("connerr", $conn->connect_error);
	die();
}

$stmt = $conn->prepare("SELECT `mood` FROM `users` WHERE `username` = ?");
$stmt->bind_param("s", $_SESSION["username"]);
$result = $stmt->execute();

if ($result === FALSE){
	printError("unknown");
	die();
}

$stmt->bind_result($selectmood);
$stmt->store_result();

if($stmt->num_rows == 1){
	$stmt->fetch();
} else {
	//absolute mindfuck
	die();
}

$mood = base64_decode($selectmood);
?>
<html>
	<body>
		<center>
			<h1>Dashboard</h1>
			<br>
			<h2>Current mood: <?php echo $mood; ?></h2>
			<br>
			<h2>Set current mood:</h2>
			<form action="mood_backplane.php" method="POST">
				<input type="text" name="mood" maxlength="2" size="2" value="<?php echo $mood; ?>"><br>
				<br>
				<input type="submit" name="submit" value="Set">
			</form>
		</center>
	</body>
</html>