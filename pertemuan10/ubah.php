<?php 
	session_start();
	require 'functions.php';

	if (!isset($_SESSION["locatedefault"])) {
		header("Location: login.php");
		exit();
	}

	$id = $_GET["id"];
	$anggota = read("SELECT * FROM anggota WHERE id = $id")[0];

	if (isset($_POST["submit"])) {
		if (update($_POST) > 0) {
			echo "Sukses mengubah data";
		}else{
			echo "Gagal mengubah data";
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
	<h2>Ubah data anggota</h2>
	<form action="" method="post" enctype="multipart/form-data">
		
		<input type="hidden" name="id" value="<?php echo $anggota["id"] ?>">
		<input type="hidden" name="gambarhidden" value="<?php echo $anggota["gambar"] ?>">

		<label for="nama">Nama : </label>
		<input type="text" name="nama" id="nama" required value="<?php echo $anggota["nama"] ?>">
		<br>
		<label for="email">E-mail : </label>
		<input type="text" name="email" id="email" required value="<?php echo $anggota["email"] ?>">
		<br>
		<label for="np">Nomor Pendaftaran : </label>
		<input type="text" name="np" id="np" required value="<?php echo $anggota["np"] ?>">
		<br>
		<label for="gambar">Gambar : </label><br>
		<img src="img/<?php echo $anggota["gambar"] ?>" alt="image:anggota" width="85"><br>
		<input type="file" name="gambar" id="gambar">
		<br>
		<button name="submit">Kirim</button>
	</form>
	<a href="index.php">Kembali ke panel</a>
	
</body>
</html>