<?php

$base_url = 'http://localhost:3306';
abstract class db_info
{	
	////////////////////////////////////////////
	// Our MySql Connection information
	// $base_url - used for link generation
	////////////////////////////////////////////
	const DB_SERVER = '104.131.179.153';
	const DB_PORT = '';
	const DB_USERNAME = 'web';
	const DB_PASSWORD = 'cea';
	const DB_DATABASE = 'Scheduler';
    const BASE_URL = 'http://104.131.179.153:3306';
	
	public $failed = false;
	protected $cur_query = "";
	public $query_id = null;
	protected $connection_id = null;
}
?>