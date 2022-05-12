-- MySQL dump 10.13  Distrib 8.0.28, for Linux (x86_64)
--
-- Host: localhost    Database: artcuration_db
-- ------------------------------------------------------
-- Server version	8.0.28-0ubuntu0.20.04.3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `artworkdetails`
--

DROP TABLE IF EXISTS `artworkdetails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `artworkdetails` (
  `ArtworkId` int NOT NULL,
  `ArtworkTitle` varchar(50) NOT NULL,
  `ArtworkUrl` varchar(550) NOT NULL,
  `ArtworkSubmittedBy` int NOT NULL,
  `SubCategoryId` int NOT NULL,
  `CollectionId` int NOT NULL,
  `Description` varchar(100) DEFAULT NULL,
  `IsDiscard` tinyint(1) NOT NULL,
  `IsActive` tinyint(1) NOT NULL,
  `IsDeleted` tinyint(1) NOT NULL,
  PRIMARY KEY (`ArtworkId`),
  KEY `FK_ArtworkDetails_SubCategory` (`SubCategoryId`),
  KEY `FK_ArtworkDetails_Collection` (`CollectionId`),
  CONSTRAINT `FK_ArtworkDetails_Collection` FOREIGN KEY (`CollectionId`) REFERENCES `m-collection` (`CollectionId`),
  CONSTRAINT `FK_ArtworkDetails_SubCategory` FOREIGN KEY (`SubCategoryId`) REFERENCES `m-subcategory` (`SubCategoryId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `artworkdetails`
--

LOCK TABLES `artworkdetails` WRITE;
/*!40000 ALTER TABLE `artworkdetails` DISABLE KEYS */;
INSERT INTO `artworkdetails` VALUES (1,'Amba River - Konkan-Eve Light-DSCF5609.jpg','/sunjoymonga/Amba River - Konkan-Eve Light-DSCF5609.jpg',1,1,1,'Photography',0,1,0),(2,'Beetle-DSC_3235.jpg','/sunjoymonga/Beetle-DSC_3235.jpg',1,1,1,'Photography',0,1,0),(3,'DSC05069.jpg','/sunjoymonga/DSC05069.jpg',1,1,1,'Photography',0,1,0),(4,'DSC05167.JPG','/sunjoymonga/DSC05167.JPG',1,1,1,'Photography',0,1,0),(5,'DSC05169.jpg','/sunjoymonga/DSC05169.jpg',1,1,1,'Photography',0,1,0),(6,'DSC06190.JPG','/sunjoymonga/DSC06190.JPG',1,1,1,'Photography',0,1,0),(7,'DSC06852.JPG','/sunjoymonga/DSC06852.JPG',1,1,1,'Photography',0,1,0),(8,'DSC06853.JPG','/sunjoymonga/DSC06853.JPG',1,1,1,'Photography',0,1,0),(9,'DSC06854.JPG','/sunjoymonga/DSC06854.JPG',1,1,1,'Photography',0,1,0),(10,'DSC06856.JPG','/sunjoymonga/DSC06856.JPG',1,1,1,'Photography',0,1,0),(11,'DSC07494.JPG','/sunjoymonga/DSC07494.JPG',1,1,1,'Photography',0,1,0),(12,'DSC07744.jpg','/sunjoymonga/DSC07744.jpg',1,1,1,'Photography',0,1,0),(13,'DSC08494.JPG','/sunjoymonga/DSC08494.JPG',1,1,1,'Photography',0,1,0),(14,'DSC08558.JPG','/sunjoymonga/DSC08558.JPG',1,1,1,'Photography',0,1,0),(15,'DSC09688.JPG','/sunjoymonga/DSC09688.JPG',1,1,1,'Photography',0,1,0),(16,'DSCF0045.JPG','/sunjoymonga/DSCF0045.JPG',1,1,1,'Photography',0,1,0),(17,'DSCF0599.JPG','/sunjoymonga/DSCF0599.JPG',1,1,1,'Photography',0,1,0),(18,'DSCF0602.JPG','/sunjoymonga/DSCF0602.JPG',1,1,1,'Photography',0,1,0),(19,'DSCF0604.JPG','/sunjoymonga/DSCF0604.JPG',1,1,1,'Photography',0,1,0),(20,'DSCF0616.JPG','/sunjoymonga/DSCF0616.JPG',1,1,1,'Photography',0,1,0),(21,'DSCF3338-Crrcted-1.jpg','/sunjoymonga/DSCF3338-Crrcted-1.jpg',1,1,1,'Photography',0,1,0),(22,'DSCF3382.JPG','/sunjoymonga/DSCF3382.JPG',1,1,1,'Photography',0,1,0),(23,'DSCF3527.JPG','/sunjoymonga/DSCF3527.JPG',1,1,1,'Photography',0,1,0),(24,'DSCF3547.JPG','/sunjoymonga/DSCF3547.JPG',1,1,1,'Photography',0,1,0),(25,'DSCF3562.JPG','/sunjoymonga/DSCF3562.JPG',1,1,1,'Photography',0,1,0),(26,'DSCF3613.JPG','/sunjoymonga/DSCF3613.JPG',1,1,1,'Photography',0,1,0),(27,'DSCF3619.JPG','/sunjoymonga/DSCF3619.JPG',1,1,1,'Photography',0,1,0),(28,'DSCF3620.JPG','/sunjoymonga/DSCF3620.JPG',1,1,1,'Photography',0,1,0),(29,'DSCF3649.JPG','/sunjoymonga/DSCF3649.JPG',1,1,1,'Photography',0,1,0),(30,'DSCF3652.JPG','/sunjoymonga/DSCF3652.JPG',1,1,1,'Photography',0,1,0),(31,'DSC_0002.JPG','/sunjoymonga/DSC_0002.JPG',1,1,1,'Photography',0,1,0),(32,'DSC_0075.JPG','/sunjoymonga/DSC_0075.JPG',1,1,1,'Photography',0,1,0),(33,'DSCF3674.JPG','/sunjoymonga/DSCF3674.JPG',1,1,1,'Photography',0,1,0),(34,'DSCF3675.JPG','/sunjoymonga/DSCF3675.JPG',1,1,1,'Photography',0,1,0),(35,'DSCF3840.JPG','/sunjoymonga/DSCF3840.JPG',1,1,1,'Photography',0,1,0),(36,'DSCF3871.JPG','/sunjoymonga/DSCF3871.JPG',1,1,1,'Photography',0,1,0),(37,'DSCF3912.JPG','/sunjoymonga/DSCF3912.JPG',1,1,1,'Photography',0,1,0),(38,'DSCF3931.JPG','/sunjoymonga/DSCF3931.JPG',1,1,1,'Photography',0,1,0),(39,'DSCF4101.JPG','/sunjoymonga/DSCF4101.JPG',1,1,1,'Photography',0,1,0),(40,'DSCF4107.JPG','/sunjoymonga/DSCF4107.JPG',1,1,1,'Photography',0,1,0),(41,'DSCF4108.JPG','/sunjoymonga/DSCF4108.JPG',1,1,1,'Photography',0,1,0),(42,'DSCF4112.JPG','/sunjoymonga/DSCF4112.JPG',1,1,1,'Photography',0,1,0),(43,'DSCF4131.JPG','/sunjoymonga/DSCF4131.JPG',1,1,1,'Photography',0,1,0),(44,'DSCF4194.JPG','/sunjoymonga/DSCF4194.JPG',1,1,1,'Photography',0,1,0),(45,'DSCF4224.JPG','/sunjoymonga/DSCF4224.JPG',1,1,1,'Photography',0,1,0),(46,'DSCF4321.JPG','/sunjoymonga/DSCF4321.JPG',1,1,1,'Photography',0,1,0),(47,'DSCF4323.JPG','/sunjoymonga/DSCF4323.JPG',1,1,1,'Photography',0,1,0),(48,'DSCF4497.JPG','/sunjoymonga/DSCF4497.JPG',1,1,1,'Photography',0,1,0),(49,'DSCF4536.JPG','/sunjoymonga/DSCF4536.JPG',1,1,1,'Photography',0,1,0),(50,'DSCF4540.JPG','/sunjoymonga/DSCF4540.JPG',1,1,1,'Photography',0,1,0),(51,'DSCF4541.JPG','/sunjoymonga/DSCF4541.JPG',1,1,1,'Photography',0,1,0),(52,'DSCF4576.JPG','/sunjoymonga/DSCF4576.JPG',1,1,1,'Photography',0,1,0),(53,'DSCF4610.JPG','/sunjoymonga/DSCF4610.JPG',1,1,1,'Photography',0,1,0),(54,'DSCF4657.JPG','/sunjoymonga/DSCF4657.JPG',1,1,1,'Photography',0,1,0),(55,'DSCF4733.JPG','/sunjoymonga/DSCF4733.JPG',1,1,1,'Photography',0,1,0),(56,'DSCF5023.JPG','/sunjoymonga/DSCF5023.JPG',1,1,1,'Photography',0,1,0),(57,'DSCF5198.JPG','/sunjoymonga/DSCF5198.JPG',1,1,1,'Photography',0,1,0),(58,'DSCF5307.JPG','/sunjoymonga/DSCF5307.JPG',1,1,1,'Photography',0,1,0),(59,'DSCF5443.JPG','/sunjoymonga/DSCF5443.JPG',1,1,1,'Photography',0,1,0),(60,'DSCF5444.JPG','/sunjoymonga/DSCF5444.JPG',1,1,1,'Photography',0,1,0),(61,'DSC_0166.JPG','/sunjoymonga/DSC_0166.JPG',1,1,1,'Photography',0,1,0),(62,'DSC_0198.JPG','/sunjoymonga/DSC_0198.JPG',1,1,1,'Photography',0,1,0),(63,'DSC_0420.JPG','/sunjoymonga/DSC_0420.JPG',1,1,1,'Photography',0,1,0),(64,'DSC_0423.JPG','/sunjoymonga/DSC_0423.JPG',1,1,1,'Photography',0,1,0),(65,'DSC_0839.JPG','/sunjoymonga/DSC_0839.JPG',1,1,1,'Photography',0,1,0),(66,'DSC_0873.JPG','/sunjoymonga/DSC_0873.JPG',1,1,1,'Photography',0,1,0),(67,'DSC_0878.JPG','/sunjoymonga/DSC_0878.JPG',1,1,1,'Photography',0,1,0),(68,'DSC_0880.JPG','/sunjoymonga/DSC_0880.JPG',1,1,1,'Photography',0,1,0),(69,'DSC_0923.JPG','/sunjoymonga/DSC_0923.JPG',1,1,1,'Photography',0,1,0),(70,'DSC_0925.JPG','/sunjoymonga/DSC_0925.JPG',1,1,1,'Photography',0,1,0),(71,'DSC_0942.JPG','/sunjoymonga/DSC_0942.JPG',1,1,1,'Photography',0,1,0),(72,'DSC_1435.JPG','/sunjoymonga/DSC_1435.JPG',1,1,1,'Photography',0,1,0),(73,'DSC_1462.JPG','/sunjoymonga/DSC_1462.JPG',1,1,1,'Photography',0,1,0),(74,'DSC_2573.JPG','/sunjoymonga/DSC_2573.JPG',1,1,1,'Photography',0,1,0),(75,'DSC_3266-Beetle-1.jpg','/sunjoymonga/DSC_3266-Beetle-1.jpg',1,1,1,'Photography',0,1,0),(76,'DSC_3267.JPG','/sunjoymonga/DSC_3267.JPG',1,1,1,'Photography',0,1,0),(77,'DSC_3274.JPG','/sunjoymonga/DSC_3274.JPG',1,1,1,'Photography',0,1,0),(78,'DSC_3297.JPG','/sunjoymonga/DSC_3297.JPG',1,1,1,'Photography',0,1,0),(79,'DSC_4177.JPG','/sunjoymonga/DSC_4177.JPG',1,1,1,'Photography',0,1,0),(80,'DSC_4475.JPG','/sunjoymonga/DSC_4475.JPG',1,1,1,'Photography',0,1,0),(81,'DSC_4478.JPG','/sunjoymonga/DSC_4478.JPG',1,1,1,'Photography',0,1,0),(82,'DSC_4530.jpg','/sunjoymonga/DSC_4530.jpg',1,1,1,'Photography',0,1,0),(83,'DSC_4532.JPG','/sunjoymonga/DSC_4532.JPG',1,1,1,'Photography',0,1,0),(84,'DSC_4560.JPG','/sunjoymonga/DSC_4560.JPG',1,1,1,'Photography',0,1,0),(85,'DSC_4653.JPG','/sunjoymonga/DSC_4653.JPG',1,1,1,'Photography',0,1,0),(86,'DSC_4656.JPG','/sunjoymonga/DSC_4656.JPG',1,1,1,'Photography',0,1,0),(87,'DSC_4660.JPG','/sunjoymonga/DSC_4660.JPG',1,1,1,'Photography',0,1,0),(88,'DSC_4666.JPG','/sunjoymonga/DSC_4666.JPG',1,1,1,'Photography',0,1,0),(89,'DSC_4667.JPG','/sunjoymonga/DSC_4667.JPG',1,1,1,'Photography',0,1,0),(90,'DSC_4703.JPG','/sunjoymonga/DSC_4703.JPG',1,1,1,'Photography',0,1,0),(91,'DSC_4710.JPG','/sunjoymonga/DSC_4710.JPG',1,1,1,'Photography',0,1,0),(92,'DSC_4740.JPG','/sunjoymonga/DSC_4740.JPG',1,1,1,'Photography',0,1,0),(93,'DSC_5635.JPG','/sunjoymonga/DSC_5635.JPG',1,1,1,'Photography',0,1,0),(94,'DSC_6049.JPG','/sunjoymonga/DSC_6049.JPG',1,1,1,'Photography',0,1,0),(95,'DSC_6349-Flower-2.jpg','/sunjoymonga/DSC_6349-Flower-2.jpg',1,1,1,'Photography',0,1,0),(96,'DSC_6571.JPG','/sunjoymonga/DSC_6571.JPG',1,1,1,'Photography',0,1,0),(97,'DSC_6740.JPG','/sunjoymonga/DSC_6740.JPG',1,1,1,'Photography',0,1,0),(98,'DSC_6741.JPG','/sunjoymonga/DSC_6741.JPG',1,1,1,'Photography',0,1,0),(99,'DSC_6753.JPG','/sunjoymonga/DSC_6753.JPG',1,1,1,'Photography',0,1,0),(100,'DSC_6926.JPG','/sunjoymonga/DSC_6926.JPG',1,1,1,'Photography',0,1,0),(101,'DSC_8525.JPG','/sunjoymonga/DSC_8525.JPG',1,1,1,'Photography',0,1,0),(102,'DSC_8527.JPG','/sunjoymonga/DSC_8527.JPG',1,1,1,'Photography',0,1,0),(103,'DSC_8539.JPG','/sunjoymonga/DSC_8539.JPG',1,1,1,'Photography',0,1,0),(104,'Fungi-Monsoon.jpg','/sunjoymonga/Fungi-Monsoon.jpg',1,1,1,'Photography',0,1,0),(105,'Ghongfhadi-_DSC3914.jpg','/sunjoymonga/Ghongfhadi-_DSC3914.jpg',1,1,1,'Photography',0,1,0),(106,'Jatya_DSC3955.jpg','/sunjoymonga/Jatya_DSC3955.jpg',1,1,1,'Photography',0,1,0),(107,'LeafUmbrella1.jpg','/sunjoymonga/LeafUmbrella1.jpg',1,1,1,'Photography',0,1,0),(108,'LRM_EXPORT_232054468421054_20180925_233941835.jpeg','/sunjoymonga/LRM_EXPORT_232054468421054_20180925_233941835.jpeg',1,1,1,'Photography',0,1,0),(109,'MALSHEJ - 20180926_075940.jpg','/sunjoymonga/MALSHEJ - 20180926_075940.jpg',1,1,1,'Photography',0,1,0),(110,'MALSHEJ - 20180926_080041.jpg','/sunjoymonga/MALSHEJ - 20180926_080041.jpg',1,1,1,'Photography',0,1,0),(111,'MALSHEJ - DSCF5194.JPG','/sunjoymonga/MALSHEJ - DSCF5194.JPG',1,1,1,'Photography',0,1,0),(112,'MALSHEJ - SENECIOUS IN BLOOM-DSCF5190.JPG','/sunjoymonga/MALSHEJ - SENECIOUS IN BLOOM-DSCF5190.JPG',1,1,1,'Photography',0,1,0),(113,'MALSHEJ-DSCF5250.JPG','/sunjoymonga/MALSHEJ-DSCF5250.JPG',1,1,1,'Photography',0,1,0),(114,'MALSHEJ-DSCF5281.JPG','/sunjoymonga/MALSHEJ-DSCF5281.JPG',1,1,1,'Photography',0,1,0),(115,'MATHERAN - 20180908_133031.jpg','/sunjoymonga/MATHERAN - 20180908_133031.jpg',1,1,1,'Photography',0,1,0),(116,'MBLSWR-_YUH3142.JPG','/sunjoymonga/MBLSWR-_YUH3142.JPG',1,1,1,'Photography',0,1,0),(117,'MPS_0159.JPG','/sunjoymonga/MPS_0159.JPG',1,1,1,'Photography',0,1,0),(118,'MPS_0161.JPG','/sunjoymonga/MPS_0161.JPG',1,1,1,'Photography',0,1,0),(119,'MPS_0164.JPG','/sunjoymonga/MPS_0164.JPG',1,1,1,'Photography',0,1,0),(120,'MPS_0219.JPG','/sunjoymonga/MPS_0219.JPG',1,1,1,'Photography',0,1,0),(121,'Monsoon - Fungi .jpg','/sunjoymonga/Monsoon - Fungi .jpg',1,1,1,'Photography',0,1,0),(122,'MPS_0332.JPG','/sunjoymonga/MPS_0332.JPG',1,1,1,'Photography',0,1,0),(123,'MPS_0438.JPG','/sunjoymonga/MPS_0438.JPG',1,1,1,'Photography',0,1,0),(124,'MPS_0445.JPG','/sunjoymonga/MPS_0445.JPG',1,1,1,'Photography',0,1,0),(125,'MPS_0447.JPG','/sunjoymonga/MPS_0447.JPG',1,1,1,'Photography',0,1,0),(126,'MPS_2123.JPG','/sunjoymonga/MPS_2123.JPG',1,1,1,'Photography',0,1,0),(127,'MPS_2126.JPG','/sunjoymonga/MPS_2126.JPG',1,1,1,'Photography',0,1,0),(128,'MPS_2136.JPG','/sunjoymonga/MPS_2136.JPG',1,1,1,'Photography',0,1,0),(129,'MPS_2137.JPG','/sunjoymonga/MPS_2137.JPG',1,1,1,'Photography',0,1,0),(130,'MPS_2141.JPG','/sunjoymonga/MPS_2141.JPG',1,1,1,'Photography',0,1,0),(131,'MPS_2143.JPG','/sunjoymonga/MPS_2143.JPG',1,1,1,'Photography',0,1,0),(132,'MPS_2147.JPG','/sunjoymonga/MPS_2147.JPG',1,1,1,'Photography',0,1,0),(133,'MPS_2151.JPG','/sunjoymonga/MPS_2151.JPG',1,1,1,'Photography',0,1,0),(134,'MPS_2152.JPG','/sunjoymonga/MPS_2152.JPG',1,1,1,'Photography',0,1,0),(135,'MPS_7616.JPG','/sunjoymonga/MPS_7616.JPG',1,1,1,'Photography',0,1,0),(136,'MR-Eyebrowed Thrush-1-SGM_6340.jpg','/sunjoymonga/MR-Eyebrowed Thrush-1-SGM_6340.jpg',1,1,1,'Photography',0,1,0),(137,'MR-Eyebrowed Thrush-1B-SGM_6340_WaterMark.jpg','/sunjoymonga/MR-Eyebrowed Thrush-1B-SGM_6340_WaterMark.jpg',1,1,1,'Photography',0,1,0),(138,'MR-Eyebrowed thrush-2-SGM_6354.jpg','/sunjoymonga/MR-Eyebrowed thrush-2-SGM_6354.jpg',1,1,1,'Photography',0,1,0),(139,'Panel-71c.jpg','/sunjoymonga/Panel-71c.jpg',1,1,1,'Photography',0,1,0),(140,'PG 221 - MBLSWR - TOP-DSCF5413.JPG','/sunjoymonga/PG 221 - MBLSWR - TOP-DSCF5413.JPG',1,1,1,'Photography',0,1,0),(141,'PG 221 TOP - MBLSWR-DSCF5437.JPG','/sunjoymonga/PG 221 TOP - MBLSWR-DSCF5437.JPG',1,1,1,'Photography',0,1,0),(142,'Pond at Nalla Sopara - 2001 (2).jpg','/sunjoymonga/Pond at Nalla Sopara - 2001 (2).jpg',1,1,1,'Photography',0,1,0),(143,'SGM_0202.JPG','/sunjoymonga/SGM_0202.JPG',1,1,1,'Photography',0,1,0),(144,'SGM_0327.JPG','/sunjoymonga/SGM_0327.JPG',1,1,1,'Photography',0,1,0),(145,'SGM_1314.JPG','/sunjoymonga/SGM_1314.JPG',1,1,1,'Photography',0,1,0),(146,'SGM_2732.JPG','/sunjoymonga/SGM_2732.JPG',1,1,1,'Photography',0,1,0),(147,'SGM_2827.JPG','/sunjoymonga/SGM_2827.JPG',1,1,1,'Photography',0,1,0),(148,'SGM_2829.JPG','/sunjoymonga/SGM_2829.JPG',1,1,1,'Photography',0,1,0),(149,'SGM_2922.JPG','/sunjoymonga/SGM_2922.JPG',1,1,1,'Photography',0,1,0),(150,'SGM_2974.JPG','/sunjoymonga/SGM_2974.JPG',1,1,1,'Photography',0,1,0),(151,'SGM_4652.JPG','/sunjoymonga/SGM_4652.JPG',1,1,1,'Photography',0,1,0),(152,'SGM_4660.JPG','/sunjoymonga/SGM_4660.JPG',1,1,1,'Photography',0,1,0),(153,'SGM_4750.JPG','/sunjoymonga/SGM_4750.JPG',1,1,1,'Photography',0,1,0),(154,'SGM_4759.JPG','/sunjoymonga/SGM_4759.JPG',1,1,1,'Photography',0,1,0),(155,'SGM_4785.JPG','/sunjoymonga/SGM_4785.JPG',1,1,1,'Photography',0,1,0),(156,'SGM_4924.JPG','/sunjoymonga/SGM_4924.JPG',1,1,1,'Photography',0,1,0),(157,'SGM_5102.JPG','/sunjoymonga/SGM_5102.JPG',1,1,1,'Photography',0,1,0),(158,'SGM_5109.JPG','/sunjoymonga/SGM_5109.JPG',1,1,1,'Photography',0,1,0),(159,'SGM_5115.JPG','/sunjoymonga/SGM_5115.JPG',1,1,1,'Photography',0,1,0),(160,'SGM_5149.JPG','/sunjoymonga/SGM_5149.JPG',1,1,1,'Photography',0,1,0),(161,'SGM_5259.JPG','/sunjoymonga/SGM_5259.JPG',1,1,1,'Photography',0,1,0),(162,'SGM_5264.JPG','/sunjoymonga/SGM_5264.JPG',1,1,1,'Photography',0,1,0),(163,'SGM_5776.JPG','/sunjoymonga/SGM_5776.JPG',1,1,1,'Photography',0,1,0),(164,'SGM_6105.JPG','/sunjoymonga/SGM_6105.JPG',1,1,1,'Photography',0,1,0),(165,'SGM_6456.JPG','/sunjoymonga/SGM_6456.JPG',1,1,1,'Photography',0,1,0),(166,'SGM_6464.JPG','/sunjoymonga/SGM_6464.JPG',1,1,1,'Photography',0,1,0),(167,'SGM_8339.JPG','/sunjoymonga/SGM_8339.JPG',1,1,1,'Photography',0,1,0),(168,'SGM_8473.JPG','/sunjoymonga/SGM_8473.JPG',1,1,1,'Photography',0,1,0),(169,'SGM_8474.JPG','/sunjoymonga/SGM_8474.JPG',1,1,1,'Photography',0,1,0),(170,'SGM_8475.JPG','/sunjoymonga/SGM_8475.JPG',1,1,1,'Photography',0,1,0),(171,'SGM_8479.JPG','/sunjoymonga/SGM_8479.JPG',1,1,1,'Photography',0,1,0),(172,'SGM_8823.JPG','/sunjoymonga/SGM_8823.JPG',1,1,1,'Photography',0,1,0),(173,'SGM_8824.JPG','/sunjoymonga/SGM_8824.JPG',1,1,1,'Photography',0,1,0),(174,'SGM_8825.JPG','/sunjoymonga/SGM_8825.JPG',1,1,1,'Photography',0,1,0),(175,'SGM_8851.JPG','/sunjoymonga/SGM_8851.JPG',1,1,1,'Photography',0,1,0),(176,'SGM_8858.JPG','/sunjoymonga/SGM_8858.JPG',1,1,1,'Photography',0,1,0),(177,'SGM_8859.JPG','/sunjoymonga/SGM_8859.JPG',1,1,1,'Photography',0,1,0),(178,'SGM_9456.JPG','/sunjoymonga/SGM_9456.JPG',1,1,1,'Photography',0,1,0),(179,'SGM_9459.JPG','/sunjoymonga/SGM_9459.JPG',1,1,1,'Photography',0,1,0),(180,'SGNP - ALONG PONGAM VALLEY, FOR SOUTH GATE TRAIL -','/sunjoymonga/SGNP - ALONG PONGAM VALLEY, FOR SOUTH GATE TRAIL - DSCF4278.JPG',1,1,1,'Photography',0,1,0),(181,'SGNP - ANY-DSC_3275.JPG','/sunjoymonga/SGNP - ANY-DSC_3275.JPG',1,1,1,'Photography',0,1,0),(182,'SGNP - Beetle on Commelina-DSC_3476.jpg','/sunjoymonga/SGNP - Beetle on Commelina-DSC_3476.jpg',1,1,1,'Photography',0,1,0),(183,'SGNP - FOREST CALOTES - YEUR-DSC_2177.JPG','/sunjoymonga/SGNP - FOREST CALOTES - YEUR-DSC_2177.JPG',1,1,1,'Photography',0,1,0),(184,'SGNP - KANHERI - DSCF3619.JPG','/sunjoymonga/SGNP - KANHERI - DSCF3619.JPG',1,1,1,'Photography',0,1,0),(185,'SGNP - KANHERI-DSCF3621.JPG','/sunjoymonga/SGNP - KANHERI-DSCF3621.JPG',1,1,1,'Photography',0,1,0),(186,'SGNP - NAGLA - DSC05068.JPG','/sunjoymonga/SGNP - NAGLA - DSC05068.JPG',1,1,1,'Photography',0,1,0),(187,'SGNP - ON WAY TO POWAI LAKE - DSC07743.jpg','/sunjoymonga/SGNP - ON WAY TO POWAI LAKE - DSC07743.jpg',1,1,1,'Photography',0,1,0),(188,'SGNP - SIDE TRAIL OFF SOUTH GATE - DSCF3864.JPG','/sunjoymonga/SGNP - SIDE TRAIL OFF SOUTH GATE - DSCF3864.JPG',1,1,1,'Photography',0,1,0),(189,'SGNP - SOUTH GATE TRAIL, NEAR PONGAM SLOPE TOP - D','/sunjoymonga/SGNP - SOUTH GATE TRAIL, NEAR PONGAM SLOPE TOP - DSC_5618.JPG',1,1,1,'Photography',0,1,0),(190,'SGNP - TULSI RD - YUH_0148.JPG','/sunjoymonga/SGNP - TULSI RD - YUH_0148.JPG',1,1,1,'Photography',0,1,0),(191,'SGNP - TWLS - DSC_2576.JPG','/sunjoymonga/SGNP - TWLS - DSC_2576.JPG',1,1,1,'Photography',0,1,0),(192,'SGNP-SOUTH GATE-DSC_6879.JPG','/sunjoymonga/SGNP-SOUTH GATE-DSC_6879.JPG',1,1,1,'Photography',0,1,0),(193,'SM-A-Steppe-DSC_0083.jpg','/sunjoymonga/SM-A-Steppe-DSC_0083.jpg',1,1,1,'Photography',0,1,0),(194,'SM-ALL-_ANV3036.jpg','/sunjoymonga/SM-ALL-_ANV3036.jpg',1,1,1,'Photography',0,1,0),(195,'SM-CWS-MPS_5841.jpg','/sunjoymonga/SM-CWS-MPS_5841.jpg',1,1,1,'Photography',0,1,0),(196,'SM-DD-sGNP-3.jpg','/sunjoymonga/SM-DD-sGNP-3.jpg',1,1,1,'Photography',0,1,0),(197,'SM-DSC_0002.JPG','/sunjoymonga/SM-DSC_0002.JPG',1,1,1,'Photography',0,1,0),(198,'SM-DSC_0015.JPG','/sunjoymonga/SM-DSC_0015.JPG',1,1,1,'Photography',0,1,0),(199,'SM-DSC_0046.JPG','/sunjoymonga/SM-DSC_0046.JPG',1,1,1,'Photography',0,1,0),(200,'SM-DSC_0047.JPG','/sunjoymonga/SM-DSC_0047.JPG',1,1,1,'Photography',0,1,0),(201,'SM-DSC_0061.JPG','/sunjoymonga/SM-DSC_0061.JPG',1,1,1,'Photography',0,1,0),(202,'SM-DSC_0063.JPG','/sunjoymonga/SM-DSC_0063.JPG',1,1,1,'Photography',0,1,0),(203,'SM-DSC_0064 2.JPG','/sunjoymonga/SM-DSC_0064 2.JPG',1,1,1,'Photography',0,1,0),(204,'SM-DSC_0064 3.JPG','/sunjoymonga/SM-DSC_0064 3.JPG',1,1,1,'Photography',0,1,0),(205,'SM-DSCF7087.JPG','/sunjoymonga/SM-DSCF7087.JPG',1,1,1,'Photography',0,1,0),(206,'SM-DSCF7096.JPG','/sunjoymonga/SM-DSCF7096.JPG',1,1,1,'Photography',0,1,0),(207,'SM-DSCF7468.JPG','/sunjoymonga/SM-DSCF7468.JPG',1,1,1,'Photography',0,1,0),(208,'SM-DSCF7515.JPG','/sunjoymonga/SM-DSCF7515.JPG',1,1,1,'Photography',0,1,0),(209,'SM-DSCF9140.JPG','/sunjoymonga/SM-DSCF9140.JPG',1,1,1,'Photography',0,1,0),(210,'SM-DSCF9141.JPG','/sunjoymonga/SM-DSCF9141.JPG',1,1,1,'Photography',0,1,0),(211,'SM-DSC_0064.JPG','/sunjoymonga/SM-DSC_0064.JPG',1,1,1,'Photography',0,1,0),(212,'SM-DSC_0066.JPG','/sunjoymonga/SM-DSC_0066.JPG',1,1,1,'Photography',0,1,0),(213,'SM-DSC_0068 2.JPG','/sunjoymonga/SM-DSC_0068 2.JPG',1,1,1,'Photography',0,1,0),(214,'SM-DSC_0068.JPG','/sunjoymonga/SM-DSC_0068.JPG',1,1,1,'Photography',0,1,0),(215,'SM-DSC_0070.JPG','/sunjoymonga/SM-DSC_0070.JPG',1,1,1,'Photography',0,1,0),(216,'SM-DSC_0081.JPG','/sunjoymonga/SM-DSC_0081.JPG',1,1,1,'Photography',0,1,0),(217,'SM-DSC_0090.JPG','/sunjoymonga/SM-DSC_0090.JPG',1,1,1,'Photography',0,1,0),(218,'SM-DSC_0096.JPG','/sunjoymonga/SM-DSC_0096.JPG',1,1,1,'Photography',0,1,0),(219,'SM-DSC_0113.JPG','/sunjoymonga/SM-DSC_0113.JPG',1,1,1,'Photography',0,1,0),(220,'SM-DSC_0116.JPG','/sunjoymonga/SM-DSC_0116.JPG',1,1,1,'Photography',0,1,0),(221,'SM-DSC_0117.JPG','/sunjoymonga/SM-DSC_0117.JPG',1,1,1,'Photography',0,1,0),(222,'SM-DSC_0118.JPG','/sunjoymonga/SM-DSC_0118.JPG',1,1,1,'Photography',0,1,0),(223,'SM-DSC_0119.JPG','/sunjoymonga/SM-DSC_0119.JPG',1,1,1,'Photography',0,1,0),(224,'SM-DSC_0122.JPG','/sunjoymonga/SM-DSC_0122.JPG',1,1,1,'Photography',0,1,0),(225,'SM-DSC_0126.JPG','/sunjoymonga/SM-DSC_0126.JPG',1,1,1,'Photography',0,1,0),(226,'SM-DSC_0194.JPG','/sunjoymonga/SM-DSC_0194.JPG',1,1,1,'Photography',0,1,0),(227,'SM-DSC_0198 2.JPG','/sunjoymonga/SM-DSC_0198 2.JPG',1,1,1,'Photography',0,1,0),(228,'SM-DSC_0199 2.JPG','/sunjoymonga/SM-DSC_0199 2.JPG',1,1,1,'Photography',0,1,0),(229,'SM-DSC_0255.JPG','/sunjoymonga/SM-DSC_0255.JPG',1,1,1,'Photography',0,1,0),(230,'SM-DSC_0273.JPG','/sunjoymonga/SM-DSC_0273.JPG',1,1,1,'Photography',0,1,0),(231,'SM-DSC_0306.JPG','/sunjoymonga/SM-DSC_0306.JPG',1,1,1,'Photography',0,1,0),(232,'SM-DSC_0358.JPG','/sunjoymonga/SM-DSC_0358.JPG',1,1,1,'Photography',0,1,0),(233,'SM-DSC_0659.JPG','/sunjoymonga/SM-DSC_0659.JPG',1,1,1,'Photography',0,1,0),(234,'SM-DSC_0721.JPG','/sunjoymonga/SM-DSC_0721.JPG',1,1,1,'Photography',0,1,0),(235,'SM-DSC_0813.JPG','/sunjoymonga/SM-DSC_0813.JPG',1,1,1,'Photography',0,1,0),(236,'SM-DSC_0866.JPG','/sunjoymonga/SM-DSC_0866.JPG',1,1,1,'Photography',0,1,0),(237,'SM-DSC_0867.JPG','/sunjoymonga/SM-DSC_0867.JPG',1,1,1,'Photography',0,1,0),(238,'SM-DSC_0879.JPG','/sunjoymonga/SM-DSC_0879.JPG',1,1,1,'Photography',0,1,0),(239,'SM-DSC_0887.JPG','/sunjoymonga/SM-DSC_0887.JPG',1,1,1,'Photography',0,1,0),(240,'SM-DSC_0919.JPG','/sunjoymonga/SM-DSC_0919.JPG',1,1,1,'Photography',0,1,0),(241,'SM-DSC_0927.JPG','/sunjoymonga/SM-DSC_0927.JPG',1,1,1,'Photography',0,1,0),(242,'SM-DSC_0928.JPG','/sunjoymonga/SM-DSC_0928.JPG',1,1,1,'Photography',0,1,0),(243,'SM-DSC_1032.JPG','/sunjoymonga/SM-DSC_1032.JPG',1,1,1,'Photography',0,1,0),(244,'SM-DSC_1159B.JPG','/sunjoymonga/SM-DSC_1159B.JPG',1,1,1,'Photography',0,1,0),(245,'SM-DSC_1166.JPG','/sunjoymonga/SM-DSC_1166.JPG',1,1,1,'Photography',0,1,0),(246,'SM-DSC_1210.JPG','/sunjoymonga/SM-DSC_1210.JPG',1,1,1,'Photography',0,1,0),(247,'SM-DSC_1293.JPG','/sunjoymonga/SM-DSC_1293.JPG',1,1,1,'Photography',0,1,0),(248,'SM-DSC_1435.JPG','/sunjoymonga/SM-DSC_1435.JPG',1,1,1,'Photography',0,1,0),(249,'SM-DSC_1462.JPG','/sunjoymonga/SM-DSC_1462.JPG',1,1,1,'Photography',0,1,0),(250,'SM-DSC_2095.JPG','/sunjoymonga/SM-DSC_2095.JPG',1,1,1,'Photography',0,1,0),(251,'SM-DSC_2266.JPG','/sunjoymonga/SM-DSC_2266.JPG',1,1,1,'Photography',0,1,0),(252,'SM-DSC_2354.JPG','/sunjoymonga/SM-DSC_2354.JPG',1,1,1,'Photography',0,1,0),(253,'SM-DSC_3227.JPG','/sunjoymonga/SM-DSC_3227.JPG',1,1,1,'Photography',0,1,0),(254,'SM-DSC_7804.JPG','/sunjoymonga/SM-DSC_7804.JPG',1,1,1,'Photography',0,1,0),(255,'SM-DSC_7931 2.JPG','/sunjoymonga/SM-DSC_7931 2.JPG',1,1,1,'Photography',0,1,0),(256,'SM-DSC_8522.jpg','/sunjoymonga/SM-DSC_8522.jpg',1,1,1,'Photography',0,1,0),(257,'SM-DSC_8748.JPG','/sunjoymonga/SM-DSC_8748.JPG',1,1,1,'Photography',0,1,0),(258,'SM-DSC_8784.JPG','/sunjoymonga/SM-DSC_8784.JPG',1,1,1,'Photography',0,1,0),(259,'SM-DSC_8786.JPG','/sunjoymonga/SM-DSC_8786.JPG',1,1,1,'Photography',0,1,0),(260,'SM-DSC_9642.JPG','/sunjoymonga/SM-DSC_9642.JPG',1,1,1,'Photography',0,1,0),(261,'SM-DSC_9680.JPG','/sunjoymonga/SM-DSC_9680.JPG',1,1,1,'Photography',0,1,0),(262,'SM-Eurasian Griffon - 1.jpg','/sunjoymonga/SM-Eurasian Griffon - 1.jpg',1,1,1,'Photography',0,1,0),(263,'SM-Eurasian Griffon - 2.jpg','/sunjoymonga/SM-Eurasian Griffon - 2.jpg',1,1,1,'Photography',0,1,0),(264,'SM-Eurasian Griffon - 3.jpg','/sunjoymonga/SM-Eurasian Griffon - 3.jpg',1,1,1,'Photography',0,1,0),(265,'SM-Gulmohur display on the Gandhi Tekdi hill of Na','/sunjoymonga/SM-Gulmohur display on the Gandhi Tekdi hill of National Park, near Borivili highway.jpg',1,1,1,'Photography',0,1,0),(266,'SM-Hill Turmeric Flowers.jpg','/sunjoymonga/SM-Hill Turmeric Flowers.jpg',1,1,1,'Photography',0,1,0),(267,'SM-MAHARASHTRA - WILD DOGS - MPS_2483.JPG','/sunjoymonga/SM-MAHARASHTRA - WILD DOGS - MPS_2483.JPG',1,1,1,'Photography',0,1,0),(268,'SM-MPS_5679.JPG','/sunjoymonga/SM-MPS_5679.JPG',1,1,1,'Photography',0,1,0),(269,'SM-MPS_6023.JPG','/sunjoymonga/SM-MPS_6023.JPG',1,1,1,'Photography',0,1,0),(270,'SM-MPS_6048.JPG','/sunjoymonga/SM-MPS_6048.JPG',1,1,1,'Photography',0,1,0),(271,'SM-MPS_6154.JPG','/sunjoymonga/SM-MPS_6154.JPG',1,1,1,'Photography',0,1,0),(272,'SM-MS-DSC07640.JPG','/sunjoymonga/SM-MS-DSC07640.JPG',1,1,1,'Photography',0,1,0),(273,'SM-On mountain top plateaus around Mumbai a riot o','/sunjoymonga/SM-On mountain top plateaus around Mumbai a riot of blooms can be seen nowDSCF5261.jpg',1,1,1,'Photography',0,1,0),(274,'SM-Osprey_YUH6411 2.jpg','/sunjoymonga/SM-Osprey_YUH6411 2.jpg',1,1,1,'Photography',0,1,0),(275,'SM-Sambar, India\'s largest deer, in tangled forest','/sunjoymonga/SM-Sambar, India\'s largest deer, in tangled forest - YUH_5745.jpg',1,1,1,'Photography',0,1,0),(276,'SM-SGNP - PG 21 VERTICAL OPTION - DSCF7500.JPG','/sunjoymonga/SM-SGNP - PG 21 VERTICAL OPTION - DSCF7500.JPG',1,1,1,'Photography',0,1,0),(277,'SM-SMYUH_9402.JPG','/sunjoymonga/SM-SMYUH_9402.JPG',1,1,1,'Photography',0,1,0),(278,'SM-Spider Web with waterdrops_YUH2337.jpg','/sunjoymonga/SM-Spider Web with waterdrops_YUH2337.jpg',1,1,1,'Photography',0,1,0),(279,'SM-YUH_0489.JPG','/sunjoymonga/SM-YUH_0489.JPG',1,1,1,'Photography',0,1,0),(280,'SM-YUH_0555.JPG','/sunjoymonga/SM-YUH_0555.JPG',1,1,1,'Photography',0,1,0),(281,'SM-YUH_0874.JPG','/sunjoymonga/SM-YUH_0874.JPG',1,1,1,'Photography',0,1,0),(282,'SM-YUH_0875.JPG','/sunjoymonga/SM-YUH_0875.JPG',1,1,1,'Photography',0,1,0),(283,'SM-YUH_0958.JPG','/sunjoymonga/SM-YUH_0958.JPG',1,1,1,'Photography',0,1,0),(284,'SM-YUH_0978.JPG','/sunjoymonga/SM-YUH_0978.JPG',1,1,1,'Photography',0,1,0),(285,'SM-YUH_2266.JPG','/sunjoymonga/SM-YUH_2266.JPG',1,1,1,'Photography',0,1,0),(286,'SM-YUH_2408.JPG','/sunjoymonga/SM-YUH_2408.JPG',1,1,1,'Photography',0,1,0),(287,'SM-YUH_2583.JPG','/sunjoymonga/SM-YUH_2583.JPG',1,1,1,'Photography',0,1,0),(288,'SM-YUH_4345.JPG','/sunjoymonga/SM-YUH_4345.JPG',1,1,1,'Photography',0,1,0),(289,'SM-YUH_4365.JPG','/sunjoymonga/SM-YUH_4365.JPG',1,1,1,'Photography',0,1,0),(290,'SM-YUH_4368.JPG','/sunjoymonga/SM-YUH_4368.JPG',1,1,1,'Photography',0,1,0),(291,'SM-YUH_4375.JPG','/sunjoymonga/SM-YUH_4375.JPG',1,1,1,'Photography',0,1,0),(292,'SM-YUH_4377.JPG','/sunjoymonga/SM-YUH_4377.JPG',1,1,1,'Photography',0,1,0),(293,'SM-YUH_4382.JPG','/sunjoymonga/SM-YUH_4382.JPG',1,1,1,'Photography',0,1,0),(294,'SM-YUH_4384.JPG','/sunjoymonga/SM-YUH_4384.JPG',1,1,1,'Photography',0,1,0),(295,'SM-YUH_4392.JPG','/sunjoymonga/SM-YUH_4392.JPG',1,1,1,'Photography',0,1,0),(296,'SM-YUH_4693.JPG','/sunjoymonga/SM-YUH_4693.JPG',1,1,1,'Photography',0,1,0),(297,'SM-YUH_4698.JPG','/sunjoymonga/SM-YUH_4698.JPG',1,1,1,'Photography',0,1,0),(298,'SM-YUH_4706.JPG','/sunjoymonga/SM-YUH_4706.JPG',1,1,1,'Photography',0,1,0),(299,'SM-YUH_4721.JPG','/sunjoymonga/SM-YUH_4721.JPG',1,1,1,'Photography',0,1,0),(300,'SM-YUH1426--104.jpg','/sunjoymonga/SM-YUH1426--104.jpg',1,1,1,'Photography',0,1,0),(301,'SM-YUH_4741.JPG','/sunjoymonga/SM-YUH_4741.JPG',1,1,1,'Photography',0,1,0),(302,'SM-YUH_4750.JPG','/sunjoymonga/SM-YUH_4750.JPG',1,1,1,'Photography',0,1,0),(303,'SM-YUH_4761.JPG','/sunjoymonga/SM-YUH_4761.JPG',1,1,1,'Photography',0,1,0),(304,'SM-YUH_4855.JPG','/sunjoymonga/SM-YUH_4855.JPG',1,1,1,'Photography',0,1,0),(305,'SM-YUH_5304.jpg','/sunjoymonga/SM-YUH_5304.jpg',1,1,1,'Photography',0,1,0),(306,'SM-YUH_5304.NEF','/sunjoymonga/SM-YUH_5304.NEF',1,1,1,'Photography',0,1,0),(307,'SM-YUH_5307t.tif','/sunjoymonga/SM-YUH_5307t.tif',1,1,1,'Photography',0,1,0),(308,'SM-YUH_5366.JPG','/sunjoymonga/SM-YUH_5366.JPG',1,1,1,'Photography',0,1,0),(309,'SM-YUH_5368.JPG','/sunjoymonga/SM-YUH_5368.JPG',1,1,1,'Photography',0,1,0),(310,'SM-YUH_5617.JPG','/sunjoymonga/SM-YUH_5617.JPG',1,1,1,'Photography',0,1,0),(311,'SM-YUH_5620.JPG','/sunjoymonga/SM-YUH_5620.JPG',1,1,1,'Photography',0,1,0),(312,'SM-YUH_5686.JPG','/sunjoymonga/SM-YUH_5686.JPG',1,1,1,'Photography',0,1,0),(313,'SM-YUH_5745t.tif','/sunjoymonga/SM-YUH_5745t.tif',1,1,1,'Photography',0,1,0),(314,'SM-YUH_5868.JPG','/sunjoymonga/SM-YUH_5868.JPG',1,1,1,'Photography',0,1,0),(315,'SM-YUH_6470t.tif','/sunjoymonga/SM-YUH_6470t.tif',1,1,1,'Photography',0,1,0),(316,'SM-YUH_6471t.tif','/sunjoymonga/SM-YUH_6471t.tif',1,1,1,'Photography',0,1,0),(317,'SM-YUH_6962.JPG','/sunjoymonga/SM-YUH_6962.JPG',1,1,1,'Photography',0,1,0),(318,'SM-YUH_7610.JPG','/sunjoymonga/SM-YUH_7610.JPG',1,1,1,'Photography',0,1,0),(319,'SM-YUH_7618.JPG','/sunjoymonga/SM-YUH_7618.JPG',1,1,1,'Photography',0,1,0),(320,'SM-YUH_7659.JPG','/sunjoymonga/SM-YUH_7659.JPG',1,1,1,'Photography',0,1,0),(321,'SM-YUH_7792.JPG','/sunjoymonga/SM-YUH_7792.JPG',1,1,1,'Photography',0,1,0),(322,'SM-YUH_7870.JPG','/sunjoymonga/SM-YUH_7870.JPG',1,1,1,'Photography',0,1,0),(323,'SM-YUH_7871.JPG','/sunjoymonga/SM-YUH_7871.JPG',1,1,1,'Photography',0,1,0),(324,'SM-YUH_7945.JPG','/sunjoymonga/SM-YUH_7945.JPG',1,1,1,'Photography',0,1,0),(325,'SM-YUH_8072.JPG','/sunjoymonga/SM-YUH_8072.JPG',1,1,1,'Photography',0,1,0),(326,'SM-YUH_8084.JPG','/sunjoymonga/SM-YUH_8084.JPG',1,1,1,'Photography',0,1,0),(327,'SM-YUH_8112.JPG','/sunjoymonga/SM-YUH_8112.JPG',1,1,1,'Photography',0,1,0),(328,'SM-YUH_8243.JPG','/sunjoymonga/SM-YUH_8243.JPG',1,1,1,'Photography',0,1,0),(329,'SM-YUH_8614.JPG','/sunjoymonga/SM-YUH_8614.JPG',1,1,1,'Photography',0,1,0),(330,'SM-YUH_9024.JPG','/sunjoymonga/SM-YUH_9024.JPG',1,1,1,'Photography',0,1,0),(331,'SM_DSC0094.JPG','/sunjoymonga/SM_DSC0094.JPG',1,1,1,'Photography',0,1,0),(332,'SM_YUH2339.jpg','/sunjoymonga/SM_YUH2339.jpg',1,1,1,'Photography',0,1,0),(333,'SM-lr_ANV0144.jpg','/sunjoymonga/SM-lr_ANV0144.jpg',1,1,1,'Photography',0,1,0),(334,'SM-lr_ANV0557.jpg','/sunjoymonga/SM-lr_ANV0557.jpg',1,1,1,'Photography',0,1,0),(335,'SM-lr_ANV0603.jpg','/sunjoymonga/SM-lr_ANV0603.jpg',1,1,1,'Photography',0,1,0),(336,'SM-lr-Imperial-MPS_7151.jpg','/sunjoymonga/SM-lr-Imperial-MPS_7151.jpg',1,1,1,'Photography',0,1,0),(337,'SM-lr-Kestrel-MPS_7234.jpg','/sunjoymonga/SM-lr-Kestrel-MPS_7234.jpg',1,1,1,'Photography',0,1,0),(338,'SM-lr-LRP-MPS_7327.jpg','/sunjoymonga/SM-lr-LRP-MPS_7327.jpg',1,1,1,'Photography',0,1,0),(339,'SM-lr-MPS_6027.jpg','/sunjoymonga/SM-lr-MPS_6027.jpg',1,1,1,'Photography',0,1,0),(340,'SM-lr-MPS_6051.jpg','/sunjoymonga/SM-lr-MPS_6051.jpg',1,1,1,'Photography',0,1,0),(341,'SM-YUH_9026.JPG','/sunjoymonga/SM-YUH_9026.JPG',1,1,1,'Photography',0,1,0),(342,'SM-YUH_9027.JPG','/sunjoymonga/SM-YUH_9027.JPG',1,1,1,'Photography',0,1,0),(343,'SM-YUH_9031.JPG','/sunjoymonga/SM-YUH_9031.JPG',1,1,1,'Photography',0,1,0),(344,'SM-YUH_9132.JPG','/sunjoymonga/SM-YUH_9132.JPG',1,1,1,'Photography',0,1,0),(345,'SM-YUH_9261.JPG','/sunjoymonga/SM-YUH_9261.JPG',1,1,1,'Photography',0,1,0),(346,'SM-YUH_9361.JPG','/sunjoymonga/SM-YUH_9361.JPG',1,1,1,'Photography',0,1,0),(347,'SM-YUH_9411.JPG','/sunjoymonga/SM-YUH_9411.JPG',1,1,1,'Photography',0,1,0),(348,'SM-YUH_9811.JPG','/sunjoymonga/SM-YUH_9811.JPG',1,1,1,'Photography',0,1,0),(349,'SM-YUH_9865.JPG','/sunjoymonga/SM-YUH_9865.JPG',1,1,1,'Photography',0,1,0),(350,'SM.JPG','/sunjoymonga/SM.JPG',1,1,1,'Photography',0,1,0),(351,'Tp050 (2).jpg','/sunjoymonga/Tp050 (2).jpg',1,1,1,'Photography',0,1,0),(352,'Tp054 (2).jpg','/sunjoymonga/Tp054 (2).jpg',1,1,1,'Photography',0,1,0),(353,'Uranid Moth.jpg','/sunjoymonga/Uranid Moth.jpg',1,1,1,'Photography',0,1,0),(354,'WADA AREA -DSCF4659.JPG','/sunjoymonga/WADA AREA -DSCF4659.JPG',1,1,1,'Photography',0,1,0),(355,'YUH_0106.JPG','/sunjoymonga/YUH_0106.JPG',1,1,1,'Photography',0,1,0),(356,'YUH_0147.JPG','/sunjoymonga/YUH_0147.JPG',1,1,1,'Photography',0,1,0),(357,'YUH_0149.JPG','/sunjoymonga/YUH_0149.JPG',1,1,1,'Photography',0,1,0),(358,'YUH_0152.JPG','/sunjoymonga/YUH_0152.JPG',1,1,1,'Photography',0,1,0),(359,'YUH_0200.JPG','/sunjoymonga/YUH_0200.JPG',1,1,1,'Photography',0,1,0),(360,'YUH_0215.JPG','/sunjoymonga/YUH_0215.JPG',1,1,1,'Photography',0,1,0),(361,'_ANV1576.JPG-Bharatpur.JPG','/sunjoymonga/_ANV1576.JPG-Bharatpur.JPG',1,1,1,'Photography',0,1,0),(362,'_ANV1596.JPG-Bharatpur.JPG','/sunjoymonga/_ANV1596.JPG-Bharatpur.JPG',1,1,1,'Photography',0,1,0),(363,'_DSC0014.JPG','/sunjoymonga/_DSC0014.JPG',1,1,1,'Photography',0,1,0),(364,'_DSC0274.JPG','/sunjoymonga/_DSC0274.JPG',1,1,1,'Photography',0,1,0),(365,'_DSC0276.JPG','/sunjoymonga/_DSC0276.JPG',1,1,1,'Photography',0,1,0),(366,'_DSC0278.JPG','/sunjoymonga/_DSC0278.JPG',1,1,1,'Photography',0,1,0),(367,'_DSC3860.jpg','/sunjoymonga/_DSC3860.jpg',1,1,1,'Photography',0,1,0),(368,'_DSC3866.jpg','/sunjoymonga/_DSC3866.jpg',1,1,1,'Photography',0,1,0),(369,'_DSC38661.jpg','/sunjoymonga/_DSC38661.jpg',1,1,1,'Photography',0,1,0),(370,'_DSC3892.jpg','/sunjoymonga/_DSC3892.jpg',1,1,1,'Photography',0,1,0),(371,'YUH_0239.JPG','/sunjoymonga/YUH_0239.JPG',1,1,1,'Photography',0,1,0),(372,'YUH_0266.JPG','/sunjoymonga/YUH_0266.JPG',1,1,1,'Photography',0,1,0),(373,'YUH_0272.JPG','/sunjoymonga/YUH_0272.JPG',1,1,1,'Photography',0,1,0),(374,'YUH_0874.JPG','/sunjoymonga/YUH_0874.JPG',1,1,1,'Photography',0,1,0),(375,'YUH_0982.JPG','/sunjoymonga/YUH_0982.JPG',1,1,1,'Photography',0,1,0),(376,'YUH_1263.JPG','/sunjoymonga/YUH_1263.JPG',1,1,1,'Photography',0,1,0),(377,'YUH_1274.JPG','/sunjoymonga/YUH_1274.JPG',1,1,1,'Photography',0,1,0),(378,'YUH_1449.JPG','/sunjoymonga/YUH_1449.JPG',1,1,1,'Photography',0,1,0),(379,'YUH_1913.JPG','/sunjoymonga/YUH_1913.JPG',1,1,1,'Photography',0,1,0),(380,'YUH_1914.JPG','/sunjoymonga/YUH_1914.JPG',1,1,1,'Photography',0,1,0),(381,'YUH_3690 2.JPG','/sunjoymonga/YUH_3690 2.JPG',1,1,1,'Photography',0,1,0);
/*!40000 ALTER TABLE `artworkdetails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `m-category`
--

DROP TABLE IF EXISTS `m-category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `m-category` (
  `CategoryId` int NOT NULL,
  `CategoryName` varchar(50) NOT NULL,
  `Description` varchar(100) NOT NULL,
  `IsDeleted` tinyint(1) NOT NULL,
  `Ranking` int DEFAULT NULL,
  `CreatedAt` date NOT NULL,
  `UpdatedAt` date DEFAULT NULL,
  PRIMARY KEY (`CategoryId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `m-category`
--

LOCK TABLES `m-category` WRITE;
/*!40000 ALTER TABLE `m-category` DISABLE KEYS */;
INSERT INTO `m-category` VALUES (1,'Photography','Section For Photographs',0,1,'2022-02-23','2022-02-23'),(2,'Paintings','Section For Paintings',0,2,'2022-02-23','2022-02-23'),(3,'Digital Art','Section For Digital Art',0,3,'2022-02-23','2022-02-23');
/*!40000 ALTER TABLE `m-category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `m-collection`
--

DROP TABLE IF EXISTS `m-collection`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `m-collection` (
  `CollectionId` int NOT NULL,
  `CollectionName` varchar(50) NOT NULL,
  `Description` varchar(550) NOT NULL,
  `IsActive` tinyint(1) NOT NULL,
  `IsDeleted` tinyint(1) NOT NULL,
  `CreatedAt` date NOT NULL,
  `UpdatedAt` date DEFAULT NULL,
  PRIMARY KEY (`CollectionId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `m-collection`
--

LOCK TABLES `m-collection` WRITE;
/*!40000 ALTER TABLE `m-collection` DISABLE KEYS */;
INSERT INTO `m-collection` VALUES (1,'From Sunjoy Monga','Photographs from Sunjoy Monga ',1,0,'2022-02-23','2022-02-23');
/*!40000 ALTER TABLE `m-collection` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `m-shortlists`
--

DROP TABLE IF EXISTS `m-shortlists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `m-shortlists` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `ShortlistName` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `CraetedAt` date NOT NULL,
  `UpdatedAt` date DEFAULT NULL,
  `IsActive` tinyint(1) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `m-shortlists`
--

LOCK TABLES `m-shortlists` WRITE;
/*!40000 ALTER TABLE `m-shortlists` DISABLE KEYS */;
INSERT INTO `m-shortlists` VALUES (1,'Level 1','2022-03-15','2022-03-15',1),(2,'Level 2','2022-03-15','2022-03-15',1),(3,'Level 3','2022-03-15','2022-03-21',1);
/*!40000 ALTER TABLE `m-shortlists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `m-subcategory`
--

DROP TABLE IF EXISTS `m-subcategory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `m-subcategory` (
  `SubCategoryId` int NOT NULL,
  `SubCategoryName` varchar(100) NOT NULL,
  `Description` varchar(50) DEFAULT NULL,
  `CategoryId` int NOT NULL,
  `IsDeleted` tinyint(1) NOT NULL,
  `CreatedAt` date NOT NULL,
  `UpdatedAt` date DEFAULT NULL,
  PRIMARY KEY (`SubCategoryId`),
  KEY `FK_SubCategory_Category` (`CategoryId`),
  CONSTRAINT `FK_SubCategory_Category` FOREIGN KEY (`CategoryId`) REFERENCES `m-category` (`CategoryId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `m-subcategory`
--

LOCK TABLES `m-subcategory` WRITE;
/*!40000 ALTER TABLE `m-subcategory` DISABLE KEYS */;
INSERT INTO `m-subcategory` VALUES (1,'Water','Water Photography',1,0,'2022-02-23','2022-02-23'),(2,'Landscape','Landscape Photography',1,0,'2022-02-23','2022-02-23'),(3,'Wildlife','Wildlife Photography',1,0,'2022-02-23','2022-02-23'),(4,'Flora','Flora Photography',1,0,'2022-02-23','2022-02-23'),(5,'Architecture','Architecture Photography',1,0,'2022-02-23','2022-02-23'),(6,'Interior','Interior Photography',1,0,'2022-02-23','2022-02-23'),(7,'Outdoor','Outdoor Photography',1,0,'2022-02-23','2022-02-23'),(8,'Street','Street Photography',1,0,'2022-02-23','2022-02-23'),(9,'Cultural','Cultural Photography',1,0,'2022-02-23','2022-02-23'),(10,'Abstract','Abstract Photography',1,0,'2022-02-23','2022-02-23'),(11,'Portraits','Portraits Photography',1,0,'2022-02-23','2022-02-23');
/*!40000 ALTER TABLE `m-subcategory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
INSERT INTO `personal_access_tokens` VALUES (1,'App\\Models\\User',1,'laravel_api','efc02419ee00462c2a509df95b1a5276f4bb498d2c643765541142181ef30ee9','[\"*\"]','2022-03-23 10:44:14','2022-03-23 10:44:14','2022-03-23 10:44:14'),(2,'App\\Models\\User',1,'laravel_api','aeb9673bfb924cb557a74fb11b58dff1af24255fc643999a65bab677ebbb1ab4','[\"*\"]','2022-03-23 11:03:46','2022-03-23 10:45:08','2022-03-23 11:03:46');
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shortlisedartworks`
--

DROP TABLE IF EXISTS `shortlisedartworks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `shortlisedartworks` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `UserId` int NOT NULL,
  `ArtworkId` int NOT NULL,
  `SortlistId` int NOT NULL DEFAULT '1',
  `Comment` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `FK_ShortlisedArtworks_UserLogin` (`UserId`),
  KEY `FK_ShortlisedArtworks_ArtworkDetails` (`ArtworkId`),
  CONSTRAINT `FK_ShortlisedArtworks_ArtworkDetails` FOREIGN KEY (`ArtworkId`) REFERENCES `artworkdetails` (`ArtworkId`),
  CONSTRAINT `FK_ShortlisedArtworks_UserLogin` FOREIGN KEY (`UserId`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shortlisedartworks`
--

LOCK TABLES `shortlisedartworks` WRITE;
/*!40000 ALTER TABLE `shortlisedartworks` DISABLE KEYS */;
INSERT INTO `shortlisedartworks` VALUES (1,1,1,1,'comment'),(2,1,2,1,'comment'),(3,1,3,1,'comment'),(4,1,4,1,'comment'),(5,1,7,1,'comment'),(6,1,8,1,'comment'),(7,1,1,2,'comment'),(8,1,4,2,'comment'),(9,1,7,2,'comment'),(10,1,8,2,'comment'),(11,1,3,2,'comment');
/*!40000 ALTER TABLE `shortlisedartworks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'L.C Singh','lcs@nihilent.com','lcs','+911234567890',1,0,NULL,'$2y$10$dXr//ntTbnoeHOexv03NeeZUy8dFagPVxkviCY1bsypwWwas5WbwW',NULL,'2022-03-17 04:38:51','2022-03-17 04:38:51');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usersession`
--

DROP TABLE IF EXISTS `usersession`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usersession` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `CollectionId` int NOT NULL,
  `UserId` int NOT NULL,
  `ShortlistId` int DEFAULT NULL,
  `Position` int NOT NULL,
  `CreatedAt` date NOT NULL,
  `UpdatedAt` date DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `FK_JudgeSession_Collection` (`CollectionId`),
  KEY `FK_UserID` (`UserId`),
  KEY `FK_ShortlistId` (`ShortlistId`),
  CONSTRAINT `FK_JudgeSession_Collection` FOREIGN KEY (`CollectionId`) REFERENCES `m-collection` (`CollectionId`),
  CONSTRAINT `FK_ShortlistId` FOREIGN KEY (`ShortlistId`) REFERENCES `m-shortlists` (`Id`),
  CONSTRAINT `FK_UserID` FOREIGN KEY (`UserId`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usersession`
--

LOCK TABLES `usersession` WRITE;
/*!40000 ALTER TABLE `usersession` DISABLE KEYS */;
INSERT INTO `usersession` VALUES (1,1,1,1,2,'2022-03-23','2022-03-23'),(2,1,1,2,1,'2022-03-23','2022-03-23');
/*!40000 ALTER TABLE `usersession` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-03-23 11:11:32
