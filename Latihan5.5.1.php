<?php
class Dog {
    public function bark() {
        echo "woof <br>";
    }
}

class Hound extends Dog {
    public function sniff() {
        echo "sniff <br>";
    }

    // Overriding method bark()
    public function bark() {
        echo "bowl <br>";
    }
}

// Testing
$d = new Dog();
$d->bark();   // Output: woof

$h = new Hound();
$h->bark();   // Output: bowl (karena sudah dioverride)
$h->sniff();  // Output: sniff
?>