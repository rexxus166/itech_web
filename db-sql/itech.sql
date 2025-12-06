-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Bulan Mei 2025 pada 17.17
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `itech`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'admin@gmail.com', '$2y$10$D9s0HH/fdyt0jTPRl3DBNuHV4Vx51dKsc3UFKc4jaQ5/hlmXVa8K.', '2025-05-15 23:55:35', '2025-05-15 23:55:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `answers`
--

CREATE TABLE `answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `answer_text` text NOT NULL,
  `pembahasan` text DEFAULT NULL,
  `option` varchar(1) DEFAULT NULL,
  `is_correct` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `answers`
--

INSERT INTO `answers` (`id`, `question_id`, `answer_text`, `pembahasan`, `option`, `is_correct`, `created_at`, `updated_at`) VALUES
(9, 4, 'A', NULL, 'A', 0, '2025-05-16 02:41:45', '2025-05-16 02:44:30'),
(10, 4, 'B', NULL, 'B', 0, '2025-05-16 02:41:45', '2025-05-16 02:44:30'),
(11, 4, 'C', NULL, 'C', 1, '2025-05-16 02:41:45', '2025-05-16 02:44:30'),
(12, 4, 'D', NULL, 'D', 0, '2025-05-16 02:41:45', '2025-05-16 02:44:30'),
(13, 5, 'A', NULL, 'A', 0, '2025-05-16 02:44:47', '2025-05-16 06:02:14'),
(14, 5, 'B', NULL, 'B', 0, '2025-05-16 02:44:47', '2025-05-16 06:02:14'),
(15, 5, 'C', NULL, 'C', 0, '2025-05-16 02:44:47', '2025-05-16 06:02:14'),
(16, 5, 'D', NULL, 'D', 1, '2025-05-16 02:44:47', '2025-05-16 06:02:14'),
(21, 7, 'a', NULL, 'A', 1, '2025-05-16 05:36:26', '2025-05-16 06:02:24'),
(22, 7, 'b', NULL, 'B', 0, '2025-05-16 05:36:26', '2025-05-16 06:02:24'),
(23, 7, 'c', NULL, 'C', 0, '2025-05-16 05:36:26', '2025-05-16 06:02:24'),
(24, 7, 'd', NULL, 'D', 0, '2025-05-16 05:36:26', '2025-05-16 06:02:24'),
(25, 8, 'A', NULL, 'A', 1, '2025-05-16 05:45:14', '2025-05-16 06:01:40'),
(26, 8, 'B', NULL, 'B', 0, '2025-05-16 05:45:14', '2025-05-16 06:01:40'),
(27, 8, 'C', NULL, 'C', 0, '2025-05-16 05:45:14', '2025-05-16 06:01:40'),
(28, 8, 'D', NULL, 'D', 0, '2025-05-16 05:45:14', '2025-05-16 06:01:40'),
(29, 9, 'a', NULL, 'A', 0, '2025-05-16 05:47:09', '2025-05-16 06:01:26'),
(30, 9, 'b', NULL, 'B', 0, '2025-05-16 05:47:09', '2025-05-16 06:01:26'),
(31, 9, 'c', NULL, 'C', 1, '2025-05-16 05:47:09', '2025-05-16 06:01:26'),
(32, 9, 'd', NULL, 'D', 0, '2025-05-16 05:47:09', '2025-05-16 06:01:26'),
(33, 10, 'a', NULL, 'A', 1, '2025-05-16 06:28:54', '2025-05-16 06:31:38'),
(34, 10, 'b', NULL, 'B', 0, '2025-05-16 06:28:54', '2025-05-16 06:31:38'),
(35, 10, 'c', NULL, 'C', 0, '2025-05-16 06:28:54', '2025-05-16 06:31:38'),
(36, 10, 'd', NULL, 'D', 0, '2025-05-16 06:28:54', '2025-05-16 06:31:38'),
(37, 11, 'a', NULL, 'A', 1, '2025-05-16 06:33:34', '2025-05-16 06:33:34'),
(38, 11, 'b', NULL, 'B', 0, '2025-05-16 06:33:34', '2025-05-16 06:33:34'),
(39, 11, 'c', NULL, 'C', 0, '2025-05-16 06:33:34', '2025-05-16 06:33:34'),
(40, 11, 'd', NULL, 'D', 0, '2025-05-16 06:33:34', '2025-05-16 06:33:34'),
(41, 12, 'a', NULL, 'A', 0, '2025-05-16 06:48:39', '2025-05-16 06:48:39'),
(42, 12, 'b', NULL, 'B', 1, '2025-05-16 06:48:39', '2025-05-16 06:48:39'),
(43, 12, 'c', NULL, 'C', 0, '2025-05-16 06:48:39', '2025-05-16 06:48:39'),
(44, 12, 'd', NULL, 'D', 0, '2025-05-16 06:48:39', '2025-05-16 06:48:39'),
(45, 13, 'a', NULL, 'A', 0, '2025-05-16 06:49:00', '2025-05-16 06:49:00'),
(46, 13, 'b', NULL, 'B', 1, '2025-05-16 06:49:00', '2025-05-16 06:49:00'),
(47, 13, 'c', NULL, 'C', 0, '2025-05-16 06:49:00', '2025-05-16 06:49:00'),
(48, 13, 'd', NULL, 'D', 0, '2025-05-16 06:49:01', '2025-05-16 06:49:01'),
(49, 14, 'a', NULL, 'A', 1, '2025-05-16 06:55:49', '2025-05-16 07:46:34'),
(50, 14, 'b', NULL, 'B', 0, '2025-05-16 06:55:49', '2025-05-16 07:46:34'),
(51, 14, 'c', NULL, 'C', 0, '2025-05-16 06:55:49', '2025-05-16 07:46:34'),
(52, 14, 'd', NULL, 'D', 0, '2025-05-16 06:55:49', '2025-05-16 07:46:34'),
(53, 15, 'a', NULL, 'A', 1, '2025-05-16 07:40:44', '2025-05-16 07:40:59'),
(54, 15, 'b', NULL, 'B', 0, '2025-05-16 07:40:44', '2025-05-16 07:40:59'),
(55, 15, 'c', NULL, 'C', 0, '2025-05-16 07:40:44', '2025-05-16 07:40:59'),
(56, 15, 'd', NULL, 'D', 0, '2025-05-16 07:40:44', '2025-05-16 07:40:59'),
(57, 16, 'a', NULL, 'A', 1, '2025-05-16 07:44:10', '2025-05-16 07:44:10'),
(58, 16, 'b', NULL, 'B', 0, '2025-05-16 07:44:10', '2025-05-16 07:44:10'),
(59, 16, 'c', NULL, 'C', 0, '2025-05-16 07:44:10', '2025-05-16 07:44:10'),
(60, 16, 'd', NULL, 'D', 0, '2025-05-16 07:44:10', '2025-05-16 07:44:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `artikels`
--

CREATE TABLE `artikels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `isi` text NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `author` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `feedback`
--

CREATE TABLE `feedback` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pesan` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `frameworks`
--

CREATE TABLE `frameworks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `features` text NOT NULL,
  `code` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `gambars`
--

CREATE TABLE `gambars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_04_18_023905_create_frameworks_table', 1),
(6, '2025_04_18_152953_add_role_to_users_table', 1),
(7, '2025_04_25_162002_create_admins_table', 1),
(8, '2025_04_25_165018_create_artikels_table', 1),
(9, '2025_04_25_165202_create_gambars_table', 1),
(10, '2025_04_25_165341_create_courses_table', 1),
(11, '2025_04_25_165359_create_feedback_table', 1),
(12, '2025_04_25_165414_create_postingan_users_table', 1),
(13, '2025_05_01_131650_add_google_id_to_users_table', 1),
(14, '2025_05_02_172427_add_slug_and_gambar_to_artikels_table', 1),
(15, '2025_06_01_000001_create_quizzes_table', 2),
(16, '2025_06_01_000002_create_questions_table', 2),
(17, '2025_06_01_000003_create_answers_table', 2),
(18, '2025_06_01_000004_create_user_answers_table', 2),
(19, '2025_06_01_000005_create_quiz_attempts_table', 2),
(20, '2025_06_01_000006_add_correct_incorrect_counts_to_quiz_attempts', 2),
(21, '2025_06_02_000001_add_date_to_quizzes_table', 3),
(22, '2025_06_02_000002_add_option_to_answers_table', 4),
(23, '2025_06_03_000001_add_pembahasan_to_quizzes_table', 5),
(24, '2025_06_03_000002_add_pembahasan_to_questions_table', 6),
(25, '2025_06_03_000003_add_pembahasan_to_answers_table', 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `postingan_users`
--

CREATE TABLE `postingan_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `konten` text NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `postingan_users`
--

INSERT INTO `postingan_users` (`id`, `judul`, `konten`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 'Judul Postingan', 'Konten Postingan', 1, '2025-05-16 00:12:21', '2025-05-16 00:12:21'),
(3, 'ets', 'tes', 2, '2025-05-16 04:04:07', '2025-05-16 04:04:07'),
(4, 'Postingan User', 'isi konten user', 2, '2025-05-16 06:05:34', '2025-05-16 06:05:34'),
(5, 'Tes Judul Postingan', 'Ini isi postingan', 3, '2025-05-16 06:44:43', '2025-05-16 06:44:43'),
(6, 'postingan user', 'isi postingan', 3, '2025-05-16 06:56:16', '2025-05-16 06:56:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quiz_id` bigint(20) UNSIGNED NOT NULL,
  `question_text` text NOT NULL,
  `pembahasan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `questions`
--

INSERT INTO `questions` (`id`, `quiz_id`, `question_text`, `pembahasan`, `created_at`, `updated_at`) VALUES
(4, 1, 'Soal TEs', NULL, '2025-05-16 02:41:45', '2025-05-16 02:41:45'),
(5, 1, 'Soal Dua Edit', 'tes soal dua', '2025-05-16 02:44:47', '2025-05-16 06:02:14'),
(7, 1, 'tes', 'tes soal tiga', '2025-05-16 05:36:26', '2025-05-16 06:02:24'),
(8, 1, 'tes', 'tessss', '2025-05-16 05:45:14', '2025-05-16 06:01:40'),
(9, 1, 'tes soal lagi', 'tes', '2025-05-16 05:47:09', '2025-05-16 05:57:12'),
(10, 3, 'soal kuis dua', 'tes', '2025-05-16 06:28:54', '2025-05-16 06:31:38'),
(11, 3, 'soal dua', 'ini pembahasan ni', '2025-05-16 06:33:34', '2025-05-16 06:33:34'),
(12, 4, 'saol satu', 'tes pembahasan soal', '2025-05-16 06:48:39', '2025-05-16 06:48:39'),
(13, 4, 'soal dua', 'pembahasan soal dua', '2025-05-16 06:49:00', '2025-05-16 06:49:00'),
(14, 5, 'soal kuis', '<p>pembahasankuis</p>\r\n\r\n<p><code>paragraph</code></p>\r\n\r\n<pre>\r\nini pake pre</pre>', '2025-05-16 06:55:49', '2025-05-16 07:46:34'),
(15, 5, 'soal lagi', '<p><em><strong>ini dengan ckeditor</strong></em></p>', '2025-05-16 07:40:44', '2025-05-16 07:40:59'),
(16, 5, 'sola tiga', '<p><em><strong>soal bahas tiga&nbsp;</strong></em></p>', '2025-05-16 07:44:10', '2025-05-16 07:44:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `quizzes`
--

CREATE TABLE `quizzes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `pembahasan` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `quizzes`
--

INSERT INTO `quizzes` (`id`, `title`, `description`, `pembahasan`, `date`, `created_at`, `updated_at`) VALUES
(1, 'Tes Kuis', 'ini tes kuis edit', 'tes', '2025-05-16', '2025-05-16 00:44:54', '2025-05-16 06:47:32'),
(3, 'Kuis Kedua', 'ini deskripsi kuisnya', NULL, '2025-05-16', '2025-05-16 06:06:41', '2025-05-16 06:11:35'),
(4, 'Kuis Ketiga', 'ini isi deskripsi', NULL, '2025-05-16', '2025-05-16 06:48:14', '2025-05-16 06:48:14'),
(5, 'Kuis Baru', 'ini deskripsi kuis', NULL, '2025-05-16', '2025-05-16 06:55:28', '2025-05-16 06:55:28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `quiz_attempts`
--

CREATE TABLE `quiz_attempts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `quiz_id` bigint(20) UNSIGNED NOT NULL,
  `score` int(11) NOT NULL DEFAULT 0,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `correct_answers_count` int(11) NOT NULL DEFAULT 0,
  `incorrect_answers_count` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `google_id`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'test', 'test@gmail.com', NULL, NULL, '$2y$10$B3mA76/aR36h65yzdNxkGeKDbwYnx.feGxg93vNNkRCdlkLGRK3S6', NULL, '2025-05-16 00:03:15', '2025-05-16 00:03:15', 'user'),
(2, 'user', 'user@gmail.com', NULL, NULL, '$2y$10$LuejTm8xt9tPn4c14KcHyOmOYcHL83J2JdDsk4egYn9YlF1frO0LS', NULL, '2025-05-16 03:16:58', '2025-05-16 03:16:58', 'user'),
(3, 'test', 'testt@gmail.com', NULL, NULL, '$2y$10$2GyhiJSMoYIHPUjTx.mSl.WBnYJnZfedjoMvOxO9KAWrV.0W9rP.6', NULL, '2025-05-16 06:44:10', '2025-05-16 06:44:10', 'user');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_answers`
--

CREATE TABLE `user_answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `answer_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `user_answers`
--

INSERT INTO `user_answers` (`id`, `user_id`, `question_id`, `answer_id`, `created_at`, `updated_at`) VALUES
(1, 3, 14, 49, '2025-05-16 07:44:34', '2025-05-16 07:44:34'),
(2, 3, 15, 54, '2025-05-16 07:44:34', '2025-05-16 07:44:34'),
(3, 3, 16, 57, '2025-05-16 07:44:34', '2025-05-16 07:44:34');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indeks untuk tabel `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `answers_question_id_foreign` (`question_id`);

--
-- Indeks untuk tabel `artikels`
--
ALTER TABLE `artikels`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `artikels_slug_unique` (`slug`);

--
-- Indeks untuk tabel `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `frameworks`
--
ALTER TABLE `frameworks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `frameworks_slug_unique` (`slug`);

--
-- Indeks untuk tabel `gambars`
--
ALTER TABLE `gambars`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `postingan_users`
--
ALTER TABLE `postingan_users`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_quiz_id_foreign` (`quiz_id`);

--
-- Indeks untuk tabel `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `quiz_attempts`
--
ALTER TABLE `quiz_attempts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_attempts_user_id_foreign` (`user_id`),
  ADD KEY `quiz_attempts_quiz_id_foreign` (`quiz_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `user_answers`
--
ALTER TABLE `user_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_answers_user_id_foreign` (`user_id`),
  ADD KEY `user_answers_question_id_foreign` (`question_id`),
  ADD KEY `user_answers_answer_id_foreign` (`answer_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `answers`
--
ALTER TABLE `answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT untuk tabel `artikels`
--
ALTER TABLE `artikels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `frameworks`
--
ALTER TABLE `frameworks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `gambars`
--
ALTER TABLE `gambars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `postingan_users`
--
ALTER TABLE `postingan_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `quiz_attempts`
--
ALTER TABLE `quiz_attempts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user_answers`
--
ALTER TABLE `user_answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_quiz_id_foreign` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `quiz_attempts`
--
ALTER TABLE `quiz_attempts`
  ADD CONSTRAINT `quiz_attempts_quiz_id_foreign` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `quiz_attempts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user_answers`
--
ALTER TABLE `user_answers`
  ADD CONSTRAINT `user_answers_answer_id_foreign` FOREIGN KEY (`answer_id`) REFERENCES `answers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_answers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
