-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 01 Juillet 2020 à 00:47
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `transport`
--

-- --------------------------------------------------------

--
-- Structure de la table `bus`
--

CREATE TABLE IF NOT EXISTS `bus` (
  `Id_bus` int(11) NOT NULL AUTO_INCREMENT,
  `ville_depart` varchar(30) DEFAULT NULL,
  `ville_arrivee` varchar(30) DEFAULT NULL,
  `heure_depart` time DEFAULT NULL,
  `heure_arrivee` time DEFAULT NULL,
  `Id_chauffeur` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_bus`),
  KEY `Id_chauffeur` (`Id_chauffeur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `bus`
--

INSERT INTO `bus` (`Id_bus`, `ville_depart`, `ville_arrivee`, `heure_depart`, `heure_arrivee`, `Id_chauffeur`) VALUES
(1, 'Cotonou', 'Parakou', '07:00:00', '13:00:00', 1),
(2, 'Porto-Novo', 'Natitingou', '06:00:00', '13:00:00', 2),
(3, 'Ouidah', 'Lokossa', '16:00:00', '19:00:00', 3),
(4, 'Cotonou', 'Ilacondji', '17:00:00', '20:00:00', 4),
(5, 'Cotonou', 'Bohicon', '10:00:00', '15:00:00', 5);

-- --------------------------------------------------------

--
-- Structure de la table `chauffeur`
--

CREATE TABLE IF NOT EXISTS `chauffeur` (
  `Id_chauffeur` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) DEFAULT NULL,
  `prenom` varchar(30) DEFAULT NULL,
  `contact` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`Id_chauffeur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `chauffeur`
--

INSERT INTO `chauffeur` (`Id_chauffeur`, `nom`, `prenom`, `contact`) VALUES
(1, 'OGAH', 'Grâce', '97002325'),
(2, 'EYE', 'Gb. Achille', '21784550'),
(3, 'GOHOUI', 'Dirranaud', '96587421'),
(4, 'MEDEHOUNKOU', 'Euphrasie', '98745621'),
(5, 'LALI', 'Patterson', '91475821');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `Id_client` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) DEFAULT NULL,
  `prenom` varchar(30) DEFAULT NULL,
  `contact` varchar(30) DEFAULT NULL,
  `ville_actuelle` varchar(30) DEFAULT NULL,
  `num_identite` varchar(30) DEFAULT NULL,
  `num_paye` varchar(30) DEFAULT NULL,
  `ville_destination` varchar(30) DEFAULT NULL,
  `nombre_reservation` int(11) DEFAULT NULL,
  `Id_bus` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_client`),
  KEY `Id_bus` (`Id_bus`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `directeur`
--

CREATE TABLE IF NOT EXISTS `directeur` (
  `Id_directeur` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) DEFAULT NULL,
  `prenom` varchar(30) DEFAULT NULL,
  `mot_passe` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`Id_directeur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1112 ;

--
-- Contenu de la table `directeur`
--

INSERT INTO `directeur` (`Id_directeur`, `nom`, `prenom`, `mot_passe`) VALUES
(1111, 'GANDONOU', 'Johanu', '5555');

-- --------------------------------------------------------

--
-- Structure de la table `permission`
--

CREATE TABLE IF NOT EXISTS `permission` (
  `Id_permission` int(11) NOT NULL AUTO_INCREMENT,
  `date_permission` date DEFAULT NULL,
  `motif` text,
  `Id_personnel` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_permission`),
  KEY `Id_personnel` (`Id_personnel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `personnel`
--

CREATE TABLE IF NOT EXISTS `personnel` (
  `Id_personnel` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) DEFAULT NULL,
  `prenom` varchar(30) DEFAULT NULL,
  `contact` varchar(30) DEFAULT NULL,
  `fonction` varchar(30) DEFAULT NULL,
  `salaire` decimal(10,0) DEFAULT NULL,
  `mot_passe` varchar(30) DEFAULT NULL,
  `Id_directeur` int(11) DEFAULT NULL,
  `Id_secretaire` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_personnel`),
  KEY `Id_directeur` (`Id_directeur`),
  KEY `Id_secretaire` (`Id_secretaire`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `presence`
--

CREATE TABLE IF NOT EXISTS `presence` (
  `date_presence` date DEFAULT NULL,
  `presence` char(1) DEFAULT NULL,
  `Id_personnel` int(11) DEFAULT NULL,
  KEY `Id_personnel` (`Id_personnel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE IF NOT EXISTS `reservation` (
  `Id_reservation` int(11) NOT NULL AUTO_INCREMENT,
  `date_reservation` date DEFAULT NULL,
  `nombre_place` int(11) DEFAULT NULL,
  `Id_client` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id_reservation`),
  KEY `Id_client` (`Id_client`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `sanction`
--

CREATE TABLE IF NOT EXISTS `sanction` (
  `type` varchar(30) DEFAULT NULL,
  `date_sanction` date DEFAULT NULL,
  `motif` text,
  `Id_personnel` int(11) DEFAULT NULL,
  KEY `Id_personnel` (`Id_personnel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `secretaire`
--

CREATE TABLE IF NOT EXISTS `secretaire` (
  `Id_secretaire` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) DEFAULT NULL,
  `prenom` varchar(30) DEFAULT NULL,
  `mot_passe` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`Id_secretaire`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2223 ;

--
-- Contenu de la table `secretaire`
--

INSERT INTO `secretaire` (`Id_secretaire`, `nom`, `prenom`, `mot_passe`) VALUES
(2222, 'ASSOCLE', 'Bernice', '1234');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `bus`
--
ALTER TABLE `bus`
  ADD CONSTRAINT `bus_ibfk_1` FOREIGN KEY (`Id_chauffeur`) REFERENCES `chauffeur` (`Id_chauffeur`);

--
-- Contraintes pour la table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `client_ibfk_1` FOREIGN KEY (`Id_bus`) REFERENCES `bus` (`Id_bus`);

--
-- Contraintes pour la table `permission`
--
ALTER TABLE `permission`
  ADD CONSTRAINT `permission_ibfk_1` FOREIGN KEY (`Id_personnel`) REFERENCES `personnel` (`Id_personnel`);

--
-- Contraintes pour la table `personnel`
--
ALTER TABLE `personnel`
  ADD CONSTRAINT `personnel_ibfk_1` FOREIGN KEY (`Id_directeur`) REFERENCES `directeur` (`Id_directeur`),
  ADD CONSTRAINT `personnel_ibfk_2` FOREIGN KEY (`Id_secretaire`) REFERENCES `secretaire` (`Id_secretaire`);

--
-- Contraintes pour la table `presence`
--
ALTER TABLE `presence`
  ADD CONSTRAINT `presence_ibfk_1` FOREIGN KEY (`Id_personnel`) REFERENCES `personnel` (`Id_personnel`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`Id_client`) REFERENCES `client` (`Id_client`);

--
-- Contraintes pour la table `sanction`
--
ALTER TABLE `sanction`
  ADD CONSTRAINT `sanction_ibfk_1` FOREIGN KEY (`Id_personnel`) REFERENCES `personnel` (`Id_personnel`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
