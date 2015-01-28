<?php
//call this file in order to connect to the database, there is an example of this in test.php
$base_url = 'http://localhost:3306';
abstract class db_info
{	
	////////////////////////////////////////////
	// Our MySql Connection information
	// $base_url - used for link generation
	////////////////////////////////////////////
	const DB_SERVER = '104.131.179.153'; //ip of server
	const DB_PORT = ''; //port is 3306, but we don't need it 
	const DB_USERNAME = 'web'; //made a username so we know what takes up most resources
	const DB_PASSWORD = 'cea'; //
	const DB_DATABASE = 'Scheduler'; // where we keep our info
    const BASE_URL = 'http://104.131.179.153:3306'; //connection url string
	
	public $failed = false;
	protected $cur_query = "";
	public $query_id = null;
	protected $connection_id = null;
}
?>