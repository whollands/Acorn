<?php defined("ACORN_EXECUTE") or die("Access Denied.");

?>

<!-- Modal -->
<div class="modal fade" id="aboutAcorn" tabindex="-1" role="dialog" aria-labelledby="aboutAcornLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><img src="<?php echo constant("ROOT_URL"); ?>acorn/images/Acorn_Small.png"/> About Acorn</h4>
      </div>
      <div class="modal-body">
      
      	<p>Designed, built and coded by <a href="http://hollands123.com" target="_blank">Will Hollands</a> in the UK</p>
       	<p>With 3rd party sources:</p>
       	<ul>
       		<li><a href="http://getbootstrap.com/" target="_blank">Bootstrap</a></li>
       		<li><a href="http://fortawesome.github.io/Font-Awesome/" target="_blank">Font Awesome Icons</a></li>
       		<li><a href="http://github.com/PHPGangsta/GoogleAuthenticator" target="_blank">PHPGangsta GoogleAuthenticator</a></li>
       		<li><a href="#" target="_blank">Calendar API</a></li>
       		<li><a href="http://developers.google.com/" target="_blank">Google APIs</a></li>
       		<li><a href="http://ckeditor.com/" target="_blank">CKEditor</a></li>
       	</ul>
       	
		<h4>Get Support</h4>
		<p>For help articles, and set-up guides see<br><a href="http://github.com/whollands/Acorn/wiki" target="_blank">http://github.com/whollands/Acorn/wiki</a></p>
		
		<h4>Bug Reporter</h4>
		<p>To report a bug or issue visit<br><a href="http://github.com/whollands/Acorn/issues" target="_blank">http://github.com/whollands/Acorn/issues</a></p>
		      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="<?php echo constant("ROOT_URL"); ?>acorn/bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>

