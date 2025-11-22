
<?php
/**
 * Class database
 * Menangani koneksi ke database dan operasi CRUD untuk tabel tb_barang dan user.
 */
class database {

    // Konfigurasi Database
    var $host = "localhost";
    var $username = "root";
    var $password = ""; 
    var $database = "belajar_oop3";
    var $koneksi;

    /**
     * Constructor.
     * Membuat koneksi ke database saat objek diinisialisasi.
     */
    function __construct() {
        $this->koneksi = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        if (mysqli_connect_error()) {
            echo "Koneksi database gagal : " . mysqli_connect_error();
        }
    }

    // -----------------------------------------------
    // --- FUNGSI AUTOGENERATE KODE BARANG
    // -----------------------------------------------
    
    /**
     * Menghasilkan kode barang otomatis (contoh: BRG001, BRG002).
     * @return string Kode barang baru.
     */
    public function kode_barang() {
        $query = "SELECT MAX(kd_barang) AS kode_terakhir FROM tb_barang";
        
        $data = mysqli_query($this->koneksi, $query); 
        $hasil = mysqli_fetch_array($data);
        $kode_terakhir = $hasil['kode_terakhir'];

        if ($kode_terakhir) {
            // Ambil angka urutan dari 3 karakter terakhir
            $urutan = (int) substr($kode_terakhir, 3); 
            $urutan++;
        } else {
            $urutan = 1;
        }

        // Format angka urutan menjadi 3 digit (contoh: 001)
        $kode_baru = 'BRG' . str_pad($urutan, 3, '0', STR_PAD_LEFT);
        return $kode_baru;
    }

    // -----------------------------------------------
    // --- FUNGSI PAGINATION
    // -----------------------------------------------

    /**
     * Menghitung jumlah total data barang, opsional dengan filter pencarian.
     * @param string $keyword Kata kunci pencarian.
     * @return int Jumlah total data.
     */
    function jumlah_total_data($keyword = '') {
        $query = "SELECT COUNT(*) AS total FROM tb_barang";
        if (!empty($keyword)) {
            $keyword = $this->koneksi->real_escape_string($keyword);
            $query .= " WHERE kd_barang LIKE '%$keyword%' OR nama_barang LIKE '%$keyword%'";
        }
        $result = mysqli_query($this->koneksi, $query);
        $row = mysqli_fetch_assoc($result);
        return (int) $row['total'];
    }

    /**
     * Mengambil data barang dengan batasan (LIMIT) untuk pagination.
     * @param int $mulai Index awal data yang diambil (offset).
     * @param int $data_per_halaman Jumlah data per halaman (limit).
     * @return array Daftar data barang.
     */
    function tampil_data_paginated($mulai, $data_per_halaman) {
        $query = "SELECT * FROM tb_barang LIMIT $mulai, $data_per_halaman";
        $data = mysqli_query($this->koneksi, $query);
        $hasil = [];
        while ($row = mysqli_fetch_assoc($data)) {
            $hasil[] = $row;
        }
        return $hasil;
    }

    // -----------------------------------------------
    // --- FUNGSI CRUD BARANG
    // -----------------------------------------------
    
    /**
     * Mengambil semua data barang (tidak digunakan untuk pagination).
     * @return array Semua data barang.
     */
    function tampil_data() {
        $data = mysqli_query($this->koneksi, "SELECT * FROM tb_barang");
        $hasil = [];
        while ($row = mysqli_fetch_array($data)) {
            $hasil[] = $row;
        }
        return $hasil;
    }
    
    /**
     * Mencari data barang berdasarkan keyword (dengan atau tanpa limit untuk pagination).
     * @param string $keyword Kata kunci pencarian.
     * @param int $mulai Index awal data yang diambil (offset).
     * @param int $data_per_halaman Jumlah data per halaman (limit).
     * @return array Hasil data barang yang dicari.
     */
    function cari_data($keyword, $mulai = 0, $data_per_halaman = 0) {
        $keyword = $this->koneksi->real_escape_string($keyword);
        $query = "SELECT * FROM tb_barang 
                  WHERE kd_barang LIKE '%$keyword%' 
                  OR nama_barang LIKE '%$keyword%'";
    
        if ($data_per_halaman > 0) {
            $query .= " LIMIT $mulai, $data_per_halaman";
        }
    
        $data = mysqli_query($this->koneksi, $query);
    
        $hasil = [];
        while ($row = mysqli_fetch_assoc($data)) { 
            $hasil[] = $row;
        }
        return $hasil;
    }

    /**
     * Menambah data barang baru ke database, termasuk unggah gambar.
     */
    function tambah_data($kd_barang, $nama_barang, $stok, $harga_beli, $harga_jual, $gambar_produk) {
        $kd_barang = $this->koneksi->real_escape_string($kd_barang);
        $nama_barang = $this->koneksi->real_escape_string($nama_barang);
        
        $gambar_produk_nama = $_FILES['gambar_produk']['name'] ?? ''; // Menggunakan null coalescing untuk menghindari warning jika $_FILES kosong
        
        // Cek apakah ada file yang diunggah
        if (!empty($gambar_produk_nama) && $_FILES['gambar_produk']['error'] !== UPLOAD_ERR_NO_FILE) {
            
            $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
            $x = explode('.', $gambar_produk_nama); 
            $ekstensi = strtolower(end($x));
            
            $file_tmp = $_FILES['gambar_produk']['tmp_name'];
            
            $angka_acak = rand(1, 999);
            $nama_gambar_baru = $angka_acak . '-' . $gambar_produk_nama;

            if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                
                if (move_uploaded_file($file_tmp, 'gambar/' . $nama_gambar_baru)) {
                    $query = "INSERT INTO tb_barang (kd_barang, nama_barang, stok, harga_beli, harga_jual, gambar_produk) 
                              VALUES ('$kd_barang', '$nama_barang', '$stok', '$harga_beli', '$harga_jual', '$nama_gambar_baru')";
                    $result = mysqli_query($this->koneksi, $query);

                    if (!$result) {
                        die ("Query gagal dijalankan: " . mysqli_errno($this->koneksi) . " - " . mysqli_error($this->koneksi));
                    } else {
                        echo "<script>alert('Data berhasil ditambah.'); window.location='tampil.php';</script>";
                    }
                } else {
                    echo "<script>alert('Gagal mengunggah file. Pastikan folder 'gambar/' memiliki permission yang benar.'); window.location='tambah_data.php';</script>";
                }
            } else {
                echo "<script>alert('Ekstensi gambar yang boleh hanya jpg, jpeg atau png.'); window.location='tambah_data.php';</script>";
            }
        } else {
            // Jika tidak ada file diunggah
            $query = "INSERT INTO tb_barang (kd_barang, nama_barang, stok, harga_beli, harga_jual, gambar_produk) 
                      VALUES ('$kd_barang', '$nama_barang', '$stok', '$harga_beli', '$harga_jual', '')";
            $result = mysqli_query($this->koneksi, $query);

            if (!$result) {
                die ("Query gagal dijalankan: " . mysqli_errno($this->koneksi) . " - " . mysqli_error($this->koneksi));
            } else {
                echo "<script>alert('Data berhasil ditambah.'); window.location='tampil.php';</script>";
            }
        }
    }
        
    /**
     * Mengambil data barang tunggal untuk proses edit.
     * @param int $id_barang ID barang yang akan diedit.
     * @return array Data barang tunggal.
     */
    function tampil_edit_data($id_barang) {
        $data = mysqli_query($this->koneksi, "SELECT * FROM tb_barang WHERE id_barang='$id_barang'");
        $hasil = [];
        while ($d = mysqli_fetch_array($data)) {
            $hasil[] = $d;
        }
        return $hasil;
    }

    /**
     * Mengubah data barang yang sudah ada, termasuk unggah/update gambar.
     */
    function edit_data($id_barang, $nama_barang, $stok, $harga_beli, $harga_jual, $gambar_produk) {
        $nama_barang = $this->koneksi->real_escape_string($nama_barang);
        $id_barang = $this->koneksi->real_escape_string($id_barang);

        $gambar_produk_nama = $_FILES['gambar_produk']['name'] ?? '';

        if (!empty($gambar_produk_nama)) {
            $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
            $x = explode('.', $gambar_produk_nama); 
            $ekstensi = strtolower(end($x));
            $file_tmp = $_FILES['gambar_produk']['tmp_name'];
            $angka_acak = rand(1, 999);
            $nama_gambar_baru = $angka_acak . '-' . $gambar_produk_nama;

            if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                move_uploaded_file($file_tmp, 'gambar/' . $nama_gambar_baru);
                
                $query = "UPDATE tb_barang SET nama_barang='$nama_barang', stok='$stok', harga_beli='$harga_beli', harga_jual='$harga_jual', gambar_produk='$nama_gambar_baru' WHERE id_barang='$id_barang'";
                $result = mysqli_query($this->koneksi, $query);

                if (!$result) {
                    die ("Query gagal dijalankan: " . mysqli_errno($this->koneksi) . " - " . mysqli_error($this->koneksi));
                } else {
                    echo "<script>alert('Data berhasil diubah.'); window.location='tampil.php';</script>";
                }
            } else {
                echo "<script>alert('Ekstensi gambar yang boleh hanya jpg, jpeg atau png.'); window.location='edit_data.php?id_barang=$id_barang';</script>";
            }
        } else {
            // Jika gambar tidak diupdate
            $query = "UPDATE tb_barang SET nama_barang='$nama_barang', stok='$stok', harga_beli='$harga_beli', harga_jual='$harga_jual' WHERE id_barang='$id_barang'";
            $result = mysqli_query($this->koneksi, $query);

            if (!$result) {
                die ("Query gagal dijalankan: " . mysqli_errno($this->koneksi) . " - " . mysqli_error($this->koneksi));
            } else {
                echo "<script>alert('Data berhasil diubah.'); window.location='tampil.php';</script>";
            }
        }
    }

    /**
     * Menghapus data barang.
     * @param int $id_barang ID barang yang akan dihapus.
     */
    public function delete_data($id_barang) {
        $id_barang = $this->koneksi->real_escape_string($id_barang);
        
        $query = "DELETE FROM tb_barang WHERE id_barang='$id_barang'";
        $result = mysqli_query($this->koneksi, $query);

        if (!$result) {
            die ("Query gagal dijalankan: " . mysqli_errno($this->koneksi) . " - " . mysqli_error($this->koneksi));
        } else {
            echo "<script>alert('Data berhasil dihapus.'); window.location='tampil.php';</script>";
        }
    }

    // -----------------------------------------------
    // --- FUNGSI CRUD USER
    // -----------------------------------------------
    
    /**
     * Mengambil semua data user.
     * @return array Daftar data user.
     */
    function tampil_user() {
        $data = mysqli_query($this->koneksi, "SELECT * FROM user");
        $hasil = [];
        while ($row = mysqli_fetch_array($data)) {
            $hasil[] = $row;
        }
        return $hasil;
    }
    
    /**
     * Menghapus data user.
     * @param int $id ID user yang akan dihapus.
     */
    function delete_user($id) {
        mysqli_query($this->koneksi, "DELETE FROM user WHERE id='$id'");
        header('location:tampil_pengguna.php'); 
    }
    
    // -----------------------------------------------
    // --- FUNGSI LOGIN DAN LOGOUT
    // -----------------------------------------------
    
    /**
     * Memproses login user.
     * @param string $username Username yang dimasukkan.
     * @param string $password Password yang dimasukkan.
     */
    function login($username, $password) {
        // Sanitisasi input untuk keamanan
        $username = $this->koneksi->real_escape_string($username);
        $password = $this->koneksi->real_escape_string($password);
        
        $data = mysqli_query($this->koneksi, "SELECT * FROM user WHERE username='$username' AND password='$password'");
        $cek = mysqli_num_rows($data);
        
        if ($cek > 0) {
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['status'] = "login";
            header("location:tampil.php");
        } else {
            header("location:index.php?pesan=gagal");
        }
    }
    
    /**
     * Memproses logout user.
     */
    function logout() {
        session_start();
        session_destroy();
        header("location:index.php?pesan=logout");
    }
}
?>