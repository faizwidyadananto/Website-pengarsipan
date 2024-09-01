<div class="card">
  <div class="card-header bg-info text-white mt-3">
    Data Surat Keluar
  </div>
  <div class="card-body">
    <a href="?halaman=surat_keluar&hal=tambahdata" class="btn btn-info mb-3">Tambah Data</a>

    <form method="GET" action="">
      <input type="hidden" name="halaman" value="surat_keluar">
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Cari berdasarkan prihal" name="search" value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>">
        <button class="btn btn-outline-secondary" type="submit">Cari</button>
      </div>
    </form>
    <table class="table table-bordered table-hover table-striped">
        <tr>
            <th>No</th>
            <th>No Surat</th>
            <th>Tanggal Surat</th>
            <th>Prihal</th>
            <th>Tujuan</th>
            <th>Pengirim</th>
            <th>File</th>
            <th>Editor</th>
            <th>Aksi</th>
        </tr>
        <?php
            $search = isset($_GET['search']) ? $_GET['search'] : '';
            $where = "";
            if ($search) {
                $where = "AND tbl_suratkeluar.prihal LIKE '%$search%'";
            }
            $tampil = mysqli_query($koneksi, "
                      SELECT
                        tbl_suratkeluar.*,
                        tbl_departemen.nama_departemen,
                        tbl_user.username
                      FROM
                        tbl_suratkeluar
                      JOIN
                        tbl_departemen ON tbl_suratkeluar.id_departemen = tbl_departemen.id_departemen
                      JOIN
                        tbl_user ON tbl_suratkeluar.id_user = tbl_user.id_user
                      WHERE 1=1 $where
                      ");
            $no = 1;
            while ($data = mysqli_fetch_array($tampil)) :
        ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $data['no_surat'] ?></td>
            <td><?= $data['tanggal_surat'] ?></td>
            <td><?= $data['prihal'] ?></td>
            <td><?= $data['tujuan'] ?></td>
            <td><?= $data['nama_departemen'] ?></td>
            <td>
              
                <?php
                  if(empty($data['file'])){
                    echo " - ";
          
                  } else {
                    ?>
                    <a href="file/<?=$data['file']?>" target="$_blank"> Lihat File </a>
                  <?php
                  }
                
                ?>
            </td>
            <td><?= $data['username'] ?></td>
            <td>
          <a href="?halaman=surat_keluar&hal=edit&id=<?=$data['id_surat']?>" class= "btn btn-success">Edit</a>
          <a href="?halaman=surat_keluar&hal=hapus&id=<?=$data['id_surat']?>" class= "btn btn-danger" onclick="return confirm ('Apakah anda yakin ingin menghapus data?')" >Hapus</a>
          <a href="?halaman=surat_keluar&hal=print&id=<?=$data['id_surat']?>" class= "btn btn-warning"onclick="printFile('file/<?= $data['file'] ?>')">Print</button>  
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
  </div>
</div>

<script>
  function printFile(url) {
    var printWindow = window.open(url, '_blank');
    printWindow.onload = function() {
      printWindow.print();
    };
  }
</script>
