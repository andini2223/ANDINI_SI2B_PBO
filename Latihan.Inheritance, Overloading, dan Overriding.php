<?php 

// Materi Inheritance, Overloading, Overriding

class Warung {
    public $namaBarang;
    Public $haraga;

    public function __construct ($namaBarang, $harga) {
        $this->namaBarang = $namaBarang;
        $this->harga = $harga;
    }

    public function informasi() {
        echo "Barang: $this->namaBarang, Harga: Rp $this->harga<br>";
    }
}

class Warung2 extends Warung {
    public $exp;

    public function __construct ($namaBarang, $harga, $exp) {
        parent ::__construct($namaBarang, $harga);
        $this->exp = $exp;
    }

    //overriding
    public function informasi() {
       echo "Barang2: $this->namaBarang, Harga: Rp $this->harga, kadaluarsa: $this->exp<br>"; 
    }
}

class Warung3 {
    public function __call($namaBarang, $x){
        if ($namaBarang == "total") {
            if (count($x) == 1) {
                return $x[0];
            }
            else if (count($x) == 2) {
                return $x[0]* $x[1];
            }
            else{
                return 0;
            }
        }
    }
}

$barang1 = new Warung("Susu kotak", 6000);
$barang1->informasi();

$barang2 = new Warung2("Yogurt", 12000, "15-11-2025");
$barang2->informasi();

$barang3 = new Warung3();
echo " Harga Indomie setelah diskon: Rp " . $barang3->total(4000) . "<br>";
echo "Harga Telur: Rp " . $barang3->total(2000, 5) . "<br>";

?>