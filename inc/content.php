<?php
error_reporting(0);

$page = $_GET['page'];
$action = $_GET['action'];

if ($page == 'petugas') {
  if ($action == '') {
    include "page/petugas/petugas.php";
  }
} elseif ($page == 'barang') {
  if ($action == '') {
    include "page/barang/barang.php";
  }
} elseif ($page == 'masyarakat') {
  if ($action == '') {
    include "page/masyarakat/masyarakat.php";
  }
} elseif ($page == 'lelang') {
  if ($action == '') {
    include "page/lelang/lelang.php";
  }
} elseif ($page == 'penawaran') {
  if ($action == '') {
    include "page/penawaran/penawaran.php";
  }elseif ($action == 'add') {
    include "page/penawaran/add.php";
  }
} elseif ($page == 'laporan') {
  if ($action == '') {
    include "page/laporan/laporan.php";
  }
}
