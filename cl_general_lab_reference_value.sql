-- MySQL dump 10.17  Distrib 10.3.22-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: cl_general
-- ------------------------------------------------------
-- Server version	10.3.22-MariaDB-0+deb10u1

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
) ENGINE=InnoDB AUTO_INCREMENT=9056 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lab_reference_value`
--

LOCK TABLES `lab_reference_value` WRITE;
/*!40000 ALTER TABLE `lab_reference_value` DISABLE KEYS */;
INSERT INTO `lab_reference_value` VALUES (1,'QC/5/Randox/1369UE',9031,'XL_1000','2020-05-08','11:49:09','2020-06-16','11:50:00',108.0000,3.6700,''),(2,'QC/5/Randox/1369UE',9001,'XL_1000','2020-05-08','11:49:09','2020-06-16','11:50:00',1.4200,0.0800,''),(3,'QC/5/Randox/1369UE',9002,'XL_1000','2020-05-08','11:49:09','2020-06-16','11:50:00',43.5000,2.7000,''),(4,'QC/5/Randox/1369UE',9006,'XL_1000','2020-05-08','11:49:09','2020-06-16','11:50:00',32.6000,1.8000,''),(5,'QC/5/Randox/1369UE',9008,'XL_1000','2020-05-08','11:49:09','2020-06-16','11:50:00',91.8000,5.0000,''),(7,'QC/5/Randox/1369UE',9007,'XL_1000','2020-05-08','11:49:09','2020-06-16','11:50:00',171.9000,8.6000,''),(8,'QC/5/Randox/1369UE',9009,'XL_1000','2020-05-08','11:49:09','2020-06-16','11:50:00',1.5700,0.0700,''),(9,'QC/5/Randox/1369UE',9010,'XL_1000','2020-05-08','11:49:09','2020-06-16','11:50:00',0.8000,0.1000,''),(10,'QC/5/Randox/1369UE',9011,'XL_1000','2020-05-08','11:49:09','2020-06-16','11:50:00',4.0300,0.1600,''),(11,'QC/5/Randox/1369UE',9012,'XL_1000','2020-05-08','11:49:09','2020-06-16','11:50:00',5.5400,0.2000,''),(12,'QC/5/Randox/1369UE',9014,'XL_1000','2020-05-08','11:49:09','2020-06-16','11:50:00',8.1200,0.3000,''),(13,'QC/5/Randox/1369UE',9015,'XL_1000','2020-05-08','11:49:09','2020-06-16','11:50:00',142.0000,6.0000,''),(14,'QC/5/Randox/1369UE',9018,'XL_1000','2020-05-08','11:49:09','2020-06-16','11:50:00',93.0000,4.1800,''),(15,'QC/5/Randox/1369UE',9019,'XL_1000','2020-05-08','11:49:09','2020-06-16','11:50:00',143.9000,2.4000,''),(16,'QC/5/Randox/1369UE',9020,'XL_1000','2020-05-08','11:49:09','2020-06-16','11:50:00',4.0500,0.1100,''),(17,'QC/5/Randox/1369UE',9025,'XL_1000','2020-05-08','11:49:09','2020-06-16','11:50:00',221.4000,12.2000,''),(18,'QC/5/Randox/1369UE',9027,'XL_1000','2020-05-08','11:49:09','2020-06-16','11:50:00',5.7400,0.2200,''),(19,'QC/5/Randox/1369UE',9051,'XL_1000','2020-05-08','11:49:09','2020-06-16','11:50:00',4.1000,0.3000,''),(20,'QC/8/SPIN_CK/241',9092,'XL_1000','2020-05-08','11:49:09','2020-06-16','11:50:00',244.6700,7.2000,'use for CK and CKMB'),(21,'QC/8/SPIN_CK/241',9093,'XL_1000','2020-05-08','11:49:09','2020-06-16','11:50:00',140.4000,8.0000,'use for CK and CKMB'),(22,'QC/5/Randox/1369UE',9113,'XL_1000','2020-05-08','11:49:09','2020-06-16','11:50:00',5959.2000,519.8400,''),(23,'QC/5/Randox/1369UE',9021,'XL_1000','2020-05-08','11:49:09','2020-06-16','11:50:00',112.1000,7.0600,''),(24,'QC/8/Randox/1066UE',9021,'XL_1000','2020-05-08','11:49:09','2020-06-16','11:50:00',221.3000,12.4000,''),(25,'QC/5/Randox/1369UE',9016,'XL_1000','2020-05-08','11:49:09','2020-06-16','11:50:00',46.5000,4.1000,''),(26,'QC/8/Randox/1066UE',9016,'XL_1000','2020-05-08','11:49:09','2020-06-16','11:50:00',90.3000,5.4000,''),(27,'QC/8/Randox/1066UE',9001,'XL_1000','2020-05-08','11:49:09','2020-06-16','11:50:00',4.1300,0.1800,''),(28,'QC/8/Randox/1066UE',9002,'XL_1000','2020-05-08','11:49:09','2020-06-16','11:50:00',117.0000,6.5000,''),(29,'QC/8/Randox/1066UE',9006,'XL_1000','2020-05-08','11:49:09','2020-06-16','11:50:00',137.7000,6.1000,''),(30,'QC/8/Randox/1066UE',9007,'XL_1000','2020-05-08','11:49:09','2020-06-16','11:50:00',332.3100,17.1000,''),(31,'QC/8/Randox/1066UE',9008,'XL_1000','2020-05-08','11:49:09','2020-06-16','11:50:00',322.7000,12.6000,''),(32,'QC/8/Randox/1066UE',9009,'XL_1000','2020-05-08','11:49:09','2020-06-16','11:50:00',4.9200,0.1500,''),(33,'QC/8/Randox/1066UE',9010,'XL_1000','2020-05-08','11:49:09','2020-06-16','11:50:00',1.6000,0.1000,''),(34,'QC/8/Randox/1066UE',9011,'XL_1000','2020-05-08','11:49:09','2020-06-16','11:50:00',2.8800,0.1300,''),(35,'QC/8/Randox/1066UE',9012,'XL_1000','2020-05-08','11:49:09','2020-06-16','11:50:00',4.4700,0.2000,''),(36,'QC/8/Randox/1066UE',9014,'XL_1000','2020-05-08','11:49:09','2020-06-16','11:50:00',12.5100,0.6400,''),(37,'QC/8/Randox/1066UE',9015,'XL_1000','2020-05-08','11:49:09','2020-06-16','11:50:00',258.0000,11.1000,''),(38,'QC/8/Randox/1066UE',9018,'XL_1000','2020-05-08','11:49:09','2020-06-16','11:50:00',240.0000,11.7000,''),(39,'QC/8/Randox/1066UE',9019,'XL_1000','2020-05-08','11:49:09','2020-06-16','11:50:00',157.7000,3.4600,''),(40,'QC/8/Randox/1066UE',9020,'XL_1000','2020-05-08','11:49:09','2020-06-16','11:50:00',5.8400,0.1600,''),(41,'QC/8/Randox/1066UE',9027,'XL_1000','2020-05-08','11:49:09','2020-06-16','11:50:00',9.2000,0.4000,''),(42,'QC/8/Randox/1066UE',9031,'XL_1000','2020-05-08','11:49:09','2020-06-16','11:50:00',281.0000,8.6200,''),(43,'QC/8/Randox/1066UE',9051,'XL_1000','2020-05-08','11:49:09','2020-06-16','11:50:00',6.2000,0.3000,''),(44,'QC/8/Randox/1066UE',9113,'XL_1000','2020-05-08','11:49:09','2020-06-16','11:50:00',5084.1000,458.6100,''),(45,'QC/8/Randox/1066UE',9025,'XL_1000','2020-05-08','11:49:09','2020-06-16','11:50:00',379.5000,20.5000,''),(46,'QC/5/Randox/1369UE',9031,'XL_640','2020-05-08','11:49:09','2021-06-16','11:50:00',108.0000,3.6700,''),(47,'QC/5/Randox/1369UE',9001,'XL_640','2020-05-08','11:49:09','2021-06-16','11:50:00',1.4200,0.0800,''),(48,'QC/8/Randox/1066UE',9001,'XL_640','2020-05-08','11:49:09','2021-06-16','11:50:00',4.1300,0.1800,''),(49,'QC/5/Randox/1369UE',9002,'XL_640','2020-05-08','11:49:09','2021-06-16','11:50:00',43.5000,2.7000,''),(50,'QC/8/Randox/1066UE',9002,'XL_640','2020-05-08','11:49:09','2021-06-16','11:50:00',117.0000,6.5000,''),(51,'QC/5/Randox/1369UE',9006,'XL_640','2020-05-08','11:49:09','2021-06-16','11:50:00',32.6000,1.8000,''),(52,'QC/8/Randox/1066UE',9006,'XL_640','2020-05-08','11:49:09','2021-06-16','11:50:00',137.7000,6.1000,''),(53,'QC/5/Randox/1369UE',9007,'XL_640','2020-05-08','11:49:09','2021-06-16','11:50:00',171.9000,8.6000,''),(54,'QC/8/Randox/1066UE',9007,'XL_640','2020-05-08','11:49:09','2021-06-16','11:50:00',332.3100,17.1000,''),(55,'QC/5/Randox/1369UE',9008,'XL_640','2020-05-08','11:49:09','2021-06-16','11:50:00',91.8000,5.0000,''),(56,'QC/8/Randox/1066UE',9008,'XL_640','2020-05-08','11:49:09','2021-06-16','11:50:00',322.7000,12.6000,''),(57,'QC/5/Randox/1369UE',9009,'XL_640','2020-05-08','11:49:09','2021-06-16','11:50:00',1.5700,0.0700,''),(58,'QC/8/Randox/1066UE',9009,'XL_640','2020-05-08','11:49:09','2021-06-16','11:50:00',4.9200,0.1500,''),(59,'QC/5/Randox/1369UE',9010,'XL_640','2020-05-08','11:49:09','2020-06-17','16:00:00',0.8000,0.1000,''),(60,'QC/8/Randox/1066UE',9010,'XL_640','2020-05-08','11:49:09','2020-06-17','16:00:00',1.6000,0.1000,''),(61,'QC/5/Randox/1369UE',9012,'XL_640','2020-05-08','11:49:09','2021-06-16','11:50:00',5.5400,0.2000,''),(62,'QC/8/Randox/1066UE',9012,'XL_640','2020-05-08','11:49:09','2021-06-16','11:50:00',4.4700,0.2000,''),(63,'QC/5/Randox/1369UE',9011,'XL_640','2020-05-08','11:49:09','2021-06-16','11:50:00',4.0300,0.1600,''),(64,'QC/8/Randox/1066UE',9011,'XL_640','2020-05-08','11:49:09','2021-06-16','11:50:00',2.8800,0.1300,''),(65,'QC/5/Randox/1369UE',9014,'XL_640','2020-05-08','11:49:09','2021-06-16','11:50:00',8.1200,0.3000,''),(66,'QC/8/Randox/1066UE',9014,'XL_640','2020-05-08','11:49:09','2021-06-16','11:50:00',12.5100,0.6400,''),(67,'QC/5/Randox/1369UE',9015,'XL_640','2020-05-08','11:49:09','2020-07-09','15:00:00',142.0000,6.0000,''),(68,'QC/8/Randox/1066UE',9015,'XL_640','2020-05-08','11:49:09','2020-07-09','15:00:00',258.0000,11.1000,''),(69,'QC/5/Randox/1369UE',9016,'XL_640','2020-05-08','11:49:09','2021-06-16','11:50:00',46.5000,4.1000,''),(70,'QC/8/Randox/1066UE',9016,'XL_640','2020-05-08','11:49:09','2020-07-07','01:00:00',90.3000,5.4000,''),(71,'QC/5/Randox/1369UE',9018,'XL_640','2020-05-08','11:49:09','2021-06-16','11:50:00',93.0000,4.1800,''),(72,'QC/8/Randox/1066UE',9018,'XL_640','2020-05-08','11:49:09','2021-06-16','11:50:00',256.0000,11.7000,''),(73,'QC/5/Randox/1369UE',9019,'XL_640','2020-05-08','11:49:09','2021-06-16','11:50:00',143.9000,2.4000,''),(74,'QC/8/Randox/1066UE',9019,'XL_640','2020-05-08','11:49:09','2021-06-16','11:50:00',157.7000,3.4600,''),(75,'QC/5/Randox/1369UE',9020,'XL_640','2020-05-08','11:49:09','2021-06-16','11:50:00',4.0500,0.1100,''),(76,'QC/8/Randox/1066UE',9020,'XL_640','2020-05-08','11:49:09','2021-06-16','11:50:00',5.8400,0.1600,''),(77,'QC/5/Randox/1369UE',9021,'XL_640','2020-05-08','11:49:09','2021-06-16','11:50:00',112.1000,7.0600,''),(78,'QC/8/Randox/1066UE',9021,'XL_640','2020-05-08','11:49:09','2021-06-16','11:50:00',221.3000,12.4000,''),(79,'QC/5/Randox/1369UE',9027,'XL_640','2020-05-08','11:49:09','2021-06-16','11:50:00',5.7400,0.2200,''),(81,'QC/8/Randox/1066UE',9027,'XL_640','2020-05-08','11:49:09','2021-06-16','11:50:00',9.2000,0.4000,''),(82,'QC/8/SPIN_CK/241',9093,'XL_640','2020-05-08','11:49:09','2021-06-16','11:50:00',140.4000,8.0000,'use for CK and CKMB'),(83,'QC/5/Randox/1369UE',9113,'XL_640','2020-05-08','11:49:09','2021-06-16','11:50:00',5959.2000,519.8400,''),(84,'QC/5/Randox/1369UE',9025,'XL_640','2020-05-08','11:49:09','2021-07-07','16:50:00',221.4000,12.2000,''),(85,'QC/8/Randox/1066UE',9025,'XL_640','2020-05-08','11:49:09','2021-06-16','11:50:00',379.5000,20.5000,''),(86,'QC/8/Randox/1066UE',9031,'XL_640','2020-05-08','11:49:09','2021-06-16','11:50:00',281.0000,8.6200,''),(87,'QC/5/Randox/1369UE',9051,'XL_640','2020-05-08','11:49:09','2020-08-13','09:50:00',4.1000,0.3000,''),(88,'QC/8/Randox/1066UE',9051,'XL_640','2020-05-08','11:49:09','2020-08-13','09:50:00',6.2000,0.3000,''),(89,'QC/5/Randox/1369UE',9031,'XL_1000','2020-06-16','12:50:00','2021-06-16','12:50:00',107.8000,3.6700,''),(90,'QC/5/Randox/1369UE',9001,'XL_1000','2020-06-16','12:50:00','2021-06-16','12:50:00',1.3900,0.0800,''),(91,'QC/5/Randox/1369UE',9002,'XL_1000','2020-06-16','12:50:00','2021-06-16','12:50:00',45.3000,2.7000,''),(92,'QC/5/Randox/1369UE',9006,'XL_1000','2020-06-16','12:50:00','2021-06-16','12:50:00',35.3000,1.8000,''),(93,'QC/5/Randox/1369UE',9008,'XL_1000','2020-06-16','12:50:00','2021-06-16','12:50:00',89.8000,5.0000,''),(94,'QC/5/Randox/1369UE',9007,'XL_1000','2020-06-16','12:50:00','2020-07-24','12:55:00',164.7000,8.6000,''),(95,'QC/5/Randox/1369UE',9009,'XL_1000','2020-06-16','12:50:00','2021-06-16','12:50:00',1.6000,0.0700,''),(96,'QC/5/Randox/1369UE',9010,'XL_1000','2020-06-16','12:50:00','2020-07-30','10:50:00',0.7500,0.1000,''),(97,'QC/5/Randox/1369UE',9011,'XL_1000','2020-06-16','12:50:00','2021-06-16','12:50:00',4.0500,0.1600,''),(98,'QC/5/Randox/1369UE',9012,'XL_1000','2020-06-16','12:50:00','2021-06-16','12:50:00',5.4200,0.2000,''),(99,'QC/5/Randox/1369UE',9014,'XL_1000','2020-06-16','12:50:00','2021-06-16','12:50:00',8.1300,0.3000,''),(100,'QC/5/Randox/1369UE',9015,'XL_1000','2020-06-16','12:50:00','2021-06-16','12:50:00',145.3000,6.0000,''),(101,'QC/5/Randox/1369UE',9018,'XL_1000','2020-06-16','12:50:00','2021-06-16','12:50:00',94.1000,4.1800,''),(102,'QC/5/Randox/1369UE',9019,'XL_1000','2020-06-16','12:50:00','2021-06-16','12:50:00',143.9000,2.4000,''),(103,'QC/5/Randox/1369UE',9025,'XL_1000','2020-06-16','12:50:00','2021-06-16','12:50:00',209.8000,12.2000,''),(104,'QC/5/Randox/1369UE',9027,'XL_1000','2020-06-16','12:50:00','2021-06-16','12:50:00',5.7300,0.2200,''),(105,'QC/5/Randox/1369UE',9051,'XL_1000','2020-06-16','12:50:00','2020-08-13','09:50:00',4.1600,0.3000,''),(106,'QC/8/Randox/1066UE',9006,'XL_1000','2020-06-16','12:50:00','2021-06-16','12:50:00',144.9000,6.1000,''),(107,'QC/8/Randox/1066UE',9007,'XL_1000','2020-06-16','12:50:00','2020-07-24','12:55:00',322.1000,17.1000,''),(108,'QC/8/Randox/1066UE',9001,'XL_1000','2020-06-16','12:50:00','2021-06-16','12:50:00',4.1100,0.1800,''),(109,'QC/8/Randox/1066UE',9018,'XL_1000','2020-06-16','12:50:00','2021-06-16','12:50:00',253.2000,11.7000,''),(110,'QC/8/Randox/1066UE',9009,'XL_1000','2020-06-16','12:50:00','2021-06-16','12:50:00',5.1700,0.1500,''),(111,'QC/8/Randox/1066UE',9010,'XL_1000','2020-06-16','12:50:00','2020-07-30','10:50:00',1.3300,0.1000,''),(112,'QC/8/Randox/1066UE',9014,'XL_1000','2020-06-16','12:50:00','2021-06-16','12:50:00',12.8300,0.6400,''),(113,'QC/8/Randox/1066UE',9051,'XL_1000','2020-06-16','12:50:00','2020-08-13','09:50:00',6.3300,0.3000,''),(114,'QC/8/Randox/1066UE',9015,'XL_1000','2020-06-16','12:50:00','2021-06-16','12:50:00',246.4000,11.1000,''),(115,'QC/8/Randox/1066UE',9025,'XL_1000','2020-06-16','12:50:00','2021-06-16','12:50:00',335.8000,20.5000,''),(116,'QC/8/Randox/1066UE',9002,'XL_1000','2020-06-16','12:50:00','2021-06-16','12:50:00',118.2000,6.5000,''),(117,'QC/8/Randox/1066UE',9008,'XL_1000','2020-06-16','12:50:00','2021-06-16','12:50:00',323.3000,12.6000,''),(118,'QC/8/Randox/1066UE',9027,'XL_1000','2020-06-16','12:50:00','2021-06-16','12:50:00',9.0300,0.4000,''),(119,'QC/8/Randox/1066UE',9012,'XL_1000','2020-06-16','12:50:00','2021-06-16','12:50:00',4.3200,0.2000,''),(120,'QC/8/Randox/1066UE',9031,'XL_1000','2020-06-16','12:50:00','2021-06-16','12:50:00',277.5000,8.6200,''),(121,'QC/8/Randox/1066UE',9011,'XL_1000','2020-06-16','12:50:00','2021-06-16','12:50:00',2.8300,0.1300,''),(122,'QC/5/Randox/1369UE',9010,'XL_640','2020-06-17','16:01:00','2020-07-30','23:50:00',0.6900,0.1000,''),(123,'QC/8/Randox/1066UE',9010,'XL_640','2020-06-17','16:01:00','2020-07-30','23:50:00',1.1400,0.1000,''),(124,'QC/5/Randox/1369UE',9021,'XL_1000','2020-06-23','09:00:09','2021-06-16','11:50:00',108.0000,7.0600,''),(125,'QC/8/Randox/1066UE',9021,'XL_1000','2020-06-23','09:00:00','2021-06-16','11:50:00',215.0000,12.4000,''),(126,'QC/8/SPIN_CK/241',9092,'XL_1000','2020-06-22','09:00:00','2021-06-16','11:50:00',243.0000,7.2000,'use for CK and CKMB'),(127,'QC/8/SPIN_CK/241',9092,'XL_640','2020-06-22','11:49:09','2021-06-16','11:50:00',244.6700,7.2000,'use for CK and CKMB'),(128,'QC/5/Randox/1369UE',9113,'XL_1000','2020-06-23','09:00:09','2021-06-16','11:50:00',5859.0000,519.8400,''),(129,'QC/8/Randox/1066UE',9113,'XL_1000','2020-06-23','09:00:09','2021-06-16','11:50:00',5213.0000,458.6100,''),(130,'QC/8/Randox/1066UE',9113,'XL_640','2020-06-23','09:00:09','2021-06-16','11:50:00',5084.1000,458.6100,''),(131,'QC/5/Randox/1242UE(D)',9081,'XL_640','2020-07-01','09:00:00','2021-06-16','11:50:00',60.2000,5.0000,''),(132,'QC/8/Randox/961UE(D)',9081,'XL_640','2020-07-01','09:00:00','2021-06-16','11:50:00',40.5000,4.0000,''),(133,'QC/8/Randox/1066UE',9016,'XL_640','2020-07-07','02:00:09','2021-07-07','01:00:00',86.1800,7.0000,'changed after calibration mean and IQC means are similar'),(134,'QC/5/UN-6',9019,'XL_640','2020-07-08','11:00:00','2022-07-08','11:00:00',46.7700,6.6100,''),(135,'QC/5/UN-6',9020,'XL_640','2020-07-08','11:00:00','2022-07-08','11:00:00',17.9500,0.8500,''),(136,'QC/5/UN-6',9001,'XL_640','2020-07-08','11:00:00','2022-07-08','11:00:00',37.7600,1.8500,''),(137,'QC/5/UA-6',9051,'XL_640','2020-07-08','11:00:00','2022-07-08','11:00:00',10.3600,0.4200,''),(138,'QC/5/UA-6',9014,'XL_640','2020-07-08','11:00:00','2022-07-08','11:00:00',1.2400,0.0600,'mean sd to be changed after collecting daily new mean and sd'),(139,'QC/5/UB-6',9027,'XL_640','2020-07-08','11:00:00','2022-07-08','11:00:00',10.0900,0.3800,''),(140,'QC/5/Randox/1369UE',9015,'XL_640','2020-07-09','15:10:09','2022-07-09','15:00:00',158.0000,6.0000,'mean  obtained during calibration is used'),(141,'QC/8/Randox/1066UE',9015,'XL_640','2020-07-09','15:10:09','2022-06-16','15:10:00',280.0000,11.1000,'mean  obtained during calibration is used'),(9013,'QC/5/Randox/1369UE',9013,'XL_640','2020-07-14','15:00:00','2021-07-14','15:00:00',33.0000,1.8000,''),(9014,'QC/8/Randox/1066UE',9013,'XL_640','2020-07-14','15:00:00','2021-07-14','15:00:00',151.0000,6.1000,''),(9015,'QC/0/BlankW',9031,'XL_1000','2020-07-24','10:00:00','2022-07-14','15:00:00',0.0000,1.8350,'for checking blank od precision. current qc 5 SD\'s half value set as SD'),(9016,'QC/0/BlankW',9012,'XL_1000','2020-07-24','10:00:00','2022-07-14','15:00:00',0.0000,0.1000,'for checking blank od precision. current qc 5 SD\'s half value set as SD'),(9017,'QC/0/BlankW',9011,'XL_1000','2020-07-24','10:00:00','2022-07-14','15:00:00',0.0000,0.0800,'for checking blank od precision. current qc 5 SD\'s half value set as SD'),(9018,'QC/0/BlankW',9027,'XL_1000','2020-07-24','10:00:00','2022-07-14','15:00:00',0.0000,0.1100,'for checking blank od precision. current qc 5 SD\'s half value set as SD'),(9019,'QC/0/BlankW',9014,'XL_1000','2020-07-24','10:00:00','2022-07-14','15:00:00',0.0000,0.1500,'for checking blank od precision. current qc 5 SD\'s half value set as SD'),(9020,'QC/0/BlankW',9051,'XL_1000','2020-07-24','10:00:00','2022-07-14','15:00:00',0.0000,0.1500,'for checking blank od precision. current qc 5 SD\'s half value set as SD'),(9021,'QC/0/BlankW',9015,'XL_1000','2020-07-24','10:00:00','2022-07-14','15:00:00',0.0000,3.0000,'for checking blank od precision. current qc 5 SD\'s half value set as SD'),(9022,'QC/0/BlankW',9018,'XL_1000','2020-07-24','10:00:00','2022-07-14','15:00:00',0.0000,2.0900,'for checking blank od precision. current qc 5 SD\'s half value set as SD'),(9023,'QC/5/Randox/1369UE',9007,'XL_1000','2020-07-24','13:00:00','2022-01-01','13:00:00',193.0000,8.6000,'achieved qc values in last calibration set as lj mean'),(9024,'QC/8/Randox/1066UE',9007,'XL_1000','2020-07-24','12:56:00','2025-07-24','12:55:00',336.0000,17.1000,'Achieved value of qc in last calibration set as LJ mean'),(9025,'QC/5/Randox/1369UE',9010,'XL_1000','2020-07-30','11:56:00','2021-07-14','12:55:00',0.7500,0.0600,'Due to round up of 0.06 which is previous sd was 1.00 which is now set as 0.06 '),(9026,'QC/8/Randox/1066UE',9010,'XL_1000','2020-07-30','11:56:00','2021-07-14','12:55:00',1.3300,0.0800,'previous sd 1 was due to round up sd now set 0.08'),(9027,'QC/5/Randox/1369UE',9010,'XL_640','2020-07-30','20:56:00','2021-07-30','23:50:00',0.6900,0.0600,'previous round up sd was 0.10 now set as 0.06'),(9028,'QC/8/Randox/1066UE',9010,'XL_640','2020-07-30','23:56:00','2021-07-30','12:55:00',1.1400,0.0800,'previous round sd was 0.10 now set 0.08'),(9051,'QC/5/Randox/1369UE',9051,'XL_1000','2020-08-13','10:56:00','2021-07-30','12:55:00',4.5700,0.3000,'reagent SOP changed achieved value in calibration set as target'),(9053,'QC/8/Randox/1066UE',9051,'XL_1000','2020-08-13','10:10:00','2021-08-13','09:50:00',6.6800,0.3000,'reagent SOP changed achieved value in calibration set as target'),(9054,'QC/5/Randox/1369UE',9051,'XL_640','2020-08-13','10:19:00','2021-08-13','09:50:00',4.5200,0.3000,'reagent SOP changed achieved value in calibration set as target'),(9055,'QC/8/Randox/1066UE',9051,'XL_640','2020-08-13','10:19:09','2021-08-13','09:50:00',6.7900,0.3000,'reagent SOP changed achieved value in calibration set as target');
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

-- Dump completed on 2020-08-13 22:37:28
