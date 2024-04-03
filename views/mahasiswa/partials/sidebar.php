<div class="position-sticky d-flex align-items-center" style="top:69px; height:91vh">
  <div class="d-flex flex-column p-3 bg-white shadow ms-4 rounded-4 zn-1" style="width: 250px; height:85vh;">
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="beranda.php" class="nav-link <?php echo ($current_page == "beranda") ? 'active' : 'text-black' ?>">
          <i class="fa-solid fa-house me-1 <?php echo ($current_page == "beranda") ? 'white-black' : 'text-black' ?>"></i>
          Beranda
        </a>
      </li>
      <li class="nav-item">
        <a href="laporan.php" class="nav-link <?php echo ($current_page == "laporan") ? 'active' : 'text-black' ?>">
          <i class="fa-solid fa-envelope me-1" <?php echo ($current_page == "laporan") ? 'white-black' : 'text-black' ?>></i>
          Laporan
        </a>
      </li>
      <li class="nav-item">
        <a href="tentang.php" class="nav-link <?php echo ($current_page == "tentang") ? 'active' : 'text-black' ?>">
          <i class="fa-solid fa-circle-question me-1" <?php echo ($current_page == "tentang") ? 'white-black' : 'text-black' ?>></i>
          Tentang
        </a>
      </li>
    </ul>
  </div>
</div>