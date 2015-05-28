<?php
include_once("../check_login_status.php");

// var_dump($_POST);
if(!empty($_POST['type'])){
	if($_POST['type'] == 'campaign'){
		if(empty($_POST['campaignid'])){
			//no campaign id passed, error out
			echo json_encode(array('status'=>'no campaign found'));
			exit();
		}

		$campaign = Campaign::getFromId($_POST['campaignid'], $db);
		if(!$campaign->getId()){
			//no campaign found, error out
			echo json_encode(array('status'=>'no campaign found'));
			exit();
		}

		$user = User::getFromId($log_id, $db);
		$appreciate = Appreciate::getFromContentIdAndUserId($_POST['campaignid'], $log_id, $db);
		if(!$appreciate->getId()){
			//no appreciate found, add appreciate
			$appreciate = new Appreciate();
			$appreciate->setUserId($log_id);
			$appreciate->setContentId($campaign->getId());
			$appreciate->setType('campaign');
			$appreciate->save($db);

			echo json_encode(array('status'=>'appreciated', 'userid'=>$log_id, 'userimg'=>$user->getImg()));
			exit();
		}else{
			//appreciate found unappreciated
			$appreciate->delete($db);
			echo json_encode(array('status'=>'unappreciated', 'userid'=>$log_id));
			exit();
		}

	}
}
