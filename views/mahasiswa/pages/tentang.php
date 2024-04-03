<?php
session_start();

// Tidak boleh masuk ke halaman home jika belum log in
if (!(isset($_SESSION['role']) && $_SESSION['role'] == "mahasiswa")) {
  header('Location: ../../auth/pages/login.php');
}

// Variable untuk mendeteksi nav-link active sidebar
$current_page = "tentang";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tentang | E-Complaint Fakultas Teknik Universitas Mulawarman</title>

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
        <h2>Tentang</h2>
      </div>

      <!-- Tentang kami -->
      <div class="card shadow rounded border-0 mb-3">
        <div class="card-body">
          <h5 class="card-title mb-3">Tentang Kami</h5>

          <hr>

          <p class="card-text">Selamat datang di E-Complaint Fakultas Teknik Universitas Mulawarman. Kami adalah platform yang didedikasikan untuk memfasilitasi mahasiswa dalam menyampaikan pengaduan terkait berbagai hal yang berkaitan dengan kehidupan akademik dan administratif di lingkungan kampus.</p>

          <p class="card-text">Kami percaya bahwa setiap masukan dan pengalaman dari mahasiswa sangat berharga dalam meningkatkan kualitas layanan dan fasilitas di Fakultas Teknik Universitas. Melalui platform ini, kami memungkinkan mahasiswa untuk dengan mudah menyampaikan pengaduan mereka terkait dengan UKT, administrasi, fasilitas, aspek akademik, atau hal lain yang mereka temui.</p>

          <p class="card-text">Kami memahami betapa pentingnya transparansi dan keterbukaan dalam menangani setiap pengaduan. Oleh karena itu, setiap pengaduan yang kami terima akan ditangani secara profesional dan transparan. Kami juga menyediakan fasilitas untuk melampirkan foto atau berkas pendukung agar pengaduan Anda dapat diproses dengan lebih baik.</p>

          <p class="card-text">Tim kami selalu siap sedia untuk membantu dan menangani setiap pengaduan dengan cepat dan efisien. Kami berkomitmen untuk terus meningkatkan layanan kami demi kenyamanan dan kepuasan seluruh mahasiswa Fakultas Teknik Universitas.</p>

          <p class="card-text">Terima kasih atas kepercayaan Anda kepada kami untuk menyampaikan pengaduan Anda. Jangan ragu untuk menggunakan platform ini sebagai sarana untuk menyampaikan masukan dan pengalaman Anda. Bersama-sama, mari kita berkontribusi dalam menciptakan lingkungan kampus yang lebih baik dan berkualitas.</p>
        </div>
      </div>

      <!-- Visi -->
      <div class="card shadow rounded border-0 mb-3">
        <div class="card-body">
          <h5 class="card-title mb-3">Visi</h5>

          <hr>

          <p class="card-text">Menjadi platform yang terpercaya dan efektif dalam menangani pengaduan mahasiswa serta menjadi agen perubahan yang berkontribusi dalam meningkatkan kualitas lingkungan akademik dan administratif di Fakultas Teknik Universitas Mulawarman.</p>
        </div>
      </div>

      <!-- Misi -->
      <div class="card shadow rounded border-0">
        <div class="card-body">
          <h5 class="card-title mb-3">Misi</h5>

          <hr>

          <ol>
            <li>
              Membangun platform yang mudah diakses dan responsif untuk memfasilitasi mahasiswa dalam menyampaikan pengaduan terkait berbagai aspek kehidupan kampus.
            </li>
            <li>
              Menyediakan layanan yang transparan, profesional, dan cepat dalam menangani setiap pengaduan yang diterima.
            </li>
            <li>
              Mendorong partisipasi aktif mahasiswa dalam memberikan masukan dan pengalaman mereka guna memperbaiki layanan dan fasilitas di Fakultas Teknik Universitas.
            </li>
            <li>
              Mengedepankan prinsip keadilan dan kesetaraan dalam penanganan setiap pengaduan, tanpa memandang status sosial, budaya, atau latar belakang lainnya.
            </li>
            <li>
              Terus melakukan evaluasi dan perbaikan berkelanjutan terhadap sistem dan prosedur yang ada untuk meningkatkan efisiensi dan efektivitas layanan kepada mahasiswa.
            </li>
            <li>
              Menjalin kerjasama dengan berbagai pihak terkait di Fakultas Teknik Universitas untuk memastikan implementasi solusi yang tepat dan berkelanjutan atas setiap pengaduan yang diajukan.
            </li>
            <li>
              Mengembangkan program-program edukasi dan advokasi untuk meningkatkan kesadaran mahasiswa tentang pentingnya berpartisipasi dalam membangun lingkungan kampus yang inklusif dan berkualitas.
            </li>
          </ol>

        </div>
      </div>
    </main>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>

</html>