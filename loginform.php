<!DOCTYPE html>

<?php
/*   TODO
*---------------------
* fix login in _mysql
* set cookie with correct id generated
*
*
*/
require_once('mysql/_db.php');
require_once('mysql/_mysql.php');

$loginStatus = '';
$remember = ''; //if user/pass should be remembered

$mysql = new mysql_driver;
$mysql->connect();


if(isset($_POST['remember'])){
  $remember = 'checked';
}

if($_SERVER["REQUEST_METHOD"] == "POST") { //this needs to change once we protect the passwords
	$username=$_POST['username'];
	$password=$_POST['password'];

	$query = "SELECT username,password FROM Users WHERE username='$username' and password='$password'";
	$result = $mysql->query($query);
	$count = mysqli_num_rows($result);

	if($count == 1){

    if(isset($_POST['rem'])){
      setcookie('id',"stillneedid",time()+172800);
    }
    $loginStatus = "<font color='green'>Login success!</font>";
    //$_SESSION = $mysql->getSessionInfo($id);
    //$_SESSION['id']= $id;

		header("location: index.php");
	}
	else{
    $loginStatus = "<font color='red'>Login failed! Username or password is wrong!</font>";

  }
		
}

/*if(isset($_POST['username']) && isset($_POST['password'])){
  $id = $mysql->login($_POST['username'],$_POST['password']);
  echo($id);
}*/
 
$form = '<div id="main-container" role="main">
      
      <section class="landingPage">
         
         <div class="container">
            
            <div class="row">
               
              <div class="col-md-3">&nbsp;</div>
               
              <div class="col-md-7">
                  
                  <div id="contact-form" class="clearfix" style="display: block; margin-left: auto; margin-right: auto;">
					
                    <div style="margin: 2em 2ex"><p align="center">Welcome to the Center for Educational Access Cart service at the University of Arkansas.</br> Running since 2015ish.</p></div>
                    <br>'. $loginStatus. '
                    <form name="login" action="" method="post" class="form-stacked">

                      <div class="form-group" style="margin: 2ex">
                        <label for="userid" style="float: left; width: 8em">Username:</label>
                        <input name="username" type="text" autofocus="autofocus" />
                      </div>

                      <div class="form-group" style="margin: 2ex">
                        <label for="pwd" style="float: left; width: 8em">Password:</label>
                        <input name="password" type="password" />
                      </div>

                      <div class="form-group" style="margin: 3ex" id="CB_rem">
                        <input name="rem" type="checkbox" value="rem"'.$remember.'/>
                        <label>Remember login?</label>
                      </div>

                      <div style="margin: 2ex">
                        <button class="btn btn-default" type="submit" value="Login">Log in</button>
                        <!--trace-->
                      </div>

                      <div style="margin: 2ex">
                        <p class="small"><a href="http://isishelp.uark.edu/frequently-asked-questions.php">Need help logging in?</a></p>
                      </div>

                    </form>
                     	
                  </div>
              </div>
               
              <div class="col-md-3">&nbsp;</div>
               	
            </div>
            
         </div>
         
      </section>
      
   </div>';

?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Bootstrap core CSS -->
    <link href="/resources/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
	<link href="/resources/css/signin.css" rel="stylesheet">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="login">
		<?php echo $form;?>


    </div> <!-- /container -->

  </body>
</html>