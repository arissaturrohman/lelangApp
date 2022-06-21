<button type="button" class="btn btn-sm btn-info mb-2" data-toggle="modal" data-target="#addBarang">
  Add Barang
</button>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Data Barang</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th width="3%">No</th>
            <th>Nama Barang</th>
            <th>Harga Awal</th>
            <th>Harga Akhir</th>
            <th>Tanggal</th>
            <th>Deskripsi</th>
            <th>Foto</th>
            <th>Status</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          $query = $conn->query("SELECT * FROM tb_barang");
          while ($result = $query->fetch_assoc()) {
          ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $result['nama_barang']; ?></td>
              <td>Rp. <?= number_format($result['harga_awal']); ?></td>
              <td>Rp. <?= number_format($result['harga_akhir']); ?></td>
              <td><?= $result['tanggal']; ?></td>
              <td><?= $result['deskripsi']; ?></td>
              <td><?= $result['foto']; ?> (sementara)</td>
              <td><?= $result['status']; ?></td>
              <td>
                <button type="button" class="btn btn-sm btn-success mb-2" data-toggle="modal" data-target="#lelangBarang<?= $result['id_barang']; ?>">
                  Lelang
                </button>
                <button type="button" class="btn btn-sm btn-warning mb-2" data-toggle="modal" data-target="#editBarang<?= $result['id_barang']; ?>">
                  Edit
                </button>
                <button type="button" class="btn btn-sm btn-danger mb-2" data-toggle="modal" data-target="#deleteBarang<?= $result['id_barang']; ?>">
                  Delete
                </button>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Add Barang -->
<div class="modal fade" id="addBarang" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Form Add Barang</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group">
            <label for="nama_barang">Nama Barang</label>
            <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
          </div>
          <div class="form-group">
            <label for="harga_awal">Harga Awal</label>
            <input type="number" class="form-control" id="harga_awal" name="harga_awal"  required>
          </div>
          <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
          </div>
          <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="5"></textarea>
          </div>
          <div class="form-group">
            <label for="foto">Foto</label>
            <input type="file" class="form-control-file" name="foto" id="foto" onchange="return validasiFile()">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" name="addBarang" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit Petugas -->
<?php
$query = $conn->query("SELECT * FROM tb_barang");
while ($result = $query->fetch_assoc()) {
?>
  <div class="modal fade" id="editBarang<?= $result['id_barang']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Form Edit Barang <?= $result['nama_barang']; ?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="post" enctype="multipart/form-data" >
          <div class="modal-body">
            <input type="hidden" name="id_barang" value="<?= $result['id_barang']; ?>">
            <input type="hidden" name="cek_foto" value="<?= $result['foto']; ?>">
            <div class="form-group">
            <label for="nama_barang">Nama Barang</label>
            <input type="text" class="form-control" id="nama_barang" value="<?= $result['nama_barang']; ?>" name="nama_barang" required>
          </div>
          <div class="form-group">
            <label for="harga_awal">Harga Awal</label>
            <input type="number" class="form-control" id="harga_awal" value="<?= $result['harga_awal']; ?>" name="harga_awal"  required>
          </div>
          <div class="form-group">
            <label for="tanggal">Tanggal</label>
            <input type="date" class="form-control" id="tanggal" value="<?= $result['tanggal']; ?>" name="tanggal" required>
          </div>
          <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="5"><?= $result['deskripsi']; ?></textarea>
          </div>
          <div class="form-group">
            <label for="editfoto">Foto</label>
            <input type="file" class="form-control-file mb-2" name="foto" id="editfoto">
            <!-- <img src="img/<?= $result['foto']; ?>" class="rounded" style="width:50%; height:50%;"> -->
          </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" name="editBarang" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
    
<?php } ?>

<!-- Delete Barang -->
<?php
$query = $conn->query("SELECT * FROM tb_barang");
while ($result = $query->fetch_assoc()) {;
?>
  <div class="modal fade" id="deleteBarang<?= $result['id_barang']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Yakin menghapus Barang <?= $result['nama_barang']; ?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="post">
          <div class="modal-body">
            Data yang sudah dihapus tidak bisa dikembalikan...!!!
            <input type="hidden" name="id_barang" value="<?= $result['id_barang']; ?>">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" name="deleteBarang" class="btn btn-danger float-right">Delete</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php } ?>

<!-- Lelang Barang -->
<?php
$query = $conn->query("SELECT * FROM tb_barang");
while ($result = $query->fetch_assoc()) {;
?>
  <div class="modal fade" id="lelangBarang<?= $result['id_barang']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Yakin Barang <?= $result['nama_barang']; ?> dilelang?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="post">
          <div class="modal-body">
            Data yang akan ditampilkan di dashboard masyarakat...!!!
            <input type="hidden" name="id_barang" value="<?= $result['id_barang']; ?>">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" name="lelangBarang" class="btn btn-success float-right">Lelang</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php } ?>


<script>
    var uploadField = document.getElementById("foto", "editfoto");
    uploadField.onchange = function() {
    if(this.files[0].size > 2000000){ // ini untuk ukuran 800KB, 1000000 untuk 1 MB.
       alert("Maaf. File Terlalu Besar ! Maksimal Upload 2 MB");
       this.value = "";
       return false;
    };
        var inputFile = document.getElementById('foto', 'editfoto');
        var pathFile = inputFile.value;
        var ekstensiOk = /(\.jpg|\.jpeg|\.png)$/i;
        if(!ekstensiOk.exec(pathFile)){
            alert('Silahkan upload file yang memiliki ekstensi .jpg | .jpeg | .png');
            inputFile.value = '';
            return false;
        }
    };

</script>

<!-- <script>
document.getElementById("editfoto").addEventListener("change", validateFile)
function validateFile(){
  const allowedExtensions =  ['jpg','png', 'jpeg'],
        sizeLimit = 2_000_000; 

  const { name:fileName, size:fileSize } = this.files[0];

  const fileExtension = fileName.split(".").pop();

  if(!allowedExtensions.includes(fileExtension)){
    alert("fSilahkan upload file yang memiliki ekstensi .jpg | .jpeg | .png");
    this.value = null;
  }else if(fileSize > sizeLimit){
    alert("Maaf. File Terlalu Besar ! Maksimal Upload 2 MB")
    this.value = null;
  }
}
</script> -->


