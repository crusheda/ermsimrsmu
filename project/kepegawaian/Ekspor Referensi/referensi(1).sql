-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Sep 2024 pada 20.14
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simrspku`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `referensi`
--

CREATE TABLE `referensi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ref_jenis` int(11) NOT NULL,
  `queue` int(11) NOT NULL COMMENT 'Urutan Referensi berdasarkan Jenis',
  `deskripsi` varchar(255) NOT NULL,
  `color` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL COMMENT '1=aktif;0=nonaktif',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `referensi`
--

INSERT INTO `referensi` (`id`, `ref_jenis`, `queue`, `deskripsi`, `color`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'Laki-Laki', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(2, 1, 2, 'Perempuan', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(3, 2, 1, 'Tidak/Belum Sekolah', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(4, 2, 2, 'Belum Tamat SD/Sederajat', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(5, 2, 3, 'Tamat SD/Sederajat', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(6, 2, 4, 'SLTP/Sederajat', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(7, 2, 5, 'SLTA/Sederajat', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(8, 2, 6, 'Diploma I/II', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(9, 2, 7, 'Akademi/Diploma III/Sarjana Muda', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(10, 2, 8, 'Diploma IV/Strata I', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(11, 2, 9, 'Strata II', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(12, 2, 10, 'Strata III', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(13, 3, 1, 'A', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(14, 3, 2, 'B', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(15, 3, 3, 'AB', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(16, 3, 4, 'O', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(17, 3, 5, 'A+', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(18, 3, 6, 'A-', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(19, 3, 7, 'B+', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(20, 3, 8, 'B-', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(21, 3, 9, 'AB+', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(22, 3, 10, 'AB-', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(23, 3, 11, 'O-', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(24, 3, 12, 'O+', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(25, 3, 13, 'Tidak Tahu', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(26, 4, 1, 'Kepala Keluarga', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(27, 4, 2, 'Suami', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(28, 4, 3, 'Isteri', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(29, 4, 4, 'Anak', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(30, 4, 5, 'Menantu', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(31, 4, 6, 'Cucu', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(32, 4, 7, 'Orang Tua', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(33, 4, 8, 'Mertua', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(34, 4, 9, 'Family Lain', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(35, 4, 10, 'Pembantu', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(36, 4, 11, 'Lainnya', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(37, 5, 1, 'Islam', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(38, 5, 2, 'Kristen (Protestan)', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(39, 5, 3, 'Katholik', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(40, 5, 4, 'Hindu', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(41, 5, 5, 'Budha', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(42, 5, 6, 'Konghuchu', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(43, 5, 7, 'Kepercayaan Terhadap Tuhan YME / Penghayat', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(44, 6, 1, 'Belum/Tidak Bekerja', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(45, 6, 2, 'Mengurus Rumah Tangga', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(46, 6, 3, 'Pelajar/Mahasiswa', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(47, 6, 4, 'Pensiunan', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(48, 6, 5, 'Pegawai Negeri Sipil', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(49, 6, 6, 'Tentara Nasional Indonesia', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(50, 6, 7, 'Kepolisian RI', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(51, 6, 8, 'Perdagangan', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(52, 6, 9, 'Petani/Pekebun', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(53, 6, 10, 'Peternak', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(54, 6, 11, 'Nelayan/Perikanan', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(55, 6, 12, 'Industri', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(56, 6, 13, 'Konstruksi', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(57, 6, 14, 'Transportasi', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(58, 6, 15, 'Karyawan Swasta', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(59, 6, 16, 'Karyawan BUMN', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(60, 6, 17, 'Karyawan BUMD', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(61, 6, 18, 'Karyawan Honorer', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(62, 6, 19, 'Buruh Harian Lepas', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(63, 6, 20, 'Buruh Tani/Perkebunan', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(64, 6, 21, 'Buruh Nelayan/Perikanan', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(65, 6, 22, 'Buruh Peternakan', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(66, 6, 23, 'Pembantu Rumah Tangga', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(67, 6, 24, 'Tukang Cukur', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(68, 6, 25, 'Tukang Listrik', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(69, 6, 26, 'Tukang Batu', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(70, 6, 27, 'Tukang Kayu', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(71, 6, 28, 'Tukang Sol Sepatu', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(72, 6, 29, 'Tukang Las/Pandai Besi', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(73, 6, 30, 'Tukang Jahit', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(74, 6, 31, 'Tukang Gigi', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(75, 6, 32, 'Penata Rias', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(76, 6, 33, 'Penata Busana', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(77, 6, 34, 'Penata Rambut', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(78, 6, 35, 'Mekanik', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(79, 6, 36, 'Seniman', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(80, 6, 37, 'Tabib', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(81, 6, 38, 'Paraji', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(82, 6, 39, 'Perancang Busana', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(83, 6, 40, 'Penterjemah', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(84, 6, 41, 'Imam Mesjid', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(85, 6, 42, 'Pendeta', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(86, 6, 43, 'Pastor', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(87, 6, 44, 'Wartawan', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(88, 6, 45, 'Ustadz/Mubaligh', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(89, 6, 46, 'Juru Masak', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(90, 6, 47, 'Promotor Acara', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(91, 6, 48, 'Anggota DPR-RI', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(92, 6, 49, 'Anggota DPD', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(93, 6, 50, 'Anggota BPK', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(94, 6, 51, 'Presiden', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(95, 6, 52, 'Wakil Presiden', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(96, 6, 53, 'Anggota Mahkamah Konstitusi', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(97, 6, 54, 'Anggota Kabinet/Kementerian', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(98, 6, 55, 'Duta Besar', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(99, 6, 56, 'Gubernur', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(100, 6, 57, 'Wakil Gubernur', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(101, 6, 58, 'Bupati', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(102, 6, 59, 'Wakil Bupati', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(103, 6, 60, 'Walikota', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(104, 6, 61, 'Wakil Walikota', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(105, 6, 62, 'Anggota DPRD Provinsi', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(106, 6, 63, 'Anggota DPRD Kabupaten/Kota', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(107, 6, 64, 'Dosen', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(108, 6, 65, 'Guru', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(109, 6, 66, 'Pilot', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(110, 6, 67, 'Pengacara', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(111, 6, 68, 'Notaris', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(112, 6, 69, 'Arsitek', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(113, 6, 70, 'Akuntan', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(114, 6, 71, 'Konsultan', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(115, 6, 72, 'Dokter', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(116, 6, 73, 'Bidan', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(117, 6, 74, 'Perawat', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(118, 6, 75, 'Apoteker', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(119, 6, 76, 'Psikiater/Psikolog', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(120, 6, 77, 'Penyiar Televisi', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(121, 6, 78, 'Penyiar Radio', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(122, 6, 79, 'Pelaut', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(123, 6, 80, 'Peneliti', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(124, 6, 81, 'Sopir', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(125, 6, 82, 'Pialang', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(126, 6, 83, 'Paranormal', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(127, 6, 84, 'Pedagang', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(128, 6, 85, 'Perangkat Desa', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(129, 6, 86, 'Kepala Desa', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(130, 6, 87, 'Biarawati', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(131, 6, 88, 'Wiraswasta', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(132, 6, 89, 'Lainnya', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(133, 6, 90, 'Anggota DPRD', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(134, 6, 91, 'Mubalig', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(135, 7, 1, 'Belum Kawin', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(136, 7, 2, 'Kawin', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(137, 7, 3, 'Cerai Hidup', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(138, 7, 4, 'Cerai Mati', '', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(139, 8, 1, 'STR', '#00C5FC', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(140, 8, 2, 'SIP', '#FD6BFF', 1, '2024-08-23 07:04:00', '2024-08-23 07:04:00', NULL),
(141, 8, 3, 'BTCLS/ACLS', NULL, 1, NULL, NULL, NULL),
(142, 9, 1, 'Mutasi', NULL, 1, NULL, NULL, NULL),
(143, 9, 2, 'Promosi', NULL, 1, NULL, NULL, NULL),
(144, 9, 3, 'Demosi', NULL, 1, NULL, NULL, NULL),
(145, 10, 1, 'THL (Tenaga Harian Lepas)', NULL, 1, NULL, NULL, NULL),
(146, 10, 2, 'Kontrak', NULL, 1, NULL, NULL, NULL),
(147, 10, 3, 'Tetap', NULL, 1, NULL, NULL, NULL),
(148, 10, 4, 'Resign', NULL, 1, NULL, NULL, NULL),
(149, 10, 5, 'Pensiun / Purnabakti', NULL, 1, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `referensi`
--
ALTER TABLE `referensi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `referensi`
--
ALTER TABLE `referensi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;