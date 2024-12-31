<?php
session_start();
$koneksi = new mysqli("localhost", "root", "", "majestic");
$ambil = $koneksi->query("SELECT * FROM layanan WHERE id_layanan='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="./assets/img/favicon.png">
    <title>Admin - Layanan</title>
    <link rel="icon" href="../fonts/favicon_io/favicon.ico" type="image/x-icon">
    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link id="pagestyle" href="./assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
    <link rel="stylesheet" href="../css/style.css" />
        <link id="pagestyle" href="./assets/css/style.css" rel="stylesheet" />
    <style>

        input[type="text"],
        input[type="number"],
        input[type="file"],
        textarea {
            width: 100%; /* Set the width to 100% for full width, or specify a specific width */
            max-width: 400px; /* Set the maximum width if needed */
        }
    </style>
</head>

<body class="g-sidenav-show bg-white-100">
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
          <a class="nav-link active" href="layanan.php">
            <span class="nav-link-text ms-1">Layanan</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="pembelian.php">
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
          <a class="nav-link " href="logout.php">
            <span class="nav-link-text ms-1">Keluar</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>
    <main class="main-content position-relative border-radius-lg">
        <section class="py-4">
            <div class="container-fluid">
                <h3 class="mb-4">Ubah Layanan</h3>
                <form method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $pecah['nama_layanan']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="harga">Harga (Rp)</label>
                                <input type="number" class="form-control" id="harga" name="harga" value="<?php echo $pecah['harga_layanan']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="foto">Foto</label>
                                <input type="file" class="form-control" id="foto" name="foto">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <img src="../foto_layanan/<?php echo $pecah['foto_layanan'] ?>" width="200">
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="5"><?php echo $pecah['deskripsi_layanan']; ?></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-green" name="ubah">Ubah</button>
						<a href="layanan.php" class="btn btn-abu">Kembali</a>
                    </div>
                </form>

                <?php
                if (isset($_POST['ubah'])) {
                    $namafoto = $_FILES['foto']['name'];
                    $lokasifoto = $_FILES['foto']['tmp_name'];

                    if (!empty($lokasifoto)) {
                        move_uploaded_file($lokasifoto, "../foto_layanan/$namafoto");
                        $koneksi->query("UPDATE layanan SET nama_layanan='$_POST[nama]',harga_layanan='$_POST[harga]',foto_layanan='$namafoto',deskripsi_layanan='$_POST[deskripsi]' WHERE id_layanan='$_GET[id]'");
                    } else {
                        $koneksi->query("UPDATE layanan SET nama_layanan='$_POST[nama]',harga_layanan='$_POST[harga]',deskripsi_layanan='$_POST[deskripsi]' WHERE id_layanan='$_GET[id]'");
                    }
                    echo "<script>alert('Data layanan telah diubah');</script>";
                    echo "<script>location='layanan.php';</script>";
                }
                ?>
            </div>
        </section>
    </main>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
