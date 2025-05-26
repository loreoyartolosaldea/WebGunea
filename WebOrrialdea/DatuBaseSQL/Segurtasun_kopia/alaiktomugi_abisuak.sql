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
-- Table structure for table `abisuak`
--

DROP TABLE IF EXISTS `abisuak`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `abisuak` (
  `Abisu_id` int NOT NULL AUTO_INCREMENT,
  `Gidari_nan` varchar(9) NOT NULL,
  `Mezua` text NOT NULL,
  `Ikusita` tinyint(1) DEFAULT '0',
  `Sortze_data` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Abisu_id`),
  KEY `Gidari_nan` (`Gidari_nan`),
  CONSTRAINT `abisuak_ibfk_1` FOREIGN KEY (`Gidari_nan`) REFERENCES `gidaria` (`NAN`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `abisuak`
--

LOCK TABLES `abisuak` WRITE;
/*!40000 ALTER TABLE `abisuak` DISABLE KEYS */;
INSERT INTO `abisuak` VALUES (1,'38104619U','Erabiltzaile batek bidaia (ID: 41) bertan behera utzi du.',1,'2025-05-22 06:55:05'),(2,'45678901D','Erabiltzaile batek bidaia (ID: 42) bertan behera utzi du.',1,'2025-05-22 07:24:12');
/*!40000 ALTER TABLE `abisuak` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-05-26  8:43:56
