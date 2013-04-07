-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 07, 2013 at 04:54 PM
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
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `title`, `category`, `type`, `dimensions`, `script`, `link`, `image`, `position`) VALUES
(1, 'Wired 868', 'published', 'image', 'h-ad', '', 'http://google.com.np', '1363158059.1957.jpg', 3),
(2, 'Vmail', 'published', 'image', 'h-ad', '', 'http://facebook.com', '1363159357.1056.jpg', 4),
(3, 'Digital Dream Utopia', 'published', 'image', 'fullbanner', '', 'http://yahoo.com', '1363159980.0329.jpg', 6),
(6, 'Car Zoom', 'published', 'image', 'rightadsense', '', 'http://cnn.com', '1363161795.57.jpg', 7),
(8, 'Vmail 2', 'draft', 'image', 'rads', '', 'http://stackoverflow.com', '1363162127.7703.jpg', 10),
(9, 'Wired 868 2', 'draft', 'image', 'rads', '', 'http://skype.com', '1363162394.1761.jpg', 8),
(10, 'Ubuntu', 'published', 'image', 'rads', '<script>\nalert(''hi'');\n</script>', 'http://ubuntu.com', '1363162466.9965.jpg', 5),
(11, 'Vmail 3', 'draft', 'image', 'rads', '', 'http://facebook.com', '1363162539.473.jpg', 9),
(12, 'Digital Dream Utopia 2', 'draft', 'image', 'rads', '', 'http://youtube.com', '1363162622.9466.jpg', 11),
(21, 'adsence test', 'published', 'script', 'rads', '<script type="text/javascript"><!--\ngoogle_ad_client = "ca-pub-7372466155313335";\n/* 250 Ad */\ngoogle_ad_slot = "3531712710";\ngoogle_ad_width = 250;\ngoogle_ad_height = 250;\n//-->\n</script>\n<script type="text/javascript"\nsrc="http://pagead2.googlesyndication.com/pagead/show_ads.js">\n</script>\n', NULL, NULL, 1),
(22, 'Adsence test 2', 'published', 'script', 'rads', '<script type="text/javascript"><!--\ngoogle_ad_client = "ca-pub-7372466155313335";\n/* 250 Ad */\ngoogle_ad_slot = "3531712710";\ngoogle_ad_width = 250;\ngoogle_ad_height = 250;\n//-->\n</script>\n<script type="text/javascript"\nsrc="http://pagead2.googlesyndication.com/pagead/show_ads.js">\n</script>\n', '0', NULL, 2),
(23, 'Google Adsence 3', 'published', 'script', 'rtbbox', '<script type="text/javascript"><!--\ngoogle_ad_client = "ca-pub-7372466155313335";\n/* 200x200 */\ngoogle_ad_slot = "2498494592";\ngoogle_ad_width = 200;\ngoogle_ad_height = 200;\n//-->\n</script>\n<script type="text/javascript"\nsrc="http://pagead2.googlesyndication.com/pagead/show_ads.js">\n</script>', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(127) NOT NULL,
  `summary` varchar(2047) NOT NULL,
  `type` varchar(11) NOT NULL,
  `location` varchar(127) NOT NULL,
  `date` varchar(11) DEFAULT NULL,
  `time` varchar(11) DEFAULT NULL,
  `details` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `summary`, `type`, `location`, `date`, `time`, `details`) VALUES
(13, 'Nv asdfiuh aefw', 'uasdh oaiusdhf owefasdf fw', 'past', 'aad', NULL, NULL, NULL),
(14, 'A Big Event', 'A big event is comming ...........', 'past', 'Ktm', NULL, NULL, NULL),
(16, 'A Upcomming Event', 'This small but strikingly beautiful Himalayan nation boasts of being a dream come true for adventure lovers as it features 8 highest Mountains including the Mt. Everest, greatest altitude variation (60 m from sea level to highest point on earth), more than 900 species of birds, more than 70 ethnic groups and same number of dialects and many more. These features make Nepal one of the best holiday destinations and we are more than happy to welcome you in this beautiful country where people are famous for their hospitality and care towards guests. Welcome to Nepal, the country of diversity. ', 'upcomming', 'Kathmandu', '1 January 2', '12:30pm', '<p>This small but strikingly beautiful Himalayan nation boasts of being a dream come true for adventure lovers as it features 8 highest Mountains including the Mt. Everest, greatest altitude variation (60 m from sea level to highest point on earth), more than 900 species of birds, more than 70 ethnic groups and same number of dialects and many more. These features make Nepal one of the best holiday destinations and we are more than happy to welcome you in this beautiful country where people are famous for their hospitality and care towards guests. Welcome to Nepal, the country of diversity.</p>\n\n<p>This small but strikingly beautiful Himalayan nation boasts of being a dream come true for adventure lovers as it features 8 highest Mountains including the Mt. Everest, greatest altitude variation (60 m from sea level to highest point on earth), more than 900 species of birds, more than 70 ethnic groups and same number of dialects and many more. These features make</P>\n');

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
  `profile_viewed` int(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `featured`
--

INSERT INTO `featured` (`id`, `name`, `gender`, `ethnicity`, `wardrobe`, `location`, `make_up`, `photographer`, `model_by`, `date_created`, `profile_viewed`) VALUES
(1, 'First Model', 0, 'gurung', 'First Wardrobe', 'KTM', 'Someone', 'Somebody', 'Noone', 0, 0),
(3, 'Test Model 2', 0, 'gurung', 'Personal', 'Kathmandu', 'Mr. Designer', 'The Fashion Plus', 'The Fashion Plus', 0, 1),
(5, 'Model Nepal', 0, 'gurung', 'Personal', 'Kathmandu', 'Mr. Designer', 'The Fashion Plus', 'The Fashion Plus', 0, 1),
(6, 'Kritika', 0, 'limbu', 'The Fashion Plus', 'The Fashion Plus', 'The Fashion Plus', 'The Fashion Plus', 'The Fashion Plus', 0, 1),
(7, 'Gunjun', 0, 'gurung', 'The Fashion Plus', 'Kathmandu', 'The Fashion Plus', 'The Fashion Plus', 'The Fashion Plus', 0, 1);

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
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(127) NOT NULL,
  `content` text NOT NULL,
  `summary` varchar(255) NOT NULL,
  `type` varchar(11) NOT NULL,
  `image` varchar(127) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `summary`, `type`, `image`) VALUES
(9, 'Ways to Decrease your Obsiety', '<p>There are many ways to decrease the obsiety. There are many ways to ecrease the obsiety There are many ways to decrease the obsiety There are many ways to decrease the obsiety. There are many ways to decrease the obsiety There are many ways to decrease the obsiety </p>\r\n<p>There are many ways to decrease the obsiety. There are many ways to ecrease the obsiety There are many ways to decrease the obsiety There are many ways to decrease the obsiety. There are many ways to decrease the obsiety There are many ways to decrease the obsiety </p>', 'There are many ways to decrease the obsiety. There are many ways to ecrease the obsiety There are many ways to decrease the obsiety There are many ways to decrease the obsiety. There are many ways to decrease the obsiety There are many ways to decrease th', 'health', '1364635223.73.jpg'),
(10, 'qqqqqqqq', 'a sdfawe fasef awef fasf w', 'asd fasdf e', 'health', '1365228551.5597.jpg');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=107 ;

--
-- Dumping data for table `visitors_count`
--

INSERT INTO `visitors_count` (`id`, `ip_address`, `type`, `model_id`, `timestamp`) VALUES
(37, '127.0.0.1', 'subjects', 1, '2013-03-22 17:02:00'),
(38, '192.168.1.3', 'subjects', 1, '2013-03-24 05:43:25'),
(39, '127.0.0.1', 'subjects', 6, '2013-03-25 07:47:09'),
(40, '127.0.0.1', 'featured', 1, '2013-04-02 05:58:25'),
(57, '127.0.0.1', 'featured', 3, '2013-04-04 11:34:18'),
(61, '127.0.0.1', 'featured', 5, '2013-04-05 03:32:13'),
(65, '127.0.0.1', 'featured', 6, '2013-04-05 11:29:38'),
(76, '127.0.0.1', 'featured', 7, '2013-04-05 11:32:21'),
(81, '127.0.0.1', 'featured', 2, '2013-04-07 01:51:01');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
