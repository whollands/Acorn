<?php defined("ACORN_EXECUTE") or die("Access Denied.");

$UserID = $_SESSION["ACORN_USER_ID"];

$Query = "SELECT * FROM Users WHERE UserID='$UserID'";
$Result = $GLOBALS["MYSQL_CON"]->query($Query);

if($Result->num_rows != 1) die("Error: None or multiple results were found");

$row = $Result->fetch_assoc();

$UserFullName = $row["Name"];
$UserEmail = $row["Email"];
$UserNotify = $row["Notify"];
$UserID = $row["UserID"];


include("acorn/global/admin-html-header.php");
// include html header
?>

<div class="container">

<?php
define("Panel_Title", "Profile");
include("acorn/global/account-html-header.php");
?>


<?php echo $InfoMsg; ?>

<form action="" method="post">
<input type="hidden" name="SUBMITTED_FORM" value="TRUE"/>

<fieldset>

<img class="img-rounded" src="http://gravatar.com/avatar/<?php echo md5($row["Email"]); ?>?s=100&d=mm"/>
<a href="http://gravatar.com/" target="_blank" class="btn btn-default btn-xs">Change Avatar</a>
<p>&nbsp;</p>
   
<!-- Text input-->
<div class="form-group">
  <label for="UserID">User ID:</label>  
  <input name="UserID" type="number" value="<?php echo $UserID; ?>" class="form-control" disabled> 
</div>

<!-- Text input-->
<div class="form-group">
  <label for="FullName">Full Name:</label>  
  <input name="FullName" type="text" value="<?php echo $UserFullName; ?>" class="form-control">
  <span class="help-block" style="color:red;"><?php echo $UserFullNameErr; ?></span>  
</div>

<!-- Text input-->
<div class="form-group">
  <label for="Email">Email Address:</label>  
  <input name="Email" type="Email" value="<?php echo $UserEmail; ?>" class="form-control">
  <span class="help-block" style="color:red;"><?php echo $UserEmailErr; ?></span>  
</div>


<input type="submit" class="btn btn-success" value="Update Profile"/>



</fieldset>
</form>


<?php

include("acorn/global/account-html-footer.php");

include("acorn/global/admin-html-footer.php");
// include html footer