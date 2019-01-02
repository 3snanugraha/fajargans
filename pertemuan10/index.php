<?php 
	session_start();
	require 'functions.php';

	if (!isset($_SESSION["locatedefault"])) {
		header("Location: login.php");
		exit();
	}
	
	$result = mysqli_query($db, "SELECT * FROM anggota");
	$yangMauDiTampilin = 2;
	$total = mysqli_num_rows($result);
	$jumlahHalaman = ceil(($total / $yangMauDiTampilin));
	
	if (isset($_GET["page"])) {
		$halamanYangAktif = $_GET["page"];
	}else{
		$halamanYangAktif = "1";
	}

	$dariIndexBerapa = ($yangMauDiTampilin * $halamanYangAktif) - $yangMauDiTampilin;


	$anggota = read("SELECT * FROM anggota LIMIT $dariIndexBerapa, $yangMauDiTampilin");

	if (isset($_POST["cari"])) {
		$anggota = searching($_POST);
	}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>fajar mah bebas</title>
</head>
<body>
	<h1>Admin Panel</h1>

	<a href="registrasi.php">Registrasi Administrator</a>&emsp;

	<a href="login.php">Login Administrator</a>&emsp;

	<a href="logout.php">Log Out</a>&emsp;
	
	<a href="tambah.php">Tambah data anggota</a>
	<br><br>
	
	<form action="" method="post">
		<input type="text" name="keyword" id="keyword" autofocus size="55" autocomplete="off" placeholder="Masukkan kata pencarian (nama/email/no. pendaftaran)">
		<button type="submit" name="cari">Cari!</button>
	</form>

	<br>
		
		<?php if ($halamanYangAktif > 1){ ?>
			<a href="?page=<?php echo $halamanYangAktif - 1 ?>"><?php echo "&laquo"; ?></a>
		<?php } ?>
			
			<?php for ($i="1"; $i <= $jumlahHalaman ; $i++) { ?>
				
				<?php if ($i == $halamanYangAktif) : ?>
					<a href="?page=<?php echo $i ?>" style="font-weight: bold; color: lime"><?php echo $i; ?></a>

					<?php else : ?>
						<a href="?page=<?php echo $i ?>"><?php echo $i ?>	</a>
				<?php endif ?>
				
			<?php } ?>

		<?php if ($halamanYangAktif < $jumlahHalaman){ ?>
			<a href="?page=<?php echo $halamanYangAktif + 1 ?>"><?php echo "&raquo"; ?></a>
		<?php } ?>

	<br><br>

	<table border="1" cellpadding="10" cellspacing="0">
		<tr>
			<th>No</th>
			<th>Aksi</th>
			<th>Nama</th>
			<th>E-mail</th>
			<th>Nomor Pendaftaran</th>
			<th>Gambar</th>
		</tr>

			<?php $i = 1; ?>
		<?php foreach ($anggota as $agt) { ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td>
					<a href="ubah.php?id=<?php echo $agt["id"] ?>">Ubah</a> | 
					<a href="hapus.php?id=<?php echo $agt["id"] ?>">Hapus</a>
				</td>
				<td><?php echo $agt["nama"]; ?></td>
				<td><?php echo $agt["email"]; ?></td>
				<td><?php echo $agt["np"]; ?></td>
				<td><img src="img/<?php echo $agt["gambar"]; ?>" alt="image:anggota" width="70"></td>
			</tr>
			<?php $i++ ?>
		<?php } ?>
	</table>
	
</body>
</html>