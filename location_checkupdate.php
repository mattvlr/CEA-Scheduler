<?php

$username="root"; // Mysql username
$password="cea"; // Mysql password
$db_name="Scheduler"; // Database name
$tbl_name="Stops"; // Table name

// Connect to server and select databse.
$conn = mysql_connect(localhost, $username, $password)or die("cannot connect");
mysql_select_db("Scheduler")or die("cannot select DB");

// username and password sent from form
$fullname=$_POST['buildings'];

$fullname = mysql_real_escape_string($fullname);

$placesql = "SELECT * FROM Stops WHERE FullName = '$fullname'";
$places = mysql_query($placesql, $conn);
$row = mysql_fetch_array($places);
$id = $row['ID']; 
$place = $row['Place']; 
$address = $row['Address'];
$city = $row['City'];
$state = $row['State'];
$zipcode = $row['ZipCode'];

?>

<html>
<head>
<title>Update Location</title>
</head>
<body>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<form name="form1" method="post" action="location_checkupdate2.php?ID=<?php echo $id ?>">
<td>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
<tr>
<td colspan="3"><strong>Update Location</strong></td>
</tr>
<tr>
<td width="120">Building Code</td>
<td width="6">:</td>
<td width="350">
<input name="nickname" type="text" id="nickname" value="<?php echo $place ?>"></td>
</tr>
<tr>
<td width="120">Building Name</td>
<td width="6">:</td>
<td width="350">
<input name="fullname" type="text" id="fullname" value="<?php echo $fullname ?>"></td>
</tr>
<tr>
<td width="120">Street Address</td>
<td width="6">:</td>
<td width="350">
<input name="address" type="text" id="address" value="<?php echo $address ?>"></td>
</tr>
<tr>
<td>City</td>
<td>:</td>
<td><input name="city" type="text" id="city" value="<?php echo $city ?>"></td>
</tr>
</tr>
<tr>
<td>State</td>
<td>:</td>
<td><input name="state" type="text" id="state" value="<?php echo $state ?>"></td>
</tr>
</tr>
<tr>
<td>Zipcode</td>
<td>:</td>
<td><input name="zipcode" type="text" id="zipcode" value="<?php echo $zipcode ?>"></td>
</tr>

<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input type="submit" name="Submit" value="Submit Address"></td>
</tr>
</table>
</td>
</form>
</tr>
</table>
<br><br>
<p>
This site uses the <a href="http://geocoder.opencagedata.com/">OpenCage Geocoder</a>. 
</p>
