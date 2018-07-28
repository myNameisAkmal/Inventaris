-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2018 at 04:45 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventaris`
--

-- --------------------------------------------------------

--
-- Table structure for table `inv_barang`
--

CREATE TABLE `inv_barang` (
  `row_id` int(11) NOT NULL,
  `id_barang` varchar(10) NOT NULL,
  `id_kategori` varchar(10) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `satuan_barang` varchar(10) NOT NULL,
  `batas_usia` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `insert_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_lokasi` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inv_barang`
--

INSERT INTO `inv_barang` (`row_id`, `id_barang`, `id_kategori`, `nama_barang`, `satuan_barang`, `batas_usia`, `stock`, `insert_at`, `id_lokasi`) VALUES
(3, 'FTR01', 'KTGR01', 'Lemari', 'unit', 5, 60, '2018-07-09 17:00:00', NULL),
(4, 'FTR02', 'KTGR01', 'Meja', 'unit', 3, 40, '2018-07-09 17:00:00', NULL),
(5, 'FTR03', 'KTGR01', 'Kursi', 'unit', 2, 100, '2018-07-06 17:00:00', NULL),
(6, 'FTR04', 'KTGR01', 'Lukisan', 'unit', 1, 250, '2018-07-12 17:00:00', NULL),
(7, 'FTR05', 'KTGR01', 'Rak Buku', 'unit', 8, 100, '2018-07-03 17:00:00', NULL),
(8, 'ELCT01', 'KTGR03', 'Kipas Angin', 'Unit', 4, 500, '2018-07-23 17:00:00', NULL),
(9, 'ELCT02', 'KTGR03', 'AC', 'unit', 5, 200, '0000-00-00 00:00:00', NULL),
(10, 'ELCT03', 'KTGR03', 'Kulkas', 'unit', 5, 100, '2018-07-24 09:36:00', NULL),
(11, 'ELCT04', 'KTGR03', 'Dispenser', 'unit', 3, 20, '2018-07-28 14:27:26', NULL),
(12, 'ELCT05', 'KTGR03', 'Lampu', 'pcs', 1, 800, '2018-07-28 14:27:26', NULL),
(13, 'KPTR01', 'KTGR02', 'CPU', 'unit', 3, 200, '2018-07-28 14:29:15', NULL),
(14, 'KPTR02', 'KTGR02', 'Monitor', 'pcs', 5, 400, '2018-07-28 14:29:15', NULL),
(15, 'KPTR03', 'KTGR02', 'Keyboard', 'pcs', 5, 500, '2018-07-28 14:30:21', NULL),
(16, 'KPTR04', 'KTGR02', 'Mouse', 'pcs', 3, 500, '2018-07-28 14:30:21', NULL),
(17, 'KPTR05', 'KTGR02', 'Printer', 'unit', 5, 350, '2018-07-28 14:31:02', NULL),
(18, 'DCMT01', 'KTGR04', 'Absensi Mahasiswa', 'doc', 1, 20, '2018-07-28 14:33:28', NULL),
(19, 'DCMT02', 'KTGR04', 'Nilai Mahasiswa', 'doc', 1, 40, '2018-07-28 14:33:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `inv_kategori`
--

CREATE TABLE `inv_kategori` (
  `row_id` int(11) NOT NULL,
  `id_kategori` varchar(10) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inv_kategori`
--

INSERT INTO `inv_kategori` (`row_id`, `id_kategori`, `nama_kategori`) VALUES
(1, 'KTGR01', 'Furniture'),
(2, 'KTGR02', 'Komputer'),
(3, 'KTGR03', 'Elektronik'),
(4, 'KTGR04', 'Document');

-- --------------------------------------------------------

--
-- Table structure for table `inv_lokasi`
--

CREATE TABLE `inv_lokasi` (
  `row_id` int(11) NOT NULL,
  `id_lokasi` varchar(10) NOT NULL,
  `nama_lokasi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inv_lokasi`
--

INSERT INTO `inv_lokasi` (`row_id`, `id_lokasi`, `nama_lokasi`) VALUES
(1, '000', 'Pusat'),
(2, '001', 'Bandung'),
(3, '002', 'Medan'),
(4, '003', 'Padang');

-- --------------------------------------------------------

--
-- Table structure for table `inv_penempatan`
--

CREATE TABLE `inv_penempatan` (
  `row_id` int(11) NOT NULL,
  `id_barang` varchar(10) NOT NULL,
  `id_lokasi` varchar(10) NOT NULL,
  `id_ruang` varchar(10) NOT NULL,
  `qty` varchar(10) NOT NULL,
  `insert_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `expired` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inv_penempatan`
--

INSERT INTO `inv_penempatan` (`row_id`, `id_barang`, `id_lokasi`, `id_ruang`, `qty`, `insert_at`, `expired`) VALUES
(1, 'KPTR01', '000', 'A201', '40', '2018-07-28 14:38:31', '2019-02-01 00:00:00'),
(2, 'ELCT02', '000', 'A201', '20', '2018-07-28 14:38:31', '0000-00-00 00:00:00'),
(3, 'KPTR02', '000', 'A201', '50', '2018-07-28 14:39:29', '0000-00-00 00:00:00'),
(4, 'KPTR03', '000', 'A201', '40', '2018-07-28 14:39:29', '0000-00-00 00:00:00'),
(5, 'KPTR05', '000', 'A201', '20', '2018-07-28 14:40:16', '0000-00-00 00:00:00'),
(6, 'FTR01', '000', 'A201', '50', '2018-07-28 14:40:16', '0000-00-00 00:00:00'),
(7, 'ELCT02', '000', 'A203', '40', '2018-07-28 14:43:09', '0000-00-00 00:00:00'),
(8, 'ELCT02', '000', 'A204', '40', '2018-07-28 14:43:09', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `inv_ruang`
--

CREATE TABLE `inv_ruang` (
  `row_id` int(11) NOT NULL,
  `lantai` int(11) NOT NULL,
  `id_ruang` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inv_ruang`
--

INSERT INTO `inv_ruang` (`row_id`, `lantai`, `id_ruang`) VALUES
(1, 2, 'A201'),
(2, 2, 'A202'),
(3, 2, 'A203'),
(4, 2, 'A204'),
(5, 3, 'A301'),
(6, 3, 'A302');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_listbarang`
-- (See below for the actual view)
--
CREATE TABLE `v_listbarang` (
`row_id` int(11)
,`id_barang` varchar(10)
,`id_kategori` varchar(10)
,`nama_barang` varchar(50)
,`satuan_barang` varchar(10)
,`batas_usia` int(11)
,`stock` int(11)
,`insert_at` timestamp
,`nama_kategori` varchar(50)
);

-- --------------------------------------------------------

--
-- Structure for view `v_listbarang`
--
DROP TABLE IF EXISTS `v_listbarang`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_listbarang`  AS  select `inv_barang`.`row_id` AS `row_id`,`inv_barang`.`id_barang` AS `id_barang`,`inv_barang`.`id_kategori` AS `id_kategori`,`inv_barang`.`nama_barang` AS `nama_barang`,`inv_barang`.`satuan_barang` AS `satuan_barang`,`inv_barang`.`batas_usia` AS `batas_usia`,`inv_barang`.`stock` AS `stock`,`inv_barang`.`insert_at` AS `insert_at`,`inv_kategori`.`nama_kategori` AS `nama_kategori` from (`inv_barang` join `inv_kategori`) where (`inv_barang`.`id_kategori` = `inv_kategori`.`id_kategori`) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inv_barang`
--
ALTER TABLE `inv_barang`
  ADD PRIMARY KEY (`row_id`);

--
-- Indexes for table `inv_kategori`
--
ALTER TABLE `inv_kategori`
  ADD PRIMARY KEY (`row_id`);

--
-- Indexes for table `inv_lokasi`
--
ALTER TABLE `inv_lokasi`
  ADD PRIMARY KEY (`row_id`);

--
-- Indexes for table `inv_penempatan`
--
ALTER TABLE `inv_penempatan`
  ADD PRIMARY KEY (`row_id`);

--
-- Indexes for table `inv_ruang`
--
ALTER TABLE `inv_ruang`
  ADD PRIMARY KEY (`row_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inv_barang`
--
ALTER TABLE `inv_barang`
  MODIFY `row_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `inv_kategori`
--
ALTER TABLE `inv_kategori`
  MODIFY `row_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `inv_lokasi`
--
ALTER TABLE `inv_lokasi`
  MODIFY `row_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `inv_penempatan`
--
ALTER TABLE `inv_penempatan`
  MODIFY `row_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `inv_ruang`
--
ALTER TABLE `inv_ruang`
  MODIFY `row_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
