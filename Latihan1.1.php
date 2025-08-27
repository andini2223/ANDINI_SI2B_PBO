<?php
Class Mobil  {
    var $jumlahRoda=4;
    var $warna="Ungu";
    var $bahanBakar="Pertamax";
    var $harga=12000000;
    var $merek='A';

    public function getJumlahRoda(){
        return "$this->jumlahRoda";
    }

    public function statusHarga(){

    }
}


$object1 = new Mobil();
$object2 = new Mobil();
$object3 = new Mobil();

echo $object1->getJumlahRoda();
?>