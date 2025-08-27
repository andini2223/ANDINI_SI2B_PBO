<?php
class Guru {
    var $nama_nama = array("de","ce","ve","re");
    var $nama_guru;
    var $NIK;
    var $jabatan;
    var $alamat;
}

class Murid {
    var $nama_siswa;
    var $NIS;
    var $kelas;
    var $alamat;
}

class Kurikulum {
    var $tahun_akademik;
    var $sks_matkul;
}

class Mobil {
    var $jumlahRoda = 4;
    var $warna = "Merah";
    var $bahanBakar = "Pertamax";
    var $harga = 12000000;
    var $merek = 'A';

    public function statusHarga() {
        if ($this->harga > 50000000) 
            $status = 'Mahal';
        else 
            $status = 'Murah';
        return $status;
    }
}

$ObjekBMW = new Mobil;   // ini adalah objek BMW dari class Mobil
$ObjekTesla = new Mobil; // ini adalah objek Tesla dari class Mobil
$ObjekAudi = new Mobil;  // ini adalah objek Audi dari class Mobil

echo "BMW: Warna = " . $ObjekBMW->warna . 
     ", Harga = " . $ObjekBMW->harga . 
     ", Status = " . $ObjekBMW->statusHarga() . "<br>";

echo "Tesla: Warna = " . $ObjekTesla->warna . 
     ", Harga = " . $ObjekTesla->harga . 
     ", Status = " . $ObjekTesla->statusHarga() . "<br>";

echo "Audi: Warna = " . $ObjekAudi->warna . 
     ", Harga = " . $ObjekAudi->harga . 
     ", Status = " . $ObjekAudi->statusHarga() . "<br>";
?>

