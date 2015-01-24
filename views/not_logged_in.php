<?php include('_header.php'); ?>

<div id="wrapper">
	<div id="sign-bar">
		<img class="login-container" src="../views/Images/kolour-logo2.svg">
		<h1 class="container medium-text">Discover</h1>
		<h2 class="container small-text"><span style="color:#a6d0d0">Search by skill, location, and worktype.</span><br> Online personal branding, create a Kolourful profile now.</h2>
		<form class="login-container" autocomplete="off" method="post" action="index.php" name="loginform">
			<input style="display:none"> <!-- dummy input  -->
			<input type="password" style="display:none"> <!-- dummy input for chrome autofill -->
			<input class="small-text" id="user_name" type="text" name="user_name" placeholder="Email or Username" autocomplete="off" onfocus="this.placeholder = ''" onblur="this.placeholder = 'EMAIL'" required>
			<input class="small-text" id="user_password" type="password" name="user_password" autocomplete="off" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'PASSWORD'" required>
			<input id="user_rememberme" name="user_rememberme" value="1" type="checkbox">
			<label class="label off-center smaller-text" for="user_rememberme"><span></span>Stay logged in</label>
			<button class="btn small-text" style="background:#383034; position:relative;" type="submit" name="login"><span id="btn-text">Start Kolouring</span><img id="arrow" src="../views/Images/go-btn.svg"></button>
		</form>
	<span id="login-footer" class="smaller-text"><a href="register.php">Register</a>|<a href="password_reset.php">Forgot Password?</a></span>
		<img class="login-container" id="banner" src="../views/Images/banner-icons.svg">
		<img id="btm-border" src="../views/Images/point-border.svg">
	</div>
</div>

<?php include('_footer.php'); ?>

<script async src="js/jquery.fittext.js"></script>
<script>
	$(".small-text").fitText(1.9,{minFontSize:"12px",maxFontSize:"40px"});$(".medium-text").fitText(1,{minFontSize:"20px",maxFontSize:"80px"});$(".smaller-text").fitText(2.3,{minFontSize:"12px",maxFontSize:"36px"});
</script>		
