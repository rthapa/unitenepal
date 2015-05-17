<?php
include_once("../check_login_status.php");

if(isset($_POST["checkemail"])){
	$email =$_POST['checkemail'];

	$emailExist = User::emailExist($email, $db);

	if($emailExist){
		$isavailable = 'taken';
	}else{
		$isavailable = 'available';
	}

	$respond = array("data" => $isavailable);
	$out = json_encode($respond);
	echo $out;
	exit();
}

if(isset($_POST["checkusername"])){
	$username = preg_replace('#[^a-z0-9]#i', '', $_POST['checkusername']);
	$usernameExist = User::usernameExist($username, $db);

	if($usernameExist){
		$isavailable = 'taken';
	}else{
		$isavailable = 'available';
	}

	$respond = array("data" => $isavailable);
	$out = json_encode($respond);
	echo $out;
	exit();
}

if(isset($_POST['password'])){
	// $username = preg_replace('#[^a-z0-9]#i', '', $_POST['username']);
	$realname = $_POST['realname'];
	$realsurname = $_POST['realsurname'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$repassword = $_POST['repassword'];
	if($email == "" || $password == "" || $repassword == ""){
		header("location: error.php?type=104");
		exit();
	}

	if($password != $repassword){
		header("location: error.php?type=104");
		exit();
	}

	//check email availability 
	// $emailExist = User::emailExist($email, $db);

	// if($emailExist){
	// 	header("location: error.php?type=104");
	// 	exit();
	// }

	//check username availability 
	// $usernameExist = User::usernameExist($username, $db);

	// if($usernameExist){
	// 	header("location: error.php?type=104");
	// 	exit();
	// }

	$password = md5($password);
	$ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));
	// $db->insertRow('INSERT INTO users (user_email, user_pwd, activated, ip, lastlogin, username) 
	// 							VALUES (:email, :password, :activated, :ip, now(), :username)',
	// 							array(":email"=>$email,
	// 									":password"=>$password,
	// 									":activated"=>'1',
	// 									":ip"=>$ip,
	// 									":username"=>$username));

	$user = new User();
	$user->setEmail($email);
	$user->setRealName($realname);
	$user->setRealSurname($realsurname);
	// $user->setUsername($username);
	$user->setPassword($password);
	$user->setIp($ip);
	$user->setHash(md5(User::generateRandomString()));
	$user->setActivated('1');
	$user->save($db);


	//create their session and cookies and log them in
	// $userid = $db->getLastInsertId();
	$_SESSION['userid'] = $user->getId();
	$_SESSION['email'] = $user->getEmail();
	$_SESSION['hash'] = $user->getHash();
	setcookie("id", $user->getId(), strtotime( '+30 days' ), "/", "", "", TRUE);
	setcookie("user", $user->getEmail(), strtotime( '+30 days' ), "/", "", "", TRUE);
	setcookie("hash", $user->getHash(), strtotime( '+30 days' ), "/", "", "", TRUE); 
	header('location: ../user.php?id='.$user->getId());
	exit();
}


//http://stackoverflow.com/questions/19596402/disable-form-submit-until-fields-have-been-validated-using-jquery
