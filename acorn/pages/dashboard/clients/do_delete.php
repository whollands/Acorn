<?php defined("ACORN_EXECUTE") or die("Access Denied.");

$ClientID = CleanID($PathInfo['call_parts'][3]);

$Query = "SELECT ClientID FROM Clients WHERE ClientID='$ClientID'";
$Result = $GLOBALS["MYSQL_CON"]->query($Query);
		
if($Result->num_rows == 1)
{
	$GLOBALS["MYSQL_CON"]->query("DELETE FROM Clients WHERE ClientID='$ClientID'")or die("MySQL Command Error: Query 1");

	$GLOBALS["MYSQL_CON"]->query("DELETE FROM Appointments WHERE ClientID='$ClientID'")or die("MySQL Command Error: Query 2");

   	header("Location: " . constant("BASE_URL") . "dashboard/clients");
   	exit;
}
else
{
	echo "This client does not exist.";
}