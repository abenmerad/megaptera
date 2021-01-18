-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 20 Août 2020 à 13:01
-- Version du serveur :  5.6.29
-- Version de PHP :  7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `megaptera`
--

-- --------------------------------------------------------

--
-- Structure de la table `dominante`
--

CREATE TABLE IF NOT EXISTS `dominante` (
  `id` int(2) NOT NULL,
  `libelle` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `dominante`
--

INSERT INTO `dominante` (`id`, `libelle`) VALUES
(1, 'Noir'),
(2, 'Blanc'),
(3, 'Pas de couleur dominante'),
(6, 'ROUGE');

-- --------------------------------------------------------

--
-- Structure de la table `lieu`
--

CREATE TABLE IF NOT EXISTS `lieu` (
  `code` varchar(3) NOT NULL,
  `lieu` varchar(50) DEFAULT NULL,
  `orientationLat` char(1) NOT NULL COMMENT 'position debut GPS',
  `orientationLong` char(1) NOT NULL COMMENT 'position Fin GPS',
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `lieu`
--

INSERT INTO `lieu` (`code`, `lieu`, `orientationLat`, `orientationLong`) VALUES
('AUT', 'Autre ', '', ''),
('COM', 'Comores', 'S', 'E'),
('GRC', 'Grande Comore', 'S', 'E'),
('MAY', 'Mayotte', 'S', 'E'),
('MOH', 'Moheli', 'S', 'E'),
('REU', 'Réunion', 'S', 'E'),
('SM', 'Sainte Marie', 'S', 'E');

-- --------------------------------------------------------

--
-- Structure de la table `matching`
--

CREATE TABLE IF NOT EXISTS `matching` (
  `codeObservation` varchar(12) NOT NULL,
  `codeObservation_avec` varchar(12) NOT NULL,
  `DateDetection` date NOT NULL,
  `id` int(11) NOT NULL,
  PRIMARY KEY (`codeObservation`,`codeObservation_avec`),
  KEY `codeObservation` (`codeObservation`),
  KEY `codeObservation_avec` (`codeObservation_avec`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=19 ;

--
-- Contenu de la table `membre`
--

INSERT INTO `membre` (`id`, `nom`, `prenom`, `login`, `mdp`, `tel`, `mail`, `poste`) VALUES
(1, 'Chadli', 'Adel', 'adel', 'Alegerie.213', '0783030259', 'adel.chadli.sio@gmail.com', 'superAdmin'),
(2, 'Laouedj', 'Farouk', 'farouk', 'farouk1234', '0695498093', 'f.laouedj.sio@gmail.com', 'superAdmin'),
(3, 'Coelembier', 'Xavier', 'Xavier', 'Xavier1234', '0987654321', 'xavier.coelembier@gmail.com', 'admin'),
(4, 'Membre', 'Normal', 'Membre1234', 'membre12', '021584962', 'Membre.megaptera@gmail.com', 'membre'),
(5, 'toto', 'rrrrrrrrrrrrrrr', 'toto', 'toto', '0606060608', 'jridon@neuf.fr', 'admin'),
(14, 'ffffffffffffff', 'Francois', 'toto', 'titi', '0671782930', 'tr@neuf.fr', 'Admin'),
(16, 'GAUTIER', 'Ghania', 'hh', 'tt', '0607080904', 'gg@neuf.fr', 'membre'),
(17, 'toto', 'titi', 'tito', '12345', '0607080904', 'jridon@neuf.fr', 'superAdmin');

-- --------------------------------------------------------

--
-- Structure de la table `observation`
--

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
  PRIMARY KEY (`codeObservation`),
  UNIQUE KEY `codePhoto` (`codeObservation`),
  KEY `lieuObservation` (`lieuObservation`),
  KEY `dominante` (`dominante`),
  KEY `typeGroupeObserve` (`typeGroupeObserve`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `observation`
--

INSERT INTO `observation` (`codeObservation`, `nomPhoto`, `lieuObservation`, `autreLieu`, `heureDebutObservation`, `heureFinObservation`, `dateObservation`, `latitude`, `longitude`, `auteurObservation`, `dominante`, `papillon`, `nbIndividus`, `typeCaudale`, `typeGroupeObserve`, `commentaire`, `comportement`, `dateEnregistrement`, `dateMAJ`, `dateDeValidite`, `numAdministrateur`) VALUES
('AUT20201', 'AUT20201.jpeg', 'AUT', 'ESPAGNE N E', '14:00', '15:00', '2020-08-11', '10°11"12', '13°14"15', 4, 2, 'Vrai', 19, 4, 'GC', '', '', '2020-08-18', NULL, NULL, NULL),
('AUT20202', 'AUT20202.jpeg', 'AUT', 'protugal ne', '16:00', '17:00', '2020-08-04', '12°13"14', '15°16"17', 2, 2, 'Vrai', 18, 2, 'A', 'yyyyyyyyyyyyyyyyyyyyyyyy', 'yyzzzzzzzzzzzzzzzzzzz', '2020-08-20', NULL, NULL, NULL),
('AUT20203', 'AUT20203.jpeg', 'AUT', 'protugal ne', '16:00', '17:00', '2020-08-04', '12°13"14', '15°16"17', 2, 2, 'Vrai', 18, 2, 'A', 'yyyyyyyyyyyyyyyyyyyyyyyy', 'yyzzzzzzzzzzzzzzzzzzz', '2020-08-20', NULL, NULL, NULL),
('GRC20201', 'GRC20201.jpeg', 'GRC', '', '14:11', '15:11', '2020-07-28', '10°15"20', '10°15"20', 4, 1, 'Vrai', 6, 2, 'GC', '', '', '2020-08-18', NULL, '2020-08-09', NULL),
('GRC20202', 'GRC20202.jpeg', 'GRC', '', '14:00', '15:00', '2020-08-04', '14°15"16', '17°18"19', 16, 2, 'Vrai', 17, 2, 'GC', 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx', 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx', '2020-08-20', NULL, NULL, NULL),
('REU20201', 'REU20201.jpeg', 'REU', '', '16:00', '17:00', '2020-08-04', '11°12"13', '14°15"16', 2, 2, 'Faux', 15, 2, 'GC', 'aaaaaaaaaaaaaaaaaa', 'bbbbbbbbbbbbbbbbbbbbb', '2020-08-20', NULL, NULL, NULL),
('REU20202', 'REU20202.jpeg', 'REU', '', '14:00', '15:00', '2020-08-04', '11°12"13', '14°15"16', 2, 3, 'Faux', 17, 3, 'GC', 'aaaaaaaaaaaaaaaaaaaaaaaaaaa', 'bbbbbbbbbbbbbbbbbbbbbb', '2020-08-20', NULL, NULL, NULL),
('REU20203', 'REU20203.jpeg', 'REU', '', '15:00', '16:00', '2020-08-03', '11°15"17', '18°19"20', 2, 3, 'Vrai', 12, 2, 'MBE', 'qqqqqqqqqqqqqqqqqqqqq', 'qqfffffffffffffffffffffffff', '2020-08-20', NULL, '2020-08-03', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `typegroupe`
--

CREATE TABLE IF NOT EXISTS `typegroupe` (
  `code` varchar(3) NOT NULL,
  `libelle` varchar(50) NOT NULL,
  `operateur` char(1) NOT NULL,
  `valeur` int(1) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `typegroupe`
--

INSERT INTO `typegroupe` (`code`, `libelle`, `operateur`, `valeur`) VALUES
('A', 'Autres', '>', 1),
('GC', 'Groupe Compétitif', '>', 1),
('GI', 'Groupe Immature', '>', 1),
('MB', 'Mère Baleineau', '%', 2),
('MBE', 'Mère Baleineau Escort', '%', 3),
('S', 'Solitaire', '=', 1);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `observation`
--
ALTER TABLE `observation`
  ADD CONSTRAINT `observation_ibfk_1` FOREIGN KEY (`dominante`) REFERENCES `dominante` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
