<?php
class database {
    var $host = "localhost";
    var $username = "root";
    var $password = "";
    var $database = "belajar_oop";
    var $koneksi = "";

    function __construct(){
        $this->koneksi = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        if (mysqli_connect_error()){
            die("Koneksi database gagal : " . mysqli_connect_error());
        }
    }

    // ==========================================================
    // FUNGSI LOGIN
    // ==========================================================
    function cek_login($username, $password){
        $user_aman = mysqli_real_escape_string($this->koneksi, $username);
        $pass_aman = mysqli_real_escape_string($this->koneksi, $password);
        $query = "SELECT * FROM user WHERE username='$user_aman' AND password='$pass_aman'";
        $data = mysqli_query($this->koneksi, $query);
        return mysqli_fetch_assoc($data);
    }

    // ==========================================================
    // FUNGSI BARANG (CRUD & PENCARIAN)
    // ==========================================================
    function tampil_data($cari = ""){ 
        $query_sql = "SELECT * FROM tb_barang";
        if(!empty($cari)){
            $cari_aman = mysqli_real_escape_string($this->koneksi, $cari);
            $query_sql = "SELECT * FROM tb_barang WHERE nama_barang LIKE '%$cari_aman%' OR kd_barang LIKE '%$cari_aman%'";
        }
        $data = mysqli_query($this->koneksi, $query_sql);
        $hasil = [];
        while ($row = mysqli_fetch_array($data)){ $hasil[] = $row; }
        return $hasil;
    }
    
    function tampil_data_per_kode($kd_barang){
        $kd_barang_aman = mysqli_real_escape_string($this->koneksi, $kd_barang);
        $data = mysqli_query($this->koneksi, "SELECT * FROM tb_barang WHERE kd_barang = '$kd_barang_aman'");
        return mysqli_fetch_assoc($data);
    }
    
    function tambah_data($id_barang, $nama_barang, $stok, $harga_beli, $harga_jual){
        mysqli_query($this->koneksi, "insert into tb_barang values ('', '$id_barang', '$nama_barang', '$stok', '$harga_beli', '$harga_jual')");
    }
    
    function tampil_edit_data($id_barang){
        $data = mysqli_query($this->koneksi, "select * from tb_barang where id_barang='$id_barang'");
        $hasil = [];
        while ($d = mysqli_fetch_array($data)){ $hasil[] = $d; }
        return $hasil;
    }

    function edit_data($id_barang, $nama_barang, $stok, $harga_beli, $harga_jual){
        mysqli_query($this->koneksi, "update tb_barang set nama_barang='$nama_barang', stok='$stok', harga_beli='$harga_beli', harga_jual='$harga_jual' where id_barang='$id_barang'");
    }

    function delete_data($id_barang){
        mysqli_query($this->koneksi, "delete from tb_barang where id_barang='$id_barang'");
    }

    // ==========================================================
    // FUNGSI CUSTOMER (CRUD & PENCARIAN)
    // ==========================================================
    function kode_customer(){
        $data = mysqli_query($this->koneksi, "SELECT MAX(id_customer) AS max_kode FROM tb_customer");
        $row = mysqli_fetch_assoc($data);
        $max_kode = $row['max_kode'];
        $next_number = empty($max_kode) ? 1 : (int) substr($max_kode, 2) + 1;
        return 'CS' . str_pad($next_number, 3, '0', STR_PAD_LEFT);
    }

    function tampil_data_customer($cari = ""){ // MENDUKUNG PENCARIAN CUSTOMER
        $query_sql = "SELECT * FROM tb_customer";
        if(!empty($cari)){
            $cari_aman = mysqli_real_escape_string($this->koneksi, $cari);
            $query_sql = "SELECT * FROM tb_customer 
                          WHERE nama_customer LIKE '%$cari_aman%' 
                          OR NIK_customer LIKE '%$cari_aman%'
                          OR email_customer LIKE '%$cari_aman%'";
        }
        $data = mysqli_query($this->koneksi, $query_sql);
        $hasil = [];
        while ($row = mysqli_fetch_array($data)){ $hasil[] = $row; }
        return $hasil;
    }

    function tambah_data_customer($nik, $nama, $jk, $alamat, $telp, $email, $pass){
        $formatted_id = $this->kode_customer();
        $query = "INSERT INTO tb_customer (id_customer, nik_customer, nama_customer, jenis_kelamin, alamat_customer, telepon_customer, email_customer, pass_customer) 
                  VALUES ('$formatted_id', '$nik', '$nama', '$jk', '$alamat', '$telp', '$email', '$pass')";
        mysqli_query($this->koneksi, $query);
    }
    
    function tampil_edit_data_customer($id){
        $id_aman = mysqli_real_escape_string($this->koneksi, $id);
        $data = mysqli_query($this->koneksi, "SELECT * FROM tb_customer WHERE id_customer='$id_aman'");
        $hasil = [];
        while ($d = mysqli_fetch_array($data)){ $hasil[] = $d; }
        return $hasil;
    }
    
    function edit_data_customer($id, $nik, $nama, $jk, $alamat, $telp, $email, $pass){
        $id_aman = mysqli_real_escape_string($this->koneksi, $id);
        $query = "UPDATE tb_customer SET NIK_customer='$nik', nama_customer='$nama', jenis_kelamin='$jk', alamat_customer='$alamat', telepon_customer='$telp', email_customer='$email', pass_customer='$pass' WHERE id_customer='$id_aman'";
        mysqli_query($this->koneksi, $query);
    }

    function delete_data_customer($id){
        $id_aman = mysqli_real_escape_string($this->koneksi, $id);
        mysqli_query($this->koneksi, "DELETE FROM tb_customer WHERE id_customer='$id_aman'");
    }
    
    // ==========================================================
    // FUNGSI SUPPLIER (CRUD & PENCARIAN)
    // ==========================================================
    function kode_supplier(){
        $data = mysqli_query($this->koneksi, "SELECT MAX(id_supplier) AS max_kode FROM tb_supplier");
        $row = mysqli_fetch_assoc($data);
        $max_kode = $row['max_kode'];
        $next_number = empty($max_kode) ? 1 : (int) substr($max_kode, 2) + 1;
        return 'SP' . str_pad($next_number, 3, '0', STR_PAD_LEFT);
    }
    
    function tampil_data_supplier($cari = ""){ // MENDUKUNG PENCARIAN SUPPLIER
        $query_sql = "SELECT * FROM tb_supplier";
        if(!empty($cari)){
            $cari_aman = mysqli_real_escape_string($this->koneksi, $cari);
            $query_sql = "SELECT * FROM tb_supplier 
                          WHERE nama_supplier LIKE '%$cari_aman%' 
                          OR email_supplier LIKE '%$cari_aman%'";
        }
        $data = mysqli_query($this->koneksi, $query_sql);
        $hasil = [];
        while ($row = mysqli_fetch_array($data)){ $hasil[] = $row; }
        return $hasil;
    }

    function tambah_data_supplier($nama, $alamat, $telp, $email, $pass){
        $formatted_id = $this->kode_supplier();
        $query = "INSERT INTO tb_supplier (id_supplier, nama_supplier, alamat_supplier, telepon_supplier, email_supplier, pass_supplier) 
                  VALUES ('$formatted_id', '$nama', '$alamat', '$telp', '$email', '$pass')";
        mysqli_query($this->koneksi, $query);
    }
    
    function tampil_edit_data_supplier($id){
        $id_aman = mysqli_real_escape_string($this->koneksi, $id);
        $data = mysqli_query($this->koneksi, "SELECT * FROM tb_supplier WHERE id_supplier='$id_aman'");
        $hasil = [];
        while ($d = mysqli_fetch_array($data)){ $hasil[] = $d; }
        return $hasil;
    }
    
    function edit_data_supplier($id, $nama, $alamat, $telp, $email, $pass){
        $id_aman = mysqli_real_escape_string($this->koneksi, $id);
        $query = "UPDATE tb_supplier SET nama_supplier='$nama', alamat_supplier='$alamat', telepon_supplier='$telp', email_supplier='$email', pass_supplier='$pass' WHERE id_supplier='$id_aman'";
        mysqli_query($this->koneksi, $query);
    }
    
    function delete_data_supplier($id){
        $id_aman = mysqli_real_escape_string($this->koneksi, $id);
        mysqli_query($this->koneksi, "DELETE FROM tb_supplier WHERE id_supplier='$id_aman'");
    }
    function kode_barang(){
    // Mengambil kode barang terbesar untuk membuat kode baru
    $data = mysqli_query($this->koneksi, "SELECT MAX(kd_barang) AS kd_barang FROM tb_barang");
    $hasil = [];
    while ($row = mysqli_fetch_array($data)){
        $hasil[] = $row;
        }
    return $hasil;
    }
}
?>