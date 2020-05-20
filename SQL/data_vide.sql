-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:3306
-- Généré le :  Mer 20 Mai 2020 à 15:32
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
  `thing_id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
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
  `last_entry_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `channels`
--

INSERT INTO `channels` (`id`, `thing_id`, `name`, `field1`, `field2`, `field3`, `field4`, `field5`, `field6`, `field7`, `field8`, `status`, `write_api_key`, `last_write_at`, `last_entry_id`) VALUES
(539387, 1, 'Tessé - Weather', 'Weight (Kg)', 'Temperature (°C)', 'Pressure (hPa)', 'Humidity (%)', 'Illuminance (Lux)', 'Dew point (°C)', 'Corrected Weight (Kg)', '', '', '8TA0YDI5T5NLCSVV', '2020-05-15 20:00:04', 12331),
(552430, 1, 'Tessé - Daily average', 'Poids', 'Température', 'Pression', 'Humidité', '', '', '', '', '', 'Y3BXR665PTEYRFCG', NULL, NULL),
(556419, 1, 'Tessé - Battery ', 'Voltage (V)', 'Current (A)', 'Power (W)', 'State Of Charge (%)', 'Capacity (Ah)', '', '', '', '', '7VX28B24FEE50ZTO', '2020-05-15 20:00:01', 498),
(558210, 12, 'Oizé - mesures', 'Weight (Kg)', 'Temperature (°C)', 'Pressure (kPa)', 'Humidity (%)', 'Illuminance (lux)', 'dew point (°C)', 'Corrected Weight (kg)', 'Derived Weight (g/h)', '', '3RPCCIIT1JJHM25A', '2020-05-15 20:00:04', 210),
(566173, 2, 'Danemark - Mesures', 'Weight (kg)', 'Temperature (°C)', 'Pressure (kPa)', 'Humidity (%)', 'Illuminance (lux)', 'Dew point (°C)', '', '', '', 'NWIA1TIPGT1L9S39', '2020-05-15 20:00:06', 15934),
(569228, 12, 'Oizé - Derived weight', 'derived weight (Kg/h)', '', '', '', '', '', '', '', '', 'OH5D06IUTUJ7ZAV9', NULL, NULL),
(602082, 10, 'Beaufay - Battery ', 'Tension (V)', 'Courant (A)', 'Puissance (W)', 'SOC (%)', '', '', '', '', '', 'BUNNFRUOOIJ4HM7X', NULL, NULL),
(622253, 1, 'Le Mans - Weather', 'Temperature (°C)', 'Pressure (hPa)', 'Humidity (%)', 'Wind speed (m/s)', 'Wind direction (°)', 'dew point (°C)', '', '', '', 'CPO5W1BNMG44EVC1', '2020-05-15 20:00:03', 243),
(684316, 2, 'Danemark Derived weight', 'derived weight (Kg/h)', '', '', '', '', '', '', '', '', '3EVVIU67Z14GDQHU', NULL, NULL),
(752839, 3, 'France - Mesures', 'Weight (kg)', 'Temperature (°C)', 'Pressure (kPa)', 'Humidity (%)', 'Illuminance (lux)', 'Dew point (°C)', 'Corrected Weight (kg)', '', '', 'OES0BIVP60Q61248', '2020-05-15 20:00:06', 15131),
(752841, 10, 'Beaufay - Derived  Weight ', 'derived weight (Kg/h)', '', '', '', '', '', '', '', '', 'AVKOTCZ049Z420QC', NULL, NULL),
(752843, 10, 'Beaufay - mesures', 'Weight (Kg)', 'Temperature (°C)', 'Pressure (hPa)', 'Humidity (%)', 'Illuminance (Lux)', 'Dew point (°C)', 'Corrected Weight (Kg)', '', '', 'MEUSWB77H6MMRFHD', NULL, NULL),
(788567, 3, 'France - Derived weight', 'derived weight (Kg/h)', '', '', '', '', '', '', '', '', '3RSFQ81I81H1RBSN', NULL, NULL);

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
(7, 'root', '4c84cbcdd5753037e19ef1dd6534b498fc5554ebf2b0e00333f309c2257f4ac6', '88.138.63.59', '2020-05-05 09:16:02'),
(8, 'root', 'e009f211469d247f425262fefc47ee269bb6e19749e39d2a39a4eb0244ccf4a4', '88.138.63.59', '2020-05-05 09:18:19'),
(9, 'ruche', '9120f78e3582caf2d3896ad0da948ed9dbeb0927a7c3c323d62d02b9d16d111d', '88.138.63.59', '2020-05-05 09:19:38'),
(10, 'admin', 'd5b7f78a77e704ed2d3ec3780a2cc255c3f8cf182a784d8b03a61033638941fd', '88.138.63.59', '2020-05-05 09:20:16');

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

--
-- Contenu de la table `Matlab_Visu`
--

INSERT INTO `Matlab_Visu` (`id`, `things_id`, `thing_speak_id`, `name`) VALUES
(1, 3, 291595, 'Poids Température'),
(2, 3, 291596, 'Histogramme'),
(3, 3, 291615, 'Humidity / Temperature'),
(4, 1, 257736, 'Wind speed compass'),
(5, 3, 257736, 'Wind speed compass'),
(6, 1, 256601, 'Histogram Temperature'),
(7, 2, 256962, 'Histogram Temperature');

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

--
-- Contenu de la table `reacts`
--

INSERT INTO `reacts` (`id`, `user_id`, `name`, `react_type`, `run_interval`, `run_on_insertion`, `last_run_at`, `channel_id`, `field_number`, `condition`, `condition_value`, `actionable_id`, `last_result`, `actionable_type`, `action_value`, `latest_value`, `run_action_every_time`) VALUES
(1, 2, 'Batterie déchargée', 'numeric', 0, 1, NULL, 556419, 4, 'lte', 10, 11, 0, 'thingHTTP', NULL, NULL, 0),
(3, 1, 'Essaimage ', 'numeric', 0, 1, NULL, 684316, 1, 'lte', -0.5, 7, NULL, 'thingHTTP', NULL, NULL, 0),
(4, 0, 'Batterie chargée', 'numeric', 0, 1, '2020-05-15 09:10:01', 556419, 4, 'eq', 100, 8, 0, 'thingHTTP', 100, NULL, 0),
(7, 2, 'Réagir poids > 50', 'numeric', 0, 1, '2020-05-10 16:30:05', 566173, 1, 'gt', 50, 9, 0, 'thingHTTP', 50.06, NULL, 0),
(8, 2, 'Réagir température', 'numeric', 0, 1, '2020-05-15 18:30:07', 752839, 2, 'lt', 20, 10, 1, 'thingHTTP', 19.47, NULL, 0),
(9, 0, 'Il fait jour', 'numeric', 0, 1, NULL, 539387, 1, 'gt', 0, 1, 0, '', NULL, NULL, 0),
(11, 0, 'tension battery', 'numeric', 0, 1, NULL, 556419, 1, 'gt', 13.6, 8, NULL, 'thingHTTP', NULL, NULL, 0),
(14, 0, 'France not updated', 'nodata', 60, 0, NULL, 752839, 0, '', 60, 6, NULL, 'thingHTTP', NULL, NULL, 0),
(15, 0, 'React', 'nodata', 60, 0, NULL, 752843, 0, '', 60, 2, NULL, 'thingHTTP', NULL, NULL, 0);

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

--
-- Contenu de la table `thinghttps`
--

INSERT INTO `thinghttps` (`id`, `user_id`, `api_key`, `url`, `auth_name`, `auth_pass`, `method`, `content_type`, `http_version`, `host`, `body`, `name`, `parse`, `created_at`) VALUES
(1, 0, 'RXP8L3RLIKD8DP', 'https://philippes.ddns.net/Ruche/api/sendSMS', '', '', 'POST', '', '1.1', '', 'key=RC8IK9LVVYEYZNSM&number=0652472542&message=Ruche%20France%20%3A%20Variation%20du%20poids%20%C3%A0%20la%20hausse%20anormale%20!', 'SMS - Hausse du poids anormale - Ruche France', '', '2019-09-08 20:40:26'),
(2, 0, '7VLDVNRIBAGP2', 'http://example.com/', '', '', 'GET', '', '1.1', '', '', 'GET Example.com', '', '2019-09-08 20:42:50'),
(3, 0, 'IS6AQF071HK', 'http://172.18.58.14/adm/', 'root', 'cestyvette', 'GET', '', '1.1', '', '', 'Backend ENT SNIR', '', '2019-09-09 14:40:51'),
(4, 0, 'VC7LTROTMUW', 'https://api.thingspeak.com/channels/12397/feeds.json?results=1', '', '', 'GET', '', '1.1', '', '', 'MathWorks Weather Station', '', '2019-09-09 20:23:49'),
(6, 0, 'HES1V3RUMSZ', 'http://404.php.net/', '', '', 'GET', '', '1.0', '', '', 'Essai avec URL inexistante', '', '2019-09-15 19:59:39'),
(7, 2, 'NS38L9AQSZVT', 'http://touchardinforeseau.servehttp.com/Ruche/api/sendSMS', '', '', 'POST', '', '1.0', '', 'key=RC8IK9LVVYEYZNSM&number=0689744235&message=Alerte Ruche Danemark : Essaimage ou perte de poids importante !', 'Envoyer un SMS Essaimage  à Philippe', '', '2020-05-08 16:26:36'),
(8, 2, 'MSN32ACRMY48PK', 'http://touchardinforeseau.servehttp.com/Ruche/api/sendSMS', '', '', 'POST', 'application/x-www-form-urlencoded', '1.0', '', 'key=RC8IK9LVVYEYZNSM&number=0689744235&message= La batterie est totalement chargée  !', 'Envoyer un SMS Batterie chargée à Philippe', '', '2020-05-08 16:33:30'),
(9, 0, 'JK2RVDDJC5F92', 'http://touchardinforeseau.servehttp.com/Ruche/api/sendSMS', '', '', 'POST', 'application/x-www-form-urlencoded', '1.0', '', 'key=RC8IK9LVVYEYZNSM&number=0689744235&message= La ruche Danemark pèse plus de 50kg.', 'Envoyer SMS à philippe ruche Danemark > 50Kg', '', '2020-05-10 12:12:30'),
(10, 2, 'O74BY1BLTLB', 'http://touchardinforeseau.servehttp.com/Ruche/api/sendSMS', '', '', 'POST', 'application/x-www-form-urlencoded', '1.0', '', 'key=RC8IK9LVVYEYZNSM&number=0689744235&message= La température mesurée sur ruche France est inférieur à 20°C  !\r\n', 'Envoyer SMS Notification temp < 20°C ', '', '2020-05-10 12:21:38'),
(11, 2, 'MLG4K7MQII', 'http://touchardinforeseau.servehttp.com/Ruche/api/sendSMS', '', '', 'POST', 'application/x-www-form-urlencoded', '1.1', '', 'key=9L0V9YXONAUJ0QRH&number=0689744235&message=Alerte  Batterie faible, le taux de charge est de 10%.', 'Envoyer SMS batterie déchargée ', '', '2020-05-13 20:33:08');

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
  `class` varchar(20) NOT NULL DEFAULT 'objet'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

--
-- Contenu de la table `things`
--

INSERT INTO `things` (`id`, `user_id`, `latitude`, `longitude`, `elevation`, `name`, `tag`, `status`, `local_ip_address`, `class`) VALUES
(1, 2, '48.010101', '0.206052', 50, 'Weather station Tessé', 'weather', 'public', '192.168.1.10 /24', 'weather'),
(2, 2, '47.994801', '0.205072', 48.9, 'Ruche Danemark', 'danemark', 'public', '172.18.58.106 /24', 'ruche'),
(3, 1, '47.994946', '0.204605', 49.4, 'Ruche France', 'france', 'public', '172.18.58.219 /24', 'ruche'),
(5, 2, '47.995499', '0.202465', 49.3, 'Gateway-SMS', 'gateway', 'private', '172.18.58.9 /24', 'objet'),
(6, 0, '47.995532', '0.202465', 49.3, 'Webcam', 'Webcam', 'private', '172.18.58.253 /24', 'objet'),
(9, 8, '47.995529', '0.204182', 60.5, 'objet_GPS', 'GPS', 'private', '172.18.58.211 /24', 'objet'),
(10, 2, '48.146652', '0.363191', 94.9, 'Ruche Beaufay', 'Beaufay', 'private', '172.18.58.221 /24', 'ruche'),
(12, 2, '47.809683', '0.103687', 76.7, 'Ruche Oizé', 'Oizé', 'private', '172.18.58.220 /24', 'ruche');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `login`, `encrypted_password`, `password_salt`, `email`, `telNumber`, `User_API_Key`, `Created_at`, `sign_in_count`, `last_sign_in_at`, `current_sign_in_at`, `time_zone`, `quotaSMS`, `delaySMS`, `allow`, `droits`, `reset_password_token`, `language`) VALUES
(0, 'root', 'ab8aad96434275bef18eac0523e9c7787fff10b7efdd0865e534836a4365fb0a', 'UI358LPHPA5B1J6TWA62', 'philaure@wanadoo.fr', '0689744235', 'RDIK9LVVYEYZYZER', '2019-08-11 10:42:44', 475, '2020-05-20 06:39:48', '2020-05-20 09:36:21', 'Europe/Paris', 140, 15, 1, 2, NULL, 'FR'),
(1, 'touchard', 'f786d8bab1d85e1be8ccf62d7adb58f503b6a605c4859f985e4f7dc092aec425', '3O6HAE3T7D3TCX661E8E', '', NULL, 'RC8IK9LVVYEYZNSM', '2019-06-18 11:40:56', 15, '2020-01-23 07:45:44', '2020-05-07 17:37:30', 'Europe/Paris', 140, 15, 1, 1, NULL, 'FR'),
(2, 'philippe', '089f509603f388d3509b303e340c56db29b6774f69a816d073f5be67bde6e5dd', 'ZGNGYYXORKXMLVWW98FZ', 'philippe.simier@ac-nantes.fr', '+33689744235', '9L0V9YXONAUJ0QRH', '2019-06-18 11:40:56', 37, '2020-05-13 20:30:51', '2020-05-14 07:11:28', 'Europe/Paris', 140, 15, 1, 1, NULL, 'FR'),
(3, 'alecren', '31f7a65e315586ac198bd798b6629ce4903d0899476d5741a9f32e2e521b6a66', NULL, '', '', 'JCCJDPMAF6WRHX', '2019-09-11 08:03:34', 0, '0000-00-00 00:00:00', NULL, 'Europe/Paris', 150, 15, 1, 1, NULL, 'EN'),
(4, 'Gabrielle', '31f7a65e315586ac198bd798b6629ce4903d0899476d5741a9f32e2e521b6a66', NULL, '', '0602154829', '28SL7HN0ZR6UF', '2020-01-16 07:51:28', 3, '2020-01-23 15:27:11', '2020-03-12 07:13:50', 'Europe/Paris', 151, 16, 1, 1, NULL, 'FR'),
(8, 'toto', '31f7a65e315586ac198bd798b6629ce4903d0899476d5741a9f32e2e521b6a66', NULL, '', '', 'O7VZJ5LOABU', '2020-01-24 09:24:01', 56, '2020-05-14 11:30:44', '2020-05-14 13:03:47', 'Europe/Paris', 250, 1, 1, 1, NULL, 'FR'),
(10, 'didier', '2fd887facce086740cd630d26c79ec00821606047ee56580a6c987aed857889a', NULL, '', NULL, 'TAJ9TRD82EELDSP2', '2020-03-25 08:17:00', 4, '2020-04-15 21:15:15', '2020-04-15 21:33:06', 'Europe/Paris', 40, 5, 1, 1, NULL, 'FR'),
(11, 'Robert', 'a7adc1494b9d93b940d29f1648b9774b0bf1078ae7432abafc7c6c12e213e97e', '963PBS76FYCTE1ETP2IG', NULL, NULL, 'YHLANG33DRAV', '2020-04-17 19:54:14', 1, '2020-04-17 19:56:54', '2020-04-17 19:56:54', 'UTC', 140, 15, 0, 1, NULL, 'FR');

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
-- Structure de la vue `login_things`
--
DROP TABLE IF EXISTS `login_things`;

CREATE ALGORITHM=UNDEFINED DEFINER=`ruche`@`%` SQL SECURITY DEFINER VIEW `login_things`  AS  select `things`.`id` AS `id`,`users`.`login` AS `login`,`things`.`name` AS `name`,`things`.`tag` AS `tag`,`things`.`status` AS `status`,`things`.`local_ip_address` AS `local_ip_address` from (`things` join `users`) where `things`.`user_id` = `users`.`id` ;

-- --------------------------------------------------------

--
-- Structure de la vue `users_channels`
--
DROP TABLE IF EXISTS `users_channels`;

CREATE ALGORITHM=UNDEFINED DEFINER=`ruche`@`%` SQL SECURITY DEFINER VIEW `users_channels`  AS  select `channels`.`id` AS `id`,`channels`.`name` AS `name`,`things`.`tag` AS `tags`,`channels`.`write_api_key` AS `write_api_key`,`channels`.`last_entry_id` AS `last_entry_id`,`channels`.`last_write_at` AS `last_write_at`,`users`.`id` AS `user_id`,`users`.`login` AS `login` from ((`channels` join `things`) join `users`) where `channels`.`thing_id` = `things`.`id` and `things`.`user_id` = `users`.`id` ;

-- --------------------------------------------------------

--
-- Structure de la vue `users_things`
--
DROP TABLE IF EXISTS `users_things`;

CREATE ALGORITHM=UNDEFINED DEFINER=`ruche`@`%` SQL SECURITY DEFINER VIEW `users_things`  AS  select `things`.`id` AS `id`,`things`.`name` AS `name`,`users`.`User_API_Key` AS `USER_API_Key`,`things`.`tag` AS `tag` from (`things` join `users`) where `things`.`user_id` = `users`.`id` ;

-- --------------------------------------------------------

--
-- Structure de la vue `vue_reacts`
--
DROP TABLE IF EXISTS `vue_reacts`;

CREATE ALGORITHM=UNDEFINED DEFINER=`ruche`@`%` SQL SECURITY DEFINER VIEW `vue_reacts`  AS  select `reacts`.`id` AS `id`,`reacts`.`react_type` AS `react_type`,`users`.`login` AS `login`,`reacts`.`name` AS `name`,`channels`.`name` AS `channelCheck`,`channels`.`id` AS `channelId`,`reacts`.`field_number` AS `field_number`,`reacts`.`condition` AS `condition`,`reacts`.`condition_value` AS `condition_value`,`thinghttps`.`name` AS `actionName` from (((`users` join `channels`) join `reacts`) join `thinghttps`) where `channels`.`id` = `reacts`.`channel_id` and `reacts`.`actionable_id` = `thinghttps`.`id` and `users`.`id` = `reacts`.`user_id` ;

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
-- Index pour la table `thinghttps`
--
ALTER TABLE `thinghttps`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `things`
--
ALTER TABLE `things`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`user_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `channels`
--
ALTER TABLE `channels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=788572;
--
-- AUTO_INCREMENT pour la table `failed_logins`
--
ALTER TABLE `failed_logins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT pour la table `feeds`
--
ALTER TABLE `feeds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54662;
--
-- AUTO_INCREMENT pour la table `Matlab_Visu`
--
ALTER TABLE `Matlab_Visu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `reacts`
--
ALTER TABLE `reacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT pour la table `thinghttps`
--
ALTER TABLE `thinghttps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `things`
--
ALTER TABLE `things`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
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
-- Contraintes pour la table `things`
--
ALTER TABLE `things`
  ADD CONSTRAINT `things_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
