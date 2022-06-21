<?php
$id = $_GET['id'];

$barang = $conn->query("SELECT * FROM tb_lelang where id_barang = '$id'");
$resultBarang = $barang->fetch_assoc();
$id_barang = $resultBarang['id_barang'];
$id_admin = $resultBarang['id_admin'];

$admin = $conn->query("SELECT * FROM tb_admin where id_admin = '$id_admin' ");
$resultAdmin = $admin->fetch_assoc();
$namaAdmin = $resultAdmin['role'];

$lelang = $conn->query("SELECT * FROM tb_lelang, tb_barang, tb_admin where tb_lelang.id_barang = tb_barang.id_barang");
$result = $lelang->fetch_assoc();

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
                        <td>: <?= $result['nama_barang']; ?></td>
                    </tr>
                    <tr>
                        <td width="35%">Tanggal lelang</td>
                        <td>: <?= $result['tanggal']; ?></td>
                    </tr>
                    <tr>
                        <td width="35%">Harga awal</td>
                        <td>: Rp. <?= number_format($result['harga_awal']); ?></td>
                    </tr>
                    <tr>
                        <td width="35%">Status</td>
                        <td>: <?= $result['status']; ?></td>
                    </tr>
                    <tr>
                        <td width="35%">Pemenang</td>
                        <td>: <?= $result['pemenang']; ?></td>
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
