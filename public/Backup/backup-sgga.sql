-- MariaDB dump 10.17  Distrib 10.5.5-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: sggdev
-- ------------------------------------------------------
-- Server version	10.5.5-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `aviarios`
--

DROP TABLE IF EXISTS `aviarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aviarios` (
  `id_aviario` int(11) NOT NULL,
  `lote_id` int(11) NOT NULL,
  `periodo` int(11) NOT NULL,
  `data_aviario` date NOT NULL,
  `aviario` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `femea_box1` int(11) NOT NULL,
  `femea_box2` int(11) DEFAULT NULL,
  `femea_box3` int(11) DEFAULT NULL,
  `femea_box4` int(11) DEFAULT NULL,
  `macho_box1` int(11) NOT NULL,
  `macho_box2` int(11) DEFAULT NULL,
  `macho_box3` int(11) DEFAULT NULL,
  `macho_box4` int(11) DEFAULT NULL,
  `femea` int(11) NOT NULL,
  `macho` int(11) NOT NULL,
  `tot_ave` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_aviario`),
  KEY `aviarios_lote_id_foreign` (`lote_id`),
  CONSTRAINT `aviarios_lote_id_foreign` FOREIGN KEY (`lote_id`) REFERENCES `lotes` (`id_lote`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aviarios`
--

LOCK TABLES `aviarios` WRITE;
/*!40000 ALTER TABLE `aviarios` DISABLE KEYS */;
INSERT INTO `aviarios` VALUES (1,1,1,'2021-02-22','1',4850,NULL,NULL,NULL,480,NULL,NULL,NULL,4850,480,5330,'2021-05-05 20:05:28','2021-05-05 20:05:28');
/*!40000 ALTER TABLE `aviarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `TRG_insert_aviarios` AFTER INSERT ON `aviarios` FOR EACH ROW BEGIN
      CALL SP_AtualizaEstoqueAves (
      new.id_aviario, 
      new.periodo, 
      new.data_aviario,
      new.lote_id, 
      new.femea_box1,
      new.femea_box2,
      new.femea_box3,
      new.femea_box4,
      new.macho_box1,
      new.macho_box2,
      new.macho_box3,
      new.macho_box4,
      new.femea, 
      new.macho,
      new.tot_ave
      );
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `TRG_update_aviarios` AFTER UPDATE ON `aviarios` FOR EACH ROW BEGIN
      CALL SP_AtualizaEstoqueAves (
      new.id_aviario, 
      new.periodo, 
      new.data_aviario,
      new.lote_id, 
      new.femea_box1 - old.femea_box1,
      new.femea_box2 - old.femea_box2,
      new.femea_box3 - old.femea_box3,
      new.femea_box4 - old.femea_box4,
      new.macho_box1 - old.macho_box1,
      new.macho_box2 - old.macho_box2,
      new.macho_box3 - old.macho_box3,
      new.macho_box4 - old.macho_box4,
      new.femea - old.femea, 
      new.macho - old.macho,
      new.tot_ave - old.tot_ave
      );
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `TRG_delete_aviarios` AFTER DELETE ON `aviarios` FOR EACH ROW BEGIN
      CALL SP_AtualizaEstoqueAves (
      old.id_aviario, 
      old.periodo, 
      old.data_aviario,
      old.lote_id, 
      old.femea_box1 * -1,
      old.femea_box2 * -1,
      old.femea_box3 * -1,
      old.femea_box4 * -1,
      old.macho_box1 * -1,
      old.macho_box2 * -1,
      old.macho_box3 * -1,
      old.macho_box4 * -1,
      old.femea * -1, 
      old.macho * -1,
      old.tot_ave * -1
      );
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `backups`
--

DROP TABLE IF EXISTS `backups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `backups` (
  `id_backup` int(11) NOT NULL,
  `basedados` char(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usuario` char(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `senha` char(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `local` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agendamento` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_backup`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `backups`
--

LOCK TABLES `backups` WRITE;
/*!40000 ALTER TABLE `backups` DISABLE KEYS */;
INSERT INTO `backups` VALUES (1,NULL,NULL,NULL,'Backup','19:00:00','2021-05-08 12:22:30','2021-05-15 20:09:26');
/*!40000 ALTER TABLE `backups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `checklists`
--

DROP TABLE IF EXISTS `checklists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `checklists` (
  `id_checklist` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `periodo` int(11) NOT NULL,
  `mes` int(11) NOT NULL,
  `data_inicial` date NOT NULL,
  `data_final` date NOT NULL,
  `check` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_checklist`),
  KEY `checklists_periodo_foreign` (`periodo`),
  CONSTRAINT `checklists_periodo_foreign` FOREIGN KEY (`periodo`) REFERENCES `periodos` (`id_periodo`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `checklists`
--

LOCK TABLES `checklists` WRITE;
/*!40000 ALTER TABLE `checklists` DISABLE KEYS */;
INSERT INTO `checklists` VALUES (1,1,1,'2021-02-22','2021-03-22',NULL,'2021-05-05 19:58:49','2021-05-05 19:58:49'),(2,1,2,'2021-03-22','2021-04-22',NULL,'2021-05-05 19:58:49','2021-05-05 19:58:49'),(3,1,3,'2021-04-22','2021-05-22',NULL,'2021-05-05 19:58:49','2021-05-05 19:58:49'),(4,1,4,'2021-05-22','2021-06-22',NULL,'2021-05-05 19:58:49','2021-05-05 19:58:49'),(5,1,5,'2021-06-22','2021-07-22',NULL,'2021-05-05 19:58:49','2021-05-05 19:58:49'),(6,1,6,'2021-07-22','2021-08-22',NULL,'2021-05-05 19:58:49','2021-05-05 19:58:49');
/*!40000 ALTER TABLE `checklists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coletas`
--

DROP TABLE IF EXISTS `coletas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coletas` (
  `id_coleta` int(11) NOT NULL,
  `lote_id` int(11) NOT NULL,
  `id_aviario` int(11) NOT NULL,
  `periodo` int(11) NOT NULL,
  `coleta` int(11) NOT NULL,
  `data_coleta` date NOT NULL,
  `hora_coleta` time NOT NULL,
  `limpos_ninho` int(11) NOT NULL,
  `sujos_ninho` int(11) NOT NULL,
  `ovos_cama` int(11) NOT NULL,
  `duas_gemas` int(11) NOT NULL,
  `refugos` int(11) DEFAULT NULL,
  `pequenos` int(11) DEFAULT NULL,
  `casca_fina` int(11) DEFAULT NULL,
  `frios` int(11) DEFAULT NULL,
  `esmagados_quebrados` int(11) DEFAULT NULL,
  `cama_nao_incubaveis` int(11) DEFAULT NULL,
  `deformados` int(11) NOT NULL,
  `sujos_cama` int(11) NOT NULL,
  `trincados` int(11) NOT NULL,
  `eliminados` int(11) DEFAULT NULL,
  `incubaveis_bons` int(11) NOT NULL,
  `incubaveis` int(11) NOT NULL,
  `comerciais` int(11) NOT NULL,
  `postura_dia` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_coleta`),
  KEY `coletas_lote_id_foreign` (`lote_id`),
  CONSTRAINT `coletas_lote_id_foreign` FOREIGN KEY (`lote_id`) REFERENCES `lotes` (`id_lote`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coletas`
--

LOCK TABLES `coletas` WRITE;
/*!40000 ALTER TABLE `coletas` DISABLE KEYS */;
INSERT INTO `coletas` VALUES (1,1,1,1,1,'2021-05-08','09:23:00',2000,50,200,4,NULL,4,0,15,9,6,8,7,6,NULL,0,2250,43,2309,'2021-05-08 12:24:15','2021-05-08 12:24:15'),(2,1,1,1,1,'2021-05-11','07:00:00',77,0,7,0,NULL,1,0,0,0,44,0,0,1,NULL,0,84,46,130,'2021-05-11 10:56:40','2021-05-11 10:56:40'),(3,1,1,1,2,'2021-05-11','08:00:00',142,6,9,0,NULL,0,0,0,1,0,1,0,2,NULL,0,157,3,161,'2021-05-11 12:54:40','2021-05-11 12:54:40'),(4,1,1,1,3,'2021-05-11','09:00:00',186,3,18,0,NULL,0,0,0,2,8,0,0,3,NULL,0,207,11,220,'2021-05-11 13:13:22','2021-05-11 13:13:22'),(5,1,1,1,4,'2021-05-11','10:00:00',360,3,8,0,NULL,0,3,0,1,4,2,0,2,NULL,0,371,11,383,'2021-05-11 15:14:46','2021-05-11 15:17:42'),(6,1,1,1,5,'2021-05-11','11:00:00',407,2,35,1,NULL,1,2,0,2,8,0,0,2,NULL,0,444,14,460,'2021-05-11 15:19:16','2021-05-11 15:19:16'),(7,1,1,1,6,'2021-05-11','12:00:00',448,2,33,0,NULL,0,0,0,5,6,2,0,5,NULL,0,483,13,501,'2021-05-11 16:07:05','2021-05-11 16:07:05'),(8,1,1,1,7,'2021-05-11','13:00:00',449,0,19,0,NULL,0,0,0,1,8,3,0,4,NULL,0,468,15,484,'2021-05-11 17:56:03','2021-05-11 17:56:03'),(9,1,1,1,8,'2021-05-11','14:00:00',169,6,7,1,NULL,0,0,0,0,2,0,0,1,NULL,0,182,4,186,'2021-05-11 18:04:49','2021-05-11 18:04:49'),(10,1,1,1,9,'2021-05-11','15:00:00',45,0,5,1,NULL,0,0,0,0,1,1,0,0,NULL,0,50,3,53,'2021-05-11 18:39:47','2021-05-11 18:39:47'),(11,1,1,1,10,'2021-05-11','16:00:00',168,0,21,2,NULL,3,0,0,0,2,0,0,1,NULL,0,189,8,197,'2021-05-12 14:43:23','2021-05-12 14:43:23'),(12,1,1,1,1,'2021-05-10','07:14:00',33,0,13,0,NULL,1,0,0,1,0,0,0,2,NULL,0,46,3,50,'2021-05-14 11:16:04','2021-05-14 11:16:04'),(13,1,1,1,2,'2021-05-10','08:16:00',80,5,12,1,NULL,0,0,0,1,0,0,0,1,NULL,0,97,2,100,'2021-05-14 11:16:55','2021-05-14 11:16:55'),(14,1,1,1,3,'2021-05-10','09:16:00',144,6,25,3,NULL,2,0,0,0,4,0,0,0,NULL,0,175,9,184,'2021-05-14 11:17:31','2021-05-14 11:17:31'),(15,1,1,1,4,'2021-05-10','10:17:00',179,9,31,1,NULL,1,2,0,0,1,1,0,2,NULL,0,219,8,227,'2021-05-14 11:18:33','2021-05-14 11:18:33'),(16,1,1,1,5,'2021-05-10','11:18:00',490,8,35,0,NULL,1,3,0,2,7,2,0,3,NULL,0,533,16,551,'2021-05-14 11:19:28','2021-05-14 11:19:28'),(17,1,1,1,6,'2021-05-10','12:19:00',525,0,46,4,NULL,1,0,0,2,0,0,0,3,NULL,0,571,8,581,'2021-05-14 11:20:10','2021-05-14 11:20:10'),(18,1,1,1,7,'2021-05-10','14:20:00',347,11,23,0,NULL,0,0,0,0,0,1,1,1,NULL,0,381,2,384,'2021-05-14 11:21:56','2021-05-14 11:44:32'),(19,1,1,1,8,'2021-05-10','15:21:00',184,0,12,0,NULL,1,0,0,0,0,1,2,2,NULL,0,196,4,202,'2021-05-14 11:22:27','2021-05-14 11:45:37'),(20,1,1,1,9,'2021-05-10','16:22:00',172,3,9,2,NULL,2,0,0,1,1,2,1,2,NULL,0,184,9,195,'2021-05-14 11:23:05','2021-05-14 11:23:05'),(21,1,1,1,10,'2021-05-10','17:23:00',141,0,22,0,NULL,0,0,0,1,2,0,0,0,NULL,0,163,2,166,'2021-05-14 11:24:15','2021-05-14 11:24:15'),(22,1,1,1,11,'2021-05-10','18:24:00',48,0,0,0,NULL,0,0,0,0,0,0,0,0,NULL,0,48,0,48,'2021-05-14 11:24:48','2021-05-14 11:24:48'),(23,1,1,1,11,'2021-05-11','17:00:00',112,1,113,0,NULL,1,1,0,0,0,0,0,1,NULL,0,226,3,229,'2021-05-14 11:29:50','2021-05-14 11:29:50'),(24,1,1,1,1,'2021-05-12','08:00:00',130,3,6,0,NULL,0,1,0,0,2,0,0,0,NULL,0,139,3,142,'2021-05-14 11:32:11','2021-05-14 11:32:11'),(25,1,1,1,2,'2021-05-12','10:33:00',205,2,8,1,NULL,0,0,0,1,1,1,0,1,NULL,0,215,4,220,'2021-05-14 11:33:40','2021-05-14 11:33:40'),(26,1,1,1,3,'2021-05-12','11:33:00',356,10,30,0,NULL,1,0,0,2,1,0,0,2,NULL,0,396,4,402,'2021-05-14 11:34:15','2021-05-14 11:34:15'),(27,1,1,1,4,'2021-05-12','12:34:00',615,20,35,0,NULL,0,2,0,1,3,0,0,2,NULL,0,670,7,678,'2021-05-14 11:34:58','2021-05-14 11:34:58'),(28,1,1,1,5,'2021-05-12','13:35:00',355,10,30,1,NULL,0,1,0,0,1,0,0,1,NULL,0,395,4,399,'2021-05-14 11:35:36','2021-05-14 11:35:36'),(29,1,1,1,6,'2021-05-12','14:35:00',171,2,25,0,NULL,1,0,0,1,1,0,0,1,NULL,0,198,3,202,'2021-05-14 11:36:04','2021-05-14 11:36:04'),(30,1,1,1,7,'2021-05-12','15:36:00',144,0,16,0,NULL,0,1,0,1,0,1,0,0,NULL,0,160,2,163,'2021-05-14 11:36:39','2021-05-14 11:36:39'),(31,1,1,1,8,'2021-05-12','16:36:00',147,1,10,0,NULL,0,0,0,0,1,2,0,0,NULL,0,158,3,161,'2021-05-14 11:37:08','2021-05-14 11:37:08'),(32,1,1,1,9,'2021-05-12','17:37:00',70,0,20,0,NULL,1,1,0,0,1,0,0,1,NULL,0,90,4,94,'2021-05-14 11:37:40','2021-05-14 11:37:40'),(33,1,1,1,10,'2021-05-12','18:37:00',44,0,35,1,NULL,0,0,0,0,1,1,0,0,NULL,0,79,3,82,'2021-05-14 11:38:26','2021-05-14 11:38:26'),(34,1,1,1,12,'2021-05-10','15:46:00',128,21,0,0,NULL,1,0,0,0,0,1,0,0,NULL,0,149,2,151,'2021-05-14 11:47:09','2021-05-14 11:47:09'),(35,1,1,1,11,'2021-05-12','07:00:00',108,2,10,0,NULL,0,0,0,1,0,0,0,1,NULL,0,120,1,122,'2021-05-14 11:54:05','2021-05-14 11:54:05'),(36,1,1,1,12,'2021-05-12','08:54:00',203,8,16,0,NULL,0,0,0,2,0,0,0,2,NULL,0,227,2,231,'2021-05-14 11:54:39','2021-05-14 11:54:39'),(37,1,1,1,1,'2021-05-13','15:33:00',0,0,0,0,NULL,0,0,0,0,29,0,0,0,NULL,0,0,29,29,'2021-05-14 18:34:02','2021-05-14 18:34:02'),(38,1,1,1,2,'2021-05-13','07:00:00',59,1,5,0,NULL,0,0,1,0,6,0,0,0,NULL,0,65,7,72,'2021-05-14 18:36:31','2021-05-14 18:36:31'),(39,1,1,1,3,'2021-05-13','09:37:00',122,0,0,0,NULL,0,0,0,0,0,0,0,0,NULL,0,122,0,122,'2021-05-14 18:38:06','2021-05-14 18:38:06'),(40,1,1,1,4,'2021-05-13','09:38:00',224,0,27,1,NULL,0,0,0,0,0,0,0,4,NULL,0,251,5,256,'2021-05-14 18:38:45','2021-05-14 18:38:45'),(41,1,1,1,5,'2021-05-13','10:38:00',206,4,33,0,NULL,0,0,0,0,3,1,0,0,NULL,0,243,4,247,'2021-05-14 18:39:27','2021-05-14 18:39:27'),(42,1,1,1,6,'2021-05-13','11:39:00',476,0,38,3,NULL,0,0,0,4,6,0,0,0,NULL,0,514,9,527,'2021-05-14 18:40:35','2021-05-14 18:40:35'),(43,1,1,1,7,'2021-05-13','12:40:00',505,6,29,1,NULL,0,1,0,1,8,1,0,2,NULL,0,540,13,554,'2021-05-14 18:41:18','2021-05-14 18:41:18'),(44,1,1,1,8,'2021-05-13','13:41:00',424,3,20,2,NULL,1,2,0,2,8,1,0,2,NULL,0,447,16,465,'2021-05-14 18:41:54','2021-05-14 18:41:54'),(45,1,1,1,9,'2021-05-13','14:41:00',131,1,0,1,NULL,0,0,0,0,0,1,0,2,NULL,0,132,4,136,'2021-05-14 18:42:29','2021-05-14 18:42:29'),(46,1,1,1,10,'2021-05-13','15:42:00',84,0,0,7,NULL,0,0,0,0,0,0,0,0,NULL,0,84,7,91,'2021-05-14 18:42:58','2021-05-14 18:42:58'),(47,1,1,1,11,'2021-05-13','16:00:00',102,0,1,0,NULL,1,0,0,0,0,0,0,0,NULL,0,103,1,104,'2021-05-14 18:43:29','2021-05-14 18:43:29'),(48,1,1,1,12,'2021-05-13','17:43:00',107,2,0,0,NULL,0,0,0,0,0,0,0,0,NULL,0,109,0,109,'2021-05-14 18:43:55','2021-05-14 18:43:55'),(49,1,1,1,13,'2021-05-13','15:43:00',38,0,0,0,NULL,0,0,0,0,0,0,0,0,NULL,0,38,0,38,'2021-05-14 18:44:15','2021-05-14 18:44:15'),(50,1,1,1,1,'2021-05-14','15:49:00',86,0,3,0,NULL,0,0,0,0,9,0,0,0,NULL,0,89,9,98,'2021-05-14 18:50:26','2021-05-14 18:50:26'),(51,1,1,1,2,'2021-05-14','15:50:00',142,2,0,0,NULL,0,1,0,0,1,2,0,0,NULL,0,144,4,148,'2021-05-14 18:51:07','2021-05-14 18:51:07'),(52,1,1,1,3,'2021-05-14','15:51:00',274,8,30,0,NULL,0,0,0,0,0,2,0,2,NULL,0,312,4,316,'2021-05-14 18:51:45','2021-05-14 18:51:45'),(53,1,1,1,4,'2021-05-14','15:51:00',332,0,20,1,NULL,0,0,0,0,5,1,0,3,NULL,0,352,10,362,'2021-05-14 18:52:35','2021-05-14 18:52:35'),(54,1,1,1,5,'2021-05-14','15:52:00',559,7,38,1,NULL,5,1,0,0,10,0,0,0,NULL,0,604,17,621,'2021-05-14 18:53:33','2021-05-14 18:53:33'),(55,1,1,1,6,'2021-05-14','15:53:00',504,3,40,2,NULL,0,0,2,0,0,0,12,1,NULL,0,547,5,564,'2021-05-14 18:54:28','2021-05-14 18:54:28'),(56,1,1,1,7,'2021-05-14','15:54:00',267,4,21,1,NULL,0,0,0,1,8,2,0,0,NULL,0,292,11,304,'2021-05-14 18:54:58','2021-05-14 18:54:58'),(57,1,1,1,8,'2021-05-14','15:55:00',143,1,12,1,NULL,0,0,0,0,7,1,0,1,NULL,0,156,10,166,'2021-05-14 18:55:21','2021-05-14 18:55:21'),(58,1,1,1,9,'2021-05-14','15:55:00',126,3,8,0,NULL,1,0,0,0,0,0,0,1,NULL,0,137,2,139,'2021-05-14 18:55:46','2021-05-14 21:31:43'),(59,1,1,1,10,'2021-05-14','18:29:00',145,0,11,0,NULL,0,1,0,0,2,0,0,0,NULL,0,156,3,159,'2021-05-14 21:30:20','2021-05-14 21:30:20'),(60,1,1,1,11,'2021-05-14','18:32:00',96,0,7,0,NULL,0,1,0,0,0,0,0,0,NULL,0,103,1,104,'2021-05-14 21:32:30','2021-05-14 21:32:30'),(61,1,1,1,12,'2021-05-14','18:40:00',50,0,4,0,NULL,0,0,0,0,3,0,0,0,NULL,0,54,3,57,'2021-05-14 21:47:55','2021-05-14 21:48:33'),(62,1,1,1,1,'2021-05-15','07:00:00',106,0,7,0,NULL,1,0,0,2,0,0,0,2,NULL,0,113,3,118,'2021-05-15 11:15:22','2021-05-15 11:15:22'),(63,1,1,1,2,'2021-05-15','08:00:00',119,3,7,0,NULL,0,0,0,0,0,0,0,1,NULL,0,129,1,130,'2021-05-15 13:23:09','2021-05-15 13:23:09'),(64,1,1,1,3,'2021-05-15','09:00:00',195,17,5,1,NULL,0,0,0,3,6,2,0,6,NULL,0,217,15,235,'2021-05-15 13:25:57','2021-05-15 13:25:57'),(65,1,1,1,4,'2021-05-15','10:00:00',459,15,11,2,NULL,2,0,0,0,3,1,0,9,NULL,0,485,17,502,'2021-05-15 16:38:38','2021-05-15 16:38:38'),(66,1,1,1,5,'2021-05-15','11:00:00',471,5,24,0,NULL,4,0,0,2,8,1,0,9,NULL,0,500,22,524,'2021-05-15 16:39:49','2021-05-15 16:39:49'),(67,1,1,1,6,'2021-05-15','12:00:00',484,6,40,2,NULL,3,1,0,1,7,0,0,6,NULL,0,530,19,550,'2021-05-15 16:40:54','2021-05-15 16:40:54'),(68,1,1,1,7,'2021-05-15','13:00:00',369,11,9,4,NULL,0,0,0,2,4,2,0,2,NULL,0,389,12,403,'2021-05-15 16:53:51','2021-05-15 16:53:51'),(69,1,1,1,8,'2021-05-15','14:00:00',167,1,14,0,NULL,2,0,0,1,2,0,0,3,NULL,0,182,7,190,'2021-05-15 17:29:54','2021-05-15 17:29:54'),(70,1,1,1,9,'2021-05-15','16:01:00',126,0,5,0,NULL,0,1,0,0,0,0,0,1,NULL,0,131,2,133,'2021-05-15 19:05:54','2021-05-15 19:05:54');
/*!40000 ALTER TABLE `coletas` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `TGR_insert_coletas` AFTER INSERT ON `coletas` FOR EACH ROW BEGIN
                CALL SP_AtualizaEstoqueOvos (
                new.periodo,
                new.data_coleta,
                new.lote_id,
                new.incubaveis,
                new.comerciais,
                new.postura_dia
                );
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `TRG_update_coleta` AFTER UPDATE ON `coletas` FOR EACH ROW BEGIN
      CALL SP_AtualizaEstoqueOvos (
      new.periodo, 
      new.data_coleta,
      new.lote_id, 
      new.incubaveis - old.incubaveis,
      new.comerciais - old.comerciais,
      new.postura_dia - old.postura_dia
      );
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `TRG_delete_coletas` AFTER DELETE ON `coletas` FOR EACH ROW BEGIN
      CALL SP_AtualizaEstoqueOvos (
      old.periodo, 
      old.data_coleta,
      old.lote_id, 
      old.incubaveis * -1,
      old.comerciais * -1,
      old.postura_dia * -1
      );
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `consumos`
--

DROP TABLE IF EXISTS `consumos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `consumos` (
  `id_consumo` int(11) NOT NULL,
  `periodo` int(11) NOT NULL,
  `lote_id` int(11) NOT NULL,
  `aviario_id` int(11) NOT NULL,
  `data_consumo` date NOT NULL,
  `femea_box1` int(11) NOT NULL,
  `femea_box2` int(11) DEFAULT NULL,
  `femea_box3` int(11) DEFAULT NULL,
  `femea_box4` int(11) DEFAULT NULL,
  `macho_box1` int(11) NOT NULL,
  `macho_box2` int(11) DEFAULT NULL,
  `macho_box3` int(11) DEFAULT NULL,
  `macho_box4` int(11) DEFAULT NULL,
  `femea` int(11) NOT NULL,
  `macho` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_consumo`),
  KEY `consumos_lote_id_foreign` (`lote_id`),
  CONSTRAINT `consumos_lote_id_foreign` FOREIGN KEY (`lote_id`) REFERENCES `lotes` (`id_lote`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consumos`
--

LOCK TABLES `consumos` WRITE;
/*!40000 ALTER TABLE `consumos` DISABLE KEYS */;
INSERT INTO `consumos` VALUES (1,1,1,1,'2021-05-08',1500,NULL,NULL,NULL,400,NULL,NULL,NULL,1500,400,'2021-05-08 12:34:32','2021-05-08 12:34:32');
/*!40000 ALTER TABLE `consumos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `controlediarios`
--

DROP TABLE IF EXISTS `controlediarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `controlediarios` (
  `id_controle` int(11) NOT NULL,
  `data_controle` date NOT NULL,
  `periodo` int(11) NOT NULL,
  `lote_id` int(11) NOT NULL,
  `aviario` int(11) NOT NULL,
  `temperatura_max` decimal(10,1) NOT NULL,
  `temperatura_min` decimal(10,1) NOT NULL,
  `umidade` int(11) NOT NULL,
  `leitura_agua` int(11) NOT NULL,
  `consumo_total` int(11) NOT NULL,
  `consumo_ave` decimal(10,2) NOT NULL,
  `leitura_inicial` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_controle`),
  KEY `controlediarios_lote_id_foreign` (`lote_id`),
  CONSTRAINT `controlediarios_lote_id_foreign` FOREIGN KEY (`lote_id`) REFERENCES `lotes` (`id_lote`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `controlediarios`
--

LOCK TABLES `controlediarios` WRITE;
/*!40000 ALTER TABLE `controlediarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `controlediarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `despesas`
--

DROP TABLE IF EXISTS `despesas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `despesas` (
  `id_despesa` int(11) NOT NULL,
  `periodo` int(11) NOT NULL,
  `vencimento` date NOT NULL,
  `descritivo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `situacao` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `observacao` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_despesa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `despesas`
--

LOCK TABLES `despesas` WRITE;
/*!40000 ALTER TABLE `despesas` DISABLE KEYS */;
/*!40000 ALTER TABLE `despesas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emails`
--

DROP TABLE IF EXISTS `emails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emails` (
  `id_email` int(11) NOT NULL,
  `smtp` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `porta` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seguranca` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usuario` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `senha` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remetente` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `destinatario` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `assunto` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mensagem` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emails`
--

LOCK TABLES `emails` WRITE;
/*!40000 ALTER TABLE `emails` DISABLE KEYS */;
INSERT INTO `emails` VALUES (1,'sgga.abrasildigital.com.br','465','ssl','send.report@sgga.abrasildigital.com.br','gNYOJmDvPAQ4','Granja Cezar Almeida','cezarandrigo@gmail.com, andersonbrasil@outlook.com','Produção Diaria','Relatório de Produção e Semanal','2021-05-08 12:20:42','2021-05-08 17:27:40');
/*!40000 ALTER TABLE `emails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empresas`
--

DROP TABLE IF EXISTS `empresas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `empresas` (
  `id_empresa` int(11) NOT NULL,
  `logotipo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cnpj` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `razao_social` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `segmento` int(11) DEFAULT NULL,
  `endereco` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cidade` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uf` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefone` char(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `celular` char(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` char(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_empresa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empresas`
--

LOCK TABLES `empresas` WRITE;
/*!40000 ALTER TABLE `empresas` DISABLE KEYS */;
INSERT INTO `empresas` VALUES (1,'1620244428.png','00.745.893/007_-__','Cezar Andrigo de Almeida',1,'Linha Babilônia','São Pedro da Serra','RS','(51)9711-9948','(23)4242-42342','cezarandrigo@gmail.com','2021-05-05 19:53:50','2021-05-16 21:15:27');
/*!40000 ALTER TABLE `empresas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `envios`
--

DROP TABLE IF EXISTS `envios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `envios` (
  `id_envio` int(11) NOT NULL,
  `data_envio` date NOT NULL,
  `hora_envio` time NOT NULL,
  `periodo` int(11) NOT NULL,
  `lote_id` int(11) NOT NULL,
  `incubaveis` int(11) NOT NULL,
  `comerciais` int(11) NOT NULL,
  `postura_dia` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_envio`),
  KEY `envios_lote_id_foreign` (`lote_id`),
  CONSTRAINT `envios_lote_id_foreign` FOREIGN KEY (`lote_id`) REFERENCES `lotes` (`id_lote`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `envios`
--

LOCK TABLES `envios` WRITE;
/*!40000 ALTER TABLE `envios` DISABLE KEYS */;
INSERT INTO `envios` VALUES (1,'2021-05-08','09:47:00',1,1,2250,43,2293,'2021-05-08 12:47:43','2021-05-08 12:47:43');
/*!40000 ALTER TABLE `envios` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `TRG_insert_envios` AFTER INSERT ON `envios` FOR EACH ROW BEGIN
      CALL SP_AtualizaEstoqueOvos (
      new.periodo, 
      new.data_envio,
      new.lote_id, 
      new.incubaveis * -1,
      new.comerciais * -1,
      new.postura_dia * -1
      );
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `TRG_update_envios` AFTER UPDATE ON `envios` FOR EACH ROW BEGIN
      CALL SP_AtualizaEstoqueOvos (
      new.periodo, 
      new.data_envio,
      new.lote_id, 
      old.incubaveis - new.incubaveis,
      old.comerciais - new.comerciais,
      old.postura_dia - new.postura_dia
      );
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `TRG_delete_envios` AFTER DELETE ON `envios` FOR EACH ROW BEGIN
      CALL SP_AtualizaEstoqueOvos (
      old.periodo, 
      old.data_envio,
      old.lote_id, 
      old.incubaveis,
      old.comerciais,
      old.postura_dia
      )
      ;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `estoque_aves`
--

DROP TABLE IF EXISTS `estoque_aves`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estoque_aves` (
  `id_estoque` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_aviario` int(11) NOT NULL,
  `periodo` int(11) NOT NULL,
  `lote` int(11) NOT NULL,
  `data_estoque` date NOT NULL,
  `femea_box1` int(11) NOT NULL,
  `femea_box2` int(11) DEFAULT NULL,
  `femea_box3` int(11) DEFAULT NULL,
  `femea_box4` int(11) DEFAULT NULL,
  `macho_box1` int(11) NOT NULL,
  `macho_box2` int(11) DEFAULT NULL,
  `macho_box3` int(11) DEFAULT NULL,
  `macho_box4` int(11) DEFAULT NULL,
  `femea` int(11) NOT NULL,
  `macho` int(11) NOT NULL,
  `tot_ave` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_estoque`),
  KEY `estoque_aves_lote_foreign` (`lote`),
  CONSTRAINT `estoque_aves_lote_foreign` FOREIGN KEY (`lote`) REFERENCES `lotes` (`id_lote`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estoque_aves`
--

LOCK TABLES `estoque_aves` WRITE;
/*!40000 ALTER TABLE `estoque_aves` DISABLE KEYS */;
INSERT INTO `estoque_aves` VALUES (1,1,1,1,'2021-05-08',4847,NULL,NULL,NULL,479,NULL,NULL,NULL,4847,479,5326,'2021-05-05 20:05:28','2021-05-08 12:33:55');
/*!40000 ALTER TABLE `estoque_aves` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estoque_ovos`
--

DROP TABLE IF EXISTS `estoque_ovos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estoque_ovos` (
  `id_estoque` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `periodo` int(11) NOT NULL,
  `lote_id` int(11) NOT NULL,
  `data_estoque` date NOT NULL,
  `incubaveis` int(11) NOT NULL,
  `comerciais` int(11) NOT NULL,
  `postura_dia` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_estoque`),
  KEY `estoque_ovos_lote_id_foreign` (`lote_id`),
  CONSTRAINT `estoque_ovos_lote_id_foreign` FOREIGN KEY (`lote_id`) REFERENCES `lotes` (`id_lote`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estoque_ovos`
--

LOCK TABLES `estoque_ovos` WRITE;
/*!40000 ALTER TABLE `estoque_ovos` DISABLE KEYS */;
INSERT INTO `estoque_ovos` VALUES (1,1,1,'2021-05-16',16740,508,17328,'2021-05-08 12:24:15','2021-05-16 21:12:50');
/*!40000 ALTER TABLE `estoque_ovos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `financeiros`
--

DROP TABLE IF EXISTS `financeiros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `financeiros` (
  `id_financeiro` int(11) NOT NULL,
  `valor_ovo` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_financeiro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `financeiros`
--

LOCK TABLES `financeiros` WRITE;
/*!40000 ALTER TABLE `financeiros` DISABLE KEYS */;
/*!40000 ALTER TABLE `financeiros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fixtarefas`
--

DROP TABLE IF EXISTS `fixtarefas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fixtarefas` (
  `id_fixtarefa` int(11) NOT NULL,
  `data_inicio` date NOT NULL,
  `periodo` int(11) NOT NULL,
  `descritivo` char(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_termino` date DEFAULT NULL,
  `situacao` int(11) NOT NULL,
  `observacao` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_fixtarefa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fixtarefas`
--

LOCK TABLES `fixtarefas` WRITE;
/*!40000 ALTER TABLE `fixtarefas` DISABLE KEYS */;
/*!40000 ALTER TABLE `fixtarefas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `geraltarefas`
--

DROP TABLE IF EXISTS `geraltarefas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `geraltarefas` (
  `id_tarefa` int(11) NOT NULL,
  `periodo` int(11) NOT NULL,
  `data_inicio` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `data_previsao` date NOT NULL,
  `hora_previsao` time NOT NULL,
  `descritivo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_termino` date DEFAULT NULL,
  `hora_termino` time DEFAULT NULL,
  `situacao` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `observacao` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_tarefa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `geraltarefas`
--

LOCK TABLES `geraltarefas` WRITE;
/*!40000 ALTER TABLE `geraltarefas` DISABLE KEYS */;
/*!40000 ALTER TABLE `geraltarefas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lotes`
--

DROP TABLE IF EXISTS `lotes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lotes` (
  `id_lote` int(11) NOT NULL,
  `periodo` int(11) NOT NULL,
  `data_lote` date NOT NULL,
  `lote` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `femea` int(11) NOT NULL,
  `macho` int(11) NOT NULL,
  `femea_capitalizada` int(11) DEFAULT NULL,
  `data_femea_capitalizada` date DEFAULT NULL,
  `macho_capitalizado` int(11) DEFAULT NULL,
  `data_macho_capitalizado` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_lote`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lotes`
--

LOCK TABLES `lotes` WRITE;
/*!40000 ALTER TABLE `lotes` DISABLE KEYS */;
INSERT INTO `lotes` VALUES (1,1,'2021-02-22','121 CA',4850,480,4700,'2021-03-08',470,'2021-03-08','2021-05-05 20:02:03','2021-05-05 20:04:17');
/*!40000 ALTER TABLE `lotes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_03_172502_create_lote_table',1),(5,'2019_12_07_182459_create_aviario_table',1),(6,'2019_12_14_161002_alter_table_aviarios_add_column_lote_id',1),(7,'2020_02_24_095639_create_periodos_table',1),(8,'2020_02_24_095640_create_mortalidades_table',1),(9,'2020_02_24_095641_alter_table_mortalidades_add_column_lote_id',1),(10,'2020_03_01_184311_create_estoque_aves_table',1),(11,'2020_03_01_184312_alter_table_estoque_aves_add_column_lote',1),(12,'2020_03_01_190002_create_procedure_estoque_aves',1),(13,'2020_03_02_145156_create_trigger_insert_aviario',1),(14,'2020_03_02_145156_create_trigger_insert_mortalidade',1),(15,'2020_03_02_145209_create_trigger_update_aviario',1),(16,'2020_03_02_145209_create_trigger_update_mortalidade',1),(17,'2020_03_02_145219_create_trigger_delete_aviario',1),(18,'2020_03_02_145219_create_trigger_delete_mortalidade',1),(19,'2020_03_27_121213_create_coletas_table',1),(20,'2020_03_27_130330_alter_table_coletas_add_column_lote_id',1),(21,'2020_04_17_164628_create_estoque_ovos_table',1),(22,'2020_04_17_172807_alter_table_estoque_ovos_add_column_lote',1),(23,'2020_04_17_172808_create_procedure_estoque_ovos',1),(24,'2020_04_17_214917_create_trigger_insert_coleta',1),(25,'2020_04_17_214930_create_trigger_update_coleta',1),(26,'2020_04_17_214947_create_trigger_delete_coleta',1),(27,'2020_04_18_162145_create_envios_table',1),(28,'2020_04_18_162146_alter_table_envios_add_column_lote',1),(29,'2020_04_18_162222_create_trigger_insert_envio',1),(30,'2020_04_18_162925_create_trigger_update_envio',1),(31,'2020_04_18_163628_create_trigger_delete_envio',1),(32,'2020_04_21_094527_create_pesos_table',1),(33,'2020_04_21_174109_alter_table_pesos_add_column_lote',1),(34,'2020_05_12_150647_create_recebimentos_table',1),(35,'2020_05_12_150648_alter_table_recebimentos_add_column_lote',1),(36,'2020_05_13_150546_create_consumos_table',1),(37,'2020_05_13_150807_alter_table_consumo_add_column_lote',1),(38,'2020_05_13_171923_create_empresas_table',1),(39,'2020_05_17_171942_create_backups_table',1),(40,'2020_05_17_171943_create_emails_table',1),(41,'2020_05_19_095104_create_despesas_table',1),(42,'2020_05_19_095923_create_geraltarefas_table',1),(43,'2020_05_23_210858_create_semanas_table',1),(44,'2020_06_03_100129_create_checklist_table',1),(45,'2020_06_03_213604_alter_tables_estatisticas',1),(46,'2020_06_03_213840_alter_table_checklist',1),(47,'2020_06_10_213231_create_controlediarios_table',1),(48,'2020_06_10_220052_alter_table_controlediarios_add_column_lote',1),(49,'2020_06_18_210011_create_fixtarefas_table',1),(50,'2020_06_24_131937_create_relatorios_table',1),(51,'2020_11_04_122301_create_financeiros_table',1),(52,'2021_03_31_122703_create_sessions_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mortalidades`
--

DROP TABLE IF EXISTS `mortalidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mortalidades` (
  `id_mortalidade` int(11) NOT NULL,
  `lote_id` int(11) NOT NULL,
  `id_aviario` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `periodo` int(11) NOT NULL,
  `data_mortalidade` date NOT NULL,
  `femea_box1` int(11) NOT NULL,
  `femea_box2` int(11) DEFAULT NULL,
  `femea_box3` int(11) DEFAULT NULL,
  `femea_box4` int(11) DEFAULT NULL,
  `macho_box1` int(11) NOT NULL,
  `macho_box2` int(11) DEFAULT NULL,
  `macho_box3` int(11) DEFAULT NULL,
  `macho_box4` int(11) DEFAULT NULL,
  `femea` int(11) NOT NULL,
  `macho` int(11) NOT NULL,
  `tot_ave` int(11) NOT NULL,
  `motivo` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_mortalidade`),
  KEY `mortalidades_lote_id_foreign` (`lote_id`),
  CONSTRAINT `mortalidades_lote_id_foreign` FOREIGN KEY (`lote_id`) REFERENCES `lotes` (`id_lote`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mortalidades`
--

LOCK TABLES `mortalidades` WRITE;
/*!40000 ALTER TABLE `mortalidades` DISABLE KEYS */;
INSERT INTO `mortalidades` VALUES (1,1,'1',1,'2021-05-08',3,NULL,NULL,NULL,1,NULL,NULL,NULL,3,1,4,6,'2021-05-08 12:33:55','2021-05-08 12:33:55');
/*!40000 ALTER TABLE `mortalidades` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `TRG_insert_mortalidades` AFTER INSERT ON `mortalidades` FOR EACH ROW BEGIN
      CALL SP_AtualizaEstoqueAves (
      new.id_aviario, 
      new.periodo, 
      new.data_mortalidade,
      new.lote_id, 
      new.femea_box1 * -1,
      new.femea_box2 * -1,
      new.femea_box3 * -1,
      new.femea_box4 * -1,
      new.macho_box1 * -1,
      new.macho_box2 * -1,
      new.macho_box3 * -1,
      new.macho_box4 * -1,
      new.femea * -1, 
      new.macho * -1,
      new.tot_ave * -1
      );
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `TRG_update_mortalidades` AFTER UPDATE ON `mortalidades` FOR EACH ROW BEGIN
      CALL SP_AtualizaEstoqueAves (
      new.id_aviario, 
      new.periodo, 
      new.data_mortalidade,
      new.lote_id, 
      old.femea_box1 - new.femea_box1,
      old.femea_box2 - new.femea_box2,
      old.femea_box3 - new.femea_box3,
      old.femea_box4 - new.femea_box4,
      old.macho_box1 - new.macho_box1,
      old.macho_box2 - new.macho_box2,
      old.macho_box3 - new.macho_box3,
      old.macho_box4 - new.macho_box4,
      old.femea - new.femea, 
      old.macho - new.macho,
      old.tot_ave - new.tot_ave
      );
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `TRG_delete_mortalidades` AFTER DELETE ON `mortalidades` FOR EACH ROW BEGIN
      CALL SP_AtualizaEstoqueAves (
      old.id_aviario, 
      old.periodo, 
      old.data_mortalidade,
      old.lote_id, 
      old.femea_box1,
      old.femea_box2,
      old.femea_box3,
      old.femea_box4,
      old.macho_box1,
      old.macho_box2,
      old.macho_box3,
      old.macho_box4,
      old.femea, 
      old.macho,
      old.tot_ave
      )
      ;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `periodos`
--

DROP TABLE IF EXISTS `periodos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `periodos` (
  `id_periodo` int(11) NOT NULL,
  `data_inicial` date NOT NULL,
  `semana_inicial` int(11) NOT NULL,
  `semana_final` int(11) NOT NULL,
  `ativo` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `desativacao` date DEFAULT NULL,
  PRIMARY KEY (`id_periodo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `periodos`
--

LOCK TABLES `periodos` WRITE;
/*!40000 ALTER TABLE `periodos` DISABLE KEYS */;
INSERT INTO `periodos` VALUES (1,'2021-02-22',29,58,1,'2021-05-05 19:58:49','2021-05-05 19:58:49','2021-09-20');
/*!40000 ALTER TABLE `periodos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pesos`
--

DROP TABLE IF EXISTS `pesos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pesos` (
  `id_peso` int(11) NOT NULL,
  `data_peso` date NOT NULL,
  `periodo` int(11) NOT NULL,
  `lote_id` int(11) NOT NULL,
  `aviario_id` int(11) NOT NULL,
  `semana` int(11) NOT NULL,
  `femea_box1` decimal(10,2) NOT NULL,
  `femea_box2` decimal(10,2) DEFAULT NULL,
  `femea_box3` decimal(10,2) DEFAULT NULL,
  `femea_box4` decimal(10,2) DEFAULT NULL,
  `macho_box1` decimal(10,2) NOT NULL,
  `macho_box2` decimal(10,2) DEFAULT NULL,
  `macho_box3` decimal(10,2) DEFAULT NULL,
  `macho_box4` decimal(10,2) DEFAULT NULL,
  `femea` decimal(10,2) DEFAULT NULL,
  `macho` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_peso`),
  KEY `pesos_lote_id_foreign` (`lote_id`),
  CONSTRAINT `pesos_lote_id_foreign` FOREIGN KEY (`lote_id`) REFERENCES `lotes` (`id_lote`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pesos`
--

LOCK TABLES `pesos` WRITE;
/*!40000 ALTER TABLE `pesos` DISABLE KEYS */;
/*!40000 ALTER TABLE `pesos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recebimentos`
--

DROP TABLE IF EXISTS `recebimentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recebimentos` (
  `id_recebimento` int(11) NOT NULL,
  `periodo` int(11) NOT NULL,
  `lote_id` int(11) NOT NULL,
  `data_recebimento` date NOT NULL,
  `hora_recebimento` time NOT NULL,
  `sexo_ave` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantidade` int(11) NOT NULL,
  `nota_fiscal` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_recebimento`),
  KEY `recebimentos_lote_id_foreign` (`lote_id`),
  CONSTRAINT `recebimentos_lote_id_foreign` FOREIGN KEY (`lote_id`) REFERENCES `lotes` (`id_lote`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recebimentos`
--

LOCK TABLES `recebimentos` WRITE;
/*!40000 ALTER TABLE `recebimentos` DISABLE KEYS */;
/*!40000 ALTER TABLE `recebimentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `relatorios`
--

DROP TABLE IF EXISTS `relatorios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `relatorios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `descritivo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `relatorios`
--

LOCK TABLES `relatorios` WRITE;
/*!40000 ALTER TABLE `relatorios` DISABLE KEYS */;
/*!40000 ALTER TABLE `relatorios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `semanas`
--

DROP TABLE IF EXISTS `semanas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `semanas` (
  `id_semana` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `periodo` int(11) NOT NULL,
  `semana` int(11) NOT NULL,
  `data_inicial` date NOT NULL,
  `data_final` date NOT NULL,
  `eclosao` decimal(10,2) DEFAULT NULL,
  `fertilidade` decimal(10,2) DEFAULT NULL,
  `producao` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_semana`),
  KEY `semanas_periodo_foreign` (`periodo`),
  CONSTRAINT `semanas_periodo_foreign` FOREIGN KEY (`periodo`) REFERENCES `periodos` (`id_periodo`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `semanas`
--

LOCK TABLES `semanas` WRITE;
/*!40000 ALTER TABLE `semanas` DISABLE KEYS */;
INSERT INTO `semanas` VALUES (1,1,29,'2021-02-22','2021-03-01',NULL,NULL,NULL,'2021-05-05 19:58:49','2021-05-05 19:58:49'),(2,1,30,'2021-03-01','2021-03-08',NULL,NULL,NULL,'2021-05-05 19:58:49','2021-05-15 20:05:20'),(3,1,31,'2021-03-08','2021-03-15',NULL,30.60,NULL,'2021-05-05 19:58:49','2021-05-10 11:03:28'),(4,1,32,'2021-03-15','2021-03-22',NULL,55.01,NULL,'2021-05-05 19:58:49','2021-05-10 11:03:38'),(5,1,33,'2021-03-22','2021-03-29',NULL,72.20,NULL,'2021-05-05 19:58:49','2021-05-10 11:03:45'),(6,1,34,'2021-03-29','2021-04-05',NULL,70.90,NULL,'2021-05-05 19:58:49','2021-05-10 11:03:51'),(7,1,35,'2021-04-05','2021-04-12',NULL,70.00,NULL,'2021-05-05 19:58:49','2021-05-10 11:03:54'),(8,1,36,'2021-04-12','2021-04-19',NULL,70.00,NULL,'2021-05-05 19:58:49','2021-05-10 11:04:09'),(9,1,37,'2021-04-19','2021-04-26',NULL,69.00,NULL,'2021-05-05 19:58:49','2021-05-10 11:04:18'),(10,1,38,'2021-04-26','2021-05-03',NULL,68.00,NULL,'2021-05-05 19:58:49','2021-05-10 11:04:44'),(11,1,39,'2021-05-03','2021-05-10',NULL,67.10,NULL,'2021-05-05 19:58:49','2021-05-10 11:04:50'),(12,1,40,'2021-05-10','2021-05-17',NULL,66.10,60.00,'2021-05-05 19:58:49','2021-05-16 01:08:27'),(13,1,41,'2021-05-17','2021-05-24',NULL,65.10,NULL,'2021-05-05 19:58:49','2021-05-10 11:04:59'),(14,1,42,'2021-05-24','2021-05-31',NULL,64.20,NULL,'2021-05-05 19:58:49','2021-05-10 11:05:05'),(15,1,43,'2021-05-31','2021-06-07',NULL,63.20,NULL,'2021-05-05 19:58:49','2021-05-10 11:05:14'),(16,1,44,'2021-06-07','2021-06-14',NULL,62.30,NULL,'2021-05-05 19:58:49','2021-05-10 11:05:25'),(17,1,45,'2021-06-14','2021-06-21',NULL,61.30,NULL,'2021-05-05 19:58:49','2021-05-10 11:05:31'),(18,1,46,'2021-06-21','2021-06-28',NULL,60.30,NULL,'2021-05-05 19:58:49','2021-05-10 11:05:37'),(19,1,47,'2021-06-28','2021-07-05',NULL,59.40,NULL,'2021-05-05 19:58:49','2021-05-10 11:05:41'),(20,1,48,'2021-07-05','2021-07-12',NULL,58.40,NULL,'2021-05-05 19:58:49','2021-05-10 11:05:44'),(21,1,49,'2021-07-12','2021-07-19',NULL,57.40,NULL,'2021-05-05 19:58:49','2021-05-10 11:05:49'),(22,1,50,'2021-07-19','2021-07-26',NULL,56.50,NULL,'2021-05-05 19:58:49','2021-05-10 11:05:53'),(23,1,51,'2021-07-26','2021-08-02',NULL,55.40,NULL,'2021-05-05 19:58:49','2021-05-10 11:05:57'),(24,1,52,'2021-08-02','2021-08-09',NULL,54.40,NULL,'2021-05-05 19:58:49','2021-05-10 11:06:02'),(25,1,53,'2021-08-09','2021-08-16',NULL,53.50,NULL,'2021-05-05 19:58:49','2021-05-10 11:06:08'),(26,1,54,'2021-08-16','2021-08-23',NULL,52.50,NULL,'2021-05-05 19:58:49','2021-05-10 11:06:14'),(27,1,55,'2021-08-23','2021-08-30',NULL,51.50,NULL,'2021-05-05 19:58:49','2021-05-10 11:06:23'),(28,1,56,'2021-08-30','2021-09-06',NULL,50.60,NULL,'2021-05-05 19:58:49','2021-05-10 11:06:27'),(29,1,57,'2021-09-06','2021-09-13',NULL,49.60,NULL,'2021-05-05 19:58:49','2021-05-10 11:06:36'),(30,1,58,'2021-09-13','2021-09-20',NULL,48.60,NULL,'2021-05-05 19:58:49','2021-05-10 11:06:42');
/*!40000 ALTER TABLE `semanas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `funcao` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Administrador','administrador',NULL,NULL,'$2y$10$kwJewvyKAMxrmznx4E.mAO5/Zj1Ao72f7/kEYmPIjJzj90b61IH0K',0,NULL,'2021-05-05 19:49:04','2021-05-05 19:49:04');
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

-- Dump completed on 2021-05-16 19:00:01
