<?php 
	session_start();
	$_SESSION = [];
	session_unset();
	session_destroy();

	setcookie("rlviewdefault", "", time() - 3600);

	header("Location: login.php");
	exit();
?>