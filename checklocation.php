<?php

$username="root"; // Mysql username
$password="cea"; // Mysql password
$db_name="Scheduler"; // Database name
$tbl_name="Stops"; // Table name

// Connect to server and select databse.
$conn = mysql_connect(localhost, $username, $password)or die("cannot connect");
mysql_select_db("Scheduler")or die("cannot select DB");

// username and password sent from form
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
$nickname = stripslashes($nickname);
$fullname = stripslashes($fullname);
$address = stripslashes($address);
$state = stripslashes($state);
$city = stripslashes($city);
$zipcode = stripslashes($zipcode);

$nickname = mysql_real_escape_string($nickname);
$fullname = mysql_real_escape_string($fullname);
$address = mysql_real_escape_string($address);
$state = mysql_real_escape_string($state);
$city = mysql_real_escape_string($city);
$zipcode = mysql_real_escape_string($zipcode);

//see what the next ID number should be
$sqlid="SELECT * FROM Stops";
$idresult= mysql_query($sqlid, $conn); 
$id=mysql_num_rows($idresult)+1;

//insert form information into database
$sql="INSERT INTO Stops (ID, Place, FullName, Address, City, State, ZipCode, Latitude, Longitude) VALUES ($id, '$nickname', '$fullname', '$address', '$state', '$city', $zipcode, '$lat', '$long')";
$result = mysql_query($sql, $conn);


if($result){
// Register new location and redirect to file 
header("location:location_success.php");}
else {
header("location:location_fail.php");}
?>
