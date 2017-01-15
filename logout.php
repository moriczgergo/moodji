<?php
include "include.php";

session_start();

$_SESSION = array(); //unset all session variables

session_destroy(); //destroy session

echo "<center><h1>You have been logged out.</h1><p><a href=\"index.php\">Return to home</a></p></center>";
?>