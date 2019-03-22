-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 22, 2019 at 02:28 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `poll.app`
--

-- --------------------------------------------------------

--
-- Table structure for table `poll`
--

DROP TABLE IF EXISTS `poll`;
CREATE TABLE IF NOT EXISTS `poll` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `poll`
--

INSERT INTO `poll` (`id`, `question`) VALUES
(1, 'Please rate our service\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `poll_options`
--

DROP TABLE IF EXISTS `poll_options`;
CREATE TABLE IF NOT EXISTS `poll_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pollid` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `poll_options`
--

INSERT INTO `poll_options` (`id`, `pollid`, `name`) VALUES
(1, 1, 'Excellent'),
(2, 1, 'Good'),
(3, 1, 'Satisfactory'),
(4, 1, 'Needs Improvement'),
(5, 1, 'Poor');

-- --------------------------------------------------------

--
-- Table structure for table `poll_result`
--

DROP TABLE IF EXISTS `poll_result`;
CREATE TABLE IF NOT EXISTS `poll_result` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `pollid` int(11) NOT NULL,
  `poll_option_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `poll_result`
--

INSERT INTO `poll_result` (`id`, `userid`, `pollid`, `poll_option_id`) VALUES
(1, 1, 1, 4),
(2, 2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(16) NOT NULL,
  `email` varchar(32) NOT NULL,
  `password` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='user data';

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `time`) VALUES
(1, 'hackerpro', 'hackerpro@host.local', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '2019-03-21 20:13:58');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
