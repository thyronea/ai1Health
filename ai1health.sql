-- Adminer 4.8.1 MySQL 11.2.2-MariaDB-1:11.2.2+maria~ubu2204 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `address`;
CREATE TABLE `address` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `userID` int(10) NOT NULL,
  `engineID` int(10) NOT NULL,
  `groupID` int(10) NOT NULL,
  `address1` varchar(100) NOT NULL,
  `address2` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `zip` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `userID` int(10) NOT NULL,
  `engineID` int(10) NOT NULL,
  `groupID` int(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `password` varchar(200) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`userID`),
  KEY `groupID` (`groupID`),
  KEY `engineID` (`engineID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `admin_log`;
CREATE TABLE `admin_log` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `userID` int(10) NOT NULL,
  `groupID` int(10) NOT NULL,
  `user` varchar(200) NOT NULL,
  `type` varchar(100) NOT NULL,
  `activity` varchar(2000) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `groupID` (`groupID`),
  KEY `userID` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `archive`;
CREATE TABLE `archive` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uniqueID` int(10) NOT NULL,
  `groupID` int(10) NOT NULL,
  `vaccine` varchar(200) NOT NULL,
  `lot` varchar(200) NOT NULL,
  `exp` varchar(100) NOT NULL,
  `manufacturer` varchar(200) NOT NULL,
  `ndc` varchar(200) NOT NULL,
  `funding_source` varchar(200) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `background_image`;
CREATE TABLE `background_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `groupID` int(11) NOT NULL,
  `filename` blob DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `chat`;
CREATE TABLE `chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groupID` int(11) NOT NULL,
  `message_ID` int(11) NOT NULL,
  `sender_ID` int(11) NOT NULL,
  `receiver_ID` int(11) NOT NULL,
  `message` text NOT NULL,
  `file` text DEFAULT NULL,
  `seen` int(11) NOT NULL DEFAULT 0,
  `received` int(11) NOT NULL DEFAULT 0,
  `sender_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `receiver_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `time` varchar(200) DEFAULT NULL,
  `date` varchar(200) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `sender_ID` (`sender_ID`),
  KEY `receiver_ID` (`receiver_ID`),
  KEY `sender_deleted` (`sender_deleted`),
  KEY `receiver_deleted` (`receiver_deleted`),
  KEY `seen` (`seen`),
  KEY `date` (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `contact`;
CREATE TABLE `contact` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `userID` int(10) NOT NULL,
  `engineID` int(10) NOT NULL,
  `groupID` int(10) DEFAULT NULL,
  `phone` varchar(100) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `data_dob`;
CREATE TABLE `data_dob` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `patientID` int(10) NOT NULL,
  `groupID` int(10) NOT NULL,
  `dob` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `data_ethnicity`;
CREATE TABLE `data_ethnicity` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `patientID` int(10) NOT NULL,
  `groupID` int(10) NOT NULL,
  `ethnicity` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `data_gender`;
CREATE TABLE `data_gender` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `patientID` int(10) NOT NULL,
  `groupID` int(10) NOT NULL,
  `gender` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `data_iz`;
CREATE TABLE `data_iz` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uniqueID` int(10) NOT NULL,
  `patientID` int(10) NOT NULL,
  `groupID` int(10) NOT NULL,
  `vaccine` varchar(100) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `data_race`;
CREATE TABLE `data_race` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `patientID` int(10) NOT NULL,
  `groupID` int(10) NOT NULL,
  `race` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `diversity`;
CREATE TABLE `diversity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `engineID` int(11) NOT NULL,
  `groupID` int(11) DEFAULT NULL,
  `dob` varchar(200) NOT NULL,
  `gender` varchar(200) NOT NULL,
  `race` varchar(200) NOT NULL,
  `ethnicity` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `docs`;
CREATE TABLE `docs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `groupID` int(11) NOT NULL,
  `docname` blob DEFAULT NULL,
  `type` char(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `email`;
CREATE TABLE `email` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `userID` int(10) NOT NULL,
  `groupID` int(10) NOT NULL,
  `fromEmail` varchar(100) NOT NULL,
  `toEmail` varchar(100) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` blob NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `groupID` (`groupID`),
  KEY `userID` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `emergency_contact`;
CREATE TABLE `emergency_contact` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `patientID` int(10) NOT NULL,
  `engineID` int(10) NOT NULL,
  `groupID` int(10) DEFAULT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `groupID` (`groupID`),
  KEY `engineID` (`engineID`),
  KEY `patientID` (`patientID`),
  CONSTRAINT `emergency_contact_ibfk_1` FOREIGN KEY (`patientID`) REFERENCES `patients` (`patientID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `engine`;
CREATE TABLE `engine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `engineID` int(10) NOT NULL,
  `groupID` int(10) DEFAULT NULL,
  `keyword1` varchar(200) NOT NULL,
  `keyword2` varchar(200) NOT NULL,
  `keyword3` varchar(200) NOT NULL,
  `link` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `groupID` (`groupID`),
  KEY `keyword1` (`keyword1`,`keyword2`,`keyword3`),
  KEY `engineID` (`engineID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `freezertemp`;
CREATE TABLE `freezertemp` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `groupID` int(10) NOT NULL,
  `freezer` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(10) NOT NULL,
  `initials` varchar(100) NOT NULL,
  `current` varchar(100) NOT NULL,
  `min` float NOT NULL,
  `max` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `groupID` (`groupID`),
  KEY `freezer` (`freezer`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `fridgetemp`;
CREATE TABLE `fridgetemp` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `groupID` int(10) NOT NULL,
  `refrigerator` varchar(100) NOT NULL,
  `date` varchar(10) NOT NULL,
  `time` varchar(10) NOT NULL,
  `initials` varchar(100) NOT NULL,
  `current` float NOT NULL,
  `min` float NOT NULL,
  `max` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `groupID` (`groupID`),
  KEY `refrigerator` (`refrigerator`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `healthplan`;
CREATE TABLE `healthplan` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `patientID` int(10) NOT NULL,
  `engineID` int(10) NOT NULL,
  `groupID` int(10) NOT NULL,
  `health_plan` varchar(100) DEFAULT NULL,
  `policy_number` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `immunization`;
CREATE TABLE `immunization` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uniqueID` int(10) NOT NULL,
  `patientID` int(10) NOT NULL,
  `groupID` int(10) NOT NULL,
  `seriesID` int(10) NOT NULL,
  `name` varchar(500) NOT NULL,
  `dob` varchar(200) NOT NULL,
  `type` varchar(100) NOT NULL,
  `vaccine` varchar(200) NOT NULL,
  `manufacturer` varchar(200) NOT NULL,
  `lot` varchar(100) NOT NULL,
  `ndc` varchar(100) NOT NULL,
  `exp` date NOT NULL,
  `site` varchar(100) NOT NULL,
  `route` varchar(100) NOT NULL,
  `vis_given` varchar(100) NOT NULL,
  `vis` varchar(100) NOT NULL,
  `funding_source` varchar(100) NOT NULL,
  `administered_by` varchar(100) NOT NULL,
  `location` varchar(200) NOT NULL,
  `comment` varchar(2000) DEFAULT NULL,
  `value` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `groupID` (`groupID`),
  KEY `name` (`name`),
  KEY `vaccine` (`vaccine`),
  KEY `patientID` (`patientID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `immunization_key`;
CREATE TABLE `immunization_key` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `inventory`;
CREATE TABLE `inventory` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `engineID` int(10) NOT NULL,
  `groupID` int(10) NOT NULL,
  `storage` varchar(100) NOT NULL,
  `name` varchar(200) NOT NULL,
  `doses` int(10) NOT NULL,
  `lot` varchar(100) NOT NULL,
  `exp` date NOT NULL,
  `manufacturer` varchar(100) NOT NULL,
  `ndc` varchar(100) NOT NULL,
  `funding_source` varchar(100) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`engineID`),
  UNIQUE KEY `id` (`id`),
  KEY `groupID` (`groupID`),
  KEY `storage` (`storage`),
  KEY `vaccine` (`name`),
  KEY `engineID` (`engineID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `location`;
CREATE TABLE `location` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `engineID` int(10) NOT NULL,
  `groupID` int(10) NOT NULL,
  `poc` varchar(200) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address1` varchar(100) NOT NULL,
  `address2` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `zip` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `link` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `groupID` (`groupID`),
  KEY `engineID` (`engineID`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `patientlog`;
CREATE TABLE `patientlog` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `patientID` int(10) NOT NULL,
  `uniqueID` int(10) NOT NULL,
  `groupID` int(10) DEFAULT NULL,
  `date` varchar(20) NOT NULL,
  `time` varchar(20) NOT NULL,
  `activity` varchar(200) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `patientID` (`patientID`,`uniqueID`,`groupID`),
  CONSTRAINT `patientlog_ibfk_1` FOREIGN KEY (`patientID`) REFERENCES `patients` (`patientID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `patients`;
CREATE TABLE `patients` (
  `patientID` int(10) NOT NULL,
  `engineID` int(10) NOT NULL,
  `groupID` int(10) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `dob` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `suffix` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(200) NOT NULL,
  `account_status` varchar(100) NOT NULL DEFAULT 'Not Verified',
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`patientID`),
  KEY `engineID` (`engineID`),
  KEY `groupID` (`groupID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `profile`;
CREATE TABLE `profile` (
  `userID` int(10) NOT NULL,
  `engineID` int(10) NOT NULL,
  `groupID` int(10) NOT NULL,
  `fname` varchar(200) NOT NULL,
  `lname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `role` varchar(200) NOT NULL,
  `location` varchar(200) DEFAULT NULL,
  `online` int(10) DEFAULT 0,
  PRIMARY KEY (`userID`),
  KEY `groupID` (`groupID`),
  KEY `engineID` (`engineID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `profile_image`;
CREATE TABLE `profile_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `groupID` int(11) NOT NULL,
  `filename` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `storage`;
CREATE TABLE `storage` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `engineID` int(10) NOT NULL,
  `groupID` int(10) NOT NULL,
  `location` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `grade` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `groupID` (`groupID`),
  KEY `engineID` (`engineID`),
  KEY `office` (`location`,`name`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `thermometers`;
CREATE TABLE `thermometers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `engineID` int(10) NOT NULL,
  `groupID` int(10) NOT NULL,
  `location` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `position` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `serial` varchar(100) NOT NULL,
  `expiration` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `location` (`location`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `token`;
CREATE TABLE `token` (
  `userID` int(11) NOT NULL,
  `groupID` int(11) NOT NULL,
  `token` varchar(200) NOT NULL,
  `dk_token` varchar(200) NOT NULL,
  `salt` varchar(200) NOT NULL,
  `v_code` varchar(200) DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`userID`),
  KEY `groupID` (`groupID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- 2024-11-18 23:17:30
