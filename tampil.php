<?php
include('koneksi.php');
$db = new database();

// --- START: LOGIKA PAGINATION & SEARCH ---

// Konfigurasi Pagination
$data_per_halaman = 5; // Jumlah data per halaman
$halaman_aktif = (isset($_GET['halaman']) && is_numeric($_GET['halaman'])) ? (int)$_GET['halaman'] : 1;
$mulai = ($halaman_aktif - 1) * $data_per_halaman; // Hitung offset data

// Ambil keyword pencarian
$keyword = isset($_GET['cari']) ? trim($_GET['cari']) : '';

// Hitung total data (dengan atau tanpa keyword)
$total_data = $db->jumlah_total_data($keyword);

// Hitung total halaman
$total_halaman = ceil($total_data / $data_per_halaman);

// Tentukan data yang akan ditampilkan (dengan limit)
if (!empty($keyword)) {
    // Cari data dengan limit
    $data_barang = $db->cari_data($keyword, $mulai, $data_per_halaman);
} else {
    // Tampilkan semua data dengan limit
    $data_barang = $db->tampil_data_paginated($mulai, $data_per_halaman);
}

// --- END: LOGIKA PAGINATION & SEARCH ---

// Fungsi untuk mencari gambar berdasarkan nama barang (Diletakkan di sini untuk menghindari error)
function cari_gambar_barang($nama_barang) {
    $gambar_dir = 'gambar/';
    $gambar_files = scandir($gambar_dir);
    
    $nama_normalized = strtolower(trim($nama_barang));
    $nama_normalized = preg_replace('/\s+/', ' ', $nama_normalized);
    $kata_kunci = explode(' ', $nama_normalized);
    
    $kata_kunci = array_filter($kata_kunci, function($kata) {
        return strlen($kata) >= 3 && !in_array(strtolower($kata), ['pro', 'plus', 'note', 'redmi', 'xiaomi']);
    });
    
    if (empty($kata_kunci)) {
        $kata_kunci = explode(' ', $nama_normalized);
        $kata_kunci = array_filter($kata_kunci, function($kata) {
            return strlen($kata) >= 2;
        });
    }
    
    // Mapping khusus untuk beberapa kasus (Prioritas Tinggi)
    $mapping_khusus = [
        'samsung m20' => ['samsung m30s', 'samsung'],
        'redmi note6' => ['redmi-note-6', 'note-6-pro', 'note6'],
        'xiaomi redmi note 9 pro' => ['redmi note 9 pro', 'note 9 pro', 'note-9-pro'],
        'xiaomi redmi note 8' => ['redmi note 8', 'note 8', 'note-8'],
        'vivo x70 pro' => ['vivox70pro', 'vivo x70', 'vivo-x70'],
        'asus zenphone x7' => ['zenphone 7', 'zenphone', 'asus zenphone', 'zenphone-7'],
        'realme a5' => ['realme', 'realme 5', 'realme-5']
    ];
    
    foreach ($mapping_khusus as $key => $patterns) {
        if (stripos($nama_normalized, $key) !== false) {
            foreach ($gambar_files as $file) {
                if ($file == '.' || $file == '..' || is_dir($gambar_dir . $file)) {
                    continue;
                }
                $file_lower = strtolower($file);
                foreach ($patterns as $pattern) {
                    if (stripos($file_lower, $pattern) !== false && stripos($file, 'logo') === false) {
                        return $file;
                    }
                }
            }
        }
    }
    
    $best_match = null;
    $best_score = 0;
    
    // Cari file gambar yang cocok dengan algoritma scoring
    foreach ($gambar_files as $file) {
        if ($file == '.' || $file == '..' || is_dir($gambar_dir . $file)) {
            continue;
        }
        
        if (stripos($file, 'logo') !== false) {
            continue;
        }
        
        $file_lower = strtolower($file);
        $file_clean = preg_replace('/^\d+-/', '', $file_lower);
        $file_clean = preg_replace('/\.(jpg|jpeg|png)$/', '', $file_clean);
        
        $score = 0;
        
        foreach ($kata_kunci as $kata) {
            if (stripos($file_clean, $kata) !== false || stripos($file_lower, $kata) !== false) {
                $score += strlen($kata) * 2;
            }
        }
        
        $nama_singkat = str_replace([' ', '-', '_'], '', $nama_normalized);
        $file_singkat = str_replace([' ', '-', '_'], '', $file_clean);
        if (stripos($file_singkat, $nama_singkat) !== false || stripos($nama_singkat, $file_singkat) !== false) {
            $score += 20;
        }
        
        if ($score > $best_score) {
            $best_score = $score;
            $best_match = $file;
        }
    }
    
    return $best_match;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, minimum-scale=1, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <title>DATA BARANG</title>
    <style type="text/css">
        * {
            font-family: "Trebuchet MS";
        }
        h1 {
            text-transform: uppercase;
            color: #47C6DB;
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            border: solid 1px #DDEEEE;
            border-collapse: collapse;
            border-spacing: 0;
            width: 90%;
            margin: 10px auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }
        table thead th {
            background-color: #DDEFEF;
            border: solid 1px #DDEEEE;
            color: #336B6B;
            padding: 10px;
            text-align: left;
            text-shadow: 1px 1px 1px #fff;
        }
        table tbody td {
            border: solid 1px #DDEEEE;
            color: #333;
            padding: 10px;
            text-shadow: 1px 1px 1px #fff;
            vertical-align: middle;
        }
        table tbody td img {
            max-width: 100px;
            max-height: 100px;
            object-fit: contain;
            border: 1px solid #DDEEEE;
            border-radius: 4px;
            display: block;
            margin: 0 auto;
        }

        /* CSS KOLOM ACTION & BUTTONS */
        a {
            background-color: #47C6DB;
            color: #fff;
            padding: 8px 10px;
            text-decoration: none;
            font-size: 12px;
            border-radius: 4px;
            display: inline-block;
            transition: background-color 0.3s;
        }
        a:hover {
            background-color: #3aa8b8;
        }
        
        a.btn-delete {
            background-color: #E74C3C;
        }
        a.btn-delete:hover {
            background-color: #C0392B;
        }

        .action-buttons {
            display: flex;
            gap: 5px;
            justify-content: center;
            align-items: center;
        }
        
        table thead th:last-child {
            width: 150px;
            text-align: center;
        }
        table tbody td:last-child {
            text-align: center;
        }
        /* END: CSS KOLOM ACTION & BUTTONS */

        .search-container {
            width: 90%;
            margin: 0 auto 20px auto;
            padding: 15px;
            background-color: #f5f5f5;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .search-form {
            display: flex;
            gap: 10px;
            align-items: center;
        }
        .search-form input[type="text"] {
            flex: 1;
            padding: 10px;
            border: 1px solid #DDEEEE;
            border-radius: 4px;
            font-size: 14px;
        }
        .search-form input[type="submit"] {
            background-color: #47C6DB;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }
        .search-form input[type="submit"]:hover {
            background-color: #3aa8b8;
        }
        .search-form a {
            padding: 10px 15px;
            font-size: 14px;
        }
        .top-action-links {
            width: 90%;
            margin: 20px auto 0 auto;
            text-align: left;
            display: flex;
            gap: 10px;
        } 
        
        /* CSS PAGINATION */
        .pagination-container {
            width: 90%;
            margin: 20px auto 30px auto;
            text-align: center;
        }
        .pagination-container a, .pagination-container span {
            color: #47C6DB;
            padding: 8px 16px;
            text-decoration: none;
            border: 1px solid #ddd;
            margin: 0 4px;
            border-radius: 4px;
            transition: background-color 0.3s;
            display: inline-block;
            font-size: 14px;
        }
        .pagination-container a:hover:not(.active) {
            background-color: #f1f1f1;
        }
        .pagination-container .active {
            background-color: #47C6DB;
            color: white;
            border: 1px solid #47C6DB;
        }
    </style>
</head>
<body>
    <style>
        .navbar {
            width: 100%;
            background-color: #47C6DB;
            padding: 14px 0;
            display: flex;
            justify-content: left;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }      

        .navbar a {
            color: white;
            padding: 12px 20px;
            text-decoration: none;
            font-size: 15px;
            font-weight: bold;
            transition: 0.3s;
        }

        .navbar a:hover {
            background-color: #3aa8b8;
        }
    </style>

    <div class="navbar">
        <a href="index.php">Home</a>
        <a href="tampil.php">Kelola Data</a>
        <a href="index.php">Logout</a>
    </div>

    <h1>Data Barang</h1>

    <div class="top-action-links">
        <a href="tambah_data.php">Tambah Data</a> 
        <a href="cetak.php" target="_blank" style="background:#2ecc71;">Cetak Data Barang</a>
    </div>

    <div class="search-container">
        <form method="GET" action="" class="search-form">
            <input type="text" name="cari" placeholder="Cari berdasarkan kode barang/nama barang..." 
                       value="<?php echo isset($_GET['cari']) ? htmlspecialchars($_GET['cari']) : ''; ?>">
            <input type="submit" value="Cari">
            <?php if(isset($_GET['cari']) && !empty($_GET['cari'])): ?>
                <a href="tampil.php">Reset</a>
            <?php endif; ?>
        </form>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Stok</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Gambar Produk</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (empty($data_barang) && !empty($keyword)) {
                echo '<tr><td colspan="8" style="text-align: center; padding: 20px;">';
                echo 'Data tidak ditemukan untuk keyword: <strong>' . htmlspecialchars($keyword) . '</strong>';
                echo '</td></tr>';
            } else if (empty($data_barang)) {
                echo '<tr><td colspan="8" style="text-align: center; padding: 20px;">Tidak ada data barang.</td></tr>';
            }
            
            // Nomor urut disesuaikan dengan halaman aktif
            $no = $mulai + 1; 
            foreach ($data_barang as $x) { 
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $x['kd_barang']; ?></td>
                <td><?php echo $x['nama_barang']; ?></td>
                <td><?php echo $x['stok']; ?></td>
                <td>Rp <?php echo number_format($x['harga_beli'], 0, ',', '.'); ?></td>
                <td>Rp <?php echo number_format($x['harga_jual'], 0, ',', '.'); ?></td>
                <td>
                    <?php 
                    $gambar_path = '';
                    
                    if (!empty($x['gambar_produk']) && file_exists('gambar/' . $x['gambar_produk'])) {
                        $gambar_path = 'gambar/' . $x['gambar_produk'];
                    } else {
                        $gambar_ditemukan = cari_gambar_barang($x['nama_barang']);
                        if ($gambar_ditemukan && file_exists('gambar/' . $gambar_ditemukan)) {
                            $gambar_path = 'gambar/' . $gambar_ditemukan;
                        }
                    }
                    
                    if (!empty($gambar_path) && file_exists($gambar_path)) {
                        echo '<img src="' . $gambar_path . '" alt="' . htmlspecialchars($x['nama_barang']) . '" title="' . htmlspecialchars($x['nama_barang']) . '">';
                    } else {
                        // Tampilkan placeholder
                        echo '<img src="gambar/logo_aplikasi.png" alt="Gambar tidak tersedia" style="opacity: 0.5;" title="Gambar tidak tersedia untuk ' . htmlspecialchars($x['nama_barang']) . '">';
                    }
                    ?>
                </td>
                <td>
                <div class="action-buttons">
                    <a href="edit_data.php?id_barang=<?php echo $x['id_barang']; ?>&action=edit">Edit</a>
                    <a href="proses_barang.php?id_barang=<?php echo $x['id_barang']; ?>&action=delete" class="btn-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Hapus</a>
                    <a href="cetak2.php?kd_barang=<?php echo $x['kd_barang']; ?>" 
                        target="_blank" 
                        style="background:#2ecc71;">Cetak Satuan</a>
                </div>
                </td>
            </tr>
            <?php 
            }
            ?>
        </tbody>
    </table>
    
    <?php if ($total_halaman > 1): ?>
    <div class="pagination-container">
        <?php 
        $search_param = !empty($keyword) ? '&cari=' . urlencode($keyword) : '';
        
        // Tombol Sebelumnya
        if ($halaman_aktif > 1) {
            echo '<a href="?halaman=' . ($halaman_aktif - 1) . $search_param . '">« Sebelumnya</a>';
        }
        
        // Tautan Angka Halaman
        for ($i = 1; $i <= $total_halaman; $i++) {
            $active_class = ($i == $halaman_aktif) ? 'active' : '';
            echo '<a class="' . $active_class . '" href="?halaman=' . $i . $search_param . '">' . $i . '</a>';
        }
        
        // Tombol Selanjutnya
        if ($halaman_aktif < $total_halaman) {
            echo '<a href="?halaman=' . ($halaman_aktif + 1) . $search_param . '">Selanjutnya »</a>';
        }
        ?>
    </div>
    <?php endif; ?>
    </body>
</html>

