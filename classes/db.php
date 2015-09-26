<?php
// Mongodb Kolour connector
function db_connect($dbname) {
	$server = "mongodb://localhost:27017";
	// Create Mongo Construct 
	$m = new MongoClient($server);
	// Connect to database
	$db = $m->$dbname;

	return $db;
}

// Mysql Kolour connector 
function mysql_db_connect($dbname) {
	$dsn = 'mysql:host=localhost;dbname='.$dbname;
	$user = 'root';
	$password = 'root';

	try {
		$dbh = new PDO($dsn, $user, $password);
	} catch (PDOException $e) {
		echo 'Connection failed: ' . $e->getMessage();
	}

	return $dbh;
}

$mongodb = db_connect('kolour');
$mysqldb = mysql_db_connect('kolour');

// $ok = db_connect("kolour");
// var_dump($ok);
