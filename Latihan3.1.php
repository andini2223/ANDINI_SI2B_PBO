<?php
class BarangHarian{
    var $namaBarang = "Mie Instan";
    var $harga; 
    var $jumlah;
    var $total; // tambahkan ; di sini

    function hitungTotalPembayaran() {
        $total = $this->harga * $this->jumlah;
        return $total;
    }

    function statusPembayaran($total){
        if ($total > 50000){
            return "Mahal";
        } else {
            return "Murah";
        }
    }
}

//mie instan, kopi, air mineral
$barang1 = new BarangHarian();
$barang1 -> harga = 15000;
$barang1 -> jumlah = 3;

$barang2 = new BarangHarian();
$barang2 -> namaBarang = "Kopi";
$barang2 -> harga = 3000;
$barang2 -> jumlah = 5;

$barang3 = new BarangHarian();
$barang3 -> namaBarang = "Air Mineral"; 
$barang3 -> harga = 6000; 
$barang3 -> jumlah = 5;

echo $barang1 -> namaBarang; echo "<br>";
echo $barang1 -> harga; echo "<br>";
echo $barang1 -> jumlah; echo "<br>";
$total1 = $barang1 -> hitungTotalPembayaran();
echo $total1; echo "<br>";
echo $barang1 -> statusPembayaran($total1); echo "<br><br>";

echo $barang2 -> namaBarang; echo "<br>";
echo $barang2 -> harga; echo "<br>";
echo $barang2 -> jumlah; echo "<br>";
$total2 = $barang2 -> hitungTotalPembayaran();
echo $total2; echo "<br>";
echo $barang2 -> statusPembayaran($total2); echo "<br><br>";

echo $barang3 -> namaBarang; echo "<br>";
echo $barang3 -> harga; echo "<br>";
echo $barang3 -> jumlah; echo "<br>";
$total3 = $barang3 -> hitungTotalPembayaran();
echo $total3; echo "<br>";
echo $barang3 -> statusPembayaran($total3); echo "<br><br>";
?>