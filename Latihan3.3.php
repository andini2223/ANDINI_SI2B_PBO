<?php

// akses properties
class Kendaraan {
  var $JumlahRoda;
  var $warna;
  var $BahanBakar;
  var $harga;
  var $merek;
  var $TahunPembuatan;

  function setMerek($x) {
    $this->merek = $x;
  }

  function getMerek() {
    return $this->merek;
  }

  function setHarga($y) {
    $this->harga = $y;
  }

  function getHarga() {
    return $this->harga;
  }
}

$kendaraan1 = new Kendaraan();
$kendaraan1->setMerek('Yamaha Mio');
$kendaraan1->setHarga(10000000);

echo $kendaraan1->getMerek();
echo "<br>";
echo $kendaraan1->getHarga();

?>