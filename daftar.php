<?php $koneksi= new mysqli("localhost","root","","majestic");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Majestic Pet Care - Daftar</title>
    <link rel="icon" href="fonts/favicon_io/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link
      href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600,700,800&display=swap"
      rel="stylesheet"
    />

    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <style>
         .btn-primary {
            background-color: #00bd56;
            border-color: #28a745;
        }

        /* Ganti warna teks tombol Masuk */
        .btn-primary:hover {
            color: #00bd56;
            background-color: transparent;
            border: 1px solid #28a745;
        }
        .btn-secondary:hover {
            color: #808080;
            background-color: transparent;
            border: 1px solid #808080;
        }
        .header-text h2 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 30px;
            font-family: 'Roboto', sans-serif; /* Menggunakan font Roboto dari Google Fonts */
            color:  #000000;
        }
        body {
            background-color: #f8f9fa;
        }

        .container {
            max-width: 650px;
            margin: 5% auto;
    margin-bottom: 200px;
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
            color: white;
        }

        .card-header img {
            max-width: 80px;
            border-radius: 50%;
            margin-bottom: 15px;
        }

        .card-body {
            padding: 30px;
        }
        </style>
</head>
<body>    
    <div class="container">
    <div class="header-text">
            <h2>Majestic Pet Care</h2>
        </div>
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
				<div class="card-header">
                <img src="images/logo.png" alt="Majestic PetCare Logo">
                        <h3 class="text-center">Daftar</h3>
                    </div>
                    <div class="card-body">
                        <form method="post" class="form-horizontal">
                            <div class="mb-3 row">
                                <label for="nama" class="col-md-3 col-form-label">Nama</label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="email" class="col-md-3 col-form-label">Email</label>
                                <div class="col-md-7">
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="password" class="col-md-3 col-form-label">Password</label>
                                <div class="col-md-7">
                                <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="telepon" class="col-md-3 col-form-label">Telp/Hp</label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" id="telepon" name="telepon" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-md-7 offset-md-3">
                                    <button class="btn btn-primary" name="daftar">Daftar</button>
									<a href="index.php" class="btn btn-secondary">Kembali</a>
                                </div>
                            </div>
                        </form>
                        <?php
                        if(isset($_POST["daftar"]))
						{

							$nama = $_POST["nama"];
							$email = $_POST["email"];
							$password = $_POST["password"];
							$telepon = $_POST["telepon"];

							$ambil = $koneksi->query("SELECT * FROM pelanggan 
								WHERE email_pelanggan='$email'");
							$yangcocok = $ambil->num_rows;
							if ($yangcocok==1)
							{
								echo "<script>alert('Pendaftaran gagal, email sudah digunakan');</script>";
								echo "<script>location = 'daftar.php';</script>"; 
				
							}
							else
							{
								$koneksi->query("INSERT INTO pelanggan(email_pelanggan,password_pelanggan,nama_pelanggan,telepon_pelanggan) VALUES ('$email','$password','$nama','$telepon') ");
									echo "<script>alert('Pendaftaran sukses, silahkan masuk');</script>";
									echo "<script>location = 'index.php';</script>"; 

							}
						}
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center mt-5">
    <p>Copyright &copy; 2023 Majestic Pet Care. All rights reserved.</p>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
