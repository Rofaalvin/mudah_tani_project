-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 24, 2025 at 08:25 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mudah_tani`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` varchar(50) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `alamat` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `no_hp`, `alamat`, `email`, `created_at`, `updated_at`) VALUES
('1', 'admin1', '$2y$12$Nu.jFVASCTi7ZbYZrY8qWuUVKfmGLRfVj2mK.TvIy/SjwEnmDfIoq', '123456789', 'kediri', 'admin1@gmail.com', '2025-03-05 13:54:02', '2025-04-24 22:26:23'),
('2', 'admin2', '$2y$12$ZAdieD76ffVEwXSq4BtII.nfFqw93i6LHXD2P/cqKiacFer5InHtq', '084666967345', 'papar', 'admin2@gmail.com', '2025-03-05 06:56:46', '2025-04-24 05:36:31');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('admin@eexample.com|192.168.244.65', 'i:1;', 1747824888),
('admin@eexample.com|192.168.244.65:timer', 'i:1747824888;', 1747824888);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_beli`
--

CREATE TABLE `data_beli` (
  `kode_trx_beli` int(11) NOT NULL,
  `id_supplyer` varchar(20) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `harga` decimal(15,2) NOT NULL,
  `total` decimal(15,2) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_pembelian`
--

CREATE TABLE `data_pembelian` (
  `id_data_pembelian` int(11) NOT NULL,
  `kode_trx_beli` varchar(50) NOT NULL,
  `id_supplyer` varchar(50) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_penjualan`
--

CREATE TABLE `data_penjualan` (
  `id_data_penjualan` int(11) NOT NULL,
  `kode_trx_jual` varchar(50) NOT NULL,
  `id_pembeli` varchar(50) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `hutang`
--

CREATE TABLE `hutang` (
  `id_hutang` varchar(50) NOT NULL,
  `nama_pembeli` varchar(250) NOT NULL,
  `nominal_hutang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
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
-- Table structure for table `job_batches`
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
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(5, '0001_01_01_000000_create_users_table', 1),
(6, '0001_01_01_000001_create_cache_table', 1),
(7, '0001_01_01_000002_create_jobs_table', 1),
(8, '2024_10_26_120204_myuser', 1),
(9, '2025_05_03_050814_add_created_at_to_pembelian_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `myuser`
--

CREATE TABLE `myuser` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(500) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id_payment` varchar(50) NOT NULL,
  `nama_pembeli` varchar(50) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `nominal` varchar(250) NOT NULL,
  `id_pembeli` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembeli`
--

CREATE TABLE `pembeli` (
  `id_pembeli` int(50) NOT NULL,
  `nama_pembeli` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `alamat` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembeli`
--

INSERT INTO `pembeli` (`id_pembeli`, `nama_pembeli`, `password`, `no_hp`, `alamat`, `email`, `created_at`, `updated_at`) VALUES
(1, 'pembeli1', '$2y$12$hvDiDPOMuELGX0lZhFNQf.WIvmsdhbHWeCo/0Z89r/65BG8kvih0q', '086138379461', 'babadan', 'pembeli1@gmail.com', '2025-04-24 06:16:59', '2025-04-24 06:16:59');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id` int(11) NOT NULL,
  `kode_trx_beli` varchar(250) NOT NULL,
  `id_supplyer` int(11) DEFAULT NULL,
  `id_barang` varchar(20) NOT NULL,
  `nama_barang` varchar(250) NOT NULL,
  `quantity` varchar(50) NOT NULL,
  `harga` int(50) NOT NULL,
  `total` int(50) NOT NULL,
  `diskon` decimal(8,2) NOT NULL DEFAULT 0.00,
  `total_final` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tanggal` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id`, `kode_trx_beli`, `id_supplyer`, `id_barang`, `nama_barang`, `quantity`, `harga`, `total`, `diskon`, `total_final`, `tanggal`, `created_at`, `updated_at`) VALUES
(8, 'PB20250509000', 1, '', 'Pestisida', '1', 20000, 20000, '0.00', '0.00', '2025-05-09 09:19:58', NULL, NULL),
(9, 'PB20250509000', 1, '', 'Pupuk Urea', '2', 43000, 86000, '0.00', '0.00', '2025-05-09 09:19:58', NULL, NULL),
(10, 'PB20250509000', 1, '', 'Pestisida', '2', 20000, 40000, '0.00', '0.00', '2025-05-09 11:16:40', NULL, NULL),
(11, 'PB20250509001', 1, '', 'Pestisida', '1', 20000, 20000, '0.00', '0.00', '2025-05-09 11:19:21', NULL, NULL),
(12, 'PB20250509002', 2, '', 'Pestisida', '1', 20000, 20000, '0.00', '0.00', '2025-05-09 12:28:11', NULL, NULL),
(13, 'PB20250509003', 3, '', 'Pupuk Urea', '3', 43000, 129000, '0.00', '0.00', '2025-05-09 12:29:30', NULL, NULL),
(14, 'PB20250509003', 3, '', 'Cangkul', '2', 17000, 34000, '0.00', '0.00', '2025-05-09 12:29:30', NULL, NULL),
(15, 'PB20250509004', 1, 'B0001', 'Pestisida', '1', 20000, 20000, '0.00', '0.00', '2025-05-09 12:40:05', NULL, NULL),
(16, 'PB20250509005', 1, 'B0001', 'Pestisida', '1', 20000, 20000, '0.00', '0.00', '2025-05-09 12:55:46', NULL, NULL),
(17, 'PB20250624001', 1, 'B0001', 'Pestisida', '1', 20000, 20000, '0.00', '0.00', '2025-06-24 17:01:41', NULL, NULL),
(18, 'PB20250624002', 2, 'B0002', 'Pupuk Urea', '3', 43000, 129000, '2.00', '126420.00', '2025-06-24 17:15:09', NULL, NULL),
(19, 'PB20250624003', 2, 'B0003', 'Cangkul', '6', 17000, 102000, '10.00', '91800.00', '2025-06-24 17:25:02', NULL, NULL),
(20, 'PB20250624004', 1, 'B0001', 'Pestisida', '1', 20000, 20000, '5.00', '76000.00', '2025-06-24 17:25:34', NULL, NULL),
(21, 'PB20250624004', 1, 'B0002', 'Pupuk Urea', '1', 43000, 43000, '5.00', '76000.00', '2025-06-24 17:25:34', NULL, NULL),
(22, 'PB20250624004', 1, 'B0003', 'Cangkul', '1', 17000, 17000, '5.00', '76000.00', '2025-06-24 17:25:34', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `penjual`
--

CREATE TABLE `penjual` (
  `id_penjual` varchar(50) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `alamat` varchar(250) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penjual`
--

INSERT INTO `penjual` (`id_penjual`, `username`, `password`, `no_hp`, `alamat`, `created_at`, `updated_at`, `email`) VALUES
('1', 'penjual1', '$2y$12$Rc8adZDfWP8MFAgIx0/jKOoBOWFhlwBQEYz5WTxMh2AdoPikl3mtW', '086138379461', 'kediri', '2025-03-06 00:59:39', '2025-03-06 00:59:39', 'penjual1@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id` int(11) NOT NULL,
  `kode_trx_jual` varchar(50) NOT NULL,
  `id_pembeli` varchar(50) NOT NULL,
  `id_barang` varchar(20) DEFAULT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `delivery_method` varchar(255) NOT NULL DEFAULT 'pickup',
  `shipping_cost` decimal(15,2) NOT NULL DEFAULT 0.00,
  `shipping_address` text DEFAULT NULL,
  `total` int(11) NOT NULL,
  `diskon` decimal(8,2) NOT NULL DEFAULT 0.00,
  `total_final` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tanggal` date NOT NULL,
  `snap_token` varchar(255) DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id`, `kode_trx_jual`, `id_pembeli`, `id_barang`, `nama_barang`, `quantity`, `harga`, `delivery_method`, `shipping_cost`, `shipping_address`, `total`, `diskon`, `total_final`, `tanggal`, `snap_token`, `status`, `updated_at`, `created_at`) VALUES
(7, 'PB20250521001', '2', 'B0001', 'Pestisida', 1, 20000, 'pickup', '0.00', '', 20000, '0.00', '0.00', '2025-05-21', NULL, 'pending', '2025-05-21 08:34:06', '2025-05-21 08:34:06'),
(8, 'PB20250521002', '2', 'B0002', 'Pupuk Urea', 1, 43000, 'pickup', '0.00', '', 43000, '0.00', '0.00', '2025-05-21', NULL, 'pending', '2025-05-21 08:40:53', '2025-05-21 08:40:53'),
(9, 'TRX-6836C0567EF58', '2', NULL, NULL, NULL, NULL, 'pickup', '0.00', '', 114000, '0.00', '0.00', '2025-05-28', NULL, 'pending', '2025-05-28 00:50:46', '2025-05-28 00:50:46'),
(10, 'TRX-6836C1678DFB0', '2', NULL, NULL, NULL, NULL, 'pickup', '0.00', '', 77000, '0.00', '0.00', '2025-05-28', NULL, 'pending', '2025-05-28 00:55:19', '2025-05-28 00:55:19'),
(11, 'PB20250528001', '2', NULL, NULL, NULL, NULL, 'pickup', '0.00', '', 34000, '0.00', '0.00', '2025-05-28', NULL, 'pending', '2025-05-28 00:56:50', '2025-05-28 00:56:50'),
(12, 'PB20250528002', '2', NULL, NULL, NULL, NULL, 'pickup', '0.00', '', 34000, '0.00', '0.00', '2025-05-28', NULL, 'pending', '2025-05-28 01:13:52', '2025-05-28 01:13:52'),
(13, 'PB20250528003', '2', NULL, NULL, NULL, NULL, 'pickup', '0.00', '', 17000, '0.00', '0.00', '2025-05-28', NULL, 'pending', '2025-05-28 01:17:02', '2025-05-28 01:17:02'),
(14, 'PB20250528004', '2', NULL, NULL, NULL, NULL, 'pickup', '0.00', '', 17000, '0.00', '0.00', '2025-05-28', NULL, 'pending', '2025-05-28 01:24:26', '2025-05-28 01:24:26'),
(15, 'PB20250528005', '2', NULL, NULL, NULL, NULL, 'pickup', '0.00', '', 17000, '0.00', '0.00', '2025-05-28', NULL, 'pending', '2025-05-28 01:37:46', '2025-05-28 01:37:46'),
(16, 'PB20250528006', '2', NULL, NULL, NULL, NULL, 'pickup', '0.00', '', 308000, '0.00', '0.00', '2025-05-28', NULL, 'paid', '2025-05-30 14:36:04', '2025-05-28 03:12:34'),
(17, 'PB20250528007', '2', NULL, NULL, NULL, NULL, 'pickup', '0.00', '', 106000, '0.00', '0.00', '2025-05-28', NULL, 'pending', '2025-05-28 09:00:09', '2025-05-28 09:00:09'),
(18, 'PB20250529001', '2', NULL, NULL, NULL, NULL, 'pickup', '0.00', '', 17000, '0.00', '0.00', '2025-05-29', '5e7c80ff-19b1-4723-9aa2-3529692150d5', 'pending', '2025-05-29 10:09:44', '2025-05-29 10:09:43'),
(19, 'PB20250529002', '2', NULL, NULL, NULL, NULL, 'pickup', '0.00', '', 43000, '0.00', '0.00', '2025-05-29', 'd8ba969b-9b87-4a17-8d8e-4848cbf1fd85', 'pending', '2025-05-29 10:31:47', '2025-05-29 10:31:47'),
(20, 'PB20250529003', '2', NULL, NULL, NULL, NULL, 'pickup', '0.00', '', 20000, '0.00', '0.00', '2025-05-29', 'c1f092b2-fde5-429d-85ca-24f7d661289f', 'pending', '2025-05-29 10:34:03', '2025-05-29 10:34:02'),
(21, 'PB20250529004', '2', NULL, NULL, NULL, NULL, 'pickup', '0.00', '', 17000, '0.00', '0.00', '2025-05-29', 'c872bd88-f6d8-4461-a0a8-69f8f8a55178', 'pending', '2025-05-29 10:36:26', '2025-05-29 10:36:26'),
(22, 'PB20250529005', '2', NULL, NULL, NULL, NULL, 'pickup', '0.00', '', 37000, '0.00', '0.00', '2025-05-29', 'f7bd3edb-ccc1-4748-8286-f6eecae5db4c', 'paid', '2025-05-30 13:21:39', '2025-05-29 10:39:31'),
(23, 'PB20250529006', '2', NULL, NULL, NULL, NULL, 'pickup', '0.00', '', 43000, '0.00', '0.00', '2025-05-29', '9fdc4add-fd72-4a4b-ac03-88b3a7f60e71', 'paid', '2025-05-30 13:21:25', '2025-05-29 10:40:23'),
(24, 'PB20250529007', '2', NULL, NULL, NULL, NULL, 'pickup', '0.00', '', 43000, '0.00', '0.00', '2025-05-29', 'd32da00d-0a3d-429f-a1db-0a7c23fe295a', 'paid', '2025-05-30 13:21:17', '2025-05-29 10:41:48'),
(25, 'PB20250529008', '2', NULL, NULL, NULL, NULL, 'pickup', '0.00', '', 43000, '0.00', '0.00', '2025-05-29', '8550ea93-3c08-4605-8061-8c0f32f6873e', 'paid', '2025-05-29 10:45:14', '2025-05-29 10:44:55'),
(26, 'PB20250529009', '2', NULL, NULL, NULL, NULL, 'pickup', '0.00', '', 20000, '0.00', '0.00', '2025-05-29', 'a2938eb6-d715-48ba-bd53-c434554d4094', 'paid', '2025-05-30 13:12:55', '2025-05-29 10:48:54'),
(27, 'PB20250531001', '2', NULL, NULL, NULL, NULL, 'pickup', '0.00', '', 106000, '0.00', '0.00', '2025-05-31', 'b4913906-ded2-44b9-b155-9acb615f1630', 'paid', '2025-05-31 08:12:37', '2025-05-31 08:11:23'),
(28, 'PB20250601001', '2', NULL, NULL, NULL, NULL, 'pickup', '0.00', '', 20000, '0.00', '0.00', '2025-06-01', NULL, 'paid', '2025-06-01 12:11:58', '2025-06-01 05:08:07'),
(29, 'PB20250601002', '2', NULL, NULL, NULL, NULL, 'pickup', '0.00', '', 20000, '0.00', '0.00', '2025-06-01', 'd4805a82-fda3-4f53-ae1f-dd54777b9b80', 'pending', '2025-06-01 05:13:34', '2025-06-01 05:13:34'),
(30, 'PB20250602001', '2', NULL, NULL, NULL, NULL, 'pickup', '0.00', '', 17000, '0.00', '0.00', '2025-06-02', '2d95a402-fd6c-4695-8784-9a119db2ee06', 'pending', '2025-06-02 05:57:09', '2025-06-02 05:57:09'),
(31, 'PB20250624001', '2', NULL, NULL, NULL, NULL, 'delivery', '12000.00', '', 72000, '0.00', '0.00', '2025-06-24', '3aa08d23-ea87-46c7-ae6b-9e8f21462e6b', 'pending', '2025-06-24 08:30:36', '2025-06-24 08:30:36'),
(32, 'PB20250624002', '2', NULL, NULL, NULL, NULL, 'delivery', '12000.00', '', 92000, '0.00', '0.00', '2025-06-24', '13dbf720-9eda-41d9-bec8-32313c8370d4', 'pending', '2025-06-24 08:32:01', '2025-06-24 08:32:00'),
(33, 'PB20250624003', '2', NULL, NULL, NULL, NULL, 'pickup', '0.00', '', 43000, '0.00', '0.00', '2025-06-24', '91314e4b-6f0f-47ea-a7ec-a579f867e3e5', 'pending', '2025-06-24 08:38:56', '2025-06-24 08:38:55'),
(34, 'PB20250624004', '2', NULL, NULL, NULL, NULL, 'delivery', '12000.00', 'anu ini Sanankulon ya mas', 32000, '0.00', '0.00', '2025-06-24', 'a576091e-fbda-49eb-ab25-06f84c3262c2', 'pending', '2025-06-24 08:48:24', '2025-06-24 08:48:24'),
(35, 'PB20250624005', '2', NULL, NULL, NULL, NULL, 'pickup', '0.00', NULL, 123000, '6.00', '115620.00', '2025-06-24', NULL, 'paid', '2025-06-24 10:46:51', '2025-06-24 10:46:51'),
(36, 'PB20250624006', '2', NULL, NULL, NULL, NULL, 'pickup', '0.00', NULL, 20000, '10.00', '18000.00', '2025-06-24', NULL, 'paid', '2025-06-24 10:49:09', '2025-06-24 10:49:09');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_items`
--

CREATE TABLE `penjualan_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `penjualan_id` int(11) NOT NULL,
  `id_produk` varchar(50) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penjualan_items`
--

INSERT INTO `penjualan_items` (`id`, `penjualan_id`, `id_produk`, `nama_produk`, `harga`, `quantity`, `subtotal`, `created_at`, `updated_at`) VALUES
(1, 9, 'B0001', 'Pestisida', 20000, 1, 20000, '2025-05-28 00:50:46', '2025-05-28 00:50:46'),
(2, 9, 'B0002', 'Pupuk Urea', 43000, 1, 43000, '2025-05-28 00:50:46', '2025-05-28 00:50:46'),
(3, 9, 'B0003', 'Cangkul', 17000, 3, 51000, '2025-05-28 00:50:46', '2025-05-28 00:50:46'),
(4, 10, 'B0003', 'Cangkul', 17000, 2, 34000, '2025-05-28 00:55:19', '2025-05-28 00:55:19'),
(5, 10, 'B0002', 'Pupuk Urea', 43000, 1, 43000, '2025-05-28 00:55:19', '2025-05-28 00:55:19'),
(6, 11, 'B0003', 'Cangkul', 17000, 2, 34000, '2025-05-28 00:56:50', '2025-05-28 00:56:50'),
(7, 12, 'B0003', 'Cangkul', 17000, 2, 34000, '2025-05-28 01:13:52', '2025-05-28 01:13:52'),
(8, 13, 'B0003', 'Cangkul', 17000, 1, 17000, '2025-05-28 01:17:02', '2025-05-28 01:17:02'),
(9, 14, 'B0003', 'Cangkul', 17000, 1, 17000, '2025-05-28 01:24:26', '2025-05-28 01:24:26'),
(10, 15, 'B0003', 'Cangkul', 17000, 1, 17000, '2025-05-28 01:37:46', '2025-05-28 01:37:46'),
(11, 16, 'B0003', 'Cangkul', 17000, 7, 119000, '2025-05-28 03:12:34', '2025-05-28 03:12:34'),
(12, 16, 'B0002', 'Pupuk Urea', 43000, 3, 129000, '2025-05-28 03:12:34', '2025-05-28 03:12:34'),
(13, 16, 'B0001', 'Pestisida', 20000, 3, 60000, '2025-05-28 03:12:34', '2025-05-28 03:12:34'),
(14, 17, 'B0001', 'Pestisida', 20000, 1, 20000, '2025-05-28 09:00:09', '2025-05-28 09:00:09'),
(15, 17, 'B0002', 'Pupuk Urea', 43000, 2, 86000, '2025-05-28 09:00:09', '2025-05-28 09:00:09'),
(16, 18, 'B0003', 'Cangkul', 17000, 1, 17000, '2025-05-29 10:09:43', '2025-05-29 10:09:43'),
(17, 19, 'B0002', 'Pupuk Urea', 43000, 1, 43000, '2025-05-29 10:31:47', '2025-05-29 10:31:47'),
(18, 20, 'B0001', 'Pestisida', 20000, 1, 20000, '2025-05-29 10:34:02', '2025-05-29 10:34:02'),
(19, 21, 'B0003', 'Cangkul', 17000, 1, 17000, '2025-05-29 10:36:26', '2025-05-29 10:36:26'),
(20, 22, 'B0001', 'Pestisida', 20000, 1, 20000, '2025-05-29 10:39:31', '2025-05-29 10:39:31'),
(21, 22, 'B0003', 'Cangkul', 17000, 1, 17000, '2025-05-29 10:39:31', '2025-05-29 10:39:31'),
(22, 23, 'B0002', 'Pupuk Urea', 43000, 1, 43000, '2025-05-29 10:40:23', '2025-05-29 10:40:23'),
(23, 24, 'B0002', 'Pupuk Urea', 43000, 1, 43000, '2025-05-29 10:41:48', '2025-05-29 10:41:48'),
(24, 25, 'B0002', 'Pupuk Urea', 43000, 1, 43000, '2025-05-29 10:44:55', '2025-05-29 10:44:55'),
(25, 26, 'B0001', 'Pestisida', 20000, 1, 20000, '2025-05-29 10:48:54', '2025-05-29 10:48:54'),
(26, 27, 'B0002', 'Pupuk Urea', 43000, 2, 86000, '2025-05-31 08:11:23', '2025-05-31 08:11:23'),
(27, 27, 'B0001', 'Pestisida', 20000, 1, 20000, '2025-05-31 08:11:23', '2025-05-31 08:11:23'),
(28, 28, 'B0001', 'Pestisida', 20000, 1, 20000, '2025-06-01 05:08:07', '2025-06-01 05:08:07'),
(29, 29, 'B0001', 'Pestisida', 20000, 1, 20000, '2025-06-01 05:13:34', '2025-06-01 05:13:34'),
(30, 30, 'B0003', 'Cangkul', 17000, 1, 17000, '2025-06-02 05:57:09', '2025-06-02 05:57:09'),
(31, 31, 'B0003', 'Cangkul', 17000, 1, 17000, '2025-06-24 08:30:36', '2025-06-24 08:30:36'),
(32, 31, 'B0002', 'Pupuk Urea', 43000, 1, 43000, '2025-06-24 08:30:36', '2025-06-24 08:30:36'),
(33, 32, 'B0003', 'Cangkul', 17000, 1, 17000, '2025-06-24 08:32:00', '2025-06-24 08:32:00'),
(34, 32, 'B0002', 'Pupuk Urea', 43000, 1, 43000, '2025-06-24 08:32:00', '2025-06-24 08:32:00'),
(35, 32, 'B0001', 'Pestisida', 20000, 1, 20000, '2025-06-24 08:32:00', '2025-06-24 08:32:00'),
(36, 33, 'B0002', 'Pupuk Urea', 43000, 1, 43000, '2025-06-24 08:38:55', '2025-06-24 08:38:55'),
(37, 34, 'B0001', 'Pestisida', 20000, 1, 20000, '2025-06-24 08:48:24', '2025-06-24 08:48:24'),
(38, 35, 'B0001', 'Pestisida', 20000, 1, 20000, '2025-06-24 10:46:51', '2025-06-24 10:46:51'),
(39, 35, 'B0002', 'Pupuk Urea', 43000, 2, 86000, '2025-06-24 10:46:51', '2025-06-24 10:46:51'),
(40, 35, 'B0003', 'Cangkul', 17000, 1, 17000, '2025-06-24 10:46:51', '2025-06-24 10:46:51'),
(41, 36, 'B0001', 'Pestisida', 20000, 1, 20000, '2025-06-24 10:49:09', '2025-06-24 10:49:09');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` varchar(50) NOT NULL,
  `nama_produk` varchar(250) NOT NULL,
  `harga` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `stok` varchar(50) NOT NULL,
  `gambar` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `harga`, `created_at`, `updated_at`, `stok`, `gambar`) VALUES
('B0001', 'Pestisida', '20000', '2025-05-02 23:13:47', '2025-06-24 10:49:09', '13', 'images/produk/1746252827_pestisida.jpg'),
('B0002', 'Pupuk Urea', '43000', '2025-05-02 23:14:19', '2025-06-24 10:46:51', '13', 'images/produk/1746252859_pupuk urea.jpg'),
('B0003', 'Cangkul', '17000', '2025-05-02 23:15:00', '2025-06-24 10:46:51', '25', 'images/produk/1746252900_cangkul.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pt`
--

CREATE TABLE `pt` (
  `id_pt` varchar(50) NOT NULL,
  `nama_pt` varchar(250) NOT NULL,
  `alamat` varchar(250) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pt`
--

INSERT INTO `pt` (`id_pt`, `nama_pt`, `alamat`, `created_at`, `updated_at`) VALUES
('1', 'PT.Pupuk', 'Kab.Kediri', '2025-03-06 18:29:36', '2025-03-06 18:29:36');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
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
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('HEWsP5pFvs6MiUwui9mZsPnzWwTS7jOdSjBZRqjS', 4, '192.168.96.65', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.5 Safari/605.1.15', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoic2JjUWc5dHVRRGlrY3FZQU5MSHNkOWIxSlY4eGxmMDE5b0FrSE94ciI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xOTIuMTY4Ljk2LjY1OjgwMDAvZGF0YV9qdWFsIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDtzOjIyOiJQSFBERUJVR0JBUl9TVEFDS19EQVRBIjthOjA6e319', 1750789249);

-- --------------------------------------------------------

--
-- Table structure for table `stok`
--

CREATE TABLE `stok` (
  `id_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `total` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stok`
--

INSERT INTO `stok` (`id_barang`, `nama_barang`, `total`) VALUES
('1', 'Pestisida', 0),
('2', 'Pupuk Urea', 0),
('3', 'Cangkul', 0);

-- --------------------------------------------------------

--
-- Table structure for table `supplyer`
--

CREATE TABLE `supplyer` (
  `id_supplyer` int(50) NOT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `nama_supplyer` varchar(250) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplyer`
--

INSERT INTO `supplyer` (`id_supplyer`, `alamat`, `nama_supplyer`, `created_at`, `updated_at`) VALUES
(1, 'Kediri', 'PT.supply1', '2025-04-26 08:07:52', '2025-04-26 08:07:52'),
(2, 'Gresik', 'PT.supply2', '2025-04-26 08:08:09', '2025-04-26 08:08:09'),
(3, 'Nganjuk', 'PT.supply3', '2025-04-26 08:08:22', '2025-04-26 08:08:22');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` varchar(50) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `nominal` varchar(250) NOT NULL,
  `barang_dibeli` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `no_hp` bigint(20) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `role` enum('admin','pembeli','penjual') NOT NULL DEFAULT 'pembeli',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `no_hp`, `alamat`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@example.com', NULL, '$2y$12$BuL7Ad7WLgvSECwwFiluOOKa6a8F.hzTdlwI.Oz1wn9D6Hn6Mag0m', NULL, NULL, NULL, 'admin', '2025-05-21 01:29:01', '2025-05-21 01:29:01'),
(2, 'Test', 'test@example.com', NULL, '$2y$12$/ywJSDL85dp8GMT43wRHjOSCxmSxq9ff23ncNbPtSOJFgex7FyOtW', NULL, 123456789, 'Kediri', 'pembeli', '2025-05-21 01:22:05', '2025-05-21 08:14:44'),
(4, 'Penjual', 'penjual@example.com', NULL, '$2y$12$3vSvv0fL0XN67fVXsi2u4etKJ2se7yMsjqGFZEQn8EnEhNmlpQyUK', NULL, 85707098009, 'Sanankulon', 'penjual', '2025-05-21 01:42:53', '2025-05-21 08:10:21'),
(12, 'Penjual 2', 'penjual2@example.com', NULL, '$2y$12$/GI1iBAfQ4yRDRPrMpm.JerzjMK/wVYmZSFDkt3N8R7S98XdL1HFK', NULL, 12345678, 'Kediri', 'penjual', '2025-05-21 08:10:49', '2025-05-21 08:10:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `data_beli`
--
ALTER TABLE `data_beli`
  ADD PRIMARY KEY (`kode_trx_beli`);

--
-- Indexes for table `data_pembelian`
--
ALTER TABLE `data_pembelian`
  ADD PRIMARY KEY (`id_data_pembelian`);

--
-- Indexes for table `data_penjualan`
--
ALTER TABLE `data_penjualan`
  ADD PRIMARY KEY (`id_data_penjualan`),
  ADD UNIQUE KEY `kode_trx_jual` (`kode_trx_jual`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `hutang`
--
ALTER TABLE `hutang`
  ADD PRIMARY KEY (`id_hutang`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `myuser`
--
ALTER TABLE `myuser`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `myuser_username_unique` (`username`),
  ADD UNIQUE KEY `myuser_email_unique` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id_payment`),
  ADD UNIQUE KEY `id_pembeli` (`id_pembeli`);

--
-- Indexes for table `pembeli`
--
ALTER TABLE `pembeli`
  ADD PRIMARY KEY (`id_pembeli`),
  ADD UNIQUE KEY `nama_pembeli` (`nama_pembeli`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penjual`
--
ALTER TABLE `penjual`
  ADD PRIMARY KEY (`id_penjual`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penjualan_items`
--
ALTER TABLE `penjualan_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penjualan_id` (`penjualan_id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `pt`
--
ALTER TABLE `pt`
  ADD PRIMARY KEY (`id_pt`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `stok`
--
ALTER TABLE `stok`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `supplyer`
--
ALTER TABLE `supplyer`
  ADD PRIMARY KEY (`id_supplyer`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_beli`
--
ALTER TABLE `data_beli`
  MODIFY `kode_trx_beli` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_pembelian`
--
ALTER TABLE `data_pembelian`
  MODIFY `id_data_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `data_penjualan`
--
ALTER TABLE `data_penjualan`
  MODIFY `id_data_penjualan` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `myuser`
--
ALTER TABLE `myuser`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pembeli`
--
ALTER TABLE `pembeli`
  MODIFY `id_pembeli` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `penjualan_items`
--
ALTER TABLE `penjualan_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `supplyer`
--
ALTER TABLE `supplyer`
  MODIFY `id_supplyer` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `penjualan_items`
--
ALTER TABLE `penjualan_items`
  ADD CONSTRAINT `penjualan_items_ibfk_1` FOREIGN KEY (`penjualan_id`) REFERENCES `penjualan` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
