<?php
error_reporting(E_ALL);
ini_set("display_errors", "1");

session_start();

include("db.php");

require( __DIR__ . "/vendor/autoload.php");


$allExts 	 = ["webm", "avi", "mov", "qt", "ogv", "ogg", "flv", "wmv", "mp4", "m4p", "m4v", "mpg", "mp2", "mpeg", "mpe", "mpv", "m2v"];
$temp 		 = explode(".", $_FILES["file"]["name"]);
$extension 	 = end($temp);
$uploads_dir = __DIR__ . "/uploads";


$name 				= $temp[0];
echo $name;
$input_name 		= $_FILES["file"]["name"];
$input_temp_name 	= $_FILES["file"]["tmp_name"];
$input_type 		= $_FILES["file"]["type"];
$input_size 		= $_FILES["file"]["size"];
$input_error 		= $_FILES["file"]["error"];

$user_name 			= $_SESSION["user_name"];
$user_email 		= $_SESSION["user_email"];

$logger = new Monolog\Logger("test");
$logger->pushHandler(new Monolog\Handler\StreamHandler("php://stdout"));

$ffmpeg = FFMpeg\FFMpeg::create(array(
	"ffmpeg.binaries" 	=> "/usr/bin/ffmpeg",
	"ffprobe.binaries" 	=> "/usr/bin/ffprobe",
	"timeout" 			=> 3600, // The timeout for the underlying process
	"ffmmpeg.threads"   => 0, // The number of threads that FFMpeg should use
), $logger);

if (in_array($extension, $allExts) && $input_size < 500000000) {
	if ($input_error > 0) {
		echo "Error was found while uploading: " . $input_error . "<br>";
	} else {
		if (is_uploaded_file($input_temp_name)) {
			move_uploaded_file($input_temp_name, "$uploads_dir/$input_name");

			$db = db_connect("kolour");
			$c = $db->profile;

			$mp4_vid = "/uploads/$input_name";

			$c->update(array("user_name" => $user_name), array('$set' => array("profile_vid" => array("mp4_vid" => $mp4_vid, "ogg_vid" => "test.ogg", "webm" => "test.webm"))));

			$video = $ffmpeg->open("$uploads_dir/$input_name");

			switch ($input_type) {
				case "video/mp4":
				$vidmp4 = "$uploads_dir/$name.mp4";
				try {
					$video
						->filters()
						->resize(new FFMpeg\Coordinate\Dimension(640, 480))
						->synchronize();
					$video
						->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(1))
						->save("$uploads_dir/frame.jpg");

					$formatogg  = new FFMpeg\Format\Video\Ogg();
					$formatwebm = new FFMpeg\Format\Video\WebM();

					$formatogg
						->setKiloBitrate(1000)
						->setAudioChannels(2)
						->setAudioKiloBitrate(256);

					$formatwebm
						->setKiloBitrate(1000)
						->setAudioChannels(2)
						->setAudioKiloBitrate(256);

						$video->save($formatogg, "$uploads_dir/$name.ogg");
						$video->save($formatwebm, "$uploads_dir/$name.webm");

				} catch(Exception $e) {
					echo $e->getMessage();
				}
				break;
				case "video/ogg":
				$vidogg = "$uploads_dir/$name.ogg";
				try {
					$video
						->filters()
						->resize(new FFMpeg\Coordinate\Dimension(640, 480))
						->synchronize();
					$video
						->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(10))
						->save("$uploads_dir/frame.jpg");

					$formatmp4 = new FFMpeg\Format\Video\X264();
					$formatwebm  = new FFMpeg\Format\Video\WebM();

					$formatmp4
						->setKiloBitrate(1000)
						->setAudioChannels(2)
						->setAudioKiloBitrate(256);

					$formatwebm
						->setKiloBitrate(1000)
						->setAudioChannels(2)
						->setAudioKiloBitrate(256);

						$video->save($formatmp4, "$uploads_dir/$name.mp4");
						$video->save($formatwebm, "$uploads_dir/$name.webm");

				} catch(Exception $e) {
					echo $e->getMessage();
				}
				break;
				case "video/webm":
				$vidwebm = "$uploads_dir/$name.webm";
				try {
					$video
						->filters()
						->resize(new FFMpeg\Coordinate\Dimension(640, 480))
						->synchronize();
					$video
						->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(10))
						->save("$uploads_dir/frame.jpg");

					$formatmp4 = new FFMpeg\Format\Video\X264();
					$formatogg  = new FFMpeg\Format\Video\Ogg();

					$formatmp4
						->setKiloBitrate(1000)
						->setAudioChannels(2)
						->setAudioKiloBitrate(256);

					$formatogg
						->setKiloBitrate(1000)
						->setAudioChannels(2)
						->setAudioKiloBitrate(256);

						$video->save($formatmp4, "$uploads_dir/$name.mp4");
						$video->save($formatogg, "$uploads_dir/$name.ogg");

				} catch(Exception $e) {
					echo $e->getMessage();
				}
				break;
				default:
					try {
					$video
						->filters()
						->resize(new FFMpeg\Coordinate\Dimension(640, 480))
						->synchronize();
					$video
						->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(10))
						->save("frame.jpg");

					$formatmp4 = new FFMpeg\Format\Video\X264();
					$formatogg  = new FFMpeg\Format\Video\Ogg();
					$formatwebm  = new FFMpeg\Format\Video\WebM();

					$formatmp4
						->setKiloBitrate(1000)
						->setAudioChannels(2)
						->setAudioKiloBitrate(256);

					$formatogg
						->setKiloBitrate(1000)
						->setAudioChannels(2)
						->setAudioKiloBitrate(256);

					$formatwebm
						->setKiloBitrate(1000)
						->setAudioChannels(2)
						->setAudioKiloBitrate(256);

						$video->save($formatmp4, "$uploads_dir/$name.mp4");
						$video->save($formatogg, "$uploads_dir/$name.ogg");
						$video->save($formatogg, "$uploads_dir/$name.webm");

				} catch(Exception $e) {
					echo $e->getMessage();
				}
			}
		}
	}
} else {
	echo "Invalid video format";
}