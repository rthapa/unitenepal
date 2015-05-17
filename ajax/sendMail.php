<?php

// mail("rthapa90@gmail.com","My subject",'testing mail system', "From:".'fromTest');

if(isset($_POST['msg'])){
	$emails = array(
			'rthapa90@gmail.com',
			'reshamgurung01@gmail.com'
		);

	$username = htmlspecialchars($_POST['username']);

	$subject = 'User feedback message : '.$username;

	$from = htmlspecialchars($_POST['email']);

	$msg = htmlspecialchars($_POST['msg']);

	foreach($emails as $email){
		mail($email, $subject, $msg, "From:".$from);
	}

	echo json_encode(array('status' => 'success'));

}


