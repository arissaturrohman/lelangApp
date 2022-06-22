<h1>Barang Terbaru</h1>

<div class="row">
    <?php
    $barang = $conn->query("SELECT * FROM tb_barang WHERE status = 'Dibuka'");
    while ($result = $barang->fetch_assoc()) {
    ?>
        <div class="col-md-3 mb-2">
            <div class="card">
                <img src="img/<?= $result['foto']; ?>" class="card-img-top img-thumbnail">
                <div class="card-body">
                    <h3 class="card-title"><?= $result['nama_barang']; ?></h3>
                    <p><?= $result['deskripsi']; ?></p>
                    <h1><?= number_format($result['harga_awal']); ?></h1>
                </div>
                <?php 
                if ($_SESSION['role'] =="Administrator") {
                    echo"
                        <a href='?page=penawaran&id=$result[id_barang]' class='btn btn-lg btn-block btn-success'>LIHAT DATA</a>
                    ";
                }
                    elseif ($_SESSION['role'] =="Petugas") {
                        echo"
                            <a href='?page=penawaran&id=$result[id_barang]' class='btn btn-lg btn-block btn-success'>LIHAT DATA</a>
                        ";
                    }
                 else {
                    echo"
                        <a href='?page=penawaran&id=$result[id_barang]' class='btn btn-lg btn-block btn-success'>TAWAR SEKARANG</a>
                    ";
                }
                ?>
                <!-- <a href="?page=penawaran&id=<?= $result['id_barang']; ?>" class="btn btn-lg btn-block btn-success">TAWAR SEKARANG</a> -->
            </div>
        </div>
    <?php } ?>
</div>