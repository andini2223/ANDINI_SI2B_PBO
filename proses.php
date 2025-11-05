<?php 
// File: supplier/proses.php

// PENTING: Naik satu level (../) untuk menemukan koneksi.php
include ('../koneksi.php'); 
session_start();
$koneksi = new database();

$action = $_GET['action'];

if ($action == "add"){
    // Tambah data Supplier
    $koneksi->tambah_data_supplier(
        $_POST['nama_supplier'], 
        $_POST['alamat_supplier'], 
        $_POST['telepon_supplier'], 
        $_POST['email_supplier'], 
        $_POST['pass_supplier']
    );
    // Redirect kembali ke tampilan Supplier di index.php (root)
    header("location:../index.php?modul=supplier");
    
} else if ($action == "edit"){
    $id = $_GET['id_supplier']; // Mengambil ID dari URL
    // Edit data Supplier
    $koneksi->edit_data_supplier(
        $id,
        $_POST['nama_supplier'], 
        $_POST['alamat_supplier'], 
        $_POST['telepon_supplier'], 
        $_POST['email_supplier'], 
        $_POST['pass_supplier']
    );
    header("location:../index.php?modul=supplier");
    
} else if ($action == "delete"){
    $id = $_GET['id_supplier']; // Mengambil ID dari URL
    // Hapus data Supplier
    $koneksi->delete_data_supplier($id);
    header("location:../index.php?modul=supplier");
} else {
    // Jika action tidak valid
    header("location:../index.php?modul=supplier");
}
?>