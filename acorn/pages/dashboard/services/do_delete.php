<?php defined("ACORN_EXECUTE") or die("Access Denied.");

$ServiceID = CleanID($PathInfo['call_parts'][3]);

$Query = "SELECT ServiceID FROM Services WHERE ServiceID='$ServiceID'";
$Result = $GLOBALS["MYSQL_CON"]->query($Query);
		
if($Result->num_rows == 1)
{
	$GLOBALS["MYSQL_CON"]->query("DELETE FROM Services WHERE ServiceID='$ServiceID'")or die("MySQL Command Error: Query 1");
	
	$GLOBALS["MYSQL_CON"]->query("DELETE FROM Appointments WHERE ServiceID='$ServiceID'")or die("MySQL Command Error: Query 2");

   	header("Location: " . constant("BASE_URL") . "dashboard/services");
   	exit;
}
else
{
	echo "This service does not exist.";
}