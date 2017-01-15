<?php
include "include.php";
include "mysql.php";

function unichr($i){
	return iconv('UCS-4LE', 'UTF-8', pack('V', $i));
}

if (isset($_POST["mood"]))
{
	if (strlen(trim($_POST["mood"])) > 0)
	{
		if (preg_match('/[' . unichr(0x1F300) . '-' . unichr(0x1F5FF) . unichr(0xE000) . '-' . unichr(0xF8FF) . ']/u', $_POST["mood"])) {
			$mood = base64_encode($_POST["mood"]);
		} else {
			printError("nonmoji");
			die();
		}

		$conn = new mysqli($sqlserv, $sqluser, $sqlpass, $sqldata);

		if ($conn->connect_error) {
			printError("connerr", $conn->connect_error);
    		die();
		}

		session_start(); //TO-DO: CHECK IF $_SESSION["username"] && $_SESSION["uid"] exists
		$stmt = $conn->prepare("UPDATE `users` SET `email` = ? WHERE `username` = ?");
		$stmt->bind_param("ss", $mood, $_SESSION["username"]);
		$result = $stmt->execute();

		if ($result === TRUE){
			printSuccess();
		} else {
			printError("unknown");
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
	} elseif ($error == "nonmoji"){
		echo "<center><h1>You did not enter a valid emoji.</h1></center>";
	}
}

function printSuccess(){
	echo "<center><h1>Success!</h1><p><a href=\"dashboard.php\">Return to dashboard</a></p></center>";
}
?>