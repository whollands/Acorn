<?php defined("ACORN_EXECUTE") or die("Access Denied.");

include("acorn/global/admin-html-header.php");
// include html header


$Query = "SELECT ServiceID, Name, MaxBooking, Cost FROM Services ORDER BY ServiceID";
$Result = $GLOBALS["MYSQL_CON"]->query($Query);
	
?>

<div class="container">

<h1><i class="fa fa-tags"></i> Services</h1>

<table class="table table-hover">

<thead>
	<tr>
		<td>Name</td>
		<td>Max Bookings</td>
		<td>Cost per Booking</td>
		<td>Actions</td>
	</tr>
</thead>
<tbody>
<?php
		
if($Result->num_rows >= 1)
{
	while($row = $Result->fetch_assoc())
	{
	echo "<tr>";
	echo "<td>" . $row["Name"] . "</td>";
	echo "<td>" . $row["MaxBooking"] . "</td>";
	echo "<td>" . constant("CURRENCY_SYMBOL") . $row["Cost"] . "</td>";
	echo "<td>";
	echo "<a href=\"" . constant("BASE_URL") . "dashboard/services/edit/" .$row["ServiceID"]."\" class=\"btn btn-success btn-xs\"><i class=\"fa fa-pencil\"></i> Edit</a>&nbsp;";
	echo "<a href=\"" . constant("BASE_URL") . "dashboard/services/delete/" .$row["ServiceID"]."\" class=\"btn btn-danger btn-xs\"><i class=\"fa fa-trash\"></i> Delete</a>";
	echo "</td>";
	echo "</tr>";
	}
}
else
{
	echo "No services have been created yet.";
}
?>
</tbody>
</table>

</div>

<?php

include("acorn/global/admin-html-footer.php");
// include html footer
