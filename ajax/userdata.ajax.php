<?php
include_once("../check_login_status.php");

if(isset($_GET['type'])){
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
			error_log($campaign->getImg());
		}
		echo json_encode($response);
		exit();
	}
}
