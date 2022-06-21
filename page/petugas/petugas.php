<button type="button" class="btn btn-sm btn-info mb-2" data-toggle="modal" data-target="#addPetugas">
  Add Petugas
</button>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Data Petugas</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable1" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th width="3%">No</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Role</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          $query = $conn->query("SELECT * FROM tb_admin");
          while ($result = $query->fetch_assoc()) {
          ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $result['nama']; ?></td>
              <td><?= $result['username']; ?></td>
              <td><?= $result['role']; ?></td>
              <td>
                <button type="button" class="btn btn-sm btn-warning mb-2" data-toggle="modal" data-target="#editPetugas<?= $result['id_admin']; ?>">
                  Edit
                </button>
                <button type="button" class="btn btn-sm btn-danger mb-2" data-toggle="modal" data-target="#deletePetugas<?= $result['id_admin']; ?>">
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

<!-- Add Petugas -->
<div class="modal fade" id="addPetugas" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Form Add Petugas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label for="nama">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Lengkap">
          </div>
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password">
          </div>
          <div class="form-group">
            <label for="role">Role</label>
            <select class="form-control" name="role" id="role">
              <option>--Pilih--</option>
              <option value="Administrator">Administrator</option>
              <option value="Petugas">Petugas</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" name="addPetugas" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit Petugas -->
<?php
$query = $conn->query("SELECT * FROM tb_admin");
while ($result = $query->fetch_assoc()) {
?>
  <div class="modal fade" id="editPetugas<?= $result['id_admin']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Form Edit Petugas</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="post">
          <div class="modal-body">
            <input type="hidden" name="id_admin" value="<?= $result['id_admin']; ?>">
            <div class="form-group">
              <label for="nama">Nama Lengkap</label>
              <input type="text" class="form-control" id="nama" name="nama" value="<?= $result['nama']; ?>" placeholder="Masukkan Nama Lengkap">
            </div>
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" class="form-control" id="username" name="username" value="<?= $result['username']; ?>" placeholder="Masukkan Username">
            </div>
            <div class="form-group">
              <label for="role">Role</label>
              <select class="form-control" name="role" id="role">
                <?php
                if ($result['role'] == "Administrator") {
                  echo "<option value='Administrator' selected>Administrator</option>";
                  echo "<option value='Petugas' >Petugas</option>";
                } else {
                  echo "<option value='Administrator' >Administrator</option>";
                  echo "<option value='Petugas' selected>Petugas</option>";
                }
                ?>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" name="editPetugas" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php } ?>

<!-- Delete Petugas -->
<?php
$query = $conn->query("SELECT * FROM tb_admin");
while ($result = $query->fetch_assoc()) {;
?>
  <div class="modal fade" id="deletePetugas<?= $result['id_admin']; ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Yakin menghapus Petugas <?= $result['nama']; ?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="post">
          <div class="modal-body">
            Data yang sudah dihapus tidak bisa dikembalikan...!!!
            <input type="hidden" name="id_admin" value="<?= $result['id_admin']; ?>">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" name="deletePetugas" class="btn btn-danger float-right">Delete</button>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php } ?>