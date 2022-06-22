<?php
$id = $_GET['id'];

$barang = $conn->query("SELECT * FROM tb_barang where id_barang = '$id'");
$resultBarang = $barang->fetch_assoc();
$id_barang = $resultBarang['id_barang'];
$id_admin = $resultBarang['id_admin'];

$admin = $conn->query("SELECT * FROM tb_admin where id_admin = '$id_admin' ");
$resultAdmin = $admin->fetch_assoc();
$namaAdmin = $resultAdmin['role'];

$lelang = $conn->query("SELECT * FROM tb_lelang, tb_barang, tb_admin where tb_lelang.id_barang = tb_barang.id_barang");
$result = $lelang->fetch_assoc();

$lelang2 = $conn->query("SELECT * FROM tb_lelang where id_barang = '$id'");
$resultLelang = $lelang2->fetch_assoc();

$pemenang = $conn->query("SELECT * FROM tb_lelang, tb_masyarakat WHERE tb_lelang.id_masyarakat = tb_masyarakat.id_masyarakat");
$resultPemenang = $pemenang->fetch_assoc();

?>

<div class="card mb-4 py-3 border-left-secondary">
    <div class="card-body">
        <div class="row">
            <div class="col-6">
                <img src="img/<?= $result['foto']; ?>" class="card-img-top img-thumbnail" width="50%">
            </div>
            <div class="col-6">
                <h2>Infromasi Barang</h2>
                <p>Detail barang yang dilelangkan.</p>
                <table class="table" width="100%">
                    <tr>
                        <td width="35%">Nama Barang</td>
                        <td>: <?= $resultBarang['nama_barang']; ?></td>
                    </tr>
                    <tr>
                        <td width="35%">Tanggal lelang</td>
                        <td>: <?= $resultBarang['tanggal']; ?></td>
                    </tr>
                    <tr>
                        <td width="35%">Harga awal</td>
                        <td>: Rp. <?= number_format($resultBarang['harga_awal']); ?></td>
                    </tr>
                    <tr>
                        <td width="35%">Status</td>
                        <td>: <?= $resultBarang['status']; ?></td>
                    </tr>
                    <tr>
                        <td width="35%">Pemenang</td>
                        <td>: <?= $resultPemenang['nama']; ?></td>
                    </tr>
                    <tr>
                        <td width="35%">Operator</td>
                        <td>: <?= $namaAdmin; ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="card shadow mb-4">
    <div class="card-body">
        <form action="" method="post">
            <div class="row">
                <div class="col-10">
                    <input type="hidden" name="id_barang" value="<?= $id_barang; ?>">
                    <input type="number" class="form-control" name="harga_tawar" placeholder="Masukkan harga tawaran Anda" required>
                </div>
                <div class="col-2">
                    <button type="submit" class="btn btn-sm btn-success btn-block" name="tawarBarang">TAWAR</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Data Penawaran</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th width="3%">No</th>
            <th>Nama</th>
            <th>Penawaran</th>
            <?php 
            if ($_SESSION['id_admin']) {
               echo"<th width='7%'>Opsi</th>";
            }
            ?>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          $tawar = $conn->query("SELECT * FROM tb_tawar WHERE id_barang = '$id' ORDER BY (harga) DESC");
          while ($result = $tawar->fetch_assoc()) {

            
          ?>
            <tr>
              <td><?= $no++; ?></td>
              <?php 
                $id_masy = $result['id_masyarakat'];
                $masyarakat = $conn->query("SELECT * FROM tb_masyarakat WHERE id_masyarakat = '$id_masy'");
                $resultMasy = $masyarakat->fetch_assoc() ;
                    echo"<td>$resultMasy[nama]</td>";
                
                ?>
              <td>Rp. <?= number_format($result['harga']); ?></td>
              <?php 
                if ($_SESSION['id_admin']) {
                    
                ?>

               <th class="text-center">
                <form action="" method="post">
                    <input type="hidden" name="idBarang" value="<?= $result['id_barang']; ?>">
                    <input type="hidden" name="hargaPemenang" value="<?= $result['harga']; ?>">
                    <input type="hidden" name="idMasyarakat" value="<?= $resultMasy['id_masyarakat']; ?>">
                    <input type="hidden" name="idLelang" value="<?= $resultLelang['id_lelang']; ?>">
                    <button onclick="return confirm('Yakin untuk dimenangkan?');" type="submit" name="pemenang" class="btn btn-sm btn-success mb-2 <?= $tampil; ?>">
                        <i class="fas fa-check"></i>
                    </button>
                </form>
               </th>

               <?php
            } 
            ?>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>



