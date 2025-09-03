<?php

  class Kendaraan {
    var $merek;
    var $jmlroda;
    var $harga;
    var $warna;
    var $bhnnbakar;
    var $tahun;

    function setMerek($x) {
      $this->merek = $x;
    }

    function setHarga($x) {
      $this->harga = $x;
    }

    function setJmlroda($x) {
      $this->jmlroda = $x;
    }

    function setwarna($x) {
      $this->warna = $x;
    }

    function setbhnnbakar($x) {
      $this->bhnnbakar = $x;
    }

    function setTahun($x) {
      $this->tahun = $x;
    }
  }

  $kendaraan1 = new Kendaraan();
  $kendaraan1->setMerek('Toyota Yaris');
  $kendaraan1->setJmlroda(4);
  $kendaraan1->setHarga(160000000);
  $kendaraan1->setwarna('Merah');
  $kendaraan1->setbhnnbakar('Premium');
  $kendaraan1->setTahun(2005);

  $kendaraan2 = new Kendaraan();
  $kendaraan2->setMerek('Honda Scoopy');
  $kendaraan2->setJmlroda(2);
  $kendaraan2->setHarga(13000000);
  $kendaraan2->setwarna('Putih');
  $kendaraan2->setbhnnbakar('Premium');
  $kendaraan2->setTahun(2004);

  $kendaraan3 = new Kendaraan();
  $kendaraan3->setMerek('Isuzu Panther');
  $kendaraan3->setJmlroda(4);
  $kendaraan3->setHarga(170000000);
  $kendaraan3->setwarna('Hitam');
  $kendaraan3->setbhnnbakar('Solar');
  $kendaraan3->setTahun(2003);

  echo $kendaraan1->merek;
  echo "<br>";
  echo $kendaraan1->jmlroda;
  echo "<br>";
  echo $kendaraan1->harga;
  echo "<br>";
  echo $kendaraan1->warna;
  echo "<br>";
  echo $kendaraan1->bhnnbakar;
  echo "<br>";
  echo $kendaraan1->tahun;
  echo "<br>";
  echo "<br>";

  echo $kendaraan2->merek;
  echo "<br>";
  echo $kendaraan2->jmlroda;
  echo "<br>";
  echo $kendaraan2->harga;
  echo "<br>";
  echo $kendaraan2->warna;
  echo "<br>";
  echo $kendaraan2->bhnnbakar;
  echo "<br>";
  echo $kendaraan2->tahun;
  echo "<br>";
  echo "<br>";

  echo $kendaraan3->merek;
  echo "<br>";
  echo $kendaraan3->jmlroda;
  echo "<br>";
  echo $kendaraan3->harga;
  echo "<br>";
  echo $kendaraan3->warna;
  echo "<br>";
  echo $kendaraan3->bhnnbakar;
  echo "<br>";
  echo $kendaraan3->tahun;
  echo "<br>";

?>