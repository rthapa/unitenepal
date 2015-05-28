<?php
include_once("../check_login_status.php");
// var_dump($_POST);
// if($_FILES['file']['name']){
// 	$fileName = $_FILES["file"]["name"]; // The file name
// 	$fileTmpLoc = $_FILES["file"]["tmp_name"]; // File in the PHP tmp folder
// 	$fileType = $_FILES["file"]["type"]; // The type of file it is
// 	$fileSize = $_FILES["file"]["size"]; // File size in bytes 1024000 -> 1mb
// 	$fileErrorMsg = $_FILES["file"]["error"]; // 0 for false... and 1 for true
// 	//random string generator
// 	$num_files = count(glob('../files/'."*"));
// 	$random_name = randStrGen(7);
// 	//$random_name .= + $num_files;
// 	//$exts = explode('.',$fileName);
// 	//$store_rand_name_ext = $random_name.'.'.$exts[1];
// 	$pi = pathinfo($fileName);
// 	$txt = $pi['filename'];
// 	$ext = $pi['extension'];
// 	$store_rand_name_ext = $random_name.'.'.$ext;
// 	if (!$fileTmpLoc) { // if file not chosen
// 	    echo "ERROR: Please browse for a file before clicking the upload button.";
// 	    exit();
// 	}
// 	//$fileName
// 	if(move_uploaded_file($fileTmpLoc, "../files/$store_rand_name_ext")){

// 	}else{
// 		//failed upload
// 	}

