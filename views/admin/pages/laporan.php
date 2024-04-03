<?php
require "../../../koneksi.php";

session_start();

// Tidak boleh masuk ke halaman home jika belum log in
if (!(isset($_SESSION['role']) && $_SESSION['role'] == "admin")) {
  header('Location: ../../auth/pages/login.php');
}

// Variable untuk mendeteksi nav-link active sidebar
$current_page = "laporan";

// Menghitung jumlah total laporan
$query_count_total = "SELECT COUNT(*) AS total FROM laporan";
$result_count_total = mysqli_query($koneksi, $query_count_total);
$count_total = mysqli_fetch_assoc($result_count_total)['total'];

// Menghitung jumlah laporan selesai
$query_count_selesai = "SELECT COUNT(*) AS total FROM laporan WHERE status='selesai'";
$result_count_selesai = mysqli_query($koneksi, $query_count_selesai);
$count_selesai = mysqli_fetch_assoc($result_count_selesai)['total'];

// Menghitung jumlah laporan diproses
$query_count_diproses = "SELECT COUNT(*) AS total FROM laporan WHERE status='diproses'";
$result_count_diproses = mysqli_query($koneksi, $query_count_diproses);
$count_diproses = mysqli_fetch_assoc($result_count_diproses)['total'];

// Menghitung jumlah laporan ditolak
$query_count_ditolak = "SELECT COUNT(*) AS total FROM laporan WHERE status='ditolak'";
$result_count_ditolak = mysqli_query($koneksi, $query_count_ditolak);
$count_ditolak = mysqli_fetch_assoc($result_count_ditolak)['total'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laporan | E-Complaint Fakultas Teknik Universitas Mulawarman</title>

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
        <h2>Laporan</h2>
      </div>

      <!-- Card banyak laporan -->
      <div class="d-flex justify-content-between mb-4">
        <!-- Card jumlah laporan -->
        <div class="border-4 border-start border-primary card shadow rounded-3 border-0" style="width: 15rem;">
          <div class="card-body d-flex justify-content-between">
            <div>
              <h5 class="card-title">Jumlah Laporan</h5>
              <p class="card-text fw-semibold "><?= $count_total ?> laporan</p>
            </div>

            <div class="my-auto">
              <i class="fa-solid fa-list fa-2xl text-secondary"></i>
            </div>
          </div>
        </div>

        <!-- Card laporan selesai -->
        <div class="border-4 border-start border-success card shadow rounded-3 border-0" style="width: 15rem;">
          <div class="card-body d-flex justify-content-between">
            <div>
              <h5 class="card-title">Laporan Selesai</h5>
              <p class="card-text fw-semibold "><?= $count_selesai ?> laporan</p>
            </div>

            <div class="my-auto">
              <i class="fa-regular fa-circle-check fa-2xl text-secondary"></i>
            </div>
          </div>
        </div>

        <!-- Card laporan diproses -->
        <div class="border-4 border-start border-warning card shadow rounded-3 border-0" style="width: 15rem;">
          <div class="card-body d-flex justify-content-between">
            <div>
              <h5 class="card-title">Laporan Diproses</h5>
              <p class="card-text fw-semibold"><?= $count_diproses ?> laporan</p>
            </div>

            <div class="my-auto">
              <i class="fa-solid fa-hourglass-start fa-2xl text-secondary"></i>
            </div>
          </div>
        </div>

        <!-- Card laporan ditolak -->
        <div class="border-4 border-start border-danger card shadow rounded-3 border-0" style="width: 15rem;">
          <div class="card-body d-flex justify-content-between">
            <div>
              <h5 class="card-title">Laporan Ditolak</h5>
              <p class="card-text fw-semibold"><?= $count_ditolak ?> laporan</p>
            </div>

            <div class="my-auto">
              <i class="fa-solid fa-ban fa-2xl text-secondary"></i>
            </div>
          </div>
        </div>
      </div>

      <div class="card shadow rounded border-0">
        <div class="card-body">
          <!-- Alert berhasil membuat laporan -->
          <?php
          if (isset($_SESSION['success']) && $_SESSION['success'] == 'berhasil_membuat_laporan') {
          ?>
            <div class='alert alert-success' role='alert'>
              Laporan berhasil diajukan.
            </div>
          <?php
            unset($_SESSION['success']);
          }
          ?>

          <!-- Alert gagal membuat laporan -->
          <?php
          if (isset($_SESSION['error']) && $_SESSION['error'] == 'danger_membuat_laporan') {
          ?>
            <div class='alert alert-danger' role='alert'>
              Laporan gagal diajukan.
            </div>
          <?php
            unset($_SESSION['error']);
          }
          ?>

          <!-- Tabel daftar laporan -->
          <table class="table border-dark-subtle">
            <thead>
              <tr class="border-dark-subtle">
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">NIM</th>
                <th scope="col">Program Studi</th>
                <th scope="col">Jenis</th>
                <th scope="col">Deskripsi</th>
                <th scope="col">Berkas</th>
                <th scope="col">Waktu Dibuat</th>
                <th scope="col">Status</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              <?php
              $query = "SELECT laporan.*, mahasiswa.nama, mahasiswa.nim, mahasiswa.prodi FROM laporan INNER JOIN mahasiswa ON laporan.nim_mahasiswa = mahasiswa.nim";
              $result = mysqli_query($koneksi, $query);

              $nomor = 1;

              while ($item  = mysqli_fetch_assoc($result)) {
              ?>
                <tr>
                  <!-- Nomor -->
                  <th scope="row">
                    <?= $nomor ?>
                  </th>

                  <!-- Nama -->
                  <td>
                    <?= $item['nama'] ?>
                  </td>

                  <!-- NIM -->
                  <td>
                    <?= $item['nim'] ?>
                  </td>

                  <!-- Program Studi -->
                  <td>
                    <?= $item['prodi'] ?>
                  </td>

                  <!-- Jenis pengaduan -->
                  <td>
                    <?= $item['jenis_pengaduan'] ?>
                  </td>

                  <!-- Deskripsi Laporan -->
                  <td>
                    <button type="button" class="btn btn-info btn-sm rounded-3 py-0 px-2" data-bs-toggle="modal" data-bs-target="#modalDeskripsiLaporan<?= $nomor ?>">
                      Lihat
                    </button>

                    <!-- Modal deskripsi laporan -->
                    <div class="modal fade" id="modalDeskripsiLaporan<?= $nomor ?>" tabindex="-1" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Deskripsi Pengaduan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <?= $item['deskripsi_pengaduan'] ?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>

                  <!-- Berkas -->
                  <td>
                    <?php if (!empty($item['berkas_pendukung'])) { ?>
                      <a href="../../../storage/<?= $item['berkas_pendukung'] ?>" class="btn btn-info btn-sm rounded-3 py-0 px-2" download>
                        Unduh
                      </a>
                    <?php } else { ?>
                      <button type="button" class="btn btn-info btn-sm rounded-3 py-0 px-2" disabled>
                        Kosong
                      </button>
                    <?php } ?>
                  </td>

                  <!-- Waktu dibuat -->
                  <td>
                    <?= date('d/m/Y H:i', strtotime($item['created_at'])) ?>
                  </td>

                  <!-- Status laporan -->
                  <td>
                    <!-- Laporan Diproses -->
                    <?php
                    if ($item['status'] == 'diproses') {
                    ?>
                      <span class="badge rounded-pill text-bg-warning">Diproses</span>
                    <?php
                    }
                    ?>

                    <!-- Laporan ditolak -->
                    <?php
                    if ($item['status'] == 'ditolak') {
                    ?>
                      <span class="badge rounded-pill text-bg-danger">Ditolak</span>
                    <?php
                    }
                    ?>

                    <!-- Laporan selesai -->
                    <?php
                    if ($item['status'] == 'selesai') {
                    ?>
                      <span class="badge rounded-pill text-bg-success">Selesai</span>
                    <?php
                    }
                    ?>
                  </td>

                  <!-- Kelola laporan -->
                  <td>
                    <a href="kelola-laporan.php?id=<?= $item['id'] ?>" class="text-black text-decoration-none">
                      <i class="fa-solid fa-pen-to-square fa-lg"></i>
                    </a>
                  </td>
                </tr>
              <?php
                $nomor++;
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </main>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>