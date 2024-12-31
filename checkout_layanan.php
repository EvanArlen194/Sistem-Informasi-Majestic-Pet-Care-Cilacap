<?php
session_start();
$koneksi = new mysqli("localhost", "root", "", "majestic");

if (!isset($_SESSION["pelanggan"])) {
    echo "<script>alert('Silahkan masuk');</script>";
    echo "<script>location = 'index.php';</script>";
    // Ambil data dari form
    $id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
    $tanggal_pembelian = date("Y-m-d");
    $waktu_pembelian = $_POST['waktu']; // Ambil waktu dari form

    $total_pembelian = 0;

    // Hitung total pembelian dan lakukan proses lainnya sesuai kebutuhan

    // Simpan data ke tabel pembelian_layanan_layanan
    $query_pembelian = "INSERT INTO pembelian_layanan_layanan (id_pelanggan, tanggal_pembelian, waktu_pembelian, total_pembelian) VALUES (?, ?, ?, ?)";
    $stmt_pembelian = $koneksi->prepare($query_pembelian);
    $stmt_pembelian->bind_param("issd", $id_pelanggan, $tanggal_pembelian, $waktu_pembelian, $total_pembelian);

    if ($stmt_pembelian->execute()) {
        // Ambil ID pembelian yang baru saja dibuat
        $id_pembelian = $stmt_pembelian->insert_id;

        // Simpan detail layanan ke tabel pembelian_layanan
        foreach ($_SESSION['layanan'] as $id_layanan => $jumlah) {
            // ... (proses penyimpanan detail layanan)
        }

        // Hapus layanan dari session setelah berhasil checkout
        unset($_SESSION['layanan']);

        header("location: nota_layanan.php?id=$id_pembelian");
        exit();
    } else {
        $alertMessage = "Maaf, Terdapat Kesalahan Saat Menyimpan Data Pembelian.";
    }

    $stmt_pembelian->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Majestic Pet Care - Checkout</title>
    <link rel="icon" href="fonts/favicon_io/favicon.ico" type="image/x-icon">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600,700,800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="css/animate.css" />
    <link rel="stylesheet" href="css/owl.carousel.min.css" />
    <link rel="stylesheet" href="css/owl.theme.default.min.css" />
    <link rel="stylesheet" href="css/magnific-popup.css" />
    <link rel="stylesheet" href="css/bootstrap-datepicker.css" />
    <link rel="stylesheet" href="css/jquery.timepicker.css" />
    <link rel="stylesheet" href="css/flaticon.css" />
    <link rel="stylesheet" href="css/style.css" />
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
    margin-bottom: 230px;
  }
    </style>
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
            <h1>Checkout Layanan</h1>
            <hr>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Layanan</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Waktu</th>
                        <th>Subharga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $nomor = 1; ?>
                    <?php $totalbelanja = 0; ?>
                    <?php foreach ($_SESSION["keranjang_layanan"] as $id_layanan => $data): ?>
                        <?php
                        $jumlah = $data['jumlah'];
                        $waktu = $data['waktu'];

                        $ambil = $koneksi->query("SELECT * FROM layanan WHERE id_layanan='$id_layanan'");
                        $pecah = $ambil->fetch_assoc();
                        $subharga = $pecah["harga_layanan"] * $jumlah;
                        ?>
                        <tr>
                            <td><?php echo $nomor; ?></td>
                            <td><?php echo $pecah["nama_layanan"]; ?></td>
                            <td><?php echo number_format($pecah["harga_layanan"]); ?></td>
                            <td><?php echo $jumlah; ?></td>
                            <td><?php echo $waktu; ?></td>
                            <td>Rp. <?php echo number_format($subharga); ?></td>
                        </tr>
                        <?php $nomor++; ?>
                        <?php $totalbelanja += $subharga; ?>
                    <?php endforeach ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="5">Total Belanja</th>
                        <th>Rp. <?php echo number_format($totalbelanja) ?></th>
                    </tr>
                </tfoot>
            </table>

            <form method="post">
                <div class="form-group">
                    <a href="keranjang_layanan.php" class="btn btn-default">Kembali</a>
                    <button class="btn btn-primary" name="checkout">Checkout</button>
                </div>
            </form>

            <?php
            if (isset($_POST["checkout"])) {
                $id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
                $tanggal_pembelian = date("Y-m-d");
                $total_pembelian = $totalbelanja;

                $koneksi->query("INSERT INTO pembelian_layanan_layanan (id_pelanggan, tanggal_pembelian, total_pembelian) VALUES ('$id_pelanggan', '$tanggal_pembelian', '$total_pembelian')");

                $id_pembelian_barusan = $koneksi->insert_id;
                foreach ($_SESSION["keranjang_layanan"] as $id_layanan => $data) {
                    $ambil = $koneksi->query("SELECT * FROM layanan WHERE id_layanan='$id_layanan'");
                    $perproduk = $ambil->fetch_assoc();
                    $nama = $perproduk['nama_layanan'];
                    $harga = $perproduk['harga_layanan'];
                    $subharga = $perproduk['harga_layanan'] * $data['jumlah'];

                    $koneksi->query("INSERT INTO pembelian_layanan (id_pembelian, id_layanan, nama, harga, subharga, jumlah, waktu) VALUES ('$id_pembelian_barusan', '$id_layanan', '$nama', '$harga', '$subharga', '{$data['jumlah']}', '{$data['waktu']}')");
                }
                unset($_SESSION["keranjang_layanan"]);

                echo "<script>alert('Pemesanan sukses');</script>";
                echo "<script>location = 'nota_layanan.php?id=$id_pembelian_barusan';</script>";
            }
            ?>
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