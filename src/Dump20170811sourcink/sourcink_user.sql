-- MySQL dump 10.13  Distrib 5.7.18, for Linux (x86_64)
--
-- Host: localhost    Database: sourcink
-- ------------------------------------------------------
-- Server version	5.7.18-0ubuntu0.16.10.1

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
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `linkedin_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `wantedJob` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `experience` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `salary` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `wantedSalary` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `resumeName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobility` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D64992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_8D93D649A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_8D93D649C05FB297` (`confirmation_token`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'justine@sourcink.com','justine@sourcink.com','justine@sourcink.com','justine@sourcink.com',1,'ZJ/XIo8KEk5R1CRHHsr0pFknJQEMQpy6dyBqz.IIb4Q','93uNUrM5cmEmHGDJZuqRVssOM/7OKnsxgHoogr8AOQht/IPm4jdP6/dnBw9/u7v/MJVBrL9pfAKJ2mP6XcdY7w==','2017-07-18 15:21:41',NULL,NULL,'a:1:{i:0;s:10:\"ROLE_ADMIN\";}','Justine','Cordey','C0nlBTpbS7','hrihgreo','5','678','9874','fehfirhe','0686038749',NULL,'a:1:{i:0;i:603611;}'),(2,'solene@sourcink.com','solene@sourcink.com','solene@sourcink.com','solene@sourcink.com',1,'6Gblt7tdwU91agdj8uEOu8hMxvJ2SWkNhWB33aLnil0','JNKAzXTpSj7asQBMsOkZ7NpKN8xSVsvWRYcjFShd9ftBZLFTafXAtREbEmEnEAVLXyTOyXUomgw3sJ5bJxJtXA==','2017-07-18 15:27:01',NULL,NULL,'a:0:{}','Solène','Baudot','lzwET7YthL','recrut','1',NULL,NULL,'recrut','0666705798',NULL,'a:1:{i:0;i:603614;}'),(3,'contact@sourcink.com','contact@sourcink.com','contact@sourcink.com','contact@sourcink.com',1,'1XWnRDAqYvTKAUpxRSbUwAnqEdqhap0WDKUayRmFXKs','LUx5h/x7FqJvCN0mIu5cbEDlcc0BjYlL8YqJO+expmyDU2QzY6qXVLeCqhdM6TTiPUKu2uBCD7VctdxRPDgTdw==','2017-08-11 11:43:58',NULL,NULL,'a:1:{i:0;s:10:\"ROLE_ADMIN\";}','Admin','Sourcink',NULL,'SuperAdmin','3',NULL,NULL,'Admin','0686938748',NULL,'a:1:{i:0;i:607096;}'),(4,'arnaud@sourcink.com','arnaud@sourcink.com','arnaud@sourcink.com','arnaud@sourcink.com',1,NULL,'6097cd93696d3e0ab0cf331f52bd9f1c','2017-07-27 14:47:07',NULL,NULL,'a:0:{}','Arnaud','Lavisse','y2WKPeVj4F',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'N;');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-08-11 12:33:08
