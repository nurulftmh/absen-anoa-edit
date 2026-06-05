-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 06, 2026 at 10:56 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absensi_anoa`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `check_in` time DEFAULT NULL,
  `check_out` time DEFAULT NULL,
  `status` enum('hadir','izin','alpa') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'hadir',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `user_id`, `date`, `check_in`, `check_out`, `status`, `created_at`, `updated_at`) VALUES
(2, 3, '2026-05-05', '11:14:28', NULL, 'hadir', '2026-05-05 03:14:28', '2026-05-05 03:14:28'),
(3, 4, '2026-05-05', '11:29:21', NULL, 'hadir', '2026-05-05 03:29:21', '2026-05-05 03:29:21'),
(4, 5, '2026-05-05', '11:40:40', NULL, 'hadir', '2026-05-05 03:40:40', '2026-05-05 03:40:40'),
(5, 5, '2026-05-13', NULL, NULL, 'izin', '2026-05-05 03:57:56', '2026-05-05 03:57:56'),
(6, 6, '2026-05-05', '12:05:56', NULL, 'hadir', '2026-05-05 04:05:56', '2026-05-05 04:05:56'),
(7, 8, '2026-05-05', '13:24:44', NULL, 'hadir', '2026-05-05 05:24:44', '2026-05-05 05:24:44'),
(8, 7, '2026-05-05', NULL, NULL, 'izin', '2026-05-05 05:30:42', '2026-05-05 05:30:42'),
(9, 9, '2026-05-05', '14:54:14', NULL, 'hadir', '2026-05-05 06:54:14', '2026-05-05 06:54:14'),
(10, 7, '2026-05-06', '08:56:35', '17:59:57', 'hadir', '2026-05-06 00:56:35', '2026-05-06 09:59:57'),
(11, 4, '2026-05-06', '18:52:16', NULL, 'hadir', '2026-05-06 10:52:16', '2026-05-06 10:52:16');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-karyawan@gmail.com|127.0.0.1', 'i:1;', 1778064744),
('laravel-cache-karyawan@gmail.com|127.0.0.1:timer', 'i:1778064744;', 1778064744),
('laravel-cache-sistem@gmail.com|127.0.0.1', 'i:1;', 1778063345),
('laravel-cache-sistem@gmail.com|127.0.0.1:timer', 'i:1778063345;', 1778063345);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

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
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leave_requests`
--

CREATE TABLE `leave_requests` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `reason` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `proof_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leave_requests`
--

INSERT INTO `leave_requests` (`id`, `user_id`, `date`, `reason`, `proof_file`, `status`, `created_at`, `updated_at`) VALUES
(1, 5, '2026-05-13', 'sakit', 'leave-proofs/F115sVqxwGUJSkZM269ZFGP7RhXL0RT52U3io0hV.jpg', 'approved', '2026-05-05 03:51:35', '2026-05-05 03:57:56'),
(3, 4, '2026-05-15', 'ke luar kota', NULL, 'rejected', '2026-05-05 04:14:50', '2026-05-05 05:30:33'),
(4, 7, '2026-05-05', 'sakit', NULL, 'approved', '2026-05-05 04:24:57', '2026-05-05 05:30:42'),
(5, 9, '2026-05-19', 'pelatihan', NULL, 'pending', '2026-05-05 06:53:31', '2026-05-05 06:53:31');

-- --------------------------------------------------------

--
-- Table structure for table `manuscripts`
--

CREATE TABLE `manuscripts` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `author_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `journal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `manuscripts`
--

INSERT INTO `manuscripts` (`id`, `user_id`, `author_name`, `title`, `journal`, `status`, `description`, `photo`, `created_at`, `updated_at`) VALUES
(4, 7, 'sita', 'aesduyigui', 'jpmh', 'Under Review', 'pindah jurnal', 'manuscripts/it0V7k3c9Z7xxMbeQdvKVx1OtwV83AoVjVxtwnmI.jpg', '2026-05-06 09:24:57', '2026-05-06 09:27:47');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_05_05_025327_add_role_to_users_table', 2),
(5, '2026_05_05_030411_create_attendances_table', 3),
(6, '2026_05_05_112218_create_work_progress_table', 4),
(7, '2026_05_05_112304_create_work_files_table', 4),
(8, '2026_05_05_114228_create_leave_requests_table', 5),
(9, '2026_05_06_161922_create_manuscripts_table', 6),
(10, '2026_05_06_165215_add_photo_to_manuscripts_table', 7);

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
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('HUNoetWnQYHRCKcyEwdQeRSDeBQyjoAazBgnZqs5', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'eyJfdG9rZW4iOiI1SVk0MW85WGFwRUJYenI2QTZvSVpNbTVuNXRFaGlvbm55UEx2ZGszIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL2Rhc2hib2FyZCIsInJvdXRlIjoiZGFzaGJvYXJkIn0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjo0fQ==', 1778064806);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'tes', 'tes@gmail.com', NULL, '$2y$12$9GfyuqmZh0hwgVt.2.JyQO/MDwwFLVUhVN5R8/rNx/pv15L/x7tnm', NULL, '2026-05-04 18:49:19', '2026-05-04 18:49:19', 'admin'),
(3, 'karyawan2', 'karyawan2@gmail.com', NULL, '$2y$12$ffcghkIPQ/KU2py7xet29u2/BIpXX.1sqLt1fZPaMx4shJ4Lho6d2', NULL, '2026-05-05 03:14:24', '2026-05-05 03:14:24', 'user'),
(4, 'pegawai', 'pegawai@gmail.com', NULL, '$2y$12$.j7z6IG2qxrTYHi0tSGvve/iMoqO1JibjrJR5x82rILn9N0HmnTpG', NULL, '2026-05-05 03:29:17', '2026-05-05 03:29:17', 'user'),
(5, 'anoa sejahtera', 'anoasejahtera238@gmail.com', NULL, '$2y$12$zmH3MdLdO0iMyK0jeQvKfOdmyiRsCk0skrDU3Qr3VR3KT0PY/566S', NULL, '2026-05-05 03:40:37', '2026-05-05 03:40:37', 'user'),
(6, 'nurul', 'nurul@gmail.com', NULL, '$2y$12$111/VjqHusZJGY85P3JfMeiXt.MVFLn52XgWevj/cyOQ/k41mwNEu', NULL, '2026-05-05 04:05:47', '2026-05-05 04:05:47', 'user'),
(7, 'sita', 'sita@gmail.com', NULL, '$2y$12$13QKLNkY5uDUvgpQY5rsneGWYwdTqh.dLhclQKHCiViviDC4UoTVS', NULL, '2026-05-05 04:17:40', '2026-05-05 04:17:40', 'user'),
(8, 'wasita', 'wasita@gmail.com', NULL, '$2y$12$5L7IhgP3elJtDL3HhCJAYeTAI8/Tsyhz8ekElH6Xb9xfpf3BdDyB.', NULL, '2026-05-05 05:22:28', '2026-05-05 05:22:28', 'user'),
(9, 'wanurul', 'wanurul@gmail.com', NULL, '$2y$12$AIEHoOxhjAm6HwxhyxWyauBdxtZVILTp0vTGZtp6mxolpg/3M2pfG', NULL, '2026-05-05 06:52:25', '2026-05-05 06:52:25', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `work_files`
--

CREATE TABLE `work_files` (
  `id` bigint UNSIGNED NOT NULL,
  `work_progress_id` bigint UNSIGNED NOT NULL,
  `file_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `work_files`
--

INSERT INTO `work_files` (`id`, `work_progress_id`, `file_path`, `file_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'work-files/ExBGRJ1xKfrQlkYmfwVW2JhgFoblzsexFop19hsV.jpg', 'WhatsApp Image 2026-04-30 at 14.25.04.jpeg', '2026-05-05 03:38:13', '2026-05-05 03:38:13'),
(2, 2, 'work-files/gFSY7MwltyzvwxpIx3LdkFqDViH2zMVMi3esM3oO.jpg', 'WhatsApp Image 2026-04-30 at 14.25.04.jpeg', '2026-05-05 03:40:56', '2026-05-05 03:40:56'),
(3, 3, 'work-files/4vXTEd4PsMwfvDyptxvRHkPiFVnCJOZogyBeEaBE.jpg', 'WhatsApp Image 2026-04-30 at 14.25.04.jpeg', '2026-05-05 04:06:07', '2026-05-05 04:06:07'),
(4, 4, 'work-files/tL99ZLZT40Ne9OiUTyDmOdgQiMMbHdAm8xXCOvx2.docx', 'Revisi_Disertasi.docx', '2026-05-05 04:15:24', '2026-05-05 04:15:24'),
(5, 4, 'work-files/fZ34Hvi2IJzznN1gD3hqLTG2YFBRwPRPmfPdcw2J.docx', 'sitasi sita.docx', '2026-05-05 04:15:24', '2026-05-05 04:15:24'),
(6, 4, 'work-files/jwUdtfavptGlUN6sWWgiydgZaTKSQeXr8QGR8W1c.pdf', 'surat permintaan rekomendasi_20260430_0001.pdf', '2026-05-05 04:15:24', '2026-05-05 04:15:24'),
(7, 4, 'work-files/2uc3qzE7ghu9M0PO4B0KmIvMRIQlnOUhSUYtKXmq.jpg', 'WhatsApp Image 2026-04-30 at 14.25.04.jpeg', '2026-05-05 04:15:24', '2026-05-05 04:15:24'),
(8, 6, 'work-files/bgKvIRhOSteyxJFL3kgacZicfLI1cXKRRyxh2Z4F.docx', 'Main Manuscript.docx', '2026-05-05 06:57:20', '2026-05-05 06:57:20');

-- --------------------------------------------------------

--
-- Table structure for table `work_progresses`
--

CREATE TABLE `work_progresses` (
  `id` bigint UNSIGNED NOT NULL,
  `attendance_id` bigint UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `work_progresses`
--

INSERT INTO `work_progresses` (`id`, `attendance_id`, `description`, `created_at`, `updated_at`) VALUES
(1, 3, '1. submit manuscript\r\n2. revisi buku', '2026-05-05 03:38:13', '2026-05-05 03:38:13'),
(2, 4, 'fetegwgwe4', '2026-05-05 03:40:56', '2026-05-05 03:40:56'),
(3, 6, '1. submit', '2026-05-05 04:06:07', '2026-05-05 04:06:07'),
(4, 3, '1. submit manuscript', '2026-05-05 04:15:24', '2026-05-05 04:15:24'),
(5, 7, '1. revisi disertasi', '2026-05-05 05:27:15', '2026-05-05 05:27:15'),
(6, 7, '1. submit manuscript\r\njudul:', '2026-05-05 06:57:19', '2026-05-05 06:57:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `attendances_user_id_date_unique` (`user_id`,`date`);

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
-- Indexes for table `leave_requests`
--
ALTER TABLE `leave_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leave_requests_user_id_foreign` (`user_id`);

--
-- Indexes for table `manuscripts`
--
ALTER TABLE `manuscripts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `manuscripts_user_id_foreign` (`user_id`);

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
-- Indexes for table `work_files`
--
ALTER TABLE `work_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `work_files_work_progress_id_foreign` (`work_progress_id`);

--
-- Indexes for table `work_progresses`
--
ALTER TABLE `work_progresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `work_progresses_attendance_id_foreign` (`attendance_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leave_requests`
--
ALTER TABLE `leave_requests`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `manuscripts`
--
ALTER TABLE `manuscripts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `work_files`
--
ALTER TABLE `work_files`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `work_progresses`
--
ALTER TABLE `work_progresses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `leave_requests`
--
ALTER TABLE `leave_requests`
  ADD CONSTRAINT `leave_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `manuscripts`
--
ALTER TABLE `manuscripts`
  ADD CONSTRAINT `manuscripts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `work_files`
--
ALTER TABLE `work_files`
  ADD CONSTRAINT `work_files_work_progress_id_foreign` FOREIGN KEY (`work_progress_id`) REFERENCES `work_progresses` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `work_progresses`
--
ALTER TABLE `work_progresses`
  ADD CONSTRAINT `work_progresses_attendance_id_foreign` FOREIGN KEY (`attendance_id`) REFERENCES `attendances` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
