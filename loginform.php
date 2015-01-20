<!DOCTYPE html>
<?php
require_once('mysql/_db.php');
require_once('mysql/_mysql.php');
session_start();

$mysql = new mysql_driver;
$mysql->connect();

if($_SERVER["REQUEST_METHOD"] == "POST") {
	$username=$_POST['username'];
	$password=$_POST['password'];

	$query = "SELECT username,password FROM Users WHERE username='$username' and password='$password'";
	$result = $mysql->query($query);
	$count = mysqli_num_rows($result);

	if($count == 1){
		header("location: index.php");
	}
	else
		echo("Username or pass is wrong");
}
 
$form = '<div id="main-container" role="main">
      
      <section class="landingPage">
         
         <div class="container">
            
            <div class="row">
               
              <div class="col-md-3">&nbsp;</div>
               
              <div class="col-md-7">
                  
                  <div id="contact-form" class="clearfix" style="display: block; margin-left: auto; margin-right: auto;">
					
                    <div style="margin: 2em 2ex"><p align="center">Welcome to the Center for Educational Access Cart service at the University of Arkansas.</br> Running since 2015ish.</p></div>
            
                    <form name="login" action="" method="post" class="form-stacked">

                      <div class="form-group" style="margin: 2ex">
                        <label for="userid" style="float: left; width: 8em">Username:</label>
                        <input name="username" type="text" autofocus="autofocus" />
                      </div>

                      <div class="form-group" style="margin: 2ex">
                        <label for="pwd" style="float: left; width: 8em">Password:</label>
                        <input name="password" type="password" />
                      </div>

                      <div class="form-group" style="margin: 3ex" id="gsmobile">
                        <input name="gsmobile" type="checkbox" onClick="this.form.action = isMobile(this.form.action)"/>
                        <label for="gsmobile">Use Full Site (non-Mobile version) <- Doesn&#39t do anything</label>
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

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="login">
		<?php echo $form;?>
     <!--<center> Return to the template <a href="template.php">here.</a> </center>-->

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>