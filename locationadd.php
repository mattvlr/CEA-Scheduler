<?php
//require_once('login.php'); <- uncomment to force a login page redirect
require_once('sidebar.php');
require_once('navbar.php');
//require_once('login.php'); // this checks for cookies and lets us know what to output for each user

?>
<html>
<head>
	<div margin-left="300px">
		
	</div>

    <!-- Bootstrap core CSS -->
    <link href="/resources/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/resources/css/dashboard.css" rel="stylesheet">
</head>

<body>
<form action="geocode.php" method="post">
Street Name: <input type="text" name="street"><br>
City: <input type="text" name="city"><br>
Zipcode: <input type="text" name="zipcode"><br>
<input type="submit">
</form>
</body>
</html>