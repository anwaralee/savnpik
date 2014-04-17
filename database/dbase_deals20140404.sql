-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2014 at 06:46 AM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbase_deals`
--

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `status`) VALUES
(8, 'Abu Dhabi', 1),
(9, 'Dubai', 1);

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE IF NOT EXISTS `companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `desc` text NOT NULL,
  `city_id` int(11) NOT NULL,
  `logo` varchar(110) NOT NULL,
  `website` varchar(110) NOT NULL,
  `address` varchar(210) NOT NULL,
  `phone_number` bigint(20) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `desc`, `city_id`, `logo`, `website`, `address`, `phone_number`, `status`) VALUES
(8, 'Manchester United', 'Manchester United is in my blood. Manchester United is in my blood. Manchester United is in my blood Manchester United is in my blood Manchester United is in my bloodManchester United is in my blood Manchester United is in my bloodManchester United is in my blood Manchester United is in my blood Manchester United is in my blood Manchester United is in my blood.', 8, 'COMP_533d55ed59937ACF-Logo.png', 'www.manutdnepal.org', 'Kathmandu', 2145141, 1),
(9, 'Arsenal1', 'Arsenal is arsenal', 9, 'COMP_533d5197ce07fCricket Logo.jpg', 'www.arsenalnepal.org.np', 'Kathmandu, Nepal', 2145141, 1);

-- --------------------------------------------------------

--
-- Table structure for table `deal_categories`
--

CREATE TABLE IF NOT EXISTS `deal_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `desc` text NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `deal_categories`
--

INSERT INTO `deal_categories` (`id`, `name`, `desc`, `status`) VALUES
(2, 'Events', 'Category for Events', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_category_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `desc` text NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `page_category_id`, `title`, `desc`, `status`) VALUES
(8, 1, 'Information', 'This is information page', 1);

-- --------------------------------------------------------

--
-- Table structure for table `page_categories`
--

CREATE TABLE IF NOT EXISTS `page_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `desc` text,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `page_categories`
--

INSERT INTO `page_categories` (`id`, `name`, `desc`, `status`) VALUES
(1, 'Entertainment', 'This is Entertainment Category description', 1),
(2, 'Travel', 'This is a description for travel', 1),
(8, 'Electronics', 'This is a description for Electronisc', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(200) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `username`, `password`, `email`, `role`, `status`) VALUES
(1, 'Manjul Bhattarai', 'manjul', '06ba99797c34dd90870992f25a9335d52f70ad8c', 'dev1@webnepal.com', 1, NULL),
(3, 'Super Bahadur Admin', 'superadmin', '3f6a714b6a7d578597e267d4e1008a1932749539', 'super@admin.com', 2, NULL),
(5, 'Admin', 'admin', '61f7cf7b994187e769cd59b43f7fb6ba616a26a5', 'admin@admin.com', 1, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
