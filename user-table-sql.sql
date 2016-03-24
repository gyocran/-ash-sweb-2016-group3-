/*
-- Query: SELECT * FROM dafla_trials.users
LIMIT 0, 1000

-- Date: 2016-03-04 16:59
*/

CREATE TABLE `wt_usergroup` (
  `usergroup` int(11) NOT NULL AUTO_INCREMENT,
  `groupname` varchar(45) NOT NULL,
  PRIMARY KEY (`usergroup`),
  UNIQUE KEY `groupname_UNIQUE` (`groupname`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

CREATE TABLE `wt_users` (
  `usercode` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `pword` varchar(36) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `usergroup` int(11) NOT NULL,
  `status` enum('DISABLED','ENABLED','NEWUSER') DEFAULT NULL,
  `permission` set('VIEW','ADD','DELETE','UPDATE') DEFAULT NULL,
  PRIMARY KEY (`usercode`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  KEY `usergroup_idx` (`usergroup`),
  CONSTRAINT `` FOREIGN KEY (`usergroup`) REFERENCES `wt_usergroup` (`usergroup`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=latin1;

INSERT INTO `wt_usergroup` (`usergroup`,`groupname`) VALUES (1,'Admin');
INSERT INTO `wt_usergroup` (`usergroup`,`groupname`) VALUES (2,'Faculty');
INSERT INTO `wt_usergroup` (`usergroup`,`groupname`) VALUES (3,'Students');

INSERT INTO `wt_users` (`usercode`,`username`,`pword`,`firstname`,`lastname`,`usergroup`,`status`,`permission`) VALUES (3,'ssb','123','simon','suuk',1,'DISABLED','VIEW,ADD,DELETE,UPDATE');
INSERT INTO `wt_users` (`usercode`,`username`,`pword`,`firstname`,`lastname`,`usergroup`,`status`,`permission`) VALUES (5,'els','123','elijah','suuk',1,'DISABLED','VIEW,ADD');
INSERT INTO `wt_users` (`usercode`,`username`,`pword`,`firstname`,`lastname`,`usergroup`,`status`,`permission`) VALUES (10,'ets','123','elizabeth','suuk',1,'DISABLED','VIEW,ADD');
INSERT INTO `wt_users` (`usercode`,`username`,`pword`,`firstname`,`lastname`,`usergroup`,`status`,`permission`) VALUES (11,'eaf','123','ephraim','ayite',2,'DISABLED','VIEW,ADD,DELETE,UPDATE');
INSERT INTO `wt_users` (`usercode`,`username`,`pword`,`firstname`,`lastname`,`usergroup`,`status`,`permission`) VALUES (12,'ada','123','ada','lovelace',2,'DISABLED','VIEW,ADD');
INSERT INTO `wt_users` (`usercode`,`username`,`pword`,`firstname`,`lastname`,`usergroup`,`status`,`permission`) VALUES (14,'ama','123','ama-zanzi','osei',1,'DISABLED','VIEW,ADD');
INSERT INTO `wt_users` (`usercode`,`username`,`pword`,`firstname`,`lastname`,`usergroup`,`status`,`permission`) VALUES (15,'zulu','','amin','sheik',2,'DISABLED','VIEW,ADD,DELETE,UPDATE');
INSERT INTO `wt_users` (`usercode`,`username`,`pword`,`firstname`,`lastname`,`usergroup`,`status`,`permission`) VALUES (16,'bless','123','buntugu','bismark',1,'DISABLED','VIEW,ADD');
INSERT INTO `wt_users` (`usercode`,`username`,`pword`,`firstname`,`lastname`,`usergroup`,`status`,`permission`) VALUES (47,'camp','','campion','elsie',3,'DISABLED','VIEW,UPDATE');
INSERT INTO `wt_users` (`usercode`,`username`,`pword`,`firstname`,`lastname`,`usergroup`,`status`,`permission`) VALUES (49,'jb','123','joy','luoom',1,'ENABLED','VIEW,ADD');
INSERT INTO `wt_users` (`usercode`,`username`,`pword`,`firstname`,`lastname`,`usergroup`,`status`,`permission`) VALUES (50,'yenu','','doris','laari',3,'ENABLED','VIEW,UPDATE');
INSERT INTO `wt_users` (`usercode`,`username`,`pword`,`firstname`,`lastname`,`usergroup`,`status`,`permission`) VALUES (52,' new','123',' kobby',' annor',1,'ENABLED','VIEW,ADD,DELETE');
INSERT INTO `wt_users` (`usercode`,`username`,`pword`,`firstname`,`lastname`,`usergroup`,`status`,`permission`) VALUES (53,'jj','123','law','biloni',2,'ENABLED','VIEW,UPDATE');
INSERT INTO `wt_users` (`usercode`,`username`,`pword`,`firstname`,`lastname`,`usergroup`,`status`,`permission`) VALUES (55,'ash','123','patrick','awuah',1,'ENABLED','VIEW,ADD,UPDATE');
INSERT INTO `wt_users` (`usercode`,`username`,`pword`,`firstname`,`lastname`,`usergroup`,`status`,`permission`) VALUES (68,'baam','123','baaman','suuk',1,'ENABLED','VIEW,ADD,DELETE,UPDATE');
INSERT INTO `wt_users` (`usercode`,`username`,`pword`,`firstname`,`lastname`,`usergroup`,`status`,`permission`) VALUES (69,'mr','rzutr','percy','nii',1,'DISABLED','VIEW,ADD,DELETE,UPDATE');
INSERT INTO `wt_users` (`usercode`,`username`,`pword`,`firstname`,`lastname`,`usergroup`,`status`,`permission`) VALUES (72,'new','dnmdnmd','newman','freezer',2,'ENABLED','VIEW,ADD,UPDATE');
INSERT INTO `wt_users` (`usercode`,`username`,`pword`,`firstname`,`lastname`,`usergroup`,`status`,`permission`) VALUES (85,'cbx','hkfgkjf','dada','suuk',2,'ENABLED','VIEW,ADD,UPDATE');
INSERT INTO `wt_users` (`usercode`,`username`,`pword`,`firstname`,`lastname`,`usergroup`,`status`,`permission`) VALUES (86,'pso','dgjdjhd','che','champ',2,'DISABLED','ADD,UPDATE');
