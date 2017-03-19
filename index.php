<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html lang="en">
<head>
  <title>Belgrave Security Camera</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 450px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      height: 100%;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }

    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;} 
    }
  </style>
</head>
<body>
<?php 
require_once("auth.php");
//Authenticator::validateUser();
session_start(); 

?>

  
<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-2 sidenav">
           
      <p><h3><?php 
      if(isset($_SESSION["authenticated"]))
      {
      echo "Hello, " . $_SESSION["fullname"] . " !"; }
      else
	{
		echo "<a href='login.php'> Login</a>" ;
       }?></h3></p>
      
            
     <p>
        <?php
	if(isset($_SESSION["authenticated"]))
	echo "<a href='logout.php'>Logout</a>"; ?></p> 
   </div>
    <div class="col-sm-8 text-left">
      <center>
      <h1>Belgrave Security Camera 01</h1>
      <?php
      if(isset($_SESSION["authenticated"]))
      {

	echo "<p><img src='http://belgrave.hopto.org:48461' /></p>";
      }      
	else
	{
		echo "<h3 style='color:red'>You must be logged in to view the stream</h3>";
	}
	?>
    <p><div id="rt-0e6fb924b593606fb0dd2c223b00cccc"></div><script src="https://www.rumbletalk.com/client/?4:-e4iDj&2"></script></p>
      
      <p><iframe src="temp.html" width="640" height="500" scrolling="no" marginheight="500" marginwidth="100"></iframe></p>
      <hr>
      <h3>More features to be added soon...</h3>
      <p></p>
    </div>
    <div class="col-sm-2 sidenav">
     <h3>Sponsored ads</h3> 
     <div class="well">
        <p>Tired of walking to school everyday? Stop being poor...</p>
      </div>
      <div class="well">
        <p>Need a new phone? Me too...</p>
      </div>
      <div class="well">
	<h3> Users watching : </h3>
	<?php 
	require_once('config.inc.php');

          // Connect to the database
          $mysqli = new mysqli($database_host, $database_user, $database_pass);

          // Check for errors before doing anything else
          if($mysqli -> connect_error)
          {
              die('Connect Error ('.$mysqli -> connect_errno.') '.$mysqli -> connect_error);
          }

	    $mysqli->query("USE cam_users");
            //Add a new entry to the database if not already in the database
            $shots = $mysqli->query("SELECT *  FROM users");
	    foreach( $shots as $row)
            {
 		$name = $row['name'];
              if ($row['logged_in'] == '1')
              {
                echo "<p>$name</p>";
              }
            }

	?>
	</div>
    </div>
  </div>
</div>

</body>
</html>


