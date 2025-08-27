<?php

// Definisi kelas "kendaraan"
class kendaraan
{
// Properti (variabel) dari kelas
var $jumlahRoda;
var $warna;
var $bahanBakar;
var $harga;
var $merek;

// Metode (fungsi) dari kelas
function statusHarga()
{
if ($this->harga > 50000000) {
$status = 'Mahal';
} else {
$status = 'Murah';
}
return $status;
}
}

// Objek 1
// Instansiasi objek baru dari kelas kendaraan
$ObjekKendaraan1 = new kendaraan();
// Mengatur properti objek secara langsung
$ObjekKendaraan1->merek = "Yamaha MIO";
$ObjekKendaraan1->harga = "100000000";

// Objek 2
// Instansiasi objek baru dari kelas kendaraan
$ObjekKendaraan2 = new kendaraan();
// Mengatur properti objek secara langsung
$ObjekKendaraan2->merek = "Toyota Avanza";
$ObjekKendaraan2->harga = "100000000";

// Menampilkan output ke browser
echo "Merek: " . $ObjekKendaraan2->merek;
echo "<br>";
echo "Nominal Harga: " . $ObjekKendaraan2->harga;
echo "<br>";
echo "Status Harga Kendaraan: " . $ObjekKendaraan2->statusHarga();
?>