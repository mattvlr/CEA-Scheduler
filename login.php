<?php
require_once('mysql/_db.php');
require_once('mysql/_mysql.php');
session_start();



$privledge = '0';  //set to 0 for guest

$mysql = new mysql_driver;
$mysql->connect();

if(isset($_SESSION["ID"]) && isset($_SESSION["USERNAME"]) && isset($_SESSION["FIRST_NAME"]) && isset($_SESSION["LAST_NAME"])  && isset($_SESSION["PERMISSION"]))
{
	$username = $_SESSION['USERNAME'];
	$first_name = $_SESSION['FIRST_NAME'];
	$last_name = $_SESSION['LAST_NAME'];
	$permission = $_SESSION['PERMISSION'];
	//var_dump($_SESSION);
	//header("Location: ?act=m");

}
else if(isset($_COOKIE['id']))
{
	$sess = $mysql->getSessionInfo($_COOKIE['id']);
	if(!$sess)
	{
	echo "COOKIE ERROR!";
	}
	else
	{
	$id = $_COOKIE['id'];
	$username = $sess['USERNAME'];
	$first_name = $sess['FIRST_NAME'];
	$last_name = $sess['LAST_NAME'];
	$permission = $sess['PERMISSION'];
	

	$_SESSION['ID'] = $id;
	$_SESSION['USERNAME'] = $username;
	$_SESSION['FIRST_NAME'] = $first_name;
	$_SESSION['LAST_NAME'] = $last_name;
	$_SESSION['PERMISSION'] = $permission;
	//var_dump($sess);
	//print_r($id);
	//var_dump($_SESSION);
	//header("Location: ?act=m");
	}
}
else
{
	//Not logged in...
	header("Location: loginform.php");
}


if(isset($_GET['act']) && $_GET['act'] == 'logout')
{
setcookie('id', '', time() - 3600);
if(session_destroy())
{
	header("Location: index.php?act=logged");
}
}
?>