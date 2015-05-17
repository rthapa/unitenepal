<?php
include_once("../check_login_status.php");

if(!empty($_POST['email']) && !empty($_POST['password'])){
	$user = User::getFromAuth($_POST['email'], $_POST['password'], $db);

	if(!$user){
		//set the status to login failed
		$out = array('status' => 'failed');
	}else{
		//user found
		//update the user. for eg: lastlogin = now(), ip etc;
		$user->setHash(md5(User::generateRandomString()));
		$user->save($db);

		//set the session and cookies
		$_SESSION['userid'] = $user->getId();
		$_SESSION['email'] = $user->getEmail();
		$_SESSION['hash'] = $user->getHash();
		// $_SESSION['password'] = $user->getPassword();
		setcookie("id", $user->getId(), strtotime( '+30 days' ), "/", "", "", TRUE);
		setcookie("user", $user->getEmail(), strtotime( '+30 days' ), "/", "", "", TRUE);
		setcookie("hash", $user->getHash(), strtotime( '+30 days' ), "/", "", "", TRUE); 


		//set the status to success
		$out = array('status' => 'success', 'userid' => $user->getId());
	}

	//send the response to ajax and exit this script
	echo json_encode($out);
	exit();
}else{
	echo json_encode(array('status'=>'no email or password given'));
	exit();
}


