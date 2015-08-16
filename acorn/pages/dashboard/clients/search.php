<?php defined("ACORN_EXECUTE") or die("Access Denied.");

include("acorn/global/admin-html-header.php");
// include html header

$SearchTerm = $PathInfo['query_vars']['search_term'];

$Query = "SELECT ClientID, Name FROM Clients WHERE Name LIKE '%$SearchTerm%'";
$Result = $GLOBALS["MYSQL_CON"]->query($Query);
	
?><div class="container">

<div class="panel panel-default">
  <div class="panel-heading clearfix">
  	<h4 class="panel-title pull-left" style="padding-top: 7.5px;"><i class="fa fa-users"></i> Clients</h4>
      <div class="btn-group pull-right">
        <a href="<?php echo constant("BASE_URL"); ?>dashboard/clients/add" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> New Client</a>
      </div>
  </div>
  <div class="panel-body">

<p>Click on a client's name to view their contact card</p>

    <form action="<?php echo constant("BASE_URL"); ?>dashboard/clients/search" method="get">
    <div class="input-group col-md-4">
     <input type="text" class="form-control" name="search_term" value="<?php echo htmlspecialchars($SearchTerm); ?>" placeholder="Search clients...">
      <span class="input-group-btn">
        <button class="btn btn-default" type="submit">Submit</button>
        <a href="<?php echo constant("BASE_URL"); ?>dashboard/clients" class="btn btn-danger">Clear Search</a>
      </span>
    </div><!-- /input-group -->
    </form>
<?php
		
if($Result->num_rows >= 1)
{
?>
<table class="table table-hover">
<thead>
	<tr>
		<th>Name</th>
		<th>Bookings Made</th>
		<th>Actions</th>
	</tr>
</thead>
<tbody>
<?php
	while($row = $Result->fetch_assoc())
	{
	echo "<tr>";
	echo "<td><a href=\"" . constant("BASE_URL") . "dashboard/clients/view/" .$row["ClientID"]."\">" . $row["Name"] . "</a></td>";
	echo "<td>";
		$Query_2 = "SELECT ClientID FROM Appointments WHERE ClientID='".$row["ClientID"]."'";
		$Result_2 = $GLOBALS["MYSQL_CON"]->query($Query_2);
		echo $Result_2->num_rows;
	echo "</td>";
	echo "<td>";
	echo "<a href=\"" . constant("BASE_URL") . "dashboard/clients/edit/" .$row["ClientID"]."\" class=\"btn btn-success btn-xs\"><i class=\"fa fa-pencil\"></i> Edit</a>&nbsp;";
	echo "<a href=\"" . constant("BASE_URL") . "dashboard/clients/delete/" .$row["ClientID"]."\" class=\"btn btn-danger btn-xs\"><i class=\"fa fa-trash\"></i> Delete</a>";
	echo "</td>";
	echo "</tr>";
	}
	?></tbody>
</table>

	<?php
}
else
{
	echo "<p>No results found</p>";
}
?></div><!-- /.panel-body -->
</div><!-- /.panel -->
</div><!-- /.container -->

<?php include("acorn/global/admin-html-footer.php");
// include html footer