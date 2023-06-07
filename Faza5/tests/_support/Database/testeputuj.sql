
CREATE DATABASE IF NOT EXISTS `eputujTest` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `eputujTest`;


DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `SifK` int NOT NULL,
  PRIMARY KEY (`SifK`)
);

DROP TABLE IF EXISTS `jedobio`;
CREATE TABLE IF NOT EXISTS `jedobio` (
  `SifK` int NOT NULL,
  `SifPokl` int NOT NULL,
  `JeDobioPK` int NOT NULL AUTO_INCREMENT,
  `Datum` datetime NOT NULL,
  PRIMARY KEY (`JeDobioPK`),
  KEY `fk_jedobio_sifpokl` (`SifPokl`),
  KEY `FK_SifK_idx` (`SifK`)
);

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
);

DROP TABLE IF EXISTS `kupljenakarta`;
CREATE TABLE IF NOT EXISTS `kupljenakarta` (
  `SifKar` int NOT NULL AUTO_INCREMENT,
  `NacinPlacanja` decimal(10,2) NOT NULL,
  `SifP` int NOT NULL,
  `SifK` int NOT NULL,
  PRIMARY KEY (`SifKar`),
  KEY `R_24` (`SifP`),
  KEY `R_25` (`SifK`)
);


DROP TABLE IF EXISTS `mesto`;
CREATE TABLE IF NOT EXISTS `mesto` (
  `SifM` int NOT NULL AUTO_INCREMENT,
  `Naziv` varchar(20) NOT NULL,
  PRIMARY KEY (`SifM`)
);

DROP TABLE IF EXISTS `obicankorisnik`;
CREATE TABLE IF NOT EXISTS `obicankorisnik` (
  `SifK` int NOT NULL,
  `token` int NOT NULL,
  PRIMARY KEY (`SifK`)
);

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
);

DROP TABLE IF EXISTS `poklon`;
CREATE TABLE IF NOT EXISTS `poklon` (
  `SifPokl` int NOT NULL AUTO_INCREMENT,
  `Iznos` decimal(10,2) NOT NULL,
  `TipPoklona` varchar(20) NOT NULL,
  PRIMARY KEY (`SifPokl`)
);

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
);


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
);


DROP TABLE IF EXISTS `postavljenaponuda`;
CREATE TABLE IF NOT EXISTS `postavljenaponuda` (
  `SifP` int NOT NULL,
  `RokZaOtkazivanje` int NOT NULL,
  PRIMARY KEY (`SifP`)
);

DROP TABLE IF EXISTS `pretplata`;
CREATE TABLE IF NOT EXISTS `pretplata` (
  `SifPret` int NOT NULL AUTO_INCREMENT,
  `Naziv` varchar(20) NOT NULL,
  `Iznos` decimal(10,2) NOT NULL,
  PRIMARY KEY (`SifPret`)
);

DROP TABLE IF EXISTS `prevoznosredstvo`;
CREATE TABLE IF NOT EXISTS `prevoznosredstvo` (
  `SifSred` int NOT NULL AUTO_INCREMENT,
  `Naziv` varchar(20) NOT NULL,
  PRIMARY KEY (`SifSred`)
);

DROP TABLE IF EXISTS `privatnik`;
CREATE TABLE IF NOT EXISTS `privatnik` (
  `SifK` int NOT NULL,
  `SifPret` int NOT NULL,
  PRIMARY KEY (`SifK`),
  KEY `R_5` (`SifPret`)
);


DROP TABLE IF EXISTS `report`;
CREATE TABLE IF NOT EXISTS `report` (
  `Razlog` varchar(20) NOT NULL,
  `SifPrijavio` int NOT NULL,
  `SifRep` int NOT NULL AUTO_INCREMENT,
  `SifPrijavljen` int NOT NULL,
  PRIMARY KEY (`SifRep`),
  KEY `R_28` (`SifPrijavljen`),
  KEY `f_32_idx` (`SifPrijavio`)
);

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
);

DROP TABLE IF EXISTS `uplata`;
CREATE TABLE IF NOT EXISTS `uplata` (
  `SifU` int NOT NULL AUTO_INCREMENT,
  `DatumUplate` datetime NOT NULL,
  `Iznos` decimal(10,2) NOT NULL,
  `SifKar` int NOT NULL,
  PRIMARY KEY (`SifU`),
  KEY `R_23` (`SifKar`)
);

DROP TABLE IF EXISTS `vanrednaponuda`;
CREATE TABLE IF NOT EXISTS `vanrednaponuda` (
  `SifP` int NOT NULL,
  `RokZaOtkazivanje` int NOT NULL,
  PRIMARY KEY (`SifP`)
);

DROP TABLE IF EXISTS `zahtevponuda`;
CREATE TABLE IF NOT EXISTS `zahtevponuda` (
  `SifP` int NOT NULL,
  `CenaOd` decimal(10,2) NOT NULL,
  `CenaDo` decimal(10,2) NOT NULL,
  PRIMARY KEY (`SifP`)
);

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
