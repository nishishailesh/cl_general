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
-- Table structure for table `dementia`
--

DROP TABLE IF EXISTS `dementia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dementia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Minutes` varchar(10) DEFAULT NULL,
  `Hours` varchar(10) DEFAULT NULL,
  `DayM` varchar(10) DEFAULT NULL,
  `Month` varchar(10) DEFAULT NULL,
  `DayW` varchar(10) DEFAULT NULL,
  `Text` varchar(200) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `recorded_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dementia`
--

LOCK TABLES `dementia` WRITE;
/*!40000 ALTER TABLE `dementia` DISABLE KEYS */;
INSERT INTO `dementia` VALUES (28,'0','8','*','*','*','Pepsin wash in ISE module','2020-08-12 13:20:39','3'),(29,'0','8','26','*','*','Print Erba640/1000 maintanance sheet, DI Plant(big+small) sheet','2020-08-12 13:49:45','3'),(32,'0','8','13','8','*','Last CSF(24-08-2020) EQA (31-08-2020)','2020-08-13 10:34:41','8866829055'),(33,'0','8','12','9','*','Last CSF(??-09-2020) EQA (28-09-2020)','2020-08-13 10:34:32','8866829055'),(38,'0','8','1','6','*','??? Calibration certificate of Erba XL-640 and 3 semiauto from jiteshbhai','2020-08-13 12:42:20','3'),(40,'0','8','1','6','*','??? Tejal - External calibration, 7 items','2020-08-13 12:40:12','3'),(41,'0','8','1','5,12','*','??? Inhouse Calibration pipettes, wMachine, Glassware, Centri, incubat, refi','2020-08-13 12:43:39','3'),(43,'0','8','*','*','0','640+1000 Autowash With 0.1N HCL and 0.1N NaOH','2020-08-13 12:36:23','3'),(44,'0','8','1','*','*','Change saturated KCL solution in PH meter','2020-08-13 12:35:34','3'),(45,'0','8','1','1','*','Check Expiry Date of drugs in ART kit, Eye wash kit and First aid kit','2020-08-13 12:35:10','3'),(46,'0','8','1','12','*','Yearly calibration of volumetric flask','2020-08-13 12:32:24','3'),(47,'0','8','*/5','*','*','Refilling of Std-A and std-B','2020-08-13 12:17:05','3'),(48,'0','8','1','6','*','??? Install Fluid pack in ERBA XL 640.','2020-08-13 12:16:15','3'),(50,'0','8','1','5','*','Renewal of CMC of Erba XL 640 and 3 semi-auto','2020-08-13 12:14:48','3'),(51,'0','8','1','8,2','*','calibration of reptac weighg machine ','2020-08-13 12:14:07','3'),(52,'0','8','1','4,10','*','PUT REQUEST FOR PRINTER CONSUMABLE','2020-08-13 12:13:08','3'),(54,'0','8','1','6','*','??elecrodes change due date','2020-08-13 12:10:26','3'),(55,'0','8','1','*','*','Back up of volume parameters,programming parameter, reapeat flags from Erba XL-640 to doks','2020-08-13 12:09:49','3'),(56,'0','8','1','1,5,9','*','quarterly maintenence for 3 semi auto ','2020-08-13 12:09:08','3'),(57,'0','8','1','*','*','count balance /order printer cartridges','2020-08-13 12:04:52','3'),(58,'0','8','1','7,12','*','refilling of fire extinguisher','2020-08-13 12:03:00','3'),(59,'0','8','*','*','1','Perform HE and PRE','2020-08-13 12:01:13','3'),(60,'0','8','10','10','*','Last CSF(??-10-2020) EQA (26-10-2020)','2020-08-13 08:51:00','9099514805'),(61,'0','8','15','11','*','Last CSF(??-11-2020) EQA (30-11-2020)','2020-08-13 08:51:36','9099514805'),(64,'0','8','12','12','*','Last CSF(??-12-2020) EQA (28-12-2020)','2020-08-13 09:30:35','8866829055'),(66,'0','8','*','*','2','Centrifuge Cleaning','2020-08-13 12:45:34','3');
/*!40000 ALTER TABLE `dementia` ENABLE KEYS */;
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
