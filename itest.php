<?php
include_once("check_login_status.php");
$users = array();
$users = User::getFromSql('SELECT * FROM users', array(), $db);

if(count($users > 0)){
	foreach ($users as $user) {
		?>
			<div>
				<a href="user.php?id=<?=$user->getId()?>"><img src="<?=$user->getImg()?>"></a>
			</div>
		<?php
	}
}
?>
<style>
img{
	width:100px;
	height:100px;
	border-radius: 50%;
	float:left;
}
</style>
