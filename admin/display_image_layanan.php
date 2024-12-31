<?php
$koneksi = new mysqli("localhost", "root", "", "majestic");

// Ambil data bukti pembayaran
$ambil_bukti = $koneksi->query("SELECT bukti_pembayaran FROM pembelian_layanan_layanan WHERE id_pembelian='$_GET[id]'");
$data_bukti = $ambil_bukti->fetch_assoc();
$bukti_pembayaran = $data_bukti['bukti_pembayaran'];

// Set header
header('Content-Type: image/jpeg');

// Output the image
echo $bukti_pembayaran;
?>
