<?php
//panggil function.php untuk upload file
include "config/function.php";

$id_user = $_SESSION['id_user']; // Ambil id_user dari session

if (isset($_GET['hal'])) {
    if ($_GET['hal'] == "edit") {
        $tampil = mysqli_query($koneksi, "SELECT
                                            tbl_arsip.*,
                                            tbl_departemen.nama_departemen,
                                            tbl_pengirim_surat.nama_pengirim,
                                            tbl_pengirim_surat.nomor_hp
                                          FROM
                                            tbl_arsip,tbl_departemen,tbl_pengirim_surat
                                          WHERE
                                            tbl_arsip.id_departemen = tbl_departemen.id_departemen
                                            and tbl_arsip.id_pengirim = tbl_pengirim_surat.id_pengirim_surat 
                                            and tbl_arsip.id_arsip = '$_GET[id]'");
        $data = mysqli_fetch_array($tampil);
        if ($data) {
            $vno_surat = $data['no_surat'];
            $vtanggal_surat = $data['tanggal_surat'];
            $vtanggal_diterima = $data['tanggal_diterima'];
            $vprihal = $data['prihal'];
            $vid_departemen = $data['id_departemen'];
            $vnama_departemen = $data['nama_departemen'];
            $vid_pengirim = $data['id_pengirim'];
            $vnama_pengirim = $data['nama_pengirim'];
            $vfile = $data['file'];
        }
    } elseif ($_GET['hal'] == 'hapus') {
        $hapus = mysqli_query($koneksi, "DELETE FROM tbl_arsip WHERE id_arsip ='$_GET[id]'");
        if ($hapus) {
            echo "<script>
                    alert('HAPUS DATA SUKSES');
                    document.location='?halaman=arsip_surat';
                  </script>";
        } else {
            echo "<script>
                    alert('HAPUS DATA GAGAL');
                    document.location='?halaman=arsip_surat';
                  </script>";
        }
    }
}

if (isset($_POST['bsimpan'])) {
    if ($_GET['hal'] == "edit") {
        // Cek apakah user pilih file atau gambar atau tidak
        if ($_FILES['file']['error'] === 4) {
            $file = $vfile;
        } else {
            $file = upload();
        }
        $ubah = mysqli_query($koneksi, "UPDATE tbl_arsip SET 
                                          no_surat = '$_POST[no_surat]',
                                          tanggal_surat = '$_POST[tanggal_surat]',
                                          tanggal_diterima = '$_POST[tanggal_diterima]',
                                          prihal = '$_POST[prihal]',
                                          id_departemen = '$_POST[id_departemen]',
                                          id_pengirim = '$_POST[id_pengirim]', 
                                          file = '$file',
                                          id_user = '$id_user'
                                          WHERE id_arsip = '$_GET[id]'");
        if ($ubah) {
            echo "<script>
                    alert('UBAH DATA SUKSES');
                    document.location='?halaman=arsip_surat';
                  </script>";
        } else {
            echo "<script>
                    alert('UBAH DATA GAGAL');
                  </script>";
        }
    } else {
        $file = upload();   
        $simpan = mysqli_query($koneksi, "INSERT INTO tbl_arsip 
                                          (no_surat, tanggal_surat, tanggal_diterima, prihal, id_departemen, id_pengirim, file, id_user)
                                          VALUES ('$_POST[no_surat]',
                                                  '$_POST[tanggal_surat]',
                                                  '$_POST[tanggal_diterima]',
                                                  '$_POST[prihal]',
                                                  '$_POST[id_departemen]',
                                                  '$_POST[id_pengirim]',
                                                  '$file',
                                                  '$id_user')");
        if ($simpan) {
            echo "<script>
                    alert('SIMPAN DATA SUKSES');
                    document.location='?halaman=arsip_surat';
                  </script>";
        } else {
            echo "<script>
                    alert('SIMPAN DATA GAGAL');
                  </script>";
        }
    }
}
?>


<div class="card">
  <div class="card-header bg-info text-white mt-3">
    Form Data Surat Masuk
  </div>
  <div class="card-body">
    <form method="post" action="" enctype="multipart/form-data">
    <div class="form-group">
        <label for="no_surat">No Surat</label>
        <input type="text" class="form-control" id="no_surat" name = "no_surat"
        value="<?=@$vno_surat?>">
    </div>
    <div class="form-group">
        <label for="tanggal_surat">Tanggal Surat</label>
        <input type="date" class="form-control" id="tanggal_surat" name = "tanggal_surat"
        value="<?=@$vtanggal_surat?>">
    </div>
    <div class="form-group">
        <label for="tanggal_diterima">Tanggal Diterima</label>
        <input type="date" class="form-control" id="tanggal_diterima" name = "tanggal_diterima"
        value="<?=@$vtanggal_diterima?>">
    </div>
    <div class="form-group">
        <label for="prihal">Prihal</label>
        <input type="prihal" class="form-control" id="prihal" name = "prihal"
        value="<?=@$vprihal?>">
    </div>
    <div class="form-group">
        <label for="id_departemen">Bidang / Tujuan Surat</label>
        <select class="form-control" name = "id_departemen">
          <option value="<?=@$vid_departemen?>"><?=@$vnama_departemen?></option>
          <?php
            $tampil = mysqli_query($koneksi, "SELECT * FROM tbl_departemen order by nama_departemen asc");
            while ($data = mysqli_fetch_array($tampil)){
              echo "<option value = '$data[id_departemen]'> $data[nama_departemen]</option>" ;
            }

          
          ?>
        </select>
    </div>
    <div class="form-group">
        <label for="id_pengirim">Pengirim Surat</label>
        <select class="form-control" name = "id_pengirim">
          <option value="<?=@$vid_pengirim?>"><?=@$vnama_pengirim?></option>
          <?php
            $tampil = mysqli_query($koneksi, "SELECT * FROM tbl_pengirim_surat order by nama_pengirim asc");
            while ($data = mysqli_fetch_array($tampil)){
              echo "<option value = '$data[id_pengirim_surat]'> $data[nama_pengirim]</option>" ;
            }

          
          ?>
        </select>
    </div>
    <div class="form-group">
        <label for="file">Pilih File</label>
        <input type="file" class="form-control" id="file" name = "file"
        value="<?=@$vfile?>">
    </div>
    <button type="submit" name="bsimpan" class="btn btn-primary">Simpan</button>
    <button type="reset" name="bbatal" class="btn btn-danger"onclick="document.location='?halaman=arsip_surat';">Batal</button>
    </form>
  </div>
</div>