<?php
include_once("check_login_status.php");

if($user_ok){
	header("location: user.php?id=".$log_id);
	exit();
}

$html = new Html();
$html->title = 'Unite Nepal';
// $html->faviconUrl = 'favicon.ico';
$html->css[] = '<link rel="stylesheet" type="text/css" href="styles/style.css">';
$html->js[] = '<script src="js/main.js"></script>';
// $html->meta[] = '<meta name="Description" content="">';
$html->meta[] = '<meta name="Keywords" content="nepal, earthquake, save, pray, information, donate, official">';
echo $html->injectHeader();
?>
<style>
	body{
		background-color:#e1e1e1;
	}
</style>
<div class="bodywrapper">
	<?php include_once('includes/nav.php'); ?>
	<div class="registerWrapper">
		<div class="registerBox">
			<div class="registerHeader"></div>
			<div class="registerLeft">
				<form style="padding: 40px 109px;" id="signupForm"><!-- action="signup.php" method="post"-->
					<!-- <span class="inputWrapper">
						<span><i class="fa fa-user"></i></span>
						<input class="formIn" id="username" name="username" type="text" maxlength="88" placeholder="Username">
					</span>
					<br> -->
					<span class="inputWrapper">
						<span><i class="fa fa-user"></i></span>
						<input class="formIn" id="realname" name="realname" type="text" maxlength="88" placeholder="First name">
					</span>
					<br>
					<span class="inputWrapper">
						<span><i class="fa fa-user"></i></span>
						<input class="formIn" id="realsurname" name="realsurname" type="text" maxlength="88" placeholder="Surname">
					</span>
					<br>
					<span class="inputWrapper">
						<span><i class="fa fa-envelope"></i></span>
						<input class="formIn" id="email" name="email" type="text" maxlength="88" placeholder="Email">
						<i id="usernameavailable" style="right: 16px; display: none;" class="fa fa-check-circle availableicon"></i>
						<i id="usernametaken" style="right: 16px; display: none;" class="fa fa-times-circle takenicon"></i>
					</span>
					<br>
					<div style="clear:both"></div>
					<span class="inputWrapper">
						<span><i class="fa fa-lock"></i></span>
						<input class="formIn" type="password" name="password" id="password" maxlength="100" placeholder="Password"> 
						<i id="emailavailable" style="right: 11px; display:none;" class="fa fa-check-circle availableicon"></i>
						<i id="emailtaken" style="right: 11px; display:none;" class="fa fa-times-circle takenicon"></i>
					</span>
					<div style="clear:both"></div>
					<span class="inputWrapper">
						<span><i class="fa fa-lock"></i></span>
						<input class="formIn" type="password" id="repassword" name="repassword" maxlength="100" placeholder="Confirm Password"> 
					</span>
					<div style="clear:both"></div>
					<p id="status"></p>
					
					<button style="width: 250px; margin-top:0px" class="btn" type="submit">Sign up</button>
				</form>
			</div>
			<div class="registerRight">
				<h4>Recommended</h4>
				<a href="https://www.facebook.com/dialog/oauth?client_id=411224929057030&redirect_uri=http://beta.unitenepal.org/includes/fbTokenHandler.php&scope=email" title="Signup with facebook">
					<button class="fbBtn"><i class="fa fa-facebook fbBtn_logo"></i><span class="fbBtn_text">Register with Facebook</span></button>
				</a>
			</div>
			<div style="clear:both;"></div>
			<div class="registerFooter">
				<p><a href="login.php">Already registered? Log in here.</a></p>
			</div>
		</div>
	</div>
</div>

<script>
	$(function() {
		register.init();
	});
</script>
