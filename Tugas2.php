<?php
class Pegadaian {
    public $pinjaman;
    public $bunga;
    public $lama;
    public $telat;

    function totalPinjaman() {
        return $this->pinjaman + ($this->pinjaman * $this->bunga / 100);
    }

    function angsuran() {
        return $this->totalPinjaman() / $this->lama;
    }

    function denda() {
        return $this->angsuran() * 0.0015 * $this->telat;
    }

    function totalBayar() {
        return $this->angsuran() + $this->denda();
    }
}

// isi data
$obj = new Pegadaian();
$obj->pinjaman = 1000000;
$obj->bunga = 10;
$obj->lama = 5;
$obj->telat = 40;

// tampilkan hasil

echo "Besaran Pinjaman: Rp. {$obj->pinjaman}<br>";
echo "Bunga: {$obj->bunga}%<br>";
echo "Total Pinjaman: Rp. {$obj->totalPinjaman()}<br>";
echo "Lama Angsuran: {$obj->lama} bulan<br>";
echo "Besaran Angsuran: Rp. {$obj->angsuran()}<br><br>";

echo "Keterlambatan: {$obj->telat} hari<br>";
echo "Denda: Rp. {$obj->denda()}<br>";
echo "Total Bayar: Rp. {$obj->totalBayar()}<br>";
?>
