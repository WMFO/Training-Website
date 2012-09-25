-- MySQL dump 10.13  Distrib 5.1.61, for redhat-linux-gnu (x86_64)
--
-- Host: localhost    Database: training
-- ------------------------------------------------------
-- Server version	5.1.61

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
-- Table structure for table `attendance`
--

DROP TABLE IF EXISTS `attendance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attendance` (
  `user_id` int(11) NOT NULL,
  `1_attend` tinyint(1) NOT NULL DEFAULT '0',
  `1_show` int(11) NOT NULL DEFAULT '0',
  `2_attend` tinyint(1) NOT NULL DEFAULT '0',
  `2_show` int(11) NOT NULL DEFAULT '0',
  `3_attend` tinyint(1) NOT NULL DEFAULT '0',
  `3_show` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attendance`
--

LOCK TABLES `attendance` WRITE;
/*!40000 ALTER TABLE `attendance` DISABLE KEYS */;
INSERT INTO `attendance` VALUES (32,0,33,0,0,0,0),(33,0,0,0,0,0,0),(34,0,0,0,0,0,0),(35,1,33,0,0,0,0),(36,0,0,0,0,0,0),(37,0,0,0,0,0,0);
/*!40000 ALTER TABLE `attendance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `checklist`
--

DROP TABLE IF EXISTS `checklist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `checklist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `weeknum` int(11) NOT NULL,
  `item` text NOT NULL,
  `onum` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `checklist`
--

LOCK TABLES `checklist` WRITE;
/*!40000 ALTER TABLE `checklist` DISABLE KEYS */;
INSERT INTO `checklist` VALUES (1,1,'Complete WMFO station tour.',1),(2,1,'Sign up for all necessary accounts.\r\nThese include\r\n<ul style=\"default\">\r\n<li><a href=\"https://wiki.wmfo.org/Staff_Info/Staff_Services/Spinitron\">Spinitron</a></li>\r\n<li>Google Group <a href=\" http://groups.google.com/group/wmfo-staff\">Staff List</a> - This is where all important emails are sent.</li>\r\n<li>Google Group <a href=\" http://groups.google.com/group/wmfo-sublist\">Sub List</a> - if you are going to miss your show, post that here. By joining, you will also receive emails when shows free up! Simply respond to attend.</li>\r\n</ul>\r\n',4),(3,2,'Each trainee should operate the board for a minimum of 20 minutes.',13),(5,1,'The <b>Public File</b> is a thing. It may be requested by listeners. It is in the GM\'s office. The FCC or anyone else may bang on the door and ask for it, and you need to know where it is.',10),(6,1,'Once signed up, take a tour of Spinitron, the system that <b>must be used</b> to log all songs during broadcast.',6),(7,1,'Explore Rivendell. The following skills are important:\r\n<ul>\r\n<li>Turn Automation On/Off</li>\r\n<li>Searching (make sure you don\'t accidentally do an empty query without first 100 checked)</li>\r\n<li>Playing PSAs</li>\r\n</ul>',7),(8,2,'Volunteering: 2 Hour Requirement, Logging, Volunteer days, Subbing, etc.',12),(9,1,'The phones exist. Demonstrate how to answer the phones.',8),(10,2,'Each trainee must physically answer the phone and put it on air.',14),(22,3,'If you are doing a make-up lesson, go over our <a href=\"checklist.php\">checklist items</a> to make sure you have completed them all!',33),(13,2,'Explore the board in greater detail.\n<ul>\n<li>Previewing channels</li>\n<li>Setting Volumes Appropriately\n<ul><li>How loud?</li></ul>\n</li>\n<li>How to preview on the main monitors?</li>\n<li>How to rearrange items on the board?</li>\n<li>Plugging Things In</li>\n</ul>',11),(14,1,'What is a legal Station ID?',2),(15,1,'When should you do a PSA? How?',3),(16,1,'WMFO Commandments:\n<ul>\n<li>Don\'t swear</li>\n<li>Don\'t be drunk on air</li>\n<li>Actually, don\'t be drunk on air</li>\n<li>Don\'t pretend to be drunk on air</li>\n<li>Don\'t bring alcohol or drugs into WMFO</li>\n</ul>',9),(17,2,'Learn about giving away tickets/policies etc.',21),(18,2,'Guests:\r\n<ul>\r\n<li>They\'re you\'re responsibility</li>\r\n</ul>',15),(20,2,'Don\'t Steal Things.',24),(21,2,'There are turntables and DJ stuff which can be cool to play with. There are records everywhere.',27),(23,1,'<b>Important Note About How Subbing Works:</b>\r\n<ul>\r\n<li>If you are going to miss your show, post that on the subbing list! Simply write a little note. You can see examples on the list.</li>\r\n<li>If you wish to take a show that has been posted, reply with a cheerful note.</li>\r\n<li>You may only miss three (3) shows per semester. If you have to miss more than that, please contact the Programming Director.</li>\r\n<li>You will be awarded volunteer hours for each show you cover.</li>\r\n<li>You must post any shows you will miss to the sub list, and try to do it within a reasonable amount of time.</li>\r\n<li>You may not \"give\" your show time away. See below.</li>\r\n</ul>\r\n<i>A brief PSA, if you are going to miss your show you MUST post that to the sub list. You are not allowed to simply \"give\" it to your friend. Airtime is a public resource which we share fairly, and as such all are entitled access to air time which frees up, not simply on the basis of who has which friends. There has been some controversy over this point recently, so please simply follow these guidelines.</i>',5),(24,2,'That\'s it! If you\'ve attended two shows, a training form will will be emailed to you (due no later than Tuesday the 10th of October).',29);
/*!40000 ALTER TABLE `checklist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `checklist_completion`
--

DROP TABLE IF EXISTS `checklist_completion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `checklist_completion` (
  `user_fk` int(11) NOT NULL,
  `checklist_fk` int(11) NOT NULL,
  PRIMARY KEY (`user_fk`,`checklist_fk`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `checklist_completion`
--

LOCK TABLES `checklist_completion` WRITE;
/*!40000 ALTER TABLE `checklist_completion` DISABLE KEYS */;
INSERT INTO `checklist_completion` VALUES (33,1),(33,2),(33,3),(33,5),(33,6),(33,7),(33,9),(33,10),(33,14),(33,15),(33,16),(33,18),(33,23),(33,24);
/*!40000 ALTER TABLE `checklist_completion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pass_reset`
--

DROP TABLE IF EXISTS `pass_reset`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pass_reset` (
  `user_id_fk` int(10) NOT NULL,
  `secret` varchar(40) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id_fk`),
  UNIQUE KEY `secret` (`secret`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pass_reset`
--

LOCK TABLES `pass_reset` WRITE;
/*!40000 ALTER TABLE `pass_reset` DISABLE KEYS */;
/*!40000 ALTER TABLE `pass_reset` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quiz_answers`
--

DROP TABLE IF EXISTS `quiz_answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quiz_answers` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `user_id_fk` int(7) DEFAULT NULL,
  `qnum_fk` int(3) DEFAULT NULL,
  `answer` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quiz_answers`
--

LOCK TABLES `quiz_answers` WRITE;
/*!40000 ALTER TABLE `quiz_answers` DISABLE KEYS */;
INSERT INTO `quiz_answers` VALUES (1,13,1,'3'),(2,13,1,'3');
/*!40000 ALTER TABLE `quiz_answers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quiz_questions`
--

DROP TABLE IF EXISTS `quiz_questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quiz_questions` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `qnum` int(3) DEFAULT NULL,
  `content` text,
  `input` text,
  `post_name` varchar(20) DEFAULT NULL,
  `answer` varchar(255) DEFAULT NULL,
  `answer_type` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `qnum` (`qnum`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quiz_questions`
--

LOCK TABLES `quiz_questions` WRITE;
/*!40000 ALTER TABLE `quiz_questions` DISABLE KEYS */;
INSERT INTO `quiz_questions` VALUES (1,1,'<p>What is 3 plus 3?</p>','<label for=\"three\">Answer:</label><input type=\"text\" name=\"three\" id=\"three\">','three','3','number');
/*!40000 ALTER TABLE `quiz_questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(4) NOT NULL,
  `name` varchar(25) NOT NULL,
  `nvalue` int(7) NOT NULL,
  `dvalue` datetime NOT NULL,
  `Description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'int','max2hour',5,'0000-00-00 00:00:00','The maximum number of students that can register for a two hour show.'),(2,'int','max1hour',2,'0000-00-00 00:00:00','The max number for a one hour show.'),(3,'date','reg_open',0,'2012-09-20 12:00:00','The time at which normal trainees can register for shows. This can be overridden if a student is set to allow Out of Bounds registration (early reg, add/drop reg) in the user management panel.'),(4,'date','training_start',0,'2012-09-11 00:00:00','The date at which training begins. Used to calculate the week number for attendance and checklist.'),(6,'date','reg_close',0,'2012-09-21 23:59:59','To prevent users from performing add/drop, set this option to the cutoff date.'),(5,'int','regkey',3311656,'0000-00-00 00:00:00','The key required for the registration page. Set as /register.php?key=########'),(7,'int','min_quiz_grade',90,'0000-00-00 00:00:00','This sets the minimum percentage (in integer form, eg 90 = 90%) for students to pass the quiz. If their percentage is equal to or greater, they will receive a link to download the form. If the grade is less, they will receive the remedial training message.');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fname` varchar(44) NOT NULL,
  `lname` varchar(44) NOT NULL,
  `email` varchar(50) NOT NULL,
  `salt` int(10) unsigned NOT NULL,
  `pwd` varchar(60) DEFAULT NULL,
  `role` varchar(8) NOT NULL DEFAULT 'trainee',
  `showday` varchar(10) NOT NULL,
  `showtime` int(2) NOT NULL,
  `showpm` varchar(2) NOT NULL,
  `showduration` varchar(1) NOT NULL,
  `enabled` int(1) NOT NULL DEFAULT '1',
  `phone` varchar(14) NOT NULL,
  `showname` varchar(50) NOT NULL,
  `showchoice` int(4) NOT NULL,
  `quizscore` int(3) DEFAULT '-1',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (13,'Nicholas','Andre','training@wmfo.org',0,'$P$Bileye4NeGsJz8BKIqPTvmG05tRQXT.','admin','',0,'AM','1',0,'','',0,100),(32,'Jim','Trainee','trainee@axfp.org',1347320987,'$2a$08$CBPxX7ypRLV8QFhqhiVO3.gxPNbBegMGhPx8m.QEFxSvVy5lDSL3O','trainee','',0,'AM','1',1,'6176997011','Jim in the watsawhoosit',0,-1),(33,'Jim','Trainer','trainer@axfp.org',1347321015,'$2a$08$u8e8FyiXOZRlcTvh7C5VTO5WL6/kgjlQ4Vrrrwraq2OlAKwT.Dsx.','trainer','Thursday',3,'PM','2',1,'','Herro',0,-1),(34,'Fred','Trainee','trainee2@axfp.org',1347505216,'$2a$08$wAFd4J9kii7ItRF/znTkdejsbE6/e0fFq1KusgtZkxOLa1unEyBou','trainee','',0,'AM','1',2,'','',0,-1),(35,'Bill','Trainee','trainee3@axfp.org',1347505662,'$2a$08$wBSz5roglkRsfywkDCpFu.snzM.CmX.LlzqVlGqkLhIKGX7.htN0C','trainee','',0,'AM','1',2,'','',33,-1),(37,'John','Trainer','trainer2@axfp.org',1348000636,'$2a$08$5bpVwxQuOP/akujbjRME0OCfHeyc3aDiANkDb5VNIm3kW7b9oxpMO','trainer','Friday',4,'AM','1',1,'','Swimmin with Fishes',0,-1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-09-24  0:00:47
