
<html>
<head>
<title>Delete Location</title>


	<!--<script src="/resources/js/jquery.min.js" type="text/javascript"></script> -->

    	<!-- Bootstrap core CSS -->
    	<link href="/resources/css/bootstrap.min.css" rel="stylesheet">

    	<!-- Custom styles for this template -->
    	<link href="/resources/css/dashboard.css" rel="stylesheet">
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>

		
		
</head>
<body>
<center>
<strong>Delete Location</strong>
<br><br>
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
	echo 'Choose Building: ';
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


<br><br>
<input type="submit" name="Submit" value="Lookup Building">



    <!-- Bootstrap core CSS -->
    <link href="/resources/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/resources/css/dashboard.css" rel="stylesheet">
</center>
</body>
</html>

