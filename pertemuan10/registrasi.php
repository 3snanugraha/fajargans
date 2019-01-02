<?php 
	require 'functions.php';

	if (isset($_POST["daftar"])) {
		if( registrasi($_POST) > 0){
			echo "Berhasil Registrasi";
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
	<form action="" method="post">
		<ul>
			<li>
				<label for="nama">Username</label>
			</li>
			<li>
				<input type="text" name="nama" id="nama" required autocomplete="off">
			</li><br>
			<li>
				<label for="password">Password</label>
			</li>
			<li>
				<input type="password" name="password" id="password" required autocomplete="off">
			</li><br>
			<li>
				<label for="password2">Konfirmasi Password</label>
			</li>
			<li>
				<input type="password" name="password2" id="password2" required autocomplete="off">
			</li><br>
			<li>
				<label for="email">E-mail : </label>
			</li>
			<li>
				<input type="email" name="email" id="email" required autocomplete="off">
			</li><br>
			<li><button type="submit" name="daftar">Regiser!</button></li>
		</ul>
	</form>
	<br>
	<a href="index.php">Kembali ke dashboard</a>
	
</body>
</html>