<?php
include "include.php";
include "mysql.php";

if (isset($_POST["user"]) && isset($_POST["pass"]) && isset($_POST["mail"]))
{
	if (strlen(trim($_POST["user"])) > 0 && strlen(trim($_POST["pass"])) > 0 && strlen(trim($_POST["mail"])) > 0)
	{
		$user = $_POST["user"];
		$pass = $_POST["pass"];
		$mail = $_POST["mail"];

		$conn = new mysqli($sqlserv, $sqluser, $sqlpass, $sqldata);

		if ($conn->connect_error) {
			printError("connerr", $conn->connect_error);
    		die();
		}

		$stmt = $conn->prepare("SELECT `username` FROM `users` WHERE `username` = ?");
		$stmt->bind_param("s", $user);
		$result = $stmt->execute();
		echo "<h1>First value: " . var_dump($result) . "</h1>";

		if ($result === FALSE){
			printError("unknown");
			die();
		}

		$stmt->store_result();

		if($stmt->num_rows == 0){
			$pass_hash = password_hash($pass, PASSWORD_DEFAULT);

			$stmt = $conn->prepare("INSERT INTO `users` (`username`, `password`, `email`) VALUES (?, ?, ?)");
			$stmt->bind_param("sss", $user, $pass_hash, $mail);
			$result = $stmt->execute();
			echo "<h1>Second value: " . var_dump($result) . "</h1>";

			if ($result === TRUE){
				printSuccess();
			} else {
				printError("lastfail", $conn->error);
			}
		} else {
			printError("unametaken", $user);
			die();
		}
	} else {
		printError("fewval");
		die();
	}
} else {
	printError("fewval");
	die();
}

function printError($error, $ext = ""){
	if ($error == "fewval"){
		echo "<center><h1>You didn't enter all the required data</h1></center>";
	} elseif ($error == "connerr") {
		echo "<center><h1>Connection to database failed:</h1><h3>" . $ext . "</h3></center>";
	} elseif ($error = "unametaken"){
		echo "<center><h1>Username " . $ext . " already taken.</h1></center>";
	} elseif ($error = "lastfail"){
		echo "<center><h1>Something went wrong:</h1><h3>" . $ext . "</h3></center>";
	} elseif ($error = "unknown"){
		echo "<center><h1>Something went wrong.</h1></center>";
	}
}

function printSuccess(){
	echo "<center><h1>Success!</h1><p><a href=\"login.php\">Click here to login</a></p></center>";
}
?>