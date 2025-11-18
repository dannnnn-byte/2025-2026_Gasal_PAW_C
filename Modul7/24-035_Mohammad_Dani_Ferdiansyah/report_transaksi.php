<?php
$conn = mysqli_connect("localhost", "root", "", "toko_dani");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$awal  = isset($_GET['awal']) ? $_GET['awal'] : date("Y-m-d");
$akhir = isset($_GET['akhir']) ? $_GET['akhir'] : date("Y-m-d");

$q = mysqli_query($conn, "
    SELECT DATE(waktu_transaksi) AS tgl, SUM(total) AS total
    FROM transaksi
    WHERE DATE(waktu_transaksi) BETWEEN '$awal' AND '$akhir'
    GROUP BY DATE(waktu_transaksi)
");

$dataTanggal = [];
$dataTotal   = [];

while ($row = mysqli_fetch_assoc($q)) {
    $dataTanggal[] = $row['tgl'];
    $dataTotal[]   = $row['total'];
}

$q2 = mysqli_query($conn, "
    SELECT DATE(waktu_transaksi) AS tgl, SUM(total) AS total
    FROM transaksi
    WHERE DATE(waktu_transaksi) BETWEEN '$awal' AND '$akhir'
    GROUP BY DATE(waktu_transaksi)
");

$q3 = mysqli_query($conn, "
    SELECT COUNT(*) AS pelanggan, SUM(total) AS pendapatan
    FROM transaksi
    WHERE DATE(waktu_transaksi) BETWEEN '$awal' AND '$akhir'
");
$total = mysqli_fetch_assoc($q3);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<div class="container mt-3">

    <h4>Rekap Laporan Penjualan</h4>
    <a href="index.php" class="btn btn-secondary btn-sm mb-2">Kembali</a>

    <form method="GET" class="form-inline mt-3 mb-3">
        <input type="date" name="awal" class="form-control mr-2" value="<?= htmlspecialchars($awal) ?>">
        <input type="date" name="akhir" class="form-control mr-2" value="<?= htmlspecialchars($akhir) ?>">
        <button class="btn btn-success">Tampilkan</button>
    </form>

    <hr>

    <canvas id="grafik" height="90"></canvas>
    <script>
        const ctx = document.getElementById("grafik").getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($dataTanggal) ?>,
                datasets: [{
                    label: 'Total',
                    data: <?= json_encode($dataTotal) ?>,
                    backgroundColor: '#c0c2c5ff',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>

    <table class="table table-bordered">
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
            while ($r = mysqli_fetch_assoc($q2)) { ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td>Rp<?= number_format($r['total'], 0, ",", ".") ?></td>
                    <td><?= date("d M Y", strtotime($r['tgl'])) ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <table class="table table-bordered" style="width:40%">
        <tr>
            <th>Jumlah Pelanggan</th>
            <th>Jumlah Pendapatan</th>
        </tr>
        <tr>
            <td><?= $total['pelanggan'] ?> Orang</td>
            <td>Rp<?= number_format($total['pendapatan'], 0, ",", ".") ?></td>
        </tr>
    </table>

    <a href="print_laporan.php?awal=<?= $awal ?>&akhir=<?= $akhir ?>" class="btn btn-warning">Cetak</a>
    <a href="export_excel.php?awal=<?= $awal ?>&akhir=<?= $akhir ?>" class="btn btn-success">Excel</a>

</div>
</body>
</html>
