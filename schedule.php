<?php
$dbhost = "104.131.179.153";
$dbname = "Scheduler";
$dbuser = "web";
$dbpass = "cea";

//	Connection
global $db;
$day = date('Y-m-d');
//echo($day);

$db = new mysqli();
$db->connect($dbhost, $dbuser, $dbpass, $dbname);
$db->set_charset("utf8");

//	Check Connection
//if ($db->connect_errno) {
 //   printf("Connect failed: %s\n", $db->connect_error);
  //  exit();
//}
$query = 'SELECT * FROM Schedules WHERE DAY = "'. $day . '" ORDER BY PickupTime ASC;';
echo'<div class="panel panel-primary" style="width=90%;margin-right:4%">

  <div class="panel-heading"><h3 class="panel-title">Schedule '.$day.'</h3></div>
  <table class="table table-striped"><thread><tr><th>Golf Cart</th><th>Student Name</th><th>Driver</th><th>Pickup Time<th>Pickup Point</th><th>Dropoff Time</th><th>Dropoff Point</th><th>Backup Driver</th></tr></thread>';
	// Do Search
	$result = $db->query($query);
	while($results = $result->fetch_array()) {
		$result_array[] = $results;
	}

	// Check If We Have Results
	if (isset($result_array)) {
		foreach ($result_array as $result) {
				if($result['Driver'] == "No Driver"){
					$warn = 'class="danger"';
				}
				if($result['BackupDriver'] == "No Backup" ){
					$bdwarn = 'class="danger"';
				}
				echo '<tr><td>'.$result['Cart'].'</td><td>'.$result['Student_First']. ' ' . $result['StudentLast'].'</td><td '.$warn.'>'.$result['Driver'].'</td><td>'.$result['PickupTime'].'</td><td>'.$result['PickupPoint'].'</td><td>'.$result['DropTime'].'</td><td>'.$result['DropPoint'].'</td><td ' .$bdwarn.'>'.$result['BackupDriver'].'</td></tr>';

			
		}
	}
	echo '</table></div>'; 
	
?>