-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u4
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Dim 14 Juillet 2019 à 11:12
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
-- Structure de la table `channels`
--

CREATE TABLE IF NOT EXISTS `channels` (
`id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `field1` varchar(50) NOT NULL,
  `field2` varchar(50) NOT NULL,
  `field3` varchar(50) NOT NULL,
  `field4` varchar(50) NOT NULL,
  `field5` varchar(50) NOT NULL,
  `field6` varchar(50) NOT NULL,
  `field7` varchar(50) NOT NULL,
  `field8` varchar(50) NOT NULL,
  `statut` varchar(11) NOT NULL,
  `tags` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=752844 DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `channels`
--

INSERT INTO `channels` (`id`, `name`, `field1`, `field2`, `field3`, `field4`, `field5`, `field6`, `field7`, `field8`, `statut`, `tags`) VALUES
(539387, 'Mesures', ' Weight (Kg)', 'Temperature (°C)', 'Pressure (hPa)', 'Humidity (%)', 'Illuminance (Lux)', 'Dew point (°C)', 'Corrected Weight (Kg)', '', '', 'beehive'),
(566173, 'Ruche Touchard 1', 'Weight (kg)', 'Temperature (°C)', 'Pressure (kPa)', 'Humidity (%)', 'Illuminance (lux)', 'Dew point (°C)', '', '', '', 'Danemark'),
(752839, 'Beehive inside', 'Weight (kg)', 'Temperature (°C)', 'Pressure (kPa)', 'Humidity (%)', 'Illuminance (lux)', 'Dew point (°C)', 'Corrected Weight (kg)', '', '', 'France'),
(752841, 'Battery', 'Tension (V)', 'Curent (A)', 'Power (W)', 'State of charge (%)', 'Capacity (Ah)', '', '', '', '', 'France'),
(752843, 'Weather Le Mans', 'Temperature (°C)', 'Pressure (hPa)', 'Humidity (%)', 'Wind speed (m/s)', 'Wind direction (°)', 'dew point (°C)', '', '', '', 'France');

-- --------------------------------------------------------

--
-- Structure de la table `feeds`
--

CREATE TABLE IF NOT EXISTS `feeds` (
`id` int(11) NOT NULL,
  `id_channel` int(11) NOT NULL,
  `field1` float DEFAULT NULL,
  `field2` float DEFAULT NULL,
  `field3` float DEFAULT NULL,
  `field4` float DEFAULT NULL,
  `field5` float DEFAULT NULL,
  `field6` float DEFAULT NULL,
  `field7` float DEFAULT NULL,
  `field8` float DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(255) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `elevation` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `Matlab_Visu`
--

CREATE TABLE IF NOT EXISTS `Matlab_Visu` (
`id` int(11) NOT NULL,
  `things_id` int(11) NOT NULL,
  `thing_speak_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `Matlab_Visu`
--

INSERT INTO `Matlab_Visu` (`id`, `things_id`, `thing_speak_id`, `name`) VALUES
(1, 3, 291595, 'Poids Température'),
(2, 3, 291596, 'Histogramme'),
(5, 3, 291615, 'Humidity / Temperature'),
(6, 1, 257736, 'Wind speed compass'),
(7, 3, 257736, 'Wind speed compass'),
(8, 1, 256601, 'Histogram Temperature'),
(9, 2, 256962, 'Histogram Temperature');

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
  `status` enum('public','private') DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `things`
--

INSERT INTO `things` (`id`, `user_id`, `latitude`, `longitude`, `elevation`, `name`, `tag`, `status`) VALUES
(1, 2, 48.0101, 0.206052, 70.2, 'Weather station Tessé', 'beehive', 'public'),
(2, 2, 47.9948, 0.205072, 48.9, 'Ruche Danemark', 'danemark', 'public'),
(3, 1, 47.9949, 0.2046, 70.2, 'Ruche France', 'beehive', 'public');

-- --------------------------------------------------------

--
-- Structure de la table `things_channels`
--

CREATE TABLE IF NOT EXISTS `things_channels` (
`id` int(11) NOT NULL,
  `thing_id` int(11) NOT NULL,
  `channel_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `things_channels`
--

INSERT INTO `things_channels` (`id`, `thing_id`, `channel_id`) VALUES
(4, 3, 539387),
(5, 1, 752839),
(6, 1, 752841),
(7, 1, 752843);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `login` varchar(25) NOT NULL,
  `encrypted_password` varchar(50) NOT NULL,
  `User_API_Key` varchar(50) NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sign_in_count` int(10) NOT NULL DEFAULT '0',
  `last_sign_in_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `login`, `encrypted_password`, `User_API_Key`, `Created_at`, `sign_in_count`, `last_sign_in_at`) VALUES
(1, 'Herisson', '21232f297a57a5a743894a0e4a801fc3', 'RC8IK9LVVYEYZNSM', '2019-06-18 20:02:20', 0, '0000-00-00 00:00:00'),
(2, 'admin', '21232f297a57a5a743894a0e4a801fc3', '9L0V9YXONAUJ0QRH', '0000-00-00 00:00:00', 0, '2019-03-03 17:07:13');

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `users_things`
--
CREATE TABLE IF NOT EXISTS `users_things` (
`id` int(11)
,`name` varchar(50)
,`USER_API_Key` varchar(50)
,`tag` varchar(50)
);
-- --------------------------------------------------------

--
-- Structure de la vue `users_things`
--
DROP TABLE IF EXISTS `users_things`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `users_things` AS select `things`.`id` AS `id`,`things`.`name` AS `name`,`users`.`User_API_Key` AS `USER_API_Key`,`things`.`tag` AS `tag` from (`things` join `users`) where (`things`.`user_id` = `users`.`id`);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `channels`
--
ALTER TABLE `channels`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `feeds`
--
ALTER TABLE `feeds`
 ADD PRIMARY KEY (`id`), ADD KEY `channel` (`id_channel`);

--
-- Index pour la table `Matlab_Visu`
--
ALTER TABLE `Matlab_Visu`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `things`
--
ALTER TABLE `things`
 ADD PRIMARY KEY (`id`), ADD KEY `id_user` (`user_id`);

--
-- Index pour la table `things_channels`
--
ALTER TABLE `things_channels`
 ADD PRIMARY KEY (`id`), ADD KEY `Thing` (`thing_id`), ADD KEY `Channel` (`channel_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `channels`
--
ALTER TABLE `channels`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=752844;
--
-- AUTO_INCREMENT pour la table `feeds`
--
ALTER TABLE `feeds`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `Matlab_Visu`
--
ALTER TABLE `Matlab_Visu`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `things`
--
ALTER TABLE `things`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `things_channels`
--
ALTER TABLE `things_channels`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `feeds`
--
ALTER TABLE `feeds`
ADD CONSTRAINT `feeds_ibfk_1` FOREIGN KEY (`id_channel`) REFERENCES `channels` (`id`);

--
-- Contraintes pour la table `things`
--
ALTER TABLE `things`
ADD CONSTRAINT `things_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `things_channels`
--
ALTER TABLE `things_channels`
ADD CONSTRAINT `things_channels_ibfk_1` FOREIGN KEY (`thing_id`) REFERENCES `things` (`id`),
ADD CONSTRAINT `things_channels_ibfk_2` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
