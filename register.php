<!DOCTYPE html>
<?php

require_once('mysql/_db.php');
require_once('mysql/_mysql.php');
$mysql = new mysql_driver;
$mysql->connect();
$status = '';
if( isset($_POST["create"]) && isset($_POST['email']) && isset($_POST['password']))
{  
	$user_inuse = $mysql->exists('Users',"USERNAME='".$_POST['username']."'");
	$email_inuse = $mysql->exists('Users',"EMAIL='".$_POST['email']."'");
	if(!$user_inuse && !$email_inuse )
	{
	$salt = uniqid(mt_rand(0,61),true);
	$passhash = crypt($_POST['password'],$salt);
	$activation = crypt($_POST['email'],$salt);
	$userinfo = array(	'USERNAME' => $_POST['username'],
						'FIRST_NAME' => $_POST['first_name'],
						'LAST_NAME' => $_POST['last_name'],
						'EMAIL' => $_POST['email'],
						'PASSHASH' => $passhash,
						'SALT' => $salt,
						'DATE_OF_BIRTH' => $_POST['dob'],
						'ACTIVATION' => $activation
					);	
	if($mysql->insert('Users',$userinfo))
	{
	//USER ADDED SUCCESSFULLY
		require_once('smtp/Send_Mail.php');
		$activation_email = 'Hello ' . $_POST['first_name'] . ' ' . $_POST['last_name'] . ', <br/> <br/> We need to confirm that this is your real email. To do so click the link below.<br/><br/>
							<a href="'.$base_url.'/activate.php?code='.$activation.'">'.$base_url.'/activate.php?code='.$activation.'</a>';
		$status = '	<font color="green" size="5">Registration Successful<br></font>
					<font color="green" size="3">Check your email for an activation link!';
		Send_Mail($_POST['email'],"Email Verification",$activation_email);
		//header( 'Location: /index.php?act=onlogin' ) ;
	}
	
	}
	else if ( $user_inuse) {
		$status = '<font color="red" size="3">The username you have chosen is in use. Please use another one.';
	}
	else if ( $email_inuse) {
		$status = '<font color="red" size="3">The email you have chosen is in use. Please use another one.';
	}
	else
	{
		//$status = 'The email you have chosen is invalid.';
	}

}

$body = '  <div class="container">
            
            <div class="row"> <div class="col-md-3">&nbsp;</div><div class="col-md-7"><div class="well" style="background-color:#eee"><div class="register">
	<form class="form-signin" role="form" action="' . $_SERVER['PHP_SELF'] . '?act=register" method = "post">
	<h1>Welcome to the CEA Cart Scheduler Project!</h1>
	<h2 class="form-signin-heading">Register:</h2>
	<h3>' . $status . '</font></h3>
	<input type="email" name = "email" class="form-control" placeholder="Email Address" required autofocus>
	<br>
	<input type="text" name = "username" class="form-control" placeholder="User Name" required>
	<input type="password" name = "password" id = "password" class="form-control" placeholder="Password" required>
	
	<a id = "confirmMessage"></a>
	<br>
	<input type=text name = "first_name" class="form-control" placeholder="First Name" required>
	<input type=text name = "last_name" class="form-control" placeholder="Last Name" required>
	<br>
	<center>Date of Birth :</center> <input type="date" name = "dob" class="form-control">
	<br>
	<input type="hidden" name="create" value = "true">
	<button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
	</form>
	<center> Already have an account? Login <a href="/loginform.php">here</a>.</center>

	</div></div> </div></div></div><!-- /register -->';

?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Register</title>

    <!-- Bootstrap core CSS -->
    <link href="/resources/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/resources/css/signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script src="functions.js"></script>
  </head>
	<body>
		<div class="register">
			<?php echo $body;?>
		</div>
	</body>
</html>