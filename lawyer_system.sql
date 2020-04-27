-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2020 at 06:19 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lawyer_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `defendant`
--

CREATE TABLE `defendant` (
  `defendant_id` int(11) NOT NULL,
  `defendant_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `defendant_no` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `enable` tinyint(1) NOT NULL,
  `race` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `nationality` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `job` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `age` int(3) NOT NULL,
  `current_unit` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `current_bloc` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `current_road` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `current_alley` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `current_zone` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `current_area` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `current_county` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `current_post` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `current_phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `current_number` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `current_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `work_unit` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `work_bloc` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `work_road` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `work_alley` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `work_zone` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `work_area` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `work_county` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `work_post` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `work_phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `work_number` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `work_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `defendant`
--

INSERT INTO `defendant` (`defendant_id`, `defendant_name`, `defendant_no`, `enable`, `race`, `nationality`, `job`, `birthday`, `age`, `current_unit`, `current_bloc`, `current_road`, `current_alley`, `current_zone`, `current_area`, `current_county`, `current_post`, `current_phone`, `current_number`, `current_email`, `work_unit`, `work_bloc`, `work_road`, `work_alley`, `work_zone`, `work_area`, `work_county`, `work_post`, `work_phone`, `work_number`, `work_email`) VALUES
(1, 'test def 1', '1111111111111', 1, '', '', '', '0000-00-00', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(2, 'test def 2', '2222222222222', 1, '', '', '', '0000-00-00', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3, 'test def 3', '3333333333333', 1, '', '', '', '0000-00-00', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `enable` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `department_name`, `enable`) VALUES
(1, 'IT', 1);

-- --------------------------------------------------------

--
-- Table structure for table `document_attc`
--

CREATE TABLE `document_attc` (
  `attc_id` int(11) NOT NULL,
  `doc_id` int(11) NOT NULL,
  `attc_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ชื่อแนบ',
  `attc_file` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'ที่อยู่ไฟล์',
  `attc_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ประเภทแนบ แนบไฟล์/คำพิพาก',
  `attc_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `document_def`
--

CREATE TABLE `document_def` (
  `doc_def_id` int(11) NOT NULL,
  `doc_id` int(11) NOT NULL,
  `defendant_id` int(11) NOT NULL,
  `doc_def_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `doc_def_no` varchar(13) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `document_def`
--

INSERT INTO `document_def` (`doc_def_id`, `doc_id`, `defendant_id`, `doc_def_name`, `doc_def_no`) VALUES
(4, 3, 1, 'aaaaa', '11111'),
(5, 1, 1, 'test def 1', '1111111111111'),
(10, 1, 2, 'test def 2', '2222222222222'),
(11, 20, 1, 'test def 1', '1111111111111');

-- --------------------------------------------------------

--
-- Table structure for table `document_filedoc`
--

CREATE TABLE `document_filedoc` (
  `doc_file_id` int(11) NOT NULL,
  `doc_id` int(11) NOT NULL,
  `doc_file_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `doc_file_text` longtext COLLATE utf8_unicode_ci NOT NULL,
  `doc_file_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `document_filedoc`
--

INSERT INTO `document_filedoc` (`doc_file_id`, `doc_id`, `doc_file_name`, `doc_file_text`, `doc_file_date`) VALUES
(19, 1, 'asdasdasd', '<h4 style=\"text-align:justify;text-justify:inter-cluster\"><div style=\"text-align: right;\"><span lang=\"TH\" style=\"color: inherit; font-size: 16pt; font-family: &quot;Angsana New&quot;, serif;\">วันที่ พฤศจิกายน\nพ.ศ. </span><span style=\"color: inherit; font-size: 16pt; font-family: &quot;Angsana New&quot;, serif;\">2562</span></div><span style=\"font-size: 16pt; font-family: &quot;Angsana New&quot;, serif;\"><div style=\"text-align: right;\"><span style=\"font-size: 16pt; color: inherit;\">เรื่อง&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; บอกกล่าวให้ชำระหนี้และบอกกล่าวบังคับจำนอง</span></div><o:p><div style=\"text-align: right;\"><span style=\"font-size: 16pt; color: inherit;\">เรียน&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;นายธนะรัชต์\nไหมใหม่&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ในฐานะ ผู้กู้</span></div></o:p></span><span lang=\"TH\" style=\"font-size: 16pt; font-family: &quot;Angsana New&quot;, serif;\"><div style=\"text-align: right;\"><span lang=\"TH\" style=\"color: inherit; font-size: 16pt;\">อ้างถึง&nbsp;&nbsp;&nbsp; สัญญากู้เงินและสัญญาจำนอง\nสินเชื่อ</span><span lang=\"TH\" style=\"color: inherit; font-size: 16pt;\">เพื่อธุรกิจ,\nสินเชื่อเบิกเงินเกินบัญชี OD</span></div></span><span lang=\"TH\" style=\"font-size: 16pt; font-family: &quot;Angsana New&quot;, serif;\"><div style=\"text-align: right;\"><span style=\"font-size: 16pt; color: inherit;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; จำนวน 3 ฉบับ</span></div></span><span lang=\"TH\" style=\"font-size: 16pt; font-family: &quot;Angsana New&quot;, serif;\"><div style=\"text-align: right;\"><span style=\"font-size: 16pt; color: inherit;\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ฉบับลงวันที่ 17\nกันยายน 2561</span></div> </span>&nbsp;&nbsp;&nbsp;&nbsp;<span lang=\"TH\" style=\"font-size: 16pt; font-family: &quot;Angsana New&quot;, serif;\">ตามที่ </span><span lang=\"TH\" style=\"font-size: 16pt; font-family: &quot;Angsana New&quot;, serif;\">นายธนะรัชต์ ไหมใหม่ ได้ทำสัญญากู้เงินประเภทสินเชื่อธุรกิจทั่วไป<span style=\"color:red\"> </span>ไปจากธนาคารออมสิน สาขาค่ายธนะรัชต์\nเมื่อวันที่ </span><span style=\"font-size: 16pt; font-family: &quot;Angsana New&quot;, serif;\">17 <span lang=\"TH\">กันยายน </span>2561 <span lang=\"TH\">&nbsp;เป็นจำนวนเงิน 8</span>00,000 <span lang=\"TH\">บาท\n(แปดแสนบาทถ้วน) ผู้กู้ยอมเสียดอกเบี้ยในอัตราดอกเบี้ยร้อยละ MLR</span>+1.00 <span lang=\"TH\">ต่อปี &nbsp;โดยตกลงจะชำระหนี้ต้นเงินและดอกเบี้ย\nเป็นงวดรายเดือน ภายในวันสุดท้ายของทุกเดือน โดยชำระในงวดแรกในเดือนสิงหาคม </span>25<span lang=\"TH\">61 และผู้กู้ตกลงจะชำระหนี้ให้หมดสิ้นภายในวันที่ 31 กรกฎาคม 2568<br> </span><o:p></o:p></span><span lang=\"TH\" style=\"font-size: 16pt; font-family: &quot;Angsana New&quot;, serif;\">ในวันดังกล่าว (<a name=\"_Hlk19090514\">วันที่</a>17 กันยายน 2561) </span><span lang=\"TH\" style=\"font-size: 16pt; font-family: &quot;Angsana New&quot;, serif;\">นายธนะรัชต์\nไหมใหม่ &nbsp;ได้ทำสัญญากู้เงินประเภทสินเชื่อเบิกเงินเกินบัญชี\n</span><span style=\"font-size: 16pt; font-family: &quot;Angsana New&quot;, serif;\">OD<span lang=\"TH\"> ไปจากธนาคารออมสิน สาขาค่ายธนะรัชต์ &nbsp;เป็นจำนวนเงิน 500</span>,<span lang=\"TH\">000 บาท\n(ห้าแสนบาทถ้วน) ผู้กู้ยอมเสียดอกเบี้ยในอัตราดอกเบี้ยร้อยละ </span>M<span lang=\"TH\">O</span>R+<span lang=\"TH\">1.00 ต่อปี&nbsp;\nโดยคำนวณเป็นรายวันของหนี้เบิกเงินเกินบัญญชีที่ค้างชำระและกำหนดส่งดอกเบี้ย\nเป็นงวดรายเดือน ทุกๆเดือน ภายในวันสุดท้ายของทุกเดือน&nbsp; ทั้งนี้ถือว่า1ปี มี 365 วัน<br> </span><o:p></o:p></span><span lang=\"TH\" style=\"font-size: 16pt; font-family: &quot;Angsana New&quot;, serif;\">และในวันเดียวกัน &nbsp;นายธนะรัชต์\nไหมใหม่ &nbsp;ได้ทำสัญญาจำนองและจดทะเบียนจำนอง&nbsp; โดยมอบหลักทรัพย์ ไว้เป็นประกัน ดังนี้<br> </span><span style=\"font-size: 16pt; font-family: &quot;Angsana New&quot;, serif;\">1.<span style=\"font-variant-numeric: normal; font-variant-east-asian: normal; font-stretch: normal; font-size: 7pt; line-height: normal; font-family: &quot;Times New Roman&quot;;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n</span></span><!--[endif]--><span lang=\"TH\" style=\"font-size: 16pt; font-family: &quot;Angsana New&quot;, serif;\">โฉนดที่ดินเลขที่ 35445</span><span lang=\"TH\" style=\"font-size: 16pt; font-family: &quot;Angsana New&quot;, serif; color: red;\"> </span><span lang=\"TH\" style=\"font-size: 16pt; font-family: &quot;Angsana New&quot;, serif;\">&nbsp;เลขที่ดิน 42&nbsp;\nหน้าสำรวจ 6161 &nbsp;&nbsp;ตำบลปรารบุรี &nbsp;<br></span><span lang=\"TH\" style=\"font-size: 16pt; font-family: &quot;Angsana New&quot;, serif;\">อำเภอปราณบุรี &nbsp;จังหวัดประจวบคีรีขันธ์<br>\n</span><span lang=\"TH\" style=\"font-size: 16pt; font-family: &quot;Angsana New&quot;, serif;\">จำนองไว้ประกันการชำระหนี้เงินกู้ดังกล่าวของท่านไว้ให้กับทางธนาคารฯตามสัญญาจำนอง\nฉบับลงวันที่ วันที่ </span><span style=\"font-size: 16pt; font-family: &quot;Angsana New&quot;, serif;\">17 <span lang=\"TH\">กันยายน </span>2561<br><o:p></o:p></span><span lang=\"TH\" style=\"font-size: 16pt; font-family: &quot;Angsana New&quot;, serif;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ขณะนี้ ท่านผู้กู้ได้ผิดนัด\nมิได้ชำระหนี้ให้กับทางธนาคารตามสัญญา และธนาคารไม่ประสงค์จะให้ผู้กู้ยืมเงินจำนวนดังกล่าวอีกต่อไป\n&nbsp;&nbsp;คิดภาระหนี้ที่ท่านค้างชำระเพียงวันที่ลงในหนังสือ</span><span lang=\"TH\" style=\"font-size: 16pt; font-family: &quot;Angsana New&quot;, serif;\">ฉบับนี้\nมียอดหนี้ค้างชำระกับธนาคารเป็นต้นเงินรวมทั้งดอกเบี้ยและดอกเบี้ยพักชำระ รวมเป็นเงินจำนวนทั้งสิ้น <span style=\"color:red\">1,214,956.98 บาท<br><o:p></o:p></span></span><span lang=\"TH\" style=\"font-size: 16pt; font-family: &quot;Angsana New&quot;, serif;\">โดยหนังสือฉบับนี้ ข้าพเจ้าในฐานะทนายความผู้รับมอบอำนาจจากทางธนาคารออมสิน\nขอบอกกล่าวทวงถามและแจ้งการบังคับจำนองมายังท่านให้นำเงินจำนวนดังกล่าวไปชำระหนี้และไถ่ถอนจำนองให้แก่ธนาคารออมสิน\nสาขาค่ายธนะรัชต์ ภายในกำหนด </span><span style=\"font-size: 16pt; font-family: &quot;Angsana New&quot;, serif;\">60<span lang=\"TH\"> วัน นับแต่วันที่ท่านได้รับหนังสือฉบับนี้\nหากท่านมีเหตุขัดข้องประการใดขอให้รีบติดต่อธนาคารออมสิน\nภายในกำหนดระยะเวลาดังกล่าว&nbsp;\nเพราะหากท่านเพิกเฉย ข้าพเจ้ามีความจำเป็นต้องดำเนินคดีกับท่านและผู้จำนองตามกฎหมายต่อไป&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br></span><o:p></o:p></span><span lang=\"TH\" style=\"font-size: 16pt; font-family: &quot;Angsana New&quot;, serif;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ขอแสดงความนับถือ<br></span><span style=\"font-size: 16pt; font-family: &quot;Angsana New&quot;, serif;\"><o:p>&nbsp;<br></o:p></span><span lang=\"TH\" style=\"font-size: 16pt; font-family: &quot;Angsana New&quot;, serif;\">ลงชื่อ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ทนายความผู้รับมอบอำนาจ<br></span><span lang=\"TH\" style=\"font-size: 16pt; font-family: &quot;Angsana New&quot;, serif;\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(นายดรินทร์ ตติยะลาภะ)<br></span><u style=\"\"><span lang=\"TH\" style=\"font-size: 16pt; font-family: &quot;Angsana New&quot;, serif;\">หมายเหตุ\n</span></u><span lang=\"TH\" style=\"font-size: 14pt; font-family: &quot;Angsana New&quot;, serif;\">โปรดติดต่อธนาคารออมสิน (\nศูนย์ควบคุมและบริหารหนี้เขตประจวบคีรีขันธ์ โทรศัพท์ 032-646535ต่อ 4 )</span></h4><p>\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n</p>', '2019-11-20 18:04:38'),
(20, 9, '', '', '2019-11-29 11:17:12'),
(22, 20, '', '', '2019-12-11 16:45:05'),
(23, 1, '', '', '2020-03-07 18:35:17');

-- --------------------------------------------------------

--
-- Table structure for table `document_notis`
--

CREATE TABLE `document_notis` (
  `doc_id` int(11) NOT NULL,
  `doc_no` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `doc_create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `doc_plaintiff_id` int(11) NOT NULL,
  `doc_plaintiff_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `doc_restructuring` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `doc_credit_type` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `doc_county` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `doc_notis_date` date DEFAULT NULL,
  `lawyer_id` int(11) NOT NULL,
  `lawyer_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `doc_status` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `create_by_user` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `document_notis`
--

INSERT INTO `document_notis` (`doc_id`, `doc_no`, `doc_create_date`, `doc_plaintiff_id`, `doc_plaintiff_name`, `doc_restructuring`, `doc_credit_type`, `doc_county`, `doc_notis_date`, `lawyer_id`, `lawyer_name`, `doc_status`, `create_by_user`) VALUES
(1, '123445', '2019-11-19 10:16:28', 2, 'โจท์ที่ 2', 'test1', 'bank33', 'หัวหินนนน', '2019-11-27', 1, '0', 'รอ', ''),
(6, '91629111', '2019-11-19 14:47:36', 1, 'test โจทก์', 'asdsad', 'sdddd', 'sdsdsaa', '0000-00-00', 0, '', 'รอ', 'admin'),
(9, '11112313211', '2019-11-19 14:56:38', 2, 'โจท์ที่ 2', 'dasdasdasd', 'asdasdsa', 'asdasdasd', '1900-11-30', 0, '', 'รอ', 'admin'),
(14, '', '2019-11-19 15:47:46', 0, '', '', '', '', '2019-11-19', 0, '', 'รอ', 'admin'),
(15, '', '2019-11-19 16:14:43', 0, '', '', '', '', NULL, 0, '', 'รอ', 'admin'),
(16, '', '2019-11-19 16:14:50', 0, '', '', '', '', NULL, 0, '', 'รอ', 'admin'),
(17, '', '2019-12-11 16:34:54', 0, '', '', '', '', NULL, 0, '', 'รอ', 'admin'),
(18, 'tttt555', '2019-12-11 16:35:01', 0, '', '', '', '', NULL, 0, '', 'รอ', 'admin'),
(19, '', '2019-12-11 16:35:34', 0, '', '', '', '', NULL, 0, '', 'รอ', 'admin'),
(20, '12s31das', '2019-12-11 16:44:41', 1, 'test โจทก์', '23131', '', 'asd', '2019-12-17', 1, 'test ทนาย', 'รอ', 'admin');

--
-- Triggers `document_notis`
--
DELIMITER $$
CREATE TRIGGER `OnDelete` AFTER DELETE ON `document_notis` FOR EACH ROW BEGIN

DELETE FROM document_def WHERE document_def.doc_id = old.doc_id;

DELETE FROM document_filedoc WHERE document_filedoc.doc_id = old.doc_id;

DELETE FROM document_report WHERE document_report.doc_id = old.doc_id;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `document_report`
--

CREATE TABLE `document_report` (
  `doc_report_id` int(11) NOT NULL,
  `doc_id` int(11) NOT NULL,
  `doc_report_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `doc_report_text` longtext COLLATE utf8_unicode_ci NOT NULL,
  `report_id` int(11) NOT NULL,
  `doc_report_date` datetime NOT NULL DEFAULT current_timestamp(),
  `doc_report_lastedit` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `document_report`
--

INSERT INTO `document_report` (`doc_report_id`, `doc_id`, `doc_report_name`, `doc_report_text`, `report_id`, `doc_report_date`, `doc_report_lastedit`) VALUES
(3, 1, 'test324', '', 2, '2019-12-09 21:53:54', NULL),
(6, 0, '', '', 0, '2019-12-09 22:00:30', NULL),
(7, 0, '', '', 0, '2019-12-09 22:00:32', NULL),
(10, 0, '', '', 0, '2019-12-09 22:11:27', NULL),
(11, 0, '', '', 0, '2019-12-09 22:12:01', NULL),
(13, 0, '', '', 0, '2019-12-09 22:12:34', NULL),
(15, 0, '', '', 0, '2019-12-09 22:21:47', NULL),
(16, 6, 'assdasdsad', '', 1, '2019-12-09 22:21:47', NULL),
(17, 0, '', '', 0, '2019-12-11 09:40:01', NULL),
(21, 0, '', '', 0, '2019-12-11 16:02:49', NULL),
(24, 0, '', '', 0, '2019-12-11 16:45:23', NULL),
(25, 20, 'test', '{\"report\":[{\"text_id\":\"doc_report_id\",\"value\":\"25\"},{\"text_id\":\"text1\",\"value\":\"\"},{\"text_id\":\"text2\",\"value\":\"\"},{\"text_id\":\"text3\",\"value\":\"\"},{\"text_id\":\"text4\",\"value\":\"\"},{\"text_id\":\"text5\",\"value\":\"asd\"},{\"text_id\":\"text6\",\"value\":\"\"},{\"text_id\":\"text8\",\"value\":\"\"},{\"text_id\":\"text9\",\"value\":\"\"},{\"text_id\":\"text10\",\"value\":\"\"},{\"text_id\":\"text13\",\"value\":\"test def 1\"},{\"text_id\":\"text14\",\"value\":\"test ทนาย\"},{\"text_id\":\"text16\",\"value\":\"test ทนาย\"},{\"text_id\":\"text17\",\"value\":\"test ทนาย\"},{\"text_id\":\"text18\",\"value\":\"test ทนาย\"},{\"text_id\":\"text19\",\"value\":\"  1   1  0  0  4   0  0   8  7  9   1  0   4\"},{\"text_id\":\"text20\",\"value\":\"2479/2546\"},{\"text_id\":\"text21\",\"value\":\"ใบอนุญาติ\"},{\"text_id\":\"text22\",\"value\":\"29/66\"},{\"text_id\":\"text23\",\"value\":\"หมู่ 11\"},{\"text_id\":\"text24\",\"value\":\"บางกระดี่\"},{\"text_id\":\"text25\",\"value\":\"35/1\"},{\"text_id\":\"text26\",\"value\":\"แสมดำ\"},{\"text_id\":\"text27\",\"value\":\"บางขุนเทียน\"},{\"text_id\":\"text28\",\"value\":\"กรุงเทพ\"},{\"text_id\":\"text29\",\"value\":\"10150\"},{\"text_id\":\"text30\",\"value\":\"097-1326510\"},{\"text_id\":\"text31\",\"value\":\"012-325456\"},{\"text_id\":\"text32\",\"value\":\"mang9162@gmail.com\"},{\"text_id\":\"text33\",\"value\":\"499\"},{\"text_id\":\"text34\",\"value\":\"12223\"},{\"text_id\":\"text35\",\"value\":\"1\"},{\"text_id\":\"text36\",\"value\":\"231313\"},{\"text_id\":\"text37\",\"value\":\"11311\"},{\"text_id\":\"text38\",\"value\":\"21121\"},{\"text_id\":\"text39\",\"value\":\"2121212\"},{\"text_id\":\"text40\",\"value\":\"21221\"},{\"text_id\":\"text41\",\"value\":\"21212\"},{\"text_id\":\"text42\",\"value\":\"2121\"},{\"text_id\":\"text43\",\"value\":\"mmmm@hotmail.com\"},{\"text_id\":\"text44\",\"value\":\"test def 1\"},{\"text_id\":\"text45\",\"value\":\"test ทนาย\"},{\"text_id\":\"text47\",\"value\":\"\"},{\"text_id\":\"text11\",\"value\":\"test โจทก์\"},{\"text_id\":\"text12\",\"value\":\"test def 1\"},{\"text_id\":\"text15\",\"value\":\"                                                                              asdasdasdasdasd\"},{\"text_id\":\"text46\",\"value\":\"\"}],\"doc_report_id\":25}', 1, '2019-12-11 16:45:23', NULL),
(26, 0, '', '', 0, '2019-12-11 16:46:09', NULL),
(27, 20, 'asdasdasds', '{\"report\":[{\"text_id\":\"doc_report_id\",\"value\":\"27\"},{\"text_id\":\"text1\",\"value\":\"\"},{\"text_id\":\"text2\",\"value\":\"\"},{\"text_id\":\"text3\",\"value\":\"\"},{\"text_id\":\"text4\",\"value\":\"\"},{\"text_id\":\"text5\",\"value\":\"asd\"},{\"text_id\":\"text6\",\"value\":\"\"},{\"text_id\":\"text8\",\"value\":\"\"},{\"text_id\":\"text9\",\"value\":\"\"},{\"text_id\":\"text10\",\"value\":\"\"},{\"text_id\":\"text18\",\"value\":\"test ทนาย\"},{\"text_id\":\"text19\",\"value\":\"  1   1  0  0  4   0  0   8  7  9   1  0   4\"},{\"text_id\":\"text20\",\"value\":\"จีน\"},{\"text_id\":\"text21\",\"value\":\"ไทย\"},{\"text_id\":\"text22\",\"value\":\"ทนายความ\"},{\"text_id\":\"text23\",\"value\":\"10\"},{\"text_id\":\"text24\",\"value\":\"กุมภาพันธ์\"},{\"text_id\":\"text25\",\"value\":\"2540\"},{\"text_id\":\"text26\",\"value\":\"21\"},{\"text_id\":\"text27\",\"value\":\"29/66\"},{\"text_id\":\"text28\",\"value\":\"หมู่ 11\"},{\"text_id\":\"text28_2\",\"value\":\"บางกระดี่\"},{\"text_id\":\"text29\",\"value\":\"35/1\"},{\"text_id\":\"text30\",\"value\":\"แสมดำ\"},{\"text_id\":\"text31\",\"value\":\"บางขุนเทียน\"},{\"text_id\":\"text32\",\"value\":\"กรุงเทพ\"},{\"text_id\":\"text33\",\"value\":\"10150\"},{\"text_id\":\"text34\",\"value\":\"097-1326510\"},{\"text_id\":\"text35\",\"value\":\"012-325456\"},{\"text_id\":\"text36\",\"value\":\"mang9162@gmail.com\"},{\"text_id\":\"text11\",\"value\":\"test โจทก์\"},{\"text_id\":\"text12\",\"value\":\"test def 1\"},{\"text_id\":\"textarea1\",\"value\":\"                       asdasdasdasdsdd55555\"},{\"text_id\":\"textarea2\",\"value\":\"ddd12331\"},{\"text_id\":\"textarea3\",\"value\":\"\"},{\"text_id\":\"textarea4\",\"value\":\"\"},{\"text_id\":\"textarea5\",\"value\":\"\"},{\"text_id\":\"textarea6\",\"value\":\"\"},{\"text_id\":\"textarea7\",\"value\":\"\"},{\"text_id\":\"textarea8\",\"value\":\"\"},{\"text_id\":\"textarea9\",\"value\":\"\"},{\"text_id\":\"textarea10\",\"value\":\"\"},{\"text_id\":\"textarea11\",\"value\":\"\"},{\"text_id\":\"textarea12\",\"value\":\"\"},{\"text_id\":\"textarea13\",\"value\":\"\"},{\"text_id\":\"textarea14\",\"value\":\"\"},{\"text_id\":\"textarea15\",\"value\":\"\"},{\"text_id\":\"textarea16\",\"value\":\"\"},{\"text_id\":\"textarea17\",\"value\":\"\"},{\"text_id\":\"textarea18\",\"value\":\"\"},{\"text_id\":\"textarea19\",\"value\":\"\"},{\"text_id\":\"textarea20\",\"value\":\"\"},{\"text_id\":\"textarea21\",\"value\":\"\"},{\"text_id\":\"textarea22\",\"value\":\"\"},{\"text_id\":\"textarea23\",\"value\":\"\"},{\"text_id\":\"textarea24\",\"value\":\"\"},{\"text_id\":\"textarea25\",\"value\":\"\"},{\"text_id\":\"textarea26\",\"value\":\"\"},{\"text_id\":\"textarea27\",\"value\":\"\"},{\"text_id\":\"textarea28\",\"value\":\"\"},{\"text_id\":\"textarea29\",\"value\":\"\"},{\"text_id\":\"textarea30\",\"value\":\"\"},{\"text_id\":\"textarea31\",\"value\":\"\"}],\"doc_report_id\":27}', 2, '2019-12-11 16:46:09', NULL),
(28, 0, '', '', 0, '2019-12-12 11:36:00', NULL),
(30, 0, '', '', 0, '2019-12-13 15:21:20', NULL),
(31, 1, 'asdsadasdas12311', '{\"report\":[{\"text_id\":\"doc_report_id\",\"value\":\"31\"},{\"text_id\":\"text5\",\"value\":\"\"},{\"text_id\":\"text6\",\"value\":\"\"},{\"text_id\":\"text7\",\"value\":\"test ทนาย\"},{\"text_id\":\"text8\",\"value\":\"\"},{\"text_id\":\"text9\",\"value\":\"\"},{\"text_id\":\"text10\",\"value\":\"test ทนาย\"},{\"text_id\":\"text11\",\"value\":\"2479/2546\"},{\"text_id\":\"text12\",\"value\":\"\"},{\"text_id\":\"text1\",\"value\":\"                                             sadasdasd\"},{\"text_id\":\"text2\",\"value\":\"                                             asd\"},{\"text_id\":\"text3\",\"value\":\"                                                     sadasdasd45354\"},{\"text_id\":\"text4\",\"value\":\"                         45345354354354\"}],\"doc_report_id\":31}', 3, '2019-12-13 15:21:20', NULL),
(32, 0, '', '', 0, '2019-12-13 15:35:48', NULL),
(33, 1, 'tessss', '', 4, '2019-12-13 15:35:48', NULL),
(34, 20, 'test', '', 9, '2020-02-26 21:45:55', NULL),
(35, 0, '', '', 0, '2020-02-26 21:45:55', NULL),
(36, 0, '', '', 0, '2020-02-26 21:46:09', NULL),
(37, 20, 'asdsad', '', 5, '2020-02-26 21:46:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lawyer`
--

CREATE TABLE `lawyer` (
  `lawyer_id` int(11) NOT NULL,
  `lawyer_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `lawyer_tex_no` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `race` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `nationality` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `job` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `age` int(3) NOT NULL,
  `submit_no` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `submit_info` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `current_unit` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `current_bloc` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `current_road` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `current_alley` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `current_zone` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `current_area` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `current_county` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `current_post` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `current_phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `current_number` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `current_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `work_unit` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `work_bloc` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `work_road` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `work_alley` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `work_zone` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `work_area` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `work_county` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `work_post` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `work_phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `work_number` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `work_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `enable` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lawyer`
--

INSERT INTO `lawyer` (`lawyer_id`, `lawyer_name`, `lawyer_tex_no`, `race`, `nationality`, `job`, `birthday`, `age`, `submit_no`, `submit_info`, `current_unit`, `current_bloc`, `current_road`, `current_alley`, `current_zone`, `current_area`, `current_county`, `current_post`, `current_phone`, `current_number`, `current_email`, `work_unit`, `work_bloc`, `work_road`, `work_alley`, `work_zone`, `work_area`, `work_county`, `work_post`, `work_phone`, `work_number`, `work_email`, `enable`) VALUES
(1, 'test ทนาย', '1100400879104', 'จีน', 'ไทย', 'ทนายความ', '1997-02-10', 21, '2479/2546', 'ใบอนุญาติ', '29/66', 'หมู่ 11', 'บางกระดี่', '35/1', 'แสมดำ', 'บางขุนเทียน', 'กรุงเทพ', '10150', '097-1326510', '012-325456', 'mang9162@gmail.com', '499', '12223', '1', '231313', '11311', '21121', '2121212', '21221', '21212', '2121', 'mmmm@hotmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `permission_id` int(11) NOT NULL,
  `permission_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `enable` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`permission_id`, `permission_name`, `enable`) VALUES
(1, 'admin Permission', 1);

-- --------------------------------------------------------

--
-- Table structure for table `plaintiff`
--

CREATE TABLE `plaintiff` (
  `plaintiff_id` int(11) NOT NULL,
  `plaintiff_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `plaintiff_tex_no` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `enable` tinyint(1) NOT NULL,
  `race` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `nationality` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `job` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `age` int(3) NOT NULL,
  `current_unit` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `current_bloc` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `current_road` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `current_alley` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `current_zone` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `current_area` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `current_county` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `current_post` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `current_phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `current_number` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `current_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `work_unit` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `work_bloc` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `work_road` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `work_alley` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `work_zone` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `work_area` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `work_county` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `work_post` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `work_phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `work_number` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `work_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `plaintiff`
--

INSERT INTO `plaintiff` (`plaintiff_id`, `plaintiff_name`, `plaintiff_tex_no`, `enable`, `race`, `nationality`, `job`, `birthday`, `age`, `current_unit`, `current_bloc`, `current_road`, `current_alley`, `current_zone`, `current_area`, `current_county`, `current_post`, `current_phone`, `current_number`, `current_email`, `work_unit`, `work_bloc`, `work_road`, `work_alley`, `work_zone`, `work_area`, `work_county`, `work_post`, `work_phone`, `work_number`, `work_email`) VALUES
(1, 'test โจทก์', '0', 1, '', '', '', '0000-00-00', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(2, 'โจท์ที่ 2', '0', 1, '', '', '', '0000-00-00', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `report_id` int(11) NOT NULL,
  `report_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `report_info` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `report_file` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `permission` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`report_id`, `report_name`, `report_info`, `report_file`, `permission`) VALUES
(1, 'ใบแต่งทนาย', 'ใบแต่งตั้งทนาย', 'lawyer_report.php', NULL),
(2, 'คำแถลงขอส่งหมายและปิดหมาย', 'คำแถลงขอส่งหมายและปิดหมาย', 'statement_request_report.php', NULL),
(3, 'คำขอท้ายฟ้อง', 'คำขอท้ายฟ้อง', 'request_consumer_report.php', NULL),
(4, 'คำฟ้อง', 'คำฟ้อง', 'indictment_report.php', NULL),
(5, 'บัญชีพยาน', 'บัญชีพยาน', 'acc_witness_report.php', NULL),
(7, 'คำแถลงขอส่งสำเนาเอกสาร', 'คำแถลงขอส่งสำเนาเอกสาร', 'request_copy_report.php', NULL),
(8, 'คำร้องกำหนดวันนัดพิจารณาเกินกว่า 30 วัน', 'คำร้องกำหนดวันนัดพิจารณาเกินกว่า 30 วัน', 'request_last30days_repost.php', NULL),
(9, 'หมายเรียกจำเลย', 'หมายเรียกจำเลย', 'call_defendant_report.php', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

CREATE TABLE `user_account` (
  `id` int(11) NOT NULL,
  `code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `image` text COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `phone` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `position` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `department` int(11) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `enable` tinyint(1) NOT NULL,
  `permission` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`id`, `code`, `username`, `password`, `image`, `name`, `phone`, `email`, `position`, `department`, `create_date`, `enable`, `permission`) VALUES
(3, '91629162', 'admin', '827ccb0eea8a706c4c34a16891f84e7b', '', 'Tanakon Admin', 971326510, 'mang_9162@hotmail.com', 'AdminJaa', 1, '2019-11-18 15:49:37', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `defendant`
--
ALTER TABLE `defendant`
  ADD PRIMARY KEY (`defendant_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `document_attc`
--
ALTER TABLE `document_attc`
  ADD PRIMARY KEY (`attc_id`);

--
-- Indexes for table `document_def`
--
ALTER TABLE `document_def`
  ADD PRIMARY KEY (`doc_def_id`);

--
-- Indexes for table `document_filedoc`
--
ALTER TABLE `document_filedoc`
  ADD PRIMARY KEY (`doc_file_id`);

--
-- Indexes for table `document_notis`
--
ALTER TABLE `document_notis`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `document_report`
--
ALTER TABLE `document_report`
  ADD PRIMARY KEY (`doc_report_id`);

--
-- Indexes for table `lawyer`
--
ALTER TABLE `lawyer`
  ADD PRIMARY KEY (`lawyer_id`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`permission_id`);

--
-- Indexes for table `plaintiff`
--
ALTER TABLE `plaintiff`
  ADD PRIMARY KEY (`plaintiff_id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `defendant`
--
ALTER TABLE `defendant`
  MODIFY `defendant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `document_attc`
--
ALTER TABLE `document_attc`
  MODIFY `attc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `document_def`
--
ALTER TABLE `document_def`
  MODIFY `doc_def_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `document_filedoc`
--
ALTER TABLE `document_filedoc`
  MODIFY `doc_file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `document_notis`
--
ALTER TABLE `document_notis`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `document_report`
--
ALTER TABLE `document_report`
  MODIFY `doc_report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `lawyer`
--
ALTER TABLE `lawyer`
  MODIFY `lawyer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `permission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `plaintiff`
--
ALTER TABLE `plaintiff`
  MODIFY `plaintiff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_account`
--
ALTER TABLE `user_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
