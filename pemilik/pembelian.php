<?php
session_start();
//koneksi ke database
$koneksi= new mysqli("localhost","root","","majestic");

// Query untuk mengambil data nama produk dan jumlah pembelian yang sudah lunas
$sql = "SELECT nama, SUM(jumlah) as total_jumlah FROM pembelian_produk
        WHERE id_pembelian IN (SELECT id_pembelian FROM pembelian WHERE status_pembayaran = 'Lunas')
        GROUP BY nama";
$result = $koneksi->query($sql);

// Inisialisasi array untuk menyimpan data nama dan jumlah
$labels = [];
$data = [];

// Memasukkan data dari hasil query ke dalam array
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $labels[] = $row["nama"];
        $data[] = $row["total_jumlah"];
    }
}

// Tutup koneksi database
$koneksi->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">
  <title>Pemilik - Pembelian Produk</title>
  <link rel="icon" href="../fonts/favicon_io/favicon.ico" type="image/x-icon">
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../admin/assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
  <link id="pagestyle" href="../admin/assets/css/style.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<body class="g-sidenav-show   bg-white-100">
<div class="min-height-300 bg-white position-absolute w-100"></div>
  <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0">
        <img src="../images/logo.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">Majestic Pet Care</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="home.php">
            <span class="nav-link-text ms-1">Beranda</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="pembelian.php">
            <span class="nav-link-text ms-1">Pembelian Produk</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="pemesanan.php">
            <span class="nav-link-text ms-1">Pemesanan Layanan</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="pelanggan.php">
            <span class="nav-link-text ms-1">Pelanggan</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="../logout.php">
            <span class="nav-link-text ms-1">Keluar</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>
  <main class="main-content position-relative border-radius-lg d-flex flex-column align-items-center" style="height: 100vh;">
    <div style="width: 30%; flex: 1; display: flex; flex-direction: column; justify-content: flex-end;">
      <canvas id="myPieChart"></canvas>
    </div>
  </main>
    <script>
        // Data untuk pie chart
        var data = {
            labels: <?php echo json_encode($labels); ?>,
            datasets: [{
                data: <?php echo json_encode($data); ?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 206, 86, 0.7)',
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(153, 102, 255, 0.7)',
                    'rgba(255, 159, 64, 0.7)',
                    'rgba(255, 99, 132, 0.7)',
                ],
            }]
        };

        // Konfigurasi pie chart
        var options = {
            responsive: true,
            maintainAspectRatio: false,
        };

        // Membuat pie chart
        var ctx = document.getElementById('myPieChart').getContext('2d');
        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: data,
            options: options
        });
    </script>
</body>
</html>
