/*
SQLyog Community v11.31 (32 bit)
MySQL - 5.1.41 : Database - ar_tugas_sispak
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`ar_tugas_sispak` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `ar_tugas_sispak`;

/*Table structure for table `fis` */

DROP TABLE IF EXISTS `fis`;

CREATE TABLE `fis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_name` varchar(255) DEFAULT NULL,
  `id_fis` int(11) DEFAULT NULL,
  `and_method` int(11) DEFAULT NULL,
  `or_method` int(11) DEFAULT NULL,
  `implication` int(11) DEFAULT NULL,
  `aggregation` int(11) DEFAULT NULL,
  `defuzzification` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `fis` */

insert  into `fis`(`id`,`project_name`,`id_fis`,`and_method`,`or_method`,`implication`,`aggregation`,`defuzzification`,`status`) values (1,'soal_pdf_1',0,100,102,NULL,NULL,111,0),(6,'produksi_benang',0,100,102,NULL,NULL,111,1);

/*Table structure for table `mf` */

DROP TABLE IF EXISTS `mf`;

CREATE TABLE `mf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_variable` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_variable` (`id_variable`),
  CONSTRAINT `mf_ibfk_1` FOREIGN KEY (`id_variable`) REFERENCES `variable` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=252 DEFAULT CHARSET=latin1;

/*Data for the table `mf` */

insert  into `mf`(`id`,`id_variable`,`name`,`type`,`value`) values (227,141,'berkurang',0,'224260  224260 350023 '),(228,141,'bertambah',0,'224260 350023 350023'),(234,145,'sedikit',0,'225886  225886 264202'),(235,145,'banyak',0,'225886  225886 264202'),(236,146,'turun',0,'224260 224260 350023 '),(237,146,'naik',0,'224260 350023 350023'),(238,147,'berkurang',0,'224260  224260 350023'),(239,147,'bertambah',0,'224260 350023 350023'),(248,152,'sedikit',0,'225886  225886 264202'),(249,152,'banyak',0,'225886  264202 264202'),(250,153,'turun',0,'224260 224260 350023 '),(251,153,'naik',0,'224260 350023 350023');

/*Table structure for table `module` */

DROP TABLE IF EXISTS `module`;

CREATE TABLE `module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `p_id` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=182 DEFAULT CHARSET=latin1;

/*Data for the table `module` */

insert  into `module`(`id`,`name`,`description`,`url`,`p_id`) values (42,'Module','-','module',45),(43,'User','-','user',45),(45,'Web Management','-','-',0),(66,'User Level','-','userLevel',45),(164,'Variable Input','-','variableInput',169),(165,'Variable Output','-','variableOutput',169),(166,'Inference System','-','inferenceSystem',169),(168,'Rules','-','rules',169),(169,'ARFuzzy','-','-',0),(180,'Fis Project','-','fisProject',169),(181,'Frontend','-','frontEnd',169);

/*Table structure for table `module_privilage` */

DROP TABLE IF EXISTS `module_privilage`;

CREATE TABLE `module_privilage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_id` int(11) DEFAULT NULL,
  `user_level_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_module_privilage_to_user_level` (`user_level_id`),
  KEY `FK_module_privilage_to_module` (`module_id`),
  CONSTRAINT `FK_module_privilage_to_module` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_module_privilage_to_user_level` FOREIGN KEY (`user_level_id`) REFERENCES `user_level` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=238 DEFAULT CHARSET=latin1;

/*Data for the table `module_privilage` */

insert  into `module_privilage`(`id`,`module_id`,`user_level_id`) values (38,42,2),(53,43,2),(188,66,2),(189,166,2),(190,166,31),(191,168,2),(192,168,31),(220,164,2),(221,164,31),(222,165,2),(223,165,31),(227,180,2),(228,180,31),(235,181,2),(236,181,31),(237,181,32);

/*Table structure for table `rule` */

DROP TABLE IF EXISTS `rule`;

CREATE TABLE `rule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_fis` int(11) DEFAULT NULL,
  `connection` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_fis` (`id_fis`),
  CONSTRAINT `rule_ibfk_1` FOREIGN KEY (`id_fis`) REFERENCES `fis` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=latin1;

/*Data for the table `rule` */

insert  into `rule`(`id`,`id_fis`,`connection`,`order`) values (92,1,'AND',NULL),(93,1,'AND',NULL),(94,1,'AND',NULL),(95,1,'AND',NULL),(104,6,'AND',NULL),(105,6,'AND',NULL),(106,6,'AND',NULL),(107,6,'AND',NULL);

/*Table structure for table `rule_detail` */

DROP TABLE IF EXISTS `rule_detail`;

CREATE TABLE `rule_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_rule` int(11) DEFAULT NULL,
  `type_rule` int(11) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `id_variable` int(11) DEFAULT NULL,
  `id_mf` int(11) DEFAULT NULL,
  `value` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_rule` (`id_rule`),
  KEY `id_variable` (`id_variable`),
  KEY `id_mf` (`id_mf`),
  CONSTRAINT `rule_detail_ibfk_1` FOREIGN KEY (`id_rule`) REFERENCES `rule` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rule_detail_ibfk_2` FOREIGN KEY (`id_variable`) REFERENCES `variable` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `rule_detail_ibfk_3` FOREIGN KEY (`id_mf`) REFERENCES `mf` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=280 DEFAULT CHARSET=latin1;

/*Data for the table `rule_detail` */

insert  into `rule_detail`(`id`,`id_rule`,`type_rule`,`order`,`id_variable`,`id_mf`,`value`) values (232,92,0,NULL,145,234,NULL),(233,92,0,NULL,146,236,NULL),(234,92,1,NULL,147,238,NULL),(235,93,0,NULL,145,235,NULL),(236,93,0,NULL,146,236,NULL),(237,93,1,NULL,147,238,NULL),(238,94,0,NULL,145,234,NULL),(239,94,0,NULL,146,237,NULL),(240,94,1,NULL,147,239,NULL),(241,95,0,NULL,145,235,NULL),(242,95,0,NULL,146,237,NULL),(243,95,1,NULL,147,239,NULL),(268,104,0,NULL,152,248,NULL),(269,104,0,NULL,153,250,NULL),(270,104,1,NULL,141,227,NULL),(271,105,0,NULL,152,249,NULL),(272,105,0,NULL,153,250,NULL),(273,105,1,NULL,141,227,NULL),(274,106,0,NULL,152,248,NULL),(275,106,0,NULL,153,251,NULL),(276,106,1,NULL,141,228,NULL),(277,107,0,NULL,152,249,NULL),(278,107,0,NULL,153,251,NULL),(279,107,1,NULL,141,228,NULL);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `user_passwd` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `register_date` datetime DEFAULT NULL,
  `register_by` int(11) DEFAULT NULL,
  `user_level_id` int(11) DEFAULT NULL,
  `last_login_date` datetime DEFAULT NULL,
  `last_ip_address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_user` (`user_level_id`),
  CONSTRAINT `FK_user` FOREIGN KEY (`user_level_id`) REFERENCES `user_level` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=237 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`id`,`name`,`user_name`,`user_passwd`,`email`,`register_date`,`register_by`,`user_level_id`,`last_login_date`,`last_ip_address`) values (234,'Administrator','admin123','0192023a7bbd73250516f069df18b500','admin@sispak.ilkom.local',NULL,NULL,2,'2015-02-23 10:37:10','::1'),(235,'User','user123','6ad14ba9986e3615423dfca256d04e3f','user@sispak.ilkom.local','2013-12-08 09:10:23',NULL,32,NULL,NULL),(236,'pakar','pakar123','982b2a975c99ad23d99bfd3d754dd94b','pakar@sispak.ilkom.local','2013-12-08 09:11:02',NULL,31,'2015-02-23 10:36:08','::1');

/*Table structure for table `user_level` */

DROP TABLE IF EXISTS `user_level`;

CREATE TABLE `user_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `p_id` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

/*Data for the table `user_level` */

insert  into `user_level`(`id`,`name`,`description`,`p_id`) values (2,'Administrator','Administrator',0),(31,'Pakar','pakar',0),(32,'User','user',0);

/*Table structure for table `variable` */

DROP TABLE IF EXISTS `variable`;

CREATE TABLE `variable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_fis` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type_input` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_fis` (`id_fis`),
  CONSTRAINT `variable_ibfk_1` FOREIGN KEY (`id_fis`) REFERENCES `fis` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=154 DEFAULT CHARSET=latin1;

/*Data for the table `variable` */

insert  into `variable`(`id`,`id_fis`,`name`,`type_input`) values (141,6,'produksi',1),(145,1,'persediaan',0),(146,1,'permintaan',0),(147,1,'produksi',1),(152,6,'persediaan',0),(153,6,'permintaan',0);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
