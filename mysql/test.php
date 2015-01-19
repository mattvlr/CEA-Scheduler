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

$found = $mysql->select('Users',$getset,'*');

echo "FOUND : " . $found . "<br>";
print_r($found);
echo '<br>';

$found = $mysql->getSessionInfo($_COOKIE['id']);  // example of loading session info fo user 1 this is used for loading userdata to a session when a cookie is present

print_r($found);



?>