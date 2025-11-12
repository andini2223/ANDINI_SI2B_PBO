<?php
include('koneksi.php');
$db = new database();
$id_barang = $_GET['id_barang'];
foreach($db->tampil_edit_data($id_barang) as $d){
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Barang</title>
    </head>
<body>
    <h1>Edit Data Barang</h1>
    <form method="POST" action="proses_barang.php?action=edit" enctype="multipart/form-data">
        <input type="hidden" name="id_barang" value="<?php echo $d['id_barang']; ?>">
        
        <label>Kode Barang</label>
        <input type="text" name="kd_barang" value="<?php echo $d['kd_barang']; ?>" readonly/>
        
        <label>Nama Barang</label>
        <input type="text" name="nama_barang" value="<?php echo $d['nama_barang']; ?>"/>
        
        <label>Stok</label>
        <input type="text" name="stok" value="<?php echo $d['stok']; ?>"/>
        
        <label>Harga Beli</label>
        <input type="text" name="harga_beli" value="<?php echo $d['harga_beli']; ?>"/>
        
        <label>Harga Jual</label>
        <input type="text" name="harga_jual" value="<?php echo $d['harga_jual']; ?>"/>
        
        <label>Gambar Produk Saat Ini</label>
        <img src="gambar/<?php echo $d['gambar_produk']; ?>" style="width: 100px; float: left; margin-bottom: 5px;"/>
        
        <label>Ganti Gambar Produk (kosongkan jika tidak ingin mengganti)</label>
        <input type="file" name="gambar_produk"/>
        
        <input type="submit" name="submit" value="Simpan Perubahan"/>
        <a href="tampil.php">Kembali</a>
    </form>
</body>
</html>
<?php 
}
?>