-- MySQL dump 10.13  Distrib 5.1.49, for debian-linux-gnu (x86_64)
--
-- Host: mysql.wmfo.org    Database: wmfo_training
-- ------------------------------------------------------
-- Server version	5.1.53-log

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
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `checklist`
--

LOCK TABLES `checklist` WRITE;
/*!40000 ALTER TABLE `checklist` DISABLE KEYS */;
INSERT INTO `checklist` VALUES (1,1,'Complete WMFO station tour.',1),(2,1,'Sign up for all necessary accounts.\r\nThese include\r\n<ul>\r\n<li><a href=\"https://wiki.wmfo.org/Staff_Info/Staff_Services/Spinitron\">Spinitron</a></li>\r\n<b><font color=\"red\">Spinitron Access Code:</b> NewFreeformer?Awesome!</font>\r\n\r\n<li>Google Group <a href=\" http://groups.google.com/group/wmfo-staff\">Staff List</a> - This is where all important emails are sent.</li>\r\n<li>Google Group <a href=\" http://groups.google.com/group/wmfo-sublist\">Sub List</a> - if you are going to miss your show, post that here. By joining, you will also receive emails when shows free up! Simply respond to attend.</li>\r\n</ul>\r\n<i><a href=\"https://wiki.wmfo.org/Staff_Info/Staff_Websites\">Optional Accounts</a></i>',4),(3,2,'Each trainee should operate the board for a minimum of 20 minutes.',11),(5,1,'The <b>Public File</b> is a thing. It may be requested by listeners. It is in the filing cabinet in the lounge, top drawer. The FCC or anyone else may bang on the door and ask for it, and you need to know where it is.',10),(6,1,'Once signed up, take a tour of Spinitron, the system that <b>must be used</b> to log all songs during broadcast.',6),(7,1,'Explore Rivendell. The following skills are important:\r\n<ul>\r\n<li>Turn Automation On/Off</li>\r\n<li>Notice the other Automatic/Manual button in the upper right. This controls whether or not songs will automatically play when the one before them finishes</li>\r\n<li>Searching (make sure you don\'t accidentally do an empty query without first 100 checked)</li>\r\n<li>Playing PSAs</li>\r\n<li>Try this: While the search window open on RDAirplay and a song is highlighted, press the green play button. Now select the External 2 feed above the monitor volume knob. You should hear the rivendell preview coming over the monitors.</li>\r\n</ul>',7),(8,2,'Volunteering: 5 Hour Requirement, Logging, Volunteer days, Subbing, etc.',14),(9,1,'The phones exist. Demonstrate how to answer the phones.',8),(10,2,'Each trainee must physically answer the phone and put it on air.',12),(22,3,'If you are doing a make-up lesson, go over our <a href=\"checklist.php\">checklist items</a> to make sure you have completed them all!',33),(13,2,'Explore the board in greater detail.\n<ul>\n<li>Previewing channels</li>\n<li>Setting Volumes Appropriately\n<ul><li>How loud?</li></ul>\n</li>\n<li>How to preview on the main monitors?</li>\n<li>How to rearrange items on the board?</li>\n<li>Plugging Things In</li>\n</ul>',13),(14,1,'What is a legal Station ID?<br />\r\n<i>\"WMFO Medford\" or \"WMFO in Medford\"</i>',2),(15,1,'When should you do a PSA? How?',3),(16,1,'WMFO Commandments:\r\n<ul>\r\n<li><b><font color=\"red\">Don\'t swear</font></b></li>\r\n<li>Don\'t be drunk on air</li>\r\n<li>Actually, don\'t be drunk on air</li>\r\n<li>Don\'t pretend to be drunk on air</li>\r\n<li>Don\'t bring alcohol or drugs into WMFO</li>\r\n<li><b><font color=\"red\">No food or drink in Studio A</font></b></li>\r\n</ul>',9),(17,2,'Learn about giving away tickets/policies etc.',21),(18,2,'Guests:\r\n<ul>\r\n<li>They\'re you\'re responsibility</li>\r\n</ul>',15),(20,2,'Don\'t Steal Things. We will find you.',24),(21,2,'There are turntables and DJ stuff which can be cool to play with. There are records everywhere.',27),(23,1,'<b>Important Note About How Subbing Works:</b>\r\n<ul>\r\n<li>If you are going to miss your show, post that on the subbing list! Simply write a little note. You can see examples on the list.</li>\r\n<li>If you wish to take a show that has been posted, reply with a cheerful note.</li>\r\n<li>You may only miss three (3) shows per semester. If you have to miss more than that, please contact the Programming Director.</li>\r\n<li>You will be awarded volunteer hours for each show you cover.</li>\r\n<li>You must post any shows you will miss to the sub list, and try to do it within a reasonable amount of time.</li>\r\n<li>You may not \"give\" your show time away. See below.</li>\r\n</ul>\r\n<i>A brief PSA, if you are going to miss your show you MUST post that to the sub list. You are not allowed to simply \"give\" it to your friend. Airtime is a public resource which we share fairly, and as such all are entitled access to air time which frees up, not simply on the basis of who has which friends. There has been some confusion regarding this point recently, so please simply follow these guidelines.</i>',5),(24,2,'That\'s it! If you\'ve attended two sessions, you\'re set to get your show. Remember, if you\'re unsure about anything, email training@wmfo.org to clarify. The <a href=\"https://wiki.wmfo.org/\">wiki</a> will be receiving more detailed info regarding studio use.',29),(26,2,'\r\n<p>Question: When may you eat or drink in the studio?</br>\r\nAnswer: NEVER!</p>',11),(27,1,'<p><font color=\"red\"><b>NEVER SWEAR. THERE IS NO SAFE HARBOR. REALLY, DRIVE THIS POINT  HOME!</font></b><p>',8),(28,2,'<font color=\"red\"><b>NEVER SWEAR. THERE IS NO SAFE HARBOR. REALLY, DRIVE THIS POINT  HOME!</font></b>',16);
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
) ENGINE=MyISAM AUTO_INCREMENT=1234 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quiz_answers`
--

LOCK TABLES `quiz_answers` WRITE;
/*!40000 ALTER TABLE `quiz_answers` DISABLE KEYS */;
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `qnum` (`qnum`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quiz_questions`
--

LOCK TABLES `quiz_questions` WRITE;
/*!40000 ALTER TABLE `quiz_questions` DISABLE KEYS */;
INSERT INTO `quiz_questions` VALUES (4,1,'<p>Which of the following statements includes a legal station ID as defined during training?</p>','\r\n<input type=\"radio\" name=\"legalid\" value=\"1\">\"WMFO 91.5 FM\"\r\n<br>\r\n<input type=\"radio\" name=\"legalid\" value=\"2\">\"91.5 WMFO\"\r\n<br>\r\n<input type=\"radio\" name=\"legalid\" value=\"3\">\"WMFO in Medford, Tufts Freeform Radio\"\r\n<br>\r\n<input type=\"radio\" name=\"legalid\" value=\"4\">\"You\'re Listening to Tufts Freeform Radio!\"\r\n','legalid','3'),(2,3,'<p>Oh no! Something has come up and a catastrophe has prevented me from attending my show tomorrow night! What should I do?</p>','<input type=\"radio\" name=\"showmiss\" value=\"1\">Burn things\r\n<br>\r\n<input type=\"radio\" name=\"showmiss\" value=\"2\">Call my friend and ask him if he can do it.\r\n<br>\r\n<input type=\"radio\" name=\"showmiss\" value=\"3\">Email Max Goldstein\r\n<br>\r\n<input type=\"radio\" name=\"showmiss\" value=\"4\">Send a quick note to the WMFO sublist group, which I have joined.','showmiss','4'),(5,10,'<p>WMFO has two email lists you have to be on if you want to DJ. Verify that you have enrolled in both the <a href=\"http://groups.google.com/group/wmfo-sublist\" target=\"_blank\">wmfo-sublist</a> and <a href=\"http://groups.google.com/group/wmfo-staff\" target=\"_blank\">wmfo-staff</a> and then check the box below.</p>','<label for=\"email\">I am enrolled in both e-lists:</label>\r\n<input type=\"checkbox\" id=\"email\" name=\"email\" value=\"true\">','email','true'),(6,4,'<p>Before each show, you must log into ____ and use it to log your songs as you play them. At the end of the show, you close the playlist and sign out.</p>','<input type=\"radio\" name=\"logging\" value=\"1\">Rivendell\r\n<br>\r\n<input type=\"radio\" name=\"logging\" value=\"2\">Spinitron\r\n<br>\r\n<input type=\"radio\" name=\"logging\" value=\"3\">TEMS\r\n<br>\r\n<input type=\"radio\" name=\"logging\" value=\"4\">Sub List','logging','2'),(7,5,'My show is over and the next DJ is not here! I need to play music through Rivendell, so I decide to use Automation. To do it, I:','<input type=\"radio\" name=\"automation\" value=\"1\">Add a bunch of songs and leave\r\n<br>\r\n<input type=\"radio\" name=\"automation\" value=\"2\">Hit the \"Automation ON\" button in Rivendell and wait for it to load.\r\n<br>\r\n<input type=\"radio\" name=\"automation\" value=\"3\">Call Max Goldstein\r\n<br>\r\n<input type=\"radio\" name=\"automation\" value=\"4\">Leave and let the next person fix it.','automation','2'),(8,2,'<p>When must you ID the station?</p>','<input type=\"radio\" name=\"idtime\" value=\"1\">Between :55 and :05 of every hour.\r\n<br>\r\n<input type=\"radio\" name=\"idtime\" value=\"2\">Only during transmitter power up and shutdown\r\n<br>\r\n<input type=\"radio\" name=\"idtime\" value=\"3\">At :30 of every hour\r\n<br>\r\n<input type=\"radio\" name=\"idtime\" value=\"4\">Whenever the FCC evokes the War Powers Act','idtime','1'),(9,6,'What <i>can</i> you do at the station or on the air?','<input type=\"radio\" name=\"rule\" value=\"1\">Bring friends, beers, and drugs for a 2am party.<br>\r\n<input type=\"radio\" name=\"rules\" value=\"2\">Swear like a sailor.\r\n<br>\r\n<input type=\"radio\" name=\"rules\" value=\"3\">Have fun, follow FCC guidelines, and play good music (or talk!).\r\n<br>\r\n<input type=\"radio\" name=\"rules\" value=\"4\">Eat or drink in Studio A.','rules','3'),(10,7,'<p>For questions 7-9, refer to this image:</p>\r\n<img src=\"./images/rdairplay.png\" width=\"650px\">\r\n<p>Which of the following buttons will allow me to add a song to the list of songs I want to play?</p>','<input type=\"radio\" name=\"playbutton\" value=\"1\">Button A<br>\r\n<input type=\"radio\" name=\"playbutton\" value=\"2\">Button B\r\n<br>\r\n<input type=\"radio\" name=\"playbutton\" value=\"3\">Button C\r\n<br>\r\n<input type=\"radio\" name=\"playbutton\" value=\"4\">Button D','playbutton','2'),(11,8,'<p>Which button will disable automation so that it does not continue to log songs on top of your show?</p>','<input type=\"radio\" name=\"stopbutton\" value=\"1\">Button A<br>\r\n<input type=\"radio\" name=\"stopbutton\" value=\"2\">Button B\r\n<br>\r\n<input type=\"radio\" name=\"stopbutton\" value=\"3\">Button C\r\n<br>\r\n<input type=\"radio\" name=\"stopbutton\" value=\"4\">Button D','stopbutton','4'),(12,9,'<p>Which button will change whether or not songs will play consecutively or stop as soon as the end is reached?</p>','<input type=\"radio\" name=\"consbutton\" value=\"1\">Button A<br>\r\n<input type=\"radio\" name=\"consbutton\" value=\"2\">Button B\r\n<br>\r\n<input type=\"radio\" name=\"consbutton\" value=\"3\">Button C\r\n<br>\r\n<input type=\"radio\" name=\"consbutton\" value=\"4\">Button D','consbutton','1'),(13,11,'<p>The strobe light just flashed! Below you will see an image with the lower sound board controls. What buttons do you have to press to accomplish both</p>\r\n<ul>\r\n<li>Answering the phone (hooking the line, in telephone terms)</li>\r\n<li>Allowing the DJ headphones and microphone to communicate with the caller off air.</li>\r\n</ul>\r\n<p>Which of the following sequences will accomplish those goals?</p>\r\n<img src=\"./images/phone.png\">','<input type=\"radio\" name=\"phone\" value=\"1\">Press and hold both buttons C and D<br>\r\n<input type=\"radio\" name=\"phone\" value=\"2\">Press and hold button A, then press button B\r\n<br>\r\n<input type=\"radio\" name=\"phone\" value=\"3\">Press button D and then while holding, press button B\r\n<br>\r\n<input type=\"radio\" name=\"phone\" value=\"4\">Press button C, press and hold button A, and then press B','phone','4'),(14,12,'<p>How many beers can you have before being on the radio?</p>','<input type=\"radio\" name=\"beer\" value=\"1\">1-2<br>\r\n<input type=\"radio\" name=\"beer\" value=\"2\">3-4, but only if they\'re WMFO\'s approved Goldstein Lite&reg;\r\n<br>\r\n<input type=\"radio\" name=\"beer\" value=\"3\">No beers, shots are okay though.\r\n<br>\r\n<input type=\"radio\" name=\"beer\" value=\"4\">None. At all.','beer','4'),(15,13,'<p>An item in the studio that looks expensive is broken or not working properly. What should you do?</p>','<input type=\"radio\" name=\"broken\" value=\"1\">Call Max Goldstein<br>\r\n<input type=\"radio\" name=\"broken\" value=\"2\">Try to fix it yourself\r\n<br>\r\n<input type=\"radio\" name=\"broken\" value=\"3\">Just leave a note and hope someone will wander accross it\r\n<br>\r\n<input type=\"radio\" name=\"broken\" value=\"4\">Do nothing and hope it will resolve itself.','broken','1'),(16,14,'<p>For some reason, a schedule change means that I cannot make my show for an extended period of time. I should take the following course of action:</p>','<input type=\"radio\" name=\"showch\" value=\"1\">Tell me friend that he can take over doing my show<br>\r\n<input type=\"radio\" name=\"showch\" value=\"2\">Send an email to the sub list every week for the rest of the semester\r\n<br>\r\n<input type=\"radio\" name=\"showch\" value=\"3\">Contact the wmfo Program Director and describe the issue so she can work it out fairly\r\n<br>\r\n<input type=\"radio\" name=\"showch\" value=\"4\">Just don\'t come to your show for a while until things change.','showch','3'),(17,15,'<p>Every hour, each DJ must broadcast a _ _ _, either out of the binder under the desk or on the Rivendell catalog.<p>\r\n<p><i>Please enter the three letter acronym. The automated grading is unable to accept other answers.</i></p>','<label for=\"broadcast\">Answer:</label>\r\n<input maxlength=\"3\" type=\"textbox\" name=\"broadcast\" id=\"broadcast\">','broadcast','psa'),(18,16,'<p>How many volunteer hours do you need per semester?</p>','<input type=\"radio\" name=\"vol\" value=\"24\">24 hours<br>\r\n<input type=\"radio\" name=\"vol\" value=\"5\">5 hours per semester. 3 must come from activites other than on air subbing.\r\n<br>\r\n<input type=\"radio\" name=\"vol\" value=\"0\">None\r\n<br>\r\n<input type=\"radio\" name=\"vol\" value=\"2\">2 Hours','vol','5'),(19,17,'<p>When may you swear or play swears on the radio?</p>','<input type=\"radio\" name=\"swear\" value=\"1\">After 8pm and Before 6am<br>\r\n<input type=\"radio\" name=\"swear\" value=\"2\">Never. That\'s not allowed.\r\n<br>\r\n<input type=\"radio\" name=\"swear\" value=\"3\">Only on Weekends\r\n<br>\r\n<input type=\"radio\" name=\"swear\" value=\"4\">When the President invokes the War Powers Act','swear','2'),(20,18,'<p>Besides email lists, WMFO requires that every DJ has an account on <a href=\"https://spinitron.com/member/logon.php\" target=\"_blank\">Spinitron</a>. Please ensure you can log on to Spinitron or you will not be able to receive a show.</p>\r\n<p>You should have signed up for it on the first day and then logged in later in the training process. If, for some reason, you have not yet created one, please do so now by clicking <a href=\"https://spinitron.com/member/newuser.php\" target=\"_blank\">here</a>. Enter the station callsign \"WMFO\" and the passcode \"NewFreeformer?Awesome!\" and then create an account.</p>\r\n<p>When you have either logged on or created an account, please certify below that you have done so.</p>','<label for=\"spinitron\">I have a Spinitron Account:</label><input type=\"checkbox\" name=\"spinitron\" id=\"spinitron\" value=\"yup\">','spinitron','yup');
/*!40000 ALTER TABLE `quiz_questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quiz_views`
--

DROP TABLE IF EXISTS `quiz_views`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quiz_views` (
  `id_fk` int(7) DEFAULT NULL,
  UNIQUE KEY `id_fk` (`id_fk`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quiz_views`
--

LOCK TABLES `quiz_views` WRITE;
/*!40000 ALTER TABLE `quiz_views` DISABLE KEYS */;
/*!40000 ALTER TABLE `quiz_views` ENABLE KEYS */;
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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'int','max2hour',4,'0000-00-00 00:00:00','The maximum number of students that can register for a two hour show.'),(2,'int','max1hour',2,'0000-00-00 00:00:00','The max number for a one hour show.'),(3,'date','reg_open',0,'2012-09-20 12:00:00','The time at which normal trainees can register for shows. This can be overridden if a student is set to allow Out of Bounds registration (early reg, add/drop reg) in the user management panel.'),(4,'date','training_start',0,'2012-09-23 03:00:00','The date at which training begins. Used to calculate the week number for attendance and checklist.'),(6,'date','reg_close',0,'2012-09-21 23:59:59','To prevent users from performing add/drop, set this option to the cutoff date.'),(5,'int','regkey',6266267,'0000-00-00 00:00:00','The key required for the registration page. Set as /register.php?key=########'),(7,'date','forms_due',0,'2012-10-10 17:00:00','This setting affects the \'show forms due\' section of the CSS template.'),(8,'int','min_quiz_grade',90,'0000-00-00 00:00:00','This sets the minimum percentage (in integer form, eg 90 = 90%) for students to pass the quiz. If their percentage is equal to or greater, they will receive a link to download the form. If the grade is less, they will receive the remedial training message.');
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
  `enrolled` int(1) NOT NULL DEFAULT '0',
  `showname` varchar(50) NOT NULL,
  `showchoice` int(4) NOT NULL,
  `quizscore` int(3) DEFAULT '-1',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=180 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (13,'Nicholas','Andre','training@wmfo.org',0,'$P$Bileye4NeGsJz8BKIqPTvmG05tRQXT.','admin','',0,'AM','1',0,'',0,'',0,-1);
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

-- Dump completed on 2012-10-23  8:00:41
