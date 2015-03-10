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
$nickname=$_POST['nickname'];
$fullname=$_POST['fullname'];
$address=$_POST['address'];
$state=$_POST['state'];
$city=$_POST['city'];
$zipcode=$_POST['zipcode'];

//get long and latitude from geocoding service
$geocode_add = str_replace(' ', '+', $address).",";
$geocode_city = '+'.str_replace(' ', '+', $city).",";
$geocode_state = '+'.str_replace(' ', '+', $state);
$geocode_zipcode = '+'.str_replace(' ', '', $zipcode);
$geocode = $geocode_add.$geocode_city.$geocode_state.$geocode_zipcode;
$url = "https://api.opencagedata.com/geocode/v1/json?q=$geocode&key=c50c138d41a9ecac2de9a5525ba612ef&pretty=1";

$jsondata = file_get_contents($url); 
$data = json_decode($jsondata); 

$lat=$data->{'results'}[0]->{'geometry'}->{'lat'}; 
$long=$data->{'results'}[0]->{'geometry'}->{'lng'}; 

// To protect MySQL injection (more detail about MySQL injection)
$id = stripslashes($id);
$nickname = stripslashes($nickname);
$fullname = stripslashes($fullname);
$address = stripslashes($address);
$state = stripslashes($state);
$city = stripslashes($city);
$zipcode = stripslashes($zipcode);

$id = mysql_real_escape_string($id); 
$nickname = mysql_real_escape_string($nickname);
$fullname = mysql_real_escape_string($fullname);
$address = mysql_real_escape_string($address);
$state = mysql_real_escape_string($state);
$city = mysql_real_escape_string($city);
$zipcode = mysql_real_escape_string($zipcode);


//insert form information into database
$sql="UPDATE Stops SET Place = '$nickname', FullName = '$fullname', Address = '$address', City = '$city', State = '$state', ZipCode = '$zipcode' WHERE ID = '$id'";
$result = mysql_query($sql, $conn);

if($result){
// Register new location and redirect to file 
header("Location: index.php?loc=uS");}
else {
header("Location: index.php?loc=uF");}
?>
