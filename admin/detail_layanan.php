<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">
  <title>Admin - Pemesanan Layanan</title>
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
  <link id="pagestyle" href="./assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
  <link rel="stylesheet" href="../css/style.css" />
  <link id="pagestyle" href="./assets/css/style.css" rel="stylesheet" />
</head>
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
          <a class="nav-link" href="produk.php">
            <span class="nav-link-text ms-1">Produk</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="layanan.php">
            <span class="nav-link-text ms-1">Layanan</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="pembelian.php">
            <span class="nav-link-text ms-1">Pembelian Produk</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="pemesanan.php">
            <span class="nav-link-text ms-1">Pemesanan Layanan</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="pelanggan.php">
            <span class="nav-link-text ms-1">Pelanggan</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="logout.php">
            <span class="nav-link-text ms-1">Keluar</span>
          </a>
        </li>
      </ul>
    </div>
</aside>

<main class="main-content position-relative border-radius-lg ">
<section class="py-4">
<div class="container-fluid">
        <h3 class="mb-4">Detail Pemesanan</h3>
        <div class="table-responsive">

    <?php 
    $koneksi = new mysqli("localhost", "root", "", "majestic");
    $ambil = $koneksi->query("SELECT * FROM pembelian_layanan_layanan JOIN pelanggan ON pembelian_layanan_layanan.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian_layanan_layanan.id_pembelian='$_GET[id]'");
    $detail = $ambil->fetch_assoc();
    ?>

    <strong><?php echo $detail['nama_pelanggan']; ?></strong> <br>
    <p>
        <?php echo $detail['telepon_pelanggan']; ?> <br>
        <?php echo $detail['email_pelanggan']; ?> 
    </p>

    <p>
        Tanggal: <?php echo $detail['tanggal_pembelian']; ?> <br>
        Total: <?php echo $detail['total_pembelian']; ?> 
    </p>
    <table class="table table-bordered">
        <thead> 
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Nama Layanan</th>
                <th class="text-center">Harga</th>
                <th class="text-center">Jumlah</th>
                <th class="text-center">Waktu</th>
                <th class="text-center">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php $nomor=1; ?>
            <?php $ambil=$koneksi->query("SELECT * FROM pembelian_layanan JOIN layanan ON pembelian_layanan.id_layanan = layanan.id_layanan WHERE pembelian_layanan.id_pembelian='$_GET[id]'"); ?>
            <?php while($pecah=$ambil->fetch_assoc()){ ?>
            <tr>
                <td class="text-center"><?php echo $nomor; ?></td>
                <td class="text-center"><?php echo $pecah['nama_layanan'];?></td>
                <td class="text-center"><?php echo $pecah['harga_layanan'];?></td>
                <td class="text-center"><?php echo $pecah['jumlah'];?></td>
                <td class="text-center"><?php echo $pecah['waktu'];?></td>
                <td class="text-center"><?php echo $pecah['harga_layanan'] * $pecah['jumlah']; ?></td>
            </tr>
            <?php $nomor++; ?>
            <?php } ?>
        </tbody>
    </table>
    <div class="mb-4">
    <h4>Bukti Pembayaran</h4>
    <img src="display_image_layanan.php?id=<?php echo $_GET['id']; ?>" alt="Bukti Pembayaran" style="max-width: 100%; height: 300px; width: 250px;">
</div>

</div>
<div>
        <a href="pemesanan.php" class="btn btn-abu">Kembali</a>
				</div>
			</section>
			</main>

<!-- Add Bootstrap JS and Popper.js scripts -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
