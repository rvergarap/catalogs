/*
SQLyog Community v13.1.2 (64 bit)
MySQL - 5.7.17-log : Database - catalogs
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`catalogs` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `catalogs`;

/*Table structure for table `catalog` */

DROP TABLE IF EXISTS `catalog`;

CREATE TABLE `catalog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `client_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_client` (`client_id`),
  CONSTRAINT `fk_client` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `catalog` */

insert  into `catalog`(`id`,`code`,`name`,`client_id`) values 
(1,1,'catalogo1',1),
(2,2,'catalogo2',2),
(3,3,'catalogo3',3),
(4,4,'catalogo4',4),
(5,5,'catalogo5',5),
(6,6,'catalogo6',6);

/*Table structure for table `catalog_product` */

DROP TABLE IF EXISTS `catalog_product`;

CREATE TABLE `catalog_product` (
  `catalog_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `current_stock` int(11) NOT NULL,
  `max_stock` int(11) NOT NULL,
  PRIMARY KEY (`catalog_id`,`product_id`),
  KEY `fk_product` (`product_id`),
  CONSTRAINT `fk_catalog2` FOREIGN KEY (`catalog_id`) REFERENCES `catalog` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `catalog_product` */

insert  into `catalog_product`(`catalog_id`,`product_id`,`current_stock`,`max_stock`) values 
(1,1,5,100),
(1,2,0,10),
(1,3,50,70),
(1,4,20,20),
(1,5,50,110),
(1,6,100,100),
(2,1,8,20),
(2,2,50,70),
(2,3,0,60),
(2,4,10,20),
(2,5,80,150),
(2,6,100,200),
(3,1,50,20),
(3,2,15,90),
(3,3,50,65),
(3,4,90,100),
(3,5,100,100),
(3,6,0,25),
(4,1,12,90),
(4,2,50,60),
(4,3,100,200),
(4,4,100,100),
(4,5,0,50),
(4,6,25,50),
(5,1,10,20),
(5,2,0,20),
(5,3,100,150),
(5,4,50,70),
(5,5,20,30),
(5,6,18,18),
(6,1,15,25),
(6,2,0,50),
(6,3,20,80),
(6,4,50,50),
(6,5,100,100),
(6,6,50,70);

/*Table structure for table `client` */

DROP TABLE IF EXISTS `client`;

CREATE TABLE `client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `rut` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `client` */

insert  into `client`(`id`,`code`,`name`,`rut`) values 
(1,1,'cliente1','1-9'),
(2,2,'cliente2','2-7'),
(3,3,'cliente3','3-5'),
(4,4,'cliente4','4-3'),
(5,5,'cliente5','5-1'),
(6,6,'cliente6','6-k');

/*Table structure for table `integrator` */

DROP TABLE IF EXISTS `integrator`;

CREATE TABLE `integrator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `rut` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `integrator` */

insert  into `integrator`(`id`,`code`,`name`,`rut`) values 
(1,1,'integrador1','1-9'),
(2,2,'integrador2','2-7'),
(3,3,'integrador3','3-5');

/*Table structure for table `integrator_client` */

DROP TABLE IF EXISTS `integrator_client`;

CREATE TABLE `integrator_client` (
  `integrator_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  PRIMARY KEY (`integrator_id`,`client_id`),
  KEY `fk_client2` (`client_id`),
  CONSTRAINT `fk_client2` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_integrator` FOREIGN KEY (`integrator_id`) REFERENCES `integrator` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `integrator_client` */

insert  into `integrator_client`(`integrator_id`,`client_id`) values 
(1,1),
(1,2),
(2,3),
(2,4),
(3,5);

/*Table structure for table `product` */

DROP TABLE IF EXISTS `product`;

CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `product` */

insert  into `product`(`id`,`code`,`name`) values 
(1,1,'producto1'),
(2,2,'producto2'),
(3,3,'producto3'),
(4,4,'producto4'),
(5,5,'producto5'),
(6,6,'producto6');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
