<?php
// File: cetak_supplier.php (Diletakkan di ROOT folder)
session_start();
include ('../koneksi.php');
$db = new database();

// Cek hak akses
if($_SESSION['status'] != "login"){ 
    header("location:login.php"); 
    exit(); 
}

$data_supplier = $db->tampil_data_supplier();

// Panggil dialog Print secara otomatis
echo "<script>window.print();</script>";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Supplier</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h3 { text-align: center; }
        table { width: 95%; border-collapse: collapse; margin: 20px auto; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; font-size: 12px; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h3>LAPORAN DATA SUPPLIER</h3>
    <hr>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID Supplier</th>
                <th>Nama Supplier</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            if (!empty($data_supplier)) {
                foreach($data_supplier as $row){
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $row['id_supplier']; ?></td>
                <td><?php echo $row['nama_supplier']; ?></td>
                <td><?php echo $row['alamat_supplier']; ?></td>
                <td><?php echo $row['telepon_supplier']; ?></td>
                <td><?php echo $row['email_supplier']; ?></td>
            </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='6' style='text-align:center;'>Data supplier tidak tersedia.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="../index.php">
    <input type="submit" name="tombol" value="Kembali"></a>
</body>
</html>