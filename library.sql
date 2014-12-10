-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 11, 2014 at 12:00 AM
-- Server version: 5.5.38-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `lib_actions`
--

CREATE TABLE IF NOT EXISTS `lib_actions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `book_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `libr_id` int(10) unsigned NOT NULL,
  `start_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expiration_date` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Информация о выдачах' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `lib_addresses`
--

CREATE TABLE IF NOT EXISTS `lib_addresses` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `country` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `street` varchar(255) DEFAULT NULL,
  `house` int(10) unsigned DEFAULT NULL,
  `flat` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Информация об адресах' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `lib_author`
--

CREATE TABLE IF NOT EXISTS `lib_author` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) NOT NULL,
  `patronymic` varchar(255) DEFAULT NULL,
  `biography` text,
  `birth_year` varchar(31) DEFAULT NULL,
  `death_year` varchar(31) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lname` (`lname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `lib_books`
--

CREATE TABLE IF NOT EXISTS `lib_books` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `isbn` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `pub_year` int(10) unsigned DEFAULT NULL,
  `volume` int(10) unsigned NOT NULL,
  `quantity` int(10) unsigned NOT NULL,
  `activity_status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `info_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `isbn` (`isbn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Таблица с информацией о книгах' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `lib_genres`
--

CREATE TABLE IF NOT EXISTS `lib_genres` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `genre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `genre` (`genre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `lib_info`
--

CREATE TABLE IF NOT EXISTS `lib_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `genre_id` int(10) unsigned DEFAULT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Информация о книгах' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `lib_librarians`
--

CREATE TABLE IF NOT EXISTS `lib_librarians` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `patronymic` varchar(255) DEFAULT NULL,
  `phone` varchar(32) NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `address_id` int(10) unsigned NOT NULL,
  `passport` int(10) unsigned NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `phone` (`phone`,`passport`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Информация о библиотекарях' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `lib_users`
--

CREATE TABLE IF NOT EXISTS `lib_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `patronymic` varchar(255) DEFAULT NULL,
  `passport` varchar(255) NOT NULL,
  `address_id` int(10) unsigned NOT NULL,
  `birthday` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `limit` int(10) unsigned NOT NULL,
  `phone` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `passport` (`passport`,`phone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Информация о пользователях' AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
