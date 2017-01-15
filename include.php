<?php
// THIS FILE IS PART OF THE MOODJI PROJECT
// Created by moriczgergo
// Creation date: 2017.01.14
// Last edited: 2017.01.14
?>
<html>
	<head>
		<!-- Setting charset to UTF-8 !-->
		<meta charset="UTF-8">

		<!-- OPTIONAL: Turn off cache !-->
		<meta http-equiv="cache-control" content="max-age=0" />
		<meta http-equiv="cache-control" content="no-cache" />
		<meta http-equiv="expires" content="0" />
		<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
		<meta http-equiv="pragma" content="no-cache" />

		<!-- Include CSS files !-->
		<link rel="stylesheet" type="text/css" href="css/header.css">
		<link rel="stylesheet" type="text/css" href="css/global.css">

		<!-- Bootstrap 4 CDN !-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

		<!-- Website title (displays on website's tab in browser) !-->
		<title>MOODJI</title>
	</head>
	<body style="background-color: #2F9395;">
		<div id="header">
			<center> <!-- CENTER BEGIN !-->
				<h1>&#x1F601; <img src="img/logo.png"> &#x1F601;</h1> <!-- Title !-->
				<h4>
				<?php
				session_start();
				if (isset($_SESSION["username"]) && isset($_SESSION["uid"])){
				?>
				<a href="dashboard.php">Dashboard</a> - <a href="friends.php">Friends</a> - <a href="logout.php">Logout</a>	
				<?php
				} else {
				?>
				<a href="register.php">Register</a> - <a href="login.php">Login</a>	
				<?php
				}
				?>
				</h4>
			</center> <!-- CENTER END !-->
		</div>
		<hr> <!-- Horizontal line !-->

		<!-- Bootstrap 4 CDN !-->
		<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
	</body>
</html>