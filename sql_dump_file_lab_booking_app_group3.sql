/*
-- Date: 2016-03-14 20:02
-- Authors (Maame, George, Eric, Simon)
*/

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
  `permission` set('VIEW','ADD','DELETE','UPDATE') DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `password_UNIQUE` (`password`),
  KEY `usergroup_idx` (`usergroup`),
  CONSTRAINT `usergroup` FOREIGN KEY (`usergroup`) REFERENCES `sweb_usergroup` (`usergroup_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

CREATE TABLE `sweb_lab` (
  `labname` varchar(45) NOT NULL,
  `department` varchar(45) DEFAULT NULL,
  `supervisor_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`labname`),
  UNIQUE KEY `labname_UNIQUE` (`labname`),
  KEY `supervisor_idx` (`supervisor_id`),
  CONSTRAINT `supervisor_id` FOREIGN KEY (`supervisor_id`) REFERENCES `sweb_user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `sweb_booking` (
  `booking_id` int(11) NOT NULL AUTO_INCREMENT,
  `labname` varchar(45) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bookingdate` date NOT NULL,
  `start_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `end_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `bookingstatus` enum('BOOKED','NOT BOOKED') NOT NULL,
  PRIMARY KEY (`booking_id`),
  KEY `labname_idx` (`labname`),
  KEY `user_id_idx` (`user_id`),
  CONSTRAINT `labname` FOREIGN KEY (`labname`) REFERENCES `sweb_lab` (`labname`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `sweb_user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `sweb_usergroup` (`usergroup_id`,`groupname`) VALUES (1,'Administrator');
INSERT INTO `sweb_usergroup` (`usergroup_id`,`groupname`) VALUES (4,'ClubHeads');
INSERT INTO `sweb_usergroup` (`usergroup_id`,`groupname`) VALUES (3,'Faculty Interns');
INSERT INTO `sweb_usergroup` (`usergroup_id`,`groupname`) VALUES (2,'Lecturers');

INSERT INTO `sweb_user` (`user_id`,`username`,`password`,`firstname`,`lastname`,`usergroup`,`permission`) VALUES (1,'simon.suuk','123','simon','baaman suuk',1,'VIEW,ADD,DELETE,UPDATE');
INSERT INTO `sweb_user` (`user_id`,`username`,`password`,`firstname`,`lastname`,`usergroup`,`permission`) VALUES (2,'george.ocran','132','george','ocran',1,'VIEW,ADD,DELETE,UPDATE');
INSERT INTO `sweb_user` (`user_id`,`username`,`password`,`firstname`,`lastname`,`usergroup`,`permission`) VALUES (3,'eric.korku','231','eric','gbekor',1,'VIEW,ADD,DELETE,UPDATE');
INSERT INTO `sweb_user` (`user_id`,`username`,`password`,`firstname`,`lastname`,`usergroup`,`permission`) VALUES (4,'maame.poku','213','maame','afriyie poku',1,'VIEW,ADD,DELETE,UPDATE');

INSERT INTO `sweb_lab` (`labname`,`department`,`supervisor_id`) VALUES ('Dlab','arts',1);
INSERT INTO `sweb_lab` (`labname`,`department`,`supervisor_id`) VALUES ('englab','engineering',2);
INSERT INTO `sweb_lab` (`labname`,`department`,`supervisor_id`) VALUES ('lab221','computer science',3);
INSERT INTO `sweb_lab` (`labname`,`department`,`supervisor_id`) VALUES ('lab222','computer science',4);

INSERT INTO `sweb_booking` (`booking_id`,`labname`,`user_id`,`bookingdate`,`start_time`,`end_time`,`bookingstatus`) VALUES (1,'Dlab',2,'2016-03-14','2016-03-14 06:44:24','2016-03-21 06:04:00','BOOKED');
INSERT INTO `sweb_booking` (`booking_id`,`labname`,`user_id`,`bookingdate`,`start_time`,`end_time`,`bookingstatus`) VALUES (2,'englab',4,'2016-03-22','2016-03-22 13:30:00','2016-03-25 13:30:00','BOOKED');
INSERT INTO `sweb_booking` (`booking_id`,`labname`,`user_id`,`bookingdate`,`start_time`,`end_time`,`bookingstatus`) VALUES (3,'lab222',1,'2016-04-02','2016-04-02 09:15:35','2016-04-02 10:50:30','NOT BOOKED');
INSERT INTO `sweb_booking` (`booking_id`,`labname`,`user_id`,`bookingdate`,`start_time`,`end_time`,`bookingstatus`) VALUES (4,'lab221',3,'2016-04-03','2016-04-03 07:30:00','2016-04-03 09:30:00','NOT BOOKED');