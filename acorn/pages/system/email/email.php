<?php defined("ACORN_EXECUTE") or die("Access Denied.");

include("acorn/global/admin-html-header.php");
// include html header

	
?>

<div class="container">


<h1><i class="fa fa-envelope-o"></i> Email</h1>



<p>You can customize email notification messages below.</p>


<form>
<fieldset>

<!-- Textarea -->
<div class="form-group">
	<div class="col-md-6">
  		<label class="control-label" for="">Booking Confirmation to Clients</label>          
  		<textarea class="form-control" name="" rows="8"></textarea>
	</div>
</div>

<!-- Textarea -->
<div class="form-group">
	<div class="col-md-6">
  		<label class="control-label" for="">Booking Notification to Users</label>          
  		<textarea class="form-control" name="" rows="8"></textarea>
	</div>
</div>




</fieldset>
</form>



</div>

<?php

include("acorn/global/admin-html-footer.php");
// include html footer