<?php
include_once("check_login_status.php");
// if(!$user_ok){
// 	header("location: index.php");
// 	exit();
// }

if(empty($_GET['id'])){
	header("location: error.php?msg=No user id passsed or invalid user id.");
	exit();
}

$userid = preg_replace('/\D/', '', $_GET['id']);
$fieldsEmpty = false;
$thisUser = User::getFromId($userid, $db);
if(!$thisUser->getId()){
	header("location: error.php?msg=No user id passsed or invalid user id.");
	exit();
}

if(trim($thisUser->getLocation()) == '' ||
	trim($thisUser->getImg()) == '' ||
	trim($thisUser->getPassword()) == '' ||
	trim($thisUser->getEmail()) == ''){
	$fieldsEmpty = true;
}

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
<div class="bodywrapper">
<div class="tooltip">
	<div class="tooltipOption">Information</div>
	<p>You need to fill all the fields in your 'About me' section. Click below to fill 'About me' form.</p>
	<button class="btn" style="margin: 0px 0px 18px 20px;  padding: 12px 10px;">About me</button>
</div>
<?php include_once('includes/nav.php'); ?>
	<div class="dash_head_wrapper">
		<div class="dash_head">
			<div class="dash_head_img_wrapper">
				<img src="<?=(trim($thisUser->getImg()) != ''?$thisUser->getImg():'images/maleavatar.png')?>" >
				<?=($fieldsEmpty && $userid == $log_id?'<i class="fa fa-exclamation emptyFieldNotice"></i>':'')?>
			</div>
			<h3><?=$thisUser->getRealName().' '.$thisUser->getRealSurname()?></h3>
			<h4 class="points">0 points</h4>
			<h4 class="gender"><i class="fa fa-transgender"></i> <?=$thisUser->getGender()?></h4>
			<?php if(trim($thisUser->getLocation()) != ''){ ?>
			<h4 class="gender"><i class="fa fa-map-marker"></i> <?=$thisUser->getLocation()?></h4>
			<?php } ?>
			<div class="dash_nav">
				<ul>
					<li data-id="user_about" class="clearFloat">About</li>
					<li data-id="user_articles" class="dash_nav_active">Articles</li>
					<li data-id="user_campaigns">Campaigns</li>
					<li data-id="user_blogs">Blogs</li>
				</ul>
			</div>
		</div>
	</div>
	<div>
		<div class="user_tab user_about tab_hide">
			<h4 class="tab_title">About</h4>
			<div style="padding:20px" class="contents">
			</div>
		</div>
		<div class="user_tab user_articles tab_show">
			<h4 class="tab_title">Articles</h4>
			<div style="padding:20px" class="contents">
				<?php if($thisUser->getId() == $log_id){?>
					<div class="createWrapper">
						<button class="btn user_tab_create_btn">Create Article</button></a>
					</div>
				<?php } ?>
				<div class="dynamicContent">
					
				</div>
			</div>
		</div>
		<div class="user_tab user_campaigns tab_hide">
			<h4 class="tab_title">Campaigns</h4>
			<div style="padding:20px" class="contents">
				<?php if($thisUser->getId() == $log_id){?>
					<div class="createWrapper">
						<button class="btn user_tab_create_btn" id="createCampaignBtn">Start Campaign</button></a>
					</div>
				<?php } ?>
				<div class="dynamicContent">
					
				</div>
			</div>
		</div>
		<div class=" user_tab user_blogs tab_hide">
			<h4 class="tab_title">Blogs</h4>
			<div style="padding:20px" class="contents">
			</div>
		</div>
	</div>
</div>

<script>
	$(function() {
		user.init(<?=$userid?>);
	});


</script>
