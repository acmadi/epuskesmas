-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 09 Nov 2015 pada 16.04
-- Versi Server: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epus_org_3172100`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `mst_inv_pilihan`
--

CREATE TABLE IF NOT EXISTS `mst_inv_pilihan` (
  `id_pilihan` int(11) NOT NULL,
  `tipe` enum('komponen','status_pengadaan','status_inventaris','satuan','status_hak','keadaan_barang','status_barang','asal_usul','bahan','kons_tingkat','kons_beton','penggunaan') NOT NULL,
  `code` varchar(30) CHARACTER SET utf8 NOT NULL,
  `value` varchar(100) CHARACTER SET utf8 NOT NULL,
  `jumlah_muncul` int(11) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=173 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mst_inv_pilihan`
--

INSERT INTO `mst_inv_pilihan` (`id_pilihan`, `tipe`, `code`, `value`, `jumlah_muncul`) VALUES
(79, 'status_hak', '3', 'Hak Pakai', NULL),
(78, 'status_hak', '2', 'Milik Negara', NULL),
(77, 'status_hak', '1', 'Milik Pemerintah Daerah Provinsi Jakarta', NULL),
(76, 'satuan', 'KG', 'Kilogram', NULL),
(75, 'satuan', 'BT', 'Batang', NULL),
(74, 'satuan', 'EK', 'Ekor', NULL),
(73, 'satuan', 'ST', 'Set/Stel', NULL),
(72, 'satuan', 'BH', 'Buah', NULL),
(71, 'satuan', 'PK', 'Tenaga Kuda', NULL),
(70, 'satuan', 'IN', 'Inchi', NULL),
(69, 'satuan', 'KM', 'Kilometer', NULL),
(68, 'satuan', 'MT', 'Meter', NULL),
(67, 'satuan', 'KM2', 'Kilometer Persegi', NULL),
(66, 'satuan', 'M2', 'Meter Persegi', NULL),
(65, 'status_inventaris', '2', 'Belum diterima', NULL),
(64, 'status_inventaris', '1', 'Diterima', NULL),
(63, 'status_pengadaan', '4', 'Sudah Diterima', NULL),
(62, 'status_pengadaan', '3', 'Dalam proses', NULL),
(61, 'status_pengadaan', '2', 'Pembelian', NULL),
(60, 'status_pengadaan', '1', 'Pengajuan', NULL),
(59, 'komponen', '12', 'BUMD/PT/Yayasan', NULL),
(58, 'komponen', '11', 'Pemerintah Daerah Provinsi Jakarta', NULL),
(57, 'komponen', '10', 'DDN', NULL),
(56, 'komponen', '09', 'DDN', NULL),
(55, 'komponen', '08', 'DDN', NULL),
(54, 'komponen', '07', 'DDN', NULL),
(53, 'komponen', '06', 'DDN', NULL),
(52, 'komponen', '05', 'DDN', NULL),
(51, 'komponen', '04', 'DDN', NULL),
(50, 'komponen', '03', 'DDN', NULL),
(49, 'komponen', '02', 'DDN', NULL),
(48, 'komponen', '01', 'DDN', NULL),
(47, 'komponen', '00', 'Pemerintah Pusat', NULL),
(80, 'status_hak', '4', 'Swadaya', NULL),
(81, 'status_hak', '5', 'Hak Guna Bangunan', NULL),
(82, 'status_hak', '6', 'Hak Pengelolaan', NULL),
(83, 'status_hak', '7', 'Wakaf', NULL),
(84, 'status_hak', '8', 'Hak Lainnya', NULL),
(85, 'status_hak', '9', 'Lain-lain', NULL),
(86, 'keadaan_barang', 'B', 'Baik', NULL),
(87, 'keadaan_barang', 'KB', 'Kurang Baik', NULL),
(88, 'keadaan_barang', 'RR', 'Rusak Ringan', NULL),
(89, 'keadaan_barang', 'RB', 'Rusak Berat', NULL),
(90, 'status_barang', '0', 'Belum diterima', NULL),
(91, 'status_barang', '1', 'Diterima', NULL),
(92, 'status_barang', '2', 'Dihapus', NULL),
(93, 'asal_usul', '1', 'Pembangunan', NULL),
(94, 'asal_usul', '2', 'Pembelian / APBD', NULL),
(95, 'asal_usul', '3', 'Hibah', NULL),
(96, 'asal_usul', '4', 'Guna Usaha', NULL),
(97, 'asal_usul', '5', 'Tukar Guling', NULL),
(98, 'asal_usul', '6', 'Ruislag', NULL),
(99, 'asal_usul', '7', 'BOP', NULL),
(100, 'asal_usul', '8', 'Asal Milik Adat', NULL),
(101, 'asal_usul', '9', 'Sekola', NULL),
(102, 'asal_usul', '10', 'Wakaf', NULL),
(103, 'asal_usul', '11', 'Sumbangan', NULL),
(104, 'asal_usul', '12', 'Swadaya', NULL),
(105, 'asal_usul', '13', 'Ex Kanwil', NULL),
(106, 'asal_usul', '14', 'Lain-lain', NULL),
(107, 'bahan', '1', 'Kayu', NULL),
(108, 'bahan', '2', 'Besi ', NULL),
(109, 'bahan', '3', 'Rotan', NULL),
(110, 'bahan', '4', 'Jok', NULL),
(111, 'bahan', '5', 'Plastik', NULL),
(112, 'bahan', '6', 'Gelas/Kaca/Beling', NULL),
(113, 'bahan', '7', 'Fiberglass', NULL),
(114, 'bahan', '8', 'Emas', NULL),
(115, 'bahan', '9', 'Intan', NULL),
(116, 'bahan', '10', 'Alumunium', NULL),
(117, 'bahan', '11', 'Tembaga', NULL),
(118, 'bahan', '12', 'Mika', NULL),
(119, 'bahan', '13', 'Kain', NULL),
(120, 'bahan', '14', 'Akrilik', NULL),
(121, 'bahan', '15', 'Kertas', NULL),
(122, 'bahan', '16', 'Batu', NULL),
(123, 'bahan', '17', 'Kanvas', NULL),
(124, 'bahan', '18', 'Benang', NULL),
(125, 'bahan', '19', 'Busa', NULL),
(126, 'bahan', '20', 'Kaolin', NULL),
(127, 'bahan', '21', 'Karet', NULL),
(128, 'bahan', '22', 'Karpet', NULL),
(129, 'bahan', '23', 'Kertas Foto', NULL),
(130, 'bahan', '24', 'Kulit', NULL),
(131, 'bahan', '25', 'Kuningan', NULL),
(132, 'bahan', '26', 'Logam ', NULL),
(133, 'bahan', '27', 'Perunggu', NULL),
(134, 'bahan', '28', 'Plakat', NULL),
(135, 'bahan', '29', 'Porselen', NULL),
(136, 'bahan', '30', 'Rapido', NULL),
(137, 'bahan', '31', 'Semen', NULL),
(138, 'bahan', '32', 'Tulang', NULL),
(139, 'bahan', '33', 'Wool', NULL),
(140, 'bahan', '34', 'Baja', NULL),
(141, 'bahan', '35', 'Keramik', NULL),
(142, 'bahan', '36', 'Kristal', NULL),
(143, 'bahan', '37', 'Bensin', NULL),
(144, 'bahan', '38', 'Marmer', NULL),
(145, 'bahan', '39', 'Melamin', NULL),
(146, 'bahan', '40', 'Metal', NULL),
(147, 'bahan', '41', 'Pasir', NULL),
(148, 'bahan', '42', 'Triplek', NULL),
(149, 'bahan', '43', 'Timah', NULL),
(150, 'bahan', '44', 'Seng', NULL),
(151, 'bahan', '45', 'Aspal', NULL),
(152, 'bahan', '46', 'Beton', NULL),
(153, 'bahan', '47', 'Beton Bertulang', NULL),
(154, 'bahan', '48', 'ConBlok', NULL),
(155, 'bahan', '49', 'Hotmix', NULL),
(156, 'bahan', '50', 'Pipa', NULL),
(157, 'bahan', '51', 'Kabel', NULL),
(158, 'bahan', '52', 'Campuran', NULL),
(159, 'bahan', '53', 'Lainnya', NULL),
(160, 'kons_tingkat', '0', 'Tidak Bertingkat', NULL),
(161, 'kons_tingkat', '-1', 'Bertingkat', NULL),
(162, 'kons_tingkat', '1', 'Bertingkat 1 Lantai', NULL),
(163, 'kons_tingkat', '2', 'Bertingkat 2 Lantai', NULL),
(164, 'kons_tingkat', '3', 'Bertingkat 3 Lantai', NULL),
(165, 'kons_tingkat', '4', 'Bertingkat 4 Lantai', NULL),
(166, 'kons_tingkat', '5', 'Bertingkat 5 Lantai', NULL),
(167, 'kons_tingkat', '6', 'Bertingkat 6 Lantai', NULL),
(168, 'kons_tingkat', '7', 'Bertingkat 7 Lantai', NULL),
(169, 'kons_beton', '0', 'Bukan Beton', NULL),
(170, 'kons_beton', '1', 'Beton', NULL),
(171, 'kons_beton', '2', 'Campuran', NULL),
(172, 'penggunaan', '1', 'Kantor/Gedung Puskesmas', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mst_inv_pilihan`
--
ALTER TABLE `mst_inv_pilihan`
  ADD PRIMARY KEY (`id_pilihan`),
  ADD UNIQUE KEY `NewIndex1` (`tipe`,`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mst_inv_pilihan`
--
ALTER TABLE `mst_inv_pilihan`
  MODIFY `id_pilihan` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=173;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
