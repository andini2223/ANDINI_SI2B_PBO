<?php
session_start();
include ('koneksi.php');
$db = new database();

if($_SESSION['status'] != "login"){
    header("location:login.php");
    exit();
}

$kd_barang = isset($_GET['kd_barang']) ? $_GET['kd_barang'] : die("Kode barang tidak ditemukan.");
$data = $db->tampil_data_per_kode($kd_barang); 

if (!$data) {
    die("Data barang dengan kode **$kd_barang** tidak ditemukan!");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cetak Satuan: <?php echo $data['nama_barang']; ?></title>
</head>
<body>
    <h2>Laporan Data Barang Satuan</h2>
    <table border="1">
        <tr><td>Kode Barang</td><td><?php echo $data['kd_barang']; ?></td></tr>
        <tr><td>Nama Barang</td><td><?php echo $data['nama_barang']; ?></td></tr>
        <tr><td>Stok</td><td><?php echo $data['stok']; ?></td></tr>
        <tr><td>Harga Beli</td><td><?php echo $data['harga_beli']; ?></td></tr>
        <tr><td>Harga Jual</td><td><?php echo $data['harga_jual']; ?></td></tr>
        <tr><td>Keuntungan</td><td><?php echo $data['harga_jual'] - $data['harga_beli']; ?></td></tr>
    </table>
    <script>
        window.print();
    </script>
    <a href="index.php">
    <input type="submit" name="tombol" value="Kembali"></a>
</body>
</html>