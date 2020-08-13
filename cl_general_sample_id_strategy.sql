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
-- Table structure for table `sample_id_strategy`
--

DROP TABLE IF EXISTS `sample_id_strategy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sample_id_strategy` (
  `sample_requirement` varchar(100) COLLATE utf8_bin NOT NULL,
  `lowest_id` bigint(20) DEFAULT NULL,
  `highest_id` bigint(20) DEFAULT NULL,
  `description` varchar(500) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`sample_requirement`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sample_id_strategy`
--

LOCK TABLES `sample_id_strategy` WRITE;
/*!40000 ALTER TABLE `sample_id_strategy` DISABLE KEYS */;
INSERT INTO `sample_id_strategy` VALUES ('Citrate-Blood-HI',2000000,2999999,'Haematology'),('EDTA-Blood-BI',1000000,1999999,'Biochemistry'),('EDTA-Blood-HI',2000000,2999999,'Haematology'),('EDTA-BodyFluid-CP',3000000,3999999,'Clinical Pathology - Body Fluid'),('EDTA-CSF-CP',3000000,3999999,'Clinical Pathology - CSF'),('Fluoride-Blood-BI',1000000,1999999,'Biochemistry'),('Formalin-Tissue-HP',4000000,4999999,''),('Frozen-Tissue-HP',4000000,4999999,''),('HCL-Urine-BI',1000000,1999999,'Biochemistry'),('None',NULL,NULL,''),('Plain-Blood-BI',1000000,1999999,'Biochemistry'),('Plain-Blood-DM',1,1000,'Dummy plain sample'),('Plain-BodyFluid-CY',5000000,5999999,''),('Plain-BodyFluid-MI',6000000,6999999,'Microbiology'),('Plain-CSF-BI',1000000,1999999,'Biochemistry'),('Plain-FNA-CY',5000000,5999999,''),('Plain-Nasopharyngeal-MI',6000000,6999999,'Microbiology'),('Plain-Other-BI',1000000,1999999,'Biochemistry'),('Plain-PAP-CY',5000000,5999999,''),('Plain-Peritoneal Fluid-BI',1000000,1999999,'Biochemistry'),('Plain-Pleural Fluid-BI',1000000,1999999,'Biochemistry'),('Plain-Semen-CP',3000000,3999999,'Clinical Pathology - Semen'),('Plain-Smear-CY',5000000,5999999,''),('Plain-Stool-CP',3000000,3999999,'Clinical Pathology - Stool'),('Plain-Urine-BI',1000000,1999999,'Biochemistry'),('Plain-Urine-CP',3000000,3999999,'Clinical Pathology - Urine'),('QC-QC-BI',9000000,9999999,'For Biochemistry QC');
/*!40000 ALTER TABLE `sample_id_strategy` ENABLE KEYS */;
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
