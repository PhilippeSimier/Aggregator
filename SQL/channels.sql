-- Généré le :  Mar 27 Août 2019 à 07:41


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `data`
--



INSERT INTO `channels` (`id`, `name`, `field1`, `field2`, `field3`, `field4`, `field5`, `field6`, `field7`, `field8`, `status`, `tags`, `write_api_key`) VALUES
(552430, 'Moyenne Journalière', 'Poids', 'Température', 'Pression', 'Humidité', '', '', '', '', '', 'weather', 'Y3BXR665PTEYRFCG'),
(556419, 'Battery', 'Voltage (V)', 'Current (A)', 'Power (W)', 'State Of Charge (%)', 'Capacity (Ah)', '', '', '', '', 'weather', '7VX28B24FEE50ZTO'),
(558210, 'Mesures - Tests', 'Weight (Kg)', 'Temperature (°C)', 'Pressure (kPa)', 'Humidity (%)', 'Illuminance (lux)', 'dew point (°C)', 'Corrected Weight (kg)', 'Derived Weight (g/h)', '', 'test', '3RPCCIIT1JJHM25A'),
(569228, 'Dérivée poids Test', 'Dérivée poids Test', '', '', '', '', '', '', '', '', 'test', 'OH5D06IUTUJ7ZAV9'),
(602082, 'Mesures via GSM', 'Weight (Kg)', 'Temperature (°C)', 'Pressure (hPa)', 'Humidity (%)', 'illuminance (Lux)', 'Dew point (°C)', 'Corrected Weight (Kg)', '', '', 'weather', 'BUNNFRUOOIJ4HM7X'),
(622253, 'Weather Le Mans', 'Temperature (°C)', 'Pressure (hPa)', 'Humidity (%)', 'Wind speed (m/s)', 'Wind direction (°)', 'dew point (°C)', '', '', '', 'france', 'MEUSWB77H6MMRFHD'),
(684316, 'Derivée poids', 'derivée (Kg/h)', '', '', '', '', '', '', '', '', 'danemark', '3EVVIU67Z14GDQHU'),
(752841, 'Battery - France', 'Voltage (V)', 'Curent (A)', 'Power (W)', 'State of charge (%)', 'Capacity (Ah)', '', '', '', '', 'france', 'AVKOTCZ049Z420QC'),
(788567, 'Derived weight - France', 'derived weight (Kg/h)', '', '', '', '', '', '', '', '', 'france', '3RSFQ81I81H1RBSN');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
