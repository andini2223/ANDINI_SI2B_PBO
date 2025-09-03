<?php
class Pembeli {
    private $kartu;
    private $totalBelanja;

    // Setter
    public function setData($kartu, $totalBelanja) {
        $this->kartu        = ($kartu); // ya/tidak
        $this->totalBelanja = $totalBelanja;
    }

    // Getter
    public function getKartu() {
        return $this->kartu;
    }

    public function getTotalBelanja() {
        return $this->totalBelanja;
    }

    // Hitung diskon 
    public function getDiskon() {
        $diskon = 0;
        switch ($this->kartu) {
            case "ya": // punya kartu member
                if ($this->totalBelanja > 500000) {
                    $diskon = 50000;
                } elseif ($this->totalBelanja > 100000) {
                    $diskon = 15000;
                } else {
                    $diskon = 5000;
                }
                break;

            case "tidak": // tidak punya kartu member
                if ($this->totalBelanja > 500000) {
                    $diskon = 50000;
                } elseif ($this->totalBelanja > 100000) {
                    $diskon = 5000;
                } else {
                    $diskon = 0;
                }
                break;
        }
        return $diskon;
    }

    public function getTotalBayar() {
        return $this->totalBelanja - $this->getDiskon();
    }

    // Cetak hasil
    public function tampilkanInfo() {
        echo "Apakah ada kartu member: " . $this->kartu . "<br>";
        echo "Total Belanja: " . $this->totalBelanja . "<br>";
        echo "Diskon: " . $this->getDiskon() . "<br>";
        echo "Total Bayar: Rp " . $this->getTotalBayar() . "<br><br>";
    }
}


$p1 = new Pembeli();
$p1->setData("ya", 200000); // input: punya kartu + total belanja 
$p1->tampilkanInfo();
?>
