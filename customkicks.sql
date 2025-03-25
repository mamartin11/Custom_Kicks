-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-03-2025 a las 04:39:06
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `customkicks`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customizations`
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
-- Volcado de datos para la tabla `customizations`
--

INSERT INTO `customizations` (`id`, `color`, `design`, `pattern`, `image`, `created_at`, `updated_at`) VALUES
(4, 'Azul', 'Cuero', 'Cocodrilo', 'customizations/GH5xwgS5vvgWdpFroJZH2fOKTQLQXAtT91Hl0PUF.png', '2025-03-25 06:56:35', '2025-03-25 07:58:42'),
(5, 'Rojo', 'Tela', 'Rayas', 'customizations/NKS9uzeELCXbHCVMsIRFGun9TBMFX9OHTGReJuag.png', '2025-03-25 06:58:51', '2025-03-25 07:58:53'),
(6, 'Morado', 'Cuero', 'Puntos', 'customizations/qNi8Qt0JZX0qXjWmenwhPyysnrfJfpn0nfRDsksH.png', '2025-03-25 06:59:13', '2025-03-25 07:59:04'),
(7, 'Multicolor', 'Knit', 'Tiedye', 'customizations/qlLeEaEwN9BNmgZV1sKn1HDQqIJJH9wxlDv2vZ27.png', '2025-03-25 06:59:47', '2025-03-25 07:59:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
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
-- Estructura de tabla para la tabla `items`
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
-- Volcado de datos para la tabla `items`
--

INSERT INTO `items` (`id`, `subtotal`, `product_id`, `customization_id`, `created_at`, `updated_at`) VALUES
(11, 51, 2, 7, '2025-03-25 07:34:17', '2025-03-25 07:34:17'),
(12, 221, 3, 5, '2025-03-25 07:42:14', '2025-03-25 07:42:14'),
(13, 131, 10, 5, '2025-03-25 08:00:38', '2025-03-25 08:00:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
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
-- Estructura de tabla para la tabla `job_batches`
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
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
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
(11, '2025_03_25_020901_change_default_value_in_table', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `total` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`id`, `total`, `order_date`, `user_id`, `created_at`, `updated_at`, `details`) VALUES
(3, 50, '2025-03-25', 5, '2025-03-25 07:36:04', '2025-03-25 07:36:04', '[{\"product_id\":2,\"product_name\":\"Adidas campus\",\"price\":50.99,\"customization_id\":7,\"customization\":{\"color\":\"Multicolor\",\"design\":\"Tiedye\",\"pattern\":\"Knit\"},\"subtotal\":50.99}]'),
(4, 50, '2025-03-25', 5, '2025-03-25 07:38:44', '2025-03-25 07:38:44', '[{\"product_id\":2,\"product_name\":\"Adidas campus\",\"price\":50.99,\"customization_id\":7,\"customization\":{\"color\":\"Multicolor\",\"design\":\"Tiedye\",\"pattern\":\"Knit\"},\"subtotal\":50.99}]'),
(5, 50, '2025-03-25', 5, '2025-03-25 07:41:13', '2025-03-25 07:41:13', '[{\"product_id\":2,\"product_name\":\"Adidas campus\",\"price\":50.99,\"customization_id\":7,\"customization\":{\"color\":\"Multicolor\",\"design\":\"Tiedye\",\"pattern\":\"Knit\"},\"subtotal\":50.99}]'),
(6, 220, '2025-03-25', 6, '2025-03-25 07:42:15', '2025-03-25 07:42:15', '[{\"product_id\":3,\"product_name\":\"Yeezy 350\",\"price\":220.99,\"customization_id\":5,\"customization\":{\"color\":\"Rojo\",\"design\":\"Rayas\",\"pattern\":\"Tela\"},\"subtotal\":220.99}]'),
(7, 220, '2025-03-25', 6, '2025-03-25 07:47:05', '2025-03-25 07:47:05', '[{\"product_id\":3,\"product_name\":\"Yeezy 350\",\"price\":220.99,\"customization_id\":5,\"customization\":{\"color\":\"Rojo\",\"design\":\"Rayas\",\"pattern\":\"Tela\"},\"subtotal\":220.99}]'),
(8, 220, '2025-03-25', 6, '2025-03-25 07:47:32', '2025-03-25 07:47:32', '[{\"product_id\":3,\"product_name\":\"Yeezy 350\",\"price\":220.99,\"customization_id\":5,\"customization\":{\"color\":\"Rojo\",\"design\":\"Rayas\",\"pattern\":\"Tela\"},\"subtotal\":220.99}]'),
(9, 220, '2025-03-25', 6, '2025-03-25 07:48:13', '2025-03-25 07:48:13', '[{\"product_id\":3,\"product_name\":\"Yeezy 350\",\"price\":220.99,\"customization_id\":5,\"customization\":{\"color\":\"Rojo\",\"design\":\"Rayas\",\"pattern\":\"Tela\"},\"subtotal\":220.99}]'),
(10, 220, '2025-03-25', 6, '2025-03-25 07:48:20', '2025-03-25 07:48:20', '[{\"product_id\":3,\"product_name\":\"Yeezy 350\",\"price\":220.99,\"customization_id\":5,\"customization\":{\"color\":\"Rojo\",\"design\":\"Rayas\",\"pattern\":\"Tela\"},\"subtotal\":220.99}]'),
(11, 220, '2025-03-25', 6, '2025-03-25 07:48:55', '2025-03-25 07:48:55', '[{\"product_id\":3,\"product_name\":\"Yeezy 350\",\"price\":220.99,\"customization_id\":5,\"customization\":{\"color\":\"Rojo\",\"design\":\"Rayas\",\"pattern\":\"Tela\"},\"subtotal\":220.99}]'),
(12, 220, '2025-03-25', 6, '2025-03-25 07:50:10', '2025-03-25 07:50:10', '[{\"product_id\":3,\"product_name\":\"Yeezy 350\",\"price\":220.99,\"customization_id\":5,\"customization\":{\"color\":\"Rojo\",\"design\":\"Rayas\",\"pattern\":\"Tela\"},\"subtotal\":220.99}]'),
(13, 220, '2025-03-25', 6, '2025-03-25 07:50:28', '2025-03-25 07:50:28', '[{\"product_id\":3,\"product_name\":\"Yeezy 350\",\"price\":220.99,\"customization_id\":5,\"customization\":{\"color\":\"Rojo\",\"design\":\"Rayas\",\"pattern\":\"Tela\"},\"subtotal\":220.99}]'),
(14, 220, '2025-03-25', 6, '2025-03-25 07:50:53', '2025-03-25 07:50:53', '[{\"product_id\":3,\"product_name\":\"Yeezy 350\",\"price\":220.99,\"customization_id\":5,\"customization\":{\"color\":\"Rojo\",\"design\":\"Rayas\",\"pattern\":\"Tela\"},\"subtotal\":220.99}]'),
(15, 220, '2025-03-25', 6, '2025-03-25 07:54:01', '2025-03-25 07:54:01', '[{\"product_id\":3,\"product_name\":\"Yeezy 350\",\"price\":220.99,\"customization_id\":5,\"customization\":{\"color\":\"Rojo\",\"design\":\"Rayas\",\"pattern\":\"Tela\"},\"subtotal\":220.99}]'),
(16, 220, '2025-03-25', 6, '2025-03-25 07:54:35', '2025-03-25 07:54:35', '[{\"product_id\":3,\"product_name\":\"Yeezy 350\",\"price\":220.99,\"customization_id\":5,\"customization\":{\"color\":\"Rojo\",\"design\":\"Rayas\",\"pattern\":\"Tela\"},\"subtotal\":220.99}]'),
(17, 130, '2025-03-25', 5, '2025-03-25 08:07:29', '2025-03-25 08:07:29', '[{\"product_id\":10,\"product_name\":\"Nike Blazer High\",\"price\":130.99,\"customization_id\":5,\"customization\":{\"color\":\"Rojo\",\"design\":\"Tela\",\"pattern\":\"Rayas\"},\"subtotal\":130.99}]'),
(18, 130, '2025-03-25', 5, '2025-03-25 08:09:30', '2025-03-25 08:09:30', '[{\"product_id\":10,\"product_name\":\"Nike Blazer High\",\"price\":130.99,\"customization_id\":5,\"customization\":{\"color\":\"Rojo\",\"design\":\"Tela\",\"pattern\":\"Rayas\"},\"subtotal\":130.99}]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `description` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `size` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `description`, `brand`, `size`, `quantity`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Air Jordan 1', 100.99, 'Jordan brand siempre debe estar en tu closet.', 'Nike', 10, 2, 'products/erYOYrOE70ZczOBAfXE5AAQ5dALnagBXvMSikv3p.png', '2025-03-25 05:14:22', '2025-03-25 07:00:17'),
(2, 'Adidas campus', 50.99, 'Una de las siluetas más icónicas de Adidas.', 'Adidas', 10.5, 10, 'products/RweVQfL6PhhbVenYaMOWLfBfMqWJdkBsMYkx8VTk.webp', '2025-03-25 05:15:02', '2025-03-25 07:00:40'),
(3, 'Yeezy 350', 220.99, 'El producto más vendido en la historia de YE', 'Adidas', 11, 10, 'products/5BG2xR9wTvH4VA0t7qRPjxdIVuauAjbeM5j1cbSO.webp', '2025-03-25 06:44:33', '2025-03-25 07:01:05'),
(4, 'Asics 330', 70.5, 'Asics es una marca que es solo para conocedores de la comodidad', 'Asics', 8, 13, 'products/caY58JK2p3AiCKs97zPpweZfyZOjq9dzwxV51toE.webp', '2025-03-25 06:45:18', '2025-03-25 07:01:25'),
(5, 'New Balance 220', 150, 'La silueta más cómoda que manejamos', 'New Balance', 9.5, 4, 'products/JhnMtDPPqepPx5o5HnaIOHerjFW3MvNG1ehDPGf9.webp', '2025-03-25 06:46:01', '2025-03-25 07:01:53'),
(6, 'New Balance 1906R', 110.99, 'Este sneaker es un grail que deberías tener', 'New Balance', 7, 12, 'products/0kf3BTzHidYlmbwfViC6AtlyYwoGItj7KepBq0T8.webp', '2025-03-25 06:46:46', '2025-03-25 07:02:22'),
(7, 'New Balance 890', 99.99, 'Dale un toque diferente a una silueta que queda bien con todo', 'New Balance', 12.5, 6, 'products/67FTDXeSG1WQARg4dD0L2IbbzGiwBKZtpcIv66p1.webp', '2025-03-25 06:47:38', '2025-03-25 07:02:45'),
(8, 'Adidas forum High', 80.99, 'Si te gusta el basketball y prefieres Adidas, esto tiene que ser tuyo', 'Adidas', 6.5, 9, 'products/qptnxYpSLFLUThutzgGb5werIHoMNxZAf2YYAceS.webp', '2025-03-25 06:48:20', '2025-03-25 07:03:21'),
(9, 'Crocs', 35.95, 'Si quieres un estilo más que único, esto definitivamente es para ti', 'Crocs', 10, 22, 'products/r0D2j9gCglcq52qPCEqje0s8O5afV2XQumRWLu1x.webp', '2025-03-25 06:49:36', '2025-03-25 07:03:42'),
(10, 'Nike Blazer High', 130.99, 'Si eres un gym rat, cómpralo ahora', 'Nike', 9, 2, 'products/2bzb3nGDFw27IRtJQAQs7VDVOV9c70UtsfF09MhO.webp', '2025-03-25 06:50:25', '2025-03-25 07:03:59'),
(11, 'Nike Dunk Panda', 100, 'Todos tienen un panda, pero no customizado por nosotros', 'Nike', 9.5, 20, 'products/EUUuGeQblP3sBSFylHIjbTfCzVrMjA4kILoJfwEM.png', '2025-03-25 06:51:38', '2025-03-25 07:04:20'),
(12, 'Air Force 1 White', 150, 'Nuestro mejor vendido', 'Nike', 10.5, 9, 'products/npGI4gHF7upEt2EBKF30H1VRZnu4JZFakcV7O8wq.png', '2025-03-25 06:52:14', '2025-03-25 07:04:35'),
(13, 'Air Force 1 Balck', 150, 'Elegancia y personalización en una sola silueta', 'Nike', 11.5, 18, 'products/W499PJpv1NJWZijrEC48S4z2awP60dTjdqfiGnrz.png', '2025-03-25 06:52:47', '2025-03-25 07:04:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
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
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('B7vNo2KlW70UA6eGz3fJBcUWPUj3TbRLE02rHgJq', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoia0lFNXpsZUJINUN5RnZpYlhTeHRIQjRyaXdPaHRqQmQ2S0hiQXJaSyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czo0OiJhdXRoIjthOjE6e3M6MjE6InBhc3N3b3JkX2NvbmZpcm1lZF9hdCI7aToxNzQyODY0NzU4O319', 1742864758),
('Op211k5q8SekrZkqS1QCGNxmBGWfYeLqub59KJFH', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoicWpVRUNCc2Y2bjVuY2dyekF6b1pmOVBXQVlBdE0yV2RTcG5Lb1NzayI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9vcmRlci9jaGVja291dCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjU7czo0OiJhdXRoIjthOjE6e3M6MjE6InBhc3N3b3JkX2NvbmZpcm1lZF9hdCI7aToxNzQyODcxNDU0O31zOjEwOiJjYXJ0X2l0ZW1zIjthOjE6e2k6MDthOjY6e3M6MTA6InByb2R1Y3RfaWQiO2k6MTA7czoxMjoicHJvZHVjdF9uYW1lIjtzOjE2OiJOaWtlIEJsYXplciBIaWdoIjtzOjU6InByaWNlIjtkOjEzMC45OTtzOjE2OiJjdXN0b21pemF0aW9uX2lkIjtpOjU7czoxMzoiY3VzdG9taXphdGlvbiI7YTozOntzOjU6ImNvbG9yIjtzOjQ6IlJvam8iO3M6NjoiZGVzaWduIjtzOjQ6IlRlbGEiO3M6NzoicGF0dGVybiI7czo1OiJSYXlhcyI7fXM6ODoic3VidG90YWwiO2Q6MTMwLjk5O319fQ==', 1742872170);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
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
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `budget`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(5, 'Miguel', 'miguel@customkicks.com', NULL, '$2y$12$cU74HQVGvoZe9HtxKt9IK.L7368jlwnV6DiwY4jvFQKIhYbrgnToS', 500, 'admin', NULL, '2025-03-25 07:11:32', '2025-03-25 07:11:32'),
(6, 'Juanito', 'juanito@gmail.com', NULL, '$2y$12$mel9.lQkrcghPVx4Z2lpsu3x1dm7ZoJz17E2dOw1AtKkdVKMPoACq', 500, 'customer', NULL, '2025-03-25 07:12:00', '2025-03-25 07:12:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `customizations`
--
ALTER TABLE `customizations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_product_id_foreign` (`product_id`),
  ADD KEY `item_customization_id_foreign` (`customization_id`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `customizations`
--
ALTER TABLE `customizations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `item_customization_id_foreign` FOREIGN KEY (`customization_id`) REFERENCES `customizations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `item_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
