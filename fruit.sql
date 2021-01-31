-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2020 at 05:04 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fruit`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `Acc_ID` int(11) NOT NULL,
  `Acc_Username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Acc_Password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Acc_Role` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Acc_Status` tinyint(1) NOT NULL DEFAULT 0,
  `Acc_Date` datetime NOT NULL DEFAULT current_timestamp(),
  `Cus_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`Acc_ID`, `Acc_Username`, `Acc_Password`, `Acc_Role`, `Acc_Status`, `Acc_Date`, `Cus_ID`) VALUES
(1, 'thang', 'e358efa489f58062f10dd7316b65649e', 'admin', 1, '2020-12-10 02:24:46', NULL),
(3, 'lan', '0cc175b9c0f1b6a831c399e269772661', 'customer', 0, '2020-12-10 02:24:46', 35),
(5, 'test', '0cc175b9c0f1b6a831c399e269772661', 'customer', 0, '2020-12-11 01:28:31', 37),
(6, 'a', '0cc175b9c0f1b6a831c399e269772661', 'customer', 0, '2020-12-11 01:44:32', 38),
(7, '1', 'c4ca4238a0b923820dcc509a6f75849b', 'customer', 0, '2020-12-18 04:26:19', 42),
(8, 't', 'e358efa489f58062f10dd7316b65649e', 'customer', 0, '2020-12-18 13:51:11', 47),
(12, 'tai', 'a412ba79e6bcd018c48faf00f057c0bb', 'admin', 1, '2020-12-26 20:12:23', NULL),
(22, 'nghia', '9e87373408a6cd425ae9b19bf870d893', 'admin', 1, '2020-12-26 23:36:58', NULL),
(23, 'thuy', '3cf2b6b121d1726bc2cdc88c39e0b119', 'admin', 1, '2020-12-26 23:45:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `Com_ID` int(11) NOT NULL,
  `Com_Content` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `Com_Date` datetime NOT NULL,
  `Pro_ID` int(11) NOT NULL,
  `Acc_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`Com_ID`, `Com_Content`, `Com_Date`, `Pro_ID`, `Acc_ID`) VALUES
(1, 'Xoài này ngon cực. Mọi người mua thử ăn nha. Cho 5 sao', '2020-12-11 15:01:17', 1, 6),
(2, 'Xoài ngon đấy', '2020-12-11 15:09:27', 1, 6),
(4, '<p>dsadsadsadsa</p>\n', '2020-12-11 16:24:41', 1, 6),
(6, '<p>OK</p>\n', '2020-12-11 18:00:34', 1, 6),
(9, '<h1>Xo&agrave;i Ngon Đấy</h1>\n', '2020-12-11 18:01:40', 1, 6),
(11, '<p>a</p>\n', '2020-12-11 19:45:06', 1, 6),
(12, '<p>ad</p>\n', '2020-12-11 19:48:07', 1, 6),
(13, '<p>Tạm</p>\n', '2020-12-11 20:37:45', 1, 6),
(14, '<p>test</p>\n', '2020-12-11 20:56:34', 1, 6),
(16, '<p>dadwadwa</p>\n', '2020-12-11 21:33:13', 1, 6),
(17, '<p>123</p>\n', '2020-12-11 21:36:08', 1, 6),
(20, '<p>aa</p>\n', '2020-12-11 21:41:06', 2, 6),
(21, '<p>aadsa</p>\n', '2020-12-11 21:41:10', 2, 6),
(22, '<p>aadsa</p>\n', '2020-12-11 21:42:05', 2, 6),
(23, '', '2020-12-11 21:42:08', 2, 6),
(25, '<p>dsawadwa</p>\n', '2020-12-11 21:57:09', 2, 6),
(26, '<p>????</p>\n', '2020-12-11 22:09:19', 1, 3),
(27, '<p>OK bạn ơi</p>\n', '2020-12-11 22:42:37', 2, 3),
(28, '<p><strong><s><em>Đẹp</em></s></strong></p>\n', '2020-12-11 22:48:17', 2, 3),
(29, '<div style=\"background:#eeeeee;border:1px solid #cccccc;padding:5px 10px;\"><font face=\"monospace\">&Ocirc;i bạn ơi!</font></div>\n', '2020-12-11 22:48:52', 2, 3),
(31, '<p>a</p>\n', '2020-12-15 19:57:43', 11, 3),
(32, '<p>Ch&ocirc;m ch&ocirc;m ngon lắm nha</p>\n', '2020-12-15 20:24:17', 6, 3),
(35, '<p><img alt=\"\" src=\"https://product.hstatic.net/1000141988/product/size_hinh_vuong__web___3__67e314590b3a46c780adf640926f8283_large.jpg\" style=\"height:480px; width:480px\" /></p>\n', '2020-12-17 13:24:48', 1, 6),
(36, '<p>thắng</p>\n', '2020-12-20 01:29:04', 1, 8),
(37, '<h1>Chuối ngon lắm nha mọi người ơi &lt;3</h1>\n', '2020-12-26 23:04:45', 7, 8),
(38, '<p>a</p>\n', '2020-12-26 23:06:48', 7, 8);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Cus_ID` int(11) NOT NULL,
  `Cus_Name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Cus_BDay` date NOT NULL,
  `Cus_Gender` tinyint(1) NOT NULL,
  `Cus_Email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Cus_Phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Cus_ID`, `Cus_Name`, `Cus_BDay`, `Cus_Gender`, `Cus_Email`, `Cus_Phone`) VALUES
(1, 'Nguyễn Thị Hồng Thủy', '2000-06-26', 0, 'hongthuy2606@gmail.com', '0966123456'),
(2, 'Chu Nam Thắng', '2000-12-28', 1, 'namthangmu123@gmail.com', '0961600587'),
(3, 'Phan Thị Phương Thảo', '2000-06-18', 0, 'thaoblue@gmail.com', '0966321456'),
(7, 'Lê Thị Tiểu Linh', '2000-11-11', 1, 'linhtay@gmail.com', '0374561236'),
(9, 'Test', '2020-12-26', 1, 'test@gmail.com', '0961600587'),
(11, 'Nguyễn Thiện Đông', '2000-11-22', 1, 'thiendong@gmail.com', '0153561864'),
(12, 'Test_2', '2020-12-18', 0, 'Test_2@gmail.com', '0118661864'),
(13, 'Thắng Béo', '2000-12-28', 1, '18521386@gm.uit.edu.vn', '0961600587'),
(14, 'Thắng Béo', '2000-12-28', 1, '18521386@gm.uit.edu.vn', '0961600587'),
(15, 'Thắng đẹp trai', '2000-12-28', 1, 'namthangmu123@gmail.com', '0961600587'),
(16, 'fdwadwadwa', '2000-12-28', 1, 'namthangmu123@gmail.com', '0961600587'),
(17, 'dawdsa', '2020-12-18', 1, 'namthangmu123@gmail.com', '0961600587'),
(18, 'Test_3', '2021-01-10', 1, 'namthangmu123@gmail.com', '0961600587'),
(19, 'Test_4', '2020-12-20', 1, 'namthangmu123@gmail.com', '0961600587'),
(20, 'Test_5', '2020-12-06', 1, 'namthangmu123@gmail.com', '0961600587'),
(22, 'Chu Nam Thắng', '2000-12-28', 1, 'namthangmu123@gmail.com', '0961600587'),
(23, 'Chu Nam Thắng', '2000-12-28', 1, 'namthangmu123@gmail.com', '0961600587'),
(24, 'Chu Nam Thắng', '2000-12-28', 1, 'namthangmu123@gmail.com', '185168565153'),
(25, 'Chu Nam Thắng', '2020-12-23', 1, 'namthangmu123@gmail.com', '0961600587'),
(26, 'Test_6', '2020-12-26', 0, 'namthangmu123@gmail.com', '0961600587'),
(27, 'Test_7', '2021-01-02', 0, 'namthangmu123@gmail.com', '0961600587'),
(28, 'Test_8', '2021-01-01', 0, 'namthangmu123@gmail.com', '0961600587'),
(29, 'Test_8', '2021-01-01', 0, 'namthangmu123@gmail.com', '0961600587'),
(31, 'Test_8', '2021-01-01', 0, 'namthangmu123@gmail.com', '0961600587'),
(32, 'Test_9', '2021-01-03', 0, 'namthangmu123@gmail.com', '0961600587'),
(33, 'Test_10', '2021-01-01', 1, 'namthangmu123@gmail.com', '0961600587'),
(34, 'Chu Nam Thắng', '2020-12-27', 0, 'namthangmu123@gmail.com', '0961600587'),
(35, 'Đinh Thị Hoàng Lan', '2020-10-13', 0, 'namthangmu123@gmail.com', '0966321456'),
(36, 'Test_11', '2020-12-23', 0, 'namthangmu123@gmail.com', '0374561236'),
(37, 'Test_11', '2020-12-23', 0, 'a@gmail.com', '0151641889'),
(38, 'a', '2020-12-04', 1, 'namthangmu123@gmail.com', '0966321456'),
(41, 'Chu Nam Thắng', '2021-01-02', 1, 'namthangmu123@gmail.com', '0151641889'),
(42, 'Test_12', '2020-12-25', 1, 'namthangmu123@gmail.com', '0151641889'),
(44, 'Test_13', '2020-12-18', 1, 'namthangmu123@gmail.com', '0374561236'),
(45, 'Test_14', '2020-12-18', 0, 'namthangmu123@gmail.com', '36784252'),
(46, 'Test_15', '2021-01-10', 0, 'namthangmu123@gmail.com', '0151641889'),
(47, 'Chu Nam Thắng', '2020-12-28', 1, 'namthangmu123@gmail.com', '0961600587');

-- --------------------------------------------------------

--
-- Table structure for table `listimg_products`
--

CREATE TABLE `listimg_products` (
  `Lis_ID` int(11) NOT NULL,
  `Lis_Path` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `Pro_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `listimg_products`
--

INSERT INTO `listimg_products` (`Lis_ID`, `Lis_Path`, `Pro_ID`) VALUES
(2, '../Image/Products/Xoài/Xoài_1.jpg', 1),
(3, '../Image/Products/Xoài/Xoài_1.jpg', 1),
(4, '../Image/Products/Xoài/Xoài_2.jpg', 1),
(5, '../Image/Products/Xoài/Xoài_3.jpg', 1),
(6, '../Image/Products/Xoài/Xoài_4.jpg', 1),
(7, '../Image/Products/Xoài/Xoài_5.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `Ord_ID` int(11) NOT NULL,
  `Ord_Address` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `Ord_Date` datetime NOT NULL,
  `Ord_Date_Done` datetime NOT NULL DEFAULT current_timestamp(),
  `Ord_Total` bigint(20) NOT NULL,
  `Ord_Status` int(11) NOT NULL DEFAULT 0,
  `Cus_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`Ord_ID`, `Ord_Address`, `Ord_Date`, `Ord_Date_Done`, `Ord_Total`, `Ord_Status`, `Cus_ID`) VALUES
(3, 'Tổ 13, khu 2, ấp 7, xã An Phước, huyện Long Thành, tỉnh Đồng Nai', '2020-12-07 10:50:57', '2020-12-27 01:58:04', 845000, 3, 11),
(5, 'Tổ 13, khu 2, ấp 7, xã An Phước, huyện Long Thành, tỉnh Đồng Nai', '2020-12-07 18:50:32', '2020-12-27 01:58:04', 75000, 3, 13),
(6, 'TP. Hồ Chí Minh', '2020-12-07 18:52:57', '2020-12-27 02:54:07', 75000, 3, 14),
(7, 'TP. Hồ Chí Minh', '2020-12-07 19:04:21', '2020-12-28 09:45:43', 75000, 3, 15),
(8, 'TP. Hồ Chí Minh', '2020-12-07 19:13:42', '2020-12-27 01:58:04', 75000, 0, 16),
(9, 'TP. Hồ Chí Minh', '2020-12-07 19:18:20', '2020-12-27 01:58:04', 75000, 0, 17),
(10, 'Xã Tam Phước, TP.Biên Hòa, tỉnh Đồng Nai', '2020-12-08 07:13:37', '2020-12-27 01:58:04', 75000, 0, 18),
(11, 'Xã Tam Phước, TP.Biên Hòa, tỉnh Đồng Nai', '2020-12-08 08:15:47', '2020-12-27 01:58:04', 75000, 0, 19),
(12, 'TP. Hồ Chí Minh', '2020-12-08 08:32:03', '2020-12-27 01:58:04', 240000, 1, 20),
(14, 'TP. Hồ Chí Minh', '2020-12-08 10:07:25', '2020-12-27 01:58:04', 577250, 0, 22),
(15, 'Xã Tam Phước, TP.Biên Hòa, tỉnh Đồng Nai', '2020-12-08 10:09:51', '2020-12-27 01:58:04', 577250, 0, 23),
(16, 'Xã Tam Phước, TP.Biên Hòa, tỉnh Đồng Nai', '2020-12-08 14:18:06', '2020-12-27 01:58:04', 732250, 0, 24),
(17, 'Tổ 13, khu 2, ấp 7, xã An Phước, huyện Long Thành, tỉnh Đồng Nai', '2020-12-08 14:26:39', '2020-12-27 01:58:04', 732250, 0, 25),
(18, 'Tổ 13, khu 2, ấp 7, xã An Phước, huyện Long Thành, tỉnh Đồng Nai', '2020-12-08 15:33:50', '2020-12-27 01:58:04', 775000, 0, 26),
(19, 'Tổ 13, khu 2, ấp 7, xã An Phước, huyện Long Thành, tỉnh Đồng Nai', '2020-12-08 15:41:07', '2020-12-27 01:58:04', 275000, 0, 27),
(20, 'Tổ 13, khu 2, ấp 7, xã An Phước, huyện Long Thành, tỉnh Đồng Nai', '2020-12-08 21:47:56', '2020-12-27 01:58:04', 150000, 0, 28),
(21, 'Tổ 13, khu 2, ấp 7, xã An Phước, huyện Long Thành, tỉnh Đồng Nai', '2020-12-08 21:49:23', '2020-12-27 01:58:04', 150000, 0, 29),
(24, 'TP. Hồ Chí Minh', '2020-12-10 20:22:01', '2020-12-27 02:57:31', 105000, 3, 33),
(27, 'TP. Hồ Chí Minh', '2020-12-11 03:19:05', '2020-12-27 01:58:04', 180000, 0, 38),
(28, 'TP. Hồ Chí Minh', '2020-12-11 03:26:03', '2020-12-27 01:58:04', 60000, 0, 41),
(38, 'Xã Tam Phước, TP.Biên Hòa, tỉnh Đồng Nai', '2020-12-17 21:02:10', '2020-12-27 01:58:04', 190000, 0, 35),
(39, 'TP. Hồ Chí Minh', '2020-12-17 22:39:08', '2020-12-27 02:22:10', 221500, 3, 35),
(42, 'Nhà Tao', '2020-12-18 04:32:02', '2020-12-27 01:58:04', 150000, 0, 35),
(72, '5', '2020-12-23 13:10:07', '2020-12-28 02:14:10', 44000, 3, 47),
(73, '5', '2020-12-23 13:10:31', '2020-12-27 01:58:04', 100000, 3, 47),
(74, '6', '2020-12-23 13:10:53', '2020-12-26 02:02:38', 51500, 3, 47),
(78, 'Test Admin', '2020-12-24 21:44:10', '2020-12-27 01:58:04', 100000, 3, 47),
(79, 'ABC', '2020-12-25 14:42:21', '2020-12-27 01:58:04', 90000, 3, 47),
(80, 'Đồng Nai Never Die', '2020-12-27 02:06:12', '2020-12-27 02:06:12', 119000, 0, 47),
(83, 'abc', '2020-12-28 01:56:51', '2020-12-28 01:56:51', 136000, 0, 47),
(85, 'TP.HCM', '2020-12-28 09:39:00', '2020-12-28 09:39:00', 818000, 0, 35),
(86, 'TP.HCM', '2020-12-28 09:40:23', '2020-12-28 09:44:32', 305000, 3, 47);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `Ord_ID` int(11) NOT NULL,
  `Pro_ID` int(11) NOT NULL,
  `Ordd_Amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`Ord_ID`, `Pro_ID`, `Ordd_Amount`) VALUES
(3, 1, 5),
(3, 2, 5),
(3, 3, 5),
(3, 4, 3),
(5, 1, 1),
(6, 1, 1),
(7, 1, 1),
(8, 1, 1),
(9, 1, 1),
(10, 1, 1),
(11, 1, 1),
(12, 1, 1),
(12, 3, 3),
(14, 1, 1),
(14, 3, 3),
(14, 7, 3),
(14, 8, 3),
(14, 10, 5),
(15, 1, 1),
(15, 3, 3),
(15, 7, 3),
(15, 8, 3),
(15, 10, 5),
(16, 1, 2),
(16, 3, 3),
(16, 6, 4),
(16, 7, 3),
(16, 8, 3),
(16, 10, 5),
(17, 1, 2),
(17, 3, 3),
(17, 6, 4),
(17, 7, 3),
(17, 8, 3),
(17, 10, 5),
(18, 1, 5),
(18, 2, 4),
(18, 3, 4),
(18, 4, 4),
(19, 3, 5),
(20, 1, 2),
(21, 1, 2),
(24, 1, 1),
(24, 2, 1),
(27, 11, 2),
(27, 12, 2),
(28, 6, 3),
(38, 6, 5),
(38, 8, 2),
(39, 3, 1),
(39, 6, 2),
(39, 7, 2),
(39, 9, 1),
(42, 1, 2),
(72, 5, 2),
(73, 6, 5),
(74, 7, 2),
(78, 6, 5),
(79, 8, 2),
(80, 4, 5),
(80, 5, 2),
(83, 1, 1),
(83, 18, 1),
(85, 1, 5),
(85, 3, 1),
(85, 5, 4),
(85, 6, 5),
(85, 17, 1),
(86, 1, 3),
(86, 6, 4);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `Pro_ID` int(11) NOT NULL,
  `Pro_Img` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `Pro_Type` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `Pro_Name` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `Pro_Nation` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Pro_Price` bigint(20) NOT NULL,
  `Pro_Rate` int(5) NOT NULL,
  `Pro_Info` varchar(2000) COLLATE utf8_unicode_ci NOT NULL,
  `Pro_View` bigint(20) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`Pro_ID`, `Pro_Img`, `Pro_Type`, `Pro_Name`, `Pro_Nation`, `Pro_Price`, `Pro_Rate`, `Pro_Info`, `Pro_View`) VALUES
(1, '../Image/Products/Xoài/Xoài.jpg', 'Trái cây nội', 'Xoài Cát Hòa Lộc', 'Việt Nam', 75000, 5, 'Xoài cát Hòa Lộc là đặc sản nổi tiếng Miền Tây. Nó là một loại hoa quả được khá nhiều người yêu thích trên thị trường vì màu sắc đẹp mắt, mùi vị thơm ngon và có giá trị dinh dưỡng tương đối cao. Loại trái cây này không chỉ có thương hiệu nổi tiếng tại Việt Nam mà cả thị trường thế giới. Hơn thế xoài cát Hòa Lộc xuất khẩu đang giữ vị trí top đầu trong nền hoa quả sạch trên thế giới.', 73),
(2, '../Image/Products/Bòn bon/Bòn bon.jpg', 'Trái cây nội', 'Bòn Bon', 'Việt Nam', 30000, 4, 'Bòn bon (một số nơi còn gọi quả boòng boong) là cây thân gỗ lớn, có 3 loại tương ứng với 3 màu quả: Đỏ, xanh và vàng nâu, bên trong lớp vỏ dày là những múi mọng nước có vị chua ngọt dịu.\r\nQuả cây bòn bon được bày bán rất nhiều vào tầm tháng 6, tháng 7, quả được bán trên thị trường như một loại trái cây đặc sản vùng rừng núi đang được mọi người ưa thích. Đặc biệt, quả cây bòn bon có màu đỏ tươi, màu nâu vàng rất đẹp, cây ra hoa đậu quả hàng năm thường xuyên, ít khi mất mùa.', 26),
(3, '../Image/Products/Bưởi/Bưởi.jpg', 'Trái cây nội', 'Bưởi Da Xanh', 'Việt Nam', 55000, 5, 'So với các giống bưởi khác thì bưởi da xanh có phần nioir trội hơn hẳn về chất lượng và hương vị. Một quả bưởi da xanh khi chín sẽ có màu xanh căng bóng. Chỉ cần bứt phần cuống đi là mùi thơm đã tỏa ra thơm ngát không gian phòng. Khi ăn bạn sẽ bị loại bưởi này làm cho mê mẩn bởi vị ngọt thanh nơi đầu lưỡi cho đến cuống họng. Múi màu hồng óng ả, giòn tan trong miệng  đặc biệt không có hạt khiến ăn một lần là nhớ mãi.', 15),
(4, '../Image/Products/Cam sành/Cam sành.jpg', 'Trái cây nội', 'Cam Sành', 'Việt Nam', 15000, 3, 'Cam sành là một giống cây ăn quả thuộc chi Cam chanh phân bố rộng khắp Việt Nam từ Tuyên Quang, Hà Giang, Yên Bái tới Vĩnh Long, Tiền Giang, Cần Thơ. Nhưng nhìn chung cam sành thích hợp với vùng đất phù sa cổ màu mỡ,khí hậu mát ẩm. Cam sành vietgap đang là tiêu chuẩn trồng và chăm sóc chính của bà con nơi đây', 6),
(5, '../Image/Products/Cam xoàn/Cam xoàn.jpg', 'Trái cây nội', 'Cam Xoàn', 'Việt Nam', 22000, 4, 'Cam xoàn là một loại quả đặc sản của miền Tây. Cam Xoàn có ruột vàng, vị ngọt thanh hơn quýt, trái to. Những cây có tuổi từ 3 năm trở lên thường ra quả nhiều và quanh năm. Cam xoàn có tác dụng rất tốt đối với sức khỏe con người. Đặc biệt là trẻ em và phụ nữ có thai. Tác dụng tăng cường hệ miễn dịch, làn da tươi trẻ, mịn màng.', 8),
(6, '../Image/Products/Chôm chôm/Chôm chôm.jpg', 'Trái cây nội', 'Chôm Chôm Long Khánh', 'Việt Nam', 20000, 5, 'Chôm chôm là sản phẩm nông nghiệp đặc sắc của Ðồng Nai, nhất là chôm chôm ở Long Khánh, có chất lượng trái ngon và giá trị kinh tế cao. Mùa này, chôm chôm Long Khánh, Đồng Nai đang chín rộ, bạn dễ dàng nhận ra khi xe ngang qua các khu vườn um tùm hai bên đường. Ghé bất kỳ quán nước nào bên đường bạn cũng có thể hỏi thăm những nhà vườn đang sẵn sàng đón khách.', 20),
(7, '../Image/Products/Chuối/Chuối.jpg', 'Trái cây nội', 'Chuối FOHLA', 'Việt Nam', 25750, 5, 'Chuối Fohla không đơn thuần lớn lên từ đất, mà đơm hoa kết trái từ 9 tháng gieo trồng tận lực bởi những bàn tay chăm sóc tận tâm. Mỗi trái chuối Fohla là sự hòa quyện hoàn hảo giữa Nước, Phân, Cần, Giống. Là cuộc sống, là đam mê, là tận tụy, để nâng những kỳ vọng về sức khỏe dinh dưỡng của bạn lên một tầm cao mới.', 11),
(8, '../Image/Products/Dưa hấu/Dưa hấu.jpg', 'Trái cây nội', 'Dưa Hấu Hắc Mỹ Nhân', 'Việt Nam', 45000, 5, 'Dưa hấu Hắc Mỹ Nhân là loại quả to, mỏng vỏ, đỏ thịt và hương vị ngon ngọt đặc biệt. Sản phẩm được trồng hữu cơ, đảm bảo không chứa chất kích thích tăng trưởng, nên rất an toàn cho sức khỏe của người sử dụng. Với Dưa hấu Hắc Mỹ Nhân, bạn có thể dùng ăn trực tiếp hoặc ép lấy nước uống, làm sinh tố, làm thạch, trang trí bánh, đều rất thơm ngon và bổ dưỡng.', 10),
(9, '../Image/Products/Dưa lưới ruột vàng/Dưa lưới ruột vàng.png', 'Trái cây nội', 'Dưa Lưới Ruột Vàng', 'Việt Nam', 75000, 5, 'Dưa Lưới Ruột Vàng là loại quả cung cấp nhiều chất dinh dưỡng cần thiết cho cơ thể như vitamin C, vitamin B, carotene, sắt, canxi, kali, natri, magiê Vì thế, nó có tác dụng bồi bổ, tăng sức đề kháng rất tốt, thích hợp với những người thiếu máu, sức yếu do ốm dậy…', 5),
(10, '../Image/Products/Mận/Mận.jpg', 'Trái cây nội', 'Mận An Phước', 'Việt Nam', 25000, 4, 'Mận An Phước, hay còn gọi là mận đỏ. Chúng có dạng hình trái oản dài, kích thước lớn. Vỏ quả màu đỏ tím có sọc trắng rất đẹp mắt. Cùi mận màu trắng xanh giòn, ngọt và không hạt.\r\nMận được trồng nhiều tại các tỉnh Bến Tre, Vĩnh Long, Đồng Tháp, Tiền Giang và chưa có vùng chuyên canh. Lý do mận An Phước không được trồng nhiều là do người dân sợ rớt giá. Và phải là giống mận An Phước xịn, chuẩn nhất thì mới trồng ra được loại quả ngon.', 7),
(11, '../Image/Products/Măng cụt/Măng cụt.jpg', 'Trái cây nội', 'Măng Cụt Bảo Lộc', 'Việt Nam', 40000, 4, 'Với khí hậu, thổ nhưỡng và thiên nhiên ưu đãi, măng cụt đã và đang trở thành loại trái cây đặc sản của Bảo Lộc, được thị trường đánh giá cao về chất lượng. Hiện tại tháng 8/2020 là thu hoạch ngịch mùa nên giá thành cao hơn mùa thuận.', 14),
(12, '../Image/Products/Nho/Nho.jpg', 'Trái cây nội', 'Nho Xanh', 'Việt Nam', 50000, 5, 'Nho xanh Ninh thuận có phần vỏ màu xanh, quả dài, nhỏ hình bầu dục, thịt dày chắc ngọt, nhiều nước, chùm quả to và dài.Từ lâu nho được biết đến là trái cây có nhiều chất dinh dưỡng, tốt cho sức khỏe\r\nTrong quả nho xanh ninh thuận chứa 70-80% là nước , 15-33% là đường, chủ yếu là glucose và fructose và các chất dinh dưỡng khác như kali, kẽm, canxi,vitamin C…\r\nThường xuyên ăn nho xanh ninh thuận tốt cho hệ tiêu hóa, cái thiện hệ tim mạch, giảm lượng cholesterol. Theo môt cuộc nghiên cứu, trong nho tươi có chất resveratrol là chất chống oxy hóa tự nhiên chống lão hóa rất hữu hiệu.\r\n\r\n\r\n', 12),
(13, '../Image/Products/Ổi/Ổi.jpg', 'Trái cây nội', 'Ổi Không Hạt', 'Việt Nam', 80000, 5, 'Trang chủ Cây ổi giống Cây giống ổi không hạt - Cách trồng chăm sóc giống ổi không hạt\r\ncay-giong-oi-khong-hat-cach-trong-cham-soc-giong-oi-khong-hat\r\nCây giống ổi không hạt - Cách trồng chăm sóc giống ổi không hạt\r\nCây giống ổi không hạt - Cách trồng chăm sóc giống ổi không hạt\r\nTình trạng: Còn hàng\r\n\r\nGiá bán :Liên hệ\r\nThông tin liên quan1. Cách trồng và nhân giống ổi không hạtTiêu chuẩn đấtTiêu chuẩn lựa chọn giống cây trồngĐào hố và trồng cây  : Trước khi trồng ổi không hạt trước 1 tháng bạn cần làm hố và bón lót cho cây. Đất trồng cây cần tơi xốp, thoáng, giữ nước tốt. Nếu như trồng ở nơi đất trũng bạn nên làm luống cao trên 50 cm sẽ giúp cây phát triển tốt tránh khô hạn.- Trồng cây2. Cách chăm sóc cây ổi không hạt- Tưới nước-Bón phânTạo tán, tỉa cành, bấm ngọnThu hoạch ổi không hạt.\r\nỔi không hạt to hơn những giống ổi khác, ăn ngọt và giòn hơn nên được nhiều người ưa chuộng tìm mua về mỗi khi đến vụ.\r\n\r\nỞ nước ta ổi từ lâu là loại trái cây đã quá đỗi quen thuộc. Giống quả to tròn giàu dinh dưỡng này đã trở thành loại quả dân dã được hầu hết mọi người ưa thích. Hiện nay bằng phương pháp nhân giống tiên tiến các nhà khoa học đã cho ra đời giống ổi không hạt với nhiều ưu điểm vượt trội so với ổi bản địa.', 1),
(15, '../Image/Products/Quýt/Quýt.jpg', 'Trái cây nội', 'Quýt Ngọt', 'Việt Nam', 30000, 5, 'Tất cả các loại trái cây họ cam quýt chứa nhiều Vitamin C và quýt không phải là ngoại lệ. Quýt chứa 36 mg vitamin C trong mỗi quả. Vitamin C tốt cho tóc, da, hệ thống miễn dịch và cân bằng trọng lượng cơ thể đồng thời cũng là một vitamin tuyệt vời cho hệ tiêu hóa của bạn. Vitamin C giúp điều hòa ruột và cải thiện sự hấp thụ chất dinh dưỡng từ các loại thực phẩm khác. Tốt hơn hãy đáp ứng nhu cầu hàng ngày của vitamin C thông qua trái cây, vì thuốc được làm bằng một số phiên bản hóa học của Vitamin C có thể làm giảm sự hấp thụ chất dinh dưỡng từ các loại thực phẩm khác.', 1),
(16, '../Image/Products/Sapoche/Sapoche.jpg', 'Trái cây ngoại', 'Sapoche (Hồng Xiêm)', 'Mexico', 130000, 5, 'Cũng do giàu canxi, photpho, các vitamin và khoáng chất nên hồng xiêm là lựa chọn tốt cho bà bầu và trẻ nhỏ. Bổ sung thêm hồng xiêm vào thực đơn hàng ngày sẽ giúp bà bầu, trẻ nhỏ phòng tránh được bệnh thiếu máu, thiếu canxi cùng các khoáng chất khác. Ngoài ra, lượng vitamin B5, B6, B3, B1... có trong hồng xiêm giúp cho hệ thần kinh phát triển, chống mỏi mệt và giúp giác ngủ được sâu hơn.\r\n\r\nCùng với đó, hồng xiêm còn là nguồn cung cấp phong phú tannin và polyphenolic – các chất có lợi cho đường tiêu hóa. Hồng xiêm sẽ giúp loại bỏ các chất thải từ dạ dày, làm sạch dạ dày, giảm tiêu chảy. Các khoáng chất dồi dào trong loại quả này cũng giúp cho việc hình thành các enzyme cần thiết trong dạ dày, từ đó điều chỉnh quá trình trao đổi chất và giữ cho đường tiêu hóa luôn sạch sẽ.\r\n\r\nĐặc biệt, hồng xiêm còn có tác dụng trong làm đẹp da, tóc. Dầu chiết xuất từ hạt hồng xiêm giúp dưỡng ẩm và làm mềm tóc, giúp tóc óng mượt. Điều tuyệt vời của dầu hạt hồng xiêm là nó dễ dàng được các sợi tóc hấp thụ mà không để lại dầu. Vì vậy mà ngay cả khi sở hữu mái tóc nhiều dầu, bạn vẫn có thể sử dụng loại dầu dưỡng này mà không phải lo đến việc nó làm mái tóc dễ bị bẩn và sinh gàu.', 1),
(17, '../Image/Products/Sầu riêng/Sầu riêng.jpg', 'Trái cây ngoại', 'Sầu Riêng Musang King', 'Malaysia', 200000, 5, 'Sầu riêng Musang King Malaysia (hay Musang King Durian) là loại sầu riêng thuộc hàng ngon nhất và trở thành “biểu tượng” của Malaysia khi được chính thủ tướng Malaysia đem tặng thủ tướng Singapre nhân sự kiện Nông sản Quốc gia Malaysia năm nay.\r\nSầu riêng Musang King của Malaysia được thu hoạch hoàn toàn từ trái sầu riêng chín hẵn và rụng xuống chứ không hái trên cây như sầu riêng Thái và Việt Nam nên cho ra độ ngậy và thơm vượt trội. Sầu riêng Musang không quá ngọt và có vị đắng đắng giống như quả bơ vậy. Đây là cách dể nhất để phân biệt sầu riêng Musang King chính hiệu.', 2),
(18, '../Image/Products/Táo xanh/Táo xanh.jpg', 'Trái cây nội', 'Táo Xanh', 'Việt Nam', 61000, 4, 'Táo xanh – Green apple có màu xanh lá nhẹ , vị chua thanh , giòn và mọng nước.\r\nTáo là một trong những loại trái cây được tiêu thụ rộng rãi trên thế giới. Hiện nay trên thị trường có rất nhiều loại táo như: táo đỏ (red delicious), táo Golden, táo xanh, táo Pink Lady, táo Fuji, táo Envy, táo Gala, táo Braeburn, táo Jazz… Táo luôn được coi là có màu đỏ vì sự phổ biến của nó. Tuy nhiên, loại táo ít được biết đến hơn, có màu xanh lục có nguồn gốc từ Úc. Táo xanh lần đầu tiên được trồng bởi Maria Ann Smith, và đó là lý do tại sao chúng thường được gọi là táo Granny Smith. Trong bài viết này, Santorino sẽ cùng các bạn giải đáp một số thắc mắc liên quan đến loại táo có màu xanh lục này, các bạn hãy cùng tham khảo bài viết bên dưới nhé.', 1),
(19, '../Image/Products/Thanh long ruột đỏ/Thanh long ruột đỏ.jpg', 'Trái cây nội', 'Thanh Long Ruột Đỏ', 'Việt Nam', 65000, 4, 'Thanh long là loại trái cây thuộc họ xương rồng, có nguồn gốc từ Trung và Nam Mỹ, được nhập vào các nước Đông Nam Á để làm thực phẩm, làm thuốc và làm cảnh. Thanh long ruột đỏ hay còn gọi là thanh long ruột hồng , quả thường được thu hoạch vào mùa hè hoặc mùa thu. Ngày nay, dưới sự phát triển của khoa học, kỹ thuật người ta có thể trồng thanh long ruột đỏ cho ra quả quanh năm.\r\nThanh long ruột đỏ thuộc loại thân leo trườn dài, dài tới 10m, cây có thể bám chặt nhờ bộ rễ phụ.\r\nThân cây thanh long có màu lục, có ít gai và ngắn, có 3 cạnh dẹp khía tai bèo, thường hóa sừng ở các mép\r\nThanh long ruột đỏ ưa ánh sáng, rễ bàng và ưa cạn nên thích hợp trồng ở nơi thông thoáng, không bị che quá 30% diện tích chiếu sáng. Tránh bị ngập úng khi mưa, lũ, nước không nhiễm bị nhiễm mặn hoặc phèn.', 1),
(20, '../Image/Products/Kiwi vàng/Kiwi vang.png', 'Trái cây ngoại', 'Kiwi Vàng', 'NewZealand', 190000, 4, 'Kiwi vàng New Zealand là loại quả ngon số 1 thế giới, với quy trình từ trồng, chăm bón đến thu, hái, vận chuyển được chính phủ New Zealand kiểm soát rất chặt chẽ để đảm bảo quả kiwi luôn đồng đều và đủ tiêu chuẩn. Kiwi vàng thường được ăn trực tiếp hoặc chế biến các món ăn tốt cho sức khỏe. Chỉ nên rửa qua lớp vỏ ngoài của kiwi trước khi gọt và sử dụng ngay sau khi gọt vỏ, tránh mất các thành phần dinh dưỡng quan trọng của quả kiwi.', 1),
(21, '../Image/Products/Lê Hàn Quốc/Le han quoc.png', 'Trái cây ngoại', 'Lê Hàn Quốc', 'Hàn Quốc', 100000, 5, 'Trái Lê Hàn Quốc được đánh giá là một trong những loại lê ngon nhất trên thế giới hiện nay. Các loại lê Hàn Quốc được nhập khẩu về Việt Nam chủ yếu là lê nâu, được lựa chọn tại các vườn danh tiếng nhất tại Hàn Quốc.\r\n\r\nLê Hàn rất đa dạng với nhiều chủng loại, giá bán khác nhau. Một trong những cách phân biệt chính là dựa theo size/ thùng, size càng lớn thì ăn càng ngọt, giòn và ngon hơn.\r\n\r\nVí dụ: Size 5/ thùng 5kg – 5 trái/ 1 thùng có khối lượng tịnh là 5kg (~ mỗi trái có khối lượng khoảng 1kg). Một số loại size khác như Size 5, 6, 7, 8 (5kg) hoặc size 22, 24, 26, 32 (thùng 15kg).', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`Acc_ID`),
  ADD UNIQUE KEY `Acc_Username` (`Acc_Username`),
  ADD KEY `FK_ACCOUNTS_01` (`Cus_ID`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`Com_ID`),
  ADD KEY `FK_COMMENTS_01` (`Acc_ID`),
  ADD KEY `FK_COMMENTS_02` (`Pro_ID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Cus_ID`);

--
-- Indexes for table `listimg_products`
--
ALTER TABLE `listimg_products`
  ADD PRIMARY KEY (`Lis_ID`),
  ADD KEY `FK_LISIMG_01` (`Pro_ID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`Ord_ID`),
  ADD KEY `FK_ORDERS_01` (`Cus_ID`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`Ord_ID`,`Pro_ID`),
  ADD KEY `FK_ORDERDETAILS_02` (`Pro_ID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`Pro_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `Acc_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `Com_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `Cus_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `listimg_products`
--
ALTER TABLE `listimg_products`
  MODIFY `Lis_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `Ord_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `Pro_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `FK_ACCOUNTS_01` FOREIGN KEY (`Cus_ID`) REFERENCES `customer` (`Cus_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `FK_COMMENTS_01` FOREIGN KEY (`Acc_ID`) REFERENCES `accounts` (`Acc_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_COMMENTS_02` FOREIGN KEY (`Pro_ID`) REFERENCES `products` (`Pro_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `listimg_products`
--
ALTER TABLE `listimg_products`
  ADD CONSTRAINT `FK_LISIMG_01` FOREIGN KEY (`Pro_ID`) REFERENCES `products` (`Pro_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_ORDERS_01` FOREIGN KEY (`Cus_ID`) REFERENCES `customer` (`Cus_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `FK_ORDERDETAILS_01` FOREIGN KEY (`Ord_ID`) REFERENCES `orders` (`Ord_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ORDERDETAILS_02` FOREIGN KEY (`Pro_ID`) REFERENCES `products` (`Pro_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
