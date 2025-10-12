<?php
$students = [
    ["Alex", "220401", "0812345678"],
    ["Bianca", "220402", "0812345687"],
    ["Candice", "220403", "0812345665"]
];

$students[] = ["Dion", "220404", "0812345679"];
$students[] = ["Elisa", "220405", "0812345688"];
$students[] = ["Farah", "220406", "0812345690"];
$students[] = ["Gilang", "220407", "0812345691"];
$students[] = ["Hana", "220408", "0812345692"];

echo "<h3>Daftar Mahasiswa</h3>";
echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr style='background-color:lightgrey; font-weight:bold;'>
        <th>No</th>
        <th>Nama</th>
        <th>NIM</th>
        <th>No. HP</th>
      </tr>";

$no = 1;
foreach ($students as $s) {
    echo "<tr>";
    echo "<td>{$no}</td>";
    echo "<td>{$s[0]}</td>";
    echo "<td>{$s[1]}</td>";
    echo "<td>{$s[2]}</td>";
    echo "</tr>";
    $no++;
}

echo "</table>";
?>