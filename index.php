<?php
	require_once('login.php'); // this checks for cookies and lets us know what to output for each user
	require_once('navbar.php');
	//require_once('sidebar.php');

?>
<html>
	<head>
		<!--<script src="/resources/js/jquery.min.js" type="text/javascript"></script> -->

    	<!-- Bootstrap core CSS -->
    	<link href="/resources/css/bootstrap.min.css" rel="stylesheet">

    	<!-- Custom styles for this template -->
    	<link href="/resources/css/dashboard.css" rel="stylesheet">
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>

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
					if($_GET['act']== 'admin'){
						$body = require("admin.php");
					}
					if($_GET['act'] == 'profile'){
						$body = require("profile.php");
					}
					if($_GET['act'] == 'ul'){
						$body = require("userlist.php");
					}
					if($_GET['act'] == 'sch'){
						$body = require("schedule.php");
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
					if($_GET['loc'] == 'delete'){
						$body = require("location_delete.php"); 
					}
					if($_GET['loc'] == 'uS'){
						$body = require("location_updatesuccess.php");
					}
					if($_GET['loc'] == 'uF'){
						$body = require("location_updatefail.php");
					}
					if($_GET['loc'] == 'editor'){
						$body = require("map_editor.php");
					}
					if($_GET['loc'] == 'success'){
						$body = require("location_updatesuccess.php");
					}
					if($_GET['loc'] == 'fail'){
						$body = require("location_updatefail.php");
					}
				}
				
				if(isset($_GET['cart'])){
					if($_GET['cart'] == 'new'){
						$body = require("cart_new.php");
					}
						if($_GET['cart'] == 'success'){
						$body = require("cart_success.php");
					}
						if($_GET['cart'] == 'failure'){
						$body = require("cart_failure.php");
					}
						if($_GET['cart'] == 'delete'){
						$body = require("cart_delete.php");
					}
						if($_GET['cart'] == 'change'){
						$body = require("cart_change.php");
					}
				}
				if(isset($_GET['user'])){
						if($_GET['user'] == 'new'){
						$body = require("user_new.php");
					}
						if($_GET['user'] == 'success'){
						$body = require("user_success.php");
					}
						if($_GET['user'] == 'failure'){
						$body = require("user_failure.php");
					}
						if($_GET['user'] == 'delete'){
						$body = require("user_checkdelete.php");
					}
						if($_GET['user'] == 'change'){
						$body = require("user_change.php");
					}
				}
			
			
				
			?>
		</div>
	</body>

</html>