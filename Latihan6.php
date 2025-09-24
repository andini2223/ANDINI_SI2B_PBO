<?php
class belanja{
public $namabarang;
public $harga;
public $jumlah;
public $total;

public function __construct($namabarang, $harga, $jumlah){
$this->namabarang = $namabarang;
$this->harga = $harga;
$this->jumlah = $jumlah;
$this->total = $harga * $jumlah;
echo "construct : Data belanja '$this->namabarang' dibuat.\n";
}
public function getinfo(){
return $this->namabarang . " (" . $this->harga . " x ". $this->jumlah . ") = ". $this->total;
}
public function __destruct(){
echo "Destructor : Data belanja '$this->namabarang' dihapus.\n";
}

}
echo "Masukkan jumlah barang belanja yang di beli: ";
$jml = (int)trim(fgets(STDIN));

$barang = [];
$totalbelanja = 0;

for ($i = 1; $i<=$jml; $i++){
    echo "\nBarang ke-$i\n";
    echo "nama barang: "; $namabarang = trim(fgets(STDIN));
    echo "Harga Satuan: "; $harga = (int)trim(fgets(STDIN));
    echo "Jumlah: "; $jumlah = (int)trim(fgets(STDIN));

    $mie = new belanja($namabarang, $harga, $jumlah);
    $barang[] = $mie;
    $totalbelanja += $mie->total;

}

echo "---Daftar Belanja---" . "\n";
foreach ($barang as $item){
    echo $item->getinfo() . "\n";

echo "--------------------";
echo "Total Belanja adalah: " . $totalbelanja . "\n";

}
?>