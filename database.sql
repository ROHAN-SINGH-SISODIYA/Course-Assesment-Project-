-- Adminer 4.6.2 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `Assesment_option_tbl`;
CREATE TABLE `Assesment_option_tbl` (
  `option_id` varchar(32) NOT NULL,
  `Quesstion_id` varchar(32) NOT NULL,
  `Assesment_id` varchar(32) NOT NULL,
  `options` varchar(150) NOT NULL,
  `correct_answer` int(1) DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `option_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `Assesment_qst_tbl`;
CREATE TABLE `Assesment_qst_tbl` (
  `Quesstion_id` varchar(32) NOT NULL,
  `Assesment_id` varchar(32) NOT NULL,
  `Question_text` varchar(150) NOT NULL,
  `Question_type` char(10) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `Qst_order` int(11) NOT NULL,
  PRIMARY KEY (`Quesstion_id`),
  KEY `fk_1` (`Assesment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `Assesment_tbl`;
CREATE TABLE `Assesment_tbl` (
  `Assesment_id` varchar(32) NOT NULL,
  `title` varchar(100) NOT NULL,
  `created_by` varchar(20) NOT NULL,
  `created_time` time NOT NULL,
  `status` int(1) DEFAULT '0',
  PRIMARY KEY (`Assesment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `course_assmts`;
CREATE TABLE `course_assmts` (
  `course_uniq_id` varchar(32) NOT NULL,
  `course_id` varchar(32) NOT NULL,
  `Assesment_id` varchar(32) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `course_file`;
CREATE TABLE `course_file` (
  `file_id` varchar(32) NOT NULL,
  `course_id` varchar(32) NOT NULL,
  `file_name` char(200) NOT NULL,
  `file_path` varchar(200) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `course_tbl`;
CREATE TABLE `course_tbl` (
  `course_id` varchar(32) NOT NULL,
  `course_title` char(20) NOT NULL,
  `course_desc` varchar(150) NOT NULL,
  `created_by` varchar(20) NOT NULL,
  `created_date` date NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `phone` bigint(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- 2019-06-22 06:22:48