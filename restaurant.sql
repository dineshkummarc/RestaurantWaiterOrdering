-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 09, 2015 at 10:28 AM
-- Server version: 5.5.39-36.0-log
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `reevahwz_restaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE IF NOT EXISTS `admin_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(50) NOT NULL,
  `pwd` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`id`, `uname`, `pwd`) VALUES
(1, 'admin', 'admin@123');

-- --------------------------------------------------------

--
-- Table structure for table `cusine`
--

CREATE TABLE IF NOT EXISTS `cusine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cusinename` varchar(100) NOT NULL,
  `cusineimage` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `cusine`
--

INSERT INTO `cusine` (`id`, `cusinename`, `cusineimage`) VALUES
(1, 'Starter', 'starter.jpg'),
(2, 'Soup', 'soup.jpg'),
(3, 'Desserts', 'desserts.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `dish`
--

CREATE TABLE IF NOT EXISTS `dish` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cusineid` int(11) NOT NULL,
  `dishname` varchar(100) NOT NULL,
  `dishimage` varchar(100) NOT NULL,
  `dishtype` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `dish`
--

INSERT INTO `dish` (`id`, `cusineid`, `dishname`, `dishimage`, `dishtype`, `description`, `price`) VALUES
(1, 1, 'Spring roll', 'spring-rolls.jpg', 2, 'Veg starter', '50'),
(2, 1, 'Sabudana tikki', 'sabudana.jpg', 1, 'Veg starter', '45'),
(3, 1, 'Cheese balls', 'cheeseballs.jpg', 1, 'Veg starter', '60'),
(4, 1, 'Veg cheese sandwiche', 'cheesesandwiche.jpg', 7, 'Veg starter', '50'),
(5, 1, 'Veg toaste sandwiche', 'toastesandwiche.jpg', 8, 'Veg starter', '60'),
(6, 2, 'Tomato soup', 'tomatosoup.jpg', 1, 'Veg Soup', '60'),
(7, 2, 'Sweet Corn Veg Soup', 'sweetcorn.jpg', 1, 'Veg Soup', '60'),
(8, 2, 'Leek Potato', 'leek.jpg', 1, 'Veg Soup', '60'),
(9, 2, 'Hot and sour vegetable soup', 'hot.jpg', 9, 'Veg Soup', '60'),
(10, 3, 'Vanilla ice cream', 'vanilla.jpg', 1, 'Ice Cream', '40'),
(11, 3, ' chocolate cake', 'chocolatecake.jpg', 1, 'Veg Cake', '40');

-- --------------------------------------------------------

--
-- Table structure for table `dish_type`
--

CREATE TABLE IF NOT EXISTS `dish_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `typename` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `dish_type`
--

INSERT INTO `dish_type` (`id`, `typename`) VALUES
(1, 'sweet'),
(2, 'Spicy'),
(6, 'Stir fried'),
(7, 'Mild'),
(8, 'Tangy'),
(9, 'Sweet & sour');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customername` varchar(100) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `rating` varchar(2) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `orderid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `customername`, `phone`, `rating`, `comment`, `orderid`) VALUES
(2, '', '', '4', 'nice food', 9),
(7, 'dhruv', '9856321425', '2', 'good', 15),
(8, 'xyz', '9965235654', '2', 'good', 0),
(9, 'abs', '8956825356', '2', 'good', 1),
(10, 'jdjdj', '997979799797', '4', 'bshhsej', 8),
(11, 'qwee', '8653425896', '3', '', 2),
(12, 'ale', '2234645434346', '5', 'good!', 12),
(13, 'gdfggt', '8555896', '', '\nhvbgg', 19),
(14, 'hsjdbdjd', '94946464', '5', 'hdjdbdj\n', 20),
(15, 'et', '003556924979', '4', 'cvv\n', 32),
(16, 'hello', '976686868', '5', 'fine', 22),
(17, 'valdir', '64649497', '5', 'legak', 40),
(18, 'chahshsh', '1545451', '4', '\n', 43),
(19, 'Victor', '123456789*', '5', 'ya', 82),
(20, 'js', '8895666', '5', 'snjdjs', 85);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `memberid` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `address` varchar(300) NOT NULL,
  `gcmid` varchar(200) NOT NULL,
  `logintype` varchar(50) NOT NULL,
  `member_since` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`memberid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`memberid`, `firstname`, `lastname`, `email`, `phone`, `address`, `gcmid`, `logintype`, `member_since`) VALUES
(1, 'Utpal', 'ruparel', 'utpalruparel@gmail.com', '9909777668', 'Bhakti Dharam Township', '4654765414165314631', 'email', '2014-12-16 19:05:18');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE IF NOT EXISTS `orderdetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dishid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `status` varchar(11) NOT NULL,
  `orderid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=171 ;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`id`, `dishid`, `quantity`, `price`, `status`, `orderid`) VALUES
(1, 2, 2, 90, '2', 3),
(2, 1, 2, 100, '2', 3),
(3, 4, 1, 50, '2', 3),
(4, 1, 2, 100, '2', 1),
(5, 6, 1, 60, '2', 1),
(6, 4, 1, 50, '2', 1),
(7, 7, 4, 240, '2', 1),
(8, 2, 2, 90, '2', 4),
(9, 2, 2, 90, '2', 4),
(10, 4, 3, 150, '2', 9),
(11, 2, 1, 45, '2', 10),
(12, 2, 1, 45, '2', 11),
(13, 3, 1, 60, '2', 11),
(14, 7, 1, 60, '2', 11),
(15, 2, 2, 90, '2', 6),
(16, 9, 2, 120, '2', 12),
(17, 7, 2, 120, '2', 12),
(18, 7, 2, 120, '2', 12),
(19, 6, 2, 120, '2', 12),
(20, 2, 1, 45, '2', 16),
(21, 2, 1, 45, '2', 16),
(22, 4, 1, 50, '2', 16),
(23, 11, 1, 40, '2', 17),
(24, 2, 4, 180, '2', 5),
(25, 2, 4, 180, '2', 5),
(26, 3, 4, 240, '2', 5),
(27, 3, 4, 240, '2', 5),
(28, 3, 4, 240, '2', 5),
(29, 3, 4, 240, '2', 5),
(30, 1, 2, 100, '2', 5),
(31, 1, 2, 100, '2', 5),
(32, 4, 1, 50, '2', 5),
(33, 4, 1, 50, '2', 5),
(34, 5, 1, 60, '2', 5),
(35, 10, 1, 40, '2', 5),
(36, 11, 1, 40, '2', 5),
(37, 5, 1, 60, '2', 5),
(38, 10, 1, 40, '2', 5),
(39, 11, 1, 40, '2', 5),
(40, 7, 3, 180, '2', 19),
(41, 3, 1, 60, '2', 20),
(42, 7, 1, 60, '2', 21),
(44, 2, 2, 90, '2', 22),
(45, 3, 1, 60, '2', 22),
(46, 1, 3, 150, '2', 22),
(47, 5, 2, 120, '2', 22),
(48, 1, 3, 150, '2', 22),
(49, 1, 4, 200, '2', 22),
(50, 7, 1, 60, '2', 25),
(51, 1, 2, 100, '3', 26),
(52, 4, 2, 100, '3', 26),
(53, 3, 1, 60, '3', 26),
(54, 5, 1, 60, '2', 27),
(55, 4, 3, 150, '2', 27),
(56, 5, 1, 60, '2', 27),
(57, 4, 3, 150, '2', 27),
(58, 2, 1, 45, '2', 28),
(59, 1, 1, 50, '2', 28),
(60, 4, 1, 50, '2', 28),
(61, 2, 1, 45, '2', 28),
(62, 1, 1, 50, '2', 28),
(63, 4, 1, 50, '2', 28),
(64, 3, 1, 60, '2', 30),
(65, 1, 1, 50, '2', 30),
(66, 6, 1, 60, '2', 30),
(67, 3, 1, 60, '2', 30),
(68, 2, 1, 45, '2', 31),
(69, 4, 1, 50, '2', 31),
(70, 1, 1, 50, '2', 32),
(71, 4, 1, 50, '2', 32),
(72, 5, 1, 60, '2', 32),
(73, 4, 2, 100, '2', 32),
(74, 6, 2, 120, '2', 32),
(75, 7, 2, 120, '2', 32),
(76, 9, 1, 60, '2', 32),
(77, 2, 1, 45, '2', 33),
(79, 7, 2, 120, '2', 22),
(80, 7, 1, 60, '2', 34),
(81, 6, 1, 60, '2', 35),
(82, 6, 1, 60, '2', 39),
(83, 7, 2, 120, '2', 38),
(84, 3, 2, 120, '2', 38),
(86, 2, 2, 90, '2', 38),
(87, 3, 2, 120, '2', 38),
(88, 2, 2, 90, '2', 38),
(89, 2, 2, 90, '2', 38),
(90, 7, 2, 120, '2', 43),
(91, 8, 2, 120, '2', 44),
(92, 11, 2, 80, '2', 44),
(93, 6, 1, 60, '2', 33),
(94, 8, 1, 60, '2', 33),
(95, 4, 1, 50, '2', 45),
(96, 7, 1, 60, '2', 45),
(97, 5, 1, 60, '2', 46),
(98, 7, 1, 60, '2', 46),
(99, 2, 1, 45, '2', 45),
(100, 2, 1, 45, '2', 49),
(101, 3, 2, 120, '2', 49),
(102, 4, 2, 100, '2', 49),
(103, 3, 1, 60, '2', 51),
(104, 1, 1, 50, '2', 51),
(105, 4, 2, 100, '2', 51),
(107, 4, 2, 100, '2', 56),
(108, 10, 1, 40, '2', 51),
(109, 11, 1, 40, '2', 51),
(110, 4, 2, 100, '2', 57),
(111, 9, 1, 60, '2', 57),
(112, 11, 1, 40, '2', 57),
(113, 3, 2, 120, '2', 58),
(114, 1, 1, 50, '2', 58),
(115, 5, 4, 240, '2', 58),
(116, 5, 4, 240, '2', 58),
(117, 1, 1, 50, '1', 42),
(118, 6, 1, 60, '1', 42),
(121, 1, 1, 50, '2', 60),
(122, 2, 1, 45, '2', 61),
(123, 1, 1, 50, '2', 61),
(124, 4, 1, 50, '2', 61),
(127, 3, 2, 120, '2', 63),
(128, 2, 1, 45, '2', 63),
(129, 6, 2, 120, '2', 63),
(130, 8, 2, 120, '2', 63),
(131, 6, 2, 120, '2', 64),
(132, 8, 2, 120, '2', 64),
(133, 9, 1, 60, '2', 64),
(134, 10, 4, 160, '2', 64),
(135, 2, 1, 45, '2', 65),
(136, 3, 1, 60, '2', 65),
(137, 1, 1, 50, '2', 65),
(138, 5, 1, 60, '2', 67),
(139, 3, 1, 60, '2', 67),
(140, 10, 1, 40, '2', 67),
(141, 2, 2, 90, '2', 68),
(142, 1, 1, 50, '2', 69),
(143, 1, 1, 50, '2', 69),
(144, 6, 1, 60, '2', 70),
(145, 8, 3, 180, '2', 70),
(146, 10, 2, 80, '2', 70),
(147, 6, 1, 60, '2', 70),
(148, 10, 1, 40, '2', 73),
(150, 4, 2, 100, '2', 74),
(151, 5, 1, 60, '2', 74),
(152, 1, 1, 50, '2', 74),
(153, 3, 1, 60, '1', 74),
(154, 11, 2, 80, '2', 76),
(155, 6, 3, 180, '0', 78),
(156, 5, 10, 600, '0', 78),
(157, 4, 1, 50, '2', 79),
(158, 5, 1, 60, '2', 79),
(161, 7, 2, 120, '2', 81),
(162, 6, 2, 120, '0', 81),
(163, 6, 2, 120, '2', 81),
(164, 2, 2, 90, '1', 84),
(165, 6, 2, 120, '1', 84),
(166, 11, 2, 80, '1', 84),
(167, 2, 3, 135, '0', 89),
(168, 8, 1, 60, '0', 90),
(169, 8, 1, 60, '0', 90);

-- --------------------------------------------------------

--
-- Table structure for table `ordertable`
--

CREATE TABLE IF NOT EXISTS `ordertable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tableid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `startdatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `enddatetime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `amount` int(10) NOT NULL,
  `customername` varchar(15) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `grandtotal` int(11) NOT NULL,
  `status` varchar(15) NOT NULL,
  `paymentstatus` varchar(15) NOT NULL,
  `paymentmode` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=93 ;

--
-- Dumping data for table `ordertable`
--

INSERT INTO `ordertable` (`id`, `tableid`, `userid`, `startdatetime`, `enddatetime`, `amount`, `customername`, `phone`, `grandtotal`, `status`, `paymentstatus`, `paymentmode`, `discount`) VALUES
(1, 1, 1, '2015-10-21 04:49:10', '0000-00-00 00:00:00', 450, '', '', 481, '3', 'paid', 2, 0),
(3, 5, 1, '2015-10-20 04:02:15', '0000-00-00 00:00:00', 240, '', '', 259, '3', 'paid', 2, 0),
(4, 7, 1, '2015-10-21 04:48:33', '0000-00-00 00:00:00', 180, '', '', 192, '3', 'paid', 2, 0),
(5, 2, 1, '2015-10-29 16:12:00', '2015-10-28 13:00:52', 1900, '', '', 2052, '3', 'paid', 4, 20),
(6, 8, 1, '2015-10-27 12:56:05', '2015-10-27 12:56:05', 90, '', '', 0, '0', '', 0, 0),
(7, 9, 1, '2015-10-27 23:02:55', '0000-00-00 00:00:00', 0, '', '', 0, '4', 'unpaid', 0, 0),
(8, 10, 1, '2015-10-30 05:25:55', '0000-00-00 00:00:00', 0, '', '', 0, '4', '', 0, 0),
(9, 1, 1, '2015-10-27 12:19:10', '2015-10-27 10:37:35', 150, '', '', 162, '3', 'paid', 2, 0),
(10, 6, 1, '2015-10-29 10:58:46', '2015-10-29 10:58:46', 45, '', '', 0, '0', 'unpaid', 0, 0),
(11, 8, 1, '2015-11-01 20:22:59', '2015-11-01 20:22:59', 165, '', '', 0, '0', 'unpaid', 0, 0),
(12, 4, 1, '2015-10-27 23:03:02', '2015-10-27 23:03:02', 480, '', '', 0, '0', 'unpaid', 0, 0),
(13, 3, 1, '2015-10-27 21:11:42', '0000-00-00 00:00:00', 0, '', '', 0, '3', 'paid', 2, 0),
(14, 1, 1, '2015-10-29 11:00:10', '0000-00-00 00:00:00', 0, '', '', 0, '4', 'unpaid', 0, 0),
(15, 4, 1, '2015-10-30 15:53:47', '0000-00-00 00:00:00', 0, '', '', 0, '4', 'unpaid', 0, 0),
(16, 3, 1, '2015-10-28 05:23:04', '2015-10-28 05:23:04', 140, '', '', 0, '0', 'unpaid', 0, 0),
(17, 8, 1, '2015-10-28 06:07:29', '2015-10-28 05:34:31', 40, '', '', 43, '3', 'paid', 2, 0),
(18, 6, 1, '2015-10-28 12:51:28', '0000-00-00 00:00:00', 0, '', '', 0, '3', 'paid', 4, 0),
(19, 4, 11, '2015-10-29 09:00:44', '2015-10-28 13:02:52', 180, '', '', 194, '3', 'paid', 2, 0),
(20, 1, 1, '2015-10-29 16:47:01', '2015-10-29 16:47:01', 60, '', '', 0, '0', 'unpaid', 0, 0),
(21, 1, 1, '2015-10-29 23:43:54', '0000-00-00 00:00:00', 60, '', '', 65, '3', 'paid', 4, 0),
(22, 6, 1, '2015-10-31 16:50:13', '2015-10-31 15:33:20', 890, '', '', 832, '3', 'paid', 4, 0),
(23, 2, 1, '2015-10-29 21:16:25', '2015-10-29 21:14:34', 0, '', '', 0, '3', 'paid', 2, 0),
(24, 1, 1, '2015-10-29 21:19:24', '2015-10-29 21:19:24', 0, '', '', 0, '0', 'unpaid', 0, 0),
(25, 0, 1, '2015-11-01 23:32:38', '0000-00-00 00:00:00', 60, '', '', 65, '1', 'unpaid', 0, 0),
(26, 4, 1, '2015-10-30 13:14:21', '0000-00-00 00:00:00', 0, '', '', 0, '4', 'unpaid', 0, 0),
(27, 7, 1, '2015-10-30 14:55:52', '2015-10-30 14:55:52', 420, '', '', 0, '0', 'unpaid', 0, 0),
(28, 1, 1, '2015-10-30 15:10:32', '2015-10-30 15:10:32', 0, '', '', 0, '0', 'unpaid', 0, 0),
(29, 0, 1, '2015-11-01 23:36:25', '0000-00-00 00:00:00', 0, '', '', 0, '1', 'unpaid', 0, 0),
(30, 9, 1, '2015-10-30 15:55:18', '2015-10-30 15:53:56', 230, '', '', 248, '3', 'paid', 2, 0),
(31, 2, 1, '2015-10-31 04:17:03', '2015-10-31 04:17:03', 95, '', '', 0, '0', 'unpaid', 0, 0),
(32, 2, 1, '2015-10-31 09:22:58', '2015-10-31 09:22:58', 560, '', '', 0, '0', 'unpaid', 0, 0),
(33, 6, 1, '2015-11-01 23:56:53', '2015-11-01 23:56:53', 45, '', '', 0, '0', 'unpaid', 0, 0),
(34, 3, 1, '2015-11-01 23:33:48', '2015-11-01 23:33:48', 60, '', '', 0, '0', 'unpaid', 0, 0),
(35, 10, 1, '2015-11-04 00:48:55', '2015-11-04 00:48:55', 60, '', '', 0, '0', 'unpaid', 0, 0),
(36, 8, 1, '2015-10-31 15:25:59', '0000-00-00 00:00:00', 0, '', '', 0, '4', 'unpaid', 0, 0),
(37, 6, 1, '2015-10-31 16:49:40', '0000-00-00 00:00:00', 0, '', '', 0, '3', 'paid', 2, 0),
(38, 4, 1, '2015-11-04 00:49:11', '2015-11-04 00:49:11', 630, '', '', 0, '0', 'unpaid', 0, 0),
(39, 1, 1, '2015-11-01 03:56:41', '2015-11-01 03:51:06', 60, '', '', 65, '3', 'paid', 4, 0),
(40, 10, 1, '2015-11-01 03:45:58', '2015-11-01 03:45:58', 0, '', '', 0, '0', 'unpaid', 0, 0),
(41, 8, 1, '2015-11-04 00:49:22', '0000-00-00 00:00:00', 0, '', '', 0, '4', 'unpaid', 0, 0),
(42, 0, 1, '2015-11-06 13:51:54', '0000-00-00 00:00:00', 0, '', '', 0, '1', 'unpaid', 0, 0),
(43, 6, 1, '2015-11-01 23:37:17', '2015-11-01 23:37:17', 120, '', '', 0, '0', 'unpaid', 0, 0),
(44, 9, 1, '2015-11-01 23:40:00', '2015-11-01 23:40:00', 200, '', '', 0, '0', 'unpaid', 0, 0),
(45, 4, 1, '2015-11-04 05:00:17', '0000-00-00 00:00:00', 155, '', '', 167, '3', 'paid', 2, 0),
(46, 1, 1, '2015-11-02 00:10:17', '2015-11-02 00:02:28', 120, '', '', 130, '3', 'paid', 2, 0),
(47, 1, 1, '2015-11-02 14:25:04', '0000-00-00 00:00:00', 0, '', '', 0, '4', 'unpaid', 0, 0),
(48, 8, 1, '2015-11-02 12:43:55', '2015-11-02 12:43:55', 0, '', '', 0, '0', 'unpaid', 0, 0),
(49, 3, 1, '2015-11-02 13:37:19', '2015-11-02 13:37:19', 265, '', '', 0, '0', 'unpaid', 0, 0),
(50, 3, 1, '2015-11-02 14:25:10', '0000-00-00 00:00:00', 0, '', '', 0, '4', 'unpaid', 0, 0),
(51, 6, 1, '2015-11-04 05:17:03', '2015-11-04 05:17:03', 290, '', '', 0, '0', 'unpaid', 0, 0),
(52, 2, 11, '2015-11-04 05:40:28', '0000-00-00 00:00:00', 0, '', '', 0, '4', 'unpaid', 0, 0),
(53, 1, 1, '2015-11-04 05:17:18', '0000-00-00 00:00:00', 0, '', '', 0, '4', 'unpaid', 0, 0),
(54, 10, 11, '2015-11-04 05:40:32', '0000-00-00 00:00:00', 0, '', '', 0, '4', 'unpaid', 0, 0),
(55, 8, 1, '2015-11-04 04:55:28', '2015-11-04 04:55:28', 0, '', '', 0, '0', 'unpaid', 0, 0),
(56, 4, 1, '2015-11-04 09:33:01', '2015-11-04 09:33:01', 100, '', '', 0, '0', 'unpaid', 0, 0),
(57, 3, 1, '2015-11-04 05:37:13', '2015-11-04 05:35:16', 200, '', '', 216, '3', 'paid', 2, 0),
(58, 2, 1, '2015-11-04 09:38:54', '2015-11-04 09:38:14', 650, '', '', 702, '3', 'paid', 2, 0),
(59, 3, 1, '2015-11-04 11:23:07', '0000-00-00 00:00:00', 0, '', '', 0, '4', 'unpaid', 0, 0),
(60, 6, 1, '2015-11-04 12:18:31', '2015-11-04 12:18:31', 50, '', '', 0, '0', 'unpaid', 0, 0),
(61, 6, 1, '2015-11-04 21:31:43', '2015-11-04 21:31:43', 145, '', '', 0, '0', 'unpaid', 0, 0),
(62, 1, 1, '2015-11-05 02:58:31', '2015-11-05 02:58:31', 0, '', '', 0, '0', 'unpaid', 0, 0),
(63, 4, 1, '2015-11-05 07:18:02', '2015-11-05 07:18:02', 405, '', '', 0, '0', 'unpaid', 0, 0),
(64, 1, 1, '2015-11-05 04:45:44', '2015-11-05 04:45:44', 460, '', '', 0, '0', 'unpaid', 0, 0),
(65, 1, 1, '2015-11-05 11:18:47', '2015-11-05 11:18:47', 155, '', '', 0, '0', 'unpaid', 0, 0),
(66, 4, 1, '2015-11-05 12:46:37', '0000-00-00 00:00:00', 0, '', '', 0, '4', 'unpaid', 0, 0),
(67, 2, 1, '2015-11-05 13:04:08', '2015-11-05 13:03:09', 160, '', '', 173, '3', 'paid', 2, 0),
(68, 2, 1, '2015-11-05 17:38:32', '2015-11-05 17:38:32', 90, '', '', 0, '0', 'unpaid', 0, 0),
(69, 10, 1, '2015-11-05 17:16:55', '0000-00-00 00:00:00', 100, '', '', 0, '3', 'paid', 2, 0),
(70, 4, 1, '2015-11-06 12:27:39', '2015-11-06 12:27:39', 380, '', '', 0, '0', 'unpaid', 0, 0),
(71, 10, 1, '2015-11-05 18:17:54', '0000-00-00 00:00:00', 0, '', '', 0, '4', 'unpaid', 0, 0),
(72, 6, 1, '2015-11-05 18:41:32', '0000-00-00 00:00:00', 0, '', '', 0, '4', 'unpaid', 0, 0),
(73, 3, 1, '2015-11-05 18:50:01', '2015-11-05 18:50:01', 40, '', '', 0, '0', 'unpaid', 0, 0),
(74, 3, 1, '2015-11-07 04:03:21', '2015-11-07 04:03:21', 270, '', '', 0, '0', 'unpaid', 0, 0),
(75, 1, 1, '2015-11-05 18:59:49', '2015-11-05 18:59:49', 0, '', '', 0, '0', 'unpaid', 0, 0),
(76, 2, 1, '2015-11-06 09:23:49', '0000-00-00 00:00:00', 80, '', '', 86, '3', 'paid', 2, 0),
(77, 10, 1, '2015-11-06 12:28:03', '0000-00-00 00:00:00', 0, '', '', 0, '4', 'unpaid', 0, 0),
(78, 0, 1, '2015-11-06 16:51:41', '0000-00-00 00:00:00', 0, '', '', 0, '1', 'unpaid', 0, 0),
(79, 3, 1, '2015-11-06 20:48:19', '0000-00-00 00:00:00', 110, '', '', 119, '3', 'paid', 2, 0),
(80, 4, 1, '2015-11-06 20:03:38', '2015-11-06 16:53:18', 0, '', '', 0, '3', 'paid', 2, 0),
(81, 9, 1, '2015-11-06 22:09:54', '2015-11-06 22:09:54', 360, '', '', 0, '0', 'unpaid', 0, 0),
(82, 3, 1, '2015-11-07 02:08:43', '2015-11-07 02:08:43', 0, '', '', 0, '0', 'unpaid', 0, 0),
(83, 4, 1, '2015-11-07 07:29:54', '2015-11-07 07:29:54', 0, '', '', 0, '0', 'unpaid', 0, 0),
(84, 2, 1, '2015-11-07 12:43:01', '2015-11-07 12:43:01', 290, '', '', 0, '0', 'unpaid', 0, 0),
(85, 9, 1, '2015-11-07 08:55:22', '2015-11-07 08:55:22', 0, '', '', 0, '0', 'unpaid', 0, 0),
(86, 3, 1, '2015-11-08 18:49:55', '2015-11-08 18:49:55', 0, '', '', 0, '0', 'unpaid', 0, 0),
(87, 2, 1, '2015-11-08 22:02:32', '0000-00-00 00:00:00', 0, '', '', 0, '4', 'unpaid', 0, 0),
(88, 2, 1, '2015-11-08 22:03:01', '2015-11-08 22:03:01', 0, '', '', 0, '0', 'unpaid', 0, 0),
(89, 2, 1, '2015-11-08 22:03:56', '2015-11-08 22:03:56', 135, '', '', 0, '0', 'unpaid', 0, 0),
(90, 3, 1, '2015-11-08 22:05:46', '2015-11-08 22:05:46', 120, '', '', 0, '0', 'unpaid', 0, 0),
(91, 2, 1, '2015-11-09 09:40:25', '0000-00-00 00:00:00', 0, '', '', 0, '1', 'unpaid', 0, 0),
(92, 6, 1, '2015-11-09 10:09:21', '0000-00-00 00:00:00', 0, '', '', 0, '1', 'unpaid', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `paymentmode`
--

CREATE TABLE IF NOT EXISTS `paymentmode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `paymentmode`
--

INSERT INTO `paymentmode` (`id`, `type`) VALUES
(2, 'Cash'),
(4, 'Card');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `currency` varchar(50) NOT NULL,
  `tax` int(5) NOT NULL,
  `vattax` int(5) NOT NULL,
  `additionaltax` int(5) NOT NULL,
  `discount` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `address`, `phone`, `currency`, `tax`, `vattax`, `additionaltax`, `discount`) VALUES
(1, 'Hotel Taj', 'Mumbai', '7899632563', 'RS', 2, 2, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tablemaster`
--

CREATE TABLE IF NOT EXISTS `tablemaster` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tablename` varchar(100) NOT NULL,
  `tablestatus` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tablemaster`
--

INSERT INTO `tablemaster` (`id`, `tablename`, `tablestatus`) VALUES
(1, 'Table 1', '1'),
(2, 'Table 2', '1'),
(3, 'Table 3', '0'),
(4, 'Table 4', '1'),
(5, 'Table 5', '1'),
(6, 'Table 6', '1'),
(7, 'Table 7', '1'),
(8, 'Table 8', '1'),
(9, 'Table 9', '1'),
(10, 'Table 10', '0');

-- --------------------------------------------------------

--
-- Table structure for table `usermaster`
--

CREATE TABLE IF NOT EXISTS `usermaster` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `usermaster`
--

INSERT INTO `usermaster` (`id`, `username`, `password`, `role`) VALUES
(1, 'John', '123456', 'user'),
(7, 'Roy', '12345', 'accountmanager'),
(10, 'Ketty', '12345', 'admin'),
(11, 'admin', 'admin@123', 'superadmin'),
(12, 'Mike', '12345', 'kitchenmanager');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
