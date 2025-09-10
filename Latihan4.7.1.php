<?php
class Perulangan{
  public function loop() {
    for($i = 15; $i > 0; $i--) {
      echo $i;
      echo "<br/>";
    }
  }
}

$ObjekPerulangan = new Perulangan();
echo "Jenis Perulangan Lainnya "."<br />";
echo $ObjekPerulangan->loop()."<br />";
?>