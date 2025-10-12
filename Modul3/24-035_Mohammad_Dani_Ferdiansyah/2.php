<?php

$fruits = ["apel", "jeruk", "pisang", "mangga", "semangka"];

for ($i = 0; $i < 5; $i++) {
    $fruits[] = "buah_" . ($i + 1);
}

for ($i = 0; $i < count($fruits); $i++) {
    echo "Indeks $i : " . $fruits[$i] . "<br>";
}

echo "<br>Panjang array \$fruits saat ini: " . count($fruits) . "<br><br>";

$veggies = ["bayam", "wortel", "kubis"];

for ($i = 0; $i < count($veggies); $i++) {
    echo "Indeks $i : " . $veggies[$i] . "<br>";
}
?>