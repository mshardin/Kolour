<?php
include_once('db.php'); 

$db = db_connect("kolour");
$c = $db->jobs;
$c->ensureIndex(['_id' => 1], ['unique' => 1, 'dropDups' => 1]);

$date           = getdate();
$company        = trim($_POST['comp-name']);
$job_title      = trim($_POST['job-title']);
$job_desc       = trim($_POST['job-desc']);
$salary         = trim($_POST['salary']);
$job_type       = $_POST['job-type'];
$k_score_limit  = $_POST['k-score-limit'];
$lat            = $_POST['lat'];
$long           = $_POST['long'];

$jid            = md5($job_title . $date);

$doc = [
    "_id"           => $jid,
    "date"          => [$date['month'], $date['mday']],
    "company"       => $company,
    "title"         => $job_title,
    "description"   => $job_desc,
    "salary"        => $salary,
    "type"          => $job_type,
    "k-score-limit" => $k_score_limit,
    "location"      => [$lat, $long]
];

try {
    if ($c->insert($doc)) {
        echo("Your job has been successfully posted.");
        $_POST = [];
    } else {
        echo "<p style='color:red;'>* Please fill in all the required fields.";
    }
} catch (MongoException $e) {
    die("Failed to insert data " . $e->getMessage());
}