-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u4
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Dim 01 Septembre 2019 à 10:36
-- Version du serveur :  5.5.62-0+deb8u1
-- Version de PHP :  5.6.40-0+deb8u1

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
-- Structure de la table `things`
--

CREATE TABLE IF NOT EXISTS `things` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  `elevation` float NOT NULL,
  `name` varchar(50) NOT NULL,
  `tag` varchar(50) NOT NULL,
  `status` enum('public','private') DEFAULT NULL,
  `local_ip_address` varchar(20) NOT NULL,
  `class` varchar(20) NOT NULL DEFAULT 'objet'
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `things`
--

INSERT INTO `things` (`id`, `user_id`, `latitude`, `longitude`, `elevation`, `name`, `tag`, `status`, `local_ip_address`, `class`) VALUES
(1, 2, 48.0101, 0.206052, 70.2, 'Weather station Tessé', 'weather', 'public', '192.168.1.10 /24', 'weather'),
(2, 2, 47.9948, 0.205072, 48.9, 'Ruche Danemark', 'danemark', 'public', '172.18.58.106 /24', 'objet'),
(3, 1, 47.9949, 0.2046, 70.2, 'Ruche France', 'france', 'public', '172.18.58.219 /24', 'objet'),
(4, 2, 47.8161, 0.113614, 83.9, 'Ruche Oizé', 'test', 'public', '192.168.1.47 /24', 'objet'),
(11, 0, 47.9955, 0.202465, 49.3, 'Gateway', 'gateway', 'private', '172.18.58.169 /24', 'objet');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `things`
--
ALTER TABLE `things`
 ADD PRIMARY KEY (`id`), ADD KEY `id_user` (`user_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `things`
--
ALTER TABLE `things`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `things`
--
ALTER TABLE `things`
ADD CONSTRAINT `things_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
