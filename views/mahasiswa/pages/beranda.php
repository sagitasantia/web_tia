<?php
session_start();

// Tidak boleh masuk ke halaman home jika belum log in
if (!(isset($_SESSION['role']) && $_SESSION['role'] == "mahasiswa")) {
  header('Location: ../../auth/pages/login.php');
}

// Variable untuk mendeteksi nav-link active sidebar
$current_page = "beranda";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda | E-Complaint Fakultas Teknik Universitas Mulawarman</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                <h2>Beranda</h2>
            </div>

            <!-- Card Selamat datang -->
            <div class="card shadow rounded border-0 mb-4">
                <div class="card-body">
                    <p class="card-text">Selamat datang di E-Complaint Fakultas Teknik Universitas Mulawarman.</p>
                </div>
            </div>

            <!-- Jam -->
            <div class="card mb-4">
                <div class="card-body text-center">
                    <h5 class="card-title"><i class="fas fa-clock"></i> Jam Sekarang</h5>
                    <div id="jam-sekarang" class="display-1"></div>
                </div>
            </div>

            <!-- Kalender -->
            <div class="card shadow rounded border-0">
                <div class="card-body shadow">
                    <h3 class="card-title bg-primary text-white p-2">Kalender</h3>
                    <div class="row">
                        <?php
                        // Menggunakan fungsi date() untuk mendapatkan informasi tanggal saat ini
                        $currentMonth = date('m');
                        $currentYear = date('Y');

                        // Mendapatkan jumlah hari dalam bulan saat ini
                        $numDays = date('t', mktime(0, 0, 0, $currentMonth, 1, $currentYear));

                        // Mendapatkan hari pertama dalam bulan saat ini
                        $firstDay = date('N', mktime(0, 0, 0, $currentMonth, 1, $currentYear));

                        // Menghitung hari dalam seminggu
                        $dayOfWeek = 1;

                        // Daftar nama bulan dalam Bahasa Indonesia
                        $bulan = array(
                            "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
                        );

                        // Membuat baris baru untuk setiap minggu
                        for ($i = 0; $i < 6; $i++) {
                            echo "<div class='col'>";
                            echo "<div class='card mb-3'>";
                            echo "<div class='card-body'>";
                            echo "<h5 class='card-title bg-primary text-white p-2'>" . $bulan[(int)$currentMonth - 1] . " $currentYear</h5>";
                            echo "<table class='table'>";
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>Sen</th>";
                            echo "<th>Sel</th>";
                            echo "<th>Rab</th>";
                            echo "<th>Kam</th>";
                            echo "<th>Jum</th>";
                            echo "<th>Sab</th>";
                            echo "<th>Ming</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";

                            // Membuat kolom untuk setiap hari dalam seminggu
                            for ($j = 0; $j < 7; $j++) {
                                // Jika sudah mencapai hari pertama dalam bulan dan belum mencapai hari terakhir dalam bulan
                                if (($i == 0 && $j >= $firstDay - 1) || ($dayOfWeek <= $numDays)) {
                                    if ($dayOfWeek == date('j') && $currentMonth == date('n') && $currentYear == date('Y')) {
                                        // Hari ini
                                        echo "<td style='background-color: #007bff; color: #fff;'>$dayOfWeek</td>";
                                    } else {
                                        echo "<td>$dayOfWeek</td>";
                                    }
                                    $dayOfWeek++;
                                } else {
                                    echo "<td></td>";
                                }
                            }

                            echo "</tbody>";
                            echo "</table>";
                            echo "</div>";
                            echo "</div>";
                            echo "</div>";

                            // Naikkan bulan jika hari sudah mencapai akhir bulan
                            if ($dayOfWeek > $numDays) {
                                $currentMonth++;
                                if ($currentMonth > 12) {
                                    $currentMonth = 1;
                                    $currentYear++;
                                }
                                // Mendapatkan jumlah hari dalam bulan baru
                                $numDays = date('t', mktime(0, 0, 0, $currentMonth, 1, $currentYear));
                                // Mendapatkan hari pertama dalam bulan baru
                                $firstDay = date('N', mktime(0, 0, 0, $currentMonth, 1, $currentYear));
                                // Reset ulang jumlah hari dalam seminggu
                                $dayOfWeek = 1;
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Script untuk menampilkan jam -->
    <script>
        function updateTime() {
            var now = new Date();
            var jam = now.getHours();
            var menit = now.getMinutes();
            var detik = now.getSeconds();

            // Menambahkan nol di depan jam, menit, dan detik jika kurang dari 10
            jam = jam < 10 ? '0' + jam : jam;
            menit = menit < 10 ? '0' + menit : menit;
            detik = detik < 10 ? '0' + detik : detik;

            document.getElementById('jam-sekarang').innerHTML = jam + ':' + menit + ':' + detik;

            // Update setiap 1 detik
            setTimeout(updateTime, 1000);
        }

        updateTime(); // Memanggil fungsi untuk pertama kali
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
</body>

</html>