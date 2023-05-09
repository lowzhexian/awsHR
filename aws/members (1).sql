-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2023 at 12:05 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `HRDB`
--

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `staff` (
  `id` int(7) NOT NULL,
  `name` varchar(20) NOT NULL,
  `gender` char(1) NOT NULL,
  `position` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `staff` (`id`, `name`, `gender`, `program`, `email`, `phone`) VALUES
(2201074, 'Yeoh Hu Lun', 'M', 'CS', 'yeahhl-pm22@student.tarc.edu.my', '0131003092'),
(2201103, 'khor ying zhen', 'M', 'MT', 'khoryz-pm22@student.tarc.edu.my', '0154429766'),
(2201288, 'Lim Jun Jie', 'M', 'IT', 'limjj-pm22@student.tarc.edu.my', '0134205311'),
(2204021, 'wong yun zhe', 'M', 'IT', 'wongyz-pm22@student.tarc.edu.my', '0142240966'),
(2204355, 'Lau Zhi Xin', 'F', 'IT', 'lauzx-pm22@student.tarc.edu.my', '0174055972'),
(2204434, 'Chan Mei Mei', 'M', 'IT', 'limjj-pm22@student.tarc.edu.my', '0134205311'),
(2205468, 'Hor Yu Xin', 'F', 'CS', 'horyx-pm22@student.tarc.edu.my', '0187761245'),
(2208850, 'Tan Jing Shen', 'M', 'IT', 'tanjs-pm22@student.tarc.edu.my', '0194304870'),
(2214496, 'Chua Chan Jing', 'F', 'IT', 'chuacj-pm22@student.tarc.edu.my', '0103325411'),
(2216428, 'lim han han', 'M', 'IT', 'limhh-pm22@student.tarc.edu.my', '0183418887'),
(2216607, 'Teoh Jun Kai', 'M', 'MT', 'teohjk-pm22@student.tarc.edu.my', '0106648851'),
(2218204, 'lim han han', 'M', 'IT', 'limhh-pm22@student.tarc.edu.my', '0183418887'),
(2218683, 'Teoh Jun Kai', 'M', 'IS', 'teohjk-pm22@student.tarc.edu.my', '0106648851'),
(2218700, 'Loo Yi Xiang', 'M', 'IT', 'looyx-pm22@student.tarc.edu.my', '0128234420');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `members`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2218701;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
