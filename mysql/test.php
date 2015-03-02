<?php
require_once('_db.php');
require_once('_mysql.php');

echo "TESTING THE MYSQL DRIVER<BR>";
echo $_SERVER['SERVER_NAME'];
$mysql = new mysql_driver;

if($mysql->connect()) //we we're connected output the echo statements
{
echo "MYSQL connected!<br>";
echo "Selecting User Table<br>";
}

//$mysql->query takes in any SQL statement and outputs an mysqli array of data
$found = $mysql->query("Select * from Users");


echo '<br>'; // new line for readability


if($found->num_rows > 0){ //if we got something back do this

	//while($row = $found->fetch_assoc()){ //prints each row and converts the mysqli datatype to an associative php array.
	//	var_dump($row);
	//	echo('<br>');
	//}
}

$mysql->login("admin","aaaaaa");
//session testing here \/
session_start();
	if( isset( $_SESSION['visit_count']) )
		$_SESSION['visit_count']++;
	else
		$_SESSION['visit_count'] = 1;
?>

<html>
<head> <title>Counting Visit</title> </head>
<body>
	<p>You have visited this page
	<?php echo $_SESSION['visit_count']; ?> 
	time(s) in this session.</p>
</body>
</html>
?>