<?php

$username="root"; // Mysql username
$password="cea"; // Mysql password
$db_name="Scheduler"; // Database name
$tbl_name="Carts"; // Table name

// Connect to server and select databse.
$conn = mysql_connect(localhost, $username, $password)or die("cannot connect");
mysql_select_db("Scheduler")or die("cannot select DB");

// username and password sent from form
$nickname=$_POST['nickname'];
$seats=$_POST['seats'];
$notes=$_POST['notes'];


// To protect MySQL injection 
$nickname = stripslashes($nickname);
$seats = stripslashes($seats);
$notes = stripslashes($notes);

$nickname = mysql_real_escape_string($nickname);
$seats = mysql_real_escape_string($seats);
$notes = mysql_real_escape_string($notes);

//see what the next ID number should be
$sqlid="SELECT * FROM Carts";
$idresult= mysql_query($sqlid, $conn); 
$id=mysql_num_rows($idresult)+1;

//insert form information into database
$sql="INSERT INTO Carts (ID, Nickname, Num_Seats, MilesDriven, LastGasUp, LastMaintenance, Notes) VALUES ('$id', '$nickname', '$seats', 0, '2015-01-01', '2015-01-01', '$notes')";
$result = mysql_query($sql, $conn);


if($result){
// Register new location and redirect to file 
header("location:index.php?cart=success");}
else {
header("location:index.php?cart=failure");}
?>
