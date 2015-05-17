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
	<div class="loginWrapper">
		<div class="loginBox">
			<div class="loginLeft">
				<h4>Login</h4>
				<form style="padding: 0 70px;" id="loginform">
					<span class="inputWrapper">
						<span><i class="fa fa-envelope"></i></span>
						<input class="formIn" id="email" name="email" type="text" maxlength="88" placeholder="Email">
					</span>
					<br>
					<div style="clear:both"></div>
					<span class="inputWrapper">
						<span><i class="fa fa-lock"></i></span>
						<input class="formIn" type="password" name="password" id="password" maxlength="100" placeholder="Password"> 
					</span>
					<div style="clear:both"></div>
					<p id="status"></p>
					
					<button style="width: 250px; margin-top:0px" class="btn" type="submit">Log in</button>
				</form>
			</div>
			<div class="loginRight">
				<a href="https://www.facebook.com/dialog/oauth?client_id=411224929057030&amp;redirect_uri=http://beta.unitenepal.org/includes/fbTokenHandler.php&amp;scope=email" title="Signup with facebook">
					<button class="fbBtn" style="margin-top: 115px;"><i class="fa fa-facebook fbBtn_logo"></i><span class="fbBtn_text">Login with Facebook</span></button>
				</a>
			</div>
			<div style="clear:both;"></div>
			<div class="registerFooter loginFooter">
				<p>Forgot your password? Click here</p>
				<p style="padding-top:0px"><a href="register.php">Need a new account? Register here</a></p>
			</div>
		</div>
	</div>
</div>
<script>
	$(function() {
		login.init();
	});
</script>
