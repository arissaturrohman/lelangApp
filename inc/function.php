<?php
error_reporting(0);
include("config.php");

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

  $foto = $_FILES['foto']['name'];
  $source = $_FILES['foto']['tmp_name'];
  $size = $_FILES['foto']['size'];
  $ekstensi = ['jpeg', 'jpg', 'png'];
  $pecah = explode('.', $foto);
  $ekstensifoto = strtolower(end($pecah));
  $folder = 'img/';
  $gambar = date('dmYHis').'-'.$foto;

  if (in_array($ekstensifoto, $ekstensi) === true) {
    if ($size < 5000000) {
      
      move_uploaded_file($source, $folder.$gambar);
      
      
      $addBarang = $conn->query("INSERT INTO tb_barang (nama_barang, harga_awal, harga_akhir, tanggal, deskripsi, foto, status) VALUES ('$nama_barang', '$harga_awal', '$harga_akhir', '$tanggal', '$deskripsi', '$gambar', '$status')");
      
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
  $gambar = date('dmYHis').'-'.$foto;

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
      
      move_uploaded_file($source, $folder.$gambar);
      
      $barang = $conn->query("SELECT * FROM tb_barang");
      $result = $barang->fetch_assoc();
      $foto = $result['foto'];

      $editBarang = $conn->query("UPDATE tb_barang SET nama_barang = '$nama_barang', harga_awal = '$harga_awal', harga_akhir = '$harga_akhir', tanggal = '$tanggal', deskripsi = '$deskripsi', foto = '$gambar', status = '$status' WHERE id_barang = '$id_barang'");
      unlink("img/".$foto);
      
     } if (!$editBarang) {
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
  unlink("img/".$foto);

  if (!$deleteBarang) {
    echo ("Error description : <span style='color:red;'>" . $conn->error . "</span> Cek lagi bro");
    $conn->close();
  } else {
    $_SESSION['status'] = "Yeeaayyy..!!";
    $_SESSION['desc'] = "Data berhasil dihapus";
    $_SESSION['link'] = "barang";
  }
}


