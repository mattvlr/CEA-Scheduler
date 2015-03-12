<div>
<?php
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
 ?>
</div>