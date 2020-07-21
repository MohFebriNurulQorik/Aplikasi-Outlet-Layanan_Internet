-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Jul 2020 pada 04.11
-- Versi server: 10.1.35-MariaDB
-- Versi PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aplikasi_data_internet`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `layanan`
--

CREATE TABLE `layanan` (
  `Id` int(11) NOT NULL,
  `Nama_layanan` varchar(255) NOT NULL,
  `Biaya_berlangganan` int(11) NOT NULL,
  `Bandwith` varchar(255) NOT NULL,
  `Kapasitas_jaringan` varchar(255) NOT NULL,
  `Kecepatan_transfer_data` varchar(255) NOT NULL,
  `Type` enum('Prabayar','Pascabayar') NOT NULL DEFAULT 'Prabayar',
  `Status` enum('Aktif','Non Aktif') NOT NULL DEFAULT 'Aktif',
  `des` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `layanan`
--

INSERT INTO `layanan` (`Id`, `Nama_layanan`, `Biaya_berlangganan`, `Bandwith`, `Kapasitas_jaringan`, `Kecepatan_transfer_data`, `Type`, `Status`, `des`, `created_at`, `updated_at`) VALUES
(1, 'Paket Data Chlid', 100000, '10 Mbps', '10', '5 Mbps', 'Prabayar', 'Aktif', NULL, '2020-07-20 19:08:40', '2020-07-20 19:08:40'),
(2, 'Paket Data Adult', 200000, '30 Mbps', '20', '10 Mbps', 'Prabayar', 'Aktif', NULL, '2020-07-20 19:08:47', '2020-07-20 19:08:47'),
(3, 'Paket Data Old', 300000, '100 Mbps', '50', '50 Mbps', 'Prabayar', 'Aktif', NULL, '2020-07-20 18:32:46', '2020-07-20 18:32:52'),
(4, 'Paket Data Chlid Pascabayar ', 100000, '10 Mbps', '5', '10 Mbps', 'Pascabayar', 'Aktif', NULL, '2020-07-20 19:24:49', '2020-07-20 19:24:49'),
(6, 'Paket Data Chlid Pascabayar ', 100000, '10 Mbps', '5', '10 Mbps', 'Pascabayar', 'Aktif', NULL, '2020-07-20 21:32:08', '2020-07-20 21:32:08'),
(7, 'Paket Data Chlid Pascabayar ', 100000, '10 Mbps', '5', '10 Mbps', 'Pascabayar', 'Aktif', NULL, '2020-07-20 21:32:22', '2020-07-20 21:32:22'),
(8, 'Paket Data Chlid Pascabayar ', 100000, '10 Mbps', '5', '10 Mbps', 'Pascabayar', 'Aktif', NULL, '2020-07-20 21:33:58', '2020-07-20 21:33:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rules`
--

CREATE TABLE `rules` (
  `id` int(11) NOT NULL,
  `name_rules` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rules`
--

INSERT INTO `rules` (`id`, `name_rules`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2020-07-20 08:58:06', '2020-07-20 08:58:09'),
(2, 'Pelanggan', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `Id` int(11) NOT NULL,
  `Id_users` int(11) NOT NULL,
  `Id_layanan` int(11) NOT NULL,
  `Priode_start` datetime DEFAULT NULL,
  `Priode_end` datetime DEFAULT NULL,
  `Status_pembayaran` enum('Bayar','Tidak Bayar') DEFAULT NULL,
  `Tgl_bayar` datetime DEFAULT NULL,
  `Nominal_dibayarkan` int(11) DEFAULT NULL,
  `Status_penagihan` enum('Telah Ditagihkan','Belum Ditagihkan') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`Id`, `Id_users`, `Id_layanan`, `Priode_start`, `Priode_end`, `Status_pembayaran`, `Tgl_bayar`, `Nominal_dibayarkan`, `Status_penagihan`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '2020-07-22 18:09:53', '2020-08-22 18:10:04', 'Bayar', '2020-07-22 18:10:22', 100000, 'Telah Ditagihkan', '2020-07-20 11:11:33', '2020-07-20 21:14:05'),
(2, 3, 1, '2020-07-20 18:11:44', '2020-08-20 18:11:50', 'Bayar', '2020-07-20 18:12:06', 100000, 'Telah Ditagihkan', '2020-07-20 11:13:23', '2020-07-20 21:14:09'),
(3, 2, 3, '2020-06-02 04:13:12', '2020-07-21 04:13:20', 'Bayar', '2020-07-21 04:13:34', 300000, 'Telah Ditagihkan', '2020-07-20 21:14:14', '2020-07-20 21:14:18'),
(4, 2, 3, '2020-07-20 18:12:06', '2020-08-20 18:12:06', 'Bayar', '2020-07-20 18:12:06', 1000000, 'Telah Ditagihkan', '2020-07-20 21:26:06', '2020-07-20 21:26:06'),
(5, 2, 3, '2020-07-20 18:12:06', '2020-08-20 18:12:06', 'Bayar', '2020-07-20 18:12:06', 1000000, 'Telah Ditagihkan', '2020-07-20 21:32:11', '2020-07-20 21:32:11'),
(6, 2, 3, '2020-07-20 18:12:06', '2020-08-20 18:12:06', 'Bayar', '2020-07-20 18:12:06', 1000000, 'Telah Ditagihkan', '2020-07-20 21:32:26', '2020-07-20 21:32:26'),
(7, 2, 3, '2020-07-20 18:12:06', '2020-08-20 18:12:06', 'Bayar', '2020-07-20 18:12:06', 1000000, 'Telah Ditagihkan', '2020-07-20 21:34:01', '2020-07-20 21:34:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adress` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles_id` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('AKTIF','NON AKTIF') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `email`, `adress`, `token`, `password`, `roles_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '081216655555', 'admin@gmail.com', 'Surabaya', '21232f297a57a5a743894a0e4a801fc3', 'admin123', '1', 'AKTIF', '2020-07-20 09:22:12', '2020-07-20 09:22:12'),
(2, 'Moh. Febri Nurul Qorik', '081216627447', 'mohfebrinq@gmail.com', 'Situbondo', '24c9e15e52afc47c225b757e7bee1f9d', 'user123', '2', 'AKTIF', '2020-07-20 09:23:15', '2020-07-20 09:23:15'),
(3, 'Meili Noni Arfianti', '081231888428', 'meilinoniarfianti@gmail.com', 'Jember', '7e58d63b60197ceb55a1c487989a3720', 'user123', '3', 'AKTIF', '2020-07-20 09:22:44', '2020-07-20 09:22:44'),
(4, 'Test', '081216627447', 'hasanah@gmail.com', 'Situbondo', '9pgVvbnKDv', 'Tes_baru123', '2', 'AKTIF', '2020-07-20 18:52:58', '2020-07-20 21:33:56'),
(5, 'Test', '081216627447', 'Test@gmail.com', 'Situbondo', 'arHIwgkSvs', 'Tes_baru123', '2', 'AKTIF', '2020-07-20 18:21:31', '2020-07-20 18:21:31');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`Id`);

--
-- Indeks untuk tabel `rules`
--
ALTER TABLE `rules`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`Id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `layanan`
--
ALTER TABLE `layanan`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `rules`
--
ALTER TABLE `rules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
