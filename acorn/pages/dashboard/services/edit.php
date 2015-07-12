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

$ServiceName = $row["Name"];
$ServiceDescription = $row["Description"];
$ServiceMax = $row["MaxBooking"];
$ServiceEnabled = $row["Enabled"];
$ServiceCost = $row["Cost"];

if(isset($_POST["SUBMITTED_FORM"]))
{

$Completed = 0;

	switch($_POST["ServiceEnabled"])
	{
	default: $ServiceEnabled = 0; break;
	case 1: $ServiceEnabled = 1; break;
	}
	
	if(empty($_POST["ServiceName"]))
		{ 
			$ServiceNameErr = "Service name is required";
		}
		else
		{
			$ServiceName = CleanData($_POST["ServiceName"]);
			
		if(!preg_match("/^[a-zA-Z0-9+-. ]*$/",$ServiceName))
			{
				$ServiceNameErr = "Letters and spaces only";
			}
			else 
			{ 
			$Completed = $Completed + 1;
			}
		}
		// end name validation
		

		$ServiceMax = CleanData($_POST["ServiceMax"]);
			
		if(!preg_match("/^[0-9]*$/",$ServiceMax))
			{
				$ServiceMaxErr = "Numbers only";
			}
			else 
			{ 
			$Completed = $Completed + 1;
			}
		// end name validation
		
		
		$ServiceCost = CleanData($_POST["ServiceCost"]);
			
		if(!preg_match("/^[0-9.]*$/",$ServiceCost))
			{
				$ServiceCostErr = "Invalid cost, numbers and decimal point only";
			}
			else 
			{ 
			$Completed = $Completed + 1;
			}
		// end name validation

	if(strlen($_POST["ServiceDescription"]) > 200)
	{
		$ServiceDescription = CleanData($_POST["ServiceDescription"]);
		$ServiceDescriptionErr = "Maximum of 200 characters";
	}
	else
	{
		$ServiceDescription = strip_tags(CleanData($_POST["ServiceDescription"]));
		$Completed = $Completed + 1;
	}
	
if($Completed == 4)
{

		$stmt = $GLOBALS["MYSQL_CON"]->prepare("UPDATE Services SET Name=?, MaxBooking=?, Cost=?, Description=?, Enabled=? WHERE ServiceID=?");
		$stmt->bind_param("ssssss", $ServiceName, $ServiceMax, $ServiceCost, $ServiceDescription, $ServiceEnabled, $ServiceID);
		$stmt->execute();
		$stmt->close();
		
		$InfoMsg = "<div class=\"alert alert-success\" role=\"alert\"><i class=\"fa fa-check\"></i> Changes saved</div>";

}
else
{
	$InfoMsg = "<div class=\"alert alert-danger\" role=\"alert\"><i class=\"fa fa-times\"></i> There are errors below</div>";
}
	
}
	
?>

<h1 class="page-header text-center"><i class="fa fa-pencil"></i> Edit Service</h1>

<?php echo $InfoMsg; ?>

<form action="" method="post" class="form-horizontal">
<input type="hidden" name="SUBMITTED_FORM" value="TRUE"/>

<fieldset>
   

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="ServiceName">Service Name:</label>  
  <div class="col-md-5">
  <input name="ServiceName" type="text" value="<?php echo $ServiceName; ?>" class="form-control input-md">
  <span class="help-block" style="color:red;"><?php echo $ServiceNameErr; ?></span>  
  </div>
</div>

<!-- Number input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="name">Maximum number of bookings:</label>  
  <div class="col-md-5">
  <input name="ServiceMax" type="number" value="<?php echo $ServiceMax; ?>" class="form-control input-md">
  <span class="help-block" style="color:red;"><?php echo $ServiceMaxErr; ?></span>  
  </div>
</div>


<!-- Number input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="name">Cost Per Booking:</label>  
  <div class="col-md-5">
 	<div class="input-group">
      <div class="input-group-addon"><?php echo constant("CURRENCY_SYMBOL"); ?></div>
      <input type="number" class="form-control" name="ServiceCost" value="<?php echo $ServiceCost; ?>" placeholder="0.00">
	</div>
	<span class="help-block" style="color:red;"><?php echo $ServiceCostErr; ?></span> 
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" for="textarea">Description:</label>
  <div class="col-md-5">                     
    <textarea class="form-control" name="ServiceDescription" rows="4"><?php echo $ServiceDescription; ?></textarea>
    <span class="help-block" style="color:red;"><?php echo $ServiceDescriptionErr; ?></span>
  </div>
</div>

<!-- Multiple Checkboxes (inline) -->
<div class="form-group">
  <label class="col-md-4 control-label" for="ServiceEnabled"></label>
  <div class="col-md-4">
    <label class="checkbox-inline" for="ServiceEnabled">
      <input type="checkbox" name="ServiceEnabled" value="1"<?php if($ServiceEnabled == 1) { echo " checked"; } ?>>
      Enable clients to book this service
    </label>
  </div>
</div>


<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="save"></label>
  <div class="col-md-4">
    <input type="submit" class="btn btn-success" value="Update Service"/>
  </div>
</div>


</fieldset>
</form>


<?php
	
}
else
{
	echo "This service does not exist.";
}
?>


</div>

<?php

include("acorn/global/admin-html-footer.php");
// include html footer



