<?php
// File: login.php (Menggabungkan Form dan Proses)

session_start();
include('koneksi.php');
$koneksi = new database();

// --- 1. CEK APAKAH SUDAH LOGIN ---
if(isset($_SESSION['status']) && $_SESSION['status'] == "login") {
    header('location:index.php'); // Redirect ke halaman utama jika sudah login
    exit();
}

$pesan = "";

// --- 2. CEK APAKAH ADA SUBMIT FORM (REQUEST METHOD POST) ---
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user_data = $koneksi->cek_login($username, $password);

    if($user_data){
        // Login berhasil
        $_SESSION['username'] = $user_data['username'];
        $_SESSION['tipe_user'] = $user_data['tipe_user'];
        $_SESSION['status'] = "login";
        header("location:index.php"); // Redirect ke index.php
        exit();
    } else {
        // Login gagal
        $pesan = "Login gagal! Cek username dan password.";
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Login System</title></head>
<body>
    <h2>Silahkan Login</h2>
    <?php 
    // Tampilkan pesan error jika ada (gagal login atau pesan dari URL)
    if (!empty($pesan)) {
        echo "<p style='color:red;'>$pesan</p>";
    } elseif (isset($_GET['pesan']) && $_GET['pesan'] == 'akses_ditolak') {
        echo "<p style='color:orange;'>Anda harus login untuk mengakses halaman tersebut.</p>";
    }
    ?>
    
    <form action="login.php" method="POST">
        Username: <input type="text" name="username" required><br><br>
        Password: <input type="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>