-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 30 Avril 2020 à 16:16
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
(3, 'Pas de couleur dominante');

-- --------------------------------------------------------

--
-- Structure de la table `lieu`
--

CREATE TABLE IF NOT EXISTS `lieu` (
  `code` varchar(3) NOT NULL,
  `lieu` varchar(13) DEFAULT NULL,
  `orientationLat` char(1) NOT NULL COMMENT 'position debut GPS',
  `orientationLong` char(1) NOT NULL COMMENT 'position Fin GPS',
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `lieu`
--

INSERT INTO `lieu` (`code`, `lieu`, `orientationLat`, `orientationLong`) VALUES
('COM', 'Comores', 'N', 'E'),
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `membre`
--

INSERT INTO `membre` (`id`, `nom`, `prenom`, `login`, `mdp`, `tel`, `mail`, `poste`) VALUES
(1, 'Chadli', 'Adel', 'adel', 'Alegerie.213', '0783030259', 'adel.chadli.sio@gmail.com', 'superAdmin'),
(2, 'Laouedj', 'Farouk', 'farouk', 'farouk1234', '0695498093', 'f.laouedj.sio@gmail.com', 'superAdmin'),
(3, 'Coelembier', 'Xavier', 'Xavier', 'Xavier1234', '0987654321', 'xavier.coelembier@gmail.com', 'admin'),
(4, 'Membre', 'Normal', 'Membre1234', 'membre12', '021584962', 'Membre.megaptera@gmail.com', 'membre'),
(5, 'toto', '', 'toto', 'toto', NULL, NULL, 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `observation`
--

CREATE TABLE IF NOT EXISTS `observation` (
  `codeObservation` varchar(12) NOT NULL COMMENT 'XXXAAAA999',
  `nomPhoto` varchar(20) NOT NULL COMMENT 'XXXAAAA999.jpg',
  `lieuObservation` varchar(3) NOT NULL COMMENT 'clé étrangère de lieu',
  `autreLieu` varchar(100) NOT NULL,
  `heureDebutObservation` int(4) NOT NULL,
  `heureFinObservation` int(4) NOT NULL,
  `dateObservation` date NOT NULL,
  `latitude` int(7) NOT NULL COMMENT 'latitude N/S',
  `longitude` int(7) NOT NULL COMMENT 'longitude  W/E',
  `auteurObservation` int(11) NOT NULL COMMENT 'cle etrangère personne loguée',
  `dominante` int(2) NOT NULL COMMENT 'type_couleur -clè étrangère',
  `papillon` tinyint(1) NOT NULL,
  `nbIndividus` int(4) NOT NULL,
  `typeCaudale` int(1) NOT NULL,
  `typeGroupeObserve` int(2) NOT NULL COMMENT 'cle etrangere de groupe',
  `commentaire` varchar(500) NOT NULL,
  `comportement` varchar(500) NOT NULL,
  `dateEnregistrement` date NOT NULL COMMENT 'par l''admin ou le memembre date du jour',
  `dateMAJ` date DEFAULT NULL COMMENT 'date de mise à jour',
  `dateDeValidite` date DEFAULT NULL COMMENT 'Admis par le super_admin',
  `numAdministrateur` int(11) NOT NULL COMMENT 'clé etrangère personne qui à valider l''observation',
  PRIMARY KEY (`codeObservation`),
  UNIQUE KEY `codePhoto` (`codeObservation`),
  KEY `lieuObservation` (`lieuObservation`),
  KEY `dominante` (`dominante`),
  KEY `typeGroupeObserve` (`typeGroupeObserve`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
INSERT INTO `observation`(`dominante`) VALUES (1)