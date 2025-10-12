<?php

$fruits = array("apel", "jeruk", "pisang", "mangga", "semangka");

array_push($fruits, "pepaya", "anggur", "melon", "nanas", "jambu");
echo "Indeks tertinggi setelah penambahan: " . (count($fruits) - 1) . "<br>";
echo "Nilai dengan indeks tertinggi: " . end($fruits) . "<br><br>";

unset($fruits[2]);

$maxIndex = max(array_keys($fruits));
echo "Indeks tertinggi setelah penghapusan: " . $maxIndex . "<br>";
echo "Nilai dengan indeks tertinggi: " . $fruits[$maxIndex] . "<br><br>";

$veggies = array("bayam", "wortel", "kubis");
echo "Isi array veggies: ";
print_r($veggies);
?>