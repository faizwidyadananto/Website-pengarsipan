<?php
  if(isset($_POST['bsimpan']))
  {

    if($_GET['hal'] == "edit"){
      $nama_departemen = mysqli_real_escape_string($koneksi, $_POST['nama_departemen']);
      $ubah = mysqli_query($koneksi, "UPDATE tbl_departemen SET nama_departemen = '$_POST[nama_departemen]' where id_departemen = '$_GET[id]' ");
      if($ubah)
      {
        echo "<script>
                alert('UBAH DATA SUKSES');
                document.location='?halaman=departemen';
              </script>";
      }
      else
      {
        echo "<script>
                alert('UBAH DATA GAGAL');
              </script>";
      }
      
    }
    else
    {    
      $nama_departemen = mysqli_real_escape_string($koneksi, $_POST['nama_departemen']);
      $simpan = mysqli_query($koneksi, "INSERT INTO tbl_departemen (nama_departemen) VALUES ('$nama_departemen')");
      if($simpan)
      {
        echo "<script>
                alert('SIMPAN DATA SUKSES');
                document.location='?halaman=departemen';
              </script>";
      }
      else
      {
        echo "<script>
                alert('SIMPAN DATA GAGAL');
              </script>";
      }

    }


  }
  if (isset($_GET['hal']))
  {
    if($_GET['hal'] == "edit")
    {
      $tampil = mysqli_query($koneksi, "SELECT * FROM tbl_departemen where id_departemen = '$_GET[id]'");
      $data = mysqli_fetch_array($tampil);
      if ($data)
      {
        $vnama_departemen = $data['nama_departemen'];
      }
    }else{
      $hapus = mysqli_query($koneksi, "DELETE FROM tbl_departemen WHERE id_departemen='$_GET[id]'");
      if ($hapus)
      {
        echo "<script>
                alert('HAPUS DATA SUKSES');
                document.location='?halaman=departemen';
              </script>";
      }
      else
      {
        echo "<script>
                alert('HAPUS DATA GAGAL');
              </script>";
      }

      
    }

    
  
  }

?>

<div class="card">
  <div class="card-header bg-info text-white mt-3">
    Form Data Bidang
  </div>
  <div class="card-body">
    <form method="post" action="">
    <div class="form-group">
        <label for="nama_departemen">Nama Bidang </label>
        <input type="text" class="form-control" id="nama_departemen" name = "nama_departemen"
        value="<?=@$vnama_departemen?>">
    </div>
    <button type="submit" name="bsimpan" class="btn btn-primary">Simpan</button>
    <button type="reset" name="bbatal" class="btn btn-danger">Batal</button>
    </form>
  </div>
</div>

<div class="card">
  <div class="card-header bg-info text-white mt-3">
    Data Bidang Terdaftar
  </div>
  <div class="card-body">
    <table class="table table-bordered table-hover table-striped">
        <tr>
            <th>No</th>
            <th>Nama Bidang</th>
            <th>Aksi</th>
        </tr>
        <?php
            $tampil = mysqli_query($koneksi, "SELECT * FROM tbl_departemen ORDER BY id_departemen DESC");
            $no = 1;
            while ($data = mysqli_fetch_array($tampil)) :
        ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $data['nama_departemen'] ?></td>
            <td>
          <a href="?halaman=departemen&hal=edit&id=<?=$data['id_departemen']?>" class= "btn btn-success">Edit</a>
          <a href="?halaman=departemen&hal=hapus&id=<?=$data['id_departemen']?>" class= "btn btn-danger" onclick="return confirm ('Apakah anda yakin ingin menghapus data?')">Hapus</a>  
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
  </div>
</div>
