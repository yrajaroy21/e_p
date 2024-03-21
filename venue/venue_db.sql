-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2023 at 05:21 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `venue_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_events`
--

CREATE TABLE `tbl_events` (
  `id` int(11) NOT NULL,
  `category` int(30) NOT NULL,
  `title` varchar(250) NOT NULL,
  `image` varchar(250) NOT NULL,
  `resource_person_name` varchar(200) NOT NULL,
  `resource_person_des` varchar(200) NOT NULL,
  `resource_person_image` varchar(200) NOT NULL,
  `event_venue` varchar(150) NOT NULL,
  `start_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_date` date NOT NULL,
  `end_time` time NOT NULL,
  `organizes_by` int(11) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Requested',
  `live` varchar(100) NOT NULL DEFAULT 'TBD',
  `created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_events`
--

INSERT INTO `tbl_events` (`id`, `category`, `title`, `image`, `resource_person_name`, `resource_person_des`, `resource_person_image`, `event_venue`, `start_date`, `start_time`, `end_date`, `end_time`, `organizes_by`, `status`, `live`, `created_on`) VALUES
(9, 1, 'SCIPI', 'uploads/20231128070243.jpg', 'seo', 'ceo', 'uploads/20231128070243.jfif', '4', '2023-11-30', '12:00:00', '2023-12-02', '16:00:00', 4, 'Approved', 'Open', '2023-11-28 07:02:43'),
(10, 3, 'OffCon', 'uploads/20231128092234.jpg', 'Heth', 'Ceo', 'uploads/20231128092234.jfif', '5', '2023-12-29', '13:00:00', '2024-01-03', '16:00:00', 4, 'OnHold', 'TBD', '2023-11-28 09:22:34'),
(11, 3, 'OffCon', 'uploads/20231128093726.jpg', 'Heth', 'Ceo', 'uploads/20231128093726.jfif', '8', '2024-01-01', '08:00:00', '2024-01-01', '16:00:00', 4, 'Requested', 'TBD', '2023-11-28 09:37:26'),
(12, 4, 'Test', 'uploads/20231129041650.jpg', 'aUH', 'oFFER', 'uploads/20231129041650.jfif', '5', '2024-01-02', '08:00:00', '2024-01-01', '17:00:00', 4, 'Approved', 'Open', '2023-11-29 04:16:50');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_event_category`
--

CREATE TABLE `tbl_event_category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_event_category`
--

INSERT INTO `tbl_event_category` (`id`, `category_name`) VALUES
(1, 'Symposium'),
(2, 'One Day Seminar'),
(3, 'Hackathon'),
(4, 'One day Workshop'),
(5, 'others');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login`
--

CREATE TABLE `tbl_login` (
  `id` int(11) NOT NULL,
  `bioid` varchar(200) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `image` varchar(500) NOT NULL DEFAULT 'assets/images/img_avatar.png',
  `phone` int(15) NOT NULL,
  `password` varchar(150) NOT NULL,
  `type` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_login`
--

INSERT INTO `tbl_login` (`id`, `bioid`, `username`, `email`, `image`, `phone`, `password`, `type`, `status`) VALUES
(2, '', 'Test', 'test@test.com', 'assets/images/img_avatar.png', 1234567899, '12345', 'Student', 'Active'),
(3, '', 'admin', 'admin@admin.com', 'assets/images/img_avatar.png', 1234512345, 'admin', 'Admin', 'Active'),
(4, '11011', 'Staff1', 'staff@login.com', '', 1234512345, '1234', 'Staff', 'Active'),
(5, '11012', 'Raja', 'raja@gmail.com', '', 0, '', 'Staff', 'Reset'),
(6, '11013', 'Mani', 'mank@gmail.com', '', 0, '', 'Staff', 'Reset');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_organizers`
--

CREATE TABLE `tbl_organizers` (
  `id` int(11) NOT NULL,
  `bioid` varchar(250) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(25) NOT NULL DEFAULT 'Reset'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_organizers`
--

INSERT INTO `tbl_organizers` (`id`, `bioid`, `username`, `email`, `password`, `status`) VALUES
(1, '11011', 'TopStaff', 'ts@login.com', '12345', 'Reset');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_register`
--

CREATE TABLE `tbl_register` (
  `id` int(11) NOT NULL,
  `student` varchar(100) NOT NULL,
  `event` varchar(100) NOT NULL,
  `created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_register`
--

INSERT INTO `tbl_register` (`id`, `student`, `event`, `created_on`) VALUES
(2, '2', '12', '2023-11-30 10:00:05');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_schedule`
--

CREATE TABLE `tbl_schedule` (
  `id` int(11) NOT NULL,
  `event` int(100) NOT NULL,
  `venue` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_date` date NOT NULL,
  `end_time` time NOT NULL,
  `organizer` int(11) NOT NULL,
  `status` int(100) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_schedule`
--

INSERT INTO `tbl_schedule` (`id`, `event`, `venue`, `start_date`, `start_time`, `end_date`, `end_time`, `organizer`, `status`) VALUES
(10, 12, 5, '2024-01-02', '08:00:00', '2024-01-01', '17:00:00', 4, 1),
(11, 9, 4, '2023-11-30', '12:00:00', '2023-12-02', '16:00:00', 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_venue`
--

CREATE TABLE `tbl_venue` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `location` varchar(250) NOT NULL,
  `floor` int(20) NOT NULL,
  `capacity` int(250) NOT NULL,
  `area` varchar(250) NOT NULL,
  `image` varchar(500) NOT NULL,
  `featured` varchar(10) NOT NULL DEFAULT 'NO',
  `status` varchar(100) NOT NULL DEFAULT 'Available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_venue`
--

INSERT INTO `tbl_venue` (`id`, `name`, `location`, `floor`, `capacity`, `area`, `image`, `featured`, `status`) VALUES
(4, 'Lines Hall', 'SSE', 3, 160, '300 m2', 'uploads/book655af0b2c3be6image1.jpg', 'NO', 'Available'),
(5, 'Lattice Hall', 'SSE', 3, 170, '320 m2', 'uploads/book655af5e707253image3.jpg', 'NO', 'Available'),
(6, 'MM Convention Hall', 'Saveetha Dental college, porur', 0, 1200, '1500 m2', 'uploads/book655af6231c9e2image2.jpg', 'NO', 'Available'),
(7, 'Majestorium', 'SSE', 5, 600, '1000', 'uploads/book655c2289da8ceimage4.jpg', 'NO', 'Available'),
(8, 'Nalli Arangam', 'Near saveetha nursing college,Saveetha Nagar', 0, 1000, '800', 'uploads/book655c23c736d1fimage5.jpeg', 'NO', 'Available');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_events`
--
ALTER TABLE `tbl_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_event_category`
--
ALTER TABLE `tbl_event_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_organizers`
--
ALTER TABLE `tbl_organizers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_register`
--
ALTER TABLE `tbl_register`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_schedule`
--
ALTER TABLE `tbl_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_venue`
--
ALTER TABLE `tbl_venue`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_events`
--
ALTER TABLE `tbl_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_event_category`
--
ALTER TABLE `tbl_event_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_login`
--
ALTER TABLE `tbl_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_organizers`
--
ALTER TABLE `tbl_organizers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_register`
--
ALTER TABLE `tbl_register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_schedule`
--
ALTER TABLE `tbl_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_venue`
--
ALTER TABLE `tbl_venue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
