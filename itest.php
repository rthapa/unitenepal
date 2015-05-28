<?php
include_once("check_login_status.php");

?>

<form action="ajax/upload.ajax.php" method="post" enctype="multipart/form-data">
	<input type="file" name="file">
	<input type="submit">
</form>
