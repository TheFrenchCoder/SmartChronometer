-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  sam. 15 juin 2019 à 18:29
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `dbchrono`
--
CREATE DATABASE IF NOT EXISTS `dbchrono` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `dbchrono`;

-- --------------------------------------------------------

--
-- Structure de la table `competitors`
--

CREATE TABLE IF NOT EXISTS `competitors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` int(11) NOT NULL,
  `name` varchar(255) NOT NULL COMMENT 'nom',
  `firstname` varchar(255) NOT NULL COMMENT 'prenom',
  `categorie_name` varchar(255) NOT NULL,
  `categorie_number` varchar(255) NOT NULL COMMENT '1;2;etc',
  `sex` tinyint(1) NOT NULL COMMENT '0=fille, 1=garcon',
  `club_abrev` varchar(255) NOT NULL COMMENT 'Abrev du nom du club',
  `IsOnStart` tinyint(1) DEFAULT NULL COMMENT 'vrai si il est au depart',
  `IsOnRun` tinyint(1) DEFAULT NULL COMMENT 'vrai si il est en course',
  `IsFinish` tinyint(1) DEFAULT NULL COMMENT 'vrai si il a fini',
  `IsHere` tinyint(1) DEFAULT NULL COMMENT '0=abs, 1=présent',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `competitors`
--

INSERT INTO `competitors` (`id`, `number`, `name`, `firstname`, `categorie_name`, `categorie_number`, `sex`, `club_abrev`, `IsOnStart`, `IsOnRun`, `IsFinish`, `IsHere`) VALUES
(19, 875, 'Balafre', 'Gabriel', 'Junior', '5', 1, 'CKS', 1, 0, 0, 1),
(18, 52, 'Rio', 'Gabin', 'Cadet', '4', 1, 'NCKC', 0, 0, 1, 1),
(17, 99, 'Ferrier', 'Gabriella', 'Cadet', '4', 0, 'NCKC', 1, 0, 0, 1),
(16, 55, 'Louvigny', 'Raphael', 'Cadet', '4', 1, 'NCKC', 0, 0, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `penalty`
--

CREATE TABLE IF NOT EXISTS `penalty` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary key of penalties',
  `gate_number` int(11) NOT NULL COMMENT 'Number of the gate in question',
  `competitor_number` int(11) NOT NULL COMMENT 'Number of the competitor in question',
  `penalty_amount` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'Which user gave the penalty',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Table containing the penalties of the competition as well as';

--
-- Déclencheurs `penalty`
--
DELIMITER $$
CREATE TRIGGER `Update - sum(penality) by competitor` AFTER UPDATE ON `penalty` FOR EACH ROW UPDATE race1, penalty SET race1.penalty = SUM(penalty.penalty_amount) WHERE race1.number = penalty.competitor_number && race1.number = NEW.competitor_number
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `race1`
--

CREATE TABLE IF NOT EXISTS `race1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` int(11) NOT NULL,
  `start_time` double DEFAULT NULL,
  `finish_time` double NOT NULL,
  `penalty` double NOT NULL,
  `result_time` double NOT NULL,
  `test` double GENERATED ALWAYS AS (((`finish_time` - `start_time`) + `penalty`)) STORED,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `race1`
--

INSERT INTO `race1` (`id`, `number`, `start_time`, `finish_time`, `penalty`, `result_time`) VALUES
(1, 1, 1555780611.0988, 1555780625.4752, 0, 14.376399993896484),
(2, 66, 1555780659.2253, 1555780822.1863, 0, 162.96099996566772),
(3, 875, 1555780882.3812, 1555780894.6619, 50, 12.280699968338013),
(4, 55, 1557833051.8524, 1558190734.6501, 0, 357682.7976999283),
(6, 52, 1557940624.8551, 1558190726.4784, 0, 250101.62330007553);

--
-- Déclencheurs `race1`
--
DELIMITER $$
CREATE TRIGGER `Insert result_time` BEFORE INSERT ON `race1` FOR EACH ROW SET NEW.result_time = NEW.finish_time - NEW.start_time
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Update result_time` BEFORE UPDATE ON `race1` FOR EACH ROW SET NEW.result_time = NEW.finish_time - NEW.start_time
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(11) NOT NULL COMMENT 'role',
  `username` varchar(11) NOT NULL COMMENT 'user',
  `password` varchar(11) NOT NULL,
  `IsConnected` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='Permet de référencer les identifiants sur les rôles';

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `role`, `username`, `password`, `IsConnected`) VALUES
(4, 'Start', 'start', 'azer', 0),
(2, 'Admin', 'admin', 'azer', 0),
(5, 'Finish', 'finish', 'azer', 0),
(6, 'Judge', 'judge', 'azer', 0),
(7, 'Admin', 'azer', 'azer', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
