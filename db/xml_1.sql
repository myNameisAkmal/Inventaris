-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 11 Feb 2018 pada 11.23
-- Versi Server: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `xml_1`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` varchar(3) NOT NULL,
  `category_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
('C01', 'Elektronik'),
('C02', 'Makanan'),
('C03', 'Fashion');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurusan`
--

CREATE TABLE IF NOT EXISTS `jurusan` (
  `kd_jurusan` varchar(5) NOT NULL,
  `nm_jurusan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jurusan`
--

INSERT INTO `jurusan` (`kd_jurusan`, `nm_jurusan`) VALUES
('BA', 'Bisnis Administrasi'),
('KA', 'Komputerisasi Akuntansi'),
('MI', 'Manajemen Informatika');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE IF NOT EXISTS `kelas` (
  `kd_kelas` varchar(5) NOT NULL,
  `nm_kelas` varchar(50) NOT NULL,
  `kd_jurusan` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`kd_kelas`, `nm_kelas`, `kd_jurusan`) VALUES
('AB', 'Administrasi Bisnis', 'BA'),
('ABO', 'Administrasi Bisnis Otomotif', 'BA'),
('AP', 'Administrasi Perkantoran', 'BA'),
('IK', 'Informatika Komputer', 'MI'),
('KA', 'Komputerisasi Akuntansi', 'KA'),
('MM', 'Multimedia', 'MI'),
('SK', 'Sekretaris', 'BA'),
('TI', 'Tekhnik Informatika', 'MI');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mahasiswa`
--

CREATE TABLE IF NOT EXISTS `mahasiswa` (
  `nim` varchar(5) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `tempat` varchar(25) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `agama` varchar(20) NOT NULL,
  `jurusan` varchar(5) NOT NULL,
  `kelas` varchar(5) NOT NULL,
  `foto` varchar(255) NOT NULL DEFAULT 'noPict.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nama`, `tempat`, `tgl_lahir`, `agama`, `jurusan`, `kelas`, `foto`) VALUES
('A01', 'Akmal', 'Jakarta', '1998-03-11', 'Islam', 'MI', 'IK', '1440904225301.jpg'),
('A02', 'Alvian', 'Karangayar', '2012-05-21', 'Islam', 'BA', 'AP', 'pian.jpg'),
('A03', 'Hananto Eko', 'Jakarta', '2017-11-22', 'Islam', 'MI', 'IK', 'hans.jpg'),
('A04', 'Hendri Febriansyah', 'Banten', '2017-11-22', 'Islam', 'MI', 'IK', 'hendri.jpg'),
('A05', 'Delia Elvina', 'Jakarta', '2017-11-22', 'Islam', 'MI', 'TI', 'jeje.jpg'),
('A06', 'Faisal Fakhri', 'Bogor', '2017-11-22', 'Islam', 'MI', 'MM', 'faisal.jpg'),
('A07', 'Bejo', 'Kranji', '2017-11-23', 'Budha', 'BA', 'SK', 'noPict.jpg'),
('A08', 'Hero', 'Kayangan', '2017-11-23', 'Islam', 'KA', 'KA', 'logo1.png'),
('A10', 'Genzhie', 'Japan', '2017-11-13', 'Islam', 'BA', 'ABO', 'noPict.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `product_id` varchar(3) NOT NULL,
  `product_name` varchar(25) NOT NULL,
  `category_id` varchar(3) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `category_id`, `price`) VALUES
('P01', 'Televisi', 'C01', 500),
('P02', 'Handphone', 'C01', 600),
('P03', 'Mie Ayam', 'C02', 15000),
('P04', 'Kopi', 'C02', 40000),
('P05', 'Sweater', 'C03', 60000),
('P06', 'Jeans', 'C03', 900000),
('P07', 'Kemeja', 'C03', 100000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_transaction`
--

CREATE TABLE IF NOT EXISTS `product_transaction` (
  `noTrans` varchar(5) NOT NULL,
  `date` datetime NOT NULL,
  `product_id` varchar(3) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `product_transaction`
--

INSERT INTO `product_transaction` (`noTrans`, `date`, `product_id`, `qty`, `total`) VALUES
('TR001', '2018-01-08 03:19:16', 'P01', 1, 500),
('TR002', '2018-01-08 07:32:22', 'P04', 78, 3120000),
('TR003', '2018-02-11 08:26:57', 'P02', 90, 54000);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_mhs`
--
CREATE TABLE IF NOT EXISTS `v_mhs` (
`nim` varchar(5)
,`nama` varchar(25)
,`tempat` varchar(25)
,`tgl_lahir` date
,`agama` varchar(20)
,`jurusan` varchar(50)
,`kelas` varchar(50)
,`foto` varchar(255)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `v_trans`
--
CREATE TABLE IF NOT EXISTS `v_trans` (
`noTrans` varchar(5)
,`date` datetime
,`product_id` varchar(3)
,`qty` int(11)
,`total` int(11)
,`category_id` varchar(3)
,`product_name` varchar(25)
,`price` int(11)
,`category_name` varchar(25)
);
-- --------------------------------------------------------

--
-- Struktur untuk view `v_mhs`
--
DROP TABLE IF EXISTS `v_mhs`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_mhs` AS select `a`.`nim` AS `nim`,`a`.`nama` AS `nama`,`a`.`tempat` AS `tempat`,`a`.`tgl_lahir` AS `tgl_lahir`,`a`.`agama` AS `agama`,`b`.`nm_jurusan` AS `jurusan`,`c`.`nm_kelas` AS `kelas`,`a`.`foto` AS `foto` from ((`mahasiswa` `a` join `jurusan` `b`) join `kelas` `c`) where ((`a`.`jurusan` = `b`.`kd_jurusan`) and (`a`.`kelas` = `c`.`kd_kelas`) and (`b`.`kd_jurusan` = `c`.`kd_jurusan`));

-- --------------------------------------------------------

--
-- Struktur untuk view `v_trans`
--
DROP TABLE IF EXISTS `v_trans`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_trans` AS select `product_transaction`.`noTrans` AS `noTrans`,`product_transaction`.`date` AS `date`,`product_transaction`.`product_id` AS `product_id`,`product_transaction`.`qty` AS `qty`,`product_transaction`.`total` AS `total`,`product`.`category_id` AS `category_id`,`product`.`product_name` AS `product_name`,`product`.`price` AS `price`,`category`.`category_name` AS `category_name` from ((`product` join `product_transaction` on((`product`.`product_id` = `product_transaction`.`product_id`))) join `category` on((`product`.`category_id` = `category`.`category_id`)));

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
 ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
 ADD PRIMARY KEY (`kd_jurusan`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
 ADD PRIMARY KEY (`kd_kelas`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
 ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
 ADD PRIMARY KEY (`product_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
