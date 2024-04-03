<nav class="navbar bg-white shadow-sm position-sticky z-3 top-0">
  <div class="container-fluid my-1 mx-4">
    <div class="d-flex">
      <a class="navbar-brand d-flex" href="#">
        <img src="../../../asset/logo-unmul.png" alt="" class="me-2" height="35">
        <p class="small m-0 fw-semibold my-auto">E-Complaint Fakultas Teknik Universitas Mulawarman</p>
      </a>
    </div>

    <div class="dropdown">
      <a href="#" class="d-flex align-items-center text-black text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fa-solid fa-circle-user fa-xl me-2" style="color: black"></i>
        <strong>
          <?php
          echo $_SESSION['nama'];
          ?>
        </strong>
      </a>
      <ul class="dropdown-menu text-small shadow dropdown-menu-end">
        <li><a class="dropdown-item" href="../../../proses/logout.php">Log out</a></li>
      </ul>
    </div>
  </div>
</nav>