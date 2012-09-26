use wmfo_training;
insert into settings (type, name, nvalue, Description) VALUES ("int", "min_quiz_grade", 90, "This sets the minimum percentage (in integer form, eg 90 = 90%) for students to pass the quiz. If their percentage is equal to or greater, they will receive a link to download the form. If the grade is less, they will receive the remedial training message.");
alter table users add column quizscore int(3) default -1;
create table quiz_views ( id_fk int(7) unique );
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
-- Table structure for table `quiz_questions`
--
use wmfo_training;
DROP TABLE IF EXISTS `quiz_answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quiz_answers` (
    `id` int(7) NOT NULL AUTO_INCREMENT,
      `user_id_fk` int(7) DEFAULT NULL,
        `qnum_fk` int(3) DEFAULT NULL,
          `answer` text,
            PRIMARY KEY (`id`)
          ) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

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
  PRIMARY KEY (`id`),
  UNIQUE KEY `qnum` (`qnum`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quiz_questions`
--

LOCK TABLES `quiz_questions` WRITE;
/*!40000 ALTER TABLE `quiz_questions` DISABLE KEYS */;
INSERT INTO `quiz_questions` VALUES (4,1,'<p>Which of the following statements includes a legal station ID as defined during training?</p>','\r\n<input type=\"radio\" name=\"legalid\" value=\"1\">\"WMFO 91.5 FM\"\r\n<br>\r\n<input type=\"radio\" name=\"legalid\" value=\"2\">\"WMFO Tufts Freeform Radio\"\r\n<br>\r\n<input type=\"radio\" name=\"legalid\" value=\"3\">\"WMFO in Medford, Tufts Freeform Radio\"\r\n<br>\r\n<input type=\"radio\" name=\"legalid\" value=\"4\">\"WMFO FM in Medford\"\r\n','legalid','3'),(2,3,'<p>Oh no! Something has come up and a catastrophe has prevented me from attending my show tomorrow night! What should I do?</p>','<input type=\"radio\" name=\"showmiss\" value=\"1\">Burn Things\r\n<br>\r\n<input type=\"radio\" name=\"showmiss\" value=\"2\">Call my friend and ask him if he can do it.\r\n<br>\r\n<input type=\"radio\" name=\"showmiss\" value=\"3\">Email Max Goldstein\r\n<br>\r\n<input type=\"radio\" name=\"showmiss\" value=\"4\">Send a quick note to the WMFO sublist group, which I have joined.','showmiss','4'),(5,2,'<p>WMFO has two email lists you have to be on if you want to DJ. Verify (in a separate tab or window, without leaving this page) that you have enrolled in both the wmfo-sublist and wmfo-staff and then type:<p>\r\n<p><i>I have enrolled in the email lists!</i></p>\r\n<p>in the box below. Please ensure you copy it exactly.</p>','<label for=\"email\">Answer:</label>\r\n<input type=\"text\" length=\"50\" id=\"email\" name=\"email\">','email','I have enrolled in the email lists!');
/*!40000 ALTER TABLE `quiz_questions` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-09-26 11:20:21
