<?php
// File: supplier/edit.php
session_start();
if($_SESSION['status'] != "login"){ 
    header("location:../login.php"); 
    exit(); 
}

// PENTING: Naik satu level (../) untuk menemukan koneksi.php
include ('../koneksi.php');
$db = new database();

$id_supplier = $_GET['id_supplier'];
// Panggil fungsi tampil_edit_data_supplier dari koneksi.php
$data_edit_supplier = $db->tampil_edit_data_supplier($id_supplier); 
?>
<!DOCTYPE html>
<html>
<head><title>Edit Supplier</title></head>
<body>
    <h3>Form Edit Data Supplier</h3>
    <hr>
    <?php foreach($data_edit_supplier as $d): ?>
    
    <form method="post" action="proses.php?action=edit&id_supplier=<?php echo $d['id_supplier']; ?>">
    <table>
        <tr>
            <td>ID Supplier</td><td>:</td>
            <td>
                <input type="hidden" name="id_supplier" value="<?php echo $d['id_supplier']; ?>">
                <input type="text" value="<?php echo $d['id_supplier']; ?>" readonly>
            </td>
        </tr>
        <tr><td>Nama Supplier</td><td>:</td>
            <td><input type="text" name="nama_supplier" value="<?php echo $d['nama_supplier']; ?>" required></td>
        </tr>
        <tr><td>Alamat</td><td>:</td>
            <td><textarea name="alamat_supplier" required><?php echo $d['alamat_supplier']; ?></textarea></td>
        </tr>
        <tr><td>Telepon</td><td>:</td><td><input type="text" name="telepon_supplier" value="<?php echo $d['telepon_supplier']; ?>"></td></tr>
        <tr><td>Email</td><td>:</td><td><input type="email" name="email_supplier" value="<?php echo $d['email_supplier']; ?>" required></td></tr>
        <tr><td>Password</td><td>:</td><td><input type="password" name="pass_supplier" value="<?php echo $d['pass_supplier']; ?>" required></td></tr>
        <tr><td></td><td></td>
            <td>
                <input type="submit" value="Ubah">
                <a href="../index.php?modul=supplier"><input type="button" value="Kembali"></a>
            </td>
        </tr>
    </table>
    </form>
    <?php endforeach; ?>
</body>
</html>