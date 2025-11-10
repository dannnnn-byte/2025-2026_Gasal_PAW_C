<?php

$conn = mysqli_connect("localhost", "root", "", "toko");
$transaksi = mysqli_query($conn, "SELECT * FROM transaksi");
$barang = mysqli_query($conn, "SELECT * FROM barang");

require 'validate.php';
$errors = [];
$data = [];

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $barang_id = $_POST["barang_id"];
    $transaksi_id = $_POST["transaksi_id"];
    $qty = $_POST["qty"];

    $data = [
        'barang_id' => $barang_id,
        'transaksi_id' => $transaksi_id,
        'qty' => $qty
    ];

    $valid_barang = validateBarang($barang_id, $transaksi_id, $errors, $conn);
    $valid_transaksi = validateTransaksi($transaksi_id, $errors);
    $valid_qty = validateQty($qty, $errors);

    if ($valid_barang && $valid_transaksi && $valid_qty) {
        $result_barang = mysqli_query($conn, "SELECT harga FROM barang WHERE id = $barang_id");
        $data_barang = mysqli_fetch_assoc($result_barang);
        $harga_satuan = $data_barang['harga'];

        $harga = $harga_satuan * $qty;

        $query = "INSERT INTO transaksi_detail (barang_id, transaksi_id, qty, harga) 
          VALUES ('$barang_id', '$transaksi_id', '$qty', '$harga')";

        if(mysqli_query($conn, $query)){
            mysqli_query($conn, "UPDATE transaksi SET total = (SELECT SUM(harga) FROM transaksi_detail WHERE transaksi_id = $transaksi_id) WHERE id = $transaksi_id");

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
    <title>Tambah Data Detail Transaksi</title>
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
            margin: 40px;
            width: 350px;
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
        .error {
            color: red;
            font-size: 13px;
            margin: -8px 0 10px 0;
            display: block;
        }
    </style>
</head>
<body>
    <form method="POST" action="tambah_detail_transaksi.php">
            <div class="card">
                <h2>Tambah Detail Transaksi</h2>
                
                <label for="barang_id">Pilih Barang</label>
                <select name="barang_id" id="barang_id">
                    <option value="">Pilih Barang</option>
                    <?php while($b = mysqli_fetch_assoc($barang)): ?>
                        <option value="<?= $b['id']; ?>" <?= ($b['id'] == ($data['barang_id'] ?? '')) ? 'selected' : '' ?>>
                            <?= $b['nama_barang']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
                <span class="error"><?php echo $errors['barang_id'] ?? ""?></span>

                <label for="transaksi_id">ID Transaksi</label>
                <select name="transaksi_id" id="transaksi_id">
                    <option value="">Pilih ID Transaksi</option>
                    <?php while($t = mysqli_fetch_assoc($transaksi)): ?>
                        <option value="<?= $t['id']; ?>" <?= ($t['id'] == ($data['transaksi_id'] ?? '')) ? 'selected' : '' ?>>
                            <?= $t['id']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
                <span class="error"><?php echo $errors['transaksi_id'] ?? ""?></span>

                <label for="qty">Quantity</label>
                <input name="qty" id="qty" type="number" placeholder="Masukkan jumlah barang" value="<?= htmlspecialchars($data['qty'] ?? '') ?>">
                <span class="error"><?php echo $errors['qty'] ?? ""?></span>

                <button class="btn-tambah">Tambah Detail Transaksi</button>
            </div>
    </form>
</body>
</html>