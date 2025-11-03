<?php
include 'koneksi.php';
$db = new database();
$db->cek_login();

$cari = $_GET['cari'] ?? '';
$data = $db->cari_data($cari);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Hasil Pencarian</title>
</head>
<body>
    <a href="tampil.php">Kembali</a>
    <h3>Hasil Pencarian: <?php echo htmlspecialchars($cari); ?></h3>
    <table border="1" cellspacing="0" cellpadding="5">
        <tr>
            <th>No</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Stok</th>
            <th>Harga Beli</th>
            <th>Harga Jual</th>
            <th>Action</th>
        </tr>
        <?php $no=1; foreach($data as $row){ ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo "BRG" . str_pad($row['id_barang'], 2, "0", STR_PAD_LEFT); ?></td>
            <td><?php echo $row['nama_barang']; ?></td>
            <td><?php echo $row['stok']; ?></td>
            <td><?php echo $row['harga_beli']; ?></td>
            <td><?php echo $row['harga_jual']; ?></td>
            <td><a href="edit_data.php?id_barang=<?php echo $row['id_barang']; ?>&action=edit">Edit</a> | <a href="proses_barang.php?id_barang=<?php echo $row['id_barang']; ?>&action=delete">Hapus</a></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
