<?php
include_once("../check_login_status.php");

if(isset($_GET['type'])){

	if($_GET['type'] == 'getUserSearch' && !empty($_GET['keyword'])){
		$users = User::getFromSql('SELECT * FROM users WHERE realname LIKE :keyword OR realsurname LIKE :keyword', 
			array(':keyword'=>'%'.$_GET['keyword'].'%'), $db);
		// echo 'ok';
		$userArr = array();
		if(count($users)>0){
			foreach($users as $user){
				$userArr[] = array(
						'id'=> $user->getId(),
						'img'=>$user->getImg(),
						'realname' => $user->getRealName(),
						'realsurname' => $user->getRealSurname()
					);
			}

			echo json_encode($userArr);
			exit();
		}else{
			echo json_encode(array('status'=>'no results'));
			exit();
		}
	}

	if($_GET['type'] == 'getArticles' && !empty($_GET['userid'])){
		$userid = preg_replace('/\D/', '', $_GET['userid']);
		$articleArr = Article::getFromOwnerId($userid, $db);
		$user = User::getFromId($userid, $db);

		if(count($articleArr) < 1 || !$user->getId()){
			echo json_encode(array("status" => 'no articles'));
			exit();
		}

		$response = array();
		foreach($articleArr as $article){
			$coverimg = 'images/defaultcoverimg.png';
			if(trim($article->getCoverImg()) != ''){
				$coverimg = $article->getCoverImg();
			}

			$bodyPreview = substr($article->getBody(), 0, 190);

			$date = explode(' ', $article->getDate());
			$date = date('F jS, Y', strtotime($date[0]));
			$response[] = array(
					'id'=>$article->getId(),
					'title'=>$article->getTitle(),
					'date'=>$date,
					'updatedate'=>$article->getUpdateDate(),
					'userimg' => $user->getImg(),
					'coverimg'=>$coverimg,
					'body'=>$bodyPreview
				);
		}
		echo json_encode($response);
		exit();
	}

	if($_GET['type'] == 'getCampaigns' && !empty($_GET['userid'])){
		$userid = preg_replace('/\D/', '', $_GET['userid']);
		$campaignArr = Campaign::getFromUserId($userid, $db);
		// echo json_encode($campaignArr);


		if(count($campaignArr) < 1){
			echo json_encode(array("status" => 'no campaigns'));
			exit();
		}

		$response = array();
		foreach($campaignArr as $campaign){
			$description = substr($campaign->getDescription(), 0, 120);

			$date = explode(' ', $campaign->getCreated());
			$date = date('F jS, Y', strtotime($date[0]));

			$happeningDate = explode(' ', $campaign->getHappeningDate());
			$happeningDate = date('F jS, Y', strtotime($happeningDate[0]));
			$response[] = array(
					'id'=>$campaign->getId(),
					'title'=>$campaign->getTitle(),
					'created'=>$date,
					'happeningdate'=>$happeningDate,
					'location' => $campaign->getLocation(),
					'description'=>$description,
					'img'=> $campaign->getImg()
				);
		}
		echo json_encode($response);
		exit();
	}

	if($_GET['type'] == 'getAbout' && !empty($_GET['userid'])){
		$userid = preg_replace('/\D/', '', $_GET['userid']);
		$user = User::getFromId($userid, $db);
		if(!$user->getId()){
			echo json_encode(array("status" => 'user not found'));
			exit();
		}

		$expertise = Expertise::getExpertiseFromUserId($userid, $db);
		$expArr = array();
		foreach($expertise as $exp){
			$expArr[] = $exp->getExpertise();
		}
		$response = array();

		$response = array(
				'bio' => $user->getBio(),
				'expertise' => $expArr
			);

		echo json_encode($response);
		exit();
	}
}

if(isset($_POST['type'])){

	// if($_POST['type'] == 'uploadProfilePic'){
	// 	error_log(var_export($_POST));
	// 	exit;
	// }
	if($_POST['type'] == 'editUser'){
		$expArr = $_POST['expertise'];

		$user = User::getFromId($log_id, $db);
		$user->setEmail($_POST['email']);
		$user->setRealName($_POST['realname']);
		$user->setRealSurname($_POST['realsurname']);
		if(trim($_POST['password']) != 'default'){
			$user->setPassword($_POST['password']);
		}
		$user->setLocation($_POST['location']);
		$user->setBio($_POST['userbio']);
		$user->save($db);
		
		if(is_array($expArr) && count($expArr) > 0){
			//save expertise
			$expObj = Expertise::getExpertiseFromUserId($user->getId(), $db);
			$userExp = array();
			foreach($expObj as $eo){
				$eo->delete($db);
			}

			foreach($expArr as $exp){
				$newExp = new Expertise();
				$newExp->setUserId($user->getId());
				$newExp->setExpertise($exp);
				$newExp->save($db);
			}
		}

		echo json_encode(array('status'=>'success'));
		exit();

	}
}
