<?php 
//Check for sessions
if(isset($_SESSION['USERNAME']))
{
  
  $username = $_SESSION['USERNAME'];
}

$permission = ''; 
if($_SESSION['PERMISSION'] == 1)
  $permission = "Student";
else if($_SESSION['PERMISSION'] == 2)
  $permission = "Driver";
else if($_SESSION['PERMISSION'] == 3)
  $permission = "Administrator";

$nav_pages = "";
if($_SESSION['PERMISSION'] == 2) // driver
{
  $nav_pages = ' <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
                 <ul class="nav navbar-nav">
                 <li class="dropdown">
                 <a href="index.php?act=admin" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">'. $_SESSION['USERNAME'] .'<span class="caret"></span></a>
                 <ul class="dropdown-menu" role="menu">

                 <li style="padding: 3px 20px">'.$permission.'</li>
                 <li class="divider"></li>
                 <li><a href="#">Schedule</a></li>
                 <li class="divider"></li>
                 <li><a href="#">Profile</a></li>
                 <li><a href="#">Driver Statistics</a></li>
                 <li><a href="?act=logout"">Logout</a></li>

                 </ul>
                 </li>
                 </ul>
                 </div>';
}
if($_SESSION['PERMISSION'] == 1) // student
{
  $nav_pages = ' <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
                 <ul class="nav navbar-nav">
                 <li class="dropdown">
                 <a href="index.php?act=admin" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">'. $_SESSION['USERNAME'] .'<span class="caret"></span></a>
                 <ul class="dropdown-menu" role="menu">

                 <li style="padding: 3px 20px">'.$permission.'</li>
                 <li class="divider"></li>
                 <li><a href="#">Schedule</a></li>
                 <li class="divider"></li>
                 <li><a href="#">Profile</a></li>
                 <li><a href="?act=logout"">Logout</a></li>

                 </ul>
                 </li>
                 </ul>
                 </div>';
}
if($_SESSION['PERMISSION'] == 3) // admin
{
  $nav_pages = ' <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
                 <ul class="nav navbar-nav">
                 <li class="dropdown">
                 <a href="index.php?act=admin" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">'. $_SESSION['USERNAME'] .'<span class="caret"></span></a>
                 <ul class="dropdown-menu" role="menu">

                 <li style="padding: 3px 20px">'.$permission.'</li>
                 <li class="divider"></li>
                 <li><a href="?act=admin">Settings Panel</a></li>
                 <li><a href="#">Schedule</a></li>
                 <li class="divider"></li>
                 <li><a href="#">Profile</a></li>
                 <li><a href="#">Statistics</a></li>
                 <li><a href="?act=logout"">Logout</a></li>

                 </ul>
                 </li>
                 </ul>
                 </div>';
}
/*$nav_pages = ' <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="index.php?act=admin" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">'. $_SESSION['USERNAME'] .'<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul>
      </div>';
*/


$navbar = '
  <div class="navbar navbar-default navbar-fixed-top">
        <div class="navbar-header">
         <a href="http://www.uark.edu"> <img src="/resources/img/logo-on-red.png" style="position:absolute; padding-left:35px; left:-5px;"/>
        </a></div>
          ' . $nav_pages . '
    </div>';

//if(isset($_SESSION["first_name"]) && isset($_SESSION["last_name"]))
//{
  echo $navbar;
//}
?>