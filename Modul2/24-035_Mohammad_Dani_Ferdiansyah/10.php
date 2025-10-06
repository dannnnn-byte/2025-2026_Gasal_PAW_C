<form method="post">
    <h3>Menu Kasir</h3>
    <p>Nasi Goreng (Rp 15.000) Jumlah: <input type="number" name="menu[nasgor]" value="0"></p>
    <p>Mie Ayam (Rp 12.000) Jumlah: <input type="number" name="menu[mie]" value="0"></p>
    <p>Es Teh (Rp 5.000) Jumlah: <input type="number" name="menu[esteh]" value="0"></p>
    <p>Kopi (Rp 8.000) Jumlah: <input type="number" name="menu[kopi]" value="0"></p>
    <input type="submit" name="hitung" value="Hitung Total">
</form>

<?php
if (isset($_POST['hitung'])) {
    $harga = [
        "nasgor" => 15000,
        "mie"    => 12000,
        "esteh"  => 5000,
        "kopi"   => 8000
    ];

    $total = 0;

    echo "<h3>Detail Pesanan:</h3>";

    foreach ($_POST['menu'] as $nama => $jumlah) {
        if ($jumlah > 0) {
            $subtotal = $jumlah * $harga[$nama];
            $total += $subtotal;
            echo ucfirst($nama) . " ($jumlah x Rp " . number_format($harga[$nama], 0, ',', '.') . ") = Rp " . number_format($subtotal, 0, ',', '.') . "<br>";
        }
    }

    echo "<h3>Total Belanja: Rp " . number_format($total, 0, ',', '.') . "</h3>";
}
?>
