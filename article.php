<?php
include_once("check_login_status.php");

if(empty($_GET['id'])){
	header("location: error.php?msg=No article id passsed or invalid article id.");
	exit();
}
$articleId = preg_replace('/\D/', '', $_GET['id']);

$article = Article::getFromId($articleId, $db);
error_log($article->getBody());
$date = explode(' ', $article->getDate());
$date = date('F jS, Y', strtotime($date[0]));

$articleOwner = User::getFromId($article->getOwnerId(), $db);

$html = new Html();
$html->title = 'Unite Nepal';
// $html->faviconUrl = 'favicon.ico';
// $html->css[] = '<link rel="stylesheet" type="text/css" href="styles/style.css">';
$html->css[] = '<link rel="stylesheet" type="text/css" href="styles/article.css">';
$html->js[] = '<script src="js/main.js"></script>';
// $html->meta[] = '<meta name="Description" content="">';
$html->meta[] = '<meta name="Keywords" content="nepal, earthquake, save, pray, information, donate, official">';
echo $html->injectHeader();
?>
<style>

</style>
<div class="bodywrapper articleBodyWrapper">
	<?php include_once('includes/nav.php'); ?>
	<div class="coverImgWrapper">
		<div style="width:1200px; margin:0 auto;position:relative;">
			<img src="files/<?=$article->getCoverImg()?>" class="coverImg articleImg">
			<img src="<?=$articleOwner->getImg()?>" class="articleViewUserImg"/>
		</div>
	</div>
	<div class="articleViewContent">
		<div style="padding: 50px 100px; border-bottom: 1px solid #e1e1e1;">
			<h4><?=$article->getTitle()?></h4>
			<h5 style="font-size: 16px;"><?=$date?></h5>
			<div class="articleBody editable"><?=nl2br($article->getBody())?></div>
		</div>
	</div>
	<div class="articleFooter">
		
	</div>
</div>
<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: "div.editable",
    inline: true,
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
});
</script>
