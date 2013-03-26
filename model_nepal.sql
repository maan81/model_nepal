-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 26, 2013 at 10:45 AM
-- Server version: 5.5.29
-- PHP Version: 5.3.10-1ubuntu3.6

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
  `type` varchar(11) NOT NULL DEFAULT 'image',
  `dimensions` varchar(127) NOT NULL,
  `script` text,
  `link` varchar(255) DEFAULT NULL,
  `image` varchar(127) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `title`, `category`, `type`, `dimensions`, `script`, `link`, `image`) VALUES
(1, 'Wired 868', 'published', 'image', 'h-ad', '', 'http://google.com.np', '1363158059.1957.jpg'),
(2, 'Vmail', 'published', 'image', 'h-ad', '', 'http://facebook.com', '1363159357.1056.jpg'),
(3, 'Digital Dream Utopia', 'published', 'image', 'fullbanner', '', 'http://yahoo.com', '1363159980.0329.jpg'),
(6, 'Car Zoom', 'published', 'image', 'rightadsense', '', 'http://cnn.com', '1363161795.57.jpg'),
(8, 'Vmail 2', 'published', 'image', 'rads', '', 'http://stackoverflow.com', '1363162127.7703.jpg'),
(9, 'Wired 868 2', 'published', 'image', 'rads', '', 'http://skype.com', '1363162394.1761.jpg'),
(10, 'Ubuntu', 'published', 'image', 'rads', '', 'http://www.ubuntu.com/', '1363162466.9965.jpg'),
(11, 'Vmail 3', 'published', 'image', 'rads', '', 'http://facebook.com', '1363162539.473.jpg'),
(12, 'Digital Dream Utopia 2', 'published', 'image', 'rads', '', 'http://youtube.com', '1363162622.9466.jpg'),
(21, 'adsence test', 'published', 'script', 'rads', '<script type="text/javascript"><!--\ngoogle_ad_client = "ca-pub-7372466155313335";\n/* 250 Ad */\ngoogle_ad_slot = "3531712710";\ngoogle_ad_width = 250;\ngoogle_ad_height = 250;\n//-->\n</script>\n<script type="text/javascript"\nsrc="http://pagead2.googlesyndication.com/pagead/show_ads.js">\n</script>\n', NULL, NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `featured`
--

INSERT INTO `featured` (`id`, `name`, `gender`, `ethnicity`, `wardrobe`, `location`, `make_up`, `photographer`, `model_by`, `date_created`) VALUES
(1, 'First Model', 0, 'gurung', 'First Wardrobe', 'KTM', 'Someone', 'Somebody', 'Noone', 0),
(2, 'nadrzr ar', 1, 'brahmin', 'd ', 'df jr', '', '', '', 0);

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
  `profile_viewed` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `age`, `gender`, `address`, `contact_no`, `email`, `height`, `weight`, `bust`, `waist`, `hips`, `shoe`, `dress`, `hair_color`, `hair_length`, `ethnicity`, `skin`, `eyes`, `teeth`, `professional`, `additional`, `travelling_area`, `travelling_duration`, `editorial`, `runaway`, `catalog`, `print`, `showroom`, `fitness`, `fit`, `tearoom`, `body_part`, `lingerie`, `product_modelling`, `lifestyle_modelling`, `coorporate_modelling`, `product_demo`, `tradeshow`, `lingrie`, `art`, `experience`, `date_created`, `profile_viewed`) VALUES
(1, 'Aa aa aaa', 11, 0, 'Ktm, NP', '987654321', 'someone@noone.com', '11', '22', '33', '44', '55', '66', '77', '88', '99', 'gurung', '1010', '1111', '1212', 'semi-pro', 'additional info here ...........								', 'national', 'bb', 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 1, 0, 1, 0, 'No Experience', 0, 2),
(6, 'asdf', 0, 1, '', '', '', '', '', '', '', '', '', '', '', '', 'brahmin', '', '', '', 'armateur', '', 'local', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tmp`
--

CREATE TABLE IF NOT EXISTS `tmp` (
  `count` int(11) NOT NULL,
  UNIQUE KEY `count` (`count`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tmp`
--

INSERT INTO `tmp` (`count`) VALUES
(11),
(12),
(110),
(1101);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(127) NOT NULL,
  `password` varchar(127) NOT NULL,
  `email` varchar(127) NOT NULL,
  `usertype` varchar(127) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `usertype`) VALUES
(1, 'root', '9d9e9979efe032e23a07cd2623574417', 'root@root.com', 'administrator'),
(11, 'ff', 'ece926d8c0356205276a45266d361161', 'ff@ff.com', 'administrator'),
(12, 'ee', 'c0bdce0aca8f4f5512bb2fd78c922c24', 'pranijman@gmail.com', 'editor');

-- --------------------------------------------------------

--
-- Table structure for table `visitors_count`
--

CREATE TABLE IF NOT EXISTS `visitors_count` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(20) NOT NULL COMMENT 'IP address of the visitor.',
  `type` varchar(11) NOT NULL COMMENT 'Type of the visit -- featured vs. subject',
  `model_id` int(11) NOT NULL COMMENT 'ID of the model',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Visited timestamp',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique` (`ip_address`,`type`,`model_id`),
  KEY `ip_address` (`ip_address`),
  KEY `model_id` (`model_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `visitors_count`
--

INSERT INTO `visitors_count` (`id`, `ip_address`, `type`, `model_id`, `timestamp`) VALUES
(37, '127.0.0.1', 'subjects', 1, '2013-03-22 17:02:00'),
(38, '192.168.1.3', 'subjects', 1, '2013-03-24 05:43:25'),
(39, '127.0.0.1', 'subjects', 6, '2013-03-25 07:47:09');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
