<?php
// File: cetak_customer.php 

session_start();
// KOREKSI JALUR: koneksi.php ada di folder yang sama (ROOT)
include ('../koneksi.php'); 
$db = new database();

if($_SESSION['status'] != "login"){ 
    header("location:login.php"); 
    exit(); 
}

$data_customer = $db->tampil_data_customer();

// Panggil dialog Print secara otomatis
echo "<script>window.print();</script>";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Customer</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h3 { text-align: center; }
        table { width: 95%; border-collapse: collapse; margin: 20px auto; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; font-size: 12px; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h3>LAPORAN DATA CUSTOMER</h3>
    <hr>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID Customer</th>
                <th>NIK</th>
                <th>Nama Customer</th>
                <th>Jenis Kelamin</th>
                <th>Telepon</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            if (!empty($data_customer)) {
                foreach($data_customer as $row){
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $row['id_customer']; ?></td>
                <td><?php echo $row['nik_customer']; ?></td>
                <td><?php echo $row['nama_customer']; ?></td>
                <td><?php echo $row['jenis_kelamin']; ?></td>
                <td><?php echo $row['telepon_customer']; ?></td>
                <td><?php echo $row['email_customer']; ?></td>
            </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='7' style='text-align:center;'>Data customer tidak tersedia.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="../index.php">
    <input type="submit" name="tombol" value="Kembali"></a>
</body>
</html>