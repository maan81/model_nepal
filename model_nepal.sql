-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 04, 2013 at 01:54 PM
-- Server version: 5.5.29
-- PHP Version: 5.3.10-1ubuntu3.5

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
-- Table structure for table `ads`
--

CREATE TABLE IF NOT EXISTS `ads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(127) NOT NULL,
  `category` varchar(127) NOT NULL,
  `dimensions` varchar(127) NOT NULL,
  `link` varchar(255) NOT NULL,
  `image` varchar(127) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(127) NOT NULL,
  `content` text NOT NULL,
  `summary` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `content`, `summary`) VALUES
(1, 'jtd ', 'fghk dshkf chj edykdgh dyj dyjd ', 'df jksrtj dfgj sert ');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(127) NOT NULL,
  `summary` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `featured`
--

CREATE TABLE IF NOT EXISTS `featured` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `ethnicity` varchar(127) NOT NULL,
  `wardrobe` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `make_up` varchar(255) NOT NULL,
  `photographer` varchar(255) NOT NULL,
  `model_by` varchar(225) NOT NULL,
  `date_created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `gossips`
--

CREATE TABLE IF NOT EXISTS `gossips` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `title` varchar(255) NOT NULL,
  `summary` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE IF NOT EXISTS `subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
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
  `date_created` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
