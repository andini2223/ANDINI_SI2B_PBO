<?php
session_start();

class database
{
    var $Host = "localhost";
    var $Username = "root";
    var $Password = "";
    var $Database = "belajar_oop";
    var $koneksi;

    function __construct()
    {
        $this->koneksi = mysqli_connect($this->Host, $this->Username, $this->Password, $this->Database);
        if (mysqli_connect_errno()) {
            echo "Koneksi database gagal : " . mysqli_connect_error();
        }
    }

    // LOGIN
    function login($username, $password)
    {
        if ($username == "admin" && $password == "admin") {
            $_SESSION['username'] = $username;
            return true;
        } else {
            return false;
        }
    }

    // LOGOUT
    function logout()
    {
        session_destroy();
        header("Location: index.php");
        exit;
    }

    // CEK LOGIN
    function cek_login()
    {
        if (!isset($_SESSION['username'])) {
            header("Location: index.php");
            exit;
        }
    }

    // CRUD
    function tampil_data()
    {
        $data = mysqli_query($this->koneksi, "SELECT * FROM tb_barang");
        while ($d = mysqli_fetch_array($data)) {
            $hasil[] = $d;
        }
        return $hasil ?? [];
    }

    function tambah_data($nama_barang, $stok, $harga_beli, $harga_jual)
    {
        mysqli_query($this->koneksi, "INSERT INTO tb_barang VALUES('', '$nama_barang', '$stok', '$harga_beli', '$harga_jual')");
    }

    function tampil_edit($id_barang)
    {
        $data = mysqli_query($this->koneksi, "SELECT * FROM tb_barang WHERE id_barang='$id_barang'");
        while ($d = mysqli_fetch_array($data)) {
            $hasil[] = $d;
        }
        return $hasil ?? [];
    }

    function edit_data($id_barang, $nama_barang, $stok, $harga_beli, $harga_jual)
    {
        mysqli_query($this->koneksi, "UPDATE tb_barang SET nama_barang='$nama_barang', stok='$stok', harga_beli='$harga_beli', harga_jual='$harga_jual' WHERE id_barang='$id_barang'");
    }

    function delete_data($id_barang)
    {
        mysqli_query($this->koneksi, "DELETE FROM tb_barang WHERE id_barang='$id_barang'");
    }

    function cari_data($nama_barang)
    {
        $data = mysqli_query($this->koneksi, "SELECT * FROM tb_barang WHERE nama_barang LIKE '%$nama_barang%'");
        while ($d = mysqli_fetch_array($data)) {
            $hasil[] = $d;
        }
        return $hasil ?? [];
    }
}
?>
