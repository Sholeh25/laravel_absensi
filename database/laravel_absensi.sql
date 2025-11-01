-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 04, 2025 at 03:23 AM
-- Server version: 8.0.40
-- PHP Version: 8.1.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_absensi`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint UNSIGNED NOT NULL,
  `employee_id` bigint NOT NULL,
  `entry_ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entry_location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exit_ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exit_location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `registered` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `employee_id`, `entry_ip`, `entry_location`, `exit_ip`, `exit_location`, `registered`, `time`, `created_at`, `updated_at`) VALUES
(1, 3, '127.0.0.1', '', '127.0.0.1', '', 'ya', NULL, '2021-08-17 03:00:23', '2021-08-17 10:00:23'),
(2, 4, '127.0.0.1', '', '127.0.0.1', '', 'ya', NULL, '2021-08-18 03:00:23', '2021-08-18 10:00:23'),
(3, 5, '127.0.0.1', '', '127.0.0.1', '', 'ya', NULL, '2021-08-19 03:00:23', '2021-08-19 10:00:23'),
(4, 6, '127.0.0.1', '', '127.0.0.1', '', 'ya', NULL, '2021-08-20 03:00:23', '2021-08-20 10:00:23'),
(5, 7, '127.0.0.1', '', '127.0.0.1', '', 'ya', NULL, '2021-08-21 03:00:23', '2021-08-21 10:00:23'),
(6, 8, '127.0.0.1', '', '127.0.0.1', '', 'ya', NULL, '2021-08-22 03:00:23', '2021-08-22 10:00:23'),
(7, 9, '127.0.0.1', '', '127.0.0.1', '', 'ya', NULL, '2021-08-23 03:00:23', '2021-08-23 10:00:23'),
(8, 10, '127.0.0.1', '', '127.0.0.1', '', 'ya', NULL, '2021-08-24 03:00:23', '2021-08-24 10:00:23'),
(9, 11, '127.0.0.1', '', '127.0.0.1', '', 'ya', NULL, '2021-08-25 03:00:23', '2021-08-25 10:00:23'),
(10, 3, '127.0.0.1', 'Geo Tag Expired', '127.0.0.1', NULL, 'ya', '10', '2025-01-04 03:02:56', '2025-01-04 03:03:02');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `overtime_cost` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `overtime_start` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `overtime_end` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `created_at`, `updated_at`, `overtime_cost`, `overtime_start`, `overtime_end`) VALUES
(1, 'Manajemen', '2025-01-04 02:59:05', '2025-01-04 02:59:05', NULL, NULL, NULL),
(2, 'Perawat', '2025-01-04 02:59:05', '2025-01-04 02:59:05', NULL, NULL, NULL),
(3, 'Bidan', '2025-01-04 02:59:05', '2025-01-04 02:59:05', NULL, NULL, NULL),
(4, 'Dokter', '2025-01-04 02:59:05', '2025-01-04 02:59:05', NULL, NULL, NULL),
(5, 'Kasir', '2025-01-04 02:59:05', '2025-01-04 02:59:05', NULL, NULL, NULL),
(6, 'Farmasi', '2025-01-04 02:59:05', '2025-01-04 02:59:05', NULL, NULL, NULL),
(7, 'Front Office', '2025-01-04 02:59:05', '2025-01-04 02:59:05', NULL, NULL, NULL),
(8, 'Petugas Kebersihan', '2025-01-04 02:59:05', '2025-01-04 02:59:05', NULL, NULL, NULL),
(9, 'Backend Developer', '2025-01-04 02:59:05', '2025-01-04 02:59:05', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` datetime NOT NULL,
  `sex` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desg` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `join_date` datetime NOT NULL,
  `salary` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `user_id`, `first_name`, `last_name`, `dob`, `sex`, `desg`, `department_id`, `join_date`, `salary`, `created_at`, `updated_at`, `photo`) VALUES
(1, 1, 'Firyanul', 'Rizky', '1999-03-29 00:00:00', 'Male', 'Manager', '1', '2021-09-15 00:00:00', '6500000', '2025-01-04 02:59:05', '2025-01-04 02:59:05', 'download.png'),
(2, 2, 'Admin', '', '1999-03-29 00:00:00', 'Male', 'Manager', '1', '2021-09-15 00:00:00', '6500000', '2025-01-04 02:59:05', '2025-01-04 02:59:05', 'admin.png'),
(3, 3, 'Anul', 'Emp', '1999-03-29 00:00:00', 'Male', 'Staff', '9', '2021-09-15 00:00:00', '300000', '2025-01-04 02:59:05', '2025-01-04 02:59:05', 'download_1639112200.png'),
(4, 4, 'Manajemen', '', '1999-03-29 00:00:00', 'Male', 'Manager', '1', '2021-09-15 00:00:00', '6500000', '2025-01-04 02:59:05', '2025-01-04 02:59:05', 'manajemen.png'),
(5, 5, 'Perawat', '', '1999-03-29 00:00:00', 'Female', 'Staff', '2', '2021-09-15 00:00:00', '300000', '2025-01-04 02:59:05', '2025-01-04 02:59:05', 'perawat.png'),
(6, 6, 'Bidan', '', '1999-03-29 00:00:00', 'Female', 'Staff', '3', '2021-09-15 00:00:00', '300000', '2025-01-04 02:59:05', '2025-01-04 02:59:05', 'bidan.png'),
(7, 7, 'Dokter', '', '1999-03-29 00:00:00', 'Female', 'Staff', '4', '2021-09-15 00:00:00', '300000', '2025-01-04 02:59:05', '2025-01-04 02:59:05', 'dokter.png'),
(8, 8, 'Kasir', '', '1999-03-29 00:00:00', 'Female', 'Staff', '5', '2021-09-15 00:00:00', '300000', '2025-01-04 02:59:05', '2025-01-04 02:59:05', 'kasir.png'),
(9, 9, 'Farmasi', '', '1999-03-29 00:00:00', 'Female', 'Staff', '6', '2021-09-15 00:00:00', '300000', '2025-01-04 02:59:05', '2025-01-04 02:59:05', 'farmasi.png'),
(10, 10, 'Front', 'Office', '1999-03-29 00:00:00', 'Male', 'Staff', '7', '2021-09-15 00:00:00', '300000', '2025-01-04 02:59:05', '2025-01-04 02:59:05', 'front_office.png'),
(11, 11, 'Petugas', 'Kebersihan', '1999-03-29 00:00:00', 'Female', 'Staff', '8', '2021-09-15 00:00:00', '300000', '2025-01-04 02:59:05', '2025-01-04 02:59:05', 'petugas_kebersihan.png');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint UNSIGNED NOT NULL,
  `employee_id` bigint NOT NULL,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL,
  `receipt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `id` bigint UNSIGNED NOT NULL,
  `employee_id` bigint NOT NULL,
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `half_day` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2020_08_25_125219_create_roles_table', 1),
(6, '2020_08_25_125921_create_role_user_table', 1),
(7, '2020_08_25_202641_create_employees_table', 1),
(8, '2020_08_26_074103_create_attendances_table', 1),
(9, '2020_08_26_123244_create_departments_table', 1),
(10, '2020_08_27_204750_create_leaves_table', 1),
(11, '2020_08_29_112051_create_holidays_table', 1),
(12, '2020_08_29_145328_create_expenses_table', 1),
(13, '2020_08_30_172041_add_photo_to_employees_table', 1),
(14, '2024_11_27_172042_add_overtime_to_departments_table', 1);

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2025-01-04 02:59:04', '2025-01-04 02:59:04'),
(2, 'employee', '2025-01-04 02:59:04', '2025-01-04 02:59:04');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint UNSIGNED NOT NULL,
  `role_id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 1, 2, NULL, NULL),
(3, 2, 3, NULL, NULL),
(4, 2, 4, NULL, NULL),
(5, 2, 5, NULL, NULL),
(6, 2, 6, NULL, NULL),
(7, 2, 7, NULL, NULL),
(8, 2, 8, NULL, NULL),
(9, 2, 9, NULL, NULL),
(10, 2, 10, NULL, NULL),
(11, 2, 11, NULL, NULL);

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Firyanul Rizky', 'firyan2903@gmail.com', NULL, '$2y$10$3ZVZmkNXuAkB4127.b8VSeistaV4xm9CsaP5n6GzLu19olvvnG26u', NULL, '2025-01-04 02:59:04', '2025-01-04 02:59:04'),
(2, 'Admin', 'admin@gmail.com', NULL, '$2y$10$/kWwDI9sUaesBqqI986w8umP07JcHBRshUhy2snVaKCvx6TBsDnpe', NULL, '2025-01-04 02:59:04', '2025-01-04 02:59:04'),
(3, 'Anul Emp', 'anul29@mail.com', NULL, '$2y$10$pRKJBmg76lUIaJBJFQtJFuKVDQjRIAIwKidGDONOGj79PPeqdaasu', NULL, '2025-01-04 02:59:04', '2025-01-04 02:59:04'),
(4, 'Manajemen', 'manajemen@gmail.com', NULL, '$2y$10$lxhZhWnXfZFRxBdygqbMx.H97E.7ycBcdPFexaGaEY34KJaKFD9Wq', NULL, '2025-01-04 02:59:04', '2025-01-04 02:59:04'),
(5, 'Perawat', 'perawat@gmail.com', NULL, '$2y$10$0bDhOKGZjy4aSntWOqaI4.vrWeOaKdnYkUuPheGb7mjCHH3T2qtdu', NULL, '2025-01-04 02:59:04', '2025-01-04 02:59:04'),
(6, 'Bidan', 'bidan@gmail.com', NULL, '$2y$10$r1MWRsIiLBwJmok1X2Sln.mlCoGZr9y11WvwZCoz9BxJXZUDWO9H2', NULL, '2025-01-04 02:59:04', '2025-01-04 02:59:04'),
(7, 'Dokter', 'dokter@gmail.com', NULL, '$2y$10$umQIa0nsByshZYmy.S//GOcgPZL5fk2s/OC4iIgwG/lRlWP4snusG', NULL, '2025-01-04 02:59:04', '2025-01-04 02:59:04'),
(8, 'Kasir', 'kasir@gmail.com', NULL, '$2y$10$RjG9sYGYO9wAn99E8QmmJeCBIcXgC4aXLxprOnddUxbeDjen/ZCTC', NULL, '2025-01-04 02:59:04', '2025-01-04 02:59:04'),
(9, 'Farmasi', 'farmasi@gmail.com', NULL, '$2y$10$JGQVe.X6hIymUa8gjXkxdecy65B7/APgg4tKKEj2zIIe.CO.v7M12', NULL, '2025-01-04 02:59:04', '2025-01-04 02:59:04'),
(10, 'Front Office', 'front_office@gmail.com', NULL, '$2y$10$QpHRwlSZOJfGuOcI1LurHuzyGrk6v1ntsKvZqzCoQAMEZFQYPxEWi', NULL, '2025-01-04 02:59:04', '2025-01-04 02:59:04'),
(11, 'Petugas Kebersihan', 'petugas_kebersihan@gmail.com', NULL, '$2y$10$StoRMsAANHshJ.Zi2e9ITONXU0h98Xa4nEmtTCQIIMLvHXjgKuxua', NULL, '2025-01-04 02:59:05', '2025-01-04 02:59:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
