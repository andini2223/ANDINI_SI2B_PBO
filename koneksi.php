<?php
class database{

    var $host = "localhost";
    var $username = "root";
    var $password = ""; 
    var $database = "belajar_oop3";
    var $koneksi;

    function __construct(){
        $this->koneksi = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        if(mysqli_connect_error()){
            echo "Koneksi database gagal : " . mysqli_connect_error();
        }
    }

    // --- FUNGSI CRUD BARANG (TIDAK BERUBAH) ---
    function tampil_data(){
        $data = mysqli_query($this->koneksi, "select * from tb_barang");
        $hasil = [];
        while($row = mysqli_fetch_array($data)){
            $hasil[] = $row;
        }
        return $hasil;
    }
    
    function cari_data($keyword){
        $keyword = $this->koneksi->real_escape_string($keyword);
        $query = "SELECT * FROM tb_barang WHERE kd_barang LIKE '%$keyword%'";
        $data = mysqli_query($this->koneksi, $query);
        
        $hasil = [];
        while($row = mysqli_fetch_array($data)){ 
            $hasil[] = $row;
        }
        return $hasil;
    }

    function tambah_data($kd_barang, $nama_barang, $stok, $harga_beli, $harga_jual, $gambar_produk){
        // ... (Kode untuk tambah data) ...
        $kd_barang = $this->koneksi->real_escape_string($kd_barang);
        $nama_barang = $this->koneksi->real_escape_string($nama_barang);
        
        if($gambar_produk != "") {
            $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
            $x = explode('.', $gambar_produk); 
            $ekstensi = strtolower(end($x));
            $file_tmp = $_FILES['gambar_produk']['tmp_name'];
            $angka_acak = rand(1, 999);
            $nama_gambar_baru = $angka_acak . '-' . $gambar_produk;

            if(in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                move_uploaded_file($file_tmp, 'gambar/'. $nama_gambar_baru);

                $query = "INSERT INTO tb_barang (kd_barang, nama_barang, stok, harga_beli, harga_jual, gambar_produk) VALUES ('$kd_barang', '$nama_barang', '$stok', '$harga_beli', '$harga_jual', '$nama_gambar_baru')";
                $result = mysqli_query($this->koneksi, $query);

                if(!$result){
                    die ("Query gagal dijalankan: " . mysqli_errno($this->koneksi) . " - " . mysqli_error($this->koneksi));
                } else {
                    echo "<script>alert('Data berhasil ditambah.'); window.location='tampil.php';</script>";
                }
            } else {
                echo "<script>alert('Ekstensi gambar yang boleh hanya jpg, jpeg atau png.'); window.location='tambah_data.php';</script>";
            }
        } else {
            $query = "INSERT INTO tb_barang (kd_barang, nama_barang, stok, harga_beli, harga_jual, gambar_produk) VALUES ('$kd_barang', '$nama_barang', '$stok', '$harga_beli', '$harga_jual', '')";
            $result = mysqli_query($this->koneksi, $query);

            if(!$result){
                die ("Query gagal dijalankan: " . mysqli_errno($this->koneksi) . " - " . mysqli_error($this->koneksi));
            } else {
                echo "<script>alert('Data berhasil ditambah.'); window.location='tampil.php';</script>";
            }
        }
    }
    
    function tampil_edit_data($id_barang){
        $data = mysqli_query($this->koneksi, "select * from tb_barang where id_barang='$id_barang'");
        $hasil = [];
        while($d = mysqli_fetch_array($data)){
            $hasil[] = $d;
        }
        return $hasil;
    }

    function edit_data($id_barang, $nama_barang, $stok, $harga_beli, $harga_jual, $gambar_produk){
        // ... (Kode untuk edit data) ...
        $nama_barang = $this->koneksi->real_escape_string($nama_barang);
        $id_barang = $this->koneksi->real_escape_string($id_barang);

        if($gambar_produk != "") {
            $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
            $x = explode('.', $gambar_produk); 
            $ekstensi = strtolower(end($x));
            $file_tmp = $_FILES['gambar_produk']['tmp_name'];
            $angka_acak = rand(1, 999);
            $nama_gambar_baru = $angka_acak . '-' . $gambar_produk;

            if(in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                move_uploaded_file($file_tmp, 'gambar/'. $nama_gambar_baru);
                
                $query = "UPDATE tb_barang SET nama_barang='$nama_barang', stok='$stok', harga_beli='$harga_beli', harga_jual='$harga_jual', gambar_produk='$nama_gambar_baru' WHERE id_barang='$id_barang'";
                $result = mysqli_query($this->koneksi, $query);

                if(!$result){
                    die ("Query gagal dijalankan: " . mysqli_errno($this->koneksi) . " - " . mysqli_error($this->koneksi));
                } else {
                    echo "<script>alert('Data berhasil diubah.'); window.location='tampil.php';</script>";
                }
            } else {
                echo "<script>alert('Ekstensi gambar yang boleh hanya jpg, jpeg atau png.'); window.location='edit_data.php?id_barang=$id_barang';</script>";
            }
        } else {
            $query = "UPDATE tb_barang SET nama_barang='$nama_barang', stok='$stok', harga_beli='$harga_beli', harga_jual='$harga_jual' WHERE id_barang='$id_barang'";
            $result = mysqli_query($this->koneksi, $query);

            if(!$result){
                die ("Query gagal dijalankan: " . mysqli_errno($this->koneksi) . " - " . mysqli_error($this->koneksi));
            } else {
                echo "<script>alert('Data berhasil diubah.'); window.location='tampil.php';</script>";
            }
        }
    }

    function delete_data($id_barang){
        mysqli_query($this->koneksi, "delete from tb_barang where id_barang='$id_barang'");
    }

    // --- FUNGSI CRUD USER (DIPERLUKAN UNTUK tampil_pengguna.php) ---
    function tampil_user(){
        $data = mysqli_query($this->koneksi, "select * from user");
        $hasil = [];
        while($row = mysqli_fetch_array($data)){
            $hasil[] = $row;
        }
        return $hasil;
    }
    
    function delete_user($id){
        mysqli_query($this->koneksi, "delete from user where id='$id'");
        header('location:tampil_pengguna.php'); 
    }
    
    // ===============================================
    // --- FUNGSI LOGIN DAN LOGOUT (YANG DIMINTA) ---
    // ===============================================
    
    /**
     * Menangani proses login user.
     */
    function login($username, $password){
        // Sanitisasi input untuk keamanan
        $username = $this->koneksi->real_escape_string($username);
        $password = $this->koneksi->real_escape_string($password);
        
        // Cari user di tabel 'user'
        $data = mysqli_query($this->koneksi, "SELECT * FROM user WHERE username='$username' AND password='$password'");
        $cek = mysqli_num_rows($data);
        
        if($cek > 0){
            // Jika user ditemukan, mulai sesi dan set status login
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['status'] = "login";
            header("location:tampil.php"); // Arahkan ke halaman utama
        } else {
            // Jika login gagal
            header("location:index.php?pesan=gagal");
        }
    }
    
    /**
     * Menangani proses logout user.
     */
    function logout(){
        session_start();
        session_destroy(); // Menghancurkan semua sesi
        header("location:index.php?pesan=logout"); // Arahkan kembali ke halaman login
    }
}
?>