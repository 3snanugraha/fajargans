<?php 
	session_start();
	require 'functions.php';

	if (isset($_COOKIE["rlviewdefault"])) {

		$userhash = $_COOKIE["rlviewdefault"];
		$idhash = $_COOKIE["ingpressroft"];

		$checksameidusserhash = mysqli_query($db, "SELECT username FROM daftar WHERE id = '$idhash'");
		$csiuh = mysqli_fetch_assoc($checksameidusserhash);

		if ($userhash === hash(snefru256, $csiuh["username"])) {
			$_SESSION["locatedefault"] = true;
		}


		// if ($_COOKIE["rlviewdefault"] === hash(snefru256, '$hashusername')) {
		// 	$_SESSION["locatedefault"] = true;
		// }
	}

	if (isset($_SESSION["locatedefault"])) {
		header("Location: index.php");
		exit();
	}

	$error = "";
	
	if (isset($_POST["login"])) {

		$username = $_POST["username"];
		$password = $_POST["password"];

		$result = mysqli_query($db, "SELECT * FROM daftar WHERE username = '$username'");

		if (mysqli_num_rows($result) < 1) {
			$error = "Username yang anda masukkan belum terdaftar";
		}
		if (mysqli_num_rows($result) === 1) {
			$rows = mysqli_fetch_assoc($result);

			if (password_verify($password, $rows["password"])) {

				$_SESSION["locatedefault"] = true;
				
				if (isset($_POST["remember"])) {
					setcookie("ingpressroft", $rows["id"], time() + 60);
					setcookie("rlviewdefault", hash(snefru256, $rows["username"]), time() + 60);
				}

				header("Location: index.php");
				exit();
			}else{
				$error = "Password yang anda masukkan tidak sesuai";
			}
		}
		// $error = "Username/Password yang anda masukkan belum terdaftar";
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>fajar mah bebas</title>
</head>
<body>
	<?php echo $error; ?>
	<form action="" method="post">
		<ul>
			<li>
				<label for="username">Username : </label>
			</li>
			<li>
				<input type="text" name="username" id="username" required>
			</li><br>
			<li>
				<label for="password">Password</label>
			</li>
			<li>
				<input type="password" name="password" id="password">
			</li><br>
			<li>
				<input type="checkbox" name="remember" id="remember">
				<label for="remember">Remember me?</label>
			</li><br>
			<li>
				<button type="submit" name="login">Login</button>
			</li>
		</ul>
	</form>
	
</body>
</html>