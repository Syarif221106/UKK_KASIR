<?php
include "../koneksi.php";

$PelangganID = $_POST['PelangganID'];
$PenjualanID = $_POST['PenjualanID'];

mysqli_query($koneksi, "INSERT INTO detailpenjualan(PenjualanID, ProdukID, JumlahProduk, Subtotal) VALUES ('$PenjualanID',NULL,0,0)");

header("location:detail_pembelian.php?PelangganID=$PelangganID");
exit();

?>