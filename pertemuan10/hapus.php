<?php 
	session_start();
	require 'functions.php';

	if (!isset($_SESSION["locatedefault"])) {
		header("Location: login.php");
		exit();
	}
	
	$id = $_GET["id"];
	if (delete($id) > 0) {
		echo "Sukses menghapus data";
	}else{
		echo "Gagal menghapus data";
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>fajar mah bebas</title>
</head>
<body>
	<a href="index.php">Kembali ke panel</a>
	
</body>
</html>