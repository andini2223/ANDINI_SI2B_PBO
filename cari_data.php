<?php
session_start();
if($_SESSION['status']!="login"){
    header("location:login.php");
}

include "koneksi.php";
$koneksi = new database();
$nama = $_GET['nama_barang'];
$data = $koneksi->cari_data($nama);
?>

<h3>Hasil Pencarian: <?= $nama ?></h3>
<a href="index.php">Kembali</a>
<br><br>

<table border="1" cellpadding="5">
    <tr>
        <th>No</th><th>Nama Barang</th><th>Stok</th><th>Harga Beli</th><th>Harga Jual</th>
    </tr>

    <?php 
    $no = 1;
    foreach($data as $d){
    ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $d['nama_barang'] ?></td>
        <td><?= $d['stok'] ?></td>
        <td><?= $d['harga_beli'] ?></td>
        <td><?= $d['harga_jual'] ?></td>
    </tr>
    <?php } ?>
</table>

<br>
<a href="proses_barang.php?action=logout">Keluar Aplikasi</a>
