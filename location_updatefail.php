<?php
//require_once('login.php'); <- uncomment to force a login page redirect
require_once('sidebar.php');
require_once('navbar.php');
//require_once('login.php'); 
// this checks for cookies and lets us 
// know what to output for each user

?>

<html>
<head>
<title>Failure</title>
<!-- Bootstrap core CSS -->
    <link href="/resources/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/resources/css/dashboard.css" rel="stylesheet">

</head>
<body>
The location could not be updated. 
<br>
<a href="location_change.php">Try again?</a>
</body>
</html>
