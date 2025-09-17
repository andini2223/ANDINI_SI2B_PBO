<?php

// class induk
class manusia {

    // property class manusia
    public $nama_saya;

    // method pada class manusia
    function berinama($saya){
        $this->nama_saya = $saya;
    }
}

// class turunan atau sub class dari class manusia
// kita menghubungkan class dengan syntax extends
class teman extends manusia {

    // property class teman
    public $nama_teman;

    // method pada class teman
    function berinamateman($teman){
        $this->nama_teman = $teman;
    }
}

// instansiasi class teman
$objectteman = new teman();

// method beri nama adalah method pada class manusia, tapi kita bisa mengaksesnya karena telah menghubungkan class teman dengan class manusia
$objectteman->berinama("Dika");
$objectteman->berinamateman("Andra");

// menampilkan isi property
echo "Nama Saya : " . $objectteman->nama_saya . "<br>";
echo "Nama Teman Saya : " . $objectteman->nama_teman;

?>