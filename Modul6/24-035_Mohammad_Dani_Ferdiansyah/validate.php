<?php

// validasi transaksi
function validateWaktu($waktu_transaksi, &$errors) {
    $hari_ini = date('Y-m-d');
    if (empty($waktu_transaksi)){
        $errors['waktu_transaksi'] = "Waktu transaksi harus di pilih";
        return false;
    } elseif ($waktu_transaksi < $hari_ini) {
        $errors['waktu_transaksi'] = "Waktu transaksi tidak boleh kurang dari hari ini.";
        return false;
    }
    return true;
}

function validateKeterangan($keterangan, &$errors) {
    if (empty(trim($keterangan))){
        $errors['keterangan'] = "Keterangan tidak boleh kosong";
        return false;
    } elseif (strlen($keterangan) < 3) {
        $errors['keterangan'] = "Keterangan minimal 3 karakter.";
        return false;
    }
    return true;
}

function validatePelanggan($pelanggan_id, &$errors) {
    if (empty($pelanggan_id)){
        $errors['pelanggan_id'] = "Pelanggan harus dipilih";
        return false;
    } 
    return true;
}

// validasi detail transaksi
function validateBarang($barang_id, $transaksi_id = null, &$errors, $conn = null) {
    if (empty($barang_id)) {
        $errors['barang_id'] = "Barang harus dipilih.";
        return false;
    } elseif ($conn && $transaksi_id) {
        $barang_id = mysqli_real_escape_string($conn, $barang_id);
        $transaksi_id = mysqli_real_escape_string($conn, $transaksi_id);

        $check = mysqli_query($conn, 
            "SELECT * FROM transaksi_detail
             WHERE barang_id = '$barang_id' AND transaksi_id = '$transaksi_id'"
        );

            if (mysqli_num_rows($check) > 0) {
                $errors['barang_id'] = "Barang ini sudah ditambahkan pada transaksi ini.";
                return false;
            }
        }

        return true;
    }

function validateTransaksi($transaksi_id, &$errors) {
    if (empty($transaksi_id)) {
        $errors['transaksi_id'] = "ID Transaksi harus dipilih.";
        return false;
    }
    return true;
}

function validateQty($qty, &$errors) {
    if (empty($qty)) {
        $errors['qty'] = "Quantity tidak boleh kosong.";
        return false;
    } elseif ($qty <= 0) {
        $errors['qty'] = "Quantity harus lebih dari 0.";
        return false;
    }
    return true;
}

// validasi hapus barang
function validateHapusBarang($barang_id, &$errors, $conn) {
    if (empty($barang_id)) {
        $errors['hapus_barang'] = "ID Barang tidak ditemukan.";
        return false;
    }

    $barang_id = mysqli_real_escape_string($conn, $barang_id);
    $cek_query = "SELECT COUNT(*) AS total FROM transaksi_detail WHERE barang_id = '$barang_id'";
    $cek_result = mysqli_query($conn, $cek_query);
    $cek_data = mysqli_fetch_assoc($cek_result);

    if ($cek_data['total'] > 0) {
        $errors['hapus_barang'] = "Barang tidak dapat dihapus karena digunakan dalam transaksi detail.";
        return false;
    }

    return true;
}

?>