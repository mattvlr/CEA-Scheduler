<?php
$host="104.131.179.153";
$username="web"; // Mysql username
$password="cea"; // Mysql password
$db_name="Scheduler"; // Database name
$tbl_name="Users"; // Table name

// Connect to server and select database.
$conn = mysql_connect($host, $username, $password)or die("cannot connect");
mysql_select_db("Scheduler")or die("cannot select DB");

// username and password sent from form
$username=$_GET['u'];

$username = mysql_real_escape_string($username);

$placesql = "SELECT * FROM Users WHERE USERNAME = '$username'";
$places = mysql_query($placesql, $conn);
$row = mysql_fetch_array($places);
$id = $row['ID']; 
$username=$row['USERNAME'];
$first_name=$row['FIRST_NAME'];
$last_name=$row['LAST_NAME'];
$userid=$row['UniversityID'];
$email=$row['EMAIL'];
$dob=$row['DATE_OF_BIRTH'];

?>

<html>
<head>
<title>Delete User</title>
</head>
<body>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<form name="form1" method="post" action="cart_checkdelete2.php?ID=<?php echo $id ?>">
<td>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
<tr>
<td colspan="3"><strong>Are you sure you wish to delete this entry?</strong></td>
</tr>
<tr>
<td width="120">Name</td>
<td width="6">:</td>
<td width="350">
<?php echo $firstname ?> </td>
</tr>
<tr>
<td width="120">Username</td>
<td width="6">:</td>
<td width="350">
<?php echo $username ?> </td>
</tr>
<tr>
<td width="120">University ID</td>
<td width="6">:</td>
<td width="350">
<?php echo $userid ?> </td>
</tr>
<tr>
<td>Email</td>
<td>:</td>
<td><?php echo $email ?></td>
</tr>
</tr>
<tr>
<td>Date of Birth</td>
<td>:</td>
<td><?php echo $dob ?></td>
</tr>
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

