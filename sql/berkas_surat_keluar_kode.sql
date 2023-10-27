-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Waktu pembuatan: 27 Okt 2023 pada 18.14
-- Versi server: 10.6.14-MariaDB-cll-lve
-- Versi PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u655189685_simrsmu`
--

--
-- Dumping data untuk tabel `berkas_surat_keluar_kode`
--

INSERT INTO `berkas_surat_keluar_kode` (`id`, `kode`, `nama`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'KEP', 'Surat Keputusan', NULL, NULL, NULL),
(2, 'PR', 'Surat Peraturan', NULL, NULL, NULL),
(3, 'EDR', 'Surat Edaran ', NULL, NULL, NULL),
(4, 'PER', 'Surat Pernyataan', NULL, NULL, NULL),
(5, 'KSA', 'Surat Kuasa', NULL, NULL, NULL),
(6, 'TGS', 'Surat Tugas', NULL, NULL, NULL),
(7, 'KET', 'Surat Keterangan', NULL, NULL, NULL),
(8, 'REK', 'Surat Rekomendasi', NULL, NULL, NULL),
(9, 'UND', 'Surat Undangan', NULL, NULL, NULL),
(10, 'PRJ', 'Surat Perjanjian', NULL, NULL, NULL),
(11, 'SPO', 'Standar Prosedur Operasional', NULL, NULL, NULL),
(12, 'LAI', 'Surat Lain Lain', NULL, NULL, NULL),
(13, 'PMH', 'Surat Permohonan', NULL, NULL, NULL),
(14, 'PMB', 'Surat Pemberitahuan (External)', NULL, NULL, NULL),
(15, 'SERT', 'Sertifikat', NULL, NULL, NULL),
(16, 'PNG', 'Surat Penugasan', NULL, NULL, NULL),
(17, 'SP', 'Surat Peringatan', NULL, NULL, NULL),
(18, 'PGT', 'Surat Pengantar', NULL, NULL, NULL),
(19, 'BA ', 'Berita Acara', NULL, NULL, NULL),
(20, 'SPM', 'Surat Perintah Membayar', NULL, NULL, NULL),
(21, 'PO', 'Surat Pemesanan', NULL, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
