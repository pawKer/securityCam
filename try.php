<html>
<head>
  <title>
    Login | Help Me Out
  </title>
 

  <link rel="icon" href=""/>
</head>

<body>
<div id="logincol">

  <form id="loginForm" class="login" action="login.php" method="post" autocomplete="off" onclick="">

    <div class="box" id="loginBox">

      <div class="username">
        <label for="username">Username:</label>
        <input id="username" name="username" class="required" tabindex="1" accesskey="n" type="text" value="" size="25" autocomplete="off"/>
      </div>

      <!--Password input box-->
      <div class="password">
        <label for="password">Password:</label>
        <input id="password" name="password" class="required" tabindex="2" accesskey="p" type="password" value="" size="25" autocomplete="off"/>
      </div>


      <!--submit button-->
      <div class="button">
        <input class="submit" name="submit" accesskey="l" value="submit" tabindex="4" type="submit" />
      </div>

      <!--"Remember me" checkbox-->
      <div class="checkbox">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>

  </form>

<?php
// Load the configuration file containing your database credentials
require_once('config.inc.php');

// Connect to the database
$mysqli = new mysqli($database_host, $database_user, $database_pass, $group_dbnames[0]);
// Check for errors before doing anything else
if($mysqli -> connect_error) {
    die('Connect Error ('.$mysqli -> connect_errno.') '.$mysqli -> connect_error);
}
else
{

   //Variables to use in the conditional statements
  $x = $_POST["username"];
  $y = $_POST["password"];

  $nameToStore = "";
  $passwordToStore = "";
  if(empty($x)==1 || empty($y)==1)
  {
  	echo "Name must be written and password too<br>";

  	//Function from w3schools
  }elseif((preg_match( '/^[A-Za-z]*$/' , $x))==1 and
          (preg_match( '/^[A-Za-z]*$/' , $y))==1)
    {

      //Function from the MySql testing if we have a database
      $sql = "SELECT name, password FROM HelpMeOutUsers";
      $result = $mysqli->query($sql);
      echo "Pass the stage of checking<br>";

      if ($result->num_rows > 0)
      {

        //Comparing with heach of the variables of the row
        //Function from w3schools
        while($row = $result->fetch_assoc())
        {
          if(($row["name"]===$x) && ($row["password"]===$y))
          {
  	         echo "Hi, you're already in out database<br>";
          }
          else
          {
            $nameToStore = $x;
            $passwordToStore = sha1($y);
            echo "It finally worked<br>";
          }
        }
       }
       else
       {
         echo "<h3>Not valid name or password</h3>";
       }
     }
     else
     {
       echo "<h3>Not valid name or password</h3>";
     }
}

//Storing the new values in the databasa
/*
if(!((empty($nameToStore)==1) || (empty($passwordToStore)==1)))
{
  $sql = "INSERT INTO HelpMeOutUsers (name , password)
  VALUES ('$nameToStore' , '$passwordToStore')";
  echo "It worked completely<br>";
}
else
{
echo "Ok this might be an issue";
}

//Test if the new entry was created or not
if($mysqli->query($sql) === TRUE)
{
	echo "New record created successfully<br>";
}/*else{
	echo "Error: " . $sql . "<br>" . $mysqli->error;
	}*/

// SELECT ALL THE THINGS
//Checking the data has not been overwritten and that our entries are now updated, the number of rows has been added one
if($result = $mysqli -> query("SELECT * FROM HelpMeOutUsers"))
{
    printf("Number of people already in the database %d .\n", $result -> num_rows);

    $result -> close(); // Remember to release the result set
}

// Always close your connection to the database cleanly!
$mysqli -> close();
?>

<p>
Here it ends
</p>
*/
<!-- text under the login box -->
<!-- reminding users that the username and password are same as the university login one -->
<!-- and if forgot the password, there is a link to the university password forgotton page -->
<div id="reminder" title="Password Forgotten">
  <p>These details are the same as those you login to <a href="https://login.manchester.ac.uk/cas/login?service=https%3A%2F%2Fmy.manchester.ac.uk%2F"> myManchester </a> with.
</div>
<div class="row">
<a href="https://iam.manchester.ac.uk/recovery_login/overview?service=">Forgotten your password?</a>
</div>


<!--pop up window to show the web is processing-->
</body>
</html>
<html>
  <head>
    <title>Hello</title>
	<link rel="stylesheet" href="greetings1.css">
  </head>
<body>
  <h2>Test server</h2>

</body>
</html>
