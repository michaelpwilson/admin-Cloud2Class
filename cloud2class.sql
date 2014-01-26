-- MySQL dump 10.13  Distrib 5.5.35, for Linux (x86_64)
--
-- Host: cpd-db    Database: cpd
-- ------------------------------------------------------
-- Server version	5.1.71

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `instances`
--

DROP TABLE IF EXISTS `instances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `instances` (
  `instance_name` varchar(50) DEFAULT NULL,
  `instance_state` varchar(20) NOT NULL,
  `instance_type` varchar(30) NOT NULL,
  `lesson_id` int(11) DEFAULT NULL,
  `ttl` datetime NOT NULL,
  `instance_id` int(11) NOT NULL AUTO_INCREMENT,
  `ip4` varchar(15) DEFAULT NULL,
  `instance_nid` varchar(70) DEFAULT NULL,
  `pool_ref` varchar(20) NOT NULL,
  PRIMARY KEY (`instance_id`),
  KEY `lesson_id` (`lesson_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1741 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instances`
--

LOCK TABLES `instances` WRITE;
/*!40000 ALTER TABLE `instances` DISABLE KEYS */;
/*!40000 ALTER TABLE `instances` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lesson`
--

DROP TABLE IF EXISTS `lesson`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lesson` (
  `user_id` int(11) NOT NULL,
  `pool_id` int(11) NOT NULL,
  `lesson_start` datetime DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `lesson_id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(10) NOT NULL,
  `password` char(60) NOT NULL,
  `packages` varchar(120) DEFAULT NULL,
  `services` varchar(120) DEFAULT NULL,
  `mounts` varchar(120) DEFAULT NULL,
  `instance_type` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`lesson_id`),
  KEY `user_id` (`user_id`),
  KEY `pool_id` (`pool_id`)
) ENGINE=MyISAM AUTO_INCREMENT=354 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lesson`
--

LOCK TABLES `lesson` WRITE;
/*!40000 ALTER TABLE `lesson` DISABLE KEYS */;
INSERT INTO `lesson` VALUES (1,4,'2014-01-25 10:07:01',700,352,'rabbit','596580',NULL,NULL,'uploads:resources','Ubuntu');
/*!40000 ALTER TABLE `lesson` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 trigger createcredentials before insert on lesson for each row begin set new.login := (select username from usernames order by rand() limit 1); set new.password := (SELECT FLOOR(RAND() * (999999-100000 +1))); end */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `pool_id` int(11) NOT NULL DEFAULT '0',
  `message` varchar(200) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`pool_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organization`
--

DROP TABLE IF EXISTS `organization`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `organization` (
  `org_id` int(11) NOT NULL AUTO_INCREMENT,
  `org_name` varchar(30) NOT NULL,
  `org_comment` varchar(100) DEFAULT NULL,
  `sub_max_pools` int(11) NOT NULL,
  `sub_max_users` int(11) NOT NULL,
  `sub_max_instances` int(11) NOT NULL DEFAULT '10',
  PRIMARY KEY (`org_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organization`
--

LOCK TABLES `organization` WRITE;
/*!40000 ALTER TABLE `organization` DISABLE KEYS */;
INSERT INTO `organization` VALUES (1,'Bett2014','Bett2014 Demonstration Account',4,2,30),(2,'Training','Bright Process general training resources',4,6,50),(3,'Trial','Trial organization',20,20,100);
/*!40000 ALTER TABLE `organization` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pool`
--

DROP TABLE IF EXISTS `pool`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pool` (
  `pool_id` int(11) NOT NULL AUTO_INCREMENT,
  `pool_max_instances` int(11) NOT NULL,
  `pool_ref` varchar(30) NOT NULL,
  `org_id` int(11) NOT NULL,
  `pool_min_instances` int(11) NOT NULL DEFAULT '0',
  `network_id` varchar(40) NOT NULL,
  `provider` varchar(30) NOT NULL,
  PRIMARY KEY (`pool_id`),
  KEY `org_id` (`org_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pool`
--

LOCK TABLES `pool` WRITE;
/*!40000 ALTER TABLE `pool` DISABLE KEYS */;
INSERT INTO `pool` VALUES (1,10,'demo',1,2,'467976fa-8bd3-4b9b-96e5-9ff71f620c34','bett-service'),(2,32,'tlc',2,5,'0665d4a2-378a-4719-b13a-9cbe9973166f','training-service'),(3,20,'internal',2,5,'0665d4a2-378a-4719-b13a-9cbe9973166f','training-service'),(4,5,'bett1',1,5,'467976fa-8bd3-4b9b-96e5-9ff71f620c34','bett-service'),(5,5,'bett2',1,5,'467976fa-8bd3-4b9b-96e5-9ff71f620c34','bett-service'),(6,5,'bett3',1,5,'467976fa-8bd3-4b9b-96e5-9ff71f620c34','bett-service');
/*!40000 ALTER TABLE `pool` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(30) NOT NULL,
  `role_comment` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,'user','Standard Controller role'),(2,'admin','Admin-level role');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `type`
--

DROP TABLE IF EXISTS `type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `type` (
  `type_id` varchar(30) NOT NULL,
  `type_desc` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type`
--

LOCK TABLES `type` WRITE;
/*!40000 ALTER TABLE `type` DISABLE KEYS */;
INSERT INTO `type` VALUES ('cpd-ubuntu-2','Ubuntu');
/*!40000 ALTER TABLE `type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_login` varchar(30) NOT NULL,
  `user_password` char(60) NOT NULL,
  `role_id` int(11) NOT NULL,
  `user_forename` varchar(20) NOT NULL,
  `user_surname` varchar(20) NOT NULL,
  `user_title` varchar(10) NOT NULL,
  `user_active` tinyint(1) NOT NULL DEFAULT '1',
  `org_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`),
  KEY `user_role_id` (`role_id`),
  KEY `org_id` (`org_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'bett2014','$2y$10$Gd7VO1mR7G3Mu/mI3FHpeOdhnSfeLiMfynQ9WgjhMuBDCj8nRwUMO',1,'Bett','2014','Mr',1,1),(2,'demo','$2y$10$Gd7VO1mR7G3Mu/mI3FHpeOdhnSfeLiMfynQ9WgjhMuBDCj8nRwUMO',1,'Bett','2014','Mr',1,1),(3,'mwils','$2y$10$Gd7VO1mR7G3Mu/mI3FHpeOdhnSfeLiMfynQ9WgjhMuBDCj8nRwUMO',2,'michael','','',1,2),(4,'asing','$2y$10$Gd7VO1mR7G3Mu/mI3FHpeOdhnSfeLiMfynQ9WgjhMuBDCj8nRwUMO',2,'Andy','','',1,2),(5,'cpdtrain','$2y$10$Gd7VO1mR7G3Mu/mI3FHpeOdhnSfeLiMfynQ9WgjhMuBDCj8nRwUMO',1,'CPD','Administrator','Ms',1,2);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_pool`
--

DROP TABLE IF EXISTS `user_pool`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_pool` (
  `user_id` int(11) NOT NULL,
  `pool_id` int(11) NOT NULL,
  KEY `user_id` (`user_id`),
  KEY `pool_id` (`pool_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_pool`
--

LOCK TABLES `user_pool` WRITE;
/*!40000 ALTER TABLE `user_pool` DISABLE KEYS */;
INSERT INTO `user_pool` VALUES (1,4),(1,5),(1,6),(2,1),(3,2),(4,2),(5,2);
/*!40000 ALTER TABLE `user_pool` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usernames`
--

DROP TABLE IF EXISTS `usernames`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usernames` (
  `username` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usernames`
--

LOCK TABLES `usernames` WRITE;
/*!40000 ALTER TABLE `usernames` DISABLE KEYS */;
INSERT INTO `usernames` VALUES ('welcome'),('flower'),('rabbit'),('daisy'),('aloha'),('mystery'),('turtle'),('light'),('shadow'),('table'),('chairs'),('lemon'),('orange'),('heather'),('yellow'),('blue'),('keyboard'),('mouse'),('antelope'),('creeper'),('coffee'),('mouse'),('red'),('press'),('small'),('large'),('troll'),('bat'),('tulip');
/*!40000 ALTER TABLE `usernames` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-01-26 15:46:15
