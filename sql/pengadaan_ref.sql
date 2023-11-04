-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Waktu pembuatan: 04 Nov 2023 pada 11.10
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
-- Dumping data untuk tabel `pengadaan_ref`
--

INSERT INTO `pengadaan_ref` (`id`, `nama`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'ATK Cetak', NULL, NULL, NULL),
(2, 'Alkes', NULL, NULL, NULL),
(3, 'Sarpras Non Alkes', NULL, NULL, NULL),
(4, 'Obat dan BHP Medis', NULL, NULL, NULL),
(5, 'BHP Non Medis dan Rumah Tangga', NULL, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
