<?php
include "koneksi.php";
$db = new database();
$db->cek_login();

if (isset($_GET['logout'])) {
    $db->logout();
}

$data_barang = $db->tampil_data();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Barang</title>
</head>
<body>
    <?php if (isset($_GET['pesan'])) echo "<p><b>" . htmlspecialchars($_GET['pesan']) . "</b></p>"; ?>

    <a href="tambah_data.php">Tambah Data</a><br><br>

    <form method="get" action="cari_data.php">
        <input type="text" name="cari" placeholder="Cari Nama Barang">
        <input type="submit" value="Cari">
    </form>
    <br>

    <table border="1" cellspacing="0" cellpadding="5">
        <tr>
            <th>No</th>
            <th>Kode Barang</th>
            <th>Barang</th>
            <th>Stok</th>
            <th>Harga Beli</th>
            <th>Harga Jual</th>
            <th>Action</th>
        </tr>
        <?php
        $no = 1;
        foreach ($data_barang as $row) {
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo "BRG" . str_pad($row['id_barang'], 2, "0", STR_PAD_LEFT); ?></td>
            <td><?php echo $row['nama_barang']; ?></td>
            <td><?php echo $row['stok']; ?></td>
            <td><?php echo $row['harga_beli']; ?></td>
            <td><?php echo $row['harga_jual']; ?></td>
            <td>
                <a href="edit_data.php?id_barang=<?php echo $row['id_barang']; ?>&action=edit">Edit</a> |
                <a href="proses_barang.php?id_barang=<?php echo $row['id_barang']; ?>&action=delete">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>

    <br>
    <form method="get" action="tampil.php">
        <input type="hidden" name="logout" value="true">
        <input type="submit" value="Keluar Aplikasi">
    </form>
</body>
</html>
