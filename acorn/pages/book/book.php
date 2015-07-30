<?php defined("ACORN_EXECUTE") or die("Access Denied.");


$ServiceID = CleanID($PathInfo['call_parts'][1]);
$DateID = CleanID($PathInfo['call_parts'][2]);

$Email = $PathInfo['call_parts'][3];

$FinalAction = CleanID($PathInfo['call_parts'][4]);


if($Email == "submit_email")
{
$EmailHash = md5($_POST["Email"]);
header("Location: " . constant("BASE_URL") . "book/" . $ServiceID . "/" . $DateID . "/" . $EmailHash . "/");
exit; 
}
	
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo constant("ROOT_URL"); ?>acorn/images/Acorn_Logo_Icon.png">
    <link rel="apple-touch-icon" href="<?php echo constant("ROOT_URL"); ?>acorn/images/Acorn_App_Icon.png">

    <title>New Booking</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo constant("ROOT_URL"); ?>acorn/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    
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
if($ServiceID == null && $DateID == null)
{
	$_SESSION["ACORN_SELECTED_DATE"] == "";

	?>
	
<ol class="breadcrumb">
  <li class="active">1. <i class="fa fa-tags"></i> Select a Service</li>
</ol>

<?php

  
$Query = "SELECT ServiceID, Name, Cost FROM Services ORDER BY Name";
$Result = $GLOBALS["MYSQL_CON"]->query($Query);
		
if($Result->num_rows >= 1)
{
?>
<table class="table table-hover">

<thead>
	<tr>
		<td>Name</td>
		<td>Cost</td>
		<td>Actions</td>
	</tr>
</thead>
<tbody>
<?php
	while($row = $Result->fetch_assoc())
	{
		
	echo "<tr>";
	echo "<td>" . $row["Name"] . "</td>";
	echo "<td>" . constant("CURRENCY_SYMBOL") . $row["Cost"] . "</td>";
	echo "<td>";
	echo "<a href=\"".$row["ServiceID"]."/\" class=\"btn btn-success btn-xs\"><i class=\"fa fa-check\"></i> Select</a>&nbsp;";
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
else if($ServiceID != null && $DateID == null)
{

?>
<ol class="breadcrumb">
  <li><a href="<?php echo constant("BASE_URL"); ?>book/"><i class="fa fa-tags"></i> 1. Select service</a></li>
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
	echo "<a href=\"".$row["DateID"]."/\" class=\"btn btn-success btn-xs\"><i class=\"fa fa-check\"></i> Select</a>&nbsp;";
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
else if($ServiceID != null && $DateID != null)
{

function isValidMd5($md5 ='')
{
    return preg_match('/^[a-f0-9]{32}$/', $md5);
}

	if(isValidMd5($Email))
	{
		
		$Query = "SELECT ClientID, Name, Email, EmailMD5, Phone FROM Clients WHERE EmailMD5='$Email'";
		$Result = $GLOBALS["MYSQL_CON"]->query($Query);
			
		if($Result->num_rows == 1)
		{
			$row = $Result->fetch_assoc();
			echo "<h2>" . $row["Name"] . "</h2>";
		?>
		
		<p>We have your email address <?php echo preg_replace("/(?<=.).(?=.*@)/u","*",$row["Email"]); ?> on our database, if this is indeed you there is no need to re-enter your details.</p>
		<p>Are you <?php echo $row["Name"]; ?>?</p>
		
		<a href="review" class="btn btn-success">Yes, Review Booking</a>
		
		&nbsp; &nbsp;
		
		<a href="edit" class="btn btn-danger">No, edit my details</a>
		<?php
		
		}
		else
		{
		?>

    <div class="row">
    <ol class="breadcrumb">
  <li><a href="<?php echo constant("BASE_URL"); ?>book/"><i class="fa fa-tags"></i> 1. Select Service</a></li>
  <li><a href="<?php echo constant("BASE_URL"); ?>book/<?php echo $ServiceID; ?>/"><i class="fa fa-calendar"></i> 2. Select Date</a></li>
  <li><a href="<?php echo constant("BASE_URL"); ?>book/<?php echo $ServiceID; ?>/<?php echo $DateID; ?>/<?php echo $Email; ?>/"><i class="fa fa-calendar"></i> 3. Select Date</a></li>
  <li class="selected"><i class="fa fa-envelope-o"></i> 4. Enter details</li>
</ol>
        <div class="col-md-4"></div>
        <div class="col-md-4">
        
        <form action="<?php echo constant("BASE_URL"); ?>book/<?php echo $ServiceID; ?>/<?php echo $DateID; ?>/submit_email" method="post">
        
        	<div class="form-group">
    			<label for="name">Full Name</label>
    			<input type="email" class="form-control" name="name" placeholder="John Doe" required>
  			</div>
  			
        	<div class="form-group">
    			<label for="email">Email address</label>
    			<input type="email" class="form-control" name="email" placeholder="someone@example.com" required>
  			</div>
  			
  			<div class="form-group">
    			<label for="phone">Phone number</label>
    			<input type="phone" class="form-control" name="phone" placeholder="+44 1234 567 890" required>
  			</div>
        
        	<div class="form-group">
    			<label for="notes">Notes (optional)</label>
    			<textarea class="form-control" rows="3" name="notes"></textarea>
  			</div>
  			
  			<input type="submit" value="Make booking &rarr;" class="btn btn-success btn-block"/>
  			
  		</form>
  			
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
  <li><a href="<?php echo constant("BASE_URL"); ?>book/"><i class="fa fa-tags"></i> 1. Select Service</a></li>
  <li><a href="<?php echo constant("BASE_URL"); ?>book/<?php echo $ServiceID; ?>/"><i class="fa fa-calendar"></i> 2. Select Date</a></li>
  <li class="selected"><i class="fa fa-envelope-o"></i> Enter email address</li>
</ol>

<div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
        
        	<form action="<?php echo constant("BASE_URL"); ?>book/<?php echo $ServiceID; ?>/<?php echo $DateID; ?>/submit_email" method="post">
  			
        	<div class="form-group">
    			<label for="email">Email address</label>
    			<input type="email" class="form-control" name="Email" placeholder="someone@example.com">
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
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="<?php echo constant("ROOT_URL"); ?>acorn/bootstrap/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo constant("ROOT_URL"); ?>acorn/bootstrap/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>