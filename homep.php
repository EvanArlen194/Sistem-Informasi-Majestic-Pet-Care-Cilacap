<?php
session_start();
//koneksi ke database
  $koneksi= new mysqli("localhost","root","","majestic");
?> 

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Majestic Pet Care - Beranda</title>
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
    .navbar-brand {
    color: #000000 !important; /* Mengubah warna teks brand menjadi hitam */
}

.navbar-nav .nav-link {
    color: #000000 !important; /* Mengubah warna teks link menjadi hitam */
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
    <!-- END nav -->
    <div
      class="hero-wrap js-fullheight"
      style="background-image: url('images/pet.png')"
      data-stellar-background-ratio="0.5"
    >
      <div class="overlay"></div>
      <div class="container">
        <div
          class="row no-gutters slider-text js-fullheight align-items-center justify-content-center"
          data-scrollax-parent="true"
        >
          <div class="col-md-11 ftco-animate text-center">
            <h1 class="mb-4">Menyediakan Perawatan Berkualitas untuk Hewan Kesayangan Anda</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section ftco-no-pt ftco-no-pb">
      <div class="container">
        <div class="row d-flex no-gutters">
          <div class="col-md-5 d-flex">
            <div
              class="img img-video d-flex align-self-stretch align-items-center justify-content-center justify-content-md-center mb-4 mb-sm-0"
              style="background-image: url(images/about-1.jpg)"
            ></div>
          </div>
          <div class="col-md-7 pl-md-5 py-md-5">
            <div class="heading-section pt-md-5">
              <h2 class="mb-4">Mengapa Memilih Kami?</h2>
            </div>
            <div class="row">
              <div class="col-md-6 services-2 w-100 d-flex">
                <div
                  class="icon d-flex align-items-center justify-content-center"
                >
                  <span class="flaticon-stethoscope"></span>
                </div>
                <div class="text pl-3">
                  <h4>Saran Perawatan</h4>
                  <p>
                  Dapatkan panduan perawatan yang ahli dan disesuaikan untuk hewan peliharaan Anda, membantu Anda menjaga kesehatan dan kebahagiaan mereka sepanjang waktu.
                  </p>
                </div>
              </div>
              <div class="col-md-6 services-2 w-100 d-flex">
                <div
                  class="icon d-flex align-items-center justify-content-center"
                >
                  <span class="flaticon-customer-service"></span>
                </div>
                <div class="text pl-3">
                  <h4>Dukungan Pelanggan</h4>
                  <p>
                  Tim dukungan pelanggan yang ramah dan responsif siap membantu menjawab pertanyaan Anda mengenai produk, layanan atau kebutuhan lainnya terkait hewan peliharaan Anda.
                  </p>
                </div>
              </div>
              <div class="col-md-6 services-2 w-100 d-flex">
                <div
                  class="icon d-flex align-items-center justify-content-center"
                >
                  <span class="flaticon-emergency-call"></span>
                </div>
                <div class="text pl-3">
                  <h4>Layanan Darurat</h4>
                  <p>
                  Siap sedia memberikan bantuan medis darurat untuk situasi kritis pada hewan peliharaan Anda, memastikan respon cepat dan efisien dalam setiap keadaan mendesak.
                  </p>
                </div>
              </div>
              <div class="col-md-6 services-2 w-100 d-flex">
                <div
                  class="icon d-flex align-items-center justify-content-center"
                >
                  <span class="flaticon-veterinarian"></span>
                </div>
                <div class="text pl-3">
                  <h4>Bantuan Veteriner</h4>
                  <p>
                  Akses mudah ke bantuan veteriner, termasuk konsultasi gratis dan panduan pertolongan pertama, untuk menjaga kesehatan optimal hewan peliharaan Anda.
                  </p>
                </div>
              </div>
            </div>
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

    <!-- loader -->
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
  </body>
</html>
