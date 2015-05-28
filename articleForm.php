<?php
include_once("check_login_status.php");
if(!$user_ok){
	header("location: index.php");
	exit();
}

$thisUser = User::getFromId($log_id, $db);
$editMode = false;
if(!empty($_GET['id'])){
	$article = Article::getFromId($_GET['id'], $db);
	if(!$article->getId()){
		//article does not exist error out!
		echo 'Invalid article id passed!';
		exit;
	}elseif($article->getOwnerId() != $log_id){
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
		<form enctype="multipart/form-data" id="articleForm">

			<?php if($editMode){?>
				<input type="hidden" name="article_id" id="article_id" value="<?=$article->getId()?>"> 
			<?php } ?>

			<h4 class="formTitle"><?=($editMode?'Edit Article':'Create Article')?></h4>
			<div class="">
				<h5>Cover Image</h5>
				<div class="file-upload" style="width: 322px;">
					<div class="file-select">
						<div class="file-select-button" id="fileName">Choose File</div>
						<div class="file-select-name" id="noFile">No file chosen...</div> 
						<input type="file" name="file" id="chooseFile">
					</div>
				</div>
				<h5>TITLE</h5>
				<input type="text" name="article_title" id="article_title" <?=($editMode?'value="'.$article->getTitle().'"':'')?> >
			</div>
			<h5>BODY</h5>
			<textarea style="height: 400px;" name="article_body" id="article_body"><?=($editMode?$article->getBody():'')?></textarea>
			<p id="status"></p>
			<button class="btn"><?=($editMode?'Save':'Create Article')?></button>
		</form>
	</div>
</div>

<script>
	$(function(){
		articleForm.init();
	});
</script>
<script src="//tinymce.cachefly.net/4.1/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: "textarea",
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
});
</script>
