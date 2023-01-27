/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.27-MariaDB : Database - u1573577_antrian
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`u1573577_antrian` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `u1573577_antrian`;

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_resets_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1),
(4,'2019_12_14_000001_create_personal_access_tokens_table',1),
(5,'2022_12_21_065415_create_master_bank',1),
(6,'2022_12_21_082700_create_unit_codes_table',1),
(7,'2022_12_22_082829_create_queue',1);

/*Table structure for table `mst_bank` */

DROP TABLE IF EXISTS `mst_bank`;

CREATE TABLE `mst_bank` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `mst_bank_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `mst_bank` */

insert  into `mst_bank`(`id`,`code`,`name`,`city`,`address`,`latitude`,`longitude`,`created_at`,`updated_at`) values 
(1,'0197','Yogyakarta (KW)','Jogyakarta','Jl. Cik Ditiro No. 3 Yogyakarta D.I. Yogyakarta',-7.7867472,110.6300068,'2023-01-23 22:26:23','2023-01-23 22:26:23');

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `queue` */

DROP TABLE IF EXISTS `queue`;

CREATE TABLE `queue` (
  `ip` varchar(45) NOT NULL,
  `id` char(36) NOT NULL,
  `queue_for` date NOT NULL,
  `number_queue` varchar(255) NOT NULL,
  `unit_code` varchar(255) NOT NULL,
  `unit_code_name` varchar(255) NOT NULL,
  `bank_id` bigint(20) unsigned NOT NULL,
  `bank_code` varchar(100) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `bank_address` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  UNIQUE KEY `queue_id_unique` (`id`),
  KEY `queue_unit_code_foreign` (`unit_code`),
  KEY `queue_bank_id_foreign` (`bank_id`),
  CONSTRAINT `queue_bank_id_foreign` FOREIGN KEY (`bank_id`) REFERENCES `mst_bank` (`id`),
  CONSTRAINT `queue_unit_code_foreign` FOREIGN KEY (`unit_code`) REFERENCES `unit_codes` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `queue` */

insert  into `queue`(`ip`,`id`,`queue_for`,`number_queue`,`unit_code`,`unit_code_name`,`bank_id`,`bank_code`,`bank_name`,`bank_address`,`created_at`,`updated_at`) values 
('::1','68baa85b-8834-483c-9d79-f090afd64dc4','2023-01-26','001','B','CS',1,'0197','Yogyakarta (KW)','Jl. Cik Ditiro No. 3 Yogyakarta D.I. Yogyakarta','2023-01-23 23:10:28','2023-01-23 23:10:28');

/*Table structure for table `transactioncust` */

DROP TABLE IF EXISTS `transactioncust`;

CREATE TABLE `transactioncust` (
  `BaseDt` char(8) DEFAULT NULL,
  `SeqNumber` char(4) DEFAULT NULL,
  `TrxDesc` varchar(10) DEFAULT NULL,
  `TimeTicket` char(8) DEFAULT NULL,
  `TimeCall` char(8) DEFAULT NULL,
  `CustWaitDuration` char(8) DEFAULT NULL,
  `UnitServe` char(1) DEFAULT NULL,
  `CounterNo` char(2) DEFAULT NULL,
  `Absent` char(1) DEFAULT 'N',
  `UserId` varchar(10) DEFAULT NULL,
  `Flag` char(1) DEFAULT NULL,
  `TimeEnd` char(8) DEFAULT NULL,
  `Tservice` varchar(8) DEFAULT NULL,
  `TWservice` varchar(8) DEFAULT NULL,
  `TSLAservice` varchar(8) DEFAULT NULL,
  `TOverSLA` varchar(8) DEFAULT NULL,
  `QrSeqNumber` varchar(4) DEFAULT NULL,
  `OnlineQ` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='InnoDB free: 4096 kB; InnoDB free: 4096 kB; InnoDB free: 409';

/*Data for the table `transactioncust` */

insert  into `transactioncust`(`BaseDt`,`SeqNumber`,`TrxDesc`,`TimeTicket`,`TimeCall`,`CustWaitDuration`,`UnitServe`,`CounterNo`,`Absent`,`UserId`,`Flag`,`TimeEnd`,`Tservice`,`TWservice`,`TSLAservice`,`TOverSLA`,`QrSeqNumber`,`OnlineQ`) values 
('20210605','A001','1111','21:50:07','22:22:28','00:32:21','A','02','N','teller1','N','22:22:39','00:00:03','00:00:06','00:05:00','00:00:00','',NULL),
('20210605','A002','Antrian Te','21:51:03','22:28:20','00:37:17','A','02','N','teller1','N','22:28:26','00:00:04',NULL,NULL,NULL,'',NULL),
('20210605','A003','Antrian Te','21:52:35','22:29:01','00:36:26','A','02','N','teller1','N','22:29:12','00:00:02',NULL,NULL,NULL,'',NULL),
('20210607','A001','1113','23:43:41','23:49:41','00:06:00','A','02','N','teller1','N','23:49:52','00:00:04','00:00:06','00:06:00','00:00:00','',NULL),
('20210607','A002','1115','23:45:25','23:50:32','00:05:07','A','02','N','teller1','N','23:50:46','00:00:04','00:00:09','00:10:00','00:00:00','',NULL),
('20210608','A001','Antrian Te','00:14:29','00:15:19','00:00:50','A','02','N','teller1','N','00:15:31','00:00:00',NULL,NULL,NULL,'',NULL),
('20210608','A002','Antrian Te','00:14:41','00:15:47','00:01:06','A','02','N','teller1','N','00:16:37','00:00:37',NULL,NULL,NULL,'',NULL),
('20210829','B001','2222','20:39:24','20:44:31','00:05:07','B','02','N','CS1','N','20:44:47','00:00:03','00:00:12','00:05:00','00:00:00','',NULL),
('20210829','B002','2222','20:41:15','20:45:08','00:03:53','B','02','N','CS1','R','20:45:20','00:00:01','00:00:07','00:05:00','00:00:00','',NULL),
(NULL,NULL,'2222',NULL,'20:45:50','00:04:35','B','02','N','CS1','R','20:45:59','00:00:01','00:00:02','00:05:00','00:00:00','',NULL),
('20210829','B003','2222','20:41:30','20:46:53','00:05:23','B','02','N','CS1','N','20:47:00','00:00:04','00:00:02','00:05:00','00:00:00','',NULL),
('20210829','B004','2222','20:41:33','20:49:23','00:07:50','B','02','N','CS1','N','20:49:33','00:00:01','00:00:07','00:05:00','00:00:00','',NULL),
('20230121','A001','1111','15:05:07','01:03:28','14:01:39','A','02','N','teller1','N','01:03:58','00:00:17','00:00:13','00:05:00','00:00:00',NULL,NULL),
('20230121','A002','1111','21:26:49','01:04:48','20:22:01','A','02','N','teller1','N','01:05:11','00:00:04','00:00:12','00:05:00','00:00:00',NULL,NULL),
('20230121','A007','1111','23:23:26','01:05:19','22:18:07','A','02','N','teller1','N','01:05:27','00:00:01','00:00:05','00:05:00','00:00:00',NULL,NULL),
('20230121','A003','1111','23:00:38','01:06:44','21:53:54','A','02','N','teller1','N','01:07:02','00:00:06','00:00:07','00:05:00','00:00:00',NULL,NULL),
('20230121','A004','1111','23:02:13','01:10:55','21:51:18','A','02','N','teller1','N','01:11:04','00:00:01','00:00:06','00:05:00','00:00:00',NULL,NULL),
('20230121','A005','1111','23:03:53','01:11:46','21:52:07','A','02','N','teller1','N','01:12:00','00:00:01','00:00:11','00:05:00','00:00:00',NULL,NULL),
('20230121','A006','1111','23:12:55','01:14:51','21:58:04','A','02','N','teller1','N','01:15:04','00:00:01','00:00:10','00:05:00','00:00:00',NULL,NULL),
('20230121','A008','1111','23:23:51','01:15:45','22:08:06','A','02','N','teller1','N','01:16:21','00:00:13','00:00:22','00:05:00','00:00:00',NULL,NULL),
('20230121','A009','1113','23:25:20','01:20:51','22:04:29','A','02','N','teller1','N','01:21:02','00:00:02','00:00:08','00:05:00','00:00:00',NULL,NULL),
('20230121','B001','2224','15:05:13','01:25:54','13:39:19','B','02','N','cs1','N','01:26:01','00:00:00','00:00:05','00:05:00','00:00:00','B001','N'),
('20230122','B004','2223','00:43:29','01:26:26','0:42:57','B','02','N','cs1','N','01:26:33','00:00:01','00:00:05','00:05:00','00:00:00','B001','Y'),
('20230121','A001','1111','15:05:07','16:22:19','1:17:12','A','01','N','01A','N','16:22:19','00:00:00','00:00:00','00:00:00','00:00:00',NULL,NULL),
('20230121','A002','1111','21:26:49','16:22:32','5:04:17','A','02','N','02A','N','16:22:32','00:00:00','00:00:00','00:00:00','00:00:00',NULL,NULL),
('20230121','B001','2222','15:05:13','16:26:51','1:21:38','B','02','N','02B','N','16:26:51','00:00:00','00:00:00','00:00:00','00:00:00',NULL,NULL),
('20230121','A003','1111','23:00:38','16:33:27','6:27:11','A','01','N','01A','N','16:33:27','00:00:00','00:00:00','00:00:00','00:00:00',NULL,NULL),
('20230121','B002','2222','21:27:12','16:33:43','4:53:29','B','02','N','02B','N','16:33:43','00:00:00','00:00:00','00:00:00','00:00:00',NULL,NULL),
('20230121','A004','1111','23:02:13','16:34:55','6:27:18','A','01','N','01A','N','16:34:55','00:00:00','00:00:00','00:00:00','00:00:00',NULL,NULL),
('20230121','A005','1111','23:03:53','16:40:15','6:23:38','A','01','N','01A','N','16:40:15','00:00:00','00:00:00','00:00:00','00:00:00','A005','N'),
('20230121','A007','1112','23:23:26','17:24:09','5:59:17','A','02','N','teller1','N','17:24:38','00:00:05','00:00:22','00:05:00','00:00:00','A001','Y'),
('20230121','A006','1111','23:12:55','17:24:58','5:47:57','A','02','N','teller1','N','17:25:18','00:00:00','00:00:19','00:05:00','00:00:00','A006','N');

/*Table structure for table `unit_codes` */

DROP TABLE IF EXISTS `unit_codes`;

CREATE TABLE `unit_codes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unit_codes_code_unique` (`code`),
  UNIQUE KEY `unit_codes_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `unit_codes` */

insert  into `unit_codes`(`id`,`code`,`name`,`created_at`,`updated_at`) values 
(1,'A','Teller','2023-01-23 22:07:47','2023-01-23 22:07:47'),
(2,'B','CS','2023-01-23 22:07:54','2023-01-23 22:07:54');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`) values 
(1,'Admin','admin@mail.com',NULL,'$2y$10$pdN99fFRHR5nzsAeyeTdrupR.IqIDry29boG/Ua/zYjiyiBUeQ7iy',NULL,'2023-01-23 22:07:05','2023-01-23 22:07:05');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
