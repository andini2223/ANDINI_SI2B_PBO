cetak satuan
<?php
include('koneksi.php');
$db = new database();
$koneksi = mysqli_connect("localhost","root","","belajar_oop2");

if(isset($_GET['kd_barang'])){
    $kd_barang = $_GET['kd_barang'];
    $data = mysqli_query($koneksi,"SELECT * FROM tb_barang WHERE kd_barang='$kd_barang'");
    $row = mysqli_fetch_array($data);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cetak Satuan Barang</title>
</head>
<body>
<?php if(!empty($row)){ ?>
    <h2>Laporan Detail Data Barang : <?php echo $row['nama_barang']; ?></h2>
    <hr>
    <table>
        <tr><td>Kode Barang</td><td>: <?php echo $row['kd_barang']; ?></td></tr>
        <tr><td>Nama Barang</td><td>: <?php echo $row['nama_barang']; ?></td></tr>
        <tr><td>Stok</td><td>: <?php echo $row['stok']; ?></td></tr>
        <tr><td>Harga Beli</td><td>: <?php echo $row['harga_beli']; ?></td></tr>
        <tr><td>Harga Jual</td><td>: <?php echo $row['harga_jual']; ?></td></tr>
        <tr><td>Keuntungan</td><td>: <?php echo ($row['harga_jual'] - $row['harga_beli']); ?></td></tr>
    </table>
    <script>
        window.print();
    </script>
<?php } else { ?>
    <p>Data barang tidak ditemukan!</p>
<?php } ?>
</body>
</html>