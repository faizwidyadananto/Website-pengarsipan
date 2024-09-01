<?php
  if(isset($_POST['bsimpan']))
  {

    if(@$_GET['hal'] == "edit"){
    $ubah = mysqli_query($koneksi, "UPDATE tbl_pengirim_surat SET 
                                          nama_pengirim = '$_POST[nama_pengirim]',
                                          alamat = '$_POST[alamat]',
                                          nomor_hp = '$_POST[nomor_hp]',
                                          email = '$_POST[email]'

                                          where id_pengirim_surat = '$_GET[id]'");
      if($ubah)
      {
        echo "<script>
                alert('UBAH DATA SUKSES');
                document.location='?halaman=pengirim_surat';
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
      $simpan = mysqli_query($koneksi, "INSERT INTO tbl_pengirim_surat VALUES (   '',
                                                                                  '$_POST[nama_pengirim]',
                                                                                  '$_POST[alamat]',
                                                                                  '$_POST[nomor_hp]',
                                                                                  '$_POST[email]'
                                                                                  
                                                                              )");
      if($simpan)
      {
        echo "<script>
                alert('SIMPAN DATA SUKSES');
                document.location='?halaman=pengirim_surat';
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
      $tampil = mysqli_query($koneksi, "SELECT * FROM tbl_pengirim_surat where id_pengirim_surat = '$_GET[id]'");
      $data = mysqli_fetch_array($tampil);
      if ($data)
      {
        $vnama_pengirim = $data['nama_pengirim'];
        $valamat        = $data['alamat'];
        $vnomor_hp      = $data['nomor_hp'];
        $vemail         = $data['email'];
      }
    }else{
      $hapus = mysqli_query($koneksi, "DELETE FROM tbl_pengirim_surat  WHERE id_pengirim_surat='$_GET[id]'");
      if ($hapus)
      {
        echo "<script>
                alert('HAPUS DATA SUKSES');
                document.location='?halaman=pengirim_surat';
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
    Form Data Pengirim Surat
  </div>
  <div class="card-body">
    <form method="post" action="">
    <div class="form-group">
        <label for="nama_pengirim">Nama Pengirim</label>
        <input type="text" class="form-control" id="nama_pengirim" name = "nama_pengirim"
        value="<?=@$vnama_pengirim?>">
    </div>
    <div class="form-group">
        <label for="alamat">Alamat</label>
        <input type="text" class="form-control" id="alamat" name = "alamat"
        value="<?=@$valamat?>">
    </div>
    <div class="form-group">
        <label for="nomor_hp">No. HP</label>
        <input type="text" class="form-control" id="nomor_hp" name = "nomor_hp"
        value="<?=@$vnomor_hp?>">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name = "email"
        value="<?=@$vemail?>">
    </div>
    <button type="submit" name="bsimpan" class="btn btn-primary">Simpan</button>
    <button type="reset" name="bbatal" class="btn btn-danger">Batal</button>
    </form>
  </div>
</div>

<div class="card">
  <div class="card-header bg-info text-white mt-3">
    Data Pengirim Surat
  </div>
  <div class="card-body">
    <table class="table table-bordered table-hover table-striped">
        <tr>
            <th>No</th>
            <th>Nama Pengirim Surat</th>
            <th>Alamat</th>
            <th>No HP</th>
            <th>Email</th>
            <th>Aksi</th>
        </tr>
        <?php
            $tampil = mysqli_query($koneksi, "SELECT * FROM tbl_pengirim_surat ORDER BY id_pengirim_surat DESC");
            $no = 1;
            while ($data = mysqli_fetch_array($tampil)) :
        ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $data['nama_pengirim'] ?></td>
            <td><?= $data['alamat'] ?></td>
            <td><?= $data['nomor_hp'] ?></td>
            <td><?= $data['email'] ?></td>
            <td>
          <a href="?halaman=pengirim_surat&hal=edit&id=<?=$data['id_pengirim_surat']?>" class= "btn btn-success">Edit</a>
          <a href="?halaman=pengirim_surat&hal=hapus&id=<?=$data['id_pengirim_surat']?>" class= "btn btn-danger" onclick="return confirm ('Apakah anda yakin ingin menghapus data?')">Hapus</a>  
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
  </div>
</div>
