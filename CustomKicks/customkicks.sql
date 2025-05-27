-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 27, 2025 at 05:39 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `customkicks`
--


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
('n@gmail|127.0.0.1', 'i:1;', 1748228568),
('n@gmail|127.0.0.1:timer', 'i:1748228568;', 1748228568);

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
-- Table structure for table `customizations`
--

CREATE TABLE `customizations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `color` varchar(255) NOT NULL,
  `design` varchar(255) NOT NULL,
  `pattern` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customizations`
--

INSERT INTO `customizations` (`id`, `color`, `design`, `pattern`, `image`, `created_at`, `updated_at`) VALUES
(4, 'Azul', 'Cuero', 'Cocodrilo', 'customizations/GH5xwgS5vvgWdpFroJZH2fOKTQLQXAtT91Hl0PUF.png', '2025-03-25 06:56:35', '2025-03-25 07:58:42'),
(5, 'Rojo', 'Tela', 'Rayas', 'customizations/NKS9uzeELCXbHCVMsIRFGun9TBMFX9OHTGReJuag.png', '2025-03-25 06:58:51', '2025-03-25 07:58:53'),
(6, 'Morado', 'Cuero', 'Puntos', 'customizations/qNi8Qt0JZX0qXjWmenwhPyysnrfJfpn0nfRDsksH.png', '2025-03-25 06:59:13', '2025-03-25 07:59:04'),
(7, 'Multicolor', 'Knit', 'Tiedye', 'customizations/qlLeEaEwN9BNmgZV1sKn1HDQqIJJH9wxlDv2vZ27.png', '2025-03-25 06:59:47', '2025-03-25 07:59:18');

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
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subtotal` int(11) NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `customization_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `subtotal`, `product_id`, `customization_id`, `created_at`, `updated_at`) VALUES
(11, 51, 2, 7, '2025-03-25 07:34:17', '2025-03-25 07:34:17'),
(12, 221, 3, 5, '2025-03-25 07:42:14', '2025-03-25 07:42:14'),
(13, 131, 10, 5, '2025-03-25 08:00:38', '2025-03-25 08:00:38'),
(14, 100, 7, 5, '2025-05-20 22:21:47', '2025-05-20 22:21:47'),
(15, 100, 7, 5, '2025-05-20 22:21:59', '2025-05-20 22:21:59');

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_03_17_023207_create_products_table', 1),
(5, '2025_03_19_030700_create_customizations_table', 1),
(6, '2025_03_19_232437_create_orders_table', 1),
(7, '2025_03_21_234719_update_users_table', 1),
(8, '2025_03_22_211230_create_items_table', 1),
(9, '2025_03_25_013634_add_items_id_to_order_table', 2),
(10, '2025_03_25_014148_rename_column_in_table', 3),
(11, '2025_03_25_020901_change_default_value_in_table', 4),
(12, '2024_03_21_000000_add_shipping_fields_to_orders_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `total` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `discount` int(11) DEFAULT 0,
  `shipping_type` varchar(255) NOT NULL DEFAULT 'standard',
  `shipping_cost` decimal(10,2) NOT NULL DEFAULT 0.00,
  `tracking_number` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `total`, `order_date`, `user_id`, `created_at`, `updated_at`, `details`, `discount`, `shipping_type`, `shipping_cost`, `tracking_number`, `status`) VALUES
(3, 50, '2025-03-25', 5, '2025-03-25 07:36:04', '2025-03-25 07:36:04', '[{\"product_id\":2,\"product_name\":\"Adidas campus\",\"price\":50.99,\"customization_id\":7,\"customization\":{\"color\":\"Multicolor\",\"design\":\"Tiedye\",\"pattern\":\"Knit\"},\"subtotal\":50.99}]', 0, 'standard', 0.00, NULL, 'pending'),
(4, 50, '2025-03-25', 5, '2025-03-25 07:38:44', '2025-03-25 07:38:44', '[{\"product_id\":2,\"product_name\":\"Adidas campus\",\"price\":50.99,\"customization_id\":7,\"customization\":{\"color\":\"Multicolor\",\"design\":\"Tiedye\",\"pattern\":\"Knit\"},\"subtotal\":50.99}]', 0, 'standard', 0.00, NULL, 'pending'),
(5, 50, '2025-03-25', 5, '2025-03-25 07:41:13', '2025-03-25 07:41:13', '[{\"product_id\":2,\"product_name\":\"Adidas campus\",\"price\":50.99,\"customization_id\":7,\"customization\":{\"color\":\"Multicolor\",\"design\":\"Tiedye\",\"pattern\":\"Knit\"},\"subtotal\":50.99}]', 0, 'standard', 0.00, NULL, 'pending'),
(6, 220, '2025-03-25', 6, '2025-03-25 07:42:15', '2025-03-25 07:42:15', '[{\"product_id\":3,\"product_name\":\"Yeezy 350\",\"price\":220.99,\"customization_id\":5,\"customization\":{\"color\":\"Rojo\",\"design\":\"Rayas\",\"pattern\":\"Tela\"},\"subtotal\":220.99}]', 0, 'standard', 0.00, NULL, 'pending'),
(7, 220, '2025-03-25', 6, '2025-03-25 07:47:05', '2025-03-25 07:47:05', '[{\"product_id\":3,\"product_name\":\"Yeezy 350\",\"price\":220.99,\"customization_id\":5,\"customization\":{\"color\":\"Rojo\",\"design\":\"Rayas\",\"pattern\":\"Tela\"},\"subtotal\":220.99}]', 0, 'standard', 0.00, NULL, 'pending'),
(8, 220, '2025-03-25', 6, '2025-03-25 07:47:32', '2025-03-25 07:47:32', '[{\"product_id\":3,\"product_name\":\"Yeezy 350\",\"price\":220.99,\"customization_id\":5,\"customization\":{\"color\":\"Rojo\",\"design\":\"Rayas\",\"pattern\":\"Tela\"},\"subtotal\":220.99}]', 0, 'standard', 0.00, NULL, 'pending'),
(9, 220, '2025-03-25', 6, '2025-03-25 07:48:13', '2025-03-25 07:48:13', '[{\"product_id\":3,\"product_name\":\"Yeezy 350\",\"price\":220.99,\"customization_id\":5,\"customization\":{\"color\":\"Rojo\",\"design\":\"Rayas\",\"pattern\":\"Tela\"},\"subtotal\":220.99}]', 0, 'standard', 0.00, NULL, 'pending'),
(10, 220, '2025-03-25', 6, '2025-03-25 07:48:20', '2025-03-25 07:48:20', '[{\"product_id\":3,\"product_name\":\"Yeezy 350\",\"price\":220.99,\"customization_id\":5,\"customization\":{\"color\":\"Rojo\",\"design\":\"Rayas\",\"pattern\":\"Tela\"},\"subtotal\":220.99}]', 0, 'standard', 0.00, NULL, 'pending'),
(11, 220, '2025-03-25', 6, '2025-03-25 07:48:55', '2025-03-25 07:48:55', '[{\"product_id\":3,\"product_name\":\"Yeezy 350\",\"price\":220.99,\"customization_id\":5,\"customization\":{\"color\":\"Rojo\",\"design\":\"Rayas\",\"pattern\":\"Tela\"},\"subtotal\":220.99}]', 0, 'standard', 0.00, NULL, 'pending'),
(12, 220, '2025-03-25', 6, '2025-03-25 07:50:10', '2025-03-25 07:50:10', '[{\"product_id\":3,\"product_name\":\"Yeezy 350\",\"price\":220.99,\"customization_id\":5,\"customization\":{\"color\":\"Rojo\",\"design\":\"Rayas\",\"pattern\":\"Tela\"},\"subtotal\":220.99}]', 0, 'standard', 0.00, NULL, 'pending'),
(13, 220, '2025-03-25', 6, '2025-03-25 07:50:28', '2025-03-25 07:50:28', '[{\"product_id\":3,\"product_name\":\"Yeezy 350\",\"price\":220.99,\"customization_id\":5,\"customization\":{\"color\":\"Rojo\",\"design\":\"Rayas\",\"pattern\":\"Tela\"},\"subtotal\":220.99}]', 0, 'standard', 0.00, NULL, 'pending'),
(14, 220, '2025-03-25', 6, '2025-03-25 07:50:53', '2025-03-25 07:50:53', '[{\"product_id\":3,\"product_name\":\"Yeezy 350\",\"price\":220.99,\"customization_id\":5,\"customization\":{\"color\":\"Rojo\",\"design\":\"Rayas\",\"pattern\":\"Tela\"},\"subtotal\":220.99}]', 0, 'standard', 0.00, NULL, 'pending'),
(15, 220, '2025-03-25', 6, '2025-03-25 07:54:01', '2025-03-25 07:54:01', '[{\"product_id\":3,\"product_name\":\"Yeezy 350\",\"price\":220.99,\"customization_id\":5,\"customization\":{\"color\":\"Rojo\",\"design\":\"Rayas\",\"pattern\":\"Tela\"},\"subtotal\":220.99}]', 0, 'standard', 0.00, NULL, 'pending'),
(16, 220, '2025-03-25', 6, '2025-03-25 07:54:35', '2025-03-25 07:54:35', '[{\"product_id\":3,\"product_name\":\"Yeezy 350\",\"price\":220.99,\"customization_id\":5,\"customization\":{\"color\":\"Rojo\",\"design\":\"Rayas\",\"pattern\":\"Tela\"},\"subtotal\":220.99}]', 0, 'standard', 0.00, NULL, 'pending'),
(17, 130, '2025-03-25', 5, '2025-03-25 08:07:29', '2025-03-25 08:07:29', '[{\"product_id\":10,\"product_name\":\"Nike Blazer High\",\"price\":130.99,\"customization_id\":5,\"customization\":{\"color\":\"Rojo\",\"design\":\"Tela\",\"pattern\":\"Rayas\"},\"subtotal\":130.99}]', 0, 'standard', 0.00, NULL, 'pending'),
(18, 130, '2025-03-25', 5, '2025-03-25 08:09:30', '2025-03-25 08:09:30', '[{\"product_id\":10,\"product_name\":\"Nike Blazer High\",\"price\":130.99,\"customization_id\":5,\"customization\":{\"color\":\"Rojo\",\"design\":\"Tela\",\"pattern\":\"Rayas\"},\"subtotal\":130.99}]', 0, 'standard', 0.00, NULL, 'pending'),
(19, 152, '2025-05-20', 7, '2025-05-20 22:51:59', '2025-05-20 22:51:59', '[{\"product_id\":2,\"product_name\":\"Adidas campus\",\"price\":50.99,\"customization_id\":4,\"customization\":{\"color\":\"Azul\",\"design\":\"Cuero\",\"pattern\":\"Cocodrilo\"},\"subtotal\":50.99},{\"product_id\":2,\"product_name\":\"Adidas campus\",\"price\":50.99,\"customization_id\":4,\"customization\":{\"color\":\"Azul\",\"design\":\"Cuero\",\"pattern\":\"Cocodrilo\"},\"subtotal\":50.99},{\"product_id\":2,\"product_name\":\"Adidas campus\",\"price\":50.99,\"customization_id\":6,\"customization\":{\"color\":\"Morado\",\"design\":\"Cuero\",\"pattern\":\"Puntos\"},\"subtotal\":50.99}]', 0, 'standard', 0.00, NULL, 'pending'),
(20, 50, '2025-05-20', 7, '2025-05-20 23:08:08', '2025-05-20 23:08:08', '[{\"product_id\":2,\"product_name\":\"Adidas campus\",\"price\":50.99,\"customization_id\":4,\"customization\":{\"color\":\"Azul\",\"design\":\"Cuero\",\"pattern\":\"Cocodrilo\"},\"subtotal\":50.99}]', 0, 'standard', 0.00, NULL, 'pending'),
(21, 50, '2025-05-20', 7, '2025-05-20 23:08:48', '2025-05-20 23:08:48', '[{\"product_id\":2,\"product_name\":\"Adidas campus\",\"price\":50.99,\"customization_id\":4,\"customization\":{\"color\":\"Azul\",\"design\":\"Cuero\",\"pattern\":\"Cocodrilo\"},\"subtotal\":50.99}]', 0, 'standard', 0.00, NULL, 'pending'),
(22, 150, '2025-05-20', 7, '2025-05-20 23:17:10', '2025-05-20 23:17:10', '[{\"product_id\":5,\"product_name\":\"New Balance 220\",\"price\":150,\"customization_id\":4,\"customization\":{\"color\":\"Azul\",\"design\":\"Cuero\",\"pattern\":\"Cocodrilo\"},\"subtotal\":150}]', 0, 'standard', 0.00, NULL, 'pending'),
(23, 50, '2025-05-25', 8, '2025-05-25 21:19:07', '2025-05-25 21:19:07', '[{\"product_id\":2,\"product_name\":\"Adidas campus\",\"price\":50.99,\"customization_id\":5,\"customization\":{\"color\":\"Rojo\",\"design\":\"Tela\",\"pattern\":\"Rayas\"},\"subtotal\":50.99}]', 0, 'standard', 0.00, NULL, 'pending'),
(24, 100, '2025-05-25', 8, '2025-05-25 21:26:32', '2025-05-25 21:26:52', '[{\"product_id\":1,\"product_name\":\"Air Jordan 1\",\"price\":100.99,\"customization_id\":5,\"customization\":{\"color\":\"Rojo\",\"design\":\"Tela\",\"pattern\":\"Rayas\"},\"subtotal\":100.99}]', 20, 'standard', 0.00, NULL, 'pending'),
(25, 150, '2025-05-25', 8, '2025-05-25 21:31:16', '2025-05-25 21:31:42', '[{\"product_id\":5,\"product_name\":\"New Balance 220\",\"price\":150,\"customization_id\":5,\"customization\":{\"color\":\"Rojo\",\"design\":\"Tela\",\"pattern\":\"Rayas\"},\"subtotal\":150}]', 10, 'standard', 0.00, NULL, 'pending'),
(26, 70, '2025-05-25', 8, '2025-05-25 21:32:11', '2025-05-25 21:32:11', '[{\"product_id\":4,\"product_name\":\"Asics 330\",\"price\":70.5,\"customization_id\":4,\"customization\":{\"color\":\"Azul\",\"design\":\"Cuero\",\"pattern\":\"Cocodrilo\"},\"subtotal\":70.5}]', 0, 'standard', 0.00, NULL, 'pending'),
(27, 80, '2025-05-25', 8, '2025-05-25 21:43:01', '2025-05-25 21:43:01', '[{\"product_id\":8,\"product_name\":\"Adidas forum High\",\"price\":80.99,\"customization_id\":4,\"customization\":{\"color\":\"Azul\",\"design\":\"Cuero\",\"pattern\":\"Cocodrilo\"},\"subtotal\":80.99}]', 0, 'standard', 0.00, NULL, 'pending'),
(28, 70, '2025-05-26', 8, '2025-05-26 08:02:38', '2025-05-26 09:35:59', '[{\"product_id\":4,\"product_name\":\"Asics 330\",\"price\":70.5,\"customization_id\":5,\"customization\":{\"color\":\"Rojo\",\"design\":\"Tela\",\"pattern\":\"Rayas\"},\"subtotal\":70.5}]', 50, 'express', 0.00, NULL, 'pending'),
(29, 100, '2025-05-27', 9, '2025-05-27 07:02:56', '2025-05-27 07:02:56', '[{\"product_id\":1,\"product_name\":\"Air Jordan 1\",\"price\":100.99,\"customization_id\":4,\"customization\":{\"color\":\"Azul\",\"design\":\"Cuero\",\"pattern\":\"Cocodrilo\"},\"subtotal\":100.99}]', 0, 'standard', 0.00, NULL, 'pending'),
(30, 50, '2025-05-27', 9, '2025-05-27 07:28:28', '2025-05-27 07:28:28', '[{\"product_id\":2,\"product_name\":\"Adidas campus\",\"price\":50.99,\"customization_id\":4,\"customization\":{\"color\":\"Azul\",\"design\":\"Cuero\",\"pattern\":\"Cocodrilo\"},\"subtotal\":50.99}]', 0, 'standard', 0.00, NULL, 'pending'),
(31, 50, '2025-05-27', 9, '2025-05-27 07:45:19', '2025-05-27 07:45:19', '[{\"product_id\":2,\"product_name\":\"Adidas campus\",\"price\":50.99,\"customization_id\":4,\"customization\":{\"color\":\"Azul\",\"design\":\"Cuero\",\"pattern\":\"Cocodrilo\"},\"subtotal\":50.99}]', 0, 'standard', 0.00, NULL, 'pending'),
(32, 50, '2025-05-27', 9, '2025-05-27 07:47:21', '2025-05-27 07:47:21', '[{\"product_id\":2,\"product_name\":\"Adidas campus\",\"price\":50.99,\"customization_id\":4,\"customization\":{\"color\":\"Azul\",\"design\":\"Cuero\",\"pattern\":\"Cocodrilo\"},\"subtotal\":50.99}]', 0, 'standard', 0.00, NULL, 'pending'),
(33, 100, '2025-05-27', 9, '2025-05-27 07:48:18', '2025-05-27 07:48:18', '[{\"product_id\":1,\"product_name\":\"Air Jordan 1\",\"price\":100.99,\"customization_id\":4,\"customization\":{\"color\":\"Azul\",\"design\":\"Cuero\",\"pattern\":\"Cocodrilo\"},\"subtotal\":100.99}]', 0, 'standard', 0.00, NULL, 'pending'),
(34, 50, '2025-05-27', 9, '2025-05-27 07:49:50', '2025-05-27 07:49:50', '[{\"product_id\":2,\"product_name\":\"Adidas campus\",\"price\":50.99,\"customization_id\":4,\"customization\":{\"color\":\"Azul\",\"design\":\"Cuero\",\"pattern\":\"Cocodrilo\"},\"subtotal\":50.99}]', 0, 'standard', 0.00, NULL, 'pending'),
(35, 50, '2025-05-27', 9, '2025-05-27 07:53:13', '2025-05-27 07:53:13', '[{\"product_id\":2,\"product_name\":\"Adidas campus\",\"price\":50.99,\"customization_id\":4,\"customization\":{\"color\":\"Azul\",\"design\":\"Cuero\",\"pattern\":\"Cocodrilo\"},\"subtotal\":50.99}]', 0, 'standard', 0.00, NULL, 'pending'),
(36, 50, '2025-05-27', 9, '2025-05-27 07:53:44', '2025-05-27 07:53:44', '[{\"product_id\":2,\"product_name\":\"Adidas campus\",\"price\":50.99,\"customization_id\":4,\"customization\":{\"color\":\"Azul\",\"design\":\"Cuero\",\"pattern\":\"Cocodrilo\"},\"subtotal\":50.99}]', 0, 'standard', 0.00, NULL, 'pending'),
(37, 50, '2025-05-27', 9, '2025-05-27 07:55:37', '2025-05-27 07:55:37', '[{\"product_id\":2,\"product_name\":\"Adidas campus\",\"price\":50.99,\"customization_id\":4,\"customization\":{\"color\":\"Azul\",\"design\":\"Cuero\",\"pattern\":\"Cocodrilo\"},\"subtotal\":50.99}]', 0, 'standard', 0.00, NULL, 'pending'),
(38, 50, '2025-05-27', 10, '2025-05-27 07:56:42', '2025-05-27 07:56:42', '[{\"product_id\":2,\"product_name\":\"Adidas campus\",\"price\":50.99,\"customization_id\":4,\"customization\":{\"color\":\"Azul\",\"design\":\"Cuero\",\"pattern\":\"Cocodrilo\"},\"subtotal\":50.99}]', 0, 'standard', 0.00, NULL, 'pending'),
(39, 220, '2025-05-27', 10, '2025-05-27 07:57:26', '2025-05-27 07:57:26', '[{\"product_id\":3,\"product_name\":\"Yeezy 350\",\"price\":220.99,\"customization_id\":4,\"customization\":{\"color\":\"Azul\",\"design\":\"Cuero\",\"pattern\":\"Cocodrilo\"},\"subtotal\":220.99}]', 0, 'standard', 0.00, NULL, 'pending');

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `description` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `size` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` longblob DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `description`, `brand`, `size`, `quantity`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Air Jordan 1', 100.99, 'Jordan brand siempre debe estar en tu closet.', 'Nike', 10, 9, 0x70726f64756374732f6572594f59724f4537305a637a4f4241665845354141513564414c6e61674258764d53696b7633702e706e67, '2025-03-25 05:14:22', '2025-05-26 09:45:38'),
(2, 'Adidas campus', 50.99, 'Una de las siluetas más icónicas de Adidas.', 'Adidas', 10.5, 10, 0x70726f64756374732f5277655651664c365068686256656e59614d4f574c6642664d71574a646b42734d596b783856546b2e77656270, '2025-03-25 05:15:02', '2025-03-25 07:00:40'),
(3, 'Yeezy 350', 220.99, 'El producto más vendido en la historia de YE', 'Adidas', 11, 10, 0x70726f64756374732f35424732785239775476483456413074377152506a78644956756175416a62654d356a316362534f2e77656270, '2025-03-25 06:44:33', '2025-03-25 07:01:05'),
(4, 'Asics 330', 70.5, 'Asics es una marca que es solo para conocedores de la comodidad', 'Asics', 8, 13, 0x70726f64756374732f63615935384a4b3270334169434b7339377a507077655a66795a4f6a7139647a7778563531746f452e77656270, '2025-03-25 06:45:18', '2025-03-25 07:01:25'),
(5, 'New Balance 220', 150, 'La silueta más cómoda que manejamos', 'New Balance', 9.5, 4, 0x70726f64756374732f4a686e4d744450507165705078356f35486e61494f4865726a4657334d764e4731656844504766392e77656270, '2025-03-25 06:46:01', '2025-03-25 07:01:53'),
(6, 'New Balance 1906R', 110.99, 'Este sneaker es un grail que deberías tener', 'New Balance', 7, 12, 0x70726f64756374732f306b663342547a486964596c6d6277665669433641746c7959776f4749746a374b657042713054382e77656270, '2025-03-25 06:46:46', '2025-03-25 07:02:22'),
(7, 'New Balance 890', 99.99, 'Dale un toque diferente a una silueta que queda bien con todo', 'New Balance', 12.5, 6, 0x70726f64756374732f363746544458655347315751415267346444304c324962627a476977424b5a7470634976363670312e77656270, '2025-03-25 06:47:38', '2025-03-25 07:02:45'),
(8, 'Adidas forum High', 80.99, 'Si te gusta el basketball y prefieres Adidas, esto tiene que ser tuyo', 'Adidas', 6.5, 9, 0x70726f64756374732f7170746e785970534c464c55546875747a6747623577657249486f4d4e785a4166325959416365532e77656270, '2025-03-25 06:48:20', '2025-03-25 07:03:21'),
(9, 'Crocs', 35.95, 'Si quieres un estilo más que único, esto definitivamente es para ti', 'Crocs', 10, 22, 0x70726f64756374732f723044326a396743676c6371353271504345716a653073384f35616656325851756d52574c7531782e77656270, '2025-03-25 06:49:36', '2025-03-25 07:03:42'),
(10, 'Nike Blazer High', 130.99, 'Si eres un gym rat, cómpralo ahora', 'Nike', 9, 2, 0x70726f64756374732f32627a62336e4744467732374952744a51415173375644564f5639633730557473664630394d684f2e77656270, '2025-03-25 06:50:25', '2025-03-25 07:03:59'),
(11, 'Nike Dunk Panda', 100, 'Todos tienen un panda, pero no customizado por nosotros', 'Nike', 9.5, 20, 0x70726f64756374732f45555575476551626c503373425346796c48496a625466437a56724d6a41346b494c6f4a6677454d2e706e67, '2025-03-25 06:51:38', '2025-03-25 07:04:20'),
(12, 'Air Force 1 White', 150, 'Nuestro mejor vendido', 'Nike', 10.5, 9, 0x70726f64756374732f6e7047493467484637757045743245424b463330483156525a6e75344a5a46616b6356374f3877712e706e67, '2025-03-25 06:52:14', '2025-03-25 07:04:35'),
(13, 'Air Force 1 Balck', 150, 'Elegancia y personalización en una sola silueta', 'Nike', 11.5, 18, 0x70726f64756374732f57343939504a7076314e4a575a696a724543343853347a32617750363064546a64716669476e727a2e706e67, '2025-03-25 06:52:47', '2025-03-25 07:04:56');

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
('4LsjYMXqsT0CILCfd0wQbWFg25mKNkHvrcxUPVnK', 10, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.5 Safari/605.1.15', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidGlZT3BBblh4Z3NRTzJjaG1LVU1vM05wM0duU2o2d2JxUmxpdHRJTSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0cyI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjEwO30=', 1748317055),
('GZhQUIvD4EWnycvhyviTWRDsKKHTihrzxESv2rgR', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36 OPR/119.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWTRmbmFGZ2kwZkdkVUdjN09vRXlwd3BVQlBCekUwS0l0R3RNNmdxUiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0cyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1748313229);

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
  `budget` int(11) NOT NULL DEFAULT 500,
  `role` enum('admin','customer') NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `budget`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(5, 'Miguel', 'miguel@customkicks.com', NULL, '$2y$12$cU74HQVGvoZe9HtxKt9IK.L7368jlwnV6DiwY4jvFQKIhYbrgnToS', 500, 'admin', NULL, '2025-03-25 07:11:32', '2025-03-25 07:11:32'),
(6, 'Juanito', 'juanito@gmail.com', NULL, '$2y$12$mel9.lQkrcghPVx4Z2lpsu3x1dm7ZoJz17E2dOw1AtKkdVKMPoACq', 500, 'customer', NULL, '2025-03-25 07:12:00', '2025-03-25 07:12:00'),
(7, 'Nicolas', 'Nico@gmail.com', NULL, '$2y$12$1SvvX415bEZZATV5c0WqFu7NWxZu/GORrSp2xcz/Iu/tgJXSI7TDy', 500, 'customer', NULL, '2025-05-20 22:51:35', '2025-05-20 22:51:35'),
(8, 'NicolasHurtado', 'N@gmail.com', NULL, '$2y$12$QpUA1BDJjMoTOarGyFKyTe1Ohb.by2Du4cFoa8vWE1aYXlid5qFa.', 330, 'customer', 'YKv3EqScmfaDtCfsaAmy61ZRhasdF97SuWt6HMkXJhnHVfcmUjHWSP1mlYuR', '2025-05-25 21:18:33', '2025-05-26 08:03:15'),
(9, 'admin', 'admin@customkicks.com', NULL, '$2y$12$D1ilxIAuOa/lagm5.eM1K.wjLwmbMIwoP1m6jfJ.ZFD6x8avFg3ay', 500, 'admin', NULL, '2025-05-26 09:37:41', '2025-05-26 09:37:41'),
(10, 'N', 'Ndfdf@gmail.com', NULL, '$2y$12$NAlkK1k7ehgFgkdz4tncsu8X8PtySxw6aQVMGtgB6gT.NsFSN1nzG', 500, 'customer', NULL, '2025-05-27 07:56:24', '2025-05-27 07:56:24');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `customizations`
--
ALTER TABLE `customizations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_product_id_foreign` (`product_id`),
  ADD KEY `item_customization_id_foreign` (`customization_id`);

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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

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
-- AUTO_INCREMENT for table `customizations`
--
ALTER TABLE `customizations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `item_customization_id_foreign` FOREIGN KEY (`customization_id`) REFERENCES `customizations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `item_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
