<?php
session_start();
if($_SESSION['status'] != "login"){ header("location:../login.php"); exit(); }
include ('../koneksi.php'); // Panggil dari root
$db = new database();
$kode_baru = $db->kode_supplier(); 
?>
<!DOCTYPE html><html><head><title>Tambah Supplier</title></head><body>
    <h3>Form Tambah Data Supplier</h3>
    <form method="post" action="proses.php?action=add">
    <table>
        <tr><td>ID Supplier</td><td>:</td><td><input type="text" name="id_supplier" value="<?php echo $kode_baru;?>" readonly></td></tr>
        <tr><td>Nama Supplier</td><td>:</td><td><input type="text" name="nama_supplier" required></td></tr>
        <tr><td>Alamat</td><td>:</td><td><textarea name="alamat_supplier" required></textarea></td></tr>
        <tr><td>Telepon</td><td>:</td><td><input type="text" name="telepon_supplier"></td></tr>
        <tr><td>Email</td><td>:</td><td><input type="email" name="email_supplier" required></td></tr>
        <tr><td>Password</td><td>:</td><td><input type="password" name="pass_supplier" required></td></tr>
        <tr><td></td><td></td><td><input type="submit" value="Simpan"><a href="../index.php?modul=supplier"><input type="button" value="Kembali"></a></td></tr>
    </table></form></body></html>