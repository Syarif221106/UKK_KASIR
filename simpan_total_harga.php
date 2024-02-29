<?php
include "../koneksi.php";

$TotalHarga = $_POST['TotalHarga'];
$PenjualanID = $_POST['PenjualanID'];
$PelangganID = $_POST['PelangganID'];

mysqli_query($koneksi, "update penjualan set TotalHarga='$TotalHarga' where PenjualanID='$PenjualanID'");

header("location:detail_pembelian.php?PelangganID=$PelangganID");

?>