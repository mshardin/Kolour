<?php 
include('_header.php'); 
include('inc/fns.php');

//createUserProfDir($_SESSION['user_name']);
?>
<style>
table.hovertable {
	font-family: verdana,arial,sans-serif;
	font-size:11px;
	color:#333333;
	border-width: 1px;
	border-color: #999999;
	border-collapse: collapse;
}
table.hovertable th {
	background-color:#c3dde0;
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #a9c6c9;
}
table.hovertable tr {
	background-color:#d4e3e5;
}
table.hovertable td {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #a9c6c9;
}
body { margin: 0; }
/*table { width: 100%; border-collapse: collapse; text-align: center; vertical-align: middle; }
td { border-right: 1px solid grey; width: 33%;}
#middle form { border-bottom: 1px solid grey; } 
input[name=status] { height: 100px; width: 200px; }
.float-right { float: right; }
.float-left { float: left; }
#left { padding: 50px;}
	*/
</style>

<div class="container_12">

	<div class="grid_2" style="border-right: 1px solid black; height: 100%; min-height: 700px; overflow: hidden;">
		<h2>
		<?php
		// if you need the user's information, just put them into the $_SESSION variable and output them here
		echo $_SESSION['user_name'] . "(" . $_SESSION['user_email'] . ")" . "<br />";
		?>
		</h2>
		
		<a href="<?php echo $_SERVER['BASE_NAME'] . '/users/'. $_SESSION['user_name']; ?>"><img src="http://www.gravatar.com/avatar/ <?php md5($_SESSION['user_email']); ?>"/></a>
		<?php
		//echo $login->user_gravatar_image_url; 
		//echo WORDING_PROFILE_PICTURE . '<br/>' . $login->user_gravatar_image_tag;
		?>

		<div>
			<a href="<?php echo $_SERVER['BASE_NAME'] . '/users/'. $_SESSION['user_name']; ?>">Edit Profile</a>
			<a href="index.php?logout">Log Out</a>
			<a href="edit.php">Edit Settings</a>
		</div>

		<div>
			
		</div>			
	</div>
		
	<?php include('_footer.php'); ?>
</div>