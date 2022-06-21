
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Data Masyarakat</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th width="3%">No</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Alamat</th>
            <th>No Telp</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          $query = $conn->query("SELECT * FROM tb_masyarakat");
          while ($result = $query->fetch_assoc()) {
          ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $result['nama']; ?></td>
              <td><?= $result['username']; ?></td>
              <td><?= $result['alamat']; ?></td>
              <td><?= $result['no_telp']; ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
