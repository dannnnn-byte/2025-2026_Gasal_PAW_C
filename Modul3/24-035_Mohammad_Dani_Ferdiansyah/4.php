<?php

$height = ["Ari" => 172, "Bela" => 166, "Cici" => 160];

$height["Doni"] = 175;
$height["Eka"] = 169;
$height["Feri"] = 163;
$height["Gita"] = 170;
$height["Hani"] = 158;

echo "Indeks terakhir dari array \$height: <b>" . array_key_last($height) . "</b><br><br>";

$keys = array_keys($height);
for ($i = 0; $i < count($height); $i++) {
    echo $keys[$i] . " = " . $height[$keys[$i]] . " cm<br>";
}

$weight = ["Ari" => 68, "Bela" => 60, "Cici" => 54];

echo "<h3>Data Berat Badan</h3>";
$keys2 = array_keys($weight);
for ($i = 0; $i < count($weight); $i++) {
    echo $keys2[$i] . " = " . $weight[$keys2[$i]] . " kg<br>";
}

echo "<br>Data ke-2 dari array \$weight adalah: <b>" . $keys2[1] . " = " . $weight[$keys2[1]] . " kg</b>";
?>