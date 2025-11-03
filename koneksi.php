<?php

class database
{
    var $Host = "localhost";
    var $Username = "root";
    var $Password = "";
    var $Database = "belajar_oop";
    var $koneksi;

    function __construct()
    {
        $this->koneksi = mysqli_connect($this->Host,$this->Username,$this->Password,$this->Database);
        if(mysqli_connect_errno()){
            echo "Koneksi database gagal : " . mysqli_connect_error();
        }
    }

    function tampil_data()
    {
        $data = mysqli_query($this->koneksi,"select * from tb_barang");
        while($d = mysqli_fetch_array($data)){
            $hasil[] = $d;
        }
        return $hasil;
    }

    function tambah_data($nama_barang,$stok,$harga_beli,$harga_jual)
    {
        mysqli_query($this->koneksi,"insert into tb_barang values('','$nama_barang','$stok','$harga_beli','$harga_jual')");
    }

    function tampil_edit($id_barang)
    {
        $data = mysqli_query($this->koneksi,"select * from tb_barang where id_barang='$id_barang'");
        while($d = mysqli_fetch_array($data)){
            $hasil[] = $d;
        }
        return $hasil;
    }

    function edit_data($id_barang,$nama_barang,$stok,$harga_beli,$harga_jual)
    {
        mysqli_query($this->koneksi,"update tb_barang set nama_barang='$nama_barang',stok='$stok',harga_beli='$harga_beli',harga_jual='$harga_jual' where id_barang='$id_barang'");
    }

    function delete_data($id_barang)
    {
        mysqli_query($this->koneksi,"delete from tb_barang where id_barang='$id_barang'");
    }

    function cari_data($nama_barang)
    {
        $data = mysqli_query($this->koneksi,"select * from tb_barang where nama_barang='$nama_barang'");
        while($d = mysqli_fetch_array($data)){
            $hasil[] = $d;
        }
        return $hasil;
    }
}
?>