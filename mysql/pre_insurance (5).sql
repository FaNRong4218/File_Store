-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2022 at 06:56 AM
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
(1, '  ไม่มียี่ห้อรถยนต์', '202201138774none.png', 'on'),
(2, '  TOYOTA', '202201132989Brand_logo_10.jpg', 'on'),
(3, '  SUSUKI', '202201136860Brand_logo_09.jpg', 'on'),
(4, '  NISSAN', '202201133489Brand_logo_07.jpg', 'on'),
(5, '  MAZDA', '202201135355Brand_logo_05.jpg', 'on'),
(6, '  HONDA', '202201133003Brand_logo_03.jpg', 'on'),
(9, '  SUBARU', '202201137333Brand_logo_08.jpg', 'on'),
(10, 'LEXUS', 'none.png', 'off');

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE `file` (
  `File_ID` int(100) NOT NULL,
  `File_Name` varchar(255) NOT NULL,
  `File_Date` datetime NOT NULL,
  `Report_ID` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `file`
--

INSERT INTO `file` (`File_ID`, `File_Name`, `File_Date`, `Report_ID`) VALUES
(1, '202201139424test..docx', '2022-01-13 03:10:27', '17'),
(3, '202201131511test..rar', '2022-01-13 11:53:23', '19'),
(4, '202201131511test..zip', '2022-01-13 11:53:23', '19');

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
(1, '  กรุงเทพประกันภัย', '2021-01-15', '202201137734insu_logo_01.png', 'on'),
(2, ' KIP กรุงไทยพานิชประกันภัย', '2021-12-15', '202201135181insu_logo_02.png', 'on'),
(3, 'KWG insurance', '2021-12-15', '202201134355insu_logo_03.png', 'on'),
(4, 'Tokiomarine Insurance', '2021-12-15', '202201131860insu_logo_04.png', 'on'),
(5, 'FWD ประกันชีวิต', '2021-12-17', '202201131460insu_logo_26.png', 'on'),
(6, 'เมืองไทยประกันชีวิต', '2021-12-19', '202201136572insu_logo_18.png', 'on'),
(7, 'ธนชาติ', '2021-12-20', '202201133012insu_logo_33.png', 'on'),
(8, 'มิตรแท้ ประกันภัย', '2021-12-29', '202201136674insu_logo_37.png', 'on'),
(9, 'Jaymart', '2022-01-11', '202201135522insu_logo_06.png', 'on'),
(10, 'MISUBISHI', '2022-01-14', 'none.jpg', 'off');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `Report_ID` int(10) NOT NULL,
  `Corp_ID` varchar(10) NOT NULL,
  `Type_ID` varchar(10) NOT NULL,
  `Car_ID` varchar(10) NOT NULL,
  `Report_Detail` text NOT NULL,
  `Date_Start` datetime NOT NULL,
  `Date_Now` datetime NOT NULL,
  `Date_Ext` date NOT NULL,
  `Report_Status` enum('on','off') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`Report_ID`, `Corp_ID`, `Type_ID`, `Car_ID`, `Report_Detail`, `Date_Start`, `Date_Now`, `Date_Ext`, `Report_Status`) VALUES
(1, '8', '1', '5,4,3', '<p>ประกันของนาย B</p>', '2021-12-21 00:00:00', '2021-12-29 00:00:00', '2025-10-25', 'off'),
(2, '3', '1', '2', '<p>sadqwqdxacw</p>', '2021-12-21 00:00:00', '2022-01-13 12:30:57', '2025-11-14', 'on'),
(3, ' 1', ' 2', ' 6', '<p>nekjbnqwkjdbviyqsgvcqwvd</p>', '2021-12-22 00:00:00', '2022-01-10 00:00:00', '2025-09-22', 'off'),
(4, '6', '2', '4', '<p>&nbsp;sd kwqbdbqwvdwquixqw&nbsp;</p>', '2021-12-22 00:00:00', '2021-12-23 00:00:00', '2025-05-18', 'on'),
(5, '4', '1', '2', '<p>wmdslwqndiouqwbduiw</p>', '2021-12-22 00:00:00', '2021-12-22 00:00:00', '2025-08-21', 'off'),
(6, '4', '2', '3', '<p>nbcbcdxbcbdhbhd</p>', '2021-12-22 00:00:00', '2021-12-22 00:00:00', '2025-07-22', 'off'),
(7, '7', '3', '4', '<p>nm,b mnvvxvcx</p>', '2021-12-22 00:00:00', '2021-12-24 00:00:00', '2029-01-22', 'on'),
(8, '8', '1', '4', '<p>ประกันชั้น 1 by มิตรแท้</p>', '2021-12-29 00:00:00', '2021-12-29 00:00:00', '2026-12-26', 'off'),
(9, '1', '1', '5', '<p>ประกันของนาย C</p>', '2022-01-08 00:00:00', '2022-01-08 00:00:00', '2022-03-31', 'on'),
(10, '3', '2', '2,3', '<p>ประกันนาย D</p>', '2022-01-08 00:00:00', '2022-01-12 16:32:47', '2022-01-12', 'on'),
(11, '1', '1', '6', '<p>ประกันนาย F</p>', '2022-01-09 00:00:00', '2022-01-09 00:00:00', '2022-12-31', 'on'),
(12, '3', '4', '6', '<p>ประกันนาย O</p>', '2022-01-09 00:00:00', '2022-01-09 00:00:00', '2022-01-30', 'on'),
(13, '5', '4', '6', '<p>ประกันของ ฟร้องค์ นะ</p>', '2022-01-09 00:00:00', '2022-01-09 00:00:00', '2022-01-30', 'off'),
(14, '7', '2', '4', '<p>ประกันนน</p>', '2022-01-10 00:00:00', '2022-01-10 00:00:00', '2022-01-30', 'off'),
(15, '1', '1', '1', '<p><strong>ประกันนน</strong></p>', '2022-01-10 00:00:00', '2022-01-13 04:42:39', '2022-01-30', 'on'),
(16, '1', '1    ', '5,9', '<p>ประกันนน</p>', '2022-01-12 00:00:00', '2022-01-13 02:25:38', '2022-01-27', 'on'),
(17, '7', '1', '2,3,4,5', '<p>ประกันนาย K</p>', '2022-01-13 02:36:49', '2022-01-13 02:36:49', '2023-01-13', 'on'),
(18, '2', '3', '1', '<p>ประกันนาย G</p>', '2022-01-13 04:56:53', '2022-01-13 11:54:22', '2022-10-27', 'on'),
(19, '1', '1', '1', '<p>ประกันนนนน</p>', '2022-01-13 11:38:58', '2022-01-13 11:38:58', '2022-01-31', 'on');

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
(1, ' ประกันชั้นที่ 1 ', '<p>ความเสียหายที่เกิดขึ้นกับรถยนต์ของคุณการชนกับรถยนต์หรือพาหนะอื่นๆ</p><p>คุ้มครองรถยนต์ของคุณหากชนกับพาหนะอื่นๆ ที่จดทะเบียน ได้แก่ รถยนต์ รถบรรทุก และรถจักรยานยนต์</p><p>การชนโดยไม่มีคู่กรณี</p><p>คุ้มครองรถยนต์ของคุณหากชนกับสิ่งอื่นๆ เช่น ต้นไม้</p><p>บริการช่วยเหลือเหตุฉุกเฉินบนท้องถนน 24 ชั่วโมง</p><p>หากรถยนต์ของคุณเสียหายอย่างหนักจากอุบัติเหตุ และไม่สามารถขับต่อไปได้ บริการช่วยเหลือเหตุฉุกเฉินบนท้องถนน 24 ชั่วโมงจะช่วยลากรถของคุณไปยังอู่ซ่อมรถ</p><p>คุ้มครองเหตุไฟไหม้/รถหาย</p><p>หากรถยนต์ของคุณเสียหายจากเหตุไฟไหม้ หรือรถยนต์ถูกขโมย วางใจได้ว่าอยู่ในความคุ้มครองของประกัน</p><p>ความรับผิดต่อบุคคลภายนอกคุ้มครองความเสียหายต่อทรัพย์สิน</p><p>หากรถยนต์ของคุณเกิดอุบัติเหตุและทำให้ทรัพย์สินของผู้อื่นเสียหาย ประกันก็คุ้มครองเช่นกัน</p><p>คุ้มครองต่อบุคคลภายนอกซึ่งบาดเจ็บหรือเสียชีวิต</p><p>ประกันจะเป็นผู้ช่วยเหลือดูแล หากคุณเกิดอุบัติเหตุรถชนทำให้ผู้อื่นบาดเจ็บหรือเสียชีวิต</p><p>ความคุ้มครองส่วนเสริมประกันอุบัติเหตุส่วนบุคคล</p><p>ครอบคลุมค่ารักษาพยาบาลหากคนขับได้รับบาดเจ็บ หรือ เสียชีวิตจากอุบัติเหตุที่เกิดขึ้น</p><p>ครอบคลุมค่ารักษาพยาบาล</p><p>ครอบคลุมค่ารักษาพยาบาลที่เกิดขึ้นกับคนขับและผู้โดยสารจากอุบัติเหตุที่เกิดขึ้น</p><p>การประกันตัวผู้ขับขี่</p><p>ครอบคลุมค่าใช้จ่ายทางกฎหมายและคดีต่างๆ จากอุบัติเหตุที่เกิดขึ้น</p>', 'on'),
(2, ' ประกันชั้นที่ 2 ', '<p>เป็นการประกันภัยรถยนต์ภาคสมัครใจ เป็นการประกันภัยที่ให้ความคุ้มครองใกล้เคียงกับการประกันภัยรถยนต์ประเภท 1</p><p>แตกต่างกันเพียงไม่มีความคุ้มครองความเสียหายที่เกิดขึ้นกับตัวรถยนต์ โดยมีความคุ้มครองหลัก ประกอบด้วย</p><p>1.หมวดการคุ้มครองความรับผิดต่อบุคคลภายนอก</p><p>- ความเสียหายต่อชีวิต ร่างกาย หรืออนามัย</p><p>- ความเสียหายต่อทรัพย์สิน</p><p>2.หมวดการคุ้มครองรถยนต์สูญหายไฟไหม้</p><p>- กรณีรถยนต์สูญหาย กรณีรถยนต์ไฟไหม้</p>', 'on'),
(3, ' ประกันชั้นที่ 3', '<p>เป็นการประกันภัยรถยนต์ภาคสมัครใจ เป็นการประกันภัยที่ให้ความคุ้มครองน้อยกว่าการประกันภัยรถยนต์ประเภท 1 และประเภท 2</p><p>โดยบริษัทประกันภัยจะชดใช้ค่าสินไหมทดแทนเฉพาะความรับผิดตามกฎหมายต่อบุคคลภายนอก</p><p>ประกอบด้วย</p><p>1.ความเสียหายต่อชีวิต ร่างกาย หรืออนามัย</p><p>2.ความเสียหายต่อทรัพย์สิน</p>', 'on'),
(4, ' ประเภทชั้นที่ 4 ', '<p>ไม่ดูแลอะไรเลย&nbsp;</p>', 'on');

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
  `type` enum('admin','employee','member') CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user`, `pass`, `name`, `email`, `tel`, `type`) VALUES
(1, 'admin', '$2y$10$NhUJwDq.n0G2nuerqbxw..qww0R8Qrtx4HkeWC/oFquQa7UnuWlo.', 'admin', 'admin@gmail.com', '0987654321', 'admin'),
(2, 'user', '$2y$10$NBM8y7xTU5WWaH0g3F0OX.NREKayLlFAlKXzJ3PA5buP44rT7EKDO', 'user', 'user@gmail.com', '0123456789', 'member'),
(9, 'InwZa007', '$2y$10$9HtoNErdK8U32e2yHP0rDeKmha5etlKnH6k.QtN2TGJNaYfE/c3W2', 'InwZa007', 'InwZa007@gmail.com', '0963852741', 'employee');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `page` varchar(200) NOT NULL,
  `role` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `page`, `role`, `link`, `icon`) VALUES
(1, 'Dashborad ', 'admin1,0,employee1,0,member1,0,admin2,0,admin3,0,admin4,0,employee4,0,0,admin5,0,employee5,0,admin9,0,employee9,0,admin10,0,employee10,0', 'page_dashboard.php', 'nav-icon fas fa-chart-line'),
(2, 'ตั้งค่าสิทธิผู้ใช้', 'admin1,0,employee1,0,member1,0,admin2,0,admin3,0,admin4,0,employee4,0,0,admin5,0,employee5,0,admin9,0,employee9,0,admin10,0,employee10,0', 'control.php', 'nav-icon fas fa-cogs'),
(3, 'ผู้ใช้งาน', 'admin1,0,employee1,0,member1,0,admin2,0,admin3,0,admin4,0,employee4,0,0,admin5,0,employee5,0,admin9,0,employee9,0,admin10,0,employee10,0', 'page_user.php', 'nav-icon fas fa-users'),
(4, 'เอกสาร', 'admin1,0,employee1,0,member1,0,admin2,0,admin3,0,admin4,0,employee4,0,member4,admin5,0,employee5,0,admin9,0,employee9,0,admin10,0,employee10,0', 'page_report.php', 'nav-icon fas fa-table'),
(13, 'ค้นหาเอกสาร', 'admin1,0,employee1,0,member1,0,admin2,0,admin3,0,admin4,0,employee4,0,member4,0,admin13,employee13', 'page_report_search.php', 'nav-icon fas fa-search'),
(14, 'บริษัทประกันภัย', 'admin1,0,employee1,0,member1,0,admin2,0,admin3,0,admin4,0,employee4,0,member4,0,admin13,0,employee13,0,admin14,employee14,admin15,employee15', 'page_insurance.php', 'nav-icon fas fa-building'),
(15, 'ยี่ห้อรถยนต์', 'admin1,0,employee1,0,member1,0,admin2,0,admin3,0,admin4,0,employee4,0,member4,0,admin13,0,employee13,0,admin14,employee14,admin15,employee15', 'page_brand.php', 'nav-icon fas fa-copyright'),
(16, 'ประเภทประกัน', 'admin1,0,employee1,0,member1,0,admin2,0,admin3,0,admin4,0,employee4,0,member4,0,admin13,0,employee13,0,admin14,0,employee14,0,admin15,0,employee15,0,admin16,employee16', 'page_type.php', 'nav-icon fas fa-shield-alt');

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
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `Car_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `File_ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `insurance`
--
ALTER TABLE `insurance`
  MODIFY `Corp_ID` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `Report_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `Type_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
