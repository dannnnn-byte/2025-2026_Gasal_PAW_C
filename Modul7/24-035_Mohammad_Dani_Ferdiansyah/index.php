<?php 
$conn = mysqli_connect("localhost", "root", "", "toko_dani");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi</title>
    <style>
        .custom-btn {
            display: inline-block;
            padding: 10px 15px;
            background-color: #818487; /* warna abu gelap */
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            border-radius: 6px;
            transition: background-color 0.3s, transform 0.2s;
            margin-bottom: 20px;
        }

        .custom-btn:hover {
            background-color: #f4f4f4;
            color: #000;
            transform: translateY(-2px);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        thead {
            background-color: #343a40;
            color: #fff;
        }

        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

    <a href="report_transaksi.php" class="custom-btn">Lihat Laporan Penjualan</a>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID Transaksi</th>
                <th>Waktu Transaksi</th>
                <th>Keterangan</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            $q = mysqli_query($conn, "SELECT * FROM transaksi ORDER BY waktu_transaksi ASC");
            while ($row = mysqli_fetch_assoc($q)) {
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['waktu_transaksi'] ?></td>
                    <td><?= $row['keterangan'] ?></td>
                    <td>Rp<?= number_format($row['total'], 0, ",", ".") ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</body>
</html>
