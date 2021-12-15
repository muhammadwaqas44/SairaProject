-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2021 at 03:52 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `document_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `certifications`
--

CREATE TABLE `certifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `certification_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_marks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `obtain_marks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cgpa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pdf_path` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pdf_image_path` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `student_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `certifications`
--

INSERT INTO `certifications` (`id`, `certification_no`, `total_marks`, `obtain_marks`, `cgpa`, `pdf_path`, `pdf_image_path`, `student_id`, `admin_id`, `created_at`, `updated_at`) VALUES
('6f6548b2-7696-4617-a082-6364c1c21ebb', 'CN/100001', '2200', '3000', '3.21', 'pdf/certificates/6f6548b2-7696-4617-a082-6364c1c21ebb.pdf', 'pdf_images/certificates/6f6548b2-7696-4617-a082-6364c1c21ebb.png', '28feff0f-ad7b-497d-abfa-4ef50aca9d15', 1, '2021-10-08 07:08:59', '2021-10-08 13:16:50'),
('ea70ad65-2f2e-412e-af65-6fac7d7bafbc', 'CN/100000', '2300', '3000', '3.39', 'pdf/certificates/ea70ad65-2f2e-412e-af65-6fac7d7bafbc.pdf', 'pdf_images/certificates/ea70ad65-2f2e-412e-af65-6fac7d7bafbc.png', '20b08e11-d6b2-4639-b9a4-4611ac9bacaf', 1, '2021-10-08 03:18:34', '2021-10-08 13:16:54');

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
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_08_19_072303_create_students_table', 1),
(5, '2021_08_19_073614_create_transcripts_table', 1),
(6, '2021_08_19_073645_create_transcript_subjects_table', 1),
(7, '2021_08_19_102517_create_certifications_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bcrypt_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `registration_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `candidate_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guardian_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `started_date` date DEFAULT NULL,
  `ended_date` date DEFAULT NULL,
  `name_campus` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batch_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `profile_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cnic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qr_code_path` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `result_notification_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `student_unique_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `email`, `password`, `phone`, `address`, `bcrypt_id`, `registration_no`, `candidate_name`, `guardian_name`, `department_name`, `class_name`, `started_date`, `ended_date`, `name_campus`, `batch_no`, `date_of_birth`, `profile_image`, `cnic`, `qr_code_path`, `result_notification_no`, `admin_id`, `created_at`, `updated_at`, `student_unique_no`) VALUES
('20b08e11-d6b2-4639-b9a4-4611ac9bacaf', 'saira@saira.com', '$2y$10$jPDaxAEHuNe/KqlwfmCmLeSBQHNRi19BQ3WJYJImTgBU891ZDTZcW', '12345678901', 'Multan', '$2y$10$U5ePeu2bQ7xPa1HuT3uT3OQ78dQxjTQD8METpHBn1BiP0.OIZh/Ca', '2019-nwm-001', 'Saira Yaqub', 'Muhammad Yaqub', 'Computer Science', 'BS', '2018-09-24', '2021-10-15', 'Nawaz Shareef', '0011', '2013-01-11', 'students/images/zlHZbMtva6wsYGV.png', '1235612356761', 'qr_images/20b08e11-d6b2-4639-b9a4-4611ac9bacaf.png', 'RNN/100000', 1, '2021-10-08 02:47:32', '2021-10-08 02:47:33', 100000),
('28feff0f-ad7b-497d-abfa-4ef50aca9d15', 'ayesha@abc.com', '$2y$10$l.ut.aKueNVJ8HJeZ6Ca6Og36eQz6AuptUKvyjI4A2tBotZftwXH2', '12345678901', 'Multan', '$2y$10$OXuztNQT6OAC/30r0ujJ1O0.J1Dgg.Qbr3CgVMsRuhi3E1rdfO.xa', '2019-nwm-002', 'Ayesha Yaqub', 'Muhammad Yaqub', 'Computer Science', 'BS', '2018-06-08', '2021-10-08', 'Nawaz Shareef', '0011', '2005-02-08', 'students/images/AKfRNcb59Ygnt2j.png', '1235612356761', 'qr_images/28feff0f-ad7b-497d-abfa-4ef50aca9d15.png', 'RNN/100001', 1, '2021-10-08 07:05:33', '2021-10-08 07:05:34', 100001);

-- --------------------------------------------------------

--
-- Table structure for table `transcripts`
--

CREATE TABLE `transcripts` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_marks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `obtain_marks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cgpa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Completed','UnCompleted') COLLATE utf8mb4_unicode_ci NOT NULL,
  `pdf_path` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pdf_image_path` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `student_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transcript_subjects`
--

CREATE TABLE `transcript_subjects` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `course_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `credit_hour` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `max_marks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `obtained_marks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `grade` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity_points` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transcript_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `student_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'admin@admin.com', NULL, '$2y$10$Krzd2HlnQqLlQlQGfrUzOe2Urwt8v3ga/8D2rTI13TCq25xc3XD8a', NULL, '2021-10-08 02:43:19', '2021-10-08 02:43:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `certifications`
--
ALTER TABLE `certifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `certifications_student_id_foreign` (`student_id`),
  ADD KEY `certifications_admin_id_foreign` (`admin_id`);

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
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_email_unique` (`email`),
  ADD UNIQUE KEY `student_unique_no` (`student_unique_no`),
  ADD KEY `students_admin_id_index` (`admin_id`);

--
-- Indexes for table `transcripts`
--
ALTER TABLE `transcripts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transcripts_student_id_foreign` (`student_id`),
  ADD KEY `transcripts_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `transcript_subjects`
--
ALTER TABLE `transcript_subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transcript_subjects_transcript_id_foreign` (`transcript_id`),
  ADD KEY `transcript_subjects_student_id_foreign` (`student_id`),
  ADD KEY `transcript_subjects_admin_id_foreign` (`admin_id`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_unique_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100002;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `certifications`
--
ALTER TABLE `certifications`
  ADD CONSTRAINT `certifications_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `certifications_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transcripts`
--
ALTER TABLE `transcripts`
  ADD CONSTRAINT `transcripts_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transcripts_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transcript_subjects`
--
ALTER TABLE `transcript_subjects`
  ADD CONSTRAINT `transcript_subjects_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transcript_subjects_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transcript_subjects_transcript_id_foreign` FOREIGN KEY (`transcript_id`) REFERENCES `transcripts` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
