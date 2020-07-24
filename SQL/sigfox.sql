-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u6
-- http://www.phpmyadmin.net
--
-- Client :  195.221.61.190
-- Généré le :  Mar 21 Juillet 2020 à 10:41
-- Version du serveur :  10.3.22-MariaDB-0+deb10u1
-- Version de PHP :  5.6.40-0+deb8u6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `data`
--

-- --------------------------------------------------------

--
-- Structure de la table `sigfox`
--

CREATE TABLE IF NOT EXISTS `sigfox` (
`id` int(11) NOT NULL,
  `idDevice` varchar(25) NOT NULL,
  `seqNumber` int(11) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `data` varchar(60) NOT NULL,
  `type` int(3) DEFAULT NULL,
  `field1` int(11) DEFAULT NULL,
  `field2` int(11) DEFAULT NULL,
  `field3` int(11) DEFAULT NULL,
  `field4` int(11) DEFAULT NULL,
  `field5` int(11) DEFAULT NULL,
  `field6` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `sigfox`
--

INSERT INTO `sigfox` (`id`, `idDevice`, `seqNumber`, `time`, `data`, `type`, `field1`, `field2`, `field3`, `field4`, `field5`, `field6`) VALUES
(10, 'C32B57', 11, '2020-07-19 19:58:02', '040000ff000000000080ff00', NULL, 1024, 255, 0, 0, 128, -256),
(11, 'C32B57', 12, '2020-07-19 20:41:08', '040000ff000000000080ff00', NULL, 1024, 255, 0, 0, 128, -256),
(12, 'C32B57', 13, '2020-07-20 08:09:46', '040000ff000000000080ff00', NULL, 1024, 255, 0, 0, 128, -256),
(13, 'C32B57', 15, '2020-07-20 19:29:57', '016401640164016401640164', NULL, 356, 356, 356, 356, 356, 356),
(14, 'C32B57', 16, '2020-07-20 20:49:26', '016401640164016401640164', NULL, 356, 356, 356, 356, 356, 356),
(15, 'C32B57', 17, '2020-07-20 21:00:11', '016401f5016401f5016401f5', NULL, 356, 501, 356, 501, 356, 501);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `sigfox`
--
ALTER TABLE `sigfox`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `sigfox`
--
ALTER TABLE `sigfox`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
