<?php defined("ACORN_EXECUTE") or die("Access Denied.");

include("acorn/global/admin-html-header.php");
// include html header

$UserID = CleanID($_SESSION["ACORN_USER_ID"]);

$Query = "SELECT * FROM UserSessions WHERE UserID='$UserID' ORDER BY Created";
$Result = $GLOBALS["MYSQL_CON"]->query($Query);
	
?>

<div class="container">

<?php
define("Panel_Title", "Notifications");
include("acorn/global/account-html-header.php");
?>

<div class="alert alert-info" role="alert"><i class="fa fa-info-circle"></i> This has not been implemented in Version 1.0 Alpha</div>


<div class="checkbox">
  <label>
    <input type="checkbox" value="">
    When a new booking is made
  </label>
</div>

<div class="checkbox">
  <label>
    <input type="checkbox" value="">
    Summary of each day
  </label>
</div>

<div class="checkbox">
  <label>
    <input type="checkbox" value="">
    When a new client joins
  </label>
</div>

<div class="checkbox">
  <label>
    <input type="checkbox" value="">
    When service details are edited
  </label>
</div>

<div class="checkbox">
  <label>
    <input type="checkbox" value="">
    When a date is added or removed
  </label>
</div>

<input type="submit" class="btn btn-success" value="Update Settings"/>

<?php

include("acorn/global/account-html-footer.php");
?>
</div>
<?php
include("acorn/global/admin-html-footer.php");
// include html footer