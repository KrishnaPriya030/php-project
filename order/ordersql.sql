/*
SQLyog Community v13.1.6 (64 bit)
MySQL - 5.6.12-log : Database - ordering_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`ordering_db` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `ordering_db`;

/*Table structure for table `cafe_tables` */

DROP TABLE IF EXISTS `cafe_tables`;

CREATE TABLE `cafe_tables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table_no` int(11) DEFAULT NULL,
  `status` enum('Available','Reserved','Pending') DEFAULT NULL,
  `capacity` int(11) DEFAULT '2',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

/*Data for the table `cafe_tables` */

insert  into `cafe_tables`(`id`,`table_no`,`status`,`capacity`) values 
(6,1,'Available',5),
(7,2,'Reserved',5),
(8,3,'Reserved',2),
(9,4,'Available',10),
(10,5,'Available',2),
(11,6,'Pending',2),
(12,7,'Available',10),
(14,8,'Available',5),
(15,9,'Available',7),
(16,10,'Available',10);

/*Table structure for table `feedback` */

DROP TABLE IF EXISTS `feedback`;

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `message` text,
  `rating` int(11) DEFAULT '5',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `feedback` */

insert  into `feedback`(`id`,`user_id`,`message`,`rating`) values 
(1,6,'very good ambience',5),
(2,6,'staffs are friendly',5),
(3,7,'Good Ambience',5);

/*Table structure for table `menu` */

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `availability` enum('Available','Not Available') DEFAULT 'Available',
  `quantity` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;

/*Data for the table `menu` */

insert  into `menu`(`id`,`name`,`price`,`image`,`availability`,`quantity`) values 
(1,'Cappuccino',100.00,'Cappuccino.jpg','Available',10),
(3,'Latte',150.00,'Latte.png','Available',10),
(4,'Espresso',100.00,'Espresso.jpg','Available',4),
(5,'Americano',100.00,'Americano.png','Available',9),
(6,'Mocha',150.00,'Mocha.jpg','Available',7),
(7,'Hot Chocolate',200.00,'Hot-Chocolate.jpg','Available',6),
(8,'Cold Coffee',100.00,'Cold-Coffee.jpeg','Available',15),
(9,'Masala Chai',100.00,'Masala-Chai.jpg','Available',20),
(10,'Black Tea',50.00,'Black-Tea.jpg','Available',20),
(11,'Green Tea',100.00,'Green-Tea.jpg','Available',5),
(12,'Macha Latte',200.00,'Matcha.jpg','Available',5),
(13,'Virgin Mojito',100.00,'Virgin Mojito.jpg','Available',20),
(14,'Blue Lagoon',150.00,'Blue-Lagoon.jpg','Available',10),
(15,'Chocolate Cake',100.00,'Chocolate-Cake.jpg','Available',20),
(16,'Brownie',100.00,'Brownie.jpg','Available',20),
(17,'Cheesecake',150.00,'Cheesecake.jpg','Available',20),
(18,'Donuts',100.00,'Donuts.jpg','Available',20),
(19,'Pancake',100.00,'Pancake.jpg','Available',20),
(20,'Waffles',150.00,'Waffles.jpg','Available',20),
(21,'Macarons',200.00,'Macarons.png','Available',20);

/*Table structure for table `order_items` */

DROP TABLE IF EXISTS `order_items`;

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `order_items` */

/*Table structure for table `orders` */

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `status` enum('Pending','Approved','Completed','Cancelled') DEFAULT 'Pending',
  `order_time` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

/*Data for the table `orders` */

insert  into `orders`(`id`,`user_id`,`total`,`status`,`order_time`) values 
(1,6,100.00,'Completed','2026-04-10 18:51:31'),
(2,6,300.00,'Pending','2026-04-10 20:53:22'),
(3,6,0.00,'Pending','2026-04-26 00:35:33'),
(4,6,300.00,'Approved','2026-04-26 09:52:57'),
(5,7,100.00,'Completed','2026-04-26 14:34:39'),
(10,7,100.00,'Cancelled','2026-04-26 15:26:30'),
(11,7,100.00,'Cancelled','2026-04-26 17:44:38'),
(12,7,100.00,'Cancelled','2026-04-26 17:53:30'),
(13,7,100.00,'Completed','2026-04-26 18:12:45'),
(14,7,100.00,'Cancelled','2026-04-26 18:16:19'),
(15,7,500.00,'Completed','2026-04-26 18:27:13'),
(16,9,200.00,'Pending','2026-04-26 20:52:16'),
(17,7,250.00,'Approved','2026-04-26 21:15:24'),
(18,7,100.00,'Pending','2026-04-26 21:16:55'),
(19,7,200.00,'Pending','2026-04-26 21:34:35');

/*Table structure for table `payments` */

DROP TABLE IF EXISTS `payments`;

CREATE TABLE `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `type` enum('order','reservation') DEFAULT NULL,
  `method` varchar(50) DEFAULT NULL,
  `status` enum('Paid','Pending') DEFAULT NULL,
  `payment_time` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

/*Data for the table `payments` */

insert  into `payments`(`id`,`ref_id`,`amount`,`type`,`method`,`status`,`payment_time`) values 
(1,0,100.00,'order','UPI','Paid','2026-04-10 18:55:30'),
(2,7,100.00,'reservation','UPI','Paid','2026-04-26 15:22:10'),
(3,7,100.00,'order','UPI','Paid','2026-04-26 17:53:52'),
(4,7,100.00,'reservation','UPI','Paid','2026-04-26 17:54:41'),
(5,7,100.00,'reservation','UPI','Paid','2026-04-26 18:04:02'),
(6,7,100.00,'reservation','UPI','Paid','2026-04-26 18:12:28'),
(7,7,100.00,'order','UPI','Paid','2026-04-26 18:13:10'),
(8,7,100.00,'order','UPI','Paid','2026-04-26 18:16:44'),
(9,7,500.00,'order','UPI','Paid','2026-04-26 18:27:41'),
(10,7,250.00,'order','UPI','Paid','2026-04-26 21:15:51'),
(11,7,100.00,'order','UPI','Paid','2026-04-26 21:17:16');

/*Table structure for table `reservations` */

DROP TABLE IF EXISTS `reservations`;

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `table_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `people` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `expire_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `reservations` */

insert  into `reservations`(`id`,`user_id`,`table_id`,`date`,`time`,`people`,`amount`,`status`,`expire_time`) values 
(1,6,6,'2026-04-28','02:27:00',3,100,'Cancelled',NULL),
(2,7,7,'2026-04-28','03:00:00',3,100,'Approved',NULL),
(3,7,8,'2026-04-10','02:03:00',3,100,'Approved','2026-04-10 05:03:00'),
(4,7,9,'2026-05-01','03:03:00',3,100,'Cancelled','2026-05-01 06:03:00'),
(5,7,12,'0004-04-10','02:03:00',4,100,'Cancelled','1970-01-01 00:00:00'),
(6,7,11,'2026-04-09','02:02:00',1,100,'Pending','2026-04-09 05:02:00');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','customer') DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`password`,`role`) values 
(1,'Lakshmy V','lakshmy2533@gmail.com','Lakshmy@2533','admin'),
(3,'Mariyam Hamsa','mariyam2528@gmail.com','Mariyam@2528','admin'),
(7,'Kristine Thomas','kristine2501@gmail.com','Kristine@2501','customer'),
(8,'Krishnapriya S','krishna2502@gmail.com','Krishna@2502','customer'),
(9,'Kukku','kukku@gmail.com','Kukku@123','customer');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
