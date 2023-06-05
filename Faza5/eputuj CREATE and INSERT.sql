-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 05, 2023 at 10:22 PM
-- Server version: 8.0.31
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eputuj`
--
CREATE DATABASE IF NOT EXISTS `eputuj` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `eputuj`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `SifK` int NOT NULL,
  PRIMARY KEY (`SifK`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`SifK`) VALUES
(5);

-- --------------------------------------------------------

--
-- Table structure for table `jedobio`
--

DROP TABLE IF EXISTS `jedobio`;
CREATE TABLE IF NOT EXISTS `jedobio` (
  `SifK` int NOT NULL,
  `SifPokl` int NOT NULL,
  `JeDobioPK` int NOT NULL AUTO_INCREMENT,
  `Datum` datetime NOT NULL,
  PRIMARY KEY (`JeDobioPK`),
  KEY `fk_jedobio_sifpokl` (`SifPokl`),
  KEY `FK_SifK_idx` (`SifK`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

DROP TABLE IF EXISTS `korisnik`;
CREATE TABLE IF NOT EXISTS `korisnik` (
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`SifK`, `KorisnickoIme`, `Lozinka`, `TraziBrisanje`, `Ime`, `Prezime`, `BrTel`, `Email`, `PrivatnikIliKorisnik`, `Novac`, `ProfilnaSlika`) VALUES
(0, 'anja.curic', 'anjacuric#111', 0, 'Anja', 'Curic', 4807, 'pomocniEPUTUJ2@outlook.com', 'K', 0, ''),
(2, 'lanaIvk', 'lana123', 0, 'Lana', 'Ivkovic', 12345678, 'pomocniEPUTUJ2@outlook.com', 'K', 100, '2_20230531215759_RE4wE8t.jfif'),
(3, 'zeljko123', 'zeljko123', 0, 'Zeljko ', 'Urosevic', 432678900, 'pomocniEPUTUJ2@outlook.com', 'P', 400, '3_20230531220122_RE4wwtb.jpg'),
(4, 'milica.c', 'milica123', 0, 'Milica', 'Cvetkovic', 1234, 'pomocniEPUTUJ2@outlook.com', 'P', 0, ''),
(5, 'admin', 'admin', 0, 'admin', 'admin', 0, 'admin', 'A', 0, ''),
(12, 'trivic123', 'Trivic123!', 0, 'Aleksa', 'Trivic', 38165123456, 'pomocniEPUTUJ2@outlook.com', 'K', -420, '');

-- --------------------------------------------------------

--
-- Table structure for table `kupljenakarta`
--

DROP TABLE IF EXISTS `kupljenakarta`;
CREATE TABLE IF NOT EXISTS `kupljenakarta` (
  `SifKar` int NOT NULL AUTO_INCREMENT,
  `NacinPlacanja` decimal(10,2) NOT NULL,
  `SifP` int NOT NULL,
  `SifK` int NOT NULL,
  PRIMARY KEY (`SifKar`),
  KEY `R_24` (`SifP`),
  KEY `R_25` (`SifK`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kupljenakarta`
--

INSERT INTO `kupljenakarta` (`SifKar`, `NacinPlacanja`, `SifP`, `SifK`) VALUES
(2, '100.00', 46, 12),
(3, '100.00', 46, 12),
(4, '100.00', 35, 12),
(5, '100.00', 46, 12),
(6, '100.00', 46, 12);

-- --------------------------------------------------------

--
-- Table structure for table `mesto`
--

DROP TABLE IF EXISTS `mesto`;
CREATE TABLE IF NOT EXISTS `mesto` (
  `SifM` int NOT NULL AUTO_INCREMENT,
  `Naziv` varchar(20) NOT NULL,
  PRIMARY KEY (`SifM`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `mesto`
--

INSERT INTO `mesto` (`SifM`, `Naziv`) VALUES
(0, 'Beograd'),
(1, 'Aleksinac'),
(2, 'Novi Sad'),
(3, 'Jagodina'),
(4, 'Subotica'),
(5, 'Kragujevac'),
(6, 'Kraljevo'),
(7, 'Smederevo'),
(8, 'Valjevo'),
(9, 'Madrid'),
(10, 'Barselona'),
(11, 'Pariz'),
(12, 'Prijepolje'),
(13, 'Trebinje'),
(14, 'Požarevac');

-- --------------------------------------------------------

--
-- Table structure for table `obicankorisnik`
--

DROP TABLE IF EXISTS `obicankorisnik`;
CREATE TABLE IF NOT EXISTS `obicankorisnik` (
  `SifK` int NOT NULL,
  `token` int NOT NULL,
  PRIMARY KEY (`SifK`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `obicankorisnik`
--

INSERT INTO `obicankorisnik` (`SifK`, `token`) VALUES
(0, 0),
(2, 0),
(12, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ocena`
--

DROP TABLE IF EXISTS `ocena`;
CREATE TABLE IF NOT EXISTS `ocena` (
  `SifO` int NOT NULL AUTO_INCREMENT,
  `Ocena` int NOT NULL,
  `Komentar` varchar(20) DEFAULT NULL,
  `SifPriv` int NOT NULL,
  `SifK` int NOT NULL,
  PRIMARY KEY (`SifO`),
  KEY `R_30` (`SifPriv`),
  KEY `R_31` (`SifK`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ocena`
--

INSERT INTO `ocena` (`SifO`, `Ocena`, `Komentar`, `SifPriv`, `SifK`) VALUES
(1, 5, 'Super si!', 3, 12);

-- --------------------------------------------------------

--
-- Table structure for table `poklon`
--

DROP TABLE IF EXISTS `poklon`;
CREATE TABLE IF NOT EXISTS `poklon` (
  `SifPokl` int NOT NULL AUTO_INCREMENT,
  `Iznos` decimal(10,2) NOT NULL,
  `TipPoklona` varchar(20) NOT NULL,
  PRIMARY KEY (`SifPokl`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `poklon`
--

INSERT INTO `poklon` (`SifPokl`, `Iznos`, `TipPoklona`) VALUES
(1, '10.00', '%'),
(2, '5.00', '%'),
(3, '8.00', '%'),
(4, '40.00', '€'),
(5, '20.00', '%'),
(6, '20.00', '€'),
(7, '15.00', '€');

-- --------------------------------------------------------

--
-- Table structure for table `ponuda`
--

DROP TABLE IF EXISTS `ponuda`;
CREATE TABLE IF NOT EXISTS `ponuda` (
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
  KEY `R_26_idx` (`SifK`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ponuda`
--

INSERT INTO `ponuda` (`SifP`, `BrMesta`, `DatumOd`, `DatumDo`, `VremeOd`, `VremeDo`, `CenaKarte`, `SifMesDo`, `SifMesOd`, `SifSred`, `SifK`, `Slika`, `SifPriv`) VALUES
(3, 5, '2023-06-14', '2023-06-18', '22:22:00', '19:00:00', '0.00', 0, 14, 2, 2, '', 0),
(4, 5, '2023-06-14', '2023-06-18', '22:22:00', '19:00:00', '0.00', 0, 14, 2, 2, '', 0),
(5, 5, '2023-06-14', '2023-06-18', '22:22:00', '19:00:00', '0.00', 0, 14, 2, 2, '', 0),
(31, 1, '2023-06-14', '2023-06-30', '22:22:00', '14:00:00', '10.00', 0, 14, 2, 3, '31_20230605185505_beograd-na-vodi.jpg', 0),
(32, 10, '2023-06-20', '2023-06-20', '08:00:00', '22:00:00', '20.00', 2, 0, 3, 3, '32_20230605184310_novi sad.webp', 0),
(33, 1, '2023-06-27', '2023-06-28', '23:50:00', '04:00:00', '30.00', 7, 6, 1, 3, '33_20230605184423_smederevo-2.jpg', 0),
(35, 1, '2023-06-30', '2023-07-01', '08:00:00', '01:00:00', '100.00', 10, 9, 1, 3, '35_20230605184702_barselona-kategorija.jpg', 0),
(36, 1, '2023-07-09', '2023-06-26', '23:00:00', '20:00:00', '0.00', 3, 8, 2, 12, '', 3),
(37, 1, '2023-07-09', '2023-06-26', '23:00:00', '20:00:00', '0.00', 3, 8, 2, 12, '', 4),
(38, 1, '2023-07-09', '2023-06-26', '23:00:00', '20:00:00', '0.00', 3, 8, 2, 12, '', 5),
(39, 1, '2023-07-09', '2023-07-10', '23:00:00', '01:00:00', '20.00', 3, 8, 2, 3, '39_20230605185926_jagodina.jpg', 0),
(40, 7, '2023-07-06', '2023-06-27', '06:00:00', '04:00:00', '0.00', 5, 2, 3, 12, '', 3),
(41, 7, '2023-07-06', '2023-06-27', '06:00:00', '04:00:00', '0.00', 5, 2, 3, 12, '', 4),
(42, 7, '2023-07-06', '2023-06-27', '06:00:00', '04:00:00', '0.00', 5, 2, 3, 12, '', 5),
(43, 6, '2023-06-07', '2023-06-10', '23:11:00', '00:11:00', '0.00', 0, 2, 1, 12, '', 3),
(44, 6, '2023-06-07', '2023-06-10', '23:11:00', '00:11:00', '0.00', 0, 2, 1, 12, '', 4),
(45, 6, '2023-06-07', '2023-06-10', '23:11:00', '00:11:00', '0.00', 0, 2, 1, 12, '', 5),
(46, 2, '2023-06-07', '2023-07-10', '23:11:00', '00:11:00', '100.00', 0, 2, 1, 3, '46_20230605191246_beograd-na-vodi.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `poruka`
--

DROP TABLE IF EXISTS `poruka`;
CREATE TABLE IF NOT EXISTS `poruka` (
  `SifPonuda` int NOT NULL,
  `SifKor` int NOT NULL,
  `SifPriv` int NOT NULL,
  `SifPor` int NOT NULL AUTO_INCREMENT,
  `SmerPoruke` int NOT NULL,
  PRIMARY KEY (`SifPor`),
  KEY `R_13` (`SifPonuda`),
  KEY `R_16` (`SifKor`),
  KEY `R_17` (`SifPriv`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `poruka`
--

INSERT INTO `poruka` (`SifPonuda`, `SifKor`, `SifPriv`, `SifPor`, `SmerPoruke`) VALUES
(4, 2, 4, 15, 1),
(5, 2, 5, 16, 1),
(31, 2, 3, 17, 2),
(37, 12, 4, 19, 1),
(38, 12, 5, 20, 1),
(40, 12, 3, 22, 1),
(41, 12, 4, 23, 1),
(42, 12, 5, 24, 1),
(44, 12, 4, 26, 1),
(45, 12, 5, 27, 1);

-- --------------------------------------------------------

--
-- Table structure for table `postavljenaponuda`
--

DROP TABLE IF EXISTS `postavljenaponuda`;
CREATE TABLE IF NOT EXISTS `postavljenaponuda` (
  `SifP` int NOT NULL,
  `RokZaOtkazivanje` int NOT NULL,
  PRIMARY KEY (`SifP`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `postavljenaponuda`
--

INSERT INTO `postavljenaponuda` (`SifP`, `RokZaOtkazivanje`) VALUES
(32, 10),
(33, 3),
(35, 4);

-- --------------------------------------------------------

--
-- Table structure for table `pretplata`
--

DROP TABLE IF EXISTS `pretplata`;
CREATE TABLE IF NOT EXISTS `pretplata` (
  `SifPret` int NOT NULL AUTO_INCREMENT,
  `Naziv` varchar(20) NOT NULL,
  `Iznos` decimal(10,2) NOT NULL,
  PRIMARY KEY (`SifPret`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pretplata`
--

INSERT INTO `pretplata` (`SifPret`, `Naziv`, `Iznos`) VALUES
(1, 'Standard', '9.99'),
(2, 'Premium', '29.99');

-- --------------------------------------------------------

--
-- Table structure for table `prevoznosredstvo`
--

DROP TABLE IF EXISTS `prevoznosredstvo`;
CREATE TABLE IF NOT EXISTS `prevoznosredstvo` (
  `SifSred` int NOT NULL AUTO_INCREMENT,
  `Naziv` varchar(20) NOT NULL,
  PRIMARY KEY (`SifSred`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `prevoznosredstvo`
--

INSERT INTO `prevoznosredstvo` (`SifSred`, `Naziv`) VALUES
(1, 'Automobil'),
(2, 'Autobus'),
(3, 'Brod');

-- --------------------------------------------------------

--
-- Table structure for table `privatnik`
--

DROP TABLE IF EXISTS `privatnik`;
CREATE TABLE IF NOT EXISTS `privatnik` (
  `SifK` int NOT NULL,
  `SifPret` int NOT NULL,
  PRIMARY KEY (`SifK`),
  KEY `R_5` (`SifPret`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `privatnik`
--

INSERT INTO `privatnik` (`SifK`, `SifPret`) VALUES
(3, 1),
(4, 1),
(5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

DROP TABLE IF EXISTS `report`;
CREATE TABLE IF NOT EXISTS `report` (
  `Razlog` varchar(20) NOT NULL,
  `SifPrijavio` int NOT NULL,
  `SifRep` int NOT NULL AUTO_INCREMENT,
  `SifPrijavljen` int NOT NULL,
  PRIMARY KEY (`SifRep`),
  KEY `R_28` (`SifPrijavljen`),
  KEY `f_32_idx` (`SifPrijavio`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`Razlog`, `SifPrijavio`, `SifRep`, `SifPrijavljen`) VALUES
('Nedolicno ponasanje.', 2, 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `rezervacija`
--

DROP TABLE IF EXISTS `rezervacija`;
CREATE TABLE IF NOT EXISTS `rezervacija` (
  `SifK` int NOT NULL,
  `SifP` int NOT NULL,
  `BrMesta` int NOT NULL,
  `SifR` int NOT NULL AUTO_INCREMENT,
  `DatumRezervacije` datetime NOT NULL,
  PRIMARY KEY (`SifR`),
  KEY `R_18` (`SifK`),
  KEY `R_19` (`SifP`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `rezervacija`
--

INSERT INTO `rezervacija` (`SifK`, `SifP`, `BrMesta`, `SifR`, `DatumRezervacije`) VALUES
(12, 31, 4, 10, '2023-06-05 19:55:50');

-- --------------------------------------------------------

--
-- Table structure for table `uplata`
--

DROP TABLE IF EXISTS `uplata`;
CREATE TABLE IF NOT EXISTS `uplata` (
  `SifU` int NOT NULL AUTO_INCREMENT,
  `DatumUplate` datetime NOT NULL,
  `Iznos` decimal(10,2) NOT NULL,
  `SifKar` int NOT NULL,
  PRIMARY KEY (`SifU`),
  KEY `R_23` (`SifKar`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vanrednaponuda`
--

DROP TABLE IF EXISTS `vanrednaponuda`;
CREATE TABLE IF NOT EXISTS `vanrednaponuda` (
  `SifP` int NOT NULL,
  `RokZaOtkazivanje` int NOT NULL,
  PRIMARY KEY (`SifP`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `vanrednaponuda`
--

INSERT INTO `vanrednaponuda` (`SifP`, `RokZaOtkazivanje`) VALUES
(31, 3),
(39, 3),
(46, 1);

-- --------------------------------------------------------

--
-- Table structure for table `zahtevponuda`
--

DROP TABLE IF EXISTS `zahtevponuda`;
CREATE TABLE IF NOT EXISTS `zahtevponuda` (
  `SifP` int NOT NULL,
  `CenaOd` decimal(10,2) NOT NULL,
  `CenaDo` decimal(10,2) NOT NULL,
  PRIMARY KEY (`SifP`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `zahtevponuda`
--

INSERT INTO `zahtevponuda` (`SifP`, `CenaOd`, `CenaDo`) VALUES
(3, '0.00', '200.00'),
(4, '0.00', '200.00'),
(5, '0.00', '200.00'),
(36, '15.00', '25.00'),
(37, '15.00', '25.00'),
(38, '15.00', '25.00'),
(40, '200.00', '400.00'),
(41, '200.00', '400.00'),
(42, '200.00', '400.00'),
(43, '200.00', '400.00'),
(44, '200.00', '400.00'),
(45, '200.00', '400.00');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `fk_14` FOREIGN KEY (`SifK`) REFERENCES `korisnik` (`SifK`);

--
-- Constraints for table `jedobio`
--
ALTER TABLE `jedobio`
  ADD CONSTRAINT `FK_Pokl` FOREIGN KEY (`SifPokl`) REFERENCES `poklon` (`SifPokl`),
  ADD CONSTRAINT `FK_SifK` FOREIGN KEY (`SifK`) REFERENCES `obicankorisnik` (`SifK`);

--
-- Constraints for table `kupljenakarta`
--
ALTER TABLE `kupljenakarta`
  ADD CONSTRAINT `R_24` FOREIGN KEY (`SifP`) REFERENCES `ponuda` (`SifP`),
  ADD CONSTRAINT `R_25` FOREIGN KEY (`SifK`) REFERENCES `obicankorisnik` (`SifK`);

--
-- Constraints for table `obicankorisnik`
--
ALTER TABLE `obicankorisnik`
  ADD CONSTRAINT `R_3` FOREIGN KEY (`SifK`) REFERENCES `korisnik` (`SifK`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ocena`
--
ALTER TABLE `ocena`
  ADD CONSTRAINT `R_30` FOREIGN KEY (`SifPriv`) REFERENCES `privatnik` (`SifK`),
  ADD CONSTRAINT `R_31` FOREIGN KEY (`SifK`) REFERENCES `obicankorisnik` (`SifK`);

--
-- Constraints for table `ponuda`
--
ALTER TABLE `ponuda`
  ADD CONSTRAINT `R_10` FOREIGN KEY (`SifMesDo`) REFERENCES `mesto` (`SifM`),
  ADD CONSTRAINT `R_11` FOREIGN KEY (`SifMesOd`) REFERENCES `mesto` (`SifM`),
  ADD CONSTRAINT `R_12` FOREIGN KEY (`SifSred`) REFERENCES `prevoznosredstvo` (`SifSred`),
  ADD CONSTRAINT `R_26` FOREIGN KEY (`SifK`) REFERENCES `korisnik` (`SifK`);

--
-- Constraints for table `poruka`
--
ALTER TABLE `poruka`
  ADD CONSTRAINT `R_13` FOREIGN KEY (`SifPonuda`) REFERENCES `ponuda` (`SifP`),
  ADD CONSTRAINT `R_16` FOREIGN KEY (`SifKor`) REFERENCES `obicankorisnik` (`SifK`),
  ADD CONSTRAINT `R_17` FOREIGN KEY (`SifPriv`) REFERENCES `privatnik` (`SifK`);

--
-- Constraints for table `postavljenaponuda`
--
ALTER TABLE `postavljenaponuda`
  ADD CONSTRAINT `R_8` FOREIGN KEY (`SifP`) REFERENCES `ponuda` (`SifP`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `privatnik`
--
ALTER TABLE `privatnik`
  ADD CONSTRAINT `R_4` FOREIGN KEY (`SifK`) REFERENCES `korisnik` (`SifK`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `R_5` FOREIGN KEY (`SifPret`) REFERENCES `pretplata` (`SifPret`);

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `f_31` FOREIGN KEY (`SifPrijavljen`) REFERENCES `privatnik` (`SifK`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `f_32` FOREIGN KEY (`SifPrijavio`) REFERENCES `obicankorisnik` (`SifK`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rezervacija`
--
ALTER TABLE `rezervacija`
  ADD CONSTRAINT `R_18` FOREIGN KEY (`SifK`) REFERENCES `obicankorisnik` (`SifK`),
  ADD CONSTRAINT `R_19` FOREIGN KEY (`SifP`) REFERENCES `ponuda` (`SifP`);

--
-- Constraints for table `uplata`
--
ALTER TABLE `uplata`
  ADD CONSTRAINT `R_23` FOREIGN KEY (`SifKar`) REFERENCES `kupljenakarta` (`SifKar`);

--
-- Constraints for table `vanrednaponuda`
--
ALTER TABLE `vanrednaponuda`
  ADD CONSTRAINT `R_9` FOREIGN KEY (`SifP`) REFERENCES `ponuda` (`SifP`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `zahtevponuda`
--
ALTER TABLE `zahtevponuda`
  ADD CONSTRAINT `R_7` FOREIGN KEY (`SifP`) REFERENCES `ponuda` (`SifP`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
