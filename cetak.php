<?php
include 'koneksi.php';
$db = new database(); // panggil class kamu

function rupiah($angka){
    return "Rp " . number_format($angka,0,',','.');
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cetak Data Barang</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h2 { text-align: center; }
        table {
            width: 90%;
            margin: auto;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #d0e9ff;
        }
    </style>
</head>
<body onload="window.print()">

<h2>Laporan Data Barang</h2>

<table>
    <tr>
        <th>No</th>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Stok</th>
        <th>Harga Beli</th>
        <th>Harga Jual</th>
        <th>Gambar</th>
    </tr>

    <?php
    $no = 1;
    foreach ($db->tampil_data() as $row) {
        echo "
        <tr>
            <td>{$no}</td>
            <td>{$row['kd_barang']}</td>
            <td>{$row['nama_barang']}</td>
            <td>{$row['stok']}</td>
            <td>".rupiah($row['harga_beli'])."</td>
            <td>".rupiah($row['harga_jual'])."</td>
            <td><img src='gambar/{$row['gambar_produk']}' width='60'></td>
        </tr>";
        $no++;
    }
    ?>
</table>

</body>
</html>
