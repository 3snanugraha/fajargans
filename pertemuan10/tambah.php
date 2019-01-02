<?php 
	session_start();
	require 'functions.php';

	if (!isset($_SESSION["locatedefault"])) {
		header("Location: login.php");
		exit();
	}

	if (isset($_POST["submit"])) {

		if (create($_POST) > 0) {
			echo "Sukses menambah data";
		}else{
			echo "Gagal menambah data";
			echo "<br>";
			echo mysqli_error($db);
		}
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>fajar mah bebas</title>
</head>
<body>
	<h2>Tambah data anggota</h2>
	<form action="" method="post" enctype="multipart/form-data">
		<label for="nama">Nama : </label>
		<input type="text" name="nama" id="nama" required autocomplete="off">
		<br>
		<label for="email">E-mail : </label>
		<input type="email" name="email" id="email" required autocomplete="off">
		<br>
		<label for="np">Nomor Pendaftaran : </label>
		<input type="text" name="np" id="np" required autocomplete="off">
		<br>
		<label for="gambar">Gambar : </label>
		<input type="file" name="gambar" id="gambar">
		<br>
		<button name="submit">Kirim</button>
	</form>
	<a href="index.php">Kembali ke panel</a>
	
</body>
</html>