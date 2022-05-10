-- phpMyAdmin SQL Dump
-- Basic ICAO Type Based Flap Setting Names
-- Boeing Series B727,B737,B747,B757,B767,B777,B787
-- Airbus Series A220,A318,A319,A320,A321,A330,A340,A350
-- McDonnell Douglas Series B717,MD8x,MD90
-- For DisposableTech Module (phpVms v7)

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- Boeing Group
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `f6_name`, `f7_name`, `f8_name`, `active`) VALUES('B721', 'UP', '1', '2', '5', '10', '15', '25', '30', '40', 0);
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `f6_name`, `f7_name`, `f8_name`, `active`) VALUES('B722', 'UP', '1', '2', '5', '10', '15', '25', '30', '40', 0);
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `f6_name`, `f7_name`, `f8_name`, `active`) VALUES('B732', 'UP', '1', '2', '5', '10', '15', '25', '30', '40', 0);
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `f6_name`, `f7_name`, `f8_name`, `active`) VALUES('B733', 'UP', '1', '2', '5', '10', '15', '25', '30', '40', 0);
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `f6_name`, `f7_name`, `f8_name`, `active`) VALUES('B734', 'UP', '1', '2', '5', '10', '15', '25', '30', '40', 0);
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `f6_name`, `f7_name`, `f8_name`, `active`) VALUES('B735', 'UP', '1', '2', '5', '10', '15', '25', '30', '40', 0);
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `f6_name`, `f7_name`, `f8_name`, `active`) VALUES('B736', 'UP', '1', '2', '5', '10', '15', '25', '30', '40', 0);
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `f6_name`, `f7_name`, `f8_name`, `active`) VALUES('B737', 'UP', '1', '2', '5', '10', '15', '25', '30', '40', 0);
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `f6_name`, `f7_name`, `f8_name`, `active`) VALUES('B738', 'UP', '1', '2', '5', '10', '15', '25', '30', '40', 0);
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `f6_name`, `f7_name`, `f8_name`, `active`) VALUES('B739', 'UP', '1', '2', '5', '10', '15', '25', '30', '40', 0);
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `f6_name`, `active`) VALUES('B741', 'UP', '1', '5', '10', '20', '25', '30', 0);
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `f6_name`, `active`) VALUES('B742', 'UP', '1', '5', '10', '20', '25', '30', 0);
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `f6_name`, `active`) VALUES('B743', 'UP', '1', '5', '10', '20', '25', '30', 0);
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `f6_name`, `active`) VALUES('B744', 'UP', '1', '5', '10', '20', '25', '30', 0);
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `f6_name`, `active`) VALUES('B748', 'UP', '1', '5', '10', '20', '25', '30', 0);
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `f6_name`, `active`) VALUES('B74R', 'UP', '1', '5', '10', '20', '25', '30', 0);
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `f6_name`, `active`) VALUES('B74S', 'UP', '1', '5', '10', '20', '25', '30', 0);
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `f6_name`, `active`) VALUES('B752', 'UP', '1', '5', '15', '20', '25', '30', 0);
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `f6_name`, `active`) VALUES('B753', 'UP', '1', '5', '15', '20', '25', '30', 0);
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `f6_name`, `active`) VALUES('B762', 'UP', '1', '5', '15', '20', '25', '30', 0);
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `f6_name`, `active`) VALUES('B763', 'UP', '1', '5', '15', '20', '25', '30', 0);
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `f6_name`, `active`) VALUES('B764', 'UP', '1', '5', '15', '20', '25', '30', 0);
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `f6_name`, `active`) VALUES('B772', 'UP', '1', '5', '15', '20', '25', '30', 0);
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `f6_name`, `active`) VALUES('B773', 'UP', '1', '5', '15', '20', '25', '30', 0);
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `f6_name`, `active`) VALUES('B778', 'UP', '1', '5', '15', '20', '25', '30', 0);
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `f6_name`, `active`) VALUES('B779', 'UP', '1', '5', '15', '20', '25', '30', 0);
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `f6_name`, `active`) VALUES('B77L', 'UP', '1', '5', '15', '20', '25', '30', 0);
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `f6_name`, `active`) VALUES('B77W', 'UP', '1', '5', '15', '20', '25', '30', 0);
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `f6_name`, `f7_name`, `f8_name`, `f9_name`, `active`) VALUES('B788', 'UP', '1', '5', '10', '15', '17', '18', '20', '25', '30', 0);
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `f6_name`, `f7_name`, `f8_name`, `f9_name`, `active`) VALUES('B789', 'UP', '1', '5', '10', '15', '17', '18', '20', '25', '30', 0);
-- Airbus Group
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `active`) VALUES('A306', 'UP', 'CONF 1', 'CONF 1+F', 'CONF 2', 'CONF 3', 'FULL', 0);
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `active`) VALUES('A30B', 'UP', 'CONF 1', 'CONF 1+F', 'CONF 2', 'CONF 3', 'FULL', 0);
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `active`) VALUES('A310', 'UP', 'CONF 1', 'CONF 1+F', 'CONF 2', 'CONF 3', 'FULL', 0);
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `active`) VALUES('A318', 'UP', 'CONF 1', 'CONF 1+F', 'CONF 2', 'CONF 3', 'FULL', 0);
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `active`) VALUES('A319', 'UP', 'CONF 1', 'CONF 1+F', 'CONF 2', 'CONF 3', 'FULL', 0);
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `active`) VALUES('A320', 'UP', 'CONF 1', 'CONF 1+F', 'CONF 2', 'CONF 3', 'FULL', 0);
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `active`) VALUES('A321', 'UP', 'CONF 1', 'CONF 1+F', 'CONF 2', 'CONF 3', 'FULL', 0);
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `active`) VALUES('A332', 'UP', 'CONF 1', 'CONF 1+F', 'CONF 2', 'CONF 3', 'FULL', 0);
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `active`) VALUES('A333', 'UP', 'CONF 1', 'CONF 1+F', 'CONF 2', 'CONF 3', 'FULL', 0);
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `active`) VALUES('A338', 'UP', 'CONF 1', 'CONF 1+F', 'CONF 2', 'CONF 3', 'FULL', 0);
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `active`) VALUES('A339', 'UP', 'CONF 1', 'CONF 1+F', 'CONF 2', 'CONF 3', 'FULL', 0);
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `active`) VALUES('A342', 'UP', 'CONF 1', 'CONF 1+F', 'CONF 2', 'CONF 3', 'FULL', 0);
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `active`) VALUES('A343', 'UP', 'CONF 1', 'CONF 1+F', 'CONF 2', 'CONF 3', 'FULL', 0);
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `active`) VALUES('A345', 'UP', 'CONF 1', 'CONF 1+F', 'CONF 2', 'CONF 3', 'FULL', 0);
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `active`) VALUES('A346', 'UP', 'CONF 1', 'CONF 1+F', 'CONF 2', 'CONF 3', 'FULL', 0);
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `active`) VALUES('A359', 'UP', 'CONF 1', 'CONF 1+F', 'CONF 2', 'CONF 3', 'FULL', 0);
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `active`) VALUES('A35K', 'UP', 'CONF 1', 'CONF 1+F', 'CONF 2', 'CONF 3', 'FULL', 0);
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `active`) VALUES('A19N', 'UP', 'CONF 1', 'CONF 1+F', 'CONF 2', 'CONF 3', 'FULL', 0);
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `active`) VALUES('A20N', 'UP', 'CONF 1', 'CONF 1+F', 'CONF 2', 'CONF 3', 'FULL', 0);
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `active`) VALUES('A21N', 'UP', 'CONF 1', 'CONF 1+F', 'CONF 2', 'CONF 3', 'FULL', 0);
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `active`) VALUES('BCS1', 'UP', 'CONF 1', 'CONF 1+F', 'CONF 2', 'CONF 3', 'FULL', 0);
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `active`) VALUES('BCS3', 'UP', 'CONF 1', 'CONF 1+F', 'CONF 2', 'CONF 3', 'FULL', 0);
-- McDonnell Douglas
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `active`) VALUES('MD81', 'UP', 'DIAL TO', '11', '15', '28', '40', 0);
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `active`) VALUES('MD82', 'UP', 'DIAL TO', '11', '15', '28', '40', 0);
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `active`) VALUES('MD83', 'UP', 'DIAL TO', '11', '15', '28', '40', 0);
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `active`) VALUES('MD87', 'UP', 'DIAL TO', '11', '15', '28', '40', 0);
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `active`) VALUES('MD88', 'UP', 'DIAL TO', '11', '15', '28', '40', 0);
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `active`) VALUES('MD90', 'UP', 'DIAL TO', '11', '15', '28', '40', 0);
INSERT INTO `disposable_flaps` (`icao`, `f0_name`, `f1_name`, `f2_name`, `f3_name`, `f4_name`, `f5_name`, `active`) VALUES('B712', 'UP', 'DIAL TO', '11', '15', '28', '40', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
