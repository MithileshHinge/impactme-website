-- MySQL dump 10.13  Distrib 5.7.29, for Linux (x86_64)
--
-- Host: localhost    Database: demo_impact
-- ------------------------------------------------------
-- Server version	5.7.29-0ubuntu0.18.04.1

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
-- Table structure for table `admin_user`
--

DROP TABLE IF EXISTS `admin_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_user` (
  `emp_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE latin1_general_ci DEFAULT NULL,
  `username` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `password` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `email_id` varchar(150) COLLATE latin1_general_ci DEFAULT NULL,
  `address` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `phone_no` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `add_date` varchar(20) COLLATE latin1_general_ci DEFAULT NULL,
  `add_by` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `edit_date` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `edit_by` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `phone_no1` varchar(150) COLLATE latin1_general_ci DEFAULT NULL,
  `image_path` varchar(150) COLLATE latin1_general_ci DEFAULT NULL,
  `thumb_image` varchar(150) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`emp_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_user`
--

LOCK TABLES `admin_user` WRITE;
/*!40000 ALTER TABLE `admin_user` DISABLE KEYS */;
INSERT INTO `admin_user` VALUES (1,'Admin','admin','pass','webstacktechnologies@gmail.com','<p>nagpur</p>\r\n','8208305165','28-04-2015','system','2019-09-12 10:15:35','admin',1,'','profile/31571495913678comment3.jpg','profile/thumbs/31571495913678comment3.jpg'),(2,'Wwww','aaaa','fff','','222','2222','2015-05-29','admin','29-05-2015','admin',1,'','','');
/*!40000 ALTER TABLE `admin_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog`
--

DROP TABLE IF EXISTS `blog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blog` (
  `blog_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `blog_category_id` int(11) NOT NULL DEFAULT '0',
  `blog_title` text,
  `written_by` varchar(250) DEFAULT NULL,
  `description` longtext,
  `image_path` varchar(150) DEFAULT NULL,
  `breadcumb_image` varchar(150) DEFAULT NULL,
  `blog_date` date DEFAULT NULL,
  `add_by` varchar(150) DEFAULT NULL,
  `add_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `edit_by` varchar(150) DEFAULT NULL,
  `edit_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` int(11) NOT NULL DEFAULT '0',
  `is_home` int(11) NOT NULL DEFAULT '0',
  `page_title` text,
  `meta_title` text,
  `meta_keyword` text,
  `meta_description` text,
  `slug` text,
  PRIMARY KEY (`blog_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog`
--

LOCK TABLES `blog` WRITE;
/*!40000 ALTER TABLE `blog` DISABLE KEYS */;
/*!40000 ALTER TABLE `blog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `impact_goal`
--

DROP TABLE IF EXISTS `impact_goal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `impact_goal` (
  `goal_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `goal_type` varchar(255) DEFAULT NULL,
  `goal_price` float(18,2) DEFAULT '0.00',
  `patron_number` int(11) DEFAULT '0',
  `description` text,
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) DEFAULT '1',
  `goal_status` int(11) DEFAULT '0',
  PRIMARY KEY (`goal_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `impact_goal`
--

LOCK TABLES `impact_goal` WRITE;
/*!40000 ALTER TABLE `impact_goal` DISABLE KEYS */;
INSERT INTO `impact_goal` VALUES (3,56,'earning',5000.00,0,'Help me to achieve my goals','2020-01-16 09:59:17',1,0),(4,46,'community',0.00,2,'asdfghj','2020-01-17 05:13:32',1,1),(5,46,'community',0.00,10,'asdfghj','2020-01-17 05:13:45',1,0);
/*!40000 ALTER TABLE `impact_goal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `impact_join`
--

DROP TABLE IF EXISTS `impact_join`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `impact_join` (
  `join_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `creator_id` int(11) NOT NULL DEFAULT '0',
  `tier_id` int(11) NOT NULL DEFAULT '0',
  `tier_type` enum('Custom','Tier') DEFAULT 'Tier',
  `tier_price` float(18,2) DEFAULT '0.00',
  `join_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`join_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `impact_join`
--

LOCK TABLES `impact_join` WRITE;
/*!40000 ALTER TABLE `impact_join` DISABLE KEYS */;
/*!40000 ALTER TABLE `impact_join` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `impact_message`
--

DROP TABLE IF EXISTS `impact_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `impact_message` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `from_id` int(11) DEFAULT '0',
  `to_id` int(11) DEFAULT '0',
  `message` text,
  `send_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '0',
  `from_delete` int(11) NOT NULL DEFAULT '0',
  `to_delete` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `impact_message`
--

LOCK TABLES `impact_message` WRITE;
/*!40000 ALTER TABLE `impact_message` DISABLE KEYS */;
INSERT INTO `impact_message` VALUES (1,49,2,'test','2020-02-08 23:22:11',1,0,0),(2,2,49,'gjhghj','2020-02-09 02:32:23',1,0,0),(3,2,66,'helloo','2020-02-12 00:49:00',1,0,0),(4,66,2,'hbuino','2020-06-11 06:00:40',0,0,0);
/*!40000 ALTER TABLE `impact_message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `impact_notification`
--

DROP TABLE IF EXISTS `impact_notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `impact_notification` (
  `notification_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `from_user_id` int(11) DEFAULT '0',
  `post_id` int(11) DEFAULT '0',
  `tier_id` int(11) DEFAULT '0',
  `description` text,
  `notify_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `read_status` int(11) DEFAULT '0',
  `notification_type` varchar(255) DEFAULT NULL,
  `notification_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`notification_id`)
) ENGINE=InnoDB AUTO_INCREMENT=371 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `impact_notification`
--

LOCK TABLES `impact_notification` WRITE;
/*!40000 ALTER TABLE `impact_notification` DISABLE KEYS */;
INSERT INTO `impact_notification` VALUES (1,56,46,17,0,'Tushar Sawant Added New Post asdasd','2020-01-16 20:29:49',0,'post',0),(2,66,46,17,0,'Tushar Sawant Added New Post asdasd','2020-01-16 20:29:49',0,'post',1),(3,73,46,17,0,'Tushar Sawant Added New Post asdasd','2020-01-16 20:29:49',0,'post',0),(4,46,56,17,0,'Ritesh Murkute Like your post asdasd','2020-01-16 20:32:39',0,'like',1),(5,46,56,0,7,'Ritesh Murkute Paid 2000.00 for your Tier mehenga','2020-01-16 21:08:12',0,'payment',1),(6,56,46,18,0,'Tushar Sawant Added New Post Aur Mehenga Teer','2020-01-16 21:10:30',0,'post',0),(7,66,46,18,0,'Tushar Sawant Added New Post Aur Mehenga Teer','2020-01-16 21:10:30',0,'post',1),(8,73,46,18,0,'Tushar Sawant Added New Post Aur Mehenga Teer','2020-01-16 21:10:30',0,'post',0),(9,46,56,18,0,'Ritesh Murkute Paid 3000 for your One Time Post Aur Mehenga Teer','2020-01-16 21:12:37',0,'payment_one_time',1),(10,56,46,19,0,'Tushar Sawant Added New Post Test Mode','2020-01-16 21:18:19',0,'post',0),(11,66,46,19,0,'Tushar Sawant Added New Post Test Mode','2020-01-16 21:18:19',0,'post',1),(12,73,46,19,0,'Tushar Sawant Added New Post Test Mode','2020-01-16 21:18:19',0,'post',0),(13,46,56,19,0,'Ritesh Murkute Paid 50 for your One Time Post Test Mode','2020-01-16 21:19:38',0,'payment_one_time',1),(14,46,66,0,6,'Mithilesh Hinge Paid 100.00 for your Tier thoda kam sasta','2020-01-16 21:25:15',0,'payment',1),(15,56,46,0,2,'Tushar Sawant Paid 50.00 for your Tier Tier1','2020-01-16 22:39:15',0,'payment',0),(16,73,46,0,14,'Tushar Sawant Paid 500.00 for your Tier 4th level','2020-01-17 04:01:11',0,'payment',0),(17,46,46,19,0,'Tushar Sawant Like your post Test Mode','2020-01-19 04:48:31',0,'like',1),(18,66,46,0,15,'Tushar Sawant Paid 2000.00 for your Tier 1st','2020-01-19 05:13:02',0,'payment',1),(19,66,2,21,0,'Bhaskar Kumar Added New Post test','2020-01-25 21:43:47',0,'post',1),(20,2,56,21,0,'Ritesh Murkute Paid 300 for your One Time Post test','2020-01-25 22:03:13',0,'payment_one_time',1),(21,56,46,22,0,'Tushar Sawant Added New Post yotyot','2020-01-26 02:56:22',0,'post',0),(22,66,46,22,0,'Tushar Sawant Added New Post yotyot','2020-01-26 02:56:22',0,'post',1),(23,73,46,22,0,'Tushar Sawant Added New Post yotyot','2020-01-26 02:56:22',0,'post',0),(24,56,46,23,0,'Tushar Sawant Added New Post qwerty','2020-01-26 02:58:14',0,'post',0),(25,66,46,23,0,'Tushar Sawant Added New Post qwerty','2020-01-26 02:58:14',0,'post',1),(26,73,46,23,0,'Tushar Sawant Added New Post qwerty','2020-01-26 02:58:14',0,'post',0),(27,56,46,24,0,'Tushar Sawant Added New Post wdawd','2020-01-26 02:59:15',0,'post',0),(28,66,46,24,0,'Tushar Sawant Added New Post wdawd','2020-01-26 02:59:15',0,'post',1),(29,73,46,24,0,'Tushar Sawant Added New Post wdawd','2020-01-26 02:59:15',0,'post',0),(32,46,66,16,0,'Mithilesh Hinge Commented on your post dsfds','2020-01-27 23:15:22',0,'Comment_add',1),(33,73,66,9,0,'Mithilesh Hinge Commented on your post jus barkatit','2020-01-27 23:17:45',0,'Comment_add',0),(34,46,66,4,0,'Mithilesh Hinge Commented on your post 1','2020-01-27 23:32:28',0,'Comment_add',1),(35,46,56,23,0,'Ritesh Murkute Commented on your post qwerty','2020-01-27 23:33:25',0,'Comment_add',1),(36,46,2,24,0,'Bhaskar Kumar Commented on your post wdawd','2020-01-27 23:38:27',0,'Comment_add',1),(37,2,58,21,0,'Chetan Tawale Paid 300 for your One Time Post test','2020-01-28 19:28:41',0,'payment_one_time',1),(38,46,2,0,7,'Bhaskar Kumar Paid 2000.00 for your Tier mehenga','2020-01-28 19:33:23',0,'payment',1),(39,46,66,6,0,'Mithilesh Hinge Commented on your post 123456','2020-01-28 20:58:21',0,'Comment_add',1),(55,46,66,6,0,'Mithilesh Hinge Commented on your post 123456','2020-01-28 23:36:20',0,'Comment_add',1),(56,46,56,6,0,'Ritesh Murkute Commented on your post 123456','2020-01-28 23:42:06',0,'Comment_add',1),(57,46,66,25,0,'Mithilesh Hinge Added New Post gggg','2020-01-29 00:35:40',0,'post',1),(59,46,66,26,0,'Mithilesh Hinge Added New Post gggg','2020-01-29 00:36:42',0,'post',1),(61,66,66,26,0,'Mithilesh Hinge Commented on your post gggg','2020-01-29 00:37:28',0,'Comment_add',1),(65,66,66,26,0,'Mithilesh Hinge Commented on your post gggg','2020-01-29 00:50:40',0,'Comment_add',1),(66,66,46,25,0,'Tushar Sawant Commented on your post gggg','2020-01-29 18:24:24',0,'Comment_add',1),(67,66,66,25,0,'Mithilesh Hinge Commented on your post gggg','2020-01-29 18:25:23',0,'Comment_add',1),(68,66,46,25,0,'Tushar Sawant Commented on your post gggg','2020-01-29 18:27:08',0,'Comment_add',1),(69,66,66,25,0,'Mithilesh Hinge Commented on your post gggg','2020-01-29 18:28:43',0,'Comment_add',1),(70,66,56,25,0,'Ritesh Murkute Commented on your post gggg','2020-01-29 18:33:09',0,'Comment_add',1),(71,2,2,1,0,'Bhaskar Kumar Like your post Apana Time Aayega','2020-01-29 23:04:07',0,'like',1),(72,2,2,1,0,'Bhaskar Kumar Like your post Apana Time Aayega','2020-01-29 23:04:19',0,'like',1),(73,2,2,1,0,'Bhaskar Kumar Like your post Apana Time Aayega','2020-01-29 23:17:26',0,'like',1),(74,2,2,1,0,'Bhaskar Kumar Like your post Apana Time Aayega','2020-01-29 23:17:29',0,'like',1),(75,2,2,1,0,'Bhaskar Kumar Like your post Apana Time Aayega','2020-01-29 23:17:32',0,'like',1),(76,2,2,21,0,'Bhaskar Kumar Like your post test','2020-01-30 00:07:48',0,'like',1),(77,2,66,1,0,'Mithilesh Hinge Commented on your post Apana Time Aayega','2020-01-30 17:35:46',0,'Comment_add',1),(78,2,66,1,0,'Mithilesh Hinge Commented on your post Apana Time Aayega','2020-01-30 17:37:59',1,'Comment_add',1),(79,66,66,26,0,'Mithilesh Hinge Like your post gggg','2020-01-31 00:24:45',0,'like',1),(80,46,2,24,0,'Bhaskar Kumar Commented on your post wdawd','2020-01-31 05:33:01',0,'Comment_add',1),(81,46,2,24,0,'Bhaskar Kumar Like your post wdawd','2020-01-31 05:33:23',0,'like',1),(82,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-01-31 17:44:09',0,'Comment_add',1),(83,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-01-31 17:44:37',0,'Comment_add',1),(84,66,46,26,0,'Tushar Sawant Commented on your post gggg','2020-01-31 19:14:21',0,'Comment_add',1),(85,66,46,26,0,'Tushar Sawant Commented on your post gggg','2020-01-31 19:14:34',0,'Comment_add',1),(86,66,46,26,0,'Tushar Sawant Commented on your post gggg','2020-01-31 19:14:36',0,'Comment_add',1),(87,66,46,26,0,'Tushar Sawant Commented on your post gggg','2020-01-31 19:14:43',0,'Comment_add',1),(88,66,46,26,0,'Tushar Sawant Commented on your post gggg','2020-01-31 19:14:49',0,'Comment_add',1),(89,66,46,26,0,'Tushar Sawant Commented on your post gggg','2020-01-31 19:14:51',0,'Comment_add',1),(90,66,46,26,0,'Tushar Sawant Commented on your post gggg','2020-01-31 19:15:08',0,'Comment_add',1),(91,66,46,26,0,'Tushar Sawant Commented on your post gggg','2020-01-31 19:15:20',0,'Comment_add',1),(92,66,46,26,0,'Tushar Sawant Commented on your post gggg','2020-01-31 19:15:21',0,'Comment_add',1),(93,66,46,25,0,'Tushar Sawant Commented on your post gggg','2020-01-31 19:15:32',0,'Comment_add',1),(94,66,46,26,0,'Tushar Sawant Commented on your post gggg','2020-01-31 19:15:40',0,'Comment_add',1),(95,66,46,26,0,'Tushar Sawant Commented on your post gggg','2020-01-31 19:15:55',0,'Comment_add',1),(96,66,46,26,0,'Tushar Sawant Commented on your post gggg','2020-01-31 19:16:09',0,'Comment_add',1),(97,66,46,26,0,'Tushar Sawant Commented on your post gggg','2020-01-31 19:17:21',0,'Comment_add',1),(98,66,46,26,0,'Tushar Sawant Commented on your post gggg','2020-01-31 19:17:24',0,'Comment_add',1),(99,66,46,26,0,'Tushar Sawant Commented on your post gggg','2020-01-31 19:17:24',0,'Comment_add',1),(100,66,46,26,0,'Tushar Sawant Commented on your post gggg','2020-01-31 19:17:42',0,'Comment_add',1),(101,66,46,26,0,'Tushar Sawant Commented on your post gggg','2020-01-31 19:17:43',0,'Comment_add',1),(102,66,46,26,0,'Tushar Sawant Commented on your post gggg','2020-01-31 19:17:43',0,'Comment_add',1),(103,66,46,26,0,'Tushar Sawant Commented on your post gggg','2020-01-31 19:17:43',0,'Comment_add',1),(104,66,46,26,0,'Tushar Sawant Commented on your post gggg','2020-01-31 19:18:55',0,'Comment_add',1),(105,66,46,26,0,'Tushar Sawant Commented on your post gggg','2020-01-31 19:18:55',0,'Comment_add',1),(106,66,46,26,0,'Tushar Sawant Commented on your post gggg','2020-01-31 19:18:55',0,'Comment_add',1),(107,66,46,26,0,'Tushar Sawant Commented on your post gggg','2020-01-31 19:18:57',0,'Comment_add',1),(108,66,46,26,0,'Tushar Sawant Commented on your post gggg','2020-01-31 19:19:00',0,'Comment_add',1),(109,66,46,25,0,'Tushar Sawant Commented on your post gggg','2020-01-31 19:19:11',0,'Comment_add',1),(110,66,46,25,0,'Tushar Sawant Commented on your post gggg','2020-01-31 19:19:11',0,'Comment_add',1),(111,66,46,25,0,'Tushar Sawant Commented on your post gggg','2020-01-31 19:19:19',0,'Comment_add',1),(112,66,46,25,0,'Tushar Sawant Commented on your post gggg','2020-01-31 19:19:22',0,'Comment_add',1),(113,66,46,26,0,'Tushar Sawant Commented on your post gggg','2020-01-31 19:19:34',0,'Comment_add',1),(114,66,46,26,0,'Tushar Sawant Commented on your post gggg','2020-01-31 19:19:34',0,'Comment_add',1),(115,2,2,21,0,'Bhaskar Kumar Commented on your post test','2020-01-31 20:13:34',0,'Comment_add',1),(116,2,2,21,0,'Bhaskar Kumar Commented on your post test','2020-01-31 20:13:37',0,'Comment_add',1),(117,2,2,21,0,'Bhaskar Kumar Commented on your post test','2020-01-31 20:13:43',0,'Comment_add',1),(118,2,2,21,0,'Bhaskar Kumar Commented on your post test','2020-01-31 20:13:44',0,'Comment_add',1),(119,2,2,21,0,'Bhaskar Kumar Commented on your post test','2020-01-31 20:14:01',0,'Comment_add',1),(120,2,2,21,0,'Bhaskar Kumar Commented on your post test','2020-01-31 20:14:03',0,'Comment_add',1),(121,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-01-31 20:15:15',0,'Comment_add',1),(122,2,2,21,0,'Bhaskar Kumar Commented on your post test','2020-01-31 20:15:19',0,'Comment_add',1),(123,2,2,21,0,'Bhaskar Kumar Commented on your post test','2020-01-31 20:15:21',0,'Comment_add',1),(124,2,2,21,0,'Bhaskar Kumar Commented on your post test','2020-01-31 20:38:13',0,'Comment_add',1),(125,2,2,21,0,'Bhaskar Kumar Commented on your post test','2020-01-31 20:38:21',0,'Comment_add',1),(126,2,2,21,0,'Bhaskar Kumar Commented on your post test','2020-01-31 20:40:12',0,'Comment_add',1),(127,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-01-31 20:41:53',0,'Comment_add',1),(128,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-01-31 20:42:42',0,'Comment_add',1),(129,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-01-31 20:42:42',0,'Comment_add',1),(130,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-01-31 20:42:43',0,'Comment_add',1),(131,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-01-31 20:42:43',0,'Comment_add',1),(132,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-01-31 20:42:44',0,'Comment_add',1),(133,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-01-31 20:42:44',0,'Comment_add',1),(134,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-01-31 20:42:45',0,'Comment_add',1),(135,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-01-31 20:42:45',0,'Comment_add',1),(136,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-01-31 20:42:45',0,'Comment_add',1),(137,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-01-31 20:43:06',0,'Comment_add',1),(138,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-01-31 20:43:07',0,'Comment_add',1),(139,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-01-31 20:43:07',0,'Comment_add',1),(140,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-01-31 20:43:07',0,'Comment_add',1),(141,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-01-31 20:43:07',0,'Comment_add',1),(142,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-01-31 20:48:29',0,'Comment_add',1),(143,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-01-31 20:48:32',0,'Comment_add',1),(144,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-01-31 20:48:34',0,'Comment_add',1),(145,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-01-31 20:48:36',0,'Comment_add',1),(146,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-01-31 20:48:36',0,'Comment_add',1),(147,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-01-31 20:48:37',0,'Comment_add',1),(148,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-01-31 20:48:37',0,'Comment_add',1),(149,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-01-31 20:48:38',0,'Comment_add',1),(150,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-01-31 20:48:39',0,'Comment_add',1),(151,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-01-31 20:48:39',0,'Comment_add',1),(152,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-01-31 20:48:39',0,'Comment_add',1),(153,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-01-31 20:48:39',0,'Comment_add',1),(154,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-01-31 20:48:40',0,'Comment_add',1),(155,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-01-31 20:48:40',0,'Comment_add',1),(156,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-01-31 20:48:41',0,'Comment_add',1),(157,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-01-31 20:48:42',0,'Comment_add',1),(158,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-01-31 20:48:42',0,'Comment_add',1),(159,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-01-31 20:48:43',0,'Comment_add',1),(160,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-01-31 20:48:45',0,'Comment_add',1),(161,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-01-31 20:48:45',0,'Comment_add',1),(162,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-01-31 20:48:45',0,'Comment_add',1),(163,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-01-31 20:48:45',0,'Comment_add',1),(164,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-01-31 20:48:45',0,'Comment_add',1),(165,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-01-31 20:48:45',0,'Comment_add',1),(166,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-01-31 20:48:47',0,'Comment_add',1),(167,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-01-31 20:48:47',0,'Comment_add',1),(168,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-01-31 20:48:47',0,'Comment_add',1),(169,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-01-31 20:48:48',0,'Comment_add',1),(170,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-01-31 20:48:48',0,'Comment_add',1),(171,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-01-31 20:48:49',0,'Comment_add',1),(172,2,2,21,0,'Bhaskar Kumar Commented on your post test','2020-01-31 20:50:02',0,'Comment_add',1),(173,2,2,21,0,'Bhaskar Kumar Commented on your post test','2020-01-31 20:50:04',0,'Comment_add',1),(174,2,2,21,0,'Bhaskar Kumar Commented on your post test','2020-01-31 20:50:07',0,'Comment_add',1),(175,2,2,21,0,'Bhaskar Kumar Commented on your post test','2020-01-31 20:50:48',0,'Comment_add',1),(176,2,2,21,0,'Bhaskar Kumar Commented on your post test','2020-01-31 20:51:07',0,'Comment_add',1),(177,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-01-31 20:54:04',0,'Comment_add',1),(178,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-01-31 20:54:34',0,'Comment_add',1),(179,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-01-31 20:55:29',0,'Comment_add',1),(180,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-01-31 20:55:52',0,'Comment_add',1),(181,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-01-31 20:56:03',0,'Comment_add',1),(182,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-01-31 20:56:04',0,'Comment_add',1),(183,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-02-01 03:32:23',0,'Comment_add',1),(184,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-02-01 03:36:11',0,'Comment_add',1),(185,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-02-01 03:41:57',0,'Comment_add',1),(186,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-02-01 03:45:54',0,'Comment_add',1),(187,2,46,27,0,'Tushar Sawant Added New Post YO BOI','2020-02-01 09:38:08',1,'post',1),(189,56,46,27,0,'Tushar Sawant Added New Post YO BOI','2020-02-01 09:38:08',0,'post',0),(190,66,46,27,0,'Tushar Sawant Added New Post YO BOI','2020-02-01 09:38:08',0,'post',1),(191,73,46,27,0,'Tushar Sawant Added New Post YO BOI','2020-02-01 09:38:08',0,'post',0),(192,2,46,28,0,'Tushar Sawant Added New Post yo boi 2','2020-02-01 09:39:52',1,'post',1),(194,56,46,28,0,'Tushar Sawant Added New Post yo boi 2','2020-02-01 09:39:52',0,'post',0),(195,66,46,28,0,'Tushar Sawant Added New Post yo boi 2','2020-02-01 09:39:52',0,'post',1),(196,73,46,28,0,'Tushar Sawant Added New Post yo boi 2','2020-02-01 09:39:52',0,'post',0),(197,46,66,29,0,'Mithilesh Hinge Added New Post Hi guys, new update from me!','2020-02-01 09:44:41',0,'post',1),(199,2,2,21,0,'Bhaskar Kumar Commented on your post test','2020-02-01 10:27:12',0,'Comment_add',1),(200,2,2,21,0,'Bhaskar Kumar Commented on your post test','2020-02-01 10:27:20',0,'Comment_add',1),(201,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-02-01 11:08:01',0,'Comment_add',1),(202,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-02-01 11:08:21',0,'Comment_add',1),(203,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-02-01 11:08:22',0,'Comment_add',1),(204,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-02-01 11:21:42',0,'Comment_add',1),(205,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-02-01 11:21:46',0,'Comment_add',1),(206,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-02-01 11:21:47',0,'Comment_add',1),(207,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-02-01 11:21:48',0,'Comment_add',1),(208,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-02-01 11:21:49',0,'Comment_add',1),(209,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-02-01 11:21:49',0,'Comment_add',1),(210,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-02-01 11:21:51',0,'Comment_add',1),(211,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-02-01 11:21:52',0,'Comment_add',1),(212,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-02-01 11:21:52',0,'Comment_add',1),(213,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-02-01 11:23:58',0,'Comment_add',1),(214,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-02-01 11:24:07',0,'Comment_add',1),(215,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-02-01 11:24:08',0,'Comment_add',1),(216,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-02-01 11:24:09',0,'Comment_add',1),(217,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-02-01 11:24:10',0,'Comment_add',1),(218,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-02-01 11:24:11',0,'Comment_add',1),(219,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-02-01 11:24:12',0,'Comment_add',1),(220,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-02-01 11:24:12',0,'Comment_add',1),(221,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-02-01 11:24:12',0,'Comment_add',1),(222,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-02-01 11:24:12',0,'Comment_add',1),(223,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-02-01 11:24:13',0,'Comment_add',1),(224,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-02-01 11:24:14',0,'Comment_add',1),(225,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-02-01 11:24:15',0,'Comment_add',1),(226,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-02-01 11:24:15',0,'Comment_add',1),(227,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-02-01 11:24:15',0,'Comment_add',1),(228,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-02-01 11:24:18',0,'Comment_add',1),(229,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-02-01 11:24:18',0,'Comment_add',1),(230,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-02-01 11:24:19',0,'Comment_add',1),(231,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-02-01 11:27:03',0,'Comment_add',1),(232,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-02-01 11:29:55',0,'Comment_add',1),(233,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-02-01 11:31:17',0,'Comment_add',1),(234,2,2,21,0,'Bhaskar Kumar Commented on your post test','2020-02-01 11:31:29',0,'Comment_add',1),(235,2,2,21,0,'Bhaskar Kumar Commented on your post test','2020-02-01 11:31:36',0,'Comment_add',1),(236,2,2,21,0,'Bhaskar Kumar Commented on your post test','2020-02-01 11:31:41',0,'Comment_add',1),(237,2,2,21,0,'Bhaskar Kumar Commented on your post test','2020-02-01 11:31:59',0,'Comment_add',1),(238,2,2,21,0,'Bhaskar Kumar Commented on your post test','2020-02-01 11:35:10',0,'Comment_add',1),(239,2,2,21,0,'Bhaskar Kumar Commented on your post test','2020-02-01 11:35:17',0,'Comment_add',1),(240,2,2,21,0,'Bhaskar Kumar Commented on your post test','2020-02-01 11:35:46',0,'Comment_add',1),(241,2,2,21,0,'Bhaskar Kumar Commented on your post test','2020-02-01 11:37:03',0,'Comment_add',1),(242,2,2,21,0,'Bhaskar Kumar Commented on your post test','2020-02-01 11:37:17',0,'Comment_add',1),(243,2,2,21,0,'Bhaskar Kumar Commented on your post test','2020-02-01 11:43:46',0,'Comment_add',1),(244,2,2,21,0,'Bhaskar Kumar Commented on your post test','2020-02-01 11:43:56',0,'Comment_add',1),(245,2,2,21,0,'Bhaskar Kumar Commented on your post test','2020-02-01 11:44:16',0,'Comment_add',1),(246,2,2,21,0,'Bhaskar Kumar Commented on your post test','2020-02-01 11:44:25',0,'Comment_add',1),(247,2,2,21,0,'Bhaskar Kumar Commented on your post test','2020-02-01 11:44:52',0,'Comment_add',1),(248,2,2,21,0,'Bhaskar Kumar Commented on your post test','2020-02-01 11:44:56',0,'Comment_add',1),(249,2,2,21,0,'Bhaskar Kumar Commented on your post test','2020-02-01 11:45:00',0,'Comment_add',1),(250,2,2,21,0,'Bhaskar Kumar Commented on your post test','2020-02-01 11:45:02',0,'Comment_add',1),(251,2,2,21,0,'Bhaskar Kumar Commented on your post test','2020-02-01 11:46:54',0,'Comment_add',1),(252,2,2,21,0,'Bhaskar Kumar Commented on your post test','2020-02-01 11:48:30',0,'Comment_add',1),(253,2,2,21,0,'Bhaskar Kumar Commented on your post test','2020-02-01 11:49:41',0,'Comment_add',1),(254,2,2,21,0,'Bhaskar Kumar Commented on your post test','2020-02-01 11:54:06',0,'Comment_add',1),(255,2,2,21,0,'Bhaskar Kumar Commented on your post test','2020-02-01 11:54:49',0,'Comment_add',1),(256,2,2,21,0,'Bhaskar Kumar Commented on your post test','2020-02-01 11:56:01',0,'Comment_add',1),(257,2,2,21,0,'Bhaskar Kumar Commented on your post test','2020-02-01 11:57:35',0,'Comment_add',1),(258,2,2,21,0,'Bhaskar Kumar Commented on your post test','2020-02-01 11:57:44',0,'Comment_add',1),(259,2,2,21,0,'Bhaskar Kumar Commented on your post test','2020-02-01 11:59:44',0,'Comment_add',1),(260,2,2,21,0,'Bhaskar Kumar Commented on your post test','2020-02-01 11:59:53',0,'Comment_add',1),(261,2,2,21,0,'Bhaskar Kumar Commented on your post test','2020-02-01 12:00:04',0,'Comment_add',1),(262,2,2,21,0,'Bhaskar Kumar Commented on your post test','2020-02-01 12:00:24',0,'Comment_add',1),(263,2,2,21,0,'Bhaskar Kumar Commented on your post test','2020-02-01 12:01:11',0,'Comment_add',1),(264,2,2,21,0,'Bhaskar Kumar Commented on your post test','2020-02-01 12:01:19',0,'Comment_add',1),(265,2,2,21,0,'Bhaskar Kumar Commented on your post test','2020-02-01 12:02:11',0,'Comment_add',1),(266,2,2,21,0,'Bhaskar Kumar Commented on your post test','2020-02-01 12:02:24',0,'Comment_add',1),(267,2,2,21,0,'Bhaskar Kumar Commented on your post test','2020-02-01 12:06:10',0,'Comment_add',1),(268,2,2,21,0,'Bhaskar Kumar Commented on your post test','2020-02-01 12:06:26',0,'Comment_add',1),(269,2,2,21,0,'Bhaskar Kumar Commented on your post test','2020-02-01 12:06:44',0,'Comment_add',1),(270,2,2,21,0,'Bhaskar Kumar Commented on your post test','2020-02-01 18:10:21',0,'Comment_add',1),(271,2,2,21,0,'Bhaskar Kumar Commented on your post test','2020-02-01 18:10:24',0,'Comment_add',1),(272,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-02-01 18:10:37',0,'Comment_add',1),(273,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-02-01 18:15:07',0,'Comment_add',1),(274,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-02-01 18:15:13',0,'Comment_add',1),(275,46,66,6,0,'Mithilesh Hinge Commented on your post 123456','2020-02-07 14:55:55',0,'Comment_add',1),(276,46,66,6,0,'Mithilesh Hinge Commented on your post 123456','2020-02-07 14:56:00',0,'Comment_add',1),(277,46,66,6,0,'Mithilesh Hinge Commented on your post 123456','2020-02-07 14:56:15',0,'Comment_add',1),(281,2,46,30,0,'Tushar Sawant Added New Post digital trends - internet connectivity','2020-02-07 15:12:02',1,'post',1),(283,56,46,30,0,'Tushar Sawant Added New Post digital trends - internet connectivity','2020-02-07 15:12:02',0,'post',0),(284,66,46,30,0,'Tushar Sawant Added New Post digital trends - internet connectivity','2020-02-07 15:12:02',0,'post',1),(285,73,46,30,0,'Tushar Sawant Added New Post digital trends - internet connectivity','2020-02-07 15:12:02',0,'post',0),(290,73,66,0,10,'Mithilesh Hinge Paid 50.00 for your Tier 1st level','2020-02-07 15:27:09',0,'payment',0),(291,46,66,0,7,'Mithilesh Hinge Paid 2000.00 for your Tier mehenga','2020-02-07 15:33:25',0,'payment',1),(292,2,2,1,0,'Bhaskar Kumar Commented on your post Apana Time Aayega','2020-02-07 19:21:37',0,'Comment_add',1),(293,46,46,28,0,'Tushar Sawant Commented on your post yo boi 2','2020-02-08 14:18:16',0,'Comment_add',1),(294,2,46,0,1,'Tushar Sawant Paid 50.00 for your Tier Apana Time Ayega','2020-02-08 18:40:44',1,'payment',1),(295,66,46,0,16,'Tushar Sawant Paid 2500.00 for your Tier 2nd','2020-02-08 19:42:06',0,'payment',1),(296,73,2,0,10,'Bhaskar Kumar Paid 50.00 for your Tier 1st level','2020-02-08 19:49:27',0,'payment',0),(297,46,46,6,0,'Tushar Sawant Like your post 123456','2020-02-08 19:49:32',0,'like',1),(298,46,66,0,7,'Mithilesh Hinge Paid 2000.00 for your Tier mehenga','2020-02-08 20:29:19',0,'payment',1),(299,2,66,0,1,'Mithilesh Hinge Paid 50.00 for your Tier Apana Time Ayega','2020-02-08 20:44:17',1,'payment',1),(300,46,2,0,4,'Bhaskar Kumar Paid 50.00 for your Tier sasta','2020-02-08 21:15:21',0,'payment',1),(301,73,46,0,11,'Tushar Sawant Paid 100.00 for your Tier 1st level-2','2020-02-08 22:06:06',0,'payment',0),(302,73,2,0,12,'Bhaskar Kumar Paid 150.00 for your Tier 2nd level','2020-02-08 22:08:21',0,'payment',0),(303,66,66,26,0,'Mithilesh Hinge Commented on your post gggg','2020-02-08 23:19:17',0,'Comment_add',1),(304,66,66,26,0,'Mithilesh Hinge Commented on your post gggg','2020-02-08 23:19:22',0,'Comment_add',1),(305,66,66,26,0,'Mithilesh Hinge Commented on your post gggg','2020-02-08 23:27:17',0,'Comment_add',1),(306,66,66,26,0,'Mithilesh Hinge Commented on your post gggg','2020-02-08 23:27:23',0,'Comment_add',1),(307,66,46,26,0,'Tushar Sawant testTest Commented on your post gggg','2020-02-09 02:23:44',1,'Comment_add',1),(308,66,46,26,0,'Tushar Sawant testTest Like your post gggg','2020-02-09 02:24:55',1,'like',1),(309,66,46,26,0,'Tushar Sawant testTest Like your post gggg','2020-02-09 02:25:10',1,'like',1),(310,66,46,26,0,'Tushar Sawant testTest Like your post gggg','2020-02-09 02:28:04',1,'like',1),(311,66,46,26,0,'Tushar Sawant testTest Like your post gggg','2020-02-09 02:28:24',1,'like',1),(312,66,66,26,0,'Mithilesh Hinge Commented on your post gggg','2020-02-09 02:30:18',0,'Comment_add',1),(313,66,66,26,0,'Mithilesh Hinge Commented on your post gggg','2020-02-09 02:30:32',0,'Comment_add',1),(314,46,46,30,0,'Tushar Sawant testTest Like your post digital trends - internet connectivity','2020-02-09 19:57:40',0,'like',1),(315,46,46,28,0,'Tushar Sawant testTest Like your post yo boi 2','2020-02-09 19:57:43',0,'like',1),(316,46,46,7,0,'Tushar Sawant testTest Like your post dsfghjk','2020-02-09 19:57:47',0,'like',1),(317,46,46,7,0,'Tushar Sawant testTest Like your post dsfghjk','2020-02-09 19:57:52',0,'like',1),(318,46,46,4,0,'Tushar Sawant testTest Like your post 1','2020-02-09 19:57:59',0,'like',1),(319,46,46,3,0,'Tushar Sawant testTest Like your post 2nd post 50 rupay','2020-02-09 19:58:03',0,'like',1),(320,46,46,2,0,'Tushar Sawant testTest Like your post 1st','2020-02-09 19:58:06',0,'like',1),(321,46,68,28,0,'Rohit Choudhari Commented on your post yo boi 2','2020-02-10 09:50:47',0,'Comment_add',1),(322,46,68,28,0,'Rohit Choudhari Commented on your post yo boi 2','2020-02-10 09:56:44',0,'Comment_add',1),(323,46,46,28,0,'Tushar Sawant Commented on your post yo boi 2','2020-02-10 09:59:58',0,'Comment_add',1),(324,46,46,28,0,'Tushar Sawant Like your comment onyo boi 2','2020-02-10 10:00:48',0,'comment_like',1),(325,46,68,2,0,'Rohit Choudhari Commented on your post 1st','2020-02-10 10:01:48',0,'Comment_add',1),(326,66,66,26,0,'Mithilesh Hinge Like your post gggg','2020-02-10 10:08:41',0,'like',1),(327,66,2,26,0,'hello world Like your comment ongggg','2020-02-10 10:15:11',1,'comment_like',1),(328,66,66,26,0,'Mithilesh Hinge Like your comment ongggg','2020-02-10 10:20:09',0,'comment_like',1),(329,66,66,26,0,'Mithilesh Hinge Commented on your post gggg','2020-02-10 10:20:16',0,'Comment_add',1),(330,46,66,27,0,'Mithilesh Hinge Commented on your post YO BOI','2020-02-10 10:22:25',0,'Comment_add',1),(331,46,66,27,0,'Mithilesh Hinge Commented on your post YO BOI','2020-02-10 10:23:15',0,'Comment_add',1),(332,66,66,26,0,'Mithilesh Hinge Like your comment ongggg','2020-02-10 10:32:25',0,'comment_like',1),(333,66,66,26,0,'Mithilesh Hinge Like your comment ongggg','2020-02-10 10:32:31',0,'comment_like',1),(334,66,66,26,0,'Mithilesh Hinge Commented on your post gggg','2020-02-10 10:32:40',0,'Comment_add',1),(335,46,66,30,0,'Mithilesh Hinge Commented on your post digital trends - internet connectivity','2020-02-10 10:33:28',1,'Comment_add',1),(336,46,66,30,0,'Mithilesh Hinge Commented on your post digital trends - internet connectivity','2020-02-10 10:37:18',1,'Comment_add',1),(337,46,66,30,0,'Mithilesh Hinge Commented on your post digital trends - internet connectivity','2020-02-10 10:52:10',1,'Comment_add',1),(338,46,68,28,0,'Rohit Choudhari Commented on your post yo boi 2','2020-02-10 11:07:02',1,'Comment_add',1),(339,46,46,28,0,'Tushar Sawant Commented on your post yo boi 2','2020-02-10 11:09:03',0,'Comment_add',1),(340,46,46,28,0,'Tushar Sawant Commented on your post yo boi 2','2020-02-10 11:27:58',0,'Comment_add',1),(341,46,46,28,0,'Tushar Sawant Commented on your post yo boi 2','2020-02-10 11:29:30',0,'Comment_add',1),(342,66,66,26,0,'Mithilesh Hinge Like your post gggg','2020-02-11 12:27:02',0,'like',1),(343,66,66,26,0,'Mithilesh Hinge Like your post gggg','2020-02-11 12:27:07',0,'like',1),(344,66,66,26,0,'Mithilesh Hinge Like your post gggg','2020-02-11 12:27:16',0,'like',1),(345,66,66,26,0,'Mithilesh Hinge Like your post gggg','2020-02-11 12:27:25',0,'like',1),(346,66,66,26,0,'Mithilesh Hinge Like your post gggg','2020-02-11 12:29:59',0,'like',1),(347,66,66,26,0,'Mithilesh Hinge Like your post gggg','2020-02-11 12:30:09',0,'like',1),(348,66,66,26,0,'Mithilesh Hinge Like your post gggg','2020-02-11 12:32:56',0,'like',1),(349,66,66,26,0,'Mithilesh Hinge Like your post gggg','2020-02-11 12:32:59',0,'like',1),(350,66,66,26,0,'Mithilesh Hinge Like your post gggg','2020-02-11 12:33:02',0,'like',1),(351,66,46,25,0,'Tushar Sawant Commented on your post gggg','2020-02-11 21:43:41',1,'Comment_add',1),(352,66,66,25,0,'Mithilesh Hinge Like your comment ongggg','2020-02-11 21:44:10',0,'comment_like',1),(353,66,66,25,0,'Mithilesh Hinge Commented on your post gggg','2020-02-11 21:44:36',0,'Comment_add',1),(354,46,66,30,0,'Mithilesh Hinge Commented on your post digital trends - internet connectivity','2020-02-11 21:46:13',1,'Comment_add',1),(355,66,66,25,0,'Mithilesh Hinge Like your post gggg','2020-02-11 22:00:43',0,'like',1),(356,66,66,25,0,'Mithilesh Hinge Like your post gggg','2020-02-11 22:00:55',0,'like',1),(357,2,2,1,0,'hello world Like your post Apana Time Aayega','2020-02-13 04:48:56',0,'like',1),(358,46,68,28,0,'Rohit Choudhari Like your post yo boi 2','2020-04-28 15:27:05',0,'like',1),(359,46,68,27,0,'Rohit Choudhari Like your post YO BOI','2020-04-28 15:27:12',0,'like',1),(360,46,68,30,0,'Rohit Choudhari Like your post digital trends - internet connectivity','2020-04-28 15:27:25',0,'like',1),(361,46,68,30,0,'Rohit Choudhari Like your post digital trends - internet connectivity','2020-04-28 15:27:30',0,'like',1),(362,46,68,30,0,'Rohit Choudhari Like your post digital trends - internet connectivity','2020-04-28 15:27:55',0,'like',1),(363,46,68,28,0,'Rohit Choudhari Commented on your post yo boi 2','2020-06-11 05:32:04',0,'Comment_add',1),(364,2,66,31,0,'Mithilesh Hinge Added New Post Raz tier test','2020-06-22 06:59:58',0,'post',0),(365,66,100,0,25,'CGP Grey Paid 50.00 for your Tier Update test update','2020-06-22 08:06:03',1,'payment',1),(366,66,100,0,25,'CGP Grey Paid 50.00 for your Tier Update test update','2020-06-22 08:20:12',1,'payment',1),(367,66,100,0,25,'CGP Grey Paid 50.00 for your Tier Update test update','2020-06-22 08:21:36',1,'payment',1),(368,66,100,0,26,'CGP Grey Paid 100.00 for your Tier Pact Upgrade test','2020-06-26 18:51:02',1,'payment',1),(369,66,100,33,0,'CGP Grey Like your post One time test','2020-06-26 23:49:32',0,'like',1),(370,66,100,0,25,'CGP Grey Paid 50.00 for your Tier Update test update','2020-06-27 00:33:27',0,'payment',1);
/*!40000 ALTER TABLE `impact_notification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `impact_pay_onetime`
--

DROP TABLE IF EXISTS `impact_pay_onetime`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `impact_pay_onetime` (
  `payment_id` bigint(20) NOT NULL DEFAULT '0',
  `transaction_id` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `creator_id` int(11) NOT NULL DEFAULT '0',
  `paid_amount` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `paid_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `post_id` int(11) NOT NULL,
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'created'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `impact_pay_onetime`
--

LOCK TABLES `impact_pay_onetime` WRITE;
/*!40000 ALTER TABLE `impact_pay_onetime` DISABLE KEYS */;
INSERT INTO `impact_pay_onetime` VALUES (0,'pay_F7MgrkY6bKNfNz',100,66,'70','2020-06-26 19:16:40',32,'order_F7MfMGZfIqruVt','success');
/*!40000 ALTER TABLE `impact_pay_onetime` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `impact_payment`
--

DROP TABLE IF EXISTS `impact_payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `impact_payment` (
  `payment_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `transaction_id` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `creator_id` int(11) NOT NULL DEFAULT '0',
  `tier_id` int(11) DEFAULT NULL,
  `subscription_id` varchar(255) DEFAULT NULL,
  `paid_amount` varchar(10) DEFAULT NULL,
  `paid_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(20) NOT NULL DEFAULT 'created',
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `impact_payment`
--

LOCK TABLES `impact_payment` WRITE;
/*!40000 ALTER TABLE `impact_payment` DISABLE KEYS */;
INSERT INTO `impact_payment` VALUES (43,'pay_F7MSgWWGZru38z',100,66,25,'sub_F7MKvRaOj2ZvDx','50.00','2020-06-29 11:46:42','cancelled');
/*!40000 ALTER TABLE `impact_payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `impact_post`
--

DROP TABLE IF EXISTS `impact_post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `impact_post` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `post_title` varchar(255) DEFAULT NULL,
  `description` text,
  `post_price` float(18,2) DEFAULT NULL,
  `post_type` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `video_link` varchar(255) DEFAULT NULL,
  `video_path` varchar(255) DEFAULT NULL,
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) DEFAULT '1',
  `video_type` varchar(255) DEFAULT NULL,
  `price_type` varchar(255) DEFAULT NULL,
  `tier_id` int(11) DEFAULT '0',
  `one_time_amount` varchar(255) DEFAULT '0.00',
  `slug` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `impact_post`
--

LOCK TABLES `impact_post` WRITE;
/*!40000 ALTER TABLE `impact_post` DISABLE KEYS */;
INSERT INTO `impact_post` VALUES (1,2,'Apana Time Aayega','&lt;p&gt;&lt;em&gt;Lorem ipsum&lt;/em&gt;, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought to have scrambled parts of Cicero&amp;#39;s De Finibus Bonorum et Malorum for use in a type specimen book.&lt;/p&gt;\r\n',NULL,'image','post/19069710451579093761blue-textured-background-1505272752YVV.jpg','','','2020-01-15 13:09:22',1,'','free',0,'','apana-time-aayega'),(2,46,'1st','',NULL,'image','post/20746045421579103276canada_flag.png','','','2020-01-15 15:47:56',1,'','free',0,'','1st'),(3,46,'2nd post 50 rupay','',NULL,'image','post/21114180431579103358austraila.png','','','2020-01-15 15:49:18',1,'','tier',4,'','2nd-post-50-rupay'),(4,46,'1','&lt;p&gt;arey bawa mast&lt;/p&gt;\r\n',NULL,'image','post/25084500515791034301280px-Flag_of_Japan.png','','','2020-01-15 15:50:30',1,'','tier',6,'','1'),(5,46,'2000','',NULL,'image','post/747241381579103530channels4_banner.jpg','','','2020-01-15 15:52:10',1,'','tier',7,'','2000'),(6,46,'123456','',NULL,'image','post/8143753071579105493usa_flag.png','','','2020-01-15 16:24:53',1,'','tier',8,'','123456'),(7,46,'dsfghjk','&lt;p&gt;fghj&lt;/p&gt;\r\n',NULL,'image','post/14807670621579105767rt2.jpg','','','2020-01-15 16:29:27',1,'','tier',9,'','dsfghjk'),(8,73,'jus likit','',NULL,'image','post/113004402315791119841.jpeg','','','2020-01-15 18:13:04',1,'','tier',10,'','jus-likit'),(9,73,'jus barkatit','',NULL,'image','post/69035998615791120702.jpg','','','2020-01-15 18:14:30',1,'','tier',11,'','jus-barkatit'),(10,73,'jus hide','',NULL,'image','post/40647654915791121703.jpg','','','2020-01-15 18:16:10',1,'','tier',12,'','jus-hide'),(11,73,'jus lik ewww','',NULL,'image','post/184339200715791122644.jpg','','','2020-01-15 18:17:44',1,'','tier',13,'','jus-lik-ewww'),(12,73,'jus humpit','',NULL,'image','post/73688101315791123005.jpg','','','2020-01-15 18:18:20',1,'','tier',14,'','jus-humpit'),(20,66,'qwerty','&lt;p&gt;kuch likhna&lt;/p&gt;\r\n',NULL,'image','post/21330715751579365707RTG1.jpg','','','2020-01-18 16:41:47',1,'','tier',15,'','qwerty-2'),(21,2,'test','',NULL,'other','post/84580838715799436271579943627.docx','','','2020-01-25 09:13:47',1,'','one_time',0,'300','test'),(25,66,'gggg','',NULL,'image','post/3895703941580213140untitled-1.png','','','2020-01-29 00:35:40',1,'','free',0,'','gggg1580213140'),(26,66,'gggg','',NULL,'image','post/17522824641580213202pie.png','','','2020-01-29 00:36:42',1,'','free',0,'','gggg1580213202'),(27,46,'YO BOI','',NULL,'image','post/1142357091580504887Thumbnail_(1).jpg','','','2020-02-01 09:38:08',1,'','tier',4,'','yo-boi1580504888'),(28,46,'yo boi 2','',NULL,'image','post/17792847231580504991photo_salo.jpg','','','2020-02-01 09:39:52',1,'','free',0,'','yo-boi-21580504992'),(29,66,'Hi guys, new update from me!','&lt;p&gt;Been working on this new concept since last week. Let me know in the comments which one you like!&lt;/p&gt;\r\n',NULL,'image','post/182811536215805052811*qDoqw_r6PAbmKN5BzpeUDw.png','','','2020-02-01 09:44:41',1,'','tier',16,'','hi-guys-new-update-from-me1580505281'),(30,46,'digital trends - internet connectivity','&lt;p&gt;vhg hg h hbnbv njk&lt;/p&gt;\r\n',NULL,'image','post/4144148221581043322Screenshot_2020-02-02_at_11.16.36_AM.png','','','2020-02-07 15:12:02',1,'','tier',7,'','digital-trends---internet-connectivity1581043322'),(31,66,'Raz tier test','&lt;p&gt;Savage scene from Bojack&lt;/p&gt;\r\n',NULL,'video','','','video/15353851921592789343.mp4','2020-06-22 06:59:57',1,'file','tier',25,'','raz-tier-test1592789397'),(32,66,'Kyubii','&lt;p&gt;Naruto Nine tails&lt;/p&gt;\r\n',NULL,'image','post/7762791971593181511naruto_kyuubi.jpg','','','2020-06-26 19:55:11',1,'','one_time',0,'70','kyubii1593181511'),(33,66,'One time test','&lt;p&gt;Squirrel macro&lt;/p&gt;\r\n',NULL,'other','post/154768514415931954741593195474.jpg','','','2020-06-26 23:47:54',1,'','one_time',0,'200','one-time-test1593195474');
/*!40000 ALTER TABLE `impact_post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `impact_tier`
--

DROP TABLE IF EXISTS `impact_tier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `impact_tier` (
  `tier_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `tier_name` varchar(255) DEFAULT NULL,
  `tier_price` float(18,2) DEFAULT NULL,
  `description` text,
  `impact_limit` varchar(150) DEFAULT NULL,
  `create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) DEFAULT '1',
  `plan_id` varchar(255) NOT NULL,
  PRIMARY KEY (`tier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `impact_tier`
--

LOCK TABLES `impact_tier` WRITE;
/*!40000 ALTER TABLE `impact_tier` DISABLE KEYS */;
INSERT INTO `impact_tier` VALUES (25,66,'Update test update',50.00,'6 months updated','1000','2020-06-20 01:47:28',1,'plan_F4hc2VS9MNlMRz'),(26,66,'Pact Upgrade test',100.00,'30 years','','2020-06-25 14:43:31',1,'plan_F6tVOSaeEC1cQv'),(27,66,'Upgrade test 2',200.00,'30 years','','2020-06-25 14:44:45',1,'plan_F6tWhYZ28gREWA');
/*!40000 ALTER TABLE `impact_tier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `impact_user`
--

DROP TABLE IF EXISTS `impact_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `impact_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_number` varchar(150) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `email_id` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `registration_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `last_log_in_date` datetime DEFAULT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `hash_active` enum('Y','N') DEFAULT 'N',
  `status` int(11) DEFAULT '0',
  `user_type` varchar(255) DEFAULT NULL,
  `reg_type` varchar(255) DEFAULT NULL,
  `oauth_provider` varchar(255) DEFAULT NULL,
  `oauth_id` varchar(255) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `register_ip` varchar(255) DEFAULT NULL,
  `impact_name` varchar(255) DEFAULT NULL,
  `creating_for` varchar(255) DEFAULT NULL,
  `tag_type` varchar(50) DEFAULT NULL,
  `tag_line` text,
  `slug` varchar(255) DEFAULT NULL,
  `cover_image_path` varchar(255) DEFAULT NULL,
  `earning_visibility` int(11) DEFAULT NULL,
  `patronage_visibility` int(11) DEFAULT NULL,
  `about_page` text,
  `intro_video` varchar(255) DEFAULT NULL,
  `thanks_message` text,
  `review_status` int(11) DEFAULT '0',
  `review_submit_status` int(11) DEFAULT '0',
  `review_submit_date` datetime DEFAULT NULL,
  `about_you` text,
  `goal_type` varchar(55) DEFAULT NULL,
  `active_status` int(11) NOT NULL DEFAULT '1',
  `bank_name` varchar(255) DEFAULT NULL,
  `bank_holder_name` varchar(255) DEFAULT NULL,
  `account_number` varchar(255) DEFAULT NULL,
  `ifsc_code` varchar(255) DEFAULT NULL,
  `upi_id` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `impact_user`
--

LOCK TABLES `impact_user` WRITE;
/*!40000 ALTER TABLE `impact_user` DISABLE KEYS */;
INSERT INTO `impact_user` VALUES (2,NULL,NULL,NULL,'Bhaskar Kumar 2','bhaskar2359@gmail.com','123','2019-08-31 13:08:31','2019-09-09 12:45:58','dc16ef0812b88742f631b04c22fc2ce2','Y',1,'ucreate','user',NULL,NULL,'user/189170921581168650Chrysanthemum.jpg','::1','hello world','application','1','hello world is creating application','bhaskar','user/16982293551569216884images.jpg',0,0,'&lt;p&gt;This is the first thing potential patrons will see when they land on your page, so make sure you paint a compelling picture of how they can join you on this journey.&lt;/p&gt;\r\n','https://www.youtube.com/watch?v=za3woSwozUE','<p>Thanks For Message</p>\r\n',1,1,'2019-09-03 01:37:10','&lt;p&gt;Hello About Myself&lt;/p&gt;\r\n','earning',1,'Test','uyu','555588777','u','iuy',''),(46,'10000001','Tushar','Sawant','Tushar Sawant','tsrsawant@gmail.com','31434','2019-09-14 01:44:05','2019-09-14 01:44:05','35c50a9cfd3365991f743aa2f83a3365','Y',1,'ucreate','facebook','facebook','2423460781201247','user/121251327215812827592-cute-baby-octopus-cartoon-clipart.jpg','157.33.61.169','Tushar Sawant','Podcast','1','Tushar Sawant is creating Podcast','randompodcast','user/18031093731570201922h4.jpg',0,1,'&lt;p&gt;yo bois I am singing song&lt;/p&gt;\r\n\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n','',NULL,1,1,'2019-09-14 14:21:06','&lt;p&gt;This is Tushar Sawant and someday it would be Sunday and i will sleep&lt;/p&gt;\r\n','community',1,'RRR','jkghk','1321345436','425365','8796897','2shar_sawant'),(49,'10000004','Tushar','Sawant','Tushar Sawant','tsrsawant@gmail.com','37854','2019-09-14 02:48:53','2019-09-14 02:48:53','35c50a9cfd3365991f743aa2f83a3365','Y',1,'create','facebook','facebook','2423460781201247','user/14111543351581282805style.jpg','123.201.116.250','Tushar Sawant',NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,0,0,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL),(54,'10000009','Ritesh','Murkute','Ritesh Murkute','ritesh.murkute@gmail.com','20915','2019-09-14 05:15:03','2019-09-14 05:15:03','a5d746c084f91a0341c24ee4cafbce9f','Y',1,'create','facebook','facebook','2656627404388367','user/fb/2656627404388367.jpg','123.201.116.238','Ritesh Murkute',NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,0,0,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL),(55,'10000010',NULL,NULL,'akshay bhoyar','akshaybhoyar65@gmail.com','akshay@1996','2019-09-16 09:52:39',NULL,'57c6c0f10ff4ecdb08161e06fd4b4b8f','Y',1,'create','user',NULL,NULL,NULL,'123.201.54.249','akshay bhoyar',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL),(56,'10000011','Ritesh','Murkute','Ritesh Murkute','ritesh.murkute@gmail.com','10026','2019-09-15 22:13:01','2019-09-15 22:13:01','a5d746c084f91a0341c24ee4cafbce9f','Y',1,'ucreate','facebook','facebook','2656627404388367','user/fb/2656627404388367.jpg','123.201.54.249','Ritesh Murkute','Videos',NULL,'Ritesh Murkute is creating Videos','','user/18113802591578907605flowing-blue-abstract-texture.jpg',0,0,'&lt;p&gt;Hi I am Ritesh a Music Creator.&lt;/p&gt;\r\n','https://www.youtube.com/watch?v=pddbaGV0dZI',NULL,1,1,'2019-09-17 10:58:02','&lt;p&gt;Hi This is my first appereance on Impact me&amp;nbsp;&lt;/p&gt;\r\n','earning',1,NULL,NULL,NULL,NULL,NULL,NULL),(57,'10000012','Chetan','Tawale','Chetan Tawale','chetan.tawale@gmail.com','33863','2019-09-15 22:26:49','2019-09-15 22:26:49','80aece9c98842beff58393bd1078a0b2','Y',1,'create','facebook','facebook','10211523257316210','user/fb/10211523257316210.jpg','123.201.54.249','Chetan Tawale',NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,0,0,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL),(58,'10000013','Chetan','Tawale','Chetan Tawale','chetan.tawale@gmail.com','32574','2019-09-15 22:32:01','2019-09-15 22:32:01','80aece9c98842beff58393bd1078a0b2','Y',1,'ucreate','facebook','facebook','10211523257316210','user/fb/10211523257316210.jpg','123.201.54.249','Chetan Tawale',NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,0,0,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL),(59,'10000014','Akshay','Bhoyar','Akshay Bhoyar','','69743','2019-09-18 00:32:23','2019-09-18 00:32:23','d41d8cd98f00b204e9800998ecf8427e','Y',1,'ucreate','facebook','facebook','2351773951756825','user/fb/2351773951756825.jpg','123.201.54.182','Akshay Bhoyar',NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,0,0,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL),(61,'10000015','Akshay','Bhoyar','Akshay Bhoyar','','18289','2019-09-19 03:28:11','2019-09-19 03:28:11','d41d8cd98f00b204e9800998ecf8427e','Y',1,'create','facebook','facebook','2351773951756825','user/fb/2351773951756825.jpg','123.201.54.5','Akshay Bhoyar',NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,0,0,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL),(62,'10000016',NULL,NULL,'Mithilesh Hinge','mithhinge@gmail.com','blahblahblah','2019-09-19 16:07:52',NULL,'16ef60fd3c4a7a00c0b17883b53e3c66','Y',1,'create','user',NULL,NULL,NULL,'123.201.54.5','Mithilesh Hinge',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL),(63,'10000017',NULL,NULL,'Chetan Tawale','info@webstacktechno.com','chetan123','2019-09-21 15:39:47',NULL,'d887aa854dd16cd0c53b6c36263c5f46','Y',1,'ucreate','user',NULL,NULL,'user/2529719781569060962WebStackTechnologies_final_logo_icon-01.jpg','123.201.54.78','Chetan Tawale','Website',NULL,'Chetan Tawale is creating Website','','user/3598192241569060962hp.jpg',1,1,'<p>Many creators on Patreon have both a text and video description for their page. This combo is incredibly motivating for fans &mdash; it shows how real this is to you and how much you value their participation in your journey.</p>\r\n','',NULL,0,1,'2019-09-21 15:49:28',NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL),(64,'10000018','Bhaskar','Kumar','Bhaskar Kumar','bhaskar2359@gmail.com','39694','2019-09-21 03:18:01','2019-09-21 03:18:01','dc16ef0812b88742f631b04c22fc2ce2','Y',1,'create','facebook','facebook','10218101520521421','user/3226923981581168614bc53ac9c054e57cd2e0334b109d7bebf.jpg','202.142.80.198','Bhaskar Kumar',NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,0,0,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL),(65,'10000019',NULL,NULL,'mayuri dandhare','mayuridandhare07@gmail.com','mayu','2019-09-21 15:57:37',NULL,'1a689502d7a7caef9d050fe013107b68','Y',1,'create','user',NULL,NULL,NULL,'123.201.54.78','mayuri dandhare',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL),(66,'10000020','','','Test','mithhinge@gmail.com','blahblahblah','2019-10-17 11:33:29',NULL,'16ef60fd3c4a7a00c0b17883b53e3c66','Y',1,'ucreate','user',NULL,NULL,'user/8581210341592597503IMG_20200310_200517.jpg','123.201.116.65','Mithilesh Hinge','videos','1','Mithilesh Hinge is creating videos','','user/17994501911578570780Screenshot_2019-12-25_at_1.41.37_PM.png',1,1,'&lt;p&gt;Many creators on Patreon have both a text and video description for their page. This combo is incredibly motivating for fans &amp;mdash; it shows how real this is to you and how much you value their participation in your journey.&lt;/p&gt;\r\n','',NULL,1,1,'2019-10-17 11:35:10','&lt;p&gt;ajhsbdjas djasd ja sjdhba jsdabhsd wend wje dwbe dwmeb dfwbe dcwedbw edwebdc wbe cfbwe cfbw debcfw debcf wdbc fwbed cwbe dwbe fcwe bwe fbwe dcbw ecfwm efc,wme dcmwbe d&lt;/p&gt;\r\n',NULL,1,'bjhgjv','jygvhvm','756765','jhgv','yjfjgv','mithileshhinge'),(67,'10000021',NULL,NULL,'akshay','akshay@gmail.com','1234','2019-10-22 11:21:56',NULL,'83862d1e9449aee54ad8bb3a11632bbe','N',0,'create','user',NULL,NULL,NULL,'175.100.139.85','akshay',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL),(68,'10000022','Rohit','Choudhari','Rohit Choudhari','rohit.choudhari1@gmail.com','51983','2019-11-21 04:38:45','2019-11-21 04:38:45','de4814870a7dc6aabfe47b42c8c9cd00','Y',1,'create','facebook','facebook','2641078149285173','user/fb/2641078149285173.jpg','42.106.116.26','Rohit Choudhari',NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,0,0,NULL,'&lt;p&gt;Hi There I am new here&lt;/p&gt;\r\n',NULL,1,NULL,NULL,NULL,NULL,NULL,NULL),(69,'10000023',NULL,NULL,'Pranav Mutharia','pranav.mutharia@gmail.com','iamtherock','2019-11-21 18:33:15',NULL,'0c0181559574e33bc49b648326377f1a','N',0,'ucreate','user',NULL,NULL,NULL,'49.207.50.35','Pranav Mutharia',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL),(70,'10000024',NULL,NULL,'Atharva Jumde','atharvajumde@gmail.com','123456789','2019-11-22 20:14:48',NULL,'6b8882fa8fcf4d89fcba5b2fa5d52184','N',0,'create','user',NULL,NULL,NULL,'106.79.184.185','Atharva Jumde',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL),(71,'10000025','Salu','Girhepuje','Salu Girhepuje','salonigirhepuje@gmail.com','96863','2019-11-22 07:51:40','2019-11-22 07:51:40','6a4d9fdfa7b97d33663ddf6c2f81d11c','Y',1,'create','facebook','facebook','2495327527182259','user/fb/2495327527182259.jpg','106.220.186.168','Salu Girhepuje',NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,0,0,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL),(72,'10000026',NULL,NULL,'Palash Wankar','palashwankar@gmail.com','qwertyuiop123','2019-12-11 20:42:58',NULL,'5097c462784af669706297a1452aaf7b','Y',1,'create','user',NULL,NULL,NULL,'101.53.139.165','Palash Wankar',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL),(73,'10000027','','','Palash Wankar','palashwankar@gmail.com','qwertyuiop123','2019-12-11 20:53:30',NULL,'5097c462784af669706297a1452aaf7b','Y',1,'ucreate','user',NULL,NULL,'user/38018751576079722WhatsApp_Image_2019-12-07_at_3.34.58_PM.jpeg','101.53.139.165','Joker','Jokes',NULL,'Joker is creating Jokes','wankar','user/16883731601576079154Screenshot_20180921-013310__01.png',1,1,'&lt;pre id=&quot;p2&quot;&gt;\r\ngenius billionaire playboy philanthropist&lt;/pre&gt;\r\n','','&lt;p&gt;thank you&lt;/p&gt;\r\n',1,1,'2019-12-11 21:27:08',NULL,'earning',1,NULL,NULL,NULL,NULL,NULL,NULL),(74,'10000028',NULL,NULL,'Georgegrimi','inbox413@glmux.com','bS6d%2xn8wE','2020-01-09 02:08:26',NULL,'460a429f95522cd63f356f525c4757bd','N',0,'create','user',NULL,NULL,NULL,'195.154.182.89','Georgegrimi',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL),(76,'10000030',NULL,NULL,'Random Guy','ideletethescam@gmail.com','qwertyuiop','2020-01-15 14:40:14',NULL,'05395eda7c0a994172960c01206fe05b','N',0,'create','user',NULL,NULL,NULL,'157.33.167.133','Random Guy',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL),(77,'10000031',NULL,NULL,'Himanshu Kulawe','loversfortheone@gmail.com','himans96','2020-01-20 23:29:25',NULL,'47efcd74d100c2068a82c0f5cc8ad260','Y',1,'create','user',NULL,NULL,NULL,'103.229.26.204','Himanshu Kulawe',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL),(78,'10000032','Shreyash','Ashtikar','Shreyash Ashtikar','ashtikarshreyas@gmail.com','52715','2020-01-28 06:18:47','2020-01-28 06:18:47','2bfced588e7c484976204753b0dd0e81','Y',1,'ucreate','facebook','facebook','1747303205411335','user/fb/1747303205411335.jpg','157.33.244.239','Shreyash Ashtikar',NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,0,0,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL),(79,'10000033',NULL,NULL,'Roopam','roopam_s@nid.edu','indianss22','2020-01-31 15:10:13',NULL,'d2d09319c956993f03c54ca10a488580','N',1,'create','user',NULL,NULL,NULL,'157.45.224.128','Roopam',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL),(80,'10000034',NULL,NULL,'Eurus','mikasaeagle@gmail.com','impactme','2020-02-02 22:20:13',NULL,'9c9efaa3a5e3ceb44ccdced81a9bda35','N',0,'create','user',NULL,NULL,NULL,'111.125.221.10','Eurus',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL),(81,'10000035',NULL,NULL,'JamesPaymn','s.z.y.m.anskiashley5@gmail.com','#6wto9y3QxQ','2020-02-09 05:00:36',NULL,'7293906b94153eb2cc753285c47380df','N',0,'create','user',NULL,NULL,NULL,'51.15.15.164','JamesPaymn',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL),(82,'10000036',NULL,NULL,'Yogesh','yog_xyz@gmail.com','yogesh123','2020-02-27 11:14:08',NULL,'e7ad3b60ca9852098ebfe4da93b35bd5','N',0,'create','user',NULL,NULL,NULL,'203.81.241.153','Yogesh',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL),(83,'10000037','Fiona','Fiona','Fiona ','iamfionafake@gmail.com','61031','2020-03-05 04:16:51','2020-03-05 04:16:51','eab9d946dfdf15ccff4c568e03eaf952','Y',1,'create','facebook','facebook','1001543959336','user/fb/1001543959336.jpg','199.201.66.0','Fiona ',NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,0,0,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL),(84,'10000038',NULL,NULL,'Saurav Naidu','saurav.naidu98@gmail.com','Aforever2behold','2020-04-12 13:46:57',NULL,'2baf7ca566fbe37211170d36db45a298','Y',1,'ucreate','user',NULL,NULL,NULL,'49.35.44.204','Saurav Naidu',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL),(85,'10000039',NULL,NULL,'Test','test@test.com','test@123','2020-04-25 16:24:03',NULL,'b642b4217b34b1e8d3bd915fc65c4452','N',0,'create','user',NULL,NULL,NULL,'78.159.99.208','Test',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL),(86,'10000040',NULL,NULL,'Vipul','sonu.wairagade@gmail.com','vips12345','2020-04-25 16:32:03',NULL,'a663007e9d03cb415492c60ab81fab9e','Y',1,'create','user',NULL,NULL,NULL,'78.159.99.208','Vipul',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL),(87,'10000041',NULL,NULL,'kAMDoXNiNETeEN','KaosTWENTYEiGHT@men.marrived.com','dxsOHM6(','2020-05-03 13:35:09',NULL,'884e03895270a7c99dc59e23a9b197ba','N',0,'create','user',NULL,NULL,NULL,'195.154.207.112','kAMDoXNiNETeEN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL),(88,'10000042',NULL,NULL,'ramesh','aksh@gmail.com','Qwerty','2020-06-07 22:35:50',NULL,'6fac581252319e133c988445dcb2577f','N',0,'create','user',NULL,NULL,NULL,'49.207.48.28','ramesh',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL),(89,'10000043',NULL,NULL,'Ramesh','ganesh@gmail.com','Qwerty','2020-06-07 22:38:36',NULL,'49a573c510ee1e36ca57b0ed1f269abb','N',0,'create','user',NULL,NULL,NULL,'49.207.48.28','Ramesh',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL),(93,'10000047','Roopam','Sonpethkar','Roopam Sonpethkar','rsonpethkar@yahoo.in','14089','2020-06-11 04:47:42','2020-06-11 04:47:42','7cd96b52c43f2ae5203dc29548323709','Y',1,'create','facebook','facebook','3025116434201769','user/fb/3025116434201769.jpg','49.35.212.87','Roopam Sonpethkar',NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,0,0,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL),(94,'10000048','Roopam','Sonpethkar','Roopam Sonpethkar','rsonpethkar@yahoo.in','14089','2020-06-11 17:21:21',NULL,'7cd96b52c43f2ae5203dc29548323709','Y',1,'ucreate','user',NULL,NULL,'user/fb/3025116434201769.jpg','49.35.212.87','Bleh','Visuals',NULL,'Bleh is creating Visuals',NULL,'',NULL,NULL,NULL,NULL,NULL,0,0,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL),(95,'10000049',NULL,NULL,'Pranav Patil','pranavpatil70@gmail.com','Helloimpactme@123','2020-06-11 18:14:02',NULL,'3ac7e2b9f824b10f6cccf71fe8768c36','N',0,'create','user',NULL,NULL,NULL,'27.7.19.251','Pranav Patil',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL),(97,'10000051',NULL,NULL,'Email test','email@impactme.co.in','blahblah','2020-06-12 19:36:18',NULL,'c9c7f57e5db659f7ddde32c8593e6c0b','N',0,'create','user',NULL,NULL,NULL,'106.220.180.59','Email test',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL),(100,'10000052',NULL,NULL,'CGP Grey','zaklance96@gmail.com','blahblahblah','2020-06-20 02:06:35',NULL,'a91dbc5f64e4d332c8433668b00dd359','Y',1,'create','user',NULL,NULL,NULL,'192.168.10.1','CGP Grey',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `impact_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_menu_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(150) DEFAULT NULL,
  `link` varchar(150) DEFAULT NULL,
  `icon` varchar(150) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `order_status` int(11) NOT NULL DEFAULT '0',
  `menu_type` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`menu_id`)
) ENGINE=MyISAM AUTO_INCREMENT=164 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (1,0,'Menu','#','fa-briefcase',1,1,1),(2,1,'Add Menu','menu_add.php','',1,0,2),(3,1,'Manage Menu','menu_view.php','',1,0,2),(15,0,'CMS','#','fa-crosshairs',1,5,1),(16,15,'Add Page','page_add.php','',0,0,2),(17,15,'Manage Page','page_view.php','',0,0,2),(18,15,'Add Post','post_add.php','',0,0,2),(19,15,'Manage Post','post_view.php','',1,0,2),(149,0,'Creator','#','fa fa-user',1,6,1),(150,149,'Manage Creator','creator_view.php','',1,0,2),(151,0,'Patreon','#','fa fa-users',1,7,1),(152,151,'Manage Patreon','patreon_view.php','',1,0,2),(153,0,'Tier','#','fa fa-book',1,8,1),(154,153,'Manage Tier','tier_view.php','',1,0,2),(155,0,'Profile Submission','#','fa fa-info',1,9,1),(156,155,'Manage New Submission','creator_submission_view_new.php','',1,0,2),(157,155,'Manage All Submission','creator_submission_view.php','',1,0,2),(158,0,'Post','#','fa fa-file',1,10,1),(159,158,'Manage Post','user_post_view.php','',1,0,2),(160,0,'Account Details','account_details_view.php','fa fa-gear',1,11,1),(161,0,'Payment','#','fa fa-inr',1,12,1),(162,161,'Manage Received Payment','payment_received.php','',1,0,2),(163,161,'Manage Sent Payment','payment_sent.php','',1,0,2);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `page`
--

DROP TABLE IF EXISTS `page`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `page` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_name` varchar(150) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `side_menu` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`page_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page`
--

LOCK TABLES `page` WRITE;
/*!40000 ALTER TABLE `page` DISABLE KEYS */;
INSERT INTO `page` VALUES (1,'Terms &amp; Conditions',1,0);
/*!40000 ALTER TABLE `page` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) NOT NULL DEFAULT '0',
  `page_name` varchar(150) DEFAULT NULL,
  `page_title` text,
  `post_name` text,
  `short_description` text,
  `description` longtext,
  `image_path` varchar(150) DEFAULT NULL,
  `thumb_image` varchar(150) DEFAULT NULL,
  `add_by` varchar(150) DEFAULT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `edit_by` varchar(150) DEFAULT NULL,
  `edit_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` int(11) NOT NULL DEFAULT '0',
  `posttype` int(11) DEFAULT NULL,
  `breadcumb_image` varchar(150) DEFAULT NULL,
  `meta_title` text,
  `meta_keyword` text,
  `meta_description` text,
  PRIMARY KEY (`post_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post`
--

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` VALUES (1,1,NULL,'Terms &amp; Conditions','Terms &amp; Conditions',NULL,'&lt;h1&gt;Terms of Use&lt;/h1&gt;\r\n\r\n&lt;p&gt;These are terms and conditions of using ImpactMe.ImpactMe is a platform by Artibuno Pvt. Ltd. and Artibuno Pvt. Ltd. reserves all rights to it. Throughout this document, &amp;rdquo;we&amp;quot;, &amp;quot;our&amp;quot; or &amp;quot;us&amp;quot; refers to Artibuno Pvt. Ltd. and all its subsidiaries, affiliates, officers, directors, employees, agents and third party service providers, whereas &amp;ldquo;you&amp;rdquo; or &amp;ldquo;your&amp;rdquo; refers to any user of this platform.Throughout this document, &amp;ldquo;ImpactMe&amp;quot; or &amp;ldquo;Impact Me&amp;rdquo; refers to the platform ImpactMe hosted on &lt;a href=&quot;http://www.impactme.in&quot;&gt;www.impactme.in&lt;/a&gt; and all the services offered by us on this platform.&lt;/p&gt;\r\n\r\n&lt;p&gt;By using ImpactMe, you agree to these terms and policies. Please read them carefully and let us know at &lt;a href=&quot;mailto:contact@impactme.in&quot;&gt;contact@impactme.in&lt;/a&gt;, if you have any queries. We have the right to review and update these policies at any time, you will be notified in case of any such change.&lt;/p&gt;\r\n\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;h2&gt;&lt;b&gt;Welcome to ImpactMe!&lt;/b&gt;&lt;/h2&gt;\r\n\r\n&lt;p&gt;ImpactMe is a platform for content creators and artists to make a stable income directly from their fans without having to rely solely on advertisements and sponsorships. Creators can release exclusive content such as behind the scenes footages, initial drafts of their work, or provide exclusive services such as a one-on-one video call, a personal message, etc to their most passionate fans as rewards in exchange for a monthly subscription fee or a one-time fee. At ImpactMe, we are focused at putting the artists and creators first, and we may update these policies at any time if we feel the need for the betterment of our community.&lt;/p&gt;\r\n\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;h2&gt;&lt;b&gt;Who can use ImpactMe&lt;/b&gt;&lt;/h2&gt;\r\n\r\n&lt;p&gt;To create an account on ImpactMe, you must be at least 13 years old.&lt;/p&gt;\r\n\r\n&lt;p&gt;You are solely responsible for anything that occurs when anyone is signed in to your account. We will not be accountable for any damage caused due to security breach to your or anyone else&amp;rsquo;s account. If you believe your security has been compromised, please reach us at &lt;a href=&quot;mailto:security@impactme.in&quot;&gt;security@impactme.in&lt;/a&gt; (chk) immediately, we will provide full support in minimising the damage as best as we can.&lt;/p&gt;\r\n\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;h2&gt;&lt;b&gt;Abusive conduct&lt;/b&gt;&lt;/h2&gt;\r\n\r\n&lt;p&gt;We reserve all the rights to deactivate or delete your account and all its content if we feel that it has violated the terms in any way. The decision taken by Artibuno Pvt. Ltd. will be final and binding.&lt;/p&gt;\r\n\r\n&lt;p&gt;Don&amp;rsquo;t do anything illegal, abusive towards others, or that abuses our site in a technical way. These terms cover most issues, but if you find a new and creative way to hurt ImpactMe and its community, we may take technical and legal actions to prevent it.&lt;/p&gt;\r\n\r\n&lt;h1&gt;&lt;b&gt;For Creators&lt;/b&gt;&lt;/h1&gt;\r\n\r\n&lt;h2&gt;&lt;b&gt;Membership and One-time payment&lt;/b&gt;&lt;/h2&gt;\r\n\r\n&lt;p&gt;A &amp;ldquo;creator&amp;rdquo; is a user who offers membership to other users on ImpactMe. A &amp;ldquo;supporter&amp;rdquo; is a user that subscribes to a membership. To become a creator simply launch your page to start your membership. Memberships are for your most passionate fans. You&amp;rsquo;re inviting them to be a part of something exciting that gives them unique benefits they want, like additional access, merchandise, exclusivity, and engaging experiences. In exchange, supporters pay on a subscription basis or one-time basis. Please note that there are different fees associated with both subscription basis payments and one-time payments. Details are discussed in Fees section below.&lt;/p&gt;\r\n\r\n&lt;h2&gt;&lt;b&gt;&lt;a id=&quot;terms_payments&quot;&gt;Payments&lt;/a&gt;&lt;/b&gt;&lt;/h2&gt;\r\n\r\n&lt;p&gt;As a creator you make your membership available on ImpactMe, and we provide membership to your supporters on a subscription basis or one-time basis. We also handle payment issues such as fraud, chargebacks and resolution of payments disputes.&lt;/p&gt;\r\n\r\n&lt;p&gt;We try to provide timely access to your funds, but you may occasionally experience delays in accessing your funds. We reserve the right to block or hold payments for violations of our policies or for compliance reasons, including collecting tax reporting information. When payments are delayed or blocked, we try to communicate the reason to you promptly. If you have questions about a payments block, please contact us at &lt;a href=&quot;mailto:support@impactme.in&quot;&gt;support@impactme.in&lt;/a&gt;. In order to protect creators, we reserve the right to block any supporters&amp;rsquo; payments if we believe them to be fraudulent.&lt;/p&gt;\r\n\r\n&lt;p&gt;Please note that any payment once made is non-refundable and non-reimbursable. But we may make an exception in special cases. Please reach out to us at &lt;a href=&quot;mailto:support@impactme.in&quot;&gt;support@impactme.in&lt;/a&gt; if you feel you&amp;rsquo;ve been wrongly charged, the decision taken by us will be final and binding. Sometimes activities like refunds can put your account balance into the negative. If your balance becomes negative then we may recover those funds from future payments. As a creator you are liable to pay us the negative balance amount if we feel we may not be able to recover the funds in future.&lt;/p&gt;\r\n\r\n&lt;h2&gt;&lt;b&gt;Fees&lt;/b&gt;&lt;/h2&gt;\r\n\r\n&lt;p&gt;There are no fees associated with using ImpactMe. We only charge a small percentage fee on each transaction that happens on our platform. The total amount paid by a supporter is divided between the creator, us, and the payment gateway.&lt;/p&gt;\r\n\r\n&lt;p&gt;In the case of monthly membership payment, a fixed 90% of the total amount will be credited to the creator. The transaction charges vary depending on your mode of payment, amount and other factors, but they can be anywhere from 0-5%, subject to change according to the payment gateway&amp;rsquo;s policies. The remaining amount after deduction of transaction charges will be our platform fees. This flexible fee structure ensures that creators always have a stable and predictable income, which is our topmost priority at ImpactMe.&lt;/p&gt;\r\n\r\n&lt;p&gt;In the case of one-time payment, a fixed 80% of the total amount will be credited to the creator. The remaining amount after deduction of transaction charges by the payment gateway, will be our platform fees. The platform fee on one-time payment is higher than the membership fees to incentivise the choice of monthly subscription, as it is more beneficial for the creator to make a regular and predictable income.&lt;/p&gt;\r\n\r\n&lt;h2&gt;&lt;b&gt;Tax&lt;/b&gt;&lt;/h2&gt;\r\n\r\n&lt;p&gt;We do not handle most tax payments, but we collect tax identification information and report this to tax authorities as legally required. You are responsible for reporting any taxes.&lt;/p&gt;\r\n\r\n&lt;h2&gt;&lt;b&gt;Restrictions&lt;/b&gt;&lt;/h2&gt;\r\n\r\n&lt;p&gt;We don&amp;rsquo;t allow creations, benefits and rewards that violate our policies. Following rewards are not allowed:&lt;/p&gt;\r\n\r\n&lt;p&gt;&amp;bull;&amp;nbsp;&amp;nbsp;&amp;nbsp; Illegal creations or benefits.&lt;/p&gt;\r\n\r\n&lt;p&gt;&amp;bull;&amp;nbsp;&amp;nbsp;&amp;nbsp; Creations or benefits that are abusive towards other people.&lt;/p&gt;\r\n\r\n&lt;p&gt;&amp;bull;&amp;nbsp;&amp;nbsp;&amp;nbsp; Creations or benefits that use others&amp;rsquo; intellectual property, unless you have written permission to use it, or your use is protected by fair use.&lt;/p&gt;\r\n\r\n&lt;p&gt;&amp;bull;&amp;nbsp;&amp;nbsp;&amp;nbsp; Creations or benefits with real people engaging in sexual acts.&lt;/p&gt;\r\n\r\n&lt;p&gt;&amp;bull;&amp;nbsp;&amp;nbsp;&amp;nbsp; Benefits that involve raffles or prizes based on chance or lottery.&lt;/p&gt;\r\n\r\n&lt;p&gt;An account is tied to your creative output and cannot be sold or transferred for use by another creator.&lt;/p&gt;\r\n\r\n&lt;h1&gt;&lt;b&gt;For Supporters&lt;/b&gt;&lt;/h1&gt;\r\n\r\n&lt;p&gt;To become a supporter simply create an account, add your preferred payment method and join a creator&amp;rsquo;s membership.&lt;/p&gt;\r\n\r\n&lt;p&gt;There are two ways to get access to your creator&amp;rsquo;s exclusive rewards. You can subscribe on a monthly basis to get access to all the content starting from your month of subscription till you end the subscription. Or you can pay for unlock each paid post whenever you want to. This is called one-time payment. The price of each membership tier and each post is decided by the creator.&lt;/p&gt;\r\n\r\n&lt;p&gt;Your membership will start as soon as you make the payment, all the posts of the running month will be unlocked. The membership amount will be deducted from your account automatically on the 3rd day of each month. You will get an invoice on a successful payment. You can view all your active membership subscriptions and billing history on your membership page (chk - link to membership page).&lt;/p&gt;\r\n\r\n&lt;p&gt;You can cancel your membership subscription at any time. We may grant refunds at our sole discretion.&lt;/p&gt;\r\n\r\n&lt;p&gt;In certain situations you may lose access to a creator&amp;rsquo;s paid posts and benefits. These include when you cancel your membership subscription, your payment method fails, the creator blocks you, or the creator deletes their account.&lt;/p&gt;\r\n\r\n&lt;p&gt;Creators&amp;rsquo; memberships vary and we have limited control over the quality and specific offerings. We attempt to screen for fraudulent creator pages, but cannot guarantee the identity of creators or the validity of any claims they make. We appreciate your help reporting suspicious creator pages so we can keep ImpactMe safe. As such it is your responsibility to ensure that the creator&amp;rsquo;s original page on other social platforms provides a link to his ImpactMe page.&lt;/p&gt;\r\n\r\n&lt;h1&gt;&lt;b&gt;ImpactMe&lt;/b&gt;&lt;b&gt;&amp;rsquo;&lt;/b&gt;&lt;b&gt;s role&lt;/b&gt;&lt;/h1&gt;\r\n\r\n&lt;p&gt;We proactively look at some pages and posts on ImpactMe to make sure creators follow our guidelines and do not abuse the platform or its community. We also investigate reports of potential violations. These investigations may take a while to resolve and may include looking at what is supported by funds received through ImpactMe.&lt;/p&gt;\r\n\r\n&lt;p&gt;In most situations we will work with creators to resolve any potential violations and allow the creator to continue using ImpactMe. In extreme cases, we reserve the right to remove any post or terminate any account that we feel indulges in abusive conduct.&lt;/p&gt;\r\n\r\n&lt;p&gt;Please let us know if you see potential violations of our terms by mailing us at &lt;a href=&quot;mailto:report@impactme.in&quot;&gt;report@impactme.in&lt;/a&gt;. (chk)&lt;/p&gt;\r\n\r\n&lt;p&gt;We are constantly testing out new features with the goal of making ImpactMe better. We may add or remove features, and test features with only a subset of our community. If we believe a feature is significantly different from these terms, we explain those differences in the test.&lt;/p&gt;\r\n\r\n&lt;h2&gt;&lt;b&gt;Account deletion&lt;/b&gt;&lt;/h2&gt;\r\n\r\n&lt;p&gt;You can permanently delete your creator&amp;rsquo;s page from your Page Settings (chk - link to Page Settings page). You can permanently delete your ImpactMe account at any time from your Profile Settings (chk - link to Profile Settings page) page. In case you choose to delete your account, we may choose to privately store your posts or other information for technical and legal reasons.&lt;/p&gt;\r\n\r\n&lt;p&gt;We can terminate or suspend your account at any time at our discretion. We can also cancel any membership subscription and remove any descriptions, posts or benefits at our discretion.&lt;/p&gt;\r\n\r\n&lt;p&gt;These terms remain in effect even if you no longer have an account.&lt;/p&gt;\r\n\r\n&lt;h2&gt;&lt;b&gt;Your creations&lt;/b&gt;&lt;/h2&gt;\r\n\r\n&lt;p&gt;You keep full ownership of all creations that you offer on ImpactMe, but we need licenses from you to operate ImpactMe effectively.&lt;/p&gt;\r\n\r\n&lt;p&gt;By posting creations on ImpactMe, you grant us a royalty-free, perpetual, irrevocable, non-exclusive, sub licensable, worldwide license to use, reproduce, distribute, perform, publicly display or prepare derivative works of your creation. The purpose of this license is strictly limited to allow us to provide and promote memberships to your supporters. We will never try to steal your creations or use them in an exploitative way.&lt;/p&gt;\r\n\r\n&lt;p&gt;You may not post creations that infringe others&amp;rsquo; intellectual property or proprietary right. We will not be responsible for any unfair use of others&amp;rsquo; creations, but we may decide to take technical or legal actions to prevent it at our discretion.&lt;/p&gt;\r\n\r\n&lt;h1&gt;&lt;b&gt;ImpactMe&lt;/b&gt;&lt;b&gt;&amp;rsquo;&lt;/b&gt;&lt;b&gt;s creations&lt;/b&gt;&lt;/h1&gt;\r\n\r\n&lt;p&gt;Some examples of our creations include text on the site, our logo, and our codebase. We grant you a license to use our logo and other copyrighted and trademarked material to promote your ImpactMe page.&lt;/p&gt;\r\n\r\n&lt;p&gt;You may not otherwise use, reproduce, distribute, perform, publicly display or publicise, or prepare derivative works of our creations unless you obtain our permission in writing. Please contact us at &lt;a href=&quot;mailto:contact@impactme.in&quot;&gt;contact@impactme.in&lt;/a&gt; if you have any queries.&lt;/p&gt;\r\n\r\n&lt;h2&gt;&lt;b&gt;Indemnity&lt;/b&gt;&lt;/h2&gt;\r\n\r\n&lt;p&gt;You will indemnify us from all losses and liabilities, including legal fees, arising from these terms or relate to your use of ImpactMe. We reserve the right to exclusive control over the defence of a claim covered by this clause. Due to this, you are liable to help us in our defence.&lt;/p&gt;\r\n\r\n&lt;p&gt;Your obligation to indemnify under this clause also applies to our subsidiaries, affiliates, officers, directors, employees, agents and third party service providers.&lt;/p&gt;\r\n\r\n&lt;h2&gt;&lt;b&gt;Warranty disclaimer&lt;/b&gt;&lt;/h2&gt;\r\n\r\n&lt;p&gt;ImpactMe is provided &amp;ldquo;as is&amp;rdquo; and without warranty of any kind. Any warranty of merchantability, fitness for a particular purpose, non-infringement, and any other warranty is excluded to the greatest extent permitted by law.&lt;/p&gt;\r\n\r\n&lt;p&gt;The disclaimers of warranty under this clause also apply to our subsidiaries, affiliates and third party service providers.&lt;/p&gt;\r\n\r\n&lt;h1&gt;&lt;b&gt;Limits on liability&lt;/b&gt;&lt;/h1&gt;\r\n\r\n&lt;p&gt;To the extent permitted by law, we are not liable to you for any damages including incidental, consequential or punitive, arising out of these terms, and your use or attempted use of ImpactMe. We are not liable for any loss associated with unfulfilled rewards and from losses caused by conflicting contractual agreements. We are not liable for any financial loss or any other damage arising out of your use of ImpactMe, to the extent permitted by law. As such, in case of any loss of property intellectual, financial or otherwise, it is your responsibility to ensure we have been notified prior to any legal or public action.&lt;/p&gt;\r\n\r\n&lt;h1&gt;&lt;b&gt;Disputes&lt;/b&gt;&lt;/h1&gt;\r\n\r\n&lt;p&gt;As a platform provider it is our responsibility to attempt to resolve any dispute arising through the use of our platform, but in the case we are unable to do so, the Indian Law will govern these terms and all other ImpactMe policies. If a lawsuit does arise, both parties, the user as well as Artibuno Pvt. Ltd. consent to the exclusive jurisdiction and venue of the courts located in Delhi, India.&lt;/p&gt;\r\n\r\n&lt;h1&gt;&lt;b&gt;Other&lt;/b&gt;&lt;/h1&gt;\r\n\r\n&lt;p&gt;These terms and policies are the entire agreement between the two parties &amp;mdash; the user of this platform and Artibuno Pvt. Ltd., 205, Vedant Diamond Apartments, New Sneh Nagar, Nagpur, Maharashtra. This agreement supersedes all prior agreements. Any clauses previously agreed upon in contradiction with the present terms are null and void. We reserve the right to make any changes to these terms and policies as deemed fit by us. If we make any changes that adversely affect your rights, we will inform you of the same. Continuing to use ImpactMe after a change shall mean you accept the new terms or policies.&lt;/p&gt;\r\n\r\n&lt;p&gt;These terms are effective immediately from the time of agreement.&lt;/p&gt;\r\n','','',NULL,'2020-03-27 15:43:55',NULL,'0000-00-00 00:00:00',1,NULL,'','Terms &amp; Conditions','Terms &amp; Conditions','Terms &amp; Conditions');
/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `slider`
--

DROP TABLE IF EXISTS `slider`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `slider` (
  `slider_id` int(11) NOT NULL AUTO_INCREMENT,
  `slider_title` varchar(150) DEFAULT NULL,
  `description` text,
  `button_name` varchar(150) DEFAULT NULL,
  `button_link` varchar(150) DEFAULT NULL,
  `button_name1` varchar(255) DEFAULT NULL,
  `button_link1` varchar(255) DEFAULT NULL,
  `image_path` varchar(150) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`slider_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slider`
--

LOCK TABLES `slider` WRITE;
/*!40000 ALTER TABLE `slider` DISABLE KEYS */;
INSERT INTO `slider` VALUES (1,'DISCOVER THE ANDAMAN & NICOBAR',' ENJOY & EXPLORE                              ','Contact Us','',NULL,NULL,'slider/15527506681.png',1),(2,'DISCOVER THE ANDAMAN & NICOBAR',' ENJOY & EXPLORE                              ',NULL,NULL,NULL,NULL,'slider/15527508302.png',1),(3,'DISCOVER THE ANDAMAN & NICOBAR',' ENJOY & EXPLORE                              ',NULL,NULL,NULL,NULL,'slider/15527515473.png',1),(4,' DISCOVER THE ANDAMAN & NICOBAR          ',' ENJOY & EXPLORE                              ',NULL,NULL,NULL,NULL,'slider/15527513424.png',1),(5,'DISCOVER THE ANDAMAN & NICOBAR','ENJOY & EXPLORE',NULL,NULL,NULL,NULL,'slider/15528011095.png',1);
/*!40000 ALTER TABLE `slider` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `social_users`
--

DROP TABLE IF EXISTS `social_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `social_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT '0',
  `oauth_provider` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `oauth_uid` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT '0000-00-00 00:00:00',
  `modified` datetime DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `social_users`
--

LOCK TABLES `social_users` WRITE;
/*!40000 ALTER TABLE `social_users` DISABLE KEYS */;
INSERT INTO `social_users` VALUES (1,9,'facebook','10218101520521421','Bhaskar','Kumar','bhaskar2359@gmail.com','','','https://platform-lookaside.fbsbx.com/platform/profilepic/?asid=10218101520521421&height=200&width=200&ext=1570520813&hash=AeSm_oRhvf7jArmW','','2019-09-08 13:16:54','0000-00-00 00:00:00'),(2,9,'google','114973254248054168811','Bhaskar','Kumar','bhaskar.webdeveloper@gmail.com','','en','https://lh3.googleusercontent.com/-7rpfxIwxlCI/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rezgITliRUdX-Z6n0mOdoTueaP45g/photo.jpg','','2019-09-08 13:26:59','0000-00-00 00:00:00'),(7,56,'facebook','2656627404388367','Ritesh','Murkute','ritesh.murkute@gmail.com','','','https://platform-lookaside.fbsbx.com/platform/profilepic/?asid=2656627404388367&height=200&width=200&ext=1571202938&hash=AeR2SaI-V5I-Hzpv','','2019-09-15 22:15:38','0000-00-00 00:00:00'),(8,56,'google','100665232589592866314','Ritesh','Murkute','ritesh.murkute@gmail.com','','en','https://lh4.googleusercontent.com/-qql0c4Kl34s/AAAAAAAAAAI/AAAAAAAAAAA/ACHi3rehxKmfR7ZN-8xPZiiebcgylQTVmA/photo.jpg','','2019-09-15 22:16:09','0000-00-00 00:00:00'),(9,58,'facebook','10211523257316210','Chetan','Tawale','chetan.tawale@gmail.com','','','https://platform-lookaside.fbsbx.com/platform/profilepic/?asid=10211523257316210&height=200&width=200&ext=1571203939&hash=AeRF2x--1YX4ovEH','','2019-09-15 22:32:19','0000-00-00 00:00:00'),(12,2,'google','117110325863745231761','Bhaskar','Kumar','bhaskar2359@gmail.com','','en-GB','https://lh3.googleusercontent.com/a-/AAuE7mByFuFL5Dw2-p-3eSINpGXbQLtQjoyuXtwhHtOwKg','','2019-09-19 03:33:17','0000-00-00 00:00:00'),(13,2,'facebook','10218101520521421','Bhaskar','Kumar','bhaskar2359@gmail.com','','','https://platform-lookaside.fbsbx.com/platform/profilepic/?asid=10218101520521421&height=200&width=200&ext=1571481301&hash=AeTvWICLozaCydx3','','2019-09-19 03:35:01','0000-00-00 00:00:00'),(16,46,'google','105416242379100694712','Random Thought','Bullets','therohanmadnani@gmail.com','','en','https://lh3.googleusercontent.com/a-/AAuE7mAafL7xlIqlYYjTdDcF6s4Z2TulYed9R_BCXriHcg','','2020-02-09 00:26:40','0000-00-00 00:00:00'),(17,94,'facebook','3025116434201769','Roopam','Sonpethkar','rsonpethkar@yahoo.in','','','https://platform-lookaside.fbsbx.com/platform/profilepic/?asid=3025116434201769&height=200&width=200&ext=1594468321&hash=AeR7LAFTiFU7u5C2','','2020-06-11 04:52:01','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `social_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_comment`
--

DROP TABLE IF EXISTS `tbl_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_comment` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_comment_id` int(11) DEFAULT '0',
  `comment` varchar(200) DEFAULT NULL,
  `comment_sender_name` varchar(40) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_comment`
--

LOCK TABLES `tbl_comment` WRITE;
/*!40000 ALTER TABLE `tbl_comment` DISABLE KEYS */;
INSERT INTO `tbl_comment` VALUES (2,0,'You are awesome!','Mithilesh Hinge','2020-01-27 23:15:22',16,66),(3,0,'Hello Palash!','Mithilesh Hinge','2020-01-27 23:17:45',9,66),(4,0,'Red moon rising!','Mithilesh Hinge','2020-01-27 23:32:28',4,66),(5,0,'Hello Tushaar Have a Nice Day!','Ritesh Murkute','2020-01-27 23:33:25',23,56),(6,0,'Hello Tushaar!!!','Bhaskar Kumar','2020-01-27 23:38:27',24,2),(7,0,'Americanno!','Mithilesh Hinge','2020-01-28 20:58:21',6,66),(10,0,'hello uncle sam','Mithilesh Hinge','2020-01-28 23:36:20',6,66),(11,0,'Aur kitane bugs nikalenge!!!!!!!','Ritesh Murkute','2020-01-28 23:42:06',6,56),(17,0,'Deleted','Tushar Sawant','2020-01-29 18:24:24',25,46),(18,17,'Good Morning','Mithilesh Hinge','2020-01-29 18:25:23',25,66),(19,0,'Deleted','Tushar Sawant','2020-01-29 18:27:08',25,46),(20,19,'hohohhohohoho','Mithilesh Hinge','2020-01-29 18:28:43',25,66),(21,0,'sossosoososo','Ritesh Murkute','2020-01-29 18:33:09',25,56),(22,0,'hello bhaskar sir','Mithilesh Hinge','2020-01-30 17:35:46',1,66),(23,0,'new post','Mithilesh Hinge','2020-01-30 17:37:59',1,66),(24,0,'hello','Bhaskar Kumar','2020-01-31 05:33:01',24,2),(25,0,'Hello Good Morning all','Bhaskar Kumar','2020-01-31 17:44:09',1,2),(26,23,'Good Morning','Bhaskar Kumar','2020-01-31 17:44:37',1,2),(27,0,'Hi mithilesh','Tushar Sawant','2020-01-31 19:14:21',26,46),(33,0,'hi','Bhaskar Kumar','2020-01-31 20:15:15',1,2),(35,0,'hii','Bhaskar Kumar','2020-01-31 20:41:53',1,2),(36,0,'hi','Bhaskar Kumar','2020-01-31 20:48:29',1,2),(39,0,'hi','Bhaskar Kumar','2020-01-31 20:54:04',1,2),(40,0,'123','Bhaskar Kumar','2020-01-31 20:55:52',1,2),(45,0,'h1','Bhaskar Kumar','2020-02-01 11:08:01',1,2),(49,0,'h','Bhaskar Kumar','2020-02-01 11:29:55',1,2),(50,0,'hello','Bhaskar Kumar','2020-02-01 11:31:17',1,2),(70,0,'Hello k','Bhaskar Kumar','2020-02-01 12:06:10',21,2),(71,0,'Hello uk','Bhaskar Kumar','2020-02-01 12:06:26',21,2),(72,0,'hello ukk','Bhaskar Kumar','2020-02-01 12:06:44',21,2),(73,0,'hi','Bhaskar Kumar','2020-02-01 18:10:21',21,2),(74,0,'hello','Bhaskar Kumar','2020-02-01 18:10:24',21,2),(75,0,'hi','Bhaskar Kumar','2020-02-01 18:10:37',1,2),(76,0,'ttt','Bhaskar Kumar','2020-02-01 18:15:07',1,2),(77,0,'hhhh','Bhaskar Kumar','2020-02-01 18:15:13',1,2),(78,0,'Hii','Mithilesh Hinge','2020-02-07 14:55:55',6,66),(79,0,'hellp','Mithilesh Hinge','2020-02-07 14:56:00',6,66),(80,0,'Hello','Mithilesh Hinge','2020-02-07 14:56:15',6,66),(88,49,'hiii','Bhaskar Kumar','2020-02-07 19:21:37',1,2),(89,0,'Welcome','Tushar Sawant','2020-02-08 14:18:16',28,46),(90,0,'Mithilesh','Mithilesh Hinge','2020-02-08 23:19:17',26,66),(91,0,'Helloo','Mithilesh Hinge','2020-02-08 23:19:22',26,66),(92,90,'Hii','Mithilesh Hinge','2020-02-08 23:27:17',26,66),(93,0,'Hello','Mithilesh Hinge','2020-02-08 23:27:23',26,66),(94,93,'Hii','Test','2020-02-09 02:23:44',26,46),(95,27,'Hey there how are you','Mithilesh Hinge','2020-02-09 02:30:18',26,66),(96,0,'Hey there how are you','Mithilesh Hinge','2020-02-09 02:30:30',26,66),(97,0,'Hi Saloni!','Rohit Choudhari','2020-02-10 09:50:47',28,68),(98,0,'Yo','Rohit Choudhari','2020-02-10 09:56:44',28,68),(99,97,'Hello Rohit! :)','Tushar Sawant','2020-02-10 09:59:58',28,46),(100,0,'Canada!','Rohit Choudhari','2020-02-10 10:01:48',2,68),(101,27,'Hello','Mithilesh Hinge','2020-02-10 10:20:16',26,66),(102,0,'Jaa Simran jaa! Jee le apni zindagi.','Mithilesh Hinge','2020-02-10 10:22:25',27,66),(103,0,'Baapuji','Mithilesh Hinge','2020-02-10 10:23:15',27,66),(104,94,'Yo!','Mithilesh Hinge','2020-02-10 10:32:40',26,66),(105,0,'I read 256 pages of this boring thing!','Mithilesh Hinge','2020-02-10 10:33:28',30,66),(106,0,'Boring man','Mithilesh Hinge','2020-02-10 10:37:18',30,66),(107,0,'Notif!','Mithilesh Hinge','2020-02-10 10:52:10',30,66),(108,0,'hi','Rohit Choudhari','2020-02-10 11:07:02',28,68),(109,108,'hello','Tushar Sawant','2020-02-10 11:09:03',28,46),(110,108,'hiiiiiii','Tushar Sawant','2020-02-10 11:27:58',28,46),(111,108,'test','Tushar Sawant','2020-02-10 11:29:30',28,46),(112,0,'Hello','Tushar Sawant','2020-02-11 21:43:41',25,46),(113,112,'Heyy','Mithilesh Hinge','2020-02-11 21:44:36',25,66),(114,0,'Notif test!','Mithilesh Hinge','2020-02-11 21:46:13',30,66),(115,0,'svfvsfvs','Rohit Choudhari','2020-06-11 05:32:04',28,68);
/*!40000 ALTER TABLE `tbl_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_comment_like`
--

DROP TABLE IF EXISTS `tbl_comment_like`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_comment_like` (
  `like_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`like_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_comment_like`
--

LOCK TABLES `tbl_comment_like` WRITE;
/*!40000 ALTER TABLE `tbl_comment_like` DISABLE KEYS */;
INSERT INTO `tbl_comment_like` VALUES (1,21,66),(2,20,66),(3,10,46),(6,91,46),(7,97,46),(8,15,2),(9,27,66),(11,94,66),(12,112,66);
/*!40000 ALTER TABLE `tbl_comment_like` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_post_like`
--

DROP TABLE IF EXISTS `tbl_post_like`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_post_like` (
  `like_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT '0',
  `user_id` int(11) DEFAULT '0',
  `like_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`like_id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_post_like`
--

LOCK TABLES `tbl_post_like` WRITE;
/*!40000 ALTER TABLE `tbl_post_like` DISABLE KEYS */;
INSERT INTO `tbl_post_like` VALUES (1,7,56,'2020-01-16 06:13:10'),(2,17,56,'2020-01-16 08:02:39'),(3,19,46,'2020-01-18 16:18:31'),(10,24,2,'2020-01-30 17:03:23'),(11,6,46,'2020-02-08 07:19:32'),(15,26,46,'2020-02-08 13:58:24'),(16,30,46,'2020-02-09 07:27:40'),(17,28,46,'2020-02-09 07:27:43'),(19,7,46,'2020-02-09 07:27:52'),(20,4,46,'2020-02-09 07:27:59'),(21,3,46,'2020-02-09 07:28:03'),(22,2,46,'2020-02-09 07:28:06'),(32,26,66,'2020-02-11 00:03:02'),(33,1,2,'2020-02-12 16:18:56'),(34,28,68,'2020-04-28 02:57:05'),(35,27,68,'2020-04-28 02:57:12'),(38,30,68,'2020-04-28 02:57:55');
/*!40000 ALTER TABLE `tbl_post_like` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testimonial`
--

DROP TABLE IF EXISTS `testimonial`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `testimonial` (
  `testimonial_id` int(11) NOT NULL AUTO_INCREMENT,
  `testimonial_name` varchar(255) DEFAULT NULL,
  `email_id` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `description` text,
  `image_path` varchar(255) DEFAULT NULL,
  `rating` int(11) NOT NULL DEFAULT '1',
  `status` int(11) NOT NULL DEFAULT '0',
  `add_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`testimonial_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testimonial`
--

LOCK TABLES `testimonial` WRITE;
/*!40000 ALTER TABLE `testimonial` DISABLE KEYS */;
INSERT INTO `testimonial` VALUES (5,'Dipankar Dutta','dipankar937@gmail.com','8981165309','kolkata','Excellent trip adviser.... ',NULL,4,1,'2019-04-30 14:02:05'),(6,'VIVEK SHARMA','viveksharmacool5587@yahoo.com','8918350936','kolkata','My Journey was gone very Awesome This Guys is one of the best travel Agent in India they Co-operate with us  very Successfully & Frankly thank to My Al-safar journey Pvt. Ltd. for making my Journey so Memorizing.',NULL,5,1,'2019-05-01 08:20:05'),(7,'SONIYA SEKHAR','soniyasekhar.dude@gamil.com','96795777606','Goa','Good coordinator my trip was gone very beautifully\r\n ','',4,1,'2019-05-02 10:19:53'),(8,'Vinay Mishra','vinaymishraCOE@gmail.com','947694','Delhi','Good Enjoyable Trip in Andaman.','',3,0,'2019-05-02 10:38:32'),(9,'Rinky Mehara','rinkymehara9662@yahoo.com','6259802014','Kolkata','Amazing Tour in Andaman Thank to My Al-safar Journey to make my Honeymoon very Special... ','',4,1,'2019-05-06 13:03:48'),(10,'Minal Gandhi','minalcoolbuddy6982@gmail.com','965464235496','Pune','Good Tour Operator i like it...!','',4,0,'2019-05-06 13:08:32'),(11,'Vinita Kumari','Vinikumai9966@Gmail.com','96','Lucknow','Good Co-coordinator for Tour I Like it.','',4,0,'2019-05-06 13:40:08'),(12,'Vinita Kumari','Vinikumai9966@Gmail.com','96','Lucknow','Good Co-coordinator for Tour I Like it.','',4,1,'2019-05-06 13:40:53'),(13,'Veena Sharma','veena.sarma2568@gmail.com','968532147','Delhi','My Trip was Good they provide Service Very well','',4,0,'2019-05-11 06:22:15'),(14,'Rohit ','Rohit.Sharma3369@gmail.com','9856321472','Kolkata','Nice Trip to Andaman','',3,0,'2019-05-11 06:28:46'),(15,'Rahul Chriyal','rahulchriyal5569@gmail.com','9866521440','Vapi','Nice Tour Arrangement good co-coordinator  ','',4,1,'2019-05-24 14:17:20'),(16,'arnab','sdsff@gmail.com','7854632145','kolkata','good','',5,0,'2019-07-18 07:35:43'),(20,'Aswin','xxxxxx@gmail.com','9679513647','Bhopal','we are 53 members are going  to Andaman Tour the Tour operator handle all over tour very good trip was nice thanks to My Alsafar Journey','',5,1,'2019-07-21 15:21:38'),(21,'Poonam','xxxxxx@gmail.com','9856215531','Delhi','Guys this Agency is very good they provide good service','',5,1,'2019-07-26 14:50:10'),(22,'Vikas Yadav','xxxxxx@gmail.com','8001005550','Vizag','Excellent trip in Andaman me and my 41 member Enjoy very well in Andaman. This Agency\'s Service is Very Good.  ','',5,0,'2019-07-30 21:58:36');
/*!40000 ALTER TABLE `testimonial` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `web_settings`
--

DROP TABLE IF EXISTS `web_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `web_settings` (
  `web_id` int(11) NOT NULL AUTO_INCREMENT,
  `image_path` varchar(150) DEFAULT NULL,
  `site_name` varchar(150) DEFAULT NULL,
  `site_url` varchar(255) DEFAULT NULL,
  `email_id` varchar(150) DEFAULT NULL,
  `phone` varchar(150) DEFAULT NULL,
  `phone1` varchar(50) DEFAULT NULL,
  `toll_free` varchar(150) DEFAULT NULL,
  `fax` varchar(150) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `google_plus` varchar(150) DEFAULT NULL,
  `facebook` varchar(150) DEFAULT NULL,
  `twitter` varchar(150) DEFAULT NULL,
  `linkedin` varchar(150) DEFAULT NULL,
  `pininterest` varchar(150) DEFAULT NULL,
  `instagram` varchar(150) DEFAULT NULL,
  `skype` varchar(150) DEFAULT NULL,
  `twitter_feed_app_id` varchar(150) DEFAULT NULL,
  `currency` varchar(50) DEFAULT NULL,
  `fav_icon` varchar(150) DEFAULT NULL,
  `meta_title` varchar(150) DEFAULT NULL,
  `meta_keyword` varchar(150) DEFAULT NULL,
  `meta_description` varchar(150) DEFAULT NULL,
  `office_schedule` text,
  `copyright` varchar(150) DEFAULT NULL,
  `page_title` varchar(150) DEFAULT NULL,
  `footer_map` text,
  `footer_contact` text,
  `contact_image` text,
  `you_tube_code` varchar(150) DEFAULT NULL,
  `contact_map` text,
  `header_gif` varchar(150) DEFAULT NULL,
  `footer_about` text,
  `no_of_file` varchar(50) DEFAULT NULL,
  `max_file_size` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`web_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `web_settings`
--

LOCK TABLES `web_settings` WRITE;
/*!40000 ALTER TABLE `web_settings` DISABLE KEYS */;
INSERT INTO `web_settings` VALUES (1,'logo/6311445511578056086yo2.png','Impactme','','contact@impactme.in','+91 7044144446','+91 8100374155','546546','','205,Vedant Diamond Apt,','New Sneh Nagar Nagpur - 440015','#','https://www.facebook.com/','#','#','','#','http://skype.com','54654','&euro;','logo/540937311578056198yo4.png','Welcome To Impactme','Welcome To Impactme','Welcome To Impactme','<p>we are open 24 hours a day,<br />365 days a year.</p>','&lt;p&gt;Copyrights &amp;copy; 2020&amp;nbsp;Impactme. All Rights Reserved&lt;/p&gt;\r\n','Welcome To Impactme','','<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>\r\n','','#','','logo/122441503764681a.gif','','4','100000');
/*!40000 ALTER TABLE `web_settings` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-06-30  9:23:46
