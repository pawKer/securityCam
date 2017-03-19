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
    <p></p>
      
      <p><iframe src="temp.html" width="640" height="500" scrolling="no" marginheight="500" marginwidth="100"></iframe></p>
      <hr>
      <h3>More features to be added soon...</h3>
      <p></p>
    </div>
    <div class="col-sm-2 sidenav">
      <div class="well">
        <p>Te-ai saturat sa ai penisul mic? Si Danut...</p>
      </div>
      <div class="well">
        <p>Te-ai saturat de kilogramele in plus? Fa 5 ani de sala intr-o vara!</p>
      </div>
    </div>
  </div>
</div>

</body>
</html>


