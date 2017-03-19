<html>
<head>
</head>
<body>
<?php
// Define the location of CAS's logtout service on the Computer Science server.
define("AUTHENTICATION_LOGOUT_URL", "http://belgrave.hopto.org/cam");
require_once("auth.php");
session_start();
 // Load the configuration file containing your database credentials
          require_once('config.inc.php');

          // Connect to the database
          $mysqli = new mysqli($database_host, $database_user, $database_pass);

          // Check for errors before doing anything else
          if($mysqli -> connect_error)
          {
              die('Connect Error ('.$mysqli -> connect_errno.') '.$mysqli -> connect_error);
          }
          else
          {
	     $username = $user_name = Authenticator::getUsername();
	     $mysqli->query("USE cam_users");
             $mysqli->query("UPDATE users SET logged_in = '0' WHERE uni_id = '$username'");
	  }
    
Authenticator::invalidateUser();


?>
</body>
</html>
