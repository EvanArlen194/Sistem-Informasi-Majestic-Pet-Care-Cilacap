<?php
session_start();

//koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "majestic");

$id_produk = $_GET["id"];
$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
$detail = $ambil->fetch_assoc();

if (isset($_POST["beli"])) {
    if (empty($_POST["jumlah"]) || $_POST["jumlah"] <= 0) {
        echo "<script>alert('Masukkan jumlah yang valid.');</script>";
        echo "<script>location = 'detail.php?id=$id_produk';</script>"; // Redirect back to detail.php
        exit;
    } else {
        $jumlah = $_POST["jumlah"];
        $_SESSION["keranjang"][$id_produk] = $jumlah;
        echo "<script>alert('Produk telah masuk ke keranjang belanja');</script>";
        echo "<script>location = 'keranjang.php';</script>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Majestic Pet Care - Detail Produk</title>
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
	<style>
  h2 {
    margin-top: 25px;
  }

  .col-md-6 img {
    width: 60%;
    height: auto;
    margin-right: 20px; /* Add margin to the right side of the image */
  }

  .form-group {
    margin-bottom: 20px;
  }

  .form-group input {
    width: 100%;
    max-width: 200px;
    padding: 10px;
  }

  .input-group-btn {
    width: 100%;
    margin-top: 10px;
  }

  .kontent {
    margin-top: 50px;
    margin-bottom : 120px;
  }
</style>


  </head>
  <body>
    <nav
      class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light"
      id="ftco-navbar"
    >
      <div class="container">
        <a class="navbar-brand" href="index.php"
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
            <div class="row">
                <div class="col-md-6">
                    <img src="foto_produk/<?php echo $detail["foto_produk"]; ?>" alt="" class="img-responsive">
                </div>
                <div class="col-md-6">
                    <h2><?php echo $detail["nama_produk"] ?></h2>           
                    <p><?php echo $detail["deskripsi_produk"]; ?></p>
                    <h4>Rp. <?php echo number_format($detail["harga_produk"]); ?></h4>
                    <form method="post">
                        <div class="form-group">
                            <label for="jumlah">Jumlah:</label>
                            <input type="number" min="1" class="form-control" name="jumlah" id="jumlah">
                            <div class="input-group-btn">
                                <button class="btn btn-primary" name="beli">Beli</button>
                                <a href="produk.php" class="btn btn-default">Kembali</a>
                            </div>
                        </div>
                    </form>
          <?php
          if (isset($_POST["beli"])) {
            $jumlah = $_POST["jumlah"];
            $_SESSION["keranjang"][$id_produk] = $jumlah;
            echo "<script>alert('Produk telah masuk ke keranjang belanja');</script>";
            echo "<script>location = 'keranjang.php';</script>";
          }
          ?>
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
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
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

 </body>
 </html>