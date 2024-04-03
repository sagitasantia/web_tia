<?php
require "../../../koneksi.php";

session_start();

// Tidak boleh masuk ke halaman home jika belum log in
if (!(isset($_SESSION['role']) && $_SESSION['role'] == "mahasiswa")) {
  header('Location: login.php');
}

// Variable untuk mendeteksi nav-link active sidebar
$current_page = "laporan";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Buat Laporan | E-Complaint Fakultas Teknik Universitas Mulawarman</title>

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
        <h2>Buat Laporan</h2>
      </div>

      <div class="card shadow rounded border-0 mb-3">
        <div class="card-body">
          <!-- Form buat laporan -->
          <form action="../../../proses/buat-laporan.php" method="POST" enctype="multipart/form-data">
            <!-- Jenis pengaduan -->
            <div class="mb-3">
              <label for="jenis_pengaduan" class="form-label fw-bold">Jenis Pengaduan <span class="text-danger">*</span></label>
              <select class="form-select" name="jenis_pengaduan" id="jenis_pengaduan" required>
                <option value="" selected disabled>Pilih jenis pengaduan</option>
                <option value="UKT">UKT</option>
                <option value="Administrasi">Administrasi</option>
                <option value="Fasilitas">Fasilitas</option>
                <option value="Akademik">Akademik</option>
                <option value="Lainnya">Lainnya</option>
              </select>
            </div>

            <!-- Deskripsi pengaduan -->
            <div class="mb-3">
              <label for="deskripsi_pengaduan" class="form-label fw-bold">Deskripsi Pengaduan <span class="text-danger">*</span></label>
              <textarea class="form-control" name="deskripsi_pengaduan" id="deskripsi_pengaduan" rows="3" required placeholder="Jelaskan detail dari pengaduan kalian di sini"></textarea>
            </div>

            <!-- Foto atau berkas pendukung -->
            <div class="mb-3">
              <label for="berkas_pendukung" class="form-label fw-bold">Berkas atau Foto Pendukung</label>
              <input class="form-control" type="file" name="berkas_pendukung" id="berkas_pendukung">
            </div>

            <!-- Ajukan pengaduan -->
            <button type="submit" class="btn btn-primary">Ajukan Pengaduan</button>
          </form>
        </div>
      </div>

      <div class="card shadow rounded border-0">
        <div class="card-body">
          <h6>Keterangan</h6>
          <small><span class="text-danger">*</span> Wajib diisi</small>
        </div>
      </div>
    </main>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>