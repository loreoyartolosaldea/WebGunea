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
-- Table structure for table `gidaria`
--

DROP TABLE IF EXISTS `gidaria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `gidaria` (
  `NAN` varchar(9) NOT NULL,
  `Izena` varchar(50) NOT NULL,
  `Abizena` varchar(50) NOT NULL,
  `Posta` varchar(100) NOT NULL,
  `Tel_zenb` varchar(20) NOT NULL,
  `Pasahitza` varchar(100) NOT NULL,
  `Kokapena` varchar(100) DEFAULT NULL,
  `Lan_lekua` varchar(100) DEFAULT NULL,
  `Matrikula` varchar(20) NOT NULL,
  PRIMARY KEY (`NAN`),
  UNIQUE KEY `Matrikula_UNIQUE` (`Matrikula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gidaria`
--

LOCK TABLES `gidaria` WRITE;
/*!40000 ALTER TABLE `gidaria` DISABLE KEYS */;
INSERT INTO `gidaria` VALUES ('34567890C','Mikel','Urrutikoetxea','mikel@gmail.com','700123443','34567890C','Tolosa','Bizkaia','6789YJL'),('38104619U','Urkoa','Mendibe','urkobengo@gmail.com','629103671','38104619U','Gasteiz','Araba','8934MNP'),('45678901D','Laura','Perez','laura@gmail.com','700987654','laura123','Donostia','Gipuzkoa','3902HTY'),('46193704O','Aitor','Gonzalez','aitorgonz@gmail.com','639583029','pvlbtnse','Arbizu','Nafarroa','2134LMY'),('72374278J','Pili','Bereiziartua','pili@hotmail.com','688845323','72374278J','Tolosa','Ordizia','7777KKK'),('72596108J','Iker','Mendibe','imendibe@hotmail.com','688845321','pvlbtnse','Tolosa','Gipuzkoa','5555KKK'),('72596109J','Eneko','Gonzalez','eneko@gmail.com','688845343','pvlbtnse','Beasain','Gipuzkoa','5432HFG'),('82749274Y','Martin','Goikoetxea','martin@gmail.com','729839273','82749274Y','Laudio','Araba','3422MLH');
/*!40000 ALTER TABLE `gidaria` ENABLE KEYS */;
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
