-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2021 at 09:02 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sitopin`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_administrator`
--

CREATE TABLE `tb_administrator` (
  `id_administrator` bigint(20) NOT NULL,
  `nama_administrator` varchar(50) NOT NULL,
  `email_administrator` varchar(100) NOT NULL,
  `sandi_administrator` varchar(255) NOT NULL,
  `super_administrator` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_administrator`
--

INSERT INTO `tb_administrator` (`id_administrator`, `nama_administrator`, `email_administrator`, `sandi_administrator`, `super_administrator`) VALUES
(1, 'Fuad Hadi Nugroho', 'fhadinugroho@gmail.com', 'e35d05b373eb0a3576e0d1e3ce1e27026d93f4d9d11bf19bad82e4770f95d37ba6ed0936551fdfc8483c900ab5739770ee193a857023ec1604742d254bc8d78e/jRpJgxzslKi6FLZ7o1RC7pcAV0FlRWhmikztkPnvUs=', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id_kategori` bigint(20) NOT NULL,
  `nama_kategori` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kategori`
--

INSERT INTO `tb_kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Busana Muslim Pria'),
(2, 'Busana Muslim Wanita');

-- --------------------------------------------------------

--
-- Table structure for table `tb_penjualan`
--

CREATE TABLE `tb_penjualan` (
  `id_penjualan` bigint(20) NOT NULL,
  `id_administrator` bigint(20) DEFAULT NULL,
  `id_produk` bigint(20) NOT NULL,
  `harga_jual` double NOT NULL,
  `jumlah_beli` int(11) NOT NULL,
  `tanggal_penjualan` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_produk`
--

CREATE TABLE `tb_produk` (
  `id_produk` bigint(20) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `kategori_produk` bigint(20) DEFAULT NULL,
  `harga_produk` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_produk`
--

INSERT INTO `tb_produk` (`id_produk`, `nama_produk`, `kategori_produk`, `harga_produk`) VALUES
(1, 'Sarung Cap Cip Cup', 1, 120000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_stok_masuk`
--

CREATE TABLE `tb_stok_masuk` (
  `id_stok_masuk` bigint(20) NOT NULL,
  `id_administrator` bigint(20) DEFAULT NULL,
  `id_produk` bigint(20) NOT NULL,
  `jumlah_masuk` int(11) NOT NULL,
  `tanggal_masuk` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_stok_masuk`
--

INSERT INTO `tb_stok_masuk` (`id_stok_masuk`, `id_administrator`, `id_produk`, `jumlah_masuk`, `tanggal_masuk`) VALUES
(1, NULL, 1, 20, '2021-06-09 18:45:55');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_penjualan`
-- (See below for the actual view)
--
CREATE TABLE `v_penjualan` (
`id_penjualan` bigint(20)
,`nama_administrator` varchar(50)
,`id_produk` bigint(20)
,`nama_produk` varchar(50)
,`kategori_produk` bigint(20)
,`harga_produk` double
,`harga_jual` double
,`jumlah_beli` int(11)
,`tanggal_penjualan` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_produk`
-- (See below for the actual view)
--
CREATE TABLE `v_produk` (
`id_produk` bigint(20)
,`nama_produk` varchar(50)
,`id_kategori` bigint(20)
,`nama_kategori` varchar(30)
,`harga_produk` double
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_stok_masuk`
-- (See below for the actual view)
--
CREATE TABLE `v_stok_masuk` (
`id_stok_masuk` bigint(20)
,`nama_administrator` varchar(50)
,`id_produk` bigint(20)
,`nama_produk` varchar(50)
,`kategori_produk` bigint(20)
,`harga_produk` double
,`jumlah_masuk` int(11)
,`tanggal_masuk` timestamp
);

-- --------------------------------------------------------

--
-- Structure for view `v_penjualan`
--
DROP TABLE IF EXISTS `v_penjualan`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_penjualan`  AS SELECT `p`.`id_penjualan` AS `id_penjualan`, (select ifnull(`a`.`nama_administrator`,NULL) from `tb_administrator` `a` where `a`.`id_administrator` = `p`.`id_administrator`) AS `nama_administrator`, `pr`.`id_produk` AS `id_produk`, `pr`.`nama_produk` AS `nama_produk`, `pr`.`kategori_produk` AS `kategori_produk`, `pr`.`harga_produk` AS `harga_produk`, `p`.`harga_jual` AS `harga_jual`, `p`.`jumlah_beli` AS `jumlah_beli`, `p`.`tanggal_penjualan` AS `tanggal_penjualan` FROM (`tb_penjualan` `p` join `tb_produk` `pr`) WHERE `p`.`id_produk` = `pr`.`id_produk` ;

-- --------------------------------------------------------

--
-- Structure for view `v_produk`
--
DROP TABLE IF EXISTS `v_produk`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_produk`  AS SELECT `p`.`id_produk` AS `id_produk`, `p`.`nama_produk` AS `nama_produk`, `k`.`id_kategori` AS `id_kategori`, `k`.`nama_kategori` AS `nama_kategori`, `p`.`harga_produk` AS `harga_produk` FROM (`tb_produk` `p` join `tb_kategori` `k`) WHERE `p`.`kategori_produk` = `k`.`id_kategori` ;

-- --------------------------------------------------------

--
-- Structure for view `v_stok_masuk`
--
DROP TABLE IF EXISTS `v_stok_masuk`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_stok_masuk`  AS SELECT `sm`.`id_stok_masuk` AS `id_stok_masuk`, (select ifnull(`a`.`nama_administrator`,NULL) from `tb_administrator` `a` where `a`.`id_administrator` = `sm`.`id_administrator`) AS `nama_administrator`, `pr`.`id_produk` AS `id_produk`, `pr`.`nama_produk` AS `nama_produk`, `pr`.`kategori_produk` AS `kategori_produk`, `pr`.`harga_produk` AS `harga_produk`, `sm`.`jumlah_masuk` AS `jumlah_masuk`, `sm`.`tanggal_masuk` AS `tanggal_masuk` FROM (`tb_stok_masuk` `sm` join `tb_produk` `pr`) WHERE `sm`.`id_produk` = `pr`.`id_produk` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_administrator`
--
ALTER TABLE `tb_administrator`
  ADD PRIMARY KEY (`id_administrator`),
  ADD UNIQUE KEY `email_administrator` (`email_administrator`);

--
-- Indexes for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id_kategori`),
  ADD UNIQUE KEY `nama_kategori` (`nama_kategori`);

--
-- Indexes for table `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  ADD PRIMARY KEY (`id_penjualan`),
  ADD KEY `id_administrator` (`id_administrator`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD UNIQUE KEY `nama_produk` (`nama_produk`),
  ADD KEY `kategori_produk` (`kategori_produk`);

--
-- Indexes for table `tb_stok_masuk`
--
ALTER TABLE `tb_stok_masuk`
  ADD PRIMARY KEY (`id_stok_masuk`),
  ADD KEY `id_administrator` (`id_administrator`),
  ADD KEY `id_produk` (`id_produk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_administrator`
--
ALTER TABLE `tb_administrator`
  MODIFY `id_administrator` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id_kategori` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  MODIFY `id_penjualan` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_produk`
--
ALTER TABLE `tb_produk`
  MODIFY `id_produk` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_stok_masuk`
--
ALTER TABLE `tb_stok_masuk`
  MODIFY `id_stok_masuk` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  ADD CONSTRAINT `tb_penjualan_ibfk_1` FOREIGN KEY (`id_administrator`) REFERENCES `tb_administrator` (`id_administrator`) ON DELETE SET NULL,
  ADD CONSTRAINT `tb_penjualan_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `tb_produk` (`id_produk`) ON DELETE CASCADE;

--
-- Constraints for table `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD CONSTRAINT `tb_produk_ibfk_1` FOREIGN KEY (`kategori_produk`) REFERENCES `tb_kategori` (`id_kategori`) ON DELETE SET NULL;

--
-- Constraints for table `tb_stok_masuk`
--
ALTER TABLE `tb_stok_masuk`
  ADD CONSTRAINT `tb_stok_masuk_ibfk_1` FOREIGN KEY (`id_administrator`) REFERENCES `tb_administrator` (`id_administrator`) ON DELETE SET NULL,
  ADD CONSTRAINT `tb_stok_masuk_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `tb_produk` (`id_produk`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
