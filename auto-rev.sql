-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2026 at 06:29 AM
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
-- Database: `auto-rev`
--

-- --------------------------------------------------------

--
-- Table structure for table `automation_jobs`
--

CREATE TABLE `automation_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `journal_id` bigint(20) UNSIGNED NOT NULL,
  `session_name` varchar(255) NOT NULL,
  `total_items` int(11) NOT NULL DEFAULT 0,
  `success_count` int(11) NOT NULL DEFAULT 0,
  `failed_count` int(11) NOT NULL DEFAULT 0,
  `status` enum('pending','processing','completed','failed') NOT NULL DEFAULT 'pending',
  `started_at` timestamp NULL DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `automation_jobs`
--

INSERT INTO `automation_jobs` (`id`, `journal_id`, `session_name`, `total_items`, `success_count`, `failed_count`, `status`, `started_at`, `completed_at`, `notes`, `created_at`, `updated_at`) VALUES
(2, 4, 'Session 2026-06-29 07:14:46', 1, 1, 0, 'completed', '2026-06-29 00:14:46', '2026-06-29 00:14:46', NULL, '2026-06-29 00:14:46', '2026-06-29 00:14:46'),
(3, 4, 'Session 2026-06-29 07:15:15', 2, 2, 0, 'completed', '2026-06-29 00:15:15', '2026-06-29 00:15:15', NULL, '2026-06-29 00:15:15', '2026-06-29 00:15:15'),
(4, 4, 'Session 2026-06-29 07:41:48', 2, 2, 0, 'completed', '2026-06-29 00:41:48', '2026-06-29 00:41:48', NULL, '2026-06-29 00:41:48', '2026-06-29 00:41:48'),
(5, 4, 'Session 2026-06-29 08:41:07', 2, 2, 0, 'completed', '2026-06-29 01:41:07', '2026-06-29 01:41:07', NULL, '2026-06-29 01:41:07', '2026-06-29 01:41:07'),
(6, 4, 'Session 2026-06-29 08:42:56', 2, 2, 0, 'completed', '2026-06-29 01:42:56', '2026-06-29 01:42:56', NULL, '2026-06-29 01:42:56', '2026-06-29 01:42:56'),
(7, 4, 'Session 2026-06-29 09:02:42', 2, 2, 0, 'completed', '2026-06-29 02:02:42', '2026-06-29 02:02:42', NULL, '2026-06-29 02:02:42', '2026-06-29 02:02:42'),
(8, 4, 'Session 2026-06-30 06:55:46', 2, 2, 0, 'completed', '2026-06-29 23:55:46', '2026-06-29 23:55:47', NULL, '2026-06-29 23:55:46', '2026-06-29 23:55:47'),
(9, 4, 'Session 2026-06-30 06:56:51', 2, 2, 0, 'completed', '2026-06-29 23:56:51', '2026-06-29 23:56:51', NULL, '2026-06-29 23:56:51', '2026-06-29 23:56:51'),
(10, 4, 'Session 2026-06-30 07:34:42', 2, 2, 0, 'completed', '2026-06-30 00:34:42', '2026-06-30 00:34:42', NULL, '2026-06-30 00:34:42', '2026-06-30 00:34:42'),
(11, 4, 'Session 2026-06-30 07:36:03', 2, 2, 0, 'completed', '2026-06-30 00:36:03', '2026-06-30 00:36:03', NULL, '2026-06-30 00:36:03', '2026-06-30 00:36:03'),
(12, 4, 'Session 2026-07-01 01:22:27', 2, 2, 0, 'completed', '2026-06-30 18:22:27', '2026-06-30 18:22:27', NULL, '2026-06-30 18:22:27', '2026-06-30 18:22:27');

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
-- Table structure for table `job_items`
--

CREATE TABLE `job_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `automation_job_id` bigint(20) UNSIGNED NOT NULL,
  `paper_id` varchar(255) NOT NULL,
  `reviewer_id` varchar(255) NOT NULL,
  `generated_url` varchar(255) NOT NULL,
  `status` enum('pending','success','failed') NOT NULL DEFAULT 'pending',
  `error_message` text DEFAULT NULL,
  `executed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_items`
--

INSERT INTO `job_items` (`id`, `automation_job_id`, `paper_id`, `reviewer_id`, `generated_url`, `status`, `error_message`, `executed_at`, `created_at`, `updated_at`) VALUES
(2, 2, '455', '527', 'https://iaesprime.com/index.php/csit/editor/selectReviewer/455/527', 'pending', NULL, NULL, '2026-06-29 00:14:46', '2026-06-29 00:14:46'),
(3, 3, '455', '527', 'https://iaesprime.com/index.php/csit/editor/selectReviewer/455/527', 'pending', NULL, NULL, '2026-06-29 00:15:15', '2026-06-29 00:15:15'),
(4, 3, '470', '527', 'https://iaesprime.com/index.php/csit/editor/selectReviewer/470/527', 'pending', NULL, NULL, '2026-06-29 00:15:15', '2026-06-29 00:15:15'),
(5, 4, '455', '527', 'https://iaesprime.com/index.php/csit/editor/selectReviewer/455/527', 'pending', NULL, NULL, '2026-06-29 00:41:48', '2026-06-29 00:41:48'),
(6, 4, '470', '527', 'https://iaesprime.com/index.php/csit/editor/selectReviewer/470/527', 'pending', NULL, NULL, '2026-06-29 00:41:48', '2026-06-29 00:41:48'),
(7, 5, '455', '527', 'https://iaesprime.com/index.php/csit/editor/selectReviewer/455/527', 'pending', NULL, NULL, '2026-06-29 01:41:07', '2026-06-29 01:41:07'),
(8, 5, '470', '527', 'https://iaesprime.com/index.php/csit/editor/selectReviewer/470/527', 'pending', NULL, NULL, '2026-06-29 01:41:07', '2026-06-29 01:41:07'),
(9, 6, '455', '527', 'https://iaesprime.com/index.php/csit/editor/selectReviewer/455/527', 'pending', NULL, NULL, '2026-06-29 01:42:56', '2026-06-29 01:42:56'),
(10, 6, '470', '527', 'https://iaesprime.com/index.php/csit/editor/selectReviewer/470/527', 'pending', NULL, NULL, '2026-06-29 01:42:56', '2026-06-29 01:42:56'),
(11, 7, '455', '527', 'https://iaesprime.com/index.php/csit/editor/selectReviewer/455/527', 'pending', NULL, NULL, '2026-06-29 02:02:42', '2026-06-29 02:02:42'),
(12, 7, '470', '527', 'https://iaesprime.com/index.php/csit/editor/selectReviewer/470/527', 'pending', NULL, NULL, '2026-06-29 02:02:42', '2026-06-29 02:02:42'),
(13, 8, '455', '527', 'https://iaesprime.com/index.php/csit/editor/selectReviewer/455/527', 'pending', NULL, NULL, '2026-06-29 23:55:47', '2026-06-29 23:55:47'),
(14, 8, '470', '527', 'https://iaesprime.com/index.php/csit/editor/selectReviewer/470/527', 'pending', NULL, NULL, '2026-06-29 23:55:47', '2026-06-29 23:55:47'),
(15, 9, '455', '527', 'https://iaesprime.com/index.php/csit/editor/selectReviewer/455/527', 'pending', NULL, NULL, '2026-06-29 23:56:51', '2026-06-29 23:56:51'),
(16, 9, '470', '527', 'https://iaesprime.com/index.php/csit/editor/selectReviewer/470/527', 'pending', NULL, NULL, '2026-06-29 23:56:51', '2026-06-29 23:56:51'),
(17, 10, '449', '527', 'https://iaesprime.com/index.php/csit/editor/selectReviewer/449/527', 'pending', NULL, NULL, '2026-06-30 00:34:42', '2026-06-30 00:34:42'),
(18, 10, '470', '527', 'https://iaesprime.com/index.php/csit/editor/selectReviewer/470/527', 'pending', NULL, NULL, '2026-06-30 00:34:42', '2026-06-30 00:34:42'),
(19, 11, '476', '527', 'https://iaesprime.com/index.php/csit/editor/selectReviewer/476/527', 'pending', NULL, NULL, '2026-06-30 00:36:03', '2026-06-30 00:36:03'),
(20, 11, '470', '527', 'https://iaesprime.com/index.php/csit/editor/selectReviewer/470/527', 'pending', NULL, NULL, '2026-06-30 00:36:03', '2026-06-30 00:36:03'),
(21, 12, '566', '527', 'https://iaesprime.com/index.php/csit/editor/selectReviewer/566/527', 'pending', NULL, NULL, '2026-06-30 18:22:27', '2026-06-30 18:22:27'),
(22, 12, '573', '527', 'https://iaesprime.com/index.php/csit/editor/selectReviewer/573/527', 'pending', NULL, NULL, '2026-06-30 18:22:27', '2026-06-30 18:22:27');

-- --------------------------------------------------------

--
-- Table structure for table `journals`
--

CREATE TABLE `journals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `base_url` varchar(255) NOT NULL,
  `ojs_version` varchar(20) NOT NULL DEFAULT '3.3.0',
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `journals`
--

INSERT INTO `journals` (`id`, `name`, `base_url`, `ojs_version`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Jurnal Pendidikan Indonesia', 'https://jpi.example.com', '3.3.0', 'Jurnal Pendidikan Indonesia adalah jurnal peer-review yang mempublikasikan penelitian tentang pendidikan.', 1, '2026-06-28 23:11:49', '2026-06-28 23:11:49'),
(2, 'Jurnal Teknologi Informasi', 'https://jti.example.com', '3.2.0', 'Jurnal Teknologi Informasi mempublikasikan artikel tentang inovasi teknologi informasi.', 1, '2026-06-28 23:11:49', '2026-06-28 23:11:49'),
(4, 'csit', 'https://iaesprime.com', '2', NULL, 1, '2026-06-29 00:14:18', '2026-06-29 00:14:18'),
(5, 'ehs', 'https://iaesprime.com', '2', NULL, 1, '2026-06-30 18:13:23', '2026-06-30 18:13:23');

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
(4, '2026_06_29_020756_create_1_journals_table', 1),
(5, '2026_06_29_020756_create_2_automation_jobs_table', 1),
(6, '2026_06_29_020756_create_job_items_table', 1);

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
('0hjv1reiumhdJcycQkQLCskOzvsO1r6pz8Phmtu0', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiOW1oREZnaHhocEM5alBPaEN4dUhnUG4zR0xYa2dKa3RoaDB3QjlLbSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hdXRvbWF0aW9uIjtzOjU6InJvdXRlIjtzOjE2OiJhdXRvbWF0aW9uLmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1782868948),
('D8I8aNtwtEVaFT4dg2osoZ34UWhx4EruCVZG3XLV', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36 Edg/150.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZmZUcGw2VXFyd3htMmxGT3ROUUt2RmNvZ0UwSnNYdlE3R2RyMXVwUyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6OToiZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1783308629),
('PHXOZ5s3dJq9FLIqYAhbkJCRhMXZcZR9SBbo9tVu', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZkdybGRBYm9SSTlQaXZYRWRVUEUzMmlDaDFIRkxrbDI3T3htbEtMRCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9qb3VybmFscyI7czo1OiJyb3V0ZSI7czoxNDoiam91cm5hbHMuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1782724368),
('uttZtshsRMQzPecf5UTsxegjjLuA1S7Tim7XkpU2', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiU0xNSjNqRWozYm1lb1lYdXVoT0UwMnROVnlrN1dqZzBXcWxDVllyZyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9qb3VybmFscyI7czo1OiJyb3V0ZSI7czoxNDoiam91cm5hbHMuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1782808929);

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'iqbal', 'iq.iaes@gmail.com', NULL, '$2y$12$g3QQZLsrGd8tY5701GzQ4efv9NyxsCbpDbhF2pCHTwYdoGOZL08S.', NULL, '2026-06-29 00:09:11', '2026-06-29 00:09:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `automation_jobs`
--
ALTER TABLE `automation_jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `automation_jobs_journal_id_foreign` (`journal_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

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
-- Indexes for table `job_items`
--
ALTER TABLE `job_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_items_automation_job_id_foreign` (`automation_job_id`);

--
-- Indexes for table `journals`
--
ALTER TABLE `journals`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `automation_jobs`
--
ALTER TABLE `automation_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
-- AUTO_INCREMENT for table `job_items`
--
ALTER TABLE `job_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `journals`
--
ALTER TABLE `journals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `automation_jobs`
--
ALTER TABLE `automation_jobs`
  ADD CONSTRAINT `automation_jobs_journal_id_foreign` FOREIGN KEY (`journal_id`) REFERENCES `journals` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `job_items`
--
ALTER TABLE `job_items`
  ADD CONSTRAINT `job_items_automation_job_id_foreign` FOREIGN KEY (`automation_job_id`) REFERENCES `automation_jobs` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
