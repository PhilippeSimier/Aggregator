-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u4
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mar 27 Août 2019 à 08:17
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

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `login`, `encrypted_password`, `User_API_Key`, `Created_at`, `sign_in_count`, `last_sign_in_at`) VALUES
(0, 'root', '21232f297a57a5a743894a0e4a801fc3', 'RDIK9LVVYEYZYZER', '2019-08-11 12:42:44', 96, '2019-08-27 04:55:46'),
(1, 'touchard', '21232f297a57a5a743894a0e4a801fc3', 'RC8IK9LVVYEYZNSM', '2019-06-18 20:02:20', 58, '2019-08-11 17:25:56'),
(2, 'philippe', '21232f297a57a5a743894a0e4a801fc3', '9L0V9YXONAUJ0QRH', '0000-00-00 00:00:00', 44, '2019-08-24 16:14:50'),
(3, 'test', 'f71dbe52628a3f83a77ab494817525c6', 'LL6B3RHFSCENGRYI', '2019-08-01 14:09:23', 18, '2019-08-23 16:37:02'),
(18, 'Anne-Marie', '1843a91724e69f036b067183cf51c6cd', 'VEOPA7KVYOB1HGSR', '2019-08-24 16:40:45', 1, '2019-08-24 16:49:46');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
