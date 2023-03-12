-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 29, 2023 at 10:42 AM
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
-- Table structure for table `mst_bank`
--

CREATE TABLE `mst_bank` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Area_Code` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `KC_Code` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mst_bank`
--

INSERT INTO `mst_bank` (`id`, `Area_Code`, `KC_Code`, `code`, `name`, `city`, `address`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
(2, '00001', '00197', '00197', 'Yogyakarta (KW)', 'Jogyakarta', 'Jl. Cik Ditiro No. 3 Yogyakarta D.I. Yogyakarta', -7.7813203, 110.374962, '2023-01-23 15:26:23', '2023-01-23 15:26:23'),
(4, '00001', '00236', '00236', 'Bantul (KC)', 'Jogyakarta', 'Jl. Jend. Sudirman No. 3 Bantu', -7.800689937847895, 110.33183843456521, '2023-01-23 15:26:23', '2023-01-23 15:26:23'),
(5, '00001', '00245', '00245', 'Yogya Katamso (KC)', 'Jogyakarta', 'Jl. Brigjen. Katamso No. 13-15 Yogyakarta', -7.801821780407484, 110.36970972135765, '2023-01-23 15:26:23', '2023-01-23 15:26:23'),
(6, '00001', '00247', '00247', 'Sleman (KC)', 'Jogyakarta', 'Jl. Bhayangkara No. 18 Sleman', -7.697668054958351, 110.34737281024015, '2023-01-23 15:26:23', '2023-01-23 15:26:23'),
(7, '00001', '00409', '00409', 'Yogyakarta MLATI (KC)', 'Jogyakarta', 'Jl. Magelang Km 4,2 Sinduadi Kec. Mlati', -7.76457804136656, 110.36142878140565, '2023-01-23 15:26:23', '2023-01-23 15:26:23'),
(8, '00001', '00236', '00410', 'Yogyakarta Adisucipto (KC)', 'Jogyakarta', 'Pasific Building Ground Floor Jl. Laksda Adisucipto No. 157 Yogyakarta', -7.782176696577571, 110.39109334850443, '2023-01-23 15:26:23', '2023-01-23 15:26:23'),
(9, '00001', '00236', '00514', 'Bethesda (KK)', 'Jogyakarta', 'Jl. Jend. Sudirman No. 70 Yogyakarta', -7.778735403249103, 110.37862775677003, '2023-01-23 15:26:23', '2023-01-23 15:26:23'),
(10, '00001', '00236', '01008', 'Gedong Kuning (KCP)', 'Jogyakarta', 'Jl. Gedungkuning No. 172 C Yogyakarta', -7.816829106867378, 110.40128700811182, '2023-01-23 15:26:23', '2023-01-23 15:26:23'),
(11, '00001', '00247', '01055', 'Godean Sleman (KCP)', 'Jogyakarta', 'Jl. Kyai Mojo No. 102 Yogyakarta', -7.74505558947869, 110.38888419859474, '2023-01-23 15:26:23', '2023-01-23 15:26:23'),
(12, '00001', '00247', '01056', 'Pasar Colombo (KCP)', 'Jogyakarta', 'Jl. Kaliurang Km. 7,5 Depok Slema', -7.771849128184555, 110.4092522832535, '2023-01-23 15:26:23', '2023-01-23 15:26:23'),
(13, '00001', '00247', '01111', 'Seturan Sleman (KCP)', 'Jogyakarta', 'Jl. Raya Seturan Caturtunggal Depok', -7.798695176666077, 110.3675269186643, '2023-01-23 15:26:23', '2023-01-23 15:26:23'),
(14, '00001', '00409', '01327', 'KPP Pratama Yogyakarta (KK)', 'Jogyakarta', 'Jl. P. Senopati No. 20 Yogyakarta', -7.761974831927912, 110.40920016315641, '2023-01-23 15:26:23', '2023-01-23 15:26:23'),
(15, '00001', '00245', '01380', 'UPN (KK)', 'Jogyakarta', 'Universitas Pembangunan Nasional Veteran Jl. SWK 104 Lingkar Utara Condong Catur Depok, Sleman', -7.758441082181291, 110.407997729967, '2023-01-23 15:26:23', '2023-01-23 15:26:23'),
(16, '00001', '00245', '01384', 'UKSW (KK)', 'Jogyakarta', 'Jl. Dr. Wahidin No. 5-9 Yogyakarta', -7.783106278113595, 110.37812870124085, '2023-01-23 15:26:23', '2023-01-23 15:26:23'),
(17, '00001', '00409', '01385', 'Lanud Adisucipto (KK)', 'Jogyakarta', 'Komplek AAU Lanud Adisucipto Yogyakarta', -7.78054932741525, 110.41675241063109, '2023-01-23 15:26:23', '2023-01-23 15:26:23'),
(18, '00001', '00409', '01489', 'RS Panti Rapih (KK)', 'Jogyakarta', 'RS. Panti Rapih Jl. Cik Di Tiro Sleman, Yogyakarta', -7.7761321400574275, 110.37805902558271, '2023-01-23 15:26:23', '2023-01-23 15:26:23'),
(19, '00001', '00409', '01522', 'APMD Yogyakarta (KK)', 'Jogyakarta', 'Jl. Timoho No. 317 Yogyakarta', -7.789823219204577, 110.39332596064243, '2023-01-23 15:26:23', '2023-01-23 15:26:23'),
(20, '00001', '00409', '01531', 'Kanwil Depag Yogyakarta (KK)', 'Jogyakarta', 'Jl. Sukonandi No. 8 Yogyakarta', -7.798281765269148, 110.38148932799005, '2023-01-23 15:26:23', '2023-01-23 15:26:23'),
(21, '00001', '00247', '01532', 'Progo Yogyakarta (KK)', 'Jogyakarta', 'Toko Progo Jl. Suryotomo No. 29 Yogyakarta', -7.797530072124615, 110.36910826606436, '2023-01-23 15:26:23', '2023-01-23 15:26:23'),
(22, '00001', '00247', '01540', 'KPPN Yogyakarta (KK)', 'Jogyakarta', 'Jl. Kusumanegara No. 11 Yogyakarta', -7.801356627099971, 110.38365651954578, '2023-01-23 15:26:23', '2023-01-23 15:26:23'),
(23, '00002', '01529', '01529', 'Sultan Agung (KK)', 'Semarang', 'Komp. Pertokoan Taman Diponegoro No. 1B, Jl. Sultan Agung, Semarang', -7.0076604264442865, 110.41575456975151, '2023-01-23 15:26:23', '2023-01-23 15:26:23'),
(24, '00002', '01529', '01447', 'UNDIP (KK)', 'Semarang', 'Kompleks Ruko Thamrin Square, Semarang', -7.0559408005501645, 110.43925849489177, '2023-01-23 15:26:23', '2023-01-23 15:26:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mst_bank`
--
ALTER TABLE `mst_bank`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mst_bank_code_unique` (`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mst_bank`
--
ALTER TABLE `mst_bank`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
