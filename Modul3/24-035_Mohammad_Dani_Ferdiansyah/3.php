<?php

$height = ["Ari" => 172, "Bela" => 166, "Cici" => 160];

$height["Doni"] = 175;
$height["Eka"] = 169;
$height["Feri"] = 163;
$height["Gita"] = 170;
$height["Hani"] = 158;

echo "Indeks terakhir: " . array_key_last($height) . "<br>";
echo "Nilai indeks terakhir: " . $height[array_key_last($height)] . " cm<br><br>";

unset($height["Bela"]);

echo "Indeks terakhir setelah penghapusan: " . array_key_last($height) . "<br>";
echo "Nilai indeks terakhir sekarang: " . $height[array_key_last($height)] . " cm<br><br>";

$weight = ["Ari" => 68, "Bela" => 60, "Cici" => 54];

$keys = array_keys($weight);
echo "Data ke-2 dari array \$weight (" . $keys[1] . "): " . $weight[$keys[1]] . " kg";
?>