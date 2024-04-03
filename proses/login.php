<?php
require "../koneksi.php";

session_start();

// Mengecek apakah proses login.php berjalan karena ada POST log in dengan role mahasiswa
if (isset($_POST["login"]) && $_POST["role"] == "mahasiswa") {
	$nim = $_POST["nim"];
	$pass = $_POST["password"];

	$result = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE nim='$nim'");

	// Mengecek apakah nim ada
	if (mysqli_num_rows($result) == 1) {
		$item = mysqli_fetch_assoc($result);

		// Mengecek apakah password benar
		if (password_verify($pass, $item['password'])) {
			$_SESSION['nama'] = $item['nama'];
			$_SESSION['nim'] = $item['nim'];
			$_SESSION['role'] = $_POST["role"];
			header("Location: ../views/mahasiswa/pages/beranda.php");
		} else {
			$_SESSION['error'] = 'login_failed';
			header("Location: ../views/auth/pages/login.php");
		}
	} else {
		$_SESSION['error'] = 'login_failed';
		header("Location: ../views/auth/pages/login.php");
	}
}

// Mengecek apakah proses login.php berjalan karena ada POST log in dengan role admin

if (isset($_POST["login"]) && $_POST["role"] == "admin") {
	$username = $_POST["username"];
	$pass = $_POST["password"];

	$result = mysqli_query($koneksi, "SELECT * FROM admin WHERE username='$username'");

	// Mengecek apakah nim ada
	if (mysqli_num_rows($result) > 0) {
		$item = mysqli_fetch_assoc($result);

		// Mengecek apakah password benar
		if (password_verify($pass, $item['password'])) {
			$_SESSION['nama'] = $item['username'];
			$_SESSION['role'] = $_POST["role"];
			header("Location: ../views/admin/pages/dashboard.php");
		} else {
			$_SESSION['error'] = 'login_failed';
			header("Location: ../views/auth/pages/login.php");
		}
	} else {
		$_SESSION['error'] = 'login_failed';
		header("Location: ../views/auth/pages/login.php");
	}
}
