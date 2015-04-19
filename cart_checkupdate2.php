<?php
$host="104.131.179.153";
$username="web"; // Mysql username
$password="cea"; // Mysql password
$db_name="Scheduler"; // Database name
$tbl_name="Carts"; // Table name

// Connect to server and select databse.
$conn = mysql_connect($host, $username, $password)or die("cannot connect");
mysql_select_db("Scheduler")or die("cannot select DB");

// username and password sent from form
$id= $_GET['ID'];
$nickname=$_POST['nickname'];
$seats=$_POST['seats'];
$miles=$_POST['miles'];
$gas=$_POST['gas'];
$main=$_POST['main'];
$notes=$_POST['notes'];

// To protect MySQL injection (more detail about MySQL injection)
$nickname = stripslashes($nickname);
$seats = stripslashes($seats);
$miles = stripslashes($miles);
$gas = stripslashes($gas);
$main = stripslashes($main);
$notes = stripslashes($notes);

$nickname = mysql_real_escape_string($nickname);
$seats = mysql_real_escape_string($seats);
$miles = mysql_real_escape_string($miles);
$gas = mysql_real_escape_string($gas);
$main = mysql_real_escape_string($main);
$notes = mysql_real_escape_string($notes);

//insert form information into database
$sql="UPDATE Carts SET Nickname = '$nickname', Num_Seats = '$seats', MilesDriven = '$miles', LastGasUp = '$gas', LastMaintenance = '$main', notes = '$notes' WHERE ID = '$id'";
$result = mysql_query($sql, $conn);

if($result){
// Register new location and redirect to file 
header("Location: index.php?loc=uS");}
else {
header("Location: index.php?loc=uF");}
?>
