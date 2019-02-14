-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2019 at 07:49 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ewastedb`
--
CREATE DATABASE IF NOT EXISTS `ewastedb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ewastedb`;

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `userKey` int(10) NOT NULL,
  `FirstName` tinytext NOT NULL,
  `LastName` tinytext NOT NULL,
  `UserName` varchar(40) NOT NULL,
  `Password` varchar(40) NOT NULL,
  `email` varchar(60) NOT NULL,
  `nationalid` int(8) NOT NULL,
  `image` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`userKey`, `FirstName`, `LastName`, `UserName`, `Password`, `email`, `nationalid`, `image`) VALUES
(4, 'elvis', 'kane', 'elviskane', 'pass', 'elviskane390@gmail.com', 33222212, '/ewasteonline/images/images (1).jpeg'),
(5, 'admin', 'admin', 'admin', 'admin145#@!', 'admin@gmail.com', 28373783, '/ewasteonline/images/admin_icon.png');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartKey` int(10) NOT NULL,
  `cartItems` varchar(5000) NOT NULL,
  `Subtotal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cartKey`, `cartItems`, `Subtotal`) VALUES
(36, '[{\"deviceKey\":\"3\",\"deviceName\":\"HUWAWEI SNAPDR2\",\"serialnumber\":\"SCBHB467GBD74BH\",\"age\":\"2\",\"price\":\"4000\",\"quantity\":\"1\"},{\"deviceKey\":\"2\",\"deviceName\":\"LG E3454 IDEA\",\"serialnumber\":\"SDFHHE643GGE674B47\",\"age\":\"4\",\"price\":\"6000\",\"quantity\":\"1\"}]', 0),
(37, '[{\"deviceKey\":0,\"deviceName\":\"INFINIX NOTE 3 PRO\",\"serialnumber\":\"GGBFGB677UJM888KKUGGH\",\"age\":\"1\",\"price\":\"4500\",\"quantity\":\"45\"},{\"deviceKey\":0,\"deviceName\":\"TOSHIBA HARD DISK\",\"serialnumber\":\"XFBFDG5Y4BV56Y5FGHDTYH\",\"age\":\"1\",\"price\":\"3000\",\"quantity\":\"1\"},{\"deviceKey\":0,\"deviceName\":\"DELL LAPTOP I3\",\"serialnumber\":\"VMOPI44-4FJN-04-094-R04\",\"age\":\"1\",\"price\":\"8000\",\"quantity\":\"5\"}]', 0),
(38, '[{\"deviceKey\":0,\"deviceName\":\"INFINIX NOTE 3 PRO\",\"serialnumber\":\"GGBFGB677UJM888KKUGGH\",\"age\":\"1\",\"price\":\"4500\",\"quantity\":\"45\"},{\"deviceKey\":0,\"deviceName\":\"TOSHIBA HARD DISK\",\"serialnumber\":\"XFBFDG5Y4BV56Y5FGHDTYH\",\"age\":\"1\",\"price\":\"3000\",\"quantity\":\"1\"},{\"deviceKey\":0,\"deviceName\":\"DELL LAPTOP I3\",\"serialnumber\":\"VMOPI44-4FJN-04-094-R04\",\"age\":\"1\",\"price\":\"8000\",\"quantity\":\"5\"}]', 0),
(39, '[{\"inventoryKey\":\"35\",\"deviceKey\":\"1\",\"deviceName\":\"ASDCASCASC\",\"price\":\"3000\",\"quantity\":\"1\"},{\"inventoryKey\":\"34\",\"deviceKey\":\"1\",\"deviceName\":\"TOSHIBA\",\"price\":\"3000\",\"quantity\":\"5\"},{\"inventoryKey\":\"33\",\"deviceKey\":\"1\",\"deviceName\":\"SEAGATE HARD DISK\",\"price\":\"3000\",\"quantity\":\"12\"},{\"inventoryKey\":\"32\",\"deviceKey\":\"2\",\"deviceName\":\"TAIFA V2 LAPTOP\",\"price\":\"6000\",\"quantity\":\"1\"},{\"inventoryKey\":\"30\",\"deviceKey\":\"2\",\"deviceName\":\"ACERS PREDITOR 345HP\",\"price\":\"6000\",\"quantity\":\"1\"}]', 0),
(40, '[{\"deviceKey\":\"10\",\"deviceName\":\"SONY E344\",\"serialnumber\":\"SDVGU67VD3VD63VV\",\"age\":\"1\",\"price\":\"8000\",\"quantity\":\"1\"}]', 0),
(41, '[{\"deviceKey\":0,\"deviceName\":\"SONY E344\",\"serialnumber\":\"SDVGU67VD3VD63VV\",\"age\":\"1\",\"price\":\"8000\",\"quantity\":\"1\"},{\"deviceKey\":0,\"deviceName\":\"INFINIX NOTE 3 PRO\",\"serialnumber\":\"GGBFGB677UJM888KKUGGH\",\"age\":\"45\",\"price\":\"4500\",\"quantity\":\"1\"},{\"deviceKey\":0,\"deviceName\":\"TOSHIBA HARD DISK\",\"serialnumber\":\"XFBFDG5Y4BV56Y5FGHDTYH\",\"age\":\"1\",\"price\":\"3000\",\"quantity\":\"1\"},{\"deviceKey\":0,\"deviceName\":\"DELL LAPTOP I3\",\"serialnumber\":\"VMOPI44-4FJN-04-094-R04\",\"age\":\"5\",\"price\":\"8000\",\"quantity\":\"1\"},{\"deviceKey\":0,\"deviceName\":\"INFINIX NOTE 3 PRO\",\"serialnumber\":\"GGBFGB677UJM888KKUGGH\",\"age\":\"45\",\"price\":\"4500\",\"quantity\":\"1\"},{\"deviceKey\":0,\"deviceName\":\"TOSHIBA HARD DISK\",\"serialnumber\":\"XFBFDG5Y4BV56Y5FGHDTYH\",\"age\":\"1\",\"price\":\"3000\",\"quantity\":\"1\"},{\"deviceKey\":0,\"deviceName\":\"DELL LAPTOP I3\",\"serialnumber\":\"VMOPI44-4FJN-04-094-R04\",\"age\":\"5\",\"price\":\"8000\",\"quantity\":\"1\"},{\"deviceKey\":0,\"deviceName\":\"HUWAWEI SNAPDR2\",\"serialnumber\":\"SCBHB467GBD74BH\",\"age\":\"1\",\"price\":\"4000\",\"quantity\":\"2\"},{\"deviceKey\":0,\"deviceName\":\"LG E3454 IDEA\",\"serialnumber\":\"SDFHHE643GGE674B47\",\"age\":\"1\",\"price\":\"6000\",\"quantity\":\"4\"},{\"deviceKey\":0,\"deviceName\":\"WD BLUE ITB\",\"serialnumber\":\"984BF834BRF84RF8734RB\",\"age\":\"1\",\"price\":\"3000\",\"quantity\":\"3\"}]', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cooperation`
--

CREATE TABLE `cooperation` (
  `userKey` int(10) NOT NULL,
  `Names` varchar(50) NOT NULL,
  `companyEmail` varchar(50) NOT NULL,
  `phonenumber` tinytext NOT NULL,
  `companyAddress` varchar(50) NOT NULL,
  `location` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `image` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cooperation`
--

INSERT INTO `cooperation` (`userKey`, `Names`, `companyEmail`, `phonenumber`, `companyAddress`, `location`, `password`, `image`) VALUES
(1, 'jkuat', 'jkuat@jkuat.ac.ke', '0293003993', 'icea NCBD nairobi', 'nairobi', 'jkuat', '/ewasteonline/images/jkuat.jpg'),
(2, 'icea', 'icea@gmail.com', '0767675645', 'icea builing moi avenue', 'nairobi', 'pass', '/ewasteonline/images/icea-lion-group.png'),
(5, 'mku Main', 'mku@gmail.com', '0738816237', 'mku@gmail.com', 'locale', 'mku', '/ewasteonline/images/mku.jpg'),
(6, 'Internet Solutions', 'internetsol@gmail.com', '0738847748', 'moi avenue Nairobi', 'Nairobi', 'internet', '/ewasteonline/images/Internet-solutions-kenya.jpg'),
(7, 'Safaricom Kenya', 'mobileoffice@safaricom.co.ke', '0722 00220', 'Westlands Nairobi Kenya', 'Nairobi', 'saf', '/ewasteonline/images/Twaweza_logo.png');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `userKey` int(10) NOT NULL,
  `FirstName` tinytext NOT NULL,
  `LastName` tinytext NOT NULL,
  `UserName` varchar(25) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `DateOfBirth` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `Phone` varchar(13) NOT NULL,
  `nationalid` int(8) NOT NULL,
  `Location` varchar(25) NOT NULL,
  `image` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`userKey`, `FirstName`, `LastName`, `UserName`, `Password`, `DateOfBirth`, `email`, `Phone`, `nationalid`, `Location`, `image`) VALUES
(1, 'jimmy', 'wats', 'jimmywats', 'wats', '2018-11-14', 'jimmy@gmail.com', '0741768464', 6466888, 'nairobi', '/ewasteonline/images/images (1).jpeg'),
(2, 'elvis', 'kane', 'elviskane', 'pass', '1995-03-12', 'elviskane390@gmail.com', '0741768464', 12312656, 'Nairobi jogo road', '/ewasteonline/images/75005_airplane_1.jpg'),
(4, 'luke', 'donovit', 'DOGNUT', 'KAS', '2004-01-13', 'mku@gmail.com', '07SAFGDSAF', 0, 'Nairobi', '/ewasteonline/images/34570979-set-of-vector-icons-of-fiction-into-flat-style-.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `device`
--

CREATE TABLE `device` (
  `deviceKey` int(10) NOT NULL,
  `manuKey` varchar(50) NOT NULL,
  `deviceName` varchar(50) NOT NULL,
  `price` double NOT NULL,
  `image` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `device`
--

INSERT INTO `device` (`deviceKey`, `manuKey`, `deviceName`, `price`, `image`) VALUES
(1, '1', 'HardDisk', 3000, '/ewasteonline/images/harddisk.jpg'),
(2, '2', 'LAPTOP', 6000, '/ewasteonline/images/laptop.jpg'),
(3, '3', 'SMART PHONES', 4000, '/ewasteonline/images/smartphone.jpg'),
(4, '3', 'REFRIGIRATOR', 8000, '/ewasteonline/images/fridge.jpg'),
(5, '1', 'COMPUTER MONITORS', 4500, '/ewasteonline/images/deskmonitors.jpg'),
(6, '5', 'CAMERAS', 10000, '/ewasteonline/images/camera.jpg'),
(7, '6', 'PRINTERS', 15450, '/ewasteonline/images/printer.jpg'),
(8, '7', 'MICROWAVES', 8000, '/ewasteonline/images/microwaves.jpg'),
(9, '8', 'RECHARGABLE BATTERIES', 50, '/ewasteonline/images/batteries.jpg'),
(10, '2', 'SPEAKERS', 8000, '/ewasteonline/images/speakers.jpg'),
(11, '5', 'PROJECTORS', 5000, '/ewasteonline/images/projector.jpg'),
(12, '3', 'TABLETS', 4500, '/ewasteonline/images/tablet.jpg'),
(13, '4', 'TELEVISIONS', 10000, '/ewasteonline/images/tvs.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `FeedsKey` int(10) NOT NULL,
  `userKey` int(10) NOT NULL,
  `usertype` int(11) NOT NULL DEFAULT '1',
  `token` varchar(20) NOT NULL,
  `isAdmin` int(1) NOT NULL,
  `messageTime` time NOT NULL,
  `message` varchar(500) NOT NULL,
  `replystatus` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`FeedsKey`, `userKey`, `usertype`, `token`, `isAdmin`, `messageTime`, `message`, `replystatus`) VALUES
(49, 2, 1, 'ExOZNQUFco794gSkBzid', 0, '08:15:00', 'HELLO ADMIN', 1),
(50, 2, 1, 'ExOZNQUFco794gSkBzid', 1, '08:16:00', 'HELLO ', 0);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `inventoryKey` int(10) NOT NULL,
  `cartKey` int(10) NOT NULL,
  `recycler_cart` int(11) NOT NULL DEFAULT '0',
  `deviceKey` int(10) NOT NULL DEFAULT '0',
  `recyclerKey` int(10) NOT NULL,
  `deviceName` varchar(30) NOT NULL,
  `serialNumber` varchar(50) NOT NULL,
  `quantity` int(50) NOT NULL,
  `price` double NOT NULL,
  `age` int(2) NOT NULL,
  `sellDate` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`inventoryKey`, `cartKey`, `recycler_cart`, `deviceKey`, `recyclerKey`, `deviceName`, `serialNumber`, `quantity`, `price`, `age`, `sellDate`) VALUES
(23, 19, 23, 0, 1, 'DELL LAPTOP I3', 'VMOPI44-4FJN-04-094-R04', 5, 8000, 1, '2019-01-16'),
(25, 21, 20, 0, 1, 'DELL LAPTOP I3', 'VMOPI44-4FJN-04-094-R04', 5, 8000, 1, '2019-01-17'),
(26, 0, 25, 2, 1, 'TAIFA LAPTOP I3', 'LKCL EF892938FB93BR98', 1, 6000, 5, '2019-01-18'),
(27, 24, 26, 3, 1, 'ININIX NOTE 3 PRO', 'NWEFNWE8F3IR983RN398F', 1, 4000, 2, '2019-01-18'),
(28, 22, 32, 4, 1, 'LG REFIDG3E 3000', 'ICNSEWDJWEP2393RN39R3N', 5, 8000, 10, '2019-01-18'),
(29, 28, 34, 1, 1, 'TOSHIBA HARDDISK', '39NFH93BF9WBR9W34BF49', 1, 3000, 3, '2019-01-19'),
(30, 0, 39, 2, 1, 'ACERS PREDITOR 345HP', 'CH83NF9WNFWEFFN49494', 1, 6000, 3, '2019-01-19'),
(31, 29, 32, 4, 1, 'LG SUPERCOOLANT DOUBLE CABIN E', 'VRV734NRF983NR2093RN3', 1, 8000, 5, '2019-01-19'),
(32, 0, 39, 2, 1, 'TAIFA V2 LAPTOP', 'VER8309NV0843R094R', 1, 6000, 4, '2019-01-19'),
(33, 30, 39, 1, 1, 'SEAGATE HARD DISK', 'OSMDCO903ND093 R20-9DFN', 12, 3000, 2, '2019-01-19'),
(34, 30, 39, 1, 1, 'TOSHIBA', 'HT7F57FD5', 5, 3000, 5, '2019-01-19'),
(35, 31, 39, 1, 1, 'ASDCASCASC', 'ASCWAEF43CSAD', 1, 3000, 1, '2019-01-19'),
(36, 31, 0, 4, 0, 'AFDSD', 'VADGV3', 1, 8000, 21, '2019-01-19'),
(37, 33, 0, 1, 0, 'WD BLUE ITB', '984BF834BRF84RF8734RB', 1, 3000, 3, '2019-01-22'),
(38, 36, 0, 2, 0, 'LG E3454 IDEA', 'SDFHHE643GGE674B47', 1, 6000, 4, '2019-01-28'),
(39, 36, 0, 3, 0, 'HUWAWEI SNAPDR2', 'SCBHB467GBD74BH', 1, 4000, 2, '2019-01-28'),
(40, 37, 0, 0, 0, 'DELL LAPTOP I3', 'VMOPI44-4FJN-04-094-R04', 5, 8000, 1, '2019-01-28'),
(41, 37, 0, 0, 0, 'TOSHIBA HARD DISK', 'XFBFDG5Y4BV56Y5FGHDTYH', 1, 3000, 1, '2019-01-28'),
(42, 37, 0, 0, 0, 'INFINIX NOTE 3 PRO', 'GGBFGB677UJM888KKUGGH', 45, 4500, 1, '2019-01-28'),
(43, 38, 0, 0, 0, 'DELL LAPTOP I3', 'VMOPI44-4FJN-04-094-R04', 5, 8000, 1, '2019-01-28'),
(44, 38, 0, 0, 0, 'TOSHIBA HARD DISK', 'XFBFDG5Y4BV56Y5FGHDTYH', 1, 3000, 1, '2019-01-28'),
(45, 38, 0, 0, 0, 'INFINIX NOTE 3 PRO', 'GGBFGB677UJM888KKUGGH', 45, 4500, 1, '2019-01-28'),
(46, 40, 0, 10, 0, 'SONY E344', 'SDVGU67VD3VD63VV', 1, 8000, 1, '2019-01-28'),
(47, 41, 0, 0, 0, 'WD BLUE ITB', '984BF834BRF84RF8734RB', 3, 3000, 1, '2019-01-31'),
(48, 41, 0, 0, 0, 'LG E3454 IDEA', 'SDFHHE643GGE674B47', 4, 6000, 1, '2019-01-31'),
(49, 41, 0, 0, 0, 'HUWAWEI SNAPDR2', 'SCBHB467GBD74BH', 2, 4000, 1, '2019-01-31'),
(50, 41, 0, 0, 0, 'DELL LAPTOP I3', 'VMOPI44-4FJN-04-094-R04', 1, 8000, 5, '2019-01-31'),
(51, 41, 0, 0, 0, 'TOSHIBA HARD DISK', 'XFBFDG5Y4BV56Y5FGHDTYH', 1, 3000, 1, '2019-01-31'),
(52, 41, 0, 0, 0, 'INFINIX NOTE 3 PRO', 'GGBFGB677UJM888KKUGGH', 1, 4500, 45, '2019-01-31'),
(53, 41, 0, 0, 0, 'DELL LAPTOP I3', 'VMOPI44-4FJN-04-094-R04', 1, 8000, 5, '2019-01-31'),
(54, 41, 0, 0, 0, 'TOSHIBA HARD DISK', 'XFBFDG5Y4BV56Y5FGHDTYH', 1, 3000, 1, '2019-01-31'),
(55, 41, 0, 0, 0, 'INFINIX NOTE 3 PRO', 'GGBFGB677UJM888KKUGGH', 1, 4500, 45, '2019-01-31'),
(56, 41, 0, 0, 0, 'SONY E344', 'SDVGU67VD3VD63VV', 1, 8000, 1, '2019-01-31');

-- --------------------------------------------------------

--
-- Table structure for table `manufacturer`
--

CREATE TABLE `manufacturer` (
  `manuKey` int(10) NOT NULL,
  `manufacturerNames` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manufacturer`
--

INSERT INTO `manufacturer` (`manuKey`, `manufacturerNames`) VALUES
(1, 'TOSHIBA INDUSTRIES'),
(2, 'SONY ERRICSON COMPANY'),
(3, 'SAMSUNG LIMITED'),
(4, 'HISENSE INDUSTRIES'),
(5, 'CANNON CAMERAS IND.'),
(6, 'HP INDUSTRIES'),
(7, 'LG ELECTRONICS'),
(8, 'EVER READY ');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `paymentKey` int(10) NOT NULL,
  `pickupKey` int(10) NOT NULL,
  `mpesaCode` varchar(20) NOT NULL,
  `paymentStatus` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`paymentKey`, `pickupKey`, `mpesaCode`, `paymentStatus`) VALUES
(10, 20, 'DHHDS764B74B7BCFFF55', 1),
(11, 21, 'pending....', 0),
(12, 23, 'pending....', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pickup_order`
--

CREATE TABLE `pickup_order` (
  `pickupKey` int(10) NOT NULL,
  `cartKey` int(10) NOT NULL,
  `userKey` int(10) NOT NULL,
  `usertype` int(11) NOT NULL DEFAULT '1',
  `amountPayable` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pickup_order`
--

INSERT INTO `pickup_order` (`pickupKey`, `cartKey`, `userKey`, `usertype`, `amountPayable`) VALUES
(20, 36, 5, 2, 10000),
(21, 37, 5, 2, 245500),
(22, 39, 1, 3, 66000),
(23, 40, 2, 1, 8000);

-- --------------------------------------------------------

--
-- Table structure for table `recycler`
--

CREATE TABLE `recycler` (
  `recyclerKey` int(10) NOT NULL,
  `recyclerEmail` varchar(50) NOT NULL,
  `recyclerAddress` varchar(50) NOT NULL,
  `recyclerPhone` tinytext NOT NULL,
  `recyclerLocation` varchar(50) NOT NULL,
  `recyclerPassword` varchar(20) NOT NULL,
  `image` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recycler`
--

INSERT INTO `recycler` (`recyclerKey`, `recyclerEmail`, `recyclerAddress`, `recyclerPhone`, `recyclerLocation`, `recyclerPassword`, `image`) VALUES
(1, 'krishna@gmail.com', 'nai', '0788288299', 'nairobi', 'recycler', '/ewasteonline/images/75005_airplane_1.jpg'),
(2, 'ewastepvt@gmail.com', 'industrial area,nairobi, st 2013-marks', '0726637623', 'Nairobi', 'pass', '/ewasteonline/images/93453777-valentines-day-seamless-pattern-love-romance-flat-line-icons-hearts-engagement-ring-kiss-balloons-do.jpg'),
(3, 'thuoewaste@gmail.com', ' desai rd, Opposite equity bank, Parkroad business', '0783883774', 'Nairobi', 'pass', '/ewasteonline/images/thuo.png'),
(4, 'ewasteinitiative@gmail.com', 'Nairobi, Kenya Ngara', '0722096921', 'Nairobi', 'ewaste', '/ewasteonline/images/ewasteInitiative.png');

-- --------------------------------------------------------

--
-- Table structure for table `recycler_payment`
--

CREATE TABLE `recycler_payment` (
  `recycler_paymentkey` int(10) NOT NULL,
  `pickup_number` int(11) NOT NULL,
  `recyclerKey` int(10) NOT NULL,
  `ammount` int(11) NOT NULL,
  `mpesaCode` varchar(20) NOT NULL DEFAULT 'pending...',
  `paymentStatus` varchar(30) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recycler_payment`
--

INSERT INTO `recycler_payment` (`recycler_paymentkey`, `pickup_number`, `recyclerKey`, `ammount`, `mpesaCode`, `paymentStatus`) VALUES
(4, 22, 1, 66000, 'DFDFB565THGH56', '1');

-- --------------------------------------------------------

--
-- Table structure for table `track`
--

CREATE TABLE `track` (
  `id` int(11) NOT NULL,
  `pickup_id` int(11) NOT NULL,
  `shippingStatus` int(11) NOT NULL DEFAULT '0',
  `location` varchar(50) NOT NULL,
  `currentTime` time NOT NULL,
  `currentDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `track`
--

INSERT INTO `track` (`id`, `pickup_id`, `shippingStatus`, `location`, `currentTime`, `currentDate`) VALUES
(3, 22, 1, 'KIAMBU', '08:12:00', '2019-01-28'),
(4, 22, 1, 'TANA RIVER', '08:12:00', '2019-01-28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`userKey`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartKey`);

--
-- Indexes for table `cooperation`
--
ALTER TABLE `cooperation`
  ADD PRIMARY KEY (`userKey`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`userKey`);

--
-- Indexes for table `device`
--
ALTER TABLE `device`
  ADD PRIMARY KEY (`deviceKey`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`FeedsKey`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`inventoryKey`);

--
-- Indexes for table `manufacturer`
--
ALTER TABLE `manufacturer`
  ADD PRIMARY KEY (`manuKey`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`paymentKey`);

--
-- Indexes for table `pickup_order`
--
ALTER TABLE `pickup_order`
  ADD PRIMARY KEY (`pickupKey`);

--
-- Indexes for table `recycler`
--
ALTER TABLE `recycler`
  ADD PRIMARY KEY (`recyclerKey`);

--
-- Indexes for table `recycler_payment`
--
ALTER TABLE `recycler_payment`
  ADD PRIMARY KEY (`recycler_paymentkey`);

--
-- Indexes for table `track`
--
ALTER TABLE `track`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `userKey` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartKey` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `cooperation`
--
ALTER TABLE `cooperation`
  MODIFY `userKey` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `userKey` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `device`
--
ALTER TABLE `device`
  MODIFY `deviceKey` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `FeedsKey` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `inventoryKey` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `manufacturer`
--
ALTER TABLE `manufacturer`
  MODIFY `manuKey` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `paymentKey` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pickup_order`
--
ALTER TABLE `pickup_order`
  MODIFY `pickupKey` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `recycler`
--
ALTER TABLE `recycler`
  MODIFY `recyclerKey` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `recycler_payment`
--
ALTER TABLE `recycler_payment`
  MODIFY `recycler_paymentkey` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `track`
--
ALTER TABLE `track`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
