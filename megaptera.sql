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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Listage des données de la table megaptera.dominante : ~3 rows (environ)
/*!40000 ALTER TABLE `dominante` DISABLE KEYS */;
REPLACE INTO `dominante` (`id`, `libelle`) VALUES
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
/*!40000 ALTER TABLE `etatobservation` DISABLE KEYS */;
REPLACE INTO `etatobservation` (`etat`, `libelle`) VALUES
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
/*!40000 ALTER TABLE `lieu` DISABLE KEYS */;
REPLACE INTO `lieu` (`code`, `lieu`, `orientationLat`, `orientationLong`) VALUES
	('AUT', 'Autre ', '', ''),
	('COM', 'Comores', 'N', 'E'),
	('GRC', 'Grande Comore', 'S', 'E'),
	('MAY', 'Mayotte', 'N', 'O'),
	('MOH', 'Moheli', 'N', 'O'),
	('REU', 'Réunion', 'S', 'O');
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
  `poste` varchar(25) NOT NULL DEFAULT 'membre',
  `token` longtext DEFAULT NULL,
  `derniereConnexion` datetime DEFAULT NULL,
  `dateInscription` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;

-- Listage des données de la table megaptera.membre : ~4 rows (environ)
/*!40000 ALTER TABLE `membre` DISABLE KEYS */;
REPLACE INTO `membre` (`id`, `nom`, `prenom`, `login`, `mdp`, `tel`, `mail`, `poste`, `token`, `derniereConnexion`, `dateInscription`) VALUES
	(3, 'Coelembier', 'Xavier', 'Xavier', 'Xavier1234', '0987654321', 'xavier.coelembier@gmail.com', 'Admin', NULL, '2021-02-27 18:29:12', '0000-00-00 00:00:00'),
	(4, 'Membre', 'Normal', 'Membre1234', 'membre12', '021584962', 'Membre.megaptera@gmail.com', 'Membre', NULL, '2021-02-27 18:29:12', '0000-00-00 00:00:00'),
	(17, 'toto', 'titi', 'tito', '12345', '0607080904', 'jridon@neuf.fr', 'superAdmin', NULL, '2021-02-27 18:29:12', '0000-00-00 00:00:00'),
	(21, 'gghghg', 'dddgd', 'gdgfgsg', '5efcd60a', '0613038610', 'dfsdfsd@ddfsfd.fr', 'Membre', NULL, NULL, '2021-02-28 22:20:59');
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

-- Listage des données de la table megaptera.observation : ~20 rows (environ)
/*!40000 ALTER TABLE `observation` DISABLE KEYS */;
REPLACE INTO `observation` (`codeObservation`, `nomPhoto`, `lieuObservation`, `autreLieu`, `heureDebutObservation`, `heureFinObservation`, `dateObservation`, `latitude`, `longitude`, `auteurObservation`, `dominante`, `papillon`, `nbIndividus`, `typeCaudale`, `typeGroupeObserve`, `commentaire`, `comportement`, `dateEnregistrement`, `dateMAJ`, `dateDeValidite`, `numAdministrateur`, `etatObservation`) VALUES
	('', '', 'REU', 'ddsfsdfdf', '00:06:00', '02:06:00', '2021-02-01', 'S 0°0\'0"', 'O 0°0\'0"', 4, 4, 'Oui', 10, 4, 'MB', '', '', '2021-02-22 21:08:25', '2021-02-22 21:08:25', NULL, NULL, 'TR'),
	('AUT20211', 'AUT20211_0.jpeg', 'AUT', 'dsdsfdfsdsf', '17:07:00', '21:07:00', '2021-02-03', 'S 0°0\'0"', 'E 0°0\'0"', 4, 3, 'Non', 11, 3, 'GI', 'fdsdfdf', 'dssdffsd', '2021-02-17 15:08:04', '2021-02-17 15:08:04', '2021-02-22', NULL, 'VA'),
	('COM20211', 'COM20211_0.jpeg;COM20211_1.jpeg;COM20211_2.jpeg;COM20211_3.jpeg', 'COM', '', '14:14:00', '15:14:00', '2021-01-12', 'E 0°0\'0"', 'S 0°0\'0"', 4, 3, 'Non', 6, 4, 'GI', 'Massiré t mort', '', '2021-01-28 11:14:57', '2021-01-28 11:14:57', '2021-02-22', NULL, 'VA'),
	('GRC20211', 'GRC20211_0.jpeg;GRC20211_1.jpeg;GRC20211_2.jpeg;GRC20211_3.jpeg', 'GRC', '', '04:39:00', '06:39:00', '2021-01-20', 'E 0°0\'0"', 'S 0°0\'0"', 4, 2, 'Oui', 18, 3, 'GC', '', '', '2021-01-28 01:39:36', '2021-01-28 01:39:36', '2021-01-28', NULL, 'VA'),
	('GRC20212', 'GRC20212_0.jpeg;GRC20212_1.jpeg;GRC20212_2.jpeg;GRC20212_3.jpeg;GRC20212_4.jpeg;GRC20212_5.jpeg;GRC20212_6.jpeg;GRC20212_7.jpeg;GRC20212_8.jpeg', 'GRC', '', '04:53:00', '04:53:00', '2021-01-12', 'E 0°0\'0"', 'S 0°0\'0"', 4, 2, 'Non', 19, 3, 'GC', '', '', '2021-01-28 01:56:25', '2021-01-28 01:56:25', '2021-01-28', NULL, 'VA'),
	('GRC20213', 'GRC20213_0.jpeg;GRC20213_1.jpeg;GRC20213_2.jpeg;GRC20213_3.jpeg', 'GRC', '', '04:56:00', '07:56:00', '2021-01-13', 'E 0°0\'0"', 'S 0°0\'0"', 4, 2, 'Non', 17, 3, 'GI', '', '', '2021-01-28 01:56:57', '2021-01-28 01:56:57', '2021-01-28', NULL, 'VA'),
	('GRC20214', 'GRC20214_0.jpeg;GRC20214_1.jpeg;GRC20214_2.jpeg;GRC20214_3.jpeg', 'GRC', '', '04:56:00', '07:56:00', '2021-01-13', 'E 0°0\'0"', 'S 0°0\'0"', 4, 2, 'Non', 17, 3, 'GI', '', '', '2021-01-28 01:57:23', '2021-01-28 01:57:23', '2021-01-28', NULL, 'VA'),
	('GRC20215', 'GRC20215_0.jpeg;GRC20215_1.jpeg;GRC20215_2.jpeg;GRC20215_3.jpeg', 'GRC', '', '04:56:00', '07:56:00', '2021-01-13', 'E 0°0\'0"', 'S 0°0\'0"', 4, 2, 'Non', 17, 3, 'GI', '', '', '2021-01-28 02:02:44', '2021-01-28 02:02:44', '2021-01-28', NULL, 'VA'),
	('GRC20216', 'GRC20216_0.jpeg', 'GRC', '', '15:44:00', '18:44:00', '2021-02-17', 'S 0°0\'0"', 'E 0°0\'0"', 4, 2, 'Oui', 17, 3, 'GC', 'fddgdfgdfg', 'sdfsdfdfdfsqdf', '2021-02-17 14:45:02', '2021-02-17 14:45:02', '2021-02-22', NULL, 'VA'),
	('GRC20217', 'GRC20217_0.jpeg', 'GRC', '', '23:38:00', '23:42:00', '2021-02-02', 'S 20°20\'20"', 'E 25°20\'51"', 4, 3, 'Non', 15, 3, 'GI', '', '', '2021-02-22 20:38:41', '2021-02-22 20:38:41', NULL, NULL, 'TR'),
	('MAY20211', 'MAY20211_0.jpeg;MAY20211_1.jpeg;MAY20211_2.jpeg;MAY20211_3.jpeg', 'MAY', '', '14:36:00', '17:36:00', '2021-01-26', 'O 0°0\'0"', 'N 0°0\'0"', 4, 3, 'Oui', 18, 3, 'GC', '', '', '2021-01-28 11:37:00', '2021-01-28 11:37:00', '2021-02-01', NULL, 'VA'),
	('MAY20212', 'MAY20212_0.jpeg;MAY20212_1.jpeg;MAY20212_2.jpeg', 'MAY', '', '14:15:00', '15:15:00', '2021-02-01', 'O 0°0\'0"', 'N 0°0\'0"', 4, 3, 'Non', 12, 3, 'MB', 'Groupe de baleines qui allaient à toutes allures ', '', '2021-02-05 12:16:50', '2021-02-05 12:16:50', '2021-02-05', NULL, 'VA'),
	('MOH20211', 'MOH20211_0.jpeg;MOH20211_1.jpeg;MOH20211_2.jpeg', 'MOH', '', '04:48:00', '06:48:00', '2021-01-05', 'O 0°0\'0"', 'N 0°0\'0"', 4, 2, 'Non', 17, 3, 'GC', '', '', '2021-01-28 01:48:39', '2021-01-28 01:48:39', '2021-01-28', NULL, 'VA'),
	('MOH20212', 'MOH20212_0.jpeg;MOH20212_1.jpeg;MOH20212_2.jpeg', 'MOH', '', '14:30:00', '15:30:00', '2021-01-05', 'O 0°0\'0"', 'N 0°0\'0"', 4, 3, 'Non', 17, 3, 'GI', 'Attroupement de jeunes baleines', '', '2021-02-01 12:31:22', '2021-02-01 12:31:22', '2021-02-22', NULL, 'VA'),
	('MOH20213', 'MOH20213_0.jpeg;MOH20213_1.jpeg;MOH20213_2.jpeg;MOH20213_3.jpeg', 'MOH', '', '12:45:00', '14:45:00', '2021-02-01', 'O 0°0\'0"', 'N 0°0\'0"', 4, 2, 'Oui', 12, 3, 'MB', '<b> Essai </b>', '', '2021-02-02 11:45:51', '2021-02-02 11:45:51', '2021-02-05', NULL, 'VA'),
	('MOH20214', 'MOH20214_0.jpeg;MOH20214_1.jpeg;MOH20214_2.jpeg;MOH20214_3.jpeg', 'MOH', '', '15:09:00', '18:09:00', '2021-02-01', 'O 0°0\'0"', 'N 0°0\'0"', 4, 4, 'Oui', 17, 3, 'GI', '&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;&eacute;', '', '2021-02-02 13:09:32', '2021-02-02 13:09:32', NULL, NULL, 'TR'),
	('MOH20215', 'MOH202150.jpeg', 'MOH', 'Je ne connais pas le lieu', '00:39:00', '00:43:00', '2021-02-09', 'N 0°0\'0"', 'O 0°0\'0"', 4, 2, 'Non', 8, 4, 'MB', '', '', '2021-02-22 20:39:26', '2021-02-22 20:39:26', '2021-02-24', NULL, 'VA'),
	('REU20211', 'REU20211_0.jpeg;REU20211_1.jpeg;REU20211_2.jpeg;REU20211_3.jpeg', 'REU', '', '14:48:00', '15:48:00', '2021-02-01', 'O 0°0\'0"', 'S 0°0\'0"', 4, 2, 'Oui', 12, 3, 'GI', '<h1> TEST </h1>', '', '2021-02-02 11:49:32', '2021-02-02 11:49:32', '2021-02-05', NULL, 'VA'),
	('SM20211', 'SM20211_0.jpeg;SM20211_1.jpeg;SM20211_2.jpeg', 'SM', '', '13:41:00', '15:41:00', '2021-01-28', 'E 0°0\'0"', 'S 0°0\'0"', 4, 2, 'Oui', 12, 3, 'MB', '', '', '2021-01-28 11:43:02', '2021-01-28 11:43:02', '2021-01-28', NULL, 'VA'),
	('SM20212', 'SM20212_0.jpeg;SM20212_1.jpeg;SM20212_2.jpeg', 'SM', '', '14:48:00', '15:48:00', '2021-02-01', 'E 0°0\'0"', 'S 0°0\'0"', 4, 2, 'Oui', 12, 3, 'GI', '<h1> TEST </h1> <b> sALUT </b>', '', '2021-02-02 12:49:42', '2021-02-02 12:49:42', '2021-02-05', NULL, 'VA'),
	('SM20213', 'SM20213_0.jpeg;SM20213_1.jpeg;SM20213_2.jpeg;SM20213_3.jpeg;SM20213_4.jpeg;SM20213_5.jpeg;SM20213_6.jpeg;SM20213_7.jpeg;SM20213_8.jpeg;SM20213_9.jpeg;SM20213_10.jpeg;SM20213_11.jpeg;SM20213_12.jpeg;SM20213_13.jpeg;SM20213_14.jpeg;SM20213_15.jpeg;SM20213_16.jpeg;SM20213_17.jpeg;SM20213_18.jpeg;SM20213_19.jpeg', 'SM', '', '14:48:00', '15:48:00', '2021-02-01', 'E 0°0\'0"', 'S 0°0\'0"', 4, 2, 'Oui', 12, 3, 'GI', '&lt;h1&gt; TEST &lt;/h1&gt; &lt;b&gt; sALUT &lt;/b&gt;', '', '2021-02-02 12:59:42', '2021-02-02 12:59:42', '2021-02-05', NULL, 'VA');
/*!40000 ALTER TABLE `observation` ENABLE KEYS */;

-- Listage de la structure de la table megaptera. typegroupe
CREATE TABLE IF NOT EXISTS `typegroupe` (
  `code` varchar(3) NOT NULL,
  `libelle` varchar(50) NOT NULL,
  `operateur` char(1) NOT NULL,
  `valeur` int(1) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Listage des données de la table megaptera.typegroupe : ~4 rows (environ)
/*!40000 ALTER TABLE `typegroupe` DISABLE KEYS */;
REPLACE INTO `typegroupe` (`code`, `libelle`, `operateur`, `valeur`) VALUES
	('GC', 'Groupe Compétitif', '%', 1),
	('GI', 'Groupe Immature', '>', 1),
	('MB', 'Mère Baleineau', '%', 2),
	('S', 'Solitaire', '=', 1);
/*!40000 ALTER TABLE `typegroupe` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
