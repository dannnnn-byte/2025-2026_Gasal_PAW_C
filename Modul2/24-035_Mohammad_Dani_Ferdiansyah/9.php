<!DOCTYPE html>
<html>
<head>
    <title>Nilai</title>
</head>
<body>
    <h2>Cek Nilai Mahasiswa</h2>
    <form method="post">
        Masukkan Nilai: <input type="number" name="nilai" required>
        <input type="submit" value="Cek Grade">
    </form>

    <?php
    if (isset($_POST['nilai'])) {
        $nilai = $_POST['nilai'];

        if ($nilai >= 85) {
            $grade = "A";
        } elseif ($nilai >= 70) {
            $grade = "B";
        } elseif ($nilai >= 55) {
            $grade = "C";
        } elseif ($nilai >= 40) {
            $grade = "D";
        } else {
            $grade = "E";
        }

        echo "<p>Nilai Anda: $nilai <br> Grade: $grade</p>";
    }
    ?>
</body>
</html>