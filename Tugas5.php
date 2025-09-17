<?php
// Class Induk
class Employee {
    public $gaji;
    public $lamaKerja;

    public function __construct($gaji, $lamaKerja) {
        $this->gaji = $gaji;
        $this->lamaKerja = $lamaKerja;
    }

    public function hitungGaji() {
        return $this->gaji;
    }

    public function informasi() {
        echo "Gaji: Rp " . number_format($this->hitungGaji(), 0, ',', '.') . "<br>";
    }
}

// 1. Programmer
class Programmer extends Employee {
    public function hitungGaji() {
        $bonus = 0;
        if ($this->lamaKerja < 1) {
            $bonus = 0;
        } elseif ($this->lamaKerja >= 1 && $this->lamaKerja <= 10) {
            $bonus = 0.01 * $this->lamaKerja * $this->gaji;
        } else {
            $bonus = 0.02 * $this->lamaKerja * $this->gaji;
        }
        return $this->gaji + $bonus;
    }

    public function informasi() {
        echo "Programmer = Gaji total: Rp " . number_format($this->hitungGaji(), 0, ',', '.') . "<br>";
    }
}

// 2. Direktur
class Direktur extends Employee {
    public function hitungGaji() {
        $bonus = 0.5 * $this->lamaKerja * $this->gaji;
        $tunjangan = 0.1 * $this->lamaKerja * $this->gaji;
        return $this->gaji + $bonus + $tunjangan;
    }

    public function informasi() {
        echo "Direktur = Gaji total: Rp " . number_format($this->hitungGaji(), 0, ',', '.') . "<br>";
    }
}

// 3. Pegawai Mingguan
class PegawaiMingguan extends Employee {
    private $hargaBarang;
    private $stokBarang;
    private $terjual;

    public function __construct($gaji, $lamaKerja, $hargaBarang, $stokBarang, $terjual) {
        parent::__construct($gaji, $lamaKerja);
        $this->hargaBarang = $hargaBarang;
        $this->stokBarang = $stokBarang;
        $this->terjual = $terjual;
    }

    public function hitungGaji() {
        $persentase = ($this->terjual / $this->stokBarang) * 100;
        if ($persentase > 70) {
            $bonus = 0.10 * $this->hargaBarang * $this->terjual;
        } else {
            $bonus = 0.03 * $this->hargaBarang * $this->terjual;
        }
        return $this->gaji + $bonus;
    }

    public function informasi() {
        echo "Pegawai Mingguan = Gaji total: Rp " . number_format($this->hitungGaji(), 0, ',', '.') . "<br>";
    }
}

// --- Testing ---
echo "<h3>Studi Kasus Employee</h3>";

// Programmer (lama kerja 12 tahun)
$prog = new Programmer(5000000, 12);
$prog->informasi();

// Direktur (lama kerja 5 tahun)
$dir = new Direktur(15000000, 5);
$dir->informasi();

// Pegawai Mingguan (stok 100, terjual 80)
$peg = new PegawaiMingguan(2000000, 2, 100000, 100, 80);
$peg->informasi();

?>
