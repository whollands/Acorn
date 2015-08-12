<?php defined("ACORN_EXECUTE") or die("Access Denied.");

if(isset($_POST["SUBMITTED_FORM"]))
{
	$done = 0;
	// password will be changed when this is equal to 3?
	
	$UserID = $_SESSION["ACORN_USER_ID"];
	// session user id

	$Query = "SELECT UserID, Salt, Password FROM Users";
	$Result = $GLOBALS["MYSQL_CON"]->query($Query);
	
	if($Result->num_rows != 1)
	{
		die("Your user account appears not to exist.");
	}
	else
	{
	$row = $Result->fetch_assoc();
	$UserSalt = $row["Salt"];
	$DatabasePassword = $row["Password"];
	}
	// drag user salt and password out of database
	
	$CurrentPassword = md5(constant("MASTER_SALT") . $_POST["CurrentPassword"] . $UserSalt);
	// hash the current password using user salt
	
	if($CurrentPassword != $DatabasePassword)
	{
		$CurrentPasswordErr = "Invalid password";
	}
	else { $done = $done + 1; }
	// check current password
	
	
	if(strlen($_POST["NewPassword"]) < 8)
	{
		$NewPasswordErr = "Password must be at least 8 characters in length";
	}
	else { $done = $done + 1; }
	// check length of new password
	
	
	if($_POST["NewPassword"] != $_POST["ConfirmNewPassword"])
	{
		$ConfirmNewPasswordErr = "Passwords did not match";
	}
	else { $done = $done + 1; }
	// check if passwords match
	
	if($done == 3)
	{
		$NewSalt = md5(uniqid($UserID, true));
		$NewPassword = md5(constant("MASTER_SALT") . $_POST["NewPassword"] . $NewSalt);
		
		$stmt = $GLOBALS["MYSQL_CON"]->prepare("UPDATE Users SET Password=?, Salt=? WHERE UserID=?");
		$stmt->bind_param("sss", $NewPassword, $NewSalt, $UserID);
		$stmt->execute();
		$stmt->close();
		
		$InfoMsg = "<div class=\"alert alert-success\" role=\"alert\"><i class=\"fa fa-check\"></i> Password changed</div>";
	}
	else
	{
		$InfoMsg = "<div class=\"alert alert-danger\" role=\"alert\"><i class=\"fa fa-times\"></i> There are errors below</div>";
	}

}

include("acorn/global/admin-html-header.php");
// include html header

?>

<div class="container">
<?php 
define("Panel_Title", "Change Password");
include("acorn/global/account-html-header.php");

echo $InfoMsg; ?>

<form action="<?php echo constant("BASE_URL"); ?>account/password" method="post" class="form-horizontal">
<input type="hidden" name="SUBMITTED_FORM" value="TRUE"/>

<fieldset>
   

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="CurrentPassword">Current Password:</label>  
  <div class="col-md-5">
  <input name="CurrentPassword" type="password" class="form-control input-md">
  <span class="help-block" style="color:red;"><?php echo $CurrentPasswordErr; ?></span>  
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="NewPassword">New Password:</label>  
  <div class="col-md-5">
  <input name="NewPassword" type="password" class="form-control input-md">
  <span class="help-block" style="color:red;"><?php echo $NewPasswordErr; ?></span>  
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="ConfirmNewPassword">Confirm New Password:</label>  
  <div class="col-md-5">
  <input name="ConfirmNewPassword" type="password" class="form-control input-md">
  <span class="help-block" style="color:red;"><?php echo $ConfirmNewPasswordErr; ?></span>  
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="save"></label>
  <div class="col-md-4">
    <input type="submit" class="btn btn-success" value="Change Password"/>
  </div>
</div>


</fieldset>
</form>

<?php

include("acorn/global/account-html-footer.php");

include("acorn/global/admin-html-footer.php");
// include html footer