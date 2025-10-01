<?php
class Komputer {

    private $jenis_prosesor = "Intel Core i7-4790 3.60GHz";
    protected $jenis_RAM = "DDR 4";
    public $jenis_VGA = "PCI Express";

    public function get_prosesor() {
        return $this->jenis_prosesor;
    }

    protected function get_RAM() {
        return $this->jenis_RAM;
    }

    // Method untuk mengakses property Public
    public function get_VGA() {
        return $this->jenis_VGA;
    }

}

class Laptop extends Komputer {

    public function tampilkan_prosesor_induk() {
        return $this->get_prosesor(); 
    }

    public function tampilkan_RAM_induk() {
        return $this->jenis_RAM; 
    }

    public function tampilkan_VGA_induk() {
        return $this->jenis_VGA;
    }

      private function rahasia_laptop() {
        return "Ini method private dari Laptop.";
    }

    public function coba_rahasia() {
        return "Akses dari dalam class: " . $this->rahasia_laptop();
    }
}

$komputer = new Komputer();
$laptop = new Laptop();

echo "--- Pemanggilan dari Objek \$komputer (Class Komputer) --- <br>";
echo "Prosesor : " . $komputer->get_prosesor() . "<br />";
echo "VGA      : " . $komputer->get_VGA() . "<br />";


echo "<br>";

echo "--- Pemanggilan dari Objek \$laptop (Class Laptop) --- <br>";
echo "Prosesor : " . $laptop->tampilkan_prosesor_induk() . "<br />";
echo "RAM      : " . $laptop->tampilkan_RAM_induk() . "<br />";
echo "VGA      : " . $laptop->tampilkan_VGA_induk() . "<br />";
echo $laptop->coba_rahasia() . "<br />";

?>