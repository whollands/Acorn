<?php defined("ACORN_EXECUTE") or die("Access Denied.");

include("acorn/global/admin-html-header.php");

?>

<div class="container">

<h1>SQL Error</h1>

<div class="alert alert-warning" role="alert">
	<i class="fa fa-warning"></i>
	An error occurred
</div>
<br>

<h4>An error occurred whilst trying run Acorn:</h4>

<pre><?php echo $ErrorMessage; ?></pre>

</div>

<?php

include("acorn/global/admin-html-footer.php");