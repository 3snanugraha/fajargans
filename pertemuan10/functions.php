<?php 
	$db = mysqli_connect("localhost", "root", "", "details");

	function read($tangkap){
		global $db;
		$result = mysqli_query($db, $tangkap);
		$rows = [];
		while ($row = mysqli_fetch_assoc($result)) {
			$rows[] = $row;
		}
		return $rows;
	}
	




	function create($tangkap){
		global $db;
		
		$nama = htmlspecialchars($tangkap["nama"]);
		$email = htmlspecialchars($tangkap["email"]);
		$np = htmlspecialchars($tangkap["np"]);

		if (!$gambar = htmlspecialchars(files())) {
			return false;
		};

		$masukkin = "INSERT INTO anggota VALUES('', '$nama', '$email', '$np', '$gambar')";
		mysqli_query($db, $masukkin);

		return mysqli_affected_rows($db);

	}

	$namaFile = $ukuranFile = $ekstensiFile = $ekstensiFileValid = $error = $tmpName = [];

	function files(){
		$namaFile = $_FILES["gambar"]["name"];
		$ukuranFile = $_FILES["gambar"]["size"];
		$ekstensiFile = strtolower(end(explode('.', $namaFile)));
		$ekstensiFileValid = ["jpg", "png", "bmp", "jpeg"];
		$error = $_FILES["gambar"]["error"];
		$tmpName = $_FILES["gambar"]["tmp_name"];

		// $namaFile = $namaFile .= $ekstensiFile;
		if ($error === 4) {
			echo "Upload gambar terlebih dahulu<br>";
			return false;
		}

		if (!in_array($ekstensiFile, $ekstensiFileValid)) {
			echo "Yang anda upload bukan gambar <br>";
			return false;
		}
		if ($ukuranFile > 300000) {
			echo "Ukuran gambar terlalu besar <br>";
			return false;
		}

		$namaFileBaru = $namaFile = uniqid();
		$namaFileBaru .= '.';
		$namaFileBaru .= $ekstensiFile;

		move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

		return $namaFileBaru;

	}





	function delete($tangkap){
		global $db;
		$hapus = "DELETE FROM anggota WHERE id = $tangkap";
		mysqli_query($db, $hapus);
		return mysqli_affected_rows($db);
	}





	function update($tangkap){
			global $db;

			$id = htmlspecialchars($tangkap["id"]);
			$nama = htmlspecialchars($tangkap["nama"]);
			$email = htmlspecialchars($tangkap["email"]);
			$np = htmlspecialchars($tangkap["np"]);

		if ($_FILES["gambar"]["error"] === 0) {
			if (!files()) {
				return false;
			}
			
			$gambar = files();

		}if( $_FILES["gambar"]["error"] === 4){
			$gambar = htmlspecialchars($tangkap["gambarhidden"]);
		}

		$ubah = "UPDATE anggota SET 
					id = '$id',
					nama = '$nama',
					email = '$email',
					np = '$np',
					gambar = '$gambar'
					WHERE id = $id
				";
		mysqli_query($db, $ubah);

		return mysqli_affected_rows($db);
	}





	function searching($tangkap){
		global $db;
		// $test = mysqli_query($db, "SELECT * FROM anggota WHERE = ($dariIndexBerapa+1)");
		// $test2 = mysqli_fetch_assoc($test);
		// var_dump($test2);

		$keyword = $tangkap["keyword"];
		$tampilin = "SELECT * FROM anggota WHERE 
						nama LIKE '%$keyword%' OR
						email LIKE '%$keyword%' OR 
						np LIKE '%$keyword%'
					";

		$result = mysqli_query($db, $tampilin);
		$rows =  [];
		while ($row = mysqli_fetch_assoc($result)) {
			$rows[] = $row;
		}
		return $rows;

	}




	function registrasi($tangkap){
		global $db;

		$nama = htmlspecialchars(stripslashes($tangkap["nama"]));
		$password = htmlspecialchars($tangkap["password"]);
		$password2 = htmlspecialchars($tangkap["password2"]);
		$email = htmlspecialchars(stripslashes($tangkap["email"]));
		
		if (isset($tangkap["daftar"])) {
		
			$result = "SELECT username FROM daftar WHERE username = '$nama'";
			$tampil = mysqli_query($db, $result);
			$rows = [];
			while ($row = mysqli_fetch_assoc($tampil)) {
				$rows[] = $row;
			}

			if ($rows) {
			 	echo "Username sudah terdaftar";
			 	return false;
			}
			if ($password !== $password2) {
				echo "Kombinasi password tidak sama";
				return false;
			}
			$password = password_hash($password, PASSWORD_DEFAULT);
			$password2 = password_hash($password2, PASSWORD_DEFAULT);

			$masukpakeko = "INSERT INTO daftar VALUES ('', '$nama', '$password', '$password2', '$email')";
			mysqli_query($db, $masukpakeko);

			return mysqli_affected_rows($db);

		}

	}



 ?>