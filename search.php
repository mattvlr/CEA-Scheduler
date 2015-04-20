<?php
/************************************************
	The Search PHP File
************************************************/


/************************************************
	MySQL Connect
************************************************/

// Credentials
$dbhost = "104.131.179.153";
$dbname = "Scheduler";
$dbuser = "web";
$dbpass = "cea";

//	Connection
global $db;

$db = new mysqli();
$db->connect($dbhost, $dbuser, $dbpass, $dbname);
$db->set_charset("utf8");

//	Check Connection
if ($db->connect_errno) {
    printf("Connect failed: %s\n", $db->connect_error);
    exit();
}
/************************************************
	Search Functionality
************************************************/

// Define Output HTML Formating
$html = '';
$html .= '<li class="result">';
$html .= '<h4>nameString</h4>';
$html .= '<h4>functionString</h4>';
$html .= '</li>';

// Get Search
$search_string = preg_replace("/[^A-Za-z0-9]/", " ", $_POST['query']);
$search_string = $db->real_escape_string($search_string);

// Check Length More Than One Character
if (strlen($search_string) >= 1 && $search_string !== ' ') {
	// Build Query
	$query = 'SELECT * FROM Users WHERE FIRST_NAME LIKE "%'.$search_string.'%" OR LAST_NAME LIKE "%'.$search_string.'%" ORDER BY LAST_NAME ASC;';

	// Do Search
	$result = $db->query($query);
	while($results = $result->fetch_array()) {
		$result_array[] = $results;
	}

	// Check If We Have Results
	if (isset($result_array)) {
		foreach ($result_array as $result) {

			
			$first_name = preg_replace("/".$search_string."/i", "<b class='highlight'>".$search_string."</b>", $result['FIRST_NAME']);
			$last_name = preg_replace("/".$search_string."/i", "<b class='highlight'>".$search_string."</b>", $result['LAST_NAME']);

			
			if($result['PERMISSION'] == 3){ //admin
				$output = '<a href="?act=profile&u='.$result['USERNAME'].'"<li class="list-group-item list-group-item-danger"><h4>'.$first_name.' '.$last_name.'<span class="badge" style="float:right">Admin</span></h4></li></a>';
			} elseif($result['PERMISSION'] == 2){ //driver
				$output = '<a href="?act=profile&u='.$result['USERNAME'].'"<li class="list-group-item list-group-item-info"><h4>'.$first_name.' '.$last_name.'<span class="badge"  style="float:right">Driver</span></h4></li></a>';
			} elseif($result['PERMISSION'] == 1){ //student
				$output = '<a href="?act=profile&u='.$result['USERNAME'].'"<li class="list-group-item list-group-item-success"><h4>'.$first_name.' '.$last_name.'<span class="badge" style="float:right">Student</span></h4></li></a>';
			} elseif($result['PERMISSION'] == 0){ //guest
				$output = '<a href="?act=profile&u='.$result['USERNAME'].'"<li class="list-group-item"><h4>'.$first_name.' '.$last_name.'<span class="badge"  style="float:right">Guest</span></h4></li></a>';
			} else{ //inactive / everyone else??
				$output = '<a href="?act=profile&u='.$result['USERNAME'].'"<li class="list-group-item list-group-item-warning"><h4>'.$first_name.' '.$last_name.'<span class="badge"  style="float:right">Inactive</span></h4></li></a>';
			}
			// Output
			echo($output);
		}
	}else{

		// Format No Results Output
		$output = str_replace('urlString', 'javascript:void(0);', $html);
		$output = str_replace('nameString', '<b>No Results Found.</b>', $output);
		$output = str_replace('functionString', 'Sorry :(', $output);

		// Output
		echo($output);
	}
}


?>