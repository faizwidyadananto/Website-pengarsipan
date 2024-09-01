<?php
  //panggil function.php untuk upload file
  include "config/function.php";

  if (isset($_GET['hal']))
  {
    if($_GET['hal'] == "edit")
    {
      $tampil = mysqli_query($koneksi, "SELECT
                                          tbl_suratkeluar.*,
                                          tbl_departemen.nama_departemen
                                        FROM
                                          tbl_suratkeluar,tbl_departemen
                                        WHERE
                                          tbl_suratkeluar.id_departemen = tbl_departemen.id_departemen
                                          and tbl_suratkeluar.id_surat = '$_GET[id]'");
      $data = mysqli_fetch_array($tampil);
      if ($data)
      {
        $vno_surat              = $data['no_surat'];
        $vtanggal_surat         = $data['tanggal_surat'];
        $vprihal                = $data['prihal'];
        $vtujuan                = $data['tujuan'];
        $vid_departemen         = $data['id_departemen'];
        $vnama_departemen       = $data['nama_departemen'];
        $vfile                  = $data['file'];
      }
    }    
    elseif($_GET['hal'] == 'hapus') {

      $hapus = mysqli_query($koneksi, "DELETE FROM tbl_suratkeluar WHERE id_surat ='$_GET[id]'");
      if ($hapus) {
          echo "<script>
                  alert('HAPUS DATA SUKSES');
                  document.location='?halaman=surat_keluar';
                </script>";
      
      }else {
        echo "<script>
                alert('HAPUS DATA GAGAL');
                document.location='?halaman=surat_keluar';
              </script>";
    }
  

  
  }
}



  if(isset($_POST['bsimpan']))
  {

    if(@$_GET['hal'] == "edit"){

    //cek apakah user pilih file atau gambar atau tidak
    if($_FILES['file']['error'] === 4){
      $file = $vfile;
    }else{
      $file = upload();
    }
    $ubah = mysqli_query($koneksi, "UPDATE tbl_suratkeluar SET 
                                          no_surat         = '$_POST[no_surat]',
                                          tanggal_surat    = '$_POST[tanggal_surat]',
                                          prihal           = '$_POST[prihal]',
                                          tujuan           = '$_POST[tujuan]',
                                          id_departemen    = '$_POST[id_departemen]',
                                          file             = '$file'

                                          where id_surat = '$_GET[id]'");
      if($ubah)
      {
        echo "<script>
                alert('UBAH DATA SUKSES');
                document.location='?halaman=surat_keluar';
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
      $file   = upload();   
      $simpan = mysqli_query($koneksi, "INSERT INTO tbl_suratkeluar
                                        VALUES (  '',
                                                  '$_POST[no_surat]',
                                                  '$_POST[tanggal_surat]',
                                                  '$_POST[prihal]',
                                                  '$_POST[tujuan]',
                                                  '$_POST[id_departemen]',
                                                  '$file'
                                                                                  
                                                )");
      if($simpan)
      {
        echo "<script>
                alert('SIMPAN DATA SUKSES');
                document.location='?halaman=surat_keluar';
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


?>

<div class="card">
  <div class="card-header bg-info text-white mt-3">
    Form Surat Keluar 
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
        <label for="prihal">Prihal</label>
        <input type="prihal" class="form-control" id="prihal" name = "prihal"
        value="<?=@$vprihal?>">
    </div>
    <div class="form-group">
        <label for="tujuan">Tujuan Surat</label>
        <input type="tujuan" class="form-control" id="tujuan" name = "tujuan"
        value="<?=@$vtujuan?>">
    </div>
    <div class="form-group">
        <label for="id_departemen">Pengirim</label>
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
        <label for="file">Pilih File</label>
        <input type="file" class="form-control" id="file" name = "file"
        value="<?=@$vfile?>">
    </div>
    <button type="submit" name="bsimpan" class="btn btn-primary">Simpan</button>
    <button type="reset" name="bbatal" class="btn btn-danger"onclick="document.location='?halaman=surat_keluar';">Batal</button>
    </form>
  </div>
</div>