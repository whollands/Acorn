<?php defined("ACORN_EXECUTE") or die("Access Denied.");

include("acorn/global/admin-html-header.php");
// include html header

$SearchTerm = $PathInfo['query_vars']['search_term'];


$Query = "SELECT UserID, Name, Email FROM Users WHERE Name LIKE '%$SearchTerm%'";
$Result = $GLOBALS["MYSQL_CON"]->query($Query);
	
?>

<div class="container">

<div class="col-md-11">
	<h1>Search for "<?php echo htmlspecialchars($SearchTerm); ?>"</h1>
</div>

<div class="col-md-1">
	<a href="<?php echo constant("BASE_URL"); ?>system/users" class="btn btn-danger btn-md" style="text-align:right;"><i class="fa fa-times"></i> Clear Search</a>
</div>

<?php
		
if($Result->num_rows >= 1)
{
?>
<table class="table table-hover">

<thead>
	<tr>
		<td>Name</td>
		<td>Email Address</td>
		<td>Actions</td>
	</tr>
</thead>
<tbody>
<?php
	while($row = $Result->fetch_assoc())
	{
	echo "<tr>";
	echo "<td>" . $row["Name"] . "</td>";
	echo "<td><a href=\"mailto:" . $row["Email"] . "\">" . $row["Email"] . "</a></td>";
	echo "<td>";
	echo "<a href=\"" . constant("BASE_URL") . "system/users/view/" .$row["UserID"]."\" class=\"btn btn-primary btn-xs\"><i class=\"fa fa-search\"></i> View</a>&nbsp;";
	echo "<a href=\"" . constant("BASE_URL") . "system/users/edit/" .$row["UserID"]."\" class=\"btn btn-success btn-xs\"><i class=\"fa fa-pencil\"></i> Edit</a>&nbsp;";
	echo "<a href=\"" . constant("BASE_URL") . "system/users/delete/" .$row["UserID"]."\" class=\"btn btn-danger btn-xs\"><i class=\"fa fa-trash\"></i> Delete</a>";
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


