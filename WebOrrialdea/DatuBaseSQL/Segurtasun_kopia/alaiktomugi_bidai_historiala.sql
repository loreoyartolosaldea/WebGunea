CREATE DATABASE  IF NOT EXISTS `alaiktomugi` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `alaiktomugi`;
-- MySQL dump 10.13  Distrib 8.0.42, for Win64 (x86_64)
--
-- Host: localhost    Database: alaiktomugi
-- ------------------------------------------------------
-- Server version	8.0.42

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bidai_historiala`
--

DROP TABLE IF EXISTS `bidai_historiala`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bidai_historiala` (
  `Bidaia_id` int NOT NULL AUTO_INCREMENT,
  `Gidari_nan` varchar(9) DEFAULT NULL,
  `Erabiltzaile_nan` varchar(9) DEFAULT NULL,
  `Data` date DEFAULT NULL,
  `Hasiera_ordua` time DEFAULT NULL,
  `Pertsona_kopurua` int DEFAULT NULL,
  `Hasiera` varchar(50) DEFAULT NULL,
  `Helmuga` varchar(50) DEFAULT NULL,
  `Egoera` varchar(45) DEFAULT NULL,
  `Amaiera_ordua` time DEFAULT NULL,
  PRIMARY KEY (`Bidaia_id`),
  UNIQUE KEY `Bidaia_id_UNIQUE` (`Bidaia_id`),
  KEY `Gidari_nan` (`Gidari_nan`),
  KEY `Erabiltzaile_nan` (`Erabiltzaile_nan`),
  CONSTRAINT `bidai_historiala_ibfk_1` FOREIGN KEY (`Bidaia_id`) REFERENCES `bidaia` (`Bidaia_id`),
  CONSTRAINT `bidai_historiala_ibfk_2` FOREIGN KEY (`Gidari_nan`) REFERENCES `gidaria` (`NAN`),
  CONSTRAINT `bidai_historiala_ibfk_3` FOREIGN KEY (`Erabiltzaile_nan`) REFERENCES `erabiltzailea` (`NAN`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bidai_historiala`
--

LOCK TABLES `bidai_historiala` WRITE;
/*!40000 ALTER TABLE `bidai_historiala` DISABLE KEYS */;
INSERT INTO `bidai_historiala` VALUES (6,'34567890C','63017305L','2025-05-20','17:30:00',4,'Beasain','Irun','eginda','18:30:00'),(13,'45678901D','63017305L','2025-05-17','10:07:00',1,'Bergara','Donostia','eginda','11:20:00'),(15,'45678901D','63017305L','2025-05-16','10:40:00',3,'Azpeitia','Ordizia','eginda','12:00:00'),(17,'72596109J','92371295J','2025-05-16','12:00:00',4,'Bergara','Beasain','eginda','12:45:00'),(18,'34567890C','92371295J','2025-05-16','19:30:00',1,'Arrasate','Ordizia','eginda','20:30:00'),(19,'45678901D','92371295J','2025-05-17','06:15:00',2,'Donostia','Bergara','eginda','07:30:00'),(20,'38104619U','12345678A','2025-05-16','17:50:00',3,'Zarautz','Irun','eginda','18:30:00'),(21,'46193704O','71936178T','2025-05-19','08:40:00',3,'Arrasate','Barakaldo','eginda','10:50:00'),(22,'34567890C','12345678A','2025-05-19','09:30:00',2,'Donostia','Bilbo','eginda','10:00:00'),(24,'82749274Y','92371295J','2025-05-20','12:00:00',3,'Agurain','Laudio','eginda','13:00:00'),(25,'72596109J','23456789B','2025-05-20','12:00:00',2,'Arrasate','Donostia','eginda','12:15:00'),(26,'34567890C','12345678A','2025-05-19','11:45:00',2,'Tolosa','Beasain','eginda','12:03:43'),(27,'34567890C','12345678A','2025-05-19','11:55:00',1,'Hernani','Ordizia','eginda','12:35:02'),(28,'45678901D','12345678A','2025-05-19','12:25:00',1,'Ordizia','Beasain','eginda','12:35:00'),(29,'34567890C','48193674Y','2025-05-20','08:55:00',4,'Altsasu','Arbizu','eginda','09:20:34'),(30,'38104619U','12345678A','2025-05-20','09:50:00',2,'Barakaldo','Bilbo','eginda','10:20:03'),(31,'82749274Y','12345678A','2025-05-20','15:10:00',5,'Lakuntza','Otsagabia','eginda','15:40:00'),(32,'82749274Y','71936178T','2025-05-20','11:40:00',2,'Tolosa','Ordizia','eginda','12:00:02'),(33,'46193704O','62817381K','2025-05-20','11:50:00',1,'Irun','Bilbo','eginda','11:52:00'),(34,'46193704O','62817381K','2025-05-21','08:55:00',2,'Donostia','Arbizu','eginda','09:45:00'),(35,'34567890C','48193674Y','2025-05-21','09:50:00',1,'Tolosa','Ordizia','eginda','10:20:32'),(36,'34567890C','62817381K','2025-05-21','10:05:00',1,'Bergara','Zumarraga','eginda','10:27:03'),(37,'38104619U','63017305L','2025-05-21','11:35:00',1,'Arrasate','Azpeitia','eginda','12:03:23'),(40,'34567890C','63017305L','2025-05-21','13:00:00',1,'Tolosa','Ordizia','eginda','13:15:09'),(43,'46193704O','12345678A','2025-05-22','10:15:00',1,'Bergara','Arrasate','eginda','11:00:12'),(44,'45678901D','12345678A','2025-05-22','10:45:00',4,'Bilbo','Gernika','eginda','12:00:32'),(45,'34567890C','23456789B','2025-05-22','11:45:00',1,'Tolosa','Beasain','eginda','12:03:03'),(46,'72596109J','23456789B','2025-05-22','12:00:00',2,'Bilbo','Getxo','eginda','11:56:33');
/*!40000 ALTER TABLE `bidai_historiala` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-05-26  8:43:55
