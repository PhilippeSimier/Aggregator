-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Mer 21 Avril 2021 à 11:46
-- Version du serveur :  10.3.27-MariaDB-0+deb10u1
-- Version de PHP :  7.3.27-1~deb10u1

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
-- Structure de la table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `thing_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `keyWord` varchar(100) DEFAULT NULL,
  `visitDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `comment` mediumtext NOT NULL,
  `status` enum('public','private') NOT NULL DEFAULT 'private'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `callbacks`
--

CREATE TABLE `callbacks` (
  `id` int(11) NOT NULL,
  `idDevice` varchar(10) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `url` varchar(150) DEFAULT NULL,
  `write_api_key` varchar(50) DEFAULT NULL,
  `payload` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `channels`
--

CREATE TABLE `channels` (
  `id` int(11) NOT NULL,
  `thing_id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `field1` varchar(50) NOT NULL,
  `field2` varchar(50) NOT NULL,
  `field3` varchar(50) NOT NULL,
  `field4` varchar(50) NOT NULL,
  `field5` varchar(50) NOT NULL,
  `field6` varchar(50) NOT NULL,
  `field7` varchar(50) NOT NULL,
  `field8` varchar(50) NOT NULL,
  `status` varchar(11) DEFAULT NULL,
  `write_api_key` varchar(50) DEFAULT NULL,
  `last_write_at` timestamp NULL DEFAULT NULL,
  `last_entry_id` int(11) DEFAULT NULL,
  `public_flag` tinyint(1) NOT NULL DEFAULT 1,
  `idDevice` varchar(25) DEFAULT NULL,
  `type` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `channels`
--

INSERT INTO `channels` (`id`, `thing_id`, `name`, `description`, `field1`, `field2`, `field3`, `field4`, `field5`, `field6`, `field7`, `field8`, `status`, `write_api_key`, `last_write_at`, `last_entry_id`, `public_flag`, `idDevice`, `type`) VALUES
(539387, 1, 'Weather', 'The Weather Station\r\nfrom Tessé ...', 'Weight (Kg)', 'Temperature (°C)', 'Pressure (hPa)', 'Humidity (%)', 'Illuminance (Lux)', 'Dew point (°C)', 'Corrected Weight (Kg)', '', '', '8TA0YDI5T5NLCSVV', '2021-03-06 17:47:06', 63, 1, NULL, NULL),
(552430, 1, 'Moyenne Journalière', '', 'temp mini', 'temp moy', 'pression', 'humidité', '', '', '', '', '', '1DRM9KB2WNY3U9', '2021-04-21 08:36:16', 948, 1, NULL, NULL),
(556419, 1, 'Battery ', '', 'Voltage (V)', 'Current (A)', 'Power (W)', 'State Of Charge (%)', 'Capacity (Ah)', '', '', '', '', '7VX28B24FEE50ZTO', '2020-07-27 16:15:25', 2, 1, NULL, NULL),
(558210, 12, 'Mesures', '', 'Weight (Kg)', 'Temperature (°C)', 'Pressure (hPa)', 'Humidity (%)', 'Illuminance (lux)', 'dew point (°C)', '', '', '', '3RPCCIIT1JJHM25A', '2020-07-27 16:02:22', 216, 1, 'C32B57', 1),
(566173, 2, 'Mesures', 'Canal de mesure principal pour la ruche Danemark', 'Weight (kg)', 'Temperature (°C)', 'Pressure (kPa)', 'Humidity (%)', 'Illuminance (lux)', 'Dew point (°C)', '', '', '', 'NWIA1TIPGT1L9S39', '2020-05-15 20:00:06', 15934, 1, NULL, NULL),
(569228, 12, 'Derived weight', '', 'derived weight (Kg/h)', '', '', '', '', '', '', '', '', 'OH5D06IUTUJ7ZAV9', NULL, NULL, 1, NULL, NULL),
(602082, 10, 'Battery ', '', 'Tension (V)', 'Courant (A)', 'Puissance (W)', 'SOC (%)', '', '', '', '', '', 'BUNNFRUOOIJ4HM7X', '2021-03-06 17:47:06', 203, 1, NULL, NULL),
(622253, 1, 'Le Mans - Weather', NULL, 'Temperature (°C)', 'Pressure (hPa)', 'Humidity (%)', 'Wind speed (m/s)', 'Wind direction (°)', 'dew point (°C)', '', '', '', 'CPO5W1BNMG44EVC1', '2020-05-15 20:00:03', 243, 1, NULL, NULL),
(684316, 2, 'Derived weight', '', 'derived weight (Kg/h)', '', '', '', '', '', '', '', '', '3EVVIU67Z14GDQHU', NULL, NULL, 1, NULL, NULL),
(752839, 3, 'Mesures', 'Canal de mesures principal de la ruche France', 'Weight (kg)', 'Temperature (°C)', 'Pressure (kPa)', 'Humidity (%)', 'Illuminance (lux)', 'Dew point (°C)', 'Corrected Weight (kg)', '', '', 'OES0BIVP60Q61248', '2020-05-15 20:00:06', 15131, 1, NULL, NULL),
(752841, 10, 'Derived  Weight ', '', 'derived weight (Kg/h)', '', '', '', '', '', '', '', '', 'AVKOTCZ049Z420QC', '2021-04-19 09:27:53', 14422, 1, NULL, NULL),
(752843, 10, 'Mesures', '', 'Weight (Kg)', 'Temperature (°C)', 'Pressure (hPa)', 'Humidity (%)', 'Illuminance (Lux)', 'Dew point (°C)', 'Corrected Weight (Kg)', '', '', 'MEUSWB77H6MMRFHD', '2021-03-06 17:47:06', 192, 1, NULL, NULL),
(788567, 3, 'Derived weight', '', 'derived weight (Kg/h)', '', '', '', '', '', '', '', '', '3RSFQ81I81H1RBSN', NULL, NULL, 1, NULL, NULL),
(788572, 1, 'test sigfox', 'Canal pour test sigfox', 'grandeur1', 'grandeur2', 'grandeur3', 'grandeur4', 'grandeur5', 'grandeur6', '', '', '', 'BXOUOB931F', '2021-04-19 08:04:00', 946, 1, NULL, NULL),
(1289006, 19, 'Mesures', '', 'Température (°C)', 'Pression (hPa)', 'Humidité (%)', 'Eclairement (lux)', '', '', '', '', '', 'QJY6HCY0J04', '2021-04-18 22:36:50', 11973, 1, NULL, NULL);

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
CREATE TRIGGER `after_insert_feeds` AFTER INSERT ON `feeds` FOR EACH ROW UPDATE `channels` SET `last_entry_id`= (SELECT count(*) FROM `feeds` WHERE `id_channel` = NEW.id_channel) , `last_write_at`=NOW() WHERE `id` = NEW.id_channel
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
,`idDevice` varchar(20)
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `reacts`
--

CREATE TABLE `reacts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `react_type` varchar(10) NOT NULL DEFAULT 'numeric',
  `run_interval` int(11) DEFAULT NULL,
  `run_on_insertion` tinyint(1) NOT NULL DEFAULT 0,
  `last_run_at` timestamp NULL DEFAULT NULL,
  `channel_id` int(11) DEFAULT NULL,
  `field_number` int(11) DEFAULT NULL,
  `condition` varchar(15) NOT NULL,
  `condition_value` float DEFAULT NULL,
  `actionable_id` int(11) NOT NULL,
  `last_result` int(11) DEFAULT NULL,
  `actionable_type` varchar(15) NOT NULL DEFAULT 'Thinghttp',
  `action_value` float DEFAULT NULL,
  `latest_value` float DEFAULT NULL,
  `run_action_every_time` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `scripts`
--

CREATE TABLE `scripts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `code` text NOT NULL,
  `language` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_run_at` timestamp NULL DEFAULT NULL,
  `return_value` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `sigfox`
--

CREATE TABLE `sigfox` (
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
  `field6` int(11) DEFAULT NULL,
  `callbacks` varchar(250) DEFAULT NULL,
  `lqi` varchar(20) DEFAULT NULL,
  `operatorName` varchar(50) DEFAULT NULL,
  `latitude` decimal(15,10) DEFAULT NULL,
  `longitude` decimal(15,10) DEFAULT NULL,
  `radius` int(10) DEFAULT NULL,
  `source` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `sigfox_events`
--

CREATE TABLE `sigfox_events` (
  `id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `sourceId` varchar(10) NOT NULL,
  `eventType` varchar(20) NOT NULL,
  `severity` varchar(20) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `things`
--

CREATE TABLE `things` (
  `id` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `latitude` decimal(9,6) DEFAULT NULL,
  `longitude` decimal(9,6) DEFAULT NULL,
  `elevation` float NOT NULL,
  `name` varchar(50) NOT NULL,
  `tag` varchar(50) NOT NULL,
  `status` enum('public','private') DEFAULT NULL,
  `local_ip_address` varchar(20) NOT NULL,
  `class` varchar(20) NOT NULL DEFAULT 'objet',
  `idDevice` varchar(20) DEFAULT NULL,
  `soundFolder` varchar(255) DEFAULT NULL,
  `blogStatus` enum('private','public','off') NOT NULL DEFAULT 'off'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

--
-- Contenu de la table `things`
--

INSERT INTO `things` (`id`, `user_id`, `latitude`, `longitude`, `elevation`, `name`, `tag`, `status`, `local_ip_address`, `class`, `idDevice`, `soundFolder`, `blogStatus`) VALUES
(1, 2, '48.010101', '0.206052', 50, 'Weather station Tessé', 'Tessé', 'public', '192.168.1.10 /24', 'weather', '', NULL, 'off'),
(2, 1, '47.994801', '0.205072', 48.9, 'Ruche Danemark', 'Danemark', 'public', '172.18.58.106 /24', 'ruche', '', 'sound/beehive2', 'private'),
(3, 1, '47.994946', '0.204605', 49.4, 'Ruche France', 'France', 'public', '172.18.58.219 /24', 'ruche', '', NULL, 'public'),
(6, 0, '47.995532', '0.202465', 49.3, 'Webcam', 'Webcam', 'private', '172.18.58.253 /24', 'objet', NULL, NULL, 'off'),
(10, 8, '48.144852', '0.358803', 91.2, 'Ruche Muguet', 'Muguet', 'public', '192.168.1.9 /24', 'ruche', 'C32B3A', NULL, 'private'),
(12, 2, '48.005115', '0.196022', 76.7, 'Ruche Oizé', 'Oizé', 'private', '172.18.58.220 /24', 'objet', 'C32B57', NULL, 'private'),
(19, 2, '47.811618', '0.109063', 81.5, 'Home inside', 'Home', 'private', '127.0.0.1 /24', 'objet', '', NULL, 'off');

-- --------------------------------------------------------

--
-- Structure de la table `timeControls`
--

CREATE TABLE `timeControls` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT 'default',
  `month` varchar(50) DEFAULT NULL,
  `dayWeek` varchar(50) DEFAULT NULL,
  `dayMonth` varchar(50) DEFAULT NULL,
  `hour` varchar(50) DEFAULT NULL,
  `minute` varchar(50) DEFAULT NULL,
  `actionable_id` int(11) NOT NULL,
  `actionable_type` varchar(15) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
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
  `language` varchar(50) NOT NULL DEFAULT 'FR',
  `cookieConsent` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `login`, `encrypted_password`, `password_salt`, `email`, `telNumber`, `User_API_Key`, `Created_at`, `sign_in_count`, `last_sign_in_at`, `current_sign_in_at`, `time_zone`, `quotaSMS`, `delaySMS`, `allow`, `droits`, `reset_password_token`, `language`, `cookieConsent`) VALUES
(0, 'root', '5cd8817d8fdb26fb7dd1d433500b50db51b8e925a2709de97a89abb6b41906a9', 'M06K292ANH0Z5DA0G603', 'philaure@wanadoo.fr', '0689744235', 'RDIK9LVVYEYZYZER', '2019-08-11 10:42:44', 749, '2021-04-21 06:48:23', '2021-04-21 07:44:42', 'Europe/Paris', 140, 15, 1, 2, NULL, 'FR', 1),
(1, 'touchard', 'f786d8bab1d85e1be8ccf62d7adb58f503b6a605c4859f985e4f7dc092aec425', '3O6HAE3T7D3TCX661E8E', 'philippe.simier@ac-nantes.fr', '0689744235', 'RC8IK9LVVYEYZNSM', '2019-06-18 11:40:56', 62, '2021-04-18 14:34:57', '2021-04-18 16:21:18', 'Europe/Paris', 140, 15, 1, 1, NULL, 'FR', 1),
(2, 'philippe', '089f509603f388d3509b303e340c56db29b6774f69a816d073f5be67bde6e5dd', 'ZGNGYYXORKXMLVWW98FZ', 'philippe.simier@ac-nantes.fr', '+33689744235', '9L0V9YXONAUJ0QRH', '2019-06-18 11:40:56', 84, '2021-04-16 20:48:46', '2021-04-20 11:48:54', 'Europe/Paris', 140, 15, 1, 1, NULL, 'EN', 1),
(8, 'vincent', 'bfb3c1c9c8d378a3770918bf6b54eb9d8841d48bb67606dc308edbdbd5a1bb8b', 'A14C6EYC5IHEYEQOHX7J', '', '', 'O3RLHW8AA8QRAY', '2020-01-24 09:24:01', 63, '2021-02-20 09:31:09', '2021-04-04 07:54:23', 'Europe/Paris', 250, 10, 1, 1, NULL, 'EN', 0);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `users_channels`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `users_channels` (
`id` int(11)
,`thing_id` int(11)
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
,`idDevice` varchar(20)
,`USER_API_Key` varchar(50)
,`tag` varchar(50)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vue_blogs`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `vue_blogs` (
`login` varchar(25)
,`things_id` int(11)
,`comment_id` int(11)
,`title` varchar(100)
,`keyWord` varchar(100)
,`visitDate` timestamp
,`comment` mediumtext
,`status` enum('public','private')
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vue_channels`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `vue_channels` (
`id` int(11)
,`name` varchar(50)
,`description` text
,`latitude` decimal(9,6)
,`longitude` decimal(9,6)
,`elevation` float
,`tag` varchar(50)
,`public_flag` tinyint(1)
,`last_entry_id` int(11)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vue_reacts`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `vue_reacts` (
`id` int(11)
,`react_type` varchar(10)
,`login` varchar(25)
,`name` varchar(50)
,`channelCheck` varchar(50)
,`channelId` int(11)
,`field_number` int(11)
,`condition` varchar(15)
,`condition_value` float
,`actionName` varchar(50)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vue_scripts`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `vue_scripts` (
`id` int(11)
,`user_id` int(11)
,`name` varchar(50)
,`code` text
,`language` varchar(50)
,`created_at` timestamp
,`last_run_at` timestamp
,`return_value` int(11)
,`login` varchar(25)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vue_timeControls`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `vue_timeControls` (
`login` varchar(25)
,`id` int(11)
,`user_id` int(11)
,`name` varchar(100)
,`month` varchar(50)
,`dayWeek` varchar(50)
,`dayMonth` varchar(50)
,`hour` varchar(50)
,`minute` varchar(50)
,`actionable_id` int(11)
,`actionable_type` varchar(15)
);

-- --------------------------------------------------------

--
-- Structure de la table `windows`
--

CREATE TABLE `windows` (
  `id` int(11) NOT NULL,
  `channel_id` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `html` text DEFAULT NULL,
  `col` int(11) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `content_id` int(11) NOT NULL,
  `content_type` varchar(20) NOT NULL,
  `options` text DEFAULT NULL,
  `public_flag` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la vue `login_things`
--
DROP TABLE IF EXISTS `login_things`;

CREATE ALGORITHM=UNDEFINED DEFINER=`ruche`@`%` SQL SECURITY DEFINER VIEW `login_things`  AS  select `things`.`id` AS `id`,`users`.`login` AS `login`,`things`.`name` AS `name`,`things`.`tag` AS `tag`,`things`.`status` AS `status`,`things`.`idDevice` AS `idDevice`,`things`.`local_ip_address` AS `local_ip_address` from (`things` join `users`) where `things`.`user_id` = `users`.`id` ;

-- --------------------------------------------------------

--
-- Structure de la vue `users_channels`
--
DROP TABLE IF EXISTS `users_channels`;

CREATE ALGORITHM=UNDEFINED DEFINER=`ruche`@`%` SQL SECURITY DEFINER VIEW `users_channels`  AS  select `channels`.`id` AS `id`,`channels`.`thing_id` AS `thing_id`,`channels`.`name` AS `name`,`things`.`tag` AS `tags`,`channels`.`write_api_key` AS `write_api_key`,`channels`.`last_entry_id` AS `last_entry_id`,`channels`.`last_write_at` AS `last_write_at`,`users`.`id` AS `user_id`,`users`.`login` AS `login` from ((`channels` join `things`) join `users`) where `channels`.`thing_id` = `things`.`id` and `things`.`user_id` = `users`.`id` ;

-- --------------------------------------------------------

--
-- Structure de la vue `users_things`
--
DROP TABLE IF EXISTS `users_things`;

CREATE ALGORITHM=UNDEFINED DEFINER=`ruche`@`%` SQL SECURITY DEFINER VIEW `users_things`  AS  select `things`.`id` AS `id`,`things`.`name` AS `name`,`things`.`idDevice` AS `idDevice`,`users`.`User_API_Key` AS `USER_API_Key`,`things`.`tag` AS `tag` from (`things` join `users`) where `things`.`user_id` = `users`.`id` ;

-- --------------------------------------------------------

--
-- Structure de la vue `vue_blogs`
--
DROP TABLE IF EXISTS `vue_blogs`;

CREATE ALGORITHM=UNDEFINED DEFINER=`ruche`@`%` SQL SECURITY DEFINER VIEW `vue_blogs`  AS  select `users`.`login` AS `login`,`things`.`id` AS `things_id`,`blogs`.`id` AS `comment_id`,`blogs`.`title` AS `title`,`blogs`.`keyWord` AS `keyWord`,`blogs`.`visitDate` AS `visitDate`,`blogs`.`comment` AS `comment`,`blogs`.`status` AS `status` from ((`blogs` join `things`) join `users`) where `users`.`id` = `things`.`user_id` and `blogs`.`thing_id` = `things`.`id` ;

-- --------------------------------------------------------

--
-- Structure de la vue `vue_channels`
--
DROP TABLE IF EXISTS `vue_channels`;

CREATE ALGORITHM=UNDEFINED DEFINER=`ruche`@`%` SQL SECURITY DEFINER VIEW `vue_channels`  AS  select `channels`.`id` AS `id`,`channels`.`name` AS `name`,`channels`.`description` AS `description`,`things`.`latitude` AS `latitude`,`things`.`longitude` AS `longitude`,`things`.`elevation` AS `elevation`,`things`.`tag` AS `tag`,`channels`.`public_flag` AS `public_flag`,`channels`.`last_entry_id` AS `last_entry_id` from (`channels` join `things`) where `channels`.`thing_id` = `things`.`id` ;

-- --------------------------------------------------------

--
-- Structure de la vue `vue_reacts`
--
DROP TABLE IF EXISTS `vue_reacts`;

CREATE ALGORITHM=UNDEFINED DEFINER=`ruche`@`%` SQL SECURITY DEFINER VIEW `vue_reacts`  AS  select `reacts`.`id` AS `id`,`reacts`.`react_type` AS `react_type`,`users`.`login` AS `login`,`reacts`.`name` AS `name`,`channels`.`name` AS `channelCheck`,`channels`.`id` AS `channelId`,`reacts`.`field_number` AS `field_number`,`reacts`.`condition` AS `condition`,`reacts`.`condition_value` AS `condition_value`,`thinghttps`.`name` AS `actionName` from (((`users` join `channels`) join `reacts`) join `thinghttps`) where `channels`.`id` = `reacts`.`channel_id` and `reacts`.`actionable_id` = `thinghttps`.`id` and `users`.`id` = `reacts`.`user_id` ;

-- --------------------------------------------------------

--
-- Structure de la vue `vue_scripts`
--
DROP TABLE IF EXISTS `vue_scripts`;

CREATE ALGORITHM=UNDEFINED DEFINER=`ruche`@`%` SQL SECURITY DEFINER VIEW `vue_scripts`  AS  select `scripts`.`id` AS `id`,`scripts`.`user_id` AS `user_id`,`scripts`.`name` AS `name`,`scripts`.`code` AS `code`,`scripts`.`language` AS `language`,`scripts`.`created_at` AS `created_at`,`scripts`.`last_run_at` AS `last_run_at`,`scripts`.`return_value` AS `return_value`,`users`.`login` AS `login` from (`scripts` join `users`) where `scripts`.`user_id` = `users`.`id` ;

-- --------------------------------------------------------

--
-- Structure de la vue `vue_timeControls`
--
DROP TABLE IF EXISTS `vue_timeControls`;

CREATE ALGORITHM=UNDEFINED DEFINER=`ruche`@`%` SQL SECURITY DEFINER VIEW `vue_timeControls`  AS  select `users`.`login` AS `login`,`timeControls`.`id` AS `id`,`timeControls`.`user_id` AS `user_id`,`timeControls`.`name` AS `name`,`timeControls`.`month` AS `month`,`timeControls`.`dayWeek` AS `dayWeek`,`timeControls`.`dayMonth` AS `dayMonth`,`timeControls`.`hour` AS `hour`,`timeControls`.`minute` AS `minute`,`timeControls`.`actionable_id` AS `actionable_id`,`timeControls`.`actionable_type` AS `actionable_type` from (`timeControls` join `users`) where `users`.`id` = `timeControls`.`user_id` ;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `thing_id` (`thing_id`) USING BTREE;

--
-- Index pour la table `callbacks`
--
ALTER TABLE `callbacks`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `channels`
--
ALTER TABLE `channels`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idDevice` (`idDevice`),
  ADD KEY `thing_id` (`thing_id`);

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
  ADD UNIQUE KEY `date_channel` (`date`,`id_channel`) USING BTREE,
  ADD KEY `canal` (`id_channel`);

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
  ADD UNIQUE KEY `run_insertion_name_channel_id` (`channel_id`,`name`,`run_on_insertion`),
  ADD KEY `index_reacts_on_channel_id_and_run_on_insertion` (`channel_id`,`run_on_insertion`),
  ADD KEY `index_reacts_on_channel_id` (`channel_id`),
  ADD KEY `index_reacts_on_user_id` (`user_id`);

--
-- Index pour la table `scripts`
--
ALTER TABLE `scripts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `sigfox`
--
ALTER TABLE `sigfox`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idDevice` (`idDevice`);

--
-- Index pour la table `sigfox_events`
--
ALTER TABLE `sigfox_events`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `thinghttps`
--
ALTER TABLE `thinghttps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `things`
--
ALTER TABLE `things`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`user_id`);

--
-- Index pour la table `timeControls`
--
ALTER TABLE `timeControls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`) USING BTREE;

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- Index pour la table `windows`
--
ALTER TABLE `windows`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT pour la table `callbacks`
--
ALTER TABLE `callbacks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `channels`
--
ALTER TABLE `channels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1289007;
--
-- AUTO_INCREMENT pour la table `failed_logins`
--
ALTER TABLE `failed_logins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `feeds`
--
ALTER TABLE `feeds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46225;
--
-- AUTO_INCREMENT pour la table `Matlab_Visu`
--
ALTER TABLE `Matlab_Visu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `reacts`
--
ALTER TABLE `reacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT pour la table `scripts`
--
ALTER TABLE `scripts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `sigfox`
--
ALTER TABLE `sigfox`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT pour la table `sigfox_events`
--
ALTER TABLE `sigfox_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `thinghttps`
--
ALTER TABLE `thinghttps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `things`
--
ALTER TABLE `things`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT pour la table `timeControls`
--
ALTER TABLE `timeControls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT pour la table `windows`
--
ALTER TABLE `windows`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blogs_ibfk_1` FOREIGN KEY (`thing_id`) REFERENCES `things` (`id`);

--
-- Contraintes pour la table `channels`
--
ALTER TABLE `channels`
  ADD CONSTRAINT `channels_ibfk_1` FOREIGN KEY (`thing_id`) REFERENCES `things` (`id`);

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
-- Contraintes pour la table `scripts`
--
ALTER TABLE `scripts`
  ADD CONSTRAINT `scripts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

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
-- Contraintes pour la table `timeControls`
--
ALTER TABLE `timeControls`
  ADD CONSTRAINT `timeControls_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
