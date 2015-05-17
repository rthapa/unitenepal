<?php
session_start();

require __DIR__.'/config.php';
require __DIR__.'/classes/PDOConnect.class.php';
require __DIR__.'/classes/Object.class.php';
require __DIR__.'/classes/User.class.php';
require __DIR__.'/classes/Html.class.php';
require __DIR__.'/classes/Article.class.php';
require __DIR__.'/classes/Expertise.class.php';
require __DIR__.'/classes/Campaign.class.php';

$db = new PDOConnect();

$user_ok = false;
$log_id = "";
$log_email = "";
$log_password = "";
$log_hash = "";
// User Verify function

if(isset($_SESSION["userid"]) && isset($_SESSION["email"]) && isset($_SESSION['hash'])) {
	$log_id = preg_replace('#[^0-9]#', '', $_SESSION['userid']);
	$log_email = $_SESSION['email'];
	$log_hash = $_SESSION['hash'];
	// Verify the user
	$user_ok = User::authCookie($log_id, $log_email, $log_hash, $db);
}else if(isset($_COOKIE["id"]) && isset($_COOKIE["user"]) && isset($_COOKIE["hash"])){
		$_SESSION['userid'] = preg_replace('#[^0-9]#', '', $_COOKIE['id']);
		$_SESSION['email'] = $_COOKIE['user'];
		$_SESSION['hash'] = $_COOKIE['hash'];
		$log_id = $_SESSION['userid'];
		$log_email = $_SESSION['email'];
		$log_hash = $_SESSION['hash'];
		// Verify the user
		$user_ok = User::authCookie($log_id, $log_email, $log_hash, $db);
		if($user_ok){
			$user = User::getFromId($log_id, $db);
			$user->save($db);
		}
}

