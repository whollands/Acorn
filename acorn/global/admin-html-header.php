<?php defined("ACORN_EXECUTE") or die("Access Denied.");


$CurrentPage = basename($_SERVER["SCRIPT_NAME"], ''); 

?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo constant("ROOT_URL"); ?>acorn/images/Acorn_Logo_Icon.png">
    <link rel="apple-touch-icon" href="<?php echo constant("ROOT_URL"); ?>acorn/images/Acorn_App_Icon.png">

    <title>Admin Panel :: Acorn</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo constant("ROOT_URL"); ?>acorn/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" type="text/css" href="http://cdn.hollands123.com/font-awesome/4.3.0/css/font-awesome.min.css"/>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>


  <body>

    <nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" target="_blank" href="https://github.com/whollands/Acorn-Appointments/" style="color:#6E8F26;font-weight:bold;">Acorn</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
      	<li<?php if($PathInfo['call_parts'][1] == "bookings") { echo " class=\"active\" "; } ?>><a href="<?php echo constant("BASE_URL"); ?>dashboard/bookings"><i class="fa fa-book"></i>&nbsp;Bookings</a></li>
        <li<?php if($PathInfo['call_parts'][1] == "calendar") { echo " class=\"active\" "; } ?>><a href="<?php echo constant("BASE_URL"); ?>dashboard/calendar"><i class="fa fa-calendar"></i>&nbsp;Calendar</a></a></li>
        <li<?php if($PathInfo['call_parts'][1] == "clients") { echo " class=\"active\" "; } ?>><a href="<?php echo constant("BASE_URL"); ?>dashboard/clients"><i class="fa fa-users"></i>&nbsp;Clients</a></li>
        <li<?php if($PathInfo['call_parts'][1] == "services") { echo " class=\"active\" "; } ?>><a href="<?php echo constant("BASE_URL"); ?>dashboard/services"><i class="fa fa-tags"></i>&nbsp;Services</a></li>
      </ul>
      
     
      <ul class="nav navbar-nav navbar-right">
      	<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-server"></i>&nbsp;Admin <span class="caret"></span></a>
          <ul class="dropdown-menu">
          	<li><a href="<?php echo constant("BASE_URL"); ?>system/users"><i class="fa fa-users"></i> Users</a></li>
          	<li><a href="<?php echo constant("BASE_URL"); ?>system/backup"><i class="fa fa-hdd-o"></i> Backup & Restore</a></li>
          	<li><a href="<?php echo constant("BASE_URL"); ?>system/email"><i class="fa fa-envelope-o"></i> Email Customisation</a></li>
            <li><a href="<?php echo constant("BASE_URL"); ?>system/settings"><i class="fa fa-gears"></i> System Settings</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i>&nbsp;<?php echo $_SESSION["ACORN_USER_NAME"]; ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo constant("BASE_URL"); ?>account"><i class="fa fa-pencil"></i> Edit account</a></li>
            <li><a href="https://github.com/whollands/Acorn-Appointments/wiki" target="_blank"><i class="fa fa-question-circle"></i> Support</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="<?php echo constant("BASE_URL"); ?>logout"><i class="fa fa-sign-out"></i> Sign Out</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
