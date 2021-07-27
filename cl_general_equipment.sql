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
-- Table structure for table `equipment`
--

DROP TABLE IF EXISTS `equipment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `equipment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `equipment` varchar(100) NOT NULL,
  `recording_time` datetime DEFAULT NULL,
  `recorded_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`equipment`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipment`
--

LOCK TABLES `equipment` WRITE;
/*!40000 ALTER TABLE `equipment` DISABLE KEYS */;
INSERT INTO `equipment` VALUES (1,'11_REFRIGERATOR_HE_78_SAMSUNG',NULL,NULL),(2,'12_REFRIGERATOR_HE_78_SAMSUNG',NULL,NULL),(3,'13_REFRIGERATOR_HE_78_SAMSUNG',NULL,NULL),(4,'5KVA UPS Arrow',NULL,NULL),(5,'Centrfuge Remi PR-23 HOSP-EQ-P-138-VCDB-4172_not working',NULL,NULL),(6,'Centrfuge Remi PR-23 HOSP-EQ-P-138-VCDB-4173',NULL,NULL),(7,'Centrfuge Remi PR-23 HOSP-EQ-P-138-VCDB-4174',NULL,NULL),(8,'Centrfuge Remi PR-23 HOSP-EQ-P-138-VCDB-4175_not in Use but working',NULL,NULL),(9,'Centrfuge Remi PR-23 HOSP-EQ-P-52-ZEHN 25664',NULL,NULL),(10,'Centrfuge Remi PR-23 HOSP-EQ-P-52-ZEHN 25665',NULL,NULL),(11,'Centrfuge Remi PR-23 HOSP-EQ-P-52-ZEHN 25666',NULL,NULL),(12,'Centrfuge Remi PR-23 HOSP-EQ-P-52-ZEHN 25667',NULL,NULL),(13,'Centrfuge Remi PR-24 HOSP-EQ-P-51-ZCBN 4721',NULL,NULL),(14,'D.I.Water Plant COLL EQ Pg 03',NULL,NULL),(15,'Deep freezer(-40) HOSP-EQ-P-136_not in use but working',NULL,NULL),(16,'Digital display thermometer',NULL,NULL),(17,'Digital Tachometer',NULL,NULL),(18,'Digital Thermometer',NULL,NULL),(19,'Erba Chem 5 Plus semiauto 1 HOSP-EQ-P-3-1 ',NULL,NULL),(20,'Erba Chem 5 Plus semiauto 2 HOSP-EQ-P-3-2 ',NULL,NULL),(21,'Erba Chem 5 Plus semiauto 3 HOSP-EQ-P-3-3 ',NULL,NULL),(22,'Erba XL-640 HOSP-EQ-P-10',NULL,NULL),(23,'Haier chest freezer: HOSP-EQ-P-136',NULL,NULL),(24,'HP Server COLL-EQ-P-133',NULL,NULL),(25,'Laboratory Fume hood COLL-EQ-P-15',NULL,NULL),(26,'Laminar air flow COLL-EQ-P-15',NULL,NULL),(27,'Maruti Calibrated weights (1kg & 2Kg) COLL EQ Pg-05',NULL,NULL),(28,'Neer R.O.Water Plant COLL-EQ-Pg-02',NULL,NULL),(29,'Pipettes',NULL,NULL),(30,'Prolyte Electrolyte Analyzer HOSP-EQ-P-40-81001755_Not working',NULL,NULL),(31,'Remi Centrifuge R-8C BL HOSP-EQ-P-50-BCLC-682_Not working',NULL,NULL),(32,'Remi Centrifuge R-8C BL HOSP-EQ-P-50-HCLC-3959_Not working',NULL,NULL),(33,'Remi Centrifuge R-8C DX HOSP-EQ-P-50-DBLC-3586_Not working',NULL,NULL),(34,'Remi Centrifuge R-8C DX HOSP-EQ-P-50-EBLC-5162_Not working ',NULL,NULL),(35,'Remi Cooling Incubator CI-35 HOSP-EQ-P-71-IHC-3182',NULL,NULL),(36,'remi quick freezer(-20) Biochemistry: HOSP-EQ-P-138',NULL,NULL),(37,'Reptech weighing machine COLL-EQ-P-05',NULL,NULL),(38,'Ricoh Printer MP 2000 L2 COLL EQ P-123-17126750553',NULL,NULL),(39,'Ricoh printer MP 2001 L COLL EQ-P-123-E343MB50051',NULL,NULL),(40,'Sartorius  Weight',NULL,NULL),(41,'Shimadzu Analytic Balance HOSP-EQ-P-21Shimadzu Sci',NULL,NULL),(42,'Shimadzu Analytic Balance HOSP-EQ-P-21Shimadzu Sci_D450028778',NULL,NULL),(43,'SYSTRONICS Digital Electrophoresis power supply HOSP-EQ-P-139-850',NULL,NULL),(44,'Thermo_Hygrometers',NULL,NULL),(45,'volumetric flask',NULL,NULL),(46,'Water Treatment Plant - Clinical Laboratory',NULL,NULL),(47,'Water Treatment Plant - Research Lab',NULL,NULL),(48,'Yorco Hot air oven YSI431D HOSP-EQ-P-69-14B5312',NULL,NULL),(49,'Zebra Technologies ZTC _GC420t_Barcode Printer',NULL,NULL),(50,'Zebra tip 2844 Barcode Printer',NULL,NULL);
/*!40000 ALTER TABLE `equipment` ENABLE KEYS */;
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
