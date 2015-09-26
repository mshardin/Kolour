<?php
session_start();

//var_dump($_FILES);
$_SESSION['file'] = true;

$allExts = ["webm", "avi", "mov", "qt", "ogv", "ogg", "flv", "wmv", "mp4", "m4p", "m4v", "mpg", "mp2", "mpeg", "mpe", "mpv", "m2v"];
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);

$input_name = $_FILES["file"]["name"];
$input_temp_name = $_FILES["file"]["tmp_name"];
$input_type = $_FILES["file"]["type"];
$input_size = $_FILES["file"]["size"];
$input_error = $_FILES["file"]["error"];

if (in_array($extension, $allExts) && $input_size < 500000000) {
	if ($input_error > 0) {
		echo "Error was found while uploading: " . $input_error . "<br>";
	} else {
		if ($input_type == "video/mp4" || $input_type == "video/webm" || $input_type == "video/ogg") {
			switch ($input_type) {
				case "video/mp4":
					$provideo_ogg = convertVideo($input_temp_name, $extension, "test", ".ogg");
					$provideo_webm = convertVideo($input_temp_name, $extension, "test", ".webm");

					move_uploaded_file($input_temp_name, "uploads/" . $input_name);
					move_uploaded_file($provideo_ogg, "uploads/" . $input_name);
					move_uploaded_file($provideo_webm, "uploads/" . $input_name);
					break;
				
				default:
					# code...
					break;
			}
			move_uploaded_file($input_temp_name, "uploads/" . $input_name);
		} else {
			$provideo_mp4 = convertVideo($input_temp_name, $extension, "test", ".mp4");
			$provideo_ogg = convertVideo($input_temp_name, $extension, "test", ".ogg");
			$provideo_webm = convertVideo($input_temp_name, $extension, "test", ".webm");
			move_uploaded_file($provideo_mp4, "uploads/" . $input_name);
			move_uploaded_file($provideo_ogg, "uploads/" . $input_name);
			move_uploaded_file($provideo_webm, "uploads/" . $input_name);
		}

	}
} else {
	echo "Invalid video format";
}

function convertVideo($inputvideo, $inputtype, $outputvideo, $outputtype) {
	$output = `ffmpeg -i $inputvideo.$inputtype -vcodec copy -vcodec copy $outputvideo.$outputtype`;
	if ($output == null || is_int($output)) {
		echo "Conversion failed: ";
	} else {
		$new_temp_file = $outputvideo.$outputtype;
	}
	return $new_temp_file;
} 
?>