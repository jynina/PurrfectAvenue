-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: purrfect
-- ------------------------------------------------------
-- Server version	8.0.35

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `orderid` int NOT NULL AUTO_INCREMENT,
  `userid` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact_num` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `mode_of_payment` varchar(50) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `order_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(20) NOT NULL DEFAULT 'NotReceived',
  `received_date` datetime DEFAULT NULL,
  PRIMARY KEY (`orderid`),
  KEY `userid` (`userid`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (3,2,'BEa','095552613','Manila','CashonDelivery',69.97,'2024-02-15 09:48:27','NotReceived',NULL),(5,2,'Bea bea','123569847','World','CashonDelivery',85.91,'2024-02-15 11:40:02','Received',NULL),(7,7,'Din Dinner','','Indonesia','CashonDelivery',75.97,'2024-02-17 08:36:57','Received',NULL),(8,7,'Din Dinner','09560624023','Indonesia','CashonDelivery',15.98,'2024-02-17 08:41:55','Received','2024-02-18 15:25:23'),(13,7,'Din Dinner','09560624023','Indonesia','CashonDelivery',9.99,'2024-02-17 09:26:33','Received','2024-02-15 16:32:15'),(14,7,'Din Dinner','09560624023','Indonesia','CashonDelivery',69.98,'2024-02-17 09:29:51','Received','2024-02-16 16:32:13'),(15,7,'Din Dinner','09560624023','Indonesia','CashonDelivery',15.98,'2024-02-17 09:31:11','Received','2024-02-15 16:32:12'),(16,7,'Din Dinner','09560624023','jjj','CashonDelivery',65.98,'2024-02-17 09:34:55','Received','2024-02-14 16:32:11'),(17,7,'Din Dinner','09560624024','Ph','CashonDelivery',9.99,'2024-02-17 09:35:58','Received','2024-02-14 15:37:42'),(18,7,'Din Dinner','09560624024','Indonesia','CashonDelivery',19.99,'2024-02-18 07:35:36','Received','2024-02-14 15:37:29'),(19,2,'Bea Bora','worlf','09560624023','CashonDelivery',684.97,'2024-02-19 09:46:15','NotReceived',NULL),(20,7,'Din Dinner','09560624024','Indonesia','CashonDelivery',416.00,'2024-02-19 10:23:27','Received','2024-02-19 18:38:58'),(21,7,'Din Dinner','09560624024','Indonesia','CashonDelivery',178.99,'2024-02-19 11:03:17','Received','2024-02-19 19:15:30'),(22,7,'Din Dinner','09560624024','Indonesia','CashonDelivery',208.00,'2024-02-19 11:18:51','Received','2024-02-19 19:18:58');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-02-19 19:48:03
