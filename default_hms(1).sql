-- phpMyAdmin SQL Dump
-- version 2.11.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 21, 2004 at 02:16 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `alovera`
--

-- --------------------------------------------------------

--
-- Table structure for table `accountbalance`
--

CREATE TABLE `accountbalance` (
  `id` int(11) NOT NULL auto_increment,
  `guestid` int(11) NOT NULL,
  `entrydate` date NOT NULL,
  `initial_deposit` int(100) NOT NULL,
  `grand_total` varchar(100) NOT NULL,
  `refund` int(100) NOT NULL,
  `balance` int(100) NOT NULL,
  `checkout` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `accountbalance`
--


-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin` varchar(300) NOT NULL,
  `id` int(10) NOT NULL auto_increment,
  `username` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `lastlogin` datetime NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin`, `id`, `username`, `password`, `lastlogin`) VALUES
('Executive', 3, 'executive', '08cb443ef348d8abf975c32ad473c0b2704ab531', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `companysetup`
--

CREATE TABLE `companysetup` (
  `company` varchar(300) NOT NULL,
  `id` int(20) NOT NULL auto_increment,
  `date` datetime NOT NULL,
  `address` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `tel` text NOT NULL,
  `logo` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `companysetup`
--

INSERT INTO `companysetup` (`company`, `id`, `date`, `address`, `email`, `tel`, `logo`) VALUES
('ALOVERA HOTEL ', 1, '2004-01-21 14:11:35', 'minna', 'musty4real2@gmail.com', '07068771913', '1074690695ra_bana_03.gif');

-- --------------------------------------------------------

--
-- Table structure for table `event_centre`
--

CREATE TABLE `event_centre` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `address` varchar(60) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `session` varchar(40) NOT NULL,
  `amount_paid` varchar(50) NOT NULL,
  `event_date` varchar(20) NOT NULL,
  `entry_date` date NOT NULL,
  `entry_time` time NOT NULL,
  `attendant` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `event_centre`
--


-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `id` int(11) NOT NULL auto_increment,
  `food_name` varchar(100) NOT NULL,
  `cost` int(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `food`
--


-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE `group` (
  `id` int(11) NOT NULL auto_increment,
  `companyname` varchar(100) NOT NULL,
  `surname` varchar(40) NOT NULL,
  `othername` varchar(40) NOT NULL,
  `phonenumber` int(10) NOT NULL,
  `inidep` int(10) NOT NULL,
  `receptionist` varchar(30) NOT NULL,
  `occupation` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `arrive_from` varchar(100) NOT NULL,
  `next_destination` varchar(100) NOT NULL,
  `checkin_date` date NOT NULL,
  `billingno` text NOT NULL,
  `sex` varchar(50) NOT NULL,
  `roomid` int(11) NOT NULL,
  `checkin_time` time NOT NULL,
  `checkout_date` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `identification` varchar(100) NOT NULL,
  `fulladdress` text NOT NULL,
  `room2_id` int(11) NOT NULL,
  `date_of_change` date NOT NULL,
  `checkout` int(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `group`
--


-- --------------------------------------------------------

--
-- Table structure for table `groupaccountbalance`
--

CREATE TABLE `groupaccountbalance` (
  `id` int(11) NOT NULL auto_increment,
  `guestid` int(11) NOT NULL,
  `entrydate` date NOT NULL,
  `initial_deposit` int(100) NOT NULL,
  `grand_total` varchar(100) NOT NULL,
  `refund` int(100) NOT NULL,
  `balance` int(100) NOT NULL,
  `checkout` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `groupaccountbalance`
--


-- --------------------------------------------------------

--
-- Table structure for table `groupgym`
--

CREATE TABLE `groupgym` (
  `id` int(11) NOT NULL auto_increment,
  `guestid` int(10) NOT NULL,
  `entrydate` date NOT NULL,
  `time` time NOT NULL,
  `num` int(10) NOT NULL,
  `cost` int(10) NOT NULL,
  `attendant` varchar(20) NOT NULL,
  `checkout` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `groupgym`
--


-- --------------------------------------------------------

--
-- Table structure for table `grouplaundry`
--

CREATE TABLE `grouplaundry` (
  `id` int(11) NOT NULL auto_increment,
  `guestid` int(11) NOT NULL,
  `cloth_type` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `cabinetnumber` varchar(100) NOT NULL,
  `entrydate` date NOT NULL,
  `staff` varchar(50) NOT NULL,
  `time` time NOT NULL,
  `quantity` text NOT NULL,
  `return` int(2) NOT NULL,
  `checkout` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `grouplaundry`
--


-- --------------------------------------------------------

--
-- Table structure for table `grouplaundryhistory`
--

CREATE TABLE `grouplaundryhistory` (
  `id` int(11) NOT NULL auto_increment,
  `guestid` int(11) NOT NULL,
  `cloth_type` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `cabinetnumber` varchar(100) NOT NULL,
  `entrydate` date NOT NULL,
  `staff` varchar(50) NOT NULL,
  `time` time NOT NULL,
  `guest_type` varchar(20) NOT NULL,
  `quantity` int(30) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `grouplaundryhistory`
--


-- --------------------------------------------------------

--
-- Table structure for table `groupresturant`
--

CREATE TABLE `groupresturant` (
  `id` int(11) NOT NULL auto_increment,
  `guestid` int(10) NOT NULL,
  `food_id` int(50) NOT NULL,
  `plate` int(10) NOT NULL,
  `cost` int(10) NOT NULL,
  `entrydate` date NOT NULL,
  `time` time NOT NULL,
  `waiter` varchar(30) NOT NULL,
  `checkout` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `groupresturant`
--


-- --------------------------------------------------------

--
-- Table structure for table `group_history`
--

CREATE TABLE `group_history` (
  `id` int(10) NOT NULL auto_increment,
  `guestid` int(10) NOT NULL,
  `date_in` varchar(40) NOT NULL,
  `date_out` varchar(40) NOT NULL,
  `staff` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `group_history`
--


-- --------------------------------------------------------

--
-- Table structure for table `hallrental`
--

CREATE TABLE `hallrental` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `address` varchar(60) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `session` varchar(40) NOT NULL,
  `amount_paid` varchar(50) NOT NULL,
  `event_date` varchar(20) NOT NULL,
  `entry_date` date NOT NULL,
  `entry_time` time NOT NULL,
  `attendant` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `hallrental`
--


-- --------------------------------------------------------

--
-- Table structure for table `outsidegym`
--

CREATE TABLE `outsidegym` (
  `id` int(11) NOT NULL auto_increment,
  `guestname` varchar(100) NOT NULL,
  `entrydate` date NOT NULL,
  `time` time NOT NULL,
  `num` int(10) NOT NULL,
  `cost` int(10) NOT NULL,
  `attendant` varchar(20) NOT NULL,
  `checkout` int(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `outsidegym`
--


-- --------------------------------------------------------

--
-- Table structure for table `outsidelaundry`
--

CREATE TABLE `outsidelaundry` (
  `id` int(11) NOT NULL auto_increment,
  `guestname` varchar(110) NOT NULL,
  `cloth_type` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `cabinetnumber` varchar(100) NOT NULL,
  `entrydate` date NOT NULL,
  `staff` varchar(50) NOT NULL,
  `time` time NOT NULL,
  `quantity` text NOT NULL,
  `return` int(2) NOT NULL,
  `checkout` int(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `outsidelaundry`
--


-- --------------------------------------------------------

--
-- Table structure for table `outsideresturant`
--

CREATE TABLE `outsideresturant` (
  `id` int(11) NOT NULL auto_increment,
  `guestname` varchar(100) NOT NULL,
  `food_id` int(50) NOT NULL,
  `plate` int(10) NOT NULL,
  `cost` int(10) NOT NULL,
  `entrydate` date NOT NULL,
  `time` time NOT NULL,
  `waiter` varchar(30) NOT NULL,
  `checkout` int(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `outsideresturant`
--


-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL auto_increment,
  `room_number` varchar(100) NOT NULL,
  `cost` varchar(100) NOT NULL,
  `room_category` varchar(100) NOT NULL,
  `room_location` varchar(100) NOT NULL,
  `room_type` varchar(100) NOT NULL,
  `room_availability` int(2) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `rooms`
--


-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `id` int(11) NOT NULL auto_increment,
  `section_name` varchar(100) NOT NULL,
  `visibility` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`id`, `section_name`, `visibility`) VALUES
(1, 'restaurant', 1),
(2, 'laundry', 1),
(4, 'gym', 1);

-- --------------------------------------------------------

--
-- Table structure for table `single`
--

CREATE TABLE `single` (
  `id` int(11) NOT NULL auto_increment,
  `surname` varchar(40) NOT NULL,
  `othername` varchar(40) NOT NULL,
  `phonenumber` int(10) NOT NULL,
  `inidep` int(10) NOT NULL,
  `receptionist` varchar(30) NOT NULL,
  `occupation` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `arrive_from` varchar(100) NOT NULL,
  `next_destination` varchar(100) NOT NULL,
  `checkin_date` date NOT NULL,
  `billingno` text NOT NULL,
  `sex` varchar(50) NOT NULL,
  `roomid` int(11) NOT NULL,
  `checkin_time` time NOT NULL,
  `checkout_date` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `identification` varchar(100) NOT NULL,
  `fulladdress` text NOT NULL,
  `room2_id` int(11) NOT NULL,
  `date_of_change` date NOT NULL,
  `checkout` int(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `single`
--


-- --------------------------------------------------------

--
-- Table structure for table `singlegym`
--

CREATE TABLE `singlegym` (
  `id` int(11) NOT NULL auto_increment,
  `guestid` int(10) NOT NULL,
  `entrydate` date NOT NULL,
  `time` time NOT NULL,
  `num` int(10) NOT NULL,
  `cost` int(10) NOT NULL,
  `attendant` varchar(20) NOT NULL,
  `checkout` int(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `singlegym`
--


-- --------------------------------------------------------

--
-- Table structure for table `singlelaundry`
--

CREATE TABLE `singlelaundry` (
  `id` int(11) NOT NULL auto_increment,
  `guestid` int(11) NOT NULL,
  `cloth_type` varchar(100) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `cabinetnumber` varchar(100) NOT NULL,
  `entrydate` date NOT NULL,
  `staff` varchar(50) NOT NULL,
  `time` time NOT NULL,
  `quantity` text NOT NULL,
  `return` int(2) NOT NULL,
  `checkout` int(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `singlelaundry`
--


-- --------------------------------------------------------

--
-- Table structure for table `singleresturant`
--

CREATE TABLE `singleresturant` (
  `id` int(11) NOT NULL auto_increment,
  `guestid` int(10) NOT NULL,
  `food_id` int(50) NOT NULL,
  `plate` int(10) NOT NULL,
  `cost` int(10) NOT NULL,
  `entrydate` date NOT NULL,
  `time` time NOT NULL,
  `waiter` varchar(30) NOT NULL,
  `checkout` int(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `singleresturant`
--


-- --------------------------------------------------------

--
-- Table structure for table `single_history`
--

CREATE TABLE `single_history` (
  `id` int(10) NOT NULL auto_increment,
  `guestid` int(10) NOT NULL,
  `date_in` varchar(40) NOT NULL,
  `date_out` varchar(40) NOT NULL,
  `staff` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `single_history`
--


-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `dept` varchar(100) NOT NULL,
  `entrydate` date NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `dept`, `entrydate`) VALUES
(2, 'musty', '12345', 'subadmin', '2004-01-21');
