<?php
include('koneksi.php');
$db = new database();

// Memulai session dan memeriksa status login
session_start();
if($_SESSION['status'] != "login"){
    header("location:index.php?pesan=belum_login");
}

// Catatan: Fungsi tampil_user() harus sudah didefinisikan di koneksi.php
$data_user = $db->tampil_user(); 
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DATA PENGGUNA</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        /* Gaya tambahan spesifik untuk halaman ini jika diperlukan */
        .tombol_tambah_user {
            background-color: #28a745; /* Warna hijau */
        }
    </style>
</head>
<body>
    <a href="proses_barang.php?action=logout" class="tombol_logout">Keluar Aplikasi</a> 
    
    <h1>Data Pengguna</h1>
    
    <a href="tambah_user.php" class="tombol_tambah tombol_tambah_user">Tambah Pengguna</a> 
    <br/><br/>
    
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Password</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            if(!empty($data_user)) {
                foreach($data_user as $x){ 
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $x['username']; ?></td>
                    <td><?php echo $x['password']; ?></td>
                    <td>
                        <a href="edit_user.php?id=<?php echo $x['id']; ?>" class="tombol_edit">Edit</a>
                        <a href="proses_barang.php?id=<?php echo $x['id']; ?>&action=delete_user" onclick="return confirm('Yakin ingin menghapus pengguna ini?')" class="tombol_hapus">Hapus</a>
                    </td>
                </tr>
                <?php 
                }
            } else {
                echo "<tr><td colspan='4' style='text-align: center;'>Tidak ada data pengguna.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="tampil.php" class="tombol_reset">Kembali ke Data Barang</a>
</body>
</html>