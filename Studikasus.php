<?php
// Membuat dua class exception khusus
class EmailException extends Exception {}
class FormatException extends Exception {}

// Array data email sesuai contoh di soal
$emails = [
    "lab4a@polsub.ac.id",
    "lab4b@polsub.ac.id",
    "lab4c@polsub.ac.id",
    "lab4d@polsub.ac.id",
    "lab5a@polsub.ac.id",
    "lab5b@polsub.ac.id",
    "lab5c@polsub.ac.id",
    "someone@example.com" // email tidak valid
];

$valid = 0;
$invalid = 0;
$countLab4 = 0;
$countLab5 = 0;

foreach ($emails as $email) {
    try {
        // Mengecek apakah email mengandung kata 'lab4' atau 'lab5'
        if (!preg_match("/lab4|lab5/", $email)) {
            throw new EmailException("$email tidak mengandung kata 'lab4/lab5' dan tidak valid");
        }

        // Mengecek apakah format email valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new FormatException("$email is no valid E-Mail address");
        }

        // Menentukan teks sesuai isi email
        if (strpos($email, 'lab4') !== false) {
            echo "$email mengandung kata 'lab4' dan E-mail valid<br>";
            $countLab4++;
        } elseif (strpos($email, 'lab5') !== false) {
            echo "$email mengandung kata 'lab5' dan E-mail valid<br>";
            $countLab5++;
        }

        $valid++;

    } catch (EmailException $e) {
        // Format error sama seperti contoh di soal
        echo "Error caught on line " . $e->getLine() . " in " . $e->getFile() . ": " . $e->getMessage() . " is no valid E-Mail address<br>";
        $invalid++;
    } catch (FormatException $e) {
        echo "Error caught on line " . $e->getLine() . " in " . $e->getFile() . ": " . $e->getMessage() . "<br>";
        $invalid++;
    }
}

// Menampilkan hasil akhir
echo "<br>Terdapat $countLab4 email lab 4 dan $countLab5 email lab 5<br>";
echo "Terdapat $invalid email bukan lab4/lab5<br>";
?>
