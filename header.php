<?php
session_start();

if($_SESSION['level']!="1"){
    header("location:../index.php?pesan=gagal");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>UKK KASIR</title>
    <link rel="stylesheet" href="../assets/bootstrap-5.3.2/dist/css/bootstrap.min.css" >
    <link rel="shortcut icon" href="../assets/login.png" type="image/x-icon">
</head>
<body>
    <div class="container">
        <div class="content">
