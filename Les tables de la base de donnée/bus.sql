-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 01 Juillet 2020 à 00:48
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

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `bus`
--
ALTER TABLE `bus`
  ADD CONSTRAINT `bus_ibfk_1` FOREIGN KEY (`Id_chauffeur`) REFERENCES `chauffeur` (`Id_chauffeur`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
