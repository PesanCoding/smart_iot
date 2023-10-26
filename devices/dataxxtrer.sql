-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 23, 2023 at 10:21 AM
-- Server version: 5.7.33
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dataxxtrer`
--

-- --------------------------------------------------------

--
-- Table structure for table `controls`
--

CREATE TABLE `controls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `nama_device` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gpio` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `controls`
--

INSERT INTO `controls` (`id`, `id_user`, `nama_device`, `gpio`, `state`, `created_at`, `updated_at`) VALUES
(1, 2, 'PH UP', 12, 1, '2023-04-14 22:01:09', '2023-07-23 09:44:54'),
(2, 2, 'PH DOWN', 13, 1, '2023-04-14 22:01:09', '2023-07-23 09:44:57'),
(3, 14, 'PH', 7, 0, '2023-07-22 11:55:20', '2023-07-22 11:55:20'),
(4, 14, 'PH Down', 13, 1, '2023-07-22 11:56:57', '2023-07-22 12:04:04'),
(5, 15, 'PH UP', 13, 0, '2023-07-23 09:56:07', '2023-07-23 09:56:07');

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `nama_devices` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mode` int(1) NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `publish` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`id`, `id_user`, `nama_devices`, `mode`, `keterangan`, `publish`, `created_at`, `updated_at`) VALUES
(1, 2, 'Device_ab', 1, 'Devices Utama_1', 1, '2023-03-09 13:25:02', '2023-07-23 09:44:48'),
(6, 14, 'Device_abu', 1, 'Device utama', 1, NULL, '2023-07-22 11:52:27'),
(8, 15, 'alif', 1, 'Device 1', 1, NULL, '2023-07-23 09:55:39'),
(9, 16, 'Device_Reza Arab', 0, 'Device Utama', 1, NULL, '2023-07-23 10:05:21');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_02_28_044419_create_sessions_table', 1),
(7, '2023_02_28_133927_create_modes_table', 2),
(8, '2023_03_09_125259_create_devices_table', 3),
(9, '2023_03_09_223551_create_roles_table', 4),
(12, '2023_04_06_163313_create_sensors_table', 6),
(13, '2023_04_06_120751_create_controls_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(260, 'App\\Models\\User', 2, 'auth_token', 'eca99e92a63d231b19cb0ec2704d0c9f162d8bdaafc33b14d6ecf4d7f6f38ed2', '[\"*\"]', '2023-07-10 23:21:49', NULL, '2023-07-10 23:14:57', '2023-07-10 23:21:49'),
(261, 'App\\Models\\User', 14, 'auth_token', '98dde1548c3358b5c3b8f2a8be0741272cc5efb9acac45bd8973cf46b5f3bd99', '[\"*\"]', '2023-07-22 12:04:59', NULL, '2023-07-22 11:58:48', '2023-07-22 12:04:59'),
(262, 'App\\Models\\User', 2, 'auth_token', 'cab1f9134d294d5f5c857cec82aa7be5a7c8a1d24e643a7c7689a0cdaf4f5c85', '[\"*\"]', '2023-07-23 09:45:06', NULL, '2023-07-23 09:41:18', '2023-07-23 09:45:06'),
(263, 'App\\Models\\User', 2, 'auth_token', 'f502c5467685b11faba6651de9236002b2ca52cb9bee506479c163400cd91860', '[\"*\"]', '2023-07-23 10:19:33', NULL, '2023-07-23 10:18:18', '2023-07-23 10:19:33');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2022-12-23 05:10:52', NULL),
(2, 'user_p', '2022-12-23 05:14:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sensors`
--

CREATE TABLE `sensors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `tegangan` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ph` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `temp` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sensors`
--

INSERT INTO `sensors` (`id`, `id_user`, `tegangan`, `ph`, `temp`, `waktu`) VALUES
(78, 2, '45', '1', '125', '2023-06-10 01:59:23'),
(79, 2, '45', '1', '125', '2023-06-10 01:59:25'),
(80, 2, '45', '1', '125', '2023-06-10 01:59:27'),
(81, 2, '45', '1', '125', '2023-06-10 01:59:30'),
(82, 2, '45', '1', '125', '2023-06-10 01:59:37'),
(83, 2, '45', '1', '125', '2023-06-10 01:59:39'),
(84, 2, '45', '1', '125', '2023-06-10 01:59:41'),
(85, 2, '45', '1', '125', '2023-06-10 01:59:42'),
(86, 2, '45', '1', '125', '2023-06-10 01:59:44'),
(87, 2, '0', '22.08972', '-127', '2023-07-10 22:57:12'),
(88, 2, '0', '22.08972', '-127', '2023-07-10 22:57:13'),
(89, 2, '0', '22.08972', '-127', '2023-07-10 22:57:15'),
(90, 2, '0', '22.08972', '-127', '2023-07-10 22:57:17'),
(91, 2, '0', '22.08972', '-127', '2023-07-10 22:57:19'),
(92, 2, '0', '22.08972', '-127', '2023-07-10 22:57:21'),
(93, 2, '0', '22.08972', '-127', '2023-07-10 22:57:23'),
(94, 2, '0', '22.08972', '-127', '2023-07-10 22:57:25'),
(95, 2, '0', '22.08972', '-127', '2023-07-10 22:57:28'),
(96, 2, '0', '22.08972', '-127', '2023-07-10 22:57:34'),
(97, 2, '0', '22.08972', '-127', '2023-07-10 22:57:39'),
(98, 2, '0', '22.08972', '-127', '2023-07-10 22:57:41'),
(99, 2, '0', '22.08972', '-127', '2023-07-10 22:57:43'),
(100, 2, '0.012891', '22.01743', '-127', '2023-07-10 22:57:50'),
(101, 2, '0', '22.08972', '-127', '2023-07-10 22:57:52'),
(102, 2, '0', '22.08972', '-127', '2023-07-10 22:57:54'),
(103, 2, '0', '22.08972', '-127', '2023-07-10 22:57:56'),
(104, 2, '0', '22.08972', '-127', '2023-07-10 22:57:58'),
(105, 2, '0', '22.08972', '-127', '2023-07-10 22:57:59'),
(106, 2, '0', '22.08972', '-127', '2023-07-10 22:58:01'),
(107, 2, '0', '22.08972', '-127', '2023-07-10 22:58:03'),
(108, 2, '0', '22.08972', '-127', '2023-07-10 22:58:05'),
(109, 2, '0', '22.08972', '-127', '2023-07-10 22:58:08'),
(110, 2, '0', '22.08972', '-127', '2023-07-10 22:58:10'),
(111, 2, '0', '22.08972', '-127', '2023-07-10 22:58:12'),
(112, 2, '0', '22.08972', '-127', '2023-07-10 22:58:15'),
(113, 2, '0', '22.08972', '-127', '2023-07-10 22:58:20'),
(114, 2, '0', '22.08972', '-127', '2023-07-10 22:58:22'),
(115, 2, '0', '22.08972', '-127', '2023-07-10 22:58:24'),
(116, 2, '0', '22.08972', '-127', '2023-07-10 22:58:27'),
(117, 2, '0', '22.08972', '-127', '2023-07-10 22:58:33'),
(118, 2, '0', '22.08972', '-127', '2023-07-10 22:58:36'),
(119, 2, '0', '22.08972', '-127', '2023-07-10 22:58:40'),
(120, 2, '0', '22.08972', '-127', '2023-07-10 22:58:45'),
(121, 2, '0', '22.08972', '-127', '2023-07-10 22:58:47'),
(122, 2, '0', '22.08972', '-127', '2023-07-10 22:58:51'),
(123, 2, '0', '22.08972', '-127', '2023-07-10 22:58:53'),
(124, 2, '0', '22.08972', '-127', '2023-07-10 22:59:00'),
(125, 2, '0', '22.08972', '-127', '2023-07-10 22:59:02'),
(126, 2, '0', '22.08972', '-127', '2023-07-10 22:59:05'),
(127, 2, '0', '22.08972', '-127', '2023-07-10 22:59:08'),
(128, 2, '0', '22.08972', '-127', '2023-07-10 22:59:14'),
(129, 2, '0', '22.08972', '-127', '2023-07-10 22:59:16'),
(130, 2, '0', '22.08972', '-127', '2023-07-10 22:59:19'),
(131, 2, '0', '22.08972', '-127', '2023-07-10 22:59:25'),
(132, 2, '0', '22.08972', '-127', '2023-07-21 10:59:59'),
(134, 2, '45', '4', '24', '2023-07-21 11:15:27'),
(135, 2, '45', '23', '24', '2023-07-21 12:25:40'),
(136, 2, '12', '4', '24', '2023-07-21 12:30:04'),
(137, 14, '34', '7', '26', '2023-07-22 12:02:35'),
(138, 14, '34', '7', '26', '2023-07-22 12:04:59'),
(139, 2, '12', '8', '24', '2023-07-23 08:08:48'),
(140, 2, '0', '22.08972', '-127', '2023-07-23 09:41:19'),
(141, 2, '0', '22.08972', '-127', '2023-07-23 09:41:21'),
(142, 2, '0', '22.08972', '-127', '2023-07-23 09:41:23'),
(143, 2, '0', '22.08972', '-127', '2023-07-23 09:41:25'),
(144, 2, '0', '22.08972', '-127', '2023-07-23 09:41:30'),
(145, 2, '0', '22.08972', '-127', '2023-07-23 09:41:32'),
(146, 2, '0', '22.08972', '-127', '2023-07-23 09:41:36'),
(147, 2, '0', '22.08972', '-127', '2023-07-23 09:41:42'),
(148, 2, '0', '22.08972', '-127', '2023-07-23 09:41:45'),
(149, 2, '0', '22.08972', '-127', '2023-07-23 09:41:48'),
(150, 2, '0', '22.08972', '-127', '2023-07-23 09:41:51'),
(151, 2, '0', '22.08972', '-127', '2023-07-23 09:41:55'),
(152, 2, '0', '22.08972', '-127', '2023-07-23 09:42:00'),
(153, 2, '0', '22.08972', '-127', '2023-07-23 09:42:07'),
(154, 2, '0', '22.08972', '-127', '2023-07-23 09:42:09'),
(155, 2, '0', '22.08972', '-127', '2023-07-23 09:42:12'),
(156, 2, '0', '22.08972', '-127', '2023-07-23 09:42:14'),
(157, 2, '0', '22.08972', '-127', '2023-07-23 09:42:16'),
(158, 2, '0', '22.08972', '-127', '2023-07-23 09:42:19'),
(159, 2, '0', '22.08972', '-127', '2023-07-23 09:42:21'),
(160, 2, '0', '22.08972', '-127', '2023-07-23 09:42:26'),
(161, 2, '0', '22.08972', '-127', '2023-07-23 09:42:29'),
(162, 2, '0', '22.08972', '-127', '2023-07-23 09:42:33'),
(163, 2, '0', '22.08972', '-127', '2023-07-23 09:42:36'),
(164, 2, '0', '22.08972', '-127', '2023-07-23 09:42:38'),
(165, 2, '0', '22.08972', '-127', '2023-07-23 09:42:41'),
(166, 2, '0.012891', '22.01743', '-127', '2023-07-23 09:42:47'),
(167, 2, '0.012891', '22.01743', '-127', '2023-07-23 09:42:51'),
(168, 2, '0.012891', '22.01743', '-127', '2023-07-23 09:42:54'),
(169, 2, '0.012891', '22.01743', '-127', '2023-07-23 09:43:00'),
(170, 2, '0.012891', '22.01743', '-127', '2023-07-23 09:43:03'),
(171, 2, '0.012891', '22.01743', '-127', '2023-07-23 09:43:10'),
(172, 2, '0.012891', '22.01743', '-127', '2023-07-23 09:43:15'),
(173, 2, '0.012891', '22.01743', '-127', '2023-07-23 09:43:19'),
(174, 2, '0.012891', '22.01743', '-127', '2023-07-23 09:43:25'),
(175, 2, '0', '22.08972', '-127', '2023-07-23 09:43:27'),
(176, 2, '0', '22.08972', '-127', '2023-07-23 09:43:32'),
(177, 2, '0', '22.08972', '-127', '2023-07-23 09:43:36'),
(178, 2, '0', '22.08972', '-127', '2023-07-23 09:43:37'),
(179, 2, '0', '22.08972', '-127', '2023-07-23 09:43:42'),
(180, 2, '0', '22.08972', '-127', '2023-07-23 09:43:43'),
(181, 2, '0', '22.08972', '-127', '2023-07-23 09:43:48'),
(182, 2, '0', '22.08972', '-127', '2023-07-23 09:43:49'),
(183, 2, '0', '22.08972', '-127', '2023-07-23 09:43:51'),
(184, 2, '0', '22.08972', '-127', '2023-07-23 09:43:53'),
(185, 2, '0', '22.08972', '-127', '2023-07-23 09:43:55'),
(186, 2, '0', '22.08972', '-127', '2023-07-23 09:43:57'),
(187, 2, '0', '22.08972', '-127', '2023-07-23 09:43:59'),
(188, 2, '0', '22.08972', '-127', '2023-07-23 09:44:01'),
(189, 2, '0', '22.08972', '-127', '2023-07-23 09:44:03'),
(190, 2, '0', '22.08972', '-127', '2023-07-23 09:44:04'),
(191, 2, '0', '22.08972', '-127', '2023-07-23 09:44:06'),
(192, 2, '0', '22.08972', '-127', '2023-07-23 09:44:08'),
(193, 2, '0', '22.08972', '-127', '2023-07-23 09:44:10'),
(194, 2, '0', '22.08972', '-127', '2023-07-23 09:44:14'),
(195, 2, '0', '22.08972', '-127', '2023-07-23 09:44:19'),
(196, 2, '0', '22.08972', '-127', '2023-07-23 09:44:25'),
(197, 2, '0', '22.08972', '-127', '2023-07-23 09:44:26'),
(198, 2, '0', '22.08972', '-127', '2023-07-23 09:44:28'),
(199, 2, '0', '22.08972', '-127', '2023-07-23 09:44:32'),
(200, 2, '0', '22.08972', '-127', '2023-07-23 09:44:36'),
(201, 2, '0', '22.08972', '-127', '2023-07-23 09:44:39'),
(202, 2, '0', '22.08972', '-127', '2023-07-23 09:44:41'),
(203, 2, '0', '22.08972', '-127', '2023-07-23 09:44:43'),
(204, 2, '0', '22.08972', '-127', '2023-07-23 09:44:48'),
(205, 2, '0', '22.08972', '-127', '2023-07-23 09:44:52'),
(206, 2, '0', '22.08972', '-127', '2023-07-23 09:44:54'),
(207, 2, '0', '22.08972', '-127', '2023-07-23 09:44:57'),
(208, 2, '0', '22.08972', '-127', '2023-07-23 09:44:59'),
(209, 2, '0', '22.08972', '-127', '2023-07-23 09:45:03'),
(210, 2, '0', '22.08972', '-127', '2023-07-23 09:45:06'),
(211, 15, '12', '12', '7', '2023-07-23 09:58:56'),
(212, 2, '34', '7', '26', '2023-07-23 10:19:33');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('aDy9GeSh3bt841X4bo9t2zjmsM2PE53kavMv3p4g', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiMDFBa3Zyb3ZKSVFnclVhOVp0bUc0RFJ6WlNCcjRMajFrR1hLYVliWSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1690107680),
('LDK6CzNOOSm8PkmtaX90utJnTOl3LGLOAKWRPOu2', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQlVuRUVzT1hrbUxBcjZBelJRVmRVVkN2ZjNwZThBNndXZndtVmc4SyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=', 1690107656),
('SsdpDDIpJAFK8znThcA94Axk0vNdPKbP6wzwnVnS', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.67', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZlFWTld2Uk14QWZDeXNnMzNzUzExbzJudzBIUGY2RVdPMWJZRnVzOCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fX0=', 1690106928);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_device` varchar(8) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` int(1) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `id_device`, `is_active`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 'Budi Setiawan', 'admin@gmail.com', NULL, 0, NULL, '$2y$10$JzCTXGJIXxo0w2cNI6pHROTjzFq6KFvOYXjVuHnrWNDf9SNweElGa', NULL, NULL, NULL, NULL, NULL, '/user/default_image.png', 1, '2023-02-27 21:46:59', '2023-07-19 00:18:07'),
(2, 'Abu Bakar', 'budi@gmail.com', '32456', 0, NULL, '$2y$10$vfQrDkTjlUBk1WHBu5qYNuqKbqAnoHINhPf2/GJ5sb7rHQBvkfdfS', NULL, NULL, NULL, NULL, NULL, '/user/user_20230525081451.jpg', 2, NULL, '2023-05-25 01:14:51'),
(5, 'abv', 'abdullah@gmail.com', NULL, 0, NULL, '$2y$10$qIIKEOwgwdhUM3h3wrEOouz3./.c/1moADES3nGsdc/Sk6NTCGs8C', NULL, NULL, NULL, NULL, NULL, '/user/default_image.png', 3, '2023-06-06 13:36:25', '2023-06-06 13:36:25'),
(14, 'abu', 'admin24@gmail.com', 'sUPR3JIB', 0, NULL, '$2y$10$uoA766P2GiVpjwVdJyuReu1uguCeLbqT0k2T.VC3IhcaNk7bRl0n2', NULL, NULL, NULL, NULL, NULL, '/user/default_image.png', 2, NULL, '2023-07-06 01:23:08'),
(15, 'alif', 'alif@gmail.com', 'P1NB21xN', 0, NULL, '$2y$10$7EK630VNLSQsGEkQ1XeiLeyrsrCwLX6s.ujcUypo.F.Oz9My.9Yn.', NULL, NULL, NULL, NULL, NULL, '/user/default_image.png', 2, '2023-07-23 09:48:20', '2023-07-23 09:48:20'),
(16, 'Reza Arab', 'reza@gmail.com', 'GeUoHyHn', 0, NULL, '$2y$10$gr21aXpkBPDqACiLTyyjuuSQoA4PWQUzTY1pBA4vAPYdT3nggvLHC', NULL, NULL, NULL, NULL, NULL, '/user/default_image.png', 2, '2023-07-23 10:01:40', '2023-07-23 10:01:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `controls`
--
ALTER TABLE `controls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `controls_id_user_foreign` (`id_user`);

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `devices_id_user_foreign` (`id_user`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sensors`
--
ALTER TABLE `sensors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sensors_id_user_foreign` (`id_user`);

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
-- AUTO_INCREMENT for table `controls`
--
ALTER TABLE `controls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=264;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sensors`
--
ALTER TABLE `sensors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=213;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `controls`
--
ALTER TABLE `controls`
  ADD CONSTRAINT `controls_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `devices`
--
ALTER TABLE `devices`
  ADD CONSTRAINT `devices_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sensors`
--
ALTER TABLE `sensors`
  ADD CONSTRAINT `sensors_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
