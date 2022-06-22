<?php

error_reporting(0);
include("config.php");

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

// Add Petugas
if (isset($_POST['addPetugas'])) {
  $nama = mysqli_real_escape_string($conn, $_POST['nama']);
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $role = mysqli_real_escape_string($conn, $_POST['role']);
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $addPetugas = $conn->query("INSERT INTO tb_admin (username, password, nama, role) VALUES ('$username', '$password', '$nama', '$role')");

  if (!$addPetugas) {
    echo ("Error description : <span style='color:red;'>" . $conn->error . "</span> Cek lagi bro");
    $conn->close();
  } else {
    $_SESSION['status'] = "Yeeaayyy..!!";
    $_SESSION['desc'] = "Data berhasil ditambah";
    $_SESSION['link'] = "petugas";
  }
}

//Edit Petugas
if (isset($_POST['editPetugas'])) {
  $nama = mysqli_real_escape_string($conn, $_POST['nama']);
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $role = mysqli_real_escape_string($conn, $_POST['role']);
  $id_admin = mysqli_real_escape_string($conn, $_POST['id_admin']);

  $editPetugas = $conn->query("UPDATE tb_admin SET username = '$username', nama = '$nama', role = '$role' WHERE id_admin = '$id_admin'");

  if (!$editPetugas) {
    echo ("Error description : <span style='color:red;'>" . $conn->error . "</span> Cek lagi bro");
    $conn->close();
  } else {
    $_SESSION['status'] = "Yeeaayyy..!!";
    $_SESSION['desc'] = "Data berhasil diubah";
    $_SESSION['link'] = "petugas";
  }
}

//Delete Petugas
if (isset($_POST['deletePetugas'])) {
  $id_admin = mysqli_real_escape_string($conn, $_POST['id_admin']);

  $deletePetugas = $conn->query("DELETE FROM tb_admin WHERE id_admin = $id_admin");

  if (!$deletePetugas) {
    echo ("Error description : <span style='color:red;'>" . $conn->error . "</span> Cek lagi bro");
    $conn->close();
  } else {
    $_SESSION['status'] = "Yeeaayyy..!!";
    $_SESSION['desc'] = "Data berhasil dihapus";
    $_SESSION['link'] = "petugas";
  }
}

// Add Barang
if (isset($_POST['addBarang'])) {
  $nama_barang = mysqli_real_escape_string($conn, $_POST['nama_barang']);
  $harga_awal = mysqli_real_escape_string($conn, $_POST['harga_awal']);
  $tanggal = mysqli_real_escape_string($conn, $_POST['tanggal']);
  $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
  $harga_akhir = 0;
  $status = "proses";
  $id_admin = $_SESSION['id_admin'];

  $foto = $_FILES['foto']['name'];
  $source = $_FILES['foto']['tmp_name'];
  $size = $_FILES['foto']['size'];
  $ekstensi = ['jpeg', 'jpg', 'png'];
  $pecah = explode('.', $foto);
  $ekstensifoto = strtolower(end($pecah));
  $folder = 'img/';
  $gambar = date('dmYHis') . '-' . $foto;

  if (in_array($ekstensifoto, $ekstensi) === true) {
    if ($size < 5000000) {

      move_uploaded_file($source, $folder . $gambar);


      $addBarang = $conn->query("INSERT INTO tb_barang (nama_barang, harga_awal, harga_akhir, tanggal, deskripsi, foto, status, id_admin) VALUES ('$nama_barang', '$harga_awal', '$harga_akhir', '$tanggal', '$deskripsi', '$gambar', '$status', '$id_admin')");

      if (!$addBarang) {
        echo ("Error description : <span style='color:red;'>" . $conn->error . "</span> Cek lagi bro");
        $conn->close();
      } else {
        $_SESSION['status'] = "Yeeaayyy..!!";
        $_SESSION['desc'] = "Data berhasil ditambah";
        $_SESSION['link'] = "barang";
      }
    }
  }
}

// Edit Barang
if (isset($_POST['editBarang'])) {
  $nama_barang = mysqli_real_escape_string($conn, $_POST['nama_barang']);
  $harga_awal = mysqli_real_escape_string($conn, $_POST['harga_awal']);
  $tanggal = mysqli_real_escape_string($conn, $_POST['tanggal']);
  $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
  $harga_akhir = 0;
  $status = "proses";
  $id_barang = $_POST['id_barang'];


  $fotolama = $_FILES['cek_foto']['name'];
  $foto = $_FILES['foto']['name'];
  $source = $_FILES['foto']['tmp_name'];
  $size = $_FILES['foto']['size'];
  $ekstensi = ['jpeg', 'jpg', 'png'];
  $pecah = explode('.', $foto);
  $ekstensifoto = strtolower(end($pecah));
  $folder = 'img/';
  $gambar = date('dmYHis') . '-' . $foto;

  if (empty($foto)) {

    $editBarang = $conn->query("UPDATE tb_barang SET nama_barang = '$nama_barang', harga_awal = '$harga_awal', harga_akhir = '$harga_akhir', tanggal = '$tanggal', deskripsi = '$deskripsi' WHERE id_barang = '$id_barang'");

    if (!$editBarang) {
      echo ("Error description : <span style='color:red;'>" . $conn->error . "</span> Cek lagi bro");
      $conn->close();
    } else {
      $_SESSION['status'] = "Yeeaayyy..!!";
      $_SESSION['desc'] = "Data berhasil ditambah";
      $_SESSION['link'] = "barang";
    }
  } elseif (in_array($ekstensifoto, $ekstensi) === true) {
    if ($size < 5000000) {

      move_uploaded_file($source, $folder . $gambar);

      $barang = $conn->query("SELECT * FROM tb_barang");
      $result = $barang->fetch_assoc();
      $foto = $result['foto'];

      $editBarang = $conn->query("UPDATE tb_barang SET nama_barang = '$nama_barang', harga_awal = '$harga_awal', harga_akhir = '$harga_akhir', tanggal = '$tanggal', deskripsi = '$deskripsi', foto = '$gambar', status = '$status' WHERE id_barang = '$id_barang'");
      unlink("img/" . $foto);
    }
    if (!$editBarang) {
      echo ("Error description : <span style='color:red;'>" . $conn->error . "</span> Cek lagi bro");
      $conn->close();
    } else {
      $_SESSION['status'] = "Yeeaayyy..!!";
      $_SESSION['desc'] = "Data berhasil ditambah";
      $_SESSION['link'] = "barang";
    }
  }
}

//Delete Barang
if (isset($_POST['deleteBarang'])) {
  $id_barang = mysqli_real_escape_string($conn, $_POST['id_barang']);

  $barang = $conn->query("SELECT * FROM tb_barang WHERE id_barang = '$id_barang'");
  $result = $barang->fetch_assoc();
  $foto = $result['foto'];

  $deleteBarang = $conn->query("DELETE FROM tb_barang WHERE id_barang = $id_barang");
  unlink("img/" . $foto);

  if (!$deleteBarang) {
    echo ("Error description : <span style='color:red;'>" . $conn->error . "</span> Cek lagi bro");
    $conn->close();
  } else {
    $_SESSION['status'] = "Yeeaayyy..!!";
    $_SESSION['desc'] = "Data berhasil dihapus";
    $_SESSION['link'] = "barang";
  }
}

// Add Lelang
if (isset($_POST['lelangBarang'])) {
  $id_barang = $_POST['id_barang'];

  $admin = $conn->query("SELECT * FROM tb_admin");
  $result = $admin->fetch_assoc();
  $id_admin = $result['id_admin'];
  $status = "Dibuka";


  $addLelang = $conn->query("INSERT INTO tb_lelang (id_barang, id_admin, status) VALUES ('$id_barang', '$id_admin', '$status')");

  $updateStatus = $conn->query("UPDATE tb_barang SET status = '$status' WHERE id_barang = '$id_barang'");

  if (!$addLelang && !$updateStatus) {
    echo ("Error description : <span style='color:red;'>" . $conn->error . "</span> Cek lagi bro");
    $conn->close();
  } else {
    $_SESSION['status'] = "Yeeaayyy..!!";
    $_SESSION['desc'] = "Data berhasil ditambah";
    $_SESSION['link'] = "barang";
  }
}

// Add Tawar
if (isset($_POST['tawarBarang'])) {
  $id_barang = $_POST['id_barang'];
  $harga = $_POST['harga_tawar'];
  $id_masyarakat = $_SESSION['id_masyarakat'];
  

  $dataHarga = $conn->query("SELECT * FROM tb_barang WHERE id_barang = '$id_barang'");
  $resultHarga = $dataHarga->fetch_assoc();
  $hargaLelang = $resultHarga['harga_awal'];

  if ($harga < $hargaLelang) {
?>
    <script>
      alert("Harga tidak boleh dibawah harga lelang");
      window.location.href = "?page=penawaran&id=<?= $id_barang; ?>";
      die();
    </script>
<?php
  } else {

    $addTawar = $conn->query("INSERT INTO tb_tawar (id_barang, id_masyarakat, harga) VALUES ('$id_barang', '$id_masyarakat', '$harga')");

    if (!$addTawar) {
      echo ("Error description : <span style='color:red;'>" . $conn->error . "</span> Cek lagi bro");
      $conn->close();
    } else {
      $_SESSION['status'] = "Yeeaayyy..!!";
      $_SESSION['desc'] = "Barang berhasil ditawar";
      $_SESSION['link'] = "?page=penawaran&id=" . "$id_barang";
    }
  }
}

// Pemenang
if (isset($_POST['pemenang'])) {
  $idBarang = $_POST['idBarang'];
  $hargaPemenang = $_POST['hargaPemenang'];
  $idMasyarakat = $_POST['idMasyarakat'];
  $idLelang = $_POST['idLelang'];
  $status = "Ditutup";

  $updatePemenang = $conn->query("UPDATE tb_lelang SET id_masyarakat = '$idMasyarakat', status = '$status', harga = '$hargaPemenang' WHERE id_lelang = '$idLelang'");

  $updateBarang = $conn->query("UPDATE tb_barang SET harga_akhir = '$hargaPemenang', status = '$status' WHERE id_barang = '$idBarang'");

  if (!$updateBarang && !$updatePemenang) {
    echo ("Error description : <span style='color:red;'>" . $conn->error . "</span> Cek lagi bro");
      $conn->close();
    } else {
      $_SESSION['status'] = "Yeeaayyy..!!";
      $_SESSION['desc'] = "Barang berhasil ditawar";
      $_SESSION['link'] = "lelang";
    }
  }
