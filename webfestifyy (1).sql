-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2025 at 02:41 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webfestifyy`
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
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `delivery_option` varchar(255) NOT NULL DEFAULT 'pickup',
  `delivery_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`delivery_details`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `product_id`, `quantity`, `created_at`, `updated_at`, `start_date`, `end_date`, `delivery_option`, `delivery_details`) VALUES
(1, 10, 13, 1, '2025-06-24 23:39:59', '2025-06-25 01:54:35', '2025-06-26', '2025-06-28', 'pickup', NULL),
(2, 10, 15, 1, '2025-06-24 23:42:41', '2025-06-24 23:42:41', '2025-06-26', '2025-06-30', 'pickup', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Electronics', '', 'There is various electronics that you can rent.', '0000-00-00 00:00:00', '2025-05-01 17:46:33'),
(2, 'Merchandise', '', 'There is various cute merch that you can rent,', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

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
(4, '2025_04_21_123316_create_users_table', 2),
(5, '2025_04_21_123847_create_categories_table', 2),
(6, '2025_04_21_123928_create_products_table', 2),
(7, '2025_04_21_124010_create_orders_table', 2),
(8, '2025_04_21_124057_create_reports_table', 2),
(9, '2025_04_21_124137_create_notifications_table', 2),
(10, '2025_04_22_090316_create_reviews_table', 3),
(11, '2025_05_01_111209_create_order_product_table', 4),
(12, '2025_05_01_175551_create_categories_table', 4),
(13, '2025_05_09_104116_add_name_to_users_table', 4),
(14, '2025_05_09_110313_add_username_to_users_table', 4),
(15, '2025_05_09_111603_rename_full_name_to_name_in_users_table', 4),
(16, '2025_05_12_182148_create_product_images_table', 4),
(17, '2025_05_13_205545_add_picture_to_users_table', 5),
(18, '2025_06_07_074141_create_sessions_table', 6),
(19, '2025_06_18_000000_add_delivery_fields_to_orders_table', 7),
(20, '2025_06_18_152252_add_availability_dates_to_products_table', 8),
(21, '2025_06_18_162315_add_max_rent_duration_to_products_table', 8),
(22, '2025_06_19_034201_remove_available_until_from_products_table', 8),
(23, '2025_06_22_081604_create_carts_table', 8),
(24, '2025_06_22_082935_add_cart_columns_to_carts_table', 8),
(25, '2025_06_22_165847_add_condition_images_to_orders_table', 8),
(26, '2025_06_23_153354_create_rentals_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_code` varchar(255) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` enum('pending','confirmed','active','completed','cancelled') DEFAULT 'pending',
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `payment_status` enum('unpaid','partial','paid') DEFAULT 'unpaid',
  `delivery_option` enum('pickup','delivery') NOT NULL DEFAULT 'pickup',
  `delivery_address` text DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `recipient_name` varchar(100) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `condition_before` varchar(255) DEFAULT NULL,
  `condition_after` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_code`, `total_amount`, `status`, `start_date`, `end_date`, `payment_status`, `delivery_option`, `delivery_address`, `phone_number`, `recipient_name`, `notes`, `created_at`, `updated_at`, `condition_before`, `condition_after`) VALUES
(99, 10, 'FST-20250619-685429E4EA5BA', 495000.00, 'confirmed', '2025-06-20', '2025-06-23', 'paid', 'delivery', 'Polibatam', '082136843895', 'Elsa', NULL, '2025-06-19 08:16:52', '2025-06-19 08:17:15', NULL, NULL),
(100, 10, 'FST-20250619-68542A81A003D', 305000.00, 'pending', '2025-06-19', '2025-06-20', 'unpaid', 'pickup', NULL, NULL, NULL, NULL, '2025-06-19 08:19:29', '2025-06-19 08:19:29', NULL, NULL),
(101, 10, 'FST-20250620-6855162A6DDA9', 3005000.00, 'pending', '2025-06-20', '2025-06-21', 'unpaid', 'pickup', NULL, NULL, NULL, NULL, '2025-06-20 01:04:58', '2025-06-20 01:04:58', NULL, NULL),
(102, 10, 'FST-20250620-6855163A30E95', 3005000.00, 'pending', '2025-06-20', '2025-06-21', 'unpaid', 'pickup', NULL, NULL, NULL, NULL, '2025-06-20 01:05:14', '2025-06-20 01:05:14', NULL, NULL),
(103, 10, 'FST-20250620-6855184172E7F', 3005000.00, 'pending', '2025-06-20', '2025-06-21', 'unpaid', 'pickup', NULL, NULL, NULL, NULL, '2025-06-20 01:13:53', '2025-06-20 01:13:53', NULL, NULL),
(104, 10, 'FST-20250620-6855192FEBA08', 375000.00, 'confirmed', '2025-06-21', '2025-06-23', 'paid', 'delivery', 'Polibatam', '081263789547', 'Elsa', NULL, '2025-06-20 01:17:51', '2025-06-20 01:18:13', NULL, NULL),
(105, 10, 'FST-20250624-685A4F6C7F4D6', 155000.00, 'pending', '2025-06-25', '2025-06-26', 'unpaid', 'pickup', NULL, NULL, NULL, NULL, '2025-06-24 00:10:36', '2025-06-24 00:10:36', NULL, NULL),
(106, 9, 'FST-20250624-685A526A1E4FA', 380000.00, 'pending', '2025-06-25', '2025-06-29', 'unpaid', 'pickup', NULL, NULL, NULL, NULL, '2025-06-24 00:23:22', '2025-06-24 00:23:22', NULL, NULL),
(107, 10, 'FST-20250624-685A5357BCEC8', 230000.00, 'pending', '2025-06-25', '2025-06-27', 'unpaid', 'pickup', NULL, NULL, NULL, NULL, '2025-06-24 00:27:19', '2025-06-24 00:27:19', NULL, NULL),
(108, 10, 'FST-20250624-685A555924CB1', 230000.00, 'confirmed', '2025-06-25', '2025-06-27', 'paid', 'pickup', NULL, NULL, NULL, NULL, '2025-06-24 00:35:53', '2025-06-24 00:36:11', NULL, NULL),
(109, 10, 'FST-20250625-685BA3336AF4C', 755000.00, 'pending', '2025-06-26', '2025-06-27', 'unpaid', 'pickup', NULL, NULL, NULL, NULL, '2025-06-25 00:20:19', '2025-06-25 00:20:19', NULL, NULL),
(110, 10, 'FST-20250625-685BBEE954AC0', 380000.00, 'pending', '2025-06-26', '2025-06-30', 'unpaid', 'pickup', NULL, NULL, NULL, NULL, '2025-06-25 02:18:33', '2025-06-25 02:18:33', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `unit_price` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`id`, `order_id`, `product_id`, `quantity`, `unit_price`, `subtotal`, `created_at`, `updated_at`) VALUES
(94, 99, 15, 1, 80000.00, 320000.00, '2025-06-19 08:16:52', '2025-06-19 08:16:52'),
(95, 100, 13, 2, 50000.00, 200000.00, '2025-06-19 08:19:29', '2025-06-19 08:19:29'),
(96, 101, 16, 1, 1000000.00, 2000000.00, '2025-06-20 01:04:58', '2025-06-20 01:04:58'),
(97, 102, 16, 1, 1000000.00, 2000000.00, '2025-06-20 01:05:14', '2025-06-20 01:05:14'),
(98, 103, 16, 1, 1000000.00, 2000000.00, '2025-06-20 01:13:53', '2025-06-20 01:13:53'),
(99, 104, 15, 1, 80000.00, 240000.00, '2025-06-20 01:17:51', '2025-06-20 01:17:51'),
(100, 105, 13, 1, 50000.00, 100000.00, '2025-06-24 00:10:36', '2025-06-24 00:10:36'),
(101, 106, 13, 1, 50000.00, 250000.00, '2025-06-24 00:23:22', '2025-06-24 00:23:22'),
(102, 107, 13, 1, 50000.00, 150000.00, '2025-06-24 00:27:19', '2025-06-24 00:27:19'),
(103, 108, 13, 1, 50000.00, 150000.00, '2025-06-24 00:35:53', '2025-06-24 00:35:53'),
(104, 109, 13, 1, 50000.00, 50000.00, '2025-06-25 00:20:19', '2025-06-25 00:20:19'),
(105, 109, 15, 1, 80000.00, 80000.00, '2025-06-25 00:20:19', '2025-06-25 00:20:19'),
(106, 110, 13, 1, 50000.00, 250000.00, '2025-06-25 02:18:33', '2025-06-25 02:18:33');

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
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `details` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock_quantity` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('available','maintenance','not_available') DEFAULT 'available',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `available_from` date DEFAULT NULL,
  `available_until` date DEFAULT NULL,
  `max_rent_duration` int(10) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `description`, `details`, `price`, `stock_quantity`, `image`, `status`, `created_at`, `updated_at`, `available_from`, `available_until`, `max_rent_duration`) VALUES
(8, 2, 'Caratbong Ver.2', 'caratbong-ver2', 'Carat ayo sewaa untuk nonton sepentin', NULL, 60000.00, 6, 'products/7KfIQN81h8Ah2jh3JvJbYcvw5pP7oqNXER2GRUNI.jpg', 'available', '2025-05-31 07:49:33', '2025-06-12 18:28:13', NULL, NULL, 1),
(9, 1, 'Iphone 16', 'iphone-16', 'Ini adalah hp Iphone keluaran terbaru dengan teknologi kamera yang jernih untuk merekam atau foto.', NULL, 125000.00, 3, 'products/s5Da0dBR3x91dN08jkDgeRiPa1w0DZUmG88GOGsR.jpg', 'available', '2025-05-31 08:04:23', '2025-06-12 18:28:13', NULL, NULL, 1),
(10, 1, 'Samsung S24 Ultra', 'samsung-s24-ultra', 'Hp Samsung dengan kualitas kamrea jernih', 'Kamera jenis untuk foto dan video', 250000.00, 4, 'products/pLGAlXFjdix21UvBYQt7WWl50NPayGE3Vw5DBAd0.jpg', 'available', '2025-05-31 08:25:41', '2025-06-12 18:28:13', NULL, NULL, 1),
(11, 2, 'Photocard Newjeans', 'photocard-newjeans', 'Photocard', 'Newjeans', 30000.00, 13, 'products/LI3ma5LSCizUHIJJGnE2GtdT9sddON06DSY54K3g.jpg', 'available', '2025-06-02 23:59:15', '2025-06-12 18:28:13', NULL, NULL, 1),
(13, 2, 'Lightstick', 'lightstick', 'Good Conditionc, like new.', 'All good.', 50000.00, 2, NULL, 'available', '2025-06-12 09:28:03', '2025-06-23 14:02:24', '2025-06-23', '2025-06-29', 7),
(15, 1, 'Babymons Lightstick', 'babymons-lightstick', 'Lightstick Babymonster untuk menemani kamu', 'Like new anti rusak, anti air, anti hancur. Banting aja coba.', 80000.00, 2, NULL, 'available', '2025-06-13 00:07:32', '2025-06-25 06:42:27', '2025-06-25', '2025-07-01', 7),
(16, 2, 'apa kek', 'apa-kek', 'okeyy', 'ok manizz', 1000000.00, 12, NULL, 'available', '2025-06-13 02:48:46', '2025-06-14 01:44:45', NULL, NULL, 1),
(18, 1, 'Iphone keren', 'iphone-keren', 'kerenn', 'kerenn', 500000.00, 1, NULL, 'available', '2025-06-13 19:04:58', '2025-06-13 19:04:58', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `path`, `created_at`, `updated_at`) VALUES
(1, 13, 'products/6El8coDDYWE6yTfOO0dL8K1vU15OnwfHxoZ2swVs.png', '2025-06-12 09:28:03', '2025-06-12 09:28:03'),
(2, 13, 'products/kwRzHwbBp8Vvjs8SpBsZIGlxnH7KlisJPZdVwrcQ.png', '2025-06-12 09:28:03', '2025-06-12 09:28:03'),
(6, 15, 'products/hF0etMQCbdykFb3ALb3J92bFsrUfncftQpZnwyOs.jpg', '2025-06-13 00:07:32', '2025-06-13 00:07:32'),
(7, 15, 'products/4neJtX5iCqxZlmrDwAEapDPT6h8aknK1M21RqtZ0.png', '2025-06-13 00:07:32', '2025-06-13 00:07:32'),
(8, 15, 'products/K8XenJ4HJbt9gBtxMrpr8Fft7utZnJ6gVdqL2Tvt.png', '2025-06-13 00:07:32', '2025-06-13 00:07:32'),
(9, 16, 'products/YnvEzZvMn28fWNZfsORiuiXjquwYSwsZgP1FqNTR.png', '2025-06-13 02:48:46', '2025-06-13 02:48:46'),
(10, 16, 'products/yY6Jmibklu51QCiu4JSF6izw9NzKl0IgsBFmpNbp.jpg', '2025-06-13 02:48:46', '2025-06-13 02:48:46'),
(13, 18, 'products/NUbMnEbpqN6elnPI1vDx5lLkyv0SiJ1usu94gu8q.png', '2025-06-13 19:04:58', '2025-06-13 19:04:58'),
(14, 18, 'products/X6VAk29hny69bifqEKyVyzQ0BpZbOMdtEAaeE0Bk.png', '2025-06-13 19:04:58', '2025-06-13 19:04:58');

-- --------------------------------------------------------

--
-- Table structure for table `rentals`
--

CREATE TABLE `rentals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('Pending','Ongoing','Completed') NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `report_type` enum('sales','inventory','customer','issue') NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `content`, `created_at`, `updated_at`) VALUES
(1, 2, 'Pelayanannya oke banget! hasil foto dan videonya jernihh kece abiezzz', '2025-04-22 02:36:40', '2025-04-22 02:36:40'),
(2, 3, 'Pengiriman cepat dan aman! Suka banget sama timnya ❤️', '2025-04-22 02:36:40', '2025-04-22 02:36:40');

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
('B1PClrE9TKvl6LQrAFuGuxqoZUSpx4LyehH50Nfq', 10, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36 Edg/137.0.0.0', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiZXU3Q2x2WEFFamk5ZW9zbnV2Rzh4SmxsQ1ZmbWx6NjFiMW1CU2xaNCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wYXltZW50Ijt9czozOiJ1cmwiO2E6MDp7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjEwO3M6MTE6InJlbnRhbF9kYXRhIjthOjk6e3M6MTA6InByb2R1Y3RfaWQiO3M6MjoiMTMiO3M6ODoicXVhbnRpdHkiO3M6MToiMSI7czoxMDoic3RhcnRfZGF0ZSI7czoxMDoiMjAyNS0wNi0yNSI7czo4OiJlbmRfZGF0ZSI7czoxMDoiMjAyNS0wNi0yNiI7czoxMToicmVudGFsX2RheXMiO2Q6MjtzOjE1OiJkZWxpdmVyeV9vcHRpb24iO3M6NjoicGlja3VwIjtzOjE2OiJkZWxpdmVyeV9hZGRyZXNzIjtOO3M6MTI6InBob25lX251bWJlciI7TjtzOjE0OiJyZWNpcGllbnRfbmFtZSI7Tjt9fQ==', 1750756087),
('gT23nUuoxRiOPMRAIotRgTtRrTrGdTz6yq39Sztw', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36 Edg/137.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQmNDNmM4VjJnZE5raU1tbUlDSEdnMUF5YTYwZk5OSmVYN1dudjdrRCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=', 1750843168),
('OoKnUmsVUTVNOXPSe7vHkAYNlyAJIlRQwm9j4F6f', 10, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36 Edg/137.0.0.0', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiVnRWczdLZ2tKZUpQWmVuRTVFTnZaNXN1S1Iwd050UXpYMm9pTEptYyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9vcmRlci9zdWNjZXNzL0ZTVC0yMDI1MDYyNC02ODVBNTM1N0JDRUM4Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTA7czoxMToicmVudGFsX2RhdGEiO2E6OTp7czoxMDoicHJvZHVjdF9pZCI7czoyOiIxMyI7czo4OiJxdWFudGl0eSI7czoxOiIxIjtzOjEwOiJzdGFydF9kYXRlIjtzOjEwOiIyMDI1LTA2LTI1IjtzOjg6ImVuZF9kYXRlIjtzOjEwOiIyMDI1LTA2LTI3IjtzOjExOiJyZW50YWxfZGF5cyI7ZDozO3M6MTU6ImRlbGl2ZXJ5X29wdGlvbiI7czo2OiJwaWNrdXAiO3M6MTY6ImRlbGl2ZXJ5X2FkZHJlc3MiO047czoxMjoicGhvbmVfbnVtYmVyIjtOO3M6MTQ6InJlY2lwaWVudF9uYW1lIjtOO31zOjE2OiJjdXJyZW50X29yZGVyX2lkIjtpOjEwNzt9', 1750750065);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `usertype` enum('admin','staff','customer') NOT NULL DEFAULT 'customer',
  `name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `usertype`, `name`, `email`, `phone`, `address`, `remember_token`, `created_at`, `updated_at`, `picture`) VALUES
(1, 'admin1nania', '$2y$12$astnTWKavlfKcWfsAgAmM.xstyTYeGt6..Z33sYmAeaStSHttyMnC', 'admin', 'Nania', 'admin1nania@gmail.com', NULL, NULL, NULL, '2025-04-22 02:30:04', '2025-04-30 17:06:09', NULL),
(2, 'djalee', '$2y$12$baHs40kaLBEjcDkneayR9eNEMON1CjDcXuV7pvSQTA4L83IJTyKGm', 'staff', 'Dierjaa', NULL, NULL, NULL, NULL, '2025-04-22 02:31:43', '2025-04-22 02:31:43', NULL),
(3, 'lincolnshire', '$2y$12$PcYVC6ls.kpX8tM4G4pKCus36fMqbFqmOc8.n9VbEMV0L5XwZx9yS', 'staff', 'Kale Lincolnshire', NULL, NULL, NULL, NULL, '2025-04-22 02:35:57', '2025-04-22 02:35:57', NULL),
(4, 'ljnnna', '$2y$12$RHhPUjeRpubZ/CggEACWNOPrdi8wCMeUO4M7r3V7HRkZt9V8hxT2q', 'customer', 'Nania Maharanny', 'heymenania@gmail.com', NULL, NULL, NULL, '2025-05-14 09:38:53', '2025-05-14 09:38:53', NULL),
(5, 'fest', '$2y$12$AgS2qKw3ldwpDNWbYPkcTOW.L60y1JOlNVlqKJ3ero0VMvcx0WRD2', 'customer', 'festify', 'festify@gmail.com', NULL, NULL, NULL, '2025-05-15 00:06:22', '2025-05-15 00:06:22', NULL),
(6, 'festcust', '$2y$12$sxPpyNJNhl7HbxJzIjxed.VX8Bp1W8NU0.L7Mr8uoIMvgl0qAnyXa', 'customer', 'festify customer', 'festcustomer@gmail.com', NULL, NULL, NULL, '2025-06-02 23:28:11', '2025-06-08 09:00:26', 'profile-picture/xGWN5j9RDSQHNBACbuCJz1AYzOdOffiPgH9s7g2K.jpg'),
(7, 'sabeth', '$2y$12$58aaHUtWctOMhYlUHr/B3O9Tv7Pdh.tsTDtdI9V6ZAL0wNkSY0yp6', 'customer', 'user sabeth', 'userelisabeth@gmail.com', NULL, NULL, 'mV1Ojc1oEDOIEwsnGpKPEnQZg5wY1TPwqWRMisieEDWxkxhoozu69cMx3ICO', '2025-06-12 09:04:23', '2025-06-13 04:29:49', NULL),
(8, 'adminsabeth', '$2y$12$KOMNRQdLSMvBO/13suv4T.bp.0sWyJNCuJL/p03MaDbcDflsoNPFG', 'admin', 'admin sabeth', 'adminelisabeth@gmail.com', NULL, NULL, 'm4tmy9h1sUTaX82MVWFNiLp8FlNbRUoHz0JDbEiz5RTf6I61D02UQsl5HwaJ', '2025-06-12 09:07:10', '2025-06-13 15:50:16', NULL),
(9, 'adminelsa', '$2y$12$JDCPqsiWzh6LZYAMwtRcBeYs0vh9IfiR2YdF3Eu9wTgA87suxrl7W', 'admin', 'Elsa', 'adminelsa@gmail.com', NULL, NULL, NULL, '2025-06-15 01:23:52', '2025-06-15 08:24:16', NULL),
(10, 'elsa', '$2y$12$M/ebzC1stfPmqcZeDpzmBeumvMKeLqm9I1qNzXAY51dJ4pWkeZrei', 'customer', 'elsa', 'elsa@gmail.com', NULL, NULL, NULL, '2025-06-15 01:40:46', '2025-06-22 08:27:18', 'profile-picture/K6zSO7v681VPZdDVjYpkS2Kf8PsRc2I12pOKhG6E.png');

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
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_product_id_foreign` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_code_unique` (`order_code`),
  ADD KEY `orders_ibfk_1` (`user_id`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_product_order_id_foreign` (`order_id`),
  ADD KEY `order_product_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `rentals`
--
ALTER TABLE `rentals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rentals_user_id_foreign` (`user_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`);

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
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `rentals`
--
ALTER TABLE `rentals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `order_products`
--
ALTER TABLE `order_products`
  ADD CONSTRAINT `order_product_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rentals`
--
ALTER TABLE `rentals`
  ADD CONSTRAINT `rentals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
