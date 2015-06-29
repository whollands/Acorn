<?php

session_start();

include("includes/config.php");
// contains mysql details, title etc.

include("includes/functions.php");
// password hashing, login check etc.

check_user_login("profile.php", "redirect");
// check user login, and redirect to page defined above

define("page_title", "Edit my profile");
// page title to be echoed in header file

$uid = $_SESSION["panel_uid"];
$username = $_SESSION["panel_username"];

$query = mysqli_query($con, "SELECT * FROM users WHERE id='".$uid."' AND username='".$username."'");

$count = $query->num_rows;

if($count == 0)
{
	die("<p style=\"color:red;\">Error, this user does not exist!</p>");
}
else if($count > 1)
{
	die("<p style=\"color:red;\">Error, more than one user under that name, contact admin!</p>");
}
else
{

$row = mysqli_fetch_array($query);

$profile = unserialize($row["profile"]);
// profile is serialized in row, so unseralize to array with keys

switch($row["role"])
                  	{
                  	default: $role = "<span style=\"color:purple;\">Dashboard Access</span>"; break;
                  	case 1: $role = "<span style=\"color:green;\">Basic Edit Rights</span>"; break;
                  	case 2: $role = "<span style=\"color:orange;\">Full Edit Rights</span>"; break;
                  	case 3: $role = "<span style=\"color:red;\">Administrator</span>"; break;
                  	}

$name = $profile["name"];
$email = $profile["email"];
$website = $profile["website"];
$about = $profile["about"];
$use_gravatar = $profile["use_gravatar"];

	if(isset($_POST["form_action"]))
	{
	
		if(empty($_POST["name"]))
		{ 
			$nameErr = "Name is required";
		}
		else
		{
			$name = safe_data($_POST["name"]);
			
		if(!preg_match("/^[a-zA-Z. ]*$/",$name))
			{
				$nameErr = "Letters and spaces only";
			}
			else 
			{ 
			$nameDone = 1;
			}
		}
		// end name validation

		if (empty($_POST["email"]))
     { $emailDone = 1; }
   else
     {
     $email = safe_data($_POST["email"]);
     // check if e-mail address syntax is valid
     if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email))
       {
       $emailErr = "Invalid email format"; 
       }
	   else { $emailDone = 1;}
     }
	 // end email validation
	
	$website = safe_data($_POST["website"]);
	
	if(empty($_POST["website"]))
	{
	$websiteDone = 1;
	}
	else
	{
	if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
	  $websiteErr = "Invalid URL"; 
	  $websiteDone = 0;
	}
	else
	{
		$websiteDone = 1;
	}
	}
	 
	 switch($_POST["use_gravatar"])
	 {
	 default:
	 $use_gravatar = 0;
	 break;
	 case 1;
	 $use_gravatar = 1;
	 break;
	}
	
	if(strlen($_POST["about"]) > 201)
	{
	$about = safe_data($_POST["about"]);
	$aboutErr = "Maximum of 200 characters";
	}
	else
	{
	$about = strip_tags(safe_data($_POST["about"]));
	$aboutDone = 1;
	}
	
	if($_POST["old_password"] != null || $_POST["new_password"] != null || $_POST["confirm_password"] != null)
	{
		if(strlen($_POST["new_password"]) < 8)
		{
			$passwordErr2 = "Password must be at least 8 characters long";
			$password_strong = 0;
		}
		else
		{
		$password_strong = 1;
		}
		
		if(strlen($_POST["new_password"]) < 8)
		{
			$passwordErr3 = "New password did not match the confirm field.";
			$passwords_match = 0;
		}
		else
		{
		$passwords_match = 1;
		}
		
		$query = mysqli_query($con, "SELECT username, password FROM users WHERE username='".$_SESSION["panel_username"]."'");
		
		$row = mysqli_fetch_array($query);
		
		if(hash_password($_POST["old_password"], $_SESSION["panel_username"]) != $row["password"])
		{
			$passwordErr1 = "Old password was incorrect";
			$old_password_correct = 0; 
		}
		else
		{
		$old_password_correct = 1; 
		}
		
		if($password_strong == 1 && $passwords_match == 1 && $old_password_correct == 1)
		{
		
		$new_password = hash_password($_POST["new_password"], $_SESSION["panel_username"]);
		
		$stmt = $con->prepare("UPDATE users SET password=? WHERE id=? AND username=?");
		$stmt->bind_param("sss", $new_password, $uid, $username);
		$stmt->execute();
		$stmt->close();
		$passwordDone = 1;
		
		}
	
	}
	else
	{
	$passwordDone = 1;
	}
	
	if($aboutDone == 1 && $emailDone == 1 && $nameDone == 1 && $passwordDone == 1 && $websiteDone == 1)
	{
	
		$profile["name"] = $name;
		$profile["email"] = $email;
		$profile["website"] = $website;
		$profile["about"] = $about;
		$profile["use_gravatar"] = $use_gravatar;
		
		$profile = serialize($profile);
		
		$stmt = $con->prepare("UPDATE users SET profile=? WHERE id=? AND username=?");
		$stmt->bind_param("sss", $profile, $uid, $username);
		$stmt->execute();
		$stmt->close();
	
		header("Location: profile.php?saved");
		exit;
	
	}
	else
	{
			$info = "<br><div class=\"alert alert-danger alert-dismissible\" role=\"alert\">
				  				<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
				  				<span class=\"glyphicon glyphicon-warning-sign\"></span>&nbsp;&nbsp;Please correct errors below
								</div>";
	}



	}

}	



include("includes/header.php");
// include basic header html

?><div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Edit profile</h1>
          
          <?php

if($_SERVER["QUERY_STRING"] == "saved")
{
	
	echo "<br><div class=\"alert alert-success alert-dismissible\" role=\"alert\">
	  				<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
	  				<span class=\"glyphicon glyphicon-ok\"></span>&nbsp;&nbsp;Changes saved
					</div>";

}
echo $info;

?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form-horizontal">
<input type="hidden" name="form_action" value="profile.save"/>

<fieldset>

<center>
                    <img src="<?php

if($use_gravatar == 1)
{
	$EmailHash = md5($profile["email"]);

	echo "http://gravatar.com/avatar/" . $EmailHash . "?s=200";
}
else
{
	echo constant("admin_url") . "img/default_avatar.png";
}

?>
" alt="Profile picture" width="140" height="140" border="0" class="img-circle"></a>
                    <h3 class="media-heading"><?php echo $_SESSION["panel_username"]; ?></h3>
                    <span><strong>Role: </strong></span>
                        <?php echo $role; ?>
                    </center>
                    <hr>
             

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="name">Full Name:</label>  
  <div class="col-md-5">
  <input id="name" name="name" type="text" value="<?php echo $name; ?>" class="form-control input-md">
  <span class="help-block" style="color:red;"><?php echo $nameErr; ?></span>  
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="email">Email address:</label>  
  <div class="col-md-5">
  <input id="email" name="email" type="text" value="<?php echo $email; ?>" class="form-control input-md">
  <span class="help-block" style="color:red;"><?php echo $emailErr; ?></span>  
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="email">Website:</label>  
  <div class="col-md-5">
  <input id="website" name="website" type="text" value="<?php echo $website; ?>" class="form-control input-md">
  <span class="help-block" style="color:red;"><?php echo $websiteErr; ?></span>  
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" for="textarea" value="<?php echo $about; ?>">About me:</label>
  <div class="col-md-5">                     
    <textarea class="form-control" id="about" name="about" rows="4" onkeyup="max_count(this,'about_alert',200)" placeholder="Write a few words about yourself..."><?php echo $about; ?></textarea>
    <span class="help-block" style="color:red;"><?php echo $aboutErr; ?></span>
	<span class="help-block" id="about_alert"></span>  
  </div>
</div>

<!-- Multiple Checkboxes (inline) -->
<div class="form-group">
  <label class="col-md-4 control-label" for="use_gravatar">Enable <a href="https://gravatar.com" target="_blank">gravatar.com</a></label>
  <div class="col-md-4">
    <label class="checkbox-inline" for="use_gravatar-0">
      <input type="checkbox" name="use_gravatar" id="use_gravatar-0" value="1"<?php if($use_gravatar == 1) { echo " checked"; } ?>>
      Use my Gravatar profile picture
    </label>
  </div>
</div>

<!-- Password input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="old_password">Old Password:</label>
  <div class="col-md-6">
    <input id="old_password" name="old_password" type="password" class="form-control input-md">
    <span class="help-block" style="color:red;"><?php echo $passwordErr1; ?></span>
  </div>
</div>

<!-- Password input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="new_password">New Password:</label>
  <div class="col-md-6">
    <input id="new_password" name="new_password" type="password" placeholder="" class="form-control input-md">
    <span class="help-block" style="color:red;"><?php echo $passwordErr2; ?></span>
  </div>
</div>

<!-- Password input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="confirm_password">Confirm Password:</label>
  <div class="col-md-6">
    <input id="confirm_password" name="confirm_password" type="password" placeholder="" class="form-control input-md">
    <span class="help-block" style="color:red;"><?php echo $passwordErr3; ?></span>
    <span class="help-block">Leave above password fields blank to keep your current password</span>
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="save">Save changes?</label>
  <div class="col-md-4">
    <button id="save" name="save" class="btn btn-primary">Save profile</button>
  </div>
</div>


</fieldset>
</form>

<script type="text/javascript">

function max_count(field,field2,maxlimit)
{
 var countfield =  document.getElementById(field2);
 if ( field.value.length > maxlimit ) {
  field.value =  field.value.substring( 0, maxlimit );
	document.getElementById(field).blur;
  return false;
 } else {
  var countnumber = maxlimit - field.value.length;
  var newcontent = 'You have ' + countnumber + ' characters left';
  if(field.value.length >= maxlimit)
{
  document.getElementById(field2).innerHTML = '<font color=red>' + newcontent + '</font>' ;
}
else if(field.value.length >= maxlimit - 2)
   {
   document.getElementById(field2).innerHTML = '<font color=orange>' + newcontent + '</font>' ;
    }
else
{
document.getElementById(field2).innerHTML = newcontent;
}
 }
}


</script

       
        </div>
<?php

include("includes/footer.php");
// don't forget the footer content!!

?>
        
        
      </div>
    </div>
