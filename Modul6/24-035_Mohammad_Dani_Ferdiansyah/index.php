<?php

require 'validate.php';
$conn = mysqli_connect("localhost", "root", "", "toko");

$query_barang = "
    SELECT barang.*, supplier.nama AS nama_supplier
    FROM barang
    INNER JOIN supplier ON barang.supplier_id = supplier.id
    ORDER BY barang.id ASC
";
$result_barang = mysqli_query($conn, $query_barang);

$query_transaksi = "
    SELECT transaksi.*, pelanggan.nama AS nama_pelanggan
    FROM transaksi
    INNER JOIN pelanggan ON transaksi.pelanggan_id = pelanggan.id
    ORDER BY transaksi.id ASC
";
$result_transaksi = mysqli_query($conn, $query_transaksi);

$query_transaksi_detail = "
    SELECT transaksi_detail.*, barang.nama_barang, barang.harga
    FROM transaksi_detail
    INNER JOIN barang ON transaksi_detail.barang_id = barang.id
    ORDER BY transaksi_detail.transaksi_id ASC
";
$result_transaksi_detail = mysqli_query($conn, $query_transaksi_detail);

$errors = [];
if (isset($_GET["id"])) {
    $id = $_GET['id'];

    $valid_hapus = validateHapusBarang($id, $errors, $conn);

    if (!$valid_hapus) {
        echo "<script>
                alert('Barang tidak dapat dihapus karena digunakan dalam transaksi detail.');
                window.location.href='index.php';
              </script>";
        exit;
    } else {
        $query = "DELETE FROM barang WHERE id = $id";
        if (mysqli_query($conn, $query)) {
            echo "<script>
                    alert('Barang berhasil dihapus.');
                    window.location.href='index.php';
                  </script>";
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
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 15px 40px 40px 40px;
            background-color: #f5f5f5ff;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        th {
            background-color: #007bff;
            color: #ffffffff;
            padding: 10px;
            text-align: left;
        }
        td {
            padding: 15px 10px;
            border-bottom: 1px solid #ddd;
        }
        tr:hover {
            color: royalblue;
            background-color: #f2f2f2;
        }
        .btn-tambah {
            background-color: royalblue;
            color: white;
            padding: 8px 14px;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            cursor: pointer;
        }
        .btn-tambah:hover {
            background-color: #0046d6;
        }
        .btn-hapus {
            color: white;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            padding: 8px 14px;
            font-size: 14px;
            background-color: #dc3545;
        }
        .btn-hapus:hover {
            background-color: #c82333;
        }
        .flex-container {
            display: flex;
            justify-content: space-between;
            gap: 30px;
        }
        .table-box {
            flex: 1;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Pengelolaan Master Detail</h2>
    </div>

    <!-- Barang -->
    <h3>Barang</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Nama Supplier</th>
            <th>Action</th>
        </tr>
        <?php 
            while($row = mysqli_fetch_assoc($result_barang)): 
        ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['kode_barang'] ?></td>
            <td><?= $row['nama_barang'] ?></td>
            <td><?= $row['harga'] ?></td>
            <td><?= $row['stok'] ?></td>
            <td><?= $row['nama_supplier'] ?></td>
            <td>
                <div class="btn-container">
                    <a href="index.php?id=<?php echo $row["id"]?>" onclick="return confirm('Anda yakin akan menghapus barang ini?')" class="btn-hapus">Hapus</a>
                </div>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <div class="flex-container">
        <div class="table-box">
            <!-- Transaksi -->
            <h3>Transaksi</h3>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Waktu Transaksi</th>
                    <th>Keterangan</th>
                    <th>Total</th>
                    <th>Nama Pelanggan</th>
                </tr>
                <?php 
                    while($row = mysqli_fetch_assoc($result_transaksi)): 
                ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['waktu_transaksi'] ?></td>
                    <td><?= $row['keterangan'] ?></td>
                    <td><?= $row['total'] ?></td>
                    <td><?= $row['nama_pelanggan'] ?></td>
                </tr>
                <?php endwhile; ?>
            </table> 
        </div>
        <div class="table-box">
            <!-- Transaksi Detail -->
            <h3>Transaksi Detail</h3>
            <table>
                <tr>
                    <th>Transaksi ID</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Qty</th>
                </tr>
                <?php 
                    while($row = mysqli_fetch_assoc($result_transaksi_detail)): 
                ?>
                <tr>
                    <td><?= $row['transaksi_id'] ?></td>
                    <td><?= $row['nama_barang'] ?></td>
                    <td><?= $row['harga'] ?></td>
                    <td><?= $row['qty'] ?></td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>
    <br>
    <br>
    <div class="btn-container">
        <a href="tambah_transaksi.php" class="btn-tambah">Tambah Transaksi</a>
        <a href="tambah_detail_transaksi.php" class="btn-tambah">Tambah Detail Transaksi</a>
    </div>
</body>
</html>