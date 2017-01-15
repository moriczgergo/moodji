<?php
include "include.php";
include "mysql.php";

if (isset($_POST["user"]) && isset($_POST["pass"]))
{
	if (strlen(trim($_POST["user"])) > 0 && strlen(trim($_POST["pass"])) > 0)
	{
		$user = $_POST["user"];
		$pass = $_POST["pass"];

		$conn = new mysqli($sqlserv, $sqluser, $sqlpass, $sqldata);

		if ($conn->connect_error) {
			printError("connerr", $conn->connect_error);
    		die();
		}

		$stmt = $conn->prepare("SELECT `password`, `id` FROM `users` WHERE `username` = ?");
		$stmt->bind_param("s", $user);
		$result = $stmt->execute();

		if ($result === FALSE){
			printError("unknown");
			die();
		}

		$stmt->bind_result($selectpassword, $selectid);
		$stmt->store_result();

		if($stmt->num_rows == 1){
			$stmt->fetch();
			if (password_verify($pass, $selectpassword) === TRUE){
				session_start();
				$_SESSION["username"] = $user;
				$_SESSION["uid"] = $selectid;
				printSuccess();
			} else {
				printError("wrongpass");
			}
		} else {
			printError("accnotfound", $user);
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
	} elseif ($error == "accnotfound"){
		echo "<center><h1>Account not found.</h1></center>";
	} elseif ($error == "wrongpass") {
		echo "<center><h1>Invalid password.</h1></center>";
	}
}

function printSuccess(){
	echo "<center><h1>Success!</h1><p><a href=\"index.php\">Return to home</a></p></center>";
}
?>