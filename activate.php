<?php
	require_once('mysql/_mysql.php');
$mysql = new mysql_driver;
$mysql->connect();              

$msg = 'fail';

$perm = $mysql->select('Users','PERMISSION','ACTIVATION="'.$_GET['code'].'"');			//Get Permission level from database

if($perm > '0')																			//Higher than unactivated permission
{
	$msg = 'Your account is already activated<br>
		Login <a href="index.php?act=login">here</a>!';
}
else if($perm == '0')																	//0 - user hasnt been activated then
{
	if($mysql->update('Users',"PERMISSION='1'",'ACTIVATION="'.$_GET['code'].'"'))		// Activate user
	{ 
		$msg = 'Your account is now activated<br>
			Login <a href="index.php?act=login">here</a>!';
	}
	else
	{
		$msg = 'Failed';
	}
}
else
{
	$msg = 'invalid activation, Please re-send your validation link';
}


?>
	<?php echo $msg; ?>