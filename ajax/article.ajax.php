<?php
include_once("../check_login_status.php");

// var_dump($_POST);
if(isset($_POST['article_title'])){
	if(!empty($_POST['article_id'])){
		$article = Article::getFromId($_POST['article_id'], $db);
	}else{
		$article = new Article();
	}
	$article->setTitle($_POST['article_title']);
	$article->setBody($_POST['article_body']);
	$article->setOwnerId($log_id);

	//upload cover pic if available
	if($_FILES['file']['name']){
		//delete the old image first if its the update
		if($article->getId()){
			unlink('../files/'.$article->getCoverImg());
		}

		//
		$fileName = $_FILES["file"]["name"]; // The file name
		$fileTmpLoc = $_FILES["file"]["tmp_name"]; // File in the PHP tmp folder
		$fileType = $_FILES["file"]["type"]; // The type of file it is
		$fileSize = $_FILES["file"]["size"]; // File size in bytes 1024000 -> 1mb
		$fileErrorMsg = $_FILES["file"]["error"]; // 0 for false... and 1 for true

		if($fileSize > 3072000){
			//max file limit reached throw error
		}
		//random string generator
		// $num_files = count(glob('../files/'."*"));
		$random_name = User::generateRandomString(7);
		//$random_name .= + $num_files;
		//$exts = explode('.',$fileName);
		//$store_rand_name_ext = $random_name.'.'.$exts[1];
		$pi = pathinfo($fileName);
		$txt = $pi['filename'];
		$ext = $pi['extension'];
		$store_rand_name_ext = $random_name.'.'.$ext;
		if (!$fileTmpLoc) { // if file not chosen
		    echo "ERROR: Please browse for a file before clicking the upload button.";
		    exit();
		}
		if(move_uploaded_file($fileTmpLoc, "../files/".$store_rand_name_ext)){
			$article->setCoverImg($store_rand_name_ext);
		}else{
			//failed upload
		}
	}

	$article->save($db);

	header("location: ../article.php?id=".$article->getId());
	exit();
}
