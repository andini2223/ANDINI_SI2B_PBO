<?php

class KonversiSuhu {
    private $celsius;

    public function __construct($celsius) {
        $this->celsius = $celsius;
    }

    public function getCelsius() {
        return $this->celsius;
    }

    public function toReamur() {
        return (4/5) * $this->celsius;
    }

    public function toFahrenheit() {
        return (9/5) * $this->celsius + 32;
    }

    public function toKelvin() {
        return $this->celsius + 273.15;
    }
}

// Mengambil input dari GET jika ada, jika tidak, gunakan nilai default
$celsius_input = isset($_GET['celsius']) ? $_GET['celsius'] : 36;

// Membuat objek KonversiSuhu dengan input Celsius
$suhu = new KonversiSuhu($celsius_input);

// Deklarasi array untuk menampung data konversi
$konversi = [
    "celsius" => $suhu->getCelsius(),
    "reamur" => $suhu->toReamur(),
    "fahrenheit" => $suhu->toFahrenheit(),
    "kelvin" => $suhu->toKelvin()
];

echo "<h1>Konversi Suhu dari Celcius</h1>";

// Perulangan untuk menampilkan output
foreach ($konversi as $jenis => $nilai) {
    // Percabangan untuk menyesuaikan output
    if ($jenis == "celsius") {
        echo "suhu dalam celcius = " . $nilai . " derajat<br>";
    } else {
        echo "suhu dalam " . $jenis . " = " . $nilai . " derajat<br>";
    }
}

echo "<br>Sekian konversi suhu yang bisa dilakukan";

?>