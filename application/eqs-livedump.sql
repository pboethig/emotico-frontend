-- MySQL dump 10.13  Distrib 5.7.18, for Linux (x86_64)
--
-- Host: localhost    Database: default
-- ------------------------------------------------------
-- Server version	5.7.18

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `companies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companies`
--

LOCK TABLES `companies` WRITE;
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
INSERT INTO `companies` VALUES (1,'EQS Group','2017-06-02 22:23:27','2017-06-03 09:10:56',NULL,'companies/June2017/ykIkCyH8692DicwKNOef.png'),(2,'BWM Group','2017-06-03 09:14:27','2017-06-03 09:14:27',NULL,'companies/June2017/eXKguvfVj2qfSbFfj2tn.jpg'),(3,'Billfinger und Berger','2017-06-03 09:17:33','2017-06-03 09:17:33',NULL,'companies/June2017/8k3myQSKJfNrEHZgXLh0.jpg'),(4,'Audi','2017-06-04 07:40:09','2017-06-04 07:40:09',NULL,'companies/June2017/R2RFJeL7SxWgrBNRxPYv.png');
/*!40000 ALTER TABLE `companies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_rows`
--

DROP TABLE IF EXISTS `data_rows`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_rows` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `data_type_id` int(10) unsigned NOT NULL,
  `field` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `required` tinyint(1) NOT NULL DEFAULT '0',
  `browse` tinyint(1) NOT NULL DEFAULT '1',
  `read` tinyint(1) NOT NULL DEFAULT '1',
  `edit` tinyint(1) NOT NULL DEFAULT '1',
  `add` tinyint(1) NOT NULL DEFAULT '1',
  `delete` tinyint(1) NOT NULL DEFAULT '1',
  `details` text COLLATE utf8mb4_unicode_ci,
  `order` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `data_rows_data_type_id_foreign` (`data_type_id`),
  CONSTRAINT `data_rows_data_type_id_foreign` FOREIGN KEY (`data_type_id`) REFERENCES `data_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=141 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_rows`
--

LOCK TABLES `data_rows` WRITE;
/*!40000 ALTER TABLE `data_rows` DISABLE KEYS */;
INSERT INTO `data_rows` VALUES (14,2,'id','number','id',1,0,0,0,0,0,'',1),(15,2,'author_id','text','author_id',1,0,0,0,0,0,'',2),(16,2,'title','text','title',1,1,1,1,1,1,'',3),(17,2,'excerpt','text_area','excerpt',1,0,1,1,1,1,'',4),(18,2,'body','rich_text_box','body',1,0,1,1,1,1,'',5),(19,2,'slug','text','slug',1,0,1,1,1,1,'{\"slugify\":{\"origin\":\"title\"}}',6),(20,2,'meta_description','text','meta_description',1,0,1,1,1,1,'',7),(21,2,'meta_keywords','text','meta_keywords',1,0,1,1,1,1,'',8),(22,2,'status','select_dropdown','status',1,1,1,1,1,1,'{\"default\":\"INACTIVE\",\"options\":{\"INACTIVE\":\"INACTIVE\",\"ACTIVE\":\"ACTIVE\"}}',9),(23,2,'created_at','timestamp','created_at',1,1,1,0,0,0,'',10),(24,2,'updated_at','timestamp','updated_at',1,0,0,0,0,0,'',11),(25,2,'image','image','image',0,1,1,1,1,1,'',12),(26,3,'id','number','id',1,0,0,0,0,0,'',1),(27,3,'name','text','name',1,1,1,1,1,1,'',2),(28,3,'email','text','email',1,1,1,1,1,1,'',3),(29,3,'password','password','password',1,0,0,1,1,0,'',4),(30,3,'remember_token','text','remember_token',0,0,0,0,0,0,'',5),(31,3,'created_at','timestamp','created_at',0,1,1,0,0,0,'',6),(32,3,'updated_at','timestamp','updated_at',0,0,0,0,0,0,'',7),(33,3,'avatar','image','avatar',0,1,1,1,1,1,'',8),(34,5,'id','number','id',1,0,0,0,0,0,'',1),(35,5,'name','text','name',1,1,1,1,1,1,'',2),(36,5,'created_at','timestamp','created_at',0,0,0,0,0,0,'',3),(37,5,'updated_at','timestamp','updated_at',0,0,0,0,0,0,'',4),(45,6,'id','number','id',1,0,0,0,0,0,'',1),(46,6,'name','text','Name',1,1,1,1,1,1,'',2),(47,6,'created_at','timestamp','created_at',0,0,0,0,0,0,'',3),(48,6,'updated_at','timestamp','updated_at',0,0,0,0,0,0,'',4),(49,6,'display_name','text','Display Name',1,1,1,1,1,1,'',5),(52,3,'role_id','text','role_id',1,1,1,1,1,1,'',9),(61,10,'id','checkbox','Id',1,1,1,0,0,0,NULL,1),(62,10,'name','checkbox','Name',0,1,1,1,1,1,NULL,2),(63,10,'created_at','timestamp','Created At',0,1,1,1,0,1,NULL,3),(64,10,'updated_at','timestamp','Updated At',0,0,0,0,0,0,NULL,4),(65,10,'deleted_at','timestamp','Deleted At',0,1,1,1,1,1,NULL,5),(71,12,'id','checkbox','Id',1,0,1,0,0,0,NULL,2),(72,12,'name','text','Name',0,1,1,1,1,1,NULL,3),(73,12,'created_at','timestamp','Created At',0,1,1,0,0,0,NULL,4),(74,12,'updated_at','timestamp','Updated At',0,1,1,0,0,0,NULL,5),(75,12,'deleted_at','timestamp','Deleted At',0,1,1,0,0,0,NULL,6),(85,12,'logo','image','Logo',0,1,1,1,1,1,NULL,1),(95,15,'id','checkbox','Id',1,0,1,0,0,0,NULL,1),(96,15,'name','text','Name',0,1,1,1,1,1,NULL,4),(97,15,'created_at','timestamp','Created At',0,0,0,0,0,0,NULL,5),(98,15,'updated_at','timestamp','Updated At',0,0,0,0,0,0,NULL,6),(99,15,'deleted_at','timestamp','Deleted At',0,0,0,0,0,0,NULL,7),(100,15,'price','text','Price',0,1,1,1,1,1,NULL,8),(101,15,'currency','select_dropdown','Currency',0,1,1,1,1,1,'{\"default\":\"option1\",\"options\":{\"option1\":\"EURO\",\"option2\":\"USD\"}}',9),(102,15,'type','select_dropdown','Type',0,1,1,1,1,1,'{\"default\":\"option1\",\"options\":{\"option1\":\"Common\",\"option2\":\"Prefered\"}}',10),(103,15,'company_id','select_dropdown','Company Id',0,1,1,1,1,1,'{\"relationship\":{\"key\":\"id\",\"label\":\"name\"}}',11),(104,16,'id','checkbox','Id',1,0,1,0,0,0,NULL,1),(105,16,'name','text','Name',0,1,1,1,1,1,NULL,2),(106,16,'created_at','timestamp','Created At',0,1,1,0,0,0,NULL,3),(107,16,'updated_at','timestamp','Updated At',0,1,0,0,0,0,NULL,4),(108,16,'deleted_at','timestamp','Deleted At',0,1,1,0,0,0,NULL,5),(109,17,'id','checkbox','Id',1,0,0,0,0,0,NULL,1),(110,17,'stock_id','select_dropdown','Stock Id',1,1,1,1,1,1,'{\"relationship\":{\"key\":\"id\",\"label\":\"name\"}}',2),(111,17,'exchange_id','select_dropdown','Exchange Id',1,1,1,1,1,1,'{\"relationship\":{\"key\":\"id\",\"label\":\"name\"}}',3),(112,17,'price','number','Price',1,1,1,1,1,1,NULL,4),(113,17,'created_at','timestamp','Created At',0,1,1,0,0,0,NULL,5),(114,17,'updated_at','timestamp','Updated At',0,0,0,0,0,0,NULL,6),(115,19,'id','checkbox','Id',1,0,0,0,0,0,NULL,1),(118,19,'price','number','Price',1,1,1,1,1,1,NULL,5),(119,19,'created_at','timestamp','Created At',0,1,1,0,0,0,NULL,6),(120,19,'updated_at','timestamp','Updated At',0,0,0,0,0,0,NULL,7),(123,19,'stock_id','select_dropdown','Stock Id',1,1,1,1,1,1,'{\"relationship\":{\"key\":\"id\",\"label\":\"name\"}}',4),(124,19,'exchange_id','select_dropdown','Exchange Id',1,1,1,1,1,1,'{\"relationship\":{\"key\":\"id\",\"label\":\"name\"}}',3),(125,20,'id','checkbox','Id',1,0,0,0,0,0,NULL,2),(126,20,'name','text','Name',0,1,1,1,1,1,NULL,3),(127,20,'created_at','timestamp','Created At',0,1,1,0,0,0,NULL,4),(128,20,'updated_at','timestamp','Updated At',0,1,1,0,0,0,NULL,5),(129,20,'deleted_at','timestamp','Deleted At',0,0,1,0,0,0,NULL,6),(130,20,'logo','image','Logo',0,1,1,1,1,1,NULL,1),(131,15,'wkn','text','Wkn',1,1,1,1,1,1,NULL,2),(132,15,'isin','text','Isin',1,1,1,1,1,1,NULL,3),(133,21,'id','checkbox','Id',1,0,0,0,0,0,NULL,1),(134,21,'company_id','select_dropdown','Company Id',1,1,1,1,1,1,'{\"relationship\":{\"key\":\"id\",\"label\":\"name\"}}',3),(135,21,'stock_id','select_dropdown','Stock Id',1,1,1,1,1,1,'{\"relationship\":{\"key\":\"id\",\"label\":\"name\"}}',4),(136,21,'price','text','Price',1,1,1,1,1,1,NULL,5),(137,21,'created_at','timestamp','Created At',0,1,1,0,0,0,NULL,6),(138,21,'updated_at','timestamp','Updated At',0,1,1,0,0,0,NULL,7),(139,21,'market_id','select_dropdown','Market Id',1,1,1,1,1,1,'{\"relationship\":{\"key\":\"id\",\"label\":\"name\"}}',2),(140,19,'market_id','checkbox','Market Id',1,1,1,1,1,1,'{\"relationship\":{\"key\":\"id\",\"label\":\"name\"}}',2);
/*!40000 ALTER TABLE `data_rows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `data_types`
--

DROP TABLE IF EXISTS `data_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_singular` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name_plural` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `controller` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `generate_permissions` tinyint(1) NOT NULL DEFAULT '0',
  `server_side` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `data_types_name_unique` (`name`),
  UNIQUE KEY `data_types_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_types`
--

LOCK TABLES `data_types` WRITE;
/*!40000 ALTER TABLE `data_types` DISABLE KEYS */;
INSERT INTO `data_types` VALUES (2,'pages','pages','Page','Pages','voyager-file-text','TCG\\Voyager\\Models\\Page','','',1,0,'2017-06-02 20:40:58','2017-06-02 20:40:58'),(3,'users','users','User','Users','voyager-person','TCG\\Voyager\\Models\\User','','',1,0,'2017-06-02 20:40:58','2017-06-02 20:40:58'),(5,'menus','menus','Menu','Menus','voyager-list','TCG\\Voyager\\Models\\Menu','','',1,0,'2017-06-02 20:40:58','2017-06-02 20:40:58'),(6,'roles','roles','Role','Roles','voyager-lock','TCG\\Voyager\\Models\\Role','','',1,0,'2017-06-02 20:40:58','2017-06-02 20:40:58'),(10,'stockexchange','stockexchange','Stockexchange','Stockexchanges','voyager-&#xe035;','App\\Stockexchange',NULL,'The marketplace to trade company stocks',1,0,'2017-06-02 21:17:22','2017-06-02 21:17:22'),(12,'companies','companies','Company','Companies',NULL,'App\\Company',NULL,'All companies',1,0,'2017-06-02 22:13:17','2017-06-02 22:13:17'),(15,'stocks','stocks','Stock','Stocks',NULL,'App\\Stock',NULL,NULL,1,0,'2017-06-03 08:09:25','2017-06-03 08:09:25'),(16,'stockexchanges','stockexchanges','Stockexchange','Stockexchanges',NULL,'App\\Stockexchange',NULL,NULL,1,0,'2017-06-03 09:32:30','2017-06-03 09:32:30'),(17,'exchange_ratings','exchange-ratings','Exchange Rating','Exchange Ratings',NULL,'App\\ExchangeRating',NULL,NULL,1,0,'2017-06-03 10:06:06','2017-06-03 10:06:06'),(19,'trades','trades','Trade','Trades',NULL,'App\\Trade',NULL,NULL,1,0,'2017-06-03 10:17:26','2017-06-03 10:35:14'),(20,'markets','markets','Market','Markets','voyager-e','App\\Market',NULL,NULL,1,0,'2017-06-03 18:11:04','2017-06-03 18:11:04'),(21,'marketmemberboards','marketmemberboards','Marketmemberboard','Marketmemberboards',NULL,'App\\Marketmemberboard',NULL,NULL,1,0,'2017-06-03 20:21:38','2017-06-03 20:21:38');
/*!40000 ALTER TABLE `data_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marketmemberboards`
--

DROP TABLE IF EXISTS `marketmemberboards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `marketmemberboards` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL,
  `price` float NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `market_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marketmemberboards`
--

LOCK TABLES `marketmemberboards` WRITE;
/*!40000 ALTER TABLE `marketmemberboards` DISABLE KEYS */;
INSERT INTO `marketmemberboards` VALUES (1,2,10,3344,'2017-06-03 20:38:04','2017-06-03 20:38:04',2),(2,3,9,55.44,'2017-06-03 20:41:40','2017-06-03 20:41:40',2),(3,1,11,55.44,'2017-06-03 20:42:19','2017-06-03 20:42:19',4),(4,2,11,123,'2017-06-03 20:42:40','2017-06-03 20:42:40',5);
/*!40000 ALTER TABLE `marketmemberboards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `markets`
--

DROP TABLE IF EXISTS `markets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `markets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `markets`
--

LOCK TABLES `markets` WRITE;
/*!40000 ALTER TABLE `markets` DISABLE KEYS */;
INSERT INTO `markets` VALUES (1,'New York Stock Exchange','2017-06-03 09:38:55','2017-06-03 18:25:39',NULL,'markets/June2017/rmkNyX4JMLPhKJ36AUvG.png'),(2,'London Stock Exchange','2017-06-03 09:39:24','2017-06-03 18:22:22',NULL,'markets/June2017/q5TWolhjrXeXEwathsEB.png'),(3,'Hong Kong Stock Exchange','2017-06-03 09:39:48','2017-06-03 18:20:45',NULL,'markets/June2017/PZITYZeOjdVTbTlurUQ5.png'),(4,'Shanghai Stock Exchange','2017-06-03 09:40:12','2017-06-03 18:18:51',NULL,'markets/June2017/Xr5IJwwClGwKnSvqTqQC.png'),(5,'Deutsche Börse Frankfurt','2017-06-03 09:40:30','2017-06-03 18:16:49',NULL,'markets/June2017/3VETkV8opcAEEyvivWcO.png');
/*!40000 ALTER TABLE `markets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_items`
--

DROP TABLE IF EXISTS `menu_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(10) unsigned DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self',
  `icon_class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `route` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameters` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `menu_items_menu_id_foreign` (`menu_id`),
  CONSTRAINT `menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_items`
--

LOCK TABLES `menu_items` WRITE;
/*!40000 ALTER TABLE `menu_items` DISABLE KEYS */;
INSERT INTO `menu_items` VALUES (1,1,'Dashboard','/admin','_self','voyager-boat',NULL,NULL,1,'2017-06-02 20:41:03','2017-06-02 20:41:03',NULL,NULL),(2,1,'Media','/admin/media','_self','voyager-images',NULL,NULL,4,'2017-06-02 20:41:03','2017-06-03 10:08:58',NULL,NULL),(4,1,'Users','/admin/users','_self','voyager-person',NULL,NULL,3,'2017-06-02 20:41:03','2017-06-02 20:41:03',NULL,NULL),(7,1,'Roles','/admin/roles','_self','voyager-lock',NULL,NULL,2,'2017-06-02 20:41:03','2017-06-02 20:41:03',NULL,NULL),(8,1,'Tools','','_self','voyager-tools',NULL,NULL,5,'2017-06-02 20:41:03','2017-06-03 10:08:58',NULL,NULL),(9,1,'Menu Builder','/admin/menus','_self','voyager-list',NULL,8,1,'2017-06-02 20:41:03','2017-06-03 10:08:58',NULL,NULL),(10,1,'Database','/admin/database','_self','voyager-data',NULL,8,2,'2017-06-02 20:41:03','2017-06-03 10:08:58',NULL,NULL),(11,1,'Settings','/admin/settings','_self','voyager-settings',NULL,NULL,6,'2017-06-02 20:41:04','2017-06-03 10:08:58',NULL,NULL),(12,1,'Companies','admin/companies','_self',NULL,'#000000',24,3,'2017-06-02 22:14:49','2017-06-03 22:38:59',NULL,''),(13,2,'Companies','/companies','_self',NULL,'#000000',NULL,2,'2017-06-02 22:42:40','2017-06-02 22:45:05',NULL,''),(18,2,'Stock Exchanges','/stockexchanges','_self',NULL,'#000000',NULL,3,'2017-06-02 22:43:39','2017-06-02 22:45:05',NULL,''),(19,2,'Home','/','_self',NULL,'#000000',NULL,1,'2017-06-02 22:45:01','2017-06-02 22:45:05',NULL,''),(20,1,'Stocks','/admin/stocks','_self',NULL,'#000000',24,5,'2017-06-03 07:58:55','2017-06-03 22:39:14',NULL,''),(21,1,'Markets','/admin/markets','_self',NULL,'#000000',24,2,'2017-06-03 09:35:47','2017-06-03 22:38:56',NULL,''),(22,1,'Trades','/admin/trades','_self',NULL,'#000000',24,4,'2017-06-03 10:08:46','2017-06-03 22:39:14',NULL,''),(23,1,'Market Member Boards','/admin/marketmemberboards','_self',NULL,'#000000',24,1,'2017-06-03 21:12:03','2017-06-03 22:41:55',NULL,''),(24,1,'EQS Business','/admin','_self','voyager-dashboard','#000000',NULL,7,'2017-06-03 22:38:31','2017-06-03 22:40:36',NULL,'');
/*!40000 ALTER TABLE `menu_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menus_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,'admin','2017-06-02 20:41:03','2017-06-02 20:41:03'),(2,'frontend','2017-06-02 22:42:02','2017-06-02 22:42:02');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2016_01_01_000000_add_voyager_user_fields',1),(4,'2016_01_01_000000_create_data_types_table',1),(5,'2016_01_01_000000_create_pages_table',1),(6,'2016_01_01_000000_create_posts_table',1),(7,'2016_02_15_204651_create_categories_table',1),(8,'2016_05_19_173453_create_menu_table',1),(9,'2016_10_21_190000_create_roles_table',1),(10,'2016_10_21_190000_create_settings_table',1),(11,'2016_11_30_135954_create_permission_table',1),(12,'2016_11_30_141208_create_permission_role_table',1),(13,'2016_12_26_201236_data_types__add__server_side',1),(14,'2017_01_13_000000_add_route_to_menu_items_table',1),(15,'2017_01_14_005015_create_translations_table',1),(16,'2017_01_15_000000_add_permission_group_id_to_permissions_table',1),(17,'2017_01_15_000000_create_permission_groups_table',1),(18,'2017_01_15_000000_make_table_name_nullable_in_permissions_table',1),(19,'2017_03_06_000000_add_controller_to_data_types_table',1),(20,'2017_04_21_000000_add_order_to_data_rows_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `body` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `status` enum('ACTIVE','INACTIVE') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'INACTIVE',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pages_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,0,'Hello World','Hang the jib grog grog blossom grapple dance the hempen jig gangway pressgang bilge rat to go on account lugger. Nelsons folly gabion line draught scallywag fire ship gaff fluke fathom case shot. Sea Legs bilge rat sloop matey gabion long clothes run a shot across the bow Gold Road cog league.','<p>Hello World. Scallywag grog swab Cat o\'nine tails scuttle rigging hardtack cable nipper Yellow Jack. Handsomely spirits knave lad killick landlubber or just lubber deadlights chantey pinnace crack Jennys tea cup. Provost long clothes black spot Yellow Jack bilged on her anchor league lateen sail case shot lee tackle.</p>\n<p>Ballast spirits fluke topmast me quarterdeck schooner landlubber or just lubber gabion belaying pin. Pinnace stern galleon starboard warp carouser to go on account dance the hempen jig jolly boat measured fer yer chains. Man-of-war fire in the hole nipperkin handsomely doubloon barkadeer Brethren of the Coast gibbet driver squiffy.</p>','pages/AAgCCnqHfLlRub9syUdw.jpg','hello-world','Yar Meta Description','Keyword1, Keyword2','ACTIVE','2017-06-02 20:41:44','2017-06-02 20:41:44');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_groups`
--

DROP TABLE IF EXISTS `permission_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permission_groups_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_groups`
--

LOCK TABLES `permission_groups` WRITE;
/*!40000 ALTER TABLE `permission_groups` DISABLE KEYS */;
/*!40000 ALTER TABLE `permission_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_permission_id_index` (`permission_id`),
  KEY `permission_role_role_id_index` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_role`
--

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
INSERT INTO `permission_role` VALUES (1,1),(2,1),(3,1),(4,1),(5,1),(6,1),(7,1),(8,1),(9,1),(10,1),(11,1),(12,1),(13,1),(14,1),(15,1),(16,1),(17,1),(18,1),(19,1),(20,1),(21,1),(22,1),(23,1),(24,1),(35,1),(35,2),(36,1),(36,2),(37,1),(37,2),(38,1),(38,2),(39,1),(39,2),(40,1),(40,2),(41,1),(41,2),(42,1),(42,2),(43,1),(43,2),(44,1),(44,2),(45,1),(45,2),(46,1),(46,2),(47,1),(47,2),(48,1),(48,2),(49,1),(49,2),(50,1),(51,1),(52,1),(53,1),(54,1),(65,1),(66,1),(67,1),(68,1),(69,1),(70,1),(71,1),(72,1),(73,1),(74,1),(80,1),(81,1),(82,1),(83,1),(84,1),(85,1),(86,1),(87,1),(88,1),(89,1),(90,1),(91,1),(92,1),(93,1),(94,1);
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `table_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `permission_group_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permissions_key_index` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'browse_admin',NULL,'2017-06-02 20:41:04','2017-06-02 20:41:04',NULL),(2,'browse_database',NULL,'2017-06-02 20:41:04','2017-06-02 20:41:04',NULL),(3,'browse_media',NULL,'2017-06-02 20:41:04','2017-06-02 20:41:04',NULL),(4,'browse_settings',NULL,'2017-06-02 20:41:04','2017-06-02 20:41:04',NULL),(5,'browse_menus','menus','2017-06-02 20:41:04','2017-06-02 20:41:04',NULL),(6,'read_menus','menus','2017-06-02 20:41:04','2017-06-02 20:41:04',NULL),(7,'edit_menus','menus','2017-06-02 20:41:04','2017-06-02 20:41:04',NULL),(8,'add_menus','menus','2017-06-02 20:41:04','2017-06-02 20:41:04',NULL),(9,'delete_menus','menus','2017-06-02 20:41:04','2017-06-02 20:41:04',NULL),(10,'browse_pages','pages','2017-06-02 20:41:04','2017-06-02 20:41:04',NULL),(11,'read_pages','pages','2017-06-02 20:41:04','2017-06-02 20:41:04',NULL),(12,'edit_pages','pages','2017-06-02 20:41:04','2017-06-02 20:41:04',NULL),(13,'add_pages','pages','2017-06-02 20:41:04','2017-06-02 20:41:04',NULL),(14,'delete_pages','pages','2017-06-02 20:41:04','2017-06-02 20:41:04',NULL),(15,'browse_roles','roles','2017-06-02 20:41:04','2017-06-02 20:41:04',NULL),(16,'read_roles','roles','2017-06-02 20:41:04','2017-06-02 20:41:04',NULL),(17,'edit_roles','roles','2017-06-02 20:41:04','2017-06-02 20:41:04',NULL),(18,'add_roles','roles','2017-06-02 20:41:04','2017-06-02 20:41:04',NULL),(19,'delete_roles','roles','2017-06-02 20:41:04','2017-06-02 20:41:04',NULL),(20,'browse_users','users','2017-06-02 20:41:04','2017-06-02 20:41:04',NULL),(21,'read_users','users','2017-06-02 20:41:04','2017-06-02 20:41:04',NULL),(22,'edit_users','users','2017-06-02 20:41:05','2017-06-02 20:41:05',NULL),(23,'add_users','users','2017-06-02 20:41:05','2017-06-02 20:41:05',NULL),(24,'delete_users','users','2017-06-02 20:41:05','2017-06-02 20:41:05',NULL),(35,'browse_stock','stock','2017-06-02 21:14:18','2017-06-02 21:14:18',NULL),(36,'read_stock','stock','2017-06-02 21:14:18','2017-06-02 21:14:18',NULL),(37,'edit_stock','stock','2017-06-02 21:14:18','2017-06-02 21:14:18',NULL),(38,'add_stock','stock','2017-06-02 21:14:18','2017-06-02 21:14:18',NULL),(39,'delete_stock','stock','2017-06-02 21:14:18','2017-06-02 21:14:18',NULL),(40,'browse_stockexchange','stockexchange','2017-06-02 21:17:22','2017-06-02 21:17:22',NULL),(41,'read_stockexchange','stockexchange','2017-06-02 21:17:22','2017-06-02 21:17:22',NULL),(42,'edit_stockexchange','stockexchange','2017-06-02 21:17:22','2017-06-02 21:17:22',NULL),(43,'add_stockexchange','stockexchange','2017-06-02 21:17:22','2017-06-02 21:17:22',NULL),(44,'delete_stockexchange','stockexchange','2017-06-02 21:17:22','2017-06-02 21:17:22',NULL),(45,'browse_company','company','2017-06-02 21:19:11','2017-06-02 21:19:11',NULL),(46,'read_company','company','2017-06-02 21:19:11','2017-06-02 21:19:11',NULL),(47,'edit_company','company','2017-06-02 21:19:11','2017-06-02 21:19:11',NULL),(48,'add_company','company','2017-06-02 21:19:11','2017-06-02 21:19:11',NULL),(49,'delete_company','company','2017-06-02 21:19:11','2017-06-02 21:19:11',NULL),(50,'browse_companies','companies','2017-06-02 22:13:17','2017-06-02 22:13:17',NULL),(51,'read_companies','companies','2017-06-02 22:13:17','2017-06-02 22:13:17',NULL),(52,'edit_companies','companies','2017-06-02 22:13:17','2017-06-02 22:13:17',NULL),(53,'add_companies','companies','2017-06-02 22:13:17','2017-06-02 22:13:17',NULL),(54,'delete_companies','companies','2017-06-02 22:13:17','2017-06-02 22:13:17',NULL),(65,'browse_stocks','stocks','2017-06-03 08:09:25','2017-06-03 08:09:25',NULL),(66,'read_stocks','stocks','2017-06-03 08:09:25','2017-06-03 08:09:25',NULL),(67,'edit_stocks','stocks','2017-06-03 08:09:25','2017-06-03 08:09:25',NULL),(68,'add_stocks','stocks','2017-06-03 08:09:25','2017-06-03 08:09:25',NULL),(69,'delete_stocks','stocks','2017-06-03 08:09:25','2017-06-03 08:09:25',NULL),(70,'browse_stockexchanges','stockexchanges','2017-06-03 09:32:30','2017-06-03 09:32:30',NULL),(71,'read_stockexchanges','stockexchanges','2017-06-03 09:32:30','2017-06-03 09:32:30',NULL),(72,'edit_stockexchanges','stockexchanges','2017-06-03 09:32:30','2017-06-03 09:32:30',NULL),(73,'add_stockexchanges','stockexchanges','2017-06-03 09:32:30','2017-06-03 09:32:30',NULL),(74,'delete_stockexchanges','stockexchanges','2017-06-03 09:32:30','2017-06-03 09:32:30',NULL),(75,'browse_exchange_ratings','exchange_ratings','2017-06-03 10:06:06','2017-06-03 10:06:06',NULL),(76,'read_exchange_ratings','exchange_ratings','2017-06-03 10:06:06','2017-06-03 10:06:06',NULL),(77,'edit_exchange_ratings','exchange_ratings','2017-06-03 10:06:06','2017-06-03 10:06:06',NULL),(78,'add_exchange_ratings','exchange_ratings','2017-06-03 10:06:06','2017-06-03 10:06:06',NULL),(79,'delete_exchange_ratings','exchange_ratings','2017-06-03 10:06:06','2017-06-03 10:06:06',NULL),(80,'browse_trades','trades','2017-06-03 10:17:26','2017-06-03 10:17:26',NULL),(81,'read_trades','trades','2017-06-03 10:17:26','2017-06-03 10:17:26',NULL),(82,'edit_trades','trades','2017-06-03 10:17:26','2017-06-03 10:17:26',NULL),(83,'add_trades','trades','2017-06-03 10:17:26','2017-06-03 10:17:26',NULL),(84,'delete_trades','trades','2017-06-03 10:17:26','2017-06-03 10:17:26',NULL),(85,'browse_markets','markets','2017-06-03 18:11:04','2017-06-03 18:11:04',NULL),(86,'read_markets','markets','2017-06-03 18:11:04','2017-06-03 18:11:04',NULL),(87,'edit_markets','markets','2017-06-03 18:11:04','2017-06-03 18:11:04',NULL),(88,'add_markets','markets','2017-06-03 18:11:04','2017-06-03 18:11:04',NULL),(89,'delete_markets','markets','2017-06-03 18:11:04','2017-06-03 18:11:04',NULL),(90,'browse_marketmemberboards','marketmemberboards','2017-06-03 20:21:38','2017-06-03 20:21:38',NULL),(91,'read_marketmemberboards','marketmemberboards','2017-06-03 20:21:38','2017-06-03 20:21:38',NULL),(92,'edit_marketmemberboards','marketmemberboards','2017-06-03 20:21:38','2017-06-03 20:21:38',NULL),(93,'add_marketmemberboards','marketmemberboards','2017-06-03 20:21:38','2017-06-03 20:21:38',NULL),(94,'delete_marketmemberboards','marketmemberboards','2017-06-03 20:21:38','2017-06-03 20:21:38',NULL);
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','Administrator','2017-06-02 20:41:04','2017-06-02 20:41:04'),(2,'user','Normal User','2017-06-02 20:41:04','2017-06-02 20:41:04');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'title','Site Title','EQS Stock Manager','','text',1),(2,'description','Site Description','Your stock exchange info platform','','text',2),(3,'logo','Site Logo','settings/June2017/6lJXYeWXkbhahaDb0eN9.png','','image',3),(4,'admin_bg_image','Admin Background Image','settings/June2017/lQ2dKS0IqkaKjMDZPs1C.jpg','','image',9),(5,'admin_title','Admin Title','EQS','','text',4),(6,'admin_description','Admin Description','Welcome to your EQS Trading Adminpanel','','text',5),(7,'admin_loader','Admin Loader','','','image',6),(8,'admin_icon_image','Admin Icon Image','settings/June2017/RBHuwZ1PfEgvEEENgS42.png','','image',7),(9,'google_analytics_client_id','Google Analytics Client ID','','','text',9);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stocks`
--

DROP TABLE IF EXISTS `stocks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stocks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `price` float DEFAULT '0',
  `currency` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'EUR',
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'prefered',
  `company_id` int(11) DEFAULT NULL,
  `wkn` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `isin` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stocks`
--

LOCK TABLES `stocks` WRITE;
/*!40000 ALTER TABLE `stocks` DISABLE KEYS */;
INSERT INTO `stocks` VALUES (9,'Bayer Aktie (Prefered)','2017-06-03 19:39:13','2017-06-03 20:39:49',NULL,121.6,'option1','option2',3,'BAY001','DE000BAY0017'),(10,'Siemens Aktie (Common)','2017-06-03 19:40:47','2017-06-03 20:39:27',NULL,323,'option1','option1',1,'723610','DE0007236101'),(11,'Siemens Aktie (Preffered)','2017-06-03 19:41:56','2017-06-03 20:38:46',NULL,4545,'option1','option2',1,'723610','DE0007236101'),(12,'BGF World Mining Fund D4RF GBP (Comon)','2017-06-03 19:46:29','2017-06-03 20:40:17',NULL,2323,'option1','option1',3,'A1J4PN','LU0827889725');
/*!40000 ALTER TABLE `stocks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `trades`
--

DROP TABLE IF EXISTS `trades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `trades` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `stock_id` int(11) NOT NULL,
  `exchange_id` int(11) NOT NULL,
  `price` float NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `market_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `trades`
--

LOCK TABLES `trades` WRITE;
/*!40000 ALTER TABLE `trades` DISABLE KEYS */;
/*!40000 ALTER TABLE `trades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `translations`
--

DROP TABLE IF EXISTS `translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `table_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `column_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foreign_key` int(10) unsigned NOT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `translations_table_name_column_name_foreign_key_locale_unique` (`table_name`,`column_name`,`foreign_key`,`locale`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `translations`
--

LOCK TABLES `translations` WRITE;
/*!40000 ALTER TABLE `translations` DISABLE KEYS */;
INSERT INTO `translations` VALUES (1,'data_types','display_name_singular',1,'pt','Post','2017-06-02 20:41:44','2017-06-02 20:41:44'),(2,'data_types','display_name_singular',2,'pt','Página','2017-06-02 20:41:44','2017-06-02 20:41:44'),(3,'data_types','display_name_singular',3,'pt','Utilizador','2017-06-02 20:41:44','2017-06-02 20:41:44'),(4,'data_types','display_name_singular',4,'pt','Categoria','2017-06-02 20:41:44','2017-06-02 20:41:44'),(5,'data_types','display_name_singular',5,'pt','Menu','2017-06-02 20:41:44','2017-06-02 20:41:44'),(6,'data_types','display_name_singular',6,'pt','Função','2017-06-02 20:41:45','2017-06-02 20:41:45'),(7,'data_types','display_name_plural',1,'pt','Posts','2017-06-02 20:41:45','2017-06-02 20:41:45'),(8,'data_types','display_name_plural',2,'pt','Páginas','2017-06-02 20:41:45','2017-06-02 20:41:45'),(9,'data_types','display_name_plural',3,'pt','Utilizadores','2017-06-02 20:41:45','2017-06-02 20:41:45'),(10,'data_types','display_name_plural',4,'pt','Categorias','2017-06-02 20:41:45','2017-06-02 20:41:45'),(11,'data_types','display_name_plural',5,'pt','Menus','2017-06-02 20:41:45','2017-06-02 20:41:45'),(12,'data_types','display_name_plural',6,'pt','Funções','2017-06-02 20:41:45','2017-06-02 20:41:45'),(13,'pages','title',1,'pt','Olá Mundo','2017-06-02 20:41:45','2017-06-02 20:41:45'),(14,'pages','slug',1,'pt','ola-mundo','2017-06-02 20:41:45','2017-06-02 20:41:45'),(15,'pages','body',1,'pt','<p>Olá Mundo. Scallywag grog swab Cat o\'nine tails scuttle rigging hardtack cable nipper Yellow Jack. Handsomely spirits knave lad killick landlubber or just lubber deadlights chantey pinnace crack Jennys tea cup. Provost long clothes black spot Yellow Jack bilged on her anchor league lateen sail case shot lee tackle.</p>\r\n<p>Ballast spirits fluke topmast me quarterdeck schooner landlubber or just lubber gabion belaying pin. Pinnace stern galleon starboard warp carouser to go on account dance the hempen jig jolly boat measured fer yer chains. Man-of-war fire in the hole nipperkin handsomely doubloon barkadeer Brethren of the Coast gibbet driver squiffy.</p>','2017-06-02 20:41:45','2017-06-02 20:41:45'),(16,'menu_items','title',1,'pt','Painel de Controle','2017-06-02 20:41:45','2017-06-02 20:41:45'),(17,'menu_items','title',2,'pt','Media','2017-06-02 20:41:45','2017-06-02 20:41:45'),(18,'menu_items','title',3,'pt','Publicações','2017-06-02 20:41:45','2017-06-02 20:41:45'),(19,'menu_items','title',4,'pt','Utilizadores','2017-06-02 20:41:45','2017-06-02 20:41:45'),(20,'menu_items','title',5,'pt','Categorias','2017-06-02 20:41:45','2017-06-02 20:41:45'),(21,'menu_items','title',6,'pt','Páginas','2017-06-02 20:41:45','2017-06-02 20:41:45'),(22,'menu_items','title',7,'pt','Funções','2017-06-02 20:41:45','2017-06-02 20:41:45'),(23,'menu_items','title',8,'pt','Ferramentas','2017-06-02 20:41:45','2017-06-02 20:41:45'),(24,'menu_items','title',9,'pt','Menus','2017-06-02 20:41:45','2017-06-02 20:41:45'),(25,'menu_items','title',10,'pt','Base de dados','2017-06-02 20:41:45','2017-06-02 20:41:45'),(26,'menu_items','title',11,'pt','Configurações','2017-06-02 20:41:45','2017-06-02 20:41:45');
/*!40000 ALTER TABLE `translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,'Admin','admin@admin.com','users/default.png','$2y$10$hcAOd90kvi.qRiZJrdfe5uJZUcPpo0wEjP17CYZdhRT68Yv.UT2i6','4RyIyJxgeOA6ohVSJTGjSSRqT6PfEcnhWdFmGVc4mlr2LPckVrrEkjo5MJWc','2017-06-02 20:41:44','2017-06-02 20:41:44'),(2,1,'admin','admin@eqs.de','users/default.png','$2y$10$sxRyFygBNugmnahnlvAAnu3eRy/PYtx7D4/z7lUtJ6h.f2qariiIe','mGX5nCP8mgx5fIykyGbNhwvFCBKXuqPgeKYD1Yi3T4ZekFp1BXALFcOY84tA','2017-06-02 20:44:38','2017-06-02 20:44:38');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-06-04  9:17:36
