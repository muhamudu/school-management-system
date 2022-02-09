-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2018 at 01:29 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `saint_philip`
--

-- --------------------------------------------------------

--
-- Table structure for table `accountabuluty`
--

CREATE TABLE `accountabuluty` (
  `id` int(11) NOT NULL,
  `std_id` int(11) NOT NULL,
  `class` varchar(500) NOT NULL,
  `content` varchar(500) NOT NULL,
  `year` varchar(200) NOT NULL,
  `uniform` varchar(200) NOT NULL,
  `sweater` varchar(200) NOT NULL,
  `piece_of_paper` varchar(200) NOT NULL,
  `practical` varchar(200) NOT NULL,
  `school_card` varchar(200) NOT NULL,
  `trip` varchar(200) NOT NULL,
  `bed_rent` varchar(500) NOT NULL,
  `cleaning_material` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accountabuluty`
--

INSERT INTO `accountabuluty` (`id`, `std_id`, `class`, `content`, `year`, `uniform`, `sweater`, `piece_of_paper`, `practical`, `school_card`, `trip`, `bed_rent`, `cleaning_material`) VALUES
(11, 1, ' L3CST', 'Daycare', '2018', '17000', '5000', '1', '', '1500', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `firstname` varchar(500) NOT NULL,
  `lastname` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `age` varchar(50) NOT NULL,
  `province` varchar(500) NOT NULL,
  `district` varchar(500) NOT NULL,
  `sector` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `firstname`, `lastname`, `email`, `gender`, `age`, `province`, `district`, `sector`) VALUES
(5, 'Ngendahayo', 'Emmanuel', 'emmangenda8@gmail.com', 'Male', '02/18/1969', 'Kigali City', 'Kicukiro', 'Kigarama');

-- --------------------------------------------------------

--
-- Table structure for table `babyeyi_post`
--

CREATE TABLE `babyeyi_post` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blog_comment`
--

CREATE TABLE `blog_comment` (
  `id` int(11) NOT NULL,
  `blog_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `comment` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blog_post`
--

CREATE TABLE `blog_post` (
  `id` int(11) NOT NULL,
  `blog_img` text NOT NULL,
  `title` varchar(200) NOT NULL,
  `heading` varchar(200) NOT NULL,
  `short_data` text NOT NULL,
  `more_data` text NOT NULL,
  `date/time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blog_views`
--

CREATE TABLE `blog_views` (
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_views`
--

INSERT INTO `blog_views` (`count`) VALUES
(3);

-- --------------------------------------------------------

--
-- Table structure for table `conduct_tb`
--

CREATE TABLE `conduct_tb` (
  `id` int(11) NOT NULL,
  `class` varchar(500) NOT NULL,
  `student_name` int(11) NOT NULL,
  `term` varchar(500) NOT NULL,
  `year` year(4) NOT NULL,
  `max_conduct` int(11) NOT NULL,
  `min_conduct` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `conduct_tb`
--

INSERT INTO `conduct_tb` (`id`, `class`, `student_name`, `term`, `year`, `max_conduct`, `min_conduct`) VALUES
(1, 'L3CST', 6, '2nd term', 2018, 40, 35),
(2, 'L3CST', 1, '3rd term', 2018, 40, 28),
(3, 'L3CST', 5, '2nd term', 2018, 40, 26),
(4, 'L3CST', 1, '2nd term', 2017, 40, 1);

-- --------------------------------------------------------

--
-- Table structure for table `dod`
--

CREATE TABLE `dod` (
  `id` int(11) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `gender` varchar(200) NOT NULL,
  `age` varchar(200) NOT NULL,
  `province` varchar(200) NOT NULL,
  `district` varchar(100) NOT NULL,
  `sector` varchar(200) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `other_phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dod`
--

INSERT INTO `dod` (`id`, `firstname`, `lastname`, `email`, `gender`, `age`, `province`, `district`, `sector`, `phone`, `other_phone`) VALUES
(1, 'TUYISABE', 'Damascene', 'dod@gmail.com', 'Male', '05/31/1989', 'Kigali City', 'Kicukiro', 'Kigarama', '0787064298', '0721458469');

-- --------------------------------------------------------

--
-- Table structure for table `dos_tb`
--

CREATE TABLE `dos_tb` (
  `id` int(11) NOT NULL,
  `firstname` varchar(500) NOT NULL,
  `lastname` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `gender` varchar(500) NOT NULL,
  `age` varchar(50) NOT NULL,
  `province` varchar(500) NOT NULL,
  `district` varchar(500) NOT NULL,
  `sector` varchar(500) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `other_phone` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dos_tb`
--

INSERT INTO `dos_tb` (`id`, `firstname`, `lastname`, `email`, `gender`, `age`, `province`, `district`, `sector`, `phone`, `other_phone`) VALUES
(2, 'Niyonzima', 'Alfred', 'n.alfred@gmail.com', 'Male', '06/16/1987', 'North Province', 'Gasabo', 'Kacyiru', '0787855445', '0727445894');

-- --------------------------------------------------------

--
-- Table structure for table `event_results`
--

CREATE TABLE `event_results` (
  `id` int(11) NOT NULL,
  `result` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `evnts_tb`
--

CREATE TABLE `evnts_tb` (
  `id` int(11) NOT NULL,
  `event_name` varchar(500) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `evnts_tb`
--

INSERT INTO `evnts_tb` (`id`, `event_name`, `date`) VALUES
(13, 'Weekend', '2018-02-13 17:00:00'),
(15, 'Beginning Term I', '2019-10-07 08:00:00'),
(16, 'Parents Meeting', '2018-06-20 08:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(800) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(800) NOT NULL,
  `message` text NOT NULL,
  `province` varchar(50) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gallery_tb`
--

CREATE TABLE `gallery_tb` (
  `id` int(11) NOT NULL,
  `g_img` text NOT NULL,
  `title` varchar(100) NOT NULL,
  `date/time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery_tb`
--

INSERT INTO `gallery_tb` (`id`, `g_img`, `title`, `date/time`) VALUES
(21, 'IMG-20181009-WA0087.jpg', 'Assemble', '2018-10-09 23:07:58'),
(22, 'IMG-20181009-WA0015.jpg', 'hot', '2018-10-09 23:08:09'),
(23, 'IMG-20181009-WA0018.jpg', 'v', '2018-10-09 23:08:24'),
(24, 'IMG-20181009-WA0061.jpg', 'vb', '2018-10-09 23:08:46'),
(25, 'IMG-20181009-WA0107.jpg', 'TOU', '2018-10-09 23:10:48'),
(26, 'IMG-20181009-WA0038.jpg', '', '2018-10-09 23:11:08'),
(27, 'IMG-20181009-WA0048.jpg', '', '2018-10-09 23:11:26'),
(28, 'IMG-20181009-WA0105.jpg', '', '2018-10-09 23:11:52'),
(29, 'IMG-20181009-WA0102.jpg', '', '2018-10-09 23:12:25'),
(30, 'IMG-20181009-WA0010.jpg', '', '2018-10-09 23:13:04'),
(31, 'IMG-20181009-WA0043.jpg', '', '2018-10-09 23:13:42');

-- --------------------------------------------------------

--
-- Table structure for table `module_tb`
--

CREATE TABLE `module_tb` (
  `id` int(11) NOT NULL,
  `teacher_email` varchar(200) NOT NULL,
  `module_code` varchar(200) NOT NULL,
  `competence_title` varchar(200) NOT NULL,
  `credit` varchar(30) NOT NULL,
  `hour` int(11) NOT NULL,
  `level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `module_tb`
--

INSERT INTO `module_tb` (`id`, `teacher_email`, `module_code`, `competence_title`, `credit`, `hour`, `level`) VALUES
(1, 'n.cogore@gmail.com', 'COM302', 'Computer System', '2', 20, 'L3CST'),
(2, 'n.cogore@gmail.com', 'CN302', 'Computer Maintainence', '3', 30, 'L3CST'),
(3, 'n.cogore@gmail.com', 'SD201', 'Software Development', '5', 50, 'L3SFTD'),
(4, 'n.cogore@gmail.com', 'ND180', 'Networking Design', '2', 20, 'L3CST');

-- --------------------------------------------------------

--
-- Table structure for table `nonstaff_payment`
--

CREATE TABLE `nonstaff_payment` (
  `id` int(11) NOT NULL,
  `nonstaff_id` int(11) NOT NULL,
  `salary` int(11) NOT NULL,
  `date_paid` date NOT NULL,
  `paid_salary` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `non_staff`
--

CREATE TABLE `non_staff` (
  `id` int(11) NOT NULL,
  `firstname` varchar(500) NOT NULL,
  `lastname` varchar(500) NOT NULL,
  `duty` varchar(500) NOT NULL,
  `gender` varchar(200) NOT NULL,
  `age` varchar(200) NOT NULL,
  `salary` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `permission_tb`
--

CREATE TABLE `permission_tb` (
  `id` int(11) NOT NULL,
  `std_id` int(11) NOT NULL,
  `class` varchar(50) NOT NULL,
  `date_time_left` datetime NOT NULL,
  `date_time_return` datetime NOT NULL,
  `place` varchar(150) NOT NULL,
  `reason` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permission_tb`
--

INSERT INTO `permission_tb` (`id`, `std_id`, `class`, `date_time_left`, `date_time_return`, `place`, `reason`) VALUES
(1, 6, 'L3CST', '2018-10-10 08:35:00', '2018-10-19 08:35:00', 'Home', 'She is sick');

-- --------------------------------------------------------

--
-- Table structure for table `punishment_tb`
--

CREATE TABLE `punishment_tb` (
  `id` int(11) NOT NULL,
  `std_id` int(11) NOT NULL,
  `class` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `fault` varchar(200) NOT NULL,
  `cutted_marks` int(11) NOT NULL,
  `punishment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `punishment_tb`
--

INSERT INTO `punishment_tb` (`id`, `std_id`, `class`, `date`, `fault`, `cutted_marks`, `punishment`) VALUES
(1, 1, 'L3CST', '2018-10-17', 'dsf', 23, 'Punishment');

-- --------------------------------------------------------

--
-- Table structure for table `reported_modules`
--

CREATE TABLE `reported_modules` (
  `id` int(11) NOT NULL,
  `teacher_email` int(11) NOT NULL,
  `std_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `competence_id` int(11) NOT NULL,
  `credit_hour_id` int(11) NOT NULL,
  `year` year(4) NOT NULL,
  `credit_point` int(11) NOT NULL,
  `max` int(11) NOT NULL,
  `2nd_sitting_piont` varchar(100) NOT NULL,
  `2nd_sitting_result` varchar(100) NOT NULL,
  `mode_comment_observation` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reported_modules`
--

INSERT INTO `reported_modules` (`id`, `teacher_email`, `std_id`, `level_id`, `competence_id`, `credit_hour_id`, `year`, `credit_point`, `max`, `2nd_sitting_piont`, `2nd_sitting_result`, `mode_comment_observation`) VALUES
(1, 2, 1, 1, 1, 2, 2018, 156, 78, '', '', 'Very Good'),
(5, 2, 4, 3, 3, 3, 2018, 237, 79, '', '', ''),
(6, 2, 1, 1, 2, 2, 2018, 96, 48, '50', 'Compitent', 'Good'),
(7, 2, 1, 1, 4, 4, 2018, 200, 50, '', '', ''),
(8, 2, 5, 1, 1, 1, 2018, 80, 80, '', '', ''),
(9, 2, 5, 1, 2, 2, 2018, 116, 58, '', '', ''),
(10, 2, 5, 1, 4, 4, 2018, 300, 75, '', '', ''),
(11, 2, 6, 1, 1, 1, 2018, 90, 90, '', '', ''),
(12, 2, 6, 1, 2, 2, 2018, 160, 80, '', '', ''),
(13, 2, 6, 1, 4, 4, 2018, 272, 68, '', '', ''),
(14, 2, 4, 3, 3, 3, 2018, 240, 80, '', '', ''),
(15, 2, 6, 1, 4, 4, 2018, 200, 50, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `secretary_tb`
--

CREATE TABLE `secretary_tb` (
  `id` int(11) NOT NULL,
  `firstname` varchar(500) NOT NULL,
  `lastname` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `gender` varchar(500) NOT NULL,
  `age` varchar(50) NOT NULL,
  `province` varchar(500) NOT NULL,
  `district` varchar(500) NOT NULL,
  `sector` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `secretary_tb`
--

INSERT INTO `secretary_tb` (`id`, `firstname`, `lastname`, `email`, `gender`, `age`, `province`, `district`, `sector`) VALUES
(1, 'INGABIRE', 'Diane', 'secr@gmail.com', 'Female', '06/18/1998', 'Kigali City', 'Nyarungege', 'Nyakabanda');

-- --------------------------------------------------------

--
-- Table structure for table `student_fees`
--

CREATE TABLE `student_fees` (
  `id` int(11) NOT NULL,
  `std_id` int(11) NOT NULL,
  `class` varchar(80) NOT NULL,
  `status` varchar(50) NOT NULL,
  `term` varchar(20) NOT NULL,
  `year` year(4) NOT NULL,
  `paid_fees` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_fees`
--

INSERT INTO `student_fees` (`id`, `std_id`, `class`, `status`, `term`, `year`, `paid_fees`) VALUES
(1, 1, 'L3CST', 'Daycare', '1st Term', 2018, 60000),
(2, 5, 'L3CST', 'Daycare', '1st Term', 2018, 50000);

-- --------------------------------------------------------

--
-- Table structure for table `student_tb`
--

CREATE TABLE `student_tb` (
  `id` int(11) NOT NULL,
  `profile_picture` varchar(5000) NOT NULL,
  `firstname` varchar(600) NOT NULL,
  `lastname` varchar(600) NOT NULL,
  `student_ID` varchar(16) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `date_of_birth` varchar(500) NOT NULL,
  `student_card_number` varchar(11) NOT NULL,
  `class` varchar(50) NOT NULL,
  `registered_year` int(11) NOT NULL,
  `content` varchar(500) NOT NULL,
  `status` varchar(200) NOT NULL,
  `province` varchar(200) NOT NULL,
  `district` varchar(200) NOT NULL,
  `sector` varchar(200) NOT NULL,
  `father_name` varchar(600) NOT NULL,
  `father_phone` varchar(15) NOT NULL,
  `mother_name` varchar(600) NOT NULL,
  `mother_phone` varchar(15) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_tb`
--

INSERT INTO `student_tb` (`id`, `profile_picture`, `firstname`, `lastname`, `student_ID`, `gender`, `date_of_birth`, `student_card_number`, `class`, `registered_year`, `content`, `status`, `province`, `district`, `sector`, `father_name`, `father_phone`, `mother_name`, `mother_phone`, `date_time`) VALUES
(1, '6.png', 'Mupenzi', 'Samiru', 'L3CST395', 'Male', '06/29/1998', '', 'L3CST', 2018, 'Daycare', 'Active', '', '', '', 'Uwimana Saidi Salim', '0784333001', 'Rukiya', '0788678861', '2018-09-15 14:04:43'),
(4, '7.png', 'Umuhoza', 'Walda', 'L3SFTD721', 'Female', '06/21/2000', '', 'L3SFTD', 2018, 'Boarding', 'Active', '', '', '', 'Harerimana', '0787064279', 'Sofia', '0787064277', '2018-09-16 10:38:57'),
(5, '5.png', 'Ntwari', 'Siradj', 'L3CST3896', 'Male', '06/23/1998', '', 'L3CST', 2018, 'Daycare', 'Active', '', '', '', 'Harerimana', '0787064275', 'Sofia', '0787064275', '2018-09-16 10:54:43'),
(6, '21.png', 'Muhoracyeye', 'Jeanette', 'L3CST3168', 'Female', '06/16/2000', '', 'L3CST', 2018, 'Boarding', 'Active', '', '', '', 'Harerimana', '0787064275', 'Sofia', '0787064275', '2018-09-16 10:56:52');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_payment`
--

CREATE TABLE `teacher_payment` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `salary` int(11) NOT NULL,
  `paid_salary` int(11) NOT NULL,
  `date_paid` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `teacher_tb`
--

CREATE TABLE `teacher_tb` (
  `id` int(11) NOT NULL,
  `firstname` varchar(500) NOT NULL,
  `lastname` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `gender` varchar(200) NOT NULL,
  `age` varchar(200) NOT NULL,
  `qualification` varchar(200) NOT NULL,
  `salary` varchar(220) NOT NULL,
  `province` varchar(500) NOT NULL,
  `district` varchar(500) NOT NULL,
  `sector` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users_tb`
--

CREATE TABLE `users_tb` (
  `id` int(11) NOT NULL,
  `email` varchar(500) NOT NULL,
  `category` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_tb`
--

INSERT INTO `users_tb` (`id`, `email`, `category`, `password`) VALUES
(1, 'emmangenda8@gmail.com', '1', 'c33367701511b4f6020ec61ded352059'),
(2, 'k.odette@gmail.com', '2', '8d788385431273d11e8b43bb78f3aa41'),
(3, 'n.cogore@gmail.com', '2', 'ad7d0e29419cc0843e35c6fe93b14d09'),
(4, 'secr@gmail.com', '3', 'e10adc3949ba59abbe56e057f20f883e'),
(9, 'k.esta@gmail.com', '2', 'e10adc3949ba59abbe56e057f20f883e'),
(22, 'n.alfred@gmail.com', '4', 'e10adc3949ba59abbe56e057f20f883e'),
(23, 'umuhozaraila@gmail.com', '2', 'ce3f7a78318d3671701ba51c4848f5ad'),
(24, 'patience@gmail.com', '2', 'e10adc3949ba59abbe56e057f20f883e'),
(25, 'dod@gmail.com', '5', '4db9d97f363365ac677403747205b7b3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accountabuluty`
--
ALTER TABLE `accountabuluty`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `std_id_2` (`std_id`),
  ADD KEY `std_id` (`std_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `babyeyi_post`
--
ALTER TABLE `babyeyi_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_comment`
--
ALTER TABLE `blog_comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_id` (`blog_id`);

--
-- Indexes for table `blog_post`
--
ALTER TABLE `blog_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conduct_tb`
--
ALTER TABLE `conduct_tb`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_name` (`student_name`);

--
-- Indexes for table `dod`
--
ALTER TABLE `dod`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dos_tb`
--
ALTER TABLE `dos_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_results`
--
ALTER TABLE `event_results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evnts_tb`
--
ALTER TABLE `evnts_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery_tb`
--
ALTER TABLE `gallery_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module_tb`
--
ALTER TABLE `module_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nonstaff_payment`
--
ALTER TABLE `nonstaff_payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nonstaff_id` (`nonstaff_id`);

--
-- Indexes for table `non_staff`
--
ALTER TABLE `non_staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_tb`
--
ALTER TABLE `permission_tb`
  ADD PRIMARY KEY (`id`),
  ADD KEY `std_id` (`std_id`);

--
-- Indexes for table `punishment_tb`
--
ALTER TABLE `punishment_tb`
  ADD PRIMARY KEY (`id`),
  ADD KEY `std_id` (`std_id`);

--
-- Indexes for table `reported_modules`
--
ALTER TABLE `reported_modules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`std_id`),
  ADD KEY `teacher_email` (`teacher_email`),
  ADD KEY `level_id` (`level_id`),
  ADD KEY `competence_id` (`competence_id`),
  ADD KEY `credit_hour_id` (`credit_hour_id`),
  ADD KEY `teacher_email_2` (`teacher_email`);

--
-- Indexes for table `secretary_tb`
--
ALTER TABLE `secretary_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_fees`
--
ALTER TABLE `student_fees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `std_id_2` (`std_id`),
  ADD KEY `std_id` (`std_id`),
  ADD KEY `std_id_3` (`std_id`);

--
-- Indexes for table `student_tb`
--
ALTER TABLE `student_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_payment`
--
ALTER TABLE `teacher_payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tescher_id` (`teacher_id`);

--
-- Indexes for table `teacher_tb`
--
ALTER TABLE `teacher_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_tb`
--
ALTER TABLE `users_tb`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accountabuluty`
--
ALTER TABLE `accountabuluty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `babyeyi_post`
--
ALTER TABLE `babyeyi_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `blog_comment`
--
ALTER TABLE `blog_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `blog_post`
--
ALTER TABLE `blog_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `conduct_tb`
--
ALTER TABLE `conduct_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `dod`
--
ALTER TABLE `dod`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `dos_tb`
--
ALTER TABLE `dos_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `event_results`
--
ALTER TABLE `event_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `evnts_tb`
--
ALTER TABLE `evnts_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `gallery_tb`
--
ALTER TABLE `gallery_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `module_tb`
--
ALTER TABLE `module_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `nonstaff_payment`
--
ALTER TABLE `nonstaff_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `non_staff`
--
ALTER TABLE `non_staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `permission_tb`
--
ALTER TABLE `permission_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `punishment_tb`
--
ALTER TABLE `punishment_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `reported_modules`
--
ALTER TABLE `reported_modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `secretary_tb`
--
ALTER TABLE `secretary_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `student_fees`
--
ALTER TABLE `student_fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `student_tb`
--
ALTER TABLE `student_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `teacher_payment`
--
ALTER TABLE `teacher_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `teacher_tb`
--
ALTER TABLE `teacher_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users_tb`
--
ALTER TABLE `users_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `accountabuluty`
--
ALTER TABLE `accountabuluty`
  ADD CONSTRAINT `accountabuluty_ibfk_1` FOREIGN KEY (`std_id`) REFERENCES `student_tb` (`id`);

--
-- Constraints for table `conduct_tb`
--
ALTER TABLE `conduct_tb`
  ADD CONSTRAINT `conduct_tb_ibfk_1` FOREIGN KEY (`student_name`) REFERENCES `student_tb` (`id`);

--
-- Constraints for table `nonstaff_payment`
--
ALTER TABLE `nonstaff_payment`
  ADD CONSTRAINT `nonstaff_payment_ibfk_1` FOREIGN KEY (`nonstaff_id`) REFERENCES `non_staff` (`id`);

--
-- Constraints for table `permission_tb`
--
ALTER TABLE `permission_tb`
  ADD CONSTRAINT `permission_tb_ibfk_1` FOREIGN KEY (`std_id`) REFERENCES `student_tb` (`id`);

--
-- Constraints for table `punishment_tb`
--
ALTER TABLE `punishment_tb`
  ADD CONSTRAINT `punishment_tb_ibfk_1` FOREIGN KEY (`std_id`) REFERENCES `student_tb` (`id`);

--
-- Constraints for table `reported_modules`
--
ALTER TABLE `reported_modules`
  ADD CONSTRAINT `reported_modules_ibfk_1` FOREIGN KEY (`std_id`) REFERENCES `student_tb` (`id`),
  ADD CONSTRAINT `reported_modules_ibfk_2` FOREIGN KEY (`teacher_email`) REFERENCES `module_tb` (`id`),
  ADD CONSTRAINT `reported_modules_ibfk_3` FOREIGN KEY (`level_id`) REFERENCES `module_tb` (`id`),
  ADD CONSTRAINT `reported_modules_ibfk_4` FOREIGN KEY (`competence_id`) REFERENCES `module_tb` (`id`),
  ADD CONSTRAINT `reported_modules_ibfk_5` FOREIGN KEY (`credit_hour_id`) REFERENCES `module_tb` (`id`);

--
-- Constraints for table `student_fees`
--
ALTER TABLE `student_fees`
  ADD CONSTRAINT `student_fees_ibfk_1` FOREIGN KEY (`std_id`) REFERENCES `student_tb` (`id`);

--
-- Constraints for table `teacher_payment`
--
ALTER TABLE `teacher_payment`
  ADD CONSTRAINT `teacher_payment_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teacher_tb` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
