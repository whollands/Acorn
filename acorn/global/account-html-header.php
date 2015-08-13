<?php defined("ACORN_EXECUTE") or die("Access Denied.");

$AccountPage = $PathInfo['call_parts'][1];

?><div class="row">
	<div class="col-md-3">
		<div class="panel panel-default">
  			<div class="panel-heading">
    			<h3 class="panel-title">Account</h3>
  			</div>
  		<div class="panel-body">
   
			<ul class="nav nav-pills nav-stacked">
			    <li role="presentation"<?php if($AccountPage == "profile") { echo " class=\"active\" "; } ?>><a href="<?php echo constant("BASE_URL"); ?>account/profile"><i class="fa fa-user"></i> Profile</a></li>
  			    <li role="presentation"<?php if($AccountPage == "notifications") { echo " class=\"active\" "; } ?>><a href="<?php echo constant("BASE_URL"); ?>account/notifications"><i class="fa fa-bell"></i> Notifications</a></li>
  				<li role="presentation"<?php if($AccountPage == "password") { echo " class=\"active\" "; } ?>><a href="<?php echo constant("BASE_URL"); ?>account/password"><i class="fa fa-key"></i> Password</a></li>
				<li role="presentation"<?php if($AccountPage == "two_factor") { echo " class=\"active\" "; } ?>><a href="<?php echo constant("BASE_URL"); ?>account/two_factor"><i class="fa fa-mobile"></i> Two-Factor</a></li>
				<li role="presentation"<?php if($AccountPage == "sessions") { echo " class=\"active\" "; } ?>><a href="<?php echo constant("BASE_URL"); ?>account/sessions"><i class="fa fa-desktop"></i> Sessions</a></li>
			</ul>
  		</div><!-- /.panel-body -->
	</div><!-- /.panel -->
	
	<a href="<?php echo constant("BASE_URL"); ?>logout" class="btn btn-block btn-danger">Sign Out &rarr;</a>

<br>
	</div><!-- /.col-md-3 -->

	<div class="col-md-9">

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"><?php echo constant("Panel_Title"); ?></h3>
  </div><!-- /.panel-heading -->
  <div class="panel-body">