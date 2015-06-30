<?php defined("ACORN_EXECUTE") or die("Access Denied.");

if($_SESSION["ACORN_LOGIN"] == true)
{
	header("Location: " . constant("BASE_URL") . "dashboard");
	exit;
}

if(isset($_POST["email"]) || isset($_POST["password"]))
{

	function hash_password($GivenPassword, $Email)
	{
		$Query = "SELECT Email, Password, Salt FROM Users WHERE Email='$Email'";
		$Result = $GLOBALS["MYSQL_CON"]->query($Query);
		
		if($Result->num_rows == 1)
		{
			$row = $Result->fetch_assoc();
			return md5(constant("MASTER_SALT") . $GivenPassword . $row["Salt"]);
		}
		else
		{
			return "";
		}
	}
	
	$Email = strtolower($_POST["email"]);
	$Password = hash_password($_POST["password"], $Email);
	
	$Query = "SELECT UserID, Name, Email, Password FROM Users WHERE Email='$Email' AND Password='$Password'";
	$Result = $GLOBALS["MYSQL_CON"]->query($Query);

	if($Result->num_rows == 1)
	{
		$UserRow = $Result->fetch_assoc();
		// asign rows to array
	
		$_SESSION["ACORN_LOGIN"] = true;
		$_SESSION["ACORN_USER_NAME"] = $UserRow["Name"];
		
		if($_POST["remember-me"] == true)
		{
			$Token = md5(uniqid(rand(), true));
			$IP = $_SERVER['REMOTE_ADDR'];
			$UserAgent = $_SERVER["HTTP_USER_AGENT"];
			$Timestamp = date("Y-m-d H:i:s");
			$UserID = $UserRow["UserID"];
			
			setcookie("AUTH_TOKEN", $Token, time() + (3600 * 24 * 7 * 4));
			// set cookie for 1 month?
			
			$stmt = $GLOBALS["MYSQL_CON"]->prepare("INSERT INTO UserSessions VALUES (DEFAULT,?,?,?,?,?)");
			$stmt->bind_param("sssss", $UserID, $Token, $UserAgent, $IP, $Timestamp);
			$stmt->execute();
			$stmt->close();
			// insert into database.
		}
		
			header("Location: "  . constant("BASE_URL") . "dashboard");
			exit;
		

	}
	else
	{
		$_SESSION["ACORN_AUTH_ERROR"] = true;
		header("Location: " . constant("BASE_URL") . "login");
		exit;
	}

}

?><!DOCTYPE html>
<html lang="en">
  <head>
  <!--
  
  	(c) Will Hollands 2015
  	
  	-->
  	
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="author" content="Will Hollands">
    <link rel="apple-touch-icon" href="<?php echo constant("ROOT_URL"); ?>acorn/images/Acorn_App_Icon.png">
    <link rel="icon" href="../../favicon.ico">

    <title>Sign In :: Acorn</title>
    
    <style>
    
body {
  padding-top: 40px;
  padding-bottom: 40px;
  background: #eee;
}

.form-signin {
  max-width: 330px;
  padding: 15px;
  margin: 0 auto;
}
.form-signin .form-signin-heading,
.form-signin .checkbox {
  margin-bottom: 10px;
}
.form-signin .checkbox {
  font-weight: normal;
}
.form-signin .form-control {
  position: relative;
  height: auto;
  -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
          box-sizing: border-box;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}


</style>

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

    <div class="container">

      <form method="post" action="<?php echo constant("BASE_URL"); ?>login" class="form-signin">
        <h2 class="form-signin-heading text-center"><span style="color:#6E8F26;font-weight:bold;">Acorn</span> Sign-In</h2>
        <label for="email" class="sr-only">Email address</label>
        <input type="email" name="email" class="form-control" placeholder="Email address" required autofocus>
        <label for="password" class="sr-only">Password</label>
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" name="remember-me" value="true" checked> Remember me for 30 days
          </label>
        </div>
        <button class="btn btn-lg btn-success btn-block" type="submit">Sign In</button>
      </form>
<?php

if($_SESSION["ACORN_AUTH_ERROR"] == true)
{
	echo "<p style=\"color:red;text-align:center;\">Invalid email or password</p>";
	$_SESSION["ACORN_AUTH_ERROR"] = false;
}

?>
    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php echo constant("ROOT_URL"); ?>acorn/bootstrap/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>

