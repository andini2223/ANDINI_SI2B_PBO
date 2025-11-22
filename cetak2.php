<?php
include('koneksi.php');
$db = new database();

// 1. Ambil KD BARANG
$kd_barang = isset($_GET['kd_barang']) ? $_GET['kd_barang'] : die("Kode barang tidak ditemukan");

// 2. Ambil 1 data barang berdasar kd_barang (PERFECT MATCH)
$query = mysqli_query($db->koneksi, "SELECT * FROM tb_barang WHERE kd_barang = '$kd_barang'");
$x = mysqli_fetch_assoc($query);

// Jika tidak ketemu
if (!$x) {
    die("Data barang tidak ditemukan.");
}

// === FUNGSI CARI GAMBAR (COPY DARI tampil.php) ===
function cari_gambar_barang($nama_barang) {
    $gambar_dir = 'gambar/';
    $gambar_files = scandir($gambar_dir);

    $nama_normalized = strtolower(trim($nama_barang));
    $nama_normalized = preg_replace('/\s+/', ' ', $nama_normalized);
    $kata_kunci = explode(' ', $nama_normalized);

    foreach ($gambar_files as $file) {
        if ($file == '.' || $file == '..') continue;
        if (stripos($file, 'logo') !== false) continue;

        $file_lower = strtolower($file);

        foreach ($kata_kunci as $kata) {
            if (stripos($file_lower, $kata) !== false) {
                return $file;
            }
        }
    }
    return null;
}

// Tentukan gambar yang dipakai
$gambar_path = "";

if (!empty($x['gambar_produk']) && file_exists("gambar/".$x['gambar_produk'])) {
    $gambar_path = "gambar/".$x['gambar_produk'];
} else {
    $cari = cari_gambar_barang($x['nama_barang']);
    if ($cari && file_exists("gambar/".$cari)) {
        $gambar_path = "gambar/".$cari;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cetak Data Barang Satuan</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        h1 { text-align: center; }
        table { width: 80%; margin:auto; border-collapse: collapse; }
        th, td {
            border:1px solid black; 
            padding: 10px;
        }
    </style>
</head>
<body onload="window.print()">

    <h1>LAPORAN DATA BARANG SATUAN</h1>
    <h2 style="text-align:center;"><?php echo strtoupper($x['nama_barang']); ?></h2>

    <table>
        <tr><th width="30%">Kode Barang</th><td><?php echo $x['kd_barang']; ?></td></tr>
        <tr><th>Nama Barang</th><td><?php echo $x['nama_barang']; ?></td></tr>
        <tr><th>Stok</th><td><?php echo $x['stok']; ?> unit</td></tr>
        <tr><th>Harga Beli</th><td>Rp <?php echo number_format($x['harga_beli'],0,',','.'); ?></td></tr>
        <tr><th>Harga Jual</th><td>Rp <?php echo number_format($x['harga_jual'],0,',','.'); ?></td></tr>
        <tr>
            <th>Gambar Produk</th>
            <td>
                <?php if (!empty($gambar_path)): ?>
                    <img src="<?php echo $gambar_path; ?>" style="width:150px;">
                <?php else: ?>
                    <small>Tidak ada gambar</small>
                <?php endif; ?>
            </td>
        </tr>
    </table>

</body>
</html>
