-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2019 at 06:06 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restoq`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteBarang` (IN `kd` VARCHAR(10))  NO SQL
DELETE FROM barang WHERE kode = kd$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteMeja` (IN `no` VARCHAR(10))  NO SQL
DELETE FROM meja WHERE meja.no = no$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deletePelanggan` (IN `id` INT)  NO SQL
DELETE FROM pelanggan WHERE pelanggan.idpelanggan = id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deletePesanan` (IN `id` INT)  NO SQL
DELETE FROM pesanan WHERE pesanan.id = id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertBarang` (IN `kode` VARCHAR(15), IN `nama` VARCHAR(191), IN `harga` INT)  NO SQL
INSERT INTO barang(kode, nama, harga) VALUES(kode, nama, harga)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertMeja` (IN `no` VARCHAR(191), IN `nama` VARCHAR(191), IN `status` ENUM('0','1'))  NO SQL
INSERT INTO meja(no, nama, status) VALUES (no, nama, status)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertPelanggan` (IN `id` INT, IN `nama` CHAR(50), IN `jk` BOOLEAN, IN `nohp` CHAR(13), IN `alamat` CHAR(95))  NO SQL
INSERT INTO pelanggan (idpelanggan, nama, jeniskelamin,nohp,alamat) VALUES(id, nama, jk, nohp, alamat)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertPesanan` (IN `id_menu` VARCHAR(15), IN `no_meja` VARCHAR(15), IN `jumlah` INT, IN `id_user` VARCHAR(15), IN `id_pel` INT)  NO SQL
INSERT INTO pesanan (id_menu, no_meja,idpelanggan, jumlah, id_user) VALUES(id_menu ,no_meja,id_pel ,jumlah, id_user)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertTransaksi` (IN `id_pesanan` INT, IN `total` INT, IN `bayar` INT, IN `created` DATE)  NO SQL
INSERT INTO transaksi(id_pesanan, total, bayar, createdAt) VALUES(id_pesanan, total, bayar, created)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateBarang` (IN `nama` VARCHAR(191), IN `harga` INT, IN `kd` VARCHAR(10))  NO SQL
UPDATE barang SET barang.nama = nama, barang.harga = harga WHERE barang.kode = kd$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateMeja` (IN `nama` VARCHAR(191), IN `status` VARCHAR(191), IN `no` VARCHAR(15))  NO SQL
UPDATE meja
SET meja.nama = nama, meja.status = status
WHERE meja.no = no$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updatePelanggan` (IN `id` INT, IN `nama` CHAR(50), IN `jk` BOOLEAN, IN `nohp` CHAR(13), IN `alamat` CHAR(95))  NO SQL
UPDATE pelanggan SET pelanggan.nama = nama, pelanggan.jeniskelamin = jk,pelanggan.nohp = nohp, pelanggan.alamat = alamat WHERE pelanggan.idpelanggan = id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updatePesanan` (IN `no_meja` VARCHAR(10), IN `id_menu` VARCHAR(10), IN `jumlah` INT, IN `id_user` INT)  NO SQL
UPDATE pesanan SET pesanan.id_menu = id_menu, pesanan.jumlah = jumlah,pesanan.id_user = id_user WHERE pesanan.no_meja = no_meja$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `kode` varchar(191) NOT NULL,
  `nama` varchar(191) NOT NULL,
  `harga` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kode`, `nama`, `harga`, `status`) VALUES
('0003', 'UU', 123, '0'),
('0004', 'Petai Jawa', 20000, '0');

-- --------------------------------------------------------

--
-- Table structure for table `meja`
--

CREATE TABLE `meja` (
  `no` varchar(191) NOT NULL,
  `nama` varchar(191) NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meja`
--

INSERT INTO `meja` (`no`, `nama`, `status`) VALUES
('MEJA-0002', 's', '0'),
('MEJA-0003', 'warna ijo', '0'),
('MEJA-0004', 'warna merah', '0');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `idpelanggan` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `jeniskelamin` tinyint(1) NOT NULL,
  `nohp` char(13) NOT NULL,
  `alamat` char(95) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`idpelanggan`, `nama`, `jeniskelamin`, `nohp`, `alamat`) VALUES
(1, 'Yusuf', 0, '0812185', 'JL BAKTI II'),
(2, 'Yusuf', 0, '05', 'asd');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL,
  `id_menu` varchar(11) NOT NULL,
  `no_meja` varchar(15) NOT NULL,
  `idpelanggan` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `bayar` int(11) NOT NULL,
  `createdAt` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(191) NOT NULL,
  `username` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `level` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama`, `username`, `password`, `level`) VALUES
(19, 'admin', 'admin', '$2y$10$8CB5pKZRhsC0JmzO6WhiDu4WDwg2/FjnDyk3Z7Ij6Afgo0JHxdjAG', 'admin'),
(20, 'waiter', 'waiter', '$2y$10$QettFNFAYD2DJgOCCREVf.5LM8uoJrM/ScXEckmtuXTX0f84d.BZi', 'waiter'),
(21, 'kasir', 'kasir', '$2y$10$QENj0IC229k4x7b.xm577O/T0ZHUHT98O7xFtDMCpzqcjCvuwXiGC', 'kasir'),
(22, 'owner', 'owner', '$2y$10$uk6Kk5rIqUCpwfAH00PxluRibrBIsaq4pWAmFXqbq61qHIOhg0vc.', 'owner');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `meja`
--
ALTER TABLE `meja`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`idpelanggan`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
