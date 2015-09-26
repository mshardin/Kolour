<?php

include_once('classes/Newsreader.php');

$frag = $_GET['cat']; // get the cat(category) variable to decide which category to view 

$token = 'a2dcUEPHFtEtkrhSqMSJ'; // Token for authentication

$reader = new Newsreader( $token ); // Instantiate a NewsReader object

$feed = $reader->getCategoryFeed( $frag ); // Returns all feeds relating to the frag

foreach ( $feed['items'] as $key => $value ) {
	$feedContent = purge($feedContent = $value['summary']['content']);

	$feed_array[$key]['title']     = htmlentities($value['title']);
	$feed_array[$key]['blog_name'] = htmlentities($value['origin']['title']);
	$feed_array[$key]['date_pub']  = date('F d, Y', $value['published']); // Convert timestamp to Month, Day and Year
	$feed_array[$key]['href']      = $value['canonical'][0]['href'];
	$feed_array[$key]['href2']     = $value['alternate'][0]['href'];
	$feed_array[$key]['image']     = getBackgroundImage($feedContent);
	$feed_array[$key]['summary']   = $value['summary']['content'];
	$feed_array[$key]['author']    = $value['author'];
}

// var_dump($feed);

// foreach ( $feed['items'] as $key => $value ) {

// 	$feedContent = $value['summary']['content'];
// 	// $feedContent = htmlentities($value['summary']['content']);
// 	print_r($feedContent = purge($feedContent));

// 	$feed_array[$key]['title'] 	 = htmlentities($value['title']);
// 	$feed_array[$key]['href'] 	 = $value['canonical'][0]['href'];
// 	$feed_array[$key]['href2'] 	 = $value['alternate'][0]['href'];
// 	echo "<br>";
// 	echo "This is image " . var_dump($feed_array[$key]['image'] = getBackgroundImage($feedContent));
// 	echo "<br>";
// 	$feed_array[$key]['summary'] = $value['summary']['content'];
// 	$feed_array[$key]['author']  = $value['author'];

// 	echo "<br>";
// 	echo "<br>";
// }

