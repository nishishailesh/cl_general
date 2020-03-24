-- MySQL dump 10.17  Distrib 10.3.22-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: cl_general
-- ------------------------------------------------------
-- Server version	10.3.22-MariaDB-1

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
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profile` (
  `profile_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `examination_id_list` varchar(500) NOT NULL,
  `extra` varchar(300) DEFAULT NULL,
  `edit_specification` varchar(500) NOT NULL,
  PRIMARY KEY (`profile_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile`
--

LOCK TABLES `profile` WRITE;
/*!40000 ALTER TABLE `profile` DISABLE KEYS */;
INSERT INTO `profile` VALUES (1,'Patient_Identification','1001,1002,1008,1004,1005,1006,1007','1020,1021,1012','{\"header\":\"no\",\"print_style\":\"horizontal\"}'),(2,'Sample Details','1000,1015,1016,1017,1018,1014','1019,1022','{\"header\":\"no\",\"print_style\":\"horizontal\"}'),(20,'Bone Marrow Examination Details','147,148','',''),(21,'Hemogram - Blood Counts and Indices','3,2,4,5,6,7,8,1,9','',''),(22,'Differential Leucocyte Count  with Premature Cells (Microscopy)','51,52,53,54,55,400,401,402,403,404','',''),(23,'Differential Leucocyte Count (Microscopy)','39,40,41,42,43,56','',''),(24,'Absolute Counts','48,49,50','',''),(25,'Peripheral Smear (Red Blood Cells)','57,58,59,60,61,62,63,64,65,66','',''),(26,'Peripheral Smear (Platelets)','45,67','',''),(27,'Peripheral Smear (Parasites)','68,69,70','',''),(28,'Rapid Malarial Antigen Test','46,47','',''),(29,'Platelet Indices','510,511,71,72','',''),(30,'Reticulocyte Count (RC)','73,74','',''),(31,'Erythrocyte Sedimentation Rate','75','',''),(32,'Prothrombin Time ','76,77,78,79,80,602','',''),(33,'Activated Partial Thromboplastin Time (aPTT)','81,82,603','',''),(34,'Plasma Fibrinogen','83,84','',''),(35,'Factor Assay','85,86','',''),(36,'Bleeding Time (BT) and Clotting Time (CT)','87,88','',''),(37,'Urine Routine and Microscopy','89,90,91,92,93,94,95,96,97,98,99,100,101,102,103,104,105,106,181,107,108,109,110,111,113','',''),(38,'Stool Examination','114,115,116,117,118,119,120,121,122,123,124,125','',''),(39,'Body Fluid Examination','126,127,128,129,130,131,132,133,134,135,136,137','',''),(40,'Semen Examination','138,139,140,141,142,143,144,145,146','',''),(41,'Bone Marrow Examination Report','150,151,152,153,154,155,156,157,158,159,160,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180','',''),(101,'Histopathology','2010,2001,2002,2003,2004,2011,2005,2009,2006,2007,2008',NULL,'{\"header\":\"no\",\"print_style\":\"vertical\"}'),(231,'Dw Graphs','19,20,21','','{\"display_name\":\"no\",\"header\":\"no\",\"print_hide\":\"no\"}'),(300,'Reported by','2012,2013,2014','2015','{\"header\":\"no\",\"print_style\":\"horizontal\"}');
/*!40000 ALTER TABLE `profile` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-03-24 23:00:03
