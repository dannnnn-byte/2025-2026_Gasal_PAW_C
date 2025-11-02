<?php
include "koneksi.php";

$id = $_GET['id'];

$hapus = mysqli_query($koneksi, "DELETE FROM supplier WHERE id='$id'");

if ($hapus) {
    session_start();
    $_SESSION['pesan'] = "Data berhasil dihapus.";
    header("Location: index.php");
    exit();
} else {
    echo "Gagal menghapus data: " . mysqli_error($koneksi);
}
?>
