<?php
session_start();
//koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "majestic");

if (isset($_GET['id'])) {
    $id_pelanggan = $_GET['id'];
    
    // Perform the deletion based on $id_pelanggan
    $koneksi->query("DELETE FROM pelanggan WHERE id_pelanggan = '$id_pelanggan'");
    
    // Redirect back to the pelanggan.php page after deletion
    header("Location: pelanggan.php");
    exit();
}
?>
