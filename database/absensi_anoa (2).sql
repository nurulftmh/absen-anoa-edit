-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 07, 2026 at 08:29 AM
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
(11, 4, '2026-05-06', '18:52:16', NULL, 'hadir', '2026-05-06 10:52:16', '2026-05-06 10:52:16'),
(12, 7, '2026-05-07', '10:06:14', NULL, 'hadir', '2026-05-07 02:06:14', '2026-05-07 02:06:14');

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
(6, 7, 'cholik Harun', 'Effect of Soleus Muscle Exercise With and Without Additional Weight on Blood Glucose Among Adults With Type 2 Diabetes Mellitus: A Cross-Over Study', 'https://jnhrc.com.np/index.php/jnhrc/index', 'Submitted', NULL, 'manuscripts/wTYFAEjcXZMDG4Sjfk7W0HaNjBqHzbHepELznfdR.jpg', '2026-05-07 02:59:38', '2026-05-07 02:59:58'),
(7, 7, 'La Rangki', 'Measurement instruments for quality of life in stoma patients: a scoping review', 'https://jnhrc.com.np/index.php/jnhrc/index', 'Draft', 'Pending', 'manuscripts/i2qHxbGA1fi7NccarmQzJBfteUMw9WorNSD7fFCX.jpg', '2026-05-07 03:05:11', '2026-05-07 06:44:01'),
(8, 7, 'Maria', 'PREDICTORS OF HYPOGLYCAEMIA AWARENESS AMONG INDONESIAN PATIENTS WITH DIABETES MELLITUS', 'https://aisyah.journalpress.id/index.php/jika/login', 'Submitted', 'Awaiting assignment', NULL, '2026-05-07 03:06:50', '2026-05-07 03:06:50'),
(9, 7, 'Sitti Aisa', 'THE EFFECT OF BOILED CHICKEN EGG CONSUMPTION ON MID-UPPER ARM CIRCUMFERENCE AND HEMOGLOBIN LEVELS AMONG PREGNANT WOMEN WITH CHRONIC ENERGY DEFICIENCY', 'https://aisyah.journalpress.id/index.php/jika/login', 'Submitted', 'Awaiting assignment', NULL, '2026-05-07 03:07:37', '2026-05-07 03:07:37'),
(10, 7, 'Sofia Februanti', 'Mother\'s Experience of Relactation in Improving Breast Milk Achieve in Tasikmalaya', 'https://aisyah.journalpress.id/index.php/jika/login', 'Submitted', 'Awaiting assignment', NULL, '2026-05-07 03:08:41', '2026-05-07 03:08:41'),
(11, 7, 'Kartini', 'ASSOCIATION OF GUIDED IMAGERY AND GOLDEN BANANA COOKIE SUPPLEMENTATION WITH ESTIMATED FETAL WEIGHT AMONG ANXIOUS PREGNANT', 'https://aisyah.journalpress.id/index.php/jika/login', 'Submitted', 'Awaiting assignment', NULL, '2026-05-07 03:09:23', '2026-05-07 03:09:23'),
(12, 7, 'arsulfa', 'Effects of Dark Chocolate and Oats Sticks on Blood Pressure and Heart Rate among Adolescents with Anxiety.docx', 'https://jnhrc.com.np/index.php/jnhrc/index', 'Submitted', 'submission', 'manuscripts/VK2eueiApGvMfnCzjQ71BFifKQ1IIMvbrP8nXpjO.jpg', '2026-05-07 03:12:22', '2026-05-07 03:12:22'),
(13, 7, 'amien', 'Feasibility of Ultrasonography Examination in Assessing Dysphagia in Children with Spastic Cerebral Palsy', 'https://jnps.org.np/', 'Under Review', NULL, 'manuscripts/MYKm8M9yXLvVThEHjrvQdoYy4VUbvz77IKOSZScx.jpg', '2026-05-07 03:13:33', '2026-05-07 03:13:33'),
(14, 7, 'Putria Carolina', 'The Mediating Role of Meaningful Work in the Relationship between Humanistic Leadership and Job Satisfaction among Health Faculty Lecturers at Private Universities in Palangka Raya', 'cari jurnal', 'Draft', 'Pending', NULL, '2026-05-07 03:23:24', '2026-05-07 03:23:24'),
(15, 7, 'yessy', 'Legal And Ethical Aspects of Forensic Odontology Services in Hospital Management Systems', 'https://jnhrc.com.np/index.php/jnhrc/index', 'Draft', 'menuju proses', 'manuscripts/zgY7zCPBrLOBjqLOPSL0ZWr2CWZXZ7XTEvtQ4miU.jpg', '2026-05-07 03:28:33', '2026-05-07 03:28:33'),
(16, 7, 'endang', 'COST ANALYSIS AND FACTORS INFLUENCING THE COST OF HYPERTENSION IN OUT PATIENTS AT BALARAJA', 'https://he01.tci-thaijo.org/index.php/AIHD-MU', 'On Progress', 'Tunggu surat Etik', 'manuscripts/WEXIv8xiFvq7D7YMrsV7LKg7l8CQWanoJf5qtFdl.jpg', '2026-05-07 03:30:09', '2026-05-07 03:31:49'),
(17, 7, 'Laksmi', 'Programmed Death-Ligand 1 Immunohistochemical Expression in Invasive Urothelial Carcinoma of the Bladder: Association with Lymphovascular Invasion', 'https://waocp.com/journal/index.php/apjcb/', 'Under Review', 'ada revisi dari 1 reviewer', 'manuscripts/k9l0Z02ceCFT4Z9lnZ8caVXm4Fshk0q3AwhbcEHk.jpg', '2026-05-07 03:37:00', '2026-05-07 03:37:00'),
(18, 7, 'Nunung', 'Caspase-3 Activation by Curcumin in Breast Cancer Cells: Assessment by Flow Cytometry and Acridine Orange/Ethidium Bromide Staining', 'https://www.rjptonline.org/', 'Under Review', NULL, 'manuscripts/AO65EUxT6OZiS69Ma1GpWpG82LuDXAAmJJzc6tts.jpg', '2026-05-07 03:41:12', '2026-05-07 03:41:12'),
(19, 7, 'Yoifah 1', 'Hyperbaric Oxygen Therapy Reverses Periodontitis-Associated Porphyromonas gingivalis–Induced Cognitive Impairment in Sprague–Dawley Rats', 'http://www.apjtb.org', 'Draft', 'menuju proses', 'manuscripts/FHXovCtqwPZwA730frvbbI9Jlh1kuIldL8ern3yG.jpg', '2026-05-07 03:42:52', '2026-05-07 07:07:53'),
(20, 7, 'Sultan akbar', 'Effect of Sea Rabbit Extract Syrup and Papaya Juice on Hemoglobin and Serum Ferritin Levels in Stunted Toddlers: A Randomized Pretest–Posttest Controlled Trial', 'https://mc.manuscriptcentral.com/jnsv', 'Under Review', 'belum ada revisi', 'manuscripts/dSE0HGyHK5Arh40gYKbe4pPMQSNWOsyJsCwnsP4Q.jpg', '2026-05-07 03:44:14', '2026-05-07 03:44:14'),
(21, 7, 'ANDIKA', 'The Association between Diaphragmatic Thickness and Pulmonary Function in Patients with Chronic Obstructive Pulmonary Disease: A Cross Sectional Study', 'https://jnhrc.com.np/index.php/jnhrc/index', 'Submitted', 'submission', 'manuscripts/8wIT0nd4Rg37c8BeSyDY5AKu8GUfhUmgXTXKYMlz.jpg', '2026-05-07 03:45:28', '2026-05-07 03:45:28'),
(22, 7, 'Linny', 'Comparative Analysis of Lipid Profiles Between Controlled and Uncontrolled Type 2 Diabetes Mellitus Patients at Tarakan Regional General Hospital (2022–2023)', 'https://jnhrc.com.np/index.php/jnhrc/index', 'Submitted', 'submission', 'manuscripts/AoClRnxjrMppq8r0QqFkO2DfvZLNsqdun9jNJrZo.jpg', '2026-05-07 03:46:47', '2026-05-07 03:46:47'),
(23, 7, 'Narmawan', 'Development of Foot Care Behavior Scale in Type 2 Diabetes Mellitus Patients: Application of Theory of Planned Behavior', 'https://he01.tci-thaijo.org/index.php/AIHD-MU', 'On Progress', 'Tunggu surat Etik Tahun 2024', 'manuscripts/3QVPDjCAv9iT9ZGDhHWHvvNvVw65ZEd0D95jkG3a.jpg', '2026-05-07 03:48:06', '2026-05-07 03:48:06'),
(24, 7, 'mubarak', 'Susceptibility Status of Aedes spp. to Pyrethroid Insecticides in Two Dengue-Endemic Subdistricts of Kendari, Indonesia: A Comparative Biochemical Study', 'https://ijph.tums.ac.ir/index.php/ijph/about', 'Under Review', 'menunggu revisi', 'manuscripts/6esdvhtgmKzIXZEJy87IkQW2gFIs0yWf10quKP0K.jpg', '2026-05-07 03:50:50', '2026-05-07 03:50:50'),
(25, 7, 'bambang/sari', 'Validation of a Modified O\'Leary Plaque Index Compared to the Standard OHI-S Among Elementary School Students at SDN Pudakpayung 02, Semarang', 'https://journal.iistr.org/index.php/JPHS', 'Under Review', 'menunggu revisi', NULL, '2026-05-07 03:53:25', '2026-05-07 03:53:25'),
(26, 7, 'Eva decroli', 'Diagnostic Accuracy of Plasma 1,5-Anhydroglucitol for Detecting Prediabetes in Obese Young Adults', 'https://indonesianjournalofclinicalpathology.org/index.php/patologi/login', 'Under Review', NULL, NULL, '2026-05-07 04:13:22', '2026-05-07 04:13:22'),
(27, 7, 'endang 2', 'Pharmacological Effects of Medicinal Plant-Based Interventions on Lipid Profiles in Adults with Dyslipidemia: A Systematic Review of Clinical Evidence', 'https://pjps.pk/home', 'Draft', 'menuju proses', 'manuscripts/kFtyo3EwZISXi8Ha3b6PGCDTh51AjkIewceYe7pX.jpg', '2026-05-07 04:14:29', '2026-05-07 04:14:29'),
(28, 7, 'cholik Harun 2', 'Effectiveness of Bodyweight Soleus Push-Up in Reducing Blood Glucose among Patients with Type II Diabetes Mellitus', 'https://ijph.tums.ac.ir/index.php/ijph', 'Draft', 'menuju proses', 'manuscripts/NypQPdRqfdgKnnjNq47mNP73SXXhhKl603XIV5pl.jpg', '2026-05-07 04:15:03', '2026-05-07 04:15:03'),
(29, 7, 'Atna Permana 1, Parto Fransiskus 2', 'Sanger sequencing Molecular Confirmation and Phylogenetic Analysis of Human BGN', 'https://genominfo.org/', 'Draft', 'menuju proses', NULL, '2026-05-07 04:15:40', '2026-05-07 04:15:40'),
(30, 7, 'Endah Suprihatin', 'Development and Validation of a Need-for-Help and Self-Care Instrument for Postpartum Emergency Prevention in Preeclampsia–Eclampsia', 'https://www.jsafog.com/journalDetails/JSAFOG', 'Draft', '-', 'manuscripts/XrUBJnnuxahTVJAPJKMvKawfWAjjsR2Psc6ulvkk.jpg', '2026-05-07 06:32:39', '2026-05-07 06:32:39');

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
('9tu0Fl9ZwZmdzbnL6uV5id2aoUSWEVvm1OsdVteB', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 Edg/147.0.0.0', 'eyJfdG9rZW4iOiJjRWdDS28ySmR4cVJZamFEc3hrSW1TcG1LQmJMRFlKY0RScVp3bnh6IiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDBcL21hbnVzY3JpcHRzP3BhZ2U9MiIsInJvdXRlIjoibWFudXNjcmlwdHMuaW5kZXgifSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjd9', 1778142372);

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
(7, 'Nurul Fatimah', 'nurulftmh085@gmail.com', NULL, '$2y$12$13QKLNkY5uDUvgpQY5rsneGWYwdTqh.dLhclQKHCiViviDC4UoTVS', NULL, '2026-05-05 04:17:40', '2026-05-07 03:32:24', 'user'),
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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

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
