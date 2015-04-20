<?php
$host="104.131.179.153";
$username="web"; // Mysql username
$password="cea"; // Mysql password
$db_name="Scheduler"; // Database name
$tbl_name="Carts"; // Table name

// Connect to server and select database.
$conn = mysql_connect($host, $username, $password)or die("cannot connect");
mysql_select_db("Scheduler")or die("cannot select DB");

// username and password sent from form
$nickname=$_POST['carts'];

$nickname = mysql_real_escape_string($nickname);

$placesql = "SELECT * FROM Carts WHERE Nickname = '$nickname'";
$places = mysql_query($placesql, $conn);
$row = mysql_fetch_array($places);
$id = $row['ID']; 
$seats=$row['Num_Seats'];
$miles=$row['MilesDriven'];
$gas=$row['LastGasUp'];
$main=$row['LastMaintenance'];
$notes=$row['Notes'];

?>

<html>
<head>
<title>Delete Cart</title>
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
<td width="120">Nickname</td>
<td width="6">:</td>
<td width="350">
<?php echo $nickname ?> </td>
</tr>
<tr>
<td width="120">Number of Seats</td>
<td width="6">:</td>
<td width="350">
<?php echo $seats ?> </td>
</tr>
<tr>
<td width="120">Miles Driven</td>
<td width="6">:</td>
<td width="350">
<?php echo $miles ?> </td>
</tr>
<tr>
<td>Last Gas Up</td>
<td>:</td>
<td><?php echo $gas ?></td>
</tr>
</tr>
<tr>
<td>Last Maintenance</td>
<td>:</td>
<td><?php echo $main ?></td>
</tr>
</tr>
<tr>
<td>Notes</td>
<td>:</td>
<td><?php echo $notes ?></td>
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

