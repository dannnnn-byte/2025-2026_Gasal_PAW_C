<?php
$arr1 = ["apel", "jeruk"];
$arr2 = ["pisang", "mangga", "melon"];

// array_push()
array_push($arr1, "pepaya");

// array_merge()
$merged = array_merge($arr1, $arr2);

// array_values()
$vals = array_values($merged);

// array_search()
$index_mangga = array_search("mangga", $merged);

// array_filter()
$filtered = array_filter($merged, function($item){
    return strlen($item) > 5;
});

// sorting
sort($merged);

// tabel html
echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr><th>No</th><th>Fungsi</th><th>Hasil</th></tr>";

echo "<tr><td>1</td><td>array_push()</td><td>" . implode(", ", $arr1) . "</td></tr>";
echo "<tr><td>2</td><td>array_merge()</td><td>" . implode(", ", $merged) . "</td></tr>";
echo "<tr><td>3</td><td>array_values()</td><td>" . implode(", ", $vals) . "</td></tr>";
echo "<tr><td>4</td><td>array_search('mangga')</td><td>Index ke-" . $index_mangga . "</td></tr>";
echo "<tr><td>5</td><td>array_filter()</td><td>" . implode(", ", $filtered) . "</td></tr>";
echo "<tr><td>6</td><td>sort()</td><td>" . implode(", ", $merged) . "</td></tr>";

echo "</table>";
?>