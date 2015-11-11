-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2015 at 03:32 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `epus_org_3172100`
--

-- --------------------------------------------------------

--
-- Table structure for table `mst_peg_golruang`
--

CREATE TABLE IF NOT EXISTS `mst_peg_golruang` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_golongan` varchar(10) NOT NULL,
  `ruang` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `AK_Key_1` (`id_golongan`),
  UNIQUE KEY `Index_1` (`ruang`),
  KEY `id_golongan` (`id_golongan`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `mst_peg_golruang`
--

INSERT INTO `mst_peg_golruang` (`id`, `id_golongan`, `ruang`) VALUES
(1, 'I/C', 'JURU'),
(2, 'I/A', 'JURU MUDA'),
(3, 'I/B', 'JURU MUDA TINGKAT I'),
(4, 'I/D', 'JURU TINGKAT I'),
(5, 'IV/A', 'PEMBINA'),
(6, 'IV/B', 'PEMBINA TINGKAT I'),
(7, 'IV/E', 'PEMBINA UTAMA'),
(8, 'IV/D', 'PEMBINA UTAMA MADYA'),
(9, 'IV/C', 'PEMBINA UTAMA MUDA'),
(10, 'III/C', 'PENATA'),
(11, 'III/A', 'PENATA MUDA'),
(12, 'III/B', 'PENATA MUDA TINGKAT I'),
(13, 'III/D', 'PENATA TINGKAT I'),
(14, 'II/C', 'PENGATUR'),
(15, 'II/A', 'PENGATUR MUDA'),
(16, 'II/B', 'PENGATUR MUDA TK I'),
(17, 'II/D', 'PENGATUR TINGKAT I'),
(18, '-', 'CPNS / Non PNS');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
