<?php
include 'koneksi.php';
$db = new database();
$db->cek_login();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Barang</title>
</head>
<body>
    <h3>Tambah Data Barang</h3>
    <form method="POST" action="proses_barang.php?action=add">
        <table>
            <tr><td>Nama Barang</td><td><input type="text" name="nama_barang"></td></tr>
            <tr><td>Stok</td><td><input type="number" name="stok"></td></tr>
            <tr><td>Harga Beli</td><td><input type="number" name="harga_beli"></td></tr>
            <tr><td>Harga Jual</td><td><input type="number" name="harga_jual"></td></tr>
            <tr><td></td><td><input type="submit" value="Simpan"></td></tr>
        </table>
    </form>
</body>
</html>
