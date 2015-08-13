<?php defined("ACORN_EXECUTE") or die("Access Denied.");

$_SESSION["ACORN_LOGIN"] = false;

session_destroy();

if(isset($_COOKIE["ACORN_SESSION"]))
{
	$Token = $_COOKIE["ACORN_SESSION"];
	$Query = "DELETE FROM UserSessions WHERE Token='$Token'";
	
	if (!mysqli_query($GLOBALS["MYSQL_CON"], $Query)) { SQLError($Query); }
	
	setcookie("ACORN_SESSION", "", time()-3600);
	// remove cookie
}

header("Location: " . constant("BASE_URL") . "login");
exit;