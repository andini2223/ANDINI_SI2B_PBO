<?php
include('koneksi.php');
$db = new database();

// Pastikan id_barang tersedia dari URL
$id_barang = isset($_GET['id_barang']) ? $_GET['id_barang'] : die("ID Barang tidak ditemukan.");

// Panggil method untuk menampilkan data yang akan diedit
$data_edit = $db->tampil_edit_data($id_barang);

// Cek apakah data ditemukan
if (empty($data_edit)) {
    die("Data barang tidak ditemukan.");
}

// Karena tampil_edit_data mengembalikan array multi-dimensi, kita ambil data pertama
$d = $data_edit[0]; 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Barang</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        /* Gaya tambahan untuk kotak form edit */
        .kotak_form {
            width: 500px;
            background: white;
            margin: 50px auto;
            padding: 30px 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .form_input { /* Style untuk input field */
            box-sizing: border-box;
            width: 100%;
            padding: 8px;
            font-size: 11pt;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .tombol_simpan { /* Style untuk tombol Simpan */
            background: #47C0DB;
            color: white;
            font-size: 11pt;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .tombol_kembali { /* Style untuk tombol Kembali */
            background: #999;
            color: white;
            font-size: 11pt;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        table {
            width: 100%;
        }
        td:first-child {
            width: 150px;
        }
        .gambar-saat-ini img {
            max-width: 150px;
            margin-top: 10px;
            border: 1px solid #ddd;
            padding: 5px;
        }
    </style>
</head>
<body>
<div class="kotak_form">
    <h3 style="text-align: center;">Form Edit Data Barang</h3>

    <form method="POST" action="proses_barang.php?action=edit" enctype="multipart/form-data">
        <input type="hidden" name="id_barang" value="<?php echo htmlspecialchars($d['id_barang']); ?>">
        
        <table>
            <tr>
                <td>Kode Barang</td>
                <td>:</td>
                <td>
                    <input type="text" name="kd_barang" class="form_input" 
                           value="<?php echo htmlspecialchars($d['kd_barang']); ?>" readonly/>
                </td>
            </tr>
            <tr>
                <td>Nama Barang</td>
                <td>:</td>
                <td><input type="text" name="nama_barang" class="form_input" 
                           value="<?php echo htmlspecialchars($d['nama_barang']); ?>" required/></td>
            </tr>
            <tr>
                <td>Stok</td>
                <td>:</td>
                <td><input type="number" name="stok" class="form_input" 
                           value="<?php echo htmlspecialchars($d['stok']); ?>" min="0" required/></td>
            </tr>
            <tr>
                <td>Harga Beli</td>
                <td>:</td>
                <td><input type="number" name="harga_beli" class="form_input" 
                           value="<?php echo htmlspecialchars($d['harga_beli']); ?>" min="0" required/></td>
            </tr>
            <tr>
                <td>Harga Jual</td>
                <td>:</td>
                <td><input type="number" name="harga_jual" class="form_input" 
                           value="<?php echo htmlspecialchars($d['harga_jual']); ?>" min="0" required/></td>
            </tr>
            <tr>
                <td>Gambar Produk</td>
                <td>:</td>
                <td>
                    <p class="gambar-saat-ini">Gambar Saat Ini: 
                        <?php if (!empty($d['gambar_produk'])): ?>
                            <img src="gambar/<?php echo htmlspecialchars($d['gambar_produk']); ?>" alt="Gambar Produk"/>
                        <?php else: ?>
                            (Tidak ada gambar)
                        <?php endif; ?>
                    </p>
                    <input type="file" name="gambar_produk" class="form_input" style="padding: 3px;"/>
                    <input type="hidden" name="gambar_lama" value="<?php echo htmlspecialchars($d['gambar_produk']); ?>">
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>
                    <button type="submit" class="tombol_simpan">Simpan Perubahan</button>
                    <a href="tampil.php" class="tombol_kembali" role="button">Kembali</a>
                </td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>