<div class="card">
  <div class="card-header bg-info text-white mt-3">
    Data Surat Masuk
  </div>
  <div class="card-body">
    <a href="?halaman=arsip_surat&hal=tambahdata" class="btn btn-info mb-3">Tambah Data</a>
    <!-- Form untuk pencarian -->
    <form method="GET" action="">
      <input type="hidden" name="halaman" value="arsip_surat">
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
            <th>Tanggal Diterima</th>
            <th>Prihal</th>
            <th>Bidang</th>
            <th>Pengirim</th>
            <th>File</th>
            <th>Editor</th>
            <th>Aksi</th>
            
        </tr>
        <?php
        // Memproses kata kunci pencarian
            $search = isset($_GET['search']) ? $_GET['search'] : '';
            $where = "";
            if ($search) {
                $where = "AND tbl_arsip.prihal LIKE '%$search%'";
            }
            $tampil = mysqli_query($koneksi, "
                      SELECT
                        tbl_arsip.*,
                        tbl_departemen.nama_departemen,
                        tbl_pengirim_surat.nama_pengirim,
                        tbl_pengirim_surat.nomor_hp,
                        tbl_user.username
                      FROM
                        tbl_arsip
                        LEFT JOIN tbl_departemen ON tbl_arsip.id_departemen = tbl_departemen.id_departemen
                        LEFT JOIN tbl_pengirim_surat ON tbl_arsip.id_pengirim = tbl_pengirim_surat.id_pengirim_surat
                        LEFT JOIN tbl_user ON tbl_arsip.id_user = tbl_user.id_user
                         WHERE 1=1 $where
                      ");
            $no = 1;
            while ($data = mysqli_fetch_array($tampil)) :
        ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $data['no_surat'] ?></td>
            <td><?= $data['tanggal_surat'] ?></td>
            <td><?= $data['tanggal_diterima'] ?></td>
            <td><?= $data['prihal'] ?></td>
            <td><?= $data['nama_departemen'] ?></td>
            <td><?= $data['nama_pengirim'] ?> / <?= $data['nomor_hp'] ?></td>
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
          <a href="?halaman=arsip_surat&hal=edit&id=<?=$data['id_arsip']?>" class= "btn btn-success">Edit</a>
          <a href="?halaman=arsip_surat&hal=hapus&id=<?=$data['id_arsip']?>" class= "btn btn-danger" onclick="return confirm ('Apakah anda yakin ingin menghapus data?')" >Hapus</a>
          <a href="?halaman=arsip_surat&hal=print&id=<?=$data['id_arsip']?>" class= "btn btn-warning"onclick="printFile('file/<?= $data['file'] ?>')">Print</button>  
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
