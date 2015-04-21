
<?php
if(isset($_GET['u'])){
	var_dump($_GET);
}else{
$permission = ''; 
if($_SESSION['PERMISSION'] == 1)
	$permission = "Student";
else if($_SESSION['PERMISSION'] == 2)
	$permission = "Driver";
else if($_SESSION['PERMISSION'] == 3)
	$permission = "Administrator";

var_dump($_SESSION);
$text ='<br><br><br><p>Your name is <bold><font size="5">'. $_SESSION['FIRST_NAME'] . '</font></bold> <bold><font size="5">'. $_SESSION['LAST_NAME'] . '</font></bold>
		. Your username is <bold><font size="5">'. $_SESSION['USERNAME'] . '</font></bold> and your permission on this site is <bold><font size="5">'. $permission . '</font></bold></p> ';
echo $text;
}


 ?>
 <div id="wrapper" style="position:relative">
  <div id="left-wrapper" style="float:left;width:50%;margin-right:4%">
 <div class="panel panel-primary" style="">
  <div class="panel-heading"><h3 class="panel-title">User Profile Panel</h3></div>

<div class="row" style="margin-top:3%;margin-left:3%;margin-right:3%;margin-bottom:3%">


<div class="input-group input-group-lg">
  <span class="input-group-addon" id="basic-addon1">Username</span>
  <input type="text" class="form-control" placeholder="Username" aria-describedby="sizing-addon1">
</div>
<br>
<div class="input-group input-group-lg">
  <span class="input-group-addon" id="basic-addon1">First Name</span>
  <input type="text" class="form-control" placeholder="" aria-describedby="sizing-addon1">
</div>
<br>
<div class="input-group input-group-lg">
  <span class="input-group-addon" id="basic-addon1">Last Name</span>
  <input type="text" class="form-control" placeholder="" aria-describedby="sizing-addon1">
</div>
<br>
<div class="input-group input-group-lg">
  <span class="input-group-addon" id="basic-addon1">Email</span>
  <input type="text" class="form-control" placeholder="example@something.com" aria-describedby="sizing-addon1">
</div>
<br>
<form role="form">
    <div class="form-group">
      <label for="sel1">Permission</label>
      <select class="form-control input-lg" id="sel1">
        <option value="-1">Inactive</option>
        <option value="0">Guest</option>
        <option value="1">Student</option>
        <option value="2">Driver</option>
        <option value="3">Admin</option>
      </select>
    </div>
  </form>
  <br>
  <center>
  <div class="btn-group btn-group-lg" role="group">
    <button type="button" class="btn btn-default">Update User</button>
    <button type="button" class="btn btn-default">Remove User</button>
  </div>
</center>
</div>
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