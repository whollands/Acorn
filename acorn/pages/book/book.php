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


include("acorn/global/admin-html-header.php");
// include html header
	
?>
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
  <li><a href="<?php echo constant("BASE_URL"); ?>book/<?php echo $ServiceID; ?>"><i class="fa fa-tags"></i> 11+ Mock</a></li>
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
        <div class="col-md-4"></div>
        <div class="col-md-4">
        
        <form action="<?php echo constant("BASE_URL"); ?>book/<?php echo $ServiceID; ?>/<?php echo $DateID; ?>/submit_email" method="post">
        
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
  <li><a href="<?php echo constant("BASE_URL"); ?>book/<?php echo $ServiceID; ?>/"><i class="fa fa-tags"></i> 11+ Mock</a></li>
  <li><a href="<?php echo constant("BASE_URL"); ?>book/<?php echo $ServiceID; ?>/<?php echo $DateID; ?>/"><i class="fa fa-calendar"></i> 11th June</a></li>
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

include("acorn/global/admin-html-footer.php");
// include html header