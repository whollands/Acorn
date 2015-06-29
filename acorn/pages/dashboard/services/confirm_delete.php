<?php defined("ACORN_EXECUTE") or die("Access Denied.");

include("acorn/global/admin-html-header.php");
// include html header

$ServiceID = CleanID($PathInfo['call_parts'][3]);

$Query = "SELECT * FROM Services WHERE ServiceID='$ServiceID'";
$Result = $GLOBALS["MYSQL_CON"]->query($Query);
	
?>

<div class="container">

<?php
		
if($Result->num_rows >= 1)
{
	$row = $Result->fetch_assoc();
	
	
?>

<div class="panel panel-danger">
	<div class="panel-heading">
		<h3 class="panel-title">Deletion Warning</h3>
	</div>
	<div class="panel-body">

	<h4>Are you sure you wish to delete the service...</h4>
	
	<h4><i><?php echo $row["Name"]; ?></i></h4>
	
	<p>This will have the following effect:</p>
		<ul>
			<li>Service will be removed</li>
			<li>All dates which are <strong>only</strong> associated with service will be removed</li>
			<li>All bookings associated with this booking will be removed</li>
		</ul>
		
	<p>This cannot be undone.</p>
		
		<br>
		
		<div class="row">
    		<div class="col-md-6">
    			<a href="<?php echo constant("BASE_URL"); ?>dashboard/services" class="btn btn-primary">&larr; Cancel</a>
    		</div>
    		<div class="col-md-6 text-right">
    			<a href="<?php echo constant("BASE_URL"); ?>dashboard/services/do_delete/<?php echo $row["ServiceID"]; ?>" class="btn btn-danger">Delete Service &rarr;</a>
    		</div>
  		</div>
  		
</div>
	<?php
	
}
else
{
	echo "This service does not exist - they have probably already been deleted!";
}
?>


</div>

<?php

include("acorn/global/admin-html-footer.php");
// include html footer



