-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2016 at 09:47 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rental_sys`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE IF NOT EXISTS `bank` (
  `bname` varchar(40) NOT NULL,
  `baddress` varchar(50) NOT NULL,
  `ownerid` int(11) NOT NULL,
  PRIMARY KEY (`bname`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`bname`, `baddress`, `ownerid`) VALUES
('BOI', 'BOI India', 11),
('HDFC', 'HDFC INDIA', 10),
('SBI', 'SBI address', 6),
('Texas Trust', '805 ST Center Street, Arlington', 4),
('Wells Fargo', 'Arlington', 12);

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE IF NOT EXISTS `car` (
  `VEHICLEID` int(25) NOT NULL AUTO_INCREMENT,
  `carname` varchar(25) NOT NULL,
  `CMODEL` varchar(25) NOT NULL,
  `CYEAR` varchar(25) NOT NULL,
  `COLOR` varchar(25) NOT NULL,
  `LICENSE_PLATE_NO` varchar(25) NOT NULL,
  `VEHICLE_TYPE` varchar(25) NOT NULL,
  `TYPE_ID` int(10) NOT NULL,
  PRIMARY KEY (`VEHICLEID`),
  UNIQUE KEY `VEHICLEID` (`VEHICLEID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2021 ;

--
-- Dumping data for table `car`
--

INSERT INTO `car` (`VEHICLEID`, `carname`, `CMODEL`, `CYEAR`, `COLOR`, `LICENSE_PLATE_NO`, `VEHICLE_TYPE`, `TYPE_ID`) VALUES
(1000, 'Cruze', 'Chevrolet', '2014', 'Black', 'BLV 235', 'Compact', 1),
(1001, 'Civic', 'Honda', '2015', 'Grey', 'GHJ 902', 'Medium', 2),
(1002, 'i40', 'Hyundai', '2013', 'Black', 'KLS 123', 'Medium', 2),
(1004, 'Passat', 'Volkswagen ', '2014', 'Brown', 'KLJ 879', 'Large', 3),
(1005, 'Tiguan', 'Volkswagen ', '2015', 'Silver', 'OLR 908', 'SUV', 4),
(1006, 'RAV4', 'Toyota', '2015', 'Black', 'FGH 1002', 'SUV', 4),
(1007, 'Santa Fe', 'Hyundai', '2014', 'Dark Blue', 'SDF 9022', 'SUV', 4),
(1009, 'Versa', 'Nissan', '2015', 'Light Blue', 'OOP 2400', 'Compact', 1),
(1010, 'Corolla', 'Toyota', '2015', 'Grey', 'UUU 9023', 'Large', 3),
(1011, 'Jetta', 'Volkswagen ', '2014', 'Brown', 'ULD 9021', 'Medium', 2),
(1012, 'Frontier', 'Nissan', '2015', 'Black', 'SKL 2381', 'Truck', 5),
(1013, 'Ram 1500 QC', 'Dodge', '2014', 'Silver', 'RRR 1000', 'Truck', 5),
(1014, 'Transit Wagon', 'Ford', '2013', 'White', 'ASD 12321', 'Van', 6),
(1015, 'Express Cargo', 'Chevrolet', '2014', 'White', 'GHF 2190', 'Van', 6),
(1016, 'Frontier', 'Nissan', '2015', 'Grey', 'SKL 2382', 'Truck', 5),
(1017, 'Van', 'Maruti', '2011', 'OffWhite', 'BXWE 2012', 'Compact', 1),
(2018, 'Focus', 'Ford', '2010', 'White', 'BEATS', 'SUV', 4),
(2019, 'EcoSport', 'Ford', '2011', 'White', 'BXERT', 'SUV', 4),
(2020, 'Poonu', 'Sangram', '2015', 'Black', 'BEATS', 'Compact', 1);

-- --------------------------------------------------------

--
-- Table structure for table `charge`
--

CREATE TABLE IF NOT EXISTS `charge` (
  `charge_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `cost` int(25) NOT NULL,
  PRIMARY KEY (`charge_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `charge`
--

INSERT INTO `charge` (`charge_id`, `name`, `cost`) VALUES
(1, 'Facility Charge', 10),
(2, 'Processing Fee', 2),
(3, 'Gov Tax (6%)', 7);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `cname` varchar(50) NOT NULL,
  `caddress` varchar(50) NOT NULL,
  `ownerid` int(11) NOT NULL,
  PRIMARY KEY (`cname`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`cname`, `caddress`, `ownerid`) VALUES
('Arlington Heights', '120 ST Michell Street, Arlington', 3),
('NGO', 'NGO TX', 7),
('State Farm', '120 ST Strooper, Arlington, TX', 2);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `idno` int(11) NOT NULL AUTO_INCREMENT,
  `initials` varchar(35) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `street` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `zipcode` varchar(35) NOT NULL,
  `phone` varchar(35) NOT NULL,
  `gender` varchar(35) NOT NULL,
  `email_address` varchar(35) NOT NULL,
  `username` varchar(35) NOT NULL,
  `password` varchar(35) NOT NULL,
  `password2` varchar(35) NOT NULL,
  `accounttype` varchar(35) NOT NULL,
  `signupdate` datetime(6) NOT NULL,
  PRIMARY KEY (`idno`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`idno`, `initials`, `lastname`, `street`, `city`, `state`, `zipcode`, `phone`, `gender`, `email_address`, `username`, `password`, `password2`, `accounttype`, `signupdate`) VALUES
(1, 'A', 'Admin', '305 South Cooper', 'Arlington', 'Texas', '76090', '8932102131', 'male', '111@hotmail.com', 'admin', '3dcf34a6023633a0d92521ec9c8d5ae4', '3dcf34a6023633a0d92521ec9c8d5ae4', 'admin', '2015-12-01 00:00:00.000000'),
(2, 'B', 'Sangram', '304 South Cooper', 'Arlington', 'Texas', '76090', '8934302131', 'male', 'test@gmail.com', 'testuser', '62a2cbf016fda6636c26e0ae2be09b5f', '62a2cbf016fda6636c26e0ae2be09b5f', 'user', '2015-12-02 00:00:00.000000'),
(3, 'A', 'Admin2', '305 South Cooper', 'Arlington', 'Texas', '76090', '8932102131', 'male', '111@hotmail.com', 'admin2', '3dcf34a6023633a0d92521ec9c8d5ae4', '3dcf34a6023633a0d92521ec9c8d5ae4', 'admin', '2015-12-02 00:00:00.000000'),
(4, 'B', 'Sangram', '304 South Cooper', 'Arlington', 'Texas', '76090', '8934302131', 'Male', 'testuser2@gmail.com', 'sangram123', '62a2cbf016fda6636c26e0ae2be09b5f', '62a2cbf016fda6636c26e0ae2be09b5f', 'user', '2015-11-10 00:00:00.000000'),
(5, 'Z', 'Piyush', '209 W Dakota Ave', 'Kerman', 'California', '76010', '8936572131', 'Male', 'piyush@gmail.com', 'piyush123', '62a2cbf016fda6636c26e0ae2be09b5f', '62a2cbf016fda6636c26e0ae2be09b5f', 'user', '2015-11-10 00:00:00.000000'),
(6, 'A', 'Mayur', '1989 Colonial Pkwy', 'ForthWorth', 'Texas', '65694', '9231031372', 'Male', 'mayur@gmail.com', 'mayur123', '62a2cbf016fda6636c26e0ae2be09b5f', '62a2cbf016fda6636c26e0ae2be09b5f', 'user', '2015-11-10 00:00:00.000000'),
(7, 'J', 'Jessica', '108 St Central', 'Austin', 'Texas', '90876', '8172320433', 'Female', 'jessica@gamil.com', 'jessica123', '62a2cbf016fda6636c26e0ae2be09b5f', '62a2cbf016fda6636c26e0ae2be09b5f', 'user', '2015-11-10 00:00:00.000000'),
(8, 'A', 'Kamran', '1232 Centennial Court', 'Arlington', 'Texas', '76010', '7821382136', 'male', 'kamran@gmail.com', 'kamran213', '62a2cbf016fda6636c26e0ae2be09b5f', '62a2cbf016fda6636c26e0ae2be09b5f', 'user', '2015-11-10 00:00:00.000000'),
(9, 'R', 'John', '108 Martin St', 'ForthWorth', 'Texas', '76110', '8123132113', 'male', 'pooja@gmail.com', 'john123', '62a2cbf016fda6636c26e0ae2be09b5f', '62a2cbf016fda6636c26e0ae2be09b5f', 'user', '2015-11-10 00:00:00.000000'),
(10, 'H', 'Sui', '908 Hts  on Pekan, Center Street', 'Arlington', 'Texas', '76090', '7213219102', 'Female', 'sui@gmail.com', 'sui123', '62a2cbf016fda6636c26e0ae2be09b5f', '62a2cbf016fda6636c26e0ae2be09b5f', 'user', '2015-11-10 00:00:00.000000'),
(11, 'S', 'Poonam', '304 Zen Apt, 805 South Center Street', 'Arlington', 'Texas', '76010', '1234567890', 'Female', 'poonam@gmail.com', 'poonam123', '62a2cbf016fda6636c26e0ae2be09b5f', '62a2cbf016fda6636c26e0ae2be09b5f', 'user', '2015-11-10 00:00:00.000000'),
(12, 'J', 'Pratik', '210 W Dakota Avenue 231', 'Kerman', 'California', '43454', '8936572143', 'male', 'piyush123', 'piyushz123', '62a2cbf016fda6636c26e0ae2be09b5f', '62a2cbf016fda6636c26e0ae2be09b5f', 'user', '2015-12-01 00:00:00.000000'),
(13, 'T', 'Priya', '805 S Center Street', 'Arlington', 'TX', '76010', '6825978884', 'female', 'priya@gmail.com', 'priya123', 'cfb077657c9b746245f0e9106c0f7660', 'cfb077657c9b746245f0e9106c0f7660', 'user', '2015-12-04 00:00:00.000000'),
(14, 'A', 'Jadhav', '805 S Center Street', 'Arlington', 'TX', '76010', '1234567890', 'male', 'sid@g.com', 'sid123', '62a2cbf016fda6636c26e0ae2be09b5f', '62a2cbf016fda6636c26e0ae2be09b5f', 'user', '2015-12-04 00:00:00.000000'),
(15, 'T', 'Harrison', '805 S Center Street', 'Arlington', 'TX', '76010', '4695001777', 'male', 'tom@gmail.com', 'tom123', '62a2cbf016fda6636c26e0ae2be09b5f', '62a2cbf016fda6636c26e0ae2be09b5f', 'user', '2015-12-04 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE IF NOT EXISTS `owner` (
  `OWNERID` int(10) NOT NULL AUTO_INCREMENT,
  `OWNERNAME` varchar(25) NOT NULL,
  PRIMARY KEY (`OWNERID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`OWNERID`, `OWNERNAME`) VALUES
(1, 'Person'),
(2, 'Company'),
(3, 'Company'),
(4, 'Bank'),
(5, 'Person'),
(6, 'Bank'),
(7, 'Company'),
(8, 'Person'),
(9, 'Person'),
(10, 'Bank'),
(11, 'Bank'),
(12, 'Bank');

-- --------------------------------------------------------

--
-- Table structure for table `owns`
--

CREATE TABLE IF NOT EXISTS `owns` (
  `OWNERID` int(11) NOT NULL,
  `VEHICLEID` varchar(10) NOT NULL,
  `PURCHASE_DATE` date NOT NULL,
  PRIMARY KEY (`OWNERID`,`VEHICLEID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `owns`
--

INSERT INTO `owns` (`OWNERID`, `VEHICLEID`, `PURCHASE_DATE`) VALUES
(1, '1001', '2015-02-19'),
(1, '1012', '2015-06-24'),
(1, '1016', '2015-06-24'),
(2, '1000', '2014-02-18'),
(2, '1005', '2015-04-19'),
(2, '1010', '2015-06-06'),
(2, '1011', '2014-04-19'),
(3, '1002', '2013-10-01'),
(3, '1009', '2015-03-30'),
(4, '1004', '2014-09-09'),
(4, '1006', '2015-05-20'),
(4, '1008', '2014-08-08'),
(4, '1013', '2014-02-19'),
(4, '1014', '2013-10-10'),
(4, '1015', '2014-06-30'),
(5, '1007', '2014-07-19'),
(10, '2018', '2014-04-20'),
(11, '2019', '2014-04-20'),
(12, '2020', '2014-04-20');

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE IF NOT EXISTS `person` (
  `ssn` int(11) NOT NULL,
  `pname` varchar(50) NOT NULL,
  `dl_no` varchar(25) NOT NULL,
  `address` varchar(50) NOT NULL,
  `ownerid` int(11) NOT NULL,
  PRIMARY KEY (`ssn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`ssn`, `pname`, `dl_no`, `address`, `ownerid`) VALUES
(1234567890, 'Piyush', '1234567890', 'W Dakota Ave, Kerman, CA 76010', 1),
(1234567891, 'Piyush Zode', '1234567891', '805, S Center Street', 8),
(1234567893, 'Sangram', '123456787', '805, S Center Street', 9),
(1438902829, 'Sam', '4354345677', 'ST Cooper Street, Hollywood, California', 5);

-- --------------------------------------------------------

--
-- Table structure for table `rate`
--

CREATE TABLE IF NOT EXISTS `rate` (
  `TYPEID` int(10) NOT NULL,
  `WEEKLY` decimal(25,2) NOT NULL,
  `DAILY` decimal(25,2) NOT NULL,
  `TYPENAME` varchar(25) NOT NULL,
  PRIMARY KEY (`TYPEID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rate`
--

INSERT INTO `rate` (`TYPEID`, `WEEKLY`, `DAILY`, `TYPENAME`) VALUES
(1, '270.99', '39.99', 'Compact'),
(2, '309.99', '77.99', 'Medium'),
(3, '344.99', '49.99', 'Large'),
(4, '382.99', '55.99', 'SUV'),
(5, '490.99', '70.99', 'Truck'),
(6, '621.99', '89.99', 'VAN');

-- --------------------------------------------------------

--
-- Table structure for table ` rents`
--

CREATE TABLE IF NOT EXISTS ` rents` (
  `VEHICLEID` int(11) NOT NULL AUTO_INCREMENT,
  `IDNO` int(11) NOT NULL,
  `NO_OF_DAYS` int(11) NOT NULL,
  `NO_OF_WEEKS` int(11) NOT NULL,
  `STARTDATE` date NOT NULL,
  `RETURNDATE` date NOT NULL,
  `AMTDUE` decimal(11,0) NOT NULL,
  PRIMARY KEY (`VEHICLEID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE IF NOT EXISTS `reservation` (
  `res_id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(11) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `location` varchar(25) NOT NULL,
  `pickup` date NOT NULL,
  `pickuptime` varchar(25) NOT NULL,
  `dropoff` date NOT NULL,
  `dropofftime` varchar(25) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(25) NOT NULL,
  `amtdue` varchar(10) NOT NULL,
  PRIMARY KEY (`res_id`,`vehicle_id`,`pickup`,`dropoff`,`user_id`,`amtdue`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`res_id`, `vehicle_id`, `phone`, `location`, `pickup`, `pickuptime`, `dropoff`, `dropofftime`, `user_id`, `status`, `amtdue`) VALUES
(1, 1014, '8172320433', 'Arlington', '2015-11-30', '12 p.m', '2015-12-13', '8 a.m', 7, 'pending', '1243.98'),
(2, 1012, '8936572131', 'Arlington', '2015-12-01', '8 a.m', '2015-12-07', '8 a.m', 5, 'pending', '490.99'),
(4, 1006, '8932102131', 'Arlington', '2015-12-15', '8 a.m', '2015-12-30', '10 a.m', 3, 'pending', '164.97'),
(7, 1016, '8932102131', 'Arlington', '2015-12-03', '8 a.m', '2015-12-04', '10 a.m', 1, 'pending', '70.98'),
(8, 1001, '8934302131', 'Arlington', '2015-12-05', '8 a.m', '2015-12-06', '8 a.m', 4, 'pending', '106.18'),
(19, 1000, '8934302131', 'Arlington', '2015-12-05', '8 a.m', '2015-12-07', '8 a.m', 4, 'pending', '71.38'),
(20, 2019, '4695001777', 'Arlington', '2015-12-05', '8 a.m', '2015-12-08', '8 a.m', 15, 'pending', '199.89'),
(21, 1006, '8932102131', 'Arlington', '2015-12-05', '8 a.m', '2015-12-12', '8 a.m', 1, 'pending', '3030.79'),
(22, 2020, '8932102131', 'Arlington', '2015-12-04', '8 a.m', '2015-12-10', '8 a.m', 1, 'pending', '285.53');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
