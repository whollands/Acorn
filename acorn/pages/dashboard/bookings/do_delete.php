<?php defined("ACORN_EXECUTE") or die("Access Denied.");

$ApptID = CleanID($PathInfo['call_parts'][3]);

$Query = "SELECT ApptID FROM Appointments WHERE ApptID='$ApptID'";
$Result = $GLOBALS["MYSQL_CON"]->query($Query);
		
if($Result->num_rows == 1)
{
	$GLOBALS["MYSQL_CON"]->query("DELETE FROM Appointments WHERE ApptID='$ApptID'")or die("MySQL Command Error: Query 1");

   	header("Location: " . constant("BASE_URL") . "dashboard/bookings");
   	exit;
}
else
{
	echo "This booking does not exist.";
}