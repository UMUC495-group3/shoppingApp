-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jul 13, 2017 at 10:48 PM
-- Server version: 10.0.27-MariaDB-cll-lve
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `umuccmsc_groupdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `cmsc_lists`
--

CREATE TABLE IF NOT EXISTS `cmsc_lists` (
  `ListID` int(11) NOT NULL AUTO_INCREMENT,
  `ProductID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `ListDate` date NOT NULL,
  PRIMARY KEY (`ListID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=151 ;

--
-- Dumping data for table `cmsc_lists`
--

INSERT INTO `cmsc_lists` (`ListID`, `ProductID`, `UserID`, `ListDate`) VALUES
(1, 835484, 2, '2016-12-18'),
(2, 1072687, 2, '2016-12-18'),
(3, 1058015, 2, '2016-12-18'),
(4, 185933, 2, '2016-12-18'),
(5, 1101074, 2, '2016-12-18'),
(6, 1047836, 2, '2016-12-18'),
(7, 13123, 2, '2016-12-18'),
(8, 85235, 2, '2016-12-11'),
(9, 5623, 2, '2016-12-11'),
(10, 96716, 2, '2016-12-11'),
(11, 1010598, 2, '2016-12-11'),
(12, 33841, 2, '2016-12-11'),
(13, 26802, 2, '2016-12-11'),
(14, 188895, 2, '2016-12-11'),
(15, 12891, 2, '2016-12-11'),
(16, 185791, 2, '2016-12-04'),
(17, 80487, 2, '2016-12-04'),
(18, 427381, 2, '2016-12-04'),
(19, 824383, 2, '2016-11-28'),
(20, 785182, 2, '2016-11-28'),
(21, 1010598, 2, '2016-11-28'),
(22, 960194, 2, '2016-11-28'),
(23, 12891, 2, '2016-11-28'),
(24, 185933, 2, '2016-11-28'),
(26, 172246, 2, '2016-11-10'),
(27, 85235, 2, '2016-11-10'),
(28, 5623, 2, '2016-11-10'),
(29, 96716, 2, '2016-11-10'),
(30, 7070, 2, '2016-11-10'),
(31, 33841, 2, '2016-11-10'),
(32, 824383, 2, '2016-11-10'),
(33, 825682, 2, '2016-11-10'),
(34, 931194, 2, '2016-11-10'),
(35, 427381, 2, '2016-11-10'),
(36, 69791, 2, '2016-11-10'),
(37, 1010598, 2, '2016-11-10'),
(38, 83257, 2, '2016-11-10'),
(39, 960194, 2, '2016-11-10'),
(40, 26802, 2, '2016-11-10'),
(41, 1068100, 2, '2016-11-10'),
(42, 5623, 2, '2017-04-10'),
(43, 33841, 2, '2017-04-10'),
(44, 647465, 2, '2017-04-10'),
(45, 5685, 2, '2017-04-10'),
(46, 26802, 2, '2017-04-10'),
(47, 1010598, 2, '2017-04-10'),
(48, 824383, 2, '2017-04-10'),
(49, 690194, 2, '2017-04-10'),
(50, 427381, 2, '2017-04-10'),
(51, 1047836, 2, '2017-04-10'),
(52, 664511, 2, '2017-04-10'),
(53, 835484, 2, '2017-04-10'),
(54, 185933, 2, '2017-04-10'),
(55, 960194, 2, '2017-05-13'),
(56, 26802, 2, '2017-05-13'),
(57, 1130088, 2, '2017-05-13'),
(58, 202193, 2, '2017-05-13'),
(59, 1010598, 2, '2017-05-13'),
(60, 18730, 2, '2017-05-13'),
(61, 1068100, 2, '2017-05-13'),
(62, 5623, 2, '2017-05-13'),
(63, 824383, 2, '2017-05-13'),
(64, 185933, 2, '2017-05-13'),
(65, 5685, 2, '2017-05-13'),
(66, 785182, 2, '2017-04-14'),
(67, 729324, 2, '2017-04-14'),
(68, 46176, 2, '2017-04-14'),
(69, 960194, 2, '2017-04-14'),
(70, 330711, 2, '2017-04-14'),
(71, 960194, 2, '2017-01-09'),
(72, 96716, 2, '2017-01-09'),
(73, 185933, 2, '2017-01-09'),
(74, 1077378, 2, '2017-01-09'),
(75, 835484, 2, '2017-01-09'),
(76, 80487, 2, '2017-01-09'),
(77, 26802, 2, '2017-01-09'),
(78, 5623, 2, '2017-01-09'),
(79, 1010598, 2, '2017-01-09'),
(80, 664511, 2, '2017-01-09'),
(81, 581871, 2, '2017-01-09'),
(82, 960194, 2, '2017-01-02'),
(83, 85235, 2, '2017-01-02'),
(84, 824383, 2, '2017-01-02'),
(85, 5623, 2, '2017-01-02'),
(86, 96716, 2, '2017-01-02'),
(87, 1010598, 2, '2017-01-02'),
(88, 647465, 2, '2017-01-02'),
(89, 15446, 2, '2017-01-14'),
(90, 647465, 2, '2017-01-14'),
(91, 33841, 2, '2017-01-14'),
(92, 960194, 2, '2017-01-14'),
(93, 96716, 2, '2017-01-14'),
(94, 5623, 2, '2017-01-31'),
(95, 960194, 2, '2017-01-31'),
(96, 664511, 2, '2017-01-31'),
(97, 185933, 2, '2017-01-31'),
(98, 1010598, 2, '2017-01-31'),
(99, 26802, 2, '2017-01-31'),
(100, 5685, 2, '2017-01-31'),
(101, 647465, 2, '2017-01-31'),
(102, 835484, 2, '2017-04-29'),
(103, 5685, 2, '2017-04-29'),
(104, 835484, 2, '2017-01-22'),
(105, 33841, 2, '2017-01-22'),
(106, 960194, 2, '2017-01-22'),
(107, 26802, 2, '2017-01-22'),
(108, 1010598, 2, '2017-01-22'),
(109, 647465, 2, '2017-01-22'),
(110, 96716, 2, '2017-01-22'),
(111, 824383, 2, '2017-01-22'),
(112, 5623, 2, '2017-01-22'),
(113, 80487, 2, '2017-01-22'),
(114, 8100690, 2, '2017-04-26'),
(115, 33841, 2, '2017-04-26'),
(116, 1010598, 2, '2017-04-26'),
(117, 15446, 2, '2017-04-26'),
(118, 960194, 2, '2017-04-26'),
(119, 5623, 2, '2017-04-26'),
(120, 647465, 2, '2017-04-26'),
(121, 26802, 2, '2017-04-26'),
(122, 835484, 2, '2017-05-26'),
(123, 8100690, 2, '2017-05-26'),
(124, 33841, 2, '2017-05-26'),
(125, 5623, 2, '2017-05-26'),
(126, 939542, 2, '2017-05-26'),
(127, 1010598, 2, '2017-05-26'),
(128, 60357, 2, '2017-05-26'),
(129, 80487, 2, '2017-05-26'),
(130, 824383, 2, '2017-05-26'),
(131, 824383, 2, '2017-06-04'),
(132, 960184, 2, '2017-06-04'),
(133, 1161769, 2, '2017-06-04'),
(134, 3210, 2, '2017-06-04'),
(135, 1134325, 2, '2017-06-04'),
(136, 3210, 2, '2017-07-06'),
(137, 3210, 2, '2017-07-06'),
(138, 5623, 2, '2017-07-06'),
(139, 7070, 2, '2017-07-06'),
(140, 26802, 2, '2017-07-06'),
(141, 26802, 2, '2017-07-06'),
(142, 960194, 2, '2017-07-06'),
(143, 5685, 2, '2017-07-06'),
(144, 5685, 2, '2017-07-06'),
(145, 80487, 2, '2017-07-07'),
(146, 185933, 2, '2017-07-07'),
(147, 185933, 2, '2017-07-07'),
(148, 1130088, 2, '2017-07-11'),
(149, 26802, 2, '2017-07-12'),
(150, 550505, 2, '2017-07-12');

-- --------------------------------------------------------

--
-- Table structure for table `cmsc_products`
--

CREATE TABLE IF NOT EXISTS `cmsc_products` (
  `ProductID` int(11) NOT NULL AUTO_INCREMENT,
  `ProductName` varchar(60) NOT NULL,
  `UserID` int(11) NOT NULL,
  PRIMARY KEY (`ProductID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8100694 ;

--
-- Dumping data for table `cmsc_products`
--

INSERT INTO `cmsc_products` (`ProductID`, `ProductName`, `UserID`) VALUES
(101, 'Cherries', 3),
(111, 'Cherries', 0),
(1234, 'Orange', 2),
(1258, 'Apple', 2),
(1888, 'Cookies', 3),
(3210, 'Whole Wheat Bread', 2),
(5623, 'Broccoli', 2),
(5685, 'Spinach', 2),
(7070, 'Smoked Salmon', 2),
(10020, 'Watermelon', 3),
(12891, 'Sandwich Salad', 2),
(13123, 'Apple Sauce', 2),
(15446, 'Kalamata Olives', 2),
(18730, 'Shrimp Cocktail', 2),
(26802, 'Feta Cheese', 2),
(33841, 'Chicken Breast', 2),
(46176, 'Balsamic Vinegar', 2),
(60357, 'Mixed Bell Peppers', 2),
(69791, 'Coffee', 2),
(80487, 'Brussels Sprouts', 2),
(83257, 'Granny Smith Apples', 2),
(85235, 'Crimini Mushrooms', 2),
(96716, 'Organic Spinach', 2),
(172246, 'Baby Carrots', 2),
(185791, 'Coffee', 2),
(185933, 'Frozen Fudge Bars', 2),
(188895, 'Smoked Paprika', 2),
(202193, 'Mini Bell Peppers', 2),
(330711, 'Coffee', 2),
(427381, 'Organic Eggs', 2),
(550505, 'Diced Chile', 2),
(581871, 'Minced Garlic', 2),
(647465, 'Avocados', 2),
(664511, 'Black Beans', 2),
(729324, 'Avocado Oil', 2),
(785182, 'Combat Protein Powder', 2),
(824383, 'Fage Greek Yogurt', 2),
(825682, 'Cottage Cheese', 2),
(826920, 'Chocolate Protein Powder', 2),
(835484, 'Sparkling Water', 2),
(931194, 'Bottled Water', 2),
(939542, 'Green Beans', 2),
(960194, 'Hardboiled Eggs', 2),
(1010598, 'Frozen Berry Blend', 2),
(1047836, 'Apple Cider Vinegar', 2),
(1058015, 'Cooking Spray', 2),
(1068100, 'Hummus 3pack', 2),
(1072687, 'Pure Vanilla', 2),
(1077378, 'Lemon Juice', 2),
(1101074, 'Chocolate Chips', 2),
(1130088, 'Tumeric', 2),
(1134325, 'Hummus 2-pack', 2),
(1161769, 'Dark Chocolate Almonds', 2),
(8100690, 'Almond Milk 3-pack', 2);

-- --------------------------------------------------------

--
-- Table structure for table `cmsc_users`
--

CREATE TABLE IF NOT EXISTS `cmsc_users` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  PRIMARY KEY (`UserID`),
  UNIQUE KEY `Username` (`Username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `cmsc_users`
--

INSERT INTO `cmsc_users` (`UserID`, `Username`, `Password`) VALUES
(1, 'Tyler', 'password'),
(2, 'HungDao', 'CMSC495'),
(3, 'TestUser', 'abc123'),
(4, 'testing', 'testing1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
