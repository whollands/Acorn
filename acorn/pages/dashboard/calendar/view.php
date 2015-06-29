<?php defined("ACORN_EXECUTE") or die("Access Denied.");

include("acorn/global/admin-html-header.php");
// include html header

$DateID = CleanID($PathInfo['call_parts'][3]);

$Query = "SELECT DateID, DateTime FROM Dates WHERE DateID='$DateID'";
$Result = $GLOBALS["MYSQL_CON"]->query($Query);
	
?>

<div class="container">

<script>
function goBack() {
    window.history.go(-1);
}
</script>
<p><a href="#" onclick="goBack();" class="btn btn-primary btn-md">&larr; Back</a></p>

<?php
		
if($Result->num_rows >= 1)
{
	$row = $Result->fetch_assoc();
	echo "<h2>" . date('jS F Y', strtotime($row["DateTime"])) . "</h2>";
?>
<p>Clients booked-in on this date:</p>
<?php

$Query = "SELECT ClientID, ApptID FROM Appointments WHERE ApptID='$DateID'";
$Result = $GLOBALS["MYSQL_CON"]->query($Query);

if($Result->num_rows >= 1)
{
	echo "<table>";
	
	while($row = $Result->fetch_assoc())
	{
		$ClientID = $row["ClientID"];
		
		$Query_2 = "SELECT ClientID, Name FROM Clients WHERE ClientID='$ClientID'";
		$Result_2 = $GLOBALS["MYSQL_CON"]->query($Query_2);
		$row_2 = $Result_2->fetch_assoc();
	
	echo "<tr>";
	echo "<td><a href=\"client.php?id=" . $row_2["ClientID"] . "\">" .  $row_2["Name"] . "</a></td>";
	echo "</tr>";
	}
	
	echo "</table>";
}
else
{
	echo "No bookings, yet.";
}

	
}
else
{
	echo "This date does not exist.";
}
?>


</div>

<?php

include("acorn/global/admin-html-footer.php");
// include html footer


