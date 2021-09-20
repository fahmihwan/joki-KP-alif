-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 20, 2021 at 04:38 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pertashop`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_jenis_bbm`
--

CREATE TABLE `tb_jenis_bbm` (
  `id_jenis` int(11) NOT NULL,
  `nama_bbm` varchar(20) NOT NULL,
  `stok` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_jenis_bbm`
--

INSERT INTO `tb_jenis_bbm` (`id_jenis`, `nama_bbm`, `stok`, `harga_jual`) VALUES
(11, 'PERTALITE', 1679, 9200),
(12, 'PERTAMAX', 1770, 10000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kendaraan`
--

CREATE TABLE `tb_kendaraan` (
  `nomor_polisi` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kendaraan`
--

INSERT INTO `tb_kendaraan` (`nomor_polisi`) VALUES
('AE1922SH');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembelian`
--

CREATE TABLE `tb_pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah_pemesanan` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `fk_supplier` int(11) NOT NULL,
  `fk_jenis_bbm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pembelian`
--

INSERT INTO `tb_pembelian` (`id_pembelian`, `tanggal`, `jumlah_pemesanan`, `harga`, `fk_supplier`, `fk_jenis_bbm`) VALUES
(35, '2021-09-19', 2, 2000000, 21, 11),
(36, '2021-09-19', 2, 2000000, 21, 12);

-- --------------------------------------------------------

--
-- Table structure for table `tb_penjualan`
--

CREATE TABLE `tb_penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `penjualan` int(11) NOT NULL,
  `total_penjualan` int(11) NOT NULL,
  `sonding` varchar(40) NOT NULL,
  `speed_awal` int(11) NOT NULL,
  `speed_akhir` int(11) NOT NULL,
  `fk_jenis_bbm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_penjualan`
--

INSERT INTO `tb_penjualan` (`id_penjualan`, `tanggal`, `penjualan`, `total_penjualan`, `sonding`, `speed_awal`, `speed_akhir`, `fk_jenis_bbm`) VALUES
(14, '2021-09-19', 12, 110400, '12312312', 0, 12, 11),
(15, '2021-09-19', 88, 809600, '1000', 12, 100, 11),
(16, '2021-09-19', 100, 920000, '12312312', 0, 100, 11),
(17, '2021-09-19', 200, 2000000, '1234567890', 0, 200, 12),
(18, '2021-09-19', 30, 300000, '1234567890', 200, 230, 12),
(19, '2021-09-19', 121, 1113200, '1234567890', 100, 221, 11);

-- --------------------------------------------------------

--
-- Table structure for table `tb_supir`
--

CREATE TABLE `tb_supir` (
  `id_supir` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `telp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_supir`
--

INSERT INTO `tb_supir` (`id_supir`, `nama`, `telp`) VALUES
(12, 'alif', '082334337393');

-- --------------------------------------------------------

--
-- Table structure for table `tb_supplier`
--

CREATE TABLE `tb_supplier` (
  `id_supplier` int(11) NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp(),
  `supir` int(11) NOT NULL,
  `nomor_polisi` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_supplier`
--

INSERT INTO `tb_supplier` (`id_supplier`, `tanggal`, `supir`, `nomor_polisi`) VALUES
(21, '2021-09-19', 12, 'AE1922SH');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_jenis_bbm`
--
ALTER TABLE `tb_jenis_bbm`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `tb_kendaraan`
--
ALTER TABLE `tb_kendaraan`
  ADD PRIMARY KEY (`nomor_polisi`);

--
-- Indexes for table `tb_pembelian`
--
ALTER TABLE `tb_pembelian`
  ADD PRIMARY KEY (`id_pembelian`),
  ADD KEY `fk_supplier` (`fk_supplier`),
  ADD KEY `fk_jenis_bbm` (`fk_jenis_bbm`);

--
-- Indexes for table `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  ADD PRIMARY KEY (`id_penjualan`),
  ADD KEY `fk_bbm` (`fk_jenis_bbm`);

--
-- Indexes for table `tb_supir`
--
ALTER TABLE `tb_supir`
  ADD PRIMARY KEY (`id_supir`);

--
-- Indexes for table `tb_supplier`
--
ALTER TABLE `tb_supplier`
  ADD PRIMARY KEY (`id_supplier`),
  ADD KEY `supir` (`supir`),
  ADD KEY `kendaraan` (`nomor_polisi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_jenis_bbm`
--
ALTER TABLE `tb_jenis_bbm`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_pembelian`
--
ALTER TABLE `tb_pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tb_supir`
--
ALTER TABLE `tb_supir`
  MODIFY `id_supir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_supplier`
--
ALTER TABLE `tb_supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_pembelian`
--
ALTER TABLE `tb_pembelian`
  ADD CONSTRAINT `tb_pembelian_ibfk_3` FOREIGN KEY (`fk_supplier`) REFERENCES `tb_supplier` (`id_supplier`),
  ADD CONSTRAINT `tb_pembelian_ibfk_4` FOREIGN KEY (`fk_jenis_bbm`) REFERENCES `tb_jenis_bbm` (`id_jenis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  ADD CONSTRAINT `tb_penjualan_ibfk_1` FOREIGN KEY (`fk_jenis_bbm`) REFERENCES `tb_jenis_bbm` (`id_jenis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_supplier`
--
ALTER TABLE `tb_supplier`
  ADD CONSTRAINT `tb_supplier_ibfk_1` FOREIGN KEY (`supir`) REFERENCES `tb_supir` (`id_supir`),
  ADD CONSTRAINT `tb_supplier_ibfk_2` FOREIGN KEY (`nomor_polisi`) REFERENCES `tb_kendaraan` (`nomor_polisi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
