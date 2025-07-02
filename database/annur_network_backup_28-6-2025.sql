-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2025 at 12:55 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `annur_network`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensis`
--

CREATE TABLE `absensis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `masuk` datetime DEFAULT NULL,
  `pulang` datetime DEFAULT NULL,
  `keterangan` enum('hadir','izin','sakit','alfa') NOT NULL DEFAULT 'alfa',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `absensis`
--

INSERT INTO `absensis` (`id`, `user_id`, `masuk`, `pulang`, `keterangan`, `created_at`, `updated_at`) VALUES
(7, 9, '2025-06-28 00:45:30', '2025-06-28 00:45:37', 'hadir', '2025-06-27 17:45:30', '2025-06-27 17:45:37');

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
('spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:5:{i:0;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:11:\"data-master\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:1;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:9:\"data-edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:2;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:11:\"data-delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:3;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:9:\"data-view\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:4;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:11:\"data-create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}}s:5:\"roles\";a:2:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:13:\"Administrator\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:8:\"Karyawan\";s:1:\"c\";s:3:\"web\";}}}', 1751118202);

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
-- Table structure for table `karyawans`
--

CREATE TABLE `karyawans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'aktif',
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `karyawans`
--

INSERT INTO `karyawans` (`id`, `nama`, `alamat`, `no_hp`, `email`, `foto`, `status`, `password`, `created_at`, `updated_at`) VALUES
(9, 'Administrator', 'Administrator', '081662761987', 'administrator@gmail.com', '1738494941.jpg', 'aktif', '$2y$12$n9vx..P3Xq5hZqw.OjgZWuI6uhAXbWyhcgUsKCjs0qVVYC6GcjTHS', '2025-02-02 03:44:59', '2025-02-02 04:15:41'),
(10, 'Adi Setiawan', 'Jl. Babatan', '081584882233', '110adisetiawan@gmail.com', '1738840498.jpg', 'aktif', '$2y$12$S9GVBLQD41hra9JFbFQNsOi1359m0sh.cyEbYL636.T/eDsnAOUDK', '2025-02-06 11:14:58', '2025-02-06 11:14:58'),
(11, 'Test', 'Test', '088288817266', 'test@gmail.com', NULL, 'aktif', '$2y$12$A1Cz9sd9VluBgvRScPuSNerVYVHQ8t6MoJ7eIi51q3rIFmp1POIDS', '2025-05-03 14:37:37', '2025-05-03 14:37:37');

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_02_01_152204_karyawans', 1),
(5, '2025_02_01_172906_tasks', 1),
(6, '2025_02_01_182110_priorities', 1),
(7, '2025_02_02_065756_foto_to_karyawans_table', 1),
(8, '2025_02_02_070046_status_to_karyawans_table', 1),
(9, '2025_02_02_131305_network', 2),
(10, '2025_02_02_140800_status_after_ip_address', 3),
(11, '2025_02_03_055511_barangs', 4),
(12, '2025_02_03_083354_s_l_a', 5),
(13, '2025_02_03_134148_ticket', 6),
(14, '2025_02_03_141259_start_date_end_date_after_status', 7),
(15, '2025_02_03_141528_start_date_end_date_after_status', 8),
(16, '2025_02_03_170615_task_id_after_status', 9),
(17, '2025_02_04_162050_note_after_end_date', 10),
(18, '2025_05_10_185805_user_before_remember_token', 11),
(19, '2025_05_20_132134_create_permission_tables', 12),
(20, '2025_05_31_212010_add_user_foreign', 13),
(21, '2025_05_31_212622_drop_karyawan_id', 14),
(22, '2025_05_31_224636_absensi', 15),
(23, '2025_06_16_215107_product_create_categories_table', 16),
(24, '2025_06_16_215835_product_category', 17),
(25, '2025_06_16_215848_product_supplier', 17),
(26, '2025_06_16_215853_product', 18),
(27, '2025_06_16_215918_product_create_reports_table', 18),
(28, '2025_06_16_215918_product_create_stock_movements_table', 19),
(29, '2025_06_24_012410_add_custom_id_to_product_stock_movements_table', 20),
(30, '2025_06_24_013138_add_transaction_date_to_product_stock_movements_table', 21);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 4),
(2, 'App\\Models\\User', 5),
(2, 'App\\Models\\User', 6),
(2, 'App\\Models\\User', 9);

-- --------------------------------------------------------

--
-- Table structure for table `networks`
--

CREATE TABLE `networks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_device` varchar(255) NOT NULL,
  `serial_number` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT 'active',
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `networks`
--

INSERT INTO `networks` (`id`, `nama_device`, `serial_number`, `ip_address`, `status`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
(1, 'CDATA OLT', '992NSNASSHM', '192.168.100.1', 'offline', '-7.300125828337798', '112.6529245360871', '2025-02-02 06:57:39', '2025-02-03 01:19:36'),
(4, 'MIKROTIK CCR', 'CCR882NNAKY6HH', '192.168.200.1', 'active', '-7.298976504915296', '112.66931819758612', '2025-02-02 07:39:36', '2025-02-03 01:19:03'),
(9, 'CDATA OLT', 'KNSBAAKW998L11', '192.168.202.1', 'active', '-7.3114220304758355', '112.69289052172101', '2025-02-03 01:27:06', '2025-02-03 01:27:06'),
(10, 'HIOSO OLT', 'H9JJSBARWWQ1', '192.168.101.1', 'active', '-7.293910933166952', '112.6824073775788', '2025-02-03 01:28:06', '2025-02-03 03:18:30'),
(11, 'a', 'a', 'a', 'active', 'a', 'a', '2025-05-20 09:15:56', '2025-05-20 09:15:56');

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(6, 'data-master', 'web', '2025-05-23 07:22:25', '2025-05-23 07:22:25'),
(7, 'data-edit', 'web', '2025-05-23 07:22:25', '2025-05-23 07:22:25'),
(8, 'data-delete', 'web', '2025-05-23 07:22:25', '2025-05-23 07:22:25'),
(9, 'data-view', 'web', '2025-05-23 07:22:25', '2025-05-23 07:22:25'),
(10, 'data-create', 'web', '2025-05-23 07:22:25', '2025-05-23 07:22:25');

-- --------------------------------------------------------

--
-- Table structure for table `priorities`
--

CREATE TABLE `priorities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_prioritas` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `priorities`
--

INSERT INTO `priorities` (`id`, `nama_prioritas`, `created_at`, `updated_at`) VALUES
(1, 'Urgent', '2025-02-02 04:18:19', '2025-02-02 04:18:19'),
(2, 'Medium', '2025-02-02 04:18:26', '2025-02-02 04:18:26'),
(3, 'Low', '2025-02-02 04:18:30', '2025-02-02 04:18:30'),
(4, 'VVIP', '2025-02-02 04:18:34', '2025-02-02 04:18:34');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `product_category_id` bigint(20) UNSIGNED NOT NULL,
  `product_supplier_id` bigint(20) UNSIGNED NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `price` varchar(255) NOT NULL DEFAULT '',
  `condition` enum('normal','damaged') NOT NULL DEFAULT 'normal',
  `damage_description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `sku`, `product_category_id`, `product_supplier_id`, `stock`, `price`, `condition`, `damage_description`, `created_at`, `updated_at`) VALUES
(6, 'HIOSO', '88HNSKH678', 1, 2, 927, '100000000', 'normal', NULL, '2025-06-16 18:27:43', '2025-06-27 18:13:10'),
(10, 'test', 'lkasdjlkasjdl', 9, 4, 100, '10000000', 'normal', NULL, '2025-06-17 18:07:23', '2025-06-27 17:49:49');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'ONT', NULL, NULL),
(3, 'ODP', NULL, NULL),
(4, 'Splitter', NULL, NULL),
(6, 'Switch', NULL, NULL),
(7, 'AP', NULL, NULL),
(9, 'Kabel Fiber Optik 1KM', NULL, '2025-06-17 16:12:40'),
(10, 'Kabel UTP', NULL, NULL),
(11, 'Konektor Fiber Optik', NULL, NULL),
(12, 'Konektor RJ45', NULL, NULL),
(13, 'Power Supply', NULL, NULL),
(14, 'Server', NULL, NULL),
(15, 'Laptop', NULL, NULL),
(17, 'ODP Gantung', '2025-06-17 16:36:30', '2025-06-17 16:36:30');

-- --------------------------------------------------------

--
-- Table structure for table `product_reports`
--

CREATE TABLE `product_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_stock_movement_id` bigint(20) UNSIGNED NOT NULL,
  `report_date` datetime NOT NULL,
  `details` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_stock_movements`
--

CREATE TABLE `product_stock_movements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `custom_id` varchar(255) NOT NULL,
  `transaction_date` date NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_supplier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `movement_type` enum('masuk','keluar') NOT NULL,
  `quantity` int(11) NOT NULL,
  `damage_status` enum('none','damaged') NOT NULL DEFAULT 'none',
  `damage_reason` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_stock_movements`
--

INSERT INTO `product_stock_movements` (`id`, `custom_id`, `transaction_date`, `product_id`, `user_id`, `product_supplier_id`, `movement_type`, `quantity`, `damage_status`, `damage_reason`, `created_at`, `updated_at`) VALUES
(7, 'OUT/20250624/00001', '2025-06-23', 6, 4, NULL, 'keluar', 1, 'none', NULL, '2025-06-23 19:38:42', '2025-06-23 19:38:42'),
(8, 'IN/20250624/00001', '2025-05-22', 6, 4, NULL, 'masuk', 10, 'none', NULL, '2025-06-23 19:38:59', '2025-06-23 19:38:59'),
(9, 'IN/20250624/00002', '2025-04-21', 6, 4, NULL, 'masuk', 900, 'none', NULL, '2025-06-23 19:40:57', '2025-06-23 19:40:57'),
(10, 'OUT/20250624/00002', '2025-03-20', 10, 4, NULL, 'keluar', 2, 'none', NULL, '2025-06-23 19:41:15', '2025-06-23 19:41:15'),
(11, 'B/20250626/00001', '2025-06-26', 10, 4, NULL, 'masuk', 100, 'damaged', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Distinctio inventore, iure in corrupti tenetur exercitationem cupiditate quibusdam! Consectetur, quisquam nobis.', '2025-06-25 18:27:23', '2025-06-25 18:27:23'),
(12, 'OUT/20250628/00001', '2025-06-28', 10, 4, NULL, 'keluar', 1, 'none', NULL, '2025-06-27 17:49:49', '2025-06-27 17:49:49'),
(14, 'OUT/20250628/00002', '2025-06-28', 6, 4, NULL, 'keluar', 1, 'none', NULL, '2025-06-27 18:13:10', '2025-06-27 18:13:10');

-- --------------------------------------------------------

--
-- Table structure for table `product_suppliers`
--

CREATE TABLE `product_suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact_info` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_suppliers`
--

INSERT INTO `product_suppliers` (`id`, `name`, `contact_info`, `address`, `created_at`, `updated_at`) VALUES
(1, 'PT. Elektronik Jaya', '082123456789', 'Jakarta', NULL, NULL),
(2, 'Furniture Indah', '081987654321', 'Surabaya', NULL, NULL),
(3, 'Fashion Trend', '081234567890', 'Bandung', NULL, NULL),
(4, 'Makanan Sehat', '082345678901', 'Yogyakarta', NULL, NULL),
(5, 'Tulis Cepat', '083456789012', 'Semarang', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'web', '2025-05-20 07:04:02', '2025-05-20 07:04:02'),
(2, 'Karyawan', 'web', '2025-05-20 07:04:42', '2025-05-20 07:04:42');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(6, 1),
(7, 1),
(7, 2),
(8, 1),
(9, 1),
(9, 2),
(10, 1);

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
('nzRwY8Anm9eNNJmrIaFT7pR1y0kJl8sSAYyze1GU', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36 Edg/137.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZTk2RFIwMWlEbmFySFJ3SFhaaTc0QTl5czlKdlFxWVQ0bmMxREFXVCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjUwOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWJzZW5zaS1yZXBvcnRzL2V4cG9ydC9leGNlbCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjQ7fQ==', 1751051583);

-- --------------------------------------------------------

--
-- Table structure for table `sla`
--

CREATE TABLE `sla` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_sla` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sla`
--

INSERT INTO `sla` (`id`, `nama_sla`, `description`, `time`, `created_at`, `updated_at`) VALUES
(1, '2 Jam - FTTH', 'Melakukan pemasangan baru ke rumah pelanggan pribadi', '2', '2025-02-03 02:47:25', '2025-02-03 03:07:51'),
(2, '4 Jam - Maintenance FTTH', 'Melakukan perbaikan ke rumah pelanggan', '4', '2025-02-03 02:52:00', '2025-02-03 02:52:00'),
(3, '8 Jam - Maintenance Dropcore', 'Melakukan maintenance dropcore', '8', '2025-02-03 02:52:35', '2025-02-03 02:52:35'),
(5, '12 Jam - Maintenance Jaringan', 'Melakukan maintenance di jaringan data', '12', '2025-02-03 03:08:35', '2025-02-03 03:08:35');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_tugas` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `nama_tugas`, `created_at`, `updated_at`) VALUES
(1, 'Pasang Baru', '2025-02-02 04:16:07', '2025-02-02 04:16:07'),
(2, 'Maintenance', '2025-02-02 04:16:14', '2025-02-02 04:16:14'),
(3, 'Pasang Drop Core', '2025-02-02 04:16:27', '2025-02-02 04:16:27'),
(4, 'Installasi Server', '2025-02-02 04:16:53', '2025-02-02 04:16:53');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `priority_id` bigint(20) UNSIGNED NOT NULL,
  `sla_id` bigint(20) UNSIGNED NOT NULL,
  `task_id` bigint(20) UNSIGNED NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `image_address` varchar(255) DEFAULT NULL,
  `latitude_ticket` varchar(255) NOT NULL,
  `longitude_ticket` varchar(255) NOT NULL,
  `image_task` varchar(255) DEFAULT NULL,
  `latitude_task` varchar(255) DEFAULT NULL,
  `longitude_task` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'open',
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `note` text DEFAULT NULL,
  `closed_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `user_id`, `priority_id`, `sla_id`, `task_id`, `customer_name`, `customer_address`, `image_address`, `latitude_ticket`, `longitude_ticket`, `image_task`, `latitude_task`, `longitude_task`, `status`, `start_date`, `end_date`, `note`, `closed_by`, `created_at`, `updated_at`) VALUES
(78, 6, 1, 2, 1, 'test', 'tsest', '1750690335.png', '-7.30725050344899', '112.68550855818874', NULL, NULL, NULL, 'open', NULL, NULL, NULL, NULL, '2025-06-23 14:52:15', '2025-06-23 14:52:15'),
(79, 5, 2, 1, 1, 'j', 'j', '1750690900.png', '-7.302993803070993', '112.68061976464881', NULL, NULL, NULL, 'open', NULL, NULL, NULL, NULL, '2025-06-23 15:01:40', '2025-06-23 15:01:40'),
(80, 5, 1, 1, 1, 'tttt', 'trhgf', '1750690969.png', '-7.3080167052110525', '112.6741871415699', NULL, NULL, NULL, 'open', NULL, NULL, NULL, NULL, '2025-06-23 15:02:49', '2025-06-23 15:02:49'),
(81, 5, 2, 3, 2, 'kjhkjh', 'jkn', '1750691099.png', '-7.3076761712568015', '112.68310704557261', NULL, NULL, NULL, 'open', NULL, NULL, NULL, NULL, '2025-06-23 15:04:59', '2025-06-23 15:04:59'),
(82, 5, 2, 2, 1, 't', 't', NULL, '-7.29584245520867', '112.66492416433634', NULL, NULL, NULL, 'onprogress', '2025-06-27 20:46:32', NULL, NULL, NULL, '2025-06-23 15:08:43', '2025-06-27 13:46:32');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'aktif',
  `alamat` varchar(255) DEFAULT NULL,
  `no_hp` varchar(255) NOT NULL DEFAULT '-',
  `telegram_id` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `foto`, `status`, `alamat`, `no_hp`, `telegram_id`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 'Administrator', 'admin@gmail.com', NULL, 'aktif', '-', '081584882233', '1678655923', NULL, '$2y$12$x5Vrpjh0VyuDxM.PrCLMAu4LOPWmQSRAiCTHrRNUnLtK1uA1FJ2iy', NULL, '2025-05-20 08:43:36', '2025-05-20 08:43:36'),
(5, 'Karyawan 1', 'karyawan@gmail.com', NULL, 'aktif', 'user', '0812322313871', '1678655923', NULL, '$2y$12$PG5I.jW9MdTk/SOcjmo2/eCkt0okHnC0y8FU7819vEU5zHvDwKOUK', NULL, '2025-05-20 08:44:59', '2025-05-20 08:44:59'),
(6, 'test', 'test1@gmail.com', NULL, 'aktif', 'test', '09299782', '1678655923', NULL, '$2y$12$2d0auoZoLhfTJZslIz.UY.AVYz5Wl34tZfZxy8OdlWPVqWwUfFnKO', NULL, '2025-06-17 18:46:44', '2025-06-17 18:48:14'),
(9, 'test 2', 'test2@gmail.com', NULL, 'aktif', 'test 2', '-', 'test', NULL, '$2y$12$NtSajL4/1g6FUWt9vatSjugY9QY6HWheNgW2Z7R4NOWsiXzvYTEs6', NULL, '2025-06-27 14:35:06', '2025-06-27 17:01:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensis`
--
ALTER TABLE `absensis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `absensis_user_id_foreign` (`user_id`);

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
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `karyawans`
--
ALTER TABLE `karyawans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `networks`
--
ALTER TABLE `networks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `priorities`
--
ALTER TABLE `priorities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_sku_unique` (`sku`),
  ADD KEY `products_product_category_id_foreign` (`product_category_id`),
  ADD KEY `products_product_supplier_id_foreign` (`product_supplier_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_categories_name_unique` (`name`);

--
-- Indexes for table `product_reports`
--
ALTER TABLE `product_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_reports_product_id_foreign` (`product_id`),
  ADD KEY `product_reports_user_id_foreign` (`user_id`),
  ADD KEY `product_reports_product_stock_movement_id_foreign` (`product_stock_movement_id`);

--
-- Indexes for table `product_stock_movements`
--
ALTER TABLE `product_stock_movements`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_stock_movements_custom_id_unique` (`custom_id`),
  ADD KEY `product_stock_movements_product_id_foreign` (`product_id`),
  ADD KEY `product_stock_movements_user_id_foreign` (`user_id`),
  ADD KEY `product_stock_movements_product_supplier_id_foreign` (`product_supplier_id`);

--
-- Indexes for table `product_suppliers`
--
ALTER TABLE `product_suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `sla`
--
ALTER TABLE `sla`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tickets_priority_id_foreign` (`priority_id`),
  ADD KEY `tickets_sla_id_foreign` (`sla_id`),
  ADD KEY `task_id_2` (`task_id`),
  ADD KEY `tickets_user_id_foreign` (`user_id`);

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
-- AUTO_INCREMENT for table `absensis`
--
ALTER TABLE `absensis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
-- AUTO_INCREMENT for table `karyawans`
--
ALTER TABLE `karyawans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `networks`
--
ALTER TABLE `networks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `priorities`
--
ALTER TABLE `priorities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `product_reports`
--
ALTER TABLE `product_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_stock_movements`
--
ALTER TABLE `product_stock_movements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product_suppliers`
--
ALTER TABLE `product_suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sla`
--
ALTER TABLE `sla`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensis`
--
ALTER TABLE `absensis`
  ADD CONSTRAINT `absensis_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_product_category_id_foreign` FOREIGN KEY (`product_category_id`) REFERENCES `product_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_product_supplier_id_foreign` FOREIGN KEY (`product_supplier_id`) REFERENCES `product_suppliers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_reports`
--
ALTER TABLE `product_reports`
  ADD CONSTRAINT `product_reports_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_reports_product_stock_movement_id_foreign` FOREIGN KEY (`product_stock_movement_id`) REFERENCES `product_stock_movements` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_stock_movements`
--
ALTER TABLE `product_stock_movements`
  ADD CONSTRAINT `product_stock_movements_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_stock_movements_product_supplier_id_foreign` FOREIGN KEY (`product_supplier_id`) REFERENCES `product_suppliers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_stock_movements_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `tickets_priority_id_foreign` FOREIGN KEY (`priority_id`) REFERENCES `priorities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tickets_sla_id_foreign` FOREIGN KEY (`sla_id`) REFERENCES `sla` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tickets_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tickets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
