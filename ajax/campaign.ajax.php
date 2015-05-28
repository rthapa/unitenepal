<?php
include_once("../check_login_status.php");

// var_dump($_POST);
if(isset($_POST['campaign_title'])){
	if(!empty($_POST['campaign_id'])){
		$campaign = Campaign::getFromId($_POST['campaign_id'], $db);
	}else{
		$campaign = new Campaign();
	}
	$campaign->setTitle($_POST['campaign_title']);
	$campaign->setHappeningdate($_POST['campaign_date']);
	$campaign->setLocation($_POST['campaign_location']);
	$campaign->setDescription($_POST['campaign_about']);
	$campaign->setUserId($log_id);

	$peopleArr = json_decode($_POST['people_list']);

	if($campaign->getId()){
		$db->deleteRow('DELETE FROM campaign_people WHERE campaignid = :id', array(':id'=>$campaign->getId()));
	}

	//upload cover pic if available
	if($_FILES['file']['name']){
		//delete the old image first if its the update
		if($campaign->getId()){
			unlink('../files/'.$campaign->getImg());
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
			$campaign->setImg($store_rand_name_ext);
		}else{
			//failed upload
		}
	}

	$campaign->save($db);

	foreach($peopleArr as $people){
		$db->insertRow('INSERT INTO campaign_people SET userid = :userid, campaignid = :campaignid', array(':userid'=>$people, ':campaignid'=>$campaign->getId()));
	}

	header("location: ../campaign.php?id=".$campaign->getId());
	exit();
}
