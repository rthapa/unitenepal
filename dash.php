<?php
include_once("check_login_status.php");
if(!$user_ok){
	header("location: index.php");
	exit();
}
$loggedUser = User::getFromId($log_id, $db);
// echo ' ==> '.$_SESSION['email'];
$html = new Html();
$html->title = 'Unite Nepal';
// $html->faviconUrl = 'favicon.ico';
$html->css[] = '<link rel="stylesheet" type="text/css" href="styles/style.css">';
$html->js[] = '<script src="js/main.js"></script>';
// $html->meta[] = '<meta name="Description" content="">';
$html->meta[] = '<meta name="Keywords" content="nepal, earthquake, save, pray, information, donate, official">';
echo $html->injectHeader();
?>

<div class="bodywrapper" style="background-color:#e1e1e1">
<?php include_once('includes/nav.php'); ?>
	<div class="dash_head_wrapper">
		<div class="dash_head">
			<img src="<?=$loggedUser->getImg();?>" >
			<h3><?=$loggedUser->getRealName().' '.$loggedUser->getRealSurname()?></h3>
			<h4>0 points</h4>
			<div class="dash_nav">
				<ul>
					<li class="dash_nav_active"><span>0</span>Campaigns</li>
					<li><span>0</span>Articles</li>
					<li><span>0</span>Blogs</li>
					<li class="clearFloat"><span>0</span>Feed</li>
				</ul>
			</div>
		</div>
	</div>
</div>

<script>
	$(function() {
		
	});
</script>
