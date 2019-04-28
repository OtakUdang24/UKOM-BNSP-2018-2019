-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2019 at 11:10 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restourant`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteBarang` (IN `nama` VARCHAR(50))  NO SQL
DELETE FROM menu WHERE menu.nama = nama$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteMeja` (IN `no` INT)  NO SQL
DELETE FROM meja WHERE meja.no = no$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deletePelanggan` (IN `idp` INT)  NO SQL
DELETE FROM pelanggan WHERE pelanggan.id = idp$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deletePesanan` (IN `idpes` INT)  NO SQL
DELETE FROM pesanan WHERE pesanan.id = idpes$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertBarang` (IN `nama` VARCHAR(50), IN `harga` INT)  NO SQL
INSERT INTO menu(nama, harga) VALUES(nama, harga)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertMeja` (IN `no` INT)  NO SQL
INSERT INTO meja(no) VALUES(no)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertPelanggan` (IN `nama` CHAR(50), IN `jk` BOOLEAN, IN `nohp` CHAR(13), IN `alamat` CHAR(95))  NO SQL
INSERT INTO pelanggan(nama, jk, noHP,alamat) VALUES (nama, jk,nohp, alamat)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertPesanan` (IN `id_menu` INT, IN `jumlah` INT, IN `id_pel` INT, IN `id_user` INT, IN `stts` ENUM('0','1'))  NO SQL
INSERT INTO pesanan(id_menu, jumlah,id_pelanggan,id_user, status) VALUES (id_menu, jumlah,id_pel,id_user,stts)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertTransaksi` (IN `idpesanan` INT, IN `total` INT, IN `bayar` INT)  NO SQL
INSERT INTO transaksi(idpesanan, total, bayar) VALUES(idpesanan, total, bayar)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pesananJoin` ()  NO SQL
SELECT pesanan.*, menu.nama,pelanggan.nama AS 'napel',users.username as 'namaUser' FROM pesanan
INNER JOIN menu ON pesanan.id_menu = menu.id
INNER JOIN pelanggan ON pesanan.id_pelanggan = pelanggan.id
INNER JOIN users ON pesanan.id_user = users.id 
ORDER BY pesanan.id DESC$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pesananJoinByStts` (IN `stts` ENUM('0','1'))  NO SQL
SELECT pesanan.*, menu.nama,menu.harga,pelanggan.nama AS 'napel',users.username as 'namaUser' FROM pesanan 
INNER JOIN menu ON pesanan.id_menu = menu.id
INNER JOIN pelanggan ON pesanan.id_pelanggan = pelanggan.id
INNER JOIN users ON pesanan.id_user = users.id
WHERE pesanan.status = stts$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pesananLaporanJoin` ()  NO SQL
SELECT pesanan.id_pelanggan,menu.nama,menu.harga,pesanan.jumlah,transaksi.total,transaksi.bayar FROM `transaksi` 
INNER JOIN pesanan ON transaksi.idpesanan = pesanan.id
INNER JOIN menu ON pesanan.id_menu = menu.id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `selectAllBarang` ()  NO SQL
SELECT * FROM menu$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `selectAllMeja` ()  NO SQL
SELECT * FROM meja$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `selectAllMenu` ()  NO SQL
SELECT * from menu$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `selectAllPelanggan` ()  NO SQL
SELECT * FROM pelanggan$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `selectAllWhereMeja` (IN `status` ENUM('0','1'))  NO SQL
SELECT * FROM meja WHERE meja.status = status$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `selectBarangByNama` (IN `nama` VARCHAR(50))  NO SQL
SELECT * FROM menu WHERE menu.nama = nama$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `selectPelangganByID` (IN `id` VARCHAR(10))  NO SQL
SELECT * FROM pelanggan WHERE pelanggan.id = id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `selectPelangganByIDPel` (IN `idPel` INT)  NO SQL
SELECT * FROM pelanggan WHERE pelanggan.id = idPel$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `selectPesananByIDPes` (IN `idpes` INT)  NO SQL
SELECT * FROM pesanan WHERE pesanan.id = idpes$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `selectTransaksi` ()  NO SQL
SELECT * FROM transaksi$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `selectUser` (IN `username` VARCHAR(50), IN `password` VARCHAR(50))  NO SQL
SELECT * FROM users WHERE users.username = username AND users.password = password$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `selectWhereBarang` (IN `nama` VARCHAR(50))  NO SQL
SELECT * FROM menu WHERE menu.nama = nama$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `selectWhereMeja` (IN `no` INT)  NO SQL
SELECT * FROM meja WHERE meja.no = no$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SelectWhereMenu` (IN `nama` VARCHAR(50))  NO SQL
SELECT * FROM menu WHERE menu.nama = nama$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `selectWhereMenuId` (IN `id` INT)  NO SQL
SELECT * FROM menu WHERE menu.id = id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `selectWherePelanggan` (IN `id` VARCHAR(10))  NO SQL
SELECT * FROM pelanggan WHERE pelanggan.id = id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `selectWherePesanan` (IN `id_tabel` INT)  NO SQL
SELECT * FROM pesanan WHERE pesanan.id_tabel = id_tabel$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateBarang` (IN `nama` VARCHAR(50), IN `harga` INT)  NO SQL
UPDATE menu
SET menu.nama = nama, menu.harga = harga WHERE menu.nama = nama$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateMeja` (IN `no` INT)  NO SQL
UPDATE meja
SET meja.no = no
WHERE no = no$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updatePelanggan` (IN `idp` INT, IN `nama` CHAR(50), IN `jk` BOOLEAN, IN `nohp` CHAR(13), IN `alamat` CHAR(95))  NO SQL
UPDATE pelanggan
SET pelanggan.nama = nama, pelanggan.jk = jk, pelanggan.noHP = nohp, pelanggan.alamat = alamat WHERE pelanggan.id = idp$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updatePesanan` (IN `id_menu` INT, IN `jumlah` INT, IN `id_pes` INT, IN `id_user` INT, IN `idpel` INT)  NO SQL
UPDATE pesanan
SET pesanan.id_pelanggan = idpel,pesanan.id_menu = id_menu, pesanan.jumlah = jumlah, pesanan.id_user = id_user WHERE pesanan.id = id_pes$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updatePesananStts` (IN `stts` ENUM('0','1'), IN `idpesanan` INT)  NO SQL
UPDATE pesanan
SET pesanan.status = stts WHERE pesanan.id = idpesanan$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `meja`
--

CREATE TABLE `meja` (
  `id` int(11) NOT NULL,
  `no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meja`
--

INSERT INTO `meja` (`id`, `no`) VALUES
(16, 1),
(17, 2),
(18, 3);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `nama`, `harga`) VALUES
(1, 'Ayam', 1000),
(4, 'Ayam Enak', 1000),
(5, 'Ayam Enak2', 20);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jk` tinyint(1) NOT NULL,
  `noHP` char(13) NOT NULL,
  `alamat` char(95) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `jk`, `noHP`, `alamat`) VALUES
(5, 'jusuf', 0, '62', 'Jl Kentang II');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL,
  `id_pelanggan` varchar(50) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id`, `id_pelanggan`, `id_menu`, `jumlah`, `id_user`, `status`) VALUES
(20, '5', 1, 12, 2, '1'),
(21, '5', 1, 12, 2, '0');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `idtransaksi` int(11) NOT NULL,
  `idpesanan` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `bayar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`idtransaksi`, `idpesanan`, `total`, `bayar`) VALUES
(13, 20, 12000, 15000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `level`) VALUES
(1, 'administrator', 'administrator', 'administrator'),
(2, 'waiter', 'waiter', 'waiter'),
(3, 'kasir', 'kasir', 'kasir'),
(4, 'owner', 'owner', 'owner');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `meja`
--
ALTER TABLE `meja`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`idtransaksi`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `meja`
--
ALTER TABLE `meja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `idtransaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
