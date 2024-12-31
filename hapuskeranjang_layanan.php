<?php
session_start();
$id_layanan=$_GET["id"];
unset($_SESSION["keranjang_layanan"][$id_layanan]);

echo "<script>alert('Layanan telah dihapus dari keranjang');</script>";
echo "<script>location = 'keranjang_layanan.php';</script>"; 
?>