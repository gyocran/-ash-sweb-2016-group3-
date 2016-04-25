/*
-- Date: 2016-03-14 20:02
-- Authors (Maame, George, Eric, Simon)
*/

DROP DATABASE IF EXISTS`ash_sweb_group_3_db`;

CREATE DATABASE `ash_sweb_group_3_db` /*!40100 DEFAULT CHARACTER SET latin1 */;
use `ash_sweb_group_3_db`;

CREATE TABLE `sweb_usergroup` (
  `usergroup_id` int(11) NOT NULL AUTO_INCREMENT,
  `groupname` varchar(45) NOT NULL,
  PRIMARY KEY (`usergroup_id`),
  UNIQUE KEY `groupname_UNIQUE` (`groupname`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

CREATE TABLE `sweb_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) CHARACTER SET big5 NOT NULL,
  `firstname` varchar(45) DEFAULT NULL,
  `lastname` varchar(45) DEFAULT NULL,
  `usergroup` int(11) NOT NULL,
  `status` enum('DISABLED','ENABLED') DEFAULT NULL,
  `permission` set('VIEW','ADD','DELETE','UPDATE') DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `password_UNIQUE` (`password`),
  KEY `usergroup_idx` (`usergroup`),
  CONSTRAINT `usergroup` FOREIGN KEY (`usergroup`) REFERENCES `sweb_usergroup` (`usergroup_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

CREATE TABLE `sweb_lab` (
  `labname` varchar(45) NOT NULL,
  `department` varchar(45) DEFAULT NULL,
  `supervisor_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`labname`),
  UNIQUE KEY `labname_UNIQUE` (`labname`),
  KEY `supervisor_idx` (`supervisor_id`),
  CONSTRAINT `supervisor_id` FOREIGN KEY (`supervisor_id`) REFERENCES `sweb_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `sweb_booking` (
  `booking_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `org_name` varchar(200) NOT NULL,
  `event_name` varchar(200) NOT NULL,
  `event_description` varchar(200) NOT NULL,
  `labname` varchar(45) NOT NULL,
  `bookingdate` date NOT NULL,
  `bookingtime` set('8:00-9:00 am','9:00-10:00 am','10:00-11:00 am','11:00-12:00 am','12:00-1:00 pm','1:00-2:00 pm','2:00-3:00 pm','3:00-4:00 pm','4:00-5:00 pm','5:00-6:00 pm') NOT NULL,
  PRIMARY KEY (`booking_id`),
  UNIQUE KEY `unique_index` (`labname`,`bookingdate`,`bookingtime`),
  KEY `labname_idx` (`labname`),
  KEY `user_id_idx` (`user_id`),
  CONSTRAINT `labname` FOREIGN KEY (`labname`) REFERENCES `sweb_lab` (`labname`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `sweb_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO `sweb_usergroup` (`usergroup_id`,`groupname`) VALUES (1,'Administrator');
INSERT INTO `sweb_usergroup` (`usergroup_id`,`groupname`) VALUES (4,'ClubHeads');
INSERT INTO `sweb_usergroup` (`usergroup_id`,`groupname`) VALUES (3,'Faculty Interns');
INSERT INTO `sweb_usergroup` (`usergroup_id`,`groupname`) VALUES (2,'Lecturers');

INSERT INTO `sweb_user` (`user_id`,`username`,`password`,`firstname`,`lastname`,`usergroup`,`status`,`permission`) VALUES (1,'simon.suuk',MD5('123'),'simon','baaman suuk',1,'ENABLED','VIEW,ADD,DELETE,UPDATE');
INSERT INTO `sweb_user` (`user_id`,`username`,`password`,`firstname`,`lastname`,`usergroup`,`status`,`permission`) VALUES (2,'george.ocran',MD5('132'),'george','ocran',1,'ENABLED','VIEW,ADD,DELETE,UPDATE');
INSERT INTO `sweb_user` (`user_id`,`username`,`password`,`firstname`,`lastname`,`usergroup`,`status`,`permission`) VALUES (3,'eric.korku',MD5('231'),'eric','gbekor',1,'ENABLED','VIEW,ADD,DELETE,UPDATE');
INSERT INTO `sweb_user` (`user_id`,`username`,`password`,`firstname`,`lastname`,`usergroup`,`status`,`permission`) VALUES (4,'maame.poku',MD5('213'),'maame','afriyie poku',1,'ENABLED','VIEW,ADD,DELETE,UPDATE');

INSERT INTO `sweb_lab` (`labname`,`department`,`supervisor_id`) VALUES ('Dlab','arts',1);
INSERT INTO `sweb_lab` (`labname`,`department`,`supervisor_id`) VALUES ('englab','engineering',2);
INSERT INTO `sweb_lab` (`labname`,`department`,`supervisor_id`) VALUES ('lab221','computer science',3);
INSERT INTO `sweb_lab` (`labname`,`department`,`supervisor_id`) VALUES ('lab222','computer science',4);

INSERT INTO `sweb_booking` (`booking_id`,`user_id`,`org_name`,`event_name`,`event_description`,`labname`,`bookingdate`,`bookingtime`) VALUES (1,1,'speak club','public speaking','we will be teaching you the techniques to overcome your fears for public speaking','Dlab','2016-03-14','8:00-9:00 am');
INSERT INTO `sweb_booking` (`booking_id`,`user_id`,`org_name`,`event_name`,`event_description`,`labname`,`bookingdate`,`bookingtime`) VALUES (2,1,'pencils of promise','mentoring kids','we will discuss how we can build the capacities of pupils in ayim primary','englab','2016-03-22','8:00-9:00 am');
INSERT INTO `sweb_booking` (`booking_id`,`user_id`,`org_name`,`event_name`,`event_description`,`labname`,`bookingdate`,`bookingtime`) VALUES (3,1,'readHub','teaching reading skills','come lets discuss how we can cultivate reading habit among kids','lab222','2016-04-02','9:00-10:00 am');
INSERT INTO `sweb_booking` (`booking_id`,`user_id`,`org_name`,`event_name`,`event_description`,`labname`,`bookingdate`,`bookingtime`) VALUES (4,1,'peer educators','first meeting','we will be discussing how we can make the club vibrant this semester','lab221','2016-04-03','12:00-1:00 pm');