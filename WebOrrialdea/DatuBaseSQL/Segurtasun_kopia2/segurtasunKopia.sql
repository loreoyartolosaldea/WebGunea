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

--
-- Table structure for table `bidaia`
--

DROP TABLE IF EXISTS `bidaia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bidaia` (
  `Bidaia_id` int NOT NULL AUTO_INCREMENT,
  `Data` date NOT NULL,
  `Hasiera_ordua` time NOT NULL,
  `Pertsona_kopurua` int NOT NULL,
  `Egoera` varchar(50) NOT NULL,
  `Erabiltzaile_NAN` varchar(9) NOT NULL,
  `Gidari_nan` varchar(9) DEFAULT NULL,
  `Hasiera` varchar(50) NOT NULL,
  `Helmuga` varchar(50) NOT NULL,
  `Amaiera_ordua` time DEFAULT NULL,
  PRIMARY KEY (`Bidaia_id`),
  KEY `Erabiltzaile_NAN` (`Erabiltzaile_NAN`),
  KEY `Gidari_NAN` (`Gidari_nan`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bidaia`
--

LOCK TABLES `bidaia` WRITE;
/*!40000 ALTER TABLE `bidaia` DISABLE KEYS */;
INSERT INTO `bidaia` VALUES (1,'2025-05-10','08:30:00',2,'eginda','12345678A','34567890C','Ordizia','Irun',NULL),(2,'2025-05-11','14:00:00',1,'eginda','23456789B','45678901D','Irun','Donostia',NULL),(3,'2025-05-13','23:00:00',2,'eginda','12345678A','34567890C','Tolosa','Donostia',NULL),(4,'2025-06-08','11:23:00',2,'bertan behera','63017305L','34567890C','Tolosa','Donostia',NULL),(5,'2025-05-14','09:57:00',1,'eginda','63017305L','34567890C','Tolosa','Zumarraga',NULL),(6,'2025-05-20','17:30:00',4,'eginda','63017305L','34567890C','Beasain','Irun',NULL),(7,'2025-05-16','20:00:00',1,'eginda','92371295J','45678901D','Azpeitia','Zumarraga',NULL),(8,'2025-05-16','20:00:00',1,'eginda','92371295J','45678901D','Azpeitia','Zumarraga',NULL),(10,'2025-05-15','12:03:00',3,'eginda','12345678A','45678901D','Beasain','Tolosa',NULL),(11,'2025-05-15','12:30:00',1,'eginda','23456789B','45678901D','Hernani','Donostia',NULL),(12,'2025-05-16','08:00:00',4,'eginda','63017305L','45678901D','Arrasate','Azpeitia',NULL),(13,'2025-05-17','10:07:00',1,'eginda','63017305L','45678901D','Bergara','Donostia',NULL),(14,'2025-05-15','20:40:00',2,'eginda','89178564I','45678901D','Zarautz','Ordizia',NULL),(15,'2025-05-16','10:40:00',3,'eginda','63017305L','45678901D','Azpeitia','Ordizia',NULL),(16,'2025-05-16','10:40:00',3,'eginda','63017305L','72596109J','Azpeitia','Ordizia',NULL),(17,'2025-05-16','12:00:00',4,'eginda','92371295J','72596109J','Bergara','Beasain',NULL),(18,'2025-05-16','19:30:00',1,'eginda','92371295J','34567890C','Arrasate','Ordizia',NULL),(19,'2025-05-17','06:15:00',2,'eginda','92371295J','45678901D','Donostia','Irun',NULL),(20,'2025-05-16','17:50:00',3,'eginda','12345678A','38104619U','Zarautz','Bergara',NULL),(21,'2025-05-19','08:40:00',3,'eginda','71936178T','46193704O','Arrasate','Barakaldo',NULL),(22,'2025-05-19','09:30:00',2,'eginda','12345678A','34567890C','Donostia','Bilbo',NULL),(23,'2025-05-19','09:50:00',1,'eginda','71936178T','82749274Y','Barakaldo','Portugalete',NULL),(24,'2025-05-20','12:00:00',3,'eginda','92371295J','82749274Y','Agurain','Laudio',NULL),(25,'2025-05-20','12:00:00',2,'eginda','23456789B','72596109J','Arrasate','Donostia',NULL),(26,'2025-05-19','11:45:00',2,'eginda','12345678A','45678901D','Tolosa','Beasain',NULL),(27,'2025-05-19','11:55:00',1,'eginda','12345678A','34567890C','Hernani','Ordizia',NULL),(28,'2025-05-19','12:25:00',1,'eginda','12345678A','45678901D','Ordizia','Beasain',NULL),(29,'2025-05-20','08:55:00',4,'eginda','48193674Y','34567890C','Altsasu','Arbizu',NULL),(30,'2025-05-20','09:50:00',2,'eginda','12345678A','38104619U','Barakaldo','Bilbo',NULL),(31,'2025-05-20','15:10:00',5,'eginda','12345678A','82749274Y','Lakuntza','Otsagabia',NULL),(32,'2025-05-20','11:40:00',2,'eginda','71936178T','82749274Y','Tolosa','Ordizia',NULL),(33,'2025-05-20','11:50:00',1,'eginda','62817381K','46193704O','Irun','Bilbo',NULL),(34,'2025-05-21','08:55:00',2,'eginda','62817381K','46193704O','Donostia','Arbizu',NULL),(35,'2025-05-21','09:50:00',1,'eginda','48193674Y','34567890C','Tolosa','Ordizia',NULL),(36,'2025-05-21','10:05:00',1,'eginda','62817381K','34567890C','Bergara','Zumarraga',NULL),(37,'2025-05-21','11:35:00',1,'eginda','63017305L','38104619U','Arrasate','Azpeitia',NULL),(38,'2025-05-21','11:40:00',2,'bertan behera','63017305L','82749274Y','Irun','Laudio',NULL),(39,'2025-05-21','12:25:00',1,'unekoa','63017305L','34567890C','Bergara','Azpeitia',NULL),(40,'2025-05-21','13:00:00',1,'eginda','63017305L','34567890C','Tolosa','Ordizia',NULL),(41,'2025-05-22','09:00:00',1,'bertan behera','12345678A','38104619U','Agurain','Añana',NULL),(42,'2025-05-22','09:30:00',2,'bertan behera','23456789B','45678901D','Arrasate','Beasain',NULL),(43,'2025-05-22','10:15:00',1,'eginda','12345678A','46193704O','Bergara','Arrasate',NULL),(44,'2025-05-22','10:45:00',4,'eginda','12345678A','45678901D','Bilbo','Gernika',NULL),(45,'2025-05-22','11:45:00',1,'eginda','23456789B','34567890C','Tolosa','Beasain',NULL),(46,'2025-05-22','12:00:00',2,'eginda','23456789B','72596109J','Bilbo','Getxo','11:56:33');
/*!40000 ALTER TABLE `bidaia` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `pasa_historialera` AFTER UPDATE ON `bidaia` FOR EACH ROW BEGIN
    IF NEW.egoera = 'eginda' AND OLD.egoera <> 'eginda' THEN
        INSERT IGNORE INTO bidai_historiala 
        (
            Bidaia_id,
            Gidari_nan,
            Erabiltzaile_nan,
            Data,
            Hasiera_ordua,
            Pertsona_kopurua,
            Hasiera,
            Helmuga,
            Egoera,
            Amaiera_ordua
        ) VALUES 
        (
            NEW.Bidaia_id,
            NEW.Gidari_nan,
            NEW.Erabiltzaile_NAN,
            NEW.Data,
            NEW.Hasiera_ordua,
            NEW.Pertsona_kopurua,
            NEW.Hasiera,
            NEW.Helmuga,
            NEW.Egoera,
            NEW.Amaiera_ordua
        );
    END IF;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `erabiltzailea`
--

DROP TABLE IF EXISTS `erabiltzailea`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `erabiltzailea` (
  `NAN` varchar(9) NOT NULL,
  `Izena` varchar(50) NOT NULL,
  `Abizena` varchar(50) NOT NULL,
  `Posta` varchar(100) NOT NULL,
  `Tel_zenb` varchar(20) NOT NULL,
  `Pasahitza` varchar(100) NOT NULL,
  PRIMARY KEY (`NAN`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `erabiltzailea`
--

LOCK TABLES `erabiltzailea` WRITE;
/*!40000 ALTER TABLE `erabiltzailea` DISABLE KEYS */;
INSERT INTO `erabiltzailea` VALUES ('12345678A','Ane','Otxoa','ane2@gmail.com','600123456','ane123'),('23456789B','Jon','Arana','jon@gmail.com','600987654','jon123'),('48193674Y','Amets','Lopetegi','amets@gmail.com','790153785','pvlbtnse'),('62817381K','Jose','Fernandez','jose@gmail.com','630184920','pvlbtnse'),('63017305L','Mikel','Ezkurdia','mikelezkurdia@gmail.com','620158739','pvlbtnse'),('71936178T','Maitane','Urrutikoetxea','maitane24@gmail.com','720164783','pvlbtnse'),('79103628H','Enetz','Tolosa','enetztolosa@gmail.com','620164589','tolosaldea'),('82617498U','Nerea','Arruabarrena','nerea12@gmail.com','7130456289','Tolosaldea'),('89178564I','Lorea','Oyarbide','lorea@gmail.com','621846370','12345'),('92371295J','Eneko','Gonzalez','eneko@gmail.com','731630174','pvlbtnse');
/*!40000 ALTER TABLE `erabiltzailea` ENABLE KEYS */;
UNLOCK TABLES;

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
INSERT INTO `gidaria` VALUES ('34567890C','Mikel','Urrutikoetxea','mikel@gmail.com','700123443','12345','Tolosa','Bizkaia','6789YJL'),('38104619U','Urkoa','Mendibea','urkobengo@gmail.com','629103671','pvlbtnse','Gasteiz','Araba','8934MNO'),('45678901D','Laura','Perez','laura@gmail.com','700987654','laura123','Donostia','Gipuzkoa','3902HTY'),('46193704O','Aitor','Gonzalez','aitorgonz@gmail.com','639583029','pvlbtnse','Arbizu','Nafarroa','2134LMY'),('72374278J','Pili','Bereiziartua','pili@hotmail.com','688845323','72374278J','Tolosa','Ordizia','7777KKK'),('72596108J','Iker','Mendibe','imendibe@hotmail.com','688845321','pvlbtnse','Tolosa','Gipuzkoa','5555KKK'),('72596109J','Eneko','Gonzalez','eneko@gmail.com','688845343','pvlbtnse','Beasain','Gipuzkoa','5432HFG'),('82749274Y','Martin','Goikoetxe','martin@gmail.com','729839273','pvlbtnse','Laudio','Araba','3422MLH');
/*!40000 ALTER TABLE `gidaria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'alaiktomugi'
--

--
-- Dumping routines for database 'alaiktomugi'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-05-26  8:40:48
