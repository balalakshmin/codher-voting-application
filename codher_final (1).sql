-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 29, 2014 at 05:39 PM
-- Server version: 5.6.14-log
-- PHP Version: 5.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `codher_final`
--

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE IF NOT EXISTS `complaints` (
  `comp_title` text NOT NULL,
  `comp_body` text NOT NULL,
  `date_time` datetime NOT NULL,
  `post_author` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`comp_title`, `comp_body`, `date_time`, `post_author`) VALUES
('VGhyZWF0', 'SSB3YXMgdGhyZWF0ZW5lZCB0byB2b3Rl', '2014-09-29 22:08:30', 'Anonymous');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `member_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`member_id`, `name`, `password`) VALUES
(123, 'Palani', 'pass');

-- --------------------------------------------------------

--
-- Table structure for table `mpconstituency_member`
--

CREATE TABLE IF NOT EXISTS `mpconstituency_member` (
  `cand_name` varchar(255) NOT NULL,
  `party_name` varchar(255) NOT NULL,
  `vote_count` int(11) NOT NULL,
  `mpconstituency_id` int(11) NOT NULL,
  `cand_id` int(11) NOT NULL,
  PRIMARY KEY (`mpconstituency_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mpconstituency_member`
--

INSERT INTO `mpconstituency_member` (`cand_name`, `party_name`, `vote_count`, `mpconstituency_id`, `cand_id`) VALUES
('lingusamy', 'DMK', 1, 111111, 1);

-- --------------------------------------------------------

--
-- Table structure for table `voter`
--

CREATE TABLE IF NOT EXISTS `voter` (
  `voter_id` int(11) NOT NULL,
  `voter_name` text NOT NULL,
  `address` text NOT NULL,
  `age` int(11) NOT NULL,
  PRIMARY KEY (`voter_id`),
  UNIQUE KEY `voter_id` (`voter_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `voter`
--

INSERT INTO `voter` (`voter_id`, `voter_name`, `address`, `age`) VALUES
(1111, 'Bala', 'jlskadfja', 18);

-- --------------------------------------------------------

--
-- Table structure for table `voter_mpconstituency`
--

CREATE TABLE IF NOT EXISTS `voter_mpconstituency` (
  `voter_id` int(11) NOT NULL,
  `voter_name` varchar(255) NOT NULL,
  `voted` int(11) NOT NULL,
  `mp_constituency_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `voter_mpconstituency`
--

INSERT INTO `voter_mpconstituency` (`voter_id`, `voter_name`, `voted`, `mp_constituency_id`) VALUES
(1111, 'Bala', 1, 111111);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
