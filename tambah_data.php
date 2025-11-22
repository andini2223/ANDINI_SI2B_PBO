
<?php
include('koneksi.php');
$db = new database();

// Panggil fungsi untuk mendapatkan kode otomatis
$kode_barangbaru = $db->kode_barang();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Barang</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        /* CSS Tambahan untuk Form */
        .kotak_form { 
            width: 500px; /* Ukuran kotak form */
            background: white;
            margin: 50px auto; /* Memusatkan kotak */
            padding: 30px 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1); /* Tambah bayangan */
        }
        .form_input { 
            /* Menyesuaikan dengan form_login dari style.css, tapi namanya diubah */
            box-sizing: border-box;
            width: 100%;
            padding: 10px;
            font-size: 11pt;
            margin-bottom: 10px; /* Jarak antar input */
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        table {
            width: 100%;
        }
        td:first-child {
            width: 150px; /* Lebar kolom label */
            padding-bottom: 10px;
        }
        /* Style untuk tombol Simpan dan Kembali */
        .tombol_simpan {
            background: #47C0DB;
            color: white;
            font-size: 11pt;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .tombol_kembali {
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
    </style>
</head>
<body>
<div class="kotak_form">
    <h3 style="text-align: center;">Form Tambah Data Barang</h3>

    <form method="post" action="proses_barang.php?action=add" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Kode Barang</td>
                <td>:</td>
                <td>
                    <input type="text" name="kd_barang" class="form_input" readonly
                           value="<?php echo htmlspecialchars($kode_barangbaru); ?>"/>
                </td>
            </tr>
            <tr>
                <td>Nama Barang</td>
                <td>:</td>
                <td><input type="text" name="nama_barang" class="form_input" required/></td>
            </tr>
            <tr>
                <td>Stok</td>
                <td>:</td>
                <td><input type="number" name="stok" class="form_input" min="0" required/></td>
            </tr>
            <tr>
                <td>Harga Beli</td>
                <td>:</td>
                <td><input type="number" name="harga_beli" class="form_input" min="0" required/></td>
            </tr>
            <tr>
                <td>Harga Jual</td>
                <td>:</td>
                <td><input type="number" name="harga_jual" class="form_input" min="0" required/></td>
            </tr>
            <tr>
                <td>Gambar Produk</td>
                <td>:</td>
                <td>
                    <input type="file" name="gambar_produk" class="form_input" style="padding: 3px;" required/>
                </td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: right; padding-top: 20px;">
                    <button type="submit" name="tombol" class="tombol_simpan">Simpan Data</button>
                    <a href="index.php" class="tombol_kembali" role="button">Kembali</a>
                </td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>
