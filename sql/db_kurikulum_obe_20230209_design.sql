-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2023 at 08:18 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kurikulum_obe`
--

-- --------------------------------------------------------

--
-- Table structure for table `bahan_kajian`
--

CREATE TABLE `bahan_kajian` (
  `id_bk` int(10) UNSIGNED NOT NULL,
  `id_prodi` int(10) UNSIGNED NOT NULL,
  `kode_bk` varchar(4) NOT NULL,
  `nama_bk` varchar(100) NOT NULL,
  `deskripsi_bk` text DEFAULT NULL,
  `bobot_min` smallint(5) UNSIGNED NOT NULL,
  `bobot_max` smallint(5) UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cpl`
--

CREATE TABLE `cpl` (
  `id_cpl` int(10) UNSIGNED NOT NULL,
  `id_prodi` int(10) UNSIGNED NOT NULL,
  `kode_cpl` varchar(5) NOT NULL,
  `deskripsi_cpl` text NOT NULL,
  `unsur` enum('Sikap','Keterampilan Umum','Pengetahuan','Keterampilan Khusus') NOT NULL,
  `referensi` text DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cpmk`
--

CREATE TABLE `cpmk` (
  `id_cpmk` int(10) UNSIGNED NOT NULL,
  `id_prodi` int(10) UNSIGNED NOT NULL,
  `id_cpl` int(10) UNSIGNED NOT NULL,
  `kode_cpmk` int(10) UNSIGNED NOT NULL,
  `deskripsi_cpmk` text NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `map_bk_mk`
--

CREATE TABLE `map_bk_mk` (
  `id_map_bk_mk` int(10) UNSIGNED NOT NULL,
  `id_bk` int(10) UNSIGNED NOT NULL,
  `id_mk` int(10) UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `map_cpl_bk`
--

CREATE TABLE `map_cpl_bk` (
  `id_map_cpl_bk` int(10) UNSIGNED NOT NULL,
  `id_cpl` int(10) UNSIGNED NOT NULL,
  `id_bk` int(10) UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `map_cpmk_mk`
--

CREATE TABLE `map_cpmk_mk` (
  `id_map_cpmk_mk` int(10) UNSIGNED NOT NULL,
  `id_cpmk` int(10) UNSIGNED NOT NULL,
  `id_mk` int(10) UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `map_pl_cpl`
--

CREATE TABLE `map_pl_cpl` (
  `id_map` int(10) UNSIGNED NOT NULL,
  `id_pl` int(11) UNSIGNED NOT NULL,
  `id_cpl` int(11) UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mata_kuliah`
--

CREATE TABLE `mata_kuliah` (
  `id_mk` int(10) UNSIGNED NOT NULL,
  `id_prodi` int(10) UNSIGNED NOT NULL,
  `kode_mk_obe` varchar(4) NOT NULL,
  `kode_mk_undiksha` varchar(10) NOT NULL,
  `nama_mk` varchar(200) NOT NULL,
  `deskripsi_mk` text DEFAULT NULL,
  `sks` smallint(6) DEFAULT NULL,
  `semester` smallint(6) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `id_prodi` int(10) UNSIGNED NOT NULL,
  `kode_prodi` varchar(20) NOT NULL,
  `nama_prodi` varchar(100) NOT NULL,
  `acitive` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `profil_lulusan`
--

CREATE TABLE `profil_lulusan` (
  `id_pl` int(10) UNSIGNED NOT NULL,
  `id_prodi` int(10) UNSIGNED NOT NULL,
  `kode_pl` varchar(4) NOT NULL,
  `deskripsi_pl` text NOT NULL,
  `unsur` enum('Sikap','Keterampilan Umum','Pengetahuan','Keterampilan Khusus') NOT NULL,
  `referensi` text DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sub_cpmk`
--

CREATE TABLE `sub_cpmk` (
  `id_sub_cpmk` int(10) UNSIGNED NOT NULL,
  `id_prodi` int(10) UNSIGNED NOT NULL,
  `id_map_cpmk_mk` int(10) UNSIGNED NOT NULL,
  `kode_sub_cpmk` varchar(12) NOT NULL,
  `deskripsi_sub_cmpk` text NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bahan_kajian`
--
ALTER TABLE `bahan_kajian`
  ADD PRIMARY KEY (`id_bk`),
  ADD KEY `id_prodi` (`id_prodi`);

--
-- Indexes for table `cpl`
--
ALTER TABLE `cpl`
  ADD PRIMARY KEY (`id_cpl`),
  ADD KEY `id_prodi` (`id_prodi`);

--
-- Indexes for table `cpmk`
--
ALTER TABLE `cpmk`
  ADD PRIMARY KEY (`id_cpmk`),
  ADD KEY `id_cpl` (`id_cpl`),
  ADD KEY `id_prodi` (`id_prodi`);

--
-- Indexes for table `map_bk_mk`
--
ALTER TABLE `map_bk_mk`
  ADD PRIMARY KEY (`id_map_bk_mk`),
  ADD KEY `id_bk` (`id_bk`),
  ADD KEY `id_mk` (`id_mk`);

--
-- Indexes for table `map_cpl_bk`
--
ALTER TABLE `map_cpl_bk`
  ADD PRIMARY KEY (`id_map_cpl_bk`),
  ADD KEY `id_cpl` (`id_cpl`),
  ADD KEY `id_bk` (`id_bk`);

--
-- Indexes for table `map_cpmk_mk`
--
ALTER TABLE `map_cpmk_mk`
  ADD PRIMARY KEY (`id_map_cpmk_mk`),
  ADD KEY `id_cpmk` (`id_cpmk`),
  ADD KEY `id_mk` (`id_mk`);

--
-- Indexes for table `map_pl_cpl`
--
ALTER TABLE `map_pl_cpl`
  ADD PRIMARY KEY (`id_map`),
  ADD KEY `id_pl` (`id_pl`),
  ADD KEY `id_cpl` (`id_cpl`);

--
-- Indexes for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD PRIMARY KEY (`id_mk`),
  ADD KEY `id_prodi` (`id_prodi`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id_prodi`);

--
-- Indexes for table `profil_lulusan`
--
ALTER TABLE `profil_lulusan`
  ADD PRIMARY KEY (`id_pl`),
  ADD KEY `id_prodi` (`id_prodi`);

--
-- Indexes for table `sub_cpmk`
--
ALTER TABLE `sub_cpmk`
  ADD PRIMARY KEY (`id_sub_cpmk`),
  ADD KEY `id_map_cpmk_mk` (`id_map_cpmk_mk`),
  ADD KEY `id_prodi` (`id_prodi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bahan_kajian`
--
ALTER TABLE `bahan_kajian`
  MODIFY `id_bk` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cpl`
--
ALTER TABLE `cpl`
  MODIFY `id_cpl` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cpmk`
--
ALTER TABLE `cpmk`
  MODIFY `id_cpmk` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `map_bk_mk`
--
ALTER TABLE `map_bk_mk`
  MODIFY `id_map_bk_mk` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `map_cpl_bk`
--
ALTER TABLE `map_cpl_bk`
  MODIFY `id_map_cpl_bk` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `map_cpmk_mk`
--
ALTER TABLE `map_cpmk_mk`
  MODIFY `id_map_cpmk_mk` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `map_pl_cpl`
--
ALTER TABLE `map_pl_cpl`
  MODIFY `id_map` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  MODIFY `id_mk` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id_prodi` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profil_lulusan`
--
ALTER TABLE `profil_lulusan`
  MODIFY `id_pl` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_cpmk`
--
ALTER TABLE `sub_cpmk`
  MODIFY `id_sub_cpmk` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bahan_kajian`
--
ALTER TABLE `bahan_kajian`
  ADD CONSTRAINT `bahan_kajian_ibfk_1` FOREIGN KEY (`id_prodi`) REFERENCES `prodi` (`id_prodi`);

--
-- Constraints for table `cpl`
--
ALTER TABLE `cpl`
  ADD CONSTRAINT `cpl_ibfk_1` FOREIGN KEY (`id_prodi`) REFERENCES `prodi` (`id_prodi`);

--
-- Constraints for table `cpmk`
--
ALTER TABLE `cpmk`
  ADD CONSTRAINT `cpmk_ibfk_1` FOREIGN KEY (`id_cpl`) REFERENCES `cpl` (`id_cpl`),
  ADD CONSTRAINT `cpmk_ibfk_2` FOREIGN KEY (`id_prodi`) REFERENCES `prodi` (`id_prodi`);

--
-- Constraints for table `map_bk_mk`
--
ALTER TABLE `map_bk_mk`
  ADD CONSTRAINT `map_bk_mk_ibfk_1` FOREIGN KEY (`id_bk`) REFERENCES `bahan_kajian` (`id_bk`),
  ADD CONSTRAINT `map_bk_mk_ibfk_2` FOREIGN KEY (`id_mk`) REFERENCES `mata_kuliah` (`id_mk`);

--
-- Constraints for table `map_cpl_bk`
--
ALTER TABLE `map_cpl_bk`
  ADD CONSTRAINT `map_cpl_bk_ibfk_1` FOREIGN KEY (`id_cpl`) REFERENCES `cpl` (`id_cpl`),
  ADD CONSTRAINT `map_cpl_bk_ibfk_2` FOREIGN KEY (`id_bk`) REFERENCES `bahan_kajian` (`id_bk`);

--
-- Constraints for table `map_cpmk_mk`
--
ALTER TABLE `map_cpmk_mk`
  ADD CONSTRAINT `map_cpmk_mk_ibfk_1` FOREIGN KEY (`id_cpmk`) REFERENCES `cpmk` (`id_cpmk`),
  ADD CONSTRAINT `map_cpmk_mk_ibfk_2` FOREIGN KEY (`id_mk`) REFERENCES `mata_kuliah` (`id_mk`);

--
-- Constraints for table `map_pl_cpl`
--
ALTER TABLE `map_pl_cpl`
  ADD CONSTRAINT `map_pl_cpl_ibfk_1` FOREIGN KEY (`id_pl`) REFERENCES `profil_lulusan` (`id_pl`),
  ADD CONSTRAINT `map_pl_cpl_ibfk_2` FOREIGN KEY (`id_cpl`) REFERENCES `cpl` (`id_cpl`);

--
-- Constraints for table `mata_kuliah`
--
ALTER TABLE `mata_kuliah`
  ADD CONSTRAINT `mata_kuliah_ibfk_1` FOREIGN KEY (`id_prodi`) REFERENCES `prodi` (`id_prodi`);

--
-- Constraints for table `profil_lulusan`
--
ALTER TABLE `profil_lulusan`
  ADD CONSTRAINT `profil_lulusan_ibfk_1` FOREIGN KEY (`id_prodi`) REFERENCES `prodi` (`id_prodi`);

--
-- Constraints for table `sub_cpmk`
--
ALTER TABLE `sub_cpmk`
  ADD CONSTRAINT `sub_cpmk_ibfk_1` FOREIGN KEY (`id_map_cpmk_mk`) REFERENCES `map_cpmk_mk` (`id_map_cpmk_mk`),
  ADD CONSTRAINT `sub_cpmk_ibfk_2` FOREIGN KEY (`id_prodi`) REFERENCES `prodi` (`id_prodi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
