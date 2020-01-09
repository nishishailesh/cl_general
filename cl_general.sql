-- MySQL dump 10.17  Distrib 10.3.18-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: cl_general
-- ------------------------------------------------------
-- Server version	10.3.18-MariaDB-0+deb10u1

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
-- Table structure for table `examination`
--

DROP TABLE IF EXISTS `examination`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `examination` (
  `examination_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `sample_requirement` varchar(100) COLLATE utf8_bin DEFAULT 'NULL',
  `edit_specification` varchar(1000) COLLATE utf8_bin NOT NULL,
  `description` varchar(300) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`examination_id`)
) ENGINE=InnoDB AUTO_INCREMENT=100009 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `examination`
--

LOCK TABLES `examination` WRITE;
/*!40000 ALTER TABLE `examination` DISABLE KEYS */;
INSERT INTO `examination` VALUES (1,'WBC','EDTA-Blood-HI','{\"type\":\"text\",\"help\":\"4000-10000, /cmm (Impedence)\",\"interval\":\"100-1000-4000-11000-20000-200000\"}','None'),(2,'RBC','EDTA-Blood-HI','{\"type\":\"text\",\"help\":\"Describe\"}','None'),(3,'Hemoglobin','EDTA-Blood-HI','{\"type\":\"text\",\"help\":\"Describe\"}','None'),(4,'Hematocrit','EDTA-Blood-HI','{\"type\":\"text\",\"help\":\"Describe\"}','None'),(5,'MCV','EDTA-Blood-HI','{\"type\":\"text\",\"help\":\"Describe\"}','None'),(6,'MCH','EDTA-Blood-HI','{\"type\":\"text\",\"help\":\"Describe\"}','None'),(7,'MCHC','EDTA-Blood-HI','{\"type\":\"text\",\"help\":\"Describe\"}','None'),(8,'RDW','EDTA-Blood-HI','{\"type\":\"text\",\"help\":\"Describe\"}','None'),(9,'Platelet','EDTA-Blood-HI','{\"type\":\"text\",\"help\":\"Describe\"}','None'),(13,'Lymphocyte%','EDTA-Blood-HI','{\"type\":\"text\",\"help\":\"Describe\"}','None'),(14,'Monocyte%','EDTA-Blood-HI','{\"type\":\"text\",\"help\":\"Describe\"}','None'),(15,'Granulocyte%','EDTA-Blood-HI','{\"type\":\"text\",\"help\":\"Describe\"}','None'),(19,'RDW Graph','EDTA-Blood-HI','{\"type\":\"text\",\"help\":\"Describe\"}','None'),(20,'WBC Graph','EDTA-Blood-HI','{\"type\":\"text\",\"help\":\"Describe\"}','None'),(21,'Platelet Graph','EDTA-Blood-HI','{\"type\":\"text\",\"help\":\"Describe\"}','None'),(39,'Neutrophils (Microscopy)','EDTA-Blood-HI','',NULL),(40,'Lymphocytes (Microscopy)','EDTA-Blood-HI','',NULL),(41,'Eosinophils (Microscopy)','EDTA-Blood-HI','',NULL),(42,'Monocytes (Microscopy)','EDTA-Blood-HI','',NULL),(43,'Basophils (Microscopy)','EDTA-Blood-HI','',NULL),(44,'NRBCs','EDTA-Blood-HI','',NULL),(45,'Platelets on smear','EDTA-Blood-HI','',NULL),(46,'Malarial Parasites (Microscopy)','EDTA-Blood-HI','{\"type\":\"text\",\"help\":\"Describe\"}','None'),(47,'Malarial Parasites (Repid)','EDTA-Blood-HI','{\"type\":\"text\",\"help\":\"Describe\"}','None'),(101,'Peripheral Smear Examination','EDTA-Blood-HI','{\"type\":\"text\",\"help\":\"Describe\"}','None'),(102,'Reticulocyte Count','EDTA-Blood-HI','{\"type\":\"text\",\"help\":\"Describe\"}','None'),(201,'Prothrombin Time','Citrate-Blood-HI','{\"type\":\"text\",\"help\":\"Describe\"}','None'),(202,'Activated Partial Thromboplastin Time','Citrate-Blood-HI','{\"type\":\"text\",\"help\":\"Describe\"}','None'),(301,'Glucose','Fluoride-Blood-BI','{\"type\":\"text\",\"help\":\"Describe\"}','None'),(302,'Glucose','Plain-CSF-BI','{\"type\":\"text\",\"help\":\"Describe\"}','None'),(303,'Creatinine','Plain-Blood-BI','{\"type\":\"text\",\"help\":\"Describe\"}','None'),(304,'Total Bilirubin','Plain-Blood-BI','{\"type\":\"text\",\"help\":\"Describe\"}','None'),(305,'Indirect Bilirubin','Plain-Blood-BI','{\"type\":\"text\",\"help\":\"Describe\"}','None'),(404,'HBsAg','Plain-Blood-MI','{\"type\":\"text\",\"help\":\"Describe\"}','None'),(1000,'sample_requirement','None','{\"type\":\"text\",\"help\":\"Describe\"}','None'),(1001,'MRD','None','{\"type\":\"text\",\"help\":\"Describe\"}','None'),(1002,'Name','None','{\"type\":\"text\",\"help\":\"Describe\"}','None'),(1003,'request_id','None','{\"type\":\"text\",\"help\":\"Describe\"}','None'),(1004,'department','None','{\"type\":\"select\",\"option\":\",ART,Dentistry,EmergencyMedicine,ENT,Medicine,OG,Opthalmology,Orthopaedics,Paediatrics,PlasticSurgery,Psychiatry,Skin,Surgery,TBChest,Unspecified\"}','None'),(1005,'unit','None','{\"type\":\"select\",\"option\":\",1,2,3,4,5,6,7,8,A,B\"}','None'),(1006,'ow_no','None','{\"type\":\"text\",\"help\":\"Describe\"}','None'),(1007,'Age','NULL','{\"type\":\"number\",\"help\":\"in years\"',NULL),(1008,'Sex','NULL','{\"type\":\"select\",\"option\":\",M,F,O\"}',NULL),(1009,'Sample_Collection_Time','None','{\"type\":\"datetime-local\"}',NULL),(1010,'Sample_Receipt_Time','None','{\"type\":\"datetime-local\"}',NULL),(1011,'Sample_Report_Time','none','{\"type\":\"datetime-local\"}',NULL),(10001,'Peripheral Smear Image','EDTA-Blood-HI','{\"type\":\"text\",\"help\":\"Describe\"}','None'),(10002,'Protein Electrophorogram Image','Plain-Blood-BI','{\"type\":\"text\",\"help\":\"Describe\"}','None');
/*!40000 ALTER TABLE `examination` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `primary_result`
--

DROP TABLE IF EXISTS `primary_result`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `primary_result` (
  `sample_id` bigint(20) NOT NULL,
  `examination_id` int(11) NOT NULL,
  `result` varchar(5000) NOT NULL,
  `uniq` varchar(100) NOT NULL,
  PRIMARY KEY (`sample_id`,`examination_id`,`uniq`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `primary_result`
--

LOCK TABLES `primary_result` WRITE;
/*!40000 ALTER TABLE `primary_result` DISABLE KEYS */;
INSERT INTO `primary_result` VALUES (6,1,'000.2 l','28/11/19 16h51mn00s'),(6,1,'000.3 l','28/11/20 16h51mn00s'),(6,1,'32','28/12/19 16h51mn00s'),(6,2,'40','28/11/19 16h51mn00s'),(6,2,'00.02 l','28/11/20 16h51mn00s'),(6,2,'43','28/12/19 16h51mn00s'),(6,3,'45','28/11/19 16h51mn00s'),(6,3,'000.0 l','28/11/20 16h51mn00s'),(6,3,'56','28/12/19 16h51mn00s'),(6,4,'000.1 l','28/11/19 16h51mn00s'),(6,4,'000.1 l','28/11/20 16h51mn00s'),(6,4,'000.1 l','28/12/19 16h51mn00s'),(6,5,'00000 l','28/11/19 16h51mn00s'),(6,5,'00000 l','28/11/20 16h51mn00s'),(6,5,'00000 l','28/12/19 16h51mn00s'),(6,6,'000.0 l','28/11/19 16h51mn00s'),(6,6,'000.0 l','28/11/20 16h51mn00s'),(6,6,'000.0 l','28/12/19 16h51mn00s'),(6,7,'000.0 l','28/11/19 16h51mn00s'),(6,7,'000.0 l','28/11/20 16h51mn00s'),(6,7,'000.0 l','28/12/19 16h51mn00s'),(6,8,'000.0 l','28/11/19 16h51mn00s'),(6,8,'000.0 l','28/11/20 16h51mn00s'),(6,8,'000.0 l','28/12/19 16h51mn00s'),(6,9,'00043 l','28/11/19 16h51mn00s'),(6,9,'00043 l','28/11/20 16h51mn00s'),(6,9,'00043 l','28/12/19 16h51mn00s'),(6,10,'006.8  ','28/11/19 16h51mn00s'),(6,10,'006.8  ','28/11/20 16h51mn00s'),(6,10,'006.8  ','28/12/19 16h51mn00s'),(6,11,' .029 l','28/11/19 16h51mn00s'),(6,11,' .029 l','28/11/20 16h51mn00s'),(6,11,' .029 l','28/12/19 16h51mn00s'),(6,12,'006.3 l','28/11/19 16h51mn00s'),(6,12,'006.3 l','28/11/20 16h51mn00s'),(6,12,'006.3 l','28/12/19 16h51mn00s'),(6,13,'088.2 h','28/11/19 16h51mn00s'),(6,13,'088.2 h','28/11/20 16h51mn00s'),(6,13,'088.2 h','28/12/19 16h51mn00s'),(6,14,'009.0  ','28/11/19 16h51mn00s'),(6,14,'009.0  ','28/11/20 16h51mn00s'),(6,14,'009.0  ','28/12/19 16h51mn00s'),(6,15,'002.8 l','28/11/19 16h51mn00s'),(6,15,'002.8 l','28/11/20 16h51mn00s'),(6,15,'002.8 l','28/12/19 16h51mn00s'),(6,16,'000.1 l','28/11/19 16h51mn00s'),(6,16,'000.1 l','28/11/20 16h51mn00s'),(6,16,'000.1 l','28/12/19 16h51mn00s'),(6,17,'000.0 l','28/11/19 16h51mn00s'),(6,17,'000.0 l','28/11/20 16h51mn00s'),(6,17,'000.0 l','28/12/19 16h51mn00s'),(6,18,'000.1 l','28/11/19 16h51mn00s'),(6,18,'000.1 l','28/11/20 16h51mn00s'),(6,18,'000.1 l','28/12/19 16h51mn00s'),(6,19,'                                                                                                                                ','28/11/19 16h51mn00s'),(6,19,'                                                                                                                                ','28/11/20 16h51mn00s'),(6,19,'                                                                                                                                ','28/12/19 16h51mn00s'),(6,20,'      H…ÖÿÿêÖ™™…q\\H\\\\H444HHH444                                                                                                H','28/11/19 16h51mn00s'),(6,20,'      H…ÖÿÿêÖ™™…q\\H\\\\H444HHH444                                                                                                H','28/11/20 16h51mn00s'),(6,20,'      H…ÖÿÿêÖ™™…q\\H\\\\H444HHH444                                                                                                H','28/12/19 16h51mn00s'),(6,21,'        !3L_[QJJH><373731--++\'%!%%)\'))++)\'!!#%)))%\'%#!#\'%%!%%# !#!   ##%#%%%%!!!##%%#!  !##!     !!!  !##!!     !!#!!  !!!   !#%','28/11/19 16h51mn00s'),(6,21,'        !3L_[QJJH><373731--++\'%!%%)\'))++)\'!!#%)))%\'%#!#\'%%!%%# !#!   ##%#%%%%!!!##%%#!  !##!     !!!  !##!!     !!#!!  !!!   !#%','28/11/20 16h51mn00s'),(6,21,'        !3L_[QJJH><373731--++\'%!%%)\'))++)\'!!#%)))%\'%#!#\'%%!%%# !#!   ##%#%%%%!!!##%%#!  !##!     !!!  !##!!     !!#!!  !!!   !#%','28/12/19 16h51mn00s'),(6,22,'RESULT  ','28/11/19 16h51mn00s'),(6,22,'RESULT  ','28/11/20 16h51mn00s'),(6,22,'RESULT  ','28/12/19 16h51mn00s'),(6,25,'31','28/11/19 16h51mn00s'),(6,25,'31','28/11/20 16h51mn00s'),(6,25,'31','28/12/19 16h51mn00s'),(6,26,'28/11/19 16h51mn00s','28/11/19 16h51mn00s'),(6,26,'28/11/20 16h51mn00s','28/11/20 16h51mn00s'),(6,26,'28/12/19 16h51mn00s','28/12/19 16h51mn00s'),(6,27,'0003','28/11/19 16h51mn00s'),(6,27,'0003','28/11/20 16h51mn00s'),(6,27,'0003','28/12/19 16h51mn00s'),(6,28,'M','28/11/19 16h51mn00s'),(6,28,'M','28/11/20 16h51mn00s'),(6,28,'M','28/12/19 16h51mn00s'),(6,29,'0000000000000003','28/11/19 16h51mn00s'),(6,29,'0000000000000003','28/11/20 16h51mn00s'),(6,29,'0000000000000003','28/12/19 16h51mn00s'),(6,30,'7300                          ','28/11/19 16h51mn00s'),(6,30,'7300                          ','28/11/20 16h51mn00s'),(6,30,'7300                          ','28/12/19 16h51mn00s'),(6,31,'D','28/11/19 16h51mn00s'),(6,31,'D','28/11/20 16h51mn00s'),(6,31,'D','28/12/19 16h51mn00s'),(6,32,'      ','28/11/19 16h51mn00s'),(6,32,'      ','28/11/20 16h51mn00s'),(6,32,'      ','28/12/19 16h51mn00s'),(6,33,'105','28/11/19 16h51mn00s'),(6,33,'105','28/11/20 16h51mn00s'),(6,33,'105','28/12/19 16h51mn00s'),(6,34,'        G2G3','28/11/19 16h51mn00s'),(6,34,'        G2G3','28/11/20 16h51mn00s'),(6,34,'        G2G3','28/12/19 16h51mn00s'),(6,35,'000 000 000 024 033','28/11/19 16h51mn00s'),(6,35,'000 000 000 024 033','28/11/20 16h51mn00s'),(6,35,'000 000 000 024 033','28/12/19 16h51mn00s'),(6,36,'MICROS60','28/11/19 16h51mn00s'),(6,36,'MICROS60','28/11/20 16h51mn00s'),(6,36,'MICROS60','28/12/19 16h51mn00s'),(6,37,'V2.8 ','28/11/19 16h51mn00s'),(6,37,'V2.8 ','28/11/20 16h51mn00s'),(6,37,'V2.8 ','28/12/19 16h51mn00s'),(6,38,'828E','28/11/19 16h51mn00s'),(6,38,'828E','28/11/20 16h51mn00s'),(6,38,'828E','28/12/19 16h51mn00s');
/*!40000 ALTER TABLE `primary_result` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `primary_result_e`
--

DROP TABLE IF EXISTS `primary_result_e`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `primary_result_e` (
  `sample_id` bigint(20) NOT NULL,
  `examination_id` int(11) NOT NULL,
  `uniq` varchar(100) NOT NULL,
  `result` varchar(5000) DEFAULT NULL,
  PRIMARY KEY (`sample_id`,`examination_id`,`uniq`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `primary_result_e`
--

LOCK TABLES `primary_result_e` WRITE;
/*!40000 ALTER TABLE `primary_result_e` DISABLE KEYS */;
/*!40000 ALTER TABLE `primary_result_e` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profile` (
  `profile_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `examination_id_list` varchar(500) NOT NULL,
  PRIMARY KEY (`profile_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile`
--

LOCK TABLES `profile` WRITE;
/*!40000 ALTER TABLE `profile` DISABLE KEYS */;
INSERT INTO `profile` VALUES (0,'Patient_Identification','1001,1002,1007,1008,1004,1005,1006'),(1,'Sample Details','1000,1009,1010,1011'),(21,'Blood Counts and Indices','3,2,4,5,6,7,8,1,9'),(22,'Microscopy','39,40,41,42,43,44,45'),(23,'Malarial Parasites','46,47'),(100,'Uploads','10002');
/*!40000 ALTER TABLE `profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `report`
--

DROP TABLE IF EXISTS `report`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `report_name` varchar(100) NOT NULL,
  `examination_id` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `report`
--

LOCK TABLES `report` WRITE;
/*!40000 ALTER TABLE `report` DISABLE KEYS */;
INSERT INTO `report` VALUES (1,'Haemogram','1001,3,2,4,5,6,7,8,1,9');
/*!40000 ALTER TABLE `report` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `result`
--

DROP TABLE IF EXISTS `result`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `result` (
  `sample_id` bigint(20) NOT NULL,
  `examination_id` int(11) NOT NULL,
  `result` varchar(5000) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  `recorded_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`sample_id`,`examination_id`),
  KEY `examination_id` (`examination_id`),
  KEY `recorded_by` (`recorded_by`),
  CONSTRAINT `result_ibfk_2` FOREIGN KEY (`recorded_by`) REFERENCES `user` (`user`),
  CONSTRAINT `result_ibfk_4` FOREIGN KEY (`examination_id`) REFERENCES `examination` (`examination_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `result`
--

LOCK TABLES `result` WRITE;
/*!40000 ALTER TABLE `result` DISABLE KEYS */;
INSERT INTO `result` VALUES (1,1,'SUR/20/66778899','2020-01-07 23:07:16',1),(1,2,NULL,NULL,NULL),(1,3,NULL,NULL,NULL),(1,4,NULL,NULL,NULL),(1,5,NULL,NULL,NULL),(1,6,NULL,NULL,NULL),(1,7,NULL,NULL,NULL),(1,8,NULL,NULL,NULL),(1,19,NULL,NULL,NULL),(1,1001,NULL,NULL,NULL),(2,1,'SUR/20/11223344','2020-01-07 23:14:47',1),(2,2,NULL,NULL,NULL),(2,3,NULL,NULL,NULL),(2,4,NULL,NULL,NULL),(2,5,NULL,NULL,NULL),(2,6,NULL,NULL,NULL),(2,7,NULL,NULL,NULL),(2,8,NULL,NULL,NULL),(2,19,NULL,NULL,NULL),(3,1,'SUR/20/11223344','2020-01-07 23:15:32',1),(3,2,NULL,NULL,NULL),(3,3,NULL,NULL,NULL),(3,4,NULL,NULL,NULL),(3,5,NULL,NULL,NULL),(3,6,NULL,NULL,NULL),(3,7,NULL,NULL,NULL),(3,8,NULL,NULL,NULL),(3,19,NULL,NULL,NULL),(4,2,NULL,NULL,NULL),(4,3,NULL,NULL,NULL),(4,4,NULL,NULL,NULL),(4,5,NULL,NULL,NULL),(4,6,NULL,NULL,NULL),(4,7,NULL,NULL,NULL),(4,8,NULL,NULL,NULL),(4,19,NULL,NULL,NULL),(4,1001,'SUR/20/44556677','2020-01-07 23:18:07',1),(5,2,NULL,NULL,NULL),(5,3,NULL,NULL,NULL),(5,4,NULL,NULL,NULL),(5,5,NULL,NULL,NULL),(5,6,NULL,NULL,NULL),(5,7,NULL,NULL,NULL),(5,8,NULL,NULL,NULL),(5,9,NULL,NULL,NULL),(5,1001,'SUR/20/44556677','2020-01-07 23:18:35',1),(6,2,'00.02 l','2020-01-09 13:00:10',1),(6,3,'56','2020-01-09 13:00:10',1),(6,4,'000.1 l','2020-01-09 13:00:10',1),(6,5,'00000 l','2020-01-09 13:00:10',1),(6,6,'000.0 l','2020-01-09 13:00:10',1),(6,7,'000.0 l','2020-01-09 13:00:10',1),(6,8,'000.0 l','2020-01-09 13:00:10',1),(6,9,'00043 l','2020-01-09 13:00:10',1),(6,39,'53','2020-01-08 00:08:05',1),(6,40,'42','2020-01-08 00:08:10',1),(6,41,'3','2020-01-08 00:08:14',1),(6,42,'2','2020-01-08 00:08:17',1),(6,43,'0','2020-01-08 00:08:23',1),(6,44,'330','2020-01-08 00:17:07',1),(6,46,'Not Detected','2020-01-08 00:23:30',1),(6,47,'Not Detected','2020-01-08 00:23:37',1),(6,1000,'EDTA-Blood-HI','2020-01-08 00:23:13',1),(6,1001,'SUR/20/44556677','2020-01-07 23:19:10',1),(6,1004,NULL,NULL,NULL),(6,1005,NULL,NULL,NULL),(6,1006,NULL,NULL,NULL),(6,1009,'2020-01-07T23:56','2020-01-07 23:56:26',1),(6,1010,'2020-01-07T23:56','2020-01-08 00:23:17',1),(6,1011,'2020-01-07T23:56','2020-01-08 00:23:20',1);
/*!40000 ALTER TABLE `result` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `result_blob`
--

DROP TABLE IF EXISTS `result_blob`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `result_blob` (
  `sample_id` bigint(20) NOT NULL,
  `examination_id` int(11) NOT NULL,
  `result` mediumblob DEFAULT NULL,
  `fname` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`sample_id`,`examination_id`),
  KEY `examination_id` (`examination_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `result_blob`
--

LOCK TABLES `result_blob` WRITE;
/*!40000 ALTER TABLE `result_blob` DISABLE KEYS */;
INSERT INTO `result_blob` VALUES (6,1002,NULL,NULL),(6,1004,NULL,NULL),(6,1005,NULL,NULL),(6,1006,NULL,NULL),(6,1007,NULL,NULL),(6,1008,NULL,NULL),(6,10002,NULL,NULL);
/*!40000 ALTER TABLE `result_blob` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sample_id_strategy`
--

DROP TABLE IF EXISTS `sample_id_strategy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sample_id_strategy` (
  `sample_requirement` varchar(300) COLLATE utf8_bin NOT NULL,
  `lowest_id` bigint(20) NOT NULL,
  `highest_id` bigint(20) NOT NULL,
  `description` varchar(500) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`sample_requirement`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sample_id_strategy`
--

LOCK TABLES `sample_id_strategy` WRITE;
/*!40000 ALTER TABLE `sample_id_strategy` DISABLE KEYS */;
INSERT INTO `sample_id_strategy` VALUES ('Citrate-Blood-HI',2000000,2999999,'Haematology series'),('EDTA-Blood-HI',2000000,2999999,'Haematology series'),('Fluoride-Blood-BI',1000000,1499999,'Biochemistry samples'),('Plain-Blood-BI',1000000,1499999,'Biochemistry samples'),('Plain-Blood-MI',6000000,6999999,'Microbiology Plain sample'),('Plain-CSF-BI',1000000,1499999,'Biochemistry sample');
/*!40000 ALTER TABLE `sample_id_strategy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `expirydate` date NOT NULL,
  PRIMARY KEY (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Shailesh','$2y$10$rK6tUXxwZc0a07pu8YiQx.lXJLCevgepyiVt4kS391BwcPOqvmiNu','2020-06-18');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-01-09 16:42:26
