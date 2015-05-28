<?php
include_once("check_login_status.php");
if(!$user_ok){
	header("location: index.php");
	exit();
}

$thisUser = User::getFromId($log_id, $db);
$editMode = false;
if(!empty($_GET['id'])){
	$campaign = Campaign::getFromId($_GET['id'], $db);
	if(!$campaign->getId()){
		//campaign does not exist error out!
		echo 'Invalid campaign id passed!';
		exit;
	}elseif($campaign->getUserId() != $log_id){
		//tryina be sneaky huh ! not this time son, error out!
		echo 'Permission Denied!';
		exit;
	}

	$editMode = true;
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
	background: #e1e1e1 !important;
}
</style>
<div class="bodywrapper" style="background-color:#e1e1e1">
	<?php include_once('includes/nav.php'); ?>
	<div class="campaignFormDiv">
		<form enctype="multipart/form-data" id="launchCampaignForm">

			<?php if($editMode){?>
				<input type="hidden" name="campaign_id" id="campaign_id" value="<?=$campaign->getId()?>"> 
			<?php } ?>

			<h4 class="formTitle"><?=($editMode?'Edit Campaign':'Launch Campaign')?></h4>
			<div class="formLeft">
				<h5>Cover Image</h5>
				<div class="file-upload">
					<div class="file-select">
						<div class="file-select-button" id="fileName">Choose File</div>
						<div class="file-select-name" id="noFile">No file chosen...</div> 
						<input type="file" name="file" id="chooseFile">
					</div>
				</div>
				<h5>TITLE</h5>
				<input type="text" name="campaign_title" id="campaign_title" <?=($editMode?'value="'.$campaign->getTitle().'"':'')?> >
			</div>
			<div class="formRight">
				<h5>DATE</h5>
				<input type="date" name="campaign_date" id="campaign_date" <?=($editMode?'value="'.explode(" ",$campaign->getHappeningDate())[0].'"':'')?> >
				<h5>LOCATION</h5>
				<input type="text" name="campaign_location" id="campaign_location"<?=($editMode?'value="'.$campaign->getLocation().'"':'')?> >
			</div>
			<div style="clear:both"></div>
			<h5>ABOUT</h5>
			<textarea name="campaign_about" id="campaign_about"><?=($editMode?$campaign->getDescription():'')?></textarea>
			<h5>PEOPLE</h5>
			<div class="campaignPeopleForm">
				<?php 
				if($editMode){
					$query = $db->query('SELECT u.img, u.id, u.realname FROM campaign_people cp
											INNER JOIN users u ON u.id = cp.userid
											WHERE campaignid = :campaignid', array(':campaignid'=>$campaign->getId()));
					if(count($query > 0)){
						foreach ($query as $q) {
						?>
							<div class="campaignPeopleImgWrap" data-id="<?=$q['id']?>">
								<img class="supporterImg" data-id="<?=$q['id']?>" title="<?=$q['realname']?>" src="<?=$q['img']?>">
								<?php if($q['id'] != $log_id){?>
								<span id="removePeople"><i class="fa fa-times"></i></span>
								<?php } ?>
							</div>
						<?php
						}
					}
				}else{
					?>
						<div class="campaignPeopleImgWrap" data-id="<?=$thisUser->getId()?>">
							<img class="supporterImg" data-id="<?=$thisUser->getId()?>" title="<?=$thisUser->getRealName()?>" src="<?=$thisUser->getImg()?>">
						</div>
					<?php
				}
				?>
			</div>
			<div style="position:relative">
				<input type="text" placeholder="Type users name here to add" autocomplete="off" id="addPeopleInput">
				<div class="addPeopleSearch">
				</div>
			</div>
			<p id="status"></p>
			<button class="btn"><?=($editMode?'Save':'Launch Campaign')?></button>
		</form>
	</div>
</div>

<script>
	$(function(){
		launchCampaign.init();
	});
</script>
