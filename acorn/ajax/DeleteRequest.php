<?php

session_start();

define("ACORN_EXECUTE", true);
// Acorn is being executed

include("includes/config.php");
// include master config file
// which includes functions.php

Check_Auth_User();
// check user is logged in.

$Action = $_GET["action"];
$ID = preg_replace("/[^0-9]/", "fail", $_GET["id"]);

// deal with some keys here...

switch($Action)
{
default: die("Invalid action."); break;

case "Delete_Date":

	$Query = "DELETE FROM Dates WHERE DateID='$ID'";
	$Result = $GLOBALS["MYSQL_CON"]->query($Query);
	
break;
// end delete query


case "Delete_Client":

	$Query = "DELETE FROM Clients WHERE ClientID='$ID'";
	$Result = $GLOBALS["MYSQL_CON"]->query($Query);
	
break;
// end delete query

case "Delete_Service":

	$Query = "DELETE FROM Services WHERE ServiceID='$ID'";
	$Result = $GLOBALS["MYSQL_CON"]->query($Query);
	
break;
// end delete query

case "Delete_User":

	$Query = "DELETE FROM Users WHERE UserID='$ID'";
	$Result = $GLOBALS["MYSQL_CON"]->query($Query);
	
break;
// end delete query

}

if($Result == true)
	{ die("true"); }
	else 
	{ die("false"); }