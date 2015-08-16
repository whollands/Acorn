<?php defined("ACORN_EXECUTE") or die("Access Denied.");

include("acorn/global/admin-html-header.php");
// include html header

	
?>

<div class="container">

<div class="row">
	<div class="col-md-3">
		<div class="panel panel-default">
  			<div class="panel-heading">
    			<h3 class="panel-title">System</h3>
  			</div>
  		<div class="panel-body">
   
			<ul class="nav nav-pills nav-stacked">
			    <li role="presentation"><a href="<?php echo constant("BASE_URL"); ?>system/users"><i class="fa fa-users"></i> Users</a></li>
  			    <li role="presentation"><a href="<?php echo constant("BASE_URL"); ?>system/email"><i class="fa fa-envelope"></i> Email</a></li>
  				<li role="presentation" class="active"><a href="<?php echo constant("BASE_URL"); ?>system/embed"><i class="fa fa-code"></i> Embed</a></li>
				<li role="presentation"><a href="<?php echo constant("BASE_URL"); ?>system/backup"><i class="fa fa-hdd-o"></i> Backup & Restore</a></li>
				<li role="presentation"><a href="<?php echo constant("BASE_URL"); ?>system/settings"><i class="fa fa-gears"></i> Settings</a></li>
			</ul>
  		</div><!-- /.panel-body -->
	</div><!-- /.panel -->
	
	<a href="http://github.com/whollands/Acorn" class="btn btn-block btn-default"><i class="fa fa-github"></i> Github Project Page &rarr;</a>

<br>
	</div><!-- /.col-md-3 -->

	<div class="col-md-9">

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Embed</h3>
  </div><!-- /.panel-heading -->
  <div class="panel-body">

<?php
$EmbedURL = constant("DOMAIN") . "book/";

?>
<p>You can embed widgets within your site to the Acorn application. Select the HTML element in your website editor or CMS and paste in some code from below:</p>
<h4>Direct URL:</h4>
<p><a href="<?php echo $EmbedURL; ?>" target="_blank"><?php echo $EmbedURL; ?></a>

<h4>HTML Button:</h4>
<div class="row">
	<div class="form-group col-md-8">
		<textarea class="form-control" rows="4" onClick="this.setSelectionRange(0, this.value.length)">[<a href="<?php echo $EmbedURL; ?>" target="_blank">Book Now</a>]</textarea>
	</div>
</div>

<h4>Fixed-width iFrame:</h4>
<div class="row">
	<div class="form-group col-md-8">
		<textarea class="form-control" rows="4" onClick="this.setSelectionRange(0, this.value.length)"><iframe width="500" height="400" frameborder="0" src="<?php echo $EmbedURL; ?>"></iframe>
		</textarea>
	</div>
</div>

<h4>Responsive Bootstrap iFrame:</h4>
<div class="row">
	<div class="form-group col-md-8">
		<textarea class="form-control" rows="4" onClick="this.setSelectionRange(0, this.value.length)"><div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="<?php echo $EmbedURL; ?>"></iframe></div>
		</textarea>
	</div>
</div>



</div><!-- /.panel-body -->
</div><!-- /.panel -->
</div><!-- /.col-md-9 -->
</div><!-- /.row -->
</div><!-- /.container -->

<?php include("acorn/global/admin-html-footer.php");
// include html footer