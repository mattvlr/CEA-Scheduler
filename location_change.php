<?php
//require_once('login.php'); <- uncomment to force a login page redirect
require_once('sidebar.php');
require_once('navbar.php');
//require_once('login.php'); 
// this checks for cookies and lets us 
// know what to output for each user

 ?>
<html>
<head>
<title>Update Location</title>
</head>
<body>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<form name="form1" method="post" action="location_checkupdate.php">
<td>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
<tr>
<td colspan="3"><strong>Edit Location</strong></td>
</tr>
<?php
$username="root"; // Mysql username
$password="cea"; // Mysql password
$db_name="Scheduler"; // Database name
$tbl_name="Stops"; // Table name

// Connect to server and select database.
$conn = mysql_connect(localhost, $username, $password)or die("cannot connect");
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

