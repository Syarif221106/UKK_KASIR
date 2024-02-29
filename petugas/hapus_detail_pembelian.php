<?php
include "../koneksi.php";

$DetailID = $_POST['DetailID'];
$PelangganID = $_POST['PelangganID'];

mysqli_query($koneksi, "DELETE FROM detailpenjualan WHERE DetailID='$DetailID'");

header("location:detail_pembelian.php?PelangganID=$PelangganID");

?>