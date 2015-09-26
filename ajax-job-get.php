<?php 
include_once('db.php');

function getTags($db) {
	$tagArray = [];
	$sql = 'SELECT tag_name FROM tags ORDER BY tag_name';
	foreach ($db->query($sql) as $row) {
		array_push($tagArray, $row['tag_name']);
		// echo $row['tag_name'] . "\n";
	}

	return $tagArray;
}

$tags = getTags($mysqldb);

echo json_encode($tags);
?>