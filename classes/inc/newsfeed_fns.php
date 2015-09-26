<?php 
function getEngadgetFeed() {
	$ch = curl_init("http://cloud.feedly.com/v3/mixes/contents?streamId=feed/http://www.engadget.com/rss.xml&count=4&hours=8&backfill=true");
	$fp = fopen("../data.json", "w");

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
	curl_setopt($ch, CURLOPT_FILE, $fp);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2194.2 Safari/537.36');

	curl_exec($ch);
	curl_close($ch);
	fclose($fp);

	$json_loc = file_get_contents(__DIR__."/../data.json");
	$json = json_decode($json_loc, true);

	foreach ($json['items'] as $key => $value) {
		$json_array[$key]['origin'] = $value['originId'];
		$json_array[$key]['title'] = htmlentities($value['title']);
		$json_array[$key]['summary'] = $value['summary']['content'];
		$json_array[$key]['author'] = $value['author'];
		$json_array[$key]['image_url'] = $value['visual']['url'];
		$json_array[$key]['image_width'] = $value['visual']['width'];
		$json_array[$key]['image_height'] = $value['visual']['height'];
		$json_array[$key]['thumbnail'] = $value['thumbnail'][0]['url'];
		$json_array[$key]['href'] = $value['alternate'][0]['href'];
	}

	return $json_array;
}

function getWorkBuzzFeed() {
	$ch = curl_init("http://cloud.feedly.com/v3/mixes/contents?streamId=feed/http://feeds.feedburner.com/theworkbuzz/posts&count=4&hours=8&backfill=true");
	$fp = fopen("../data.json", "w");

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
	curl_setopt($ch, CURLOPT_FILE, $fp);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2194.2 Safari/537.36');

	curl_exec($ch);
	curl_close($ch);
	fclose($fp);

	$json_loc = file_get_contents(__DIR__."/../data.json");
	$json = json_decode($json_loc, true);

	foreach ($json['items'] as $key => $value) {
		$json_array[$key]['origin'] = $value['originId'];
		$json_array[$key]['title'] = htmlentities($value['title']);
		$json_array[$key]['summary'] = $value['summary']['content'];
		$json_array[$key]['author'] = $value['author'];
		$json_array[$key]['image_url'] = $value['visual']['url'];
		$json_array[$key]['image_width'] = $value['visual']['width'];
		$json_array[$key]['image_height'] = $value['visual']['height'];
		$json_array[$key]['thumbnail'] = $value['thumbnail'][0]['url'];
		$json_array[$key]['href'] = $value['alternate'][0]['href'];
	}

	return $json_array;
}

function getTechCrunchFeed() {
	$ch = curl_init("http://cloud.feedly.com/v3/mixes/contents?streamId=feed/http://techcrunch.com/feed&count=4&hours=8&backfill=true");
	$fp = fopen("data.json", "w");

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
	curl_setopt($ch, CURLOPT_FILE, $fp);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2194.2 Safari/537.36');

	curl_exec($ch);
	curl_close($ch);
	fclose($fp);

	$json_loc = file_get_contents(__DIR__."/data.json");
	$json = json_decode($json_loc, true);

	foreach ($json['items'] as $key => $value) {
		$json_array[$key]['origin'] = $value['originId'];
		$json_array[$key]['title'] = htmlentities($value['title']);
		$json_array[$key]['summary'] = $value['summary']['content'];
		$json_array[$key]['author'] = $value['author'];
		$json_array[$key]['image_url'] = $value['visual']['url'];
		$json_array[$key]['image_width'] = $value['visual']['width'];
		$json_array[$key]['image_height'] = $value['visual']['height'];
		$json_array[$key]['thumbnail'] = $value['thumbnail'][0]['url'];
		$json_array[$key]['href'] = $value['alternate'][0]['href'];
	}

	return $json_array;
}

function getCareerRealismFeed() {
	$ch = curl_init("http://cloud.feedly.com/v3/mixes/contents?streamId=feed/http://www.careerealism.com/feed&count=4&hours=8&backfill=true");
	$fp = fopen("../data.json", "w");

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 0);
	curl_setopt($ch, CURLOPT_FILE, $fp);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2194.2 Safari/537.36');

	curl_exec($ch);
	curl_close($ch);
	fclose($fp);

	$json_loc = file_get_contents(__DIR__."/../data.json");
	$json = json_decode($json_loc, true);

	foreach ($json['items'] as $key => $value) {
		$json_array[$key]['origin'] = $value['originId'];
		$json_array[$key]['title'] = htmlentities($value['title']);
		$json_array[$key]['summary'] = $value['summary']['content'];
		$json_array[$key]['author'] = $value['author'];
		$json_array[$key]['image_url'] = $value['visual']['url'];
		$json_array[$key]['image_width'] = $value['visual']['width'];
		$json_array[$key]['image_height'] = $value['visual']['height'];
		$json_array[$key]['thumbnail'] = $value['thumbnail'][0]['url'];
		$json_array[$key]['href'] = $value['alternate'][0]['href'];
	}

	return $json_array;
}


$gadget_feed = getEngadgetFeed();
$buzz_feed = getWorkBuzzFeed();
$crunch_feed = getTechCrunchFeed();
//$careal_feed = getCareerRealismFeed();