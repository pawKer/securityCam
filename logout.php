<html>
<head>
</head>
<body>
<?php
// Define the location of CAS's logtout service on the Computer Science server.
define("AUTHENTICATION_LOGOUT_URL", "http://belgrave.hopto.org/cam");
require_once("auth.php");
session_start();
Authenticator::invalidateUser();


?>
</body>
</html>
