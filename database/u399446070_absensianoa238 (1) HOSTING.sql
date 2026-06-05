-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 04, 2026 at 02:26 AM
-- Server version: 11.8.6-MariaDB-log
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u399446070_absensianoa238`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `check_in` time DEFAULT NULL,
  `check_out` time DEFAULT NULL,
  `status` enum('hadir','izin','alpa') NOT NULL DEFAULT 'hadir',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `user_id`, `date`, `check_in`, `check_out`, `status`, `created_at`, `updated_at`) VALUES
(42, 18, '2026-05-11', '09:12:12', NULL, 'hadir', '2026-05-11 09:12:12', '2026-05-11 09:12:12'),
(43, 17, '2026-05-11', '09:14:20', NULL, 'hadir', '2026-05-11 09:14:20', '2026-05-11 09:14:20'),
(44, 17, '2026-05-12', '18:06:56', NULL, 'hadir', '2026-05-12 18:06:56', '2026-05-12 18:06:56'),
(45, 19, '2026-05-13', '08:31:19', '17:06:33', 'hadir', '2026-05-13 08:31:19', '2026-05-13 17:06:33'),
(46, 18, '2026-05-13', '08:33:00', '17:06:25', 'hadir', '2026-05-13 08:33:00', '2026-05-13 17:06:25'),
(47, 17, '2026-05-13', '09:15:49', NULL, 'hadir', '2026-05-13 09:15:49', '2026-05-13 09:15:49'),
(48, 17, '2026-05-15', '08:55:10', '16:57:47', 'hadir', '2026-05-15 08:55:10', '2026-05-15 16:57:47'),
(49, 18, '2026-05-15', '08:59:50', '17:00:59', 'hadir', '2026-05-15 08:59:50', '2026-05-15 17:00:59'),
(50, 19, '2026-05-15', '09:02:17', '17:08:57', 'hadir', '2026-05-15 09:02:17', '2026-05-15 17:08:57'),
(51, 18, '2026-05-16', '08:28:54', '16:31:00', 'hadir', '2026-05-16 08:28:54', '2026-05-16 16:31:00'),
(52, 19, '2026-05-16', '08:31:57', NULL, 'hadir', '2026-05-16 08:31:57', '2026-05-16 08:31:57'),
(53, 17, '2026-05-16', '14:09:48', NULL, 'hadir', '2026-05-16 14:09:48', '2026-05-16 14:09:48'),
(54, 18, '2026-05-18', '08:22:39', '17:26:43', 'hadir', '2026-05-18 08:22:39', '2026-05-18 17:26:43'),
(55, 19, '2026-05-18', '08:45:44', '17:27:01', 'hadir', '2026-05-18 08:45:44', '2026-05-18 17:27:01'),
(56, 17, '2026-05-18', '09:58:27', NULL, 'hadir', '2026-05-18 09:58:27', '2026-05-18 09:58:27'),
(57, 19, '2026-05-19', '09:40:58', '17:44:37', 'hadir', '2026-05-19 09:40:58', '2026-05-19 17:44:37'),
(58, 18, '2026-05-19', '10:26:27', '20:33:07', 'hadir', '2026-05-19 10:26:27', '2026-05-19 20:33:07'),
(59, 17, '2026-05-19', '17:36:27', NULL, 'hadir', '2026-05-19 17:36:27', '2026-05-19 17:36:27'),
(60, 18, '2026-05-20', '08:34:50', '17:05:07', 'hadir', '2026-05-20 08:34:50', '2026-05-20 17:05:07'),
(61, 19, '2026-05-20', '09:43:20', '18:49:11', 'hadir', '2026-05-20 09:43:20', '2026-05-20 18:49:11'),
(62, 17, '2026-05-20', '17:05:34', NULL, 'hadir', '2026-05-20 17:05:34', '2026-05-20 17:05:34'),
(63, 19, '2026-05-21', '08:41:22', '16:55:34', 'hadir', '2026-05-21 08:41:22', '2026-05-21 16:55:34'),
(64, 18, '2026-05-21', '08:53:49', '16:55:08', 'hadir', '2026-05-21 08:53:49', '2026-05-21 16:55:08'),
(65, 17, '2026-05-21', '10:17:46', NULL, 'hadir', '2026-05-21 10:17:46', '2026-05-21 10:17:46'),
(66, 19, '2026-05-22', '07:34:56', '17:20:18', 'hadir', '2026-05-22 07:34:56', '2026-05-22 17:20:18'),
(67, 18, '2026-05-22', '09:13:50', '17:20:36', 'hadir', '2026-05-22 09:13:50', '2026-05-22 17:20:36'),
(68, 17, '2026-05-22', '09:46:39', NULL, 'hadir', '2026-05-22 09:46:39', '2026-05-22 09:46:39'),
(69, 19, '2026-05-23', '07:53:39', '17:03:53', 'hadir', '2026-05-23 07:53:39', '2026-05-23 17:03:53'),
(70, 17, '2026-05-23', '08:37:40', '16:54:15', 'hadir', '2026-05-23 08:37:40', '2026-05-23 16:54:15'),
(71, 18, '2026-05-23', '08:42:44', '17:01:36', 'hadir', '2026-05-23 08:42:44', '2026-05-23 17:01:36'),
(72, 18, '2026-05-25', '08:44:49', '19:45:40', 'hadir', '2026-05-25 08:44:49', '2026-05-25 19:45:40'),
(73, 17, '2026-05-25', '08:54:30', '19:34:22', 'hadir', '2026-05-25 08:54:30', '2026-05-25 19:34:22'),
(74, 19, '2026-05-25', '09:20:19', '19:43:46', 'hadir', '2026-05-25 09:20:19', '2026-05-25 19:43:46'),
(75, 19, '2026-05-26', '07:03:57', NULL, 'hadir', '2026-05-26 07:03:57', '2026-05-26 07:03:57'),
(76, 17, '2026-05-26', '07:05:18', NULL, 'hadir', '2026-05-26 07:05:18', '2026-05-26 07:05:18'),
(77, 18, '2026-05-26', '07:59:36', NULL, 'hadir', '2026-05-26 07:59:36', '2026-05-26 07:59:36'),
(78, 18, '2026-05-28', '08:54:15', '17:59:08', 'hadir', '2026-05-28 08:54:15', '2026-05-28 17:59:08'),
(79, 19, '2026-05-28', '09:10:00', NULL, 'hadir', '2026-05-28 09:10:00', '2026-05-28 09:10:00'),
(80, 17, '2026-05-28', '10:00:59', '19:40:26', 'hadir', '2026-05-28 10:00:59', '2026-05-28 19:40:26'),
(81, 19, '2026-05-29', '08:59:25', '18:29:35', 'hadir', '2026-05-29 08:59:25', '2026-05-29 18:29:35'),
(82, 17, '2026-05-29', '09:00:03', '18:38:00', 'hadir', '2026-05-29 09:00:03', '2026-05-29 18:38:00'),
(83, 18, '2026-05-29', '09:00:21', '18:29:47', 'hadir', '2026-05-29 09:00:21', '2026-05-29 18:29:47'),
(84, 18, '2026-05-30', '09:06:51', '19:20:40', 'hadir', '2026-05-30 09:06:51', '2026-05-30 19:20:40'),
(85, 19, '2026-05-30', '09:07:11', '19:21:29', 'hadir', '2026-05-30 09:07:11', '2026-05-30 19:21:29'),
(86, 17, '2026-05-30', '09:07:57', NULL, 'hadir', '2026-05-30 09:07:57', '2026-05-30 09:07:57'),
(87, 18, '2026-06-02', '07:49:20', '17:21:58', 'hadir', '2026-06-02 07:49:20', '2026-06-02 17:21:58'),
(88, 20, '2026-06-02', '08:03:48', '16:45:24', 'hadir', '2026-06-02 08:03:48', '2026-06-02 16:45:24'),
(89, 19, '2026-06-02', '08:10:10', '17:22:06', 'hadir', '2026-06-02 08:10:10', '2026-06-02 17:22:06'),
(90, 17, '2026-06-02', '08:40:11', '17:22:45', 'hadir', '2026-06-02 08:40:11', '2026-06-02 17:22:45'),
(91, 17, '2026-06-03', '07:16:36', '17:06:00', 'hadir', '2026-06-03 07:16:36', '2026-06-03 17:06:00'),
(92, 18, '2026-06-03', '07:28:56', '17:06:11', 'hadir', '2026-06-03 07:28:56', '2026-06-03 17:06:11'),
(93, 19, '2026-06-03', '07:56:30', '16:52:29', 'hadir', '2026-06-03 07:56:30', '2026-06-03 16:52:29'),
(94, 20, '2026-06-03', '07:57:31', '17:06:25', 'hadir', '2026-06-03 07:57:31', '2026-06-03 17:06:25'),
(95, 20, '2026-06-04', '08:00:38', NULL, 'hadir', '2026-06-04 08:00:38', '2026-06-04 08:00:38'),
(96, 18, '2026-06-04', '08:02:38', NULL, 'hadir', '2026-06-04 08:02:38', '2026-06-04 08:02:38'),
(97, 19, '2026-06-04', '08:52:40', NULL, 'hadir', '2026-06-04 08:52:40', '2026-06-04 08:52:40'),
(98, 17, '2026-06-04', '09:01:03', NULL, 'hadir', '2026-06-04 09:01:03', '2026-06-04 09:01:03');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `entry_date` date NOT NULL,
  `author_name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `docs_link` text DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `user_id`, `entry_date`, `author_name`, `title`, `docs_link`, `status`, `note`, `created_at`, `updated_at`) VALUES
(30, 18, '2026-05-11', 'Dasmin Sidu', 'Penyuluhan Pertanian Berbasis Lima Modal Penghidupan', 'https://docs.google.com/document/d/1dQqlhH2L19JtyZiaS0FKuTdgZLIreuIlVA2bKCUF1jw/edit?tab=t.0', 'Selesai', 'Revisi Bab 9 dan finalisasi isi buku', '2026-05-11 09:15:06', '2026-05-13 09:42:25'),
(31, 18, '2026-05-11', 'Prof. Dr. Malik Saepudin,S.KM[AE1.1]., M.Kes', 'TANTANGAN DAN MANAJEMEN PENGENDALIAN RABIES DAN PENYAKIT MENULAR ZOONOSIS', 'https://docs.google.com/document/d/1MVskTMeprOXkUOpWsQDXfIblFeVkOkkoQ9kvRyr8THM/edit?tab=t.0', 'Selesai', 'Secara umum sdh ok, hanya berpa yg blok  warna kuning, ada bebrpa hal yg dikonfirmasi yakni sbb; 1. Perlu informasinya ..terkait dg cheks plagiarisme, mohon berkenan dishare ke saya. Kawatir ada yg mempertanyakan hal tsb.  2. Daftar pustaka tdk menggunakan mandelay, mungkin tdk menambahkan poin sitasi dalam Sinta/Google scholer merka.', '2026-05-11 09:25:45', '2026-05-19 16:27:06'),
(32, 19, '2026-05-13', 'Dr. drg. Dhona Afriza, M. Biomed', 'DAMPAK PAPARAN INHALASI METIL METAKRILAT TERHADAP MUKOSA HIDUNG DAN PARU-PARU', NULL, 'Draft', NULL, '2026-05-13 09:41:43', '2026-05-13 09:41:43'),
(35, 19, '2026-05-13', 'dr. Jojor Sihotang, Sp. OG, M. Ked. Klin', 'MONOGRAF TERAPI REGENERATIF UNTUK FISTULA VESIKOVAGINALIS', 'https://docs.google.com/document/d/1W1F8nipWo62SfGTWqDe0cMu4JWoAc7eXuEB0nKNgwdE/edit?tab=t.0#heading=h.hg5vs2lk5bc6', 'Selesai', '1. anatomi organ panggul di cover belum sesuai semestinya -> organ tampak potongan samping, namun tulangnya tampak depan, semestinya juga tidak ada penggantung rahim ke atas dan tidak ada plasenta maupun tali pusat diantara tulang simfisis. Berikut saya lampirkan contoh gambarnya 2. penulisan gelar -> sudah saya perbaiki menjadi dr. Jojor Sihotang, Sp. OG, M. Ked. Klin (mohon bantuannya untuk dicek kembali) 3. ahli bedah = ahli uroginekologi-rekonstruksi (sudah saya ganti, mohon bantuannya untuk dicek kembali) 4. gambar 1.1; 1.2; 2.1; 3.1; 4.1; 5.1; 6.1; 7.1; 8.1 belum masuk 5. terdapat beberapa sub bab / bagian tanpa referensi  - hal 15 paragraf 2&3 - ⁠hal 19 paragraf 1&2 - ⁠hal 61 paragraf 2&3 - ⁠hal 76 paragraf 2&3 - ⁠hal 77 paragraf 1 - ⁠hal 92 paragraf 1-3 - ⁠hal 93 paragraf 1-3 - ⁠hal 99 paragraf 1-3 - ⁠hal 115 paragraf 4 - ⁠hal 116 paragraf 1&2 - ⁠hal 118 paragraf 1-4 - ⁠hal 119 paragraf 1&2 - ⁠hal 128 paragraf 1-3 - ⁠hal 130 paragraf 4 - ⁠hal 131 paragraf 1-2 - ⁠hal 133 paragraf 1-4 - ⁠hal 134 paragraf 1-2 - ⁠hal 135 paragraf 4 - ⁠hal 136 paragraf 1-4 - ⁠hal 140 paragraf 4 - ⁠hal 141 paragraf 1-4 - ⁠Hal 142 paragraf 1-4 - ⁠hal 143 paragraf 1 - ⁠hal 144 paragraf 1-2 - ⁠hal 145 paragraf 2-4 - ⁠hal 146 paragraf 3-4 - ⁠hal 147 paragraf 1-3 - ⁠hal 148 paragraf 1-4 - ⁠hal 149 paragraf 3-4, - ⁠hal 151 paragraf 1-3 - ⁠hal 152 paragraf 3-4 - ⁠153 paragraf 1-4 - ⁠hal 154 paragraf 1-3 - ⁠hal 160 paragraf 1-2 - ⁠hal 169 paragraf 1-3 - ⁠hal 182 paragraf 1-3 - ⁠hal 183 paragraf 1-3 - ⁠hal 184 paragraf 3 - ⁠hal 185 paragraf 3 - ⁠hal 186 paragraf 1-3 - ⁠hal 187 paragraf 1-2 - ⁠hal 188 paragraf 1-3 - ⁠hal 189 paragraf 1-3 - ⁠hal 190 paragraf 1-3 - ⁠hal 191 paragraf 3-4 - ⁠hal 192 paragraf 1-3 - ⁠hal 193 paragraf 1 6. italic yang english (sudah saya crosscheck, mohon bantuannya untuk dicek kembali)', '2026-05-13 09:45:39', '2026-05-13 11:48:04'),
(36, 19, '2026-05-04', 'dr. Ariza Julia Paulina, M.Biomed apt, Besse Hardianti, M.Pharm.Sc., Ph.D Dra. Shinta, M.S. Astuti Amin, S.Si., M.Sc Siti Nurkasanah, S.Si., M.Biomed dr. Sisca, M.Biomed Dr. Nurkhairo Hidayati, S.Pd., M.Pd Putri Widelia Welkriana, S.Si., M.Sc', 'Genetika Dasar', 'https://docs.google.com/document/d/1Z8ZRgfMqEa8bNl2VS0ZBB9GKt7TzQn0x7BTbfe7bHMo/edit?tab=t.0', 'Selesai', '1. Referensi semua gambar sebaiknya ditambah Lengkapi referensi daftar pustaka Referensi semua tabel ditambah Tambah referensi untuk Bab 4, 6 & 7', '2026-05-13 11:53:25', '2026-05-13 11:55:33'),
(39, 19, '2026-05-05', 'Dr. dr. Mutiara Indah Sari, M.Kes Dr. Masfufatun, M.Si', 'STRUKTUR DAN METABOLISME MAKROMOLEKUL', 'https://docs.google.com/document/d/1hjdO-Ba-GSh5eHRDdsorldThnMOnwzae/edit', 'Selesai', NULL, '2026-05-13 15:01:05', '2026-05-13 15:01:05'),
(40, 19, '2026-05-05', 'Dr. apt. Khairuddin, S.Si., M.Si Dr. Jafriati, S.Si., M.Si', 'BIOLOGI SEL:\r\nKonsep dan Teori', 'https://docs.google.com/document/d/1clOhws_vqOcq267hAJdEB22wuqvagz1M/edit', 'Selesai', NULL, '2026-05-13 15:04:54', '2026-05-13 15:04:54'),
(41, 19, '2026-05-13', 'Dr. drg. Dhona Afriza, M. Biomed', 'DAMPAK PAPARAN INHALASI METIL METAKRILAT TERHADAP MUKOSA HIDUNG DAN PARU-PARU', 'https://docs.google.com/document/d/1sXiM-dlEUueFwjoYxPbp_FNEeHW8ek3K/edit', 'Selesai', NULL, '2026-05-13 16:15:07', '2026-05-13 16:15:07'),
(42, 18, '2026-05-15', 'Dr dr Liliriawati Ananta Kahar SpAnTI SubSp TI', 'STRATEGIES FOR MANAGING MULTI-HAZARD DISASTERS FOR ANESTHESIOLOGISTS AND INTENSIVISTS', NULL, 'Selesai', 'Tolong tambahkan gambar di setiap bab (minimal 2 bab) dan parafrase', '2026-05-15 09:19:52', '2026-05-29 09:06:55'),
(43, 19, '2026-05-16', 'dr. Jojor Sihotang, Sp. OG, M. Ked. Klin', 'Buku Monograf Terapi Regeneratif untuk Fistula Vesikovaginalis', NULL, 'Selesai', 'Terdapat double referensi persis mohon bantuannya agar dapat dijadikan 1, karena takutnya jika dihapus manual di sini jadi berantakan, mengingat referensi di paragraf dan daftar pustaka menggunakan mendeley', '2026-05-16 14:15:45', '2026-05-16 14:15:45'),
(44, 19, '2026-05-16', 'Rasmaniar,SKM,M.Kes . dr. Lukman ,Sp.PD ,FINASIM', 'Referensi Surveilans Kesehatan Remaja dalam Pencegahan Stunting', NULL, 'Selesai', NULL, '2026-05-16 15:39:11', '2026-05-16 15:39:11'),
(45, 18, '2026-05-19', 'Dr. drg. Risyandi Anwar, Sp.KGA drg. Steffi Triany Arnov, Sp. Perio', 'MONOGRAF Kulit Manggis (Garcinia mangostana Linn) Penghambat Pertumbuhan Sel Kanker', NULL, 'Selesai', 'Catatan layout 26-05-13-Monograf Kulit Manggis (Garcinia mangostana Linn) Penghambat Pertumbuhan Sel Kanker: * gambar 1.1; 2.1;2.2;3.1;3.2;4.1;4.2;5.1;6.1;7.1;8.1;8.2;9.2;10.1 kurang jelas * ilustrasi gambar 4.2 sama dengan gambar 4.1 * ilustasi gambar 9.1 belum ada', '2026-05-19 16:28:40', '2026-05-30 15:39:18'),
(46, 18, '2026-05-26', 'Atna Permana, M. Biomed, PhD', 'KULIT MANGGIS DAN TEROBOSAN BARU TERAPI ANTIBAKTERI', NULL, 'On Progress', '*Coba Check sitasinya di daftar buku dan daftar pustaka*', '2026-05-26 13:48:59', '2026-06-02 11:10:16'),
(47, 19, '2026-05-28', 'Prof.Dr.dr.Dewi Masyithah Darlan, DAP&E, MPH, Sp.ParK Prof. Dr. dr. Rodiah Rahmawaty Lubis M.Ked(Oph)., Sp.M(K) Prof. Dr. dr. Nelva Karmila Jusuf Sp.D.V.E., Subs. D.K.E., FINSDV, FAADV Prof Dr dr Sry Suryani Widjaja, MKes, Sp KKLP', 'PARASITIC INFESTATION\\ OF THE EYE AND SKIN: A MULTIDISCIPLINARY CLINICAL APPROACH', NULL, 'Selesai', 'unit 2 dan unit 4', '2026-05-28 13:06:15', '2026-05-28 13:06:15'),
(48, 18, '2026-06-02', 'Desi Aryani, S.Tr.Kes., SE., MA', 'IDENTIFIKASI GEN PLASMODIUM LACTATE DEHYDROGENASE (pLDH) PADA PLASMODIUM VIVAX', NULL, 'Draft', 'Tolong direvisi sesuai catatan', '2026-06-02 14:39:59', '2026-06-02 14:39:59');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('pt-anoa-sejahtera-mandiri-cache-abbyiindika@gmail.con|2001:448a:7160:3a95:55e0:4db9:216a:4b97', 'i:1;', 1780444695),
('pt-anoa-sejahtera-mandiri-cache-abbyiindika@gmail.con|2001:448a:7160:3a95:55e0:4db9:216a:4b97:timer', 'i:1780444695;', 1780444695),
('pt-anoa-sejahtera-mandiri-cache-msytasantika@gmail.com|180.245.112.214', 'i:2;', 1778461772),
('pt-anoa-sejahtera-mandiri-cache-msytasantika@gmail.com|180.245.112.214:timer', 'i:1778461772;', 1778461772),
('pt-anoa-sejahtera-mandiri-cache-msytasantika@gmail.com|2001:448a:7160:52c0:900d:98dd:1814:2bc0', 'i:1;', 1778632393),
('pt-anoa-sejahtera-mandiri-cache-msytasantika@gmail.com|2001:448a:7160:52c0:900d:98dd:1814:2bc0:timer', 'i:1778632393;', 1778632393);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL
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
  `attempts` smallint(5) UNSIGNED NOT NULL,
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
-- Table structure for table `leave_requests`
--

CREATE TABLE `leave_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `reason` text NOT NULL,
  `proof_file` varchar(255) DEFAULT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manuscripts`
--

CREATE TABLE `manuscripts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `author_name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `journal` varchar(255) NOT NULL,
  `docs_link` text DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `manuscripts`
--

INSERT INTO `manuscripts` (`id`, `user_id`, `author_name`, `title`, `journal`, `docs_link`, `status`, `description`, `photo`, `created_at`, `updated_at`) VALUES
(39, 19, 'Mubarak1*, Tri Baskoro Tunggul Satoto2', 'Laboratory Evaluation of a Non-Insecticide Multimodal Trap Using Carbon Dioxide, Lactic Acid, Ultraviolet-A Light, and Sound Frequency for Aedes aegypti Control', 'https://jad.tums.ac.ir/index.php/jad', NULL, 'Submitted', NULL, 'manuscripts/4Wbx8suQ8xlPjNgjum6tPODcauTAXModwIFOS3lO.png', '2026-05-21 15:07:13', '2026-05-21 15:07:13'),
(40, 19, 'Rasmaniar', 'Risk Factors of Stunting among Toddlers Aged 6–36 Months in a Coastal Community of Soropia, Indonesia: A Case-Control Study', 'https://jnhrc.com.np/', NULL, 'On Progress', 'EC tidak berlaku', 'manuscripts/QHM6bq9djxQkmIwOJwDSpMKI0TrubQK7STuUkWxF.png', '2026-05-21 15:12:23', '2026-06-03 10:12:21'),
(41, 19, 'Mubarak1*, Tri Baskoro Tunggul Satoto2', 'Natural versus Synthetic Repellents for Aedes aegypti: A Systematic Review and Meta-Analysis of Efficacy and Protection Duration', 'https://jad.tums.ac.ir/index.php/jad', NULL, 'Submitted', NULL, 'manuscripts/92NzNqY2KdL7uE4XRFtvV8HFyjvmJV5bVY4CUIhl.png', '2026-05-29 09:23:45', '2026-06-03 10:21:55'),
(42, 19, 'Tiara Muslimah Jamal1, Sartiah DP.2*, I Made Christian B3', 'Association of Sociocultural Factors and Health Literacy Levels with Cervical Cancer Early Detection among Women in Reproductive-Age Couples in the Service Area of the Laosu Community Health Center in 2025', 'via email IJCSRR', NULL, 'Submitted', NULL, NULL, '2026-06-02 08:51:10', '2026-06-02 08:51:10'),
(43, 19, 'Mubarak1*, Tri Baskoro Tunggul Satoto2', 'Plant-Derived Repellents Against Aedes aegypti for Sustainable Vector Control: A Systematic Review and Meta-Analysis', 'https://li01.tci-thaijo.org/index.php/cast', NULL, 'Submitted', NULL, 'manuscripts/LFLVdsyVrYLEgWK8XaD85EkY0FYqlcDeSim4llJL.png', '2026-06-03 10:24:02', '2026-06-03 10:24:02'),
(44, 19, 'La Rangki1*, Kadek Ayu Erika2, Rusdina Bte Ladju3', 'Complications, Risk Factors, and Quality of Life after Intestinal Stoma Formation: A Systematic Review and Meta-Analysis', 'https://tjs.manuscriptmanager.net/sLib/v4/authordash.php', NULL, 'Submitted', NULL, 'manuscripts/bSSXS1lMLbF7pqdOBr4KWQTC7sQz8LM3rsH69Yub.png', '2026-06-03 10:25:52', '2026-06-03 10:25:52'),
(45, 19, 'Yoifah Rizka Wedarti1,2*, Soetjipto3, Agung Krismariono4', 'Therapeutic Effects of Hyperbaric Oxygen Therapy on Amyloid-β, Tau, and Spatial Working Memory in a Porphyromonas gingivalis-Induced Neurodegeneration Model', 'https://mjmhs.upm.edu.my/', NULL, 'Submitted', NULL, NULL, '2026-06-03 10:28:09', '2026-06-03 10:28:09'),
(46, 19, 'Rima Anggraini Asbar1', 'Screening, Identification, and Medical-Psychological Services for Domestic Violence Survivors in Inpatient Primary Health Centers in Kendari City', 'via email IJCSRR', NULL, 'Submitted', 'email corresponding author', NULL, '2026-06-03 15:04:50', '2026-06-04 10:08:57'),
(47, 20, 'Fani Pangabdian', 'CBCT-Guided Multidisciplinary Management of Heithersay Class III Invasive Cervical Resorption Using Bioceramic Materials and Injectable Composite: A Case Report', 'https://fid.tums.ac.ir/index.php/fid/index', NULL, 'On Progress', NULL, 'manuscripts/PbpMGcpNt43QEog4Fy4W7QKqEAGNGfMY6JVTq2Je.png', '2026-06-03 15:13:25', '2026-06-03 15:13:25');

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
(4, '2026_05_05_025327_add_role_to_users_table', 2),
(5, '2026_05_05_030411_create_attendances_table', 3),
(6, '2026_05_05_112218_create_work_progress_table', 4),
(7, '2026_05_05_112304_create_work_files_table', 4),
(8, '2026_05_05_114228_create_leave_requests_table', 5),
(9, '2026_05_06_161922_create_manuscripts_table', 6),
(10, '2026_05_06_165215_add_photo_to_manuscripts_table', 7),
(11, '2026_05_08_112619_create_books_table', 8),
(12, '2026_05_08_161426_add_is_read_to_leave_requests_table', 9),
(13, '2026_05_09_074420_add_docs_link_to_manuscripts_table', 10),
(14, '2026_05_09_080342_add_docs_link_to_books_table', 11);

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
('7jaKpMRIQYLGoEc7h959osxVdAx4pvIu5u1wuax6', NULL, '2405:9800:b660:698e:c0b8:6015:39df:8a79', 'Python/3.14 aiohttp/3.13.3', 'eyJfdG9rZW4iOiJkUzBKSEJiNjVGRWM1NzNWZGdYZVNuUWc5b2xFZG10ZGNtM05nc1U1IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9hbm9hc2VqYWh0ZXJhbWFuZGlyaS5jb20iLCJyb3V0ZSI6bnVsbH0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1780536807),
('bNMLeXDRDUAMLDdr2KtGVHLHaPEStwuAQ9bkQZjC', 20, '2001:448a:7160:312:c519:a58:9e31:1fd2', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.4 Mobile/15E148 Safari/604.1', 'eyJfdG9rZW4iOiJ1aUdGTklvZ2hRRndHVkxPTEtObVByMkpFNmpyR2VnSms2WUxub3NNIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9hbm9hc2VqYWh0ZXJhbWFuZGlyaS5jb21cL2Rhc2hib2FyZCIsInJvdXRlIjoiZGFzaGJvYXJkIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjIwfQ==', 1780531238),
('bZcrSWQttIk3PUifZCzYxgEIYcSlxyn6gtqxaTfx', NULL, '74.7.228.187', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36; compatible; OAI-SearchBot/1.4; +https://openai.com/searchbot', 'eyJfdG9rZW4iOiJaTW5VbndzN2VnajFMQjc3QkRBTlNBOGU4UWxMalJvS09uZUQ2YWN2IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC93d3cuYW5vYXNlamFodGVyYW1hbmRpcmkuY29tXC9yZWdpc3RlciIsInJvdXRlIjoicmVnaXN0ZXIifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1780538037),
('DNxd7WWXu96kqTLEwouYGqQ8DejOcJ50seNiX3Cl', 18, '2001:448a:7160:312:b4df:92b7:49b:f3db', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJvMUhzYzl3VEwwRWtBMGtDd3l3Z0V0dVZpQUhlS3dNajljRDZvRmd4IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9hbm9hc2VqYWh0ZXJhbWFuZGlyaS5jb21cL2Rhc2hib2FyZCIsInJvdXRlIjoiZGFzaGJvYXJkIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjE4fQ==', 1780531358),
('E3o5rrKk79ivqjMmZYp5XpCczjbveVfygzdnnR83', NULL, '70.153.76.29', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko); compatible; ChatGPT-User/1.0; +https://openai.com/bot', 'eyJfdG9rZW4iOiJpSDJoWERoT0NTeTdweTlWaWZOS25EamszWTR2bGxHTlpQalJoT0taIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC93d3cuYW5vYXNlamFodGVyYW1hbmRpcmkuY29tXC9sb2dpbiIsInJvdXRlIjoibG9naW4ifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1780538041),
('FrVEw039Tcd5qJuFY3fEIipF7iot3AiqfwHnN9yo', 19, '2001:448a:7160:312:80bc:af8b:fcd9:b1b', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJheXg4b0Z6bzRBSm5ITVM2YklmamZvT1hFMDIybXo0Y29KQmRzSUhCIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cHM6XC9cL2Fub2FzZWphaHRlcmFtYW5kaXJpLmNvbVwvbWFudXNjcmlwdHMiLCJyb3V0ZSI6Im1hbnVzY3JpcHRzLmluZGV4In0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoxOX0=', 1780538937),
('Ktl3Ih7iHPr8Xg9Agi10Z2biknnaxP97gNj5fiF7', NULL, '2001:448a:7160:312:c519:a58:9e31:1fd2', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.4 Mobile/15E148 Safari/604.1', 'eyJfdG9rZW4iOiJkNXlscm9NM0tXbUJXcGxWN25QdWh3S1ZSMEJCUUtkYUZ2S1JGdTd4IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9hbm9hc2VqYWh0ZXJhbWFuZGlyaS5jb21cL2xvZ2luIiwicm91dGUiOiJsb2dpbiJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1780535677),
('ktYEByBbb4GctkGBPaZusiov3eV9TTSw71160WnB', NULL, '70.153.76.26', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko); compatible; ChatGPT-User/1.0; +https://openai.com/bot', 'eyJfdG9rZW4iOiI5cTIxN0lQTVBPZkd2dHpRTmJQbDdwVmQzSGRmUWtWRnE2ZjN2SzZHIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC93d3cuYW5vYXNlamFodGVyYW1hbmRpcmkuY29tIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1780537974),
('LPG5URX1X3qD71wTuzR6KL7FobWNVqmobOCWOpuU', NULL, '70.153.76.29', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko); compatible; ChatGPT-User/1.0; +https://openai.com/bot', 'eyJfdG9rZW4iOiJKc1VCVmFNNVhub3I4aXVMT3hiYVpFVnhwbEZPYUwzQ3NlTVhyTzlBIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9hbm9hc2VqYWh0ZXJhbWFuZGlyaS5jb20iLCJyb3V0ZSI6bnVsbH0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1780538046),
('NhbrjvrWnryL2o9LQyKVxZSqKXnDL8vdjGQk63HB', NULL, '93.123.109.102', '', 'eyJfdG9rZW4iOiJicnQyMFAycElxMXIzV0JlYm9LN2hxcXJ4NmxoVGRKaWxCcU1jUnl0IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9hbm9hc2VqYWh0ZXJhbWFuZGlyaS5jb20iLCJyb3V0ZSI6bnVsbH0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1780530277),
('O7UKyFbyWQswauFfrytPdNZ6Y0qJJgXAoozjR4bd', NULL, '2001:448a:7160:312:c519:a58:9e31:1fd2', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/26.4 Mobile/15E148 Safari/604.1', 'eyJfdG9rZW4iOiJtYUxIT0JEdUFTRmZrb0JxMDdFVmVOQndZdHpTU1dQYjFhVFRuR2ZaIiwidXJsIjp7ImludGVuZGVkIjoiaHR0cHM6XC9cL2Fub2FzZWphaHRlcmFtYW5kaXJpLmNvbVwvZGFzaGJvYXJkIn0sIl9wcmV2aW91cyI6eyJ1cmwiOiJodHRwczpcL1wvYW5vYXNlamFodGVyYW1hbmRpcmkuY29tXC9sb2dpbiIsInJvdXRlIjoibG9naW4ifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119fQ==', 1780535658),
('RJlwMkPCOlFewHm6mjOywP5LYNXUlnO2PPpcbT6P', NULL, '74.7.228.193', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36; compatible; OAI-SearchBot/1.4; +https://openai.com/searchbot', 'eyJfdG9rZW4iOiJtQ1ZoMG0zYVBjR21BSkxiMTVrZjdqdVNxTGdIcEdZVkZ1RUZlN255IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC93d3cuYW5vYXNlamFodGVyYW1hbmRpcmkuY29tIiwicm91dGUiOm51bGx9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1780538011),
('S4eyls4xNaUyWcWQZy05P5rcLZY3kE14UrenjnaB', NULL, '2001:448a:7160:312:dd7e:e68b:db55:c2d8', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiI1M01IQ3JoaVNyRkdObkxHOGFqU2pNWDQzYzB5NnNNUTc3Mmx5ZGNpIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9hbm9hc2VqYWh0ZXJhbWFuZGlyaS5jb20iLCJyb3V0ZSI6bnVsbH0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1780538223),
('x2L6nlkcGazh735EGGxIqYlMqio0io5uKpsw1GCF', 17, '2001:448a:7160:312:dd7e:e68b:db55:c2d8', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'eyJfdG9rZW4iOiI0bTI2ZUtiS3hPNWZYQkE2SDJpS3Ixc1RjemNkbEJvOGVETmdKVWRPIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHBzOlwvXC9hbm9hc2VqYWh0ZXJhbWFuZGlyaS5jb21cL2Rhc2hib2FyZCIsInJvdXRlIjoiZGFzaGJvYXJkIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjE3fQ==', 1780534863);

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
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'tes', 'tes@gmail.com', NULL, '$2y$12$9GfyuqmZh0hwgVt.2.JyQO/MDwwFLVUhVN5R8/rNx/pv15L/x7tnm', NULL, '2026-05-04 18:49:19', '2026-05-04 18:49:19', 'admin'),
(5, 'anoa sejahtera', 'anoasejahtera238@gmail.com', NULL, '$2y$12$zmH3MdLdO0iMyK0jeQvKfOdmyiRsCk0skrDU3Qr3VR3KT0PY/566S', NULL, '2026-05-05 03:40:37', '2026-05-08 10:08:12', 'admin'),
(16, 'Mubarak', 'mubarak@uho.ac.id', NULL, '$2y$12$JZQ.41D6d2xGhQbeY4R60.jr2YWoHSqu.6bnN2lUwjCF0Hjl0NoKu', 'bEVkxUORI3YVXyUdjZjvIJ2L6eUKyoredurzAwFf3sJMajgsuMZMRpBjCBjx', '2026-05-09 17:13:40', '2026-05-09 17:13:50', 'admin'),
(17, 'Nurul Fatimah', 'nurulftmh085@gmail.com', NULL, '$2y$12$DpbNAnu5bD7DQLCyRtOfhegiirrgJ7GsbZK1MDeXXQnkG5UZBoK4a', NULL, '2026-05-09 18:13:08', '2026-05-09 18:13:08', 'user'),
(18, 'Masita Oktolara Santika', 'msytasantika@gmail.com', NULL, '$2y$12$ocWE1N7fONQ9NUFW6vfQuuo70tKD7u985/JlgkibwiwiU8Y/WRFy6', NULL, '2026-05-11 09:11:49', '2026-05-13 16:48:15', 'user'),
(19, 'Yuni Maulidya Kaplale', 'ymaulidya66@gmail.com', NULL, '$2y$12$OrO//g5/RPR5zdhcerCrYeIYJ5eU/yAkYwEXWPT3jHUqebwfBk55K', '4lm1wIO0Ssg05G2bPFd6dzaOhlZMZwrNo9S2JvCZ3POaqSQoLAMxi3w4u8jR', '2026-05-12 15:06:52', '2026-05-12 15:06:52', 'user'),
(20, 'Abby Indika Risdiani Batubara', 'abbyiindika@gmail.com', NULL, '$2y$12$htAomhNS3QgolX7uJlZky.EeLxDPqxPWUBn.K9Q0zDCfUmGqelldO', NULL, '2026-06-02 08:03:08', '2026-06-02 08:03:08', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `work_files`
--

CREATE TABLE `work_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `work_progress_id` bigint(20) UNSIGNED NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `work_files`
--

INSERT INTO `work_files` (`id`, `work_progress_id`, `file_path`, `file_name`, `created_at`, `updated_at`) VALUES
(10, 9, 'work-files/hljJSgDzqGlVY97dKaxSiaSP1XiiDRUdb7jT7rmI.docx', 'Manuscript.docx', '2026-05-12 18:07:52', '2026-05-12 18:07:52'),
(11, 13, 'work-files/vlLKK6585QwiQVzJnWPXwhBnaojPzXEd9rOBhIoh.docx', 'manuscript.docx', '2026-05-13 16:58:25', '2026-05-13 16:58:25'),
(12, 15, 'work-files/ZTXT00y037IC7IMZJoiL6mZlu7YvskY8Z1MQktOl.docx', 'BDS_Title_Page_Filled_v2.docx', '2026-05-15 16:59:27', '2026-05-15 16:59:27'),
(13, 15, 'work-files/VNLMYZOKyXJYFMRuTWO7Q8Zueptem2xqREaSoaWW.pdf', 'Copyright_20260515_0001.pdf', '2026-05-15 16:59:27', '2026-05-15 16:59:27'),
(14, 15, 'work-files/MwoHDNDmJZzmjuwLKchzak7Yx6XU4wJYpAsUAryn.docx', 'Cover Letter_BDS.docx', '2026-05-15 16:59:27', '2026-05-15 16:59:27'),
(15, 15, 'work-files/KuNhYv9UG6TXa9EuiFMf0rNn9AAoVth8gazK1tHi.png', 'Figure.png', '2026-05-15 16:59:27', '2026-05-15 16:59:27'),
(16, 15, 'work-files/iqzQpCgNx0T28hITZ1aNmwV7MWNv87X8iO0hcC37.docx', 'Manuscript BDS.docx', '2026-05-15 16:59:27', '2026-05-15 16:59:27'),
(17, 15, 'work-files/r3cZJuSba2zLohiwF1T0k07vU637VMJHlvQBsPI1.docx', 'Table.docx', '2026-05-15 16:59:27', '2026-05-15 16:59:27'),
(18, 24, 'work-files/0T685aZlRkcZ7yC0NBN4Nm9rck835FHnhkNrtNEJ.png', 'Screenshot 2026-05-22 144307.png', '2026-05-23 11:19:45', '2026-05-23 11:19:45'),
(19, 25, 'work-files/TgFbKszPaqn4e2KFZPI5QWmXvNozifUJqTLAZrq7.docx', 'Main_Manuscript.docx', '2026-05-25 15:21:30', '2026-05-25 15:21:30'),
(20, 28, 'work-files/pwL27Rdto49na24yOMPykPQNckhgESUP5RTfqDah.docx', 'Main_Manuscript.docx', '2026-05-28 17:58:04', '2026-05-28 17:58:04'),
(21, 32, 'work-files/tquMMuGLcgBF3cEIwJ9ZxpQFDW9E33ByhXxsFkTx.docx', 'Manuscript FID.docx', '2026-06-03 15:19:22', '2026-06-03 15:19:22');

-- --------------------------------------------------------

--
-- Table structure for table `work_progresses`
--

CREATE TABLE `work_progresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `attendance_id` bigint(20) UNSIGNED NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `work_progresses`
--

INSERT INTO `work_progresses` (`id`, `attendance_id`, `description`, `created_at`, `updated_at`) VALUES
(9, 44, '1. mengerjakan manuscript ibu narmawan', '2026-05-12 18:07:52', '2026-05-12 18:07:52'),
(10, 45, 'menyelesaikan revisi buku Monograf Dampak Paparan Inhalasi Metil Metakrilat terhadap Mukosa Hidung dan Paru-paru', '2026-05-13 16:19:02', '2026-05-13 16:19:02'),
(11, 45, 'menyelesaikan revisi buku Monograf Terapi Regeneratif untuk Fistula Vesikovaginalis', '2026-05-13 16:21:27', '2026-05-13 16:21:27'),
(12, 46, 'a) Mensitasi buku menggunakan Mendeley (mencari, dan menyematkan sitasi) ke dalam daftar pustaka\r\nb) Menyusun dan menyelesaikan 3 sub buku dengan judul sub-bab:\r\n1. Patologi Ilmiah\r\n2. Histologi\r\n3. Biomedik 2', '2026-05-13 16:46:42', '2026-05-13 16:46:42'),
(13, 47, 'mengerjakan manuscript yoifah 1 berjudul \"Hyperbaric Oxygen Therapy Improves Spatial Working Memory in a Porphyromonas gingivalis-Induced Periodontitis Rat Model\"', '2026-05-13 16:58:25', '2026-05-13 16:58:25'),
(14, 49, 'Menyelesaikan sitasi buku Prof. Dr. Malik Saepudin,S.K.M., M.Kes', '2026-05-15 16:57:35', '2026-05-15 16:57:35'),
(15, 48, 'submit manuscript ibu yoifah', '2026-05-15 16:59:27', '2026-05-15 16:59:27'),
(16, 50, 'mencari jurnal yang sesuai dengan manuscript Use of Physical Attractants and Chemical Attractants in Controlling the Aedes aegypti Vector. penulis: Mubarak, Tri Baskoro Tunggul Satoto', '2026-05-15 17:07:46', '2026-05-15 17:07:46'),
(17, 52, 'menyelesaikan revisi draft buku Monograf Terapi Regeneratif untuk Fistula Vesikovaginalis (round 2)', '2026-05-16 14:14:26', '2026-05-16 14:14:26'),
(18, 52, 'menyelesaikan revisi draft buku Surveilans Kesehatan remaja dalam Pencegahan Stunting', '2026-05-16 15:36:18', '2026-05-16 15:36:18'),
(19, 52, 'menyelesaikan revisi manuscript Development and Laboratory Evaluation of a Non-Insecticide Multimodal Trap for Aedes aegypti Vector Control, penulis : Mubarak,1* Tri Baskoro Tunggul Satoto2', '2026-05-16 15:37:37', '2026-05-16 15:37:37'),
(20, 53, 'memcari jurnal tujuan scopus Q2-Q3 untuk manuscript', '2026-05-16 16:31:54', '2026-05-16 16:32:04'),
(21, 51, 'Finalisasi Revisi sitasi buku Malik Saepudin, menyusun sub-bab buku masing-masing yang terdiri dari 20 bab buku. dengan judul:\r\n1. Kesehatan Reproduksi Remaja : Konsep dan Teori\r\n2. Kesehatan Lingkungan Pesisir dan Perdesaan : Teori dan Aplikasi', '2026-05-16 16:33:15', '2026-05-16 16:33:15'),
(22, 63, 'melakukan submit manuscript Laboratory Evaluation of a Non-Insecticide Multimodal Trap Using Carbon Dioxide, Lactic Acid, Ultraviolet-A Light, and Sound Frequency for Aedes aegypti Control, Journal of Arthropod-Borne Diseases (Mubarak1*, Tri Baskoro Tunggul Satoto2)', '2026-05-21 15:01:34', '2026-05-21 15:01:34'),
(23, 63, 'menyelesaikan revisi manuscript Risk Factors of Stunting among Toddlers Aged 6–36 Months in a Coastal Community of Soropia, Indonesia: A Case-Control Study, Journal of Nepal Health Research Council (Rasmaniar)', '2026-05-21 16:52:56', '2026-05-21 16:53:10'),
(24, 69, 'melakukan submit manuscript \"Plant-Derived Repellents Against Aedes aegypti for Sustainable Vector Control: A Systematic Review and Meta-Analysis\", CURRENT APPLIED SCIENCE AND TECHNOLOGY (Mubarak1*, Tri Baskoro Tunggul Satoto2)', '2026-05-23 11:19:45', '2026-05-23 11:19:45'),
(25, 74, 'menyelesaikan revisi manuscript \"Laboratory Evaluation of a Non-Insecticide Multimodal Trap Using Carbon Dioxide, Lactic Acid, Ultraviolet-A Light, and Sound Frequency for Aedes aegypti Control\" dari editor Journal of Arthropod-Borne Diseases', '2026-05-25 15:21:30', '2026-05-25 15:21:30'),
(26, 75, 'melakukan submit manuscript ibu Yoifah 2', '2026-05-26 16:49:09', '2026-05-26 16:49:09'),
(27, 79, 'menyelesaikan revisi buku Parasitic Infestation of the Eye and Skin', '2026-05-28 13:04:59', '2026-05-28 13:04:59'),
(28, 78, 'melakukan submit manuscript \"Natural versus Synthetic Repellents for Aedes aegypti: A Systematic Review and Meta-Analysis of Efficacy and Protection Duration\" di JAD', '2026-05-28 17:58:04', '2026-05-28 17:58:24'),
(29, 89, 'melakukan submit manuscript \"Association of Sociocultural Factors and Health Literacy Levels with Cervical Cancer Early Detection among Women in Reproductive-Age Couples in the Service Area of the Laosu Community Health Center in 2025\" (Tiara, Sartiah DP) via email IJCSRR', '2026-06-02 08:49:24', '2026-06-02 08:49:24'),
(30, 89, 'menyelesaikan revisi manuscript Bapak Mubarak (CAST)', '2026-06-02 15:14:37', '2026-06-02 15:14:37'),
(31, 93, 'melakukan submit manuscript \"Complications, Risk Factors, and Quality of Life after Intestinal Stoma Formation: A Systematic Review and Meta-Analysis\" (La Rangki) TJS', '2026-06-03 10:10:35', '2026-06-03 10:10:35'),
(32, 94, 'Hari ini saya melakukan pengecekan lengkap terhadap jurnal Frontiers in Dentistry (FID), mencakup scope, tipe artikel, biaya publikasi, format referensi, dan persyaratan submit. Manuscript telah direvisi sesuai guideline jurnal, termasuk blind manuscript, title page, cover letter, abstract <150 kata, dan Vancouver numbered style. Saya juga menyiapkan dokumen tambahan seperti patient consent template, AI disclosure, serta mengecek berkas yang masih perlu dilengkapi sebelum submit.', '2026-06-03 15:19:22', '2026-06-03 15:19:22'),
(33, 91, 'Proses kerja manuscript pak Fani', '2026-06-03 17:07:16', '2026-06-03 17:07:16'),
(34, 92, 'Mensitasi buku pak Atna Permana', '2026-06-03 17:10:11', '2026-06-03 17:10:11'),
(35, 97, 'melakukan submit manuscript via email IJCSRR (Screening, Identification, and Medical-Psychological Services for Domestic Violence Survivors in Inpatient Primary Health Centers in Kendari City)', '2026-06-04 10:06:34', '2026-06-04 10:06:34');

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
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `books_user_id_foreign` (`user_id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

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
-- AUTO_INCREMENT for table `leave_requests`
--
ALTER TABLE `leave_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `manuscripts`
--
ALTER TABLE `manuscripts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `work_files`
--
ALTER TABLE `work_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `work_progresses`
--
ALTER TABLE `work_progresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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
