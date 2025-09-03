<?php

class kendaraan
{
    var $jumlahRoda;
    var $warna;
    var $bahanBakar;
    var $harga;
    var $merek;

    function setMerek ($x) {
        $this ->merek = $x;
    }
    function getMerek (){
        return $this ->merek;
    }
    
}

$kendaraan1 = new kendaraan();
$kendaraan1->setMerek('Yamaha MIO');

echo $kendaraan1->getMerek();

?>