CREATE DATABASE  IF NOT EXISTS `insurance` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `insurance`;
-- MySQL dump 10.13  Distrib 8.0.16, for Win64 (x86_64)
--
-- Host: localhost    Database: insurance
-- ------------------------------------------------------
-- Server version	5.7.19

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `additional_insured`
--

DROP TABLE IF EXISTS `additional_insured`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `additional_insured` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `birthdate` date NOT NULL,
  `passport_id` varchar(10) NOT NULL,
  `policy_owner_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_policy_owner_id_idx` (`policy_owner_id`),
  CONSTRAINT `fk_policy_owner_id` FOREIGN KEY (`policy_owner_id`) REFERENCES `policy_owner` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `additional_insured`
--

LOCK TABLES `additional_insured` WRITE;
/*!40000 ALTER TABLE `additional_insured` DISABLE KEYS */;
INSERT INTO `additional_insured` VALUES (2,'Sam','Greene','1983-02-03','385443876',4),(3,'Marie','Bourne','1981-06-12','365789371',5),(4,'Liya','Hogan','1990-03-08','372987927',4);
/*!40000 ALTER TABLE `additional_insured` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `policy_owner`
--

DROP TABLE IF EXISTS `policy_owner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `policy_owner` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `birthdate` date NOT NULL,
  `passport_id` varchar(10) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `date_from` date NOT NULL,
  `date_to` date NOT NULL,
  `policy_type` enum('group','individual') DEFAULT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `policy_owner`
--

LOCK TABLES `policy_owner` WRITE;
/*!40000 ALTER TABLE `policy_owner` DISABLE KEYS */;
INSERT INTO `policy_owner` VALUES (1,'John','Doe','1982-06-17','321321321','0622323233','john@gmail.com','2019-06-17','2019-06-26','individual','2019-06-04 09:43:01'),(4,'Claire','Becker','1986-06-02','321325754','0625454657','cbecker@yahoo.com','2019-06-18','2019-06-26','group','2019-06-04 10:03:08'),(5,'Jason','Bourne','1978-03-24','325658795','0633245658','jbourne@gmail.com','2019-07-17','2019-07-27','group','2019-06-04 11:55:04');
/*!40000 ALTER TABLE `policy_owner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'insurance'
--

--
-- Dumping routines for database 'insurance'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-06-05  7:45:50
