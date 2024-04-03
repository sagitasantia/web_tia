<?php
require "../../../koneksi.php";

session_start();

// Tidak boleh masuk ke halaman home jika belum log in
if (!(isset($_SESSION['role']) && $_SESSION['role'] == "admin")) {
  header('Location: ../../auth/pages/login.php');
}

// Variable untuk mendeteksi nav-link active sidebar
$current_page = "laporan";

// Memastikan ada id laporan saat masuk ke page
if (!isset($_GET['id']) || empty($_GET['id'])) {
  header('Location: laporan.php');
  exit();
}

$id_laporan = mysqli_real_escape_string($koneksi, $_GET['id']);

// Mengambil data laporan
$query = "SELECT laporan.*, mahasiswa.nama, mahasiswa.nim, mahasiswa.prodi FROM laporan INNER JOIN mahasiswa ON laporan.nim_mahasiswa = mahasiswa.nim WHERE laporan.id = '$id_laporan'";
$result = mysqli_query($koneksi, $query);

// Memastikan jika ada data laporan
if (mysqli_num_rows($result) == 0) {
  header('Location: kelola-laporan.php'); // arahkan langsung ke halaman kelola-laporan.php jika tidak ada data laporan
  exit();
}

$item = mysqli_fetch_assoc($result);

// Update status dan deskripsi penolakan
if (isset($_POST['kelola-laporan'])) {
  $status = $_POST['status'];
  $deskripsi_penolakan = isset($_POST['deskripsi_penolakan']) ? $_POST['deskripsi_penolakan'] : '';

  $update_query = "UPDATE laporan SET status='$status', aksi='$deskripsi_penolakan' WHERE id='$id_laporan'";
  $update_result = mysqli_query($koneksi, $update_query);

  if ($update_result) {
    $_SESSION['success'] = true;
  } else {
    $_SESSION['error'] = true;
  }

  header("Location: kelola-laporan.php"); // arahkan kembali ke halaman kelola-laporan.php setelah submit
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kelola Laporan | E-Complaint Fakultas Teknik Universitas Mulawarman</title>

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

    <main class="container-fluid m-4">
  <!-- Title -->
  <div class="row mb-4">
    <div class="col">
      <h2>Kelola Laporan</h2>
    </div>
  </div>

  <div class="card shadow rounded border-0 mb-3">
    <div class="card-body">
      <?php
      if (isset($_SESSION['success'])) {
        echo "<div class='alert alert-success' role='alert'>Status laporan berhasil diubah.</div>";
        unset($_SESSION['success']);
      }
      if (isset($_SESSION['error'])) {
        echo "<div class='alert alert-danger' role='alert'>Gagal mengubah status laporan.</div>";
        unset($_SESSION['error']);
      }
      ?>
      <form action="kelola-laporan.php?id=<?= $id_laporan ?>" method="POST">
        <div class="row mb-3">
          <!-- Nama -->
          <div class="col-md-6 mb-3">
            <label for="nama" class="form-label fw-bold">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= $item['nama'] ?>" readonly>
          </div>

          <!-- NIM -->
          <div class="col-md-3 mb-3">
            <label for="nim" class="form-label fw-bold">NIM</label>
            <input type="text" class="form-control" id="nim" name="nim" value="<?= $item['nim'] ?>" readonly>
          </div>

          <!-- Program Studi -->
          <div class="col-md-3">
            <label for="prodi" class="form-label fw-bold">Program Studi</label>
            <input type="text" class="form-control" id="prodi" name="prodi" value="<?= $item['prodi'] ?>" readonly>
          </div>
        </div>

        <!-- Jenis Pengaduan -->
        <div class="row mb-3">
          <div class="col-md-6 mb-3">
            <label for="jenis_pengaduan" class="form-label fw-bold">Jenis Pengaduan</label>
            <input type="text" class="form-control" id="jenis_pengaduan" name="jenis_pengaduan" value="<?= $item['jenis_pengaduan'] ?>" readonly>
          </div>

          <div class="col-md-6">
            <label for="jenis_pengaduan" class="form-label fw-bold">Waktu dibuat</label>
            <input type="text" class="form-control" id="jenis_pengaduan" name="jenis_pengaduan" value="<?= $item['created_at'] ?>" readonly>
          </div>
        </div>

        <!-- Deskripsi Pengaduan -->
        <div class="row mb-3">
          <div class="col">
            <label for="deskripsi_pengaduan" class="form-label fw-bold">Deskripsi Pengaduan</label>
            <textarea class="form-control" id="deskripsi_pengaduan" name="deskripsi_pengaduan" rows="3" readonly><?= $item['deskripsi_pengaduan'] ?></textarea>
          </div>
        </div>

        <!-- Berkas -->
        <div class="row mb-3">
          <div class="col">
            <p class="fw-bold mb-2">Berkas</p>
            <?php if (!empty($item['berkas_pendukung'])) { ?>
              <a href="../../../storage/<?= $item['berkas_pendukung'] ?>" class="btn btn-info btn-sm" download>
                Lihat Berkas
              </a>
            <?php } else { ?>
              <button type="button" class="btn btn-info btn-sm" disabled>
                Tidak Ada Berkas
              </button>
            <?php } ?>
          </div>
        </div>

        <!-- Deskripsi Penolakan -->
        <div class="row mb-3">
          <div class="col">
            <label for="deskripsi_penolakan" class="form-label fw-bold">Deskripsi Penolakan</label>
            <textarea class="form-control" id="deskripsi_penolakan" name="deskripsi_penolakan" rows="3"><?= $item['deskripsi_penolakan'] ?? '' ?></textarea>
          </div>
        </div>

        <!-- Status -->
        <div class="row mb-3">
          <div class="col">
            <label for="status" class="form-label fw-bold">Status</label>
            <div class="d-flex">
              <div class="form-check me-3">
                <input class="form-check-input" type="radio" name="status" id="diproses" value="diproses" <?= $item['status'] == 'diproses' ? 'checked' : '' ?>>
                <label class="form-check-label" for="diproses">Diproses</label>
              </div>
              <div class="form-check me-3">
                <input class="form-check-input" type="radio" name="status" id="ditolak" value="ditolak" <?= $item['status'] == 'ditolak' ? 'checked' : '' ?>>
                <label class="form-check-label" for="ditolak">Ditolak</label>
              </div>
              <div class="form-check me-3">
                <input class="form-check-input" type="radio" name="status" id="selesai" value="selesai" <?= $item['status'] == 'selesai' ? 'checked' : '' ?>>
                <label class="form-check-label" for="selesai">Selesai</label>
              </div>
            </div>
          </div>
        </div>

        <!-- id laporan -->
        <input type="hidden" name="id_laporan" value="<?= $id_laporan ?>">

        <!-- Tombol simpan perubahan -->
        <div class="row mb-3">
          <div class="col">
            <button type="submit" class="btn btn-primary" name="kelola-laporan">Simpan Perubahan</button>
          </div>
        </div>

      </form>
    </div>
  </div>

</main>
