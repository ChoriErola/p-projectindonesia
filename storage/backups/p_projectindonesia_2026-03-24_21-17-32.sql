-- MySQL dump 10.13  Distrib 5.7.39, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: p_projectindonesia
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `about_us`
--

DROP TABLE IF EXISTS `about_us`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `about_us` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `about_us`
--

LOCK TABLES `about_us` WRITE;
/*!40000 ALTER TABLE `about_us` DISABLE KEYS */;
INSERT INTO `about_us` VALUES (2,'P Project Indonesia','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. ','about-us/01KEAAP7DTRWDKZB7TFVDF2RH7.jpg','2025-12-15 06:12:55','2026-01-06 18:56:40');
/*!40000 ALTER TABLE `about_us` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('p-project-indonesia-cache-spatie.permission.cache','a:3:{s:5:\"alias\";a:0:{}s:11:\"permissions\";a:0:{}s:5:\"roles\";a:0:{}}',1774447402);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_us`
--

DROP TABLE IF EXISTS `contact_us`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact_us` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_hp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `map_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_us`
--

LOCK TABLES `contact_us` WRITE;
/*!40000 ALTER TABLE `contact_us` DISABLE KEYS */;
INSERT INTO `contact_us` VALUES (1,'P Project Indonesia','PROJECTP643@GMAIL.COM','0811-741-1190','JL GURU MUCTHAR RT 13 RW 03 NO 38 JELUTUNG JAMBI 36136','https://www.google.com/maps/embed?pb=!1m12!1m8!1m3!1d906.1797851888309!2d103.6185691!3d-1.6169311!3m2!1i1024!2i768!4f13.1!2m1!1sJL%20GURU%20MUCTHAR%20RT%2013%20RW%2003%20NO%2038%20JELUTUNG%20JAMBI%2036136!5e1!3m2!1sen!2sid!4v1767725643712!5m2!1sen!2sid','2025-12-18 06:30:08','2026-01-06 18:54:35');
/*!40000 ALTER TABLE `contact_us` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2025_10_15_170201_create_permission_tables',1),(5,'2025_10_18_051820_add_role_to_users_table',1),(7,'2025_10_20_135316_remove_no_hp_and_alamat_from_users_table',2),(8,'2025_11_10_204845_add_avatar_url_column_to_users_table',3),(9,'2025_11_24_165338_create_packages_table',4),(10,'2025_11_24_171505_add_image_to_packages_table',5),(11,'2025_11_24_180944_update_packages_description_column',6),(12,'2025_11_24_184400_add_no_hp_and_alamat_to_users_table',7),(13,'2025_11_27_232337_create_services_table',8),(14,'2025_11_27_232943_create_packages_services_table',8),(15,'2025_11_30_140201_drop_description_from_packages_table',9),(17,'2025_11_30_143925_create_orders_table',10),(18,'2025_11_30_151600_create_order_services_table',10),(19,'2025_12_02_232040_add_packages_to_order_sevices_table',11),(20,'2025_12_03_001640_rename_packages_id_to_package_id_in_order_services_table',12),(21,'2025_12_10_180932_add_alamat_to_orders_table',13),(22,'2025_12_15_123102_create_about_us_table',14),(26,'2025_12_15_131848_create_contact_us_table',15),(27,'2025_12_15_180928_add_bukti_pembayaran_to_orders_table',16),(28,'2025_12_16_155636_add_payment_status_to_orders_table',17),(30,'2025_12_17_130353_create_order_histories_table',18),(31,'2025_12_17_141510_remove_payment_status_columns_from_order_histories_table',19),(32,'2025_12_18_135607_add_acara_to_orders_table',20),(34,'2025_12_18_add_notes_to_order_services_table',21),(35,'2025_12_27_111638_create_portfolio_images_table',22),(36,'2025_12_27_120629_remove_image_column_from_portfolio_images_table',23),(37,'2025_12_27_121058_make_images_nullable_on_portfolio_images_table',24),(38,'2025_01_06_000001_update_payment_status_enum_in_orders_table',25),(39,'2026_01_25_000001_add_amount_paid_to_orders_table',26),(40,'2026_01_25_000002_drop_payment_note_from_orders_table',27),(41,'2026_01_25_145145_add_payment_note_to_orders_table',28);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_histories`
--

DROP TABLE IF EXISTS `order_histories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_histories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint unsigned NOT NULL,
  `old_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `new_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `changed_by` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_histories_order_id_foreign` (`order_id`),
  KEY `order_histories_changed_by_foreign` (`changed_by`),
  CONSTRAINT `order_histories_changed_by_foreign` FOREIGN KEY (`changed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `order_histories_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_histories`
--

LOCK TABLES `order_histories` WRITE;
/*!40000 ALTER TABLE `order_histories` DISABLE KEYS */;
INSERT INTO `order_histories` VALUES (21,53,'pending','confirmed',NULL,3,'2026-01-20 11:18:26','2026-01-20 11:18:26'),(22,53,'confirmed','paid in progress',NULL,3,'2026-01-25 05:46:48','2026-01-25 05:46:48'),(23,54,'confirmed','confirmed',NULL,3,'2026-01-25 06:27:45','2026-01-25 06:27:45'),(24,54,'confirmed','paid in progress',NULL,3,'2026-01-25 06:27:59','2026-01-25 06:27:59');
/*!40000 ALTER TABLE `order_histories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_services`
--

DROP TABLE IF EXISTS `order_services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_services` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `order_id` bigint unsigned NOT NULL,
  `service_id` bigint unsigned DEFAULT NULL,
  `package_id` bigint unsigned DEFAULT NULL,
  `service_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `is_required` tinyint(1) NOT NULL DEFAULT '0',
  `is_custom` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_services_order_id_foreign` (`order_id`),
  KEY `order_services_service_id_foreign` (`service_id`),
  KEY `order_services_package_id_foreign` (`package_id`),
  CONSTRAINT `order_services_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_services_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE SET NULL,
  CONSTRAINT `order_services_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=1491 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_services`
--

LOCK TABLES `order_services` WRITE;
/*!40000 ALTER TABLE `order_services` DISABLE KEYS */;
INSERT INTO `order_services` VALUES (1451,53,1,NULL,'Dekorasi',5000000.00,NULL,0,0,'2026-01-20 11:15:34','2026-01-20 11:15:34'),(1452,53,6,NULL,'Pelaminan',10000000.00,NULL,0,0,'2026-01-20 11:15:34','2026-01-20 11:15:34'),(1453,53,7,NULL,'Welcome Gate',200000.00,NULL,0,0,'2026-01-20 11:15:34','2026-01-20 11:15:34'),(1454,53,8,NULL,'Welcom Sign',200000.00,NULL,0,0,'2026-01-20 11:15:34','2026-01-20 11:15:34'),(1455,53,10,NULL,'Kotak Pundi',100000.00,NULL,0,0,'2026-01-20 11:15:34','2026-01-20 11:15:34'),(1456,53,11,NULL,'Lighting',250000.00,NULL,0,0,'2026-01-20 11:15:34','2026-01-20 11:15:34'),(1457,53,12,NULL,'Handbouquet',100000.00,NULL,0,0,'2026-01-20 11:15:34','2026-01-20 11:15:34'),(1458,53,13,NULL,'Photographer',500000.00,NULL,0,0,'2026-01-20 11:15:34','2026-01-20 11:15:34'),(1459,53,16,NULL,'Videographer',5000000.00,NULL,0,0,'2026-01-20 11:15:34','2026-01-20 11:15:34'),(1460,53,17,NULL,'All FIle Save FD',1000000.00,NULL,0,0,'2026-01-20 11:15:34','2026-01-20 11:15:34'),(1461,53,18,NULL,'Penerapan Protokol Kesehatan',0.00,NULL,0,0,'2026-01-20 11:15:34','2026-01-20 11:15:34'),(1462,53,20,NULL,'Acoustic (Main Vocal, Rhytm Guitar, Keyboard, Cajon, Percussion',5000000.00,NULL,0,0,'2026-01-20 11:15:34','2026-01-20 11:15:34'),(1463,53,21,NULL,'MC Akad dan Resepsi',1500000.00,NULL,0,0,'2026-01-20 11:15:34','2026-01-20 11:15:34'),(1464,53,22,NULL,'Mini Garden',1500000.00,NULL,0,0,'2026-01-20 11:15:34','2026-01-20 11:15:34'),(1465,53,23,NULL,'Backdrop Penanti Tamu',500000.00,NULL,0,0,'2026-01-20 11:15:34','2026-01-20 11:15:34'),(1466,53,24,NULL,'7 Crew WO 1 Hari Acara',1200000.00,NULL,0,0,'2026-01-20 11:15:34','2026-01-20 11:15:34'),(1467,53,28,NULL,'Make Up + Busana Penanti Buku Tamu 4 Orang',4000000.00,NULL,0,0,'2026-01-20 11:15:34','2026-01-20 11:15:34'),(1468,53,29,NULL,'Tenda',5000000.00,NULL,0,0,'2026-01-20 11:15:34','2026-01-20 11:15:34'),(1469,53,30,NULL,'Meja',300000.00,NULL,0,0,'2026-01-20 11:15:34','2026-01-20 11:15:34'),(1470,53,31,NULL,'Kursi',300000.00,NULL,0,0,'2026-01-20 11:15:34','2026-01-20 11:15:34'),(1471,53,32,NULL,'Karpet',500000.00,NULL,0,0,'2026-01-20 11:15:34','2026-01-20 11:15:34'),(1472,53,33,NULL,'Konsultasi & koordinasi Vendor',0.00,NULL,0,0,'2026-01-20 11:15:34','2026-01-20 11:15:34'),(1473,53,34,NULL,'Wedding Guidebook',50000.00,NULL,0,0,'2026-01-20 11:15:34','2026-01-20 11:15:34'),(1474,53,37,NULL,'Create Rundown',0.00,NULL,0,0,'2026-01-20 11:15:34','2026-01-20 11:15:34'),(1475,53,38,NULL,'Make Up + Busana Orang Tua & Besan 2 Pasang',10000000.00,NULL,0,0,'2026-01-20 11:15:34','2026-01-20 11:15:34'),(1476,53,39,NULL,'1x Technical Meeting',0.00,NULL,0,0,'2026-01-20 11:15:34','2026-01-20 11:15:34'),(1477,53,40,NULL,'Make Up 1x + Retouch & Busana Pengantin 2 Pasang',10000000.00,NULL,0,0,'2026-01-20 11:15:34','2026-01-20 11:15:34'),(1478,54,18,NULL,'Penerapan Protokol Kesehatan',0.00,NULL,0,0,'2026-01-25 06:27:32','2026-01-25 06:27:32'),(1479,54,24,NULL,'7 Crew WO 1 Hari Acara',1200000.00,NULL,0,0,'2026-01-25 06:27:32','2026-01-25 06:27:32'),(1480,54,33,NULL,'Konsultasi & koordinasi Vendor',0.00,NULL,0,0,'2026-01-25 06:27:32','2026-01-25 06:27:32'),(1481,54,34,NULL,'Wedding Guidebook',50000.00,NULL,0,0,'2026-01-25 06:27:32','2026-01-25 06:27:32'),(1482,54,37,NULL,'Create Rundown',0.00,NULL,0,0,'2026-01-25 06:27:32','2026-01-25 06:27:32'),(1483,54,39,NULL,'1x Technical Meeting',0.00,NULL,0,0,'2026-01-25 06:27:32','2026-01-25 06:27:32'),(1484,54,20,NULL,'Acoustic (Main Vocal, Rhytm Guitar, Keyboard, Cajon, Percussion',5000000.00,NULL,0,1,'2026-01-25 06:27:45','2026-01-25 06:27:45'),(1485,55,18,NULL,'Penerapan Protokol Kesehatan',0.00,NULL,0,0,'2026-01-25 07:57:37','2026-01-25 07:57:37'),(1486,55,33,NULL,'Konsultasi & koordinasi Vendor',0.00,NULL,0,0,'2026-01-25 07:57:37','2026-01-25 07:57:37'),(1487,55,34,NULL,'Wedding Guidebook',50000.00,NULL,0,0,'2026-01-25 07:57:37','2026-01-25 07:57:37'),(1488,55,36,NULL,'5 Crew WO 1 Hari Acara',1000000.00,NULL,0,0,'2026-01-25 07:57:37','2026-01-25 07:57:37'),(1489,55,37,NULL,'Create Rundown',0.00,NULL,0,0,'2026-01-25 07:57:37','2026-01-25 07:57:37'),(1490,55,39,NULL,'1x Technical Meeting',0.00,NULL,0,0,'2026-01-25 07:57:37','2026-01-25 07:57:37');
/*!40000 ALTER TABLE `order_services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `package_id` bigint unsigned DEFAULT NULL,
  `order_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_date` date NOT NULL,
  `acara` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `base_price` decimal(15,2) NOT NULL DEFAULT '0.00',
  `total_price` decimal(15,2) NOT NULL DEFAULT '0.00',
  `amount_paid` decimal(15,2) DEFAULT '0.00',
  `payment_note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `payment_status` enum('unpaid','pending','approved','rejected','paid in progress','paid completed') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'unpaid',
  `bukti_pembayaran` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `payment_approved_at` timestamp NULL DEFAULT NULL,
  `payment_approved_by` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orders_order_code_unique` (`order_code`),
  KEY `orders_user_id_foreign` (`user_id`),
  KEY `orders_package_id_foreign` (`package_id`),
  KEY `orders_payment_approved_by_foreign` (`payment_approved_by`),
  CONSTRAINT `orders_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE SET NULL,
  CONSTRAINT `orders_payment_approved_by_foreign` FOREIGN KEY (`payment_approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (53,5,4,'ORD-20260120-ZHDVYL','2026-01-31','akad nikah',147500000.00,147500000.00,50000000.00,'DP 1 50.000.000','paid in progress','paid in progress','[\"bukti-pembayaran\\/01KFSVJWC4NJ2BJ19VJN1HZRGV.png\"]','jalan 2','1231234123','2026-01-20 11:15:34','2026-01-25 08:03:35',NULL,NULL),(54,11,6,'ORD-20260125-HBVD6H','2026-01-31','nikah',48900000.00,55100000.00,25000000.00,'DP 1 25.000.000','paid in progress','paid in progress','[\"bukti-pembayaran\\/01KFSXP0GD7Z6Z4T8QH3H8QH3T.png\"]','2131231','sesuai acara','2026-01-25 06:27:32','2026-01-25 07:53:19',NULL,NULL),(55,9,6,'ORD-20260125-CL3FTC','2026-02-07','sadasd',48900000.00,49900000.00,0.00,NULL,'confirmed','unpaid',NULL,'adsasd','12312','2026-01-25 07:57:37','2026-01-25 07:57:37',NULL,NULL);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `packages`
--

DROP TABLE IF EXISTS `packages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `packages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `packages`
--

LOCK TABLES `packages` WRITE;
/*!40000 ALTER TABLE `packages` DISABLE KEYS */;
INSERT INTO `packages` VALUES (1,'Standar','packages/01KEAB93MX8ACZ1S4VVXEV1768.jpg',100000000.00,'2025-11-24 10:41:11','2026-01-06 19:06:59'),(2,'Paket Pre-Wedding Indoor','packages/01KEABA35ZBZDNYZBTKDB7YCVP.jpg',150000000.00,'2025-11-24 11:13:24','2026-01-06 19:07:31'),(4,'Paket Pre-Wedding Outdoor','packages/01KEABAW2RK07PQH1BGGK98H3Z.jpg',150000000.00,'2025-11-24 11:34:19','2026-01-06 19:07:57'),(6,'Paket WO Only','packages/01KEABBFZXZ026R4FXRYXE5X55.jpg',50000000.00,'2025-11-27 14:34:58','2026-01-06 19:08:17'),(7,'Paket WO All-In','packages/01KEABBXQ40R332F243RB1RAN6.jpg',60000000.00,'2025-11-27 14:55:59','2026-01-06 19:08:31'),(9,'intimate Wedding Package (100 Pax)','packages/01KEABDJBMA60027T54DN1DW96.jpg',130000000.00,'2025-11-30 07:20:51','2026-01-06 19:09:25'),(12,'intimate Wedding Package (400 Pax)','packages/01KEABE019AZE8W5S7958B0E91.jpg',150000000.00,'2025-12-10 13:36:47','2026-01-06 19:09:39');
/*!40000 ALTER TABLE `packages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `packages_services`
--

DROP TABLE IF EXISTS `packages_services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `packages_services` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `package_id` bigint unsigned NOT NULL,
  `service_id` bigint unsigned NOT NULL,
  `value_price` decimal(15,2) NOT NULL DEFAULT '0.00',
  `is_required` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `packages_services_package_id_foreign` (`package_id`),
  KEY `packages_services_service_id_foreign` (`service_id`),
  CONSTRAINT `packages_services_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE,
  CONSTRAINT `packages_services_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=197 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `packages_services`
--

LOCK TABLES `packages_services` WRITE;
/*!40000 ALTER TABLE `packages_services` DISABLE KEYS */;
INSERT INTO `packages_services` VALUES (2,1,1,5000000.00,1,'2025-11-28 18:29:12','2025-11-28 18:29:12'),(4,2,1,5000000.00,1,'2025-11-28 18:33:48','2025-11-28 18:33:48'),(6,2,9,1500000.00,1,'2025-11-30 06:07:48','2025-11-30 06:07:48'),(7,2,12,100000.00,1,'2025-11-30 06:07:48','2025-11-30 06:07:48'),(8,2,10,100000.00,1,'2025-11-30 06:07:48','2025-11-30 06:07:48'),(9,2,11,250000.00,1,'2025-11-30 06:07:48','2025-11-30 06:07:48'),(11,2,6,10000000.00,1,'2025-11-30 06:07:48','2025-11-30 06:07:48'),(12,2,13,500000.00,1,'2025-11-30 06:07:48','2025-11-30 06:07:48'),(13,2,8,200000.00,1,'2025-11-30 06:07:48','2025-11-30 06:07:48'),(14,2,7,200000.00,1,'2025-11-30 06:07:48','2025-11-30 06:07:48'),(30,7,1,5000000.00,1,'2025-11-30 07:13:24','2025-11-30 07:13:24'),(31,7,11,250000.00,1,'2025-11-30 07:13:24','2025-11-30 07:13:24'),(32,7,10,100000.00,1,'2025-11-30 07:13:24','2025-11-30 07:13:24'),(33,7,8,200000.00,1,'2025-11-30 07:13:24','2025-11-30 07:13:24'),(34,7,31,300000.00,1,'2025-11-30 07:13:24','2025-11-30 07:13:24'),(35,7,32,500000.00,1,'2025-11-30 07:13:24','2025-11-30 07:13:24'),(37,7,33,0.00,1,'2025-11-30 07:13:24','2025-11-30 07:13:24'),(38,7,39,0.00,1,'2025-11-30 07:13:24','2025-11-30 07:13:24'),(39,7,37,0.00,1,'2025-11-30 07:13:25','2025-11-30 07:13:25'),(40,7,34,50000.00,1,'2025-11-30 07:13:25','2025-11-30 07:13:25'),(41,7,18,0.00,1,'2025-11-30 07:13:25','2025-11-30 07:13:25'),(42,7,27,6000000.00,1,'2025-11-30 07:13:25','2025-11-30 07:13:25'),(43,7,13,500000.00,1,'2025-11-30 07:13:25','2025-11-30 07:13:25'),(44,7,16,5000000.00,1,'2025-11-30 07:13:25','2025-11-30 07:13:25'),(45,7,29,5000000.00,1,'2025-11-30 07:13:25','2025-11-30 07:13:25'),(46,7,17,1000000.00,1,'2025-11-30 07:13:25','2025-11-30 07:13:25'),(47,7,9,1500000.00,1,'2025-11-30 07:14:19','2025-11-30 07:14:19'),(48,7,12,100000.00,1,'2025-11-30 07:14:19','2025-11-30 07:14:19'),(49,7,24,1200000.00,1,'2025-11-30 07:14:19','2025-11-30 07:14:19'),(50,7,41,8000000.00,1,'2025-11-30 07:14:19','2025-11-30 07:14:19'),(52,7,21,1500000.00,1,'2025-11-30 07:14:19','2025-11-30 07:14:19'),(53,7,22,1500000.00,1,'2025-11-30 07:14:19','2025-11-30 07:14:19'),(54,7,6,10000000.00,1,'2025-11-30 07:14:19','2025-11-30 07:14:19'),(55,7,7,200000.00,1,'2025-11-30 07:14:19','2025-11-30 07:14:19'),(56,2,22,1500000.00,1,'2025-11-30 07:16:12','2025-11-30 07:16:12'),(57,2,29,5000000.00,1,'2025-11-30 07:16:12','2025-11-30 07:16:12'),(58,2,16,5000000.00,1,'2025-11-30 07:16:12','2025-11-30 07:16:12'),(59,2,34,50000.00,1,'2025-11-30 07:16:12','2025-11-30 07:16:12'),(60,2,35,1100000.00,1,'2025-11-30 07:16:12','2025-11-30 07:16:12'),(61,2,33,0.00,1,'2025-11-30 07:16:12','2025-11-30 07:16:12'),(62,2,32,500000.00,1,'2025-11-30 07:16:12','2025-11-30 07:16:12'),(63,2,31,300000.00,1,'2025-11-30 07:16:12','2025-11-30 07:16:12'),(64,2,30,300000.00,1,'2025-11-30 07:16:12','2025-11-30 07:16:12'),(65,2,25,4000000.00,1,'2025-11-30 07:16:12','2025-11-30 07:16:12'),(67,2,40,10000000.00,1,'2025-11-30 07:16:12','2025-11-30 07:16:12'),(68,2,38,10000000.00,1,'2025-11-30 07:16:12','2025-11-30 07:16:12'),(69,2,28,4000000.00,1,'2025-11-30 07:16:12','2025-11-30 07:16:12'),(70,2,18,0.00,1,'2025-11-30 07:16:12','2025-11-30 07:16:12'),(71,2,39,0.00,1,'2025-11-30 07:16:12','2025-11-30 07:16:12'),(72,2,17,1000000.00,1,'2025-11-30 07:16:12','2025-11-30 07:16:12'),(73,4,39,0.00,1,'2025-11-30 07:17:07','2025-11-30 07:17:07'),(74,4,24,1200000.00,1,'2025-11-30 07:17:07','2025-11-30 07:17:07'),(75,4,20,5000000.00,1,'2025-11-30 07:17:07','2025-11-30 07:17:07'),(76,4,17,1000000.00,1,'2025-11-30 07:17:07','2025-11-30 07:17:07'),(78,4,23,500000.00,1,'2025-11-30 07:17:07','2025-11-30 07:17:07'),(79,4,37,0.00,1,'2025-11-30 07:17:07','2025-11-30 07:17:07'),(80,4,1,5000000.00,1,'2025-11-30 07:17:07','2025-11-30 07:17:07'),(81,4,12,100000.00,1,'2025-11-30 07:17:07','2025-11-30 07:17:07'),(82,4,32,500000.00,1,'2025-11-30 07:17:07','2025-11-30 07:17:07'),(83,4,33,0.00,1,'2025-11-30 07:17:07','2025-11-30 07:17:07'),(84,4,10,100000.00,1,'2025-11-30 07:17:07','2025-11-30 07:17:07'),(85,4,31,300000.00,1,'2025-11-30 07:17:07','2025-11-30 07:17:07'),(86,4,11,250000.00,1,'2025-11-30 07:17:07','2025-11-30 07:17:07'),(87,4,38,10000000.00,1,'2025-11-30 07:17:07','2025-11-30 07:17:07'),(88,4,28,4000000.00,1,'2025-11-30 07:17:07','2025-11-30 07:17:07'),(89,4,40,10000000.00,1,'2025-11-30 07:17:07','2025-11-30 07:17:07'),(90,4,21,1500000.00,1,'2025-11-30 07:17:07','2025-11-30 07:17:07'),(91,4,30,300000.00,1,'2025-11-30 07:17:07','2025-11-30 07:17:07'),(92,4,22,1500000.00,1,'2025-11-30 07:17:07','2025-11-30 07:17:07'),(93,4,6,10000000.00,1,'2025-11-30 07:17:07','2025-11-30 07:17:07'),(94,4,18,0.00,1,'2025-11-30 07:17:07','2025-11-30 07:17:07'),(95,4,13,500000.00,1,'2025-11-30 07:17:07','2025-11-30 07:17:07'),(96,4,29,5000000.00,1,'2025-11-30 07:17:07','2025-11-30 07:17:07'),(97,4,16,5000000.00,1,'2025-11-30 07:17:07','2025-11-30 07:17:07'),(98,4,34,50000.00,1,'2025-11-30 07:17:07','2025-11-30 07:17:07'),(100,4,8,200000.00,1,'2025-11-30 07:17:07','2025-11-30 07:17:07'),(101,4,7,200000.00,1,'2025-11-30 07:17:07','2025-11-30 07:17:07'),(102,6,39,0.00,1,'2025-11-30 07:18:07','2025-11-30 07:18:07'),(104,6,35,1100000.00,1,'2025-11-30 07:18:07','2025-11-30 07:18:07'),(105,6,37,0.00,1,'2025-11-30 07:18:07','2025-11-30 07:18:07'),(106,6,33,0.00,1,'2025-11-30 07:18:07','2025-11-30 07:18:07'),(107,6,18,0.00,1,'2025-11-30 07:18:07','2025-11-30 07:18:07'),(108,6,34,50000.00,1,'2025-11-30 07:18:07','2025-11-30 07:18:07'),(110,9,34,50000.00,1,'2025-11-30 07:20:51','2025-11-30 07:20:51'),(112,9,39,0.00,1,'2025-11-30 07:20:51','2025-11-30 07:20:51'),(113,9,37,0.00,1,'2025-11-30 07:20:51','2025-11-30 07:20:51'),(114,9,20,5000000.00,1,'2025-11-30 07:20:51','2025-11-30 07:20:51'),(115,9,43,1000000.00,1,'2025-11-30 07:20:51','2025-11-30 07:20:51'),(116,9,38,10000000.00,1,'2025-11-30 07:20:51','2025-11-30 07:20:51'),(118,9,21,1500000.00,1,'2025-11-30 07:20:51','2025-11-30 07:20:51'),(119,9,6,10000000.00,1,'2025-11-30 07:20:51','2025-11-30 07:20:51'),(120,9,22,1500000.00,1,'2025-11-30 07:20:51','2025-11-30 07:20:51'),(121,9,7,200000.00,1,'2025-11-30 07:20:51','2025-11-30 07:20:51'),(122,9,8,200000.00,1,'2025-11-30 07:20:51','2025-11-30 07:20:51'),(123,9,9,1500000.00,1,'2025-11-30 07:20:51','2025-11-30 07:20:51'),(124,9,1,5000000.00,1,'2025-11-30 07:20:51','2025-11-30 07:20:51'),(125,9,11,250000.00,1,'2025-11-30 07:20:51','2025-11-30 07:20:51'),(126,9,13,500000.00,1,'2025-11-30 07:20:51','2025-11-30 07:20:51'),(127,9,16,5000000.00,1,'2025-11-30 07:20:51','2025-11-30 07:20:51'),(128,9,29,5000000.00,1,'2025-11-30 07:20:51','2025-11-30 07:20:51'),(129,9,18,0.00,1,'2025-11-30 07:20:51','2025-11-30 07:20:51'),(130,9,30,300000.00,1,'2025-11-30 07:20:51','2025-11-30 07:20:51'),(131,9,32,500000.00,1,'2025-11-30 07:20:51','2025-11-30 07:20:51'),(132,9,33,0.00,1,'2025-11-30 07:20:51','2025-11-30 07:20:51'),(133,9,12,100000.00,1,'2025-11-30 07:20:51','2025-11-30 07:20:51'),(134,9,31,300000.00,1,'2025-11-30 07:20:51','2025-11-30 07:20:51'),(135,9,10,100000.00,1,'2025-11-30 07:20:51','2025-11-30 07:20:51'),(136,9,17,1000000.00,1,'2025-11-30 07:20:51','2025-11-30 07:20:51'),(137,1,29,5000000.00,1,'2025-11-30 07:22:53','2025-11-30 07:22:53'),(138,1,16,5000000.00,1,'2025-11-30 07:22:53','2025-11-30 07:22:53'),(139,1,13,500000.00,1,'2025-11-30 07:22:53','2025-11-30 07:22:53'),(140,1,15,2000000.00,1,'2025-11-30 07:22:53','2025-11-30 07:22:53'),(141,1,14,2000000.00,1,'2025-11-30 07:22:53','2025-11-30 07:22:53'),(142,1,6,10000000.00,1,'2025-11-30 07:22:53','2025-11-30 07:22:53'),(143,1,17,1000000.00,1,'2025-11-30 07:22:53','2025-11-30 07:22:53'),(144,1,10,100000.00,1,'2025-11-30 07:22:53','2025-11-30 07:22:53'),(145,1,31,300000.00,1,'2025-11-30 07:22:53','2025-11-30 07:22:53'),(146,1,30,300000.00,1,'2025-11-30 07:22:53','2025-11-30 07:22:53'),(147,1,9,1500000.00,1,'2025-11-30 07:22:53','2025-11-30 07:22:53'),(148,1,36,1000000.00,1,'2025-11-30 07:22:53','2025-11-30 07:22:53'),(149,1,39,0.00,1,'2025-11-30 07:22:53','2025-11-30 07:22:53'),(150,1,37,0.00,1,'2025-11-30 07:22:53','2025-11-30 07:22:53'),(151,1,11,250000.00,1,'2025-11-30 07:22:53','2025-11-30 07:22:53'),(152,1,33,0.00,1,'2025-11-30 07:22:53','2025-11-30 07:22:53'),(153,1,38,10000000.00,1,'2025-11-30 07:22:53','2025-11-30 07:22:53'),(155,9,24,0.00,1,'2025-12-09 06:52:56','2025-12-09 06:52:56'),(156,9,40,0.00,1,'2025-12-09 06:52:56','2025-12-09 06:52:56'),(164,1,48,0.00,1,'2025-12-10 12:40:27','2025-12-10 12:40:27'),(165,2,48,0.00,1,'2025-12-10 12:40:37','2025-12-10 12:40:37'),(166,4,48,0.00,1,'2025-12-10 12:40:47','2025-12-10 12:40:47'),(167,7,47,0.00,1,'2025-12-10 12:40:55','2025-12-10 12:40:55'),(168,9,47,0.00,1,'2025-12-10 12:41:06','2025-12-10 12:41:06'),(174,12,48,0.00,1,'2025-12-10 13:36:47','2025-12-10 13:36:47'),(175,12,39,0.00,1,'2025-12-10 13:36:47','2025-12-10 13:36:47'),(176,12,24,0.00,1,'2025-12-10 13:36:47','2025-12-10 13:36:47'),(177,12,28,0.00,1,'2025-12-10 13:36:47','2025-12-10 13:36:47'),(179,12,38,0.00,1,'2025-12-10 13:36:47','2025-12-10 13:36:47'),(180,12,40,0.00,1,'2025-12-10 13:36:47','2025-12-10 13:36:47'),(181,12,20,0.00,1,'2025-12-10 13:36:47','2025-12-10 13:36:47'),(182,12,1,0.00,1,'2025-12-10 13:36:47','2025-12-10 13:36:47'),(183,12,31,0.00,1,'2025-12-10 13:36:47','2025-12-10 13:36:47'),(184,12,11,0.00,1,'2025-12-10 13:36:47','2025-12-10 13:36:47'),(185,12,33,0.00,1,'2025-12-10 13:36:47','2025-12-10 13:36:47'),(186,12,32,0.00,1,'2025-12-10 13:36:47','2025-12-10 13:36:47'),(187,12,12,0.00,1,'2025-12-10 13:36:47','2025-12-10 13:36:47'),(188,12,16,0.00,1,'2025-12-10 13:36:47','2025-12-10 13:36:47'),(189,12,13,0.00,1,'2025-12-10 13:36:47','2025-12-10 13:36:47'),(190,12,22,0.00,1,'2025-12-10 13:36:47','2025-12-10 13:36:47'),(191,12,30,0.00,1,'2025-12-10 13:36:47','2025-12-10 13:36:47'),(192,12,21,0.00,1,'2025-12-10 13:36:47','2025-12-10 13:36:47'),(193,12,34,0.00,1,'2025-12-10 13:36:47','2025-12-10 13:36:47'),(194,12,8,0.00,1,'2025-12-10 13:36:47','2025-12-10 13:36:47'),(195,12,7,0.00,1,'2025-12-10 13:36:47','2025-12-10 13:36:47');
/*!40000 ALTER TABLE `packages_services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
INSERT INTO `password_reset_tokens` VALUES ('yoyo@gmail.com','$2y$12$cgN5C5VTQuR5pbwjy8J0V.ZQ1UHGEuD5Wv1vQfirvAC37261KAKu6','2026-01-04 09:27:54');
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `portfolio_images`
--

DROP TABLE IF EXISTS `portfolio_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `portfolio_images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `images` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `portfolio_images`
--

LOCK TABLES `portfolio_images` WRITE;
/*!40000 ALTER TABLE `portfolio_images` DISABLE KEYS */;
INSERT INTO `portfolio_images` VALUES (5,'[\"portfolios/01KEA81QA9QZY5P5GNGZR5FAMV.jpg\", \"portfolios/01KEA81QATBNTPHVR2NPH9SS53.jpg\", \"portfolios/01KEA81QB0Y1C4NBA0TQXE5MEW.jpg\", \"portfolios/01KEA81QB5H3GD9AQ092K8C3PD.jpg\", \"portfolios/01KEA81QBB5NPTE81GHYYV3FX5.jpg\", \"portfolios/01KEA81QBZ8AKTQ0P2J8NNTE2F.jpg\", \"portfolios/01KEA81QCDPZ7GKQJ08J9A85E7.jpg\"]','2025-12-27 05:17:50','2026-01-06 18:10:31'),(6,'[\"portfolios/01KEA83QA8J85E4005ZZC7TGZK.jpg\", \"portfolios/01KEA83QAGQNJ6TEH6X169AWA7.jpg\", \"portfolios/01KEA83QARG2W9R9CGXZJEXJPP.jpg\", \"portfolios/01KEA83QB6MXTKQ05JSFF429ZJ.jpg\", \"portfolios/01KEA83QBPXKE2B1MP13GZN22V.jpg\", \"portfolios/01KEA83QBYH7YGDMH86FW4SC70.jpg\"]','2025-12-27 05:19:38','2026-01-06 18:11:37'),(9,'[\"portfolios/01KEA85KXR2M2N8C0R12QSAE4H.jpg\", \"portfolios/01KEA85KY20ZD32VE30KK1T66X.jpg\", \"portfolios/01KEA85KYCE1HX0JF1AGX3FH0A.jpg\", \"portfolios/01KEA85KYT1QKMP2Y0KMZA0ZQE.jpg\", \"portfolios/01KEA85KZ7JXXHVAEYWKFYRYDS.jpg\", \"portfolios/01KEA85KZGHTG8Z77YFM0W7JTP.jpg\", \"portfolios/01KEA85M05Z3228HHAWJY1561M.jpg\", \"portfolios/01KEA85M0AP4QTQBZGMA5TAEER.jpg\", \"portfolios/01KEA85M0RFR7P6117T59MG1A4.jpg\"]','2026-01-06 05:52:28','2026-01-06 18:12:39');
/*!40000 ALTER TABLE `portfolio_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `services` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `harga_layanan` decimal(12,2) NOT NULL DEFAULT '0.00',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,'Dekorasi','Terdapat Pelaminan 6 meter, Mini garden,  Welcome gate, Welcome sign, Dekorasi Lorong, Kotak pundi, Lighting, Handbouqet.',5000000.00,1,'2025-11-27 17:43:16','2025-11-27 17:51:20'),(5,'Make Up',NULL,2000000.00,0,'2025-11-30 05:21:14','2025-12-12 13:49:48'),(6,'Pelaminan',NULL,10000000.00,1,'2025-11-30 05:46:52','2025-11-30 05:46:52'),(7,'Welcome Gate',NULL,200000.00,1,'2025-11-30 05:47:28','2025-11-30 05:47:28'),(8,'Welcom Sign',NULL,200000.00,1,'2025-11-30 05:47:42','2025-11-30 05:47:42'),(9,'Dekorasi Lorong',NULL,1500000.00,1,'2025-11-30 05:47:57','2025-11-30 05:47:57'),(10,'Kotak Pundi',NULL,100000.00,1,'2025-11-30 05:48:09','2025-11-30 05:48:09'),(11,'Lighting',NULL,250000.00,1,'2025-11-30 05:48:23','2025-11-30 05:48:23'),(12,'Handbouquet',NULL,100000.00,1,'2025-11-30 05:48:38','2025-11-30 05:48:38'),(13,'Photographer',NULL,500000.00,1,'2025-11-30 05:49:01','2025-11-30 05:49:01'),(14,'Busana Akad Nikah',NULL,2000000.00,1,'2025-11-30 06:08:30','2025-11-30 06:08:30'),(15,'Busana Resepsi',NULL,2000000.00,1,'2025-11-30 06:08:44','2025-11-30 06:08:44'),(16,'Videographer',NULL,5000000.00,1,'2025-11-30 06:09:06','2025-11-30 06:09:06'),(17,'All FIle Save FD',NULL,1000000.00,1,'2025-11-30 06:09:34','2025-11-30 06:09:34'),(18,'Penerapan Protokol Kesehatan',NULL,0.00,1,'2025-11-30 06:09:59','2025-11-30 06:09:59'),(20,'Acoustic (Main Vocal, Rhytm Guitar, Keyboard, Cajon, Percussion',NULL,5000000.00,1,'2025-11-30 06:10:59','2025-11-30 06:53:46'),(21,'MC Akad dan Resepsi',NULL,1500000.00,1,'2025-11-30 06:11:23','2025-11-30 06:11:23'),(22,'Mini Garden',NULL,1500000.00,1,'2025-11-30 06:11:51','2025-11-30 06:11:51'),(23,'Backdrop Penanti Tamu',NULL,500000.00,1,'2025-11-30 06:12:07','2025-11-30 06:12:07'),(24,'7 Crew WO 1 Hari Acara',NULL,1200000.00,1,'2025-11-30 06:12:37','2025-11-30 06:17:55'),(25,'Mini Band (Main Vocal, Rhytm Guitar, Keyboard, Drum Pad)',NULL,4000000.00,1,'2025-11-30 06:13:19','2025-11-30 06:54:08'),(26,'Busana Pengantin 2 Pasang',NULL,8000000.00,1,'2025-11-30 06:13:48','2025-11-30 06:13:48'),(27,'Make Up & Busana Orang Tua 2 Pasang',NULL,6000000.00,1,'2025-11-30 06:14:10','2025-11-30 06:14:10'),(28,'Make Up + Busana Penanti Buku Tamu 4 Orang',NULL,4000000.00,1,'2025-11-30 06:14:42','2025-11-30 06:49:11'),(29,'Tenda',NULL,5000000.00,1,'2025-11-30 06:15:00','2025-11-30 06:15:00'),(30,'Meja',NULL,300000.00,1,'2025-11-30 06:15:14','2025-11-30 06:15:14'),(31,'Kursi',NULL,300000.00,1,'2025-11-30 06:15:22','2025-11-30 06:15:22'),(32,'Karpet',NULL,500000.00,1,'2025-11-30 06:15:32','2025-11-30 06:15:32'),(33,'Konsultasi & koordinasi Vendor',NULL,0.00,1,'2025-11-30 06:15:50','2025-11-30 06:15:50'),(34,'Wedding Guidebook',NULL,50000.00,1,'2025-11-30 06:16:04','2025-11-30 06:16:04'),(35,'6 Crew WO 1 Hari Acara',NULL,1100000.00,1,'2025-11-30 06:16:24','2025-11-30 06:18:25'),(36,'5 Crew WO 1 Hari Acara',NULL,1000000.00,1,'2025-11-30 06:17:17','2025-11-30 06:17:17'),(37,'Create Rundown',NULL,0.00,1,'2025-11-30 06:19:39','2025-11-30 06:19:39'),(38,'Make Up + Busana Orang Tua & Besan 2 Pasang',NULL,10000000.00,1,'2025-11-30 06:20:13','2025-11-30 06:20:13'),(39,'1x Technical Meeting',NULL,0.00,1,'2025-11-30 06:20:42','2025-11-30 06:20:42'),(40,'Make Up 1x + Retouch & Busana Pengantin 2 Pasang',NULL,10000000.00,1,'2025-11-30 06:21:17','2025-11-30 06:21:17'),(41,'Big Band (Main & Backing Vocal, Lead Guitar, Bass, Double Keyboard, Drum Pad & Set Percussiom)',NULL,8000000.00,1,'2025-11-30 06:49:37','2025-11-30 06:52:54'),(43,'Make Up & Busana Lamaran 1 Pasang',NULL,1000000.00,1,'2025-11-30 07:05:31','2025-11-30 07:05:31'),(44,'wedding organizer',NULL,10000000.00,0,'2025-12-09 06:48:49','2025-12-09 06:49:01'),(47,'Catering 100 Pax',NULL,1000000.00,1,'2025-12-10 12:39:10','2025-12-10 12:39:10'),(48,'Catering 400 Pax',NULL,2500000.00,1,'2025-12-10 12:40:01','2025-12-10 12:40:01');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('0KVBZuP9miqNEWZm62XfWXKeu00rJsTOtoxEK3la',3,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36 Edg/146.0.0.0','YTo3OntzOjY6Il90b2tlbiI7czo0MDoickZTVkpZMTNVTG9LWk8ydk5IOFhaZ25qRFpiVzYzeHlYZE01aG42UiI7czoyMjoiUEhQREVCVUdCQVJfU1RBQ0tfREFUQSI7YTowOnt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly9wLXByb2plY3RpbmRvbmVzaWEudGVzdC9wYW5lbC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTIkVHFpMTl1RmozZWNPUHFqeTcydWguLnZ1TVpaeUhrMUZ4dUh6RnpkaWFia29tZ251Q2U0S0siO3M6NjoidGFibGVzIjthOjI6e3M6NDA6IjIyMWI2MmExNGRmOWYzYzM4NTM1ZTk1OWQzNzI1Yjg5X2NvbHVtbnMiO2E6Njp7aTowO2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjEwOiJvcmRlcl9jb2RlIjtzOjU6ImxhYmVsIjtzOjEwOiJLb2RlIE9yZGVyIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6MTthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czoxMzoiY3VzdG9tZXIubmFtZSI7czo1OiJsYWJlbCI7czo5OiJQZWxhbmdnYW4iO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aToyO2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjEyOiJwYWNrYWdlLm5hbWUiO3M6NToibGFiZWwiO3M6NToiUGFrZXQiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aTozO2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjEwOiJldmVudF9kYXRlIjtzOjU6ImxhYmVsIjtzOjEzOiJUYW5nZ2FsIEFjYXJhIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6NDthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czo2OiJzdGF0dXMiO3M6NToibGFiZWwiO3M6NjoiU3RhdHVzIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6NTthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czoxMToidG90YWxfcHJpY2UiO3M6NToibGFiZWwiO3M6MTE6IlRvdGFsIEhhcmdhIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fX1zOjQwOiJkOTA0NmI5NzM2MzVlM2NlN2Y1NzFjNTMzZWRkNDdkMl9jb2x1bW5zIjthOjg6e2k6MDthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czoxMzoiY2F0ZXJpbmdfY29kZSI7czo1OiJsYWJlbCI7czoxMzoiS29kZSBDYXRlcmluZyI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjE7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MTM6ImN1c3RvbWVyLm5hbWUiO3M6NToibGFiZWwiO3M6MTQ6Ik5hbWEgUGVsYW5nZ2FuIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fWk6MjthOjc6e3M6NDoidHlwZSI7czo2OiJjb2x1bW4iO3M6NDoibmFtZSI7czoxMDoiZXZlbnRfbmFtZSI7czo1OiJsYWJlbCI7czoxMDoiTmFtYSBBY2FyYSI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjM7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MTA6ImV2ZW50X2RhdGUiO3M6NToibGFiZWwiO3M6MTM6IlRhbmdnYWwgQWNhcmEiO3M6ODoiaXNIaWRkZW4iO2I6MDtzOjk6ImlzVG9nZ2xlZCI7YjoxO3M6MTI6ImlzVG9nZ2xlYWJsZSI7YjowO3M6MjQ6ImlzVG9nZ2xlZEhpZGRlbkJ5RGVmYXVsdCI7Tjt9aTo0O2E6Nzp7czo0OiJ0eXBlIjtzOjY6ImNvbHVtbiI7czo0OiJuYW1lIjtzOjg6InF1YW50aXR5IjtzOjU6ImxhYmVsIjtzOjM6IlF0eSI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjU7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MTE6InRvdGFsX3ByaWNlIjtzOjU6ImxhYmVsIjtzOjExOiJUb3RhbCBIYXJnYSI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjY7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6Njoic3RhdHVzIjtzOjU6ImxhYmVsIjtzOjY6IlN0YXR1cyI7czo4OiJpc0hpZGRlbiI7YjowO3M6OToiaXNUb2dnbGVkIjtiOjE7czoxMjoiaXNUb2dnbGVhYmxlIjtiOjA7czoyNDoiaXNUb2dnbGVkSGlkZGVuQnlEZWZhdWx0IjtOO31pOjc7YTo3OntzOjQ6InR5cGUiO3M6NjoiY29sdW1uIjtzOjQ6Im5hbWUiO3M6MTA6ImNyZWF0ZWRfYXQiO3M6NToibGFiZWwiO3M6MTE6IkRpYnVhdCBQYWRhIjtzOjg6ImlzSGlkZGVuIjtiOjA7czo5OiJpc1RvZ2dsZWQiO2I6MTtzOjEyOiJpc1RvZ2dsZWFibGUiO2I6MDtzOjI0OiJpc1RvZ2dsZWRIaWRkZW5CeURlZmF1bHQiO047fX19fQ==',1774361444),('bXabe10tka4aPY1ZANIBmFNEiAHHRCFjrfzt7Yrd',14,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZlZBdlo5TWc4TTlzNlpPRG5DRktRaUt6N0pJaVJHWEl3U2o4QmZubSI7czoyMjoiUEhQREVCVUdCQVJfU1RBQ0tfREFUQSI7YTowOnt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly9wLXByb2plY3RpbmRvbmVzaWEudGVzdC9wZWxhbmdnYW4vcGVzYW5hbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE0O30=',1774361312);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pelanggan',
  `no_hp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `avatar_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (3,'admin','admin@gmail.com','$2y$12$Tqi19uFj3ecOPqjy72uh..vuMZZyHk1FxuHzFzdiabkomgnuCe4KK','admin','08117411190',NULL,NULL,'2025-10-18 06:32:05','2026-01-06 17:50:20','avatars/01KEA6WRHK23AVRA0ME33AZWYG.jpg'),(4,'pemilik','pemilik@gmail.com','$2y$12$QxwxAcYQLQLvug3uSyVw5OxMUoUCZwHW2WsMc20fDXf8UNn6jfROW','pemilik','0845451644422','asdawqwdqwd',NULL,'2025-10-18 06:32:47','2026-01-22 15:20:21','avatars/01KFK4NKXR60474BGZK1RC4QD4.jpg'),(5,'aaa','aaa@gmail.com','$2y$12$4enTl4hy7GDQjjMwX.AcNOqvE7GTB.uyqOOEKXY20Aal2UPg61G8i','pelanggan','11231441413','Pulvinar vivamus fringilla lacus nec metus bibendum egestas. Iaculis massa nisl malesuada lacinia integer nunc posuere.',NULL,'2025-10-23 05:43:07','2025-11-24 11:45:32',NULL),(7,'bbbb','bbb@gmail.com','$2y$12$L9DP9KKQ0fIVcxLAdL2t3ukDVX/3XZ7lx/JTAWOuzJHxzhLDnFG2u','pelanggan','2314422','Ut hendrerit semper vel class aptent taciti sociosqu. Ad litora torquent per conubia nostra inceptos himenaeos.',NULL,'2025-10-23 06:15:19','2025-11-24 11:47:54',NULL),(8,'Saya','saya@gmail.com','$2y$12$IKtLLm53.HXspF2QmZrUjuFXOQe.nXmM6T0aVhPiNnKly5kvXUbUe','pelanggan','0831232121','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',NULL,'2025-11-30 06:07:09','2025-11-30 06:07:09',NULL),(9,'Kamu','kamu@gmail.com','$2y$12$M.MdtiEG5Z//TvqlQrv0L.lFCE7A6YBqzDFiEmQwwY5cIZdj.2l5O','pelanggan','3123123124','loeremasda',NULL,'2025-12-08 18:35:24','2025-12-08 18:35:24',NULL),(10,'Kita','Kita@gmail.com','$2y$12$4YizxDb/7z7Vb6PfDSzn8ugOnqwSyGR7N6R.wdE62hzQ4tkG8NnFK','pelanggan','08541244865','dasdasdasdasd',NULL,'2025-12-12 18:02:27','2025-12-12 18:02:27',NULL),(11,'hehe','hehe@gmail.com','$2y$12$DmNipbjYdHP9FSrXABKiUeUScQvos08IdN8SRpcYsoPjU8ox1fzEa','pelanggan',NULL,NULL,NULL,'2025-12-22 18:18:31','2025-12-22 18:18:31',NULL),(12,'lala','lala@gmail.com','$2y$12$v41IcWxWAW18KTKm.EglJeXcf5fsvo9KtrRGvaydIAu9.mrOPS/ki','pelanggan',NULL,NULL,NULL,'2025-12-23 06:45:17','2025-12-23 06:45:17',NULL),(13,'yyyy','yyy@gmail.com','$2y$12$xtDzRjgaXlcgPqkKQsuvpuT8NtgzcYOVJ3uBh2BgHwQFgGuGh9c4W','pelanggan',NULL,NULL,NULL,'2025-12-23 10:45:28','2025-12-23 10:45:28',NULL),(14,'yoyo','yoyo@gmail.com','$2y$12$WGmmsOoltZB2muls7tiBre5nzsg2dTPFeZ74ynJSj58Ix35sKwaG2','pelanggan',NULL,NULL,NULL,'2025-12-27 08:19:03','2025-12-28 16:09:55',NULL),(15,'nisa','nisa@gmail.com','$2y$12$WjDJRZN9RVNsBaHm8eaEB.1I88sZo8HhzEkQIVCJMSWcTtCzBT0Q.','pelanggan',NULL,NULL,NULL,'2026-01-05 06:42:53','2026-01-05 06:42:53',NULL),(16,'wwww','wwww@gmail.com','$2y$12$gKbQykd53WTREb7olZfZZOBdfmZe.7OdGPkwmxJkNDQy6JIW1O6U.','pelanggan',NULL,NULL,NULL,'2026-01-08 10:08:02','2026-01-08 10:08:02',NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-03-24 21:17:32
