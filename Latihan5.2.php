<?php

class manusia {
    public $nama;
    public $umur;
    public $gender;

    function bicara(){
        echo "Selamat Datang";
    }

    function getInfo(){
        echo "Nama: " . $this->nama . "<br>";
        echo "Umur: " . $this->umur . "<br>";
        echo "JK: " . $this->gender . "<br>";
    }
}

class ayah extends manusia {
    function pekerjaan(){
        echo "Pegawai Negeri Sipil";
    }
}

class ibu extends manusia {
    function pekerjaan(){
        echo "Ibu Rumah Tangga";
    }
}

class anak extends manusia {
    function pekerjaan(){
        echo "Pelajar";
    }
}

// Objek Ayah
$objekAyah = new ayah();
$objekAyah->nama = "Budi";
$objekAyah->gender = "Laki-Laki";
$objekAyah->umur = "45";
echo "<b>Info Ayah</b><br>";
$objekAyah->getInfo();
$objekAyah->pekerjaan();

// Objek Ibu
$objekIbu = new ibu();
$objekIbu->nama = "Dini";
$objekIbu->gender = "Perempuan";
$objekIbu->umur = "38";
echo "<br><b>Info Ibu</b><br>";
$objekIbu->getInfo();
$objekIbu->pekerjaan();

// Objek Anak
$objekAnak = new anak();
$objekAnak->nama = "Ardi";
$objekAnak->gender = "Laki-Laki";
$objekAnak->umur = "15";
echo "<br><b>Info Anak</b><br>";
$objekAnak->getInfo();
$objekAnak->pekerjaan();

?>