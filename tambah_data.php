<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Barang</title>
    </head>
<body>
    <h1>Tambah Data Barang</h1>
    <form method="POST" action="proses_barang.php?action=add" enctype="multipart/form-data">
        <label>Kode Barang</label>
        <input type="text" name="kd_barang"/>
        <label>Nama Barang</label>
        <input type="text" name="nama_barang"/>
        <label>Stok</label>
        <input type="text" name="stok"/>
        <label>Harga Beli</label>
        <input type="text" name="harga_beli"/>
        <label>Harga Jual</label>
        <input type="text" name="harga_jual"/>
        <label>Gambar Produk</label>
        <input type="file" name="gambar_produk"/>
        <input type="submit" name="submit" value="Simpan"/>
        <a href="tampil.php">Kembali</a>
    </form>
</body>
</html>