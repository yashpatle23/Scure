-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2023 at 06:55 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scure`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `name` varchar(255) DEFAULT NULL,
  `number` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`name`, `number`, `email`, `reason`, `date`, `time`) VALUES
('Sahil Mohurale', '8830568867', 'sahilmohurale03@gmail.com', 'fracture', '2023-04-01', '10:00-11:00'),
('Priya Kriplani', '9356567276', 'priyakriplani950@gmail.com', 'Skin pimples', '2023-04-02', '13:00-14:00'),
('Priya Kriplani', '9356567276', 'priyakriplani950@gmail.com', 'Skin pimples', '2023-04-02', '13:00-14:00'),
('Priya Sharma', '999999', 'abc@gmail.com', 'hhh', '2023-03-29', '13:00-14:00'),
('Radhika', '99999999999', 'bhoyar@gmail.com', 'skin disease', '2023-04-05', '19:00-20:00');

-- --------------------------------------------------------

--
-- Table structure for table `patient_data`
--

CREATE TABLE `patient_data` (
  `name` varchar(255) DEFAULT NULL,
  `age` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `oxygen` varchar(255) DEFAULT NULL,
  `bp` varchar(255) DEFAULT NULL,
  `temperature` varchar(255) DEFAULT NULL,
  `other_info` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient_data`
--

INSERT INTO `patient_data` (`name`, `age`, `gender`, `oxygen`, `bp`, `temperature`, `other_info`) VALUES
('Sahil Mohurale', '19', 'male', '99', '99', '99', 'hello'),
('Sahil Mohurale', '19', 'male', '99', '99', '99', 'hello'),
('Sahil Mohurale', '19', 'male', '99', '99', '99', 'hello'),
('spandan', '19', 'male', '98', '80', '86', ''),
('Priya Kriplani', '18', 'female', '98', '90', '90', ''),
('Radhika', '19', 'female', '99', '85', '98', 'xyz');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
