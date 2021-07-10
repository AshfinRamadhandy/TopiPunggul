-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2021 at 04:06 PM
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
(1, 'Fuad Hadi Nugroho', 'fhadinugroho@gmail.com', 'e35d05b373eb0a3576e0d1e3ce1e27026d93f4d9d11bf19bad82e4770f95d37ba6ed0936551fdfc8483c900ab5739770ee193a857023ec1604742d254bc8d78e/jRpJgxzslKi6FLZ7o1RC7pcAV0FlRWhmikztkPnvUs=', 1);

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
(1, 'Aksesoris Pria');

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

--
-- Dumping data for table `tb_penjualan`
--

INSERT INTO `tb_penjualan` (`id_penjualan`, `id_administrator`, `id_produk`, `harga_jual`, `jumlah_beli`, `tanggal_penjualan`) VALUES
(6, NULL, 1, 30000, 3000, '2017-12-31 17:00:00'),
(7, NULL, 1, 30000, 1100, '2018-01-31 17:00:00'),
(8, NULL, 1, 30000, 130, '2018-02-28 17:00:00'),
(9, NULL, 1, 30000, 960, '2018-03-31 17:00:00'),
(10, NULL, 1, 30000, 800, '2018-04-30 17:00:00'),
(11, NULL, 1, 30000, 1500, '2018-05-31 17:00:00'),
(12, NULL, 1, 30000, 1400, '2018-07-12 17:00:00'),
(13, NULL, 1, 30000, 1100, '2018-07-31 17:00:00'),
(14, NULL, 1, 30000, 400, '2018-08-31 17:00:00'),
(15, NULL, 1, 30000, 760, '2018-09-30 17:00:00'),
(16, NULL, 1, 30000, 1100, '2018-10-31 17:00:00'),
(17, NULL, 1, 30000, 1100, '2018-11-30 17:00:00'),
(18, NULL, 1, 30000, 1500, '2018-12-31 17:00:00'),
(19, NULL, 1, 30000, 760, '2019-01-31 17:00:00'),
(20, NULL, 1, 30000, 3200, '2019-02-28 17:00:00'),
(21, NULL, 1, 30000, 1100, '2019-03-31 17:00:00'),
(22, NULL, 1, 30000, 1400, '2019-04-30 17:00:00'),
(23, NULL, 1, 30000, 1100, '2019-05-31 17:00:00'),
(24, NULL, 1, 30000, 400, '2019-06-30 17:00:00'),
(25, NULL, 1, 30000, 2600, '2019-07-31 17:00:00'),
(26, NULL, 1, 30000, 1500, '2019-08-31 17:00:00'),
(27, NULL, 1, 30000, 800, '2019-09-30 17:00:00'),
(28, NULL, 1, 30000, 400, '2019-10-31 17:00:00'),
(29, NULL, 1, 30000, 1100, '2019-11-30 17:00:00'),
(30, NULL, 1, 30000, 4200, '2019-12-31 17:00:00'),
(31, NULL, 1, 30000, 2100, '2020-01-31 17:00:00'),
(32, NULL, 1, 30000, 4800, '2020-02-29 17:00:00'),
(33, NULL, 1, 30000, 2060, '2020-03-31 17:00:00'),
(34, NULL, 1, 30000, 5200, '2020-04-30 17:00:00'),
(35, NULL, 1, 30000, 300, '2020-05-31 17:00:00'),
(36, NULL, 1, 30000, 219, '2020-06-30 17:00:00'),
(37, NULL, 1, 30000, 250, '2020-07-31 17:00:00'),
(38, NULL, 1, 30000, 102, '2020-08-31 17:00:00'),
(39, NULL, 1, 30000, 460, '2020-09-30 17:00:00'),
(40, NULL, 1, 30000, 529, '2020-10-31 17:00:00'),
(41, NULL, 1, 30000, 412, '2020-11-30 17:00:00'),
(42, NULL, 1, 30000, 468, '2020-12-31 17:00:00'),
(43, NULL, 1, 30000, 732, '2021-01-31 17:00:00'),
(44, NULL, 1, 30000, 511, '2021-02-28 17:00:00'),
(45, NULL, 1, 30000, 629, '2021-03-31 17:00:00'),
(46, NULL, 1, 30000, 427, '2021-04-30 17:00:00');

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
(1, 'Topi Baret', 1, 30000),
(2, 'Kopiah', 1, 45000);

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
(2, NULL, 1, 50000, '2017-12-31 17:00:00'),
(3, NULL, 1, 5000, '2020-12-31 17:00:00'),
(4, NULL, 2, 1000, '2021-06-13 07:26:30');

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
,`id_kategori` bigint(20)
,`nama_kategori` varchar(30)
,`harga_produk` double
,`harga_jual` double
,`jumlah_beli` int(11)
,`tanggal_penjualan` timestamp
,`tahun_penjualan` int(4)
,`bulan_penjualan` int(2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_produk`
-- (See below for the actual view)
--
CREATE TABLE `v_produk` (
`id_produk` bigint(20)
,`nama_produk` varchar(50)
,`kategori_produk` varchar(30)
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

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_penjualan`  AS SELECT `p`.`id_penjualan` AS `id_penjualan`, (select ifnull(`a`.`nama_administrator`,NULL) from `tb_administrator` `a` where `a`.`id_administrator` = `p`.`id_administrator`) AS `nama_administrator`, `pr`.`id_produk` AS `id_produk`, `pr`.`nama_produk` AS `nama_produk`, (select ifnull(`k`.`id_kategori`,NULL) from `tb_kategori` `k` where `k`.`id_kategori` = `pr`.`kategori_produk`) AS `id_kategori`, (select ifnull(`k`.`nama_kategori`,NULL) from `tb_kategori` `k` where `k`.`id_kategori` = `pr`.`kategori_produk`) AS `nama_kategori`, `pr`.`harga_produk` AS `harga_produk`, `p`.`harga_jual` AS `harga_jual`, `p`.`jumlah_beli` AS `jumlah_beli`, `p`.`tanggal_penjualan` AS `tanggal_penjualan`, year(`p`.`tanggal_penjualan`) AS `tahun_penjualan`, month(`p`.`tanggal_penjualan`) AS `bulan_penjualan` FROM (`tb_penjualan` `p` join `tb_produk` `pr`) WHERE `p`.`id_produk` = `pr`.`id_produk` ;

-- --------------------------------------------------------

--
-- Structure for view `v_produk`
--
DROP TABLE IF EXISTS `v_produk`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_produk`  AS SELECT `p`.`id_produk` AS `id_produk`, `p`.`nama_produk` AS `nama_produk`, (select ifnull(`k`.`nama_kategori`,'Tanpa kategori') from `tb_kategori` `k` where `k`.`id_kategori` = `p`.`kategori_produk`) AS `kategori_produk`, `p`.`harga_produk` AS `harga_produk` FROM `tb_produk` AS `p` ;

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
  MODIFY `id_penjualan` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `tb_produk`
--
ALTER TABLE `tb_produk`
  MODIFY `id_produk` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_stok_masuk`
--
ALTER TABLE `tb_stok_masuk`
  MODIFY `id_stok_masuk` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
