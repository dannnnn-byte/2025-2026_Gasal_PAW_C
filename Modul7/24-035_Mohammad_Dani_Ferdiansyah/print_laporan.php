<?php
if (!isset($_GET['awal']) || !isset($_GET['akhir'])) {
    die("Parameter tanggal tidak dikirim.");
}

$conn = mysqli_connect("localhost", "root", "", "toko_dani");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$awal  = $_GET['awal'];
$akhir = $_GET['akhir'];

$q = mysqli_query($conn, "
    SELECT DATE(waktu_transaksi) AS tgl, SUM(total) AS total
    FROM transaksi
    WHERE DATE(waktu_transaksi) BETWEEN '$awal' AND '$akhir'
    GROUP BY DATE(waktu_transaksi)
    ORDER BY tgl ASC
");

$dataTanggal = [];
$dataTotal   = [];

while ($r = mysqli_fetch_assoc($q)) {
    $dataTanggal[] = $r['tgl'];
    $dataTotal[]   = $r['total'];
}

// Ambil total keseluruhan
$qTotal = mysqli_query($conn, "
    SELECT COUNT(*) AS pelanggan, SUM(total) AS pendapatan
    FROM transaksi
    WHERE DATE(waktu_transaksi) BETWEEN '$awal' AND '$akhir'
");
$total = mysqli_fetch_assoc($qTotal);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body { 
            font-family: Arial, sans-serif; 
            margin: 20px;
        }

        .header {
            background-color: #c0c2c5ff;
            color: white;
            padding: 14px;
            font-size: 20px;
            margin-bottom: 20px;
            border-radius: 6px;
        }

        button#backBtn {
            margin-bottom: 20px;
            padding: 8px 14px;
            font-size: 14px;
            cursor: pointer;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 6px;
            text-align: left;
        }

        h4 {
            margin-top: 30px;
        }

        @media print {
            @page {
                size: A4;
                margin: 10mm;
            }
            #backBtn { display: none; }
        }
    </style>
</head>
<body>

<div class="header">
    Rekap Laporan Penjualan <?= htmlspecialchars($awal) ?> sampai <?= htmlspecialchars($akhir) ?>
</div>

<button id="backBtn" onclick="history.back()">Kembali</button>

<canvas id="grafik" height="120"></canvas>

<script>
    const ctx = document.getElementById("grafik").getContext("2d");

    new Chart(ctx, {
        type: "bar",
        data: {
            labels: <?= json_encode($dataTanggal) ?>,
            datasets: [{
                label: "Total",
                data: <?= json_encode($dataTotal) ?>,
                backgroundColor: "#c0c2c5ff",
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    setTimeout(() => { window.print(); }, 800);
</script>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Total</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        mysqli_data_seek($q, 0);
        while ($r = mysqli_fetch_assoc($q)) { ?>
            <tr>
                <td><?= $no++ ?></td>
                <td>Rp<?= number_format($r['total'], 0, ",", ".") ?></td>
                <td><?= date("d M Y", strtotime($r['tgl'])) ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<table style="width:40%;">
    <tr>
        <th>Jumlah Pelanggan</th>
        <th>Jumlah Pendapatan</th>
    </tr>
    <tr>
        <td><?= $total['pelanggan'] ?> Orang</td>
        <td>Rp<?= number_format($total['pendapatan'], 0, ",", ".") ?></td>
    </tr>
</table>

</body>
</html>
