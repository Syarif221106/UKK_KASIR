<?php
include "../koneksi.php";

$PelangganID = $_POST['PelangganID'];

mysqli_query($koneksi, "DELETE FROM penjualan WHERE PelangganID=$PelangganID");
mysqli_query($koneksi, "DELETE FROM pelanggan WHERE PelangganID=$PelangganID");

header("location:pembelian.php?pesan=hapus");

?>