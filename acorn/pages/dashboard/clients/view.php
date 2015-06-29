<?php defined("ACORN_EXECUTE") or die("Access Denied.");

include("acorn/global/admin-html-header.php");
// include html header

$ClientID = CleanID($PathInfo['call_parts'][3]);

$Query = "SELECT * FROM Clients WHERE ClientID='$ClientID'";
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
	echo "<h2>" . $row["Name"] . "</h2>";
	
?>

<img src="http://gravatar.com/avatar/<?php echo md5($row["Email"]); ?>"/>

	<h4>Email:</h4>
	<a href="mailto:<?php echo $row["Email"]; ?>"><?php echo $row["Email"]; ?></a>

	<h4>Phone:</h4>
	<a href="tel:<?php echo $row["Phone"]; ?>"><?php echo $row["Phone"]; ?></a>

	<h4>Identification Key:</h4>
	<p><?php echo $row["Key"]; ?></p>
	
	<h4>Notes:</h4>
	<p><?php echo $row["Notes"]; ?></p>
	
	<br>
	
	<a href="<?php echo constant("BASE_URL"); ?>dashboard/clients/vcard/<?php echo $ClientID; ?>" target="_blank" class="btn btn-warning"><i class="fa fa-download"></i> Import to contacts</a>
	
<?php


/*

$Query = "SELECT ClientID, ApptID FROM Appointments WHERE ApptID='$DateID'";
$Result = $GLOBALS["MYSQL_CON"]->query($Query);

if($Result->num_rows >= 1)
{
	while($row = $Result->fetch_assoc())
	{
		$ClientID = $row["ClientID"];
		
		$Query_2 = "SELECT ClientID, Name FROM Clients WHERE ClientID='$ClientID'";
		$Result_2 = $GLOBALS["MYSQL_CON"]->query($Query_2);
		$row_2 = $Result_2->fetch_assoc();
	
	echo "<tr>";
	echo "<td>" .  $row_2["Name"] . "</td>";
	echo "</tr>";
	}
	
	
}
else
{
	echo "No bookings, yet.";
}
*/
	
}
else
{
	echo "This client does not exist.";
}
?>


</div>

<?php

include("acorn/global/admin-html-footer.php");
// include html footer



