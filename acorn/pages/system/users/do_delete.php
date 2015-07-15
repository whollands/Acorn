<?php defined("ACORN_EXECUTE") or die("Access Denied.");

$UserID = CleanID($PathInfo['call_parts'][3]);

$Query = "SELECT UserID FROM Users WHERE UserID='$UserID'";
$Result = $GLOBALS["MYSQL_CON"]->query($Query);
		
if($Result->num_rows == 1)
{
	$GLOBALS["MYSQL_CON"]->query("DELETE FROM Users WHERE UserID='$UserID'")or die("MySQL Command Error: Query 1");

   	header("Location: " . constant("BASE_URL") . "dashboard/users/success");
   	exit;
}
else
{
	echo "This user does not exist.";
}