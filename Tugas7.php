<?php
// buka handle input dari command prompt
$handle = fopen("php://stdin", "r");

// ================================
// Class Induk: UangTabungan
// ================================
class UangTabungan {
    private $saldo; // saldo disembunyikan (private)

    public function __construct($saldoAwal) {
        $this->saldo = $saldoAwal; // set saldo awal
    }

    protected function getSaldo() { // ambil saldo
        return $this->saldo;
    }

    protected function setor($jumlah) { // tambah saldo
        $this->saldo += $jumlah;
    }

    protected function tarik($jumlah) { // kurangi saldo
        if ($jumlah <= $this->saldo) {
            $this->saldo -= $jumlah;
        } else {
            echo "Saldo tidak cukup!\n";
        }
    }
}

// ================================
// Class Anak: Siswa1, Siswa2, Siswa3
// ================================
class Siswa1 extends UangTabungan {
    public function tampilSaldo() { echo "Saldo Siswa 1: Rp".parent::getSaldo()."\n"; }
    public function setorTunai($jml) { parent::setor($jml); }
    public function tarikTunai($jml) { parent::tarik($jml); }
}
class Siswa2 extends UangTabungan {
    public function tampilSaldo() { echo "Saldo Siswa 2: Rp".parent::getSaldo()."\n"; }
    public function setorTunai($jml) { parent::setor($jml); }
    public function tarikTunai($jml) { parent::tarik($jml); }
}
class Siswa3 extends UangTabungan {
    public function tampilSaldo() { echo "Saldo Siswa 3: Rp".parent::getSaldo()."\n"; }
    public function setorTunai($jml) { parent::setor($jml); }
    public function tarikTunai($jml) { parent::tarik($jml); }
}

// ================================
// Program utama Array
// ================================
$siswa = [
    new Siswa1(100000), // saldo awal siswa 1
    new Siswa2(150000), // saldo awal siswa 2
    new Siswa3(200000)  // saldo awal siswa 3
];

while (true) {
    echo "\n=== MENU TABUNGAN SEKOLAH ===\n";
    echo "1. Lihat Saldo\n";    // pilihan lihat saldo
    echo "2. Setor Tunai\n";    // pilihan setor
    echo "3. Tarik Tunai\n";    // pilihan tarik
    echo "4. Keluar\n";         // pilihan keluar
    echo "Pilih menu: ";
    $menu = trim(fgets($handle)); // input menu

    if ($menu == 4) { // keluar program
        echo "Program selesai.\n"; 
        break;
    }

    echo "Pilih siswa (1-3): ";
    $pilih = trim(fgets($handle)); // input siswa
    $index = $pilih - 1; // karena array dimulai dari 0

    if (!isset($siswa[$index])) { // kalau siswa tidak ada
        echo "Siswa tidak ada!\n"; 
        continue;
    }

    switch ($menu) {
        case 1: // menampilkan saldo
            $siswa[$index]->tampilSaldo();
            break;
        case 2: // setor
            echo "Jumlah setor: ";
            $jml = trim(fgets($handle));
            $siswa[$index]->setorTunai($jml);
            break;
        case 3: // tarik
            echo "Jumlah tarik: ";
            $jml = trim(fgets($handle));
            $siswa[$index]->tarikTunai($jml);
            break;
        default: // kalau menu salah
            echo "Menu salah!\n";
    }
}

fclose($handle); // tutup handle input
?>

