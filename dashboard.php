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

$mood = hex2bin($selectmood);

function printError($error, $ext = ""){
	if ($error == "fewval"){
		echo "<center><h1>You didn't enter all the required data</h1></center>";
	} elseif ($error == "connerr") {
		echo "<center><h1>Connection to database failed:</h1><h3>" . $ext . "</h3></center>";
	} elseif ($error == "unametaken"){
		echo "<center><h1>Username " . $ext . " already taken.</h1></center>";
	} elseif ($error == "lastfail"){
		echo "<center><h1>Something went wrong:</h1><h3>" . $ext . "</h3></center>";
	} elseif ($error == "unknown"){
		echo "<center><h1>Something went wrong.</h1></center>";
	} elseif ($error == "accnotfound"){
		echo "<center><h1>Account not found.</h1></center>";
	} elseif ($error == "wrongpass") {
		echo "<center><h1>Invalid password.</h1></center>";
	}
}
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