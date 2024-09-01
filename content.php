<?php 

    @$halaman = $_GET['halaman'];
    if ($halaman == "departemen")
    {
        include "modul/departemen/departemen.php";
    }
    elseif ($halaman == "pengirim_surat"){
        include "modul/pengirim_surat/pengirim_surat.php";
    }
    elseif ($halaman == "arsip_surat"){
        if(@$_GET['hal']=="tambahdata" || @$_GET['hal']=="edit" ||@$_GET['hal']=="hapus"){
            include "modul/arsip/form.php";
        }  else {
            include "modul/arsip/data.php";
        }
    }
    elseif ($halaman == "buat_akun_baru") {
        include "modul/buat_akun_baru/buat_akun_baru.php";
    }    
    elseif ($halaman == "surat_keluar"){
        if(@$_GET['hal']=="tambahdata" || @$_GET['hal']=="edit" ||@$_GET['hal']=="hapus"){
            include "modul/persuratan/form.php";
        }  else {
            include "modul/persuratan/data.php";
        }
    }
    else {
        include "modul/home.php";
    }

?>