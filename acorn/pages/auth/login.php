<?php defined("ACORN_EXECUTE") or die("Access Denied.");

include("acorn/global/LoginFunctions.php");

if($_SESSION["ACORN_LOGIN"] == true)
{
	header("Location: " . constant("BASE_URL") . "dashboard");
	exit;
}

if(isset($_POST["Email"]) || isset($_POST["Password"]))
{

$Password = $_POST["Password"];
$Email = $_POST["Email"];

	if($stmt = $GLOBALS["MYSQL_CON"]->prepare("SELECT UserID, Name, Email, Password, Salt FROM Users WHERE Email=? LIMIT 1")) 
	{
        $stmt->bind_param('s', $Email);  // Bind "$email" to parameter.
        $stmt->execute();    // Execute the prepared query.
        $stmt->store_result();
 
        // get variables from result.
        $stmt->bind_result($UserID, $Name, $Email, $DbPassword, $Salt);
        $stmt->fetch();
 
        // hash the password with the unique salt.
        $Password = md5(constant("MASTER_SALT") . $Password . $Salt);
        
        if ($stmt->num_rows == 1) {
            // If the user exists we check if the account is locked
            // from too many login attempts 
 
            if (CheckFailedAttempts($UserID, $GLOBALS["MYSQL_CON"]) == true) {
                // Account is locked 
                // Send an email to user saying their account is locked
                
                $_SESSION["ACORN_CAPACHA_REQUIRED"] = true;
            	header("Location: "  . constant("BASE_URL") . "login");
				exit;
                
            } else {
                // Check if the password in the database matches
                // the password the user submitted.
                if ($DbPassword == $Password) {
                	
                	$_SESSION["ACORN_LOGIN"] = true;
					$_SESSION["ACORN_USER_NAME"] = $Name;
					$_SESSION["ACORN_USER_ID"] = CleanID($UserID);
                	
                	/*
                    // Password is correct!
                    // Get the user-agent string of the user.
                    $user_browser = $_SERVER['HTTP_USER_AGENT'];
                    // XSS protection as we might print this value
                    $user_id = preg_replace("/[^0-9]+/", "", $user_id);
                    $_SESSION['user_id'] = $user_id;
                    // XSS protection as we might print this value
                    $username = preg_replace("/[^a-zA-Z0-9_\-]+/", 
                                                                "", 
                                                                $username);
                    $_SESSION['username'] = $username;
                    $_SESSION['login_string'] = hash('sha512', 
                              $password . $user_browser);
                              */
                    
                    if($_SESSION["ACORN_AUTH_RETURN"] == null)
                    {
           	 		header("Location: "  . constant("BASE_URL") . "dashboard");
					exit;
					}
					else
					{
					header("Location: " . $_SESSION["ACORN_AUTH_RETURN"]);
					exit;
					}
				
                } else {
                    // Password is not correct
                    // We record this attempt in the database
                    $now = date('Y-m-d H:i:s');
                    $GLOBALS["MYSQL_CON"]->query("INSERT INTO UserLoginAttempts (UserID, DateTime) VALUES ('$UserID', '$now')");
                    
                    $_SESSION["ACORN_AUTH_ERROR"] = true;
            		header("Location: "  . constant("BASE_URL") . "login");
					exit;
                }
            }
        } else {
            
            $_SESSION["ACORN_AUTH_ERROR"] = true;
            header("Location: "  . constant("BASE_URL") . "login");
			exit;
            
        }
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
        <label for="Email" class="sr-only">Email address</label>
        <input type="email" name="Email" class="form-control" placeholder="Email address" required autofocus>
        <label for="Password" class="sr-only">Password</label>
        <input type="password" name="Password" class="form-control" placeholder="Password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" name="remember-me" value="true" checked> Remember me for 30 days
          </label>
        </div>
        <button class="btn btn-lg btn-success btn-block" type="submit">Sign In</button>
      </form>
<p style="text-align:center;">You will be returned to <?php
 echo $_SESSION["ACORN_AUTH_RETURN"];
 ?></p>
 
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

