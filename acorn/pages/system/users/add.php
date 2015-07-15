<?php defined("ACORN_EXECUTE") or die("Access Denied.");

if ($_SERVER["REQUEST_METHOD"] == "POST") {


$AllClear = 0;

  if (empty($_POST["Name"])) {
    $NameErr = "Name is required";
  } else {
    $Name = CleanData($_POST["Name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$Name)) {
      $NameErr = "Only letters and white space allowed"; 
    } else {
    $AllClear = $AllClear + 1;
    }
  }

  if (empty($_POST["Email"])) {
    $EmailErr = "Email is required";
  } else {
    $Email = CleanData($_POST["Email"]);
    // check if e-mail address is well-formed
    if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
      $EmailErr = "Invalid email format"; 
    } else {
    $AllClear = $AllClear + 1;
    }
  }
  
  if (empty($_POST["Phone"])) {
    $PhoneErr = "Phone is required";
  } else {
    $Phone = CleanData($_POST["Phone"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[0-9+ ]*$/",$Phone)) {
      $PhoneErr = "Numbers, spaces and + only"; 
 	} else {
    $AllClear = $AllClear + 1;
    }
  }
  
  if (empty($_POST["Notes"])) {
    $Notes = "";
    $AllClear = $AllClear + 1;
  } else {
    $Notes = CleanData($_POST["Notes"]);
    if(strlen($Notes) > 350) {
    $NotesErr = "Maximum of 350 Characters";
    } else {
    $AllClear = $AllClear + 1;
    }
  }
  
if($AllClear == 4)
{

$Key = RandomKey(8);
$Query = "INSERT INTO Clients VALUES (DEFAULT, '$Name', '$Email', '$Phone', '$Notes', '$Key')";

if (mysqli_query($GLOBALS["MYSQL_CON"], $Query)) {
   header("Location: " . constant("BASE_URL") . "dashboard/clients/add/success");
} else {
	SQLError($Query);
}
}
  
}

include("acorn/global/admin-html-header.php");
// include html header
?>

<script type="text/javascript">

var keylist="FKLMNOPYZabcdefgh!-_@ijklGHIJmnoABCDEpqQRSTUVWXrstuvwxyz0123456789";
var temp=''

function RandPass(plength){
temp=''
for (i=0;i<plength;i++)
temp+=keylist.charAt(Math.floor(Math.random()*keylist.length))
return temp
}

</script>

<div class="container">

<?php

if($PathInfo['call_parts'][3] == "success")
{
?>
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <i class="fa fa-check"></i> Client added successfully
</div><?php
}
?>

<form action="<?php echo constant("BASE_URL"); ?>dashboard/clients/add" method="post" class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend>Add User</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="">Full Name:</label>  
  <div class="col-md-6">
  	<input name="Name" type="text" value="<?php echo $Name; ?>" placeholder="John Doe" class="form-control input-md" required>
	<span class="help-block" style="color:red;"><?php echo $NameErr; ?></span> 
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="Email">Email Address:</label>  
  <div class="col-md-6">
 	<input name="Email" type="email" value="<?php echo $Email; ?>" placeholder="someone@example.com" class="form-control input-md" required>
    <span class="help-block" style="color:red;"><?php echo $EmailErr; ?></span> 
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="Password">Password:</label>  
  <div class="col-md-6">
	<div class="input-group">
      <input type="text" name="Password" id="Password" class="form-control input-md"/>
      <span class="input-group-btn">
        <button class="btn btn-default" type="button" onclick="document.getElementById('Password').value=RandPass(8);"><i class="fa fa-random"></i> Random</button>
      </span>
    </div><!-- /input-group -->  	
  	<span class="help-block" style="color:red;"><?php echo $PasswordErr; ?></span>   
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="">Permissions</label>
  <div class="col-md-6">
    <select id="" name="" class="form-control">
      <option value="1">Full</option>
      <option value="2">Medium</option>
      <option value="">Low</option>
    </select>
  </div>
</div>


<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for=""></label>
  <div class="col-md-4">
    <button type="submit" class="btn btn-success">Add User</button>
  </div>
</div>

</fieldset>
</form>

</div>

<?php

include("acorn/global/admin-html-footer.php");
// include html footer