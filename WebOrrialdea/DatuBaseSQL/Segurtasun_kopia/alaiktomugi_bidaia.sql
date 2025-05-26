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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-05-26  8:43:56
