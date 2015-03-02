<?php
	require_once('sidebar.php');
	require_once('navbar.php');
	//require_once('login.php'); // this checks for cookies and lets us know what to output for each user

?>
<html>
	<head>

    	<!-- Bootstrap core CSS -->
    	<link href="/resources/css/bootstrap.min.css" rel="stylesheet">

    	<!-- Custom styles for this template -->
    	<link href="/resources/css/dashboard.css" rel="stylesheet">
	</head>

	<body>
		
			<?php

				if(isset($_GET['act'])) {
				
					if($_GET['act']== 'register'){
						$body = require("register.php");
					}
					if($_GET['act']== 'login'){
						$body = require("loginform.php");
					}
					if($_GET['act']== 'forgot'){
						$body = require("forgot.php");
					}
					if($_GET['act']== 'home'){
						$body = require("index.php");
					}
	
				}
			?>
	</body>
</html>