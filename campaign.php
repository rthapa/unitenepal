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
		<div style="width:800px; margin:0 auto;position:relative; padding: 30px;">
			<img src="files/<?=$campaign->getImg()?>" class="coverImg">
		</div>
	</div>
	<div class="campaignViewContent">
		<div style="padding: 0px 100px; text-align:center;">
			<h4><?=$campaign->getTitle()?></h4>
			<?php if($log_id == $campaign->getUserId()){ ?>
				<a href="launchCampaign.php?id=<?=$campaign->getId()?>"><button class="circleBtn" style="  margin:0 0 25px; padding: 10px 15px;"><i class="fa fa-pencil"></i></button></a>
				<button class="circleBtn" style="  margin:0 0 25px; padding: 10px 14px;"><i class="fa fa-trash"></i></button>
			<?php } ?>
			<div class="verticalLine"></div>
			<h5 style="margin-bottom: 10px;"><i class="fa fa-calendar" style="color:#FA6145"></i> <?=$date?></h5>
			<h5><i class="fa fa-map-marker" style="color:#FA6145"></i> <?=$campaign->getLocation()?></h5>
			<div class="verticalLine"></div>
			<h3 class="supportDesc">DESCRIPTION</h3>
			<p><?=nl2br ($campaign->getDescription())?></p>
			
			<div class="verticalLine" style="margin: 20px auto 20px;"></div>
			<h3 class="supportDesc">PEOPLE</h3>
			<!-- <div style="text-align:center;">
				<button class="btn2 support support_btn">Support</button>
			</div> -->
			<div class="peopleDiv">
				<?php
					$query = $db->query('SELECT u.img, u.id, u.realname FROM campaign_people cp
											INNER JOIN users u ON u.id = cp.userid
											WHERE campaignid = :campaignid', array(':campaignid'=>$campaign->getId()));

					if(count($query > 0)){
						foreach ($query as $q) {
							?>
								<div>
									<a href="user.php?id=<?=$q['id']?>"><img class="supporterImg" src="<?=$q['img']?>"></a>
									<h5 class="campaignPeopleName"><?=$q['realname']?></h5>
								</div>
							<?php
						}
					}
				?>
				<div style="clear:both;"></div>
			</div>

			<div class="verticalLine" style="margin: 20px auto 20px;"></div>
			<h3 class="supportDesc">APPRECIATION</h3>
			<div style="text-align:center;">
				<?php
				$appreciateStatus = Appreciate::getFromContentIdAndUserId($campaign->getId(), $log_id, $db);
				?>
				<button class="btn2 support support_btn" id="appreciateBtn" data-id="<?=$campaign->getId()?>">
				<?=($appreciateStatus->getId()?'Appreciated':'Appreciate')?>
				</button>
			</div>
			<div class="supporterDiv">
				<?php
					$appreciateQuery = $db->query('SELECT u.id, u.img FROM appreciate a
											INNER JOIN users u ON a.userid = u.id 
											WHERE contentid = :campaignid', array(':campaignid'=>$campaign->getId()));

					if(count($appreciateQuery > 0)){
						foreach ($appreciateQuery as $q) {
							?>
								<div data-id="<?=$q['id']?>">
									<a href="user.php?id=<?=$q['id']?>"><img class="supporterImg" src="<?=$q['img']?>"></a>
								</div>
							<?php
						}
					}
				?>
				<div style="clear:both;"></div>
			</div>
		</div>
	</div>
</div>
<script>
	$(function(){
		campaign.init();
	});
</script>
