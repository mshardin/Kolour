<?php

/**
* Pulls image/video or both from feed
*/
function getBackgroundImage( $string ) {
	$media = array();
	$doc = new DOMDocument();
	@$doc->loadHTML( $string );
	$ixml=simplexml_import_dom($doc);
	$vxml=simplexml_import_dom($doc);

	$image = $ixml->xpath('//img');
	$image = $image[0]['src'];

	$video = $vxml->xpath('//iframe');
	$video = $video[0]['src'];

	if (!empty($image) && !empty($video)) {
		$image = "";
		$media = array($video, $image);
	}

	$media = array($image, $video);
	return $media;
}

// Clears a gif url
function checkForGif( $url ) {
	// $allowExts = ['jpg', 'jpeg', 'png'];
	// $ourl = $url;
	// $urlArray = explode(".", $url);
	// $ext = end($urlArray);
	// if ($ext == "gif" && !in_array($ext, $allowExts)) {
	// 	return "../img/no-image.png";
	// } else {
	// 	return $ourl;
	// }
	return $url;
}

/**
* Pulls out all uncessary Images and 
* Links from RSS content 
*/
function purge( $content ) {
	$content = removeSocialImgs( $content );
	$content = removeSocialLinks( $content );

	return $content;
}

// Removes all uncessary Images 
function removeSocialImgs( $content ) {
	$content = preg_replace("<img src=\"(http?:\/\/feeds.feedburner.com\/\~ff\/jezebel\/excerpts\?[a-z]\=[a-zA-Z0-9:_-]+)\">", "", $content);
	$content = preg_replace("<img src=\"(http?:\/\/feeds.feedburner.com\/\~ff\/businessinsider\?[a-z]\=[a-zA-Z0-9:_-]+)\">", "", $content);
	//$content = preg_replace("/<img[^>]+\>/i", "(image) ", $content);

	return $content;
}

// Removes all uncessary Links
function removeSocialLinks( $content ) {
	$content = preg_replace("<a href=\"(http?:\/\/feeds.feedburner.com\/\~ff\/jezebel\/excerpts\?[a-z]\=[a-zA-Z0-9:_-]+)\">", "", $content);
	$content = preg_replace("<a href=\"(http?:\/\/feeds.feedburner.com\/\~ff\/businessinsider\?[a-z]\=[a-zA-Z0-9:_-]+)\">", "", $content);
	$content = preg_replace("<a href=\"(http?:\/\/feeds.gawker.com\/\~ff\/jezebel\/excerpts\?[a-z]\=[a-zA-Z0-9:_-]+)\">", "", $content);
	$content = preg_replace("[(<>)*]", "", $content);

	return $content;
}

class Newsreader
{
	const VERSION = '0.0.1BETA';
	const DOMAIN = 'https://theoldreader.com';
	const API = '/reader/api/0';
	private $token;
	private $request;

	public $tag_list;

	public function __construct( $token = null )
	{
		$this->token = $token;

		$this->tag_list = array(
			'Technology' => 'user/-/label/Technology',
			'Design' 	 => 'user/-/label/Design',
			'WasteTime'  => 'user/-/label/Waste Time',
			'Science'  	 => 'user/-/label/Science',
			'News'		 => 'user/-/label/News'
		);
	}

	public function getToken( $email, $passwd )
	{
		$args = array(
			'client' => 'Kolour News Reader',
			'accountType' => 'HOSTED_OR_GOOGLE',
			'service' => 'reader',
			'Email' => $email,
			'Passwd' => $passwd,
		);
		return $this->post( self::DOMAIN . self::API . '/accounts/ClientLogin', $args );
	}

	public function getStatus()
	{
		return $this->get( self::DOMAIN . self::API . '/status' );
	}

	public function getUserInfo()
	{
		return $this->get( self::DOMAIN . self::API . '/user-info' );
	}

	public function getItemIds( $s, $xt = null, $n = 1000, $r = false, $c = null, $t = null )
	{
		$args = array(
			's' => $s,
			'xt' => $xt,
			'n' => $n,
			'c' => $c
		);
		if ( $r ) {
			$args['r'] = 'o';
			$args['ot'] = $t;
		} else {
			$args['nt'] = $t;
		}
		return $this->get( self::DOMAIN . self::API . '/stream/items/ids', $args );
	}

	public function getItemContents( $i, $output = 'json' )
	{
		$args = array(
			'i' => $i,
			'output' => $output
		);
		return $this->post( self::DOMAIN . self::API . '/stream/items/contents', $args );
	}

	public function getStreamContents( $i, $s, $output = 'json' )
	{
		$args = array(
			'i' => $this->regexpLabel( $i ),
			's' => isset($s) ? $s : '',
			'output' => $output
		);
		return $this->get( self::DOMAIN . self::API . '/stream/contents', $args );
	}

	public function getCategoryFeed( $category=' ', $s='' ) {

		switch ( $category ) {
			case 'Technology':
				$categoryID = $this->tag_list['Technology'];
				break;
			case 'Design':
				$categoryID = $this->tag_list['Design'];
				break;
			case 'WasteTime':
				$categoryID = $this->tag_list['WasteTime'];
				break;
			case 'Science':
				$categoryID = $this->tag_list['Science'];
				break;
			case 'News':
				$categoryID = $this->tag_list['News'];
				break;
			case ' ':
				$categoryID = 'user/-/state/com.google/starred';
				break;
		}
		
		return $this->getStreamContents($i='',$categoryID);
	}

	private function regexpLabel( $string )
	{
		return 'user/-/label/' . preg_replace( '/user\/-\/label\//', '', $string );
	}

	private function get( $url, $data = array() )
	{
		return $this->request( $url, $data, $method = 'get' );
	}

	private function post( $url, $data = array() )
	{
		return $this->request( $url, $data, $method = 'post' );
	}

	private function request( $url, $data = array(), $method = 'get' )
	{
		$data = array_merge( array( 'output' => 'json' ), $data );
		$headers = array( 'Authorization: GoogleLogin auth=' . $this->token );

		if ( $method == 'get' && $data ) {
			$url = is_array( $data ) ? trim( $url, '/' ) . '/?' . http_build_query( $data ) : trim( $url, '/' ) . '/?' . $data;
		}
		$this->request = curl_init( $url );

		$options = array(
			CURLOPT_HEADER => true,
			CURLOPT_NOBODY => false,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_CONNECTTIMEOUT => 30,
			CURLOPT_USERAGENT => 'Kolour News Feed ' . self::VERSION,
			CURLOPT_SSL_VERIFYPEER => false
		);

		if ( ( $method == 'post' ) && $data ) {
			$options[CURLOPT_POSTFIELDS] = is_array( $data ) ? http_build_query( $data ) : $data;
		}

		if ( $headers ) {
			$options[CURLOPT_HTTPHEADER] = $headers;
		}

		curl_setopt_array( $this->request, $options );
		$result = curl_exec( $this->request );

		$response_parts = explode( "\r\n\r\n", $result, 2 );
		curl_close( $this->request );

		$body = json_decode( $response_parts[1], true );
		return !empty( $body ) ? $body : $response_parts[1];
	}
}