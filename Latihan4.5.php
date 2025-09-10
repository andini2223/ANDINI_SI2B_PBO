<?php
// Class Kendaraan
class Kendaraan {
    private $merek;
    private $jmlroda;
    private $harga;
    private $warna;
    private $bhnBakar;
    private $tahun;

    // ===== Setter (assignment properties) =====
    public function setMerek($m) { $this->merek = $m; }
    public function setJmlroda($r) { $this->jmlroda = $r; }
    public function setHarga($h) { $this->harga = $h; }
    public function setWarna($w) { $this->warna = $w; }
    public function setBhnBakar($b) { $this->bhnBakar = $b; }
    public function setTahun($t) { $this->tahun = $t; }

    // ===== Getter =====
    public function getMerek() { return $this->merek; }
    public function getJmlroda() { return $this->jmlroda; }
    public function getHarga() { return $this->harga; }
    public function getWarna() { return $this->warna; }
    public function getBhnBakar() { return $this->bhnBakar; }
    public function getTahun() { return $this->tahun; }

    // ===== Method tambahan =====
    public function statusHarga() {
        return ($this->harga > 50000000) ? "Mahal" : "Murah";
    }

    public function dapatSubsidi() {
        return ($this->bhnBakar == "Solar") ? "Dapat Subsidi" : "Tidak Dapat Subsidi";
    }

    public function hargaSecondKendaraan() {
        $usia = date("Y") - $this->tahun;
        $penyusutan = $this->harga - ($usia * 2000000);
        return "Harga Second: Rp " . number_format(max($penyusutan, 0), 0, ',', '.');
    }
}

// ===== Array data kendaraan =====
$Data1 = array('Toyota Yaris','4','160000000','Merah','Pertamax','2014');
$Data2 = array('Honda Scoopy','2','13000000','Putih','Premium','2005');
$Data3 = array('Isuzu Panther','4','40000000','Hitam','Solar','1994');

// ===== Pemetaan array ke objek =====
for($i = 1; $i <= 3; $i++) {
    ${"kendaraan$i"} = new Kendaraan();
    ${"kendaraan$i"}->setMerek(${ "Data$i"}[0]);
    ${"kendaraan$i"}->setJmlroda(${ "Data$i"}[1]);
    ${"kendaraan$i"}->setHarga(${ "Data$i"}[2]);
    ${"kendaraan$i"}->setWarna(${ "Data$i"}[3]);
    ${"kendaraan$i"}->setBhnBakar(${ "Data$i"}[4]);
    ${"kendaraan$i"}->setTahun(${ "Data$i"}[5]);
}

// ===== Menampilkan hasil perulangan =====
for($i = 1; $i <= 3; $i++) {
    echo "<b>Kendaraan $i</b><br>";
    echo "Merek : ".${"kendaraan$i"}->getMerek()."<br>";
    echo "Jumlah Roda : ".${"kendaraan$i"}->getJmlroda()."<br>";
    echo "Harga : Rp ".number_format(${"kendaraan$i"}->getHarga(),0,',','.')."<br>";
    echo "Warna : ".${"kendaraan$i"}->getWarna()."<br>";
    echo "Bahan Bakar : ".${"kendaraan$i"}->getBhnBakar()."<br>";
    echo "Tahun : ".${"kendaraan$i"}->getTahun()."<br>";
    echo "Status Harga : ".${"kendaraan$i"}->statusHarga()."<br>";
    echo "Subsidi : ".${"kendaraan$i"}->dapatSubsidi()."<br>";
    echo ${"kendaraan$i"}->hargaSecondKendaraan()."<br><br>";
}
?>