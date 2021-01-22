-- --------------------------------------------------------
-- Hôte :                        localhost
-- Version du serveur:           10.4.8-MariaDB-log - mariadb.org binary distribution
-- SE du serveur:                Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Listage de la structure de la base pour megaptera
CREATE DATABASE IF NOT EXISTS `megaptera` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `megaptera`;

-- Listage de la structure de la table megaptera. dominante
CREATE TABLE IF NOT EXISTS `dominante` (
  `id` int(2) NOT NULL,
  `libelle` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table megaptera.dominante : ~4 rows (environ)
/*!40000 ALTER TABLE `dominante` DISABLE KEYS */;
REPLACE INTO `dominante` (`id`, `libelle`) VALUES
	(1, 'Noir'),
	(2, 'Blanc'),
	(3, 'Pas de couleur dominante'),
	(6, 'ROUGE');
/*!40000 ALTER TABLE `dominante` ENABLE KEYS */;

-- Listage de la structure de la table megaptera. etatobservation
CREATE TABLE IF NOT EXISTS `etatobservation` (
  `etat` varchar(2) NOT NULL,
  `libelle` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`etat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table megaptera.etatobservation : ~2 rows (environ)
/*!40000 ALTER TABLE `etatobservation` DISABLE KEYS */;
REPLACE INTO `etatobservation` (`etat`, `libelle`) VALUES
	('TR', 'En cours de traitement'),
	('VA', 'Validée');
/*!40000 ALTER TABLE `etatobservation` ENABLE KEYS */;

-- Listage de la structure de la table megaptera. lieu
CREATE TABLE IF NOT EXISTS `lieu` (
  `code` varchar(3) NOT NULL,
  `lieu` varchar(50) DEFAULT NULL,
  `orientationLat` char(1) NOT NULL COMMENT 'position debut GPS',
  `orientationLong` char(1) NOT NULL COMMENT 'position Fin GPS',
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Listage des données de la table megaptera.lieu : ~7 rows (environ)
/*!40000 ALTER TABLE `lieu` DISABLE KEYS */;
REPLACE INTO `lieu` (`code`, `lieu`, `orientationLat`, `orientationLong`) VALUES
	('AUT', 'Autre ', '', ''),
	('COM', 'Comores', 'S', 'E'),
	('GRC', 'Grande Comore', 'S', 'E'),
	('MAY', 'Mayotte', 'S', 'E'),
	('MOH', 'Moheli', 'S', 'E'),
	('REU', 'Réunion', 'S', 'E'),
	('SM', 'Sainte Marie', 'S', 'E');
/*!40000 ALTER TABLE `lieu` ENABLE KEYS */;

-- Listage de la structure de la table megaptera. matching
CREATE TABLE IF NOT EXISTS `matching` (
  `codeObservation` varchar(12) NOT NULL,
  `codeObservation_avec` varchar(12) NOT NULL,
  `DateDetection` date NOT NULL,
  `id` int(11) NOT NULL,
  PRIMARY KEY (`codeObservation`,`codeObservation_avec`),
  KEY `codeObservation` (`codeObservation`),
  KEY `codeObservation_avec` (`codeObservation_avec`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table megaptera.matching : ~0 rows (environ)
/*!40000 ALTER TABLE `matching` DISABLE KEYS */;
/*!40000 ALTER TABLE `matching` ENABLE KEYS */;

-- Listage de la structure de la table megaptera. membre
CREATE TABLE IF NOT EXISTS `membre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `login` varchar(20) NOT NULL,
  `mdp` varchar(20) NOT NULL,
  `tel` varchar(10) DEFAULT NULL,
  `mail` varchar(70) DEFAULT NULL,
  `poste` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table megaptera.membre : ~8 rows (environ)
/*!40000 ALTER TABLE `membre` DISABLE KEYS */;
REPLACE INTO `membre` (`id`, `nom`, `prenom`, `login`, `mdp`, `tel`, `mail`, `poste`) VALUES
	(1, 'Chadli', 'Adel', 'adel', 'Alegerie.213', '0783030259', 'adel.chadli.sio@gmail.com', 'superAdmin'),
	(2, 'Laouedj', 'Farouk', 'farouk', 'farouk1234', '0695498093', 'f.laouedj.sio@gmail.com', 'superAdmin'),
	(3, 'Coelembier', 'Xavier', 'Xavier', 'Xavier1234', '0987654321', 'xavier.coelembier@gmail.com', 'admin'),
	(4, 'Membre', 'Normal', 'Membre1234', 'membre12', '021584962', 'Membre.megaptera@gmail.com', 'membre'),
	(5, 'toto', 'rrrrrrrrrrrrrrr', 'toto', 'toto', '0606060608', 'jridon@neuf.fr', 'admin'),
	(14, 'ffffffffffffff', 'Francois', 'toto', 'titi', '0671782930', 'tr@neuf.fr', 'Admin'),
	(16, 'GAUTIER', 'Ghania', 'hh', 'tt', '0607080904', 'gg@neuf.fr', 'membre'),
	(17, 'toto', 'titi', 'tito', '12345', '0607080904', 'jridon@neuf.fr', 'superAdmin');
/*!40000 ALTER TABLE `membre` ENABLE KEYS */;

-- Listage de la structure de la table megaptera. observation
CREATE TABLE IF NOT EXISTS `observation` (
  `codeObservation` varchar(12) NOT NULL COMMENT 'XXXAAAA999',
  `nomPhoto` varchar(20) NOT NULL COMMENT 'XXXAAAA999.jpg',
  `lieuObservation` varchar(3) DEFAULT NULL COMMENT 'clé étrangère de lieu',
  `autreLieu` varchar(100) NOT NULL,
  `heureDebutObservation` varchar(5) NOT NULL,
  `heureFinObservation` varchar(5) NOT NULL,
  `dateObservation` date NOT NULL,
  `latitude` varchar(15) NOT NULL COMMENT 'latitude N/S',
  `longitude` varchar(15) NOT NULL COMMENT 'longitude  W/E',
  `auteurObservation` int(11) NOT NULL COMMENT 'cle etrangère personne loguée',
  `dominante` int(2) NOT NULL COMMENT 'type_couleur -clè étrangère',
  `papillon` varchar(4) NOT NULL,
  `nbIndividus` int(4) NOT NULL,
  `typeCaudale` int(1) NOT NULL,
  `typeGroupeObserve` varchar(3) NOT NULL,
  `commentaire` varchar(500) DEFAULT NULL,
  `comportement` varchar(500) DEFAULT NULL,
  `dateEnregistrement` date NOT NULL COMMENT 'par l''admin ou le memembre date du jour',
  `dateMAJ` date DEFAULT NULL COMMENT 'date de mise à jour',
  `dateDeValidite` date DEFAULT NULL COMMENT 'Admis par le super_admin',
  `numAdministrateur` int(11) DEFAULT NULL COMMENT 'clé etrangère personne qui à valider l''observation',
  `etatObservation` varchar(2) DEFAULT 'TR' COMMENT 'etat de l''observation',
  PRIMARY KEY (`codeObservation`),
  UNIQUE KEY `codePhoto` (`codeObservation`),
  KEY `lieuObservation` (`lieuObservation`),
  KEY `dominante` (`dominante`),
  KEY `typeGroupeObserve` (`typeGroupeObserve`),
  KEY `etat_observation_fk1` (`etatObservation`),
  CONSTRAINT `etat_observation_fk1` FOREIGN KEY (`etatObservation`) REFERENCES `etatobservation` (`etat`),
  CONSTRAINT `observation_ibfk_1` FOREIGN KEY (`dominante`) REFERENCES `dominante` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table megaptera.observation : ~8 rows (environ)
/*!40000 ALTER TABLE `observation` DISABLE KEYS */;
REPLACE INTO `observation` (`codeObservation`, `nomPhoto`, `lieuObservation`, `autreLieu`, `heureDebutObservation`, `heureFinObservation`, `dateObservation`, `latitude`, `longitude`, `auteurObservation`, `dominante`, `papillon`, `nbIndividus`, `typeCaudale`, `typeGroupeObserve`, `commentaire`, `comportement`, `dateEnregistrement`, `dateMAJ`, `dateDeValidite`, `numAdministrateur`, `etatObservation`) VALUES
	('AUT20201', 'AUT20201.jpeg', 'AUT', 'ESPAGNE N E', '14:00', '15:00', '2020-08-11', '10°11"12', '13°14"15', 4, 2, 'Vrai', 19, 4, 'GC', '', '', '2020-08-18', NULL, NULL, NULL, 'TR'),
	('AUT20202', 'AUT20202.jpeg', 'AUT', 'protugal ne', '16:00', '17:00', '2020-08-04', '12°13"14', '15°16"17', 2, 2, 'Vrai', 18, 2, 'A', 'yyyyyyyyyyyyyyyyyyyyyyyy', 'yyzzzzzzzzzzzzzzzzzzz', '2020-08-20', NULL, NULL, NULL, 'TR'),
	('AUT20203', 'AUT20203.jpeg', 'AUT', 'protugal ne', '16:00', '17:00', '2020-08-04', '12°13"14', '15°16"17', 2, 2, 'Vrai', 18, 2, 'A', 'yyyyyyyyyyyyyyyyyyyyyyyy', 'yyzzzzzzzzzzzzzzzzzzz', '2020-08-20', NULL, NULL, NULL, NULL),
	('GRC20201', 'GRC20201.jpeg', 'GRC', '', '14:11', '15:11', '2020-07-28', '10°15"20', '10°15"20', 4, 1, 'Vrai', 6, 2, 'GC', '', '', '2020-08-18', NULL, '2020-08-09', NULL, NULL),
	('GRC20202', 'GRC20202.jpeg', 'GRC', '', '14:00', '15:00', '2020-08-04', '14°15"16', '17°18"19', 16, 2, 'Vrai', 17, 2, 'GC', 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx', 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx', '2020-08-20', NULL, NULL, NULL, NULL),
	('REU20201', 'REU20201.jpeg', 'REU', '', '16:00', '17:00', '2020-08-04', '11°12"13', '14°15"16', 2, 2, 'Faux', 15, 2, 'GC', 'aaaaaaaaaaaaaaaaaa', 'bbbbbbbbbbbbbbbbbbbbb', '2020-08-20', NULL, NULL, NULL, NULL),
	('REU20202', 'REU20202.jpeg', 'REU', '', '14:00', '15:00', '2020-08-04', '11°12"13', '14°15"16', 2, 3, 'Faux', 17, 3, 'GC', 'aaaaaaaaaaaaaaaaaaaaaaaaaaa', 'bbbbbbbbbbbbbbbbbbbbbb', '2020-08-20', NULL, NULL, NULL, NULL),
	('REU20203', 'REU20203.jpeg', 'REU', '', '15:00', '16:00', '2020-08-03', '11°15"17', '18°19"20', 2, 3, 'Vrai', 12, 2, 'MBE', 'qqqqqqqqqqqqqqqqqqqqq', 'qqfffffffffffffffffffffffff', '2020-08-20', NULL, '2020-08-03', NULL, NULL);
/*!40000 ALTER TABLE `observation` ENABLE KEYS */;

-- Listage de la structure de la table megaptera. typegroupe
CREATE TABLE IF NOT EXISTS `typegroupe` (
  `code` varchar(3) NOT NULL,
  `libelle` varchar(50) NOT NULL,
  `operateur` char(1) NOT NULL,
  `valeur` int(1) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table megaptera.typegroupe : ~6 rows (environ)
/*!40000 ALTER TABLE `typegroupe` DISABLE KEYS */;
REPLACE INTO `typegroupe` (`code`, `libelle`, `operateur`, `valeur`) VALUES
	('A', 'Autres', '>', 1),
	('GC', 'Groupe Compétitif', '>', 1),
	('GI', 'Groupe Immature', '>', 1),
	('MB', 'Mère Baleineau', '%', 2),
	('MBE', 'Mère Baleineau Escort', '%', 3),
	('S', 'Solitaire', '=', 1);
/*!40000 ALTER TABLE `typegroupe` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;