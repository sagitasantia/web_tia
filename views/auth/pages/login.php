<!DOCTYPE html>
<html lang="en" data-bs-theme="auto">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Log In | E-Complaint Fakultas Teknik Universitas Mulawarman</title>

  <!-- Hubungkan file CSS eksternal -->
  <link rel="stylesheet" href="../../../css/styles.css">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" crossorigin="anonymous">

  <!-- CSS Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-vgs43iZ61t4OqltmKaXdkRxTMV5Y1eABybP+Vovh+41Q0KzHuDDtVgFJnmiHpRzNwtgL1D8xNJpeZD9qf0Pvhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="login-body"> <!-- Tambahkan kelas login-body di sini -->
  <!-- Konten halaman log in -->
  <main class="d-flex justify-content-center align-items-center" style="height: 100vh;">
    <!-- Konten kartu log in -->
    <div class="card shadow rounded border-0 rounded-3" style="width: 22rem">
      <div class="card-body m-3">
        <!-- Simbol untuk dark mode (bulan) -->
        <div class="dark-mode-toggle">
          <i class="fas fa-moon"></i> <!-- Font Awesome ikon bulan -->
        </div>
        <!-- Simbol untuk light mode (matahari) -->
        <div class="light-mode-toggle">
          <i class="fas fa-sun"></i> <!-- Font Awesome ikon matahari -->
        </div>
        
        <!-- Konten lainnya -->
        <!-- Alert jika log in salah -->
        <?php
        if (isset($_SESSION['error']) && $_SESSION['error'] == 'login_failed') {
          echo "<div class='alert alert-danger text-center' role='alert'>";
          echo "Log in salah. Silakan coba lagi.";
          echo "</div>";

          unset($_SESSION['error']);
        }
        ?>

        <img class="mb-3 mx-auto d-block" src="../../../asset/logo-unmul.png" alt="" width="72" height="72">

        <h5 class="card-title text-center mb-3">E-Complaint Fakultas Teknik <br> Universitas Mulawarman</h5>
        <h6 class="card-subtitle mb-3 text-body-secondary text-center small" id="card-subtitle">Silahkan log in untuk mengelola laporan</h6>

        <!-- Form log in -->
        <form method="POST" action="../../../proses/login.php" id="loginForm">
          <div class="mb-3">
            <label for="nim" id="nimLabel" class="form-label fw-semibold">NIM</label>
            <input type="text" class="form-control" name="nim" id="nim">
          </div>

          <div class="mb-3">
            <label for="password" class="form-label fw-semibold">Password</label>
            <input type="password" class="form-control" name="password" id="password">
          </div>

          <div class="mb-4">
            <label for="role" class="form-label fw-semibold">Log in sebagai</label>
            <select class="form-select" id="role" name="role" onchange="changeRole()">
              <option value="mahasiswa">Mahasiswa</option>
              <option value="admin">Admin</option>
            </select>
          </div>

          <button class="btn btn-primary w-100 py-2" type="submit" name="login">Log in</button>
        </form>
      </div>
    </div>
  </main>

  <!-- Bootstrap Bundle JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

  <!-- Custom JavaScript -->
  <script src="../../../js/auth.js"></script>
</body>

</html>
