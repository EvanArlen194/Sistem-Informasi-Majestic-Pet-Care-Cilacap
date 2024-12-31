<?php
session_start();
$koneksi = new mysqli("localhost", "root", "", "majestic");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Majestic Pet Care - Masuk / Login</title>
    <link rel="icon" href="fonts/favicon_io/favicon.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            max-width: 400px;
            margin: 5% auto;
            margin-bottom: 200px;
        }

        .header-text h2 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 30px;
            font-family: 'Roboto', sans-serif; /* Menggunakan font Roboto dari Google Fonts */
            color: #000000;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #00bd56;
            border-radius: 10px 10px 0 0;
            padding: 15px;
            text-align: center;
        }

        .card-header img {
            max-width: 80px;
            border-radius: 50%;
            margin-bottom: 15px;
        }

        .card-body {
            padding: 30px;
        }

        .btn-primary {
            background-color: #00bd56;
            border-color: #00bd56;
        }

        .btn-primary:hover {
            color: #00bd56;
            background-color: transparent;
            border: 1px solid #00bd56;
        }

        .mt-3.text-center a {
            color: #00bd56 !important;
            text-decoration: none !important;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header-text">
            <h2>Majestic Pet Care</h2>
        </div>
        <div class="card">
            <div class="card-header">
                <img src="images/logo.png" alt="Majestic PetCare Logo">
                <h4 class="text-white">Masuk</h4>
            </div>
            <div class="card-body">
                <form method="post">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary" name="login">Masuk</button>
                </form>
                <div class="mt-3 text-center">
                    Belum Punya Akun? <a href="daftar.php">Daftar</a>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center mt-5">
    <p>Copyright &copy; 2023 Majestic Pet Care. All rights reserved.</p>
</div>

    <?php
  if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Query untuk mencari data di tabel admin
    $query_admin = "SELECT * FROM admin WHERE email='$email' AND password='$password'";
    $result_admin = $koneksi->query($query_admin);
    $akun_admin = $result_admin->fetch_assoc();

    // Query untuk mencari data di tabel pemilik
    $query_pemilik = "SELECT * FROM pemilik WHERE email_pemilik='$email' AND password_pemilik='$password'";
    $result_pemilik = $koneksi->query($query_pemilik);
    $akun_pemilik = $result_pemilik->fetch_assoc();

    // Query untuk mencari data di tabel pelanggan
    $query_pelanggan = "SELECT * FROM pelanggan WHERE email_pelanggan='$email' AND password_pelanggan='$password'";
    $result_pelanggan = $koneksi->query($query_pelanggan);
    $akun_pelanggan = $result_pelanggan->fetch_assoc();

    if ($akun_admin) {
        // Jika akun ditemukan di tabel admin
        $_SESSION["admin"] = $akun_admin;
        echo "<script>alert('Anda sukses masuk sebagai admin');</script>";
        echo "<script>location = 'admin/home.php';</script>";
    } elseif ($akun_pemilik) {
        // Jika akun ditemukan di tabel pemilik
        $_SESSION["pemilik"] = $akun_pemilik;
        echo "<script>alert('Anda sukses masuk sebagai pemilik');</script>";
        echo "<script>location = 'pemilik/home.php';</script>";
    } elseif ($akun_pelanggan) {
        // Jika akun ditemukan di tabel pemilik
        $_SESSION["pelanggan"] = $akun_pelanggan;
        echo "<script>alert('Anda sukses masuk sebagai pelanggan');</script>";
        echo "<script>location = 'homep.php';</script>";
    }
     else {
        // Jika tidak ditemukan di ketiga tabel
        echo "<script>alert('Anda gagal login, periksa akun Anda');</script>";
        echo "<script>location = 'index.php';</script>";
    }
}

    ?>
</body>
</html>
