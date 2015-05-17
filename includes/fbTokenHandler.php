<?php
include_once("../check_login_status.php");

$code = $_GET['code'];
$app_id = "411224929057030";
 
$app_secret = "f02bfadbb06e3941c738fa3d405e88e0";
 
$my_url = "http://beta.unitenepal.org/includes/fbTokenHandler.php";
 
$token_url = "https://graph.facebook.com/oauth/access_token?"
	. "client_id=" . $app_id . "&redirect_uri=" . urlencode($my_url)
	. "&client_secret=" . $app_secret . "&code=" . $code . "&scope=publish_stream,user_photos,email";


$response = @file_get_contents($token_url);
$params = null;
var_dump($response);
parse_str($response, $params);

$graph_url = "https://graph.facebook.com/me?access_token=" 
. $params['access_token'];

$user = json_decode(file_get_contents($graph_url));
// echo '<pre>';
// var_dump($user);
// echo '</pre>';
// exit;
// $username = $user->username;
// $email = $user->email;
// $facebook_id = $user->id;
// echo $username;

// $userIdCheck = User::getFromId($user->id, $db);
// echo $userIdCheck->getId();
// if(!$userIdCheck->getId()) echo 'already registered';
// exit;

$fbIdExist = User::fbIdExist($user->id, $db);
// error_log($fbIdExist);

if(!$fbIdExist){
	// header("location: error.php?type=104");
	// exit();
	$userObj = new User();
	$userObj->setEmail($user->email);
	$userObj->setRealName($user->first_name);
	$userObj->setRealSurname($user->last_name);
	$userObj->setFbId($user->id);
	$userObj->setGender($user->gender);
	// $userObj->setPassword($password);
	// $userObj->setIp($ip);
	$userObj->setActivated('1');
	$userObj->setImg('http://graph.facebook.com/'.$user->id.'/picture?width=300&height=300');
	$userObj->setHash(md5(User::generateRandomString()));
	$userObj->save($db);

} else{
	$userObj = User::getSingleFromSql('SELECT * FROM users WHERE fbid = :fbid LIMIT 1', array(':fbid'=>$user->id), $db);
	$userObj->setHash(md5(User::generateRandomString()));
	$userObj->save($db);
}



//create their session and cookies and log them in
// $userid = $db->getLastInsertId();
$userid = $userObj->getId();
$_SESSION['userid'] = $userid;
$_SESSION['email'] = $userObj->getEmail();
$_SESSION['hash'] = $userObj->getHash();

setcookie("id", $userid, strtotime( '+30 days' ), "/", "", "", TRUE);
setcookie("user", $_SESSION['email'], strtotime( '+30 days' ), "/", "", "", TRUE);
setcookie("hash", $_SESSION['hash'], strtotime( '+30 days' ), "/", "", "", TRUE);
// setcookie("pass", $password, strtotime( '+30 days' ), "/", "", "", TRUE); 
// header('location: ../user.php?id='.$userid);
header('location: ../user.php?id='.$userid);
exit();
