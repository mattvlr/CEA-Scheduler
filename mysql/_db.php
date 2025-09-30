<?php
//call this file in order to connect to the database, there is an example of this in test.php
$base_url = 'http://localhost';
abstract class db_info
{	
	////////////////////////////////////////////
	// Our MySql Connection information
	// $base_url - used for link generation
	////////////////////////////////////////////
        const DB_SERVER = 'localhost';
        const DB_PORT = '';
        const DB_USERNAME = 'demo';
        const DB_PASSWORD = 'demo';
        const DB_DATABASE = 'Scheduler';
    const BASE_URL = 'http://localhost';
	
	public $failed = false;
	protected $cur_query = "";
	public $query_id = null;
	protected $connection_id = null;
}
?>