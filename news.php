<?php

require_once('classes/Newsreader.php');

$token = 'a2dcUEPHFtEtkrhSqMSJ'; // Token for authentication

$reader = new NewsReader( $token ); // Instantiate a NewsReader object

$feed = $reader->getCategoryFeed( $frag ); // Returns all feeds relating to that 

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

