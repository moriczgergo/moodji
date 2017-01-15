<?php
include "include.php";
include "mysql.php";

if (isset($_POST["currpass"]) && isset($_POST["newpass"]) && isset($_POST["newpassver"]))
{
	if (strlen(trim($_POST["currpass"])) > 0 && strlen(trim($_POST["newpass"])) > 0 && strlen(trim($_POST["newpassver"])) > 0)
	{
		$currpass = $_POST["currpass"];
		$newpass = $_POST["newpass"];
		$newpassver = $_POST["newpassver"];

		$currpass = password_hash($currpass, PASSWORD_DEFAULT);
		$newpass = password_hash($newpass, PASSWORD_DEFAULT);
		$newpassver = password_hash($newpassver, PASSWORD_DEFAULT);

		if ($newpass == $newpassver){
			printError("wrongver");
			die();
		}

		$conn = new mysqli($sqlserv, $sqluser, $sqlpass, $sqldata);

		if ($conn->connect_error) {
			printError("connerr", $conn->connect_error);
    		die();
		}

		session_start(); //TO-DO: CHECK IF $_SESSION["username"] && $_SESSION["uid"] exists
		$stmt = $conn->prepare("SELECT `password` FROM `users` WHERE `username` = ?");
		$stmt->bind_param("s", $_SESSION["username"]);
		$result = $stmt->execute();

		if ($result === FALSE){
			printError("unknown");
			die();
		}

		$stmt->bind_result($selectpass);
		$stmt->store_result();

		if($stmt->num_rows == 1){
			$stmt->fetch();
			if (password_verify($currpass, $selectpass)){
				$stmt = $conn->prepare("UPDATE `users` SET `password` = ? WHERE `username` = ?");
				$stmt->bind_param("ss", $newpass, $_SESSION["username"]);
				$result = $stmt->execute();

				if ($result === TRUE){
					printSuccess();
				} else {
					printError("unknown");
				}
			} else {
				printError("wrongpass");
			}
		} else {
			//absolute mindfuck
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
	} elseif ($error == "unametaken"){
		echo "<center><h1>Username " . $ext . " already taken.</h1></center>";
	} elseif ($error == "lastfail"){
		echo "<center><h1>Something went wrong:</h1><h3>" . $ext . "</h3></center>";
	} elseif ($error == "unknown"){
		echo "<center><h1>Something went wrong.</h1></center>";
	} elseif ($error == "wrongver"){
		echo "<center><h1>The new passwords doesnt match.</h1></center>";
	} elseif ($error == "wrongpass") {
		echo "<center><h1>Invalid password.</h1></center>";
	}
}

function printSuccess(){
	echo "<center><h1>Success!</h1><p><a href=\"index.php\">Return to home</a></p></center>";
}
?>