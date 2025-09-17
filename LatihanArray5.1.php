<?php
class warung {
    private $barang;
    public function __construct($barang) {
        $this->barang = $barang;
    }
    public function menampilkanBarang () {
        foreach ($this->barang as $namabarang => $harga) {
            echo "$namabarang dengan harga Rp $harga\n";
        }
    }
}
$barang = [
    "Kecap" => 3000 ."<br/>",
    "Tepung Terigu" => 4000
];

$barang1 = new warung ($barang);
$barang1->menampilkanBarang();
?>