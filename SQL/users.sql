-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u6
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mer 22 Avril 2020 à 11:06
-- Version du serveur :  5.5.62-0+deb8u1
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
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `login` varchar(25) NOT NULL,
  `encrypted_password` varchar(128) NOT NULL,
  `password_salt` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telNumber` varchar(20) DEFAULT NULL,
  `User_API_Key` varchar(50) NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sign_in_count` int(10) NOT NULL DEFAULT '0',
  `last_sign_in_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `current_sign_in_at` timestamp NULL DEFAULT NULL,
  `time_zone` varchar(25) NOT NULL DEFAULT 'UTC',
  `quotaSMS` int(11) NOT NULL DEFAULT '140',
  `delaySMS` int(11) NOT NULL DEFAULT '15',
  `allow` tinyint(1) NOT NULL DEFAULT '1',
  `droits` int(11) NOT NULL DEFAULT '1',
  `reset_password_token` varchar(128) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `login`, `encrypted_password`, `password_salt`, `email`, `telNumber`, `User_API_Key`, `Created_at`, `sign_in_count`, `last_sign_in_at`, `current_sign_in_at`, `time_zone`, `quotaSMS`, `delaySMS`, `allow`, `droits`, `reset_password_token`) VALUES
(0, 'root', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', NULL, '', NULL, 'RDIK9LVVYEYZYZER', '2019-08-11 12:42:44', 257, '2020-04-21 22:00:38', '2020-04-22 07:46:42', 'Europe/Paris', 140, 15, 1, 2, NULL),
(1, 'touchard', '31f7a65e315586ac198bd798b6629ce4903d0899476d5741a9f32e2e521b6a66', NULL, '', '', 'RC8IK9LVVYEYZNSM', '2019-06-18 20:02:20', 64, '2019-09-08 09:41:45', '2020-04-13 16:36:39', 'Europe/Paris', 140, 15, 1, 1, NULL),
(2, 'philippe', '509ba13c6766198a14d559630a41dd94d14713dc8cd7c0668c04daa05db2a238', 'U0R8M28PJ7G6S566WPNX', 'philaure@wanadoo.fr', '+33689744235', '9L0V9YXONAUJ0QRH', '0000-00-00 00:00:00', 79, '2020-04-22 08:18:03', '2020-04-22 08:37:38', 'Europe/Paris', 140, 15, 1, 2, NULL),
(4, 'essai', '31f7a65e315586ac198bd798b6629ce4903d0899476d5741a9f32e2e521b6a66', NULL, 'l.ziani@st.org', NULL, 'PPE8Z95B409IB', '2020-03-30 16:15:37', 5, '2020-04-13 16:26:21', '2020-04-14 19:34:00', 'UTC', 140, 30, 1, 1, NULL),
(6, 'didier', '2fd887facce086740cd630d26c79ec00821606047ee56580a6c987aed857889a', NULL, '', NULL, 'GC6SESWGAIOW0', '2020-03-31 18:58:51', 1, '2020-04-13 16:28:07', '2020-04-13 16:28:07', 'Europe/Paris', 140, 30, 0, 1, NULL),
(7, 'bidochon', '31f7a65e315586ac198bd798b6629ce4903d0899476d5741a9f32e2e521b6a66', NULL, 'robertb@gmail.com', '+33612724236', 'A35GZOE7XXZGU8YO', '2020-04-11 09:10:56', 7, '2020-04-14 13:39:12', '2020-04-14 19:18:16', 'Europe/Paris', 140, 15, 1, 1, NULL),
(8, 'Robert', 'b85f210cc99ff61458254877cb0720e332619cb3badde110502bf124f80cdbc9', 'SNTOLFKALB2I0SX0WDH2', 'robertb@st.org', '0243740440', 'LJZGWX8MA4', '2020-04-17 19:32:34', 1, '2020-04-17 19:35:00', '2020-04-17 19:35:00', 'Europe/Paris', 150, 25, 1, 1, NULL);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `login` (`login`), ADD UNIQUE KEY `tel` (`telNumber`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
