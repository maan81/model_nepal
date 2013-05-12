-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 12, 2013 at 11:11 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `model_nepal`
--

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE IF NOT EXISTS `subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `link` varchar(127) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact_no` varchar(127) NOT NULL,
  `email` varchar(255) NOT NULL,
  `height` varchar(11) NOT NULL,
  `weight` varchar(11) NOT NULL,
  `bust` varchar(11) NOT NULL,
  `waist` varchar(11) NOT NULL,
  `hips` varchar(11) NOT NULL,
  `shoe` varchar(11) NOT NULL,
  `dress` varchar(11) NOT NULL,
  `hair_color` varchar(127) NOT NULL,
  `hair_length` varchar(127) NOT NULL,
  `ethnicity` varchar(127) NOT NULL,
  `skin` varchar(127) NOT NULL,
  `eyes` varchar(127) NOT NULL,
  `teeth` varchar(11) NOT NULL,
  `professional` varchar(127) NOT NULL,
  `additional` text NOT NULL,
  `travelling_area` varchar(11) NOT NULL,
  `travelling_duration` varchar(11) NOT NULL,
  `editorial` tinyint(1) NOT NULL,
  `runaway` tinyint(1) NOT NULL,
  `catalog` tinyint(1) NOT NULL,
  `print` tinyint(1) NOT NULL,
  `showroom` tinyint(1) NOT NULL,
  `fitness` tinyint(1) NOT NULL,
  `fit` tinyint(1) NOT NULL,
  `tearoom` tinyint(1) NOT NULL,
  `body_part` tinyint(1) NOT NULL,
  `lingerie` tinyint(1) NOT NULL,
  `product_modelling` tinyint(1) NOT NULL,
  `lifestyle_modelling` tinyint(1) NOT NULL,
  `coorporate_modelling` tinyint(1) NOT NULL,
  `product_demo` tinyint(1) NOT NULL,
  `tradeshow` tinyint(1) NOT NULL,
  `lingrie` tinyint(1) NOT NULL,
  `art` tinyint(1) NOT NULL,
  `experience` text NOT NULL,
  `date_created` date NOT NULL,
  `profile_viewed` int(11) NOT NULL DEFAULT '0',
  `created_by` varchar(11) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `link` (`link`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `link`, `age`, `gender`, `address`, `contact_no`, `email`, `height`, `weight`, `bust`, `waist`, `hips`, `shoe`, `dress`, `hair_color`, `hair_length`, `ethnicity`, `skin`, `eyes`, `teeth`, `professional`, `additional`, `travelling_area`, `travelling_duration`, `editorial`, `runaway`, `catalog`, `print`, `showroom`, `fitness`, `fit`, `tearoom`, `body_part`, `lingerie`, `product_modelling`, `lifestyle_modelling`, `coorporate_modelling`, `product_demo`, `tradeshow`, `lingrie`, `art`, `experience`, `date_created`, `profile_viewed`, `created_by`, `position`) VALUES
(8, 'sss', 'sss', 20, 0, 'Kathnamdu', '123456', 'test@test.com', '5'' 5''''', '50', '', '', '', '', '', '', '', 'brahmin', '', '', '', 'armateur', '', 'local', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '2013-04-01', 2, '', 1),
(10, 'as dfas dawe ', 'as_dfas_dawe', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', 'brahmin', '', '', '', 'armateur', '', 'local', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '2013-04-10', 3, '', 2),
(11, 'Pooza', 'pooza', 18, 0, '', '', '', '', '', '', '', '', '', '', '', '', 'brahmin', '', '', '', 'armateur', '', 'local', '', 1, 0, 1, 1, 0, 1, 1, 0, 0, 0, 1, 1, 0, 1, 1, 0, 0, '', '2013-04-11', 3, '', 3);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
