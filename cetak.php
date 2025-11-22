<?php
session_start();
include 'koneksi.php';
$db = new database();

if(!isset($_SESSION['status']) || $_SESSION['status'] != "login"){
    exit("Akses ditolak. Anda harus login untuk mencetak.");
}

$data_barang = $db->tampil_data();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cetak Data Barang</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .data-table { width: 100%; border-collapse: collapse; }
        .data-table th, .data-table td { border: 1px solid #333; padding: 8px; text-align: center; }
        .data-table th { background-color: #f2f2f2; }
        .header-cetak { text-align: center; margin-bottom: 20px; }
        .header-cetak h2 { margin: 0; }
        @media print {
            .tombol_print { display: none; }
        }
    </style>
</head>
<body onload="window.print()">
<div class="header-cetak">
    <h2>LAPORAN DATA BARANG</h2>
    <p>Dicetak pada: <?php echo date("d M Y H:i:s"); ?></p>
</div>

<table class="data-table">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Stok</th>
            <th>Harga Beli</th>
            <th>Harga Jual</th>
            <th>Gambar Produk</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $no = 1;
        if (!empty($data_barang)):
            foreach($data_barang as $row):
                $rupiah_harga_beli = "Rp. " . number_format($row['harga_beli'], 0, ',', '.');
                $rupiah_harga_jual = "Rp. " . number_format($row['harga_jual'], 0, ',', '.');
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $row['kd_barang']; ?></td>
            <td><?php echo $row['nama_barang']; ?></td>
            <td><?php echo $row['stok']; ?></td>
            <td><?php echo $rupiah_harga_beli; ?></td>
            <td><?php echo $rupiah_harga_jual; ?></td>
            <td><img src="gambar/<?php echo $row['gambar_produk']; ?>" style="width: 80px;"></td>
        </tr>
        <?php 
            endforeach;
        else:
        ?>
        <tr>
            <td colspan="7">Tidak ada data barang untuk dicetak.</td>
        </tr>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>