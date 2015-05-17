<?php
if(isset($_GET['type'])){
	if($_GET['type'] == '104'){
		$message = 'Something went wrong. Make sure you have Javascript turned on and please try again.';
	}
}elseif(isset($_GET['msg'])) {
	$message = $_GET['msg'];
}else{
	$message= 'Oops the page you are looking could not be found';
}
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
	<div>
		<p><?=$message?></p>
	</div>
</body>
</html>
