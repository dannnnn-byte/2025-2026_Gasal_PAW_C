-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 10 Nov 2025 pada 14.34
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(10) DEFAULT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id`, `kode_barang`, `nama_barang`, `harga`, `stok`, `supplier_id`) VALUES
(1, 'BRG001', 'Mouse Logitech', 150000, 20, 5),
(2, 'BRG002', 'Keyboard Mechanical', 350000, 15, 2),
(3, 'BRG003', 'Monitor 24 inch', 1250000, 10, 3),
(4, 'BRG004', 'Flashdisk 32GB', 80000, 25, 2),
(5, 'BRG005', 'Headset Gaming', 250000, 18, 1),
(6, 'BRG006', 'Harddisk Eksternal 1TB', 750000, 8, 3),
(7, 'BRG007', 'Headset Gaming', 250000, 18, 4),
(8, 'BRG008', 'Webcam Full HD', 300000, 10, 4),
(9, 'BRG009', 'Speaker Bluetooth', 200000, 15, 1),
(10, 'BRG010', 'Powerbank 10000mAh', 180000, 20, 1),
(11, 'BRG011', 'Powerbank 5000mAh', 18000, 202, 1),
(12, 'BRG012', 'Airphone', 250000, 23, 5),
(13, 'BRG013', 'Casing Iphone XI ProMax', 70000, 34, 4),
(14, 'BRG014', ' Rtx5060', 23671762, 4, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` varchar(20) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT 'L',
  `telp` varchar(12) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `jenis_kelamin`, `telp`, `alamat`) VALUES
('1', 'Dani', 'L', '0811111111', 'Sampang'),
('2', 'Nayla', 'P', '0822222222', 'Blega'),
('3', 'Dewi', 'P', '0833333333', 'Malang'),
('4', 'Agus', 'L', '0844444444', 'Surabaya'),
('5', 'Putri', 'P', '0855555555', 'Semarang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `waktu_bayar` datetime DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `metode` enum('TUNAI','TRANSFER','EDC') DEFAULT NULL,
  `transaksi_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `waktu_bayar`, `total`, `metode`, `transaksi_id`) VALUES
(1, '2025-11-01 09:00:00', 350000, 'TUNAI', 1),
(2, '2025-11-01 10:00:00', 1500000, 'TRANSFER', 2),
(3, '2025-11-02 11:00:00', 250000, 'EDC', 3),
(4, '2025-11-02 12:00:00', 80000, 'TUNAI', 4),
(5, '2025-11-03 09:30:00', 150000, 'TRANSFER', 5),
(6, '2025-11-03 10:45:00', 275000, 'TUNAI', 6),
(7, '2025-11-04 13:00:00', 1250000, 'EDC', 7),
(8, '2025-11-04 15:20:00', 300000, 'TUNAI', 8),
(9, '2025-11-05 09:15:00', 500000, 'TRANSFER', 9),
(10, '2025-11-05 11:45:00', 750000, 'TUNAI', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `telp` varchar(12) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `telp`, `alamat`) VALUES
(1, 'Toko Maju Jaya', '081234567890', 'Jakarta'),
(2, 'Sumber Rejeki', '082134567891', 'Surabaya'),
(3, 'Makmur Abadi', '083145678912', 'Bandung'),
(4, 'Cahaya Elektronik', '084156789123', 'Yogyakarta'),
(5, 'Mitra Jaya', '085167891234', 'Malang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `waktu_transaksi` date DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `total` int(11) DEFAULT 0,
  `pelanggan_id` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `waktu_transaksi`, `keterangan`, `total`, `pelanggan_id`) VALUES
(1, '2025-11-01', 'Pembelian pertama', 713600, '1'),
(2, '2025-11-01', 'Pembelian kedua', 2200000, '2'),
(3, '2025-11-02', 'Pembelian ketiga', 250000, '3'),
(4, '2025-11-02', 'Pembelian keempat', 80000, '4'),
(5, '2025-11-03', 'Pembelian kelima', 150000, '5'),
(6, '2025-11-03', 'Pembelian keenam', 275000, '1'),
(7, '2025-11-04', 'Pembelian ketujuh', 1250000, '2'),
(8, '2025-11-04', 'Pembelian kedelapan', 300000, '3'),
(9, '2025-11-05', 'Pembelian kesembilan', 500000, '4'),
(10, '2025-11-05', 'Pembelian kesepuluh', 750000, '5'),
(11, '2025-11-09', 'Pembelian kesebelas', 450000, '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `transaksi_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `harga` int(11) DEFAULT 0,
  `qty` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`transaksi_id`, `barang_id`, `harga`, `qty`) VALUES
(1, 1, 150000, 1),
(1, 2, 200000, 1),
(1, 10, 360000, 2),
(1, 11, 3600, 2),
(2, 3, 1250000, 1),
(2, 4, 250000, 1),
(3, 5, 250000, 1),
(4, 4, 80000, 1),
(5, 1, 150000, 1),
(6, 2, 275000, 1),
(7, 3, 1250000, 1),
(8, 5, 300000, 1),
(9, 1, 150000, 2),
(10, 2, 350000, 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_barang_supplier` (`supplier_id`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pembayaran_transaksi` (`transaksi_id`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_transaksi_pelanggan` (`pelanggan_id`);

--
-- Indeks untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`transaksi_id`,`barang_id`),
  ADD KEY `fk_td_barang` (`barang_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `fk_barang_supplier` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `fk_pembayaran_transaksi` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `fk_transaksi_pelanggan` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `fk_td_barang` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_td_transaksi` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
