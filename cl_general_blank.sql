-- MariaDB dump 10.19  Distrib 10.5.15-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: cl_general
-- ------------------------------------------------------
-- Server version	10.5.15-MariaDB-0+deb11u1

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
-- Table structure for table `BMW Management`
--

DROP TABLE IF EXISTS `BMW Management`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `BMW Management` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Number_and_weight_of_red_bag` varchar(50) DEFAULT NULL,
  `Number_and_weight_of_yellow_bag` varchar(50) DEFAULT NULL,
  `Number_and_weight_of_blue_bag` varchar(50) DEFAULT NULL,
  `Weight_of_white_puncture_proof_container` varchar(50) DEFAULT NULL,
  `Number_of_Black_bag` varchar(50) DEFAULT NULL,
  `Staff_name` varchar(50) DEFAULT NULL,
  `Name_of_Waste_receiver` varchar(50) DEFAULT NULL,
  `Remarks` varchar(500) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  `recorded_by` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Barcode_Header`
--

DROP TABLE IF EXISTS `Barcode_Header`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Barcode_Header` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_of_cleaning` datetime NOT NULL,
  `time_of_cleaning` datetime NOT NULL,
  `recorded_by` varchar(100) NOT NULL,
  `recording_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Extent`
--

DROP TABLE IF EXISTS `Extent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Extent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Extent` varchar(200) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  `recorded_by` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `First Dose`
--

DROP TABLE IF EXISTS `First Dose`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `First Dose` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `First Dose` varchar(100) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  `recorded_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `HIB_Vaccination`
--

DROP TABLE IF EXISTS `HIB_Vaccination`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `HIB_Vaccination` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) DEFAULT NULL,
  `First_Dose` date DEFAULT NULL,
  `Second_Dose` date DEFAULT NULL,
  `Third_Dose` date DEFAULT NULL,
  `Titre` mediumblob DEFAULT NULL,
  `Titre_name` varchar(500) DEFAULT NULL,
  `Remarks` varchar(500) DEFAULT NULL,
  `recorded_by` varchar(50) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `IQC`
--

DROP TABLE IF EXISTS `IQC`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `IQC` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Parameter` varchar(100) DEFAULT NULL,
  `attachment` mediumblob DEFAULT NULL,
  `attachment_name` varchar(50) DEFAULT NULL,
  `recorded_by` varchar(50) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Internal_audit`
--

DROP TABLE IF EXISTS `Internal_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Internal_audit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Name_of_Discipline` varchar(100) DEFAULT NULL,
  `Detail_of_Non_conformity` varchar(500) DEFAULT NULL,
  `NC_attachment` mediumblob DEFAULT NULL,
  `Name_of_attachment_of_NC` int(11) DEFAULT NULL,
  `Quality_manual_section` int(11) DEFAULT NULL,
  `Corrective_action_taken` varchar(500) DEFAULT NULL,
  `CA_attachment` mediumblob DEFAULT NULL,
  `Name_of_attachment_CA` varchar(100) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  `recorded_by` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Name_of_attachment_of_NC` (`Name_of_attachment_of_NC`),
  KEY `Quality_manual_section` (`Quality_manual_section`),
  CONSTRAINT `Internal_audit_ibfk_1` FOREIGN KEY (`Name_of_attachment_of_NC`) REFERENCES `Name` (`id`),
  CONSTRAINT `Internal_audit_ibfk_2` FOREIGN KEY (`Quality_manual_section`) REFERENCES `Quality_manual_section` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `NABL_Records`
--

DROP TABLE IF EXISTS `NABL_Records`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `NABL_Records` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attachment` mediumblob DEFAULT NULL,
  `attachment_name` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `doc_type` varchar(100) DEFAULT NULL,
  `recorded_by` varchar(100) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=893 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Name`
--

DROP TABLE IF EXISTS `Name`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Name` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) DEFAULT NULL,
  `recorded_by` varchar(100) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Name_of_Discipline`
--

DROP TABLE IF EXISTS `Name_of_Discipline`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Name_of_Discipline` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Name_of_Discipline` varchar(100) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  `recorded_by` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Nonconformity`
--

DROP TABLE IF EXISTS `Nonconformity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Nonconformity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `NC_Name` varchar(500) DEFAULT NULL,
  `First_information_personnel` varchar(200) DEFAULT NULL,
  `Quality_manual_section` varchar(500) DEFAULT NULL,
  `Source` varchar(500) DEFAULT NULL,
  `Process_affected` varchar(500) DEFAULT NULL,
  `Extent` varchar(500) DEFAULT NULL,
  `Immediate_control` varchar(1000) DEFAULT NULL,
  `Examination_stopped` varchar(500) DEFAULT NULL,
  `Reports_recalled` varchar(500) DEFAULT NULL,
  `RCA` varchar(1500) DEFAULT NULL,
  `Corrective_and_preventive_actions` varchar(1500) DEFAULT NULL,
  `attachment` mediumblob DEFAULT NULL,
  `attachment_name` varchar(500) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  `recorded_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Performance_characteristics`
--

DROP TABLE IF EXISTS `Performance_characteristics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Performance_characteristics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Performance_characteristics` varchar(100) DEFAULT NULL,
  `attachment` mediumblob DEFAULT NULL,
  `attachment_name` varchar(100) DEFAULT NULL,
  `Remarks` varchar(100) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  `recorded_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Performance_characteristics_list`
--

DROP TABLE IF EXISTS `Performance_characteristics_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Performance_characteristics_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Performance_specification` varchar(100) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  `recorded_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Personal_Records`
--

DROP TABLE IF EXISTS `Personal_Records`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Personal_Records` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) DEFAULT NULL,
  `Attachments` mediumblob DEFAULT NULL,
  `Attachment_Name` varchar(100) DEFAULT NULL,
  `Remarks` varchar(500) DEFAULT NULL,
  `recorded_by` int(50) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Process_affected`
--

DROP TABLE IF EXISTS `Process_affected`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Process_affected` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Process_affected` varchar(200) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  `recorded_by` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Quality_manual_section`
--

DROP TABLE IF EXISTS `Quality_manual_section`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Quality_manual_section` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `recording_time` datetime DEFAULT NULL,
  `recorded_by` varchar(100) DEFAULT NULL,
  `clause` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Refrigerator_Temp`
--

DROP TABLE IF EXISTS `Refrigerator_Temp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Refrigerator_Temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_of_reading` date DEFAULT NULL,
  `time_of_reading` time DEFAULT NULL,
  `5_REFRIGERATOR_HE_78_WHIRLPOOL` text DEFAULT NULL,
  `11_REFRIGERATOR_HE_78_SAMSUNG` text DEFAULT NULL,
  `17_REFRIGERATOR_LG-010PRNF052047:HOSP-EQ-P-78` text DEFAULT NULL,
  `18_REFRIGERATOR_LG-010PRZZ052109:HOSP-EQ-P-78` text DEFAULT NULL,
  `6_REFRIGERATOR_HE_136_DEEP_FREEZER_(-40)` text DEFAULT NULL,
  `12_REFRIGERATOR_HE_78_SAMSUNG` text DEFAULT NULL,
  `13_REFRIGERATOR_HE_78_SAMSUNG` text DEFAULT NULL,
  `19_REFRIGERATOR_LG-011PRWH031393:HOSP-EQ-P-78` text DEFAULT NULL,
  `20_REFRIGERATOR_LG-011PRDE031386:HOSP-EQ-P-78` text DEFAULT NULL,
  `21_REFRIGERATOR_LG-102PRSD109078:HOSP-EQ-P-75` text DEFAULT NULL,
  `16_REFRIGERATOR_Haier_chest_freezer:HOSP-EQ-P-136(-30)` text DEFAULT NULL,
  `7_REFRIGERATOR_HE_138_REMI_DEEP_FREEZER_(-20` text DEFAULT NULL,
  `15_REFRIGERATOR_HE_78_WHIRLPOOL` text DEFAULT NULL,
  `23_REFRIGERATOR_LG-102PRSD109102:HOSP-EQ-P-75` text DEFAULT NULL,
  `22_REFRIGERATOR_LG-102PRWH028929:HOSP-EQ-P-75` text DEFAULT NULL,
  `Temperature_equipment_room` decimal(3,1) DEFAULT NULL,
  `Humidity_equipment_room` decimal(3,1) DEFAULT NULL,
  `recorded_by` varchar(50) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=409 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Sample_Transporter`
--

DROP TABLE IF EXISTS `Sample_Transporter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Sample_Transporter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  `recorded_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Sample_Transporter_name`
--

DROP TABLE IF EXISTS `Sample_Transporter_name`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Sample_Transporter_name` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `mobile` varchar(12) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  `recorded_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Second Dose`
--

DROP TABLE IF EXISTS `Second Dose`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Second Dose` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Second Dose` date DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  `recorded_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Third Dose`
--

DROP TABLE IF EXISTS `Third Dose`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Third Dose` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Third Dose` date DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  `recorded_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `available_request`
--

DROP TABLE IF EXISTS `available_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `available_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `examination_ids` varchar(2000) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

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
-- Table structure for table `calibration`
--

DROP TABLE IF EXISTS `calibration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `calibration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `cal_examination` varchar(100) DEFAULT NULL,
  `cal_equipment` varchar(100) DEFAULT NULL,
  `purpose` varchar(100) DEFAULT NULL,
  `reagent_details` varchar(100) DEFAULT NULL,
  `correlation` varchar(100) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `attachment` mediumblob DEFAULT NULL,
  `attachment_name` varchar(100) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  `recorded_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1521 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `container_additives`
--

DROP TABLE IF EXISTS `container_additives`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `container_additives` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `recording_time` datetime DEFAULT NULL,
  `recorded_by` varchar(100) DEFAULT NULL,
  `container_additives` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `copy_bin_text`
--

DROP TABLE IF EXISTS `copy_bin_text`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `copy_bin_text` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `text` varchar(2000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `copy_sample`
--

DROP TABLE IF EXISTS `copy_sample`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `copy_sample` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `keep_ex_list` varchar(500) NOT NULL,
  `add_ex_list` varchar(500) NOT NULL,
  `add_ex_with_result` varchar(500) NOT NULL,
  `remark` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `critical_alerts`
--

DROP TABLE IF EXISTS `critical_alerts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `critical_alerts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `send_to` varchar(50) DEFAULT NULL,
  `message` varchar(500) DEFAULT NULL,
  `message_status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `equipment_record`
--

DROP TABLE IF EXISTS `equipment_record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `equipment_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `equipment` varchar(100) DEFAULT NULL,
  `equipment_record_type` varchar(100) DEFAULT NULL,
  `breakdown_date_time` varchar(100) DEFAULT NULL,
  `repair_date_time` varchar(100) DEFAULT NULL,
  `description` varchar(6000) DEFAULT NULL,
  `attachment` mediumblob DEFAULT NULL,
  `attachment_name` varchar(100) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  `recorded_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `equipment` (`equipment`)
) ENGINE=InnoDB AUTO_INCREMENT=347 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

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
-- Table structure for table `examination`
--

DROP TABLE IF EXISTS `examination`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `examination` (
  `examination_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_bin NOT NULL,
  `sample_requirement` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT 'NULL',
  `edit_specification` varchar(2000) COLLATE utf8_bin NOT NULL,
  `description` varchar(300) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`examination_id`),
  KEY `sample_requirement` (`sample_requirement`),
  CONSTRAINT `examination_ibfk_1` FOREIGN KEY (`sample_requirement`) REFERENCES `sample_id_strategy` (`sample_requirement`)
) ENGINE=InnoDB AUTO_INCREMENT=100025 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `examination_is_currently_available`
--

DROP TABLE IF EXISTS `examination_is_currently_available`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `examination_is_currently_available` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `examination_is_currently_available` varchar(100) DEFAULT NULL,
  `recorded_by` varchar(100) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `host_code`
--

DROP TABLE IF EXISTS `host_code`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `host_code` (
  `examination_id` int(11) NOT NULL,
  `equipment` enum('XL_640','XL_1000','VITROS3600','RP500','TOSOH') NOT NULL,
  `code` varchar(10) NOT NULL,
  PRIMARY KEY (`equipment`,`examination_id`),
  KEY `examination_id` (`examination_id`),
  CONSTRAINT `host_code_ibfk_1` FOREIGN KEY (`examination_id`) REFERENCES `examination` (`examination_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `im_message`
--

DROP TABLE IF EXISTS `im_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `im_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `send_to` varchar(50) DEFAULT NULL,
  `message` varchar(5000) DEFAULT NULL,
  `message_status` int(1) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  `recorded_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3234 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

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
  `remark` varchar(100) DEFAULT NULL,
  `manufacturer_data` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`lab_reference_value_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9822 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `lis_to_vitros_sample_type`
--

DROP TABLE IF EXISTS `lis_to_vitros_sample_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lis_to_vitros_sample_type` (
  `lis_sample_type` varchar(100) NOT NULL,
  `vitros_sample_type` varchar(10) NOT NULL,
  PRIMARY KEY (`lis_sample_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `menu_new`
--

DROP TABLE IF EXISTS `menu_new`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_new` (
  `id` int(11) NOT NULL,
  `caption` varchar(100) NOT NULL,
  `ex_list` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `moving_average`
--

DROP TABLE IF EXISTS `moving_average`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `moving_average` (
  `examination_id` int(11) NOT NULL,
  `date_time` datetime NOT NULL,
  `avg_value` decimal(10,2) DEFAULT NULL,
  `median_value` decimal(10,2) DEFAULT NULL,
  `ewma` decimal(10,2) DEFAULT NULL,
  `xbar` decimal(10,2) DEFAULT NULL,
  `sample_id` bigint(20) DEFAULT NULL,
  `value` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`examination_id`,`date_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `nabl_accreditation_status`
--

DROP TABLE IF EXISTS `nabl_accreditation_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nabl_accreditation_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `recording_time` datetime DEFAULT NULL,
  `recorded_by` varchar(100) DEFAULT NULL,
  `nabl_accreditation_status` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `nc_source`
--

DROP TABLE IF EXISTS `nc_source`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nc_source` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `recording_time` datetime DEFAULT NULL,
  `recorded_by` varchar(100) DEFAULT NULL,
  `source` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `outward`
--

DROP TABLE IF EXISTS `outward`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `outward` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `outward_no` varchar(50) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  `Description` varchar(500) DEFAULT NULL,
  `attachment` mediumblob DEFAULT NULL,
  `attachment_name` varchar(100) DEFAULT NULL,
  `recorded_by` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=169 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `parameter`
--

DROP TABLE IF EXISTS `parameter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parameter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parameter` varchar(100) DEFAULT NULL,
  `recorded_by` varchar(50) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `primary_result`
--

DROP TABLE IF EXISTS `primary_result`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `primary_result` (
  `sample_id` bigint(20) NOT NULL,
  `examination_id` int(11) NOT NULL,
  `result` varchar(5000) NOT NULL,
  `uniq` varchar(100) NOT NULL,
  PRIMARY KEY (`sample_id`,`examination_id`,`uniq`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `primary_result_blob`
--

DROP TABLE IF EXISTS `primary_result_blob`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `primary_result_blob` (
  `sample_id` bigint(20) NOT NULL,
  `examination_id` int(11) NOT NULL,
  `uniq` varchar(100) NOT NULL,
  `result` mediumblob DEFAULT NULL,
  `fname` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`sample_id`,`examination_id`,`uniq`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=983 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

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
  `reorder_value` decimal(10,0) DEFAULT NULL,
  `recorded_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

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
  `date_of_closing` date DEFAULT NULL,
  `remark` varchar(100) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  `recorded_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `reagent_id_count` (`reagent_id`,`count`),
  CONSTRAINT `reagent_use_ibfk_1` FOREIGN KEY (`reagent_id`) REFERENCES `reagent` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1926 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `record_tables`
--

DROP TABLE IF EXISTS `record_tables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `record_tables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table_name` varchar(100) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `recorded_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `reminders`
--

DROP TABLE IF EXISTS `reminders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reminders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reminder` varchar(100) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `response` varchar(100) DEFAULT NULL,
  `completed` int(11) DEFAULT NULL,
  `recording_time` varchar(100) DEFAULT NULL,
  `recorded_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3179 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `request`
--

DROP TABLE IF EXISTS `request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `request` (
  `request_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `requested_ids` varchar(2000) NOT NULL,
  `requester_id` varchar(200) NOT NULL,
  `request_data` varchar(2000) NOT NULL,
  PRIMARY KEY (`request_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `result`
--

DROP TABLE IF EXISTS `result`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `result` (
  `sample_id` bigint(20) NOT NULL,
  `examination_id` int(11) NOT NULL,
  `result` varchar(5000) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  `recorded_by` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`sample_id`,`examination_id`),
  KEY `examination_id` (`examination_id`),
  KEY `recorded_by` (`recorded_by`),
  CONSTRAINT `result_ibfk_5` FOREIGN KEY (`examination_id`) REFERENCES `examination` (`examination_id`) ON UPDATE CASCADE,
  CONSTRAINT `result_ibfk_6` FOREIGN KEY (`recorded_by`) REFERENCES `user` (`user`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `result_blob`
--

DROP TABLE IF EXISTS `result_blob`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `result_blob` (
  `sample_id` bigint(20) NOT NULL,
  `examination_id` int(11) NOT NULL,
  `result` mediumblob DEFAULT NULL,
  `fname` varchar(100) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  `recorded_by` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`sample_id`,`examination_id`),
  KEY `examination_id` (`examination_id`),
  KEY `recorded_by` (`recorded_by`),
  CONSTRAINT `result_blob_ibfk_1` FOREIGN KEY (`examination_id`) REFERENCES `examination` (`examination_id`) ON UPDATE CASCADE,
  CONSTRAINT `result_blob_ibfk_2` FOREIGN KEY (`recorded_by`) REFERENCES `user` (`user`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

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
-- Table structure for table `sample_link`
--

DROP TABLE IF EXISTS `sample_link`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sample_link` (
  `sample_id` bigint(20) NOT NULL,
  `link` varchar(500) NOT NULL,
  PRIMARY KEY (`sample_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sample_type`
--

DROP TABLE IF EXISTS `sample_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sample_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `recording_time` datetime DEFAULT NULL,
  `recorded_by` varchar(100) DEFAULT NULL,
  `sample_type` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `schedule`
--

DROP TABLE IF EXISTS `schedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `min` varchar(5) NOT NULL,
  `hour` varchar(5) NOT NULL,
  `day` varchar(5) NOT NULL,
  `month` varchar(5) NOT NULL,
  `week` varchar(5) NOT NULL,
  `text` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `scope`
--

DROP TABLE IF EXISTS `scope`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `scope` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_of_examination` varchar(100) DEFAULT NULL,
  `examination_is_currently_available` varchar(100) DEFAULT NULL,
  `nabl_accreditation_status` varchar(100) DEFAULT NULL,
  `unit_of_measurement` varchar(100) DEFAULT NULL,
  `referance_range` varchar(500) DEFAULT NULL,
  `source_of_reference_range` varchar(500) DEFAULT NULL,
  `sample_type` varchar(100) DEFAULT NULL,
  `container_additives` varchar(100) DEFAULT NULL,
  `method_of_analysis` varchar(100) DEFAULT NULL,
  `turn_around_time` varchar(100) DEFAULT NULL,
  `instructions_preparation_of_the_patient` varchar(100) DEFAULT NULL,
  `instructions_patient_collected_samples` varchar(100) DEFAULT NULL,
  `patient_consent` varchar(100) DEFAULT NULL,
  `patient_family_information` varchar(100) DEFAULT NULL,
  `temperature_transport_pre-examination_storage` varchar(100) DEFAULT NULL,
  `additional_examination_timelimit` varchar(100) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  `recorded_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `sensa`
--

DROP TABLE IF EXISTS `sensa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sensa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_time` varchar(50) DEFAULT NULL,
  `sample_id` bigint(11) DEFAULT NULL,
  `pH` varchar(50) DEFAULT NULL,
  `pCO2` varchar(50) DEFAULT NULL,
  `pO2` varchar(50) DEFAULT NULL,
  `Na` varchar(50) DEFAULT NULL,
  `K` varchar(50) DEFAULT NULL,
  `iCa` varchar(50) DEFAULT NULL,
  `Cl` varchar(50) DEFAULT NULL,
  `GLU` varchar(50) DEFAULT NULL,
  `LAC` varchar(50) DEFAULT NULL,
  `HCO3` varchar(50) DEFAULT NULL,
  `recording_time` datetime DEFAULT NULL,
  `recorded_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sample_id_date_time` (`sample_id`,`date_time`)
) ENGINE=InnoDB AUTO_INCREMENT=9934 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `training_record`
--

DROP TABLE IF EXISTS `training_record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `training_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `recording_time` datetime DEFAULT NULL,
  `topic` varchar(100) DEFAULT NULL,
  `attachment` mediumblob DEFAULT NULL,
  `attachment_name` varchar(500) DEFAULT NULL,
  `conducted_by` varchar(500) DEFAULT NULL,
  `competency_record` mediumblob DEFAULT NULL,
  `competency_record_name` varchar(500) DEFAULT NULL,
  `recorded_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `unit_of_measurement`
--

DROP TABLE IF EXISTS `unit_of_measurement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unit_of_measurement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `recording_time` datetime DEFAULT NULL,
  `recorded_by` varchar(100) DEFAULT NULL,
  `unit_of_measurement` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user` bigint(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `expirydate` date NOT NULL,
  `authorization` varchar(300) NOT NULL,
  `group` varchar(300) NOT NULL,
  PRIMARY KEY (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-08-27 12:18:19
