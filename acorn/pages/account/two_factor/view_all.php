<?php defined("ACORN_EXECUTE") or die("Access Denied.");

include("acorn/global/admin-html-header.php");
// include html header

$UserID = CleanID($_SESSION["ACORN_USER_ID"]);

$Query = "SELECT DeviceID, Label, Created FROM User2FADevices WHERE UserID='$UserID' ORDER BY Created";
$Result = $GLOBALS["MYSQL_CON"]->query($Query);
	
?>

<div class="container">

<?php
define("Panel_Title", "Two-Factor");
include("acorn/global/account-html-header.php");
?>

<div class="alert alert-info alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  You can disable two-factor by removing all your devices below.
</div>


	<a href="<?php echo constant("BASE_URL"); ?>account/two_factor/add" class="btn btn-success btn-md" style="text-align:right;"><i class="fa fa-plus"></i> Add Device</a>

<?php
		
if($Result->num_rows >= 1)
{
?>
  
<table class="table table-hover">

<thead>
	<tr>
		<td>Label</td>
		<td>Created</td>
		<td>Actions</td>
	</tr>
</thead>
<tbody>
<?php
	while($row = $Result->fetch_assoc())
	{
	echo "<tr>";
	echo "<td>" . $row["Label"] . "</td>";
	echo "<td>" . date('jS F Y', strtotime($row["Created"])) . "</td>";
	echo "<td>";
	echo "<a href=\"" . constant("BASE_URL") . "account/two_factor/remove/" .$row["DeviceID"]."\" class=\"btn btn-danger btn-xs\"><i class=\"fa fa-times\"></i> Remove</a>";
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
	echo "<p style=\"display:inline-block;\">No devices registered, two factor is disabled until you add your first device.</p>";
}
?>


</div>

<?php

include("acorn/global/account-html-footer.php");

include("acorn/global/admin-html-footer.php");
// include html footer


