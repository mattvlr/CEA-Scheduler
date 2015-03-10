<?php
$host="104.131.179.153";
$username="web"; // Mysql username
$password="cea"; // Mysql password
$db_name="Scheduler"; // Database name
$tbl_name="Stops"; // Table name

// Connect to server and select database.
$conn = mysql_connect($host, $username, $password)or die("cannot connect");
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
<title>Delete Location</title>
</head>
<body>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<form name="form1" method="post" action="location_checkdelete2.php?ID=<?php echo $id ?>">
<td>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
<tr>
<td colspan="3"><strong>Are you sure you wish to delete this entry?</strong></td>
</tr>
<tr>
<td width="120">Building Code</td>
<td width="6">:</td>
<td width="350">
<?php echo $place ?> </td>
</tr>
<tr>
<td width="120">Building Name</td>
<td width="6">:</td>
<td width="350">
<?php echo $fullname ?> </td>
</tr>
<tr>
<td width="120">Street Address</td>
<td width="6">:</td>
<td width="350">
<?php echo $address ?> </td>
</tr>
<tr>
<td>City</td>
<td>:</td>
<td><?php echo $city ?></td>
</tr>
</tr>
<tr>
<td>State</td>
<td>:</td>
<td><?php echo $state ?></td>
</tr>
</tr>
<tr>
<td>Zipcode</td>
<td>:</td>
<td><?php echo $zipcode ?></td>
</tr>

<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input type="submit" name="Submit" value="Confirm Delete"></td>
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
