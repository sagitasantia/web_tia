<?php
require "../koneksi.php";

session_start();

// Memastikan yang mengakses proses buat-laporan.php merupakan admin yang sudah log in
if(!(isset($_SESSION['role']) && $_SESSION['role'] == "admin")) {
  header('Location: ../../auth/pages/login.php');
}

// Apakah proses login.php berjalan karena ada POST kelola-laporan
if (isset($_POST['kelola-laporan'])) {
  // Memastikan status tidak kosong
  if (isset($_POST['status'])) {
    $status = $_POST['status'];
    $id_laporan = $_POST['id_laporan'];

    // Update status laporan di database
    $query = "UPDATE laporan SET status = '$status' WHERE id = '$id_laporan'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
      $_SESSION['success'] = 'status_laporan_berhasil_diubah';
      header('Location: ../views/admin/pages/kelola-laporan.php?id=' . $id_laporan);
      exit();
    }
  }
}
?>
