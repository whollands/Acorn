<?php defined("ACORN_EXECUTE") or die("Access Denied.");

$DateID = CleanID($PathInfo['call_parts'][3]);

$Query = "SELECT DateID FROM Dates WHERE DateID='$DateID'";
$Result = $GLOBALS["MYSQL_CON"]->query($Query);
		
if($Result->num_rows == 1)
{
	$GLOBALS["MYSQL_CON"]->query("DELETE FROM Dates WHERE DateID='$DateID'")or die("MySQL Command Error: Query 1");

	$GLOBALS["MYSQL_CON"]->query("DELETE FROM Appointments WHERE DateID='$DateID'")or die("MySQL Command Error: Query 2");

   	header("Location: " . constant("BASE_URL") . "dashboard/calendar");
   	exit;
}
else
{
	echo "This date does not exist.";
}