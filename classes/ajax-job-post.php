<?php
ini_set('display_errors', 1);
error_reporting(-1);

include_once('db.php'); 

// connect to mongodb kolour database
$db = db_connect("kolour");
$c = $db->jobs;
$c->ensureIndex(['_id' => 1], ['unique' => 1, 'dropDups' => 1]);

// Retrieve data from Job Post Form
$date          = getdate(); // data
$company       = trim($_POST['comp-name']); // company name
$job_title     = trim($_POST['job-title']); // job title 
$job_desc      = trim($_POST['job-desc']); // job description 
$salary        = trim($_POST['salary']); // salary 
$job_type      = $_POST['job-type']; // job type 
$k_score_limit = $_POST['k-score-limit']; // kolour score limit
$lat           = $_POST['lat']; // latitude 
$long          = $_POST['long']; // longitude 
$tags          = $_POST['tags']; // tags

$jid           = md5($job_title . $date);

// create a document to store in mongodb
$doc = [
    "_id"           => $jid,
    "date"          => [$date['month'], $date['mday']],
    "company"       => $company,
    "title"         => $job_title,
    "description"   => $job_desc,
    "salary"        => $salary,
    "type"          => $job_type,
    "k-score-limit" => $k_score_limit,
    "location"      => [$lat, $long],
    "tags"          => [$tags[0], $tags[1], $tags[2], $tags[3], $tags[4]]
];

// try to post or echo error message 
try {
    if ($c->insert($doc)) {
        echo "Your job has been successfully posted.";
        $_POST = [];
    } else {
        echo "<p style='color:red;'>* Please fill in all the required fields.";
    }
} catch (MongoException $e) {
    die("Failed to insert data " . $e->getMessage());
}

// check if tag exist in database already
function tagCheckExists($db, $tagsArray) {
    // hold all the tags that aren't already stored in db
    $array = [];

    // loop through the tags that were sent with job post
    foreach ($tagsArray as $key => $value) {
        // query string for find if a tag exists
        $sql = "SELECT tag_name FROM tags WHERE tag_name = '$value' LIMIT 1";

        $stmt = $db->prepare($sql);
        $stmt->execute();

        // if any rows were affected the tag was found 
        // if not insert into `tags` table
        $count = $stmt->rowCount();

        if ($count) {
            echo $value . ' tag was found';
        } else {
            echo $value . 'tag not found';
            try {
                $sqlTagInsert = "INSERT INTO tags (tag_name) VALUES ('$value')";
                $db->exec($sqlTagInsert);
            } catch (PDOException $e) {
                echo $sql . "<br>" . $e->getMessage();
            }
        }
    } 
}