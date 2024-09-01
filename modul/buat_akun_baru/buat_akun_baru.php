<?php
include 'config/koneksi.php';

// Cek apakah pengguna sudah login dan merupakan admin
if (!isset($_SESSION['id_user']) || $_SESSION['role'] !== 'admin') {
    echo "<script>
            alert('Hanya admin yang dapat mengakses halaman ini.');
            document.location = 'admin.php';
          </script>";
    exit();
}
?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Buat Akun Baru</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Buat Akun Baru</h2>
        <form action="proses_buat_akun.php" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            
            <button type="submit" name="bsimpan" class="btn btn-primary">Buat Akun</button>
        </form>
    </div>

