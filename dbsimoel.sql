-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2018 at 10:54 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbsimoel`
--

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `idDriver` int(11) NOT NULL,
  `namaDriver` varchar(100) NOT NULL,
  `ktp` int(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `kondisiSupir` varchar(25) NOT NULL,
  `cekSupir` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`idDriver`, `namaDriver`, `ktp`, `alamat`, `kondisiSupir`, `cekSupir`) VALUES
(14, 'soponoooo', 2147483646, 'Jalan Margonda Raya No.152', 'Baik', 'Tidak Ada'),
(15, 'iqbal', 234234234, 'jalan kramat jaya', 'Baik', 'Tidak Ada'),
(16, 'arie', 324234234, 'jalan kedung', 'Baik', 'Ada');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `idJadwal` int(11) NOT NULL,
  `idDriver` int(11) NOT NULL,
  `platKendaraan` varchar(11) NOT NULL,
  `tujuan` varchar(100) NOT NULL,
  `tglBerangkat` varchar(100) NOT NULL,
  `kepentingan` varchar(100) NOT NULL,
  `idPegawai` int(11) NOT NULL,
  `lamaWaktu` int(11) NOT NULL,
  `statusPerjalanan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`idJadwal`, `idDriver`, `platKendaraan`, `tujuan`, `tglBerangkat`, `kepentingan`, `idPegawai`, `lamaWaktu`, `statusPerjalanan`) VALUES
(3, 15, 'B 1432 GQ', 'Jakarta', '2018-11-30', 'umum', 5, 5, 'Terjadwal'),
(4, 16, 'B 2645 SQ', 'Bogor', '2018-12-08', 'umum', 6, 5, 'Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `kendaraan`
--

CREATE TABLE `kendaraan` (
  `idKendaraan` int(11) NOT NULL,
  `namaKendaraan` varchar(100) NOT NULL,
  `merkKendaraan` varchar(100) NOT NULL,
  `bahanBakar` varchar(100) NOT NULL,
  `tglPajak` varchar(100) NOT NULL,
  `platKendaraan` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kendaraan`
--

INSERT INTO `kendaraan` (`idKendaraan`, `namaKendaraan`, `merkKendaraan`, `bahanBakar`, `tglPajak`, `platKendaraan`) VALUES
(1, 'Kijang', 'Innova', 'Bensin', '27-03-2019', 'B 1391 RF'),
(2, 'Kijang', 'Innova', 'Bensin', '27-03-2019', 'B 1392 RF'),
(3, 'Kijang', 'Innova', 'Bensin', '27-03-2019', 'B 1013 RF'),
(4, 'Kijang', 'Innova', 'Bensin', '15-04-2019', 'B 2645 SQ'),
(5, 'Toyota', 'Avanza', 'Bensin', '29-11-2018', 'B 2196 SQ'),
(6, 'Honda', 'Honda Stream', 'Bensin', '13-04-2019', 'B 1432 GQ'),
(7, 'Hyundai', 'Trajet', 'Bensin', '20-04-2019', 'B 1091 WQ'),
(8, 'Hyundai', 'Trajet', 'Bensin', '20-04-2019', 'B 1092 WQ'),
(9, 'Kijang ', 'Kijang Kapsul', 'Bensin', '09-09-2019', 'B 2376 JQ'),
(10, 'YamahMUD', 'Mio', 'Bensin', '30-11-2018', 'B 3497 ST');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `idPegawai` int(200) NOT NULL,
  `namaPegawai` varchar(200) NOT NULL,
  `jabatanPegawai` varchar(200) NOT NULL,
  `statusPegawai` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`idPegawai`, `namaPegawai`, `jabatanPegawai`, `statusPegawai`) VALUES
(5, 'Prof. Muchlisin Arief, Ph.D.', 'CEO Lapan', 'Aktif'),
(6, 'Dr. Wikanti Asriningrum, M.Si', 'CTO Lapan', 'Aktif'),
(7, 'Ir. Wawan Kusnawan Harsanugraha, M.Si.', 'CEO Pusfatja', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `pemeliharaan`
--

CREATE TABLE `pemeliharaan` (
  `idPemeliharaan` int(11) NOT NULL,
  `platKendaraan` varchar(20) NOT NULL,
  `oliMesin` varchar(100) NOT NULL,
  `airRadiator` varchar(100) NOT NULL,
  `kondisiRem` varchar(100) NOT NULL,
  `kondisiAccu` varchar(100) NOT NULL,
  `kondisiLampu` varchar(100) NOT NULL,
  `statusMobil` enum('Available','Service') NOT NULL,
  `cekMobil` varchar(25) NOT NULL,
  `tglPrint` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemeliharaan`
--

INSERT INTO `pemeliharaan` (`idPemeliharaan`, `platKendaraan`, `oliMesin`, `airRadiator`, `kondisiRem`, `kondisiAccu`, `kondisiLampu`, `statusMobil`, `cekMobil`, `tglPrint`) VALUES
(1, 'B 1391 RF', 'YA', 'YA', 'YA', 'YA', 'YA', 'Available', 'Tersedia', '2017-11-10'),
(2, 'B 1392 RF', 'TIDAK', 'YA', 'YA', 'YA', 'YA', 'Service', 'Tersedia', '2018-10-11'),
(3, 'B 1013 RF', 'YA', 'YA', 'YA', 'YA', 'YA', 'Available', 'TidakTersedia', '2017-10-09'),
(4, 'B 2645 SQ', 'YA', 'YA', 'YA', 'YA', 'YA', 'Available', 'Tersedia', '2018-11-11'),
(5, 'B 1091 WQ', 'YA', 'YA', 'YA', 'YA', 'TIDAK', 'Service', 'Tersedia', '2018-08-11'),
(6, 'B 1432 GQ', 'YA', 'YA', 'YA', 'YA', 'YA', 'Available', 'Tidak Tersedia', '2018-11-09');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `iduser` int(2) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `stuser` int(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`iduser`, `username`, `password`, `stuser`) VALUES
(1, 'kabeng', 'e10adc3949ba59abbe56e057f20f883e', 1),
(2, 'kabag', 'e10adc3949ba59abbe56e057f20f883e', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`idDriver`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`idJadwal`),
  ADD UNIQUE KEY `idDriver` (`idDriver`,`platKendaraan`,`idPegawai`);

--
-- Indexes for table `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD PRIMARY KEY (`idKendaraan`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`idPegawai`);

--
-- Indexes for table `pemeliharaan`
--
ALTER TABLE `pemeliharaan`
  ADD PRIMARY KEY (`idPemeliharaan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `idDriver` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `idPegawai` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pemeliharaan`
--
ALTER TABLE `pemeliharaan`
  MODIFY `idPemeliharaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
