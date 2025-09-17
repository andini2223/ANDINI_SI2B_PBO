<?php
class Dog {
    // Method "bark" tanpa parameter
    public function bark() {
        $numArgs = func_num_args(); // cek jumlah argumen
        $args = func_get_args();    // ambil argumen

        if ($numArgs == 0) {
            echo "woof <br>";
        } elseif ($numArgs == 1) {
            for ($i = 0; $i < $args[0]; $i++) {
                echo "woof <br>";
            }
        } else {
            echo "Invalid number of arguments <br>";
        }
    }
}

// Testing
$d = new Dog();
$d->bark();      // Output: woof
$d->bark(3);     // Output: woof (3 kali)
?>