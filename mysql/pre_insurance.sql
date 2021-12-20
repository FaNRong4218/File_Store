-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2021 at 02:05 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pre_insurance`
--

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `Car_ID` int(10) NOT NULL,
  `Car_Name` varchar(255) NOT NULL,
  `Car_Img` varchar(255) NOT NULL,
  `Car_Status` enum('on','off') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`Car_ID`, `Car_Name`, `Car_Img`, `Car_Status`) VALUES
(1, ' HONDA', 'Brand_logo_03.jpg', 'on'),
(2, 'TOYOTA', 'Brand_logo_10.jpg', 'on'),
(3, '  SUSUKI', 'Brand_logo_09.jpg', 'on'),
(4, ' NISSAN', 'Brand_logo_07.jpg', 'on');

-- --------------------------------------------------------

--
-- Table structure for table `insurance`
--

CREATE TABLE `insurance` (
  `Corp_ID` int(25) NOT NULL,
  `Corp_Name` varchar(255) NOT NULL,
  `Corp_Date` date NOT NULL,
  `Corp_img` varchar(255) NOT NULL,
  `Corp_Status` enum('on','off') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `insurance`
--

INSERT INTO `insurance` (`Corp_ID`, `Corp_Name`, `Corp_Date`, `Corp_img`, `Corp_Status`) VALUES
(1, ' กรุงเทพประกันภัย', '2021-12-15', 'insu_logo_01.png', 'on'),
(2, 'KIP กรุงไทยพานิชประกันภัย', '2021-12-15', 'insu_logo_02.png', 'on'),
(3, 'KWG insurance', '2021-12-15', 'insu_logo_03.png', 'on'),
(4, 'Tokiomarine Insurance', '2021-12-15', 'insu_logo_04.png', 'off'),
(5, 'FWD ประกันชีวิต', '2021-12-17', 'insu_logo_26.png', 'on'),
(6, 'เมืองไทยประกันชีวิต', '2021-12-19', 'insu_logo_18.png', 'on');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `Report_ID` int(10) NOT NULL,
  `Corp_ID` int(10) NOT NULL,
  `Type_ID` int(10) NOT NULL,
  `Car_ID` int(10) NOT NULL,
  `Report_Detail` text NOT NULL,
  `Date_Start` date NOT NULL,
  `Date_Now` date NOT NULL,
  `Date_Ext` date NOT NULL,
  `Report_Status` enum('on','off') NOT NULL,
  `File1` varchar(255) NOT NULL,
  `File2` varchar(255) NOT NULL,
  `File3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`Report_ID`, `Corp_ID`, `Type_ID`, `Car_ID`, `Report_Detail`, `Date_Start`, `Date_Now`, `Date_Ext`, `Report_Status`, `File1`, `File2`, `File3`) VALUES
(1, 2, 1, 3, '<p>ประกันที่ 1 ในใจคุณ</p>', '2021-12-10', '2021-12-19', '2025-12-30', 'on', '20211219546.txt', '202112191780.docx', '202112192995.pdf'),
(2, 2, 2, 2, '<p>TOYOTA ขอมอบความสุขแก่รถของท่าน</p>', '2021-12-19', '2021-12-19', '2026-02-24', 'off', '20211219313.mp3', ' 202112191113.xlsx', '202112192369.png'),
(3, 5, 1, 4, '<p>test test test</p>', '2021-12-19', '2021-12-19', '2026-05-23', 'on', '20211219247.pdf', ' 202112191433.txt', '202112192111.tif');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `Type_ID` int(10) NOT NULL,
  `Type_Name` varchar(255) NOT NULL,
  `Type_detail` text NOT NULL,
  `Type_Status` enum('on','off') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`Type_ID`, `Type_Name`, `Type_detail`, `Type_Status`) VALUES
(1, '  ประเภทที่ 1', '<p><strong>คือประเภทประกันแบบสมัครใจ ประกอบด้วย </strong></p><p><strong>1. หมวดการคุ้มครองความรับผิดต่อบุคคลภายนอก </strong></p><p><strong>- ความเสียหายต่อชีวิต ร่างกาย หรืออนามัย </strong></p><p><strong>- ความเสียหายต่อทรัพย์สิน </strong></p><p><strong>2. หมวดการคุ้มครองรถยนต์สูญหายไฟไหม้ </strong></p><p><strong>- กรณีรถยนต์สูญหาย </strong></p><p><strong>- กรณีรถยนต์ไฟไหม้ </strong></p><p><strong>3 หมวดการคุ้มครองความเสียหายต่อรถยนต์</strong></p>', 'on'),
(2, 'ประเภทที่ 2 ', 'เป็นการประกันภัยรถยนต์ภาคสมัครใจ \r\nเป็นการประกันภัยที่ให้ความคุ้มครองใกล้เคียงกับการประกันภัยรถยนต์ประเภท 1 แตกต่างกันเพียงไม่มีความคุ้มครองความเสียหายที่เกิดขึ้นกับตัวรถยนต์ โดยมีความคุ้มครองหลัก\r\nประกอบด้วย\r\n1.หมวดการคุ้มครองความรับผิดต่อบุคคลภายนอก\r\n- ความเสียหายต่อชีวิต ร่างกาย หรืออนามัย\r\n- ความเสียหายต่อทรัพย์สิน\r\n2.หมวดการคุ้มครองรถยนต์สูญหายไฟไหม้\r\n- กรณีรถยนต์สูญหาย\r\nกรณีรถยนต์ไฟไหม้\r\n', 'on'),
(3, 'ประเภทที่ 3', 'เป็นการประกันภัยรถยนต์ภาคสมัครใจ \r\nเป็นการประกันภัยที่ให้ความคุ้มครองน้อยกว่าการประกันภัยรถยนต์ประเภท 1 และประเภท 2 โดยบริษัทประกันภัยจะชดใช้ค่าสินไหมทดแทนเฉพาะความรับผิดตามกฎหมายต่อบุคคลภายนอก ประกอบด้วย\r\n1.ความเสียหายต่อชีวิต ร่างกาย หรืออนามัย\r\n2.ความเสียหายต่อทรัพย์สิน\r\n\r\n', 'on');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user` varchar(200) CHARACTER SET utf8 NOT NULL,
  `pass` varchar(255) CHARACTER SET utf8 NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `tel` varchar(10) CHARACTER SET utf8 NOT NULL,
  `type` enum('Admin','Stuff','User') CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user`, `pass`, `name`, `email`, `tel`, `type`) VALUES
(1, 'admin', '$2y$10$NhUJwDq.n0G2nuerqbxw..qww0R8Qrtx4HkeWC/oFquQa7UnuWlo.', 'admin', 'admin@gmail.com', '0987654321', 'Admin'),
(2, 'user', '$2y$10$NBM8y7xTU5WWaH0g3F0OX.NREKayLlFAlKXzJ3PA5buP44rT7EKDO', 'user', 'user@gmail', '0123456789', 'User'),
(3, 'stuff', '$2y$10$nj8r6qRs7coI0gvIPzModOpf.1TUbzyS5EZOmyYcuRmHAkUvdonJ2', 'stuff', 'stuff@gmail.com', '0147896325', 'Stuff');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`Car_ID`);

--
-- Indexes for table `insurance`
--
ALTER TABLE `insurance`
  ADD PRIMARY KEY (`Corp_ID`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`Report_ID`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`Type_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `Car_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `insurance`
--
ALTER TABLE `insurance`
  MODIFY `Corp_ID` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `Report_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `Type_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
