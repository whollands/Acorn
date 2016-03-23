<?php defined("ACORN_EXECUTE") or die("Access Denied.");

if ($_SERVER["REQUEST_METHOD"] == "POST") {


$AllClear = 0;

  if (empty($_POST["Name"])) {
    $NameErr = "Service name is required";
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

$Key = RandomToken();
$EmailMD5 = md5($Email);

$Query = "INSERT INTOafsd Clients VALUES (DEFAULT, '$Name', '$Email', '$EmailMD5', '$Phone', '$Notes', '$Key')";

if (mysqli_query($GLOBALS["MYSQL_CON"], $Query)) {
   
   $InfoMsg = SuccessMessage("Service added successfully!");
   
} else {
	$InfoMsg = WarningMessage("An SQL Database error occurred");
}
}
  
}

include("acorn/global/admin-html-header.php");
// include html header
?><div class="container">

<div class="panel panel-default">
  <div class="panel-heading">
  	<h4 class="panel-title"><i class="fa fa-tags"></i> New Service</h4>
  </div>
<div class="panel-body">

<?php echo $InfoMsg; ?>

<form action="<?php echo constant("BASE_URL"); ?>dashboard/clients/add" method="post">

<!-- Text input-->
<div class="row">
	<div class="form-group col-md-6">
	  <label for="Name">Client Name:</label>  
	  	<input name="Name" type="text" value="<?php echo $Name; ?>" placeholder="John Doe" class="form-control" required>
		<span class="help-block" style="color:red;"><?php echo $NameErr; ?></span> 
	</div>
</div><!-- /.row -->

<div class="row">
	<div class="form-group col-md-6">
	  <label for="Email">Email Address:</label>  
	 	<input name="Email" type="email" value="<?php echo $Email; ?>" placeholder="someone@example.com" class="form-control" required>
	    <span class="help-block" style="color:red;"><?php echo $EmailErr; ?></span> 
	</div>
</div><!-- /.row -->

<div class="row">
	<div class="form-group col-md-6">
	  <label for="Phone">Phone Number:</label>  
	  	<input name="Phone" type="phone" value="<?php echo $Phone; ?>" placeholder="+44 1234 567 890" class="form-control" required>
	  	<span class="help-block" style="color:red;"><?php echo $PhoneErr; ?></span>   
	</div>
</div><!-- /.row -->

<div class="row">
	<div class="form-group col-md-6">
	  <label for="Notes">Notes:</label>                  
	    <textarea rows="4" class="form-control" value="<?php echo $Notes; ?>" placeholder="Other names, details etc." name="Notes" required><?php echo $Notes; ?></textarea>
	    <span class="help-block" style="color:red;"><?php echo $NotesErr; ?></span> 
	</div>
</div><!-- /.row -->

<button type="submit" class="btn btn-success">Add Client</button>

</form>

</div><!-- /.panel-body -->
</div><!-- /.panel -->
</div><!-- /.container -->
<?php include("acorn/global/admin-html-footer.php");
// include html footer