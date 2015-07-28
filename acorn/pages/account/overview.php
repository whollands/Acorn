<?php defined("ACORN_EXECUTE") or die("Access Denied.");


$ActiveUserID = CleanID($_SESSION[""]);

$Query = "SELECT * FROM Users";
$Result = $GLOBALS["MYSQL_CON"]->query($Query);

if($Result->num_rows != 1)
{
	die("Error: There are multiple or no users with the User ID: #" . $ActiveUserID);
}

$UserRow = $Result->fetch_assoc();

include("acorn/global/admin-html-header.php");
// include html header
?>

<div class="container">

<p>&nbsp;</p>

<div class="col-md-4"></div>

<div class="row col-md-4 text-center">
	<img class="img-rounded" src="http://gravatar.com/avatar/<?php echo md5($UserRow["Email"]); ?>?s=100"/>

<h2 class="text-center"><?php echo $UserRow["Name"]; ?></h2>

<p><a href="mailto:<?php echo $UserRow["Email"]; ?>"><?php echo $UserRow["Email"]; ?></a></p>

<p class="text-center">Member Since <?php echo date('jS F Y', strtotime($UserRow["Joined"])); ?></p>

<div class="list-group">
  <a href="<?php echo constant("BASE_URL"); ?>account/edit" class="list-group-item"><i class="fa fa-pencil"></i> Edit account</a>
  <a href="<?php echo constant("BASE_URL"); ?>account/password" class="list-group-item"><i class="fa fa-lock"></i> Change password</a>
  <a href="http://gravatar.com/" class="list-group-item"><i class="fa fa-picture-o"></i> Change profile picture</a>
  <a href="<?php echo constant("BASE_URL"); ?>logout" class="list-group-item"><i class="fa fa-sign-out"></i> Sign Out</a>
</div>

</div>

<div class="col-md-4"></div>

</div><!-- /.container -->

<?php

include("acorn/global/admin-html-footer.php");
// include html footer