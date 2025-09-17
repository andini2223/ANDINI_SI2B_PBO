<?php
// Class induk
class BangunDatar {
    public function luas() {
        return 0;
    }

    public function keliling() {
        return 0;
    }
}

// Class turunan
class Persegi extends BangunDatar {
    public $sisi;

    public function __construct($sisi) {
        $this->sisi = $sisi;
    }

    public function luas() {
        return $this->sisi * $this->sisi;
    }

    public function keliling() {
        return 4 * $this->sisi;
    }
}

class Lingkaran extends BangunDatar {
    public $r;

    public function __construct($r) {
        $this->r = $r;
    }

    public function luas() {
        return 3.14 * $this->r * $this->r;
    }

    public function keliling() {
        return 2 * 3.14 * $this->r;
    }
}

class PersegiPanjang extends BangunDatar {
    public $panjang;
    public $lebar;

    public function __construct($panjang, $lebar) {
        $this->panjang = $panjang;
        $this->lebar = $lebar;
    }

    public function luas() {
        return $this->panjang * $this->lebar;
    }

    public function keliling() {
        return 2 * ($this->panjang + $this->lebar);
    }
}

class Segitiga extends BangunDatar {
    public $alas;
    public $tinggi;

    public function __construct($alas, $tinggi) {
        $this->alas = $alas;
        $this->tinggi = $tinggi;
    }

    public function luas() {
        return 0.5 * $this->alas * $this->tinggi;
    }

    // keliling untuk segitiga (asumsikan segitiga siku-siku)
    public function keliling() {
        $sisiMiring = sqrt(($this->alas * $this->alas) + ($this->tinggi * $this->tinggi));
        return $this->alas + $this->tinggi + $sisiMiring;
    }
}

// Main
echo "<h3>Persegi</h3>";
$p = new Persegi(5);
echo "Luas = ".$p->luas()."<br>";
echo "Keliling = ".$p->keliling()."<hr>";

echo "<h3>Lingkaran</h3>";
$l = new Lingkaran(7);
echo "Luas = ".$l->luas()."<br>";
echo "Keliling = ".$l->keliling()."<hr>";

echo "<h3>Persegi Panjang</h3>";
$pp = new PersegiPanjang(8, 4);
echo "Luas = ".$pp->luas()."<br>";
echo "Keliling = ".$pp->keliling()."<hr>";

echo "<h3>Segitiga</h3>";
$s = new Segitiga(6, 8);
echo "Luas = ".$s->luas()."<br>";
echo "Keliling = ".$s->keliling()."<hr>";
?>