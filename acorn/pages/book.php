<?php

session_start();

define("ACORN_EXECUTE", true);
// Acorn is being executed

include("includes/config.php");
// include master config file
// which includes functions.php


$ServiceID = $_GET["select_service"];
$DateID = $_GET["select_date"];

?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="images/Acorn_Logo_Icon.png">
    <link rel="apple-touch-icon" href="images/Acorn_Appointments_Medium.png">

    <title>Make a Booking :: Acorn</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" type="text/css" href="http://cdn.hollands123.com/font-awesome/4.3.0/css/font-awesome.min.css"/>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>


  <body>
  
<div class="container">

<h1><i class="fa fa-plus"></i> New Booking</h1>
<br>

<?php
if($_GET["select_date"] == null && $_GET["select_service"] == null)
{
	$_SESSION["ACORN_SELECTED_DATE"] == "";

	?>
	
<ol class="breadcrumb">
  <li class="active">1. <i class="fa fa-tags"></i> Select a Service</li>
</ol>

<?php

  
$Query = "SELECT ServiceID, Name FROM Services ORDER BY Name";
$Result = $GLOBALS["MYSQL_CON"]->query($Query);
		
if($Result->num_rows >= 1)
{
?>
<table class="table table-hover">

<thead>
	<tr>
		<td>Name</td>
		<td>Actions</td>
	</tr>
</thead>
<tbody>
<?php
	while($row = $Result->fetch_assoc())
	{
		
	echo "<tr>";
	echo "<td>" . $row["Name"] . "</td>";
	echo "<td>";
	echo "<a href=\"book.php?select_service=".$row["ServiceID"]."\" class=\"btn btn-success btn-xs\"><i class=\"fa fa-check\"></i> Select</a>&nbsp;";
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
	echo "No services are available yet.";
}


}
else if($_GET["select_service"] != null && $_GET["select_date"] == null)
{

?>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-tags"></i> 11+ Mock</a></li>
  <li class="active"><i class="fa fa-calendar"></i> Select a date</li>
</ol>

<?php

  
$Query = "SELECT DateID, DateTime FROM Dates ORDER BY DateTime";
$Result = $GLOBALS["MYSQL_CON"]->query($Query);
		
if($Result->num_rows >= 1)
{
?>
<table class="table table-hover">

<thead>
	<tr>
		<td>Date</td>
		<td>Time</td>
		<td>Actions</td>
	</tr>
</thead>
<tbody>
<?php
	while($row = $Result->fetch_assoc())
	{
		
	echo "<tr>";
	echo "<td>" . date('jS F Y', strtotime($row["DateTime"])) . "</td>";
	echo "<td>" . date('h:i', strtotime($row["DateTime"])) . "</td>";
	echo "<td>";
	echo "<a href=\"book.php?select_service=".$ServiceID."&select_date=".$row["DateID"]."\" class=\"btn btn-success btn-xs\"><i class=\"fa fa-check\"></i> Select</a>&nbsp;";
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
	echo "No dates are available yet.";
}

}
else if($_GET["select_date"] != null && $_GET["select_service"] != null)
{

	if(isset($_POST["SUBMIT_EMAIL"]))
	{
		$Email = $_POST["email"];
		// DANGER NO FILTER YET
		
		$Query = "SELECT ClientID, Name, Email, Phone FROM Clients WHERE Email='$Email'";
		$Result = $GLOBALS["MYSQL_CON"]->query($Query);
			
		if($Result->num_rows == 1)
		{
			$row = $Result->fetch_assoc();
			echo "<h2>Are you " . $row["Name"] . "?</h2>";
			echo "<p><strong>Email:</strong> " . preg_replace("/(?<=.).(?=.*@)/u","*",$row["Email"]) . "</p>";
		?>
		
		<p>Is this you?</p>
		
		<a href="#" class="btn btn-success">Yes, Complete Booking</a>
		
		<br>
		
		<a href="#" class="btn btn-danger">No, edit my details</a>
		<?php
		
		}
		else
		{
		?>

    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
        
        	<div class="form-group">
    			<label for="name">Full Name</label>
    			<input type="email" class="form-control" name="name" placeholder="John Doe">
  			</div>
  			
        	<div class="form-group">
    			<label for="email">Email address</label>
    			<input type="email" class="form-control" name="email" placeholder="someone@example.com">
  			</div>
  			
  			<div class="form-group">
    			<label for="phone">Phone number</label>
    			<input type="phone" class="form-control" name="phone" placeholder="+44 1234 567 890">
  			</div>
        
        	<div class="form-group">
    			<label for="notes">Notes (optional)</label>
    			<textarea class="form-control" rows="3" name="notes"></textarea>
  			</div>
  			
  			<input type="submit" value="Make booking &rarr;" class="btn btn-success btn-block"/>
  			
  			<p><a href="index.php">Admin Panel &rarr;</a></p>
        	
        
        </div>
        <div class="col-md-4"></div>
      </div>

<?php
		}
	}
	else
	{
			
		
?>


<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-tags"></i> 11+ Mock</a></li>
  <li><i class="fa fa-calendar"></i> 11th June</li>
  <li class="selected"><i class="fa fa-envelope-o"></i> Enter email address</li>
</ol>

<div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
        
        	<form action="book.php?select_service=<?php echo $ServiceID; ?>&select_date=<?php echo $DateID; ?>&entered_email=true" method="post">
        	<input type="hidden" name="SUBMIT_EMAIL" value="TRUE"/>
  			
        	<div class="form-group">
    			<label for="email">Email address</label>
    			<input type="email" class="form-control" name="email" placeholder="someone@example.com">
  			</div>
  			
  			<input type="submit" value="Next &rarr;" class="btn btn-success btn-block"/>
        	
        	</form>
        
        </div>
        <div class="col-md-4"></div>
      </div>


<?php
	}
}
// end switchies!

?>
    
    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>

