<div>
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
<div class="row">
<div class="col-lg-6">
<div class="input-group input-group-lg">
  <input type="text" class="form-control" placeholder="Username" aria-describedby="sizing-addon1">
  <input type="text" class="form-control" placeholder="Username" aria-describedby="sizing-addon1">
  <input type="text" class="form-control" placeholder="Username" aria-describedby="sizing-addon1">
  <input type="text" class="form-control" placeholder="Username" aria-describedby="sizing-addon1">
  <input type="text" class="form-control" placeholder="Username" aria-describedby="sizing-addon1">
  <input type="text" class="form-control" placeholder="Username" aria-describedby="sizing-addon1">
  
</div>

</div>
</div>
</div>