<?php defined("ACORN_EXECUTE") or die("Access Denied.");

include("acorn/global/admin-html-header.php");
// include html header



	
?>

<div class="container">

<h1><i class="fa fa-plus"></i> New Date</h1>


<h4>Select services:</h4>
<?php

$Query = "SELECT ServiceID, Name, MaxBooking FROM Services ORDER BY ServiceID";
$Result = $GLOBALS["MYSQL_CON"]->query($Query);

if($Result->num_rows >= 1)
{
	while($row = $Result->fetch_assoc())
	{
	echo "<div class=\"checkbox\"><label><input type=\"checkbox\" name=\"select-service-".$row["ServiceID"]."\" value=\"1\">".$row["Name"]."</label></div>";
	}
}
else
{
	echo "No services have been created yet!";
}
?>
<p>These services will be available to book on this date</p>

<input type="submit" value="Create &rarr;" class="btn btn-success"/>


</div>

<?php

include("acorn/global/admin-html-footer.php");
// include html footer



