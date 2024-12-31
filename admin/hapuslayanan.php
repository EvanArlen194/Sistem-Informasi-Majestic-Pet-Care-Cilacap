<?php
session_start();
$koneksi= new mysqli("localhost","root","","majestic");
$ambil = $koneksi->query("SELECT * FROM layanan WHERE id_layanan='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
$fotolayanan = $pecah['foto_layanan'];
	if (file_exists("../foto_layanan/$fotolayanan"))
	{
		unlink("../foto_layanan/$fotolayanan");
	}

	$koneksi->query("DELETE FROM layanan WHERE id_layanan='$_GET[id]'");
	echo "<script>alert('Layanan terhapus');</script>";
	echo "<script>location='layanan.php';</script>";
