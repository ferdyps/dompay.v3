-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2019 at 07:59 AM
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
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `no_rek` varchar(255) NOT NULL,
  `typeBank` varchar(20) NOT NULL,
  `saldo` varchar(15) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id_account`, `id`, `username`, `password`, `no_rek`, `typeBank`, `saldo`, `deskripsi`) VALUES
(7, 69, 'cFcvcUlyQitNNzdYaEdXMW9CaDFZUT09', 'NXNpTjFDY1JCaVhOaGp2dkxxWWdkdz09', 'VXh6TGVwak5ObEptcXpmczlXUUVzQzdCM0ErWnRsUjJ0R1RMRGZJY1ljST0=', 'BNI', 'UDNGTVRBT2J5S3R', 'Akun Dummy BNI..'),
(8, 68, 'V21tZldMSHdNSnVxdWlSaURKNkwrUT09', 'YmZrYnkyTW1VVkhXdThuSGgrZzQvQT09', 'cTRBSDNid09kOGFONDlxdE92dzJUUT09', 'Mandiri', 'bDJTWXZ2QStuaWZ', 'Akun utama'),
(13, 69, 'V21tZldMSHdNSnVxdWlSaURKNkwrUT09', 'YmZrYnkyTW1VVkhXdThuSGgrZzQvQT09', 'eEczZ1JTRXFueG0yajJhTVpvQ1pLZz09', 'Mandiri', 'bDJTWXZ2QStuaWZ', 'Akun Mandiri utama');

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
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `id_owner` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `id_owner`) VALUES
(70, 69);

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
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nohp` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `akses` int(1) NOT NULL,
  `fitur` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `email`, `nohp`, `password`, `akses`, `fitur`) VALUES
(68, 'Zahid Akhyar', 'NXloRzVpMUtGZzdOMXFaL2hIcTMwdz09', 'zahidakhyar@gmail.com', '081250685820', 'VWlLeVRjbHhOZWpGakgzdEEvdFhJUT09', 2, 'All'),
(69, 'Petrus Alex', 'Z1Q4cy9rcFNzVEZMbE9MQUlaOVZFQT09', 'petrus@gmail.com', '081234567890', 'Z1Q4cy9rcFNzVEZMbE9MQUlaOVZFQT09', 2, 'All'),
(70, 'Petrik Ganteng', 'L0hvNm1SSVg4aVlHS3RnUGdDRGlRdz09', 'petrus@gmail.com', '081234567890', 'L0hvNm1SSVg4aVlHS3RnUGdDRGlRdz09', 3, 'Saldo, Debit');

-- --------------------------------------------------------

--
-- Stand-in structure for view `vemployees`
-- (See below for the actual view)
--
CREATE TABLE `vemployees` (
`id` int(11)
,`nama` varchar(100)
,`username` varchar(255)
,`email` varchar(255)
,`nohp` varchar(20)
,`password` varchar(255)
,`akses` int(1)
,`fitur` varchar(255)
,`id_owner` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vowners`
-- (See below for the actual view)
--
CREATE TABLE `vowners` (
`id` int(11)
,`nama` varchar(100)
,`username` varchar(255)
,`email` varchar(255)
,`nohp` varchar(20)
,`password` varchar(255)
,`akses` int(1)
,`fitur` varchar(255)
);

-- --------------------------------------------------------

--
-- Structure for view `vemployees`
--
DROP TABLE IF EXISTS `vemployees`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vemployees`  AS  select `employees`.`id` AS `id`,`users`.`nama` AS `nama`,`users`.`username` AS `username`,`users`.`email` AS `email`,`users`.`nohp` AS `nohp`,`users`.`password` AS `password`,`users`.`akses` AS `akses`,`users`.`fitur` AS `fitur`,`employees`.`id_owner` AS `id_owner` from (`users` join `employees` on((`users`.`id` = `employees`.`id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `vowners`
--
DROP TABLE IF EXISTS `vowners`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vowners`  AS  select `users`.`id` AS `id`,`users`.`nama` AS `nama`,`users`.`username` AS `username`,`users`.`email` AS `email`,`users`.`nohp` AS `nohp`,`users`.`password` AS `password`,`users`.`akses` AS `akses`,`users`.`fitur` AS `fitur` from (`users` left join `employees` on((`users`.`id` = `employees`.`id`))) where isnull(`employees`.`id_owner`) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id_account`),
  ADD UNIQUE KEY `no_rek` (`no_rek`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `akses`
--
ALTER TABLE `akses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD KEY `id` (`id`),
  ADD KEY `id_owner` (`id_owner`);

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
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id_account` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `employee_ibfk_2` FOREIGN KEY (`id_owner`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mutasi`
--
ALTER TABLE `mutasi`
  ADD CONSTRAINT `mutasi_ibfk_1` FOREIGN KEY (`no_rek`) REFERENCES `accounts` (`no_rek`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
