
<html>
<head>
<title>Update Location</title>
</head>
<body>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<form name="form1" method="post" action="location_checkdelete.php">
<td>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
<tr>
<td colspan="3"><strong>Delete Location</strong></td>
</tr>
<?php
$host = "104.131.179.153";
$username="web"; // Mysql username
$password="cea"; // Mysql password
$db_name="Scheduler"; // Database name
$tbl_name="Stops"; // Table name

// Connect to server and select database.
$conn = mysql_connect($host, $username, $password)or die("cannot connect");
mysql_select_db("Scheduler")or die("cannot select DB");

$sql = "SELECT FullName FROM Stops GROUP BY FullName";

$result = mysql_query($sql, $conn);
if ($result) {
	
	echo '<td width="120">Choose Building</td>';
	echo '<td width="6">:</td>';
	echo "<td width=\"350\">";
	echo "<select name=\"buildings\">";

    $num_results = mysql_num_rows($result);
    for ($i=0;$i<$num_results;$i++) {
        $row = mysql_fetch_array($result);
        $name = $row['FullName'];
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
<td><input type="submit" name="Submit" value="Lookup Building"></td>
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

