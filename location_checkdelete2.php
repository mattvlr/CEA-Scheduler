<?php
$host="104.131.179.153";
$username="web"; // Mysql username
$password="cea"; // Mysql password
$db_name="Scheduler"; // Database name
$tbl_name="Stops"; // Table name

// Connect to server and select databse.
$conn = mysql_connect($host, $username, $password)or die("cannot connect");
mysql_select_db("Scheduler")or die("cannot select DB");

// username and password sent from form
$id = $_GET['ID']; 
$id = stripslashes($id);
$id = mysql_real_escape_string($id); 


//delete information into database
$sql="DELETE from Stops WHERE ID = '$id'";
$result = mysql_query($sql, $conn);

if($result){
// Register new location and redirect to file 
header("Location: index.php?loc=uS");}
else {
header("Location: index.php?loc=uF");}
?>
