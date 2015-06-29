<?php defined("ACORN_EXECUTE") or die("Access Denied.");

include("acorn/global/admin-html-header.php");
// include html header
?>

<div class="container">

<h1 class="page-header text-center"><i class="fa fa-pencil"></i> Edit account</h1>

<?php echo $InfoMsg; ?>

<form action="" method="post" class="form-horizontal">
<input type="hidden" name="SUBMITTED_FORM" value="TRUE"/>

<fieldset>
   

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="FullName">Full Name:</label>  
  <div class="col-md-5">
  <input name="FullName" type="text" value="<?php echo $FullName; ?>" class="form-control input-md">
  <span class="help-block" style="color:red;"><?php echo $FullNameErr; ?></span>  
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="Email">Email Address:</label>  
  <div class="col-md-5">
  <input name="Email" type="Email" value="<?php echo $Email; ?>" class="form-control input-md">
  <span class="help-block" style="color:red;"><?php echo $EmailErr; ?></span>  
  </div>
</div>

<!-- Multiple Checkboxes (inline) -->
<div class="form-group">
  <label class="col-md-4 control-label" for=""></label>
  <div class="col-md-4">
    <label class="checkbox-inline" for="BookingNotification">
      <input type="checkbox" name="BookingNotification" value="1"<?php if($ServiceEnabled == 1) { echo " checked"; } ?>>
      Send me a notification when a new booking is made
    </label>
  </div>
</div>


<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="save"></label>
  <div class="col-md-4">
    <input type="submit" class="btn btn-success" value="Update Settings"/>
  </div>
</div>


</fieldset>
</form>


<?php

include("acorn/global/admin-html-footer.php");
// include html footer