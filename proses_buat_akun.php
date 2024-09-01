<?php
session_start();
include 'config/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = md5(mysqli_real_escape_string($koneksi, $_POST['password']));

    // Check if the username already exists
    $check_user = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE username = '$username'");
    if (mysqli_num_rows($check_user) > 0) {
        echo "<script>
                alert('Username sudah digunakan, silahkan pilih username lain.');
                document.location = 'admin.php?halaman=buat_akun_baru';
              </script>";
    } else {
        // Insert the new user into the database
        $simpan = mysqli_query($koneksi, "INSERT INTO tbl_user (username, password) VALUES ('$username', '$password')");

        if ($simpan) {
            echo "<script>
                    alert('Akun berhasil dibuat, anda bisa login pada menu login.');
                    document.location = 'index.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Terjadi kesalahan, silahkan coba lagi.');
                    document.location = '?halaman=buat_akun_baru';
                  </script>";
        }
    }
}
?>
