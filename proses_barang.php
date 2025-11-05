<?php
include ('koneksi.php');
$koneksi = new database();

$action = $_GET['action'];

if ($action == "add"){
    $koneksi->tambah_data($_POST['kd_barang'], $_POST['nama_barang'], $_POST['stok'], $_POST['harga_beli'], $_POST['harga_jual']);
    header("location:index.php");

} else if ($action == "edit"){
    $id_barang = $_GET['id_barang'];
    $koneksi->edit_data($id_barang, $_POST['nama_barang'], $_POST['stok'], $_POST['harga_beli'], $_POST['harga_jual']);
    header("location:index.php");

} else if ($action == "delete"){
    $id_barang = $_GET['id_barang'];
    $koneksi->delete_data($id_barang);
    header("location:index.php");
}
?>