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
INSERT INTO `profile` VALUES (1,'Patient_Identification','1001,1002,1008,1004,1005,1006,1007','1020,1021,1012,1024,1025','{\"header\":\"no\",\"print_style\":\"horizontal\",\"compact\":\"no\"}'),(2,'Sample Details','1000,1015,1016,1017,1018,1014','1019,1022,1023,5103,9000','{\"header\":\"no\",\"print_style\":\"horizontal\",\"compact\":\"no\"}'),(20,'Bone Marrow Examination Details','147,148','',''),(21,'Hemogram - Blood Counts and Indices','3,2,4,5,6,7,8,1,9','',''),(22,'Differential Leucocyte Count  with Premature Cells (Microscopy)','51,52,53,54,55,400,401,402,403,404','',''),(23,'Differential Leucocyte Count (Microscopy)','39,40,41,42,43,56','',''),(24,'Absolute Counts','48,49,50','',''),(25,'Peripheral Smear (Red Blood Cells)','57,58,59,60,61,62,63,64,65,66','',''),(26,'Peripheral Smear (Platelets)','45,67','',''),(27,'Peripheral Smear (Parasites)','68,69,70','',''),(28,'Rapid Malarial Antigen Test','46,47','',''),(29,'Platelet Indices','510,511,71,72','',''),(30,'Reticulocyte Count (RC)','73,74','',''),(31,'Erythrocyte Sedimentation Rate','75','',''),(32,'Prothrombin Time ','76,77,78,79,80,602','',''),(33,'Activated Partial Thromboplastin Time (aPTT)','81,82,603','',''),(34,'Plasma Fibrinogen','83,84','',''),(35,'Factor Assay','85,86','',''),(36,'Bleeding Time (BT) and Clotting Time (CT)','87,88','',''),(37,'Urine Routine and Microscopy','89,90,91,92,93,94,95,96,97,98,99,100,101,102,103,104,105,106,181,107,108,109,110,111,113','',''),(38,'Stool Examination','114,115,116,117,118,119,120,121,122,123,124,125','',''),(39,'Body Fluid Examination','126,127,128,129,130,131,132,133,134,135,136,137','',''),(40,'Semen Examination','138,139,140,141,142,143,144,145,146','',''),(41,'Bone Marrow Examination Report','150,151,152,153,154,155,156,157,158,159,160,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180','',''),(101,'Histopathology','2010,2001,2002,2003,2004,2011,2005,2009,2006,2007,2008','','{\"header\":\"no\",\"print_style\":\"vertical\"}'),(231,'Dw Graphs','19,20,21','','{\"display_name\":\"no\",\"header\":\"no\",\"print_hide\":\"no\"}'),(300,'Reported by','2012,2013,2014','2015','{\"header\":\"no\",\"print_style\":\"horizontal\"}'),(501,'Diabetes Mellitus Profile','5031','5102','{\"group\":\"BI\"}'),(503,'LFT','5006,5009,5010,5024','5013','{\"group\":\"BI\"}'),(504,'ALB+TP(ALP)','5012,5011','5007','{\"display_name\":\"no\",\"group\":\"BI\"}'),(505,'Pancreatic profile','5008,5026','','{\"group\":\"BI\"}'),(506,'Electrolyte','5019,5020','','{\"group\":\"BI\"}'),(507,'RFT','5001','','{\"group\":\"BI\"}'),(508,'Adavanced RFT','5002,5027','','{\"group\":\"BI\",\"display_name\":\"no\",\"header\":\"no\"}'),(509,'Cal+PO4','5014,5100,5114','5101','{\"display_name\":\"no\",\"group\":\"BI\"}'),(510,'Cardiac profile','5092,5093','','{\"group\":\"BI\"}'),(511,'Misc','5025,5113','','{\"display_name\":\"no\",\"group\":\"BI\"}'),(512,'Urine','5085,5050,5052,5057,5053,5056,5054,5086','','{\"group\":\"BI\"}'),(513,'24 Hr Urine','5058,5059','','{\"group\":\"BI\"}'),(514,'eGFR','5088,5089,5087,5060','','{\"group\":\"BI\"}'),(515,'Lipid profile','5015,5018','5016,5017,5028','{\"group\":\"BI\"}'),(519,'Other Fluid','5105','5106,5107,5108,5109,5110,5111,5112','{\"display_name\":\"no\",\"group\":\"BI\"}'),(520,'Peritoneal profile','5033,5035,5038,5039,5040,5041,5042,5043,5082,5094','','{\"group\":\"BI\"}'),(521,'Pleural profile','5034,5036,5037,5044,5045,5046,5081','','{\"group\":\"BI\"}'),(522,'Anemia profile','5021,5022,5023','','{\"group\":\"BI\"}'),(530,'Protein Electrophoresis','5076,5078,5079,5077,5075','','{\"header\":\"no\",\"print_style\":\"vertical\",\"group\":\"BI\"}'),(531,'Hemoglobin Electrophoresis','5063,5065,5066,5067,5068,5069,5064,5070,5071,5072,5073,5074','','{\"header\":\"no\",\"print_style\":\"vertical\",\"group\":\"BI\"}'),(532,'CSF profile','5029,5030,5080,5032','5047','{\"group\":\"BI\"}'),(533,'Morning QC','9001,9002,9006,9007,9008,9009,9010,9011,9012,9013,9014,9015,9031,9018,9019,9020,9025,9027,9051,9114','','{\"group\":\"BI\"}'),(534,'Serum osmolality','5061','','{\"group\":\"BI\"}'),(535,'QC others','9016,9021,9023,9026,9092,9093,9113,9081','','{\"group\":\"BI\"}'),(1001,'Remark','5095,5096,5097,5098,5099','','{\"header\":\"no\",\"print_style\":\"vertical\",\"group\":\"BI\"}'),(2001,'COVID19','10003,10001,10002','','{\"group\":\"MI\"}');
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

-- Dump completed on 2020-08-14  1:15:49
