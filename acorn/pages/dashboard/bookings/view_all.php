<?php defined("ACORN_EXECUTE") or die("Access Denied.");

include("acorn/global/admin-html-header.php");


$Query = "SELECT ApptID, DateID, ClientID, DateTime FROM Appointments ORDER BY DateTime DESC";
$Result = $GLOBALS["MYSQL_CON"]->query($Query);
	
?>

<div class="container">

<h1><i class="fa fa-book"></i> Bookings</h1>

<?php
		
if($Result->num_rows >= 1)
{
?>
<table class="table table-hover">

<thead>
	<tr>
		<td>Client</td>
		<td>Date</td>
		<td>Actions</td>
	</tr>
</thead>
<tbody>
<?php
	while($row = $Result->fetch_assoc())
	{
	echo "<tr>";
	
	echo "<td>";
		$Query_2 = "SELECT ClientID, Name FROM Clients WHERE ClientID='".$row["ClientID"]."'";
		$Result_2 = $GLOBALS["MYSQL_CON"]->query($Query_2);
		$row_2 = $Result_2->fetch_assoc();
		echo "<a href=\"" . constant("BASE_URL") . "dashboard/clients/view/" . $row_2["ClientID"] . "\">" . $row_2["Name"] . "</a>";
	echo "</td>";
	
	echo "<td>";
		$Query_3 = "SELECT DateID, DateTime FROM Dates WHERE DateID='".$row["DateID"]."'";
		$Result_3 = $GLOBALS["MYSQL_CON"]->query($Query_3);
		$row_3 = $Result_3->fetch_assoc();
		echo "<a href=\"" . constant("BASE_URL") . "dashboard/calendar/view/" . $row_3["DateID"] . "\">" . date('jS F Y', strtotime($row_3["DateTime"])) . "</a>";
	echo "</td>";
	
	echo "<td>";
	echo "<a href=\"".constant("BASE_URL")."dashboard/bookings/delete/" . $row["ApptID"]. "\" class=\"btn btn-danger btn-xs\"><i class=\"fa fa-times\"></i> Cancel</a>";
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
	echo "No bookings have been made.";
}
?>


</div>

<?php

include("acorn/global/admin-html-footer.php");