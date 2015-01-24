<?php

include("db.php");

$skills = $_POST["skills"];
$titles = $_POST["titles"];
$years 	= $_POST["years"];
$descs 	= $_POST["descs"];

// $db = db_connect("kolour");
// $c = $db->profile;

// $result['skills'] 	= $skills;
// $result['titles'] 	= $titles;
// $result['years'] 	= $years;
// $result['descs'] 	= $descs;

echo json_encode(array("skills" => $skills, "titles" => $titles, "years" => $years, "descs" => $descs));
//echo json_encode($result);

