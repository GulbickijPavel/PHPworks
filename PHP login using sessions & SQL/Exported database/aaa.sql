-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Darbinė stotis: 127.0.0.1
-- Atlikimo laikas: 2014 m. Bal 27 d. 19:04
-- Serverio versija: 5.5.32
-- PHP versija: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Duomenų bazė: `aaa`
--
CREATE DATABASE IF NOT EXISTS `aaa` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `aaa`;

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `contract`
--

CREATE TABLE IF NOT EXISTS `contract` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `payment_name` varchar(50) NOT NULL,
  `payment_code` varchar(10) NOT NULL,
  `customer_id` varchar(10) NOT NULL,
  `frequency_in_months` int(2) NOT NULL,
  `payment_amount` float(6,2) NOT NULL,
  `contract_start_date` datetime NOT NULL,
  `contract_end_date` datetime NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Sukurta duomenų kopija lentelei `contract`
--

INSERT INTO `contract` (`id`, `payment_name`, `payment_code`, `customer_id`, `frequency_in_months`, `payment_amount`, `contract_start_date`, `contract_end_date`, `is_active`, `timestamp`) VALUES
(47, 'Dviratis', '0000000001', '1', 6, 100.00, '2014-04-27 19:56:00', '2014-04-27 19:56:00', 1, '2014-04-27 16:57:02');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `person_id` bigint(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1684 ;

--
-- Sukurta duomenų kopija lentelei `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `person_id`, `first_name`, `last_name`, `is_admin`, `is_active`, `timestamp`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 3911105000, 'Pavel', 'Gulbickij', 1, 1, '2013-04-09 17:37:39'),
(2, 'Pavel', '202cb962ac59075b964b07152d234b70', 123, 'Pavel', 'Gulbickij', 0, 1, '2014-04-09 21:50:11'),
(3, 'p1', '202cb962ac59075b964b07152d234b70', 11111111111, 'adsasd', 'asdasd', 0, 1, '2014-04-09 22:15:01'),
(4, 'p14', '202cb962ac59075b964b07152d234b70', 123124124, 'qwe', 'qwe', 0, 1, '2014-04-09 22:16:39'),
(5, 'p1212', '202cb962ac59075b964b07152d234b70', 123123, 'qwe', '123', 0, 1, '2014-04-09 22:20:23'),
(1683, 'Gulbickij', '9830805fd794d3b8cbee22fe898fefb7', 39111050000, 'Pavel', 'Gulbickij', 0, 1, '2014-04-27 16:54:26');

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `user_contracts`
--

CREATE TABLE IF NOT EXISTS `user_contracts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `contract_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `contract_id` (`contract_id`,`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

--
-- Sukurta duomenų kopija lentelei `user_contracts`
--

INSERT INTO `user_contracts` (`id`, `user_id`, `contract_id`) VALUES
(49, 1, 47);

--
-- Apribojimai eksportuotom lentelėm
--

--
-- Apribojimai lentelei `user_contracts`
--
ALTER TABLE `user_contracts`
  ADD CONSTRAINT `user_contracts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user_contracts_ibfk_2` FOREIGN KEY (`contract_id`) REFERENCES `contract` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
