<?php include "koneksi.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Supplier</title>
    <style>
        form { width: 400px; margin: 40px auto; }
        input, textarea { width: 100%; padding: 8px; margin-bottom: 5px; }
        .btn { padding: 6px 12px; border: none; border-radius: 3px; cursor: pointer; }
        .update { background-color: green; color: white; }
        .batal { background-color: red; color: white; text-decoration: none; padding: 6px 12px; }
        .error { color: red; font-size: 13px; margin-bottom: 10px; display: block; }
        .success { color: green; text-align: center; font-weight: bold; }
    </style>
</head>
<body>

<h2 align="center">Edit Data Master Supplier</h2>

<?php
$id = $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM supplier WHERE id='$id'");
$d = mysqli_fetch_array($data);

$error_nama = $error_telp = "";
$success = "";

if (isset($_POST['update'])) {
    $nama   = trim($_POST['nama']);
    $telp   = trim($_POST['telp']);
    $alamat = trim($_POST['alamat']);
    $valid  = true;

    if (!preg_match("/^[a-zA-Z\s.]+$/", $nama)) {
        $error_nama = "Nama hanya boleh berisi huruf dan spasi (tanpa angka atau simbol).";
        $valid = false;
    }

    if (!preg_match("/^[0-9]{10,15}$/", $telp)) {
        $error_telp = "Nomor telepon hanya boleh berisi angka (10–15 digit).";
        $valid = false;
    }

    if ($valid) {
        $query = "UPDATE supplier SET nama='$nama', telp='$telp', alamat='$alamat' WHERE id='$id'";
        if (mysqli_query($koneksi, $query)) {
            $success = "Data berhasil diperbarui!";
        } else {
            $error_nama = "Gagal memperbarui data: " . mysqli_error($koneksi);
        }
    }
}
?>

<?php if ($success): ?>
    <p class="success"><?= $success ?></p>
    <meta http-equiv="refresh" content="1;url=index.php">
<?php endif; ?>

<form method="POST" action="">
    <label>Nama</label>
    <input type="text" name="nama" value="<?= isset($_POST['nama']) ? $_POST['nama'] : $d['nama']; ?>" required>
    <?php if ($error_nama): ?><span class="error"><?= $error_nama ?></span><?php endif; ?>

    <label>Telp</label>
    <input type="text" name="telp" value="<?= isset($_POST['telp']) ? $_POST['telp'] : $d['telp']; ?>" required>
    <?php if ($error_telp): ?><span class="error"><?= $error_telp ?></span><?php endif; ?>

    <label>Alamat</label>
    <textarea name="alamat" required><?= isset($_POST['alamat']) ? $_POST['alamat'] : $d['alamat']; ?></textarea>

    <button type="submit" name="update" class="btn update">Update</button>
    <a href="index.php" class="btn batal">Batal</a>
</form>

</body>
</html>
