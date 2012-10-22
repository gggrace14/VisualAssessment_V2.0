-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 29, 2012 at 11:30 PM
-- Server version: 5.5.25
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `VisualAssessment`
--

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE IF NOT EXISTS `ratings` (
  `session_id` varchar(50) NOT NULL DEFAULT '',
  `group_id` int(11) NOT NULL DEFAULT '0',
  `rating` int(11) NOT NULL DEFAULT '0',
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`session_id`,`group_id`,`rating`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`session_id`, `group_id`, `rating`, `image`) VALUES
('3mnbufc6mdndkf4uo004384i97', 0, 0, ''),
('3mnbufc6mdndkf4uo004384i97', 0, 1, ''),
('3mnbufc6mdndkf4uo004384i97', 0, 2, ''),
('3mnbufc6mdndkf4uo004384i97', 0, 3, ''),
('3mnbufc6mdndkf4uo004384i97', 0, 4, ''),
('3mnbufc6mdndkf4uo004384i97', 0, 5, ''),
('3mnbufc6mdndkf4uo004384i97', 0, 6, ''),
('3mnbufc6mdndkf4uo004384i97', 0, 7, ''),
('3mnbufc6mdndkf4uo004384i97', 0, 8, ''),
('s669dbbiigbp1p9dq0p5uj3054', 0, 0, ''),
('s669dbbiigbp1p9dq0p5uj3054', 0, 1, ''),
('s669dbbiigbp1p9dq0p5uj3054', 0, 2, ''),
('s669dbbiigbp1p9dq0p5uj3054', 0, 3, ''),
('s669dbbiigbp1p9dq0p5uj3054', 0, 4, ''),
('s669dbbiigbp1p9dq0p5uj3054', 0, 5, ''),
('s669dbbiigbp1p9dq0p5uj3054', 0, 6, ''),
('s669dbbiigbp1p9dq0p5uj3054', 0, 7, ''),
('s669dbbiigbp1p9dq0p5uj3054', 0, 8, '');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(50) NOT NULL DEFAULT '',
  `user_id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `time`) VALUES
('3mnbufc6mdndkf4uo004384i97', 85, '2012-07-26 06:58:29'),
('s669dbbiigbp1p9dq0p5uj3054', 83, '2012-07-26 06:41:03'),
('uuvllanbjjm8ibmr6noit08rp0', 84, '2012-07-26 06:49:18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `livingCity` varchar(45) DEFAULT NULL,
  `birthPlace` varchar(45) DEFAULT NULL,
  `education` varchar(45) DEFAULT NULL,
  `profession` varchar(45) DEFAULT NULL,
  `race` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=86 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `gender`, `age`, `livingCity`, `birthPlace`, `education`, `profession`, `race`) VALUES
(83, 'Grace', 'female', 34, 'Cville', 'Cville', 'hispanic', 'st', 'asian'),
(84, 'A', 'male', 2, 'C', 'C', 'Less than High School', 'a', 'American Indian or Alaska Native'),
(85, '', '', 2, 'Ca', 'Ca', 'Less than High School', 'ca', 'American Indian or Alaska Native');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
