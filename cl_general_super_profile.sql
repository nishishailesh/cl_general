-- MySQL dump 10.17  Distrib 10.3.23-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: cl_general
-- ------------------------------------------------------
-- Server version	10.3.23-MariaDB-1

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
-- Table structure for table `super_profile`
--

DROP TABLE IF EXISTS `super_profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `super_profile` (
  `super_profile_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `profile_id_list` varchar(500) NOT NULL,
  `extra` varchar(300) DEFAULT NULL,
  `edit_specification` varchar(500) NOT NULL,
  PRIMARY KEY (`super_profile_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `super_profile`
--

LOCK TABLES `super_profile` WRITE;
/*!40000 ALTER TABLE `super_profile` DISABLE KEYS */;
INSERT INTO `super_profile` VALUES (1,'Blood Counts - Hb, TC, Platelet','21','',''),(2,'CBC (Routine)','21,23','',''),(3,'CBC MP (Routine)','21,23,26,27','',''),(4,'PSCM','21,23,25,26,27','',''),(5,'RC','30','',''),(6,'ESR','31','',''),(7,'PT','32','',''),(8,'Urine Routine','37','',''),(9,'Stool Routine','38','',''),(10,'CBC (Emergency)','21','',''),(11,'CBC MP (Emergency)','21,26,27','',''),(12,'PSCM Leukemia Panel','21,22,25,26,27','',''),(13,'Bone Marrow Examination Report','20,21,23,25,26,27,30,41','',''),(14,'Expert Level PSCM','21,23,25,26,27','',''),(15,'Fine Needle Aspiration Cytology Report','201,202','',''),(16,'RFT+Electrolyte','507,506','','{\"group\":\"BI\"}'),(17,'creatinine + eGFR','507,514','','{\"group\":\"BI\"}'),(18,'LRE','503,507,506','','{\"group\":\"BI\"}'),(19,'LRE+GLC','501,503,502,507,506','','{\"group\":\"BI\"}'),(20,'LL-RR-E','503,507,502,508,504','','{\"group\":\"BI\"}'),(21,'Cal-PO4','511','5014,5101,5100,5011','{\"group\":\"BI\"}');
/*!40000 ALTER TABLE `super_profile` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-08-14  1:15:50
