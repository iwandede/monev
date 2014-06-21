<?php
	include_once('../app/sk_config.php');
	if(isset($_SESSION['UserSession']))
		session_destroy();
		redirect(PATHURL);
	exit;
?>