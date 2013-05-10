-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 10, 2013 at 07:21 AM
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
  `created_by` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `title`, `category`, `type`, `dimensions`, `script`, `link`, `image`, `position`, `created_by`) VALUES
(1, 'Wired 868', 'published', 'image', 'h-ad', '', 'http://google.com.np', '1363158059.1957.jpg', 4, ''),
(2, 'Vmail', 'published', 'image', 'h-ad', '', 'http://facebook.com', '1363159357.1056.jpg', 5, ''),
(3, 'Digital Dream Utopia', 'published', 'image', 'fullbanner', '', 'http://yahoo.com', '1363159980.0329.jpg', 7, ''),
(6, 'Car Zoom', 'published', 'image', 'rightadsense', '', 'http://cnn.com', '1363161795.57.jpg', 6, ''),
(8, 'Vmail 2', 'draft', 'image', 'rads', '', 'http://stackoverflow.com', '1363162127.7703.jpg', 10, ''),
(9, 'Wired 868 2', 'draft', 'image', 'rads', '', 'http://skype.com', '1363162394.1761.jpg', 8, ''),
(10, 'Ubuntu', 'published', 'image', 'rads', '<script>\nalert(''hi'');\n</script>', 'http://ubuntu.com', '1363162466.9965.jpg', 1, ''),
(11, 'Vmail 3', 'draft', 'image', 'rads', '', 'http://facebook.com', '1363162539.473.jpg', 9, ''),
(12, 'Digital Dream Utopia 2', 'draft', 'image', 'rads', '', 'http://youtube.com', '1363162622.9466.jpg', 11, ''),
(21, 'adsence test', 'published', 'script', 'rads', '<script type="text/javascript"><!--\ngoogle_ad_client = "ca-pub-7372466155313335";\n/* 250 Ad */\ngoogle_ad_slot = "3531712710";\ngoogle_ad_width = 250;\ngoogle_ad_height = 250;\n//-->\n</script>\n<script type="text/javascript"\nsrc="http://pagead2.googlesyndication.com/pagead/show_ads.js">\n</script>', NULL, NULL, 2, ''),
(22, 'Adsence test 2', 'published', 'script', 'rads', '<script type="text/javascript"><!--\ngoogle_ad_client = "ca-pub-7372466155313335";\n/* 250 Ad */\ngoogle_ad_slot = "3531712710";\ngoogle_ad_width = 250;\ngoogle_ad_height = 250;\n//-->\n</script>\n<script type="text/javascript"\nsrc="http://pagead2.googlesyndication.com/pagead/show_ads.js">\n</script>', '0', NULL, 3, ''),
(23, 'Google Adsence 3', 'published', 'script', 'rtbbox', '<script type="text/javascript"><!--\ngoogle_ad_client = "ca-pub-7372466155313335";\n/* 200x200 */\ngoogle_ad_slot = "2498494592";\ngoogle_ad_width = 200;\ngoogle_ad_height = 200;\n//-->\n</script>\n<script type="text/javascript"\nsrc="http://pagead2.googlesyndication.com/pagead/show_ads.js">\n</script>', NULL, NULL, 12, ''),
(27, 'Photography', 'published', 'image', 'rtbbox', NULL, 'http://cybernepal.com', '1366024025.7594.jpg', 13, '');

-- --------------------------------------------------------

--
-- Table structure for table `contests`
--

CREATE TABLE IF NOT EXISTS `contests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(127) NOT NULL,
  `summary` varchar(2047) NOT NULL,
  `type` varchar(11) NOT NULL,
  `location` varchar(127) NOT NULL,
  `time` varchar(11) DEFAULT NULL,
  `details` text,
  `date_created` date NOT NULL,
  `upcomming` tinyint(4) NOT NULL,
  `featured` tinyint(4) NOT NULL DEFAULT '0',
  `created_by` varchar(11) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `time` varchar(11) DEFAULT NULL,
  `details` text,
  `date_created` date NOT NULL,
  `upcomming` tinyint(4) NOT NULL,
  `featured` tinyint(4) NOT NULL DEFAULT '0',
  `created_by` varchar(11) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `summary`, `type`, `location`, `time`, `details`, `date_created`, `upcomming`, `featured`, `created_by`, `position`) VALUES
(13, 'Nv asdfiuh aefw', 'Was a nice event', 'pagent', 'aad', 'ag', 'asg asg', '2013-04-01', 0, 0, '', 1),
(14, 'A Big Event', 'A big event is comming ...........', 'fashion', 'Kathmandu', '11:11', 'asd fasdf awe', '2013-04-09', 1, 0, '', 2),
(16, 'A Upcomming Event', 'This small but strikingly beautiful Himalayan nation boasts of being a dream come true for adventure lovers as it features 8 highest Mountains including the Mt. Everest, greatest altitude variation (60 m from sea level to highest point on earth), more than 900 species of birds, more than 70 ethnic groups and same number of dialects and many more. These features make Nepal one of the best holiday destinations and we are more than happy to welcome you in this beautiful country where people are famous for their hospitality and care towards guests. Welcome to Nepal, the country of diversity. ', 'dance', 'Kathmandu', '12:30pm', '<p>This small but strikingly beautiful Himalayan nation boasts of being a dream come true for adventure lovers as it features 8 highest Mountains including the Mt. Everest, greatest altitude variation (60 m from sea level to highest point on earth), more than 900 species of birds, more than 70 ethnic groups and same number of dialects and many more. These features make Nepal one of the best holiday destinations and we are more than happy to welcome you in this beautiful country where people are famous for their hospitality and care towards guests. Welcome to Nepal, the country of diversity.</p>\r\n\r\n<p>This small but strikingly beautiful Himalayan nation boasts of being a dream come true for adventure lovers as it features 8 highest Mountains including the Mt. Everest, greatest altitude variation (60 m from sea level to highest point on earth), more than 900 species of birds, more than 70 ethnic groups and same number of dialects and many more. These features make</P>\r\n', '2013-04-08', 1, 0, '', 3);

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
  `date_created` date NOT NULL,
  `profile_viewed` int(255) NOT NULL DEFAULT '0',
  `created_by` varchar(11) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `featured`
--

INSERT INTO `featured` (`id`, `name`, `gender`, `ethnicity`, `wardrobe`, `location`, `make_up`, `photographer`, `model_by`, `date_created`, `profile_viewed`, `created_by`, `position`) VALUES
(3, 'Model Nepal', 0, 'gurung', 'Personal', 'Kathmandu', 'Mr. Designer', 'The Fashion Plus', 'The Fashion Plus', '2013-04-07', 2, '', 2),
(6, 'Kritika', 0, 'rana', 'The Fashion Plus', 'The Fashion Plus', 'The Fashion Plus', 'The Fashion Plus', 'The Fashion Plus', '2013-04-21', 3, '', 3),
(7, 'Gunjun', 0, 'gurung', 'The Fashion Plus', 'Kathmandu', 'The Fashion Plus', 'The Fashion Plus', 'The Fashion Plus', '2013-03-01', 2, '', 4),
(8, 'Bipishana', 0, 'limbu', 'The Fashion Plus', 'The Fashion Plus', 'The Fashion Plus', 'The Fashion Plus', 'The Fashion Plus', '2013-04-11', 3, '', 1),
(9, 'Sarifa', 0, 'gurung', 'The Fashion Plus', 'The Fashion Plus', 'The Fashion Plus', 'The Fashion Plus', 'The Fashion Plus', '2013-04-11', 2, '', 6),
(10, 'Zigyasha', 0, 'gurung', 'The Fashion Plus', 'The Fashion Plus', 'The Fashion Plus', 'The Fashion Plus', 'The Fashion Plus', '2013-04-11', 2, '', 5);

-- --------------------------------------------------------

--
-- Table structure for table `flinks`
--

CREATE TABLE IF NOT EXISTS `flinks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(127) NOT NULL,
  `image` varchar(127) NOT NULL,
  `title` varchar(11) NOT NULL,
  `summary` varchar(2047) NOT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '1',
  `date_created` date NOT NULL,
  `created_by` varchar(11) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `flinks`
--

INSERT INTO `flinks` (`id`, `link`, `image`, `title`, `summary`, `enabled`, `date_created`, `created_by`, `position`) VALUES
(25, 'http://google.com', '1367918911.0396.jpg', 'lkj hlkj hl', 'lk u hgl jk', 1, '0000-00-00', 'root', 1),
(26, 'http://en.wikipedia.org/wiki/Nepal', '1367924166.248.jpg', 'tttt', 'about nepal ........', 1, '0000-00-00', 'root', 2);

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
  `date_created` date NOT NULL,
  `created_by` varchar(11) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `summary`, `type`, `image`, `date_created`, `created_by`, `position`) VALUES
(9, 'Ways to Decrease your Obsiety', '<p>There are many ways to decrease the obsiety. There are many ways to ecrease the obsiety There are many ways to decrease the obsiety There are many ways to decrease the obsiety. There are many ways to decrease the obsiety There are many ways to decrease the obsiety </p>\r\n<p>There are many ways to decrease the obsiety. There are many ways to ecrease the obsiety There are many ways to decrease the obsiety There are many ways to decrease the obsiety. There are many ways to decrease the obsiety There are many ways to decrease the obsiety </p>', 'There are many ways to decrease the obsiety. There are many ways to ecrease the obsiety There are many ways to decrease the obsiety There are many ways to decrease the obsiety. There are many ways to decrease the obsiety There are many ways to decrease th', 'health', '1364635223.73.jpg', '2013-04-03', '', 1),
(10, 'qqqqqqqq', 'nn', 'ss', 'health', '1365228551.5597.jpg', '2013-04-09', '', 2),
(11, 'asd fawef awe', '33333333333', '2222222222', 'health', '1365667723.6356.jpg', '2013-04-11', '', 3),
(12, 'Hello World', 'Hello world .... How are you doing? ', 'Hello world .... How are you doing? ', 'health', '1366021550.8427.png', '2013-04-15', '', 4);

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
  `date_created` date NOT NULL,
  `profile_viewed` int(11) NOT NULL DEFAULT '0',
  `created_by` varchar(11) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `age`, `gender`, `address`, `contact_no`, `email`, `height`, `weight`, `bust`, `waist`, `hips`, `shoe`, `dress`, `hair_color`, `hair_length`, `ethnicity`, `skin`, `eyes`, `teeth`, `professional`, `additional`, `travelling_area`, `travelling_duration`, `editorial`, `runaway`, `catalog`, `print`, `showroom`, `fitness`, `fit`, `tearoom`, `body_part`, `lingerie`, `product_modelling`, `lifestyle_modelling`, `coorporate_modelling`, `product_demo`, `tradeshow`, `lingrie`, `art`, `experience`, `date_created`, `profile_viewed`, `created_by`, `position`) VALUES
(8, 'sss', 20, 0, 'Kathnamdu', '123456', 'test@test.com', '5'' 5''''', '50', '', '', '', '', '', '', '', 'brahmin', '', '', '', 'armateur', '', 'local', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '2013-04-01', 2, '', 1),
(10, 'as dfas dawe ', 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', 'brahmin', '', '', '', 'armateur', '', 'local', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '2013-04-10', 3, '', 2),
(11, 'Pooza', 18, 0, '', '', '', '', '', '', '', '', '', '', '', '', 'brahmin', '', '', '', 'armateur', '', 'local', '', 1, 0, 1, 1, 0, 1, 1, 0, 0, 0, 1, 1, 0, 1, 1, 0, 0, '', '2013-04-11', 3, '', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tmp`
--

CREATE TABLE IF NOT EXISTS `tmp` (
  `count` int(11) NOT NULL,
  `date_created` date NOT NULL,
  UNIQUE KEY `count` (`count`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tmp`
--

INSERT INTO `tmp` (`count`, `date_created`) VALUES
(11, '0000-00-00'),
(12, '0000-00-00'),
(33, '0000-00-00'),
(110, '0000-00-00'),
(777, '2013-04-01'),
(888, '2013-04-02'),
(1101, '0000-00-00'),
(1111, '2013-04-29'),
(22222, '2013-04-30'),
(23232, '2013-04-08');

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
  `last_loggedin` datetime NOT NULL,
  `last_location` varchar(31) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `usertype`, `last_loggedin`, `last_location`) VALUES
(1, 'root', '9d9e9979efe032e23a07cd2623574417', 'root@root.com', 'administrator', '2013-05-09 06:29:35', '::1'),
(11, 'ff', 'ece926d8c0356205276a45266d361161', 'ff@ff.com', 'administrator', '0000-00-00 00:00:00', '0'),
(12, 'ee', 'c0bdce0aca8f4f5512bb2fd78c922c24', 'pranijman@gmail.com', 'editor', '0000-00-00 00:00:00', '0');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=187 ;

--
-- Dumping data for table `visitors_count`
--

INSERT INTO `visitors_count` (`id`, `ip_address`, `type`, `model_id`, `timestamp`) VALUES
(37, '127.0.0.1', 'subjects', 1, '2013-03-22 17:02:00'),
(38, '192.168.1.3', 'subjects', 1, '2013-03-24 05:43:25'),
(39, '127.0.0.1', 'subjects', 6, '2013-03-25 07:47:09'),
(57, '127.0.0.1', 'featured', 3, '2013-04-04 11:34:18'),
(81, '127.0.0.1', 'featured', 2, '2013-04-07 01:51:01'),
(96, '127.0.0.1', 'subjects', 7, '2013-04-11 09:12:47'),
(97, '127.0.0.1', 'subjects', 10, '2013-04-11 10:46:25'),
(101, '127.0.0.1', 'featured', 1, '2013-04-11 11:30:15'),
(102, '127.0.0.1', 'featured', 9, '2013-04-11 11:40:57'),
(110, '127.0.0.1', 'featured', 8, '2013-04-11 11:44:01'),
(119, '127.0.0.1', 'subjects', 11, '2013-04-11 11:55:00'),
(122, '127.0.0.1', 'featured', 10, '2013-04-11 12:14:39'),
(123, '192.168.1.2', 'subjects', 10, '2013-04-14 06:07:30'),
(124, '192.168.1.2', 'subjects', 11, '2013-04-14 06:07:51'),
(126, '192.168.1.2', 'subjects', 8, '2013-04-14 06:10:50'),
(127, '192.168.1.2', 'featured', 6, '2013-04-14 06:15:34'),
(130, '192.168.1.2', 'featured', 8, '2013-04-14 07:06:12'),
(137, '127.0.0.1', 'featured', 6, '2013-04-15 03:22:37'),
(140, '127.0.0.1', 'featured', 7, '2013-04-16 11:00:06'),
(141, '::1', 'featured', 10, '2013-05-01 11:45:33'),
(142, '::1', 'featured', 9, '2013-05-03 06:41:54'),
(161, '::1', 'subjects', 8, '2013-05-03 08:32:58'),
(165, '::1', 'featured', 3, '2013-05-06 09:34:23'),
(168, '::1', 'subjects', 11, '2013-05-06 10:19:57'),
(178, '::1', 'subjects', 10, '2013-05-08 07:27:16'),
(186, '::1', 'featured', 8, '2013-05-08 08:48:39');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
