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
	
?>

<p>&nbsp;</p>

<div class="col-md-4"></div>

<div class="row col-md-4 text-center">
	<img class="img-rounded" src="http://gravatar.com/avatar/<?php echo md5($row["Email"]); ?>?s=100&d=mm"/>
	<h2><?php echo $row["Name"]; ?></h2>
<p>&nbsp;</p>
<table class="table table-striped">
<tbody>
<tr>
	<td>Email Address</td>
	<td><i class="fa fa-envelope-o"></i> <a href="mailto:<?php echo $row["Email"]; ?>"><?php echo $row["Email"]; ?></a></td>
</tr>
<tr>
	<td>Telephone</td>
	<?php
	$ClientPhone = preg_replace("/^(\d{3})(\d{3})(\d{4})$/", "$1-$2-$3", $row["Phone"]);
	?>
	<td><i class="fa fa-phone"></i> <a href="tel:<?php echo $ClientPhone; ?>"><?php echo $ClientPhone ; ?></a></td>
</tr>
<tr>
	<td>Key</td>
	<td><i class="fa fa-key"></i> <?php echo $row["Key"]; ?></td>
</tr>
<tr>
	<td>Notes</td>
	<td><i class="fa fa-book"></i> <?php echo $row["Notes"]; ?></td>
</tr>
</tbody>
</table>
	
	<br>
	
	<a href="<?php echo constant("BASE_URL"); ?>dashboard/clients/vcard/<?php echo $ClientID; ?>" target="_blank" class="btn btn-sm btn-default"><i class="fa fa-download"></i> Import to contacts</a>&nbsp;
	<a href="<?php echo constant("BASE_URL"); ?>dashboard/clients/edit/<?php echo $ClientID; ?>" class="btn btn-sm btn-success"><i class="fa fa-pencil"></i> Edit</a>&nbsp;
	<a href="<?php echo constant("BASE_URL"); ?>dashboard/clients/delete/<?php echo $ClientID; ?>" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Delete</a>&nbsp;
	
	
</div><!-- /. row col-md-4 -->
<div class="col-md-4"></div>
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
	echo "<div class=\"alert alert-warning\" role=\"alert\"><i class=\"fa fa-warning\"></i>&nbsp; This client does not exist</div>";
}
?>


</div>

<?php

include("acorn/global/admin-html-footer.php");
// include html footer



