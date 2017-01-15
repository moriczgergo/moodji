<?php
include "include.php";
include "mysql.php";

if (isset($_POST["currmail"]) && isset($_POST["newmail"]))
{
	if (strlen(trim($_POST["currmail"])) > 0 && strlen(trim($_POST["newmail"])) > 0)
	{
		$currmail = $_POST["currmail"];
		$newmail = $_POST["newmail"];

		$conn = new mysqli($sqlserv, $sqluser, $sqlpass, $sqldata);

		if ($conn->connect_error) {
			printError("connerr", $conn->connect_error);
    		die();
		}

		session_start(); //TO-DO: CHECK IF $_SESSION["username"] && $_SESSION["uid"] exists
		$stmt = $conn->prepare("SELECT `email` FROM `users` WHERE `username` = ?");
		$stmt->bind_param("s", $_SESSION["username"]);
		$result = $stmt->execute();

		if ($result === FALSE){
			printError("unknown");
			die();
		}

		$stmt->bind_result($selectmail);
		$stmt->store_result();

		if($stmt->num_rows == 1){
			$stmt->fetch();
			if ($selectmail == $currmail){
				$stmt = $conn->prepare("UPDATE `users` SET `email` = ? WHERE `username` = ?");
				$stmt->bind_param("ss", $newmail, $_SESSION["username"]);
				$result = $stmt->execute();

				if ($result === TRUE){
					printSuccess();
				} else {
					printError("unknown");
				}
			} else {
				printError("wrongmail");
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
	} elseif ($error == "wrongmail"){
		echo "<center><h1>The current email you specified doesn't match with what you entered at registration.</h1></center>";
	}
}

function printSuccess(){
	echo "<center><h1>Success!</h1><p><a href=\"index.php\">Return to home</a></p></center>";
}
?>úű