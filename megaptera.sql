-- --------------------------------------------------------
-- Hôte :                        localhost
-- Version du serveur:           10.5.4-MariaDB-log - mariadb.org binary distribution
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
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Listage des données de la table megaptera.dominante : ~3 rows (environ)
DELETE FROM `dominante`;
/*!40000 ALTER TABLE `dominante` DISABLE KEYS */;
INSERT INTO `dominante` (`id`, `libelle`) VALUES
	(2, 'BLANC'),
	(3, 'ROUGE'),
	(4, 'PAS DE COULEUR DOMINANTE');
/*!40000 ALTER TABLE `dominante` ENABLE KEYS */;

-- Listage de la structure de la table megaptera. etatobservation
CREATE TABLE IF NOT EXISTS `etatobservation` (
  `etat` varchar(2) NOT NULL,
  `libelle` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`etat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table megaptera.etatobservation : ~3 rows (environ)
DELETE FROM `etatobservation`;
/*!40000 ALTER TABLE `etatobservation` DISABLE KEYS */;
INSERT INTO `etatobservation` (`etat`, `libelle`) VALUES
	('AR', 'Archivé'),
	('RF', 'Refusé'),
	('TR', 'En cours de traitement'),
	('VA', 'Validé');
/*!40000 ALTER TABLE `etatobservation` ENABLE KEYS */;

-- Listage de la structure de la table megaptera. lieu
CREATE TABLE IF NOT EXISTS `lieu` (
  `code` varchar(3) NOT NULL,
  `lieu` varchar(13) DEFAULT NULL,
  `orientationLat` char(1) NOT NULL COMMENT 'position debut GPS',
  `orientationLong` char(1) NOT NULL COMMENT 'position Fin GPS',
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Listage des données de la table megaptera.lieu : ~6 rows (environ)
DELETE FROM `lieu`;
/*!40000 ALTER TABLE `lieu` DISABLE KEYS */;
INSERT INTO `lieu` (`code`, `lieu`, `orientationLat`, `orientationLong`) VALUES
	('AUT', 'Autre ', '', ''),
	('COM', 'Comores', 'N', 'E'),
	('GRC', 'Grande Comore', 'S', 'E'),
	('MAY', 'Mayotte', 'N', 'O'),
	('MOH', 'Moheli', 'N', 'O'),
	('REU', 'Reunion', 'S', 'O');
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
DELETE FROM `matching`;
/*!40000 ALTER TABLE `matching` DISABLE KEYS */;
INSERT INTO `matching` (`codeObservation`, `codeObservation_avec`, `DateDetection`, `id`) VALUES
	('MAY20211', 'MOH20211', '2021-03-03', 5);
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
  `poste` varchar(25) NOT NULL DEFAULT 'Membre',
  `token` longtext DEFAULT NULL,
  `derniereConnexion` datetime DEFAULT NULL,
  `dateInscription` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `poste` (`poste`),
  CONSTRAINT `FK_membre_poste` FOREIGN KEY (`poste`) REFERENCES `poste` (`nom`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table megaptera.membre : ~2 rows (environ)
DELETE FROM `membre`;
/*!40000 ALTER TABLE `membre` DISABLE KEYS */;
INSERT INTO `membre` (`id`, `nom`, `prenom`, `login`, `mdp`, `tel`, `mail`, `poste`, `token`, `derniereConnexion`, `dateInscription`) VALUES
	(3, 'Coelembier', 'Xavier', 'Xavier', 'Xavier1234', '0987654321', 'xavier.coelembier@gmail.com', 'Admin', NULL, '2021-02-27 18:29:12', '0000-00-00 00:00:00'),
	(17, 'toto', 'titi', 'tito', '12345', '0607080904', 'jridon@neuf.fr', 'superAdmin', NULL, '2021-02-27 18:29:12', '0000-00-00 00:00:00'),
	(22, 'Ben', 'Ali', 'aben', '875bc510', '0613038610', 'benmerad.ali@gmail.com', 'Membre', NULL, NULL, '2021-03-05 18:23:12');
/*!40000 ALTER TABLE `membre` ENABLE KEYS */;

-- Listage de la structure de la table megaptera. observation
CREATE TABLE IF NOT EXISTS `observation` (
  `codeObservation` varchar(12) NOT NULL COMMENT 'XXXAAAA999',
  `nomPhoto` longtext NOT NULL DEFAULT '' COMMENT 'XXXAAAA999.jpg',
  `lieuObservation` varchar(3) NOT NULL COMMENT 'clé étrangère de lieu',
  `autreLieu` varchar(100) DEFAULT NULL,
  `heureDebutObservation` time NOT NULL,
  `heureFinObservation` time NOT NULL,
  `dateObservation` date NOT NULL,
  `latitude` tinytext DEFAULT NULL COMMENT 'latitude N/S',
  `longitude` tinytext DEFAULT NULL COMMENT 'longitude  W/E',
  `auteurObservation` int(11) NOT NULL COMMENT 'cle etrangère personne loguée',
  `dominante` int(2) NOT NULL COMMENT 'type_couleur -clè étrangère',
  `papillon` tinytext NOT NULL DEFAULT '',
  `nbIndividus` int(4) NOT NULL,
  `typeCaudale` int(1) NOT NULL,
  `typeGroupeObserve` varchar(50) NOT NULL DEFAULT '' COMMENT 'cle etrangere de groupe',
  `commentaire` varchar(500) DEFAULT NULL,
  `comportement` varchar(500) DEFAULT NULL,
  `dateEnregistrement` datetime NOT NULL COMMENT 'par l''admin ou le memembre date du jour',
  `dateMAJ` datetime DEFAULT NULL COMMENT 'date de mise à jour',
  `dateDeValidite` date DEFAULT NULL COMMENT 'Admis par le super_admin',
  `numAdministrateur` int(11) unsigned zerofill DEFAULT NULL COMMENT 'clé etrangère personne qui à valider l''observation',
  `etatObservation` varchar(2) NOT NULL DEFAULT 'TR' COMMENT 'état de l''observation',
  PRIMARY KEY (`codeObservation`),
  UNIQUE KEY `codePhoto` (`codeObservation`),
  KEY `lieuObservation` (`lieuObservation`),
  KEY `dominante` (`dominante`),
  KEY `typeGroupeObserve` (`typeGroupeObserve`),
  KEY `etatObservation_ibfk_1` (`etatObservation`),
  CONSTRAINT `etatObservation_ibfk_1` FOREIGN KEY (`etatObservation`) REFERENCES `etatobservation` (`etat`),
  CONSTRAINT `observation_ibfk_1` FOREIGN KEY (`dominante`) REFERENCES `dominante` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table megaptera.observation : ~3 rows (environ)
DELETE FROM `observation`;
/*!40000 ALTER TABLE `observation` DISABLE KEYS */;
INSERT INTO `observation` (`codeObservation`, `nomPhoto`, `lieuObservation`, `autreLieu`, `heureDebutObservation`, `heureFinObservation`, `dateObservation`, `latitude`, `longitude`, `auteurObservation`, `dominante`, `papillon`, `nbIndividus`, `typeCaudale`, `typeGroupeObserve`, `commentaire`, `comportement`, `dateEnregistrement`, `dateMAJ`, `dateDeValidite`, `numAdministrateur`, `etatObservation`) VALUES
	('MAY20211', 'images/MAY/MAY20211.jpeg', 'MAY', 'Autre', '14:34:00', '16:34:00', '2021-03-01', 'N 0°0\'0"', 'O 0°0\'0"', 17, 3, 'Non', 18, 4, 'GI', 'TEST', 'tesTEST', '2021-03-06 13:35:09', '2021-03-06 13:35:09', '2021-03-06', NULL, 'VA'),
	('REU20211', 'images/REU/REU20211.jpeg', 'REU', 'Autre test ', '13:37:00', '16:37:00', '2021-03-01', 'S 0°0\'0"', 'O 0°0\'0"', 17, 3, 'Non', 12, 4, 'MB', 'sqddf', 'dsfsdsfd', '2021-03-06 13:38:41', '2021-03-06 13:38:41', '2021-03-06', NULL, 'VA'),
	('REU20212', 'images/REU/REU20212.jpeg', 'REU', 'Autre test ', '13:37:00', '16:37:00', '2021-03-01', 'S 0°0\'0"', 'O 0°0\'0"', 17, 3, 'Non', 12, 4, 'MB', 'sqddf', 'dsfsdsfd', '2021-03-06 13:39:26', '2021-03-06 13:39:26', '2021-03-06', NULL, 'VA');
/*!40000 ALTER TABLE `observation` ENABLE KEYS */;

-- Listage de la structure de la table megaptera. poste
CREATE TABLE IF NOT EXISTS `poste` (
  `nom` varchar(25) NOT NULL,
  PRIMARY KEY (`nom`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Liste des postes des utilisateurs du site';

-- Listage des données de la table megaptera.poste : ~3 rows (environ)
DELETE FROM `poste`;
/*!40000 ALTER TABLE `poste` DISABLE KEYS */;
INSERT INTO `poste` (`nom`) VALUES
	('Admin'),
	('Membre'),
	('superAdmin');
/*!40000 ALTER TABLE `poste` ENABLE KEYS */;

-- Listage de la structure de la table megaptera. typegroupe
CREATE TABLE IF NOT EXISTS `typegroupe` (
  `code` varchar(3) NOT NULL,
  `libelle` varchar(50) NOT NULL,
  `operateur` char(1) NOT NULL,
  `valeur` int(1) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table megaptera.typegroupe : ~5 rows (environ)
DELETE FROM `typegroupe`;
/*!40000 ALTER TABLE `typegroupe` DISABLE KEYS */;
INSERT INTO `typegroupe` (`code`, `libelle`, `operateur`, `valeur`) VALUES
	('GC', 'Groupe Compétitif', '%', 1),
	('GI', 'Groupe Immature', '>', 1),
	('MB', 'Mère Baleineau', '%', 2),
	('S', 'Solitaire', '=', 1);
/*!40000 ALTER TABLE `typegroupe` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
