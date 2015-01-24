<?php
session_start();
// load functions
include("../../inc/fns.php");
include("../../inc/db_fns.php");

// print header
include('../../views/_header.php');
?>

<main class="container_12">
	<aside class="grid_2" style="border-right: 1px solid black; height: 100%; min-height: 700px; overflow: hidden;">
		<h2>
		<?php
		// if you need the user's information, just put them into the $_SESSION variable and output them here
		echo $_SESSION['user_name'] . "<br />";
		?>
		</h2>
		
		<a href="<?php echo $_SERVER['BASE_NAME'] . '/users/'. $_SESSION['user_name']; ?>"><img src="http://www.gravatar.com/avatar/ <?php md5($_SESSION['user_email']); ?>"/></a>
		<?php
		//echo $login->user_gravatar_image_url; 
		//echo WORDING_PROFILE_PICTURE . '<br/>' . $login->user_gravatar_image_tag;
		?>

		<article>
			<a href="<?php echo $_SERVER['BASE_NAME'] . '/users/'. $_SESSION['user_name']; ?>">Edit Profile</a>
			<a href="index.php?logout">Log Out</a>
			<a href="edit.php">Edit Settings</a>
		</article>				
	</aside>

	<section>
		<article id="basic-info-table" class="grid_5 ">
			<?php printBasicInfoTable(); ?>
		</article>
	</section>
</main>
<?php 
include("../../views/_footer.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
	$collection = mongoConnect();

	$id = hash('sha1', $_SESSION['user_email']);
	$user_id = $_SESSION['user_id'];
	$user_name = $_SESSION['user_name'];
	$user_email = $_SESSION['user_email'];
	$birthplace = clean($_POST['birthplace']);
	$current_loc = clean($_POST['current_loc']);
	$race = clean($_POST['race']);
	$sex = clean($_POST['sex']);
	$hec = clean($_POST['hec']);
	$degree = clean($_POST['degree']);
	$speciality = clean($_POST['speciality']);
	$skills = $_POST['skills'];

	$profile = [
	"_id" => $id, "user_id" => $user_id, "user_name" => $user_name,
	"user_email" => $user_email, "birthplace" => $birthplace,
	"current_loc" => $current_loc, "race" => $race, "sex" => $sex,
	"hec" => $hec, "degree" => $degree, "speciality" => $speciality,
	"skills" => 
	[
		[
		"skill" => $skills['skill'][0], "desc" => $skills['desc'][0], "exp" => $skills['exp'][0]
		],
		[
		"skill" => $skills['skill'][1], "desc" => $skills['desc'][1], "exp" => $skills['exp'][1]
		]
	]
	];

	if($collection->findOne(['_id' => hash('sha1', $_SESSION['user_email'])])) {
		if(isset($birthplace)) {
			$collection->update(["birthplace" => $birthplace]);
		}
	} else {
		$collection->insert($profile);
		// for($i = 0; $i < count($skills); $i++) {
		// 	$skill = $skills['skill'][$i];
		// 	$desc = $skills['desc'][$i];
		// 	$exp = $skills['exp'][$i];
		// 	$skills_doc = ["skills" => ['$push' => ["skill" => $skill, "desc" => $desc, "exp" => $exp ]]];
		// 	$collection->insert($skills_doc);
		// }
		echo('Successful insertion of business documents.');
	}
}
?>