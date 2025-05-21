/*
SQLyog Enterprise v13.1.1 (64 bit)
MySQL - 8.0.30 : Database - mudah_tani
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`mudah_tani` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `mudah_tani`;

/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id_admin` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `no_hp` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `admin` */

insert  into `admin`(`id_admin`,`username`,`password`,`no_hp`,`alamat`,`email`,`created_at`,`updated_at`) values 
('1','admin1','$2y$12$Nu.jFVASCTi7ZbYZrY8qWuUVKfmGLRfVj2mK.TvIy/SjwEnmDfIoq','123456789','kediri','admin1@gmail.com','2025-03-05 20:54:02','2025-04-25 05:26:23'),
('2','admin2','$2y$12$ZAdieD76ffVEwXSq4BtII.nfFqw93i6LHXD2P/cqKiacFer5InHtq','084666967345','papar','admin2@gmail.com','2025-03-05 13:56:46','2025-04-24 12:36:31');

/*Table structure for table `cache` */

DROP TABLE IF EXISTS `cache`;

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cache` */

insert  into `cache`(`key`,`value`,`expiration`) values 
('admin@eexample.com|192.168.244.65','i:1;',1747824888),
('admin@eexample.com|192.168.244.65:timer','i:1747824888;',1747824888);

/*Table structure for table `cache_locks` */

DROP TABLE IF EXISTS `cache_locks`;

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cache_locks` */

/*Table structure for table `data_beli` */

DROP TABLE IF EXISTS `data_beli`;

CREATE TABLE `data_beli` (
  `kode_trx_beli` int NOT NULL AUTO_INCREMENT,
  `id_supplyer` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_barang` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `quantity` int NOT NULL,
  `harga` decimal(15,2) NOT NULL,
  `total` decimal(15,2) NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`kode_trx_beli`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `data_beli` */

/*Table structure for table `data_pembelian` */

DROP TABLE IF EXISTS `data_pembelian`;

CREATE TABLE `data_pembelian` (
  `id_data_pembelian` int NOT NULL AUTO_INCREMENT,
  `kode_trx_beli` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `id_supplyer` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_barang` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `quantity` int NOT NULL,
  `harga` int NOT NULL,
  `total` int NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id_data_pembelian`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `data_pembelian` */

/*Table structure for table `data_penjualan` */

DROP TABLE IF EXISTS `data_penjualan`;

CREATE TABLE `data_penjualan` (
  `id_data_penjualan` int NOT NULL AUTO_INCREMENT,
  `kode_trx_jual` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `id_pembeli` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_barang` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `quantity` int NOT NULL,
  `harga` int NOT NULL,
  `total` int NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id_data_penjualan`),
  UNIQUE KEY `kode_trx_jual` (`kode_trx_jual`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `data_penjualan` */

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `hutang` */

DROP TABLE IF EXISTS `hutang`;

CREATE TABLE `hutang` (
  `id_hutang` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_pembeli` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `nominal_hutang` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_hutang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `hutang` */

/*Table structure for table `job_batches` */

DROP TABLE IF EXISTS `job_batches`;

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `job_batches` */

/*Table structure for table `jobs` */

DROP TABLE IF EXISTS `jobs`;

CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `jobs` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(5,'0001_01_01_000000_create_users_table',1),
(6,'0001_01_01_000001_create_cache_table',1),
(7,'0001_01_01_000002_create_jobs_table',1),
(8,'2024_10_26_120204_myuser',1),
(9,'2025_05_03_050814_add_created_at_to_pembelian_table',2);

/*Table structure for table `myuser` */

DROP TABLE IF EXISTS `myuser`;

CREATE TABLE `myuser` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `myuser_username_unique` (`username`),
  UNIQUE KEY `myuser_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `myuser` */

/*Table structure for table `password_reset_tokens` */

DROP TABLE IF EXISTS `password_reset_tokens`;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_reset_tokens` */

/*Table structure for table `payment` */

DROP TABLE IF EXISTS `payment`;

CREATE TABLE `payment` (
  `id_payment` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_pembeli` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_bayar` date NOT NULL,
  `nominal` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `id_pembeli` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_payment`),
  UNIQUE KEY `id_pembeli` (`id_pembeli`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `payment` */

/*Table structure for table `pembeli` */

DROP TABLE IF EXISTS `pembeli`;

CREATE TABLE `pembeli` (
  `id_pembeli` int NOT NULL AUTO_INCREMENT,
  `nama_pembeli` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `no_hp` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_pembeli`),
  UNIQUE KEY `nama_pembeli` (`nama_pembeli`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pembeli` */

insert  into `pembeli`(`id_pembeli`,`nama_pembeli`,`password`,`no_hp`,`alamat`,`email`,`created_at`,`updated_at`) values 
(1,'pembeli1','$2y$12$hvDiDPOMuELGX0lZhFNQf.WIvmsdhbHWeCo/0Z89r/65BG8kvih0q','086138379461','babadan','pembeli1@gmail.com','2025-04-24 13:16:59','2025-04-24 13:16:59');

/*Table structure for table `pembelian` */

DROP TABLE IF EXISTS `pembelian`;

CREATE TABLE `pembelian` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode_trx_beli` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `id_supplyer` int DEFAULT NULL,
  `id_barang` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_barang` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `quantity` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `harga` int NOT NULL,
  `total` int NOT NULL,
  `tanggal` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pembelian` */

insert  into `pembelian`(`id`,`kode_trx_beli`,`id_supplyer`,`id_barang`,`nama_barang`,`quantity`,`harga`,`total`,`tanggal`,`created_at`,`updated_at`) values 
(8,'PB20250509000',1,'','Pestisida','1',20000,20000,'2025-05-09 09:19:58',NULL,NULL),
(9,'PB20250509000',1,'','Pupuk Urea','2',43000,86000,'2025-05-09 09:19:58',NULL,NULL),
(10,'PB20250509000',1,'','Pestisida','2',20000,40000,'2025-05-09 11:16:40',NULL,NULL),
(11,'PB20250509001',1,'','Pestisida','1',20000,20000,'2025-05-09 11:19:21',NULL,NULL),
(12,'PB20250509002',2,'','Pestisida','1',20000,20000,'2025-05-09 12:28:11',NULL,NULL),
(13,'PB20250509003',3,'','Pupuk Urea','3',43000,129000,'2025-05-09 12:29:30',NULL,NULL),
(14,'PB20250509003',3,'','Cangkul','2',17000,34000,'2025-05-09 12:29:30',NULL,NULL),
(15,'PB20250509004',1,'B0001','Pestisida','1',20000,20000,'2025-05-09 12:40:05',NULL,NULL),
(16,'PB20250509005',1,'B0001','Pestisida','1',20000,20000,'2025-05-09 12:55:46',NULL,NULL);

/*Table structure for table `penjual` */

DROP TABLE IF EXISTS `penjual`;

CREATE TABLE `penjual` (
  `id_penjual` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `no_hp` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_penjual`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `penjual` */

insert  into `penjual`(`id_penjual`,`username`,`password`,`no_hp`,`alamat`,`created_at`,`updated_at`,`email`) values 
('1','penjual1','$2y$12$Rc8adZDfWP8MFAgIx0/jKOoBOWFhlwBQEYz5WTxMh2AdoPikl3mtW','086138379461','kediri','2025-03-06 07:59:39','2025-03-06 07:59:39','penjual1@gmail.com');

/*Table structure for table `penjualan` */

DROP TABLE IF EXISTS `penjualan`;

CREATE TABLE `penjualan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kode_trx_jual` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `id_pembeli` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `id_barang` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_barang` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `quantity` int NOT NULL,
  `harga` int NOT NULL,
  `total` int NOT NULL,
  `tanggal` date NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `penjualan` */

insert  into `penjualan`(`id`,`kode_trx_jual`,`id_pembeli`,`id_barang`,`nama_barang`,`quantity`,`harga`,`total`,`tanggal`,`updated_at`,`created_at`) values 
(1,'PB20250509001','1','','Pestisida',1,20000,20000,'2025-05-09','2025-05-09 12:13:14','2025-05-09 12:13:14'),
(2,'PB20250509001','1','','Pestisida',1,20000,20000,'2025-05-09','2025-05-09 12:13:58','2025-05-09 12:13:58'),
(3,'PB20250509001','1','','Pupuk Urea',3,43000,129000,'2025-05-09','2025-05-09 12:13:58','2025-05-09 12:13:58'),
(4,'PB20250509002','1','','Pestisida',1,20000,20000,'2025-05-09','2025-05-09 12:16:11','2025-05-09 12:16:11'),
(5,'PB20250509003','1','B0001','Pestisida',3,20000,60000,'2025-05-09','2025-05-09 12:56:30','2025-05-09 12:56:30'),
(6,'PB20250509003','1','B0002','Pupuk Urea',1,43000,43000,'2025-05-09','2025-05-09 12:56:30','2025-05-09 12:56:30');

/*Table structure for table `produk` */

DROP TABLE IF EXISTS `produk`;

CREATE TABLE `produk` (
  `id_produk` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_produk` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `harga` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `stok` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `gambar` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_produk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `produk` */

insert  into `produk`(`id_produk`,`nama_produk`,`harga`,`created_at`,`updated_at`,`stok`,`gambar`) values 
('B0001','Pestisida','20000','2025-05-03 06:13:47','2025-05-09 12:56:30','20','images/produk/1746252827_pestisida.jpg'),
('B0002','Pupuk Urea','43000','2025-05-03 06:14:19','2025-05-09 12:56:30','19','images/produk/1746252859_pupuk urea.jpg'),
('B0003','Cangkul','17000','2025-05-03 06:15:00','2025-05-09 12:29:30','22','images/produk/1746252900_cangkul.jpg');

/*Table structure for table `pt` */

DROP TABLE IF EXISTS `pt`;

CREATE TABLE `pt` (
  `id_pt` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_pt` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_pt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `pt` */

insert  into `pt`(`id_pt`,`nama_pt`,`alamat`,`created_at`,`updated_at`) values 
('1','PT.Pupuk','Kab.Kediri','2025-03-07 01:29:36','2025-03-07 01:29:36');

/*Table structure for table `sessions` */

DROP TABLE IF EXISTS `sessions`;

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sessions` */

insert  into `sessions`(`id`,`user_id`,`ip_address`,`user_agent`,`payload`,`last_activity`) values 
('jujvZWfOPTBMS8kyOBofBSoacgQxyfLlxrlxS0pA',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiUlhPM2JSYWtVYjN5b2MxbmpDYXF1bTBpcUNvbXY0enUyaVFuaUNsMyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=',1747831587);

/*Table structure for table `stok` */

DROP TABLE IF EXISTS `stok`;

CREATE TABLE `stok` (
  `id_barang` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `nama_barang` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `total` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `stok` */

insert  into `stok`(`id_barang`,`nama_barang`,`total`) values 
('1','Pestisida',0),
('2','Pupuk Urea',0),
('3','Cangkul',0);

/*Table structure for table `supplyer` */

DROP TABLE IF EXISTS `supplyer`;

CREATE TABLE `supplyer` (
  `id_supplyer` int NOT NULL AUTO_INCREMENT,
  `alamat` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama_supplyer` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_supplyer`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `supplyer` */

insert  into `supplyer`(`id_supplyer`,`alamat`,`nama_supplyer`,`created_at`,`updated_at`) values 
(1,'Kediri','PT.supply1','2025-04-26 15:07:52','2025-04-26 15:07:52'),
(2,'Gresik','PT.supply2','2025-04-26 15:08:09','2025-04-26 15:08:09'),
(3,'Nganjuk','PT.supply3','2025-04-26 15:08:22','2025-04-26 15:08:22');

/*Table structure for table `transaksi` */

DROP TABLE IF EXISTS `transaksi`;

CREATE TABLE `transaksi` (
  `id_transaksi` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `nominal` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `barang_dibeli` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `transaksi` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','pembeli','penjual') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pembeli',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`remember_token`,`role`,`created_at`,`updated_at`) values 
(1,'Admin','admin@example.com',NULL,'$2y$12$BuL7Ad7WLgvSECwwFiluOOKa6a8F.hzTdlwI.Oz1wn9D6Hn6Mag0m',NULL,'admin','2025-05-21 08:29:01','2025-05-21 08:29:01'),
(2,'Test','test@example.com',NULL,'$2y$12$/ywJSDL85dp8GMT43wRHjOSCxmSxq9ff23ncNbPtSOJFgex7FyOtW',NULL,'pembeli','2025-05-21 08:22:05','2025-05-21 08:22:05'),
(4,'Penjual','penjual@example.com',NULL,'$2y$12$3vSvv0fL0XN67fVXsi2u4etKJ2se7yMsjqGFZEQn8EnEhNmlpQyUK',NULL,'penjual','2025-05-21 08:42:53','2025-05-21 08:42:53');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
