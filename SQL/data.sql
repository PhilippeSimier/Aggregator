-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Mer 06 Mai 2020 à 21:35
-- Version du serveur :  10.3.22-MariaDB-0+deb10u1
-- Version de PHP :  7.3.14-1~deb10u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `data`
--

-- --------------------------------------------------------

--
-- Structure de la table `channels`
--

CREATE TABLE `channels` (
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
  `status` varchar(11) NOT NULL,
  `tags` varchar(50) DEFAULT NULL,
  `write_api_key` varchar(50) DEFAULT NULL,
  `last_write_at` timestamp NULL DEFAULT NULL,
  `last_entry_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

--
-- Contenu de la table `channels`
--

INSERT INTO `channels` (`id`, `name`, `field1`, `field2`, `field3`, `field4`, `field5`, `field6`, `field7`, `field8`, `status`, `tags`, `write_api_key`, `last_write_at`, `last_entry_id`) VALUES
(539387, 'Weather - Tessé', ' --', 'Temperature (°C)', 'Pressure (hPa)', 'Humidity (%)', 'Illuminance (Lux)', 'Dew point (°C)', '--', '', 'actif', 'weather', '8TA0YDI5T5NLCSVV', NULL, NULL),
(552430, 'Moyenne Journalière', 'Poids', 'Température', 'Pression', 'Humidité', '', '', '', '', '', 'weather', 'Y3BXR665PTEYRFCG', NULL, NULL),
(556419, 'Battery', 'Voltage (V)', 'Current (A)', 'Power (W)', 'State Of Charge (%)', 'Capacity (Ah)', '', '', '', '', 'weather', '7VX28B24FEE50ZTO', NULL, NULL),
(558210, 'Mesures - Tests', 'Weight (Kg)', 'Temperature (°C)', 'Pressure (kPa)', 'Humidity (%)', 'Illuminance (lux)', 'dew point (°C)', 'Corrected Weight (kg)', 'Derived Weight (g/h)', '', 'test', '3RPCCIIT1JJHM25A', NULL, NULL),
(566173, 'Mesures Danemark', 'Weight (kg)', 'Temperature (°C)', 'Pressure (kPa)', 'Humidity (%)', 'Illuminance (lux)', 'Dew point (°C)', 'Corrected Weight (Kg)', '', 'actif', 'danemark', 'NWIA1TIPGT1L9S39', NULL, NULL),
(569228, 'Dérivée poids Test', 'Dérivée poids Test', '', '', '', '', '', '', '', '', 'test', 'OH5D06IUTUJ7ZAV9', NULL, NULL),
(602082, 'Tests unitaires', 'Echelon', 'Sinus', 'Carré', 'Impulsions', 'field5', 'field6', 'field7', 'field8', 'passif', 'weather', 'BUNNFRUOOIJ4HM7X', NULL, NULL),
(622253, 'Weather Le Mans', 'Temperature (°C)', 'Pressure (hPa)', 'Humidity (%)', 'Wind speed (m/s)', 'Wind direction (°)', 'dew point (°C)', '', '', '', 'france', 'MEUSWB77H6MMRFHD', NULL, NULL),
(684316, 'Derivée poids', 'derivée (Kg/h)', '', '', '', '', '', '', '', '', 'danemark', '3EVVIU67Z14GDQHU', NULL, NULL),
(752839, 'Mesures - France', 'Weight (kg)', 'Temperature (°C)', 'Pressure (kPa)', 'Humidity (%)', 'Illuminance (lux)', 'Dew point (°C)', 'Corrected Weight (kg)', '', '', 'france', 'OES0BIVP60Q61248', NULL, NULL),
(752841, 'Battery - France', 'Voltage (V)', 'Curent (A)', 'Power (W)', 'State of charge (%)', 'Capacity (Ah)', '', '', '', 'actif', 'france', 'AVKOTCZ049Z420QC', NULL, NULL),
(788567, 'Derived weight - France', 'derived weight (Kg/h)', '', '', '', '', '', '', '', 'public', 'france', '3RSFQ81I81H1RBSN', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `failed_logins`
--

CREATE TABLE `failed_logins` (
  `id` int(11) NOT NULL,
  `login` varchar(25) NOT NULL,
  `password` varchar(128) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `failed_logins`
--

INSERT INTO `failed_logins` (`id`, `login`, `password`, `ip_address`, `created_at`) VALUES
(12, 'root', 'b778ff35a109e2291d9f12016f951d899b3a270bd495fc6a539b83a8650d515d', '192.168.1.26', '2020-04-19 16:43:34'),
(13, 'philippe', 'c3255ad8dad4cd57a29f3a61293003d5aca4447c0e7846173fb0fb6b186b62ee', '192.168.1.26', '2020-04-19 19:32:30');

-- --------------------------------------------------------

--
-- Structure de la table `feeds`
--

CREATE TABLE `feeds` (
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
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) DEFAULT NULL,
  `latitude` decimal(15,10) DEFAULT NULL,
  `longitude` decimal(15,10) DEFAULT NULL,
  `elevation` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déclencheurs `feeds`
--
DELIMITER $$
CREATE TRIGGER `after_insert_feeds` AFTER INSERT ON `feeds` FOR EACH ROW UPDATE `channels` 
SET `last_entry_id`= (SELECT count(*) FROM `feeds` WHERE `id_channel` = NEW.id_channel) , 
`last_write_at`=NOW() 
WHERE `id` = NEW.id_channel
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `login_things`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `login_things` (
`id` int(11)
,`login` varchar(25)
,`name` varchar(50)
,`tag` varchar(50)
,`status` enum('public','private')
,`local_ip_address` varchar(20)
);

-- --------------------------------------------------------

--
-- Structure de la table `Matlab_Visu`
--

CREATE TABLE `Matlab_Visu` (
  `id` int(11) NOT NULL,
  `things_id` int(11) NOT NULL,
  `thing_speak_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Structure de la table `reacts`
--

CREATE TABLE `reacts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `run_interval` int(11) DEFAULT NULL,
  `run_on_insertion` tinyint(1) NOT NULL DEFAULT 0,
  `last_run_at` timestamp NULL DEFAULT NULL,
  `channel_id` int(11) DEFAULT NULL,
  `field_number` int(11) NOT NULL,
  `condition` varchar(15) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `condition_value` float NOT NULL,
  `actionable_id` int(11) NOT NULL,
  `last_result` int(11) DEFAULT NULL,
  `actionable_type` varchar(15) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'Thinghttp',
  `action_value` float DEFAULT NULL,
  `latest_value` float DEFAULT NULL,
  `run_action_every_time` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `reacts`
--

INSERT INTO `reacts` (`id`, `user_id`, `name`, `run_interval`, `run_on_insertion`, `last_run_at`, `channel_id`, `field_number`, `condition`, `condition_value`, `actionable_id`, `last_result`, `actionable_type`, `action_value`, `latest_value`, `run_action_every_time`) VALUES
(1, 0, 'Weather temperature greater 20', 0, 1, NULL, 552430, 2, 'gt', 20, 4, NULL, 'thingHTTP', NULL, NULL, 0),
(2, 0, 'SOC Battery less 10', 60, 0, NULL, 556419, 4, 'lt', 10, 2, NULL, 'thingHTTP', NULL, NULL, 0),
(3, 0, 'Ruche-Danemark Weight 50', 0, 1, NULL, 566173, 1, 'gt', 50, 1, NULL, 'thingHTTP', NULL, NULL, 0),
(5, 7, 'React1', 0, 1, NULL, 602082, 3, 'gt', 50, 2, NULL, 'thingHTTP', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `thinghttps`
--

CREATE TABLE `thinghttps` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `api_key` varchar(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `auth_name` varchar(50) NOT NULL,
  `auth_pass` varchar(50) NOT NULL,
  `method` enum('GET','POST','PUT','DELETE') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content_type` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `http_version` enum('1.1','1.0') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `host` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `body` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `parse` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `thinghttps`
--

INSERT INTO `thinghttps` (`id`, `user_id`, `api_key`, `url`, `auth_name`, `auth_pass`, `method`, `content_type`, `http_version`, `host`, `body`, `name`, `parse`, `created_at`) VALUES
(1, 0, 'BNVZU7JHUHUEQAP1', 'https://philippes.ddns.net/Ruche/api/sendSMS', '', '', 'POST', 'application/x-www-form-urlencoded', '1.1', '', 'key=RC8IK9LVVYEYZNSM&number=0689744235&message=Ruche France : Variation du poids à  la hausse anormale !', 'SMS - Hausse du poids anormale - Ruche France', '', '2019-09-08 16:09:42'),
(2, 2, 'AZERTYUIOP', 'http://example.com/', '', '', 'GET', '', '1.1', '', '', 'GET Example.com', '', '2019-09-08 18:18:25'),
(4, 0, 'FPAC2971PZDGB2', 'http://touchardinforeseau.servehttp.com/Ruche/api/sendSMS', '', '', 'POST', 'application/x-www-form-urlencoded', '1.1', '', 'key=RC8IK9LVVYEYZNSM&number=0689744235&message=Ruche%20France%20%3A%20Variation%20du%20poids%20%C3%A0%20la%20hausse%20anormale%20!', 'Send SMS with API DMZ', '', '2019-09-15 07:30:21'),
(5, 0, 'GG58UUU72V02K', 'http://404.php.net/', '', '', 'GET', '', '1.0', '', '', 'Essai avec URL inexistante', 'test', '2019-09-15 20:02:27'),
(7, 4, '89M57KUW0FN', 'http://google.fr', '', '', 'GET', 'application/x-www-form-urlencoded', '1.1', 'api.aggregate.com', '', 'Redirection 301 moved', '', '2020-04-28 15:00:28');

-- --------------------------------------------------------

--
-- Structure de la table `things`
--

CREATE TABLE `things` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `latitude` decimal(9,6) DEFAULT NULL,
  `longitude` decimal(9,6) DEFAULT NULL,
  `elevation` float DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `tag` varchar(50) NOT NULL,
  `status` enum('public','private') DEFAULT NULL,
  `local_ip_address` varchar(20) NOT NULL,
  `class` varchar(20) NOT NULL DEFAULT 'objet'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

--
-- Contenu de la table `things`
--

INSERT INTO `things` (`id`, `user_id`, `latitude`, `longitude`, `elevation`, `name`, `tag`, `status`, `local_ip_address`, `class`) VALUES
(1, 2, '48.010101', '0.206052', 70.2, 'Weather Station Tessé', 'weather', 'public', '192.168.1.10 /24', 'weather'),
(2, 2, '47.994862', '0.205088', 49, 'Ruche Danemark', 'danemark', 'public', '172.18.58.106 /24', 'ruche'),
(3, 1, '47.994900', '0.204600', 70.2, 'Ruche France', 'france', 'public', '172.18.58.219 /24', 'ruche'),
(4, 2, '47.816359', '0.113129', 83.3, 'Ruche Oizé', 'test', 'public', '172.18.58.220 /24', 'ruche'),
(11, 1, '47.995532', '0.202465', 49.3, 'Gateway - Gsm', 'gateway', 'private', '172.18.58.169 /24', 'objet'),
(13, 2, '48.170718', '0.704355', 113.6, 'Webcam', 'Webcam', 'public', '172.18.58.253 /24', 'objet'),
(17, 2, '48.146652', '0.363191', 94.9, 'Ruche beaufay', 'beaufay', 'private', '192.168.1.9 /24', 'ruche'),
(18, 12, '48.009774', '0.199032', 77.8, 'test_unit', 'test_unit', 'private', '127.0.0.1', 'objet');

-- --------------------------------------------------------

--
-- Structure de la table `things_channels`
--

CREATE TABLE `things_channels` (
  `id` int(11) NOT NULL,
  `thing_id` int(11) NOT NULL,
  `channel_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(25) NOT NULL,
  `encrypted_password` varchar(128) NOT NULL,
  `password_salt` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telNumber` varchar(20) DEFAULT NULL,
  `User_API_Key` varchar(50) NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `sign_in_count` int(10) NOT NULL DEFAULT 0,
  `last_sign_in_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `current_sign_in_at` timestamp NULL DEFAULT NULL,
  `time_zone` varchar(25) NOT NULL DEFAULT 'UTC',
  `quotaSMS` int(11) NOT NULL DEFAULT 140,
  `delaySMS` int(11) NOT NULL DEFAULT 15,
  `allow` tinyint(1) NOT NULL DEFAULT 1,
  `droits` int(11) NOT NULL DEFAULT 1,
  `reset_password_token` varchar(128) DEFAULT NULL,
  `language` varchar(50) NOT NULL DEFAULT 'FR'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `login`, `encrypted_password`, `password_salt`, `email`, `telNumber`, `User_API_Key`, `Created_at`, `sign_in_count`, `last_sign_in_at`, `current_sign_in_at`, `time_zone`, `quotaSMS`, `delaySMS`, `allow`, `droits`, `reset_password_token`, `language`) VALUES
(0, 'root', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', NULL, '', NULL, 'RDIK9LVVYEYZYZER', '2019-08-11 12:42:44', 323, '2020-05-06 14:55:37', '2020-05-06 16:54:07', 'Europe/Paris', 140, 15, 1, 2, NULL, 'FR'),
(1, 'touchard', '31f7a65e315586ac198bd798b6629ce4903d0899476d5741a9f32e2e521b6a66', NULL, '', '', 'RC8IK9LVVYEYZNSM', '2019-06-18 20:02:20', 64, '2019-09-08 09:41:45', '2020-04-13 16:36:39', 'Europe/Paris', 140, 30, 1, 1, NULL, 'FR'),
(2, 'philippe', '011311eee2eb1a13e3fb1503397f43f3c7ae184ad30a23c83b102a528c92cb1e', NULL, 'philaure@wanadoo.fr', '+33689744235', '9L0V9YXONAUJ0QRH', '0000-00-00 00:00:00', 87, '2020-04-22 18:46:21', '2020-04-23 19:25:26', 'Europe/Paris', 140, 15, 1, 1, NULL, 'FR'),
(4, 'essai', '8284654b713eef76588b094c7fd4c0641b9fedb798ffaefc40defc4db17ceb38', 'ABOCH9FPWQ5SRTNZAWXD', 'l.ziani@st.org', NULL, '6BNI1RPKV4M', '2020-03-30 16:15:37', 9, '2020-04-17 16:34:02', '2020-04-19 19:43:40', 'Europe/Prague', 140, 30, 1, 1, NULL, 'FR'),
(6, 'didier', '2fd887facce086740cd630d26c79ec00821606047ee56580a6c987aed857889a', NULL, '', NULL, 'GC6SESWGAIOW0', '2020-03-31 18:58:51', 1, '2020-04-13 16:28:07', '2020-04-13 16:28:07', 'Europe/Paris', 140, 30, 1, 1, NULL, 'FR'),
(7, 'bidochon', 'e743dd1be6bcd0a00ad0de2e561e9341800f5cebf5def5db1218217e5ff62ff0', '1LHIFKUGI6E3MC4LLJ1Y', 'bidochon@gmail.com', '+33612724236', '3G7IMI0INJ683IT', '2020-04-11 09:10:56', 7, '2020-04-14 13:39:12', '2020-04-14 19:18:16', 'Europe/Madrid', 140, 15, 1, 1, NULL, 'FR'),
(9, 'Robert', '7d4a5ed6d9ee48ebd83d1637628bfa9c5709dd572ff24332e03fbdef502ca2b9', 'JVCZ7VA1BCPG6A1DJKWC', NULL, NULL, 'M5R470BD20KU', '2020-04-17 19:09:20', 5, '2020-04-18 15:11:58', '2020-04-19 19:30:46', 'Europe/Paris', 140, 15, 0, 1, NULL, 'FR'),
(12, 'Camille', '2e09944dafe7cd2616362f4054a00ad886137edb6efe2859cbc8a428b92836c1', '7AHITEGURANUASTZ6WKM', 'madamecamille@hotmail.fr', '0602154830', 'A5MMSU09QPA', '2020-04-20 19:06:20', 1, '2020-04-20 19:08:03', '2020-04-20 19:08:03', 'Europe/Monaco', 149, 15, 1, 1, NULL, 'FR'),
(23, 'clement', '7f306a91dc8837dcd19b30e93787047769921abc72a0f68b7247b4f540cef794', '84PISTBH49GMPM1K479D', NULL, NULL, 'STGMZ40PUNX', '2020-05-03 20:47:32', 0, '0000-00-00 00:00:00', NULL, 'Europe/Copenhagen', 140, 15, 1, 1, NULL, 'FR');

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `users_channels`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `users_channels` (
`id` int(11)
,`name` varchar(50)
,`tags` varchar(50)
,`write_api_key` varchar(50)
,`last_entry_id` int(11)
,`last_write_at` timestamp
,`user_id` int(11)
,`login` varchar(25)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `users_things`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `users_things` (
`id` int(11)
,`name` varchar(50)
,`USER_API_Key` varchar(50)
,`tag` varchar(50)
);

-- --------------------------------------------------------

--
-- Structure de la vue `login_things`
--
DROP TABLE IF EXISTS `login_things`;

CREATE ALGORITHM=UNDEFINED DEFINER=`ruche`@`localhost` SQL SECURITY DEFINER VIEW `login_things`  AS  select `things`.`id` AS `id`,`users`.`login` AS `login`,`things`.`name` AS `name`,`things`.`tag` AS `tag`,`things`.`status` AS `status`,`things`.`local_ip_address` AS `local_ip_address` from (`things` join `users`) where `things`.`user_id` = `users`.`id` ;

-- --------------------------------------------------------

--
-- Structure de la vue `users_channels`
--
DROP TABLE IF EXISTS `users_channels`;

CREATE ALGORITHM=UNDEFINED DEFINER=`ruche`@`localhost` SQL SECURITY DEFINER VIEW `users_channels`  AS  select `channels`.`id` AS `id`,`channels`.`name` AS `name`,`channels`.`tags` AS `tags`,`channels`.`write_api_key` AS `write_api_key`,`channels`.`last_entry_id` AS `last_entry_id`,`channels`.`last_write_at` AS `last_write_at`,`users`.`id` AS `user_id`,`users`.`login` AS `login` from ((`channels` join `things`) join `users`) where `channels`.`tags` = `things`.`tag` and `things`.`user_id` = `users`.`id` ;

-- --------------------------------------------------------

--
-- Structure de la vue `users_things`
--
DROP TABLE IF EXISTS `users_things`;

CREATE ALGORITHM=UNDEFINED DEFINER=`ruche`@`localhost` SQL SECURITY DEFINER VIEW `users_things`  AS  select `things`.`id` AS `id`,`things`.`name` AS `name`,`users`.`User_API_Key` AS `USER_API_Key`,`things`.`tag` AS `tag` from (`things` join `users`) where `things`.`user_id` = `users`.`id` ;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `channels`
--
ALTER TABLE `channels`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `failed_logins`
--
ALTER TABLE `failed_logins`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `feeds`
--
ALTER TABLE `feeds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `channel` (`id_channel`);

--
-- Index pour la table `Matlab_Visu`
--
ALTER TABLE `Matlab_Visu`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reacts`
--
ALTER TABLE `reacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index_reacts_on_channel_id_and_run_on_insertion` (`channel_id`,`run_on_insertion`),
  ADD KEY `index_reacts_on_channel_id` (`channel_id`),
  ADD KEY `index_reacts_on_user_id` (`user_id`);

--
-- Index pour la table `thinghttps`
--
ALTER TABLE `thinghttps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users` (`user_id`);

--
-- Index pour la table `things`
--
ALTER TABLE `things`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`user_id`);

--
-- Index pour la table `things_channels`
--
ALTER TABLE `things_channels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Thing` (`thing_id`),
  ADD KEY `Channel` (`channel_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `tel` (`telNumber`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `channels`
--
ALTER TABLE `channels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=788570;
--
-- AUTO_INCREMENT pour la table `failed_logins`
--
ALTER TABLE `failed_logins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT pour la table `feeds`
--
ALTER TABLE `feeds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1690;
--
-- AUTO_INCREMENT pour la table `Matlab_Visu`
--
ALTER TABLE `Matlab_Visu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `reacts`
--
ALTER TABLE `reacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `thinghttps`
--
ALTER TABLE `thinghttps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `things`
--
ALTER TABLE `things`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT pour la table `things_channels`
--
ALTER TABLE `things_channels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `feeds`
--
ALTER TABLE `feeds`
  ADD CONSTRAINT `feeds_ibfk_1` FOREIGN KEY (`id_channel`) REFERENCES `channels` (`id`);

--
-- Contraintes pour la table `reacts`
--
ALTER TABLE `reacts`
  ADD CONSTRAINT `reacts_ibfk_1` FOREIGN KEY (`channel_id`) REFERENCES `channels` (`id`),
  ADD CONSTRAINT `reacts_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `thinghttps`
--
ALTER TABLE `thinghttps`
  ADD CONSTRAINT `thinghttps_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

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
