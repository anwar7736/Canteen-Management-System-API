-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2022 at 07:24 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `daily_meal_items`
--

CREATE TABLE `daily_meal_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `day` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lunch_item` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dinner_item` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `daily_meal_items`
--

INSERT INTO `daily_meal_items` (`id`, `day`, `lunch_item`, `dinner_item`, `created_at`, `updated_at`) VALUES
(1, 'শনিবার', 'মুরগীর মাংস, সবজি, ডাল, আলু ভর্তা', 'বড় মাছ, শাকসবজি, ডাল', '2022-02-07 15:58:34', '2022-02-07 10:05:13'),
(2, 'রবিবার', 'বড় মাছ, সবজি, ডাল', 'ছোট মাছ, ভর্তা, ডাল', '2022-02-07 15:58:41', '2022-02-07 15:58:43'),
(3, 'সোমবার', 'ডিম, ভর্তা, ডাল', 'বড় মাছ, সবজি, ডাল', '2022-02-07 15:58:45', '2022-02-07 15:58:46'),
(4, 'মঙ্গলবার', 'মুরগীর মাংস, সবজি, ডাল', 'মলা মাছ ভর্তা, ডাল', '2022-02-07 15:58:47', '2022-02-07 15:58:48'),
(5, 'বুধবার', 'বড় মাছ, শাক-সবজি, ডাল', 'বড় মাছ, আলু ভর্তা, ডাল', '2022-02-07 15:58:49', '2022-02-07 15:58:50'),
(6, 'বৃহস্পতিবার', 'ছোট মাছ, ভর্তা, ডাল', 'ভুনা খিচুড়ি, সবজি, ডাল', '2022-02-07 15:58:51', '2022-02-07 15:58:52'),
(7, 'শুক্রবার', 'গরুর মাংস, সবজি, ডাল', 'ডিম, শাক, ডাল', '2022-02-07 15:58:54', '2022-02-07 15:58:55');

-- --------------------------------------------------------

--
-- Table structure for table `email_otp_verification`
--

CREATE TABLE `email_otp_verification` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `otp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_otp_verification`
--

INSERT INTO `email_otp_verification` (`id`, `email`, `otp`, `time`, `date`) VALUES
(53, 'mdshahjahansheikh1995@gmail.com', '255134', '09:29:31pm', '2022-01-31'),
(55, 'anwarhossain7736@gmail.com', '911952', '09:50:45pm', '2022-02-01'),
(56, 'anwarhossain7736@gmail.com', '751875', '09:56:15pm', '2022-02-01');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meal_rates`
--

CREATE TABLE `meal_rates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lunch_expiry_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dinner_expiry_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lunch_rate` int(11) NOT NULL,
  `dinner_rate` int(11) NOT NULL,
  `total_rate` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meal_rates`
--

INSERT INTO `meal_rates` (`id`, `lunch_expiry_time`, `dinner_expiry_time`, `lunch_rate`, `dinner_rate`, `total_rate`, `created_at`, `updated_at`) VALUES
(1, '3:50', '11:00', 60, 50, 110, '2022-02-07 16:15:39', '2022-02-07 16:20:50');

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
(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(3, '2021_08_01_153542_email_otp_verification', 2),
(4, '2022_01_15_180927_create_daily_meal_items_table', 3),
(5, '2022_01_15_185710_create_notifications_table', 4),
(6, '2022_01_15_190301_create_notification_details_table', 4),
(13, '2022_01_22_150933_create_payments_table', 7),
(16, '2022_01_17_153112_create_order_meals_table', 8),
(18, '2022_01_25_142927_create_monthly_statements_table', 9),
(19, '2022_01_29_165256_create_jobs_table', 10),
(22, '2022_01_17_153007_create_meal_rates_table', 11);

-- --------------------------------------------------------

--
-- Table structure for table `monthly_statements`
--

CREATE TABLE `monthly_statements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token_no` int(11) NOT NULL,
  `total_lunch` int(11) NOT NULL,
  `lunch_cost` int(11) NOT NULL,
  `total_dinner` int(11) NOT NULL,
  `dinner_cost` int(11) NOT NULL,
  `total_meal` int(11) NOT NULL,
  `total_cost` int(11) NOT NULL,
  `total_payment` double(8,2) NOT NULL,
  `give` double(8,2) NOT NULL,
  `take` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `monthly_statements`
--

INSERT INTO `monthly_statements` (`id`, `year`, `month`, `token_no`, `total_lunch`, `lunch_cost`, `total_dinner`, `dinner_cost`, `total_meal`, `total_cost`, `total_payment`, `give`, `take`, `created_at`, `updated_at`) VALUES
(1, 2022, 'January', 121245, 7, 420, 7, 350, 14, 770, 1860.00, 0.00, 1090.00, NULL, NULL),
(2, 2022, 'January', 475214, 2, 120, 2, 100, 4, 220, 320.50, 0.00, 100.50, NULL, NULL),
(3, 2022, 'January', 142782, 2, 120, 2, 100, 4, 220, 220.00, 0.00, 0.00, NULL, NULL),
(4, 2022, 'February', 142782, 5, 300, 5, 250, 10, 550, 500.00, 50.00, 0.00, NULL, NULL),
(5, 2022, 'February', 192328, 5, 300, 5, 250, 10, 550, 400.00, 150.00, 0.00, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `author_id` int(11) NOT NULL,
  `author_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `msg_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `msg_body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `create_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `create_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `author_id`, `author_name`, `msg_title`, `msg_body`, `create_date`, `create_time`) VALUES
(4, 3, 'Anwar', 'Hello', 'Hello there, how are you?', '2022-01-16', '09:42:59pm'),
(5, 1, 'Md Sujon Mollah', 'Check you mail', 'Dear All, Please check your mail', '2022-01-16', '09:44:45pm'),
(9, 3, 'Anwar', 'Request for guest meal', 'Dear Admin,\r\nI want to  add some guest meal for 17-01-22', '2022-01-16', '10:04:05pm'),
(10, 3, 'Md Anwar Hossain', 'Good Night', 'Good Night', '2022-01-17', '12:28:30am'),
(11, 5, 'Good Night', 'Good Night', 'Hey there,\r\nHow are you?', '2022-01-31', '10:02:02pm');

-- --------------------------------------------------------

--
-- Table structure for table `notification_details`
--

CREATE TABLE `notification_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `notification_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unread',
  `create_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `create_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification_details`
--

INSERT INTO `notification_details` (`id`, `notification_id`, `user_id`, `status`, `create_date`, `create_time`) VALUES
(2, 4, 1, 'Latest', '2022-01-16', '09:42:59pm'),
(3, 5, 3, 'Read', '2022-01-16', '09:44:45pm'),
(4, 5, 4, 'Latest', '2022-01-16', '09:44:45pm'),
(5, 5, 5, 'Read', '2022-01-16', '09:44:45pm'),
(9, 9, 1, 'Latest', '2022-01-16', '10:04:05pm'),
(11, 10, 1, 'Latest', '2022-01-17', '12:28:30am'),
(12, 11, 1, 'Latest', '2022-01-31', '10:02:02pm');

-- --------------------------------------------------------

--
-- Table structure for table `order_meals`
--

CREATE TABLE `order_meals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `token_no` int(11) NOT NULL,
  `lunch` int(11) NOT NULL,
  `lunch_amount` int(11) NOT NULL,
  `dinner` int(11) NOT NULL,
  `dinner_amount` int(11) NOT NULL,
  `total_meal` int(11) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `meal_given_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_meals`
--

INSERT INTO `order_meals` (`id`, `user_id`, `token_no`, `lunch`, `lunch_amount`, `dinner`, `dinner_amount`, `total_meal`, `total_amount`, `meal_given_date`, `deleted_at`, `created_at`, `updated_at`) VALUES
(24, 3, 121245, 5, 300, 5, 250, 10, 550, '2022-01-26', NULL, '2022-01-26 17:01:12', '2022-01-26 11:01:48'),
(25, 3, 121245, 1, 60, 1, 50, 2, 110, '2022-01-27', NULL, '2022-01-26 17:02:55', '2022-01-26 17:02:55'),
(26, 5, 475214, 2, 120, 2, 100, 4, 220, '2022-01-27', NULL, '2022-01-26 17:05:01', '2022-01-26 17:05:01'),
(29, 3, 121245, 1, 60, 1, 50, 2, 110, '2022-01-31', NULL, '2022-01-30 17:39:37', '2022-01-30 17:39:37'),
(31, 5, 475214, 1, 60, 1, 50, 2, 110, '2022-02-01', NULL, '2022-01-31 16:43:08', '2022-01-31 16:43:08'),
(32, 4, 142782, 5, 300, 5, 250, 10, 550, '2022-02-08', NULL, '2022-02-07 15:48:02', '2022-02-07 15:48:02'),
(33, 10, 192328, 5, 300, 5, 250, 10, 550, '2022-02-08', NULL, '2022-02-07 15:54:23', '2022-02-07 15:54:23');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `year`, `month`, `name`, `token_no`, `email`, `phone`, `amount`, `address`, `transaction_id`, `status`, `currency`, `payment_date`, `payment_time`) VALUES
(2, 2022, 'January', 'Md Anwar Hossain', '121245', 'abc@gmail.com', '01794030592', 100.50, 'Polashbari, Ashulia, Dhaka', '61ed6e4de4448', 'Processing', 'BDT', '2022-01-23', '09:03:41pm'),
(3, 2022, 'January', 'Md Anwar Hossain', '121245', 'abc@gmail.com', '01794030592', 100.50, 'Polashbari, Ashulia, Dhaka', '16ed6e45e4504', 'Processing', 'BDT', '2022-01-24', '09:19:41pm'),
(4, 2022, 'January', 'Md Anwar Hossain', '121245', 'abc@gmail.com', '01794030592', 200.00, 'Polashbari, Ashulia, Dhaka', '61ed77db3a6a1', 'Processing', 'BDT', '2022-01-23', '09:44:27pm'),
(5, 2022, 'January', 'Md Anwar Hossain', '121245', 'abc@gmail.com', '01794030592', 149.00, 'Polashbari, Ashulia, Dhaka', '61f02b3308fdf', 'Processing', 'BDT', '2022-01-25', '10:54:11pm'),
(6, 2022, 'January', 'Md Anwar Hossain', '121245', 'abc@gmail.com', '01794030592', 10.00, 'Polashbari, Ashulia, Dhaka', '61f02b65634b8', 'Processing', 'BDT', '2022-01-25', '10:55:01pm'),
(7, 2022, 'January', 'Md Anwar Hossain', '475214', 'abc@gmail.com', '01794030592', 220.00, 'Polashbari, Ashulia, Dhaka', '61f17f7f920f3', 'Processing', 'BDT', '2022-01-26', '11:06:07pm'),
(8, 2022, 'January', 'Md Anwar Hossain', '121245', 'abc@gmail.com', '01794030592', 100.00, 'Polashbari, Ashulia, Dhaka', '61f17ff85444e', 'Processing', 'BDT', '2022-01-26', '11:08:08pm'),
(9, 2022, 'January', 'Md Anwar Hossain', '121245', 'abc@gmail.com', '01794030592', 1200.00, 'Polashbari, Ashulia, Dhaka', '61ddbfb227839', 'Processing', 'BDT', '2022-01-11', '11:34:42pm'),
(10, 2022, 'January', 'Md Anwar Hossain', '475214', 'abc@gmail.com', '01794030592', 100.50, 'Polashbari, Ashulia, Dhaka', '61f80af8e7913', 'Processing', 'BDT', '2022-01-31', '10:14:48pm'),
(11, 2022, 'February', 'Md Anwar Hossain', '142782', 'abc@gmail.com', '01794030592', 500.00, 'Polashbari, Ashulia, Dhaka', '6201405ba7b0a', 'Processing', 'BDT', '2022-02-07', '09:52:59pm'),
(12, 2022, 'February', 'Md Anwar Hossain', '192328', 'abc@gmail.com', '01794030592', 400.00, 'Polashbari, Ashulia, Dhaka', '620140c360625', 'Processing', 'BDT', '2022-02-07', '09:54:43pm');

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
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `token_no` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `token_no`, `name`, `username`, `email`, `phone`, `role`, `status`, `password`, `address`, `photo`, `created_at`, `updated_at`) VALUES
(1, 101101, 'Md Anwar Hossain', 'admin1234', 'anwarhossain7736@gmail.com', '01794030592', 'admin', 'active', '$2y$10$TNTNLwY0bIY0QJlVYm27n.udAn4n8kaRYXvhpFwk/JGbbpwTuJeom', 'Polashbari, Ashulia, Dhaka', NULL, '2022-01-09 09:42:41', '2022-02-05 09:41:57'),
(4, 142782, 'Shara', 'anwar123', 'shara6493@gmail.com', '01795700837', 'user', 'active', '$2y$10$gA2dLvyNMSdZ1ZjahqksLOHWrxOQTvVU1NMvWl1xhvVqhCcLCSapu', 'Polashbari, Ashulia, Dhaka', 'http://127.0.0.1:8000/storage/MH81KDFSpYEzifC7CsOWtv0Zeq990qe4HTW2iBPa.jpg', '2022-01-09 09:42:41', '2022-02-06 11:24:46'),
(9, 824720, 'Md Ahsan Karim', 'ahsan123', 'abc@gmail.com', '01715414525', 'user', 'active', '$2y$10$ms.dc/xaupEwF9pMrSMtk.nH6XlqUEH/tMMZwaP3fyil3S4roWKM2', 'Savar,Dhaka', 'http://127.0.0.1:8000/storage/b014cQa0nAq1FfYzoDJw6eQTlumqhADg2qnFRWzk.jpg', '2022-02-06 10:42:12', '2022-02-06 11:24:56'),
(10, 192328, 'Shara Enterprise', 'shara1234', 'shara_enterprise@yahoo.com', '01715424526', 'user', 'active', '$2y$10$l205ZeJruxRam8TgnHI6Se1JUF/cRD2HFa0S7rceNgdrWBwZ14YKi', 'Polashbari, Ashulia, Dhaka', 'http://127.0.0.1:8000/storage/vc6OkHvNQ79gP3g3r9sUUfS3TTYUqDXevJ9G68FS.jpg', '2022-02-06 11:28:12', '2022-02-06 11:28:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daily_meal_items`
--
ALTER TABLE `daily_meal_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_otp_verification`
--
ALTER TABLE `email_otp_verification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `meal_rates`
--
ALTER TABLE `meal_rates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monthly_statements`
--
ALTER TABLE `monthly_statements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_details`
--
ALTER TABLE `notification_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_meals`
--
ALTER TABLE `order_meals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daily_meal_items`
--
ALTER TABLE `daily_meal_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `email_otp_verification`
--
ALTER TABLE `email_otp_verification`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT for table `meal_rates`
--
ALTER TABLE `meal_rates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `monthly_statements`
--
ALTER TABLE `monthly_statements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `notification_details`
--
ALTER TABLE `notification_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `order_meals`
--
ALTER TABLE `order_meals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
