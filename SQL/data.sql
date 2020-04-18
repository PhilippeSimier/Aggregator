-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u6
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mer 15 Avril 2020 à 09:56
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
  `status` varchar(11) NOT NULL,
  `tags` varchar(50) DEFAULT NULL,
  `write_api_key` varchar(50) DEFAULT NULL,
  `last_write_at` timestamp NULL DEFAULT NULL,
  `last_entry_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=788569 DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `channels`
--

INSERT INTO `channels` (`id`, `name`, `field1`, `field2`, `field3`, `field4`, `field5`, `field6`, `field7`, `field8`, `status`, `tags`, `write_api_key`, `last_write_at`, `last_entry_id`) VALUES
(539387, 'Weather - Tessé', ' --', 'Temperature (°C)', 'Pressure (hPa)', 'Humidity (%)', 'Illuminance (Lux)', 'Dew point (°C)', '--', '', '', 'weather', '8TA0YDI5T5NLCSVV', '2020-04-11 17:30:17', 63),
(552430, 'Moyenne Journalière', 'Poids', 'Température', 'Pression', 'Humidité', '', '', '', '', '', 'weather', 'Y3BXR665PTEYRFCG', NULL, NULL),
(556419, 'Battery', 'Voltage (V)', 'Current (A)', 'Power (W)', 'State Of Charge (%)', 'Capacity (Ah)', '', '', '', '', 'weather', '7VX28B24FEE50ZTO', NULL, NULL),
(558210, 'Mesures - Tests', 'Weight (Kg)', 'Temperature (°C)', 'Pressure (kPa)', 'Humidity (%)', 'Illuminance (lux)', 'dew point (°C)', 'Corrected Weight (kg)', 'Derived Weight (g/h)', '', 'test', '3RPCCIIT1JJHM25A', NULL, NULL),
(566173, 'Mesures Danemark', 'Weight (kg)', 'Temperature (°C)', 'Pressure (kPa)', 'Humidity (%)', 'Illuminance (lux)', 'Dew point (°C)', 'Corrected Weight (Kg)', '', 'actif', 'danemark', 'NWIA1TIPGT1L9S39', NULL, NULL),
(569228, 'Dérivée poids Test', 'Dérivée poids Test', '', '', '', '', '', '', '', '', 'test', 'OH5D06IUTUJ7ZAV9', NULL, NULL),
(602082, 'Tests unitaires', 'Echelon', 'Sinus', 'Carré', '--', '--', '--', '--', '', '', 'weather', 'BUNNFRUOOIJ4HM7X', NULL, NULL),
(622253, 'Weather Le Mans', 'Temperature (°C)', 'Pressure (hPa)', 'Humidity (%)', 'Wind speed (m/s)', 'Wind direction (°)', 'dew point (°C)', '', '', '', 'france', 'MEUSWB77H6MMRFHD', NULL, NULL),
(684316, 'Derivée poids', 'derivée (Kg/h)', '', '', '', '', '', '', '', '', 'danemark', '3EVVIU67Z14GDQHU', NULL, NULL),
(752839, 'Mesures - France', 'Weight (kg)', 'Temperature (°C)', 'Pressure (kPa)', 'Humidity (%)', 'Illuminance (lux)', 'Dew point (°C)', 'Corrected Weight (kg)', '', '', 'france', 'OES0BIVP60Q61248', NULL, NULL),
(752841, 'Battery - France', 'Voltage (V)', 'Curent (A)', 'Power (W)', 'State of charge (%)', 'Capacity (Ah)', '', '', '', '', 'france', 'AVKOTCZ049Z420QC', NULL, NULL),
(788567, 'Derived weight - France', 'derived weight (Kg/h)', '', '', '', '', '', '', '', '', 'france', '3RSFQ81I81H1RBSN', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `failed_logins`
--

CREATE TABLE IF NOT EXISTS `failed_logins` (
`id` int(11) NOT NULL,
  `login` varchar(25) NOT NULL,
  `password` varchar(128) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `failed_logins`
--

INSERT INTO `failed_logins` (`id`, `login`, `password`, `ip_address`, `created_at`) VALUES
(2, 'test', '71b4e190fc7a0aa86f24cb18d88c09bfd8a45292f1ae434fac3c0351f4d838d3', '90.12.147.179', '2020-04-14 12:59:35'),
(3, 'root', '31f7a65e315586ac198bd798b6629ce4903d0899476d5741a9f32e2e521b6a66', '90.12.147.179', '2020-04-14 13:07:15'),
(4, 'bidochon', 'd4b3dfbf113cc8b2f6fd71bcb24b761d04b47c04a59b22a2a7db91b275542892', '92.184.117.172', '2020-04-14 13:34:08'),
(5, 'bidochon', '31f7a65e315586ac198bd798b6629ce4903d0899476d5741a9f32e2e521b6a66', '92.184.117.172', '2020-04-14 13:34:35'),
(6, 'Bidochon', '31f7a65e315586ac198bd798b6629ce4903d0899476d5741a9f32e2e521b6a66', '92.184.117.172', '2020-04-14 13:34:53'),
(7, 'bidochon', '31f7a65e315586ac198bd798b6629ce4903d0899476d5741a9f32e2e521b6a66', '92.184.117.172', '2020-04-14 13:37:53');

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
  `latitude` decimal(15,10) DEFAULT NULL,
  `longitude` decimal(15,10) DEFAULT NULL,
  `elevation` double DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1688 DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `feeds`
--

INSERT INTO `feeds` (`id`, `id_channel`, `field1`, `field2`, `field3`, `field4`, `field5`, `field6`, `field7`, `field8`, `date`, `status`, `latitude`, `longitude`, `elevation`) VALUES
(1625, 539387, NULL, 22.28, 1024.87, 28.2568, 440.417, 3.07, NULL, NULL, '2019-09-18 13:02:17', '', NULL, NULL, NULL),
(1626, 539387, NULL, 22.11, 1024.76, 28.8916, 380.417, 3.16, NULL, NULL, '2019-09-18 13:32:19', '', NULL, NULL, NULL),
(1627, 539387, NULL, 21.7, 1024.61, 28.1289, 322.083, 2.77, NULL, NULL, '2019-09-18 14:02:16', '', NULL, NULL, NULL),
(1628, 539387, NULL, 21.22, 1024.64, 28.9033, 257.917, 2.47, NULL, NULL, '2019-09-18 14:32:18', '', NULL, NULL, NULL),
(1629, 539387, NULL, 20.66, 1024.63, 30.4365, 191.25, 2.78, NULL, NULL, '2019-09-18 15:01:23', '', NULL, NULL, NULL),
(1630, 539387, NULL, 20.21, 1024.93, 32.082, 113.75, 3.22, NULL, NULL, '2019-09-18 15:30:54', '', NULL, NULL, NULL),
(1631, 539387, NULL, 19.44, 1025.13, 33.8799, 25.4167, 3.1, NULL, NULL, '2019-09-18 16:00:53', '', NULL, NULL, NULL),
(1632, 539387, NULL, 18.84, 1025.25, 35.5732, 0, 3.22, NULL, NULL, '2019-09-18 16:32:17', '', NULL, NULL, NULL),
(1633, 539387, NULL, 18.4, 1025.67, 36.5156, 0, 3.3, NULL, NULL, '2019-09-18 17:01:22', '', NULL, NULL, NULL),
(1634, 539387, NULL, 17.94, 1026.01, 37.5947, 0, 3.23, NULL, NULL, '2019-09-18 17:30:32', '', NULL, NULL, NULL),
(1635, 539387, NULL, 17.52, 1026.4, 38.9023, 0, 3.35, NULL, NULL, '2019-09-18 18:02:13', '', NULL, NULL, NULL),
(1636, 539387, NULL, 17.18, 1026.7, 39.7676, 0, 3.42, NULL, NULL, '2019-09-18 18:30:22', '', NULL, NULL, NULL),
(1637, 539387, NULL, 16.78, 1026.95, 41.4297, 0, 3.68, NULL, NULL, '2019-09-18 19:01:13', '', NULL, NULL, NULL),
(1638, 539387, NULL, 16.36, 1027.12, 43.1465, 0, 3.77, NULL, NULL, '2019-09-18 19:32:20', '', NULL, NULL, NULL),
(1639, 539387, NULL, 16.01, 1027.24, 44.5391, 0, 4.02, NULL, NULL, '2019-09-18 20:02:17', '', NULL, NULL, NULL),
(1640, 539387, NULL, 15.76, 1027.41, 45.3848, 0, 4.01, NULL, NULL, '2019-09-18 20:30:55', '', NULL, NULL, NULL),
(1641, 539387, NULL, 15.53, 1027.53, 46.4785, 0, 4.15, NULL, NULL, '2019-09-18 21:01:33', '', NULL, NULL, NULL),
(1642, 539387, NULL, 15.29, 1027.64, 47.5693, 0, 4.32, NULL, NULL, '2019-09-18 21:30:32', '', NULL, NULL, NULL),
(1643, 539387, NULL, 15.05, 1027.45, 48.2539, 0, 4.19, NULL, NULL, '2019-09-18 22:01:35', '', NULL, NULL, NULL),
(1644, 539387, NULL, 14.77, 1027.52, 49.2402, 0, 4.26, NULL, NULL, '2019-09-18 22:30:32', '', NULL, NULL, NULL),
(1645, 539387, NULL, 14.33, 1027.51, 51.2207, 0, 4.42, NULL, NULL, '2019-09-18 23:01:04', '', NULL, NULL, NULL),
(1646, 539387, NULL, 14.04, 1027.42, 53.3604, 0, 4.59, NULL, NULL, '2019-09-18 23:30:32', '', NULL, NULL, NULL),
(1647, 539387, NULL, 13.52, 1027.47, 55.4072, 0, 4.77, NULL, NULL, '2019-09-19 00:02:15', '', NULL, NULL, NULL),
(1648, 539387, NULL, 13.24, 1027.48, 57.3242, 0, 5.01, NULL, NULL, '2019-09-19 00:30:13', '', NULL, NULL, NULL),
(1649, 539387, NULL, 12.86, 1027.53, 59.8887, 0, 5.28, NULL, NULL, '2019-09-19 01:01:02', '', NULL, NULL, NULL),
(1650, 539387, NULL, 12.63, 1027.49, 61.7441, 0, 5.5, NULL, NULL, '2019-09-19 01:30:33', '', NULL, NULL, NULL),
(1651, 539387, NULL, 12.4, 1027.53, 62.8086, 0, 5.54, NULL, NULL, '2019-09-19 02:01:36', '', NULL, NULL, NULL),
(1652, 539387, NULL, 12.12, 1027.53, 64.709, 0, 5.74, NULL, NULL, '2019-09-19 02:32:16', '', NULL, NULL, NULL),
(1653, 539387, NULL, 12.01, 1027.5, 65.6855, 4.58333, 5.76, NULL, NULL, '2019-09-19 03:00:13', '', NULL, NULL, NULL),
(1654, 539387, NULL, 11.94, 1027.53, 66.3506, 3.33333, 5.87, NULL, NULL, '2019-09-19 03:31:23', '', NULL, NULL, NULL),
(1655, 539387, NULL, 11.9, 1027.59, 66.5771, 93.3333, 5.88, NULL, NULL, '2019-09-19 04:01:04', '', NULL, NULL, NULL),
(1656, 539387, NULL, 27.36, 1012.94, 42.7979, 3312.5, 13.7, NULL, NULL, '2019-09-21 08:00:06', '', NULL, NULL, NULL),
(1657, 539387, NULL, 17.26, 1016.04, 71.5928, 0, 12.11, NULL, NULL, '2019-09-27 17:02:19', '', NULL, NULL, NULL),
(1658, 539387, NULL, 14.07, 1013.48, 78.3096, 0, 10.34, NULL, NULL, '2019-10-15 18:00:04', '', NULL, NULL, NULL),
(1659, 539387, NULL, 13.92, 1013.6, 80.332, 0, 10.55, NULL, NULL, '2019-10-15 18:30:06', '', NULL, NULL, NULL),
(1660, 539387, NULL, 11.8, 1015.94, 100, 0, 11.79, NULL, NULL, '2019-10-31 03:00:04', '', NULL, NULL, NULL),
(1661, 539387, NULL, 11.94, 1015.98, 100, 0, 11.93, NULL, NULL, '2019-10-31 03:30:04', '', NULL, NULL, NULL),
(1662, 539387, NULL, 12.06, 1015.88, 100, 0, 12.03, NULL, NULL, '2019-10-31 04:00:06', '', NULL, NULL, NULL),
(1663, 539387, NULL, 11.97, 1006.7, 87.4561, 6.66667, 9.92, NULL, NULL, '2019-11-06 15:30:06', '', NULL, NULL, NULL),
(1664, 539387, NULL, 11.28, 1009.54, 99.917, 612.083, 11.26, NULL, NULL, '2019-11-11 10:30:06', '', NULL, NULL, NULL),
(1665, 539387, NULL, 6.62, 1012.69, 75.5283, 1084.17, 2.62, NULL, NULL, '2019-11-20 10:02:14', '', NULL, NULL, NULL),
(1666, 539387, NULL, 6.92, 1012.15, 75.2734, 964.583, 2.86, NULL, NULL, '2019-11-20 10:32:16', '', NULL, NULL, NULL),
(1667, 539387, NULL, 7.82, 1011.65, 73.6182, 881.667, 3.39, NULL, NULL, '2019-11-20 11:02:13', '', NULL, NULL, NULL),
(1668, 539387, NULL, 11.42, 999.617, 99.9287, 0, 11.4, NULL, NULL, '2019-11-27 21:02:18', '', NULL, NULL, NULL),
(1669, 539387, NULL, 11.4, 999.713, 100, 0, 11.37, NULL, NULL, '2019-11-27 21:32:16', '', NULL, NULL, NULL),
(1670, 539387, NULL, 11.39, 999.624, 100, 0, 11.37, NULL, NULL, '2019-11-27 22:02:18', '', NULL, NULL, NULL),
(1671, 539387, NULL, 11.3, 999.753, 100, 0, 11.29, NULL, NULL, '2019-11-27 22:32:20', '', NULL, NULL, NULL),
(1672, 539387, NULL, 5.76, 1012.95, 100, 0, 5.74, NULL, NULL, '2019-12-01 01:30:04', '', NULL, NULL, NULL),
(1673, 539387, NULL, 7.65, 1017.52, 100, 183.333, 7.64, NULL, NULL, '2019-12-06 12:30:04', '', NULL, NULL, NULL),
(1674, 539387, NULL, 8.58, 1017.21, 100, 92.5, 8.54, NULL, NULL, '2019-12-06 13:30:03', '', NULL, NULL, NULL),
(1675, 539387, NULL, 3.13, 1030.56, 100, 0, 3.1, NULL, NULL, '2019-12-10 03:30:05', '', NULL, NULL, NULL),
(1676, 539387, NULL, 11.54, 1029.35, 100, 0, 11.53, NULL, NULL, '2020-01-07 23:02:17', '', NULL, NULL, NULL),
(1677, 539387, NULL, 8.61, 1026.82, 100, 0, 8.6, NULL, NULL, '2020-01-12 23:33:41', '', NULL, NULL, NULL),
(1678, 539387, NULL, 409.49, 1524.28, 100, 0, 409.47, NULL, NULL, '2020-01-22 04:32:16', '', NULL, NULL, NULL),
(1679, 539387, NULL, 3.36, 1030.12, 85.2471, 14.1667, 1.19, NULL, NULL, '2020-01-23 08:30:26', '', NULL, NULL, NULL),
(1680, 539387, NULL, 4.4, 1023.75, 100, 0, 4.38, NULL, NULL, '2020-02-12 05:32:16', '', NULL, NULL, NULL),
(1681, 539387, NULL, 0, 0, 0, 725, NULL, NULL, NULL, '2020-02-17 13:30:17', '', NULL, NULL, NULL),
(1682, 539387, NULL, 19.43, 1020.39, 42.7471, 1960, 6.47, NULL, NULL, '2020-03-28 14:30:22', '', NULL, NULL, NULL),
(1683, 539387, NULL, 14.74, 1018.58, 28.751, 483.333, -3.12, NULL, NULL, '2020-04-01 14:00:17', '', NULL, NULL, NULL),
(1684, 539387, NULL, 16.14, 1024.24, 94.8193, 654.583, 15.31, NULL, NULL, '2020-04-06 14:30:24', '', NULL, NULL, NULL),
(1685, 539387, NULL, 26.55, 1021.56, 22.4385, 784.167, 3.6, NULL, NULL, '2020-04-10 11:30:16', '', NULL, NULL, NULL),
(1686, 539387, NULL, 26.26, 1021.36, 23.1172, 529.583, 3.62, NULL, NULL, '2020-04-10 12:00:22', '', NULL, NULL, NULL),
(1687, 539387, NULL, 25.32, 1020.63, 23.1816, 294.583, 2.84, NULL, NULL, '2020-04-11 15:30:17', '', NULL, NULL, NULL);

--
-- Déclencheurs `feeds`
--
DELIMITER //
CREATE TRIGGER `after_insert_feeds` AFTER INSERT ON `feeds`
 FOR EACH ROW UPDATE `channels` 
SET `last_entry_id`= (SELECT count(*) FROM `feeds` WHERE `id_channel` = NEW.id_channel) , 
`last_write_at`=NOW() 
WHERE `id` = NEW.id_channel
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `login_things`
--
CREATE TABLE IF NOT EXISTS `login_things` (
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
-- Structure de la table `reacts`
--

CREATE TABLE IF NOT EXISTS `reacts` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `run_interval` int(11) DEFAULT NULL,
  `run_on_insertion` tinyint(1) NOT NULL DEFAULT '0',
  `last_run_at` timestamp NULL DEFAULT NULL,
  `channel_id` int(11) DEFAULT NULL,
  `field_number` int(11) NOT NULL,
  `condition` varchar(15) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `condition_value` float NOT NULL,
  `actionable_id` int(11) NOT NULL,
  `last_result` int(11) NOT NULL,
  `actionable_type` varchar(15) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'Thinghttp',
  `action_value` float NOT NULL,
  `latest_value` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `thinghttps`
--

CREATE TABLE IF NOT EXISTS `thinghttps` (
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
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `thinghttps`
--

INSERT INTO `thinghttps` (`id`, `user_id`, `api_key`, `url`, `auth_name`, `auth_pass`, `method`, `content_type`, `http_version`, `host`, `body`, `name`, `parse`, `created_at`) VALUES
(1, 1, 'BNVZU7JHUHUEQAP1', 'https://philippes.ddns.net/Ruche/api/sendSMS', '', '', 'POST', 'application/x-www-form-urlencoded', '1.1', '', 'key=RC8IK9LVVYEYZNSM&number=0689744235&message=Ruche France : Variation du poids à  la hausse anormale !', 'SMS - Hausse du poids anormale - Ruche France', '', '2019-09-08 16:09:42'),
(2, 2, 'AZERTYUIOP', 'http://example.com/', 'toto', 'toto', 'GET', '', '1.1', '', '', 'GET Example.com', '', '2019-09-08 18:18:25'),
(4, 0, 'FPAC2971PZDGB2', 'http://touchardinforeseau.servehttp.com/Ruche/api/sendSMS', '', '', 'POST', 'application/x-www-form-urlencoded', '1.1', '', 'key=RC8IK9LVVYEYZNSM&number=0689744235&message=Ruche%20France%20%3A%20Variation%20du%20poids%20%C3%A0%20la%20hausse%20anormale%20!', 'Send SMS with API DMZ', '', '2019-09-15 07:30:21'),
(5, 0, 'GG58UUU72V02K', 'http://404.php.net/', '', '', 'GET', '', '1.0', '', '', 'Essai avec URL inexistante', '', '2019-09-15 20:02:27');

-- --------------------------------------------------------

--
-- Structure de la table `things`
--

CREATE TABLE IF NOT EXISTS `things` (
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `things`
--

INSERT INTO `things` (`id`, `user_id`, `latitude`, `longitude`, `elevation`, `name`, `tag`, `status`, `local_ip_address`, `class`) VALUES
(1, 2, 48.010101, 0.206052, 70.2, 'Weather station Tessé', 'weather', 'public', '192.168.1.10 /24', 'weather'),
(2, 2, 47.994862, 0.205088, 49, 'Ruche Danemark', 'danemark', 'public', '172.18.58.106 /24', 'objet'),
(3, 1, 47.994900, 0.204600, 70.2, 'Ruche France', 'france', 'public', '172.18.58.219 /24', 'objet'),
(4, 2, 47.816359, 0.113129, 83.3, 'Ruche Oizé', 'test', 'public', '172.18.58.220 /24', 'objet'),
(11, 0, 47.995533, 0.202465, 49.3, 'Gateway', 'gateway', 'private', '172.18.58.169 /24', 'objet'),
(13, 0, 48.847849, 2.335168, 44, 'Webcam', 'Webcam', 'private', '172.18.58.253 /24', '');

-- --------------------------------------------------------

--
-- Structure de la table `things_channels`
--

CREATE TABLE IF NOT EXISTS `things_channels` (
`id` int(11) NOT NULL,
  `thing_id` int(11) NOT NULL,
  `channel_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `login` varchar(25) NOT NULL,
  `encrypted_password` varchar(128) NOT NULL,
  `email` varchar(100) NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `login`, `encrypted_password`, `email`, `telNumber`, `User_API_Key`, `Created_at`, `sign_in_count`, `last_sign_in_at`, `current_sign_in_at`, `time_zone`, `quotaSMS`, `delaySMS`, `allow`, `droits`, `reset_password_token`) VALUES
(0, 'root', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', '', NULL, 'RDIK9LVVYEYZYZER', '2019-08-11 12:42:44', 242, '2020-04-14 19:10:26', '2020-04-15 05:19:55', 'Europe/Paris', 140, 15, 1, 2, NULL),
(1, 'touchard', '31f7a65e315586ac198bd798b6629ce4903d0899476d5741a9f32e2e521b6a66', '', NULL, 'RC8IK9LVVYEYZNSM', '2019-06-18 20:02:20', 64, '2019-09-08 09:41:45', '2020-04-13 16:36:39', 'Europe/Paris', 0, 0, 1, 1, NULL),
(2, 'philippe', '011311eee2eb1a13e3fb1503397f43f3c7ae184ad30a23c83b102a528c92cb1e', 'philaure@wanadoo.fr', '+33689744235', '9L0V9YXONAUJ0QRH', '0000-00-00 00:00:00', 73, '2020-04-14 19:20:27', '2020-04-15 05:15:28', 'Europe/Paris', 140, 15, 1, 2, NULL),
(4, 'essai', '31f7a65e315586ac198bd798b6629ce4903d0899476d5741a9f32e2e521b6a66', 'l.ziani@st.org', NULL, 'PPE8Z95B409IB', '2020-03-30 16:15:37', 5, '2020-04-13 16:26:21', '2020-04-14 19:34:00', 'UTC', 140, 30, 1, 1, NULL),
(6, 'didier', '2fd887facce086740cd630d26c79ec00821606047ee56580a6c987aed857889a', '', NULL, 'GC6SESWGAIOW0', '2020-03-31 18:58:51', 1, '2020-04-13 16:28:07', '2020-04-13 16:28:07', 'Europe/Paris', 140, 30, 1, 1, NULL),
(7, 'bidochon', '31f7a65e315586ac198bd798b6629ce4903d0899476d5741a9f32e2e521b6a66', 'robertb@gmail.com', '+33612724236', 'A35GZOE7XXZGU8YO', '2020-04-11 09:10:56', 7, '2020-04-14 13:39:12', '2020-04-14 19:18:16', 'Europe/Paris', 140, 15, 0, 1, NULL);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `users_channels`
--
CREATE TABLE IF NOT EXISTS `users_channels` (
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
--
CREATE TABLE IF NOT EXISTS `users_things` (
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

CREATE ALGORITHM=UNDEFINED DEFINER=`ruche`@`localhost` SQL SECURITY DEFINER VIEW `login_things` AS select `things`.`id` AS `id`,`users`.`login` AS `login`,`things`.`name` AS `name`,`things`.`tag` AS `tag`,`things`.`status` AS `status`,`things`.`local_ip_address` AS `local_ip_address` from (`things` join `users`) where (`things`.`user_id` = `users`.`id`);

-- --------------------------------------------------------

--
-- Structure de la vue `users_channels`
--
DROP TABLE IF EXISTS `users_channels`;

CREATE ALGORITHM=UNDEFINED DEFINER=`ruche`@`localhost` SQL SECURITY DEFINER VIEW `users_channels` AS select `channels`.`id` AS `id`,`channels`.`name` AS `name`,`channels`.`tags` AS `tags`,`channels`.`write_api_key` AS `write_api_key`,`channels`.`last_entry_id` AS `last_entry_id`,`channels`.`last_write_at` AS `last_write_at`,`users`.`id` AS `user_id`,`users`.`login` AS `login` from ((`channels` join `things`) join `users`) where ((`channels`.`tags` = `things`.`tag`) and (`things`.`user_id` = `users`.`id`));

-- --------------------------------------------------------

--
-- Structure de la vue `users_things`
--
DROP TABLE IF EXISTS `users_things`;

CREATE ALGORITHM=UNDEFINED DEFINER=`ruche`@`localhost` SQL SECURITY DEFINER VIEW `users_things` AS select `things`.`id` AS `id`,`things`.`name` AS `name`,`users`.`User_API_Key` AS `USER_API_Key`,`things`.`tag` AS `tag` from (`things` join `users`) where (`things`.`user_id` = `users`.`id`);

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
 ADD PRIMARY KEY (`id`), ADD KEY `channel` (`id_channel`);

--
-- Index pour la table `Matlab_Visu`
--
ALTER TABLE `Matlab_Visu`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reacts`
--
ALTER TABLE `reacts`
 ADD PRIMARY KEY (`id`), ADD KEY `index_reacts_on_channel_id_and_run_on_insertion` (`channel_id`,`run_on_insertion`), ADD KEY `index_reacts_on_channel_id` (`channel_id`), ADD KEY `index_reacts_on_user_id` (`user_id`);

--
-- Index pour la table `thinghttps`
--
ALTER TABLE `thinghttps`
 ADD PRIMARY KEY (`id`), ADD KEY `users` (`user_id`);

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
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `tel` (`telNumber`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `channels`
--
ALTER TABLE `channels`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=788569;
--
-- AUTO_INCREMENT pour la table `failed_logins`
--
ALTER TABLE `failed_logins`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `feeds`
--
ALTER TABLE `feeds`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1688;
--
-- AUTO_INCREMENT pour la table `Matlab_Visu`
--
ALTER TABLE `Matlab_Visu`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `reacts`
--
ALTER TABLE `reacts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `thinghttps`
--
ALTER TABLE `thinghttps`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `things`
--
ALTER TABLE `things`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT pour la table `things_channels`
--
ALTER TABLE `things_channels`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
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
