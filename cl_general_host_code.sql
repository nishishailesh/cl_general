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
INSERT INTO `host_code` VALUES (5001,'XL_640','CR'),(5002,'XL_640','URE'),(5006,'XL_640','ALT'),(5007,'XL_640','ALP'),(5008,'XL_640','AMY'),(5009,'XL_640','TBIL'),(5010,'XL_640','DBIL'),(5011,'XL_640','ALB'),(5012,'XL_640','TP'),(5013,'XL_640','AST'),(5014,'XL_640','CAL'),(5015,'XL_640','CHO'),(5016,'XL_640','CHOH'),(5017,'XL_640','CHOL'),(5018,'XL_640','TG'),(5019,'XL_640','Na'),(5020,'XL_640','K'),(5021,'XL_640','IRON'),(5022,'XL_640','TIBC'),(5023,'XL_640','UIBC'),(5024,'XL_640','IBIL'),(5025,'XL_640','LDH'),(5026,'XL_640','LIP'),(5027,'XL_640','UA'),(5028,'XL_640','CHOV'),(5029,'XL_640','GLC'),(5030,'XL_640','MPR'),(5031,'XL_640','GLC'),(5032,'XL_640','ADA'),(5033,'XL_640','ADA'),(5034,'XL_640','ADA'),(5035,'XL_640','GLC'),(5036,'XL_640','GLC'),(5037,'XL_640','TP'),(5038,'XL_640','TP'),(5039,'XL_640','LIP'),(5040,'XL_640','AMY'),(5041,'XL_640','LDH'),(5042,'XL_640','CHO'),(5043,'XL_640','TG'),(5044,'XL_640','AMY'),(5045,'XL_640','LIP'),(5046,'XL_640','LDH'),(5047,'XL_640','LDH'),(5048,'XL_640','Na'),(5049,'XL_640','K'),(5050,'XL_640','CAL'),(5051,'XL_640','PHO'),(5052,'XL_640','CR'),(5053,'XL_640','TP'),(5054,'XL_640','KTO'),(5055,'XL_640','UA'),(5080,'XL_640','TP'),(5081,'XL_640','MPR'),(5082,'XL_640','MPR'),(5083,'XL_640','Na'),(5084,'XL_640','CAL'),(5085,'XL_640','MPR'),(5092,'XL_640','CK'),(5093,'XL_640','CKMB'),(5100,'XL_640','PHO'),(5113,'XL_640','CHE'),(9001,'XL_640','CR'),(9002,'XL_640','URE'),(9006,'XL_640','ALT'),(9007,'XL_640','ALP'),(9008,'XL_640','AMY'),(9009,'XL_640','TBIL'),(9010,'XL_640','DBIL'),(9011,'XL_640','ALB'),(9012,'XL_640','TP'),(9013,'XL_640','AST'),(9014,'XL_640','CAL'),(9015,'XL_640','CHO'),(9016,'XL_640','CHOH'),(9018,'XL_640','TG'),(9019,'XL_640','Na'),(9020,'XL_640','K'),(9021,'XL_640','IRON'),(9023,'XL_640','UIBC'),(9025,'XL_640','LDH'),(9026,'XL_640','LIP'),(9027,'XL_640','UA'),(9031,'XL_640','GLC'),(9051,'XL_640','PHO'),(9092,'XL_640','CK'),(9093,'XL_640','CKMB'),(9113,'XL_640','CHE'),(5001,'XL_1000','CRR'),(5002,'XL_1000','UREE'),(5006,'XL_1000','ALTT'),(5007,'XL_1000','ALPP'),(5008,'XL_1000','AMYY'),(5009,'XL_1000','TBILL'),(5010,'XL_1000','DBILL'),(5011,'XL_1000','ALBB'),(5012,'XL_1000','TPP'),(5013,'XL_1000','ASTT'),(5014,'XL_1000','CALL'),(5015,'XL_1000','CHOO'),(5016,'XL_1000','CHOHH'),(5018,'XL_1000','TGG'),(5019,'XL_1000','Naa'),(5020,'XL_1000','KK'),(5021,'XL_1000','IRONN'),(5023,'XL_1000','UIBCC'),(5025,'XL_1000','LDHH'),(5026,'XL_1000','LIPP'),(5027,'XL_1000','UAA'),(5029,'XL_1000','GLCC'),(5030,'XL_1000','MPRR'),(5031,'XL_1000','GLCC'),(5032,'XL_1000','ADAA'),(5033,'XL_1000','ADAA'),(5034,'XL_1000','ADAA'),(5035,'XL_1000','GLCC'),(5036,'XL_1000','GLCC'),(5037,'XL_1000','TPP'),(5038,'XL_1000','TPP'),(5039,'XL_1000','LIPP'),(5040,'XL_1000','AMYY'),(5041,'XL_1000','LDHH'),(5042,'XL_1000','CHOO'),(5043,'XL_1000','TGG'),(5044,'XL_1000','AMYY'),(5045,'XL_1000','LIPP'),(5046,'XL_1000','LDHH'),(5047,'XL_1000','LDHH'),(5048,'XL_1000','Naa'),(5049,'XL_1000','KK'),(5050,'XL_1000','CALL'),(5051,'XL_1000','PHOO'),(5052,'XL_1000','CRR'),(5053,'XL_1000','TPP'),(5054,'XL_1000','KTOO'),(5055,'XL_1000','UAA'),(5080,'XL_1000','TPP'),(5081,'XL_1000','MPRR'),(5082,'XL_1000','MPRR'),(5083,'XL_1000','Naa'),(5084,'XL_1000','CALL'),(5085,'XL_1000','MPRR'),(5092,'XL_1000','CKK'),(5093,'XL_1000','CKMBB'),(5100,'XL_1000','PHOO'),(5113,'XL_1000','CHEE'),(5114,'XL_1000','HCLL'),(9001,'XL_1000','CRR'),(9002,'XL_1000','UREE'),(9006,'XL_1000','ALTT'),(9007,'XL_1000','ALPP'),(9008,'XL_1000','AMYY'),(9009,'XL_1000','TBILL'),(9010,'XL_1000','DBILL'),(9011,'XL_1000','ALBB'),(9012,'XL_1000','TPP'),(9013,'XL_1000','ASTT'),(9014,'XL_1000','CALL'),(9015,'XL_1000','CHOO'),(9016,'XL_1000','CHOHH'),(9018,'XL_1000','TGG'),(9019,'XL_1000','Naa'),(9020,'XL_1000','KK'),(9021,'XL_1000','IRONN'),(9023,'XL_1000','UIBC'),(9025,'XL_1000','LDHH'),(9026,'XL_1000','LIPP'),(9027,'XL_1000','UAA'),(9031,'XL_1000','GLCC'),(9051,'XL_1000','PHOO'),(9092,'XL_1000','CKK'),(9093,'XL_1000','CKMBB'),(9113,'XL_1000','CHEE');
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

-- Dump completed on 2020-07-03 22:40:21
