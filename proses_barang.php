<?php

include('koneksi.php');

$koneksi = new database();

$action = $_GET['action'];

if($action == "add"){
    $koneksi->tambah_data($_POST['kd_barang'], $_POST['nama_barang'], $_POST['stok'], $_POST['harga_beli'], $_POST['harga_jual'], $_FILES['gambar_produk']['name']);
    header('location:tampil.php');
}
else if($action == "edit"){
    $id_barang = $_GET['id_barang']; // ID barang bisa diambil dari GET atau POST tergantung implementasi form edit
    // Di contoh kode koneksi.php, edit_data tidak menggunakan id_barang dari GET, tapi dari POST.
    // Kode ini di sesuaikan dengan implementasi di file koneksi.php yang menerima semua parameter:
    $koneksi->edit_data($_POST['id_barang'], $_POST['nama_barang'], $_POST['stok'], $_POST['harga_beli'], $_POST['harga_jual'], $_FILES['gambar_produk']['name']);
}
else if($action == "delete"){
    $id_barang = $_GET['id_barang'];
    $koneksi->delete_data($id_barang);
    header('location:tampil.php');
}
else if($action == "print_satuan"){
    $nama_barang = $_POST['nama_barang'];
    $koneksi->satuan_print($nama_barang); // Fungsi ini tidak didefinisikan di koneksi.php di atas, tapi ada di proses_barang.php
    header('location:cetak2.php?nama_barang=' . $nama_barang);
}
else if($action == "login"){
    $koneksi->login($_POST['username'], $_POST['password']); // Fungsi login tidak didefinisikan di koneksi.php di atas
}
else if($action == "logout"){
    $koneksi->logout(); // Fungsi logout tidak didefinisikan di koneksi.php di atas
}
?>