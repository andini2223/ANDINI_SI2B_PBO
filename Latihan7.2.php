<?php
class manusia{
    //prop
    private $nama="Ardi";
    private $kelas = "SI 2";

    //method manusia
    private function m_nama(){
        return $this->nama;
    }

    public function tampilkan_nama(){
        return $this->m_nama();
    }

    function tampilkan_kelas(){
        return $this->kelas;
    }
}

//instansiasi class manusia
$manusia = new manusia();

//memanggil method tampilkan_nama dari class manusia
echo "Nama : " . $manusia->tampilkan_nama() . "<br />";
echo "Kelas : " . $manusia->tampilkan_kelas();
?>