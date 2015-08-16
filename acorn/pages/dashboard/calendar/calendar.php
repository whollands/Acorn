<?php defined("ACORN_EXECUTE") or die("Access Denied.");

include("acorn/global/admin-html-header.php");


$Query = "SELECT DateID, DateTime FROM Dates ORDER BY DateTime";
$Result = $GLOBALS["MYSQL_CON"]->query($Query);
	
?>

<div class="container">

<div class="panel panel-default">
  <div class="panel-heading clearfix">
  	<h4 class="panel-title pull-left" style="padding-top: 7.5px;"><i class="fa fa-calendar"></i> Calendar</h4>
      <div class="pull-right">
      	<div class="btn-group">
        <a href="<?php echo constant("BASE_URL"); ?>dashboard/calendar" class="btn btn-primary btn-sm active" disabled><i class="fa fa-calendar"></i></a>
        <a href="<?php echo constant("BASE_URL"); ?>dashboard/calendar/list" class="btn btn-default btn-sm"><i class="fa fa-list"></i></a>
        </div>
        <a href="#" class="btn btn-success btn-sm btn-disabled"><i class="fa fa-plus"></i> New Event</a>
      </div>
  </div>
  <div class="panel-body">

<?php
		
if($Result->num_rows >= 1)
{
?>
<table class="table table-hover">

<thead>
	<tr>
		<td>Date & Time</td>
		<td>Bookings Made</td>
		<td>Actions</td>
	</tr>
</thead>
<tbody>
<?php
	while($row = $Result->fetch_assoc())
	{
		
	echo "<tr>";
	echo "<td>" . date('jS F Y', strtotime($row["DateTime"])) . "</td>";
	echo "<td>";
			$Query_2 = "SELECT ClientID FROM Appointments WHERE DateID='".$row["DateID"]."'";
			$Result_2 = $GLOBALS["MYSQL_CON"]->query($Query_2);
			echo $Result_2->num_rows;
	echo "</td>";
	echo "<td>";
	echo "<a href=\"" . constant("BASE_URL") . "dashboard/calendar/view/" .$row["DateID"]."\" class=\"btn btn-primary btn-xs\"><i class=\"fa fa-search\"></i> View</a>&nbsp;";
	echo "<a href=\"" . constant("BASE_URL") . "dashboard/calendar/delete/" .$row["DateID"]."\" class=\"btn btn-danger btn-xs\"><i class=\"fa fa-trash\"></i> Delete</a>";
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
	echo "No dates created yet.";
}
?>
</div>
</div>

</div>

<?php

include("acorn/global/admin-html-footer.php");
// include html footer



