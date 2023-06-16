-- MySQL dump 10.13  Distrib 8.0.32, for Win64 (x86_64)
--
-- Host: localhost    Database: eputuj
-- ------------------------------------------------------
-- Server version	8.0.32

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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `SifK` int NOT NULL,
  PRIMARY KEY (`SifK`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (5);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jedobio`
--

DROP TABLE IF EXISTS `jedobio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jedobio` (
  `SifK` int NOT NULL,
  `SifPokl` int NOT NULL,
  `JeDobioPK` int NOT NULL AUTO_INCREMENT,
  `Datum` datetime NOT NULL,
  PRIMARY KEY (`JeDobioPK`),
  KEY `fk_jedobio_sifpokl` (`SifPokl`),
  KEY `FK_SifK_idx` (`SifK`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jedobio`
--

LOCK TABLES `jedobio` WRITE;
/*!40000 ALTER TABLE `jedobio` DISABLE KEYS */;
/*!40000 ALTER TABLE `jedobio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `korisnik`
--

DROP TABLE IF EXISTS `korisnik`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `korisnik` (
  `SifK` int NOT NULL AUTO_INCREMENT,
  `KorisnickoIme` varchar(20) NOT NULL,
  `Lozinka` varchar(20) NOT NULL,
  `TraziBrisanje` int NOT NULL,
  `Ime` varchar(20) NOT NULL,
  `Prezime` varchar(20) NOT NULL,
  `BrTel` bigint NOT NULL,
  `Email` varchar(45) NOT NULL,
  `PrivatnikIliKorisnik` varchar(1) NOT NULL,
  `Novac` float NOT NULL,
  `ProfilnaSlika` text NOT NULL,
  PRIMARY KEY (`SifK`),
  UNIQUE KEY `Kime` (`KorisnickoIme`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `korisnik`
--

LOCK TABLES `korisnik` WRITE;
/*!40000 ALTER TABLE `korisnik` DISABLE KEYS */;
INSERT INTO `korisnik` VALUES (0,'anja.curic','Anjacuric123#',0,'Anja','Curic',4807,'pomocniEPUTUJ2@outlook.com','K',0,''),(2,'lanaIvk','Ivkovic123#',0,'Lana','Ivkovic',12345678,'pomocniEPUTUJ2@outlook.com','K',100,'2_20230531215759_RE4wE8t.jfif'),(4,'milica.c','Milica123#',0,'Milica','Cvetkovic',1234567,'pomocniEPUTUJ2@outlook.com','P',0,''),(5,'admin','Admin123#',0,'admin','admin',0,'admin','A',0,''),(12,'trivic123','Trivic123#',1,'Aleksa','Trivic',38165123433,'pomocniEPUTUJ1@outlook.com','K',-420,'12_20230615222956_slika.jpg'),(15,'pero123','Pero123#',0,'Pero','Peric',654567890,'pero@gmail.com','K',0,''),(16,'anja12333','Anja123#',0,'Anja','Curic',65732659,'anjacuric96@gmail.com','K',0,''),(18,'djordje.golubovic','Proba123#',0,'Djordje','Golubovic',65,'gd200112d@student.etf.bg.ac.rs','K',0,'');
/*!40000 ALTER TABLE `korisnik` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kupljenakarta`
--

DROP TABLE IF EXISTS `kupljenakarta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kupljenakarta` (
  `SifKar` int NOT NULL AUTO_INCREMENT,
  `NacinPlacanja` decimal(10,2) NOT NULL,
  `SifP` int NOT NULL,
  `SifK` int NOT NULL,
  PRIMARY KEY (`SifKar`),
  KEY `R_24` (`SifP`),
  KEY `R_25` (`SifK`),
  CONSTRAINT `R_24` FOREIGN KEY (`SifP`) REFERENCES `ponuda` (`SifP`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `R_25` FOREIGN KEY (`SifK`) REFERENCES `obicankorisnik` (`SifK`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kupljenakarta`
--

LOCK TABLES `kupljenakarta` WRITE;
/*!40000 ALTER TABLE `kupljenakarta` DISABLE KEYS */;
/*!40000 ALTER TABLE `kupljenakarta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mesto`
--

DROP TABLE IF EXISTS `mesto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `mesto` (
  `SifM` int NOT NULL AUTO_INCREMENT,
  `Naziv` varchar(20) NOT NULL,
  PRIMARY KEY (`SifM`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mesto`
--

LOCK TABLES `mesto` WRITE;
/*!40000 ALTER TABLE `mesto` DISABLE KEYS */;
INSERT INTO `mesto` VALUES (0,'Beograd'),(1,'Aleksinac'),(2,'Novi Sad'),(3,'Jagodina'),(4,'Subotica'),(5,'Kragujevac'),(6,'Kraljevo'),(7,'Smederevo'),(8,'Valjevo'),(9,'Madrid'),(10,'Barselona'),(11,'Pariz'),(12,'Prijepolje'),(13,'Trebinje'),(14,'Požarevac');
/*!40000 ALTER TABLE `mesto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `obicankorisnik`
--

DROP TABLE IF EXISTS `obicankorisnik`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `obicankorisnik` (
  `SifK` int NOT NULL,
  `token` int NOT NULL,
  PRIMARY KEY (`SifK`),
  CONSTRAINT `R_3` FOREIGN KEY (`SifK`) REFERENCES `korisnik` (`SifK`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `obicankorisnik`
--

LOCK TABLES `obicankorisnik` WRITE;
/*!40000 ALTER TABLE `obicankorisnik` DISABLE KEYS */;
INSERT INTO `obicankorisnik` VALUES (0,0),(2,0),(12,0),(15,0),(16,0),(18,0);
/*!40000 ALTER TABLE `obicankorisnik` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ocena`
--

DROP TABLE IF EXISTS `ocena`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ocena` (
  `SifO` int NOT NULL AUTO_INCREMENT,
  `Ocena` int NOT NULL,
  `Komentar` varchar(20) DEFAULT NULL,
  `SifPriv` int NOT NULL,
  `SifK` int NOT NULL,
  PRIMARY KEY (`SifO`),
  KEY `R_30` (`SifPriv`),
  KEY `R_31` (`SifK`),
  CONSTRAINT `R_30` FOREIGN KEY (`SifPriv`) REFERENCES `privatnik` (`SifK`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `R_31` FOREIGN KEY (`SifK`) REFERENCES `obicankorisnik` (`SifK`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ocena`
--

LOCK TABLES `ocena` WRITE;
/*!40000 ALTER TABLE `ocena` DISABLE KEYS */;
INSERT INTO `ocena` VALUES (2,3,'',4,0),(3,5,'super',4,0),(4,5,'super',4,0),(5,5,'Super',4,0),(6,5,'Super',4,0),(7,5,'Super',4,0),(8,5,'Super',4,0),(9,3,'',4,0),(10,5,'super',4,0),(11,5,'super',4,0),(12,5,'',4,0),(13,5,'super',4,12),(14,5,'super',4,12),(15,5,'super',4,12),(16,5,'',4,12);
/*!40000 ALTER TABLE `ocena` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `poklon`
--

DROP TABLE IF EXISTS `poklon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `poklon` (
  `SifPokl` int NOT NULL AUTO_INCREMENT,
  `Iznos` decimal(10,2) NOT NULL,
  `TipPoklona` varchar(20) NOT NULL,
  PRIMARY KEY (`SifPokl`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `poklon`
--

LOCK TABLES `poklon` WRITE;
/*!40000 ALTER TABLE `poklon` DISABLE KEYS */;
INSERT INTO `poklon` VALUES (1,10.00,'%'),(2,5.00,'%'),(3,8.00,'%'),(4,40.00,'€'),(5,20.00,'%'),(6,20.00,'€'),(7,15.00,'€');
/*!40000 ALTER TABLE `poklon` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ponuda`
--

DROP TABLE IF EXISTS `ponuda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ponuda` (
  `SifP` int NOT NULL AUTO_INCREMENT,
  `BrMesta` int NOT NULL,
  `DatumOd` date NOT NULL,
  `DatumDo` date DEFAULT NULL,
  `VremeOd` time NOT NULL,
  `VremeDo` time DEFAULT NULL,
  `CenaKarte` decimal(10,2) NOT NULL,
  `SifMesDo` int NOT NULL,
  `SifMesOd` int NOT NULL,
  `SifSred` int NOT NULL,
  `SifK` int NOT NULL,
  `Slika` text NOT NULL,
  `SifPriv` int NOT NULL,
  PRIMARY KEY (`SifP`),
  KEY `R_10` (`SifMesDo`),
  KEY `R_11` (`SifMesOd`),
  KEY `R_12` (`SifSred`),
  KEY `R_26_idx` (`SifK`),
  CONSTRAINT `R_10` FOREIGN KEY (`SifMesDo`) REFERENCES `mesto` (`SifM`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `R_11` FOREIGN KEY (`SifMesOd`) REFERENCES `mesto` (`SifM`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `R_12` FOREIGN KEY (`SifSred`) REFERENCES `prevoznosredstvo` (`SifSred`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `R_26` FOREIGN KEY (`SifK`) REFERENCES `korisnik` (`SifK`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ponuda`
--

LOCK TABLES `ponuda` WRITE;
/*!40000 ALTER TABLE `ponuda` DISABLE KEYS */;
INSERT INTO `ponuda` VALUES (3,5,'2023-06-14','2023-06-18','22:22:00','19:00:00',10.00,0,14,2,2,'',0),(4,5,'2023-06-14','2023-06-18','22:22:00','19:00:00',0.00,0,14,2,2,'',0),(5,5,'2023-06-14','2023-06-18','22:22:00','19:00:00',0.00,0,14,2,2,'',0),(36,1,'2023-07-09','2023-06-26','23:00:00','20:00:00',0.00,3,8,2,12,'',3),(37,1,'2023-07-09','2023-06-26','23:00:00','20:00:00',0.00,3,8,2,12,'',4),(38,1,'2023-07-09','2023-06-26','23:00:00','20:00:00',0.00,3,8,2,12,'',5),(40,7,'2023-07-06','2023-06-27','06:00:00','04:00:00',0.00,5,2,3,12,'',3),(41,7,'2023-07-06','2023-06-27','06:00:00','04:00:00',0.00,5,2,3,12,'',4),(42,7,'2023-07-06','2023-06-27','06:00:00','04:00:00',0.00,5,2,3,12,'',5),(43,6,'2023-06-07','2023-06-10','23:11:00','00:11:00',0.00,0,2,1,12,'',3),(44,6,'2023-06-07','2023-06-10','23:11:00','00:11:00',0.00,0,2,1,12,'',4),(45,6,'2023-06-07','2023-06-10','23:11:00','00:11:00',0.00,0,2,1,12,'47_20230616003255_beograd.jpeg',5),(47,8,'2023-06-25','2023-06-29','22:22:00','22:02:00',100.00,0,14,2,4,'47_20230616003255_beograd.jpeg',4),(48,5,'2023-06-22','2023-06-22','09:00:00','15:00:00',30.00,1,4,1,4,'48_20230616002930_aleksinac.jpeg',4),(49,20,'2023-07-09','2023-07-09','06:00:00','07:45:00',10.00,3,8,2,4,'49_20230616002823_jagodina.jpg',4),(50,2,'2023-06-24','2023-06-24','15:00:00','18:00:00',50.00,8,3,1,4,'50_20230616001636_valjevo.jpeg',4),(52,80,'2023-06-23','2023-06-23','20:00:00','22:00:00',10.00,4,2,2,4,'52_20230616001755_subotica.jpeg',4),(53,100,'2023-06-25','2023-06-26','21:45:00','06:30:00',40.00,13,0,2,4,'53_20230616001855_trebinje.jpeg',4),(54,95,'2023-06-26','2023-06-26','10:15:00','11:00:00',5.00,2,0,2,4,'54_20230616002037_novisad.jpg',4),(55,200,'2023-06-27','2023-07-01','14:00:00','15:00:00',150.00,11,0,2,4,'55_20230616002144_pariz.jpeg',4),(56,156,'2023-06-25','2023-06-28','14:00:00','15:00:00',100.00,9,11,2,4,'56_20230616002238_madrid.jpeg',4),(57,100,'2023-06-24','2023-06-27','11:00:00','11:00:00',135.00,10,0,2,4,'57_20230616002400_barselona.jpeg',4),(58,145,'2023-06-23','2023-06-23','10:00:00','16:00:00',20.00,0,12,1,4,'58_20230616002455_beograd.jpeg',4),(59,30,'2023-06-22','2023-06-22','11:00:00','13:00:00',10.00,5,6,2,4,'59_20230616002543_kragujevac.jpeg',4);
/*!40000 ALTER TABLE `ponuda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `poruka`
--

DROP TABLE IF EXISTS `poruka`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `poruka` (
  `SifPonuda` int NOT NULL,
  `SifKor` int NOT NULL,
  `SifPriv` int NOT NULL,
  `SifPor` int NOT NULL AUTO_INCREMENT,
  `SmerPoruke` int NOT NULL,
  PRIMARY KEY (`SifPor`),
  KEY `R_13` (`SifPonuda`),
  KEY `R_16` (`SifKor`),
  KEY `R_17` (`SifPriv`),
  CONSTRAINT `R_13` FOREIGN KEY (`SifPonuda`) REFERENCES `ponuda` (`SifP`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `R_16` FOREIGN KEY (`SifKor`) REFERENCES `obicankorisnik` (`SifK`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `R_17` FOREIGN KEY (`SifPriv`) REFERENCES `privatnik` (`SifK`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `poruka`
--

LOCK TABLES `poruka` WRITE;
/*!40000 ALTER TABLE `poruka` DISABLE KEYS */;
INSERT INTO `poruka` VALUES (5,2,5,16,1),(38,12,5,20,1),(41,12,4,23,1),(42,12,5,24,1),(44,12,4,26,1),(45,12,5,27,1),(49,12,4,30,2);
/*!40000 ALTER TABLE `poruka` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `postavljenaponuda`
--

DROP TABLE IF EXISTS `postavljenaponuda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `postavljenaponuda` (
  `SifP` int NOT NULL,
  `RokZaOtkazivanje` int NOT NULL,
  PRIMARY KEY (`SifP`),
  CONSTRAINT `R_8` FOREIGN KEY (`SifP`) REFERENCES `ponuda` (`SifP`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `postavljenaponuda`
--

LOCK TABLES `postavljenaponuda` WRITE;
/*!40000 ALTER TABLE `postavljenaponuda` DISABLE KEYS */;
INSERT INTO `postavljenaponuda` VALUES (3,1),(48,3),(50,3),(52,5),(53,9),(54,5),(55,10),(56,5),(57,4),(58,2),(59,3);
/*!40000 ALTER TABLE `postavljenaponuda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pretplata`
--

DROP TABLE IF EXISTS `pretplata`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pretplata` (
  `SifPret` int NOT NULL AUTO_INCREMENT,
  `Naziv` varchar(20) NOT NULL,
  `Iznos` decimal(10,2) NOT NULL,
  PRIMARY KEY (`SifPret`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pretplata`
--

LOCK TABLES `pretplata` WRITE;
/*!40000 ALTER TABLE `pretplata` DISABLE KEYS */;
INSERT INTO `pretplata` VALUES (1,'Standard',9.99),(2,'Premium',29.99);
/*!40000 ALTER TABLE `pretplata` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prevoznosredstvo`
--

DROP TABLE IF EXISTS `prevoznosredstvo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prevoznosredstvo` (
  `SifSred` int NOT NULL AUTO_INCREMENT,
  `Naziv` varchar(20) NOT NULL,
  PRIMARY KEY (`SifSred`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prevoznosredstvo`
--

LOCK TABLES `prevoznosredstvo` WRITE;
/*!40000 ALTER TABLE `prevoznosredstvo` DISABLE KEYS */;
INSERT INTO `prevoznosredstvo` VALUES (1,'Automobil'),(2,'Autobus'),(3,'Brod');
/*!40000 ALTER TABLE `prevoznosredstvo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `privatnik`
--

DROP TABLE IF EXISTS `privatnik`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `privatnik` (
  `SifK` int NOT NULL,
  `SifPret` int NOT NULL,
  PRIMARY KEY (`SifK`),
  KEY `R_5` (`SifPret`),
  CONSTRAINT `R_4` FOREIGN KEY (`SifK`) REFERENCES `korisnik` (`SifK`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `R_5` FOREIGN KEY (`SifPret`) REFERENCES `pretplata` (`SifPret`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `privatnik`
--

LOCK TABLES `privatnik` WRITE;
/*!40000 ALTER TABLE `privatnik` DISABLE KEYS */;
INSERT INTO `privatnik` VALUES (5,1),(4,2);
/*!40000 ALTER TABLE `privatnik` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `report`
--

DROP TABLE IF EXISTS `report`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `report` (
  `Razlog` varchar(20) NOT NULL,
  `SifPrijavio` int NOT NULL,
  `SifRep` int NOT NULL AUTO_INCREMENT,
  `SifPrijavljen` int NOT NULL,
  PRIMARY KEY (`SifRep`),
  KEY `R_28` (`SifPrijavljen`),
  KEY `f_32_idx` (`SifPrijavio`),
  CONSTRAINT `f_31` FOREIGN KEY (`SifPrijavljen`) REFERENCES `privatnik` (`SifK`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `f_32` FOREIGN KEY (`SifPrijavio`) REFERENCES `obicankorisnik` (`SifK`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `report`
--

LOCK TABLES `report` WRITE;
/*!40000 ALTER TABLE `report` DISABLE KEYS */;
INSERT INTO `report` VALUES ('Lazno predstavljanje',2,6,4),('Lazno predstavljanje',2,7,4),('Lazno predstavljanje',2,8,4);
/*!40000 ALTER TABLE `report` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rezervacija`
--

DROP TABLE IF EXISTS `rezervacija`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rezervacija` (
  `SifK` int NOT NULL,
  `SifP` int NOT NULL,
  `BrMesta` int NOT NULL,
  `SifR` int NOT NULL AUTO_INCREMENT,
  `DatumRezervacije` datetime NOT NULL,
  PRIMARY KEY (`SifR`),
  KEY `R_18` (`SifK`),
  KEY `R_19` (`SifP`),
  CONSTRAINT `R_18` FOREIGN KEY (`SifK`) REFERENCES `obicankorisnik` (`SifK`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `R_19` FOREIGN KEY (`SifP`) REFERENCES `ponuda` (`SifP`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rezervacija`
--

LOCK TABLES `rezervacija` WRITE;
/*!40000 ALTER TABLE `rezervacija` DISABLE KEYS */;
/*!40000 ALTER TABLE `rezervacija` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uplata`
--

DROP TABLE IF EXISTS `uplata`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `uplata` (
  `SifU` int NOT NULL AUTO_INCREMENT,
  `DatumUplate` datetime NOT NULL,
  `Iznos` decimal(10,2) NOT NULL,
  `SifKar` int NOT NULL,
  PRIMARY KEY (`SifU`),
  KEY `R_23` (`SifKar`),
  CONSTRAINT `R_23` FOREIGN KEY (`SifKar`) REFERENCES `kupljenakarta` (`SifKar`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uplata`
--

LOCK TABLES `uplata` WRITE;
/*!40000 ALTER TABLE `uplata` DISABLE KEYS */;
/*!40000 ALTER TABLE `uplata` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vanrednaponuda`
--

DROP TABLE IF EXISTS `vanrednaponuda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vanrednaponuda` (
  `SifP` int NOT NULL,
  `RokZaOtkazivanje` int NOT NULL,
  PRIMARY KEY (`SifP`),
  CONSTRAINT `R_9` FOREIGN KEY (`SifP`) REFERENCES `ponuda` (`SifP`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vanrednaponuda`
--

LOCK TABLES `vanrednaponuda` WRITE;
/*!40000 ALTER TABLE `vanrednaponuda` DISABLE KEYS */;
INSERT INTO `vanrednaponuda` VALUES (49,6);
/*!40000 ALTER TABLE `vanrednaponuda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zahtevponuda`
--

DROP TABLE IF EXISTS `zahtevponuda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `zahtevponuda` (
  `SifP` int NOT NULL,
  `CenaOd` decimal(10,2) NOT NULL,
  `CenaDo` decimal(10,2) NOT NULL,
  PRIMARY KEY (`SifP`),
  CONSTRAINT `R_7` FOREIGN KEY (`SifP`) REFERENCES `ponuda` (`SifP`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zahtevponuda`
--

LOCK TABLES `zahtevponuda` WRITE;
/*!40000 ALTER TABLE `zahtevponuda` DISABLE KEYS */;
INSERT INTO `zahtevponuda` VALUES (3,0.00,200.00),(4,0.00,200.00),(5,0.00,200.00),(36,15.00,25.00),(37,15.00,25.00),(38,15.00,25.00),(40,200.00,400.00),(41,200.00,400.00),(42,200.00,400.00),(43,200.00,400.00),(44,200.00,400.00),(45,200.00,400.00);
/*!40000 ALTER TABLE `zahtevponuda` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-06-16  2:35:43
