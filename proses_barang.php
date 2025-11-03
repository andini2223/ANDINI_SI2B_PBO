<?php
include 'koneksi.php';
$db = new database();
$db->cek_login();

if (isset($_GET['logout'])) {
    $db->logout();
}

$action = $_GET['action'] ?? '';

if ($action == "add") {
    $db->tambah_data($_POST['nama_barang'], $_POST['stok'], $_POST['harga_beli'], $_POST['harga_jual']);
    header('location:tampil.php');
}

elseif ($action == "edit") {
    $db->edit_data($_POST['id_barang'], $_POST['nama_barang'], $_POST['stok'], $_POST['harga_beli'], $_POST['harga_jual']);
    header('location:tampil.php');
}

elseif ($action == "delete") {
    $db->delete_data($_GET['id_barang']);
    header('location:tampil.php');
}

elseif ($action == "search") {
    header('location:cari_data.php?cari=' . $_POST['nama_barang']);
}

else {
    header('location:tampil.php');
}
?>
