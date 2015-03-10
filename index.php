<?php
	require_once('login.php'); // this checks for cookies and lets us know what to output for each user
	require_once('navbar.php');
	require_once('sidebar.php');

?>
<html>
	<head>
		<!--<script src="/resources/js/jquery.min.js" type="text/javascript"></script> -->

    	<!-- Bootstrap core CSS -->
    	<link href="/resources/css/bootstrap.min.css" rel="stylesheet">

    	<!-- Custom styles for this template -->
    	<link href="/resources/css/dashboard.css" rel="stylesheet">
	</head>

	<body>
		<div class="main_body">

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
					if($_GET['act']== 'm'){
						$body = require("main.php");
					}
					if($_GET['act']== 'admin'){
						$body = require("admin.php");
					}
	
				}
				if(isset($_GET['loc'])){
					if($_GET['loc'] == 'new'){
						$body = require("location_new.php");
					}
					if($_GET['loc'] == 'fail'){
						$body = require("location_fail.php");
					}
					if($_GET['loc'] == 'update'){
						$body = require("location_checkupdate.php");
					}
					if($_GET['loc'] == 'edit'){
						$body = require("location_change.php");
					}
					if($_GET['loc'] == 'uS'){
						$body = require("location_updatesuccess.php");
					}
					if($_GET['loc'] == 'uF'){
						$body = require("location_updatefail.php");
					}
				}
			?>
		</div>
	</body>

</html>