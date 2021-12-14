-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2021 at 03:25 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `monitoring_sppd`
--

-- --------------------------------------------------------

--
-- Table structure for table `sppd`
--

CREATE TABLE `sppd` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sppd_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ipa_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pp_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pegawai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sppd_tujuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sppd_alasan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sppd_kendaraan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sppd_tgl_msk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `op_pengisi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_kerja` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ipa_nilai` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sumber_dana` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `tgl_berangkat` date NOT NULL,
  `tgl_pulang` date NOT NULL,
  `ipa_tgl_dibuat` date DEFAULT NULL,
  `ipa_tgl_diajukan` date DEFAULT NULL,
  `ipa_tgl_approval` date DEFAULT NULL,
  `ipa_tgl_msk_finance` date DEFAULT NULL,
  `ipa_tgl_selesai` date DEFAULT NULL,
  `pp_tgl_dibuat` date DEFAULT NULL,
  `pp_tgl_diajukan` date DEFAULT NULL,
  `pp_tgl_approval` date DEFAULT NULL,
  `pp_tgl_msk_finance` date DEFAULT NULL,
  `pp_tgl_selesai` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sppd`
--

INSERT INTO `sppd` (`id`, `sppd_no`, `ipa_no`, `pp_no`, `pegawai`, `sppd_tujuan`, `sppd_alasan`, `sppd_kendaraan`, `sppd_tgl_msk`, `op_pengisi`, `unit_kerja`, `ipa_nilai`, `sumber_dana`, `keterangan`, `status`, `tgl_berangkat`, `tgl_pulang`, `ipa_tgl_dibuat`, `ipa_tgl_diajukan`, `ipa_tgl_approval`, `ipa_tgl_msk_finance`, `ipa_tgl_selesai`, `pp_tgl_dibuat`, `pp_tgl_diajukan`, `pp_tgl_approval`, `pp_tgl_msk_finance`, `pp_tgl_selesai`, `created_at`, `updated_at`) VALUES
(1, 'dummy1', 'ipa.1.2021', NULL, 'rafi, Ari', 'Surabaya', 'mengantar', 'Kendaraan Darat', '2021-11-10', 'Ady', NULL, '250000', 'Sekretariat dan Urusan Umum', NULL, 3, '2021-11-01', '2021-11-03', '2021-11-11', '2021-11-26', '2021-11-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-11-26 00:57:20', '2021-11-26 01:58:51'),
(2, 'AG.TR.04.124', '002.00/7814/XI/2021', NULL, 'Richad Rambi', 'Malang', 'Mengantar Dirops Kunjungan Kerja Trans Jawa Toll', 'Kendaraan Dinas/Pribadi', '2021-11-22', 'Rika', 'HC&GA', '1000000', 'Sekretariat dan Urusan Umum', NULL, 3, '2021-11-15', '2021-11-18', '2021-11-23', '2021-12-25', '2021-12-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-12-05 18:17:47', '2021-12-05 18:17:47'),
(3, 'AG.TR.04.105', '002.00/7525/X/2021', NULL, 'Ari Setyawan', 'Yogyakarta', 'Kunjungan Dinas Ke Yokyakarta', 'Kendaraan Dinas/Pribadi', '2021-10-21', 'Rika', 'HC&GA', '1350000', 'Sekretariat dan Urusan Umum', NULL, 3, '2021-10-15', '2021-10-17', '2021-10-21', '2021-10-22', '2021-10-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-12-05 18:24:36', '2021-12-05 18:24:36'),
(4, 'AG.TR.04.109', '002.00/7541/X/2021', NULL, 'Mamat Supriadi', 'Bandung', 'Mengantar Dirut PT JMTM Pak Rudi Hardiansyah', 'Kendaraan Dinas/Pribadi', '2021-10-22', 'Rika', 'HC&GA', '250000', 'Sekretariat dan Urusan Umum', NULL, 3, '2021-10-20', '2021-10-20', '2021-10-22', '2021-10-22', '2021-10-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-12-05 18:27:13', '2021-12-05 18:27:13'),
(5, 'AG.TR.04.101', '002.00/7509/X/2021', NULL, 'Duranda', 'Solo', 'Mengantar Direksi Pak Adhi Kris kunjungan ke Solo', 'Kendaraan Dinas/Pribadi', '2021-10-19', 'Rika', 'HC&GA', '1000000', 'Sekretariat dan Urusan Umum', NULL, 1, '2021-10-15', '2021-10-18', '2021-10-21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-12-05 18:28:46', '2021-12-05 18:28:46'),
(6, 'AG.TR.04.117', '002.00/7665/XI/2021', NULL, 'Agus Joko Nugroho', 'Semarang', 'Mengantar Kunjungan Kerja ke Proyek Kawasan Industri Kenda', 'Kendaraan Darat', '2021-11-02', 'Ady', NULL, NULL, NULL, NULL, 0, '2021-10-29', '2021-10-30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-12-05 18:31:59', '2021-12-05 19:18:39'),
(7, 'AG.TR.116', '002.00/7665/XI/2021', NULL, 'Agus Joko Nugroho', 'Bandung', 'Mengantar GM untuk Proyek Pengukuran Beban Kerja dan Monitoring Dokumen Kerja', 'Kendaraan Dinas/Pribadi', '2021-11-02', 'Rika', 'HC&GA', '1000000', 'Sekretariat dan Urusan Umum', NULL, 3, '2021-10-04', '2021-10-04', '2021-11-08', '2021-11-09', '2021-11-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-12-05 18:34:51', '2021-12-05 18:34:51'),
(8, 'AG.TR.120', '002.00/7665/XI/2021', NULL, 'Agus Joko Nugroho', 'Bandung', 'Mengantar GM Corporate Planning Finance,Tax & Accounting', 'Kendaraan Dinas/Pribadi', '2021-11-03', 'Rika', 'HC&GA', NULL, NULL, NULL, 0, '2021-10-28', '2021-10-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-12-05 19:18:25', '2021-12-05 19:18:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sppd`
--
ALTER TABLE `sppd`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sppd`
--
ALTER TABLE `sppd`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
