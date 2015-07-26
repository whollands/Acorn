<?php defined("ACORN_EXECUTE") or die("Access Denied.");

include("acorn/global/admin-html-header.php");
// include html header

	
?>

<div class="container">


<h1><i class="fa fa-hdd-o"></i> Backup</h1>



<p>You can make a full system backup using the button below.</p>

<a href="<?php echo constant("BASE_URL"); ?>system/backup/do_backup" class="btn btn-primary btn-md" style="text-align:right;"><i class="fa fa-download"></i> Download Backup</a>


<h1><i class="fa fa-undo"></i> Restore</h1>

<p>To restore a backup, execute the sql file downloaded above in your administrators console or DBMS such as phpMyAdmin.</p>

</div>

<?php

include("acorn/global/admin-html-footer.php");
// include html footer