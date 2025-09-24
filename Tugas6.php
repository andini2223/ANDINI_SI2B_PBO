<?php
class Karyawan {
    public $nama;
    public $golongan;
    public $lembur;
    public $gajiPokok;

    public $dataGaji = [
        "Ib" => 1250000, "Ic" => 1300000, "Id" => 1350000,
        "IIa" => 2000000, "IIb" => 2100000, "IIc" => 2200000, "IId" => 2300000,
        "IIIa" => 2400000, "IIIb" => 2500000, "IIIc" => 2600000, "IIId" => 2700000,
        "IVa" => 2800000, "IVb" => 2900000, "IVc" => 3000000, "IVd" => 3100000
    ];

    // Constructor dengan parameter
    public function __construct($nama, $golongan, $lembur) {
        $this->nama     = $nama;
        $this->golongan = $golongan;
        $this->lembur   = $lembur;
        $this->gajiPokok = $this->getGajiPokok($golongan);

        echo "Constructor: Data karyawan {$this->nama} dibuat.\n";
    }

    // Getter sesuai ketentuan
    public function getNama() {
        return $this->nama;
    }

    public function getGolongan() {
        return $this->golongan;
    }

    public function getLembur() {
        return $this->lembur;
    }

    public function getGajiPokok($gol) {
        return isset($this->dataGaji[$gol]) ? $this->dataGaji[$gol] : 0;
    }

    public function getTotalGaji() {
        $uangLembur = $this->lembur * 15000;
        return $this->gajiPokok + $uangLembur;
    }

    // Destructor
    public function __destruct() {
        echo "Destructor: Data karyawan {$this->nama} dihapus.\n";
    }
}

// ---------- Program utama (CLI) ----------
echo "Masukkan jumlah karyawan: ";
$jml = (int) trim(fgets(STDIN));
$daftar = [];

for ($i = 1; $i <= $jml; $i++) {
    echo "\nData karyawan ke-$i\n";
    echo "Nama Karyawan   : "; $nama = trim(fgets(STDIN));
    echo "Golongan        : "; $gol = trim(fgets(STDIN));
    echo "Total Jam Lembur: "; $lembur = (int) trim(fgets(STDIN));

    $k = new Karyawan($nama, $gol, $lembur);
    $daftar[] = $k;
}

// Cetak tabel rapi
echo "\n--- Daftar Gaji Karyawan ---\n";
printf("%-20s %-10s %-15s %-15s\n", "Nama Karyawan", "Golongan", "Total Lembur", "Total Gaji");

foreach ($daftar as $d) {
    printf(
        "%-20s %-10s %-15d Rp %-15s\n",
        $d->getNama(),
        $d->getGolongan(),
        $d->getLembur(),
        number_format($d->getTotalGaji(), 0, ',', '.')
    );
    unset($d); // memicu destructor
}
