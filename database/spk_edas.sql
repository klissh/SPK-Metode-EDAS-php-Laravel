-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Waktu pembuatan: 12 Bulan Mei 2025 pada 09.45
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
-- Database: `spk_edas`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alternatifs`
--

CREATE TABLE `alternatifs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `nama_alternatif` varchar(255) NOT NULL,
  `jenis_analisis_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `alternatifs`
--

INSERT INTO `alternatifs` (`id`, `code`, `nama_alternatif`, `jenis_analisis_id`, `created_at`, `updated_at`) VALUES
(2, 'A1', 'Heru', 3, '2025-05-02 02:19:52', '2025-05-02 05:10:54'),
(3, 'A2', 'Nurdin', 3, '2025-05-02 02:28:38', '2025-05-02 02:44:09'),
(5, 'A1', 'Asus', 4, '2025-05-02 02:44:57', '2025-05-02 02:44:57'),
(6, 'A2', 'Lenovo', 4, '2025-05-02 02:50:27', '2025-05-02 02:50:27'),
(7, 'A3', 'Yanto', 3, '2025-05-02 03:53:29', '2025-05-02 03:53:29'),
(8, 'A4', 'Toni', 3, '2025-05-02 03:53:36', '2025-05-02 03:53:36'),
(9, 'A5', 'husein', 3, '2025-05-02 03:53:45', '2025-05-02 07:12:49'),
(13, 'A1', 'A1', 5, '2025-05-07 22:10:54', '2025-05-11 08:53:29'),
(14, 'A2', 'A2', 5, '2025-05-07 22:11:08', '2025-05-07 22:11:08'),
(15, 'A3', 'A3', 5, '2025-05-07 22:11:17', '2025-05-07 22:11:17'),
(16, 'A4', 'A4', 5, '2025-05-07 22:11:24', '2025-05-07 22:11:24'),
(17, 'A5', 'A5', 5, '2025-05-07 22:11:35', '2025-05-07 22:11:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_analisis`
--

CREATE TABLE `jenis_analisis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jenis_analisis`
--

INSERT INTO `jenis_analisis` (`id`, `nama`, `user_id`, `created_at`, `updated_at`) VALUES
(3, 'Pekerjaan', 1, '2025-05-02 01:21:42', '2025-05-02 01:21:42'),
(4, 'Laptop', 1, '2025-05-02 01:22:42', '2025-05-02 01:22:42'),
(5, 'contoh', 1, '2025-05-07 22:10:29', '2025-05-07 22:10:29'),
(6, 'TI MSU 4', 2, '2025-05-12 00:33:43', '2025-05-12 00:33:43');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriterias`
--

CREATE TABLE `kriterias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `nama_kriteria` varchar(255) NOT NULL,
  `tipe` enum('benefit','cost') NOT NULL,
  `jenis_analisis_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `bobot` double(8,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kriterias`
--

INSERT INTO `kriterias` (`id`, `code`, `nama_kriteria`, `tipe`, `jenis_analisis_id`, `created_at`, `updated_at`, `bobot`) VALUES
(2, 'C1', 'Penjualan', 'benefit', 3, '2025-05-02 02:20:40', '2025-05-02 06:54:10', 0.40),
(7, 'C1', 'RAM', 'benefit', 4, '2025-05-02 03:40:27', '2025-05-02 03:40:27', 0.40),
(8, 'C2', 'CPU', 'benefit', 4, '2025-05-02 03:40:40', '2025-05-02 03:40:40', 0.30),
(9, 'C2', 'Sikap', 'benefit', 3, '2025-05-02 03:54:15', '2025-05-02 07:51:12', 0.25),
(10, 'C3', 'Daftar Hadir', 'benefit', 3, '2025-05-02 03:54:31', '2025-05-02 06:56:46', 0.25),
(11, 'C4', 'Kemampuan Komunikasi', 'benefit', 3, '2025-05-02 03:54:40', '2025-05-02 03:54:40', 0.05),
(12, 'C5', 'Pengetahuan Produk', 'benefit', 3, '2025-05-02 03:54:57', '2025-05-02 03:54:57', 0.05),
(16, 'C1', 'C1', 'benefit', 5, '2025-05-07 22:12:08', '2025-05-11 08:53:52', 0.30),
(17, 'C2', 'C2', 'benefit', 5, '2025-05-07 22:12:27', '2025-05-07 22:12:27', 0.20),
(18, 'C3', 'C3', 'benefit', 5, '2025-05-07 22:12:45', '2025-05-07 22:12:45', 0.20),
(19, 'C4', 'C4', 'cost', 5, '2025-05-07 22:12:59', '2025-05-07 22:12:59', 0.15),
(20, 'C5', 'C5', 'cost', 5, '2025-05-07 22:13:17', '2025-05-07 22:13:17', 0.15);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(9, '2025_05_02_070737_add_jenis_analisis_to_kriterias_alternatifs_subkriterias', 3),
(10, '0001_01_01_000000_create_users_table', 4),
(11, '0001_01_01_000001_create_cache_table', 4),
(12, '0001_01_01_000002_create_jobs_table', 4),
(13, '2025_05_01_072152_create_kriterias_table', 4),
(14, '2025_05_01_072152_create_sub_kriterias_table', 4),
(15, '2025_05_01_072153_create_alternatifs_table', 4),
(16, '2025_05_01_072154_create_nilai_alternatifs_table', 4),
(17, '2025_05_02_072910_create_jenis_analisis_table', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai_alternatifs`
--

CREATE TABLE `nilai_alternatifs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `alternatif_id` bigint(20) UNSIGNED DEFAULT NULL,
  `kriteria_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sub_kriteria_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `nilai_alternatifs`
--

INSERT INTO `nilai_alternatifs` (`id`, `alternatif_id`, `kriteria_id`, `sub_kriteria_id`, `created_at`, `updated_at`) VALUES
(7, 5, 7, 6, '2025-05-02 03:41:40', '2025-05-02 07:43:46'),
(8, 5, 8, 7, '2025-05-02 03:41:40', '2025-05-02 03:41:40'),
(9, 6, 7, 6, '2025-05-02 03:41:40', '2025-05-02 03:41:40'),
(10, 6, 8, 8, '2025-05-02 03:41:40', '2025-05-02 03:41:40'),
(13, 2, 2, 9, '2025-05-02 04:00:05', '2025-05-02 04:00:05'),
(14, 2, 9, 14, '2025-05-02 04:00:05', '2025-05-02 04:00:05'),
(15, 2, 10, 21, '2025-05-02 04:00:05', '2025-05-02 04:00:05'),
(16, 2, 11, 25, '2025-05-02 04:00:05', '2025-05-02 04:00:05'),
(17, 2, 12, 29, '2025-05-02 04:00:05', '2025-05-02 04:00:05'),
(18, 3, 2, 10, '2025-05-02 04:00:05', '2025-05-02 04:00:05'),
(19, 3, 9, 15, '2025-05-02 04:00:05', '2025-05-02 04:00:05'),
(20, 3, 10, 19, '2025-05-02 04:00:05', '2025-05-02 04:00:05'),
(21, 3, 11, 27, '2025-05-02 04:00:05', '2025-05-02 04:00:05'),
(22, 3, 12, 31, '2025-05-02 04:00:05', '2025-05-02 04:00:05'),
(23, 7, 2, 11, '2025-05-02 04:00:05', '2025-05-02 04:00:05'),
(24, 7, 9, 16, '2025-05-02 04:00:05', '2025-05-02 04:00:05'),
(25, 7, 10, 20, '2025-05-02 04:00:05', '2025-05-02 04:00:05'),
(26, 7, 11, 24, '2025-05-02 04:00:05', '2025-05-02 04:00:05'),
(27, 7, 12, 32, '2025-05-02 04:00:05', '2025-05-02 04:00:05'),
(28, 8, 2, 10, '2025-05-02 04:00:05', '2025-05-02 04:00:05'),
(29, 8, 9, 14, '2025-05-02 04:00:05', '2025-05-02 04:00:05'),
(30, 8, 10, 21, '2025-05-02 04:00:05', '2025-05-02 04:00:05'),
(31, 8, 11, 25, '2025-05-02 04:00:05', '2025-05-02 04:00:05'),
(32, 8, 12, 30, '2025-05-02 04:00:05', '2025-05-02 04:00:05'),
(33, 9, 2, 9, '2025-05-02 04:00:05', '2025-05-02 04:00:05'),
(34, 9, 9, 14, '2025-05-02 04:00:05', '2025-05-02 04:00:05'),
(35, 9, 10, 20, '2025-05-02 04:00:05', '2025-05-02 04:00:05'),
(36, 9, 11, 26, '2025-05-02 04:00:05', '2025-05-02 04:00:05'),
(37, 9, 12, 31, '2025-05-02 04:00:05', '2025-05-02 04:00:05'),
(38, 13, 16, 35, '2025-05-07 22:24:30', '2025-05-07 22:24:30'),
(39, 13, 17, 39, '2025-05-07 22:24:30', '2025-05-07 22:24:30'),
(40, 13, 18, 47, '2025-05-07 22:24:31', '2025-05-07 22:28:42'),
(41, 13, 19, 52, '2025-05-07 22:24:31', '2025-05-07 22:24:31'),
(42, 13, 20, 54, '2025-05-07 22:24:31', '2025-05-07 22:24:31'),
(43, 14, 16, 34, '2025-05-07 22:24:31', '2025-05-07 22:24:31'),
(44, 14, 17, 40, '2025-05-07 22:24:31', '2025-05-07 22:24:31'),
(45, 14, 18, 44, '2025-05-07 22:24:31', '2025-05-07 22:24:31'),
(46, 14, 19, 53, '2025-05-07 22:24:31', '2025-05-07 22:24:31'),
(47, 14, 20, 54, '2025-05-07 22:24:31', '2025-05-07 22:24:31'),
(48, 15, 16, 34, '2025-05-07 22:24:31', '2025-05-07 22:24:31'),
(49, 15, 17, 41, '2025-05-07 22:24:31', '2025-05-07 22:24:31'),
(50, 15, 18, 45, '2025-05-07 22:24:31', '2025-05-07 22:24:31'),
(51, 15, 19, 52, '2025-05-07 22:24:31', '2025-05-07 22:24:31'),
(52, 15, 20, 54, '2025-05-07 22:24:31', '2025-05-07 22:24:31'),
(53, 16, 16, 38, '2025-05-07 22:24:31', '2025-05-07 22:24:31'),
(54, 16, 17, 39, '2025-05-07 22:24:31', '2025-05-07 22:26:56'),
(55, 16, 18, 47, '2025-05-07 22:24:31', '2025-05-07 22:27:43'),
(56, 16, 19, 50, '2025-05-07 22:24:31', '2025-05-07 22:24:31'),
(57, 16, 20, 56, '2025-05-07 22:24:31', '2025-05-07 22:24:31'),
(58, 17, 16, 34, '2025-05-07 22:24:31', '2025-05-07 22:24:31'),
(59, 17, 17, 39, '2025-05-07 22:24:31', '2025-05-07 22:24:31'),
(60, 17, 18, 45, '2025-05-07 22:24:31', '2025-05-07 22:24:31'),
(61, 17, 19, 52, '2025-05-07 22:24:31', '2025-05-07 22:24:31'),
(62, 17, 20, 54, '2025-05-07 22:24:31', '2025-05-07 22:24:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('kreatifforever@gmail.com', '$2y$12$kaTkS8cRxgJXLnoLVuzPH.CZ0B1VnxJA5OjLcyqRphJWbeHLsJFOK', '2025-05-12 00:13:13'),
('wizmukhlish546@gmail.com', '$2y$12$7zUWTxmbS6B/kH09reZqD.h/hAWqH.9rIV5L1BzoYVkru9wkewBX2', '2025-05-12 00:16:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('minjMJ9zPwuDvpZA5SsYpc8v62nWrB6EFzMK6INv', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRjZON0FVV0lrQlNnd2JSTFZ1NWtFZVh3MWVBb0cxQlp4bWhuamZHOCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO319', 1747035246);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sub_kriterias`
--

CREATE TABLE `sub_kriterias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kriteria_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nama_sub` varchar(255) NOT NULL,
  `nilai` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sub_kriterias`
--

INSERT INTO `sub_kriterias` (`id`, `kriteria_id`, `nama_sub`, `nilai`, `created_at`, `updated_at`) VALUES
(5, 7, 'Sangat Baik', 5, '2025-05-02 03:40:57', '2025-05-02 03:40:57'),
(6, 7, 'Baik', 4, '2025-05-02 03:41:04', '2025-05-02 03:41:04'),
(7, 8, 'Sangat Baik', 5, '2025-05-02 03:41:16', '2025-05-02 03:41:16'),
(8, 8, 'Baik', 4, '2025-05-02 03:41:27', '2025-05-02 03:41:27'),
(9, 2, '2x dari Target', 5, '2025-05-02 03:55:22', '2025-05-02 03:55:22'),
(10, 2, 'Lebih dari Target', 4, '2025-05-02 03:55:33', '2025-05-02 03:55:33'),
(11, 2, 'Capai Target', 3, '2025-05-02 03:55:41', '2025-05-02 03:55:41'),
(12, 2, 'Kurang Dari Target', 2, '2025-05-02 03:55:48', '2025-05-02 03:55:48'),
(13, 2, 'Tidak Terjual sama sekali', 1, '2025-05-02 03:55:53', '2025-05-02 03:55:53'),
(14, 9, 'Sangat Baik', 5, '2025-05-02 03:56:04', '2025-05-02 03:56:04'),
(15, 9, 'Baik', 4, '2025-05-02 03:56:10', '2025-05-02 03:56:10'),
(16, 9, 'Cukup', 3, '2025-05-02 03:56:18', '2025-05-02 03:56:18'),
(17, 9, 'buruk', 2, '2025-05-02 03:56:24', '2025-05-02 03:56:24'),
(18, 9, 'sangat buruk', 1, '2025-05-02 03:56:29', '2025-05-02 03:56:29'),
(19, 10, '>=24', 5, '2025-05-02 03:56:53', '2025-05-02 03:56:53'),
(20, 10, '>20&&<24', 4, '2025-05-02 03:57:00', '2025-05-02 03:57:00'),
(21, 10, '>15&&<20', 3, '2025-05-02 03:57:11', '2025-05-02 03:57:11'),
(22, 10, '>10&&<15', 2, '2025-05-02 03:57:22', '2025-05-02 03:57:22'),
(23, 10, '<10', 1, '2025-05-02 03:57:28', '2025-05-02 03:57:28'),
(24, 11, 'Sangat Baik', 5, '2025-05-02 03:57:45', '2025-05-02 03:57:45'),
(25, 11, 'Baik', 4, '2025-05-02 03:57:51', '2025-05-02 03:57:51'),
(26, 11, 'Cukup', 3, '2025-05-02 03:57:59', '2025-05-02 03:57:59'),
(27, 11, 'buruk', 2, '2025-05-02 03:58:06', '2025-05-02 03:58:06'),
(28, 11, 'sangat buruk', 1, '2025-05-02 03:58:13', '2025-05-02 03:58:13'),
(29, 12, 'Sangat Baik', 5, '2025-05-02 03:58:25', '2025-05-02 03:58:25'),
(30, 12, 'Baik', 4, '2025-05-02 03:58:30', '2025-05-02 03:58:30'),
(31, 12, 'Cukup', 3, '2025-05-02 03:58:37', '2025-05-02 03:58:37'),
(32, 12, 'buruk', 2, '2025-05-02 03:58:42', '2025-05-02 03:58:42'),
(33, 12, 'sangat buruk', 1, '2025-05-02 03:58:47', '2025-05-02 03:58:47'),
(34, 16, 'Tidak Prioritas', 1, '2025-05-07 22:18:04', '2025-05-07 22:18:04'),
(35, 16, 'Kurang Prioritas', 2, '2025-05-07 22:18:11', '2025-05-07 22:18:11'),
(36, 16, 'Cukup Prioritas', 3, '2025-05-07 22:18:22', '2025-05-07 22:18:22'),
(37, 16, 'Prioritas', 4, '2025-05-07 22:18:34', '2025-05-07 22:18:34'),
(38, 16, 'Sangat Prioritas', 5, '2025-05-07 22:18:44', '2025-05-07 22:18:44'),
(39, 17, 'Tidak Prioritas', 1, '2025-05-07 22:19:11', '2025-05-07 22:19:11'),
(40, 17, 'Kurang Prioritas', 2, '2025-05-07 22:19:45', '2025-05-07 22:19:45'),
(41, 17, 'Cukup Prioritas', 3, '2025-05-07 22:19:53', '2025-05-07 22:19:53'),
(42, 17, 'Prioritas', 4, '2025-05-07 22:20:00', '2025-05-07 22:20:00'),
(43, 17, 'Sangat Prioritas', 5, '2025-05-07 22:20:07', '2025-05-07 22:20:07'),
(44, 18, 'Tidak Prioritas', 1, '2025-05-07 22:20:25', '2025-05-07 22:20:25'),
(45, 18, 'Kurang Prioritas', 2, '2025-05-07 22:20:35', '2025-05-07 22:20:35'),
(46, 18, 'Prioritas', 3, '2025-05-07 22:20:43', '2025-05-07 22:20:43'),
(47, 18, 'Sangat Prioritas', 4, '2025-05-07 22:20:49', '2025-05-07 22:20:49'),
(48, 18, 'Sangat Prioritas', 5, '2025-05-07 22:21:01', '2025-05-07 22:21:01'),
(49, 19, 'Tidak Prioritas', 1, '2025-05-07 22:21:21', '2025-05-07 22:21:21'),
(50, 19, 'Kurang Prioritas', 2, '2025-05-07 22:21:27', '2025-05-07 22:21:27'),
(51, 19, 'Cukup Prioritas', 3, '2025-05-07 22:21:34', '2025-05-07 22:21:34'),
(52, 19, 'Prioritas', 4, '2025-05-07 22:21:40', '2025-05-07 22:21:40'),
(53, 19, 'Sangat Prioritas', 5, '2025-05-07 22:21:46', '2025-05-07 22:21:46'),
(54, 20, 'Tidak Prioritas', 1, '2025-05-07 22:22:02', '2025-05-07 22:22:02'),
(55, 20, 'Kurang Prioritas', 2, '2025-05-07 22:22:10', '2025-05-07 22:22:10'),
(56, 20, 'Cukup Prioritas', 3, '2025-05-07 22:22:17', '2025-05-07 22:22:17'),
(57, 20, 'Prioritas', 4, '2025-05-07 22:22:29', '2025-05-07 22:22:29'),
(58, 20, 'Sangat Prioritas', 5, '2025-05-07 22:22:36', '2025-05-07 22:22:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'wizmukhlish546@gmail.com', NULL, '$2y$12$K.uZILxdyEuyG1T2P7JNfuiP9Dz1baPWfgg.aNyy6iYavAVXvHo9O', 'M6U2ehxaXaz6CVp2EQhCo0DGSsMiaOF3iSt7oC3cq2Gt0nXF8ZdgYIivnKXF', '2025-05-02 00:40:24', '2025-05-02 00:40:24'),
(2, 'Muhammad Mukhlish', 'kreatifforever@gmail.com', NULL, '$2y$12$/K99tK2VVdcpdRwebJ1hau.24r1B42plL3jrnWzcePVFFIrBmKiLi', 'O8S1S26sVkfvduTGcAT0OEeRDSMKSGekM8X4Uw205yJzsQdGtgk7CCn3STG3', '2025-05-11 10:53:01', '2025-05-11 10:53:01');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alternatifs`
--
ALTER TABLE `alternatifs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_alternatif_jenis` (`jenis_analisis_id`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jenis_analisis`
--
ALTER TABLE `jenis_analisis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_jenis_analisis_user` (`user_id`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kriterias`
--
ALTER TABLE `kriterias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kriteria_jenis` (`jenis_analisis_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `nilai_alternatifs`
--
ALTER TABLE `nilai_alternatifs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nilai_alternatifs_sub_kriteria_id_foreign` (`sub_kriteria_id`),
  ADD KEY `fk_nilai_alternatif` (`alternatif_id`),
  ADD KEY `fk_nilai_kriteria` (`kriteria_id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `sub_kriterias`
--
ALTER TABLE `sub_kriterias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_subkriteria_kriteria` (`kriteria_id`);

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
-- AUTO_INCREMENT untuk tabel `alternatifs`
--
ALTER TABLE `alternatifs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jenis_analisis`
--
ALTER TABLE `jenis_analisis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kriterias`
--
ALTER TABLE `kriterias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `nilai_alternatifs`
--
ALTER TABLE `nilai_alternatifs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT untuk tabel `sub_kriterias`
--
ALTER TABLE `sub_kriterias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `alternatifs`
--
ALTER TABLE `alternatifs`
  ADD CONSTRAINT `fk_alternatif_jenis` FOREIGN KEY (`jenis_analisis_id`) REFERENCES `jenis_analisis` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jenis_analisis`
--
ALTER TABLE `jenis_analisis`
  ADD CONSTRAINT `fk_jenis_analisis_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `kriterias`
--
ALTER TABLE `kriterias`
  ADD CONSTRAINT `fk_kriteria_jenis` FOREIGN KEY (`jenis_analisis_id`) REFERENCES `jenis_analisis` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `nilai_alternatifs`
--
ALTER TABLE `nilai_alternatifs`
  ADD CONSTRAINT `fk_nilai_alternatif` FOREIGN KEY (`alternatif_id`) REFERENCES `alternatifs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_nilai_kriteria` FOREIGN KEY (`kriteria_id`) REFERENCES `kriterias` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `nilai_alternatifs_sub_kriteria_id_foreign` FOREIGN KEY (`sub_kriteria_id`) REFERENCES `sub_kriterias` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sub_kriterias`
--
ALTER TABLE `sub_kriterias`
  ADD CONSTRAINT `fk_subkriteria_kriteria` FOREIGN KEY (`kriteria_id`) REFERENCES `kriterias` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
