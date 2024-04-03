<?php
require_once("../koneksi.php");

session_start();

// Memastikan yang mengakses proses buat-laporan.php merupakan mahasiswa yang sudah log in
if (!(isset($_SESSION['role']) && $_SESSION['role'] == "mahasiswa")) {
  header('Location: ../views/auth/pages/login.php');
  exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Memeriksa apakah Jenis Pengaduan dan Deskripsi Pengaduan tidak kosong
  if (isset($_POST['jenis_pengaduan']) && isset($_POST['deskripsi_pengaduan'])) {
    $jenis_pengaduan = $_POST['jenis_pengaduan'];
    $deskripsi_pengaduan = $_POST['deskripsi_pengaduan'];

    // Membuat ID unik menggunakan uniqid()
    $id_laporan = uniqid();

    // Memeriksa apakah mengunggah berkas
    if (isset($_FILES['berkas_pendukung']) && $_FILES['berkas_pendukung']['error'] === UPLOAD_ERR_OK) {
      // Mendapatkan ekstensi file yang diunggah
      $ekstensi = pathinfo($_FILES['berkas_pendukung']['name'], PATHINFO_EXTENSION);

      // Mengubah nama file berdasarkan ID laporan
      $nama_file = $id_laporan . '.' . $ekstensi;

      // Menyimpan berkas ke folder storage
      $lokasi_simpan = '../storage/' . $nama_file;
      move_uploaded_file($_FILES['berkas_pendukung']['tmp_name'], $lokasi_simpan);
    } else {
      $nama_file = null;
    }

    // Menyimpan laporan ke database
    $nim_mahasiswa = mysqli_real_escape_string($koneksi, $_SESSION['nim']);
    $query = "INSERT INTO laporan (id, nim_mahasiswa, jenis_pengaduan, deskripsi_pengaduan, berkas_pendukung) 
              VALUES ('$id_laporan', '$nim_mahasiswa', '$jenis_pengaduan', '$deskripsi_pengaduan', '$nama_file')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
      $_SESSION['success'] = 'berhasil_membuat_laporan';
      header('Location: ../views/mahasiswa/pages/laporan.php');
    } else {
      $_SESSION['error'] = 'gagal_membuat_laporan';
      header('Location: ../views/mahasiswa/pages/laporan.php');
      header('Location: laporan.php');
    }
  }
}
