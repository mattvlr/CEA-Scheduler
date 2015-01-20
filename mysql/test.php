<?php
require_once('_db.php');
require_once('_mysql.php');

echo "TESTING THE MYSQL DRIVER<BR>";

$mysql = new mysql_driver;

if($mysql->connect())
{
echo "MYSQL connected!<br>";
echo "Selecting User Table<br>";
}

//$found = $mysql->select("Users","*","Username='*'");
$found = $mysql->query("Select * from Users");
//echo "FOUND : " . $found[0] . "<br>";

echo '<br>';
//$result = $found->fetch_array(MYSQLI_NUM);

if($found->num_rows > 0){
	while($row = $found->fetch_assoc()){
	var_dump($row);
	echo('<br>');
	}
	}


//$found = $mysql->getSessionInfo($_COOKIE['id']);  // example of loading session info fo user 1 this is used for loading userdata to a session when a cookie is present

//print_r($found);



?>