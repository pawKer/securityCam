<?php
/**
 * This is an example of how to authenticate a user with a University username
 * and password.
 *
 * It required the instillation of the file Authenticator.php in the same
 * directory.
 *
 * @todo The developer must edit this file to define the constant DEVELOPER_URL.
 *
 * @author Iain Hart (iain@cs.man.ac.uk)
 * @date 1st November 2013
 */

// @todo Replace the following defined constant with the URL which runs the
// program requiring authentication.
define ("DEVELOPER_URL", "http://belgrave.hopto.org/cam/login.php");
//http://studentnet.cs.manchester.ac.uk/authenticate/demonstration.php"

// Define the location of the service on the Computer Science server.
define("AUTHENTICATION_SERVICE_URL", "http://studentnet.cs.manchester.ac.uk/authenticate/");

// Define the location of CAS's logtout service on the Computer Science server.
define("AUTHENTICATION_LOGOUT_URL", "http://studentnet.cs.manchester.ac.uk/systemlogout.php");

// Locate the Authenticator class.
require_once("auth.php");

// Start a php session to store variables. This will be used to hold the ticket
// issued to the user so that when the user returns from CAS we know that
// we are interacting with the same user.

session_start();

// Uncomment this next line if study year is required but this will necessitate
// an extra query on the database so only use it if genuinely needed.
// Authenticator::requireStudyLevel();

// Validate the user.
Authenticator::validateUser();

// To invalidate a user uncomment the following. It uses header() to send the
// user to CAS's logout page on the Computer Science server. To work you must
// not have returned any output to the client before calling it.

// Authenticator::invalidateUser();
header("Location: http://belgrave.hopto.org/cam");
?>

<html>
    <head>
        <title>Authentication with University of Manchester</title>
    </head>
    <body>
      <h3>You are now authenticated with the University of Manchester<br></h3>
      <p>
You have successfully authenticated. We have the following details for you:
</p>
<ul>
<li>
You authenticated at
<?php
$timestamp = Authenticator::getTimeAuthenticated();
echo date("l jS F Y H:i:s", $timestamp);
?>
</li>

<li>
Your username is
<?php
  $user_name = Authenticator::getUsername();
  $_SESSION["uni_id"] = $user_name;
  $_SESSION["logged_in"] = 1;
echo $user_name;
?>
</li>

<li>
Your full name is
<?php
$full_name = Authenticator::getFullName();
$_SESSION["name"] = $full_name;
echo $full_name;
?>
</li>

<li>
Your user category is
<?php
$category = Authenticator::getUserCategory();
echo $category;
?>
</li>

<li>
Your department is
<?php
$deparment = Authenticator::getUserDepartment();
echo $deparment;
?>
</li>

<li>
Your study level is -->
<?php
$study_Level = Authenticator::getStudyLevel();
echo $study_Level;
?>
</li>

            <p> If you want to logout, click <a href="http://belgrave.hopto.org/cam/logout.php">here</a>.</p>
        </ul>
<?php

        //Do not forget that each variable is of type string
        if ($study_Level != '02' && $category != 'student'
            && $deparment != 'School of Computer Science')
        {
          echo "Hello second year CS student";
        }
        else
        {
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
            $isInDataBase = FALSE;
	    $mysqli->query("USE cam_users");
            //Add a new entry to the database if not already in the database
            foreach ($mysqli->query("SELECT uni_id FROM users") as $row)
            {
              if ($row['uni_id'] == $user_name)
              {
                echo "Already in database";
                $mysqli->query("USE cam_users");
		$mysqli->query("UPDATE users SET logged_in = '1' WHERE uni_id = '$user_name'");
		$isInDataBase = TRUE;
              }
            }
            if (!$isInDataBase)
            {
              $sql1 = "USE cam_users";
              $sql2 = "INSERT INTO users(id, uni_id, name, logged_in)
              VALUES ('','$user_name', '$full_name', '1')";
              if($mysqli->query($sql1) === TRUE && $mysqli->query($sql2) === TRUE)
              {
              	echo "New record created successfully<br>";
              }
              else
              {
              	echo "Error: " . $sql . "<br>" . $mysqli->error;
              }
            }
          }

              $mysqli -> close();
        }
        ?>      


    </body>
</html>
