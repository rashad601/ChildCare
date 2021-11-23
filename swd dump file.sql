-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2021 at 02:54 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `id` int(16) NOT NULL,
  `title` varchar(255) NOT NULL,
  `activity_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`id`, `title`, `activity_date`, `start_time`, `end_time`, `description`, `image`) VALUES
(5, 'Puzzle Solving', '2021-05-09', '11:13:00', '11:50:00', 'Our Program prioritizes quality time. Highly experienced teachers dedicate their time to guaranteeing your child&rsquo;s safety, security, and happiness', 'activity-1.jpg'),
(6, 'Make Robot', '2021-05-10', '11:14:00', '11:50:00', 'Our Program prioritizes quality time. Highly experienced teachers dedicate their time to guaranteeing your child&rsquo;s safety, security, and happiness', 'activity-2.jpg'),
(7, 'Science And  Arts', '2021-05-14', '11:14:00', '11:59:00', 'Our Program prioritizes quality time. Highly experienced teachers dedicate their time to guaranteeing your child&rsquo;s safety, security, and happiness', 'classes-1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(16) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`, `email`) VALUES
(4, 'Abdullah', 'c93ccd78b2076528346216b3b2f701e6', 'usamaabdul7@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `child`
--

CREATE TABLE `child` (
  `child_id` int(16) NOT NULL,
  `child_first_name` varchar(255) NOT NULL,
  `child_last_name` varchar(255) NOT NULL,
  `child_father_name` varchar(255) NOT NULL,
  `child_age` int(4) NOT NULL,
  `child_dob` date NOT NULL,
  `child_gender` varchar(255) NOT NULL,
  `child_room` varchar(255) NOT NULL,
  `child_program` varchar(255) NOT NULL,
  `parent_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `child`
--

INSERT INTO `child` (`child_id`, `child_first_name`, `child_last_name`, `child_father_name`, `child_age`, `child_dob`, `child_gender`, `child_room`, `child_program`, `parent_email`) VALUES
(46, 'Hena', 'Stark', 'Stark', 5, '2016-01-12', 'Female', 'Pre-School', '3 Day', 'stark@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `child_event`
--

CREATE TABLE `child_event` (
  `id` int(16) NOT NULL,
  `title` varchar(255) NOT NULL,
  `event_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `child_event`
--

INSERT INTO `child_event` (`id`, `title`, `event_date`, `start_time`, `end_time`, `description`, `image`) VALUES
(5, 'English Day on Carfree day', '2021-05-08', '11:08:00', '11:40:00', 'Our Program prioritizes quality time. Highly experienced teachers dedicate their time to guaranteeing your child&rsquo;s safety, security, and happiness', 'event-1.jpg'),
(6, 'Play And Study with Mrs Smith', '2021-05-03', '11:09:00', '11:50:00', 'Our Program prioritizes quality time. Highly experienced teachers dedicate their time to guaranteeing your child&rsquo;s safety, security, and happiness', 'event-2.jpg'),
(7, 'Drawing at City Park', '2021-05-10', '11:10:00', '11:50:00', 'Our Program prioritizes quality time. Highly experienced teachers dedicate their time to guaranteeing your child&rsquo;s safety, security, and happiness', 'event-3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `daily_activity`
--

CREATE TABLE `daily_activity` (
  `id` int(16) NOT NULL,
  `name` varchar(255) NOT NULL,
  `temperature` int(4) NOT NULL,
  `breakfast` varchar(255) NOT NULL,
  `lunch` varchar(255) NOT NULL,
  `activity` varchar(255) NOT NULL,
  `activity_date` date NOT NULL,
  `child_id` int(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `daily_activity`
--

INSERT INTO `daily_activity` (`id`, `name`, `temperature`, `breakfast`, `lunch`, `activity`, `activity_date`, `child_id`) VALUES
(7, 'Hena Stark', 100, 'Bread', 'Biscuits', 'Math', '2021-05-12', 46);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(16) NOT NULL,
  `name` varchar(255) NOT NULL,
  `service` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `feedback` varchar(255) NOT NULL,
  `verified` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `service`, `date`, `feedback`, `verified`) VALUES
(14, 'Stark', 'Anything', '2021-05-12', 'Dolor sit amet, dolor gravida, placerat liberolorem ipsum dolor consectetur adipiscing elit, sed do eiusmod.', 1),
(15, 'James', 'Something', '2021-05-11', 'Dolor sit amet, dolor gravida, placerat liberolorem ipsum dolor consectetur adipiscing elit, sed do eiusmod.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(16) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `name`, `email`, `subject`, `phone`, `message`) VALUES
(19, 'Stark', 'stark@gmail.com', 'Something', '8118556069', 'Hi, How are you?');

-- --------------------------------------------------------

--
-- Table structure for table `offer`
--

CREATE TABLE `offer` (
  `id` int(16) NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offer`
--

INSERT INTO `offer` (`id`, `title`, `price`, `description`, `image`) VALUES
(8, 'Drawing Class', 20, 'Dolor sit amet, dolor gravida, placerat liberolorem ipsum dolor consectetur adipiscing elit, sed do eiusmod.', 'classes-1.jpg'),
(9, 'Gaming Class', 20, 'Dolor sit amet, dolor gravida, placerat liberolorem ipsum dolor consectetur adipiscing elit, sed do eiusmod.', 'classes-3.jpg'),
(10, 'Learning Class', 20, 'Dolor sit amet, dolor gravida, placerat liberolorem ipsum dolor consectetur adipiscing elit, sed do eiusmod.', 'classes-2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `parent`
--

CREATE TABLE `parent` (
  `parent_id` int(16) NOT NULL,
  `parent_first_name` varchar(255) NOT NULL,
  `parent_last_name` varchar(255) NOT NULL,
  `parent_email` varchar(255) NOT NULL,
  `parent_phone_num` varchar(255) NOT NULL,
  `parent_pswd` varchar(255) NOT NULL,
  `child_id` int(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parent`
--

INSERT INTO `parent` (`parent_id`, `parent_first_name`, `parent_last_name`, `parent_email`, `parent_phone_num`, `parent_pswd`, `child_id`) VALUES
(13, 'Stark', 'James', 'stark@gmail.com', '8558116069', '8cd31a8bdccc976e252136f695060dda', 46);

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `id` int(16) NOT NULL,
  `title` varchar(255) NOT NULL,
  `about` varchar(255) NOT NULL,
  `class_size` int(16) NOT NULL,
  `child_age` varchar(255) NOT NULL,
  `program` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`id`, `title`, `about`, `class_size`, `child_age`, `program`, `image`) VALUES
(12, 'Art', 'Dolor sit amet, dolor gravida, placerat liberolorem ipsum dolor consectetur adipiscing elit, sed do eiusmod.', 9, '1-2', 'Half', 'classes-1.jpg'),
(13, 'Music', 'Dolor sit amet, dolor gravida, placerat liberolorem ipsum dolor consectetur adipiscing elit, sed do eiusmod.', 14, '2-4', 'Full', 'classes-2.jpg'),
(14, 'Math', 'Dolor sit amet, dolor gravida, placerat liberolorem ipsum dolor consectetur adipiscing elit, sed do eiusmod.', 16, '4-6', '3', 'classes-3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `job` varchar(255) NOT NULL,
  `about` varchar(255) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `fname`, `lname`, `job`, `about`, `image`) VALUES
(14, 'Broklyn ', 'Doel', 'Art ', 'Dolor sit amet, dolor gravida, placerat liberolorem ipsum dolor consectetur adipiscing elit, sed do eiusmod.', 'teacher_05.png'),
(15, 'Anna', 'Doel', 'Math', 'Dolor sit amet, dolor gravida, placerat liberolorem ipsum dolor consectetur adipiscing elit, sed do eiusmod.\r\n\r\n', 'teacher_06.png'),
(16, 'Tonny', 'Stark', 'Computer', 'Dolor sit amet, dolor gravida, placerat liberolorem ipsum dolor consectetur adipiscing elit, sed do eiusmod.', 'team-img1.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `child`
--
ALTER TABLE `child`
  ADD PRIMARY KEY (`child_id`);

--
-- Indexes for table `child_event`
--
ALTER TABLE `child_event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daily_activity`
--
ALTER TABLE `daily_activity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `child_id` (`child_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offer`
--
ALTER TABLE `offer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parent`
--
ALTER TABLE `parent`
  ADD PRIMARY KEY (`parent_id`),
  ADD KEY `child_id` (`child_id`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `child`
--
ALTER TABLE `child`
  MODIFY `child_id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `child_event`
--
ALTER TABLE `child_event`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `daily_activity`
--
ALTER TABLE `daily_activity`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `offer`
--
ALTER TABLE `offer`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `parent`
--
ALTER TABLE `parent`
  MODIFY `parent_id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `daily_activity`
--
ALTER TABLE `daily_activity`
  ADD CONSTRAINT `daily_activity_ibfk_1` FOREIGN KEY (`child_id`) REFERENCES `child` (`child_id`) ON DELETE CASCADE;

--
-- Constraints for table `parent`
--
ALTER TABLE `parent`
  ADD CONSTRAINT `parent_ibfk_1` FOREIGN KEY (`child_id`) REFERENCES `child` (`child_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
