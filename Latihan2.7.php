<?php

class Kendaraan
{
// Properti atau variabel dari class
public $JumlahRoda = 4;
public $Warna;
public $BahanBakar = "Premium";
public $Harga = 100000000;
public $Merek;
public $TahunPembuatan = 2004;

// Metode atau fungsi dari class
public function statusHarga()
{
if ($this->Harga > 50000000) {
$status = "Harga Kendaraan Mahal";
} else {
$status = "Harga Kendaraan Murah";
}
return $status;
}

public function statusSubsidi()
{
if ($this->TahunPembuatan < 2005 && $this->BahanBakar == "Premium") {
$status = "DAPAT SUBSIDI";
} else {
$status = "TIDAK DAPAT SUBSIDI";
}
return $status;
}

public function dapatSubsidi()
{
if ($this->TahunPembuatan < 2005 && $this->BahanBakar == "Premium") {
$status = "DAPAT SUBSIDI";
} else {
$status = "TIDAK DAPAT SUBSIDI";
}
return $status;
}

public function hargaSecondKendaraan()
{
// Contoh sederhana untuk menghitung harga bekas
$tahunSekarang = date("Y");
$umurKendaraan = $tahunSekarang - $this->TahunPembuatan;
$hargaBekas = $this->Harga * (1 - ($umurKendaraan * 0.1));

// Pastikan harga tidak negatif
if ($hargaBekas < 0) {
$hargaBekas = 0;
}

return $hargaBekas;
}
}

// Proses instansiasi dan pemanggilan
// Objek 1 (Latihan 2.7)
$ObjekKendaraan = new Kendaraan();
echo "Jumlah Roda: " . $ObjekKendaraan->JumlahRoda . "<br>";
echo "Status Harga: " . $ObjekKendaraan->statusHarga() . "<br>";
echo "Status Subsidi: " . $ObjekKendaraan->statusSubsidi() . "<br>" ;
echo "<br>";

// Objek 2 (Kelanjutan Latihan 2.7)
$ObjekKendaraan1 = new Kendaraan(); // Deklarasi objek
$ObjekKendaraan1->Harga = 10000000; // Mengubah properti
$ObjekKendaraan1->TahunPembuatan = 1999;
echo "Status Harga Objek 1: " . $ObjekKendaraan1->statusHarga() . "<br>";
echo "br";

// Objek 3 (Kelanjutan Latihan 2.7)
$ObjekKendaraan2 = new Kendaraan(); // Deklarasi objek
$ObjekKendaraan2->BahanBakar = "Pertamax"; // Mengubah properti
$ObjekKendaraan2->TahunPembuatan = 1999;
echo "Status BBM Objek 2: " . $ObjekKendaraan2->dapatSubsidi() . "<br>";
echo "Harga Bekas Objek 2: " . $ObjekKendaraan2->hargaSecondKendaraan() . "<br>";
echo "<br>";

?>