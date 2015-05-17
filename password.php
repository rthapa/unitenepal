<?php
include_once("check_login_status.php");
if(!$user_ok){
	header("location: index.php");
	exit();
}

$loggedUser = User::getFromId($log_id, $db);
$request = '';
if(trim($loggedUser->getPassword()) == ''){
	$request = 'createpwd';
}else{
	$request = 'changepwd';
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

<div class="bodywrapper">
	<?php include_once('includes/nav.php'); ?>
	<?php
		if($request == 'createpwd'){
	?>
		createpwd
	<?php
		}else{
	?>
		changepwd
	<?php
		}
	?>
</div>

