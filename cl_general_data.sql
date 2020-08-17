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
-- Table structure for table `examination`
--

DROP TABLE IF EXISTS `examination`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `examination` (
  `examination_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `sample_requirement` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT 'NULL',
  `edit_specification` varchar(1000) COLLATE utf8_bin NOT NULL,
  `description` varchar(300) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`examination_id`),
  KEY `sample_requirement` (`sample_requirement`),
  CONSTRAINT `examination_ibfk_1` FOREIGN KEY (`sample_requirement`) REFERENCES `sample_id_strategy` (`sample_requirement`)
) ENGINE=InnoDB AUTO_INCREMENT=100014 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `examination`
--

LOCK TABLES `examination` WRITE;
/*!40000 ALTER TABLE `examination` DISABLE KEYS */;
INSERT INTO `examination` VALUES (1,'WBC (Leucocyte Count)','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\" /cmm  4000-10000 (Impedance)\",\"step\":\"1\", \"interval_l\":\"4000\",\"interval_h\":\"10000\",\"cinterval_l\":\"2000\",\"cinterval_h\":\"30000\"}',''),(2,'RBC (Erythrocyte Count)','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"M/cmm, M:4.5-5.5 F:3.8-4.8 (Impedance)\",\"interval_l\":\"3.8\",\"interval_h\":\"5.5\",\"step\":\"0.01\"}','None'),(3,'Hemoglobin','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"gm/dL M: 13-17 F:12-15 (Non-CyanomethHb)\",\"interval_l\":\"12\",\"interval_h\":\"17\",\"cinterval_l\":\"7\",\"cinterval_h\":\"20\",\"step\":\"0.1\"}','None'),(4,'PCV (Packed Cell Volume)','EDTA-Blood-HI','{\"type\":\"number\",\"step\":\"0.1\",\"help\":\"% M:40-50 F:36-46 (Impedance)\",\"interval_l\":\"36\",\"interval_h\":\"50\",\"cinterval_l\":\"20\",\"cinterval_h\":\"60\"}','None'),(5,'MCV (Mean Corp Vol)','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"fL 80-96 (Calculated)\",\"step\":\"0.1\",\"interval_l\":\"80\",\"interval_h\":\"96\"}','None'),(6,'MCH (Mean Corp Hb)','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"pg 27-31 (Calculated)\",\"step\":\"0.1\",\"interval_l\":\"27\",\"interval_h\":\"31\"}','None'),(7,'MCHC (Mean Corp Hb Conc)','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"gm/dL 32-36 (Calculated)\",\"step\":\"0.1\",\"interval_l\":\"32\",\"interval_h\":\"36\"}','None'),(8,'RDW (Red Cell Dist Width)','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"% 11.5-14 (Calculated)\",\"step\":\"0.1\",\"interval_l\":\"11.5\",\"interval_h\":\"14\"}','None'),(9,'Platelet','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"/cmm 150000-400000 (Impedance)\",\"step\":\"1\",\"interval_l\":\"150000\",\"interval_h\":\"400000\",\"cinterval_l\":\"20000\",\"cinterval_h\":\"1000000\"}','None'),(13,'Lymphocyte%','EDTA-Blood-HI','{\"type\":\"text\",\"help\":\"Describe\"}','None'),(14,'Monocyte%','EDTA-Blood-HI','{\"type\":\"text\",\"help\":\"Describe\"}','None'),(15,'Granulocyte%','EDTA-Blood-HI','{\"type\":\"text\",\"help\":\"Describe\"}','None'),(19,'RBC Graph','EDTA-Blood-HI','{\"type\":\"blob\",\"readonly\":\"readonly\",\"img\":\"dw\"}','None'),(20,'WBC Graph','EDTA-Blood-HI','{\"type\":\"blob\",\"readonly\":\"readonly\",\"img\":\"dw\"}','None'),(21,'Platelet Graph','EDTA-Blood-HI','{\"type\":\"blob\",\"readonly\":\"readonly\",\"img\":\"dw\"}','None'),(26,'Sample_Report_Time','None','{\"type\":\"datetime-local\", \"pattern\":\"[0-9]{4}-[0-9]{2}-[0-9]{2}T[0-9]{2}:[0-9]{2}\",\"default\":\"date(\'Y-m-d\')\" }',''),(39,'Neutrophils','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"% 40-80\",\"step\":\"1\",\"interval_l\":\"40\",\"interval_h\":\"80\"}',''),(40,'Lymphocytes','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"% 20-40\",\"step\":\"1\",\"interval_l\":\"20\",\"interval_h\":\"40\"}',''),(41,'Eosinophils','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"% 01-06\",\"step\":\"1\",\"interval_h\":\"6\"}',''),(42,'Monocytes','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"% 02-10\",\"step\":\"1\",\"interval_h\":\"10\"}',''),(43,'Basophils','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"% 00-02\",\"step\":\"1\",\"interval_h\":\"2\"}',''),(44,'NRBCs','EDTA-Blood-HI','',''),(45,'Platelets on smear','EDTA-Blood-HI','{\"type\":\"select\",\"help\":\"\",\"option\":\",Adequate,Reduced,Increased,Mildly Reduced, Markedly Reduced,\"}',''),(46,'Plasmodium Vivax Malarial Antigen','EDTA-Blood-HI','{\"type\":\"select\",\"option\":\",Negative, Positive\"}','For P. Vivax'),(47,'Plasmodium Falciparum Malarial Antigen','EDTA-Blood-HI','{\"type\":\"select\",\"option\":\",Negative, Positive\"}','For P. Vivax'),(48,'ANC (Absolute Neutrophil Count)','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"/cmm 1600-8000 (Calculation)\",\"step\":\"1\",\"interval_l\":\"1600\",\"interval_h\":\"8000\"}',''),(49,'ALC (Absolute Lymphocyte Count)','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"/cmm 800-4000 (Calculation)\",\"step\":\"1\",\"interval_l\":\"800\",\"interval_h\":\"4000\"}',''),(50,'AEC (Absolute Eosinophil Count)','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"/cmm 20-500 (Calculation)\",\"step\":\"1\",\"interval_l\":\"20\",\"interval_h\":\"500\"}',''),(51,'Blasts','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"%\"}',''),(52,'Promyelocytes','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"%\"}',''),(53,'Myelocytes','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"%\"}',''),(54,'Metamyelocytes','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"%\"}',''),(55,'Neutrophils + Band Cells','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"%\"}',''),(56,'Remark','EDTA-Blood-HI','{\"type\":\"text\"}','For Differential Count'),(57,'Morphology','EDTA-Blood-HI','{\"type\":\"select\",\"option\":\",Normocytic,Normochromic,Normocytic Normochromic,Hypochromic Microcytic,Predominantly Normocytic Normochromic\"}',''),(58,'Anisocytosis','EDTA-Blood-HI','{\"type\":\"select\",\"option\":\",+,++,+++,++++,Mild,Occasional,Few\"}',''),(59,'Poikilocytosis','EDTA-Blood-HI','{\"type\":\"select\",\"option\":\",+,++,+++,++++,Mild,Occasional,Few\"}',''),(60,'Microcytosis','EDTA-Blood-HI','{\"type\":\"select\",\"option\":\",+,++,+++,++++,Mild,Occasional,Few\"}',''),(61,'Macrocytosis','EDTA-Blood-HI','{\"type\":\"select\",\"option\":\",+,++,+++,++++,Mild,Occasional,Few\"}',''),(62,'Hypochromia','EDTA-Blood-HI','{\"type\":\"select\",\"option\":\",+,++,+++,++++,Mild,Occasional,Few\"}',''),(63,'Target Cells','EDTA-Blood-HI','{\"type\":\"select\",\"option\":\",+,Occasional,Few\"}',''),(64,'Elliptocytes','EDTA-Blood-HI','{\"type\":\"select\",\"option\":\",+,Occasional,Few\"}',''),(65,'Tear Drop Cells','EDTA-Blood-HI','{\"type\":\"select\",\"option\":\",+,Occasional,Few\"}',''),(66,'Others','EDTA-Blood-HI','{\"type\":\"text\"}','For RBC Morphology'),(67,'Platelet Morphology','EDTA-Blood-HI','	{\"type\":\"select\",\"option\":\",Giant Platelet seen,Platelet aggregates seen\"}',''),(68,'Species','EDTA-Blood-HI','{\"type\":\"select\",\"option\":\",Not Detected, Plasmodium Vivax Ring Forms and Trophozoites,Plasmodium Falciparum Ring Forms, Plasmodium Falciparum Ring Forms with Gametocytes, Plasmodium Falciparum Gametocytes Detected,Plasmodium Vivax Ring and Trophozoites with Schizonts, Plasmodium Vivax Ring and Trophozoites with Gametocytes, Mixed Infection, Others\"}',''),(69,'Grade','EDTA-Blood-HI','{\"type\":\"select\",\"option\":\",+,++,+++,++++\"}',''),(70,'Others','EDTA-Blood-HI','{\"type\":\"text\"}','For other parasites and mixed'),(71,'MPV (Mean Platelet Volume)','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"fL 6.5-10 (Calculated)\",\"step\":\"0.1\",\"interval_l\":\"6.5\",\"interval_h\":\"10\"}','None'),(72,'PDW (Platelet Distribution Width)','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"% 10-18 (Calculated)\",\"step\":\"0.1\",\"interval_l\":\"10\",\"interval_h\":\"18\"}','None'),(73,'Reticulocyte Count ','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"% 0.5-2.5 (Microscopy)\",\"step\":\"0.1\",\"interval_l\":\"0.5\",\"interval_h\":\"2.5\"}','None'),(74,'Corrected Reticulocyte Count ','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"% (Calculated)\",\"step\":\"0.1\"}','None'),(75,'Erythrocyte Sedimentation Rate','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"mm/hr 0-12 (Westergren Method)\",\"interval_l\":\"0\",\"interval_h\":\"12\"}','None'),(76,'Prothrombin Time (PT)','Citrate-Blood-HI','{\"type\":\"number\",\"help\":\"secs 11-16 (Clot Based)\",\"interval_l\":\"11\",\"interval_h\":\"16\",\"cinterval_h\":\"60\"}','None'),(77,'Control (MNPT)','Citrate-Blood-HI','{\"type\":\"number\",\"help\":\"secs\"}','None'),(78,'Ratio','Citrate-Blood-HI','{\"type\":\"number\",\"calculate\":\"max(E/e,1)\",\"ex_list\":\"76,77\",\"step\":\"0.01\",\"decimal\":\"2\",\"help\":\"PT/MNPT (Calculated)\"}','None'),(79,'Index','Citrate-Blood-HI','{\"type\":\"number\",\"calculate\":\"100/e\",\"ex_list\":\"78\",\"step\":\"1\",\"decimal\":\"0\",\"help\":\"% 100/Ratio (Calculated)\"}','None'),(80,'PT (INR) Value','Citrate-Blood-HI','{\"type\":\"number\",\"calculate\":\"e^1.08\",\"ex_list\":\"78\",\"step\":\"0.01\",\"decimal\":\"2\",\"help\":\"Normal Population: 0.8-1.2\\nStandard Therapy: 2.0-3.0\\nHigh Dose Therapy: 3.0-4.5\\n(Calculated, ISI=1.0)\"}','None'),(81,'aPTT - Test','Citrate-Blood-HI','{\"type\":\"number\",\"help\":\"secs 27-34 (Clot Based)\",\"interval_l\":\"27\",\"interval_h\":\"34\",\"cinterval_h\":\"100\"}','None'),(82,'aPTT - Control ','Citrate-Blood-HI','{\"type\":\"number\",\"help\":\"secs\"}','None'),(83,'Fibrinogen','Citrate-Blood-HI','{\"type\":\"number\",\"help\":\"mg% 150-400 (Clot Based)\",\"interval_l\":\"150\",\"interval_h\":\"400\"}','None'),(84,'Fibrinogen Degradation Product (FDP)','Citrate-Blood-HI','{\"type\":\"select\",\"help\":\"(Agglutination)\",\"option\":\",Negative, Positive\"}','None'),(85,'Factor VIII Assay','Citrate-Blood-HI','{\"type\":\"number\",\"help\":\"% 50-150 (Clot Based)\",\"interval_l\":\"50\",\"interval_h\":\"150\"}','None'),(86,'Factor IX Assay','Citrate-Blood-HI','{\"type\":\"number\",\"help\":\"% 50-150 (Clot Based)\",\"interval_l\":\"50\",\"interval_h\":\"150\"}','None'),(87,'Bleeding Time (BT)','Citrate-Blood-HI','{\"type\":\"number\",\"help\":\"mins 02-05 (Duke Method)\",\"interval_l\":\"2\",\"interval_h\":\"5\"}','None'),(88,'Clotting Time (BT)','Citrate-Blood-HI','{\"type\":\"number\",\"help\":\"mins 08-15 (Capillary Tube Method)\",\"interval_l\":\"8\",\"interval_h\":\"15\"}','None'),(89,'Physical Examination','Plain-Urine-CP','{\"type\":\"subsection\",\"readonly\":\"readonly\"}','For Urine Physical Examination'),(90,'Quantity','Plain-Urine-CP','{\"type\":\"number\",\"help\":\"ml\"}','None'),(91,'Colour','Plain-Urine-CP','{\"type\":\"select\",\"help\":\"Pale Yellow\",\"option\":\",Pale Yellow, Yellow, Reddish, Dark Yellow,Slightly Reddish,Amber,Colourless,Pink\"}','None'),(92,'Appearance','Plain-Urine-CP','{\"type\":\"select\",\"help\":\"Clear\",\"option\":\",Clear, Slightly Turbid, Turbid, Cloudy\"}','None'),(93,'Odour','Plain-Urine-CP','{\"type\":\"select\",\"help\":\"Non-Specific\",\"option\":\",Non-Specific, Fruity, Mousy/Musty, Fishy, Ammoniacal, Foul, Rancid, Maple Syrup/Burnt Sugar\"}','For Urine Odour'),(94,'Chemical Examination','Plain-Urine-CP','{\"type\":\"subsection\",\"readonly\":\"readonly\"}','For Urine Chemical Examination'),(95,'pH','Plain-Urine-CP','{\"type\":\"text\",\"help\":\"4.5 - 8\"}',''),(96,'Specific Gravity','Plain-Urine-CP','{\"type\":\"text\",\"help\":\"1.003 - 1.030\"}',''),(97,'Protein (Albumin)','Plain-Urine-CP','{\"type\":\"select\",\"help\":\"Absent\",\"option\":\",Absent,Trace,+,++,+++,++++\"}','None'),(98,'Glucose','Plain-Urine-CP','{\"type\":\"select\",\"help\":\"Absent\",\"option\":\",Absent,Trace,+,++,+++,++++\"}','None'),(99,'Ketones','Plain-Urine-CP','{\"type\":\"select\",\"help\":\"Absent\",\"option\":\",Absent,Trace,+,++,+++,++++\"}','None'),(100,'Bile Salts','Plain-Urine-CP','{\"type\":\"select\",\"help\":\"Absent\",\"option\":\",Absent, Present\"}','None'),(101,'Bile Pigments','Plain-Urine-CP','{\"type\":\"select\",\"help\":\"Absent\",\"option\":\",Absent, Present\"}','None'),(102,'Blood','Plain-Urine-CP','{\"type\":\"select\",\"help\":\"Absent\",\"option\":\",Absent,Trace,+,++,+++,++++\"}','None'),(103,'Microscopic Examination','Plain-Urine-CP','{\"type\":\"subsection\",\"readonly\":\"readonly\"}','For Urine Microscopic Examination'),(104,'Pus Cells','Plain-Urine-CP','{\"type\":\"text\",\"help\":\"Absent\",\"option\":\",Nil,1-2,2-4\"}',''),(105,'RBC (Red Blood Cells)','Plain-Urine-CP','{\"type\":\"text\",\"help\":\"Absent\",\"option\":\",Nil,1-2,2-4\"}',''),(106,'Epithelial Cells Number','Plain-Urine-CP','{\"type\":\"text\",\"help\":\"/hpf 0 - 5\"}',''),(107,'Crystals','Plain-Urine-CP','	{\"type\":\"select\",\"help\":\"Absent\",\"option\":\",Nil\"}','None'),(108,'Casts','Plain-Urine-CP','{\"type\":\"select\",\"help\":\"Absent\",\"option\":\",Nil\"}','None'),(109,'Others','Plain-Urine-CP','{\"type\":\"text\"}','For Urine Microscopic Examination'),(110,'Special Tests','Plain-Urine-CP','{\"type\":\"subsection\",\"readonly\":\"readonly\"}','For Urine Special Tests'),(111,'Test  Name','Plain-Urine-CP','{\"type\":\"select\",\"help\":\"Absent\",\"option\":\"NA, Bence Jones Proteins, Porphobilinogen, Chyluria, Cylindroids\"}','None'),(113,'Result','Plain-Urine-CP','{\"type\":\"text\"}','For Urine Special Test Result'),(114,'Physical Examination','Plain-Stool-CP','{\"type\":\"subsection\",\"readonly\":\"readonly\"}','For Stool Physical Examination'),(115,'Colour','Plain-Stool-CP','{\"type\":\"select\",\"option\":\",Brown, Yellow, Green,  Black, Greenish Yellow, Dark Yellow, Dark Brown, Whitish, Rice-water \"}','None'),(116,'Consistency','Plain-Stool-CP','{\"type\":\"select\",\"option\":\", Solid, Semi-solid, Loose, Watery\"}','None'),(117,'Chemical Examination','Plain-Stool-CP','{\"type\":\"subsection\",\"readonly\":\"readonly\"}','For Stool Chemical Examination'),(118,'Occult Blood','Plain-Stool-CP','{\"type\":\"select\",\"help\":\"Absent (Benzidine Test)\",\"option\":\",Absent, Present\"}','None'),(119,'Microscopic Examination','Plain-Stool-CP','{\"type\":\"subsection\",\"readonly\":\"readonly\"}','For Stool Microscopic Examination'),(120,'Trophozoites','Plain-Stool-CP','{\"type\":\"select\",\"help\":\"Absent\",\"option\":\",Absent, Present\"}','None'),(121,'Ova','Plain-Stool-CP','{\"type\":\"select\",\"help\":\"Absent\",\"option\":\",Absent, Present\"}','None'),(122,'Cysts','Plain-Stool-CP','{\"type\":\"select\",\"help\":\"Absent\",\"option\":\",Nil\"}','None'),(123,'Pus Cells','Plain-Stool-CP','{\"type\":\"select\",\"help\":\"Absent\",\"option\":\",Absent, 1-2, 3-5, 6-8, 10-12, 15-20, Plenty\"}','None'),(124,'RBC (Red Blood Cells)','Plain-Stool-CP','{\"type\":\"select\",\"help\":\"Absent\",\"option\":\",Absent, 1-2, 3-5, 6-8, 10-12, 15-20, Plenty\"}','None'),(125,'Others','Plain-Stool-CP','{\"type\":\"text\"}','For Stool Microscopic Examination'),(126,'Specimen','EDTA-BodyFluid-CP','{\"type\":\"select\",\"option\":\",Cerebrospinal Fluid (CSF), Ascitic Fluid, Pleural Fluid, Peritoneal Fluid, Synovial Fluid, Pus, Pericardial Fluid, Cystic Fluid, Drain Fluid, Colposcopy Fluid, Abscess Material\"}','None'),(127,'Physical Examination','EDTA-BodyFluid-CP','{\"type\":\"subsection\",\"readonly\":\"readonly\"}','For Body Fluidl Examination'),(128,'Quantity','EDTA-BodyFluid-CP','{\"type\":\"select\",\"help\":\"ml\",\"option\":\",0.5, 1, 1.5, 2, 2.5, 3, 3.5\"}','None'),(129,'Colour','EDTA-BodyFluid-CP','{\"type\":\"select\",\"option\":\",Colourless, Pale Yellow, Yellow, Reddish, Dark Yellow,Slightly Reddish, Amber, Brownish, Greenish, Greyish, Milky-white, Black\"}','None'),(130,'Appearance','EDTA-BodyFluid-CP','{\"type\":\"select\",\"help\":\"Clear\",\"option\":\",Clear, Slightly Turbid, Turbid, Cloudy\"}','None'),(131,'Clot Formation','EDTA-BodyFluid-CP','{\"type\":\"select\",\"help\":\"Absent\",\"option\":\",Absent, Present\"}','None'),(132,'Microscopic Examination','EDTA-BodyFluid-CP','{\"type\":\"subsection\",\"readonly\":\"readonly\"}','For Microscopic Body Fluid Examination'),(133,'Total RBC (Red Blood Cells) Count','EDTA-BodyFluid-CP','{\"type\":\"text\",\"help\":\"cells/cmm\"}','None'),(134,'Total WBC (White Blood Cell) Count','EDTA-BodyFluid-CP','{\"type\":\"text\",\"help\":\"cells/cmm\"}','None'),(135,'Polymorphs','EDTA-BodyFluid-CP','{\"type\":\"text\",\"help\":\"%\"}','None'),(136,'Lymphocytes','EDTA-BodyFluid-CP','{\"type\":\"text\",\"help\":\"%\"}','None'),(137,'Remarks','EDTA-BodyFluid-CP','{\"type\":\"text\"}','For Body Fluid Microscopy'),(138,'Physical Examination','Plain-Semen-CP','{\"type\":\"subsection\",\"readonly\":\"readonly\"}','For Semen Physical Examination'),(139,'Quantity','Plain-Semen-CP','{\"type\":\"select\",\"help\":\"ml 2 - 5\",\"option\":\",0.5, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10\"}','None'),(140,'Colour','Plain-Semen-CP','{\"type\":\"select\",\"help\":\"Greyish White\",\"option\":\",Greyish White, Whitish, Pale Yellow, Reddish, Slightly Reddish\"}','None'),(141,'Microscopic Examination','Plain-Semen-CP','{\"type\":\"subsection\",\"readonly\":\"readonly\"}','For Semen Examination'),(142,'Total Sperm Count','Plain-Semen-CP','{\"type\":\"text\",\"help\":\"mil/mL 30 - 300\"}','None'),(143,'Sperm motility','Plain-Semen-CP','{\"type\":\"subsection\",\"readonly\":\"readonly\"}','For Sperm Motility '),(144,'Actively Motile','Plain-Semen-CP','{\"type\":\"text\",\"help\":\"% 60 - 70\"}','None'),(145,'Sluggishly Motile','Plain-Semen-CP','{\"type\":\"text\",\"help\":\"%\"}','None'),(146,'Non - Motile','Plain-Semen-CP','{\"type\":\"text\",\"help\":\"%\"}','None'),(147,'Bone Marrow Aspiration/Biopsy Number:','EDTA-Blood-HI','{\"type\":\"text\"}','For Bone marrow aspiration and biopsy'),(148,'Nature of Specimen:','EDTA-Blood-HI','{\"type\":\"text\"}','For Bone marrow aspiration and biopsy'),(149,'Brief Clinical History:','EDTA-Blood-HI','{\"type\":\"text\"}','For Bone marrow aspiration and biopsy'),(150,'Bone Marrow Aspiration Report','EDTA-Blood-HI','{\"type\":\"subsection\",\"readonly\":\"readonly\"}',''),(151,'Site:','EDTA-Blood-HI','{\"type\":\"select\",\"option\":\",Left Posterior Superior Iliac Spine, Right Posterior Superior Iliac Spine, Left Anterior Superior Iliac Spine, Right Anterior Superior Iliac Spine, Left Tibial Tuberosity, Right Tibial Tuberosity\"}',''),(152,'Particles:','EDTA-Blood-HI','{\"type\":\"select\",\"option\":\",Grossly appreciated, Grossly not appreciated, Heavily diluted with blood\"}',''),(153,'Cellularity:','EDTA-Blood-HI','{\"type\":\"select\",\"option\":\",Normocellular for age of patient, Hypocellular for age of patient, Hypercellular for age of patient\"}',''),(154,'M:E ratio','EDTA-Blood-HI','{\"type\":\"text\"}',''),(155,'Erythropoiesis','EDTA-Blood-HI','{\"type\":\"text\"}',''),(156,'Myelopoiesis','EDTA-Blood-HI','{\"type\":\"text\"}',''),(157,'Megakaryopoiesis','EDTA-Blood-HI','{\"type\":\"text\"}',''),(158,'Iron store:','EDTA-Blood-HI','{\"type\":\"text\"}',''),(159,'Differential count','EDTA-Blood-HI','{\"type\":\"subsection\",\"readonly\":\"readonly\"}','For Bone marrow aspiration'),(160,'Blasts:','EDTA-Blood-HI','{\"type\":\"text\"}','For Bone marrow aspiration'),(161,'Promyelocytes:','EDTA-Blood-HI','{\"type\":\"text\"}','For Bone marrow aspiration'),(162,'Myelocytes:','EDTA-Blood-HI','{\"type\":\"text\"}','For Bone marrow aspiration'),(163,'Metamyelocytes:','EDTA-Blood-HI','{\"type\":\"text\"}','For Bone marrow aspiration'),(164,'Neutrophils/Band cells','EDTA-Blood-HI','{\"type\":\"text\"}','For Bone marrow aspiration'),(165,'Lymphocytes:','EDTA-Blood-HI','{\"type\":\"text\"}','For Bone marrow aspiration'),(166,'Eosinophils and precursors','EDTA-Blood-HI','{\"type\":\"text\"}','For Bone marrow aspiration'),(167,'Monocytes:','EDTA-Blood-HI','{\"type\":\"text\"}','For Bone marrow aspiration'),(168,'Basophils:','EDTA-Blood-HI','{\"type\":\"text\"}','For Bone marrow aspiration'),(169,'Plasma cells:','EDTA-Blood-HI','{\"type\":\"text\"}','For Bone marrow aspiration'),(170,'others:','EDTA-Blood-HI','{\"type\":\"text\"}','For Bone marrow aspiration'),(171,'Findings:','EDTA-Blood-HI','{\"type\":\"text\"}','For Bone marrow aspiration'),(172,'Conclusion:','EDTA-Blood-HI','{\"type\":\"text\"}','For Bone marrow aspiration'),(173,'Bone Marrow Biopsy Report','EDTA-Blood-HI','{\"type\":\"subsection\",\"readonly\":\"readonly\"}',''),(174,'Site:','EDTA-Blood-HI','{\"type\":\"select\",\"option\":\",Left Posterior Superior Iliac Spine, Right Posterior Superior Iliac Spine, Left Anterior Superior Iliac Spine, Right Anterior Superior Iliac Spine, Left Tibial Tuberosity, Right Tibial Tuberosity\"}','for BMB'),(175,'Cellularity:','EDTA-Blood-HI','{\"type\":\"select\",\"option\":\",Normocellular for age of patient, Hypocellular for age of patient, Hypercellular for age of patient\"}','for BMB'),(176,'Erythropoesis:','EDTA-Blood-HI','{\"type\":\"text\"}','For Bone marrow biopsy'),(177,'Myelopoesis:','EDTA-Blood-HI','{\"type\":\"text\"}','For Bone marrow biopsy'),(178,'Megakaryopoesis:','EDTA-Blood-HI','{\"type\":\"text\"}','For Bone marrow biopsy'),(179,'Findings:','EDTA-Blood-HI','{\"type\":\"text\"}','For Bone marrow biopsy'),(180,'Conclusion:','EDTA-Blood-HI','{\"type\":\"text\"}','For Bone marrow biopsy'),(181,'Epithelial Cells Type','Plain-Urine-CP','{\"type\":\"select\",\"option\":\",Squamous Epithelial Cells, Transitional Epithelial Cells\"}',''),(400,'Lymphocyte','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"%\"}',''),(401,'Eosinophil','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"%\"}',''),(402,'Monocyte','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"%\"}',''),(403,'Basophil','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"%\"}',''),(404,'Others','EDTA-Blood-HI','{\"type\":\"text\"}','For premature dc'),(501,'Parasite','EDTA-Blood-HI','{\"type\":\"json\",\"json\":{\"Parasite Name\":{\"select\":\",PF,PV,F\"},\"Number\":{\"select\":\",+,++,+++\"},\"Stages\":\"Text\"}}',''),(502,'Basic','EDTA-Blood-HI','{\"type\":\"subsection\",\"readonly\":\"readonly\"}','For Basic PS'),(503,'Advanced','EDTA-Blood-HI','{\"type\":\"subsection\",\"readonly\":\"readonly\"}','For Advanced PS'),(510,'Manual Platelet Count','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"/cmm 150000-400000 (Impedance)\",\"step\":\"1\",\"interval_l\":\"150000\",\"interval_h\":\"400000\",\"cinterval_l\":\"20000\",\"cinterval_h\":\"1000000\"}','None'),(511,'Platelets on Peripheral Smear','EDTA-Blood-HI','{\"type\":\"select\",\"help\":\"\",\"option\":\",Adequate,Reduced,Increased,Mildly Reduced, Markedly Reduced,\"}',''),(555,'Hemoglobin','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"gm/dL M: 13-17 F:12-15 (Non-CyanomethHb)\",\"interval_l\":\"12\",\"interval_h\":\"17\",\"cinterval_l\":\"7\",\"cinterval_h\":\"20\",\"step\":\"0.1\"}','None'),(600,'Hemogram and Blood Indices','EDTA-Blood-HI','{\"type\":\"subsection\",\"readonly\":\"readonly\"}','For CBC'),(601,'Differential Count (Microscopy)','EDTA-Blood-HI','{\"type\":\"subsection\",\"readonly\":\"readonly\"}','For CBC'),(602,'Remark','Citrate-Blood-HI','{\"type\":\"text\"}','For PT'),(603,'Remark','Citrate-Blood-HI','{\"type\":\"text\"}','For aPTT'),(1000,'Sample_requirement','None','{\"type\":\"text\",\"help\":\"Describe\",\"readonly\":\"readonly\"}','None'),(1001,'MRD','None','{\"type\":\"realtext\",\"readonly\":\"readonly\",\"help\":\"QC/5/Randox/1369UE\\nQC/8/Randox/1066UE\\nQC/5/UA-6\\nQC/5/UN-6\\nQC/5/UB-6\"}','None'),(1002,'Name','None','{\"type\":\"text\"}','None'),(1003,'Request_id','None','{\"type\":\"text\",\"help\":\"Describe\"}','None'),(1004,'Department','None','{\"type\":\"select\",\"option\":\",ART,Dentistry,EmergencyMedicine,ENT,Medicine,OG,Opthalmology,Orthopaedics,Paediatrics,PlasticSurgery,Psychiatry,Skin,Surgery,TBChest,Unspecified\"}','None'),(1005,'Unit','None','{\"type\":\"select\",\"option\":\",-,1,2,3,4,5,6,7,8,A,B\"}','None'),(1006,'OPD/Ward','None','{\"type\":\"select\",\"option\":\",C2(684),C3(685),Casualty(446),E0(506),E1(507),E2(508),E3(509),E4(510),EMW(485),EOT(591),F0(511),F1(512),F2(513),F3(514),F3N(503),F4(515),FOW,G0(516),G0MICU(500),G1(517),G2(518),G3(519),G4(520),GOT(551),H0(497),H1(522),H2(523),H3(524),H4(525),HemodialysisUNIT(741),Isolation Ward,J0(521),J1(531),J2(527),J3(529),J4(530),LeptoWard(506),MICU(500-2),MOT(567),MOW(310),NEWORTHO(311),NOT(551),NOW(311),O2(539),OB(546),OBICU,OLDORTHO(310),OPD,PrisonerWard(310),RI(548),RII(564),RIII(580),SICU(478),SpecialWard(570-71),SwineFluWard(529),StemHosp,StemOPD,TBICU,TRAUMA1(476),TRAUMA2(485),TraumaCenter(472-87),NICU,Unspecified\"}','None'),(1007,'Age(Y)','None','{\"type\":\"number\",\"help\":\"Full Years\"}',''),(1008,'Sex','None','{\"type\":\"select\",\"option\":\",M,F,O\"}',''),(1009,'Sample_Collection_Time','None','{\"type\":\"datetime-local\", \"pattern\":\"[0-9]{4}-[0-9]{2}-[0-9]{2}T[0-9]{2}:[0-9]{2}\" }',''),(1010,'Sample_Receipt_Time','None','{\"type\":\"datetime-local\", \"pattern\":\"[0-9]{4}-[0-9]{2}-[0-9]{2}T[0-9]{2}:[0-9]{2}\" }',''),(1011,'Request_Entry_time','None','{\"type\":\"datetime-local\",\"pattern\":\"[0-9]{4}-[0-9]{2}-[0-9]{2}T[0-9]{2}:[0-9]{2}\"}',''),(1012,'DOB','None','{\"type\":\"date\"}',''),(1013,'Laboratory Name','None','{\"type\":\"select\",\"option\":\",Haematology and Clinical Pathology OPD-10 New Civil Hospital Surat Ph: 216-2244456 Ext: 424 425 426,Biochemistry Near Blood Bank New Civil Hospital Surat Ph: 0216-2244456 Ext: 317\"}',''),(1014,'released_by','None','{\"type\":\"text\",\"readonly\":\"readonly\"}',''),(1015,'Collection_Date','None','{\"type\":\"date\"}',''),(1016,'Collection_Time','None','{\"type\":\"time\"}',''),(1017,'Received_on','None','{\"type\":\"date\"}',''),(1018,'Receipt_time','None','{\"type\":\"time\"}',''),(1019,'(Interim) Released by ','None','{\"type\":\"text\"}',''),(1020,'Age(M)','None','{\"type\":\"number\",\"help\":\"Full Months\"}',''),(1021,'Age(D)','None','{\"type\":\"number\",\"help\":\"Days\"}',''),(1022,'Sample Remark','None','',''),(1023,'Sample Collection Condition','None','{\"type\":\"select\",\"option\":\"Random,Fasting,Postprendial-2HR,PostGlucose-75GM-1HR,PostGlucose-75GM-2HR,PostGlucose-75GM-3HR,PostGlucose-50GM-1HR\"}',''),(1024,'email','None','{\"type\":\"realtext\"}','suratcv19@gmail.com'),(1025,'Dr Mobile','None','',''),(2001,'Clinical History','Formalin-Tissue-HP','{\"zoom\":\"zoom\"}',''),(2002,'Nature of specimen','Formalin-Tissue-HP','{\"zoom\":\"zoom\"}',''),(2003,'Macroscopic examination done by','Formalin-Tissue-HP','',''),(2004,'Total Number of Blocks','Formalin-Tissue-HP','',''),(2005,'Macroscopic Examination','Formalin-Tissue-HP','{\"zoom\":\"zoom\"}',''),(2006,'Microscopic Examination','Formalin-Tissue-HP','{\"zoom\":\"zoom\"}',''),(2007,'Conclusion','Formalin-Tissue-HP','{\"zoom\":\"zoom\"}','For Formalin HP specimen'),(2008,'Notes','Formalin-Tissue-HP','{\"zoom\":\"zoom\"}','For Formalin HP specimen'),(2009,'Stains','Formalin-Tissue-HP','',''),(2010,'General','Formalin-Tissue-HP','{\"type\":\"subsection\",\"readonly\":\"readonly\"}','For Histopathology'),(2011,'.                                              .','Formalin-Tissue-HP','{\"type\":\"subsection\",\"readonly\":\"readonly\"}','For Histopathology'),(2012,'Dr.','None','{\"type\":\"select\",\"option\":\",Komal Patel (M.D Pathology),V M Bhagat (M.D Pathology),Sejal Gamit (M.D Pathology)\"}',''),(2013,'Dr.','None','{\"type\":\"select\",\"option\":\",Komal Patel (M.D Pathology),V M Bhagat (M.D Pathology),Sejal Gamit (M.D Pathology)\"}',''),(2014,'Dr.','None','{\"type\":\"select\",\"option\":\",Komal Patel (M.D Pathology),V M Bhagat (M.D Pathology),Sejal Gamit (M.D Pathology)\"}',''),(2015,'Dr.','None','{\"type\":\"select\",\"option\":\",Komal Patel (M.D Pathology),V M Bhagat (M.D Pathology),Sejal Gamit (M.D Pathology)\"}',''),(5001,'Creatinine','Plain-Blood-BI','{\"type\":\"number\",\"help\":\"mg/dL (Jaffe two point)\\n Male: 0.9-1.3\\n Female: 0.6-1.1\",\"step\":\"0.1\",\"interval_h\":\"1.3\",\"cinterval_h\":\"4.0\",\"ainterval_h\":\"40.0\",\"ainterval_l\":\"0.1\"}',''),(5002,'Urea','Plain-Blood-BI','{\"type\":\"number\",\"help\":\"mg/dL 13-43 (Urease  GLDH)\",\"interval_h\":\"43\",\"interval_l\":\"13\",\"cinterval_h\":\"100\",\"ainterval_h\":\"400\"}',''),(5006,'Alanine Transaminase','Plain-Blood-BI','{\"type\":\"text\",\"help\":\"U/L <45 (L-Alanine LDH UV Kinetic)\",\"interval_h\":\"45\",\"cinterval_h\":\"450\",\"ainterval_h\":\"4500\"}',''),(5007,'Alkaline Phosphatase','Plain-Blood-BI','{\"type\":\"number\",\"help\":\"U/L 42-128 (pNPP with AMP buffer)\",\"interval_h\":\"128\",\"cinterval_h\":\"1000\",\"ainterval_h\":\"3000\"}',''),(5008,'Amylase','Plain-Blood-BI','{\"type\":\"number\",\"help\":\"U/L 28-100 (CNPG)\",\"interval_h\":\"100\",\"cinterval_h\":\"400\",\"ainterval_h\":\"5000\"}',''),(5009,'Total Billirubin','Plain-Blood-BI','{\"type\":\"text\",\"help\":\"mg/dL <1.3 (Diazo Reaction)\",\"step\":\"0.1\",\"cinterval_h\":\"15\",\"interval_h\":\"1.3\",\"ainterval_h\":\"50\"}',''),(5010,'Direct Billirubin','Plain-Blood-BI','{\"type\":\"text\",\"help\":\"mg/dL <0.4 (Diazo Reaction)\",\"step\":\"0.1\",\"interval_h\":\"0.4\",\"ainterval_h\":\"50\"}',''),(5011,'Albumin','Plain-Blood-BI','{\"type\":\"number\",\"help\":\" g/dL <3.5-5.2 (BCG)\",\"step\":\"0.1\",\"cinterval_l\":\"1\",\"interval_h\":\"5.2\",\"interval_l\":\"3.5\",\"ainterval_h\":\"10\",\"ainterval_l\":\"0.5\"}',''),(5012,'Total Protein','Plain-Blood-BI','{\"type\":\"number\",\"help\":\" g/dL <6.4-8.3 (Biuret)\",\"step\":\"0.1\",\"cinterval_l\":\"3\",\"interval_h\":\"8.3\",\"interval_l\":\"6.4\",\"ainterval_h\":\"15\",\"ainterval_l\":\"1\"}',''),(5013,'Aspartate transaminase','Plain-Blood-BI','{\"type\":\"number\",\"help\":\"U/L <35 ( UV Kinetic)\",\"interval_h\":\"35\",\"cinterval_h\":\"450\",\"ainterval_h\":\"4500\"}',''),(5014,'Calcium','Plain-Blood-BI','{\"type\":\"number\",\"help\":\"mg/dL 8.6-10.2 (Arsenazo III)\",\"step\":\"0.1\",\"cinterval_l\":\"6.5\",\"cinterval_h\":\"13\",\"interval_l\":\"8.6\",\"interval_h\":\"10.2\",\"ainterval_h\":\"15\",\"ainterval_l\":\"3\"}',''),(5015,'Total Cholesterol','Plain-Blood-BI','{\"type\":\"number\",\"help\":\" mg/dL <200 (CHOD-POD)\",\"interval_h\":\"200\",\"ainterval_h\":\"1000\",\"ainterval_l\":\"30\"}',''),(5016,'HDL Cholesterol','Plain-Blood-BI','{\"type\":\"number\",\"help\":\" mg/dL >40 (Dextransulphate-Mg2+precipitat)\",\"interval_l\":\"40\"}',''),(5017,'LDL Cholesterol','Plain-Blood-BI','{\"type\":\"number\",\"help\":\" mg/dL <130 (Calculated)\",\"interval_h\":\"130\",\"calculate\":\"E-E-E\",\"ex_list\":\"5015,5016,5028\"}',''),(5018,'Triglyceride','Plain-Blood-BI','{\"type\":\"number\",\"help\":\"mg/dL <150 (LipaseGPOPOD)\",\"interval_h\":\"150\",\"cinterval_h\":\"1000\",\"ainterval_h\":\"1500\"}',''),(5019,'Sodium','Plain-Blood-BI','{\"type\":\"number\",\"help\":\" mmol/L 136-145 (Direct ISE)\",\"cinterval_l\":\"129\",\"cinterval_h\":\"160\",\"interval_h\":\"145\",\"interval_l\":\"136\",\"ainterval_h\":\"175\",\"ainterval_l\":\"110\"}',''),(5020,'Potassium','Plain-Blood-BI','{\"type\":\"number\",\"help\":\" mmol/L 3.5-5.1 (Direct ISE)\",\"step\":\"0.1\",\"cinterval_l\":\"3\",\"cinterval_h\":\"7.1\",\"interval_h\":\"5.1\",\"interval_l\":\"3.5\",\"ainterval_h\":\"7.5\",\"ainterval_l\":\"1\"}',''),(5021,'Iron','Plain-Blood-BI','{\"type\":\"number\",\"help\":\"microgm/dL 41-141 (Ferrozine)\",\"interval_h\":\"141\",\"interval_l\":\"41\",\"ainterval_h\":\"750\"}',''),(5022,'TIBC','Plain-Blood-BI','{\"type\":\"number\",\"help\":\"microgm/dL 251-406(calculated)\",\"interval_h\":\"406\",\"interval_l\":\"251\",\"ainterval_h\":\"750\"}',''),(5023,'UIBC','Plain-Blood-BI','{\"type\":\"number\",\"help\":\"microgm/dL 120-470((Ferrozine Alkaline PH)\",\"interval_h\":\"470\",\"interval_l\":\"120\",\"ainterval_h\":\"600\"}',''),(5024,'Indirect Billirubin','Plain-Blood-BI','{\"type\":\"text\",\"calculate\":\"E-E\",\"ex_list\":\"5009,5010\", \"step\":\"0.1\",\"decimal\":\"1\",\"help\":\"(Calculated)(mg/dL)<1.3\",\"cinterval_h\":\"15\",\"interval_h\":\"1.3\",\"ainterval_h\":\"50\"}',''),(5025,'Lactate Dehydrogenase','Plain-Blood-BI','{\"type\":\"number\",\"help\":\"U/L <360 (L to P UV Kinetic)\",\"interval_h\":\"360\"}',''),(5026,'Lipase','Plain-Blood-BI','{\"type\":\"number\",\"help\":\" U/L 0-5 (Turbidimetry )\",\"interval_h\":\"5\"}',''),(5027,'Uric Acid','Plain-Blood-BI','{\"type\":\"number\",\"help\":\"mg/dL 2.6-7.2 (Uricase POD)\",\"step\":\"0.1\",\"interval_h\":\"7.2\",\"cinterval_h\":\"10\",\"ainterval_h\":\"20\"}',''),(5028,'VLDL Cholesterol','Plain-Blood-BI','{\"type\":\"number\",\"help\":\" mg/dL <30 (Calculated)\",\"interval_h\":\"30\",\"calculate\":\"E/5\",\"ex_list\":\"5018\"}',''),(5029,'Glucose','Plain-CSF-BI','{\"type\":\"number\",\"help\":\"mg/dl 40-70 (GOD-POD)\",\"interval_l\":\"40\",\"interval_h\":\"70\",\"cinterval_l\":\"30\",\"ainterval_h\":\"1500\"}',''),(5030,'Total Protein','Plain-CSF-BI','{\"type\":\"number\",\"help\":\"mg/dL 15-40 (Pyrogallol red)\",\"interval_l\":\"15\",\"interval_h\":\"40\",\"method\":\"Pyrogallol Red\"}',''),(5031,'Glucose','Fluoride-Blood-BI','{\"type\":\"number\",\"help\":\"mg/dl (GOD-POD endpoint)\\n **Diabetes Mellitus (ADA 2016)**\\n   ===========================\\nFasting >126 mg/dL \\nPost Glucose (75gm) >=200 mg/dL \\n\\n **Impaired Glucose Tolerance (ADA 2016)**\\n   =====================================\\nFasting 100-125 mg/dL\\nPost Glucose (75gm) 140-199 mg/dL\",\"interval_l\":\"74\",\"interval_h\":\"110\",\"cinterval_l\":\"55\",\"cinterval_h\":\"300\",\"ainterval_h\":\"1500\",\"ainterval_l\":\"5\"}',''),(5032,'Adenosine Deaminase','Plain-CSF-BI','{\"type\":\"number\",\"help\":\"U/mL <15 (Berthelot)\",\"interval_h\":\"15\"}',''),(5033,'Adenosine Deaminase','Plain-Peritoneal Fluid-BI','{\"type\":\"number\",\"help\":\"U/mL N/A (Berthelot)\"}',''),(5034,'Adenosine Deaminase','Plain-Pleural Fluid-BI','{\"type\":\"number\",\"help\":\"U/mL N/A (Berthelot)\"}',''),(5035,'Glucose','Plain-Peritoneal Fluid-BI','{\"type\":\"number\",\"help\":\"mg/dl NA(GOD-POD)\"}',''),(5036,'Glucose','Plain-Pleural Fluid-BI','{\"type\":\"number\",\"help\":\"mg/dl NA(GOD-POD)\"}',''),(5037,'Total Protein','Plain-Pleural Fluid-BI','{\"type\":\"number\",\"help\":\"g/dL NA(Biuret)\",\"step\":\"0.1\",\"method\":\"Biuret\"}',''),(5038,'Total Protein','Plain-Peritoneal Fluid-BI','{\"type\":\"number\",\"help\":\"g/dL NA(Biuret)\",\"step\":\"0.1\",\"method\":\"Biuret\"}',''),(5039,'Lipase','Plain-Peritoneal Fluid-BI','{\"type\":\"number\",\"help\":\"U/L NA (Turbidimetry)\"}',''),(5040,'Amylase','Plain-Peritoneal Fluid-BI','{\"type\":\"number\",\"help\":\"U/L NA(CNPG)\"}',''),(5041,'Lactate Dehydrogenase','Plain-Peritoneal Fluid-BI','{\"type\":\"number\",\"help\":\"U/L NA(L to P UV Kinetic)\"}',''),(5042,'Cholesterol','Plain-Peritoneal Fluid-BI','{\"type\":\"number\",\"help\":\" mg/dL N/A(CHOD-POD)\"}',''),(5043,'Triglyceride','Plain-Peritoneal Fluid-BI','{\"type\":\"number\",\"help\":\" mg/dL N/A(Lipase  GPO - POD)\"}',''),(5044,'Amylase','Plain-Pleural Fluid-BI','{\"type\":\"number\",\"help\":\"U/L NA(CNPG)\"}',''),(5045,'Lipase','Plain-Pleural Fluid-BI','{\"type\":\"number\",\"help\":\"U/L NA (Turbidimetry)\",\"step\":\"0.1\"}',''),(5046,'Lactate Dehydrogenase','Plain-Pleural Fluid-BI','{\"type\":\"number\",\"help\":\"U/L NA(L to P UV Kinetic)\"}',''),(5047,'Lactate Dehydrogenase','Plain-CSF-BI','{\"type\":\"number\",\"help\":\"U/L NA(L to P UV Kinetic)\"}',''),(5048,'Sodium','Plain-Urine-BI','{\"type\":\"number\",\"help\":\" mmol/L N/A(Direct ISE)\"}',''),(5049,'Potassium','Plain-Urine-BI','{\"type\":\"number\",\"help\":\" mmol/L N/A(Direct ISE)\",\"step\":\"0.1\"}',''),(5050,'Calcium','Plain-Urine-BI','{\"type\":\"number\",\"help\":\" mg/dL N/A (Arsenazo III)\",\"step\":\"0.1\"}',''),(5051,'Phosphorus','Plain-Urine-BI','{\"type\":\"number\",\"help\":\" mg/dL N/A (Ammonium Molybdate)\",\"step\":\"0.1\"}',''),(5052,'Creatinine','Plain-Urine-BI','{\"type\":\"number\",\"help\":\" mg/dL N/A (Jaffe two point)\",\"step\":\"0.1\"}',''),(5053,'Total Protein','Plain-Urine-BI','{\"type\":\"number\",\"help\":\"g/dL N/A (Biuret)\",\"step\":\"0.1\",\"method\":\"Biuret\"}',''),(5054,'Ketone body','Plain-Urine-BI','{\"type\":\"select\",\"option\":\", Positive , Negative\",\"help\":\" (Nitropruside)\"}',''),(5055,'Uric Acid','Plain-Urine-BI','{\"type\":\"number\",\"help\":\"mg/dL N/A (Uricase POD)\",\"step\":\"0.1\",\"step\":\"0.1\"}',''),(5056,'Protein:creatinine Ratio','Plain-Urine-BI','{\"type\":\"number\",\"calculate\":\"E/e\",\"ex_list\":\"5085,5052\", \"step\":\"0.1\",\"decimal\":\"1\",\"help\":\"(Calculated)(mg/mg)\",\"method\":\"Pyrogallol Red\"}',''),(5057,'Calcium:creatinine Ratio','Plain-Urine-BI','{\"type\":\"number\",\"calculate\":\"E/e\",\"ex_list\":\"5050,5052\", \"step\":\"0.1\",\"decimal\":\"1\",\"help\":\"(Calculated)(mg/mg)\"}',''),(5058,'24 hours Urine Volume','Plain-Urine-BI','{\"type\":\"number\",\"help\":\"mL (24 hours urine volume)\"}',''),(5059,'24 hours Urine  Protein','Plain-Urine-BI','{\"type\":\"number\",\"calculate\":\"E*E/100\",\"ex_list\":\"5058,5085,\",\"step\":\"0.1\", \"decimal\":\"1\",\"help\":\"mg(Calculated)\",\"method\":\"Pyrogallol Red\"}',''),(5060,'eGFR','Plain-Blood-BI','{\"type\":\"number\",\"calculate\":\"175*E^-1.154*E^-.203*E*E\",\"ex_list\":\"5001,5088,5087,5089\",\"step\":\"0.1\", \"decimal\":\"1\",\"help\":\"mL/min/1.73 m²(Calculated)(MDRD)\"}',''),(5061,'Serum Osmolality','Plain-Blood-BI','{\"type\":\"number\",\"calculate\":\"2*E+(E*0.17)+(E*0.06)+9\",\"ex_list\":\"5019,5002,5031\",\"step\":\"0.1\", \"decimal\":\"1\",\"help\":\"(Calculated)\"}',''),(5062,'Protein Electrophoresis','Plain-Blood-BI','{\"zoom\":\"zoom\"}',''),(5063,'Electrophoresis Observation','EDTA-Blood-BI','{\"type\":\"subsection\",\"readonly\":\"readonly\"}',NULL),(5064,'Dithonite Test Observation','EDTA-Blood-BI','{\"type\":\"subsection\",\"readonly\":\"readonly\"}',NULL),(5065,'Band at HbA position','EDTA-Blood-BI','{\"type\":\"select\",\"option\":\",Not Seen,Light,Dark\"}',''),(5066,'Band at HbF position','EDTA-Blood-BI','{\"type\":\"select\",\"option\":\",Not Seen,Light,Dark\"}',''),(5067,'Band at HbS position','EDTA-Blood-BI','{\"type\":\"select\",\"option\":\",Not Seen,Light,Dark\"}',''),(5068,'Band at HbA2 position','EDTA-Blood-BI','{\"type\":\"select\",\"option\":\",Not Seen,Light,Dark\"}',''),(5069,'Other Bands','EDTA-Blood-BI','{\"zoom\":\"zoom\"}',''),(5070,'Dithonite test without Urea','EDTA-Blood-BI','{\"type\":\"select\",\"option\":\",Not Done,Turbid,Clear\"}',''),(5071,'Dithonite test with Urea','EDTA-Blood-BI','{\"type\":\"select\",\"option\":\",Not Done,Turbid,Clear\"}',''),(5072,'Clinical Laboratory Interpretation','EDTA-Blood-BI','{\"zoom\":\"zoom\"}','For HB Electrophoresis'),(5073,'Electrophoresis Image','EDTA-Blood-BI','{\"type\":\"blob\",\"img\":\"png\",\"width\":\"300\",\"height\":\"200\"}',''),(5074,'Remarks','EDTA-Blood-BI','',''),(5075,'Remarks','Plain-Blood-BI','',''),(5076,'Electrophoresis Image','Plain-Blood-BI','{\"type\":\"blob\",\"img\":\"png\",\"width\":\"300\",\"height\":\"200\"}',''),(5077,'Clinical Laboratory Interpretation','Plain-Blood-BI','{\"zoom\":\"zoom\"}','For HB Electrophoresis'),(5078,'Electrophoresis Observation','Plain-Blood-BI','{\"type\":\"subsection\",\"readonly\":\"readonly\"}',''),(5079,'Band at M position','Plain-Blood-BI','{\"type\":\"select\",\"option\":\",Not Seen,Light,Dark\"}',''),(5080,'Total Protein','Plain-CSF-BI','{\"type\":\"number\",\"help\":\"g/dL 0.015-0.040 (Biuret)\",\"method\":\"Biuret\"}',''),(5081,'Total Protein','Plain-Pleural Fluid-BI','{\"type\":\"number\",\"help\":\"mg/dL NA(Pyrogallol Red)\",\"method\":\"Pyrogallol Red\"}',''),(5082,'Total Protein','Plain-Peritoneal Fluid-BI','{\"type\":\"number\",\"help\":\"mg/dL NA(Pyrogallol Red)\",\"method\":\"Pyrogallol Red\"}',''),(5083,'Sodium','Plain-CSF-BI','{\"type\":\"number\",\"help\":\" mmol/L N/A(Direct ISE)\"}',''),(5084,'Calcium','HCL-Urine-BI','{\"type\":\"number\",\"help\":\" mg/dL N/A (Arsenazo III)(Preservative:30 mL 6 M HCL)\",\"step\":\"0.1\",\"method\":\"24Hr Urine\"}',''),(5085,'Total Protein','Plain-Urine-BI','{\"type\":\"number\",\"help\":\"mg/dL NA(Pyrogallol Red)\",\"method\":\"Pyrogallol Red\"}',''),(5086,'Protein:creatinine Ratio','Plain-Urine-BI','{\"type\":\"number\",\"calculate\":\"(E*1000)/e\", \"ex_list\":\"5053,5052\", \"step\":\"0.1\",\"decimal\":\"1\",\"help\":\"(Calculated)(mg/mg)\",\"method\":\"Biuret\"}',''),(5087,'Sex for eGFR','Plain-Blood-BI','{\"type\":\"select\",\"option\":\",1,0.742\",\"help\":\" (male:1) (female:0.742)\"}',''),(5088,'Age for GFR','Plain-Blood-BI','{\"type\":\"number\"}',''),(5089,'race for eGFR','Plain-Blood-BI','{\"type\":\"select\",\"option\":\",1,1.210\",\"help\":\" (American:1) (African:1.210)\"}',''),(5092,'CK','Plain-Blood-BI','{\"type\":\"number\",\"help\":\"U/L 25-125 (phosphocreatine HK G6PD)\",\"interval_h\":\"125\"}',''),(5093,'CK-MB','Plain-Blood-BI','{\"type\":\"number\",\"help\":\"U/L 0-24 (Immunoinhibition, HK, G6PD)\",\"interval_h\":\"24\"}',''),(5094,'Creatinine','Plain-Peritoneal Fluid-BI','{\"type\":\"number\",\"help\":\" mg/dL N/A (Jaffe two point)\",\"step\":\"0.1\"}',''),(5095,'Sample_Rejection','None','{\"type\":\"select\",\"option\":\",not done as sample inadequate\"}',''),(5096,'Examination_Rejection','None','{\"type\":\"select\",\"option\":\",not done because instrument is breakdown, some examinations are not done because sample is inadequate,Creatinine is  not done because sample is highly icteric and high bilirubin has negative interference on creatinine level,not done because sample not received, not  done because sample was highly hemolyzed, not done as lab resources are inadequate\"}',''),(5097,'Critical_Alert','None','{\"zoom\":\"zoom\"}',''),(5098,'Remark','None','{\"zoom\":\"zoom\"}',''),(5099,'Withdrawn_Report','None','{\"zoom\":\"zoom\"}',''),(5100,'Phosphorus','Plain-Blood-BI','{\"type\":\"number\",\"help\":\" mg/dL <2.5-4.5 (Ammonium Molybdate)\",\"step\":\"0.1\",\"cinterval_l\":\"1\",\"cinterval_h\":\"8.9\",\"interval_h\":\"4.5\",\"interval_l\":\"2.5\",\"ainterval_h\":\"12.0\",\"ainterval_l\":\"0.5\"}',''),(5101,'Corrected Calcium','Plain-Blood-BI','{\"type\":\"number\",\"calculate\":\"0.8*(4-E)+E\",\"ex_list\":\"5011,5014\", \"step\":\"0.1\",\"decimal\":\"1\",\"help\":\"(Calculated)(mg/dL)8.6 - 10.2\"}',''),(5102,'Ketone body','Plain-Blood-BI','{\"type\":\"select\",\"option\":\",Positive,Negative,Not Done(See Remark)\",\"help\":\" (Nitropruside)\"}',''),(5103,'OPD_Sequence','None','','For Biochemistry OPD Sequence'),(5105,'Lactate Dehydrogenase','Plain-Other-BI','{\"type\":\"number\",\"help\":\"U/L NA(L to P UV Kinetic)\"}',''),(5106,'Amylase','Plain-Other-BI','{\"type\":\"number\",\"help\":\"U/L NA(CNPG)\"}',''),(5107,'Lipase','Plain-Other-BI','{\"type\":\"number\",\"help\":\"U/L NA (Turbidimetry)\"}',''),(5108,'Glucose','Plain-Other-BI','{\"type\":\"number\",\"help\":\"mg/dl NA(GOD-POD)\"}',''),(5109,'Cholesterol','Plain-Other-BI','{\"type\":\"number\",\"help\":\" mg/dL N/A(CHOD-POD)\"}',''),(5110,'Triglyceride','Plain-Other-BI','{\"type\":\"number\",\"help\":\" mg/dL N/A(Lipase  GPO - POD)\"}',''),(5111,'Total Protein','Plain-Other-BI','{\"type\":\"number\",\"help\":\"mg/dL NA(Pyrogallol Red)\",\"method\":\"Pyrogallol Red\"}',''),(5112,'Total Protein','Plain-Other-BI','{\"type\":\"number\",\"help\":\" g/dL N/A (Biuret)\",\"step\":\"0.1\",\"method\":\"Biuret\"}',''),(5113,'Cholineterase','Plain-Blood-BI','{\"type\":\"number\",\"help\":\" U/L <3000-13000 (Butyrylthiocholine)\",\"cinterval_l\":\"3000\"}',''),(5114,'HCL wash','Plain-Blood-BI','{\"hide\":\"yes\"}',''),(9000,'QC Equipment','None','{\"type\":\"select\",\"option\":\",XL_640,XL_1000\"}',NULL),(9001,'Creatinine','QC-QC-BI','',''),(9002,'Urea','QC-QC-BI','',''),(9006,'ALT','QC-QC-BI','',''),(9007,'Alkaline Phosphatase','QC-QC-BI','',''),(9008,'Amylase','QC-QC-BI','',''),(9009,'Total Billirubin','QC-QC-BI','',''),(9010,'Direct Billirubin','QC-QC-BI','',''),(9011,'Albumin','QC-QC-BI','',''),(9012,'Total Protein','QC-QC-BI','',''),(9013,'Aspartate transaminase','QC-QC-BI','',''),(9014,'Calcium','QC-QC-BI','',''),(9015,'Total Cholesterol','QC-QC-BI','',''),(9016,'HDL Cholesterol','QC-QC-BI','',''),(9018,'Triglyceride','QC-QC-BI','',''),(9019,'Sodium','QC-QC-BI','',''),(9020,'Potassium','QC-QC-BI','',''),(9021,'Iron','QC-QC-BI','',''),(9023,'UIBC','QC-QC-BI','',''),(9025,'Lactate Dehydrogenase','QC-QC-BI','',''),(9026,'Lipase','QC-QC-BI','',''),(9027,'Uric Acid','QC-QC-BI','',''),(9031,'Glucose','QC-QC-BI','',''),(9051,'Phosphorus','QC-QC-BI','',''),(9081,'Total Protein','QC-QC-BI','',''),(9092,'CK','QC-QC-BI','',''),(9093,'CK-MB','QC-QC-BI','',''),(9113,'Cholineterase','QC-QC-BI','',''),(9114,'HCL wash','QC-QC-BI','{\"hide\":\"yes\"}',''),(10001,'SARS-CoV2','Plain-BodyFluid-MI','{\"type\":\"select\",\"option\":\"Positive,Negative\"}',''),(10002,'Other Respiratory Viruses','Plain-BodyFluid-MI','',''),(10003,'Laboratory Section','None','{\"type\":\"select\",\"option\":\",VDRL\"}','');
/*!40000 ALTER TABLE `examination` ENABLE KEYS */;
UNLOCK TABLES;

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

--
-- Table structure for table `dashboard`
--

DROP TABLE IF EXISTS `dashboard`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dashboard` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `topic` varchar(100) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `priority` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dashboard`
--

LOCK TABLES `dashboard` WRITE;
/*!40000 ALTER TABLE `dashboard` DISABLE KEYS */;
INSERT INTO `dashboard` VALUES (1,'Calculated Parameters','Prothrombin Time related calculation of indexes is now available. \nWhen in <b>Edit</b> mode, Click <b>Calculate</b> to refresh calculation.\nModification in database is required to add new calculated tests.\nChanging ISI value in database as required is essential',NULL),(2,'Suggestions and Feedback','For suggestion for improvement, contact lab in-charge or whatsApp: 9664555812 Dr Shailesh ',NULL),(3,'Super Profiles','Use Super Profiles to reduce your clicks and prevent lapses in entry',3),(4,'View Statistics','Click <b>HOME</b>. select Click <span class=\"bg-danger\">red colored number</span> to view data. Provide appropriate input (e.g date). Export Data in spreadsheet if required',4),(5,'Bold','use (((xyz))) to bold a word',7),(6,'New Software','New Software have 7 digit sample ID (REMEMBER)',5),(7,'Dokuwiki and Docs Old LIS Started',' Click ---> <a href=\"\\dokuwiki\">Dokuwiki</a> <a href=\"\\docs\">Docs</a>  <a href=\"http://12.207.3.250\">Old LIS</a>',6),(8,'Worklist Print','See number 6 (get examination id from 7)',8);
/*!40000 ALTER TABLE `dashboard` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `super_profile`
--

DROP TABLE IF EXISTS `super_profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `super_profile` (
  `super_profile_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `profile_id_list` varchar(500) NOT NULL,
  `extra` varchar(300) DEFAULT NULL,
  `edit_specification` varchar(500) NOT NULL,
  PRIMARY KEY (`super_profile_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `super_profile`
--

LOCK TABLES `super_profile` WRITE;
/*!40000 ALTER TABLE `super_profile` DISABLE KEYS */;
INSERT INTO `super_profile` VALUES (1,'Blood Counts - Hb, TC, Platelet','21','',''),(2,'CBC (Routine)','21,23','',''),(3,'CBC MP (Routine)','21,23,26,27','',''),(4,'PSCM','21,23,25,26,27','',''),(5,'RC','30','',''),(6,'ESR','31','',''),(7,'PT','32','',''),(8,'Urine Routine','37','',''),(9,'Stool Routine','38','',''),(10,'CBC (Emergency)','21','',''),(11,'CBC MP (Emergency)','21,26,27','',''),(12,'PSCM Leukemia Panel','21,22,25,26,27','',''),(13,'Bone Marrow Examination Report','20,21,23,25,26,27,30,41','',''),(14,'Expert Level PSCM','21,23,25,26,27','',''),(15,'Fine Needle Aspiration Cytology Report','201,202','',''),(16,'RFT+Electrolyte','507,506','','{\"group\":\"BI\"}'),(17,'creatinine + eGFR','507,514','','{\"group\":\"BI\"}'),(18,'LRE','503,507,506','','{\"group\":\"BI\"}'),(19,'LRE+GLC','501,503,502,507,506','','{\"group\":\"BI\"}'),(20,'LL-RR-E','503,507,502,508,504','','{\"group\":\"BI\"}'),(21,'Cal-PO4','511','5014,5101,5100,5011','{\"group\":\"BI\"}');
/*!40000 ALTER TABLE `super_profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `copy_bin_text`
--

DROP TABLE IF EXISTS `copy_bin_text`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `copy_bin_text` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `text` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `copy_bin_text`
--

LOCK TABLES `copy_bin_text` WRITE;
/*!40000 ALTER TABLE `copy_bin_text` DISABLE KEYS */;
INSERT INTO `copy_bin_text` VALUES (1,'Absurd K+ EDTA','Absurd K+ may be due to EDTA contamination of Plain Blood. '),(3,'Absurd K+ Hemolysis','Sample Grossly Hemolysed. Absurd K+ may be due to Excess hemolysis'),(4,'High DBIL','Majority of bilirubin is of conjugated bilirubin(Direct), disregard total bilirubin.'),(5,'QNS','Test is not done as sample is inadequate'),(6,'Missing sample','Test is not done as sample is not received'),(7,'Bilirubin interfence','Very High bilirubin has negative interferance in creatinine estimation  '),(8,'Lipemic sample','Test is not done as sample is lipemic'),(9,'Viscous sample','Test is not done as sample is highly viscous'),(10,'email for COVID-19','suratcv19@gmail.com'),(11,'Not done','Test is not done as lab resources are inadequate');
/*!40000 ALTER TABLE `copy_bin_text` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `view_info_data`
--

DROP TABLE IF EXISTS `view_info_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `view_info_data` (
  `id` int(11) NOT NULL,
  `info` varchar(100) NOT NULL,
  `Fields` varchar(2000) NOT NULL,
  `sql` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `view_info_data`
--

LOCK TABLES `view_info_data` WRITE;
/*!40000 ALTER TABLE `view_info_data` DISABLE KEYS */;
INSERT INTO `view_info_data` VALUES (1,'Total Sample On a Day','<input type=date name=__p1 title=\'Give Date\'>','select count(examination_id) as Total_Sample from result where examination_id=1017 and result=\"__p1\"'),(2,'Test count on a date','<input type=date name=__p1 title=\'Give Date\'>','select  	r1.examination_id A ,e1.name B ,  	r2.examination_id C ,e2.name D, 	r2.result E, 	count(r2.result) F from  	examination e1,examination e2,  	result r1,result r2  where  	r1.sample_id=r2.sample_id and  	r2.examination_id=1017 and  	r2.result=\"__p1\" and 	e1.examination_id=r1.examination_id and  	e2.examination_id=r2.examination_id  group by r1.examination_id order by r1.examination_id'),(3,'Max ID (series 2,3,1)','','select 2 as series, max(sample_id) from result where sample_id between 2000000 and 2999999 union select 3 as series, max(sample_id) from result where sample_id between 3000000 and 3999999 union select 1 as series, max(sample_id) from result where sample_id between 1000000 and 1999999'),(4,'Test count on a date (a bit better)','<input type=date name=__p1 title=\'Give Date\'>','select  	r1.examination_id examination_id ,e1.name Test,  r2.result Date, 	count(r2.result) Test_Count  from  	examination e1,examination e2,  	result r1,result r2  where  	r1.sample_id=r2.sample_id and  	r2.examination_id=1017 and  	r2.result=\"__p1\" and 	e1.examination_id=r1.examination_id and  	e2.examination_id=r2.examination_id  and e1.sample_requirement!=\'None\' group by r1.examination_id order by r1.examination_id'),(5,'Test count on between two dates','From:<input type=date name=__p1 title=\'Give From  Date\'>To:<input type=date name=__p2 title=\'Give To Date\'>','select r1.examination_id examination_id ,e1.name Test,  	count(r2.result) Test_Count   from  	examination e1,examination e2,  	result r1,result r2   where  	r1.sample_id=r2.sample_id and  	r2.examination_id=1017 and  	 r2.result between str_to_date(\'__p1\',\'%Y-%m-%d\') and str_to_date(\'__p2\',\'%Y-%m-%d\') and 	 e1.examination_id=r1.examination_id and  	e2.examination_id=r2.examination_id   and e1.sample_requirement!=\'None\' group by r1.examination_id order by r1.examination_id'),(6,'(Worklist) Sample_ID,Test name and result of a date','Date:<input type=date name=__p1 title=\'Give From  Date\'>Ex_ID:<input type=number name=__p2 title=\'Give Examination_id\'>','select  	 r1.sample_id sample_id, r1.examination_id examination_id ,e1.name Test, r1.result , r2.result Date  from  	 examination e1,examination e2,  	 result r1,result r2    where  	 r1.sample_id=r2.sample_id and  	 r2.examination_id=1017 and  	 r2.result=\"__p1\" and 	 e1.examination_id=r1.examination_id and  	 e2.examination_id=r2.examination_id  and  e1.examination_id=\"__p2\" and e1.sample_requirement!=\'None\'   order by r1.examination_id'),(7,'Test ID and their Name','','select examination_id,name,sample_requirement from examination order by name'),(8,'Profile count between two dates','From:<input type=date name=__p1 title=\'Give From  Date\'>To:<input type=date name=__p2 title=\'Give To Date\'>','select  p.profile_id, p.name,  	count(r2.result) Test_Count   from  	 examination e1,examination e2, result r1,result r2, profile p  where  	 r1.sample_id=r2.sample_id and  	 r2.examination_id=1017 and  	  r2.result between str_to_date(\'__p1\',\'%Y-%m-%d\') and str_to_date(\'__p2\',\'%Y-%m-%d\') and e1.examination_id=r1.examination_id and  	 e2.examination_id=r2.examination_id   and  e1.sample_requirement!=\'None\' and substring_index(p.examination_id_list,\',\',1)=e1.examination_id  group by  r1.examination_id   order by  p.profile_id'),(9,'sample count: age more than 60 years','From:<input type=date name=__p1 title=\'Give From Date\'>To<input type=date name=__p2 title=\'Give To Date\'>','select count(sample_id) from result where examination_id=1007  and (recording_time between \"__p1\" and \"__p2\" )and result>=60'),(10,'Sample Location with  Specific Date','<input type=date name=__p1 title=\'Give Date\'>','select s1.sample_id as sample_id ,s1.result as date ,s2.result as location  from result s1, result s2  where    s1.examination_id=1017 and s1. result like \"__p1\" and  s2.examination_id=1006    and  s1.sample_id=s2.sample_id'),(11,'Sample Location with  Specific Date(color)','<input type=date name=__p1 title=\'Give Date\'>','select s1.sample_id as sample_id ,s1.result as date ,if(s2.result=\"OPD\",concat(\'<span class=bg-danger>\',s2.result,\'</span>\'),s2.result) as location  from result s1, result s2  where    s1.examination_id=1017 and s1. result like \"__p1\" and  s2.examination_id=1006    and  s1.sample_id=s2.sample_id'),(12,'Sample Release Status(between two sample_id)','<input type=number name=__p1><input type=number name=__p2>','select sample_id,if(examination_id=1017,\"Received on\",\"Released_by\"),result from result where examination_id in (1017,1014) and sample_id between \"__p1\" and \"__p2\" order by sample_id'),(13,'Test count of a date with total','<input type=date name=__p1 title=\'Give Date\'>','(select  r1.examination_id examination_id ,e1.name Test,  r2.result Date, 	count(r2.result) Test_Count  from  	examination e1,examination e2,  	result r1,result r2  where  	r1.sample_id=r2.sample_id and  	r2.examination_id=1017 and  	r2.result=\"__p1\" and 	e1.examination_id=r1.examination_id and  	e2.examination_id=r2.examination_id  and e1.sample_requirement!=\'None\' group by r1.examination_id order by r1.examination_id) UNION (select  \'Grand \' ,\'Total \',  \' \', 	count(r2.result) Test_Count  from  	examination e1,examination e2,  	result r1,result r2  where  	r1.sample_id=r2.sample_id and  	r2.examination_id=1017 and  	r2.result=\"__p1\" and 	e1.examination_id=r1.examination_id and  	e2.examination_id=r2.examination_id  and e1.sample_requirement!=\'None\')'),(14,'Test count between two dates with total','From:<input type=date name=__p1 title=\'Give Date\'>To:<input type=date name=__p2 title=\'Give Date\'>','(select  r1.examination_id examination_id ,e1.name Test,  r2.result Date, 	count(r2.result) Test_Count    from  	examination e1,examination e2,  	result r1,result r2  where  	 r1.sample_id=r2.sample_id and  	r2.examination_id=1017 and  	r2.result between \"__p1\" and \"__p2\"	and  e1.examination_id=r1.examination_id and  	e2.examination_id=r2.examination_id  and e1.sample_requirement!=\'None\'  group by r1.examination_id order by r1.examination_id) UNION   (select  \'Grand \' ,\'Total \',  \' \', 	count(r2.result) Test_Count  from  	examination e1,examination e2,  	 result r1,result r2  where  	r1.sample_id=r2.sample_id and  	r2.examination_id=1017 and  	 (r2.result between \"__p1\" and \"__p2\")	and e1.examination_id=r1.examination_id and  	e2.examination_id=r2.examination_id  and e1.sample_requirement!=\'None\')'),(15,'Samples Types count between two dates','From:<input type=date name=__p1 title=\'Give Date\'>To:<input type=date name=__p2 title=\'Give Date\'>','select r1.result,count(r1.sample_id)  from result  r1, result r2   where  r2.examination_id=1017  and (r2.result between \"__p1\" and \"__p2\")  and r1.examination_id=1000 and r1.sample_id=r2.sample_id  group by result '),(16,'Samples Types count between two dates (only OPD)','From:<input type=date name=__p1 title=\'Give Date\'>To:<input type=date name=__p2 title=\'Give Date\'>','select r1.result,count(r1.sample_id)  from result  r1, result r2 ,result r3  where  r2.examination_id=1017  and (r2.result between \"__p1\" and \"__p2\")  and r1.examination_id=1000 and r1.sample_id=r2.sample_id and r1.sample_id=r3.sample_id and r3.examination_id=1006  and (r3.result =\'OPD\')   group by result  '),(17,'Worklist between two dates','From:<input type=date name=__p1 title=\'Give From  Date\'>To:<input type=date name=__p2 title=\'Give From  Date\'>Ex_ID:<input type=number name=__p3 title=\'Give Examination_id\'>','select  	  r1.sample_id sample_id, r1.examination_id examination_id ,e1.name Test, r1.result , r2.result Date    from  	  examination e1,examination e2,  	 result r1,result r2      where  	   r1.sample_id=r2.sample_id and  	 r2.examination_id=1017 and  	  (r2.result between \"__p1\" and \"__p2\") and 	 e1.examination_id=r1.examination_id and  	  e2.examination_id=r2.examination_id  and  e1.examination_id=\"__p3\"  and e1.sample_requirement!=\'None\'     order by r1.examination_id'),(18,'OPD Samples on a date','<input type=date name=__p1 title=\'Give Date\'>','select s1.sample_id as sample_id ,s1.result as date ,if(s2.result=\"OPD\",concat(\'<span class=bg-danger>\',s2.result,\'</span>\'),s2.result) as location   from result s1, result s2   where    s1.examination_id=1017 and s1. result like \"__p1\" and  s2.examination_id=1006    and  s1.sample_id=s2.sample_id and s2.result=\'OPD\''),(19,'non-OPD Samples on a date','<input type=date name=__p1 title=\'Give Date\'>','select s1.sample_id as sample_id ,s1.result as date ,if(s2.result!=\"OPD\",concat(\'<span class=bg-danger>\',s2.result,\'</span>\'),s2.result) as location   from result s1, result s2   where    s1.examination_id=1017 and s1. result like \"__p1\" and  s2.examination_id=1006    and  s1.sample_id=s2.sample_id and s2.result!=\'OPD\''),(20,'QC Statistics on between two dates','From:<input type=date name=__p1 title=\'Give From  Date\'>To:<input type=date name=__p2 title=\'Give To Date\'>','select  	r1.examination_id examination_id , 	e1.name Test,  	 	r3.result MRD, 	count(r2.result) Test_Count  ,  	avg(r1.result) mean,    	STDDEV(r1.result) SD    	 from  	 	examination e1,examination e2, 	result r1,result r2,result r3     where  	 	r1.sample_id=r2.sample_id  		and  	 	r1.sample_id=r3.sample_id  		and 		 	r2.examination_id=1015  		and 	r3.examination_id=1001  		and		 	r2.result between str_to_date(\'__p1\',\'%Y-%m-%d\') and str_to_date(\'__p2\',\'%Y-%m-%d\')  		and 	  		 	e1.examination_id=r1.examination_id  		and  	 	e2.examination_id=r2.examination_id    		and  		 	e1.sample_requirement!=\'None\' 		and 	r1.sample_id between 9000000 and 9999999 		 group by  	r1.examination_id, r3.result  order by  	r1.examination_id'),(101,'Sample Release Status(between two sample_id)','<input type=number name=__p1><input type=number name=__p2>','select sample_id,result from result where examination_id =1014  and sample_id between \"__p1\" and \"__p2\" order by sample_id'),(102,'OPD Release Status of Samples on a date','<input type=date name=__p1 title=\'Give Date\'>','select \r\n	s1.sample_id as sample_id ,\r\n	s1.result as date ,\r\n	if(s2.result=\"OPD\",concat(\'<span class=bg-danger>\',s2.result,\'</span>\'),s2.result) as location,   \r\n	s3.result as release_status\r\nfrom \r\n	result s1, result s2, result s3\r\n	\r\nwhere\r\n    s1.examination_id=1017 \r\n    and \r\n    s1. result like \"__p1\" and  s2.examination_id=1006    \r\n    and  \r\n	s3.examination_id=1014    \r\n    and      \r\n    \r\n    s1.sample_id=s2.sample_id \r\n    and\r\n    s1.sample_id=s3.sample_id \r\n    \r\n    and\r\n    s2.result=\'OPD\''),(103,'OPD Release Status of Samples on a date','<input type=date name=__p1 title=\'Give Date\'>','select \r\n	s1.sample_id as sample_id ,\r\n\r\nconcat(\'<div class=\"d-inline-block\" ><form target=_blank method=post action=edit_general.php class=print_hide>\r\n	<button class=\"btn btn-outline-primary btn-sm\" name=sample_id value=\\\'\',s1.sample_id,\'\\\' >\',s1.sample_id,\'</button>\r\n	<input type=hidden name=session_name value=\\\'\\\'.$_POST[\\\'session_name\\\'].\\\'\\\'>\r\n	<input type=hidden name=action value=edit_general>\r\n	</form></div>\')\r\n\r\nas sample_id,\r\n\r\n	s1.result as date ,\r\n	if(s2.result=\"OPD\",concat(\'<span class=bg-danger>\',s2.result,\'</span>\'),s2.result) as location,   \r\n	s3.result as release_status\r\nfrom \r\n	result s1, result s2, result s3\r\n	\r\nwhere\r\n    s1.examination_id=1017 \r\n    and \r\n    s1. result like \"__p1\" and  s2.examination_id=1006    \r\n    and  \r\n	s3.examination_id=1014    \r\n    and      \r\n    \r\n    s1.sample_id=s2.sample_id \r\n    and\r\n    s1.sample_id=s3.sample_id \r\n    \r\n    and\r\n    s2.result=\'OPD\'');
/*!40000 ALTER TABLE `view_info_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prototype`
--

DROP TABLE IF EXISTS `prototype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prototype` (
  `prototype_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`prototype_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prototype`
--

LOCK TABLES `prototype` WRITE;
/*!40000 ALTER TABLE `prototype` DISABLE KEYS */;
INSERT INTO `prototype` VALUES (1,'Breast CAP'),(2,'Lymphoma'),(3,'Sickle Cell disease'),(4,'Sickle Cell trait'),(5,'Multiple Myeloma'),(6,'Only HbA');
/*!40000 ALTER TABLE `prototype` ENABLE KEYS */;
UNLOCK TABLES;

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
INSERT INTO `host_code` VALUES (5001,'XL_640','CR'),(5002,'XL_640','UREA'),(5006,'XL_640','ALT'),(5007,'XL_640','ALP'),(5008,'XL_640','AMY'),(5009,'XL_640','TBIL'),(5010,'XL_640','DBIL'),(5011,'XL_640','ALB'),(5012,'XL_640','TP'),(5013,'XL_640','AST'),(5014,'XL_640','CAL'),(5015,'XL_640','CHO'),(5016,'XL_640','CHOH'),(5017,'XL_640','CHOL'),(5018,'XL_640','TG'),(5019,'XL_640','Na'),(5020,'XL_640','K'),(5021,'XL_640','IRON'),(5022,'XL_640','TIBC'),(5023,'XL_640','UIBC'),(5024,'XL_640','IBIL'),(5025,'XL_640','LDH'),(5026,'XL_640','LIP'),(5027,'XL_640','UA'),(5028,'XL_640','CHOV'),(5029,'XL_640','GLC'),(5030,'XL_640','MPR'),(5031,'XL_640','GLC'),(5032,'XL_640','ADA'),(5033,'XL_640','ADA'),(5034,'XL_640','ADA'),(5035,'XL_640','GLC'),(5036,'XL_640','GLC'),(5037,'XL_640','TP'),(5038,'XL_640','TP'),(5039,'XL_640','LIP'),(5040,'XL_640','AMY'),(5041,'XL_640','LDH'),(5042,'XL_640','CHO'),(5043,'XL_640','TG'),(5044,'XL_640','AMY'),(5045,'XL_640','LIP'),(5046,'XL_640','LDH'),(5047,'XL_640','LDH'),(5048,'XL_640','Na'),(5049,'XL_640','K'),(5050,'XL_640','CAL'),(5051,'XL_640','PHO'),(5052,'XL_640','CR'),(5053,'XL_640','TP'),(5054,'XL_640','KTO'),(5055,'XL_640','UA'),(5080,'XL_640','TP'),(5081,'XL_640','MPR'),(5082,'XL_640','MPR'),(5083,'XL_640','Na'),(5084,'XL_640','CAL'),(5085,'XL_640','MPR'),(5092,'XL_640','CK'),(5093,'XL_640','CKMB'),(5100,'XL_640','PHO'),(5113,'XL_640','CHE'),(9001,'XL_640','CR'),(9002,'XL_640','UREA'),(9006,'XL_640','ALT'),(9007,'XL_640','ALP'),(9008,'XL_640','AMY'),(9009,'XL_640','TBIL'),(9010,'XL_640','DBIL'),(9011,'XL_640','ALB'),(9012,'XL_640','TP'),(9013,'XL_640','AST'),(9014,'XL_640','CAL'),(9015,'XL_640','CHO'),(9016,'XL_640','CHOH'),(9018,'XL_640','TG'),(9019,'XL_640','Na'),(9020,'XL_640','K'),(9021,'XL_640','IRON'),(9023,'XL_640','UIBC'),(9025,'XL_640','LDH'),(9026,'XL_640','LIP'),(9027,'XL_640','UA'),(9031,'XL_640','GLC'),(9051,'XL_640','PHO'),(9081,'XL_640','MPR'),(9092,'XL_640','CK'),(9093,'XL_640','CKMB'),(9113,'XL_640','CHE'),(9114,'XL_640','HCL'),(5001,'XL_1000','CRR'),(5002,'XL_1000','UREE'),(5006,'XL_1000','ALTT'),(5007,'XL_1000','ALPP'),(5008,'XL_1000','AMYY'),(5009,'XL_1000','TBILL'),(5010,'XL_1000','DBILL'),(5011,'XL_1000','ALBB'),(5012,'XL_1000','TPP'),(5013,'XL_1000','ASTT'),(5014,'XL_1000','CALL'),(5015,'XL_1000','CHOO'),(5016,'XL_1000',''),(5018,'XL_1000','TGG'),(5019,'XL_1000','Naa'),(5020,'XL_1000','KK'),(5021,'XL_1000','IRONN'),(5023,'XL_1000','UIBCC'),(5025,'XL_1000','LDHH'),(5026,'XL_1000','LIPP'),(5027,'XL_1000','UAA'),(5029,'XL_1000','GLCC'),(5030,'XL_1000','MPRR'),(5031,'XL_1000','GLCC'),(5032,'XL_1000','ADAA'),(5033,'XL_1000','ADAA'),(5034,'XL_1000','ADAA'),(5035,'XL_1000','GLCC'),(5036,'XL_1000','GLCC'),(5037,'XL_1000','TPP'),(5038,'XL_1000','TPP'),(5039,'XL_1000','LIPP'),(5040,'XL_1000','AMYY'),(5041,'XL_1000','LDHH'),(5042,'XL_1000','CHOO'),(5043,'XL_1000','TGG'),(5044,'XL_1000','AMYY'),(5045,'XL_1000','LIPP'),(5046,'XL_1000','LDHH'),(5047,'XL_1000','LDHH'),(5048,'XL_1000','Naa'),(5049,'XL_1000','KK'),(5050,'XL_1000','CALL'),(5051,'XL_1000','PHOO'),(5052,'XL_1000','CRR'),(5053,'XL_1000','TPP'),(5054,'XL_1000','KTOO'),(5055,'XL_1000','UAA'),(5080,'XL_1000','TPP'),(5081,'XL_1000','MPRR'),(5082,'XL_1000','MPRR'),(5083,'XL_1000','Naa'),(5084,'XL_1000','CALL'),(5085,'XL_1000','MPRR'),(5092,'XL_1000','CKK'),(5093,'XL_1000','CKMBB'),(5100,'XL_1000','PHOO'),(5113,'XL_1000','CHEE'),(5114,'XL_1000','HCLL'),(9001,'XL_1000','CRR'),(9002,'XL_1000','UREE'),(9006,'XL_1000','ALTT'),(9007,'XL_1000','ALPP'),(9008,'XL_1000','AMYY'),(9009,'XL_1000','TBILL'),(9010,'XL_1000','DBILL'),(9011,'XL_1000','ALBB'),(9012,'XL_1000','TPP'),(9013,'XL_1000','ASTT'),(9014,'XL_1000','CALL'),(9015,'XL_1000','CHOO'),(9016,'XL_1000',''),(9018,'XL_1000','TGG'),(9019,'XL_1000','Naa'),(9020,'XL_1000','KK'),(9021,'XL_1000','IRONN'),(9023,'XL_1000',''),(9025,'XL_1000','LDHH'),(9026,'XL_1000','LIPP'),(9027,'XL_1000','UAA'),(9031,'XL_1000','GLCC'),(9051,'XL_1000','PHOO'),(9081,'XL_1000','MPRR'),(9092,'XL_1000','CKK'),(9093,'XL_1000','CKMBB'),(9113,'XL_1000','CHEE'),(9114,'XL_1000','HCLL');
/*!40000 ALTER TABLE `host_code` ENABLE KEYS */;
UNLOCK TABLES;

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

--
-- Table structure for table `equipment`
--

DROP TABLE IF EXISTS `equipment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `equipment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `equipment` varchar(100) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  `recorded_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `equipment` (`equipment`)
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

--
-- Table structure for table `equipment_record_type`
--

DROP TABLE IF EXISTS `equipment_record_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `equipment_record_type` (
  `equipment_record_type` varchar(100) NOT NULL,
  PRIMARY KEY (`equipment_record_type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipment_record_type`
--

LOCK TABLES `equipment_record_type` WRITE;
/*!40000 ALTER TABLE `equipment_record_type` DISABLE KEYS */;
INSERT INTO `equipment_record_type` VALUES ('a. identity'),('b. manufacturer , model, serial number'),('c. contect'),('d1. date of receiving'),('d2. date of entering into service'),('e. location'),('f. condition when received'),('g. manufacturer’s instructions'),('h. schedule for preventive maintenance and calibration'),('i. conformation of initial acceptability for use (initial calibration/verification)'),('j. conformation of ongoing acceptability for use (ongoing calibration/verification)'),('k. maintenance aggrement'),('l. maintenance carried out'),('m. damage, malfunction, modification, repair'),('n. Schedule of quality check after repair');
/*!40000 ALTER TABLE `equipment_record_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `record_tables`
--

DROP TABLE IF EXISTS `record_tables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `record_tables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table_name` varchar(100) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `level` int(11) DEFAULT NULL,
  `recorded_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `record_tables`
--

LOCK TABLES `record_tables` WRITE;
/*!40000 ALTER TABLE `record_tables` DISABLE KEYS */;
INSERT INTO `record_tables` VALUES (1,'record_tables','2020-08-16 00:47:54',2,'3'),(2,'equipment_record','2020-08-16 00:47:13',0,'3'),(3,'dementia','2020-08-16 00:47:35',1,'3'),(18,'equipment','2020-08-16 00:47:42',2,'3'),(19,'calibration','2020-08-16 00:46:53',0,'3'),(20,'reagent','2020-08-16 00:47:04',0,'3'),(21,'reagent_name','2020-08-16 00:57:55',2,'3'),(22,'unit_name',NULL,2,NULL);
/*!40000 ALTER TABLE `record_tables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `table_field_specification`
--

DROP TABLE IF EXISTS `table_field_specification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `table_field_specification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tname` varchar(100) DEFAULT NULL,
  `fname` varchar(100) DEFAULT NULL,
  `ftype` varchar(50) DEFAULT NULL,
  `table` varchar(50) DEFAULT NULL,
  `field` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tname_fname` (`tname`,`fname`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `table_field_specification`
--

LOCK TABLES `table_field_specification` WRITE;
/*!40000 ALTER TABLE `table_field_specification` DISABLE KEYS */;
INSERT INTO `table_field_specification` VALUES (1,'equipment_record','equipment','table','equipment','equipment'),(2,'equipment_record','equipment_record_type','table','equipment_record_type','equipment_record_type'),(3,'equipment_record','date','date','',''),(4,'equipment_record','description','textarea','',''),(5,'calibration','date','date','',''),(6,'calibration','cal_equipment','table','cal_equipment','cal_equipment'),(7,'calibration','remarks','textarea','',''),(8,'calibration','correlation','textarea','',''),(9,'calibration','cal_examination','table','host_code','code'),(10,'reagent','name','table','reagent_name','reagent_name'),(11,'reagent','date_of_preparation','date','',''),(12,'reagent','date_of_expiry','date','',''),(13,'reagent','date_of_receipt','date','',''),(14,'reagent_date_of_opening','date_of_opening','date','',''),(15,'reagent','unit','table','unit_name','unit_name');
/*!40000 ALTER TABLE `table_field_specification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reagent`
--

DROP TABLE IF EXISTS `reagent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reagent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `lot` varchar(20) DEFAULT NULL,
  `size` decimal(10,0) DEFAULT NULL,
  `unit` varchar(20) DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  `date_of_preparation` date DEFAULT NULL,
  `date_of_expiry` date DEFAULT NULL,
  `prepared_by` varchar(50) DEFAULT NULL,
  `date_of_receipt` date DEFAULT NULL,
  `condition_on_receipt` varchar(50) DEFAULT NULL,
  `remark` varchar(100) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  `recorded_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reagent`
--

LOCK TABLES `reagent` WRITE;
/*!40000 ALTER TABLE `reagent` DISABLE KEYS */;
INSERT INTO `reagent` VALUES (1,'ALTR1','001',100,'ml',5,'2020-08-05','2020-08-27','me','2020-08-11','4\'\'\'\'\'C','ok','2020-08-16 15:40:35','3'),(2,'ALTR2','ER454',30,'ml',4,'2020-08-17','2020-08-17','me','2020-08-18','ok',NULL,'2020-08-17 21:36:26','3');
/*!40000 ALTER TABLE `reagent` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reagent_name`
--

DROP TABLE IF EXISTS `reagent_name`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reagent_name` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reagent_name` varchar(100) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  `recorded_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reagent_name`
--

LOCK TABLES `reagent_name` WRITE;
/*!40000 ALTER TABLE `reagent_name` DISABLE KEYS */;
INSERT INTO `reagent_name` VALUES (1,'ALTR1',NULL,NULL),(2,'ALTR2','2020-08-16 00:58:11','3'),(3,NULL,NULL,NULL);
/*!40000 ALTER TABLE `reagent_name` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unit_name`
--

DROP TABLE IF EXISTS `unit_name`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unit_name` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_name` varchar(100) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  `recorded_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unit_name`
--

LOCK TABLES `unit_name` WRITE;
/*!40000 ALTER TABLE `unit_name` DISABLE KEYS */;
INSERT INTO `unit_name` VALUES (1,'ml',NULL,NULL);
/*!40000 ALTER TABLE `unit_name` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cal_equipment`
--

DROP TABLE IF EXISTS `cal_equipment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cal_equipment` (
  `cal_equipment` varchar(100) NOT NULL,
  PRIMARY KEY (`cal_equipment`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cal_equipment`
--

LOCK TABLES `cal_equipment` WRITE;
/*!40000 ALTER TABLE `cal_equipment` DISABLE KEYS */;
/*!40000 ALTER TABLE `cal_equipment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reagent_use`
--

DROP TABLE IF EXISTS `reagent_use`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reagent_use` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reagent_id` int(11) DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  `date_of_opening` date DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  `recorded_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `reagent_id_count` (`reagent_id`,`count`),
  CONSTRAINT `reagent_use_ibfk_1` FOREIGN KEY (`reagent_id`) REFERENCES `reagent` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reagent_use`
--

LOCK TABLES `reagent_use` WRITE;
/*!40000 ALTER TABLE `reagent_use` DISABLE KEYS */;
INSERT INTO `reagent_use` VALUES (3,1,1,'2020-08-17','2020-08-17 23:13:40','3'),(26,2,1,'2020-08-17','2020-08-17 20:12:43','3'),(28,2,3,'2020-08-17','2020-08-17 20:12:35','3'),(30,2,2,'2020-08-17','2020-08-17 22:06:41','3'),(31,2,4,'2020-08-17','2020-08-17 20:12:53','3'),(37,1,2,'2020-08-17','2020-08-17 23:09:30','3');
/*!40000 ALTER TABLE `reagent_use` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-08-17 23:22:40
