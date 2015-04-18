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

if(isset($_POST['username'])){ //fills in username if they got it wrong the first time.
 $username = 'value="'.$_POST['username'];
}
else{
 $username = 'placeholder="Username';
}
if(isset($_POST['remember'])){
  $remember = 'checked';
}

if(isset($_POST['username']) && isset($_POST['password']))
{

  //$result = mysql_
  $id = $mysql->login($_POST['username'],$_POST['password']);
  if($id)
  { // user logged in
    if(isset($_POST['rem']))
    {
      $time = 172800; // 2 days;
      setcookie('id',$id,time()+$time);  //IM PRETTY SURE ANYONE COULD JUST MAKE A COOKIE WITH THAT ID AND USE IT TO LOGIN, but it works for now...
    }
    $loginStatus = "<font color='green'>Login success!</font>";
    $_SESSION = $mysql->getSessionInfo($id);
    $_SESSION['id']= $id;
    var_dump($_SESSION);
    header("Location: index.php?act=m");
  }
  else  // not logged in
  {
    $loginStatus = "<font color='#aa0000'>Login failed!</font>";
    //if(!$mysql->exists('Users',"EMAIL='".$_POST['username']."'"))
    //{
    //  $loginStatus = "<font color='#aa0000'>Username doesn't exsit!</font>";
    //}
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
                  <div class="well" style="background-color:#eee">
                  <div id="contact-form" class="clearfix" style="display: block; margin-left: auto; margin-right: auto;">
					         <div class="jumbotron">
                   <h1>Welcome!</h1>
                  <p>To the Center for Educational Access Cart service at the University of Arkansas. Running since 2015ish.</p>
  
                  </div>
                    <form name="login" action="" method="post" class="form-signin">

                      
                        
                        <input name="username" type="text" class="form-control" placeholder="Username" autofocus="autofocus" />
                        <br>
                        <input name="password" type="password" class="form-control" placeholder="Password" />
                        <input name="rem" type="checkbox" value="rem"'.$remember.'/>
                        
                        <label>Remember login?</label><br>
                        <label>'.$loginStatus.'</label>
                        <br>
                        <br>
                        <button class="btn btn-primary btn-lg" type="submit" value="Login">Log in</button>
                        

                        <br>
                        <br>
                        <p class=""><a href="http://isishelp.uark.edu/frequently-asked-questions.php">Need help logging in?</a></p>
                        <p class="">Don&#39;t have an account? Register <a href="/register.php">here.</a></p>

                    </form>
                    </div>
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