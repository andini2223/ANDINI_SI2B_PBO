<?php
class BangunRuang {
    private $jenis, $sisi, $jari, $tinggi;
    private $pi = 3.14; // biar hasilnya sama dengan soal

    // Setter
    public function setJenis($jenis) { $this->jenis = $jenis; }
    public function setSisi($sisi) { $this->sisi = $sisi; }
    public function setJari($jari) { $this->jari = $jari; }
    public function setTinggi($tinggi) { $this->tinggi = $tinggi; }

    // Getter
    public function getJenis() { return $this->jenis; }
    public function getSisi() { return $this->sisi; }
    public function getJari() { return $this->jari; }
    public function getTinggi() { return $this->tinggi; }

    // Hitung volume sesuai jenis
    public function getVolume() {
        if ($this->jenis == "Bola") {
            return (4/3) * $this->pi * pow($this->jari, 3);
        } elseif ($this->jenis == "Kerucut") {
            return (1/3) * $this->pi * pow($this->jari, 2) * $this->tinggi;
        } elseif ($this->jenis == "Limas Segi Empat") {
            return (1/3) * pow($this->sisi, 2) * $this->tinggi;
        } elseif ($this->jenis == "Kubus") {
            return pow($this->sisi, 3);
        } elseif ($this->jenis == "Tabung") {
            return $this->pi * pow($this->jari, 2) * $this->tinggi;
        } else {
            return 0;
        }
    }

    // Method untuk tampilkan data
    public function tampilkan() {
        echo "Jenis Bangun Ruang : ".$this->getJenis()."<br>";
        echo "Sisi              : ".$this->getSisi()."<br>";
        echo "Jari-jari         : ".$this->getJari()."<br>";
        echo "Tinggi            : ".$this->getTinggi()."<br>";
        echo "Volume            : ".$this->getVolume()."<br><br>";
    }
}

// Data array
$data = [
    ["Bola", 0, 7, 0],
    ["Kerucut", 0, 14, 10],
    ["Limas Segi Empat", 8, 0, 24],
    ["Kubus", 30, 0, 0],
    ["Tabung", 0, 7, 10]
];

// Perulangan untuk tampilkan semua
foreach ($data as $d) {
    $obj = new BangunRuang();
    $obj->setJenis($d[0]);
    $obj->setSisi($d[1]);
    $obj->setJari($d[2]);
    $obj->setTinggi($d[3]);
    $obj->tampilkan();
}
?>
