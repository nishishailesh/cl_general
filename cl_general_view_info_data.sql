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
INSERT INTO `view_info_data` VALUES (1,'Total Sample On a Day','<input type=date name=__p1 title=\'Give Date\'>','select count(examination_id) as Total_Sample from result where examination_id=1017 and result=\"__p1\"'),(2,'Test count on a date','<input type=date name=__p1 title=\'Give Date\'>','select  	r1.examination_id A ,e1.name B ,  	r2.examination_id C ,e2.name D, 	r2.result E, 	count(r2.result) F from  	examination e1,examination e2,  	result r1,result r2  where  	r1.sample_id=r2.sample_id and  	r2.examination_id=1017 and  	r2.result=\"__p1\" and 	e1.examination_id=r1.examination_id and  	e2.examination_id=r2.examination_id  group by r1.examination_id order by r1.examination_id'),(3,'Max ID (series 2,3)','','select 2 as series, max(sample_id) from result where sample_id between 2000000 and 2999999 union select 3 as series, max(sample_id) from result where sample_id between 3000000 and 3999999'),(4,'Test count on a date (a bit better)','<input type=date name=__p1 title=\'Give Date\'>','select  	r1.examination_id examination_id ,e1.name Test,  r2.result Date, 	count(r2.result) Test_Count  from  	examination e1,examination e2,  	result r1,result r2  where  	r1.sample_id=r2.sample_id and  	r2.examination_id=1017 and  	r2.result=\"__p1\" and 	e1.examination_id=r1.examination_id and  	e2.examination_id=r2.examination_id  and e1.sample_requirement!=\'None\' group by r1.examination_id order by r1.examination_id'),(5,'Test count on between two dates','From:<input type=date name=__p1 title=\'Give From  Date\'>To:<input type=date name=__p2 title=\'Give To Date\'>','select r1.examination_id examination_id ,e1.name Test,  	count(r2.result) Test_Count   from  	examination e1,examination e2,  	result r1,result r2   where  	r1.sample_id=r2.sample_id and  	r2.examination_id=1017 and  	 r2.result between str_to_date(\'__p1\',\'%Y-%m-%d\') and str_to_date(\'__p2\',\'%Y-%m-%d\') and 	 e1.examination_id=r1.examination_id and  	e2.examination_id=r2.examination_id   and e1.sample_requirement!=\'None\' group by r1.examination_id order by r1.examination_id'),(6,'Sample_ID,Test name and result of a date','Date:<input type=date name=__p1 title=\'Give From  Date\'>Ex_ID:<input type=number name=__p2 title=\'Give Examination_id\'>','select  	 r1.sample_id sample_id, r1.examination_id examination_id ,e1.name Test, r1.result , r2.result Date  from  	 examination e1,examination e2,  	 result r1,result r2    where  	 r1.sample_id=r2.sample_id and  	 r2.examination_id=1017 and  	 r2.result=\"__p1\" and 	 e1.examination_id=r1.examination_id and  	 e2.examination_id=r2.examination_id  and  e1.examination_id=\"__p2\" and e1.sample_requirement!=\'None\'   order by r1.examination_id'),(7,'Test ID and their Name','','select examination_id,name,sample_requirement from examination order by name'),(8,'Profile count between two dates','From:<input type=date name=__p1 title=\'Give From  Date\'>To:<input type=date name=__p2 title=\'Give To Date\'>','select  p.profile_id, p.name,  	count(r2.result) Test_Count   from  	 examination e1,examination e2, result r1,result r2, profile p  where  	 r1.sample_id=r2.sample_id and  	 r2.examination_id=1017 and  	  r2.result between str_to_date(\'__p1\',\'%Y-%m-%d\') and str_to_date(\'__p2\',\'%Y-%m-%d\') and e1.examination_id=r1.examination_id and  	 e2.examination_id=r2.examination_id   and  e1.sample_requirement!=\'None\' and substring_index(p.examination_id_list,\',\',1)=e1.examination_id  group by  r1.examination_id   order by  p.profile_id'),(9,'sample count: age more than 60 years','From:<input type=date name=__p1 title=\'Give From Date\'>To<input type=date name=__p2 title=\'Give To Date\'>','select count(sample_id) from result where examination_id=1007  and (recording_time between \"__p1\" and \"__p2\" )and result>=60');
/*!40000 ALTER TABLE `view_info_data` ENABLE KEYS */;
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
