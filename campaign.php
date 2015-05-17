<?php
include_once("check_login_status.php");

if(empty($_GET['id'])){
	header("location: error.php?msg=No campaign id passsed or invalid campaign id.");
	exit();
}
$campaignId = preg_replace('/\D/', '', $_GET['id']);

$campaign = Campaign::getFromId($campaignId, $db);
$date = explode(' ', $campaign->getHappeningDate());
$date = date('F jS, Y', strtotime($date[0]));

// $articleOwner = User::getFromId($article->getOwnerId(), $db);

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

</style>
<div class="bodywrapper">
	<?php include_once('includes/nav.php'); ?>
	<div class="coverImgWrapper">
		<div style="width:1200px; margin:0 auto;position:relative;">
			<img src="<?=$campaign->getImg()?>" class="coverImg">
		</div>
	</div>
	<div class="campaignViewContent">
		<div style="padding: 0px 100px;">
			<h4><?=$campaign->getTitle()?></h4>
			<!-- <div class="verticalLine"></div> -->
			<h5 style="margin-bottom: 10px;"><i class="fa fa-calendar" style="color:#FA6145"></i> <?=$date?></h5>
			<h5><i class="fa fa-map-marker" style="color:#FA6145"></i> <?=$campaign->getLocation()?></h5>
			<!-- <div class="verticalLine"></div> -->
			<p><?=nl2br ($campaign->getDescription())?></p>
			<!-- <div class="verticalLine" style="margin: 20px auto 20px;"></div> -->
		</div>
	</div>
</div>
