<?php defined("ACORN_EXECUTE") or die("Access Denied.");

$RemoveID = CleanID($PathInfo['query_vars']['remove_id']);
$UserID = CleanID($_SESSION["ACORN_USER_ID"]);
if($RemoveID != null)
{

// sql to delete a record
$Query = "DELETE FROM UserSessions WHERE SessionID='$RemoveID' AND UserID='$UserID'";

if ($GLOBALS["MYSQL_CON"]->query($Query) === TRUE) {
    header("Location: " . constant("BASE_URL") . "account/sessions/success");
} else {
    echo "Error deleting record: " . $GLOBALS["MYSQL_CON"]->error;
}

$GLOBALS["MYSQL_CON"]->close();

}

$UserID = CleanID($_SESSION["ACORN_USER_ID"]);

$Query = "SELECT * FROM UserSessions WHERE UserID='$UserID' ORDER BY LastActive";
$Result = $GLOBALS["MYSQL_CON"]->query($Query);

include("acorn/global/admin-html-header.php");
// include html header
	
?>

<div class="container">

<?php
define("Panel_Title", "Sessions");
include("acorn/global/account-html-header.php");
?>

<p>Places where you are currently logged in to will appear below. Remove any devices you do not recognise.</p>
<?php
		
if($Result->num_rows >= 1)
{
?>
  
<table class="table table-hover">

<thead>
	<tr>
		<td>Device</td>
		<td>Last IP</td>
		<td>Last Active</td>
		<td></td>
	</tr>
</thead>
<tbody>
<?php
	while($row = $Result->fetch_assoc())
	{
	echo "<tr>";
	echo "<td>" . getOS($row["UserAgent"]) . "</td>";
	echo "<td><a href=\"http://whatismyipaddress.com/ip/" . $row["LastIP"] . "\" title=\"Lookup this IP Address\" target=\"_blank\">" . $row["LastIP"] . "</a></td>";
	echo "<td>" . date('jS F Y', strtotime($row["LastActive"])) . "</td>";
	echo "<td>";
	echo "<a href=\"" . constant("BASE_URL") . "account/sessions?remove_id=" .$row["SessionID"]."\" class=\"btn btn-danger btn-xs\"><i class=\"fa fa-times\"></i> Remove</a>";
	echo "</td>";
	echo "</tr>";
	}
	
	?>
	
	</tbody>
</table>

	<?php
}
else
{
	echo "<p style=\"display:inline-block;\">No currently active sessions</p>";
}
?>


</div>

<?php

include("acorn/global/account-html-footer.php");

include("acorn/global/admin-html-footer.php");
// include html footer


