<?php
function mongoConnect() {
	try {
		$db = "nool";
		$coloname = "users";
		$connection = new Mongo();
		$database = $connection->selectDB($db);
		$collection = $database->selectCollection($coloname);
		return $collection;
	} catch(MongoException $e) {
		die('Failed to insert data ' . $e->getMessage());
	}
}
?>