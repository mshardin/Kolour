<?php

function db_connect($dbname) {
	$server = "mongodb://localhost:27017";
	// Create Mongo Construct 
	$m = new MongoClient($server);
	// Connect to database
	$db = $m->$dbname;

	return $db;
}

// $ok = db_connect("kolour");
// var_dump($ok);
