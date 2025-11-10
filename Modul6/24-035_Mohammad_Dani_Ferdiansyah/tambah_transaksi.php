<?php

$conn = mysqli_connect("localhost", "root", "", "toko");
$pelanggan = mysqli_query($conn, "SELECT * FROM pelanggan");

require 'validate.php';
$errors = [];
$data = [];

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $waktu_transaksi = $_POST["waktu_transaksi"];
    $keterangan = $_POST["keterangan"];
    $total = $_POST["total"];
    $pelanggan_id = $_POST["pelanggan_id"];

    $data = [
        'waktu_transaksi' => $waktu_transaksi,
        'keterangan' => $keterangan,
        'total' => $total,
        'pelanggan_id' => $pelanggan_id,
    ];

    $validwaktu = validateWaktu($waktu_transaksi, $errors);
    $validketerangan = validateKeterangan($keterangan, $errors);
    $validpelanggan = validatePelanggan($pelanggan_id, $errors);

    if($validwaktu && $validketerangan && $validpelanggan){
        $query = "INSERT INTO transaksi (waktu_transaksi, keterangan, total, pelanggan_id) VALUES ('$waktu_transaksi', '$keterangan', '$total', '$pelanggan_id')";
        
        if(mysqli_query($conn, $query)){
            header("location: index.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #e9ecef;
            display: flex;
            justify-content: center;
        }
        .card {
            background: white;
            padding: 10px 25px 25px 25px;
            width: 350px;
            margin: 40px;
            border-radius: 10px;
            box-shadow: 0 0 8px rgba(0,0,0,0.2);
        }
        .card h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 18px;
        }
        label {
            font-size: 14px;
            font-weight: bold;
        }
        input {
            width: 95%;
            padding: 8px;
            margin-top: 6px;
            margin-bottom: 14px;
            border: 1px solid #bbb;
            border-radius: 5px;
            font-size: 14px;
        }
        select {
            width: 100%;
            padding: 8px;
            margin-top: 6px;
            margin-bottom: 14px;
            border: 1px solid #bbb;
            border-radius: 5px;
            font-size: 14px;
        }
        textarea {
            height: 60px;
            resize: vertical;
            width: 95%;
            padding: 8px;
            margin-top: 6px;
            margin-bottom: 14px;
            border: 1px solid #bbb;
            border-radius: 5px;
            font-size: 14px;
        }
        .btn-tambah {
            width: 100%;
            padding: 10px;
            background: royalblue;
            border: none;
            color: white;
            border-radius: 5px;
            font-size: 15px;
            cursor: pointer;
        }
        .btn-tambah:hover {
            background: #0046d6;
        }
        .btn-container {
            text-align: center;
        }
        .error {
            color: red;
            font-size: 13px;
            margin: -8px 0 10px 0;
            display: block;
        }
    </style>
</head>
<body>
    <form method="POST" action="tambah_transaksi.php">
            <div class="card">
                <h2>Tambah Data Transaksi</h2>

                <label for="waktu_transaksi">Waktu Transaksi</label>
                <input type="date" id="waktu_transaksi" name="waktu_transaksi" value="<?= htmlspecialchars($data['waktu_transaksi'] ?? '') ?>">
                <span class="error"><?php echo $errors['waktu_transaksi'] ?? ""?></span>

                <label for="keterangan">Keterangan</label>
                <textarea name="keterangan" id="keterangan" placeholder="Masukkan keterangan transaksi"><?= htmlspecialchars($data['keterangan'] ?? '') ?></textarea>
                <span class="error"><?php echo $errors['keterangan'] ?? ""?></span>

                <label for="total">Total</label>
                <input name="total" id="total" type="number" value="0">
                <span class="error"><?php echo $errors['total'] ?? ""?></span>

                <label for="pelanggan_id">Pelanggan</label>
                <select name="pelanggan_id" id="pelanggan_id">
                    <option value="">Pilih Pelanggan</option>
                    <?php while($p = mysqli_fetch_assoc($pelanggan)): ?>
                        <option value="<?= $p['id']; ?>"  <?= ($p['id'] == ($data['pelanggan_id'] ?? '')) ? 'selected' : '' ?>>
                            <?= $p['nama']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
                <span class="error"><?php echo $errors['pelanggan_id'] ?? ""?></span>
                        

                <div class="btn-container">
                    <button class="btn-tambah">Tambah Transaksi</button>
                    <!-- <a href="index.php" class="btn-back">Kembali</a> -->
                </div>

            </div>
    </form>
</body>
</html>