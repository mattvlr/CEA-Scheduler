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
$nickname=$_POST['carts'];

$nickname = mysql_real_escape_string($nickname);

$placesql = "SELECT * FROM Carts WHERE Nickname = '$nickname'";
$places = mysql_query($placesql, $conn);
$row = mysql_fetch_array($places);
$id = $row['ID']; 
$nickname = $row['Nickname']; 
$seats = $row['Num_Seats'];
$miles = $row['MilesDriven'];
$gas = $row['LastGasUp'];
$main = $row['LastMaintenance'];
$notes = $row['Notes'];

?>

<html>
<head>
<title>Update Cart</title>

	<!--<script src="/resources/js/jquery.min.js" type="text/javascript"></script> -->

    	<!-- Bootstrap core CSS -->
    	<link href="/resources/css/bootstrap.min.css" rel="stylesheet">

    	<!-- Custom styles for this template -->
    	<link href="/resources/css/dashboard.css" rel="stylesheet">
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>

</head>
<body>
<form name="form1" method="post" action="cart_checkupdate2.php?ID=<?php echo $id ?>">
<center><strong>Update Cart</strong>

<br><br>

<div class="input-group">
<span class="input-group-addon" id="basic-addon1" style="width:150px;">Cart Name</span>
<input name="nickname" type="text" id="nickname" value="<?php echo $nickname ?>" aria-describedby="basic-addon1" style="width:300px;"></td>
</div> 

<div class="input-group">
<span class="input-group-addon" id="basic-addon1" style="width:150px;">Number of Seats</span>
<input name="seats" type="text" id="seats" value="<?php echo $seats ?>" aria-describedby="basic-addon1" style="width:300px;"></td>
</div> 

<div class="input-group">
<span class="input-group-addon" id="basic-addon1" style="width:150px;">Miles Driven</span>
<input name="miles" type="text" id="miles" value="<?php echo $miles ?>" aria-describedby="basic-addon1" style="width:300px;"></td>
</div> 

<div class="input-group">
<span class="input-group-addon" id="basic-addon1" style="width:150px;">Last Gas Up</span>
<input name="gas" type="text" id="gas" value="<?php echo $gas ?>" aria-describedby="basic-addon1" style="width:300px;"></td>
</div> 

<div class="input-group">
<span class="input-group-addon" id="basic-addon1" style="width:150px;">Last Maintenance</span>
<input name="main" type="text" id="main" value="<?php echo $main ?>" aria-describedby="basic-addon1" style="width:300px;"></td>
</div> 

<div class="input-group">
<span class="input-group-addon" id="basic-addon1" style="width:150px;">Notes</span>
<input name="notes" type="text" id="notes" value="<?php echo $notes ?>" aria-describedby="basic-addon1" style="width:300px;"></td>
</div> 

<button type="submit" class="btn btn-default">Submit</button>

</body>
</html>
