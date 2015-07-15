<?php

session_start();

define("ACORN_EXECUTE", true);
// Acorn is being executed

include("includes/config.php");
// include master config file
// which includes functions.php

Check_Auth_User();
// check user is logged in.



include("includes/header.php");
// include master header file


$Query = "SELECT ServiceID, Name, MaxBooking FROM Services ORDER BY ServiceID";
$Result = $GLOBALS["MYSQL_CON"]->query($Query);
	
?>

<div class="container">

<h1>Personal Settings</h1>

<div class="col-md-4">

<p>&nbsp;</p>

<h4><i class="fa fa-bell"></i> Notifications</h4>

<div class="checkbox">
  <label>
    <input type="checkbox" value="1">
    Email me when a new booking is made (recommended)
  </label>
</div>

<p>&nbsp;</p>

<h4><i class="fa fa-user"></i> Personal Details</h4>

<div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
</div>

<div class="form-group">
    <label for="exampleInputEmail1">Full Name</label>
    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Your Name">
</div>
  
<p>&nbsp;</p>

<h4><i class="fa fa-key"></i> Change Password</h4>

<p>Leave fields below blank to keep current password</p>

<div class="form-group">
    <label for="exampleInputPassword1">Current Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Current">
</div>

<div class="form-group">
    <label for="exampleInputPassword1">New Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="New">
</div>

<div class="form-group">
    <label for="exampleInputPassword1">Confirm New Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Repeat-new">
</div>

<p>&nbsp;</p>

<input type="submit" value="Save Changes &rarr;" class="btn btn-success btn-block"/>

</div><!-- /.col-md-4 -->

<div class="col-md-4"></div>
<div class="col-md-4"></div>

<?php

/*
		
if($Result->num_rows >= 1)
{
	while($row = $Result->fetch_assoc())
	{
	echo "<tr>";
	echo "<td>" . $row["ServiceID"] . "</td>";
	echo "<td>" . $row["Name"] . "</td>";
	echo "<td>" . $row["MaxBooking"] . "</td>";
	echo "<td>";
	echo "<button class=\"btn btn-success btn-xs\"><i class=\"fa fa-pencil\"></i> Edit</button>&nbsp;";
	echo "<button class=\"btn btn-danger btn-xs\"><i class=\"fa fa-trash\"></i> Delete</button>";
	echo "</td>";
	echo "</tr>";
	}
}
else
{
	echo "No services have been created yet.";
}
*/
?>


</div>

<?php

include("includes/footer.php");
// include master footer file


