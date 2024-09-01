<?php

session_start();
//untuk block link tanpa login
if (empty($_SESSION['id_user']) or empty($_SESSION['username'])) 
{
    echo "<script>
            alert ('Maaf, untuk mengakses halaman ini, silahkan login terlebih dahulu!!');
            document.location= 'index.php'; 
            </script>";

}


?>




<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Arsip Bid TIK | POLDA JATENG</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-nav .nav-link {
        font-size: 1 rem; /* Ganti ukuran font sesuai keinginan */
      }


    </style>
  </head>

  <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <!-- Logo dan nama -->
        <a class="navbar-brand" href="#">
            <img src="assets/logo.png" alt="Logo" width="90" class="d-inline-block align-text-top">
        </a>
        <div>
            <a class="navbar-brand" href="#">Arsip TIK POLDA</a>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="?halaman=home">Beranda</a>
                </li>
                </li>
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <li class="nav-item">
                    <a class="nav-link active" href="?halaman=buat_akun_baru">Buat Akun Baru</a>
                </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link active" href="?halaman=departemen">Data Bidang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="?halaman=pengirim_surat">Data Pengirim Surat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="?halaman=arsip_surat">Surat Masuk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="?halaman=surat_keluar">Surat Keluar</a>
                
            </ul>
            <a class="navbar-brand ms-auto" href="#">
                <img src="assets/logopolda.png" alt="Logo" width="110" class="d-inline-block align-text-top">
            </a>
        </div>
    </div>
</nav>

  <div class="container">

   