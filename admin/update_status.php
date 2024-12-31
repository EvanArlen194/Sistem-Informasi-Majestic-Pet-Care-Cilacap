<?php
session_start();
$koneksi = new mysqli("localhost", "root", "", "majestic");

// Check if the ID is provided
if (isset($_GET['id'])) {
  $id_pembelian = $_GET['id'];

  // Get the current status
  $get_status = $koneksi->query("SELECT status_pembayaran FROM pembelian WHERE id_pembelian=$id_pembelian");
  $current_status = $get_status->fetch_assoc()['status_pembayaran'];

  // Toggle the status
  $new_status = ($current_status == 'Lunas') ? 'Belum Lunas' : 'Lunas';

  // Update the status
  $update_status = $koneksi->query("UPDATE pembelian SET status_pembayaran='$new_status' WHERE id_pembelian=$id_pembelian");

  if ($update_status) {
    // Redirect back to the previous page or to the data page
    header("Location: pembelian.php");
    exit();
  } else {
    echo "Error updating status: " . $koneksi->error;
  }
} else {
  echo "Invalid ID";
}
?>
