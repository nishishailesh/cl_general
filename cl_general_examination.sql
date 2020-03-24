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
) ENGINE=InnoDB AUTO_INCREMENT=100011 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `examination`
--

LOCK TABLES `examination` WRITE;
/*!40000 ALTER TABLE `examination` DISABLE KEYS */;
INSERT INTO `examination` VALUES (1,'WBC (Leucocyte Count)','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\" /cmm  4000-10000 (Impedance)\",\"step\":\"1\", \"interval_l\":\"4000\",\"interval_h\":\"10000\",\"cinterval_l\":\"2000\",\"cinterval_h\":\"30000\"}',''),(2,'RBC (Erythrocyte Count)','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"M/cmm, M:4.5-5.5 F:3.8-4.8 (Impedance)\",\"interval_l\":\"3.8\",\"interval_h\":\"5.5\",\"step\":\"0.01\"}','None'),(3,'Hemoglobin','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"gm/dL M: 13-17 F:12-15 (Non-CyanomethHb)\",\"interval_l\":\"12\",\"interval_h\":\"17\",\"cinterval_l\":\"7\",\"cinterval_h\":\"20\",\"step\":\"0.1\"}','None'),(4,'PCV (Packed Cell Volume)','EDTA-Blood-HI','{\"type\":\"number\",\"step\":\"0.1\",\"help\":\"% M:40-50 F:36-46 (Impedance)\",\"interval_l\":\"36\",\"interval_h\":\"50\",\"cinterval_l\":\"20\",\"cinterval_h\":\"60\"}','None'),(5,'MCV (Mean Corp Vol)','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"fL 80-96 (Calculated)\",\"step\":\"0.1\",\"interval_l\":\"80\",\"interval_h\":\"96\"}','None'),(6,'MCH (Mean Corp Hb)','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"pg 27-31 (Calculated)\",\"step\":\"0.1\",\"interval_l\":\"27\",\"interval_h\":\"31\"}','None'),(7,'MCHC (Mean Corp Hb Conc)','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"gm/dL 32-36 (Calculated)\",\"step\":\"0.1\",\"interval_l\":\"32\",\"interval_h\":\"36\"}','None'),(8,'RDW (Red Cell Dist Width)','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"% 11.5-14 (Calculated)\",\"step\":\"0.1\",\"interval_l\":\"11.5\",\"interval_h\":\"14\"}','None'),(9,'Platelet','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"/cmm 150000-400000 (Impedance)\",\"step\":\"1\",\"interval_l\":\"150000\",\"interval_h\":\"400000\",\"cinterval_l\":\"20000\",\"cinterval_h\":\"1000000\"}','None'),(13,'Lymphocyte%','EDTA-Blood-HI','{\"type\":\"text\",\"help\":\"Describe\"}','None'),(14,'Monocyte%','EDTA-Blood-HI','{\"type\":\"text\",\"help\":\"Describe\"}','None'),(15,'Granulocyte%','EDTA-Blood-HI','{\"type\":\"text\",\"help\":\"Describe\"}','None'),(19,'RBC Graph','EDTA-Blood-HI','{\"type\":\"blob\",\"readonly\":\"readonly\",\"img\":\"dw\"}','None'),(20,'WBC Graph','EDTA-Blood-HI','{\"type\":\"blob\",\"readonly\":\"readonly\",\"img\":\"dw\"}','None'),(21,'Platelet Graph','EDTA-Blood-HI','{\"type\":\"blob\",\"readonly\":\"readonly\",\"img\":\"dw\"}','None'),(26,'Sample_Report_Time','None','{\"type\":\"datetime-local\", \"pattern\":\"[0-9]{4}-[0-9]{2}-[0-9]{2}T[0-9]{2}:[0-9]{2}\",\"default\":\"date(\'Y-m-d\')\" }',''),(39,'Neutrophils','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"% 40-80\",\"step\":\"1\",\"interval_l\":\"40\",\"interval_h\":\"80\"}',''),(40,'Lymphocytes','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"% 20-40\",\"step\":\"1\",\"interval_l\":\"20\",\"interval_h\":\"40\"}',''),(41,'Eosinophils','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"% 01-06\",\"step\":\"1\",\"interval_h\":\"6\"}',''),(42,'Monocytes','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"% 02-10\",\"step\":\"1\",\"interval_h\":\"10\"}',''),(43,'Basophils','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"% 00-02\",\"step\":\"1\",\"interval_h\":\"2\"}',''),(44,'NRBCs','EDTA-Blood-HI','',''),(45,'Platelets on smear','EDTA-Blood-HI','{\"type\":\"select\",\"help\":\"\",\"option\":\",Adequate,Reduced,Increased,Mildly Reduced, Markedly Reduced,\"}',''),(46,'Plasmodium Vivax Malarial Antigen','EDTA-Blood-HI','{\"type\":\"select\",\"option\":\",Negative, Positive\"}','For P. Vivax'),(47,'Plasmodium Falciparum Malarial Antigen','EDTA-Blood-HI','{\"type\":\"select\",\"option\":\",Negative, Positive\"}','For P. Vivax'),(48,'ANC (Absolute Neutrophil Count)','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"/cmm 1600-8000 (Calculation)\",\"step\":\"1\",\"interval_l\":\"1600\",\"interval_h\":\"8000\"}',''),(49,'ALC (Absolute Lymphocyte Count)','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"/cmm 800-4000 (Calculation)\",\"step\":\"1\",\"interval_l\":\"800\",\"interval_h\":\"4000\"}',''),(50,'AEC (Absolute Eosinophil Count)','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"/cmm 20-500 (Calculation)\",\"step\":\"1\",\"interval_l\":\"20\",\"interval_h\":\"500\"}',''),(51,'Blasts','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"%\"}',''),(52,'Promyelocytes','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"%\"}',''),(53,'Myelocytes','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"%\"}',''),(54,'Metamyelocytes','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"%\"}',''),(55,'Neutrophils + Band Cells','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"%\"}',''),(56,'Remark','EDTA-Blood-HI','{\"type\":\"text\"}','For Differential Count'),(57,'Morphology','EDTA-Blood-HI','{\"type\":\"select\",\"option\":\",Normocytic,Normochromic,Normocytic Normochromic,Hypochromic Microcytic,Predominantly Normocytic Normochromic\"}',''),(58,'Anisocytosis','EDTA-Blood-HI','{\"type\":\"select\",\"option\":\",+,++,+++,++++,Mild,Occasional,Few\"}',''),(59,'Poikilocytosis','EDTA-Blood-HI','{\"type\":\"select\",\"option\":\",+,++,+++,++++,Mild,Occasional,Few\"}',''),(60,'Microcytosis','EDTA-Blood-HI','{\"type\":\"select\",\"option\":\",+,++,+++,++++,Mild,Occasional,Few\"}',''),(61,'Macrocytosis','EDTA-Blood-HI','{\"type\":\"select\",\"option\":\",+,++,+++,++++,Mild,Occasional,Few\"}',''),(62,'Hypochromia','EDTA-Blood-HI','{\"type\":\"select\",\"option\":\",+,++,+++,++++,Mild,Occasional,Few\"}',''),(63,'Target Cells','EDTA-Blood-HI','{\"type\":\"select\",\"option\":\",+,Occasional,Few\"}',''),(64,'Elliptocytes','EDTA-Blood-HI','{\"type\":\"select\",\"option\":\",+,Occasional,Few\"}',''),(65,'Tear Drop Cells','EDTA-Blood-HI','{\"type\":\"select\",\"option\":\",+,Occasional,Few\"}',''),(66,'Others','EDTA-Blood-HI','{\"type\":\"text\"}','For RBC Morphology'),(67,'Platelet Morphology','EDTA-Blood-HI','	{\"type\":\"select\",\"option\":\",Giant Platelet seen,Platelet aggregates seen\"}',''),(68,'Species','EDTA-Blood-HI','{\"type\":\"select\",\"option\":\",Not Detected, Plasmodium Vivax Ring Forms and Trophozoites,Plasmodium Falciparum Ring Forms, Plasmodium Falciparum Ring Forms with Gametocytes, Plasmodium Falciparum Gametocytes Detected,Plasmodium Vivax Ring and Trophozoites with Schizonts, Plasmodium Vivax Ring and Trophozoites with Gametocytes, Mixed Infection, Others\"}',''),(69,'Grade','EDTA-Blood-HI','{\"type\":\"select\",\"option\":\",+,++,+++,++++\"}',''),(70,'Others','EDTA-Blood-HI','{\"type\":\"text\"}','For other parasites and mixed'),(71,'MPV (Mean Platelet Volume)','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"fL 6.5-10 (Calculated)\",\"step\":\"0.1\",\"interval_l\":\"6.5\",\"interval_h\":\"10\"}','None'),(72,'PDW (Platelet Distribution Width)','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"% 10-18 (Calculated)\",\"step\":\"0.1\",\"interval_l\":\"10\",\"interval_h\":\"18\"}','None'),(73,'Reticulocyte Count ','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"% 0.5-2.5 (Microscopy)\",\"step\":\"0.1\",\"interval_l\":\"0.5\",\"interval_h\":\"2.5\"}','None'),(74,'Corrected Reticulocyte Count ','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"% (Calculated)\",\"step\":\"0.1\"}','None'),(75,'Erythrocyte Sedimentation Rate','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"mm/hr 0-12 (Westergren Method)\",\"interval_l\":\"0\",\"interval_h\":\"12\"}','None'),(76,'Prothrombin Time (PT)','Citrate-Blood-HI','{\"type\":\"number\",\"help\":\"secs 11-16 (Clot Based)\",\"interval_l\":\"11\",\"interval_h\":\"16\",\"cinterval_h\":\"60\"}','None'),(77,'Control (MNPT)','Citrate-Blood-HI','{\"type\":\"number\",\"help\":\"secs\"}','None'),(78,'Ratio','Citrate-Blood-HI','{\"type\":\"number\",\"calculate\":\"max(E/e,1)\",\"ex_list\":\"76,77\",\"step\":\"0.01\",\"decimal\":\"2\",\"help\":\"PT/MNPT (Calculated)\"}','None'),(79,'Index','Citrate-Blood-HI','{\"type\":\"number\",\"calculate\":\"100/e\",\"ex_list\":\"78\",\"step\":\"1\",\"decimal\":\"0\",\"help\":\"% 100/Ratio (Calculated)\"}','None'),(80,'PT (INR) Value','Citrate-Blood-HI','{\"type\":\"number\",\"calculate\":\"e^1.08\",\"ex_list\":\"78\",\"step\":\"0.01\",\"decimal\":\"2\",\"help\":\"Normal Population: 0.8-1.2\\nStandard Therapy: 2.0-3.0\\nHigh Dose Therapy: 3.0-4.5\\n(Calculated, ISI=1.0)\"}','None'),(81,'aPTT - Test','Citrate-Blood-HI','{\"type\":\"number\",\"help\":\"secs 27-34 (Clot Based)\",\"interval_l\":\"27\",\"interval_h\":\"34\",\"cinterval_h\":\"100\"}','None'),(82,'aPTT - Control ','Citrate-Blood-HI','{\"type\":\"number\",\"help\":\"secs\"}','None'),(83,'Fibrinogen','Citrate-Blood-HI','{\"type\":\"number\",\"help\":\"mg% 150-400 (Clot Based)\",\"interval_l\":\"150\",\"interval_h\":\"400\"}','None'),(84,'Fibrinogen Degradation Product (FDP)','Citrate-Blood-HI','{\"type\":\"select\",\"help\":\"(Agglutination)\",\"option\":\",Negative, Positive\"}','None'),(85,'Factor VIII Assay','Citrate-Blood-HI','{\"type\":\"number\",\"help\":\"% 50-150 (Clot Based)\",\"interval_l\":\"50\",\"interval_h\":\"150\"}','None'),(86,'Factor IX Assay','Citrate-Blood-HI','{\"type\":\"number\",\"help\":\"% 50-150 (Clot Based)\",\"interval_l\":\"50\",\"interval_h\":\"150\"}','None'),(87,'Bleeding Time (BT)','Citrate-Blood-HI','{\"type\":\"number\",\"help\":\"mins 02-05 (Duke Method)\",\"interval_l\":\"2\",\"interval_h\":\"5\"}','None'),(88,'Clotting Time (BT)','Citrate-Blood-HI','{\"type\":\"number\",\"help\":\"mins 08-15 (Capillary Tube Method)\",\"interval_l\":\"8\",\"interval_h\":\"15\"}','None'),(89,'Physical Examination','Plain-Urine-CP','{\"type\":\"subsection\",\"readonly\":\"readonly\"}','For Urine Physical Examination'),(90,'Quantity','Plain-Urine-CP','{\"type\":\"number\",\"help\":\"ml\"}','None'),(91,'Colour','Plain-Urine-CP','{\"type\":\"select\",\"help\":\"Pale Yellow\",\"option\":\",Pale Yellow, Yellow, Reddish, Dark Yellow,Slightly Reddish,Amber,Colourless,Pink\"}','None'),(92,'Appearance','Plain-Urine-CP','{\"type\":\"select\",\"help\":\"Clear\",\"option\":\",Clear, Slightly Turbid, Turbid, Cloudy\"}','None'),(93,'Odour','Plain-Urine-CP','{\"type\":\"select\",\"help\":\"Non-Specific\",\"option\":\",Non-Specific, Fruity, Mousy/Musty, Fishy, Ammoniacal, Foul, Rancid, Maple Syrup/Burnt Sugar\"}','For Urine Odour'),(94,'Chemical Examination','Plain-Urine-CP','{\"type\":\"subsection\",\"readonly\":\"readonly\"}','For Urine Chemical Examination'),(95,'pH','Plain-Urine-CP','{\"type\":\"text\",\"help\":\"4.5 - 8\"}',''),(96,'Specific Gravity','Plain-Urine-CP','{\"type\":\"text\",\"help\":\"1.003 - 1.030\"}',''),(97,'Protein (Albumin)','Plain-Urine-CP','{\"type\":\"select\",\"help\":\"Absent\",\"option\":\",Absent,Trace,+,++,+++,++++\"}','None'),(98,'Glucose','Plain-Urine-CP','{\"type\":\"select\",\"help\":\"Absent\",\"option\":\",Absent,Trace,+,++,+++,++++\"}','None'),(99,'Ketones','Plain-Urine-CP','{\"type\":\"select\",\"help\":\"Absent\",\"option\":\",Absent,Trace,+,++,+++,++++\"}','None'),(100,'Bile Salts','Plain-Urine-CP','{\"type\":\"select\",\"help\":\"Absent\",\"option\":\",Absent, Present\"}','None'),(101,'Bile Pigments','Plain-Urine-CP','{\"type\":\"select\",\"help\":\"Absent\",\"option\":\",Absent, Present\"}','None'),(102,'Blood','Plain-Urine-CP','{\"type\":\"select\",\"help\":\"Absent\",\"option\":\",Absent,Trace,+,++,+++,++++\"}','None'),(103,'Microscopic Examination','Plain-Urine-CP','{\"type\":\"subsection\",\"readonly\":\"readonly\"}','For Urine Microscopic Examination'),(104,'Pus Cells','Plain-Urine-CP','{\"type\":\"text\",\"help\":\"Absent\",\"option\":\",Nil,1-2,2-4\"}',''),(105,'RBC (Red Blood Cells)','Plain-Urine-CP','{\"type\":\"text\",\"help\":\"Absent\",\"option\":\",Nil,1-2,2-4\"}',''),(106,'Epithelial Cells Number','Plain-Urine-CP','{\"type\":\"text\",\"help\":\"/hpf 0 - 5\"}',''),(107,'Crystals','Plain-Urine-CP','	{\"type\":\"select\",\"help\":\"Absent\",\"option\":\",Nil\"}','None'),(108,'Casts','Plain-Urine-CP','{\"type\":\"select\",\"help\":\"Absent\",\"option\":\",Nil\"}','None'),(109,'Others','Plain-Urine-CP','{\"type\":\"text\"}','For Urine Microscopic Examination'),(110,'Special Tests','Plain-Urine-CP','{\"type\":\"subsection\",\"readonly\":\"readonly\"}','For Urine Special Tests'),(111,'Test  Name','Plain-Urine-CP','{\"type\":\"select\",\"help\":\"Absent\",\"option\":\"NA, Bence Jones Proteins, Porphobilinogen, Chyluria, Cylindroids\"}','None'),(113,'Result','Plain-Urine-CP','{\"type\":\"text\"}','For Urine Special Test Result'),(114,'Physical Examination','Plain-Stool-CP','{\"type\":\"subsection\",\"readonly\":\"readonly\"}','For Stool Physical Examination'),(115,'Colour','Plain-Stool-CP','{\"type\":\"select\",\"option\":\",Brown, Yellow, Green,  Black, Greenish Yellow, Dark Yellow, Dark Brown, Whitish, Rice-water \"}','None'),(116,'Consistency','Plain-Stool-CP','{\"type\":\"select\",\"option\":\", Solid, Semi-solid, Loose, Watery\"}','None'),(117,'Chemical Examination','Plain-Stool-CP','{\"type\":\"subsection\",\"readonly\":\"readonly\"}','For Stool Chemical Examination'),(118,'Occult Blood','Plain-Stool-CP','{\"type\":\"select\",\"help\":\"Absent (Benzidine Test)\",\"option\":\",Absent, Present\"}','None'),(119,'Microscopic Examination','Plain-Stool-CP','{\"type\":\"subsection\",\"readonly\":\"readonly\"}','For Stool Microscopic Examination'),(120,'Trophozoites','Plain-Stool-CP','{\"type\":\"select\",\"help\":\"Absent\",\"option\":\",Absent, Present\"}','None'),(121,'Ova','Plain-Stool-CP','{\"type\":\"select\",\"help\":\"Absent\",\"option\":\",Absent, Present\"}','None'),(122,'Cysts','Plain-Stool-CP','{\"type\":\"select\",\"help\":\"Absent\",\"option\":\",Nil\"}','None'),(123,'Pus Cells','Plain-Stool-CP','{\"type\":\"select\",\"help\":\"Absent\",\"option\":\",Absent, 1-2, 3-5, 6-8, 10-12, 15-20, Plenty\"}','None'),(124,'RBC (Red Blood Cells)','Plain-Stool-CP','{\"type\":\"select\",\"help\":\"Absent\",\"option\":\",Absent, 1-2, 3-5, 6-8, 10-12, 15-20, Plenty\"}','None'),(125,'Others','Plain-Stool-CP','{\"type\":\"text\"}','For Stool Microscopic Examination'),(126,'Specimen','EDTA-BodyFluid-CP','{\"type\":\"select\",\"option\":\",Cerebrospinal Fluid (CSF), Ascitic Fluid, Pleural Fluid, Peritoneal Fluid, Synovial Fluid, Pus, Pericardial Fluid, Cystic Fluid, Drain Fluid, Colposcopy Fluid, Abscess Material\"}','None'),(127,'Physical Examination','EDTA-BodyFluid-CP','{\"type\":\"subsection\",\"readonly\":\"readonly\"}','For Body Fluidl Examination'),(128,'Quantity','EDTA-BodyFluid-CP','{\"type\":\"select\",\"help\":\"ml\",\"option\":\",0.5, 1, 1.5, 2, 2.5, 3, 3.5\"}','None'),(129,'Colour','EDTA-BodyFluid-CP','{\"type\":\"select\",\"option\":\",Colourless, Pale Yellow, Yellow, Reddish, Dark Yellow,Slightly Reddish, Amber, Brownish, Greenish, Greyish, Milky-white, Black\"}','None'),(130,'Appearance','EDTA-BodyFluid-CP','{\"type\":\"select\",\"help\":\"Clear\",\"option\":\",Clear, Slightly Turbid, Turbid, Cloudy\"}','None'),(131,'Clot Formation','EDTA-BodyFluid-CP','{\"type\":\"select\",\"help\":\"Absent\",\"option\":\",Absent, Present\"}','None'),(132,'Microscopic Examination','EDTA-BodyFluid-CP','{\"type\":\"subsection\",\"readonly\":\"readonly\"}','For Microscopic Body Fluid Examination'),(133,'Total RBC (Red Blood Cells) Count','EDTA-BodyFluid-CP','{\"type\":\"text\",\"help\":\"cells/cmm\"}','None'),(134,'Total WBC (White Blood Cell) Count','EDTA-BodyFluid-CP','{\"type\":\"text\",\"help\":\"cells/cmm\"}','None'),(135,'Polymorphs','EDTA-BodyFluid-CP','{\"type\":\"text\",\"help\":\"%\"}','None'),(136,'Lymphocytes','EDTA-BodyFluid-CP','{\"type\":\"text\",\"help\":\"%\"}','None'),(137,'Remarks','EDTA-BodyFluid-CP','{\"type\":\"text\"}','For Body Fluid Microscopy'),(138,'Physical Examination','Plain-Semen-CP','{\"type\":\"subsection\",\"readonly\":\"readonly\"}','For Semen Physical Examination'),(139,'Quantity','Plain-Semen-CP','{\"type\":\"select\",\"help\":\"ml 2 - 5\",\"option\":\",0.5, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10\"}','None'),(140,'Colour','Plain-Semen-CP','{\"type\":\"select\",\"help\":\"Greyish White\",\"option\":\",Greyish White, Whitish, Pale Yellow, Reddish, Slightly Reddish\"}','None'),(141,'Microscopic Examination','Plain-Semen-CP','{\"type\":\"subsection\",\"readonly\":\"readonly\"}','For Semen Examination'),(142,'Total Sperm Count','Plain-Semen-CP','{\"type\":\"text\",\"help\":\"mil/mL 30 - 300\"}','None'),(143,'Sperm motility','Plain-Semen-CP','{\"type\":\"subsection\",\"readonly\":\"readonly\"}','For Sperm Motility '),(144,'Actively Motile','Plain-Semen-CP','{\"type\":\"text\",\"help\":\"% 60 - 70\"}','None'),(145,'Sluggishly Motile','Plain-Semen-CP','{\"type\":\"text\",\"help\":\"%\"}','None'),(146,'Non - Motile','Plain-Semen-CP','{\"type\":\"text\",\"help\":\"%\"}','None'),(147,'Bone Marrow Aspiration/Biopsy Number:','EDTA-Blood-HI','{\"type\":\"text\"}','For Bone marrow aspiration and biopsy'),(148,'Nature of Specimen:','EDTA-Blood-HI','{\"type\":\"text\"}','For Bone marrow aspiration and biopsy'),(149,'Brief Clinical History:','EDTA-Blood-HI','{\"type\":\"text\"}','For Bone marrow aspiration and biopsy'),(150,'Bone Marrow Aspiration Report','EDTA-Blood-HI','{\"type\":\"subsection\",\"readonly\":\"readonly\"}',''),(151,'Site:','EDTA-Blood-HI','{\"type\":\"select\",\"option\":\",Left Posterior Superior Iliac Spine, Right Posterior Superior Iliac Spine, Left Anterior Superior Iliac Spine, Right Anterior Superior Iliac Spine, Left Tibial Tuberosity, Right Tibial Tuberosity\"}',''),(152,'Particles:','EDTA-Blood-HI','{\"type\":\"select\",\"option\":\",Grossly appreciated, Grossly not appreciated, Heavily diluted with blood\"}',''),(153,'Cellularity:','EDTA-Blood-HI','{\"type\":\"select\",\"option\":\",Normocellular for age of patient, Hypocellular for age of patient, Hypercellular for age of patient\"}',''),(154,'M:E ratio','EDTA-Blood-HI','{\"type\":\"text\"}',''),(155,'Erythropoiesis','EDTA-Blood-HI','{\"type\":\"text\"}',''),(156,'Myelopoiesis','EDTA-Blood-HI','{\"type\":\"text\"}',''),(157,'Megakaryopoiesis','EDTA-Blood-HI','{\"type\":\"text\"}',''),(158,'Iron store:','EDTA-Blood-HI','{\"type\":\"text\"}',''),(159,'Differential count','EDTA-Blood-HI','{\"type\":\"subsection\",\"readonly\":\"readonly\"}','For Bone marrow aspiration'),(160,'Blasts:','EDTA-Blood-HI','{\"type\":\"text\"}','For Bone marrow aspiration'),(161,'Promyelocytes:','EDTA-Blood-HI','{\"type\":\"text\"}','For Bone marrow aspiration'),(162,'Myelocytes:','EDTA-Blood-HI','{\"type\":\"text\"}','For Bone marrow aspiration'),(163,'Metamyelocytes:','EDTA-Blood-HI','{\"type\":\"text\"}','For Bone marrow aspiration'),(164,'Neutrophils/Band cells','EDTA-Blood-HI','{\"type\":\"text\"}','For Bone marrow aspiration'),(165,'Lymphocytes:','EDTA-Blood-HI','{\"type\":\"text\"}','For Bone marrow aspiration'),(166,'Eosinophils and precursors','EDTA-Blood-HI','{\"type\":\"text\"}','For Bone marrow aspiration'),(167,'Monocytes:','EDTA-Blood-HI','{\"type\":\"text\"}','For Bone marrow aspiration'),(168,'Basophils:','EDTA-Blood-HI','{\"type\":\"text\"}','For Bone marrow aspiration'),(169,'Plasma cells:','EDTA-Blood-HI','{\"type\":\"text\"}','For Bone marrow aspiration'),(170,'others:','EDTA-Blood-HI','{\"type\":\"text\"}','For Bone marrow aspiration'),(171,'Findings:','EDTA-Blood-HI','{\"type\":\"text\"}','For Bone marrow aspiration'),(172,'Conclusion:','EDTA-Blood-HI','{\"type\":\"text\"}','For Bone marrow aspiration'),(173,'Bone Marrow Biopsy Report','EDTA-Blood-HI','{\"type\":\"subsection\",\"readonly\":\"readonly\"}',''),(174,'Site:','EDTA-Blood-HI','{\"type\":\"select\",\"option\":\",Left Posterior Superior Iliac Spine, Right Posterior Superior Iliac Spine, Left Anterior Superior Iliac Spine, Right Anterior Superior Iliac Spine, Left Tibial Tuberosity, Right Tibial Tuberosity\"}','for BMB'),(175,'Cellularity:','EDTA-Blood-HI','{\"type\":\"select\",\"option\":\",Normocellular for age of patient, Hypocellular for age of patient, Hypercellular for age of patient\"}','for BMB'),(176,'Erythropoesis:','EDTA-Blood-HI','{\"type\":\"text\"}','For Bone marrow biopsy'),(177,'Myelopoesis:','EDTA-Blood-HI','{\"type\":\"text\"}','For Bone marrow biopsy'),(178,'Megakaryopoesis:','EDTA-Blood-HI','{\"type\":\"text\"}','For Bone marrow biopsy'),(179,'Findings:','EDTA-Blood-HI','{\"type\":\"text\"}','For Bone marrow biopsy'),(180,'Conclusion:','EDTA-Blood-HI','{\"type\":\"text\"}','For Bone marrow biopsy'),(181,'Epithelial Cells Type','Plain-Urine-CP','{\"type\":\"select\",\"option\":\",Squamous Epithelial Cells, Transitional Epithelial Cells\"}',''),(400,'Lymphocyte','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"%\"}',''),(401,'Eosinophil','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"%\"}',''),(402,'Monocyte','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"%\"}',''),(403,'Basophil','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"%\"}',''),(404,'Others','EDTA-Blood-HI','{\"type\":\"text\"}','For premature dc'),(501,'Parasite','EDTA-Blood-HI','{\"type\":\"json\",\"json\":{\"Parasite Name\":{\"select\":\",PF,PV,F\"},\"Number\":{\"select\":\",+,++,+++\"},\"Stages\":\"Text\"}}',''),(502,'Basic','EDTA-Blood-HI','{\"type\":\"subsection\",\"readonly\":\"readonly\"}','For Basic PS'),(503,'Advanced','EDTA-Blood-HI','{\"type\":\"subsection\",\"readonly\":\"readonly\"}','For Advanced PS'),(510,'Manual Platelet Count','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"/cmm 150000-400000 (Impedance)\",\"step\":\"1\",\"interval_l\":\"150000\",\"interval_h\":\"400000\",\"cinterval_l\":\"20000\",\"cinterval_h\":\"1000000\"}','None'),(511,'Platelets on Peripheral Smear','EDTA-Blood-HI','{\"type\":\"select\",\"help\":\"\",\"option\":\",Adequate,Reduced,Increased,Mildly Reduced, Markedly Reduced,\"}',''),(555,'Hemoglobin','EDTA-Blood-HI','{\"type\":\"number\",\"help\":\"gm/dL M: 13-17 F:12-15 (Non-CyanomethHb)\",\"interval_l\":\"12\",\"interval_h\":\"17\",\"cinterval_l\":\"7\",\"cinterval_h\":\"20\",\"step\":\"0.1\"}','None'),(600,'Hemogram and Blood Indices','EDTA-Blood-HI','{\"type\":\"subsection\",\"readonly\":\"readonly\"}','For CBC'),(601,'Differential Count (Microscopy)','EDTA-Blood-HI','{\"type\":\"subsection\",\"readonly\":\"readonly\"}','For CBC'),(602,'Remark','Citrate-Blood-HI','{\"type\":\"text\"}','For PT'),(603,'Remark','Citrate-Blood-HI','{\"type\":\"text\"}','For aPTT'),(1000,'Sample_requirement','None','{\"type\":\"text\",\"help\":\"Describe\",\"readonly\":\"readonly\"}','None'),(1001,'MRD','None','{\"type\":\"text\",\"readonly\":\"readonly\"}','None'),(1002,'Name','None','{\"type\":\"text\"}','None'),(1003,'Request_id','None','{\"type\":\"text\",\"help\":\"Describe\"}','None'),(1004,'Department','None','{\"type\":\"select\",\"option\":\",ART,Dentistry,EmergencyMedicine,ENT,Medicine,OG,Opthalmology,Orthopaedics,Paediatrics,PlasticSurgery,Psychiatry,Skin,Surgery,TBChest,Unspecified\"}','None'),(1005,'Unit','None','{\"type\":\"select\",\"option\":\",1,2,3,4,5,6,7,8,A,B\"}','None'),(1006,'OPD/Ward','None','{\"type\":\"select\",\"option\":\",C2(684),C3(685),Casualty(446),E0(506),E1(507),E2(508),E3(509),E4(510),EMW(485),EOT(591),F0(511),F1(512),F2(513),F3(514),F3N(503),F4(515),FOW,G0(516),G0MICU(500),G1(517),G2(518),G3(519),G4(520),GOT(551),H0(497),H1(522),H2(523),H3(524),H4(525),HemodialysisUNIT(741),J0(521),J1(531),J2(527),J3(529),J4(530),LeptoWard(506),MICU(500-2),MOT(567),MOW(310),NEWORTHO(311),NOT(551),NOW(311),O2(539),OB(546),OBICU,OLDORTHO(310),OPD,PrisonerWard(310),RI(548),RII(564),RIII(580),SICU(478),SpecialWard(570-71),SwineFluWard(529),TBICU,TRAUMA1(476),TRAUMA2(485),TraumaCenter(472-87),NICU,Unspecified\"}','None'),(1007,'Age(Y)','None','{\"type\":\"number\",\"help\":\"Full Years\"}',''),(1008,'Sex','None','{\"type\":\"select\",\"option\":\",M,F,O\"}',''),(1009,'Sample_Collection_Time','None','{\"type\":\"datetime-local\", \"pattern\":\"[0-9]{4}-[0-9]{2}-[0-9]{2}T[0-9]{2}:[0-9]{2}\" }',''),(1010,'Sample_Receipt_Time','None','{\"type\":\"datetime-local\", \"pattern\":\"[0-9]{4}-[0-9]{2}-[0-9]{2}T[0-9]{2}:[0-9]{2}\" }',''),(1011,'Request_Entry_time','None','{\"type\":\"datetime-local\",\"pattern\":\"[0-9]{4}-[0-9]{2}-[0-9]{2}T[0-9]{2}:[0-9]{2}\"}',''),(1012,'DOB','None','{\"type\":\"date\"}',''),(1013,'Laboratory Name','None','{\"type\":\"select\",\"option\":\",Haematology and Clinical Pathology OPD-10 New Civil Hospital Surat Ph: 216-2244456 Ext: 424 425 426,Biochemistry Near Blood Bank New Civil Hospital Surat Ph: 0216-2244456 Ext: 317\"}',''),(1014,'released_by','None','{\"type\":\"text\",\"readonly\":\"readonly\"}',''),(1015,'Collection_Date','None','{\"type\":\"date\"}',''),(1016,'Collection_Time','None','{\"type\":\"time\"}',''),(1017,'Received_on','None','{\"type\":\"date\"}',''),(1018,'Receipt_time','None','{\"type\":\"time\"}',''),(1019,'(Interim) Released by ','None','{\"type\":\"text\"}',''),(1020,'Age(M)','None','{\"type\":\"number\",\"help\":\"Full Months\"}',''),(1021,'Age(D)','None','{\"type\":\"number\",\"help\":\"Days\"}',''),(1022,'Sample Remark','None','',''),(2001,'Clinical History','Formalin-Tissue-HP','{\"zoom\":\"zoom\"}',''),(2002,'Nature of specimen','Formalin-Tissue-HP','{\"zoom\":\"zoom\"}',''),(2003,'Macroscopic examination done by','Formalin-Tissue-HP','',''),(2004,'Total Number of Blocks','Formalin-Tissue-HP','',''),(2005,'Macroscopic Examination','Formalin-Tissue-HP','{\"zoom\":\"zoom\"}',''),(2006,'Microscopic Examination','Formalin-Tissue-HP','{\"zoom\":\"zoom\"}',''),(2007,'Conclusion','Formalin-Tissue-HP','{\"zoom\":\"zoom\"}','For Formalin HP specimen'),(2008,'Notes','Formalin-Tissue-HP','{\"zoom\":\"zoom\"}','For Formalin HP specimen'),(2009,'Stains','Formalin-Tissue-HP','',''),(2010,'General','Formalin-Tissue-HP','{\"type\":\"subsection\",\"readonly\":\"readonly\"}','For Histopathology'),(2011,'.                                              .','Formalin-Tissue-HP','{\"type\":\"subsection\",\"readonly\":\"readonly\"}','For Histopathology'),(2012,'Dr.','None','{\"type\":\"select\",\"option\":\",Komal Patel (M.D Pathology),V M Bhagat (M.D Pathology),Sejal Gamit (M.D Pathology)\"}',''),(2013,'Dr.','None','{\"type\":\"select\",\"option\":\",Komal Patel (M.D Pathology),V M Bhagat (M.D Pathology),Sejal Gamit (M.D Pathology)\"}',''),(2014,'Dr.','None','{\"type\":\"select\",\"option\":\",Komal Patel (M.D Pathology),V M Bhagat (M.D Pathology),Sejal Gamit (M.D Pathology)\"}',''),(2015,'Dr.','None','{\"type\":\"select\",\"option\":\",Komal Patel (M.D Pathology),V M Bhagat (M.D Pathology),Sejal Gamit (M.D Pathology)\"}',''),(100001,'Peripheral Smear Image','EDTA-Blood-HI','{\"type\":\"blob\",\"help\":\"Describe\"}','None'),(100002,'Protein Electrophorogram Image','Plain-Blood-BI','{\"type\":\"blob\",\"help\":\"Describe\"}','None'),(100003,'Patient Photo','None','{\"type\":\"blob\",\"help\":\"Describe\"}','');
/*!40000 ALTER TABLE `examination` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-03-24 23:00:03
