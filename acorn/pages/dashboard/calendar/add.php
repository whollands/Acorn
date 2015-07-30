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
$EmailMD5 = md5($Email);

$Query = "INSERT INTO Clients VALUES (DEFAULT, '$Name', '$Email', '$EmailMD5', '$Phone', '$Notes', '$Key')";

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
<legend>Add Client</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="">Date:</label>  
  <div class="col-md-6">
  	<input name="Name" type="text" value="<?php echo $Name; ?>" placeholder="DD/MM/YYYY" class="form-control input-md" required>
	<span class="help-block" style="color:red;"><?php echo $NameErr; ?></span> 
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="selectbasic">Time:</label>
  <div class="col-md-1">
    <select id="selectbasic" name="selectbasic" class="form-control">
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
      <option value="7">7</option>
      <option value="8">8</option>
      <option value="9">9</option>
      <option value="10">10</option>
      <option value="11">11</option>
      <option value="12">12</option>
    </select>
 </div>
 <div class="col-md-1">
    <select id="selectbasic" name="selectbasic" class="form-control">
      <option value="1">00</option>
      <option value="2">05</option>
      <option value="2">10</option>
      <option value="2">15</option>
      <option value="2">20</option>
      <option value="2">25</option>
      <option value="2">30</option>
      <option value="2">35</option>
      <option value="2">40</option>
      <option value="2">45</option>
      <option value="2">50</option>
      <option value="2">55</option>
      <option value="2">60</option>
    </select>
  </div>
</div>

<!-- Multiple Checkboxes (inline) -->
<div class="form-group">
<p>Which services are available on this date?</p>
  <label class="col-md-4 control-label" for="ServiceEnabled"></label>
  <div class="col-md-4">
    <label class="checkbox-inline" for="ServiceEnabled">
      <input type="checkbox" name="ServiceEnabled" value="1"<?php if($ServiceEnabled == 1) { echo " checked"; } ?>>
      Service 1
    </label>
    <br>
    <label class="checkbox-inline" for="ServiceEnabled">
      <input type="checkbox" name="ServiceEnabled" value="1"<?php if($ServiceEnabled == 1) { echo " checked"; } ?>>
      Service 2
    </label>
    <br>
    <label class="checkbox-inline" for="ServiceEnabled">
      <input type="checkbox" name="ServiceEnabled" value="1"<?php if($ServiceEnabled == 1) { echo " checked"; } ?>>
      Service 3
    </label>
  </div>
</div>



<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for=""></label>
  <div class="col-md-4">
    <button type="submit" class="btn btn-success">Add Date</button>
  </div>
</div>

</fieldset>
</form>

</div>

<?php

include("acorn/global/admin-html-footer.php");
// include html footer