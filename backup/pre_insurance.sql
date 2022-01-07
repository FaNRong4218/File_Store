-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2022 at 02:29 AM
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
(1, '  HONDA', 'Brand_logo_03.jpg', 'off'),
(2, 'TOYOTA', 'Brand_logo_10.jpg', 'on'),
(3, '  SUSUKI', 'Brand_logo_09.jpg', 'on'),
(4, ' NISSAN', 'Brand_logo_07.jpg', 'on'),
(5, 'MAZDA', 'Brand_logo_05.jpg', 'on');

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE `file` (
  `File_ID` int(100) NOT NULL,
  `File_Name` varchar(255) NOT NULL,
  `Report_ID` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `file`
--

INSERT INTO `file` (`File_ID`, `File_Name`, `Report_ID`) VALUES
(1, '202112211909.docx', '1'),
(2, '202112211909.gif', '1'),
(3, '202112222641.rar', '2'),
(4, '202112222641.jpg', '2'),
(6, '202112228529.docx', '3'),
(7, '202112228529.rar', '3'),
(8, '202112228529.txt', '3'),
(9, '202112227090.tif', '4'),
(10, '202112227090.pdf', '4'),
(11, '202112227090.zip', '4'),
(14, '202112236864.docx', '5'),
(15, '202112236864.gif', '5'),
(16, '202112236595.rar', '6'),
(17, '202112236595.tif', '6'),
(18, '202112236595.mp3', '6'),
(20, '202112235655.xlsx', '6'),
(21, '202112269332.gif', '6'),
(22, '202112285238.docx', '1'),
(23, '202112281891.xlsx', '1'),
(24, '202112293723.png', '6');

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
(2, ' KIP กรุงไทยพานิชประกันภัย', '2021-12-15', 'insu_logo_02.png', 'off'),
(3, 'KWG insurance', '2021-12-15', 'insu_logo_03.png', 'on'),
(4, 'Tokiomarine Insurance', '2021-12-15', 'insu_logo_04.png', 'on'),
(5, 'FWD ประกันชีวิต', '2021-12-17', 'insu_logo_26.png', 'on'),
(6, 'เมืองไทยประกันชีวิต', '2021-12-19', 'insu_logo_18.png', 'on'),
(7, ' ธนชาติ', '2021-12-20', 'insu_logo_33.png', 'on'),
(8, 'มิตรแท้ ประกันภัย', '2021-12-29', 'insu_logo_37.png', 'on');

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
  `Report_Status` enum('on','off') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`Report_ID`, `Corp_ID`, `Type_ID`, `Car_ID`, `Report_Detail`, `Date_Start`, `Date_Now`, `Date_Ext`, `Report_Status`) VALUES
(1, 8, 1, 5, '<p>ประกันของนาย B</p>', '2021-12-21', '2021-12-29', '2025-10-25', 'on'),
(2, 3, 1, 2, '<p>sadqwqdxacw</p>', '2021-12-21', '2021-12-27', '2025-11-14', 'on'),
(3, 1, 2, 1, '<p>nekjbnqwkjdbviyqsgvcqwvd</p>', '2021-12-22', '2021-12-27', '2025-09-22', 'on'),
(4, 6, 2, 4, '<p>&nbsp;sd kwqbdbqwvdwquixqw&nbsp;</p>', '2021-12-22', '2021-12-23', '2025-05-18', 'on'),
(5, 4, 1, 2, '<p>wmdslwqndiouqwbduiw</p>', '2021-12-22', '2021-12-22', '2025-08-21', 'off'),
(6, 4, 2, 3, '<p>nbcbcdxbcbdhbhd</p>', '2021-12-22', '2021-12-22', '2025-07-22', 'off'),
(7, 7, 3, 4, '<p>nm,b mnvvxvcx</p>', '2021-12-22', '2021-12-24', '2029-01-22', 'on'),
(8, 8, 1, 4, '<p>ประกันชั้น 1 by มิตรแท้</p>', '2021-12-29', '2021-12-29', '2026-12-26', 'on');

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
(1, '    ประกันชั้นที่ 1 ', '<p><strong>คือประเภทประกันแบบสมัครใจ ซึ่งประกอบด้วย </strong></p><p><strong>1. หมวดการคุ้มครองความรับผิดต่อบุคคลภายนอก </strong></p><p><strong>- ความเสียหายต่อชีวิต ร่างกาย หรืออนามัย </strong></p><p><strong>- ความเสียหายต่อทรัพย์สิน </strong></p><p><strong>2. หมวดการคุ้มครองรถยนต์สูญหายไฟไหม้ </strong></p><p><strong>- กรณีรถยนต์สูญหาย </strong></p><p><strong>- กรณีรถยนต์ไฟไหม้ </strong></p><p><strong>3 หมวดการคุ้มครองความเสียหายต่อรถยนต์</strong></p>', 'on'),
(2, ' ประกันชั้นที่ 2 ', '<p>เป็นการประกันภัยรถยนต์ภาคสมัครใจ เป็นการประกันภัยที่ให้ความคุ้มครองใกล้เคียงกับการประกันภัยรถยนต์ประเภท 1 แตกต่างกันเพียงไม่มีความคุ้มครองความเสียหายที่เกิดขึ้นกับตัวรถยนต์ โดยมีความคุ้มครองหลัก ประกอบด้วย 1.หมวดการคุ้มครองความรับผิดต่อบุคคลภายนอก - ความเสียหายต่อชีวิต ร่างกาย หรืออนามัย - ความเสียหายต่อทรัพย์สิน 2.หมวดการคุ้มครองรถยนต์สูญหายไฟไหม้ - กรณีรถยนต์สูญหาย กรณีรถยนต์ไฟไหม้</p>', 'on'),
(3, ' ประกันชั้นที่ 3', '<p>เป็นการประกันภัยรถยนต์ภาคสมัครใจ เป็นการประกันภัยที่ให้ความคุ้มครองน้อยกว่าการประกันภัยรถยนต์ประเภท 1 และประเภท 2 โดยบริษัทประกันภัยจะชดใช้ค่าสินไหมทดแทนเฉพาะความรับผิดตามกฎหมายต่อบุคคลภายนอก ประกอบด้วย 1.ความเสียหายต่อชีวิต ร่างกาย หรืออนามัย 2.ความเสียหายต่อทรัพย์สิน</p>', 'on'),
(4, 'ประเภทชั้นที่ 4 ', '<p>ไม่ดูแลอะไรเลย&nbsp;</p>', 'on');

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
(2, 'user', '$2y$10$NBM8y7xTU5WWaH0g3F0OX.NREKayLlFAlKXzJ3PA5buP44rT7EKDO', 'user', 'user@gmail.com', '0123456789', 'User'),
(9, 'InwZa007', '$2y$10$9HtoNErdK8U32e2yHP0rDeKmha5etlKnH6k.QtN2TGJNaYfE/c3W2', 'InwZa007', 'InwZa007@gmail.com', '0963852741', 'Stuff');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`Car_ID`);

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`File_ID`);

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
  MODIFY `Car_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `File_ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `insurance`
--
ALTER TABLE `insurance`
  MODIFY `Corp_ID` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `Report_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `Type_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
