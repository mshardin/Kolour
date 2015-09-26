<?php 
include_once('views/_header.php'); 
include_once('views/menu_bar.php'); 
include_once('views/side_bar.php');
?>
<style type="text/css">
	#row {
		width: 100%;
		height: 100%;
		display: block;
		text-align: center;
	}
	#find-job, #post-job {
		color: black;
		width: 100%;
		height: 50%;
		vertical-align: middle
	}
	#find-job {
		background-color: red;
	}
	#find-job:hover {
		background-color: white;
	}
	#find-job.overlay {
		background-color: SlateGray;
		position: relative;
		width: 100%;
		height: 50%;
		opacity: 0.50;
		-moz-opacity: 50%;
		-webkit-opacity: 50%;
		z-index: 2;
	}
	#post-job {
		background-color: blue;
	}
	#post-job:hover {
		background-color: white;
	}
	#post-job.overlay {
		background-color: Gray;
		position: relative;
		width: 100%;
		height: 50%;
		opacity: 0.50;
		-moz-opacity: 50%;
		-webkit-opacity: 50%;
		z-index: 2;
	}
	#row a {
		color: white;
	}
	#row a:hover {
		color: black;
	}
	#middle-floater {
		float: left;
		height: 50%;
		width: 100%;
		margin-bottom: -50px;
	}
	.active {
		color: ;
	}
</style>
<div id="container">
	<div id="row">
		<div id="find-job" class="overlay">
			<div id="middle-floater"></div>
			<h1><a href="joblist.php">Find Job</a></h1>
		</div>
		<div id="post-job" class="overlay">
			<div id="middle-floater"></div>
			<h1><a href="jobpost.php">Post Job</a></h1>
		</div>
	</div>
</div>
<?php
include_once('views/_footer.php');
?>