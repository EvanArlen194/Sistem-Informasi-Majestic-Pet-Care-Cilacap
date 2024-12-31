<?php
session_start();
include 'koneksi.php'; 

// Initialize variable for alert message
$alertMessage = "";

// Handle form submission for proof of payment
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['bukti_pembayaran'])) {
    // Handle file upload logic here
    $bukti_pembayaran = file_get_contents($_FILES["bukti_pembayaran"]["tmp_name"]);

    // Insert the file content into the database
    $query = "UPDATE pembelian SET bukti_pembayaran = ? WHERE id_pembelian = ?";
    $stmt = $koneksi->prepare($query);
    $stmt->bind_param("si", $bukti_pembayaran, $_GET['id']);

    if ($stmt->execute()) {
        $alertMessage = "Bukti Pembayaran Berhasil Diunggah.";
    } else {
        $alertMessage = "Maaf, Terdapat Kesalahan Saat Menyimpan Bukti Pembayaran.";
    }

    $stmt->close();
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Majestic Pet Care - Nota</title>
    <link rel="icon" href="fonts/favicon_io/favicon.ico" type="image/x-icon">
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600,700,800&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link rel="stylesheet" href="css/animate.css" />

    <link rel="stylesheet" href="css/owl.carousel.min.css" />
    <link rel="stylesheet" href="css/owl.theme.default.min.css" />
    <link rel="stylesheet" href="css/magnific-popup.css" />
    <link rel="stylesheet" href="css/bootstrap-datepicker.css" />
    <link rel="stylesheet" href="css/jquery.timepicker.css" />
    <link rel="stylesheet" href="css/flaticon.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
  <style>
        .navbar-brand {
    color: #000000 !important; /* Mengubah warna teks brand menjadi hitam */
}

.navbar-nav .nav-link {
    color: #000000 !important; /* Mengubah warna teks link menjadi hitam */
} 
.kontent h1 {
        font-size: 24px; /* Sesuaikan ukuran font sesuai keinginan */
        margin-top: 20px
    }
    .table-bordered {
        border: 1px solid black;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        padding: 8px; /* Ruang di dalam sel tabel */
        text-align: center; /* Teks di tengah sel tabel */
    }
    .kontent {
    margin-bottom: 210px;
  }
        </style>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>

<nav
      class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light"
      id="ftco-navbar"
    >
      <div class="container">
        <a class="navbar-brand"
          ><img src="images/logo.png" alt="Majestic Pet Care" style="width: 50px; height: 50px; margin-right: 10px;">Majestic Pet Care</a>

        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#ftco-nav"
          aria-controls="ftco-nav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="fa fa-bars"></span> Menu
        </button>
        <div class="collapse navbar-collapse" id="ftco-nav">
          <ul class="navbar-nav ml-auto">
          <li class="nav-item">
              <a href="homep.php" class="nav-link">Beranda</a>
            </li>
            <li class="nav-item">
              <a href="produk.php" class="nav-link">Produk</a>
            </li>
            <li class="nav-item">
              <a href="services.php" class="nav-link">Layanan</a>
            </li>
			<?php if (isset($_SESSION["pelanggan"])): ?>
				<li class="nav-item">
              <a href="logout.php" class="nav-link">Keluar</a>
            </li>
			<?php else: ?>
            <li class="nav-item">
              <a href="login.php" class="nav-link">Masuk/Daftar</a>
            </li>
			<?php endif ?>
          </ul>
        </div>
      </div>
    </nav>

    <section class="kontent">
    <div class="container">

        <h1>Nota Pembelian</h1>
        <?php 
        $ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'");
        $detail = $ambil->fetch_assoc();
        ?>

        <strong><?php echo $detail['nama_pelanggan']; ?></strong> <br>
        <p>
            <?php echo $detail['telepon_pelanggan']; ?> <br>
            <?php echo $detail['email_pelanggan']; ?> 
        </p>

        <p>
            Tanggal : <?php echo $detail['tanggal_pembelian']; ?> <br>
            Total : <?php echo $detail['total_pembelian']; ?> 
        </p>

        <!-- Display purchased products -->
        <table class="table table-bordered">
            <thead> 
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php $nomor=1; ?>
                <?php $ambil=$koneksi->query("SELECT * FROM pembelian_produk 
                    JOIN produk ON pembelian_produk.id_produk = produk.id_produk
                    WHERE pembelian_produk.id_pembelian='$_GET[id]'"); ?>
                <?php while($pecah=$ambil->fetch_assoc()){ ?>
                    <tr>
                        <td><?php echo $nomor; ?></td>
                        <td><?php echo $pecah['nama_produk'];?></td>
                        <td><?php echo $pecah['harga_produk'];?></td>
                        <td><?php echo $pecah['jumlah'];?></td>
                        <td>
                            <?php echo $pecah['harga_produk']*$pecah['jumlah']; ?>
                        </td>
                    </tr>
                    <?php $nomor++; ?>
                <?php } ?>
            </tbody>
        </table>

        <!-- Payment information and proof of payment upload in the same row -->
        <div class="row">
            <div class="col-md-7">
                <div class="alert alert-info">
                    <p>
                        Silahkan melakukan pembayaran Rp. <?php echo number_format($detail['total_pembelian']); ?> ke kasir atau<br>
                        <strong>BANK BNI 057347890 AN. Wulan Winda Sari</strong>
                    </p>
                </div>
            </div>
            <div class="col-md-5">
                <!-- Form for uploading proof of payment -->
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="bukti_pembayaran">Upload Bukti Pembayaran:</label>
                        <input type="file" name="bukti_pembayaran" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

    </div>
</section>

<footer class="footer">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-lg-3 mb-4 mb-md-0">
            <h2 class="footer-heading">Majestic Pet Care</h2>
            <p>
              Dengan komitmen kami pada kebahagiaan dan kesejahteraan teman Anda, kami menyajikan pengalaman perawatan yang istimewa dan penuh kasih sayang.
            </p>
            <ul class="ftco-footer-social p-0">
              <li class="ftco-animate">
                <a
                  href="https://www.instagram.com/majesticpetcare/" target="_blank"
                  data-toggle="tooltip"
                  data-placement="top"
                  title="Instagram"
                  ><span class="fa fa-instagram"></span
                ></a>
              </li>
            </ul>
          </div>
          <div class="col-md-6 col-lg-3 mb-4 mb-md-0">
            <h2 class="footer-heading">Jam Kerja</h2>
            <ul class="list-unstyled">
        <li><strong>Senin:</strong> 09.00 - 20.00</li>
        <li><strong>Selasa:</strong> 09.00 - 15.00</li>
        <li><strong>Rabu:</strong> 09.00 - 20.00</li>
        <li><strong>Kamis:</strong> 09.00 - 20.00</li>
        <li><strong>Jumat:</strong> 09.00 - 20.00</li>
        <li><strong>Sabtu:</strong> 09.00 - 20.00</li>
        <li><strong>Minggu:</strong> 09.00 - 20.00</li>
      </ul>
          </div>
          <div class="col-md-6 col-lg-3 pl-lg-5 mb-4 mb-md-0">
            <h2 class="footer-heading">Quick Links</h2>
            <ul class="list-unstyled">
              <li><a href="homep.php" class="py-2 d-block">Beranda</a></li>
              <li><a href="produk.php" class="py-2 d-block">Produk</a></li>
              <li><a href="services.php" class="py-2 d-block">Layanan</a></li>
              <?php if (isset($_SESSION["pelanggan"])): ?>
              <li><a href="logout.php" class="py-2 d-block">Keluar</a></li>
              <?php else: ?>
              <li><a href="index.php" class="py-2 d-block">Masuk/Daftar</a></li>
              <?php endif ?>
            </ul>
          </div>
          <div class="col-md-6 col-lg-3 mb-4 mb-md-0">
            <h2 class="footer-heading">Butuh Bantuan?</h2>
            <div class="block-23 mb-3">
              <ul>
                <li>
                  <span class="icon fa fa-map"></span
                  ><span class="text"
                    >JL. Mayjen DI Panjaitan, Tambakreja, Cilacap Selatan, Cilacap, 53213, Kandang Macan, Tegalreja, Kec. Cilacap Sel., Kabupaten Cilacap, Jawa Tengah 53212</span
                  >
                </li>
                <li>
                  <a href="#"
                    ><span class="icon fa fa-phone"></span
                    ><span class="text">+62895611576883</span></a
                  >
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="row mt-5">
          <div class="col-md-12 text-center">
            <p class="copyright">
              <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
              Copyright &copy;
              <script>
                document.write(new Date().getFullYear());
              </script>
              Majestic Pet Care. All rights reserved. 
              <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
          </div>
        </div>
      </div>
    </footer>
    <div id="ftco-loader" class="show fullscreen">
      <svg class="circular" width="48px" height="48px">
        <circle
          class="path-bg"
          cx="24"
          cy="24"
          r="22"
          fill="none"
          stroke-width="4"
          stroke="#eeeeee"
        />
        <circle
          class="path"
          cx="24"
          cy="24"
          r="22"
          fill="none"
          stroke-width="4"
          stroke-miterlimit="10"
          stroke="#F96D00"
        />
      </svg>
    </div>
    <script>
    <?php if (!empty($alertMessage)): ?>
            alert("<?php echo $alertMessage; ?>");
        <?php endif; ?>
    </script>
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-migrate-3.0.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/jquery.animateNumber.min.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/jquery.timepicker.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/scrollax.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="js/google-map.js"></script>
    <script src="js/main.js"></script>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
