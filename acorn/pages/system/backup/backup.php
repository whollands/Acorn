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
  				<li role="presentation"><a href="<?php echo constant("BASE_URL"); ?>system/embed"><i class="fa fa-code"></i> Embed</a></li>
				<li role="presentation" class="active"><a href="<?php echo constant("BASE_URL"); ?>system/backup"><i class="fa fa-hdd-o"></i> Backup & Restore</a></li>
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
    <h3 class="panel-title">Backup & Restore</h3>
  </div><!-- /.panel-heading -->
  <div class="panel-body">

<p>You can make a full system backup using the button below.</p>

<p><a href="<?php echo constant("BASE_URL"); ?>system/backup/do_backup" class="btn btn-primary btn-md" style="text-align:right;"><i class="fa fa-download"></i> Download Backup</a></p>

<p>To restore a backup, execute the sql file downloaded above in your administrators console or DBMS such as phpMyAdmin.</p>

</div><!-- /.panel-body -->
</div><!-- /.panel -->
</div><!-- /.col-md-9 -->
</div><!-- /.row -->
</div><!-- /.container -->

<?php

include("acorn/global/admin-html-footer.php");
// include html footer