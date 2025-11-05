<?php
include ('koneksi.php');
$db = new database();
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <h3>Form Tambah Data Barang</h3>
    <hr>
    <?php
    $kode_barang = $db->kode_barang();
    foreach($kode_barang as $row){
        $kode_max = $row['kd_barang'];
    }
    $pecahdata = explode('0', $kode_max);
    $kode_barangbaru = $pecahdata[0]."0".($pecahdata[1]+1);
    ?>
    <form method="post" action="proses_barang.php?action=add">
    <table>
        <tr>
            <td>Kode Barang</td>
            <td>:</td>
            <td><input type="text" name="kd_barang" value="<?php echo $kode_barangbaru;?>" readonly></td>
        </tr>
        <tr>
            <td>Nama Barang</td>
            <td>:</td>
            <td><input type="text" name="nama_barang"></td>
        </tr>
        <tr>
            <td>Stok</td>
            <td>:</td>
            <td><input type="text" name="stok"></td>
        </tr>
        <tr>
            <td>Harga Beli</td>
            <td>:</td>
            <td><input type="text" name="harga_beli"></td>
        </tr>
        <tr>
            <td>Harga Jual</td>
            <td>:</td>
            <td><input type="text" name="harga_jual"></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>
                <input type="submit" name="tombol" value="Simpan">
                <a href="index.php">
                <input type="button" name="tombol" value="Kembali"></a>
            </td>
        </tr>
    </table>
    </form>
</body>
</html>