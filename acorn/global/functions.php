<?php defined("ACORN_EXECUTE") or die("Access Denied.");


function Check_Auth_User()
{
	if($_SESSION["ACORN_LOGIN"] != true)
	{
		header("Location: " . constant("BASE_URL") . "login");
		exit;
	}
}


function CleanID($ID) {
return preg_replace("/[^0-9]/", rand(000,999), $ID);
}


function CleanData($Data) {
	$Data = trim($Data);
	$Data = stripslashes($Data);
  	$Data = htmlspecialchars($Data);
  	return $Data;
}

function ParsePath() {
  $path = array();
  if (isset($_SERVER['REQUEST_URI'])) {
    $request_path = explode('?', $_SERVER['REQUEST_URI']);

    $path['base'] = rtrim(dirname($_SERVER['SCRIPT_NAME']), '\/');
    $path['call_utf8'] = substr(urldecode($request_path[0]), strlen($path['base']) + 1);
    $path['call'] = utf8_decode($path['call_utf8']);
    if ($path['call'] == basename($_SERVER['PHP_SELF'])) {
      $path['call'] = '';
    }
    $path['call_parts'] = explode('/', $path['call']);

    $path['query_utf8'] = urldecode($request_path[1]);
    $path['query'] = utf8_decode(urldecode($request_path[1]));
    $vars = explode('&', $path['query']);
    foreach ($vars as $var) {
      $t = explode('=', $var);
      $path['query_vars'][$t[0]] = $t[1];
    }
  }
return $path;
}

?>