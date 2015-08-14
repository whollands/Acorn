<?php defined("ACORN_EXECUTE") or die("Access Denied.");

include("acorn/global/admin-html-header.php");
// include html header


$Query = "SELECT UserID, Name, Email FROM Users ORDER BY Name";
$Result = $GLOBALS["MYSQL_CON"]->query($Query);
	
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
			    <li role="presentation" class="active"><a href="<?php echo constant("BASE_URL"); ?>system/users"><i class="fa fa-users"></i> Users</a></li>
  			    <li role="presentation"><a href="<?php echo constant("BASE_URL"); ?>system/email"><i class="fa fa-envelope"></i> Email</a></li>
  				<li role="presentation"><a href="<?php echo constant("BASE_URL"); ?>system/embed"><i class="fa fa-code"></i> Embed</a></li>
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
  <div class="panel-heading clearfix">
  	<h4 class="panel-title pull-left" style="padding-top: 7.5px;"><i class="fa fa-users"></i> Users</h4>
      <div class="btn-group pull-right">
        <a href="<?php echo constant("BASE_URL"); ?>system/users/add" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> New User</a>
      </div>
  </div>
  <div class="panel-body">
  
<?php
		
if($Result->num_rows >= 1)
{
?>

<div class="row">
 <div class="col-lg-6">
    <div class="input-group">
    <form action="<?php echo constant("BASE_URL"); ?>system/users/search" method="get">
      <input type="search" name="search_term" class="form-control" placeholder="Search Users...">
    </form>
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
</div>
  
<table class="table table-hover">

<thead>
	<tr>
		<td>Name</td>
		<td>Email Address</td>
		<td>Actions</td>
	</tr>
</thead>
<tbody>
<?php
	while($row = $Result->fetch_assoc())
	{
	echo "<tr>";
	echo "<td>" . $row["Name"] . "</td>";
	echo "<td><a href=\"mailto:" . $row["Email"] . "\">" . $row["Email"] . "</a></td>";
	echo "<td>";
	echo "<a href=\"" . constant("BASE_URL") . "system/users/view/" .$row["UserID"]."\" class=\"btn btn-primary btn-xs\"><i class=\"fa fa-search\"></i> View</a>&nbsp;";
	echo "<a href=\"" . constant("BASE_URL") . "system/users/edit/" .$row["UserID"]."\" class=\"btn btn-success btn-xs\"><i class=\"fa fa-pencil\"></i> Edit</a>&nbsp;";
	echo "<a href=\"" . constant("BASE_URL") . "system/users/delete/" .$row["UserID"]."\" class=\"btn btn-danger btn-xs\"><i class=\"fa fa-trash\"></i> Delete</a>";
	echo "</td>";
	echo "</tr>";
	}
	
	?>
	
	</tbody>
</table>

	<?php
}
else
{
	echo "No clients yet.";
}
?>

</div><!-- /.panel-body -->
</div><!-- /.panel -->
</div><!-- /.col-md-9 -->
</div><!-- /.row -->
</div><!-- /.container -->

<?php

include("acorn/global/admin-html-footer.php");
// include html footer


