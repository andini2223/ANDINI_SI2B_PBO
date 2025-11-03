<?php
include 'koneksi.php';
$db = new database();
$db->cek_login();

$id = $_GET['id_barang'];
$data = $db->tampil_edit($id);
foreach ($data as $d) {
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Barang</title>
</head>
<body>
    <h3>Edit Data Barang</h3>
    <form method="POST" action="proses_barang.php?action=edit">
        <input type="hidden" name="id_barang" value="<?php echo $d['id_barang']; ?>">
        <table>
            <tr><td>Nama Barang</td><td><input type="text" name="nama_barang" value="<?php echo $d['nama_barang']; ?>"></td></tr>
            <tr><td>Stok</td><td><input type="number" name="stok" value="<?php echo $d['stok']; ?>"></td></tr>
            <tr><td>Harga Beli</td><td><input type="number" name="harga_beli" value="<?php echo $d['harga_beli']; ?>"></td></tr>
            <tr><td>Harga Jual</td><td><input type="number" name="harga_jual" value="<?php echo $d['harga_jual']; ?>"></td></tr>
            <tr><td></td><td><input type="submit" value="Update"></td></tr>
        </table>
    </form>
</body>
</html>
<?php } ?>
