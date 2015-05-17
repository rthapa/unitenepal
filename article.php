<?php
include_once("check_login_status.php");

if(empty($_GET['id'])){
	header("location: error.php?msg=No article id passsed or invalid article id.");
	exit();
}
$articleId = preg_replace('/\D/', '', $_GET['id']);

$article = Article::getFromId($articleId, $db);
$date = explode(' ', $article->getDate());
$date = date('F jS, Y', strtotime($date[0]));

$articleOwner = User::getFromId($article->getOwnerId(), $db);

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
			<img src="<?=$article->getCoverImg()?>" class="coverImg">
			<img src="<?=$articleOwner->getImg()?>" class="articleViewUserImg"/>
		</div>
	</div>
	<div class="articleViewContent">
		<div style="padding: 50px 100px;">
			<h4><?=$article->getTitle()?></h4>
			<h5><?=$date?></h5>
			<p><?=nl2br ($article->getBody())?></p>
		</div>
	</div>
	<div class="articleFooter">
		
	</div>
</div>
