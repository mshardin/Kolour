<?php include('_header.php'); ?>

<!-- show registration form, but only if we didn't submit already -->
<?php if (!$registration->registration_successful && !$registration->verification_successful) { ?>
<form id="sign-up" method="post" action="register.php" name="registerform">
	<label for="user_name"><?php echo WORDING_REGISTRATION_USERNAME; ?></label>
	<input id="user_name" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" placeholder="User Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'User Name'" required />

	<label for="user_email"><?php echo WORDING_REGISTRATION_EMAIL; ?></label>
	<input id="user_email" type="email" name="user_email" placeholder="Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'"required />

	<label for="user_password_new"><?php echo WORDING_REGISTRATION_PASSWORD; ?></label>
	<input id="user_password_new" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" placeholder="New Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'New Password'" />

	<label for="user_password_repeat"><?php echo WORDING_REGISTRATION_PASSWORD_REPEAT; ?></label>
	<input id="user_password_repeat" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" placeholder="Confirm Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Confirm Password'" />

	<!--<img src="tools/showCaptcha.php" alt="captcha" />-->
	<!--<label><?php echo WORDING_REGISTRATION_CAPTCHA; ?></label>-->

	<!--<label for="name" class="hidden">Name</label>-->
	<!--<input type="text" id="name" name="name" class="hidden" placeholder="Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Name'"/>-->

	<button class="btn small-text" style="background:#383034; position:relative;" type="submit" name="register"><span id="btn-text">Start Kolouring</span><img id="arrow" src="../views/Images/go-btn.svg"></button>
</form>
<?php } else { ?>
	<p>
    	<!--<a href="index.php"><?php // echo WORDING_BACK_TO_LOGIN; ?></a>-->
    	<?php header("Location: index.php"); ?>
    </p>

<?php } 
include('_footer.php'); 
?>
