-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2019 at 07:25 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uzahacom_dopay`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id_account` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `username` varchar(80) NOT NULL,
  `password` varchar(80) NOT NULL,
  `no_rek` varchar(30) NOT NULL,
  `typeBank` varchar(20) NOT NULL,
  `saldo` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id_account`, `id`, `username`, `password`, `no_rek`, `typeBank`, `saldo`) VALUES
(6, 21, 'petrus_mandiri', 'petrus', '1234567890', 'Mandiri', ''),
(7, 21, 'asd', 'asd', '123123123123', 'BCA', ''),
(8, 21, 'petric', 'petric', '213123123132', 'BCA', ''),
(9, 21, 'asddsa', 'asda', '1231231231231', 'Mandiri', '');

-- --------------------------------------------------------

--
-- Table structure for table `akses`
--

CREATE TABLE `akses` (
  `id` int(1) NOT NULL,
  `jenis_akses` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akses`
--

INSERT INTO `akses` (`id`, `jenis_akses`) VALUES
(1, 'Superadmin'),
(2, 'Owner'),
(3, 'Employee');

-- --------------------------------------------------------

--
-- Table structure for table `mutasi`
--

CREATE TABLE `mutasi` (
  `id_mutasi` int(11) NOT NULL,
  `no_rek` varchar(30) NOT NULL,
  `tgl_mutasi` timestamp NULL DEFAULT NULL,
  `keterangan` text NOT NULL,
  `nominal` varchar(15) NOT NULL,
  `tipe_mutasi` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nohp` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `akses` int(1) NOT NULL,
  `fitur` varchar(255) DEFAULT NULL,
  `id_owner` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `nohp`, `password`, `akses`, `fitur`, `id_owner`) VALUES
(21, 'Petrus', 'petrus@gmail.com', '081234567890', 'd4cf33622613ca191a0055807f4ff2f8', 2, 'All', NULL),
(22, 'Alex', 'alex@gmail.com', '081234567899', '534b44a19bf18d20b71ecc4eb77c572f', 2, 'All', NULL),
(25, 'Jojon', 'petrus@gmail.com', '081234567890', 'b012694e87911f33173e85dd1e72a826', 3, 'Debit, Kredit', 21),
(26, 'Petric', 'petrus@gmail.com', '081234567890', 'f88142be3868999471b29a191bc3aec5', 3, 'Dashboard', 21);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id_account`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `no_rek` (`no_rek`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `akses`
--
ALTER TABLE `akses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mutasi`
--
ALTER TABLE `mutasi`
  ADD PRIMARY KEY (`id_mutasi`),
  ADD KEY `no_rek` (`no_rek`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_owner` (`id_owner`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id_account` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `akses`
--
ALTER TABLE `akses`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mutasi`
--
ALTER TABLE `mutasi`
  MODIFY `id_mutasi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mutasi`
--
ALTER TABLE `mutasi`
  ADD CONSTRAINT `mutasi_ibfk_1` FOREIGN KEY (`no_rek`) REFERENCES `accounts` (`no_rek`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
