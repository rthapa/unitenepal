<?php
require __DIR__.'/../config.php';
require __DIR__.'/../classes/PDOConnect.php';

$db = new PDOConnect();

$query = $db->query('SELECT * FROM gofundme');
$db->updateRow('UPDATE gofundme SET goal = "000"');
foreach($query as $q){
	$agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';
	$ch = curl_init($q['url']);

	//curl options
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_USERAGENT, $agent);
	curl_setopt($ch, CURLOPT_ENCODING ,"");
	curl_setopt ($ch, CURLOPT_CAINFO, dirname(__FILE__)."/cacert.pem");

	$cl = curl_exec($ch);
	$dom = new DOMDocument();
	@$dom->loadHTML($cl);
	$xpath = new DOMXpath($dom);
	$articles = $xpath->query("//*[contains(@class, 'raised')]");
	// echo "<pre>";
	// var_dump($image->item(0)->childNodes->item(1)->attributes->item(0)->value);
	// echo $image->item(0)->childNodes->item(1)->attributes->item(0)->value;
	$raised = '';
	$raisedraw = '';
	$goalraw = '';
	foreach($articles as $article){
		$raised = $article->nodeValue;
	}
	$raised = explode(" of ",$raised);
	//string replaces for k
	$raised[0] = str_replace(array('k',), '000' , $raised[0]);
	$raised[1] = str_replace(array('k'), '000' , $raised[1]);
	//string replace for comma
	$raisedraw = str_replace(array(',',), '' , $raised[0]);
	$goalraw = str_replace(array(','), '' , $raised[1]);
	//string replaces for comma and currency
	$raised[0] = str_replace(array('£', '$'), '' , $raisedraw);
	$raised[1] = str_replace(array('£', '$'), '' , $goalraw);
	
	
	
	//Fetch person image
	$userImage = '';
	$image = $xpath->query("//*[contains(@class, 'cbimg')]");

	foreach($image as $i){
		$userImage = $i->childNodes->item(1)->attributes->item(0)->value;
	}

	//fetch message only if the message field is not filled already? maybe not as message can be updated
	// if(trim($q['message']) == ''){
	$msgs = $xpath->query("//*[contains(@class, 'pg_msg')]");
	$msg = '';
	foreach($msgs as $m){
		// echo($m->nodeValue);
		$msg= $m->c14n();
	}

	//finally update to DB
	$db->updateRow('UPDATE gofundme SET goal = :goal, raised = :raised, goalraw = :goalraw, raisedraw = :raisedraw, image = :image, message = :message WHERE id = :id', 
		array(
			":goal" => trim($raised[1]),
			":raised" => trim($raised[0]),
			":goalraw" => trim($goalraw),
			":raisedraw" => trim($raisedraw),
			":image" => $userImage,
			":id" => $q['id'],
			":message" => $msg
			)
		);
}

