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
-- Table structure for table `prototype_data`
--

DROP TABLE IF EXISTS `prototype_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prototype_data` (
  `prototype_id` int(11) NOT NULL,
  `examination_id` int(11) NOT NULL,
  `result` varchar(5000) NOT NULL,
  PRIMARY KEY (`prototype_id`,`examination_id`),
  KEY `examination_id` (`examination_id`),
  CONSTRAINT `prototype_data_ibfk_1` FOREIGN KEY (`examination_id`) REFERENCES `examination` (`examination_id`),
  CONSTRAINT `prototype_data_ibfk_2` FOREIGN KEY (`prototype_id`) REFERENCES `prototype` (`prototype_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prototype_data`
--

LOCK TABLES `prototype_data` WRITE;
/*!40000 ALTER TABLE `prototype_data` DISABLE KEYS */;
INSERT INTO `prototype_data` VALUES (1,2001,'Lump in Right Breast'),(1,2002,'MRM specimen'),(1,2005,'Received specimen of left/right modified radical mastectomy consists of resected breast and attached /separately lying axillary fat tissue. Resected breast measures ________           cm3. Overlying skin measures _______       cm2 . Attached /separately lying axillary tissue measures ________          cm3. Overlying skin, nipple and areola appears to be unremarkable.  A ulceration/suture /scar is identified measuring      cm .it is   cm away from nipple at        quadrant. (If surface is bosselated due to tumour than mention it). On serial cutting of specimen a single/multiple tumour is identified measuring         cm3 is seen at _____________quadrant. Tumour is ______        consistency. Areas of haemorrhage, necrosis is seen /not seen. Tumour is    __cm away from overlying skin and ______cm away from deep resected margin. Tumour lies (mention other margins) ____________________________________________________________ . On dissecting axillary tissue total __    lymph nodes are identified. Largest measures ___cm. Macroscopic tumour involvement is seen/not seen in _____lymph nodes. Soft tissue deposit of tumour is seen/not seen. (If seen than mention measurement).  '),(1,2006,'Sections from tumour show features of ‘invasive mammary carcinoma with no special type ‘.if other type than_________________________. Overall Histologic grade (Nottingham histologic score) is 1/2/3.[Glandular(Acinar /Tubular differentiation score 1/2/3, nuclear  pleomorphism 1,2,3, mitotic rate 1,2,3, Total score ____].Specimen has single/multiple  focus of invasive carcinoma .(if multiple than refer CAP). There is presence/absence of extensive lympho-vascular invasion. Overlying skin, nipple, and areola are uninvolved by invasive carcinoma. (If skin is involved than show CAP for exact wording)  Deep resected margin is uninvolved by invasive carcinoma.  Superior, inferior, medial, lateral resected margin are uninvolved by invasive carcinoma. Rest of breast shows ________________(if DCIS then refer  C AP) . Out of ________lymph nodes dissected from axillary tissue,____ are involved by invasive carcinoma . Extra nodal extension is present /absent.  Pathological staging (pTNM) -   '),(1,2007,'Overall histopathological features are that of Invasive Ductal Carcinoma- Not Otherwise Specified with Ductal Carcinoma In Situ Component- Comedo Type. Modified Bloom Richardson Grade- II (2+2+3). Pathological stage- pT2N0. Base is 1 mm away from tumour. Lymphovascular invasion and perinuclear invasion is not seen. Overlying skin, nipple, areola and all four margins are free from tumour. Total 15 lymphnodes are identified, all are free from tumour. '),(1,2009,'H&E'),(2,2001,'neck lymphadanopathy'),(3,5072,'As Dithionite test is positive, Band at HbS is likely to be of Hemoglobin S.\r\nPatient is (((Sickle cell disease))).\r\nCorrelate with clinical history.\r\n\r\n==========================================================================\r\nCommon Beta-variants that Migrate same as HbS position with Negative dithionite test\r\n--------------------------------------------------------------------------------\r\n	-HbD\r\n	-HbLepore\r\nCommon Beta-variants that Migrate same as HbA2 position with Negative dithionite test\r\n-----------------------------------------------------------------------------------\r\n	-HbO-Arab\r\n	-HbC\r\n	-HbE\r\nCommon Beta-variants that Migrate same as HbA2 position with Positive dithionite test\r\n-------------------------------------------------------------------------------------\r\n	-HbC(Herlem/Georgetown)\r\n\r\n'),(4,5072,'As Dithionite test is positive, Band at HbS is likely to be of Hemoglobin S.\r\nPatient is (((Sickle cell trait))).\r\nCorrelate with clinical history and history of blood Transfusion\r\nIf There is recent history of Blood transfusion, after three month of BT-free period or\r\nrepeat the examinations before next blood transfusion.	\r\n	\r\n\r\nCommon Beta-variants that Migrate same as HbA2 position with Negative dithionite test	\r\n-----------------------------------------------------------------------------------	\r\n	-HbO-Arab\r\n	-HbC\r\n	-HbE\r\nCommon Beta-variants that Migrate same as HbA2 position with Positive dithionite test	\r\n-------------------------------------------------------------------------------------	\r\n	-HbC(Herlem/Georgetown)\r\n'),(5,5078,'No M Band Seen.'),(6,5072,'Majority of Hemoglobin is HbA.Correlate Clinically\r\n==========================================================================\r\nCommon Beta-variants that Migrate same as HbS position with Negative dithionite test\r\n--------------------------------------------------------------------------------\r\n	-HbD\r\n	-HbLepore\r\nCommon Beta-variants that Migrate same as HbA2 position with Negative dithionite test\r\n-----------------------------------------------------------------------------------\r\n	-HbO-Arab\r\n	-HbC\r\n	-HbE\r\nCommon Beta-variants that Migrate same as HbA2 position with Positive dithionite test\r\n-------------------------------------------------------------------------------------\r\n	-HbC(Herlem/Georgetown)\r\n\r\n');
/*!40000 ALTER TABLE `prototype_data` ENABLE KEYS */;
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
