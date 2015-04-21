
<?php
if(isset($_POST)){
  if(isset($_POST['delete'])){
    deleteuser();
  }elseif(isset($_POST['update'])){
    updateuser();
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
    $p = $result['PERMISSION'];

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

if($_SESSION['PERMISSION'] != 3){
  $r = "readonly";
}else{
  $r ="";
}

function deleteuser() {
    //delete information into database
	$usrname = $_POST['username'];
	$sql="DELETE from Users WHERE USERNAME = '$usrname'";
	$result = mysql_query($sql, $conn);

	if($result){
	// Register delete location and redirect to file 
	header("Location: index.php?loc=uS");}
	else {
	header("Location: index.php?loc=uF");}
	} 

function updateuser() {
    $firstname=$_POST['first_name'];
	$lastname=$_POST['last_name'];
	$email=$_POST['email'];
	$birth=$_POST['dob'];
	$permission=$_POST['permission'];

	$firstname = stripslashes($firstname);
	$lastname = stripslashes($lastname);
	$email = stripslashes($email);
	$birth = stripslashes($birth);
	$permission = stripslashes($permission);
	
	$firstname = mysql_real_escape_string($firstname);
	$lastname = mysql_real_escape_string($lastname);
	$email = mysql_real_escape_string($email);
	$birth = mysql_real_escape_string($birth);
	$permission = mysql_real_escape_string($permission);

	//insert form information into database
	$sql2="UPDATE Carts SET Nickname = '$nickname', Num_Seats = '$seats', MilesDriven = '$miles', LastGasUp = '$gas', LastMaintenance = '$main', notes = '$notes' WHERE ID = '$id'";
	$result2 = mysql_query($sql2, $conn);

	if($result2){
	// Register new location and redirect to file 
	header("Location: index.php?loc=uS");}
	else {
	header("Location: index.php?loc=uF");}	
} 
?>
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
        ';
      }?>
      <br>
      <?php if($_SESSION['PERMISSION'] == 3){
        echo '<center>
        <div class="btn-group btn-group-lg" role="group">
		<button type="submit" name="update" class="btn btn-default" role="button"><span class="glyphicon glyphicon-plus"></span>Update User</button>
		<button type="submit" name="delete" class="btn btn-default" role="button"><span class="glyphicon glyphicon-plus"></span>Remove User</button>
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
      Schedule Generator stuff goes here or a link to it.
    </div>
  </div>
</div>



