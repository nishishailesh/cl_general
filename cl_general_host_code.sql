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
-- Table structure for table `host_code`
--

DROP TABLE IF EXISTS `host_code`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `host_code` (
  `examination_id` int(11) NOT NULL,
  `equipment` enum('XL_640','XL_1000') NOT NULL,
  `code` varchar(10) NOT NULL,
  PRIMARY KEY (`equipment`,`examination_id`),
  KEY `examination_id` (`examination_id`),
  CONSTRAINT `host_code_ibfk_1` FOREIGN KEY (`examination_id`) REFERENCES `examination` (`examination_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `host_code`
--

LOCK TABLES `host_code` WRITE;
/*!40000 ALTER TABLE `host_code` DISABLE KEYS */;
INSERT INTO `host_code` VALUES (5001,'XL_640','CR'),(5002,'XL_640','URE'),(5006,'XL_640','ALT'),(5007,'XL_640','ALP'),(5008,'XL_640','AMY'),(5009,'XL_640','TBIL'),(5010,'XL_640','DBIL'),(5011,'XL_640','ALB'),(5012,'XL_640','TP'),(5013,'XL_640','AST'),(5014,'XL_640','CAL'),(5015,'XL_640','CHO'),(5016,'XL_640','CHOH'),(5017,'XL_640','CHOL'),(5018,'XL_640','TG'),(5019,'XL_640','Na'),(5020,'XL_640','K'),(5021,'XL_640','IRON'),(5022,'XL_640','TIBC'),(5023,'XL_640','UIBC'),(5024,'XL_640','IBIL'),(5025,'XL_640','LDH'),(5026,'XL_640','LIP'),(5027,'XL_640','UA'),(5028,'XL_640','CHOV'),(5029,'XL_640','GLC'),(5030,'XL_640','TP'),(5031,'XL_640','GLC'),(5032,'XL_640','ADA'),(5033,'XL_640','ADA'),(5034,'XL_640','ADA'),(5035,'XL_640','GLC'),(5036,'XL_640','GLC'),(5037,'XL_640','TP'),(5038,'XL_640','TP'),(5039,'XL_640','LIP'),(5040,'XL_640','AMY'),(5041,'XL_640','LDH'),(5042,'XL_640','CHO'),(5043,'XL_640','TG'),(5044,'XL_640','AMY'),(5045,'XL_640','LIP'),(5046,'XL_640','LDH'),(5047,'XL_640','LDH'),(5048,'XL_640','Na'),(5049,'XL_640','K'),(5050,'XL_640','CAL'),(5051,'XL_640','PHO'),(5052,'XL_640','CR'),(5054,'XL_640','KTO'),(5055,'XL_640','UA'),(5080,'XL_640','TP'),(5081,'XL_640','TP'),(5082,'XL_640','TP'),(5083,'XL_640','Na'),(5084,'XL_640','CAL'),(5085,'XL_640','MPR'),(5092,'XL_640','CK'),(5093,'XL_640','CKMB');
/*!40000 ALTER TABLE `host_code` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-04-26 23:45:42
