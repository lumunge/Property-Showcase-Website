-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 06, 2018 at 09:52 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rentals`
--

-- --------------------------------------------------------

--
-- Table structure for table `apartment`
--

CREATE TABLE `apartment` (
  `apartment_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `apartment_type` varchar(30) NOT NULL,
  `rent` varchar(30) NOT NULL,
  `location` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apartment`
--

INSERT INTO `apartment` (`apartment_id`, `name`, `image`, `description`, `apartment_type`, `rent`, `location`) VALUES
(1, 'Maua Plaza', 'lol.jpg', 'Free Wifi', 'BedSitter', '4500', 'Maua Town'),
(2, 'Mwangaza', 'jersey.jpg', 'cxk', 'BedSitters', '4500', 'Maua town'),
(3, 'Conner House', 'parksideluxuryapartmentrockland.jpg', 'Parking Available', 'BedSitters', '5000', 'Makutano'),
(4, 'MoonLight Plaza', 'nyc_apartments_1-537x354.jpg', 'Free water', 'BedSitters', '4500', 'Meru town');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `tenant_id` int(11) NOT NULL,
  `rent_deposit` varchar(11) NOT NULL,
  `booking_status` varchar(30) NOT NULL DEFAULT 'Cart',
  `booking_payment` varchar(50) NOT NULL DEFAULT 'Pending',
  `rent_balance` int(11) NOT NULL,
  `booking_remarks` varchar(150) NOT NULL,
  `rent_due_date` varchar(30) NOT NULL,
  `exit_status` varchar(20) NOT NULL DEFAULT 'Not Sent',
  `deposit_status` varchar(20) NOT NULL DEFAULT 'Pending Refund'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `room_id`, `tenant_id`, `rent_deposit`, `booking_status`, `booking_payment`, `rent_balance`, `booking_remarks`, `rent_due_date`, `exit_status`, `deposit_status`) VALUES
(5, 3, 5, '4500', 'Vacated', 'Approved', 0, 'Booking Payment Accepted', '10-06-2018', 'Vacated', 'Refunded'),
(6, 5, 5, '4500', 'Approved', 'Approved', 0, 'Booking Payment Accepted', '26-05-2018', 'Not Sent', 'Pending Refund'),
(7, 25, 5, '4500', 'Pending Approval', 'Pending', 0, '', '', 'Not Sent', 'Pending Refund'),
(8, 14, 5, '4500', 'Approved', 'Approved', 4100, 'Booking Payment Accepted', '26-07-2018', 'Not Sent', 'Pending Refund'),
(11, 26, 2, '5000', 'Approved', 'Approved', 0, 'Booking Payment Accepted', '26-01-2018', 'Not Sent', 'Pending Refund'),
(12, 36, 2, '4500', 'Pending Approval', 'Pending', 0, '', '', 'Not Sent', 'Pending Refund'),
(15, 22, 12, '4500', 'Vacated', 'Approved', 0, 'Booking Payment Accepted', '19-05-2018', 'Vacated', 'Refunded'),
(16, 30, 12, '5000', 'Pending Approval', 'Pending', 0, '', '', 'Not Sent', 'Pending Refund'),
(17, 24, 12, '4500', 'Pending Approval', 'Pending', 0, '', '', 'Not Sent', 'Pending Refund'),
(18, 10, 12, '4500', 'Rejected', 'Rejected', 0, 'ddf', '', 'Not Sent', 'Pending Refund'),
(19, 21, 12, '4500', 'Pending Approval', 'Pending', 0, '', '', 'Not Sent', 'Pending Refund'),
(21, 35, 13, '4500', 'Vacated', 'Approved', 0, 'Booking Payment Accepted', '04-05-2018', 'Vacated', 'Pending Refund'),
(22, 28, 13, '5000', 'Rejected', 'Rejected', 0, 'kjk', '', 'Not Sent', 'Pending Refund'),
(23, 18, 13, '4500', 'Rejected', 'Rejected', 0, 'mnjh', '04-04-2018', 'Vacated', 'Pending Refund'),
(24, 20, 13, '4500', 'Rejected', 'Rejected', 0, 'sscc', '', 'Not Sent', 'Pending Refund'),
(25, 3, 14, '4500', 'Vacated', 'Approved', 0, 'Booking Payment Accepted', '05-04-2018', 'Vacated', 'Pending Refund'),
(26, 21, 14, '4500', 'Rejected', 'Rejected', 0, 'xsx', '', 'Not Sent', 'Pending Refund'),
(27, 31, 14, '4500', 'Approved', 'Approved', 1000, 'Booking Payment Accepted', '05-05-2018', 'Not Sent', 'Pending Refund'),
(29, 18, 15, '4500', 'Pending Approval', 'Pending', 0, '', '', 'Not Sent', 'Pending Refund'),
(30, 7, 15, '4500', 'Approved', 'Approved', 0, 'Booking Payment Accepted', '05-04-2018', 'Not Sent', 'Pending Refund'),
(31, 8, 15, '4500', 'Vacated', 'Approved', 100, 'Booking Payment Accepted', '05-05-2018', 'Vacated', 'Pending Refund'),
(32, 23, 15, '4500', 'Rejected', 'Rejected', 0, 'NBHGVF', '', 'Not Sent', 'Pending Refund'),
(33, 15, 15, '4500', 'Pending Approval', 'Pending', 0, '', '', 'Not Sent', 'Pending Refund'),
(34, 34, 15, '4500', 'Vacated', 'Approved', 0, 'Booking Payment Accepted', '05-04-2018', 'Vacated', 'Pending Refund'),
(35, 28, 15, '5000', 'Pending Approval', 'Pending', 0, '', '', 'Not Sent', 'Pending Refund'),
(36, 23, 15, '4500', 'Approved', 'Approved', 0, 'Booking Payment Accepted', '05-04-2018', 'Not Sent', 'Pending Refund'),
(37, 7, 1, '4500', 'Pending Approval', 'Pending', 0, '', '', 'Not Sent', 'Pending Refund'),
(39, 23, 1, '4500', 'Pending Approval', 'Pending', 0, '', '', 'Not Sent', 'Pending Refund'),
(40, 35, 16, '4500', 'Vacated', 'Approved', 0, 'Booking Payment Accepted', '06-04-2018', 'Vacated', 'Pending Refund'),
(41, 16, 16, '4500', 'Rejected', 'Rejected', 0, 'No water connections', '', 'Not Sent', 'Pending Refund'),
(43, 10, 16, '4500', 'Approved', 'Approved', 0, 'Booking Payment Accepted', '06-04-2018', 'Not Sent', 'Pending Refund'),
(44, 21, 16, '4500', 'Pending Approval', 'Pending', 0, '', '', 'Not Sent', 'Pending Refund'),
(45, 18, 16, '', 'Cart', 'Pending', 0, '', '', 'Not Sent', 'Pending Refund'),
(46, 20, 16, '4500', 'Pending Approval', 'Pending', 0, '', '', 'Not Sent', 'Pending Refund'),
(47, 19, 17, '4500', 'Vacated', 'Approved', 0, 'Booking Payment Accepted', '01-01-1970', 'Vacated', 'Pending Refund'),
(48, 18, 17, '4500', 'Rejected', 'Rejected', 0, 'Under renovation', '', 'Not Sent', 'Pending Refund'),
(49, 17, 17, '4500', 'Vacated', 'Approved', 0, 'Booking Payment Accepted', '11-04-2018', 'Vacated', 'Pending Refund'),
(50, 24, 17, '4500', 'Vacated', 'Approved', 0, 'Booking Payment Accepted', '11-04-2018', 'Vacated', 'Pending Refund'),
(51, 29, 17, '5000', 'Vacated', 'Approved', 0, 'Booking Payment Accepted', '12-04-2018', 'Vacated', 'Pending Refund'),
(52, 32, 17, '4500', 'Vacated', 'Approved', 0, 'Booking Payment Accepted', '12-04-2018', 'Vacated', 'Pending Refund'),
(53, 33, 17, '4500', 'Vacated', 'Approved', 0, 'Booking Payment Accepted', '12-04-2018', 'Vacated', 'Pending Refund'),
(54, 18, 17, '4500', 'Vacated', 'Approved', 0, 'Booking Payment Accepted', '13-04-2018', 'Vacated', 'Refunded'),
(55, 19, 17, '4500', 'Vacated', 'Approved', 0, 'Booking Payment Accepted', '13-03-2018', 'Vacated', 'Refunded'),
(56, 16, 18, '4500', 'Approved', 'Approved', 0, 'Booking Payment Accepted', '20-04-2018', 'Not Sent', 'Pending Refund'),
(57, 17, 18, '4500', 'Pending Approval', 'Pending', 5500, '', '', 'Not Sent', 'Pending Refund'),
(58, 9, 18, '4500', 'Pending Approval', 'Pending', 5500, '', '', 'Not Sent', 'Pending Refund'),
(59, 28, 18, '5000', 'Vacated', 'Approved', 0, 'Booking Payment Accepted', '20-05-2018', 'Vacated', 'Refunded'),
(60, 11, 18, '4500', 'Pending Approval', 'Pending', 1000, '', '', 'Not Sent', 'Pending Refund'),
(62, 24, 18, '4500', 'Rejected', 'Rejected', 100, 'mimi', '', 'Not Sent', 'Pending Refund'),
(64, 22, 19, '4500', 'Vacated', 'Approved', 0, 'Booking Payment Accepted', '05-07-2018', 'Vacated', 'Refunded'),
(66, 18, 19, '4500', 'Vacated', 'Approved', 0, 'Booking Payment Accepted', '05-06-2018', 'Vacated', 'Pending Refund'),
(67, 28, 20, '5000', 'Vacated', 'Approved', 0, 'Booking Payment Accepted', '06-07-2018', 'Vacated', 'Refunded'),
(68, 29, 20, '5000', 'Rejected', 'Rejected', 0, 'THE ROOM BOOKED IS UNDER RENOV', '', 'Not Sent', 'Pending Refund'),
(69, 13, 20, '', 'Cart', 'Pending', 0, '', '', 'Not Sent', 'Pending Refund');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `tenant_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `reply` text NOT NULL,
  `staff_id` int(11) NOT NULL,
  `comment_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `tenant_id`, `comment`, `reply`, `staff_id`, `comment_date`) VALUES
(1, 17, 'i need a 2 bedroom house', 'Not available', 0, '2018-03-13 14:05:06'),
(2, 19, 'thank u', 'welcome', 0, '2018-04-05 22:26:24'),
(3, 20, 'CAN I SECURE A ROOM AT CORNER HOUSE', 'YES WE HAVE VACANT ROOMS', 0, '2018-04-06 10:25:50'),
(4, 20, 'THANK U', 'Pending', 0, '2018-04-06 10:29:09');

-- --------------------------------------------------------

--
-- Table structure for table `inspection_report`
--

CREATE TABLE `inspection_report` (
  `inspection_id` int(11) NOT NULL,
  `notice_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `inspection_report` text NOT NULL,
  `fine` varchar(30) NOT NULL,
  `inspection_status` varchar(30) NOT NULL DEFAULT 'Pending',
  `inspection_date` varchar(20) NOT NULL,
  `fine_status` varchar(30) NOT NULL DEFAULT 'Payment Pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inspection_report`
--

INSERT INTO `inspection_report` (`inspection_id`, `notice_id`, `staff_id`, `room_id`, `inspection_report`, `fine`, `inspection_status`, `inspection_date`, `fine_status`) VALUES
(1, 1, 4, 3, 'broken window', '244', 'Inspected', '2018-02-22 18:53:18', 'Payment Approved'),
(2, 2, 4, 35, '123c', '200', 'Inspected', '2018-03-04 15:38:43', 'Payment Approved'),
(3, 3, 3, 18, 'broken door', '500', 'Inspected', '2018-03-04 16:33:04', 'Payment Approved'),
(4, 4, 4, 3, 'no fine', '0', 'Inspected', '2018-03-05 20:02:23', 'Payment Pending'),
(5, 5, 4, 8, 'in good condition', '0', 'Inspected', '2018-03-05 22:49:03', 'Payment Pending'),
(6, 6, 3, 34, 'rtr', '0', 'Inspected', '2018-03-05 23:05:20', 'Payment Pending'),
(7, 7, 4, 35, 'broken door', '100', 'Inspected', '2018-03-06 19:12:46', 'Payment Approved'),
(8, 8, 4, 19, 'no fine', '0', 'Inspected', '2018-03-12 00:50:47', 'Payment Pending'),
(9, 9, 3, 17, 'hg', '0', 'Inspected', '2018-03-12 01:44:47', 'Payment Pending'),
(10, 10, 4, 24, 'm', '0', 'Inspected', '2018-03-12 02:00:30', 'Payment Pending'),
(11, 11, 4, 29, 'gfg', '0', 'Inspected', '2018-03-12 02:05:03', 'Payment Pending'),
(12, 12, 4, 32, 'c', '0', 'Inspected', '2018-03-13 01:21:09', 'Payment Pending'),
(13, 13, 4, 33, 'dede good', '0', 'Inspected', '2018-03-13 01:30:53', 'Payment Pending'),
(14, 14, 4, 18, '45', '0', 'Inspected', '2018-03-13 17:07:27', 'Payment Pending'),
(15, 15, 4, 19, 'def', '500', 'Inspected', '2018-03-13 17:43:16', 'Payment Approved'),
(16, 16, 4, 22, 'we', '0', 'Inspected', '2018-03-20 00:43:09', 'Payment Pending'),
(17, 17, 4, 28, 'repainting', '5200', 'Inspected', '2018-03-20 19:42:21', 'Payment Approved'),
(18, 18, 4, 22, 'window broken', '450', 'Inspected', '2018-04-05 22:09:46', 'Payment Approved'),
(19, 19, 4, 18, 'repainting', '345', 'Inspected', '2018-04-05 22:31:59', 'Payment Approved'),
(20, 20, 4, 28, 'broken door', '900', 'Inspected', '2018-04-06 10:06:25', 'Payment Approved');

-- --------------------------------------------------------

--
-- Table structure for table `rent_payment`
--

CREATE TABLE `rent_payment` (
  `payment_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `tenant_id` int(11) NOT NULL,
  `mpesa_code` varchar(30) NOT NULL,
  `months` varchar(30) NOT NULL,
  `cash` varchar(30) NOT NULL,
  `balance` varchar(30) NOT NULL,
  `payment_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `payment_status` varchar(30) NOT NULL DEFAULT 'Pending Approval',
  `payment_remarks` text NOT NULL,
  `type_of_payment` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rent_payment`
--

INSERT INTO `rent_payment` (`payment_no`, `room_id`, `booking_id`, `tenant_id`, `mpesa_code`, `months`, `cash`, `balance`, `payment_date`, `payment_status`, `payment_remarks`, `type_of_payment`) VALUES
(5, 3, 5, 5, 'lkijuhygth', '', '9000', '', '2018-02-22 18:11:57', 'Approved', 'Payment Accepted', 'Booking Payment'),
(6, 5, 6, 5, 'hgtfrtgftr', '', '9000', '', '2018-02-22 18:20:49', 'Approved', 'Payment Accepted', 'Booking Payment'),
(7, 3, 5, 5, 'jnhbghytui', '2', '9000', '', '2018-02-22 18:41:03', 'Approved', 'Payment Accepted', 'Rent Payment'),
(8, 3, 5, 5, 'kjuhjunjik', '', '244', '', '2018-02-22 18:54:00', 'Approved', 'Payment Accepted', 'Fine Payment'),
(9, 14, 8, 5, 'dfdfdfdfd3', '', '9000', '', '2018-02-24 00:47:08', 'Approved', 'Payment Accepted', 'Booking Payment'),
(10, 25, 7, 5, 'wwwwssdwsd', '', '9000', '', '2018-02-24 00:47:52', 'Rejected', 'hij', 'Booking Payment'),
(11, 14, 8, 5, 'CDFVBGHNJU', '2', '9000', '', '2018-02-24 00:54:02', 'Approved', 'Payment Accepted', 'Rent Payment'),
(12, 14, 8, 5, 'dsefrgbvf4', '1', '5002', '', '2018-02-24 13:39:10', 'Rejected', 'Under renovation', 'Rent Payment'),
(13, 14, 8, 5, 'sdsdsdsdsd', '1', '4500', '', '2018-02-24 15:42:21', 'Pending Approval', 'Pending', 'Rent Payment'),
(14, 14, 8, 5, 'njbhgytgfr', '1', '4500', '', '2018-02-24 15:43:51', 'Pending Approval', 'Pending', 'Rent Payment'),
(15, 14, 8, 5, 'ssssssssss', '1', '4500', '', '2018-02-24 15:46:40', 'Pending Approval', 'Pending', 'Rent Payment'),
(16, 14, 8, 5, 'sdxcdxszas', '1', '4500', '', '2018-02-24 15:48:17', 'Pending Approval', 'Pending', 'Rent Payment'),
(17, 14, 8, 5, 'sdsxcdfvcb', '1', '4500', '', '2018-02-24 15:50:00', 'Pending Approval', 'Pending', 'Rent Payment'),
(18, 14, 8, 5, 'xcdfvcdfe4', '1', '4500', '', '2018-02-24 15:51:54', 'Pending Approval', 'Pending', 'Rent Payment'),
(19, 14, 8, 5, 'swdscxvfgb', '1', '4500', '', '2018-02-24 15:53:02', 'Pending Approval', 'Pending', 'Rent Payment'),
(20, 14, 8, 5, 'mnjbhgtfrv', '1', '4500', '0', '2018-02-24 15:59:14', 'Pending Approval', 'Pending', 'Rent Payment'),
(21, 14, 8, 5, 'mnjbhnjbhg', '2', '10000', '1000', '2018-02-24 16:00:37', 'Approved', 'Payment Accepted', 'Rent Payment'),
(22, 5, 6, 5, '1100kjijhu', '2', '12000', '3000', '2018-02-26 12:30:06', 'Approved', 'Payment Accepted', 'Rent Payment'),
(23, 14, 8, 5, 'MNJBHUY78U', '1', '5000', '500', '2018-02-26 14:15:46', 'Approved', 'Payment Accepted', 'Rent Payment'),
(24, 14, 8, 5, 'lkijuhyjhu', '1', '5100', '600', '2018-02-26 14:19:56', 'Approved', 'Payment Accepted', 'Rent Payment'),
(25, 14, 8, 5, 'hgbvgftr56', '4', '20000', '2000', '2018-02-26 14:21:51', 'Approved', 'Payment Accepted', 'Rent Payment'),
(26, 26, 11, 2, 'kmjnjhuij9', '', '10000', '', '2018-02-26 15:58:18', 'Approved', 'Payment Accepted', 'Booking Payment'),
(27, 36, 12, 2, 'nbhgythyg7', '', '9000', '', '2018-02-26 15:58:33', 'Rejected', 'rtrt', 'Booking Payment'),
(28, 22, 15, 12, 'bvfcder43e', '', '9000', '', '2018-03-04 13:34:26', 'Approved', 'Payment Accepted', 'Booking Payment'),
(29, 21, 19, 12, 'vfcdsew32w', '', '9000', '', '2018-03-04 13:34:39', 'Rejected', 'mn', 'Booking Payment'),
(30, 24, 17, 12, 'vcfdswe32w', '', '9000', '', '2018-03-04 13:34:51', 'Rejected', 'sds', 'Booking Payment'),
(31, 10, 18, 12, 'vcfdxsewdr', '', '9000', '', '2018-03-04 13:35:05', 'Rejected', 'ddf', 'Booking Payment'),
(32, 30, 16, 12, 'xsdswewdrf', '', '10000', '', '2018-03-04 13:35:21', 'Rejected', 'House under rnovation', 'Booking Payment'),
(33, 18, 23, 13, 'hbghgyghyu', '', '9000', '', '2018-03-04 15:20:43', 'Approved', 'Payment Accepted', 'Booking Payment'),
(34, 20, 24, 13, 'hbgvfgtfg5', '', '9000', '', '2018-03-04 15:21:00', 'Rejected', 'sscc', 'Booking Payment'),
(35, 28, 22, 13, 'vfcderdre4', '', '10000', '', '2018-03-04 15:21:19', 'Rejected', 'wewewer', 'Booking Payment'),
(36, 35, 21, 13, 'fdre434e5r', '', '9000', '', '2018-03-04 15:21:38', 'Approved', 'Payment Accepted', 'Booking Payment'),
(37, 35, 21, 13, 'hgtyt6y76t', '1', '4500', '0', '2018-03-04 15:25:32', 'Approved', 'Payment Accepted', 'Rent Payment'),
(38, 35, 21, 13, 'nhbhgyt6y7', '', '200', '', '2018-03-04 15:39:37', 'Approved', 'Payment Accepted', 'Fine Payment'),
(39, 18, 23, 13, 'nbhgvfgfrt', '', '500', '', '2018-03-04 18:10:50', 'Approved', 'Payment Accepted', 'Fine Payment'),
(40, 3, 25, 14, 'bgvfcdfdre', '', '9500', '', '2018-03-05 15:58:16', 'Approved', 'Payment Accepted', 'Booking Payment'),
(41, 21, 26, 14, 'bvgftrfdre', '', '9000', '', '2018-03-05 15:58:32', 'Rejected', 'xsx', 'Booking Payment'),
(42, 31, 27, 14, 'jhbhgy67y8', '', '9000', '', '2018-03-05 19:59:32', 'Approved', 'Payment Accepted', 'Booking Payment'),
(43, 31, 27, 14, 'ASWQE34RE4', '1', '5000', '500', '2018-03-05 20:19:56', 'Approved', 'Payment Accepted', 'Rent Payment'),
(44, 31, 27, 14, 'GHYUH65T56', '1', '5000', '500', '2018-03-05 20:21:17', 'Approved', 'Payment Accepted', 'Rent Payment'),
(45, 8, 31, 15, 'kjijuhyuy7', '', '9000', '', '2018-03-05 22:35:12', 'Approved', 'Payment Accepted', 'Booking Payment'),
(46, 18, 29, 15, 'nbhvgftr54', '', '9000', '', '2018-03-05 22:37:36', 'Rejected', 'mnjh', 'Booking Payment'),
(47, 7, 30, 15, 'bvgfcdre45', '', '9000', '', '2018-03-05 22:37:50', 'Rejected', 'mnjh', 'Booking Payment'),
(48, 8, 31, 15, 'aswdefr456', '1', '4600', '100', '2018-03-05 22:42:17', 'Approved', 'Payment Accepted', 'Rent Payment'),
(49, 23, 32, 15, 'mjnhuy78u8', '', '9000', '', '2018-03-05 22:54:01', 'Rejected', 'nbhu', 'Booking Payment'),
(50, 15, 33, 15, 'bvgftr56t7', '', '9000', '', '2018-03-05 22:54:17', 'Pending Approval', 'Wait for your booking to be approved', 'Booking Payment'),
(51, 28, 35, 15, 'nbhgyty67u', '', '10000', '', '2018-03-05 22:55:00', 'Rejected', 'kjk', 'Booking Payment'),
(52, 34, 34, 15, 'mnjhuy7y8u', '', '9000', '', '2018-03-05 22:55:18', 'Approved', 'Payment Accepted', 'Booking Payment'),
(53, 23, 36, 15, 'bhgtfrdesw', '', '9000', '', '2018-03-05 22:58:21', 'Rejected', 'NBHGVF', 'Booking Payment'),
(54, 7, 37, 1, 'MNJHYTGFR5', '', '9000', '', '2018-03-05 23:16:57', 'Approved', 'Payment Accepted', 'Booking Payment'),
(55, 23, 39, 1, 'NBHGTFRDES', '', '9000', '', '2018-03-05 23:22:47', 'Approved', 'Payment Accepted', 'Booking Payment'),
(56, 16, 41, 16, 'hgtfrt65r5', '', '9000', '', '2018-03-06 16:26:13', 'Rejected', 'No water connections', 'Booking Payment'),
(57, 10, 43, 16, 'nbhgyt67y6', '', '9000', '', '2018-03-06 16:31:21', 'Approved', 'Payment Accepted', 'Booking Payment'),
(58, 35, 40, 16, 'nbhgyt6756', '', '9000', '', '2018-03-06 16:31:33', 'Approved', 'Payment Accepted', 'Booking Payment'),
(59, 21, 44, 16, 'bvgftr54e3', '', '9000', '', '2018-03-06 16:34:34', 'Pending Approval', 'Wait for your booking to be approved', 'Booking Payment'),
(60, 20, 46, 16, 'bvgftfrde4', '', '9000', '', '2018-03-06 16:37:28', 'Pending Approval', 'Wait for your booking to be approved', 'Booking Payment'),
(61, 35, 40, 16, 'ASW3EW23E4', '', '100', '', '2018-03-06 20:19:31', 'Approved', 'Payment Accepted', 'Fine Payment'),
(62, 19, 47, 17, 'nbgvfcdfre', '', '9000', '', '2018-03-11 15:33:23', 'Approved', 'Payment Accepted', 'Booking Payment'),
(63, 18, 48, 17, 'nbgvfcdfre', '', '9000', '', '2018-03-11 15:33:57', 'Rejected', 'Under renovation', 'Booking Payment'),
(64, 17, 49, 17, 'nbhgvfgftr', '', '9000', '', '2018-03-11 15:34:11', 'Approved', 'Payment Accepted', 'Booking Payment'),
(65, 19, 47, 17, 'mnhbvgftrd', '1', '5000', '500', '2018-03-11 15:51:37', 'Approved', 'Payment Accepted', 'Rent Payment'),
(66, 19, 47, 17, 'nhgyt6yt78', '1', '5000', '500', '2018-03-11 16:09:29', 'Approved', 'Payment Accepted', 'Rent Payment'),
(67, 19, 47, 17, 'cdfredfr45', '2', '10000', '1000', '2018-03-11 16:11:21', 'Approved', 'Payment Accepted', 'Rent Payment'),
(68, 19, 47, 17, 'nbhgftre45', '1', '4500', '0', '2018-03-11 17:40:46', 'Approved', 'Payment Accepted', 'Rent Payment'),
(69, 19, 47, 17, 'dswedfrgt5', '1', '4600', '100', '2018-03-11 17:48:28', 'Approved', 'Payment Accepted', 'Rent Payment'),
(70, 19, 47, 17, 'wsdfrgtfde', '1', '2400', '0', '2018-03-11 17:55:31', 'Approved', 'Payment Accepted', 'Rent Payment'),
(71, 19, 47, 17, 'cdferfgthy', '1', '4550', '50', '2018-03-11 18:09:13', 'Approved', 'Payment Accepted', 'Rent Payment'),
(72, 19, 47, 17, 'bgvfcde34e', '1', '4550', '100', '2018-03-11 18:13:08', 'Pending Approval', 'Pending', 'Rent Payment'),
(73, 19, 47, 17, 'wqsedrfgt5', '15.5', '2250', '', '2018-03-11 23:52:20', 'Pending Approval', 'Pending', 'Rent Payment'),
(74, 19, 47, 17, 'xzsdcdfr45', '15.5  Days', '2250', '', '2018-03-11 23:58:40', 'Approved', 'Payment Accepted', 'Rent Payment'),
(75, 24, 50, 17, 'nhjyujkuij', '', '9000', '', '2018-03-12 01:57:48', 'Approved', 'Payment Accepted', 'Booking Payment'),
(76, 29, 51, 17, 'bgfgbgvfgv', '', '10000', '', '2018-03-12 02:02:33', 'Approved', 'Payment Accepted', 'Booking Payment'),
(77, 32, 52, 17, 'nbgvfdre34', '', '9000', '', '2018-03-13 01:09:28', 'Approved', 'Payment Accepted', 'Booking Payment'),
(78, 33, 53, 17, 'bvgfgft67y', '', '9000', '', '2018-03-13 01:27:25', 'Approved', 'Payment Accepted', 'Booking Payment'),
(79, 18, 54, 17, 'nbgvfcdxsw', '', '9000', '', '2018-03-13 17:02:00', 'Approved', 'Payment Accepted', 'Booking Payment'),
(80, 19, 55, 17, 'xsdcfvgbty', '', '9000', '', '2018-03-13 17:40:36', 'Approved', 'Payment Accepted', 'Booking Payment'),
(81, 19, 55, 17, 'xsdwe345r6', '', '500', '', '2018-03-13 17:44:54', 'Approved', 'Payment Accepted', 'Fine Payment'),
(82, 22, 15, 12, 'csdefrgthy', '1', '5000', '500', '2018-03-20 00:37:10', 'Approved', 'Payment Accepted', 'Rent Payment'),
(83, 22, 15, 12, 'cdfergthyj', '1', '4000', '0', '2018-03-20 00:39:57', 'Approved', 'Payment Accepted', 'Rent Payment'),
(84, 16, 56, 18, '47ut75y7h5', '', '10000', '', '2018-03-20 18:43:18', 'Approved', 'Payment Accepted', 'Booking Payment'),
(85, 17, 57, 18, 'dsdwe3e4r5', '', '10000', '', '2018-03-20 18:48:27', 'Pending Approval', 'Wait for your booking to be approved', 'Booking Payment'),
(86, 9, 58, 18, 'hgtfrdesw3', '', '10000', '', '2018-03-20 18:50:32', 'Pending Approval', 'Wait for your booking to be approved', 'Booking Payment'),
(87, 28, 59, 18, 'xsdcvfbghn', '', '10500', '', '2018-03-20 18:56:42', 'Approved', 'Payment Accepted', 'Booking Payment'),
(88, 11, 60, 18, '100dcdfvfr', '', '10000', '1000', '2018-03-20 19:10:12', 'Pending Approval', 'Wait for your booking to be approved', 'Booking Payment'),
(89, 28, 59, 18, 'cvdfrt567y', '1', '4500', '0', '2018-03-20 19:36:44', 'Approved', 'Payment Accepted', 'Rent Payment'),
(90, 28, 59, 18, 'bvgfdeswe3', '', '5200', '', '2018-03-20 19:46:25', 'Approved', 'Payment Accepted', 'Fine Payment'),
(91, 24, 62, 18, 'mjhy87y6tr', '', '9100', '100', '2018-03-20 23:17:13', 'Rejected', 'mimi', 'Booking Payment'),
(92, 16, 56, 18, 'nhbfhyuyhd', '15.5  Days', '2250', '', '2018-03-21 01:40:21', 'Pending Approval', 'Pending', 'Rent Payment'),
(93, 22, 64, 19, 'CDVGBHNJUI', '', '9500', '500', '2018-04-05 21:47:26', 'Approved', 'Payment Accepted', 'Booking Payment'),
(94, 18, 66, 19, 'ERT56Y7U8I', '', '9100', '100', '2018-04-05 21:48:28', 'Approved', 'Payment Accepted', 'Booking Payment'),
(95, 22, 64, 19, 'iujihygdtg', '2', '8500', '0', '2018-04-05 21:55:40', 'Approved', 'Payment Accepted', 'Rent Payment'),
(96, 22, 64, 19, 'cdfrgtyhju', '', '450', '', '2018-04-05 22:14:21', 'Approved', 'Payment Accepted', 'Fine Payment'),
(97, 18, 66, 19, '34565678gf', '1', '4400', '0', '2018-04-05 22:25:59', 'Approved', 'Payment Accepted', 'Rent Payment'),
(98, 18, 66, 19, '23456ythuj', '', '400', '', '2018-04-05 22:34:19', 'Approved', 'Payment Accepted', 'Fine Payment'),
(99, 28, 67, 20, 'TYGH67Y0OP', '', '10500', '500', '2018-04-06 09:39:32', 'Approved', 'Payment Accepted', 'Booking Payment'),
(100, 29, 68, 20, 'E3RTY67YUT', '', '10000', '0', '2018-04-06 09:41:04', 'Rejected', 'THE ROOM BOOKED IS UNDER RENOVATION', 'Booking Payment'),
(101, 28, 67, 20, 'RFT5T67UY8', '2', '9500', '0', '2018-04-06 09:52:01', 'Approved', 'Payment Accepted', 'Rent Payment'),
(102, 28, 67, 20, 'FGH78HUJI8', '', '900', '', '2018-04-06 10:10:11', 'Approved', 'Payment Accepted', 'Fine Payment');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` int(11) NOT NULL,
  `apartment_id` int(11) NOT NULL,
  `room_no` varchar(30) NOT NULL,
  `room_status` varchar(30) NOT NULL DEFAULT 'Empty'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `apartment_id`, `room_no`, `room_status`) VALUES
(3, 1, '1', 'Empty'),
(5, 1, '2', 'Booked'),
(6, 2, '1', 'Empty'),
(7, 2, '2', 'Booked'),
(8, 2, '3', 'Booked'),
(9, 2, '4', 'Booked'),
(10, 2, '6', 'Booked'),
(11, 2, '7', 'Booked'),
(12, 2, '8', 'Empty'),
(13, 2, '9', 'Empty'),
(14, 2, '10', 'Booked'),
(15, 1, '4', 'Booked'),
(16, 1, '5', 'Booked'),
(17, 1, '6', 'Booked'),
(18, 1, '7', 'Empty'),
(19, 1, '8', 'Empty'),
(20, 1, '9', 'Booked'),
(21, 1, '10', 'Booked'),
(22, 1, '13', 'Empty'),
(23, 1, '14', 'Booked'),
(24, 2, '15', 'Empty'),
(25, 2, '16', 'Booked'),
(26, 3, '1', 'Booked'),
(27, 3, '2', 'Empty'),
(28, 3, '3', 'Empty'),
(29, 3, '4', 'Empty'),
(30, 3, '5', 'Booked'),
(31, 4, '1', 'Booked'),
(32, 4, '2', 'Empty'),
(33, 4, '3', 'Empty'),
(34, 4, '4', 'Booked'),
(35, 4, '5', 'Empty'),
(36, 4, '6', 'Booked');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(11) NOT NULL,
  `userlevel` varchar(30) NOT NULL DEFAULT 'Staff',
  `staff_status` varchar(30) NOT NULL DEFAULT 'Approved',
  `remarks` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `last_name`, `first_name`, `username`, `password`, `userlevel`, `staff_status`, `remarks`) VALUES
(1, 'James', 'Kaidio', 'Admin', '4321', 'Admin', 'Approved', ''),
(2, 'Janny', 'Jame', 'Janny', '1234', 'Staff', 'Approved', ''),
(3, 'Mwenda', 'Jimmy', 'Jimmy', '1234', 'Staff', 'Approved', ''),
(4, 'Jim', 'Felix', 'Jim', '1234', 'Staff', 'Approved', '');

-- --------------------------------------------------------

--
-- Table structure for table `tenants`
--

CREATE TABLE `tenants` (
  `tenant_id` int(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `middle_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `id_no` varchar(30) NOT NULL,
  `phone_no` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `tenant_status` varchar(30) NOT NULL DEFAULT 'Pending',
  `account_remarks` text NOT NULL,
  `password` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tenants`
--

INSERT INTO `tenants` (`tenant_id`, `first_name`, `middle_name`, `last_name`, `username`, `id_no`, `phone_no`, `email`, `tenant_status`, `account_remarks`, `password`) VALUES
(1, 'Kaidio', 'James', 'Jamo', 'james', '34500600', '8765654533', 'kmkm@gmail.com', 'Approved', '', '1234'),
(2, 'Denis', 'Kim', 'Kimani', 'Kim', '23434344', '1232321232', 'kim@gmail.com', 'Approved', '', '1234'),
(3, 'Mercy', 'Mercy', 'Njeri', 'Njeri', '14578452', '1247458452', 'emeil@gmail.com', 'Approved', '', '1234'),
(4, 'Denis', 'Njoroge', 'Kimani', 'Kimani', '87878999', '9878789898', 'dkim@gmail.com', 'Approved', '', '1234'),
(5, 'Johnston', 'Mau', 'Kamau', 'Kamaa', '12332323', '1234567876', 'kamaa@gmail.cim', 'Approved', '', '1234'),
(6, 'Felista', 'Wanja', 'Wambui', 'Felista', '86787888', '3332312324', 'feli@gmail.com', 'Approved', '', '1234'),
(7, 'Eric', 'Mwenda', 'Mwenda', 'Eric', '21457854', '1454758485', 'eric@gmail.com', 'Approved', '', '1234'),
(8, 'Joel', 'Joel', 'Kamau', 'Joel', '56787878', '9878787890', 'joel@gmail.com', 'Pending', '', '1234'),
(9, 'Kenneth', 'Kamau', 'Njigi', 'Njigi', '14141414', '1412514521', 'njigi@gmail.com', 'Pending', '', '1234'),
(10, 'Rahab', 'Njoroge', 'Njeri', 'Njeri123', '14541254', '1415421547', 'rahab@gmail.com', 'Pending', '', '1234'),
(11, 'sds', 'sds', 'sds', 'sdsdw', '23232323', '2222223332', 'emil@gmail.com', 'Pending', '', '1234'),
(12, 'Mercy', 'Kendi', 'Kendi', 'Kendi', '8888877777', '9998898987', 'kendi@gmail.com', 'Approved', '', '1234'),
(13, 'Lilie', 'Mary', 'ann', 'lili', '23232123', '1234232332', 'lili@gmail.com', 'Approved', '', '1234'),
(14, 'Stano', 'Stano', 'Njoroge', 'STANO', '76767678', '1232321123', 'stano@gmail.com', 'Approved', '', '1234'),
(15, 'Leah', 'Mbugua', 'Kelvin', 'Leah', '87678767', '9878787800', 'leah@gmail.com', 'Approved', '', '1234'),
(16, 'Sam', 'Jesse', 'Kamau', 'Jesse', '98989789', '8787899098', 'jaess@gmail.com', 'Approved', '', '1234'),
(17, 'Diana', 'Gitari', 'rita', 'Diana', '22333223', '1232321112', 'gD@gmail.com', 'Approved', '', '1234'),
(18, 'Ken', 'shiku', 'Njeri', 'Shiku', '45454343', '3434344367', 'shiku@gmail.com', 'Approved', '', '1234'),
(19, 'First', 'Middle', 'Last', 'Username', '98986784', '1234787668', 'user@gmail.com', 'Approved', '', '1234'),
(20, 'martin', 'kirema', 'safari', 'safari', '45678909', '0716699166', 'safari@gmail.com', 'Approved', '', 'safari');

-- --------------------------------------------------------

--
-- Table structure for table `vacate_notice`
--

CREATE TABLE `vacate_notice` (
  `notice_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `tenant_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `vacate_date` varchar(30) NOT NULL,
  `vacate_status` varchar(30) NOT NULL DEFAULT 'Pending Approval',
  `vacate_remarks` text NOT NULL,
  `vacate_reason` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vacate_notice`
--

INSERT INTO `vacate_notice` (`notice_id`, `booking_id`, `tenant_id`, `room_id`, `vacate_date`, `vacate_status`, `vacate_remarks`, `vacate_reason`) VALUES
(1, 5, 5, 3, '12-05-2018', 'Inspected', 'Inspection Report Sent', 'promotion'),
(2, 21, 13, 35, '2018-03-29', 'Inspected', 'Inspection Report Sent', 'retirement'),
(3, 23, 13, 18, '2018-03-14', 'Inspected', 'Inspection Report Sent', 'jiji move'),
(4, 25, 14, 3, '2018-03-20', 'Inspected', 'Inspection Report Sent', 'vcv'),
(5, 31, 15, 8, '2018-03-14', 'Inspected', 'Inspection Report Sent', 'kate'),
(6, 34, 15, 34, '2018-03-06', 'Inspected', 'Inspection Report Sent', 'rt'),
(7, 40, 16, 35, '2018-03-30', 'Inspected', 'Inspection Report Sent', 'mkm'),
(8, 47, 17, 19, '2018-03-14', 'Inspected', 'Inspection Report Sent', 'cv'),
(9, 49, 17, 17, '22-03-2018', 'Inspected', 'Inspection Report Sent', 'er'),
(10, 50, 17, 24, '11-04-2018', 'Inspected', 'Inspection Report Sent', 'bnbn'),
(11, 51, 17, 29, '22-03-2018', 'Inspected', 'Inspection Report Sent', 'x'),
(12, 52, 17, 32, '14-03-2018', 'Inspected', 'Inspection Report Sent', 'mnjhyg'),
(13, 53, 17, 33, '09-04-2018', 'Inspected', 'Inspection Report Sent', 'mjh'),
(14, 54, 17, 18, '02-04-2018', 'Inspected', 'Inspection Report Sent', 'gf'),
(15, 55, 17, 19, '30-03-2018', 'Inspected', 'Inspection Report Sent', 'bv'),
(16, 15, 12, 22, '30-03-2018', 'Inspected', 'Inspection Report Sent', 'xcd'),
(17, 59, 18, 28, '17-05-2018', 'Inspected', 'Inspection Report Sent', 'mjuh'),
(18, 64, 19, 22, '27-04-2018', 'Inspected', 'Inspection Report Sent', 'transfer'),
(19, 66, 19, 18, '04-05-2018', 'Inspected', 'Inspection Report Sent', 'transfer'),
(20, 67, 20, 28, '03-07-2018', 'Inspected', 'Inspection Report Sent', 'MOVING TO ANOTHER PLACE FOR JOB');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `apartment`
--
ALTER TABLE `apartment`
  ADD PRIMARY KEY (`apartment_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `tenant_id` (`tenant_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `tenant_id` (`tenant_id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `inspection_report`
--
ALTER TABLE `inspection_report`
  ADD PRIMARY KEY (`inspection_id`),
  ADD KEY `vacate_id` (`notice_id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `rent_payment`
--
ALTER TABLE `rent_payment`
  ADD PRIMARY KEY (`payment_no`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `tenanat_id` (`tenant_id`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `apartment_id` (`apartment_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `tenants`
--
ALTER TABLE `tenants`
  ADD PRIMARY KEY (`tenant_id`);

--
-- Indexes for table `vacate_notice`
--
ALTER TABLE `vacate_notice`
  ADD PRIMARY KEY (`notice_id`),
  ADD KEY `tenant_id` (`tenant_id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `booking_id` (`booking_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `apartment`
--
ALTER TABLE `apartment`
  MODIFY `apartment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `inspection_report`
--
ALTER TABLE `inspection_report`
  MODIFY `inspection_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `rent_payment`
--
ALTER TABLE `rent_payment`
  MODIFY `payment_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tenants`
--
ALTER TABLE `tenants`
  MODIFY `tenant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `vacate_notice`
--
ALTER TABLE `vacate_notice`
  MODIFY `notice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`tenant_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`feedback_id`) REFERENCES `tenants` (`tenant_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inspection_report`
--
ALTER TABLE `inspection_report`
  ADD CONSTRAINT `inspection_report_ibfk_1` FOREIGN KEY (`notice_id`) REFERENCES `vacate_notice` (`notice_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inspection_report_ibfk_2` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `inspection_report_ibfk_3` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rent_payment`
--
ALTER TABLE `rent_payment`
  ADD CONSTRAINT `rent_payment_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rent_payment_ibfk_2` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`tenant_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`apartment_id`) REFERENCES `apartment` (`apartment_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vacate_notice`
--
ALTER TABLE `vacate_notice`
  ADD CONSTRAINT `vacate_notice_ibfk_1` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`tenant_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vacate_notice_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
