-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2023 at 01:46 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_cctrepository`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_adminuser`
--

CREATE TABLE `tb_adminuser` (
  `admin_id` int(111) NOT NULL,
  `admin_lastname` varchar(255) NOT NULL,
  `admin_firstname` varchar(255) NOT NULL,
  `admin_middlename` varchar(255) NOT NULL,
  `admin_gender` varchar(255) NOT NULL,
  `admin_birthday` date NOT NULL,
  `admin_address` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_username` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_token` varchar(255) NOT NULL,
  `admin_status` varchar(255) NOT NULL DEFAULT 'Active',
  `admin_picture` blob NOT NULL,
  `admin_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `admin_deac_timestamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `admin_reac_timestamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_adminuser`
--

INSERT INTO `tb_adminuser` (`admin_id`, `admin_lastname`, `admin_firstname`, `admin_middlename`, `admin_gender`, `admin_birthday`, `admin_address`, `admin_email`, `admin_username`, `admin_password`, `admin_token`, `admin_status`, `admin_picture`, `admin_timestamp`, `admin_deac_timestamp`, `admin_reac_timestamp`) VALUES
(1, 'Tuballa', 'Juztine', 'Hamasa', 'Male', '2000-04-09', 'Dasmarinas, Cavite', 'juztinetuballa@gmail.com', 'juztine', '$2y$10$tGv0kuol6pOZV0tSth0qNeX9MH5QPqs0FAhIxrox2oX2bKjACnB0e', 'e5c87a3cb9160d334cd06e6d27f85fe8', 'Active', 0x61646d696e2d6a757a74696e652e706e67, '2023-07-14 12:31:05', '2023-07-14 12:30:31', '2023-07-14 12:31:05'),
(2, 'Nuestro', 'Monica', 'Hernandez', 'Female', '2001-01-01', 'Mendez, Cavite', 'monicanuestro@gmail.com', 'monica', '$2y$10$OaZO8dM.7sty0dNF/OVuge.GIOdpgLvJ0341JkcH8pjYRnRq9SE6q', '', 'Active', 0x61646d696e2d6d6f6e6963612e706e67, '2023-04-29 13:41:07', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'Casanova', 'Robert', 'Santiago', 'Others', '1958-08-25', 'Tagaytay, Cavite', 'robertcasanova@gmail.com', 'robert', '$2y$10$Gs8FOfc32i91yF69rnXMv.yZFl79R8M18t48Ke0o5.KQov62a5/uO', '', 'Active', 0x48756d616e2d6d696e2e706e67, '2023-05-06 21:01:35', '2023-05-06 21:01:00', '2023-05-06 21:01:35');

-- --------------------------------------------------------

--
-- Table structure for table `tb_depthead`
--

CREATE TABLE `tb_depthead` (
  `dhead_id` int(111) NOT NULL,
  `dhead_dept` varchar(255) NOT NULL,
  `dhead_lname` varchar(255) NOT NULL,
  `dhead_fname` varchar(255) NOT NULL,
  `dhead_mname` varchar(255) NOT NULL,
  `dhead_uname` varchar(255) NOT NULL,
  `dhead_pword` varchar(255) NOT NULL,
  `dhead_status` varchar(255) NOT NULL DEFAULT 'Active',
  `dhead_picture` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_depthead`
--

INSERT INTO `tb_depthead` (`dhead_id`, `dhead_dept`, `dhead_lname`, `dhead_fname`, `dhead_mname`, `dhead_uname`, `dhead_pword`, `dhead_status`, `dhead_picture`) VALUES
(1, 'School of Computer Studies', 'Dimaranan', 'Gerome', 'Tanyag', 'gerome', '$2y$10$NgTlJfjTyCJAdLsL8UahJ.ichCJGh/qT.k/uMA8XwhsePvk0Vh8jq', 'Active', 0x6765726f6d652d64696d6172616e616e2e706e67),
(2, 'School of Education', 'Atienza', 'Kim', 'Alejandro', 'kim', '$2y$10$2UjRCp4WN90f6ZqAm3hDce6DITbjb/4ymB7lkFcAaHbECvRNEDahO', 'Active', 0x6b696d2d617469656e7a612e6a7067),
(3, 'School of Business Management', 'Gaza', 'Christian ', 'Soriano', 'xian', '$2y$10$0V0HR/vvP2xEIyQXMBloB..dSyxF1n1Rqs15YBHevZQK//cP7Hrb6', 'Active', 0x7869616e2d67617a612e6a7067),
(4, 'School of Hospitality and Tourism Management', 'Al-Alawi', 'Mariam ', 'Marbella', 'ivana', '$2y$10$LO4KxlDnBkglDSGljgN7Du3TS0j4OGyn/UbUJLaomlaSOu72a7SpC', 'Active', 0x6976616e612d616c6177692e6a7067);

-- --------------------------------------------------------

--
-- Table structure for table `tb_frequest`
--

CREATE TABLE `tb_frequest` (
  `req_id` int(11) NOT NULL,
  `req_studdepartment` varchar(255) NOT NULL,
  `req_studnum` varchar(255) NOT NULL,
  `req_studlname` varchar(255) NOT NULL,
  `req_studfname` varchar(255) NOT NULL,
  `req_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `req_fuptitle` varchar(255) NOT NULL,
  `req_fupdepartment` varchar(255) NOT NULL,
  `req_fupauthors` varchar(255) NOT NULL,
  `req_fupdate` varchar(255) NOT NULL,
  `req_fupabstract` text NOT NULL,
  `req_fupstatus` varchar(255) DEFAULT 'Pending',
  `req_fupdheadarchive` varchar(255) NOT NULL DEFAULT 'Unarchived',
  `req_fuparchive` varchar(255) NOT NULL DEFAULT 'Unarchived'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_frequest`
--

INSERT INTO `tb_frequest` (`req_id`, `req_studdepartment`, `req_studnum`, `req_studlname`, `req_studfname`, `req_date`, `req_fuptitle`, `req_fupdepartment`, `req_fupauthors`, `req_fupdate`, `req_fupabstract`, `req_fupstatus`, `req_fupdheadarchive`, `req_fuparchive`) VALUES
(1, 'School of Computer Studies', '1801052', 'Sy', 'Henry', '2023-03-13 18:05:25', 'Cybersecurity Risk Assessment and Management Tool for Small and Medium-sized Businesses', 'School of Computer Studies', ' Elon Musk, Bill Gates', '2023-02-01', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.', 'Approved', 'Unarchived', 'Unarchived'),
(3, 'School of Business Management', '1801053', 'Ayala', 'Augusto', '2023-03-14 10:46:26', 'Cybersecurity Risk Assessment and Management Tool for Small and Medium-sized Businesses', 'School of Computer Studies', ' Elon Musk, Bill Gates', '2023-02-01', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore... See more', 'Denied', 'Unarchived', 'Unarchived'),
(5, 'School of Education', '1801054', 'Miranda', 'Chito', '2023-03-26 08:05:59', 'Cybersecurity Risk Assessment and Management Tool for Small and Medium-sized Businesses', 'School of Computer Studies', ' Elon Musk, Bill Gates', '2023-02-01', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore... See more', 'Approved', 'Unarchived', 'Unarchived'),
(6, 'School of Computer Studies', '1801052', 'Sy', 'Henry', '2023-03-27 09:03:12', 'A Study Of The Factors Affecting Consumer Buying Behavior In The Luxury Goods Industry', 'School of Business Management', ' Mohammad Bin Salman Al Saud', '2023-03-07', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, q... See more', 'Approved', 'Unarchived', 'Unarchived'),
(7, 'School of Computer Studies', '1801052', 'Sy', 'Henry', '2023-03-27 09:03:20', 'Lorem 1', 'School of Computer Studies', ' Lorem 1', '2023-03-17', 'wfsd... See more', 'Pending', 'Unarchived', 'Unarchived'),
(8, 'School of Computer Studies', '1801052', 'Sy', 'Henry', '2023-03-27 09:10:22', 'The Effects of Leadership Style on Employee Productivity and Organizational Performance', 'School of Business Management', ' Yao Ming, Xi Jinping', '2023-04-03', 'Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eu... See more', 'Pending', 'Unarchived', 'Unarchived'),
(9, 'School of Business Management', '1801053', 'Ayala', 'Augusto', '2023-04-24 08:07:44', 'Diversity and Inclusion in the Workplace Best Practices and Challenges', 'School of Hospitality and Tourism Management', ' Andrea Torres, Mike Santos, John Doe', '2023-04-25', 'This study explores best practices and challenges related to diversity and inclusion in the workplace. Through a literature review and analysis of case studies, the study examines strategies that organizations can employ to foster a more diverse and inclusive workplace, such as creating a culture of respect, implementing inclusive policies, and providing diversity training. The study also identifies challenges organizations face, such as unconscious bias and resistance to change, and suggests ways to overcome these obstacles. The findings of this study have important implications for organizations seeking to promote diversity and inclusion in their workplaces, highlighting the importance of implementing effective strategies to improve organizational culture and performance.', 'Approved', 'Unarchived', 'Unarchived'),
(10, 'School of Business Management', '2023586', 'Smith', 'Nicky', '2023-04-25 17:56:53', 'Astra', 'School of Computer Studies', ' Astra Group', '2023-04-24', 'Astra is a theme made for the Elementor! Rather than duplicating the functionality Elementor already offers, Astra is developed lightweight, bloat-fre... See more', 'Approved', 'Archived', 'Unarchived'),
(11, 'School of Business Management', '1801053', 'Ayala', 'Augusto', '2023-05-06 20:35:46', 'Cybersecurity Risk Assessment and Management Tool for Small and Medium-sized Businesses', 'School of Computer Studies', ' Elon Musk, Bill Gates', '2023-03-14 18:46:26', '', 'Pending', 'Unarchived', 'Unarchived');

-- --------------------------------------------------------

--
-- Table structure for table `tb_fsemester`
--

CREATE TABLE `tb_fsemester` (
  `sem_id` int(11) NOT NULL,
  `sem_department` varchar(255) NOT NULL,
  `sem_name` varchar(255) NOT NULL,
  `sem_start` year(4) NOT NULL,
  `sem_end` year(4) NOT NULL,
  `sem_priority_id` varchar(255) NOT NULL,
  `sem_status` varchar(255) NOT NULL DEFAULT 'Created',
  `sem_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_fuploads`
--

CREATE TABLE `tb_fuploads` (
  `fup_id` int(111) NOT NULL,
  `fup_department` varchar(255) NOT NULL,
  `fup_title` varchar(255) NOT NULL,
  `fup_author` varchar(255) NOT NULL,
  `fup_status` varchar(255) NOT NULL DEFAULT 'Posted',
  `fup_saveitem` varchar(255) NOT NULL DEFAULT 'Unsave',
  `fup_abstract` text NOT NULL,
  `fup_document` longblob NOT NULL,
  `fup_date` date NOT NULL,
  `priority_id` varchar(255) NOT NULL,
  `sem_priority_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_librarian`
--

CREATE TABLE `tb_librarian` (
  `librarian_id` int(11) NOT NULL,
  `librarian_lname` varchar(255) NOT NULL,
  `librarian_fname` varchar(255) NOT NULL,
  `librarian_mname` varchar(255) NOT NULL,
  `librarian_uname` varchar(255) NOT NULL,
  `librarian_pword` varchar(255) NOT NULL,
  `librarian_status` varchar(255) NOT NULL DEFAULT 'Active',
  `librarian_picture` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_librarian`
--

INSERT INTO `tb_librarian` (`librarian_id`, `librarian_lname`, `librarian_fname`, `librarian_mname`, `librarian_uname`, `librarian_pword`, `librarian_status`, `librarian_picture`) VALUES
(1, 'Jung', ' Sung', 'Ha', 'sungha', '$2y$10$JfLcqbMd7I1z6jnDIg.zluc2Y7Gj63opkU9pw7I.YgnccnhNkyrDS', 'Active', 0x73756e6768612d6a756e672d6d696e2e6a7067),
(2, 'Escobar', ' Pablo', 'Gaviria', 'pablo', '$2y$10$R2HF8C2oMlOpQGU0j.STFebcJTbpEwJpLn.6xX4CA236u5BIXlW2C', 'Active', 0x7061626c6f2d6573636f6261722e706e67),
(3, 'Clara', ' Maria', 'Isabel', 'maria', '$2y$10$uRBWDs1w8K9Kss/XGxVUvuLhkexi9K8F25OAIhW.SbbmVnF/QKyES', 'Active', 0x79736162656c2d6f72746567612e6a7067);

-- --------------------------------------------------------

--
-- Table structure for table `tb_researchhead`
--

CREATE TABLE `tb_researchhead` (
  `reshead_id` int(111) NOT NULL,
  `reshead_lname` varchar(255) NOT NULL,
  `reshead_fname` varchar(255) NOT NULL,
  `reshead_mname` varchar(255) NOT NULL,
  `reshead_uname` varchar(255) NOT NULL,
  `reshead_pword` varchar(255) NOT NULL,
  `reshead_status` varchar(255) NOT NULL DEFAULT 'Active',
  `reshead_picture` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_researchhead`
--

INSERT INTO `tb_researchhead` (`reshead_id`, `reshead_lname`, `reshead_fname`, `reshead_mname`, `reshead_uname`, `reshead_pword`, `reshead_status`, `reshead_picture`) VALUES
(1, 'Lavigne', ' Avril', 'Ramona', 'avril', '$2y$10$Erw9gsEHj5g9TBdCgFfpzOg7VAPeO3L.EaZ9x5kF4aaSSQ/aPMmQq', 'Active', 0x617672696c2d6c617669676e652d6d696e2e6a7067),
(2, 'Williams', ' Hayley', 'Nichole', 'hayley', '$2y$10$IfJ0A/9k2SjhG9D3VdZlseOr03.LbK3JFukbbhMWru8yLY9eoT8ny', 'Active', 0x6861796c65792d77696c6c69616d732d6d696e2e6a7067);

-- --------------------------------------------------------

--
-- Table structure for table `tb_student`
--

CREATE TABLE `tb_student` (
  `stud_id` int(111) NOT NULL,
  `stud_department` varchar(255) NOT NULL,
  `stud_lname` varchar(255) NOT NULL,
  `stud_fname` varchar(255) NOT NULL,
  `stud_mname` varchar(255) NOT NULL,
  `stud_num` varchar(255) NOT NULL,
  `stud_bdate` date NOT NULL,
  `stud_pword` varchar(255) NOT NULL,
  `stud_picture` blob NOT NULL,
  `stud_status` varchar(255) NOT NULL DEFAULT 'Approved'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_student`
--

INSERT INTO `tb_student` (`stud_id`, `stud_department`, `stud_lname`, `stud_fname`, `stud_mname`, `stud_num`, `stud_bdate`, `stud_pword`, `stud_picture`, `stud_status`) VALUES
(1, 'School of Hospitality and Tourism Management', 'De Mol', 'Jessie ', 'Almacen', '1980177', '2001-04-12', '$2y$10$Dvw5jMjpfJTcvvPLxUQSQ.6qEZMowD46B/mvR71.Qwz8NYOVYct0e', 0x6a65737369652d64652d6d6f6c2d6d696e2e6a7067, 'Approved'),
(2, 'School of Computer Studies', 'Sy', 'Henry', 'Tan', '1801052', '1924-12-05', '$2y$10$he5h0TUrELusPTt88JJJ..NbVic5UuFDXybr5ZhhPereAvbEG4xiW', 0x68656e72792d73792d6d696e2e6a7067, 'Approved'),
(3, 'School of Business Management', 'Ayala', 'Augusto', 'Zobel', '1801053', '1959-03-07', '$2y$10$O7vTAkYPmfPCqfuULksWA.1eDi0BiTe5g.JtBA5HcPKDDqLYfgv6O', 0x6a61696d652d6179616c612d6d696e2e6a7067, 'Approved'),
(4, 'School of Education', 'Miranda', 'Chito', 'Fernandez', '1801054', '1976-02-07', '$2y$10$jMCJQ3yjqlAklAeWzRt9CeTgVB2eYiNi4YeoDBG.Yq4cI5UMtVCfi', 0x636869746f2d6d6972616e64612d6d696e2e6a7067, 'Approved'),
(5, 'School of Business Management', 'Smith', 'Nicky', 'Jones', '2023586', '2002-02-15', '$2y$10$Ett/4H20wX37OjfTWc1gUukHFbt1uFCHByZ.t2R3pqgyMeP0lZFH6', 0x4e69636b7920536d6974682e706e67, 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `tb_validatestudent`
--

CREATE TABLE `tb_validatestudent` (
  `valstud_id` int(11) NOT NULL,
  `valstud_num` varchar(255) DEFAULT NULL,
  `valstud_lname` varchar(255) NOT NULL,
  `valstud_fname` varchar(255) NOT NULL,
  `valstud_mname` varchar(255) NOT NULL,
  `valstud_gender` varchar(255) NOT NULL,
  `valstud_civilstatus` varchar(255) NOT NULL,
  `valstud_birthdate` date NOT NULL,
  `valstud_citizenship` varchar(255) NOT NULL,
  `valstud_status` varchar(255) NOT NULL DEFAULT 'Added'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_validatestudent`
--

INSERT INTO `tb_validatestudent` (`valstud_id`, `valstud_num`, `valstud_lname`, `valstud_fname`, `valstud_mname`, `valstud_gender`, `valstud_civilstatus`, `valstud_birthdate`, `valstud_citizenship`, `valstud_status`) VALUES
(1, '2023987', 'Tuballa', 'Jerielle', 'Hamasa', 'Female', 'Single', '2013-09-19', 'Filipino', 'Added'),
(2, '2022876', 'Duterte', 'Rodrigo', 'Roa', 'Male', 'Married', '1945-04-28', 'Filipino', 'Added'),
(3, '2022877', 'Toledo', 'Mark', 'Blue', 'Male', 'Single', '1990-04-01', 'Filipino', 'Added'),
(4, '2022878', 'Pelayo', 'Sherwin', 'Green', 'Male', 'Married', '1983-02-03', 'Filipino', 'Added'),
(5, '2022879', 'Faeldon', 'James', 'Orange', 'Male', 'Married', '1989-07-12', 'Filipino', 'Added'),
(6, '2022880', 'Sudaria', 'Celman', 'Pink', 'Male', 'Single', '2000-05-03', 'Filipino', 'Added'),
(7, '2022881', 'Ako', 'Pogi', 'Tunay', 'Male', 'Single', '2001-08-01', 'Filipino', 'Added'),
(8, '1801052', 'Sy', 'Henry', 'Tan', 'Male', 'Married', '1924-12-05', 'Filipino', 'Added'),
(9, '1801053', 'Ayala', 'Augusto', 'Zobel', 'Male', 'Married', '1959-03-07', 'Filipino', 'Added'),
(10, '1801054', 'Miranda', 'Chito', 'Fernandez', 'Male', 'Married', '1976-02-07', 'Filipino', 'Added'),
(11, '1801055', 'Contreras', 'Ferdinand Jay ', 'Magtoto ', 'Male', 'Married', '1983-02-02', 'Filipino', 'Added'),
(12, '1801056', 'Buendia', 'Ely ', 'Basino', 'Male', 'Married', '1970-11-02', 'Filipino', 'Added'),
(13, '1980177', 'De Mol', 'Jessie', 'Almacen', 'Female', 'Single', '2001-04-12', 'Filipino', 'Added'),
(14, '2023111', 'De Juan', 'Erika', 'Hernandez', 'Female', 'Single', '2008-05-23', 'Filipino', 'Added'),
(15, '2023112', 'Vida', 'Babylynn', 'Aaa', 'Male', 'Married', '2001-12-25', 'Filipino', 'Added'),
(16, '2023113', 'Dandoy', 'Kyle', 'Bbb', 'Male', 'Single', '2001-01-01', 'Filipino', 'Added'),
(17, '2023114', 'Ronquillo', 'Amor', 'Ccc', 'Male', 'Married', '2001-02-02', 'Filipino', 'Added'),
(18, '2023115', 'Viscaya', 'Mary', 'Ambat', 'Female', 'Married', '2001-03-03', 'Filipino', 'Added'),
(19, '2023586', 'Smith', 'Nicky', 'Jones', 'Female', 'Single', '2002-02-15', 'Filipino', 'Added');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_adminuser`
--
ALTER TABLE `tb_adminuser`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tb_depthead`
--
ALTER TABLE `tb_depthead`
  ADD PRIMARY KEY (`dhead_id`);

--
-- Indexes for table `tb_frequest`
--
ALTER TABLE `tb_frequest`
  ADD PRIMARY KEY (`req_id`);

--
-- Indexes for table `tb_fsemester`
--
ALTER TABLE `tb_fsemester`
  ADD PRIMARY KEY (`sem_id`);

--
-- Indexes for table `tb_fuploads`
--
ALTER TABLE `tb_fuploads`
  ADD PRIMARY KEY (`fup_id`);

--
-- Indexes for table `tb_librarian`
--
ALTER TABLE `tb_librarian`
  ADD PRIMARY KEY (`librarian_id`);

--
-- Indexes for table `tb_researchhead`
--
ALTER TABLE `tb_researchhead`
  ADD PRIMARY KEY (`reshead_id`);

--
-- Indexes for table `tb_student`
--
ALTER TABLE `tb_student`
  ADD PRIMARY KEY (`stud_id`);

--
-- Indexes for table `tb_validatestudent`
--
ALTER TABLE `tb_validatestudent`
  ADD PRIMARY KEY (`valstud_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_adminuser`
--
ALTER TABLE `tb_adminuser`
  MODIFY `admin_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_depthead`
--
ALTER TABLE `tb_depthead`
  MODIFY `dhead_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_frequest`
--
ALTER TABLE `tb_frequest`
  MODIFY `req_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_fsemester`
--
ALTER TABLE `tb_fsemester`
  MODIFY `sem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_fuploads`
--
ALTER TABLE `tb_fuploads`
  MODIFY `fup_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tb_librarian`
--
ALTER TABLE `tb_librarian`
  MODIFY `librarian_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_researchhead`
--
ALTER TABLE `tb_researchhead`
  MODIFY `reshead_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_student`
--
ALTER TABLE `tb_student`
  MODIFY `stud_id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_validatestudent`
--
ALTER TABLE `tb_validatestudent`
  MODIFY `valstud_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
