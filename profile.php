
<?php
//var_dump($_POST);
if(isset($_POST)){
  if(isset($_POST['delete'])){
    deleteuser();
  }elseif(isset($_POST['update'])){
    updateuser();
  }elseif(isset($_POST['add'])){
    addstop();
  }
}
if(isset($_GET['u'])){
	$u = $_GET['u'];
}else{
  $u = $_SESSION['USERNAME'];
  $p = $_SESSION['PERMISSION'];
}



$dbhost = "104.131.179.153";
$dbname = "Scheduler";
$dbuser = "web";
$dbpass = "cea";

//  Connection
global $db;

$db = new mysqli();
$db->connect($dbhost, $dbuser, $dbpass, $dbname);
$db->set_charset("utf8");

//  Check Connection
if ($db->connect_errno) {
  printf("Connect failed: %s\n", $db->connect_error);
  exit();
}
$query = 'SELECT * FROM Users WHERE USERNAME="'.$u.'"';
$result = $db->query($query);
while($results = $result->fetch_array()) {
  $result_array[] = $results;
}


  // Check If We Have Results
if (isset($result_array)) {
  foreach ($result_array as $result) {
    $fn = $result['FIRST_NAME'];
    $ln = $result['LAST_NAME'];
    $e = $result['EMAIL'];
    $dob = $result['DATE_OF_BIRTH'];
	  $nrides = $result['NumRides'];
	  $nshow = $result['NoShows'];
    $p = $result['PERMISSION'];
    $ua = $result['UniversityID'];
    $n = $result['Notes'];

    if($p == -1){
      $sel = "selected";
    }else if($p == 0){
      $sel1 = "selected";
    }else if($p == 1){
      $sel2 = "selected";
    }else if($p == 2){
      $sel3 = "selected";
    }else if($p == 3){
      $sel4 = "selected";
    }

  }
}
//rides table
$query1 = 'SELECT * FROM StudentTimes WHERE UniversityID="'.$ua.'" ORDER BY RideTime ASC;';
$stop = $db->query($query1);
 $table = '<table class="table table-striped table-condensed "><caption>Current Scheduled Rides</caption><thread><tr class="info"><th>Ride Time</th><th>Pickup Location</th><th>Dropoff Location</th><th>Days</th></tr></thread>';
while($stops = $stop->fetch_array()) {
  $stop_array[] = $stops;
}
if(isset($stop_array)){
  foreach($stop_array as $stop){
    $daytemp = $stop['Day'];
    $day = "";
    if($daytemp[0] == 1){
      $day = $day . "M ";
    }
    if($daytemp[1] == 1){
      $day = $day . "Tu ";
    }
    if($daytemp[2] == 1){
      $day = $day . "W ";
    }
    if($daytemp[3] == 1){
      $day = $day . "Th ";
    }
    if($daytemp[4] == 1){
      $day = $day . "F";
    }
    if($daytemp == "00000"){
      $day = "None";
    }
    if($day == "None"){
    $table = $table . '<tr class="danger"><td>' . $stop['RideTime'] . '</td><td>' . $stop['PickupPlace'] . '</td><td>' . $stop['DropPlace'] . '</td><td><b>' . $day . '</b></td></tr>'; 
    }else{
      $table = $table . '<tr><td>' . $stop['RideTime'] . '</td><td>' . $stop['PickupPlace'] . '</td><td>' . $stop['DropPlace'] . '</td><td>' . $day . '</td></tr>'; 
    }
  }
}
  $table = $table . '</table>';

  //end of rides table
  //google routing info db call
  if(($_SESSION['PERMISSION'] == 1) || ($_SESSION['PERMISSION'] == 3)){
   
    $mysql->connect();
    $places = $mysql->getPlaces($ua);
    $num_places = count($places);
    $todays_stops = array();
   // print_r($places);
   // echo(date('N') . "<br>");
    for($i = 0; $i < $num_places; ++$i){
      $day = $places[$i]['Day']; 
      $currday = date('N')-1;
      if($day[$currday] == '1'){
       // echo($day . "<br>");
        array_push($todays_stops,$places[$i]['PickupPlace']);
      }
    }
   // print_r($todays_stops);
    $num_places = count($todays_stops);
    $lats = array($num_places);
    $lngs = array($num_places);

    for($i = 0; $i < $num_places; ++$i){
      $get = array('Latitude', 'Longitude');
      $where = 'Place = "'. $todays_stops[$i] .'"';

      $latlng = $mysql->selectMany('Stops',$get,$where);
     //print_r($latlng);
      $lats[$i] = $latlng[0]['Latitude'];
      $lngs[$i] = $latlng[0]['Longitude'];
      //var_dump($lats);
     // echo("<br>");
    }

  }
  
if($_SESSION['PERMISSION'] != 3){
  $r = "readonly";
}else{
  $r ="";
}
function addstop(){
  $dbhost = "104.131.179.153";
  $dbname = "Scheduler";
  $dbuser = "web";
  $dbpass = "cea";

  //  Connection
  global $db;

  $db = new mysqli();
  $db->connect($dbhost, $dbuser, $dbpass, $dbname);
  $db->set_charset("utf8");

  //  Check Connection
  if ($db->connect_errno) {
    printf("Connect failed: %s\n", $db->connect_error);
    exit();
    }
 
 // $usql = 'SELECT UniversityID FROM Users WHERE '
  $ptime = str_replace(':', '', $_POST['ptime']);
  $ploc=$_POST['ploc'];

  $ua = $_POST['uid'];

  $dloc=$_POST['dloc'];

  //binary date maker
  $day = "23456";
  if($_POST['monday'] == 1){ //not the prettiest way to do it but it works
    $day = str_replace('2', '1', $day);
  }else{
    $day = str_replace('2', '0', $day);
  }
  if($_POST['tuesday'] == 1){
    $day = str_replace('3', '1', $day);
  }else{
    $day = str_replace('3', '0', $day);
  }
  if($_POST['wednesday'] == 1){
    $day = str_replace('4', '1', $day);
  }else{
    $day = str_replace('4', '0', $day);
  }
  if($_POST['thursday'] == 1){
    $day = str_replace('5', '1', $day);
  }else{
    $day = str_replace('5', '0', $day);
  }
  if($_POST['friday'] == 1){
    $day = str_replace('6', '1', $day);
  }else{
    $day = str_replace('6', '0', $day);
  }
  
  
  
  //insert form information into database
  $sql = 'INSERT INTO StudentTimes (UniversityID, RideTime, PickupPlace, DropPlace, Day)
          VALUES ("'.$ua.'","'.$ptime.'","'.$ploc.'","'.$dloc.'","'.$day.'");';
  echo($sql); 
 
  $result = $db->query($sql);
  var_dump($result);
  if($result){
  echo ("Added");
  }
}
function deleteuser() {
	$dbhost = "104.131.179.153";
	$dbname = "Scheduler";
	$dbuser = "web";
	$dbpass = "cea";

	//  Connection
	global $db;

	$db = new mysqli();
	$db->connect($dbhost, $dbuser, $dbpass, $dbname);
	$db->set_charset("utf8");

	//  Check Connection
	if ($db->connect_errno) {
		printf("Connect failed: %s\n", $db->connect_error);
		exit();
		}
    //delete information into database
	$usrname = $_POST['username'];
	//echo $usrname;
	$sql='DELETE from Users WHERE USERNAME = "'. $usrname.'"';
	//echo($sql);
	$result = $db->query($sql);
	//var_dump($result);
	//if($result){
	// Register delete location and redirect to file 
	//header("Location: index.php?loc=uS");}
	//else {
//	header("Location: index.php?loc=uF");}
	} 

function updateuser() {
	$dbhost = "104.131.179.153";
	$dbname = "Scheduler";
	$dbuser = "web";
	$dbpass = "cea";

	//  Connection
	global $db;

	$db = new mysqli();
	$db->connect($dbhost, $dbuser, $dbpass, $dbname);
	$db->set_charset("utf8");

	//  Check Connection
	if ($db->connect_errno) {
		printf("Connect failed: %s\n", $db->connect_error);
		exit();
		}
		
    $firstname=$_POST['first_name'];
	$lastname=$_POST['last_name'];
	$uid=$_POST['UAID'];
	$email=$_POST['email'];
	$birth=$_POST['dob'];
	$permission=$_POST['perm'];
	$notes=$_POST['notes'];

	$firstname = stripslashes($firstname);
	$lastname = stripslashes($lastname);
	$uid = stripslashes($uid);
	$email = stripslashes($email);
	$birth = stripslashes($birth);
	$permission = stripslashes($permission);
	$notes = stripslashes($notes);
	
	$uname = $_POST['username'];
	 
	//insert form information into database
	$sql3='UPDATE Users SET FIRST_NAME = "' .$firstname. '", LAST_NAME = "'.$lastname. '", EMAIL = "' . $email. '", DATE_OF_BIRTH = "' .$birth. '", PERMISSION= "' .$permission. '", Notes ="' .$notes. '", UniversityID ="' .$uid. '" WHERE USERNAME = "' .$uname. '"';

	//echo($sql3); 
	
	$result3 = $db->query($sql3);
	//var_dump($result3);
	if($result3){
	//echo ("Updated");
	}
}
?>
<head>
   <style type="text/css">
       html, body, #map-canvas { height: 74.75%;}
       </style>

       <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8a1UKXLfNwfqwR_nmH-yg-l35APWpeL4"></script>
    
      <script type="text/javascript">
      var directionsDisplay;
      var directionsService = new google.maps.DirectionsService();


      var stopsCount = <?php echo json_encode($num_places); ?>;
      var lngs = <?php echo json_encode($lngs); ?>;
      var lats = <?php echo json_encode($lats); ?>;
      var places = <?php echo json_encode($places); ?>;
     // alert(lngs[0]);
          function initialize() {
             directionsDisplay = new google.maps.DirectionsRenderer();
            var mapOptions = {
                center: { lat: 36.068681, lng: -94.176012},
                zoom: 17
            };
            var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
            directionsDisplay.setMap(map);
          }
          function calcRoute() {
            var selectedMode = "WALKING";
            if(stopsCount > 1){
             // alert(lats[stopsCount-1]);
              var o = new google.maps.LatLng(lats[0],lngs[0]);
              var e = new google.maps.LatLng(lats[stopsCount-1],lngs[stopsCount-1]);
              var waypnts = [];
              for(var i = 1; i < stopsCount - 1; i++){
                var temp = new google.maps.LatLng(lats[i],lngs[i]);
                waypnts.push({
                  location: temp,
                  stopover: true});
                }
              

            
            var request = {
                origin: o,
                destination: e,
                waypoints: waypnts,
                // Note that Javascript allows us to access the constant
                // using square brackets and a string value as its
                // "property."
                travelMode: google.maps.TravelMode[selectedMode]
            };
            directionsService.route(request, function(response, status) {
              if (status == google.maps.DirectionsStatus.OK) {
                directionsDisplay.setDirections(response);
              }
            });
          }
          }


      google.maps.event.addDomListener(window, 'load', initialize);
      </script>
    </head>
</head>
<body  onload="calcRoute()">
<div id="wrapper" style="position:relative">
  <div id="left-wrapper" style="float:left;width:50%;margin-right:4%">
   <div class="panel panel-primary" style="">
    <div class="panel-heading"><h3 class="panel-title">User Profile Panel</h3></div>

    <div class="row" style="margin-top:3%;margin-left:3%;margin-right:3%;margin-bottom:3%">
     
     <form name="user" method="post" class="form-signin">
      <div class="input-group input-group-lg">
        <span class="input-group-addon" id="basic-addon1">Username</span>
        <input type="text" class="form-control" name="username" placeholder="Username" aria-describedby="sizing-addon1" value='<?php if($u != NULL){echo $u;} ?>' <?php echo $r;?>>
      </div>
      <br>
      <div class="input-group input-group-lg">
        <span class="input-group-addon" id="basic-addon1">First Name</span>
        <input type="text" class="form-control" name="first_name" placeholder="" aria-describedby="sizing-addon1" value='<?php if($u != NULL){echo $fn;} ?>'  <?php echo $r;?>>
      </div>
      <br>
      <div class="input-group input-group-lg">
        <span class="input-group-addon" id="basic-addon1">Last Name</span>
        <input type="text" class="form-control" name="last_name" placeholder="" aria-describedby="sizing-addon1" value='<?php if($u != NULL){echo $ln;} ?>'  <?php echo $r;?>>
      </div>
      <br>
      <div class="input-group input-group-lg">
        <span class="input-group-addon" id="basic-addon1">Email</span>
        <input type="text" class="form-control" name="email" placeholder="example@something.com" aria-describedby="sizing-addon1" value='<?php if($u != NULL){echo $e;} ?>'  <?php echo $r;?>>
      </div>
      <br>
      <div class="input-group input-group-lg">
        <span class="input-group-addon" id="basic-addon1">University ID</span>
        <input type="text" class="form-control" name="UAID" placeholder="" aria-describedby="sizing-addon1" value='<?php if($u != NULL){echo $ua;} ?>'  <?php echo $r;?>>
      </div>
	  <br>
	  <div class="input-group input-group-lg">
        <span class="input-group-addon" id="basic-addon1">Number of Rides</span>
        <input type="text" class="form-control" name="nrides" placeholder="0" aria-describedby="sizing-addon1" value='<?php if($u != NULL){echo $nrides;} ?>'  <?php echo $r;?>>
      </div>
      <br>
	  <div class="input-group input-group-lg">
        <span class="input-group-addon" id="basic-addon1">No Shows</span>
        <input type="text" class="form-control" name="nshows" placeholder="0" aria-describedby="sizing-addon1" value='<?php if($u != NULL){echo $nshow;} ?>'  <?php echo $r;?>>
      </div>
      <br>
      <label for"dob">Date of Birth: </label><input id="dob" type="date" name = "dob" class="form-control input-lg" value='<?php if($u != NULL){echo $dob;} ?>'  <?php echo $r;?>>
      <br>

      <?php if($_SESSION['PERMISSION'] == 3){
        echo '
        <label for="sel1">Permission</label>
        <select name="perm" class="form-control input-lg" id="sel1">
        <option '. $sel .' value="-1">Inactive</option>
        <option '. $sel1 .' value="0">Guest</option>
        <option '. $sel2 .' value="1">Student</option>
        <option '. $sel3 .' value="2">Driver</option>
        <option '. $sel4 .' value="3">Admin</option>
        </select>
        <br>
        <label for="n">Student Notes</label>
        <textarea  id="n" name="notes" class="form-control" rows="3">'.$n.'</textarea>
        ';
      }?>
      <br>
      <?php if($_SESSION['PERMISSION'] == 3){
        echo '<center>
        <div class="btn-group btn-group-lg" role="group">
		<button type="submit" name="update" class="btn btn-default" role="button"><span class="glyphicon glyphicon-plus"></span> Update User</button>
		<button type="submit" name="delete" class="btn btn-default" role="button"><span class="glyphicon glyphicon-minus"></span> Remove User</button>
        </div>
        </center>';}
        ?>
      </form>
      </div>

    </div>
  </div>

  <div id="right-wrapper" style="float:right;width:43%;margin-right:3%;">
    <div class="panel panel-primary" style="">
      <div class="panel-heading"><h3 class="panel-title">User Schedule Panel</h3></div>
      <div class="row" style="margin-top:3%;margin-left:3%;margin-right:3%;margin-bottom:3%">
         <?php echo $table; ?>
       <form name="sch" method="post" class="form-signin">
        <div class="input-group input-group-lg">
          <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-time"></span> Pickup Time</span>
          <input type="time" class="form-control" name="ptime" aria-describedby="sizing-addon1" required>
        </div>
        <br>
        <?php
        $host = "104.131.179.153";
      $username="web"; // Mysql username
      $password="cea"; // Mysql password
      $db_name="Scheduler"; // Database name
      $tbl_name="Stops"; // Table name

      // Connect to server and select database.
      $conn = mysql_connect($host, $username, $password)or die("cannot connect");
      mysql_select_db("Scheduler")or die("cannot select DB");

      $sql = "SELECT * FROM Stops GROUP BY FullName";

      $result = mysql_query($sql, $conn);
      if ($result) {
        echo  '<label for="sel2">Pickup Location</label>
        <select id="sel2" class="form-control input-lg" name="ploc">';

        $num_results = mysql_num_rows($result);
        for ($i=0;$i<$num_results;$i++) {
          $row = mysql_fetch_array($result);
          $name = $row['FullName'];
          $place = $row['Place'];
          echo '<option value="' .$place. '">' .$name. '</option>';
        }

        echo '</select>';
      }
      ?>
      <br>
      <?php
        $host = "104.131.179.153";
      $username="web"; // Mysql username
      $password="cea"; // Mysql password
      $db_name="Scheduler"; // Database name
      $tbl_name="Stops"; // Table name

      // Connect to server and select database.
      $conn = mysql_connect($host, $username, $password)or die("cannot connect");
      mysql_select_db("Scheduler")or die("cannot select DB");

      $sql = "SELECT * FROM Stops GROUP BY FullName";

      $result = mysql_query($sql, $conn);
      if ($result) {
        echo  '<label for="sel2">Dropoff Location</label>
        <select id="sel2" class="form-control input-lg" name="dloc">';

        $num_results = mysql_num_rows($result);
        for ($i=0;$i<$num_results;$i++) {
          $row = mysql_fetch_array($result);
          $name = $row['FullName'];
          $place = $row['Place'];
          echo '<option value="' .$place. '">' .$name. '</option>';
        }

        echo '</select>';
      }
      ?>
      <br>
      <label for="days">Days to be picked up</label>
      <div id="days" class="input-group input-group-lg">
        <label class="checkbox-inline">
          <input type="checkbox" name="monday" value="1"> Monday
        </label>
        <label class="checkbox-inline">
          <input type="checkbox" name="tuesday" value="1"> Tuesday
        </label>
        <label class="checkbox-inline">
          <input type="checkbox" name="wednesday" value="1"> Wednesday
        </label>
        <label class="checkbox-inline">
          <input type="checkbox" name="thursday" value="1"> Thursday
        </label>
        <label class="checkbox-inline">
          <input type="checkbox" name="friday" value="1"> Friday
        </label>
      </div>
      <br>
      <input type="hidden" name="uid" value='<?php echo ($ua); ?>'> 
      <center>
       <div class="btn-group btn-group-lg" role="group">
        <button type="submit" name="add" class="btn btn-default" role="button"><span class="glyphicon glyphicon-plus"></span> Add Pickup</button>
        <button type="reset" name="clear" class="btn btn-default" role="button"><span class="glyphicon glyphicon-refresh"></span> Clear Form</button>
        </div>
      </center>
    </form>
    <caption>Today's Schedule: </caption>
    <div id="map-canvas"></div>
    </div> <!-- div row -->
    </div>
  </div>
</div>
</body>



