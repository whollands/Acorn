<?php defined("ACORN_EXECUTE") or die("Access Denied.");

include("acorn/global/admin-html-header.php");

?>

<div class="container">

<h1>SQL Error</h1>

<div class="alert alert-warning" role="alert">
	<i class="fa fa-warning"></i>
	Sorry, an error occurred when executing a command to the database
</div>
<br>

<h4>Server returned the following error:</h4>

<pre><?php echo $SQL_Error_Output; ?></pre>

</div>

<?php

include("acorn/global/admin-html-footer.php");