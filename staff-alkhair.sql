-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2021 at 07:57 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `staff-alkhair`
--

-- --------------------------------------------------------

--
-- Table structure for table `acceptances`
--

CREATE TABLE `acceptances` (
  `id_acceptance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_staff` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_request` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `acceptances`
--

INSERT INTO `acceptances` (`id_acceptance`, `id_staff`, `id_request`, `created_at`, `updated_at`) VALUES
('accpt-60daabfb5a207', 'staff-akf-60daab6d344c4', 'request-60daabe74e1a4', '2021-06-28 22:13:31', '2021-06-28 22:13:31'),
('accpt-60daac25c1c40', 'staff-akf-60daab75772fe', 'request-60daabe74e1a4', '2021-06-28 22:14:13', '2021-06-28 22:14:13'),
('accpt-60daac4ce2c84', 'staff-akf-60daab82a3836', 'request-60daabe74e1a4', '2021-06-28 22:14:52', '2021-06-28 22:14:52'),
('accpt-60dab297d6a54', 'staff-akf-60daab6d344c4', 'request-60daac8a8a1f7', '2021-06-28 22:41:43', '2021-06-28 22:41:43'),
('accpt-60dab2a7580e8', 'staff-akf-60daab75772fe', 'request-60daac8a8a1f7', '2021-06-28 22:41:59', '2021-06-28 22:41:59'),
('accpt-60dab2bce20a7', 'staff-akf-60daab82a3836', 'request-60daac8a8a1f7', '2021-06-28 22:42:20', '2021-06-28 22:42:20');

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
-- Table structure for table `list_items`
--

CREATE TABLE `list_items` (
  `id_item` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `references` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `budget_available` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_of_measurement` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estimated_unit_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `project` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `settlement` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `settlement_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_request` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `list_items`
--

INSERT INTO `list_items` (`id_item`, `description`, `references`, `amount`, `budget_available`, `quantity`, `unit_of_measurement`, `estimated_unit_price`, `project`, `account_code`, `settlement`, `settlement_amount`, `id_request`) VALUES
('item-60daabe74f4ab', 'Banner Gaza', NULL, '85000', NULL, '1', 'Pcs', NULL, NULL, NULL, 'settlement-60dab7c761677.jpg', '20000', 'request-60daabe74e1a4'),
('item-60daabe750b24', 'Roll Banner Surabaya', NULL, '75000', NULL, '1', 'Pcs', NULL, NULL, NULL, 'settlement-60dab7c7657bd.jpg', '75000', 'request-60daabe74e1a4'),
('item-60daac8a8b7cd', 'Sapi Qurban', NULL, '15000000', NULL, '1', 'Pcs', NULL, NULL, NULL, 'settlement-60dab331e5e5b.jpg', '15000000', 'request-60daac8a8a1f7'),
('item-60daac8a8cdef', 'Penggaris', NULL, '5000', NULL, '1', 'Pcs', NULL, NULL, NULL, 'settlement-60dab33232be7.jpg', '5000', 'request-60daac8a8a1f7'),
('item-60daaea95aed6', 'Sampoerna Mild', NULL, '35000', NULL, '1', 'Pcs', NULL, NULL, NULL, NULL, NULL, 'request-60daaea959b7d');

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
(11, '2014_10_12_000000_create_users_table', 1),
(12, '2014_10_12_100000_create_password_resets_table', 1),
(13, '2019_08_19_000000_create_failed_jobs_table', 1),
(14, '2021_04_03_103655_create_subpotition_table', 1),
(15, '2021_04_04_84210_create_positions_table', 1),
(16, '2021_04_19_081800_create_role_table', 1),
(17, '2021_04_19_084711_create_staff_table', 1),
(18, '2021_05_07_073511_create_payment_requests_table', 1),
(19, '2021_05_07_073532_create_list_items_table', 1),
(20, '2021_06_02_143456_create_acceptances_table', 1);

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
-- Table structure for table `payment_requests`
--

CREATE TABLE `payment_requests` (
  `id_request` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_staff` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_pengajuan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_requests`
--

INSERT INTO `payment_requests` (`id_request`, `id_staff`, `tanggal_pengajuan`, `status`, `created_at`, `updated_at`) VALUES
('request-60daabe74e1a4', 'staff-akf-60daab901010b', '29-Jun-2021 05:13:11', 'Done', '2021-06-28 22:13:11', '2021-06-28 23:03:51'),
('request-60daac8a8a1f7', 'staff-akf-60daab901010b', '29-Jun-2021 05:15:54', 'Done', '2021-06-28 22:15:54', '2021-06-28 22:44:18'),
('request-60daaea959b7d', 'staff-akf-60daab901010b', '29-Jun-2021 05:24:57', 'Requested', '2021-06-28 22:24:57', '2021-06-28 22:24:57');

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `id_position` bigint(20) UNSIGNED NOT NULL,
  `nama_position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_subposition` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`id_position`, `nama_position`, `id_subposition`) VALUES
(1, 'Country Director', 1),
(2, 'Treasurer', 2),
(3, 'Logistic', 3),
(4, 'Media', 4),
(5, 'Program', 5);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id_role` bigint(20) UNSIGNED NOT NULL,
  `nama_role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id_role`, `nama_role`) VALUES
(1, 'Admin'),
(2, 'Staff');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id_staff` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_staff` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_staff` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_masuk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount_pr_requested` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_role` bigint(20) UNSIGNED NOT NULL,
  `id_position` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id_staff`, `nama_staff`, `email_staff`, `tanggal_lahir`, `tanggal_masuk`, `password`, `amount_pr_requested`, `id_role`, `id_position`, `created_at`, `updated_at`) VALUES
('staff-akf-60daab6d344c4', 'Fahturrahman Fauzi', 'fatur@gmail.com', '29-06-2021', '29-06-2021', '$2y$10$iDHhVSNIlozWepE5Ql.0V.h3rmuu//zd/e2uG.bWYj2YZN178XLOe', '0', 2, 1, '2021-06-28 22:11:09', '2021-06-28 22:11:09'),
('staff-akf-60daab75772fe', 'Fariz', 'fariz@gmail.com', '29-06-2021', '29-06-2021', '$2y$10$iLqMqU2g9ZeOYrbiIy95Ie/hBdU/S6IZ1Y1WFyBBz0qVz8ypa8aJm', '0', 2, 2, '2021-06-28 22:11:17', '2021-06-28 22:11:17'),
('staff-akf-60daab82a3836', 'Ardy', 'ardy@gmail.com', '29-06-2021', '29-06-2021', '$2y$10$QnqsaVKN07kZSH.R4mEOEuNvnzpP.72hmWoXAq3gRkivTaQUgHyWa', '0', 2, 3, '2021-06-28 22:11:30', '2021-06-28 22:11:30'),
('staff-akf-60daab901010b', 'Nabila Fauzul', 'nabila@gmail.com', '29-06-2021', '29-06-2021', '$2y$10$NU/ZCRs4T6FZ36.YCleUme6Y2LGcT/I4aLmAurixYkiTpVqUA3zGW', '0', 2, 4, '2021-06-28 22:11:44', '2021-06-28 22:11:44');

-- --------------------------------------------------------

--
-- Table structure for table `subposition`
--

CREATE TABLE `subposition` (
  `id_subposition` bigint(20) UNSIGNED NOT NULL,
  `nama_subposition` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `allowed_to_accept_request` tinyint(1) NOT NULL,
  `allowed_to_input_donator` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subposition`
--

INSERT INTO `subposition` (`id_subposition`, `nama_subposition`, `allowed_to_accept_request`, `allowed_to_input_donator`) VALUES
(1, 'Approver', 1, 0),
(2, 'Reviewer', 1, 0),
(3, 'Checker', 1, 0),
(4, 'Donatur Input', 0, 1),
(5, 'Staff', 0, 0);

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
-- Indexes for dumped tables
--

--
-- Indexes for table `acceptances`
--
ALTER TABLE `acceptances`
  ADD PRIMARY KEY (`id_acceptance`),
  ADD KEY `acceptances_id_staff_foreign` (`id_staff`),
  ADD KEY `acceptances_id_request_foreign` (`id_request`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `list_items`
--
ALTER TABLE `list_items`
  ADD PRIMARY KEY (`id_item`),
  ADD KEY `list_items_id_request_foreign` (`id_request`);

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
-- Indexes for table `payment_requests`
--
ALTER TABLE `payment_requests`
  ADD PRIMARY KEY (`id_request`),
  ADD KEY `payment_requests_id_staff_foreign` (`id_staff`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`id_position`),
  ADD KEY `position_id_subposition_foreign` (`id_subposition`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id_staff`),
  ADD KEY `staff_id_role_foreign` (`id_role`),
  ADD KEY `staff_id_position_foreign` (`id_position`);

--
-- Indexes for table `subposition`
--
ALTER TABLE `subposition`
  ADD PRIMARY KEY (`id_subposition`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `id_position` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id_role` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subposition`
--
ALTER TABLE `subposition`
  MODIFY `id_subposition` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `acceptances`
--
ALTER TABLE `acceptances`
  ADD CONSTRAINT `acceptances_id_request_foreign` FOREIGN KEY (`id_request`) REFERENCES `payment_requests` (`id_request`),
  ADD CONSTRAINT `acceptances_id_staff_foreign` FOREIGN KEY (`id_staff`) REFERENCES `staff` (`id_staff`);

--
-- Constraints for table `list_items`
--
ALTER TABLE `list_items`
  ADD CONSTRAINT `list_items_id_request_foreign` FOREIGN KEY (`id_request`) REFERENCES `payment_requests` (`id_request`);

--
-- Constraints for table `payment_requests`
--
ALTER TABLE `payment_requests`
  ADD CONSTRAINT `payment_requests_id_staff_foreign` FOREIGN KEY (`id_staff`) REFERENCES `staff` (`id_staff`);

--
-- Constraints for table `position`
--
ALTER TABLE `position`
  ADD CONSTRAINT `position_id_subposition_foreign` FOREIGN KEY (`id_subposition`) REFERENCES `subposition` (`id_subposition`);

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_id_position_foreign` FOREIGN KEY (`id_position`) REFERENCES `position` (`id_position`),
  ADD CONSTRAINT `staff_id_role_foreign` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
