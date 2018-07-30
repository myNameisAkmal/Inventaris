-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2018 at 03:50 PM
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
(3, 'KPTR01', 'KTGR02', 'CPU', 'unit', 5, 10, '2018-07-30 12:27:50', '000'),
(4, 'KPTR02', 'KTGR02', 'Monitor', 'unit', 4, 10, '2018-07-30 12:27:50', '000'),
(5, 'KPTR03', 'KTGR02', 'Keyboard', 'unit', 3, 5, '2018-07-30 12:27:50', '000'),
(6, 'KPTR04', 'KTGR02', 'Mouse', 'unit', 5, 15, '2018-07-30 12:27:50', '000');

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
(4, 'KTGR04', 'Document'),
(5, 'KTGR05', 'Accessories');

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
-- Table structure for table `inv_merk`
--

CREATE TABLE `inv_merk` (
  `row_id` int(11) NOT NULL,
  `id_barang` varchar(10) NOT NULL,
  `id_dtl` varchar(20) NOT NULL,
  `merk` varchar(50) NOT NULL,
  `tipe` varchar(50) NOT NULL,
  `stock_dtl` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inv_merk`
--

INSERT INTO `inv_merk` (`row_id`, `id_barang`, `id_dtl`, `merk`, `tipe`, `stock_dtl`) VALUES
(1, 'KPTR01', 'KPTR01CPUHP1', 'HP', 'HP 3330', 5),
(2, 'KPTR01', 'KPTR01CPUHP2', 'HP', 'HP 490', 15),
(3, 'KPTR02', 'KPTR02MONHP1', 'HP', 'HP Lx90', 5),
(4, 'KPTR02', 'KPTR02MONDEL1', 'DELL', 'DELL 2xbq', 5),
(5, 'KPTR03', 'KPTR03KEYLOG1', 'Logitech', 'Logitech K120', 2),
(6, 'KPTR03', 'KPTR03KEYLEN1', 'LENOVO', 'G40', 3),
(7, 'KPTR04', 'KPTR04MOULOG1', 'Logitech', 'M325', 10),
(8, 'KTPR04', 'KPTR04MOULOG2', 'Logitech', 'M125', 5);

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
(8, 'ELCT02', '000', 'A204', '40', '2018-07-28 14:43:09', '0000-00-00 00:00:00'),
(9, 'KPTR01', '000', 'B201', '4', '2018-07-28 14:55:17', '0000-00-00 00:00:00'),
(10, 'KPTR03', '000', 'B202', '4', '2018-07-28 14:55:17', '0000-00-00 00:00:00'),
(11, 'ELCT03', '000', 'A201', '5', '2018-07-29 03:30:19', '0000-00-00 00:00:00'),
(12, 'ELCT04', '000', 'A201', '20', '2018-07-29 03:30:19', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `inv_ruang`
--

CREATE TABLE `inv_ruang` (
  `row_id` int(11) NOT NULL,
  `lantai` int(11) NOT NULL,
  `id_ruang` varchar(10) NOT NULL,
  `id_lokasi` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inv_ruang`
--

INSERT INTO `inv_ruang` (`row_id`, `lantai`, `id_ruang`, `id_lokasi`) VALUES
(1, 2, 'A201', '000'),
(2, 2, 'A202', '000'),
(3, 2, 'A203', '000'),
(4, 2, 'A204', '000'),
(5, 3, 'A301', '000'),
(6, 3, 'A302', '000'),
(7, 3, 'A303', '000'),
(8, 4, 'B401', '000'),
(9, 2, 'B201', '000'),
(10, 2, 'B202', '000'),
(11, 3, 'B203', '000'),
(12, 3, 'B303', '000');

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
-- Stand-in structure for view `v_penempatan`
-- (See below for the actual view)
--
CREATE TABLE `v_penempatan` (
`row_id` int(11)
,`id_barang` varchar(10)
,`id_lokasi` varchar(10)
,`id_ruang` varchar(10)
,`qty` varchar(10)
,`insert_at` timestamp
,`expired` datetime
,`nama_barang` varchar(50)
,`satuan_barang` varchar(10)
,`batas_usia` int(11)
,`id_kategori` varchar(10)
,`nama_kategori` varchar(50)
,`nama_lokasi` varchar(50)
,`lantai` int(11)
);

-- --------------------------------------------------------

--
-- Structure for view `v_listbarang`
--
DROP TABLE IF EXISTS `v_listbarang`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_listbarang`  AS  select `inv_barang`.`row_id` AS `row_id`,`inv_barang`.`id_barang` AS `id_barang`,`inv_barang`.`id_kategori` AS `id_kategori`,`inv_barang`.`nama_barang` AS `nama_barang`,`inv_barang`.`satuan_barang` AS `satuan_barang`,`inv_barang`.`batas_usia` AS `batas_usia`,`inv_barang`.`stock` AS `stock`,`inv_barang`.`insert_at` AS `insert_at`,`inv_kategori`.`nama_kategori` AS `nama_kategori` from (`inv_barang` join `inv_kategori`) where (`inv_barang`.`id_kategori` = `inv_kategori`.`id_kategori`) ;

-- --------------------------------------------------------

--
-- Structure for view `v_penempatan`
--
DROP TABLE IF EXISTS `v_penempatan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_penempatan`  AS  select `inv_penempatan`.`row_id` AS `row_id`,`inv_penempatan`.`id_barang` AS `id_barang`,`inv_penempatan`.`id_lokasi` AS `id_lokasi`,`inv_penempatan`.`id_ruang` AS `id_ruang`,`inv_penempatan`.`qty` AS `qty`,`inv_penempatan`.`insert_at` AS `insert_at`,`inv_penempatan`.`expired` AS `expired`,`v_listbarang`.`nama_barang` AS `nama_barang`,`v_listbarang`.`satuan_barang` AS `satuan_barang`,`v_listbarang`.`batas_usia` AS `batas_usia`,`v_listbarang`.`id_kategori` AS `id_kategori`,`v_listbarang`.`nama_kategori` AS `nama_kategori`,`inv_lokasi`.`nama_lokasi` AS `nama_lokasi`,`inv_ruang`.`lantai` AS `lantai` from (((`inv_penempatan` join `v_listbarang`) join `inv_lokasi`) join `inv_ruang`) where ((`inv_penempatan`.`id_barang` = `v_listbarang`.`id_barang`) and (`inv_penempatan`.`id_lokasi` = `inv_lokasi`.`id_lokasi`) and (`inv_penempatan`.`id_ruang` = `inv_ruang`.`id_ruang`)) ;

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
-- Indexes for table `inv_merk`
--
ALTER TABLE `inv_merk`
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
  MODIFY `row_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `inv_kategori`
--
ALTER TABLE `inv_kategori`
  MODIFY `row_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `inv_lokasi`
--
ALTER TABLE `inv_lokasi`
  MODIFY `row_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `inv_merk`
--
ALTER TABLE `inv_merk`
  MODIFY `row_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `inv_penempatan`
--
ALTER TABLE `inv_penempatan`
  MODIFY `row_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `inv_ruang`
--
ALTER TABLE `inv_ruang`
  MODIFY `row_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
