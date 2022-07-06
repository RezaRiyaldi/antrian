-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: antrian
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'admin','$2y$10$Y/sPp9HR6PxRGUclp.kutOgCYivMEJWzi4EJKG9rAKhel5PcOybl6','admin');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `antrian`
--

DROP TABLE IF EXISTS `antrian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `antrian` (
  `id_antrian` int(11) NOT NULL AUTO_INCREMENT,
  `no_antrian` int(11) NOT NULL,
  `kode_antrian` varchar(10) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `waktu_panggil` datetime DEFAULT NULL,
  `waktu_selesai` datetime DEFAULT NULL,
  `created_at` date NOT NULL,
  `pelayanan_id` int(11) NOT NULL,
  `loket_id` int(11) NOT NULL,
  PRIMARY KEY (`id_antrian`),
  KEY `pelayanan_id` (`pelayanan_id`),
  KEY `loket_id` (`loket_id`),
  CONSTRAINT `antrian_ibfk_1` FOREIGN KEY (`loket_id`) REFERENCES `loket` (`id_loket`),
  CONSTRAINT `antrian_ibfk_2` FOREIGN KEY (`pelayanan_id`) REFERENCES `pelayanan` (`id_pelayanan`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `antrian`
--

LOCK TABLES `antrian` WRITE;
/*!40000 ALTER TABLE `antrian` DISABLE KEYS */;
INSERT INTO `antrian` VALUES (70,1,'CS-1',0,NULL,NULL,'2022-07-05',1,1),(71,2,'CS-2',0,NULL,NULL,'2022-07-05',1,1),(72,3,'PG-3',0,NULL,NULL,'2022-07-05',2,2),(73,4,'PG-4',0,NULL,NULL,'2022-07-05',2,2),(74,5,'CS-5',0,NULL,NULL,'2022-07-05',1,1),(75,6,'PG-6',0,NULL,NULL,'2022-07-05',2,2),(76,7,'CS-7',0,NULL,NULL,'2022-07-05',1,1),(77,8,'CS-8',0,NULL,NULL,'2022-07-05',1,1),(78,1,'CS-1',2,NULL,'2022-07-06 14:22:47','2022-07-06',1,1),(79,2,'SD-2',2,'2022-07-06 13:38:18','2022-07-06 14:01:25','2022-07-06',3,3),(80,3,'CS-3',2,NULL,NULL,'2022-07-06',1,1),(81,4,'CS-4',2,'2022-07-06 14:22:41','2022-07-06 14:22:51','2022-07-06',1,1),(82,5,'SD-5',2,'2022-07-06 14:08:24','2022-07-06 14:08:27','2022-07-06',3,3),(83,6,'CS-6',2,'2022-07-06 14:26:49','2022-07-06 14:42:42','2022-07-06',1,1),(84,7,'CS-7',2,'2022-07-06 14:42:47','2022-07-06 14:42:52','2022-07-06',1,1),(85,8,'PG-8',2,'2022-07-06 14:56:14','2022-07-06 15:05:29','2022-07-06',2,2),(86,9,'PG-9',2,'2022-07-06 15:05:31','2022-07-06 16:15:22','2022-07-06',2,2),(87,10,'CS-10',2,'2022-07-06 15:06:14','2022-07-06 16:10:57','2022-07-06',1,1),(88,11,'SD-11',2,'2022-07-06 15:08:25','2022-07-06 16:15:17','2022-07-06',3,3),(89,12,'CS-12',2,'2022-07-06 16:12:12','2022-07-06 16:14:56','2022-07-06',1,1),(90,13,'CS-13',2,'2022-07-06 16:15:06','2022-07-06 16:15:25','2022-07-06',1,1);
/*!40000 ALTER TABLE `antrian` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loket`
--

DROP TABLE IF EXISTS `loket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `loket` (
  `id_loket` int(11) NOT NULL AUTO_INCREMENT,
  `nama_loket` varchar(50) NOT NULL,
  `pelayanan_id` int(11) NOT NULL,
  PRIMARY KEY (`id_loket`),
  KEY `pelayanan_id` (`pelayanan_id`),
  CONSTRAINT `loket_ibfk_1` FOREIGN KEY (`pelayanan_id`) REFERENCES `pelayanan` (`id_pelayanan`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loket`
--

LOCK TABLES `loket` WRITE;
/*!40000 ALTER TABLE `loket` DISABLE KEYS */;
INSERT INTO `loket` VALUES (1,'Loket 1',1),(2,'Loket 2',2),(3,'Loket 3',3);
/*!40000 ALTER TABLE `loket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pelayanan`
--

DROP TABLE IF EXISTS `pelayanan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pelayanan` (
  `id_pelayanan` int(11) NOT NULL AUTO_INCREMENT,
  `kode_pelayanan` varchar(2) NOT NULL,
  `nama_pelayanan` varchar(50) NOT NULL,
  PRIMARY KEY (`id_pelayanan`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pelayanan`
--

LOCK TABLES `pelayanan` WRITE;
/*!40000 ALTER TABLE `pelayanan` DISABLE KEYS */;
INSERT INTO `pelayanan` VALUES (1,'CS','Customer Services'),(2,'PG','Pengaduan'),(3,'SD','Sidang');
/*!40000 ALTER TABLE `pelayanan` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-07-07  3:13:47
