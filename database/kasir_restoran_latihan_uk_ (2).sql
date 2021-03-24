-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2021 at 10:46 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasir_restoran(latihan_uk)`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_oder`
--

CREATE TABLE `detail_oder` (
  `id_detail_oder` int(11) NOT NULL,
  `id_oder` int(10) NOT NULL,
  `id_masakan` int(10) NOT NULL,
  `qty` int(10) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `status_detail_oder` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_oder`
--

INSERT INTO `detail_oder` (`id_detail_oder`, `id_oder`, `id_masakan`, `qty`, `keterangan`, `status_detail_oder`) VALUES
(1, 4, 3, 2, 'nasinya yang peram', 'sudah dibayar');

-- --------------------------------------------------------

--
-- Table structure for table `lvl`
--

CREATE TABLE `lvl` (
  `id_lvl` int(11) NOT NULL,
  `nama_lvl` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lvl`
--

INSERT INTO `lvl` (`id_lvl`, `nama_lvl`) VALUES
(1, 'administrator'),
(2, 'waiter'),
(3, 'kasir'),
(4, 'owner'),
(5, 'pelanggan');

-- --------------------------------------------------------

--
-- Table structure for table `masakan`
--

CREATE TABLE `masakan` (
  `id_masakan` int(11) NOT NULL,
  `nama_masakan` varchar(255) NOT NULL,
  `harga` int(10) NOT NULL,
  `status_masakan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `masakan`
--

INSERT INTO `masakan` (`id_masakan`, `nama_masakan`, `harga`, `status_masakan`) VALUES
(1, 'Nasi Goreng', 20000, 'Tersedia'),
(2, 'Mie Goreng', 15000, 'Tersedia'),
(3, 'Sate Padang', 20000, 'Tersedia'),
(4, 'Ayam Penyet', 10000, 'Tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `oder`
--

CREATE TABLE `oder` (
  `id_oder` int(11) NOT NULL,
  `no_meja` int(10) DEFAULT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user` int(10) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `status_oder` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `oder`
--

INSERT INTO `oder` (`id_oder`, `no_meja`, `tanggal`, `id_user`, `keterangan`, `status_oder`) VALUES
(3, NULL, '2019-11-29 09:41:38', 3, '-', 'belum dibayar'),
(4, NULL, '2021-03-20 09:29:43', 10, 'nasinya yang peram', 'sudah dibayar');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_user` int(10) NOT NULL,
  `id_oder` int(10) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total_bayar` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_user`, `id_oder`, `tanggal`, `total_bayar`) VALUES
(1, 10, 4, '2021-03-20 09:29:54', 40000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_user` varchar(255) NOT NULL,
  `id_lvl` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama_user`, `id_lvl`) VALUES
(2, 'tuR', 'tuR', 'Faturahman Zulfi', 4),
(3, 'thor', 'thor', 'John Thor', 1),
(4, 'boy', 'boy', 'Hendrawan', 2),
(5, 'kira', 'kira', 'Kira Izuru', 3),
(6, 'bang', 'bang', 'Bambang', 5),
(8, 'don', 'don', 'Dono', 2),
(9, 'jin', 'jin', 'Jinta', 2),
(10, 'di', 'di', 'Aldi', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_oder`
--
ALTER TABLE `detail_oder`
  ADD PRIMARY KEY (`id_detail_oder`),
  ADD KEY `id_oder` (`id_oder`),
  ADD KEY `id_masakan` (`id_masakan`);

--
-- Indexes for table `lvl`
--
ALTER TABLE `lvl`
  ADD PRIMARY KEY (`id_lvl`);

--
-- Indexes for table `masakan`
--
ALTER TABLE `masakan`
  ADD PRIMARY KEY (`id_masakan`);

--
-- Indexes for table `oder`
--
ALTER TABLE `oder`
  ADD PRIMARY KEY (`id_oder`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_oder` (`id_oder`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_lvl` (`id_lvl`),
  ADD KEY `id_lvl_2` (`id_lvl`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_oder`
--
ALTER TABLE `detail_oder`
  MODIFY `id_detail_oder` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lvl`
--
ALTER TABLE `lvl`
  MODIFY `id_lvl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `masakan`
--
ALTER TABLE `masakan`
  MODIFY `id_masakan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `oder`
--
ALTER TABLE `oder`
  MODIFY `id_oder` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_oder`
--
ALTER TABLE `detail_oder`
  ADD CONSTRAINT `detail_oder_ibfk_1` FOREIGN KEY (`id_masakan`) REFERENCES `masakan` (`id_masakan`),
  ADD CONSTRAINT `detail_oder_ibfk_2` FOREIGN KEY (`id_oder`) REFERENCES `oder` (`id_oder`);

--
-- Constraints for table `oder`
--
ALTER TABLE `oder`
  ADD CONSTRAINT `oder_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_oder`) REFERENCES `oder` (`id_oder`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_lvl`) REFERENCES `lvl` (`id_lvl`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
