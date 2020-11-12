-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2020 at 09:08 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `no_anggota` int(11) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `jurusan` varchar(25) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`no_anggota`, `nama`, `jurusan`, `alamat`, `tgl_lahir`) VALUES
(1, 'Haris', 'RPL', 'Sungai Andai', '2020-10-01'),
(2, 'Wira', 'MM', 'Komp. AMD', '2020-07-06'),
(3, 'Heri', 'PS', 'Simpan Anemo', '2017-08-15'),
(4, 'Pasa', 'RPL (salah jurusan)', 'kejaksaan', '2004-11-12');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `no_buku` int(11) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `pengarang` varchar(50) NOT NULL,
  `thn_terbit` varchar(20) NOT NULL,
  `penerbit` varchar(50) NOT NULL,
  `jns_buku` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`no_buku`, `judul`, `pengarang`, `thn_terbit`, `penerbit`, `jns_buku`) VALUES
(1, 'Sibuta dari gua hantu', 'Utuh', '1999', 'PT. Majutrus', 'Fiksi'),
(2, 'Cara bercocok tanam', 'Heri', '2020', 'Heri sendiri', 'dokumenter'),
(3, 'The Lord Of The Ring : The Fellowship of The Ring', 'J.J Tolkien', '1954', 'Allen & Unwin', 'Fiksi'),
(4, 'motor resing', 'agung', '2012', 'PT. agung sejati', 'Otomotif');

-- --------------------------------------------------------

--
-- Table structure for table `denda`
--

CREATE TABLE `denda` (
  `kode_denda` int(11) NOT NULL,
  `kode_pinjam` int(11) NOT NULL,
  `no_anggota` int(11) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tarif_denda` varchar(50) NOT NULL,
  `jns_denda` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `denda`
--

INSERT INTO `denda` (`kode_denda`, `kode_pinjam`, `no_anggota`, `tgl_pinjam`, `tarif_denda`, `jns_denda`) VALUES
(1, 1, 1, '2020-10-01', '10.000', 'terlambat mengembalikan'),
(3, 3, 2, '2020-10-14', '25.000', 'buku rusak'),
(8, 9, 3, '2020-11-12', '20.000', 'Buku hilang'),
(9, 10, 1, '2020-11-12', '10000', 'Buku hilang');

-- --------------------------------------------------------

--
-- Table structure for table `pinjam_buku`
--

CREATE TABLE `pinjam_buku` (
  `kode_pinjam` int(11) NOT NULL,
  `no_anggota` int(11) NOT NULL,
  `no_buku` int(11) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pinjam_buku`
--

INSERT INTO `pinjam_buku` (`kode_pinjam`, `no_anggota`, `no_buku`, `tgl_pinjam`, `tgl_kembali`) VALUES
(1, 1, 2, '2020-10-01', '2020-10-07'),
(3, 2, 2, '2020-10-14', '2020-10-21'),
(9, 3, 2, '2020-11-12', '2020-11-16'),
(10, 1, 3, '2020-11-12', '2020-11-19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`no_anggota`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`no_buku`);

--
-- Indexes for table `denda`
--
ALTER TABLE `denda`
  ADD PRIMARY KEY (`kode_denda`),
  ADD KEY `no_anggota` (`no_anggota`) USING BTREE,
  ADD KEY `kode_pinjam` (`kode_pinjam`);

--
-- Indexes for table `pinjam_buku`
--
ALTER TABLE `pinjam_buku`
  ADD PRIMARY KEY (`kode_pinjam`),
  ADD KEY `no_buku` (`no_buku`) USING BTREE,
  ADD KEY `no_anggota` (`no_anggota`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `no_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `no_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `denda`
--
ALTER TABLE `denda`
  MODIFY `kode_denda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pinjam_buku`
--
ALTER TABLE `pinjam_buku`
  MODIFY `kode_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `denda`
--
ALTER TABLE `denda`
  ADD CONSTRAINT `denda_ibfk_1` FOREIGN KEY (`no_anggota`) REFERENCES `anggota` (`no_anggota`),
  ADD CONSTRAINT `denda_ibfk_2` FOREIGN KEY (`kode_pinjam`) REFERENCES `pinjam_buku` (`kode_pinjam`);

--
-- Constraints for table `pinjam_buku`
--
ALTER TABLE `pinjam_buku`
  ADD CONSTRAINT `pinjam_buku_ibfk_1` FOREIGN KEY (`no_anggota`) REFERENCES `anggota` (`no_anggota`),
  ADD CONSTRAINT `pinjam_buku_ibfk_2` FOREIGN KEY (`no_buku`) REFERENCES `buku` (`no_buku`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
