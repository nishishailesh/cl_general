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
-- Table structure for table `lab_reference_value`
--

DROP TABLE IF EXISTS `lab_reference_value`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lab_reference_value` (
  `lab_reference_value_id` int(11) NOT NULL AUTO_INCREMENT,
  `mrd` varchar(5000) NOT NULL,
  `examination_id` int(11) NOT NULL,
  `equipment` varchar(100) NOT NULL,
  `start_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `mean` decimal(10,4) NOT NULL,
  `sd` decimal(10,4) NOT NULL,
  `remark` varchar(100) NOT NULL,
  PRIMARY KEY (`lab_reference_value_id`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lab_reference_value`
--

LOCK TABLES `lab_reference_value` WRITE;
/*!40000 ALTER TABLE `lab_reference_value` DISABLE KEYS */;
INSERT INTO `lab_reference_value` VALUES (1,'QC/5/Randox/1369UE',9031,'XL_1000','2020-05-08','11:49:09','2021-06-08','11:49:09',108.0000,3.6700,''),(2,'QC/5/Randox/1369UE',9001,'XL_1000','2020-05-08','11:49:09','2021-06-08','11:49:09',1.4200,0.0800,''),(3,'QC/5/Randox/1369UE',9002,'XL_1000','2020-05-08','11:49:09','2021-06-08','11:49:09',43.5000,2.7000,''),(4,'QC/5/Randox/1369UE',9006,'XL_1000','2020-05-08','11:49:09','2021-06-08','11:49:09',32.6000,1.8000,''),(5,'QC/5/Randox/1369UE',9008,'XL_1000','2020-05-08','11:49:09','2021-06-08','11:49:09',91.8000,5.0000,''),(7,'QC/5/Randox/1369UE',9007,'XL_1000','2020-05-08','11:49:09','2021-06-08','11:49:09',171.9000,8.6000,''),(8,'QC/5/Randox/1369UE',9009,'XL_1000','2020-05-08','11:49:09','2021-06-08','11:49:09',1.5700,0.0700,''),(9,'QC/5/Randox/1369UE',9010,'XL_1000','2020-05-08','11:49:09','2021-06-08','11:49:09',0.8000,0.1000,''),(10,'QC/5/Randox/1369UE',9011,'XL_1000','2020-05-08','11:49:09','2021-06-08','11:49:09',4.0300,0.1600,''),(11,'QC/5/Randox/1369UE',9012,'XL_1000','2020-05-08','11:49:09','2021-06-08','11:49:09',5.5400,0.2000,''),(12,'QC/5/Randox/1369UE',9014,'XL_1000','2020-05-08','11:49:09','2021-06-08','11:49:09',8.1200,0.3000,''),(13,'QC/5/Randox/1369UE',9015,'XL_1000','2020-05-08','11:49:09','2021-06-08','11:49:09',142.0000,6.0000,''),(14,'QC/5/Randox/1369UE',9018,'XL_1000','2020-05-08','11:49:09','2021-06-08','11:49:09',93.0000,4.1800,''),(15,'QC/5/Randox/1369UE',9019,'XL_1000','2020-05-08','11:49:09','2021-06-08','11:49:09',143.9000,2.4000,''),(16,'QC/5/Randox/1369UE',9020,'XL_1000','2020-05-08','11:49:09','2021-06-08','11:49:09',4.0500,0.1100,''),(17,'QC/5/Randox/1369UE',9025,'XL_1000','2020-05-08','11:49:09','2021-06-08','11:49:09',221.4000,12.2000,''),(18,'QC/5/Randox/1369UE',9027,'XL_1000','2020-05-08','11:49:09','2021-06-08','11:49:09',5.7400,0.2200,''),(19,'QC/5/Randox/1369UE',9051,'XL_1000','2020-05-08','11:49:09','2021-06-08','11:49:09',4.1000,0.3000,''),(20,'QC/5/Randox/1369UE',9092,'XL_1000','2020-05-08','11:49:09','2021-06-08','11:49:09',244.6700,7.2000,''),(21,'QC/5/Randox/1369UE',9093,'XL_1000','2020-05-08','11:49:09','2021-06-08','11:49:09',140.4000,8.0000,''),(22,'QC/5/Randox/1369UE',9113,'XL_1000','2020-05-08','11:49:09','2021-06-08','11:49:09',5959.2000,519.8400,''),(23,'QC/5/Randox/1369UE',9021,'XL_1000','2020-05-08','11:49:09','2021-06-08','11:49:09',112.1000,7.0600,''),(24,'QC/8/Randox/1066UE',9021,'XL_1000','2020-05-08','11:49:09','2021-06-08','11:49:09',221.3000,12.4000,''),(25,'QC/5/Randox/1369UE',9016,'XL_1000','2020-05-08','11:49:09','2021-06-08','11:49:09',46.5000,4.1000,''),(26,'QC/8/Randox/1066UE',9016,'XL_1000','2020-05-08','11:49:09','2021-06-08','11:49:09',90.3000,5.4000,''),(27,'QC/8/Randox/1066UE',9001,'XL_1000','2020-05-08','11:49:09','2021-06-08','11:49:09',4.1300,0.1800,''),(28,'QC/8/Randox/1066UE',9002,'XL_1000','2020-05-08','11:49:09','2021-06-08','11:49:09',117.0000,6.5000,''),(29,'QC/8/Randox/1066UE',9006,'XL_1000','2020-05-08','11:49:09','2021-06-08','11:49:09',137.7000,6.1000,''),(30,'QC/8/Randox/1066UE',9007,'XL_1000','2020-05-08','11:49:09','2021-06-08','11:49:09',332.3100,17.1000,''),(31,'QC/8/Randox/1066UE',9008,'XL_1000','2020-05-08','11:49:09','2021-06-08','11:49:09',322.7000,12.6000,''),(32,'QC/8/Randox/1066UE',9009,'XL_1000','2020-05-08','11:49:09','2021-06-08','11:49:09',4.9200,0.1500,''),(33,'QC/8/Randox/1066UE',9010,'XL_1000','2020-05-08','11:49:09','2021-06-08','11:49:09',1.6000,0.1000,''),(34,'QC/8/Randox/1066UE',9011,'XL_1000','2020-05-08','11:49:09','2021-06-08','11:49:09',2.8800,0.1300,''),(35,'QC/8/Randox/1066UE',9012,'XL_1000','2020-05-08','11:49:09','2021-06-08','11:49:09',4.4700,0.2000,''),(36,'QC/8/Randox/1066UE',9014,'XL_1000','2020-05-08','11:49:09','2021-06-08','11:49:09',12.5100,0.6400,''),(37,'QC/8/Randox/1066UE',9015,'XL_1000','2020-05-08','11:49:09','2021-06-08','11:49:09',258.0000,11.1000,''),(38,'QC/8/Randox/1066UE',9018,'XL_1000','2020-05-08','11:49:09','2021-06-08','11:49:09',240.0000,11.7000,''),(39,'QC/8/Randox/1066UE',9019,'XL_1000','2020-05-08','11:49:09','2021-06-08','11:49:09',157.7000,3.4600,''),(40,'QC/8/Randox/1066UE',9020,'XL_1000','2020-05-08','11:49:09','2021-06-08','11:49:09',5.8400,0.1600,''),(41,'QC/8/Randox/1066UE',9027,'XL_1000','2020-05-08','11:49:09','2021-06-08','11:49:09',9.2000,0.4000,''),(42,'QC/8/Randox/1066UE',9031,'XL_1000','2020-05-08','11:49:09','2021-06-08','11:49:09',281.0000,8.6200,''),(43,'QC/8/Randox/1066UE',9051,'XL_1000','2020-05-08','11:49:09','2021-06-08','11:49:09',6.2000,0.3000,''),(44,'QC/8/Randox/1066UE',9113,'XL_1000','2020-05-08','11:49:09','2021-06-08','11:49:09',5084.1000,458.6100,''),(45,'QC/8/Randox/1066UE',9025,'XL_1000','2020-05-08','11:49:09','2021-06-08','11:49:09',379.5000,20.5000,''),(46,'QC/5/Randox/1369UE',9031,'XL_640','2020-05-08','11:49:09','2021-06-08','11:49:09',108.0000,3.6700,''),(47,'QC/5/Randox/1369UE',9001,'XL_640','2020-05-08','11:49:09','2021-06-08','11:49:09',1.4200,0.0800,''),(48,'QC/8/Randox/1066UE',9001,'XL_640','2020-05-08','11:49:09','2021-06-08','11:49:09',4.1300,0.1800,''),(49,'QC/5/Randox/1369UE',9002,'XL_640','2020-05-08','11:49:09','2021-06-08','11:49:09',43.5000,2.7000,''),(50,'QC/8/Randox/1066UE',9002,'XL_640','2020-05-08','11:49:09','2021-06-08','11:49:09',117.0000,6.5000,''),(51,'QC/5/Randox/1369UE',9006,'XL_640','2020-05-08','11:49:09','2021-06-08','11:49:09',32.6000,1.8000,''),(52,'QC/8/Randox/1066UE',9006,'XL_640','2020-05-08','11:49:09','2021-06-08','11:49:09',137.7000,6.1000,''),(53,'QC/5/Randox/1369UE',9007,'XL_640','2020-05-08','11:49:09','2021-06-08','11:49:09',171.9000,8.6000,''),(54,'QC/8/Randox/1066UE',9007,'XL_640','2020-05-08','11:49:09','2021-06-08','11:49:09',332.3100,17.1000,''),(55,'QC/5/Randox/1369UE',9008,'XL_640','2020-05-08','11:49:09','2021-06-08','11:49:09',91.8000,5.0000,''),(56,'QC/8/Randox/1066UE',9008,'XL_640','2020-05-08','11:49:09','2021-06-08','11:49:09',322.7000,12.6000,''),(57,'QC/5/Randox/1369UE',9009,'XL_640','2020-05-08','11:49:09','2021-06-08','11:49:09',1.5700,0.0700,''),(58,'QC/8/Randox/1066UE',9009,'XL_640','2020-05-08','11:49:09','2021-06-08','11:49:09',4.9200,0.1500,''),(59,'QC/5/Randox/1369UE',9010,'XL_640','2020-05-08','11:49:09','2021-06-08','11:49:09',0.8000,0.1000,''),(60,'QC/8/Randox/1066UE',9010,'XL_640','2020-05-08','11:49:09','2021-06-08','11:49:09',1.6000,0.1000,''),(61,'QC/5/Randox/1369UE',9012,'XL_640','2020-05-08','11:49:09','2021-06-08','11:49:09',5.5400,0.2000,''),(62,'QC/8/Randox/1066UE',9012,'XL_640','2020-05-08','11:49:09','2021-06-08','11:49:09',4.4700,0.2000,''),(63,'QC/5/Randox/1369UE',9011,'XL_640','2020-05-08','11:49:09','2021-06-08','11:49:09',4.0300,0.1600,''),(64,'QC/8/Randox/1066UE',9011,'XL_640','2020-05-08','11:49:09','2021-06-08','11:49:09',2.8800,0.1300,''),(65,'QC/5/Randox/1369UE',9014,'XL_640','2020-05-08','11:49:09','2021-06-08','11:49:09',8.1200,0.3000,''),(66,'QC/8/Randox/1066UE',9014,'XL_640','2020-05-08','11:49:09','2021-06-08','11:49:09',12.5100,0.6400,''),(67,'QC/5/Randox/1369UE',9015,'XL_640','2020-05-08','11:49:09','2021-06-08','11:49:09',142.0000,6.0000,''),(68,'QC/8/Randox/1066UE',9015,'XL_640','2020-05-08','11:49:09','2021-06-08','11:49:09',258.0000,11.1000,''),(69,'QC/5/Randox/1369UE',9016,'XL_640','2020-05-08','11:49:09','2021-06-08','11:49:09',46.5000,4.1000,''),(70,'QC/8/Randox/1066UE',9016,'XL_640','2020-05-08','11:49:09','2021-06-08','11:49:09',90.3000,5.4000,''),(71,'QC/5/Randox/1369UE',9018,'XL_640','2020-05-08','11:49:09','2021-06-08','11:49:09',93.0000,4.1800,''),(72,'QC/8/Randox/1066UE',9018,'XL_640','2020-05-08','11:49:09','2021-06-08','11:49:09',240.0000,11.7000,''),(73,'QC/5/Randox/1369UE',9019,'XL_640','2020-05-08','11:49:09','2021-06-08','11:49:09',143.9000,2.4000,''),(74,'QC/8/Randox/1066UE',9019,'XL_640','2020-05-08','11:49:09','2021-06-08','11:49:09',157.7000,3.4600,''),(75,'QC/5/Randox/1369UE',9020,'XL_640','2020-05-08','11:49:09','2021-06-08','11:49:09',4.0500,0.1100,''),(76,'QC/8/Randox/1066UE',9020,'XL_640','2020-05-08','11:49:09','2021-06-08','11:49:09',5.8400,0.1600,''),(77,'QC/5/Randox/1369UE',9021,'XL_640','2020-05-08','11:49:09','2021-06-08','11:49:09',112.1000,7.0600,''),(78,'QC/8/Randox/1066UE',9021,'XL_640','2020-05-08','11:49:09','2021-06-08','11:49:09',221.3000,12.4000,''),(79,'QC/5/Randox/1369UE',9027,'XL_640','2020-05-08','11:49:09','2021-06-08','11:49:09',5.7400,0.2200,''),(81,'QC/8/Randox/1066UE',9027,'XL_640','2020-05-08','11:49:09','2021-06-08','11:49:09',9.2000,0.4000,''),(82,'QC/5/Randox/1369UE',9093,'XL_640','2020-05-08','11:49:09','2021-06-08','11:49:09',140.4000,8.0000,''),(83,'QC/5/Randox/1369UE',9113,'XL_640','2020-05-08','11:49:09','2021-06-08','11:49:09',5959.2000,519.8400,''),(84,'QC/5/Randox/1369UE',9025,'XL_640','2020-05-08','11:49:09','2021-06-08','11:49:09',221.4000,12.2000,''),(85,'QC/8/Randox/1066UE',9025,'XL_640','2020-05-08','11:49:09','2021-06-08','11:49:09',379.5000,20.5000,''),(86,'QC/8/Randox/1066UE',9031,'XL_640','2020-05-08','11:49:09','2021-06-08','11:49:09',281.0000,8.6200,''),(87,'QC/5/Randox/1369UE',9051,'XL_640','2020-05-08','11:49:09','2021-06-08','11:49:09',4.1000,0.3000,''),(88,'QC/8/Randox/1066UE',9051,'XL_640','2020-05-08','11:49:09','2021-06-08','11:49:09',6.2000,0.3000,'');
/*!40000 ALTER TABLE `lab_reference_value` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-06-24 23:39:09
