-- MySQL dump 10.13  Distrib 5.5.62, for Win64 (AMD64)
--
-- Host: localhost    Database: drafteam
-- ------------------------------------------------------
-- Server version	5.5.5-10.3.38-MariaDB-0ubuntu0.20.04.1

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
-- Table structure for table `championnat`
--

DROP TABLE IF EXISTS `championnat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `championnat` (
  `idChampionnat` int(11) NOT NULL AUTO_INCREMENT,
  `nomChampionnat` varchar(100) DEFAULT NULL,
  `saison` float DEFAULT NULL,
  `idSportif` int(11) DEFAULT NULL,
  PRIMARY KEY (`idChampionnat`),
  KEY `championnat_FK` (`idSportif`),
  CONSTRAINT `championnat_FK` FOREIGN KEY (`idSportif`) REFERENCES `sportif` (`idSportif`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `championnat`
--

LOCK TABLES `championnat` WRITE;
/*!40000 ALTER TABLE `championnat` DISABLE KEYS */;
INSERT INTO `championnat` VALUES (37,'Liga Santanders',2023,49),(38,'Champions league',2023,49),(39,'Serie A',2023,64);
/*!40000 ALTER TABLE `championnat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equipe`
--

DROP TABLE IF EXISTS `equipe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `equipe` (
  `idEquipe` int(11) NOT NULL AUTO_INCREMENT,
  `nomEquipe` varchar(100) DEFAULT NULL,
  `ecusson` varchar(150) DEFAULT NULL,
  `idLieu` int(11) DEFAULT NULL,
  PRIMARY KEY (`idEquipe`),
  KEY `equipe_FK_1` (`idLieu`),
  CONSTRAINT `equipe_FK_1` FOREIGN KEY (`idLieu`) REFERENCES `lieu` (`idLieu`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equipe`
--

LOCK TABLES `equipe` WRITE;
/*!40000 ALTER TABLE `equipe` DISABLE KEYS */;
INSERT INTO `equipe` VALUES (16,'Real Madrid','logoMadrid-removebg-preview.png2023-05-1507:38:44.png',1),(17,'AS Roma','téléchargement.png2023-05-1508:49:28.png',2);
/*!40000 ALTER TABLE `equipe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `etre_present`
--

DROP TABLE IF EXISTS `etre_present`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `etre_present` (
  `idSportif` int(11) NOT NULL,
  `idEvenement` int(11) NOT NULL,
  `present` int(11) DEFAULT NULL,
  `commentaire` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idSportif`,`idEvenement`),
  KEY `etre_present_FK_1` (`idEvenement`),
  CONSTRAINT `etre_present_FK` FOREIGN KEY (`idSportif`) REFERENCES `sportif` (`idSportif`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `etre_present_FK_1` FOREIGN KEY (`idEvenement`) REFERENCES `evenement` (`idEvenement`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `etre_present`
--

LOCK TABLES `etre_present` WRITE;
/*!40000 ALTER TABLE `etre_present` DISABLE KEYS */;
INSERT INTO `etre_present` VALUES (52,13,1,''),(53,13,NULL,NULL),(54,13,NULL,NULL),(55,13,NULL,NULL),(56,13,NULL,NULL),(57,13,NULL,NULL),(58,13,NULL,NULL),(59,13,NULL,NULL),(60,13,NULL,NULL),(61,13,NULL,NULL),(62,13,NULL,NULL),(63,13,NULL,NULL),(75,13,NULL,NULL);
/*!40000 ALTER TABLE `etre_present` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evenement`
--

DROP TABLE IF EXISTS `evenement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `evenement` (
  `idEvenement` int(11) NOT NULL AUTO_INCREMENT,
  `nomEvenement` varchar(100) NOT NULL DEFAULT 'event',
  `description` varchar(100) NOT NULL DEFAULT 'evenement',
  `dateEvenement` date NOT NULL DEFAULT '2023-01-01',
  `heureDebut` datetime NOT NULL DEFAULT '2023-01-01 00:00:00',
  `heureFin` datetime DEFAULT '2023-01-01 00:00:00',
  `image` varchar(150) DEFAULT NULL,
  `resultat` varchar(100) DEFAULT NULL,
  `idType` int(11) NOT NULL DEFAULT 1,
  `idLieu` int(11) DEFAULT NULL,
  `idSportif` int(11) DEFAULT NULL,
  `idEquipe` int(11) DEFAULT NULL,
  PRIMARY KEY (`idEvenement`),
  KEY `evenement_FK` (`idType`),
  KEY `evenement_FK_1` (`idLieu`),
  KEY `evenement_FK_2` (`idSportif`),
  KEY `evenement_FK_3` (`idEquipe`),
  CONSTRAINT `evenement_FK` FOREIGN KEY (`idType`) REFERENCES `type_evenement` (`idType`),
  CONSTRAINT `evenement_FK_1` FOREIGN KEY (`idLieu`) REFERENCES `lieu` (`idLieu`),
  CONSTRAINT `evenement_FK_2` FOREIGN KEY (`idSportif`) REFERENCES `sportif` (`idSportif`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `evenement_FK_3` FOREIGN KEY (`idEquipe`) REFERENCES `equipe` (`idEquipe`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evenement`
--

LOCK TABLES `evenement` WRITE;
/*!40000 ALTER TABLE `evenement` DISABLE KEYS */;
INSERT INTO `evenement` VALUES (13,'Real Madrid VS Manchester City','Match de champion&#39;s','2023-05-16','2023-05-16 20:30:00','2023-05-16 23:00:00','compoDV_neutre(3).png2023-05-1509:07:54.png',NULL,1,1,49,16);
/*!40000 ALTER TABLE `evenement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lieu`
--

DROP TABLE IF EXISTS `lieu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lieu` (
  `idLieu` int(11) NOT NULL AUTO_INCREMENT,
  `nomLieu` varchar(100) DEFAULT NULL,
  `adresse` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idLieu`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lieu`
--

LOCK TABLES `lieu` WRITE;
/*!40000 ALTER TABLE `lieu` DISABLE KEYS */;
INSERT INTO `lieu` VALUES (1,'Stade de la praille','Rte des jeunes 16, 1212 Lancy'),(2,'Stade de Frontenex','Plt de Frontenex 8, 1223 Cologny'),(3,'Stade des Trois-Chêne','Rte de Sous-Moulin 28, 1225 Chêne-Bourg'),(4,'Stade de la Fontenette','Rte de veyrier, 1227 Carouge'),(5,'Centre Sportif du Bout du Monde','Rte de Vessy 12. 1206 Genève');
/*!40000 ALTER TABLE `lieu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `participe`
--

DROP TABLE IF EXISTS `participe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `participe` (
  `idChampionnat` int(11) NOT NULL,
  `idEquipe` int(11) NOT NULL,
  `actif` int(11) DEFAULT NULL,
  PRIMARY KEY (`idEquipe`,`idChampionnat`),
  KEY `participe_FK_1` (`idChampionnat`),
  CONSTRAINT `participe_FK` FOREIGN KEY (`idEquipe`) REFERENCES `equipe` (`idEquipe`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `participe_FK_1` FOREIGN KEY (`idChampionnat`) REFERENCES `championnat` (`idChampionnat`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `participe`
--

LOCK TABLES `participe` WRITE;
/*!40000 ALTER TABLE `participe` DISABLE KEYS */;
INSERT INTO `participe` VALUES (37,16,0),(38,16,1),(38,17,1),(39,17,0);
/*!40000 ALTER TABLE `participe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `poste`
--

DROP TABLE IF EXISTS `poste`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `poste` (
  `idPoste` int(11) NOT NULL AUTO_INCREMENT,
  `poste` varchar(100) DEFAULT NULL,
  `staff` int(11) DEFAULT NULL,
  `admin` int(11) DEFAULT NULL,
  PRIMARY KEY (`idPoste`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `poste`
--

LOCK TABLES `poste` WRITE;
/*!40000 ALTER TABLE `poste` DISABLE KEYS */;
INSERT INTO `poste` VALUES (1,'Entraîneur',0,1),(2,'Adjoint',1,0),(3,'AT',0,0),(4,'MC',0,0),(5,'DC',0,0),(6,'G',0,0);
/*!40000 ALTER TABLE `poste` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sportif`
--

DROP TABLE IF EXISTS `sportif`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sportif` (
  `idSportif` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL DEFAULT '',
  `prenom` varchar(100) NOT NULL DEFAULT '',
  `numero` int(11) DEFAULT NULL,
  `dateNaissance` date DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL DEFAULT 'drafteam@drafteam.ch',
  `motDePasse` varchar(100) NOT NULL DEFAULT 'pwd',
  `telephone` varchar(100) DEFAULT NULL,
  `idEquipe` int(11) DEFAULT NULL,
  `baniere` varchar(100) DEFAULT NULL,
  `idPoste` int(11) DEFAULT NULL,
  PRIMARY KEY (`idSportif`),
  KEY `sportif_FK` (`idPoste`),
  KEY `sportif_FK_1` (`idEquipe`),
  CONSTRAINT `sportif_FK` FOREIGN KEY (`idPoste`) REFERENCES `poste` (`idPoste`),
  CONSTRAINT `sportif_FK_1` FOREIGN KEY (`idEquipe`) REFERENCES `equipe` (`idEquipe`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sportif`
--

LOCK TABLES `sportif` WRITE;
/*!40000 ALTER TABLE `sportif` DISABLE KEYS */;
INSERT INTO `sportif` VALUES (49,'Ancelotti','Carlos',NULL,'1975-02-12','14576.jpg2023-05-1506:53:53.jpg','carlos@ancelotti.com','$2y$10$oAlMRVgpQ0l9GpTeAvxSjO408kSAAwZe30OBwhtDOPgtZsMDDazJ.','0781234567',16,'carleto-kCVF--1248x698@abc.jpg2023-05-1507:06:29.jpg',1),(52,'Martin','Gabriel',NULL,'2003-09-29','cropped-cropped-logo_white_transparent.png2023-05-1509:15:43.png','gabrielmartingm7@gmail.com','$2y$10$hf/Jv6yNrumiQC5unZwXm.FyckquxJ88dt7bvo71oq4fa9R5GEgee','0762070678',16,'fcaa18ec-cuántos-batman.jpg2023-05-1509:15:43.jpg',3),(53,'','',NULL,NULL,NULL,'karim@benzema.com','$2y$10$audB.MBxjoq2pqtg7jsum.GASUHqV83iMbD1HCdXypgij3dcZkhqC',NULL,16,NULL,3),(54,'','',NULL,NULL,NULL,'cristiano@ronaldo.com','$2y$10$skcJaN3nM5YcW4/2cs1WSOQgHw1SshUdHoHf6qBCn74u11AUCVT/q',NULL,16,NULL,3),(55,'','',NULL,NULL,NULL,'luka@modric.com','$2y$10$Mm9UJgljwlKya9bhJA40AufNV2etggx6HsE5tU2ga73qdwvKlLnhe',NULL,16,NULL,4),(56,'','',NULL,NULL,NULL,'toni@kroos.com','$2y$10$0HYpvf0/Mney4ysarC4y0.MfJT5MOWKGqW43/LN.hH1XPbtyLzyoG',NULL,16,NULL,4),(57,'','',NULL,NULL,NULL,'vinicius@junior.com','$2y$10$/JwKHizoxD/jSAD0xBdPZ.XuxL1tvnGrpwaLsEolwhfzes3IPtxNK',NULL,16,NULL,3),(58,'','',NULL,NULL,NULL,'sergio@ramos.com','$2y$10$uVDbdEd0nJ3iMGeUnyVGAu3Q2/zOlkxW68Spp3OQjXrSZL7zQLQuS',NULL,16,NULL,5),(59,'','',NULL,NULL,NULL,'david@alaba.com','$2y$10$6iDWNFm68R.IAzgoOKZIAeNKmvmYCVmG8sh5AaepbcsuTUk1Ah/oi',NULL,16,NULL,5),(60,'','',NULL,NULL,NULL,'thibaut@courtois.com','$2y$10$J6k3pmfJzMEmQ0bXsvYjredrYjoYCHjg89skpEtE8jcS.WuGa.nZ6',NULL,16,NULL,6),(61,'','',NULL,NULL,NULL,'marcelo@vieira.com','$2y$10$VS6ES8Bb00PMBTpopgVSFub7xPxnm/2AqvoG3oNxbpSBYyWuHvt6i',NULL,16,NULL,5),(62,'','',NULL,NULL,NULL,'dani@carvajal.com','$2y$10$D5TQhHBGm.8ngacMX6axjOELYrDFKl383BIoQmQPorCMZOQWgsyXy',NULL,16,NULL,5),(63,'','',NULL,NULL,NULL,'zinedine@zidane.com','$2y$10$1frgifH/imm5rvnHXitpEOmCdfBmX4uop74Wkdx8tyvQi7mUPMOBO',NULL,16,NULL,2),(64,'Mourinho','José',NULL,'1977-07-14','mourinho-was-furious-with-solskjaers-post-match-comments-abo-1a0853-sc.jpg2023-05-1508:46:23.jpg','jose@mourinho.com','$2y$10$6gjmA35Tj6R/AuJ2BKSCcuWzJ1VJXvJsbsgyBjT2vqEQ0a5MygyzW','0791234567',17,'399449093_highres.jpg2023-05-1508:46:23.jpg',1),(65,'','',NULL,NULL,NULL,'tammy@abraham.com','$2y$10$YMOOACZDLo//rtfZHnPZcO/cVOB0ViLm2G4ejd4/lB53K3HwPEZEW',NULL,17,NULL,3),(66,'','',NULL,NULL,NULL,'andrea@belotti.com','$2y$10$LBwjTQbdh0MTUWbgbkM37.42bUPvcLlY8vAuKafY.9MVZIkS/rMM.',NULL,17,NULL,3),(67,'','',NULL,NULL,NULL,'lorenzo@pellegrini.com','$2y$10$hCp/0ZCzs575Ep6kTTqSJeucd3nHBozGFBH1hZcajKHgsOVeOFeAC',NULL,17,NULL,4),(68,'','',NULL,NULL,NULL,'nemanja@matic.com','$2y$10$eImF4.hqAexfXt4xHLt0N.tDt1cTgGflebvY9ky7z1PvO9XKqZbsG',NULL,17,NULL,4),(69,'','',NULL,NULL,NULL,'edoardo@bove.com','$2y$10$JuYb4kPqdMNJ7Qdt2fDiAOVSBSTg0HmbqHO2V3qBaL/bixjNITULK',NULL,17,NULL,4),(70,'','',NULL,NULL,NULL,'roger@silva.com','$2y$10$b9tltsy/rYWWrktdMUvaYuGaY.4AlJ1vHkIb9UzwmxuuuEDcy.AeS',NULL,17,NULL,5),(71,'','',NULL,NULL,NULL,'roger@ibanez.com','$2y$10$OOOZXpuNm/lLDEMJYx05iOhFXYODzP/1v7Sp2Im5tAM57XfWSlVh2',NULL,17,NULL,5),(72,'','',NULL,NULL,NULL,'gianluca@mancini.com','$2y$10$7RH/CgPaDS9tG4MpqG0uJuSKsvLHRfofiOvptGqVUwtoO6Y8K/vca',NULL,17,NULL,5),(73,'','',NULL,NULL,NULL,'rui@patricio.com','$2y$10$8SzKTiWgwieIdsRwpC4Pfu16IW6GyUGkKdqTgC7wGPfnoDRjAZFnS',NULL,17,NULL,6),(74,'','',NULL,NULL,NULL,'jean@michel.com','$2y$10$q40NsE0ivpDrGWVSdFHWpuS9Ic1oWl.s7IDyHVpsYcknXruaQgHBC',NULL,17,NULL,2),(75,'','',NULL,NULL,NULL,'eduardo@camavinga.ch','$2y$10$hopv2I2a8E827eH8Fh/zC.kQsXv3xi2.4k/WvpIuj0emw.ClbI.0G',NULL,16,NULL,4);
/*!40000 ALTER TABLE `sportif` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `type_evenement`
--

DROP TABLE IF EXISTS `type_evenement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `type_evenement` (
  `idType` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idType`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type_evenement`
--

LOCK TABLES `type_evenement` WRITE;
/*!40000 ALTER TABLE `type_evenement` DISABLE KEYS */;
INSERT INTO `type_evenement` VALUES (1,'Match'),(2,'Réunion'),(3,'Entraînement');
/*!40000 ALTER TABLE `type_evenement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'drafteam'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-05-15 13:22:37
