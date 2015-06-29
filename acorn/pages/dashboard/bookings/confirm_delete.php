<?php defined("ACORN_EXECUTE") or die("Access Denied.");

include("acorn/global/admin-html-header.php");
// include html header

$ApptID = CleanID($PathInfo['call_parts'][3]);

$Query = "SELECT * FROM Appointments WHERE ApptID='$ApptID'";
$Result = $GLOBALS["MYSQL_CON"]->query($Query);
	
?>

<div class="container">

<?php
		
if($Result->num_rows >= 1)
{
	$row = $Result->fetch_assoc();
	
	

		$ClientQuery = "SELECT ClientID, Name FROM Clients WHERE ClientID='".$row["ClientID"]."'";
		$ClientResults = $GLOBALS["MYSQL_CON"]->query($ClientQuery);
		$ClientRow = $ClientResults->fetch_assoc();
		
		$DateQuery = "SELECT DateID, DateTime FROM Dates WHERE DateID='".$row["DateID"]."'";
		$DateResults = $GLOBALS["MYSQL_CON"]->query($DateQuery);
		$DateRow = $DateResults->fetch_assoc();
	
?>

<div class="panel panel-danger">
	<div class="panel-body">

	<h4>Are you sure you wish to cancel this booking?</h4>
	
	<h4><i><?php echo $ClientRow["Name"]; ?> on <?php echo date('jS F Y', strtotime($DateRow["DateTime"])); ?></i></h4>
		
		<br>
		
		<div class="row">
    		<div class="col-md-6">
    			<a href="<?php echo constant("BASE_URL"); ?>dashboard/bookings" class="btn btn-primary">&larr; Back</a>
    		</div>
    		<div class="col-md-6 text-right">
    			<a href="<?php echo constant("BASE_URL"); ?>dashboard/bookings/do_delete/<?php echo $row["ApptID"]; ?>" class="btn btn-danger">Cancel Booking &rarr;</a>
    		</div>
  		</div>
  		
</div>
	<?php
}
else
{
	echo "This Appointment does not exist - it was probably already deleted!";
}
?>
</div>
<?php

include("acorn/global/admin-html-footer.php");
// include html footer