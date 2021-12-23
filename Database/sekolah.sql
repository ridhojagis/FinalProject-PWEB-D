-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2021 at 02:32 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sekolah`
--

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `guru_id` int(11) NOT NULL,
  `guru_nama` varchar(100) NOT NULL,
  `guru_email` varchar(100) NOT NULL,
  `guru_password` varchar(100) NOT NULL,
  `guru_kontak` varchar(15) NOT NULL,
  `guru_alamat` varchar(100) NOT NULL,
  `guru_tempatlahir` varchar(50) NOT NULL,
  `guru_tanggallahir` date NOT NULL,
  `guru_jkel` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`guru_id`, `guru_nama`, `guru_email`, `guru_password`, `guru_kontak`, `guru_alamat`, `guru_tempatlahir`, `guru_tanggallahir`, `guru_jkel`) VALUES
(1, 'Yanto Suharjo', 'yanto@email.com', 'yanto123', '08123456788', 'jl. Garuda II', 'Surabaya', '1977-01-01', 'L');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `siswa_id` int(11) NOT NULL,
  `siswa_nama` varchar(100) NOT NULL,
  `siswa_email` varchar(100) NOT NULL,
  `siswa_password` varchar(100) NOT NULL,
  `siswa_kontak` varchar(15) NOT NULL,
  `siswa_alamat` varchar(100) NOT NULL,
  `siswa_tempatlahir` varchar(50) NOT NULL,
  `siswa_tanggallahir` date NOT NULL,
  `siswa_jkel` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`siswa_id`, `siswa_nama`, `siswa_email`, `siswa_password`, `siswa_kontak`, `siswa_alamat`, `siswa_tempatlahir`, `siswa_tanggallahir`, `siswa_jkel`) VALUES
(1, 'Adiarja Budiyanto', 'adiarja@email.com', 'adiarja123', '08123456789', 'jl. Garuda', 'surabaya', '2000-01-01', 'L');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`guru_id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`siswa_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `guru_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `siswa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
