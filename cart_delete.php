
<html>
<head>
<title>Delete Cart</title>
</head>
<body>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<form name="form1" method="post" action="cart_checkdelete.php">
<td>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
<tr>
<td colspan="3"><strong>Delete Cart</strong></td>
</tr>
<?php
$host = "104.131.179.153";
$username="web"; // Mysql username
$password="cea"; // Mysql password
$db_name="Scheduler"; // Database name
$tbl_name="Carts"; // Table name

// Connect to server and select database.
$conn = mysql_connect($host, $username, $password)or die("cannot connect");
mysql_select_db("Scheduler")or die("cannot select DB");

$sql = "SELECT Nickname FROM Carts GROUP BY Nickname";

$result = mysql_query($sql, $conn);
if ($result) {
	
	echo '<td width="120">Choose Cart: </td>';
	echo "<td width=\"350\">";
	echo "<select name=\"carts\">";

    $num_results = mysql_num_rows($result);
    for ($i=0;$i<$num_results;$i++) {
        $row = mysql_fetch_array($result);
        $name = $row['Nickname'];
        echo '<option value="' .$name. '">' .$name. '</option>';
    }

    echo '</select>';
}
else { echo "there are problems here";}

//mysql_close($conn);

	?>


<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td><input type="submit" name="Submit" value="Lookup Cart"></td>
</tr>
</table>
</td>
</form>
</tr>
</table>


    <!-- Bootstrap core CSS -->
    <link href="/resources/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/resources/css/dashboard.css" rel="stylesheet">

</body>
</html>

