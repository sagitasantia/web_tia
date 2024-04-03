<?php
session_start();

// Tidak boleh masuk ke halaman dashboard jika belum log in
if (!(isset($_SESSION['role']) && $_SESSION['role'] == "admin")) {
  header('Location: ../../auth/pages/login.php');
}

// Variable untuk mendeteksi nav-link active sidebar
$current_page = "dashboard";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard | E-Complaint Fakultas Teknik Universitas Mulawarman</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-body-tertiary">
  <!-- Navbar -->
  <?php
  require "../partials/navbar.php";
  ?>

  <div class="d-flex">
    <!-- Sidebar -->
    <div>
      <?php
      require "../partials/sidebar.php";
      ?>
    </div>

    <!-- Main content -->
    <main class="container w-100 m-4">
      <!-- Title -->
      <div class="mb-4">
        <h2>Dashboard</h2>
      </div>

      <div class="card shadow rounded border-0">
        <div class="card-body">
          Selamat datang Admin di E-Complaint Fakultas Teknik Universitas Mulawarman. Kelola laporan dari Mahasiswa di sini.
        </div>
      </div>
    </main>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>