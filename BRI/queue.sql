-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 29, 2023 at 10:44 AM
-- Server version: 10.5.17-MariaDB-cll-lve
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u1573577_antrian`
--

-- --------------------------------------------------------

--
-- Table structure for table `queue`
--

CREATE TABLE `queue` (
  `ip` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_for` date NOT NULL,
  `number_queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_code_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_id` bigint(20) UNSIGNED NOT NULL,
  `bank_code` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `queue`
--

INSERT INTO `queue` (`ip`, `id`, `queue_for`, `number_queue`, `unit_code`, `unit_code_name`, `bank_id`, `bank_code`, `bank_name`, `bank_address`, `created_at`, `updated_at`) VALUES
('202.152.150.131', '140de2f5-c1c3-4b0d-853b-98e5f90b0800', '2023-02-10', '001', 'B', 'CS', 1, '0197', 'Yogyakarta (KW)', 'Jl. Cik Ditiro No. 3 Yogyakarta D.I. Yogyakarta', '2023-01-28 10:05:47', '2023-01-28 10:05:47'),
('114.142.168.14', '49151b2b-ef43-469e-9f85-87b2fd287f5b', '2023-01-24', '001', 'A', 'Teller', 1, '0197', 'Yogyakarta (KW)', 'Jl. Cik Ditiro No. 3 Yogyakarta D.I. Yogyakarta', '2023-01-24 06:29:41', '2023-01-24 06:29:41'),
('125.164.178.42', '4cd3ff64-beb5-456d-86ff-3e618690c43e', '2023-01-26', '001', 'B', 'CS', 1, '0197', 'Yogyakarta (KW)', 'Jl. Cik Ditiro No. 3 Yogyakarta D.I. Yogyakarta', '2023-01-23 17:26:44', '2023-01-23 17:26:44'),
('114.142.168.8', '5f09a005-4a27-407c-885e-ccdf33830ab7', '2023-01-24', '001', 'A', 'Teller', 1, '0197', 'Yogyakarta (KW)', 'Jl. Cik Ditiro No. 3 Yogyakarta D.I. Yogyakarta', '2023-01-24 04:55:16', '2023-01-24 04:55:16'),
('::1', '68baa85b-8834-483c-9d79-f090afd64dc4', '2023-01-26', '001', 'B', 'CS', 1, '0197', 'Yogyakarta (KW)', 'Jl. Cik Ditiro No. 3 Yogyakarta D.I. Yogyakarta', '2023-01-23 16:10:28', '2023-01-23 16:10:28'),
('114.142.168.8', '74adb166-db91-4a95-8e3b-1065e3779ed3', '2023-01-24', '001', 'A', 'Teller', 1, '0197', 'Yogyakarta (KW)', 'Jl. Cik Ditiro No. 3 Yogyakarta D.I. Yogyakarta', '2023-01-24 04:56:16', '2023-01-24 04:56:16'),
('114.142.169.11', '81925658-2af3-42cc-9b61-3aaeca9811d9', '2023-01-26', '001', 'A', 'Teller', 1, '0197', 'Yogyakarta (KW)', 'Jl. Cik Ditiro No. 3 Yogyakarta D.I. Yogyakarta', '2023-01-26 09:13:37', '2023-01-26 09:13:37'),
('114.142.168.8', 'a4982ff3-c9f7-41c0-ac47-41ee437488de', '2023-01-24', '001', 'A', 'Teller', 1, '0197', 'Yogyakarta (KW)', 'Jl. Cik Ditiro No. 3 Yogyakarta D.I. Yogyakarta', '2023-01-24 04:50:55', '2023-01-24 04:50:55'),
('202.152.150.131', 'b26b945e-d2ba-45d0-8cb3-0b7a141069dd', '2023-02-03', '001', 'B', 'CS', 1, '0197', 'Yogyakarta (KW)', 'Jl. Cik Ditiro No. 3 Yogyakarta D.I. Yogyakarta', '2023-01-28 10:04:05', '2023-01-28 10:04:05'),
('36.65.230.49', 'c457aa99-9090-4f32-942d-05520a682db6', '2023-01-28', '001', 'B', 'CS', 1, '0197', 'Yogyakarta (KW)', 'Jl. Cik Ditiro No. 3 Yogyakarta D.I. Yogyakarta', '2023-01-28 10:07:06', '2023-01-28 10:07:06'),
('36.65.230.49', 'd92a835b-ac3c-4851-9042-3b6d41d047b7', '2023-01-28', '001', 'A', 'Teller', 1, '0197', 'Yogyakarta (KW)', 'Jl. Cik Ditiro No. 3 Yogyakarta D.I. Yogyakarta', '2023-01-28 10:09:54', '2023-01-28 10:09:54'),
('114.142.168.8', 'd9b4867e-269a-4fb3-9f05-fa9608410613', '2023-01-24', '001', 'A', 'Teller', 1, '0197', 'Yogyakarta (KW)', 'Jl. Cik Ditiro No. 3 Yogyakarta D.I. Yogyakarta', '2023-01-24 04:50:06', '2023-01-24 04:50:06'),
('202.152.150.131', 'e03d2a4a-2351-4f19-9a0c-e4e9f6935b44', '2023-01-31', '001', 'B', 'CS', 1, '0197', 'Yogyakarta (KW)', 'Jl. Cik Ditiro No. 3 Yogyakarta D.I. Yogyakarta', '2023-01-28 10:04:47', '2023-01-28 10:04:47'),
('36.65.230.49', 'e901d846-78a5-4ed3-b581-4d1b41aaa712', '2023-01-28', '001', 'A', 'Teller', 1, '0197', 'Yogyakarta (KW)', 'Jl. Cik Ditiro No. 3 Yogyakarta D.I. Yogyakarta', '2023-01-28 10:06:33', '2023-01-28 10:06:33'),
('114.142.168.8', 'f4f11c49-86c1-4178-952d-26fb284810f9', '2023-01-24', '001', 'A', 'Teller', 1, '0197', 'Yogyakarta (KW)', 'Jl. Cik Ditiro No. 3 Yogyakarta D.I. Yogyakarta', '2023-01-24 04:51:19', '2023-01-24 04:51:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `queue`
--
ALTER TABLE `queue`
  ADD UNIQUE KEY `queue_id_unique` (`id`),
  ADD KEY `queue_unit_code_foreign` (`unit_code`),
  ADD KEY `queue_bank_id_foreign` (`bank_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `queue`
--
ALTER TABLE `queue`
  ADD CONSTRAINT `queue_bank_id_foreign` FOREIGN KEY (`bank_id`) REFERENCES `mst_bank` (`id`),
  ADD CONSTRAINT `queue_unit_code_foreign` FOREIGN KEY (`unit_code`) REFERENCES `unit_codes` (`code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
