<?php
include('koneksi.php');
$db = new database();

// Fungsi untuk mencari gambar berdasarkan nama barang
function cari_gambar_barang($nama_barang) {
    $gambar_dir = 'gambar/';
    $gambar_files = scandir($gambar_dir);
    
    // Normalisasi nama barang (lowercase, hapus spasi berlebih, hapus karakter khusus)
    $nama_normalized = strtolower(trim($nama_barang));
    $nama_normalized = preg_replace('/\s+/', ' ', $nama_normalized); // Hapus spasi berlebih
    $kata_kunci = explode(' ', $nama_normalized);
    
    // Filter kata kunci yang relevan (minimal 3 karakter)
    $kata_kunci = array_filter($kata_kunci, function($kata) {
        return strlen($kata) >= 3 && !in_array(strtolower($kata), ['pro', 'plus', 'note', 'redmi', 'xiaomi']);
    });
    
    // Jika tidak ada kata kunci yang cukup, gunakan semua kata
    if (empty($kata_kunci)) {
        $kata_kunci = explode(' ', $nama_normalized);
        $kata_kunci = array_filter($kata_kunci, function($kata) {
            return strlen($kata) >= 2;
        });
    }
    
    // Mapping khusus untuk beberapa kasus berdasarkan file yang ada (prioritas tinggi)
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
        
        // Skip file logo
        if (stripos($file, 'logo') !== false) {
            continue;
        }
        
        $file_lower = strtolower($file);
        // Hapus angka di depan nama file (format: 123-nama-file.jpg)
        $file_clean = preg_replace('/^\d+-/', '', $file_lower);
        $file_clean = preg_replace('/\.(jpg|jpeg|png)$/', '', $file_clean);
        
        $score = 0;
        
        // Hitung skor berdasarkan kemiripan nama
        foreach ($kata_kunci as $kata) {
            if (stripos($file_clean, $kata) !== false || stripos($file_lower, $kata) !== false) {
                $score += strlen($kata) * 2; // Beri bobot lebih untuk kata yang lebih panjang
            }
        }
        
        // Bonus jika nama barang lengkap ada di nama file
        $nama_singkat = str_replace([' ', '-', '_'], '', $nama_normalized);
        $file_singkat = str_replace([' ', '-', '_'], '', $file_clean);
        if (stripos($file_singkat, $nama_singkat) !== false || stripos($nama_singkat, $file_singkat) !== false) {
            $score += 20; // Bonus besar untuk kecocokan lengkap
        }
        
        // Pilih file dengan skor tertinggi
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
        *{
            font-family: "Trebuchet MS";
        }
        h1 {
            text-transform: uppercase;
            color: #47C6DB;
        }
        table {
            border: solid 1px #DDEEEE;
            border-collapse: collapse;
            border-spacing: 0;
            width: 70%;
            margin: 10px auto;
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
        }
        table tbody td img {
            max-width: 100px;
            max-height: 100px;
            object-fit: cover;
            border: 1px solid #DDEEEE;
            border-radius: 4px;
        }
        a {
            background-color: #47C6DB;
            color: #fff;
            padding: 10px;
            text-decoration: none;
            font-size: 12px;
        }
        .search-container {
            width: 70%;
            margin: 20px auto;
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
        /* ... CSS lain dari source ... */
    </style>
</head>
<body>
    <h1>Data Barang</h1>
    <a href="tambah_data.php">Tambah Data</a> 
    <br/><br/>
    
    <!-- Form Pencarian -->
    <div class="search-container">
        <form method="GET" action="" class="search-form">
            <input type="text" name="cari" placeholder="Cari berdasarkan kode barang (contoh: BRG01)..." 
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
            // Ambil keyword pencarian
            $keyword = isset($_GET['cari']) ? trim($_GET['cari']) : '';
            
            // Tentukan data yang akan ditampilkan
            if(!empty($keyword)) {
                $data_barang = $db->cari_data($keyword);
            } else {
                $data_barang = $db->tampil_data();
            }
            
            // Tampilkan pesan jika tidak ada hasil
            if(empty($data_barang) && !empty($keyword)) {
                echo '<tr><td colspan="8" style="text-align: center; padding: 20px;">';
                echo 'Data tidak ditemukan untuk kode barang: <strong>' . htmlspecialchars($keyword) . '</strong>';
                echo '</td></tr>';
            } else if(empty($data_barang)) {
                echo '<tr><td colspan="8" style="text-align: center; padding: 20px;">Tidak ada data barang.</td></tr>';
            }
            
            $no = 1;
            foreach($data_barang as $x){ 
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $x['kd_barang']; ?></td>
                <td><?php echo $x['nama_barang']; ?></td>
                <td><?php echo $x['stok']; ?></td>
                <td><?php echo $x['harga_beli']; ?></td>
                <td><?php echo $x['harga_jual']; ?></td>
                <td>
                    <?php 
                    $gambar = '';
                    $gambar_path = '';
                    
                    // Prioritas 1: Gunakan gambar dari database jika ada
                    if(!empty($x['gambar_produk']) && file_exists('gambar/' . $x['gambar_produk'])) {
                        $gambar = $x['gambar_produk'];
                        $gambar_path = 'gambar/' . $gambar;
                    } else {
                        // Prioritas 2: Cari gambar berdasarkan nama barang
                        $gambar_ditemukan = cari_gambar_barang($x['nama_barang']);
                        if($gambar_ditemukan && file_exists('gambar/' . $gambar_ditemukan)) {
                            $gambar = $gambar_ditemukan;
                            $gambar_path = 'gambar/' . $gambar;
                        }
                    }
                    
                    // Tampilkan gambar atau placeholder
                    if(!empty($gambar) && !empty($gambar_path) && file_exists($gambar_path)) {
                        echo '<img src="' . $gambar_path . '" alt="' . htmlspecialchars($x['nama_barang']) . '" title="' . htmlspecialchars($x['nama_barang']) . '">';
                    } else {
                        // Tampilkan placeholder jika gambar tidak ditemukan
                        echo '<img src="gambar/logo_aplikasi.png" alt="Gambar tidak tersedia" style="opacity: 0.5;" title="Gambar tidak tersedia untuk ' . htmlspecialchars($x['nama_barang']) . '">';
                    }
                    ?>
                </td>
                <td>
                    <a href="edit_data.php?id_barang=<?php echo $x['id_barang']; ?>&action=edit">Edit</a>
                    <a href="proses_barang.php?id_barang=<?php echo $x['id_barang']; ?>&action=delete" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                </td>
            </tr>
            <?php 
            }
            ?>
        </tbody>
    </table>
</body>
</html>
<a href="cetak.php" target="_blank" class="btn btn-warning">Print Data</a>
