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
		
		$InfoMsg = SuccessMessage("Password changed successfully");
	}
	else
	{
		$InfoMsg = DangerMessage("There are errors below");
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

<form action="<?php echo constant("BASE_URL"); ?>account/password" method="post">
<input type="hidden" name="SUBMITTED_FORM" value="TRUE"/>

<fieldset>
   

<div class="row">
	<div class="form-group col-md-8">
	  <label for="CurrentPassword">Current Password:</label>  
	  <input name="CurrentPassword" type="password" class="form-control">
	  <span class="help-block" style="color:red;"><?php echo $CurrentPasswordErr; ?></span>  
	</div>
</div>

<div class="row">
	<div class="form-group col-md-8">
	  <label for="NewPassword">New Password:</label>  
	  <input name="NewPassword" type="password" class="form-control">
	  <span class="help-block" style="color:red;"><?php echo $NewPasswordErr; ?></span>  
	</div>
</div>
<div class="row">
	<div class="form-group col-md-8">
	  <label for="ConfirmNewPassword">Confirm New Password:</label>  
	  <input name="ConfirmNewPassword" type="password" class="form-control">	
  	  <span class="help-block" style="color:red;"><?php echo $ConfirmNewPasswordErr; ?></span>  
	</div>
</div>
<input type="submit" class="btn btn-success" value="Change Password"/>

</fieldset>
</form>

<?php

include("acorn/global/account-html-footer.php");

include("acorn/global/admin-html-footer.php");
// include html footer