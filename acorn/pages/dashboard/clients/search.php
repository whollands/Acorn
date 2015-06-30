<?php defined("ACORN_EXECUTE") or die("Access Denied.");

include("acorn/global/admin-html-header.php");
// include html header

$SearchTerm = $PathInfo['query_vars']['search_term'];


$Query = "SELECT ClientID, Name FROM Clients WHERE Name LIKE '%$SearchTerm%'";
$Result = $GLOBALS["MYSQL_CON"]->query($Query);
	
?>

<div class="container">

<div class="col-md-11">
	<h1>Search for "<?php echo htmlspecialchars($SearchTerm); ?>"</h1>
</div>

<div class="col-md-1">
	<a href="<?php echo constant("BASE_URL"); ?>dashboard/clients" class="btn btn-danger btn-md" style="text-align:right;"><i class="fa fa-times"></i> Clear Search</a>
</div>

<?php
		
if($Result->num_rows >= 1)
{
?>
<table class="table table-hover">

<thead>
	<tr>
		<td>#</td>
		<td>Name</td>
		<td>Bookings Made</td>
		<td>Actions</td>
	</tr>
</thead>
<tbody>
<?php
	while($row = $Result->fetch_assoc())
	{
	echo "<tr>";
	echo "<td>" . $row["ClientID"] . "</td>";
	echo "<td>" . $row["Name"] . "</td>";
	echo "<td>";
		$Query_2 = "SELECT ClientID FROM Appointments WHERE ClientID='".$row["ClientID"]."'";
		$Result_2 = $GLOBALS["MYSQL_CON"]->query($Query_2);
		echo $Result_2->num_rows;
	echo "</td>";
	echo "<td>";
	echo "<a href=\"" . constant("BASE_URL") . "dashboard/clients/view/" .$row["ClientID"]."\" class=\"btn btn-primary btn-xs\"><i class=\"fa fa-search\"></i> View</a>&nbsp;";
	echo "<a href=\"" . constant("BASE_URL") . "dashboard/clients/edit/" .$row["ClientID"]."\" class=\"btn btn-success btn-xs\"><i class=\"fa fa-pencil\"></i> Edit</a>&nbsp;";
	echo "<a href=\"" . constant("BASE_URL") . "dashboard/clients/delete/" .$row["ClientID"]."\" class=\"btn btn-danger btn-xs\"><i class=\"fa fa-trash\"></i> Delete</a>";
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
	echo "<p>No results found</p>";
}
?>


</div>

<?php

include("acorn/global/admin-html-footer.php");
// include html footer


