<?php
include '../koneksi.php';

$nama_petugas = $_POST['nama_petugas'];
$username = $_POST['username'];
$password = $_POST['password'];
$level = $_POST['level'];

mysqli_query($koneksi, "insert into petugas values('','$nama_petugas','$username','$password','$level')");

header("location:data_pengguna.php?pesan=simpan");

?>