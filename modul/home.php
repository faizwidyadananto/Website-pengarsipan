<?php

// Dapatkan nama pengguna dari sesi
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Selamat Datang</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="jumbotron mt-3">
  <h1 class="display-4">Selamat Datang <?php echo htmlspecialchars($username); ?></h1>
  <p class="lead">Aplikasi E-Arsip ini masih dalam tahap pengembangan oleh Magang-Undip Tekkom 22</p>
  <hr class="my-4">
  <p>Anda dapat menggunakan menu-menu yang ada di atas</p>
  <a class="btn btn-primary btn-lg" href="logout.php" role="button">Logout</a>
</div>
</body>
</html>