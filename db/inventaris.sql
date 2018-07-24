-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 22 Jul 2018 pada 15.50
-- Versi server: 10.1.34-MariaDB
-- Versi PHP: 7.2.7

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
-- Struktur dari tabel `inv_barang`
--

CREATE TABLE `inv_barang` (
  `row_id` int(11) NOT NULL,
  `id_barang` varchar(10) NOT NULL,
  `id_kategori` varchar(10) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `satuan_barang` varchar(10) NOT NULL,
  `batas_usia` int(11) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `inv_kategori`
--

CREATE TABLE `inv_kategori` (
  `row_id` int(11) NOT NULL,
  `id_kategori` varchar(10) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `inv_kategori`
--

INSERT INTO `inv_kategori` (`row_id`, `id_kategori`, `nama_kategori`) VALUES
(1, 'KTGR01', 'Furniture'),
(2, 'KTGR02', 'Elektronik');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_listbarang`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_listbarang` (
`row_id` int(11)
,`id_barang` varchar(10)
,`id_kategori` varchar(10)
,`nama_barang` varchar(50)
,`satuan_barang` varchar(10)
,`batas_usia` int(11)
,`stock` int(11)
,`nama_kategori` varchar(50)
);

-- --------------------------------------------------------

--
-- Struktur untuk view `v_listbarang`
--
DROP TABLE IF EXISTS `v_listbarang`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_listbarang`  AS  select `inv_barang`.`row_id` AS `row_id`,`inv_barang`.`id_barang` AS `id_barang`,`inv_barang`.`id_kategori` AS `id_kategori`,`inv_barang`.`nama_barang` AS `nama_barang`,`inv_barang`.`satuan_barang` AS `satuan_barang`,`inv_barang`.`batas_usia` AS `batas_usia`,`inv_barang`.`stock` AS `stock`,`inv_kategori`.`nama_kategori` AS `nama_kategori` from (`inv_barang` join `inv_kategori`) where (`inv_barang`.`id_kategori` = `inv_kategori`.`id_kategori`) ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `inv_barang`
--
ALTER TABLE `inv_barang`
  ADD PRIMARY KEY (`row_id`);

--
-- Indeks untuk tabel `inv_kategori`
--
ALTER TABLE `inv_kategori`
  ADD PRIMARY KEY (`row_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `inv_barang`
--
ALTER TABLE `inv_barang`
  MODIFY `row_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `inv_kategori`
--
ALTER TABLE `inv_kategori`
  MODIFY `row_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
