-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 19, 2025 lúc 09:59 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `intern`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Đồ chơi Lego', 'do-choi-lego', '2025-01-20 02:22:09', '2025-02-04 01:50:45'),
(4, 'Lego Gấu Bearbrick', 'lego-gau-bearbrick', '2025-03-15 02:52:06', '2025-03-15 02:52:06'),
(5, 'Xe Điều Khiển Từ Xa', 'xe-dieu-khien-tu-xa', '2025-03-15 02:55:21', '2025-03-15 02:55:21');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(1, 'Vũ Minh Hiếu', 'vmhieu121103@gmail.com', 'Góp ý test', 'test', '2025-03-17 08:11:48', '2025-03-17 08:11:48'),
(2, 'VU MINH HIEU', 'cavaldos1211@gmail.com', 'test123', '123', '2025-03-17 08:13:47', '2025-03-17 08:13:47');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `value` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `type`, `value`, `created_at`, `updated_at`) VALUES
(1, 'abc', 'fixed', 20, '2025-01-20 20:50:35', '2025-01-20 20:50:35'),
(7, 'percent10', 'percent', 10, '2025-01-22 02:21:47', '2025-01-23 00:08:33'),
(8, 'percent20', 'percent', 20, '2025-01-22 23:59:07', '2025-01-23 00:08:40');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
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
-- Cấu trúc bảng cho bảng `jobs`
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
-- Cấu trúc bảng cho bảng `job_batches`
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
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(48, '0001_01_01_000000_create_users_table', 1),
(49, '0001_01_01_000001_create_cache_table', 1),
(50, '0001_01_01_000002_create_jobs_table', 1),
(51, '2025_01_15_153031_create_categories_table', 1),
(52, '2025_01_15_153124_create_photos_table', 1),
(53, '2025_01_15_153140_create_products_table', 1),
(54, '2025_01_15_161422_create_sub_categories_table', 1),
(55, '2025_01_16_065505_create_permission_tables', 1),
(56, '2025_01_17_032835_create_system_settings_table', 1),
(57, '2025_01_17_033046_create_coupons_table', 1),
(58, '2025_01_21_025415_create_order_product_table', 2),
(59, '2025_01_21_031331_create_orders_table', 3),
(60, '2025_01_21_042718_alter_status_in_orders', 4),
(61, '2025_01_21_044117_create_orders_table', 5),
(62, '2025_01_21_044428_create_order_statuses_table', 6),
(63, '2025_01_21_101625_create_contact_table', 7),
(66, '2025_01_23_070635_remove_percent_off_in_coupons_table', 8),
(67, '2025_02_07_035648_modify_payment_method_column', 8),
(68, '2025_02_07_081108_create_slides_table', 9),
(69, '2025_03_01_094305_add_social_auth_to_users_table', 10),
(70, '2025_03_10_022043_change_slides_table', 11);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 3),
(2, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 4),
(2, 'App\\Models\\User', 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_status_id` int(11) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `billing_discount` int(11) NOT NULL DEFAULT 0,
  `billing_discount_code` varchar(255) DEFAULT NULL,
  `billing_subtotal` decimal(8,3) DEFAULT NULL,
  `billing_total` decimal(8,3) NOT NULL,
  `billing_fullname` varchar(255) NOT NULL,
  `billing_address` varchar(255) NOT NULL,
  `billing_city` varchar(255) NOT NULL,
  `billing_province` varchar(255) NOT NULL,
  `billing_phone` varchar(255) NOT NULL,
  `billing_email` varchar(255) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `user_id`, `order_status_id`, `payment_method`, `billing_discount`, `billing_discount_code`, `billing_subtotal`, `billing_total`, `billing_fullname`, `billing_address`, `billing_city`, `billing_province`, `billing_phone`, `billing_email`, `notes`, `created_at`, `updated_at`) VALUES
(12, '67ac5a5458d0d', 1, 3, 'cash_on_delivery', 0, NULL, 410.000, 410.000, 'admin', 'Đức Thượng', 'Hà Nội', 'Hà Nội', '0963077286', 'admin@gmail.com', NULL, '2025-02-12 01:22:44', '2025-03-12 21:37:59'),
(18, '67d7f24164fef', 1, 1, 'cash_on_delivery', 0, NULL, 895.000, 895.000, 'admin', 'Đức Thượng', 'Hà Nội', 'Hà Nội', '0963077286', 'admin@gmail.com', NULL, '2025-03-17 09:58:25', '2025-03-17 09:58:25');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_product`
--

CREATE TABLE `order_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_product`
--

INSERT INTO `order_product` (`id`, `order_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2025-01-20 20:16:22', '2025-01-20 20:16:22'),
(2, 2, 1, 3, '2025-01-20 20:57:58', '2025-01-20 20:57:58'),
(3, 1, 1, 1, '2025-01-20 23:50:54', '2025-01-20 23:50:54'),
(4, 2, 1, 1, '2025-01-23 01:18:20', '2025-01-23 01:18:20'),
(5, 3, 2, 1, '2025-01-23 01:19:42', '2025-01-23 01:19:42'),
(6, 4, 2, 1, '2025-02-05 00:38:14', '2025-02-05 00:38:14'),
(7, 5, 3, 1, '2025-02-06 20:52:55', '2025-02-06 20:52:55'),
(8, 6, 3, 1, '2025-02-06 21:01:12', '2025-02-06 21:01:12'),
(9, 7, 2, 1, '2025-02-06 21:05:05', '2025-02-06 21:05:05'),
(10, 8, 3, 1, '2025-02-06 21:06:14', '2025-02-06 21:06:14'),
(11, 9, 3, 1, '2025-02-06 21:13:23', '2025-02-06 21:13:23'),
(12, 10, 2, 1, '2025-02-06 21:16:55', '2025-02-06 21:16:55'),
(13, 11, 3, 1, '2025-02-12 01:16:22', '2025-02-12 01:16:22'),
(14, 12, 2, 1, '2025-02-12 01:22:44', '2025-02-12 01:22:44'),
(15, 18, 5, 1, '2025-03-17 09:58:25', '2025-03-17 09:58:25'),
(16, 18, 2, 1, '2025-03-17 09:58:25', '2025-03-17 09:58:25');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_statuses`
--

CREATE TABLE `order_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `identify_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_statuses`
--

INSERT INTO `order_statuses` (`id`, `name`, `identify_name`, `created_at`, `updated_at`) VALUES
(1, 'Pending', 'Pending', '2025-01-20 23:41:50', '2025-02-04 00:34:46'),
(2, 'Xác nhận', 'Accepted', '2025-01-20 23:58:08', '2025-01-20 23:58:08'),
(3, 'Chờ xử lý', 'Processing', '2025-02-04 04:29:39', '2025-02-04 04:29:39'),
(4, 'Đang giao hàng', 'Shipped', '2025-02-04 04:30:20', '2025-02-04 04:30:20'),
(5, 'Đã giao hàng', 'Delivered', '2025-02-04 04:30:34', '2025-02-04 04:30:34');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('admin@gmail.com', '$2y$12$9n9LHR1EhWhMfv.B6DOwqOcnU3lfUXnI/tToDV6/Qp6n.c12gxRZO', '2025-02-04 01:16:19'),
('cavaldos1211@gmail.com', '$2y$12$NwZ5ABRZsdH32NFZ7cRvNu22geeeT/8U8ALU6dqMOqrg7PB0V08P6', '2025-03-17 06:59:39');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `photos`
--

CREATE TABLE `photos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `images` varchar(255) NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `photos`
--

INSERT INTO `photos` (`id`, `images`, `product_id`, `created_at`, `updated_at`) VALUES
(3, 'products/Đồ chơi lắp ráp Bearbrick 55cm Họa tiết vằn Trắng – Đen LEGOHAIBR59054/1FRWfuJXMOUBsd.jpg', 1, '2025-01-21 01:31:03', '2025-01-21 01:31:03'),
(4, 'products/Đồ chơi lắp ráp Bearbrick 55cm Họa tiết vằn Trắng – Đen LEGOHAIBR59054/5sPAAhHEnRO0ey.jpg', 1, '2025-01-21 01:31:03', '2025-01-21 01:31:03'),
(5, 'products/2/oD5A2pQh8CDtqT.jpg', 2, '2025-01-22 00:40:36', '2025-01-22 00:40:36'),
(6, 'products/2/WgZZjF7gAeKxCT.jpg', 2, '2025-01-22 00:40:36', '2025-01-22 00:40:36'),
(7, 'products/3/L5auye7zmiqL4J.jpg', 3, '2025-01-22 00:42:02', '2025-01-22 00:42:02'),
(8, 'products/3/nQvQtn8Cu1M5H6.jpg', 3, '2025-01-22 00:42:02', '2025-01-22 00:42:02'),
(9, 'products/3/MkWqjQxHKCAlf6.jpg', 3, '2025-01-22 00:42:02', '2025-01-22 00:42:02'),
(10, 'products/4/ItiUdrWohZ2o3S.jpg', 4, '2025-02-04 01:48:18', '2025-02-04 01:48:18'),
(11, 'products/4/5CC26YzMkzQJZn.jpg', 4, '2025-02-04 01:48:18', '2025-02-04 01:48:18'),
(12, 'products/4/0bR4phTmCjNhJw.jpg', 4, '2025-02-04 01:48:18', '2025-02-04 01:48:18'),
(13, 'products/4/GUQ4z5ZRdz4KTG.jpg', 4, '2025-02-04 01:48:18', '2025-02-04 01:48:18'),
(14, 'products/5/EHTjXeIIW0256r.jpg', 5, '2025-03-15 02:53:43', '2025-03-15 02:53:43'),
(15, 'products/5/10aH6ElrRL6G4L.jpg', 5, '2025-03-15 02:53:43', '2025-03-15 02:53:43'),
(16, 'products/6/N3VRvX7yjtBxSZ.jpg', 6, '2025-03-15 02:56:07', '2025-03-15 02:56:07'),
(17, 'products/6/X4Fcts5O0njFSt.jpg', 6, '2025-03-15 02:56:07', '2025-03-15 02:56:07'),
(18, 'products/6/3veIPJPZUVUb3B.jpg', 6, '2025-03-15 02:56:07', '2025-03-15 02:56:07'),
(19, 'products/6/etJhgM88CCdzB6.jpg', 6, '2025-03-15 02:56:07', '2025-03-15 02:56:07');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(8,3) NOT NULL,
  `quantity` bigint(20) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) DEFAULT NULL,
  `on_sale` tinyint(1) DEFAULT 0,
  `is_new` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `code`, `description`, `price`, `quantity`, `slug`, `category_id`, `sub_category_id`, `on_sale`, `is_new`, `created_at`, `updated_at`) VALUES
(1, 'Đồ chơi lắp ráp Bearbrick 55cm Họa tiết vằn Trắng – Đen LEGOHAIBR59054', 'LEGOHAIBR59054', 'Mẫu Đồ chơi Bearbrick có 2 màu trắng đen đơn giản với độ cao 55cm. Đồ chơi Bearbrick không chỉ giúp bé phát triển trí thông minh, tư duy lắp ghép mà còn là món quà ý nghĩa dành tặng bé những dịp đặc biệt. Toystory.vn chuyên cung cấp các mẫu Lego Gấu Bearbrick đa dạng về màu sắc, chiều cao và kiểu dáng.', 410.000, 100, 'do-choi-lap-rap-bearbrick-55cm-hoa-tiet-van-trang-den-legohaibr59054', 4, NULL, 0, 0, '2025-01-20 02:22:18', '2025-03-15 02:54:19'),
(2, 'Đồ chơi lắp ráp Bearbrick 55cm Mặt trăng – Mặt trời màu Xanh Dương đậm LEGOHAIBR59065', 'LEGOHAIBR59065', 'Đồ chơi lắp ráp Bearbrick 55cm Mặt trăng – Mặt trời màu Xanh Dương đậm LEGOHAIBR59065', 410.000, 13, 'do-choi-lap-rap-bearbrick-55cm-mat-trang-mat-troi-mau-xanh-duong-dam-legohaibr59065', 4, NULL, 0, 0, '2025-01-22 00:40:35', '2025-03-17 09:58:13'),
(3, 'Đồ chơi lắp ráp Lego Mini Model Chú vịt Donald 8.4cm 293 PCS LEGOMODELM1003', 'LEGOMODELM1003', 'Lego Vịt Donald là một trong những mẫu Lego được yêu thích. Đồ chơi Lego tại Toystory với đa dạng mẫu mã giúp cha mẹ có nhiều sự lựa chọn cho các bé', 33.000, 4, 'do-choi-lap-rap-lego-mini-model-chu-vit-donald-84cm-293-pcs-legomodelm1003', 1, NULL, 1, 1, '2025-01-22 00:42:02', '2025-03-15 02:47:27'),
(4, 'Bàn Bắn Bi Gỗ cho bé siêu vui nhộn DCVD101', 'DCVD101', '1234', 160.000, 97, 'ban-ban-bi-go-cho-be-sieu-vui-nhon-dcvd101', 1, NULL, 0, 0, '2025-02-04 01:48:18', '2025-03-15 02:47:29'),
(5, 'Lego Gấu Bearbrick 43cm Graffiti Xiaofangle Full Box Size lớn LEGOXIAO89008', 'LEGOXIAO89008', 'Gấu đa màu sắc Graffiti được sản xuất bởi Hãng Xiaofangle, Một trong những hãng nổi tiếng với mảnh Lego vuông trơn cùng Hướng dẫn lắp ghép 3D cực kỳ dễ nhìn. Toystory.vn chuyên cung cấp Lego Gấu Bearbrick hãng Xiaofangle', 485.000, 98, 'lego-gau-bearbrick-43cm-graffiti-xiaofangle-full-box-size-lon-legoxiao89008', 4, NULL, 0, 1, '2025-03-15 02:53:43', '2025-03-17 10:24:16'),
(6, 'Máy xúc bánh xích điều khiển từ xa, có chế độ Xúc cát cho bé XDK109', 'XDK109', 'Máy xúc điều khiển từ xa có chức năng Tiến, Lùi, Rẽ Trái, Rẽ phải. Ngoài ra xe còn có thể xoay được và có chế độ điều khiển Gầu xúc. Xe chạy bánh xích vượt được nhiều địa hình gồ ghề. Chạy trên được cát lún. Máy xúc điều khiển từ xa thích hợp thiết kế những trò chơi vận động ngoài trời như Thi múc cát vào ô tô tải. Hay thi hoàn thành múc đồ vật với số lượng nhất định và về đích. Máy xúc điều khiển từ xa là loại xe điều khiển từ xa giúp bé vận động sự nhanh nhẹn và khéo léo của mình qua cách ba mẹ thiết kế các trò chơi. Tham khảo thêm các mẫu xe điều khiển từ xa có tại Toystory.vn nhé', 260.000, 100, 'may-xuc-banh-xich-dieu-khien-tu-xa-co-che-do-xuc-cat-cho-be-xdk109', 5, NULL, 1, 1, '2025-03-15 02:56:07', '2025-03-15 02:56:07');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2025-01-20 01:44:07', '2025-01-20 01:44:07'),
(2, 'customer', 'web', '2025-01-21 21:30:13', '2025-01-21 21:30:13');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sessions`
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
-- Đang đổ dữ liệu cho bảng `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('GjW01d2LZNg4dNflq5pDIjZzoDaT2BRw4C4iQkEc', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWWNMSG9ZNlZ1Tk1acTBZV1VWOGRLZGVkbEFtWTVwdFhiM0E0VWNrTSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fX0=', 1742268353),
('hXhISrWhKb5A47uZqIhgmStf3ZS0S8kRGuSwBxB6', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoicENac2FKbXVac05yUlZGeFVPb0t6dzY4MTdpRTFNdXFEWEJZMnd4UCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9jaGVja291dCI7fXM6MzoidXJsIjthOjA6e31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6NDoiY2FydCI7YToxOntzOjc6ImRlZmF1bHQiO086Mjk6IklsbHVtaW5hdGVcU3VwcG9ydFxDb2xsZWN0aW9uIjoyOntzOjg6IgAqAGl0ZW1zIjthOjE6e3M6MzI6IjQ2ODM5OTU4MTM0MjUwNWM0N2Y0NjE1YjgxYmVkYWE5IjtPOjMyOiJHbG91ZGVtYW5zXFNob3BwaW5nY2FydFxDYXJ0SXRlbSI6OTp7czo1OiJyb3dJZCI7czozMjoiNDY4Mzk5NTgxMzQyNTA1YzQ3ZjQ2MTViODFiZWRhYTkiO3M6MjoiaWQiO3M6MToiNSI7czozOiJxdHkiO3M6MToiMSI7czo0OiJuYW1lIjtzOjc5OiJMZWdvIEfhuqV1IEJlYXJicmljayA0M2NtIEdyYWZmaXRpIFhpYW9mYW5nbGUgRnVsbCBCb3ggU2l6ZSBs4bubbiBMRUdPWElBTzg5MDA4IjtzOjU6InByaWNlIjtkOjQ4NTtzOjc6Im9wdGlvbnMiO086Mzk6Ikdsb3VkZW1hbnNcU2hvcHBpbmdjYXJ0XENhcnRJdGVtT3B0aW9ucyI6Mjp7czo4OiIAKgBpdGVtcyI7YTowOnt9czoyODoiACoAZXNjYXBlV2hlbkNhc3RpbmdUb1N0cmluZyI7YjowO31zOjQ5OiIAR2xvdWRlbWFuc1xTaG9wcGluZ2NhcnRcQ2FydEl0ZW0AYXNzb2NpYXRlZE1vZGVsIjtzOjE4OiJBcHBcTW9kZWxzXFByb2R1Y3QiO3M6NDE6IgBHbG91ZGVtYW5zXFNob3BwaW5nY2FydFxDYXJ0SXRlbQB0YXhSYXRlIjtpOjIxO3M6NDE6IgBHbG91ZGVtYW5zXFNob3BwaW5nY2FydFxDYXJ0SXRlbQBpc1NhdmVkIjtiOjA7fX1zOjI4OiIAKgBlc2NhcGVXaGVuQ2FzdGluZ1RvU3RyaW5nIjtiOjA7fX19', 1742207058),
('O5BxQj7JUjuCyiCVjtra4ti5a872WzKOBrVyBZIO', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiblZrc1lzMVpZZmtlc1BDTUhNVFJnTUFXV1BXQ0JSdkRWVnBURW05YiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1742270504),
('zeeY2RgKAZmBkgoGNcKE533LdbFmxuCw8D6h3WaP', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTmlvdUNuV1dBZUN3bmNjWWNjajdTZzRmY2VYODg2a1lDM2U1clhsUyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fX0=', 1742368490);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `slides`
--

CREATE TABLE `slides` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `slides`
--

INSERT INTO `slides` (`id`, `image`, `created_at`, `updated_at`) VALUES
(3, 'uploads/slides/qw0rUJkPHFLgkACG2BJmMauqvYf26RJBLafPiIfI.png', '2025-03-07 01:29:53', '2025-03-15 01:52:10'),
(4, 'uploads/slides/G1cXqzBslNx9YPsTLHIYJt5OOLsRZx1r3j20ZSFO.png', '2025-03-09 18:59:24', '2025-03-15 01:52:35');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `name`, `slug`, `category_id`, `created_at`, `updated_at`) VALUES
(2, 'ô tô', 'o-to', 5, '2025-03-17 08:10:01', '2025-03-17 08:10:01'),
(3, 'lego marvel', 'lego-marvel', 1, '2025-03-17 08:10:09', '2025-03-17 08:10:32');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `system_settings`
--

CREATE TABLE `system_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `address` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `tel` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `system_settings`
--

INSERT INTO `system_settings` (`id`, `name`, `description`, `address`, `logo`, `favicon`, `tel`, `email`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'ToyStory', 'The best store have toy', '43 Tran Duy Hung', 'uploads/logos/fu6zYhbKHhuugQ8VVFMShNNlPpG5izggkaAYE1nK.png', 'uploads/logos/Jc9uxA3UsGavJgVbJNCDWPZ2DONIZ8GmHObuGoBp.png', '+84963077286', 'cavaldos1211@gmail.com', 'company-info', '2025-01-20 01:42:23', '2025-02-04 01:08:45');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `dob` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `provider` varchar(255) DEFAULT NULL,
  `provider_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `address`, `dob`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `provider`, `provider_id`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, NULL, NULL, NULL, '$2y$12$OR75/ZzNfJfGdO6ZaYpKMeiKs8aaq5CPIBnndwEcG91MhS9GvknLm', NULL, '2025-01-20 01:44:15', '2025-01-20 01:44:15', NULL, NULL),
(2, 'customer', 'vmhieu121103@gmail.com', NULL, NULL, NULL, NULL, '$2y$12$WcEyDC4GN1qRUr3q91nEO.Mqx5YxfsIZelhBE1KUtlARPWKvnZPOu', 'BuguBPeVmeNg3hfO98TFvfQ0ZWaD3oFHp7d0mwRuQH42YbUUA9LVEmG4dQkD', '2025-01-21 21:30:26', '2025-02-04 19:19:21', NULL, NULL),
(3, 'vu minh hieu', 'cavaldos1211@gmail.com', NULL, NULL, NULL, NULL, '$2y$12$qr0tOTY5i.ucIvjm9XqJZetFQKJ9nYNYCCNJBKZlwMqYYe2KVsTAC', 'ikDqmjtyajepP3Wh0JZSADwBOv645ZwrY7cT8fkZAxV7OziXGkkENQ0wr6Hv', '2025-02-04 01:17:34', '2025-02-04 01:30:39', NULL, NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Chỉ mục cho bảng `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Chỉ mục cho bảng `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order_statuses`
--
ALTER TABLE `order_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Chỉ mục cho bảng `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_name_unique` (`name`),
  ADD UNIQUE KEY `products_code_unique` (`code`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Chỉ mục cho bảng `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Chỉ mục cho bảng `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Chỉ mục cho bảng `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sub_categories_name_unique` (`name`),
  ADD UNIQUE KEY `sub_categories_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `system_settings_slug_unique` (`slug`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `order_product`
--
ALTER TABLE `order_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `order_statuses`
--
ALTER TABLE `order_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `photos`
--
ALTER TABLE `photos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `slides`
--
ALTER TABLE `slides`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
