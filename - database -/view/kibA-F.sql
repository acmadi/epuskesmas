/*
SQLyog Enterprise - MySQL GUI v8.1 
MySQL - 5.6.26 : Database - epus_org_3172100
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`epus_org_3172100` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `epus_org_3172100`;

/*Table structure for table `get_all_inventaris` */

DROP TABLE IF EXISTS `get_all_inventaris`;

/*!50001 DROP VIEW IF EXISTS `get_all_inventaris` */;
/*!50001 DROP TABLE IF EXISTS `get_all_inventaris` */;

/*!50001 CREATE TABLE `get_all_inventaris` (
  `id_ruangan` int(11) DEFAULT NULL,
  `id_cl_phc` char(12) DEFAULT NULL,
  `register` int(11) DEFAULT NULL,
  `value` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `id_inventaris_barang` int(11) NOT NULL DEFAULT '0',
  `id_mst_inv_barang` varchar(30) NOT NULL DEFAULT '',
  `id_pengadaan` int(11) DEFAULT NULL,
  `pilihan_keadaan_barang` varchar(10) DEFAULT NULL,
  `nama_barang` varchar(200) DEFAULT NULL,
  `pilihan_komponen` varchar(10) DEFAULT NULL,
  `harga` double(10,2) DEFAULT NULL,
  `keterangan_pengadaan` varchar(200) DEFAULT NULL,
  `pilihan_status_invetaris` varchar(10) DEFAULT NULL,
  `tanggal_pembelian` date DEFAULT NULL,
  `foto_barang` varchar(200) DEFAULT NULL,
  `barang_kembar_proc` varchar(50) DEFAULT NULL,
  `keterangan_inventory` varchar(200) DEFAULT NULL,
  `tanggal_pengadaan` date DEFAULT NULL,
  `tanggal_diterima` date DEFAULT NULL,
  `tanggal_dihapus` date DEFAULT NULL,
  `alasan_penghapusan` varchar(200) DEFAULT NULL,
  `pilihan_asal` varchar(10) DEFAULT NULL,
  `waktu_dibuat` date DEFAULT NULL,
  `terakhir_diubah` date DEFAULT NULL,
  `jumlah` bigint(21) NOT NULL DEFAULT '0',
  `totalharga` double(19,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 */;

/*Table structure for table `kiba` */

DROP TABLE IF EXISTS `kiba`;

/*!50001 DROP VIEW IF EXISTS `kiba` */;
/*!50001 DROP TABLE IF EXISTS `kiba` */;

/*!50001 CREATE TABLE `kiba` (
  `asal_usul` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `keterangan_pengadaan` varchar(200) DEFAULT NULL,
  `id_ruangan` int(11) DEFAULT NULL,
  `harga` double(10,2) DEFAULT NULL,
  `id_cl_phc` char(12) DEFAULT NULL,
  `register` int(11) DEFAULT NULL,
  `pilihan_status_invetaris` varchar(10) DEFAULT NULL,
  `uraian` varchar(200) DEFAULT NULL,
  `satuan` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `hak` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `penggunaan` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `barang_kembar_proc` varchar(50) DEFAULT NULL,
  `id_pengadaan` int(11) DEFAULT NULL,
  `id_inventaris_barang` int(11) NOT NULL DEFAULT '0',
  `id_mst_inv_barang` varchar(30) NOT NULL DEFAULT '',
  `luas` double(10,2) DEFAULT NULL,
  `alamat` text,
  `pilihan_satuan_barang` varchar(10) DEFAULT NULL,
  `pilihan_status_hak` varchar(10) DEFAULT NULL,
  `status_sertifikat_tanggal` date DEFAULT NULL,
  `status_sertifikat_nomor` varchar(50) DEFAULT NULL,
  `pilihan_penggunaan` varchar(10) DEFAULT NULL,
  `jumlah` bigint(21) NOT NULL DEFAULT '0',
  `totalharga` double(19,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 */;

/*Table structure for table `kibb` */

DROP TABLE IF EXISTS `kibb`;

/*!50001 DROP VIEW IF EXISTS `kibb` */;
/*!50001 DROP TABLE IF EXISTS `kibb` */;

/*!50001 CREATE TABLE `kibb` (
  `asal_usul` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `keterangan_pengadaan` varchar(200) DEFAULT NULL,
  `keadaan_barang` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `id_ruangan` int(11) DEFAULT NULL,
  `harga` double(10,2) DEFAULT NULL,
  `id_cl_phc` char(12) DEFAULT NULL,
  `register` int(11) DEFAULT NULL,
  `pilihan_status_invetaris` varchar(10) DEFAULT NULL,
  `uraian` varchar(200) DEFAULT NULL,
  `satuan` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `bahan` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `barang_kembar_proc` varchar(50) DEFAULT NULL,
  `id_pengadaan` int(11) DEFAULT NULL,
  `id_inventaris_barang` int(11) NOT NULL DEFAULT '0',
  `id_mst_inv_barang` varchar(30) NOT NULL DEFAULT '',
  `merek_type` text,
  `identitas_barang` text,
  `pilihan_bahan` varchar(10) DEFAULT NULL,
  `ukuran_barang` varchar(100) DEFAULT NULL,
  `pilihan_satuan` varchar(10) DEFAULT NULL,
  `tanggal_bpkb` date DEFAULT NULL,
  `nomor_bpkb` varchar(100) DEFAULT NULL,
  `no_polisi` varchar(100) DEFAULT NULL,
  `tanggal_perolehan` date DEFAULT NULL,
  `jumlah` bigint(21) NOT NULL DEFAULT '0',
  `totalharga` double(19,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 */;

/*Table structure for table `kibc` */

DROP TABLE IF EXISTS `kibc`;

/*!50001 DROP VIEW IF EXISTS `kibc` */;
/*!50001 DROP TABLE IF EXISTS `kibc` */;

/*!50001 CREATE TABLE `kibc` (
  `asal_usul` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `keterangan_pengadaan` varchar(200) DEFAULT NULL,
  `keadaan_barang` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `id_ruangan` int(11) DEFAULT NULL,
  `harga` double(10,2) DEFAULT NULL,
  `id_cl_phc` char(12) DEFAULT NULL,
  `register` int(11) DEFAULT NULL,
  `pilihan_status_invetaris` varchar(10) DEFAULT NULL,
  `uraian` varchar(200) DEFAULT NULL,
  `hak` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `tingkat` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `beton` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `barang_kembar_proc` varchar(50) DEFAULT NULL,
  `id_pengadaan` int(11) DEFAULT NULL,
  `id_inventaris_barang` int(11) NOT NULL DEFAULT '0',
  `id_mst_inv_barang` varchar(30) NOT NULL DEFAULT '',
  `luas_lantai` double(10,2) DEFAULT NULL,
  `letak_lokasi_alamat` text,
  `pillihan_status_hak` varchar(10) DEFAULT NULL,
  `nomor_kode_tanah` varchar(100) DEFAULT NULL,
  `pilihan_kons_tingkat` varchar(10) DEFAULT NULL,
  `pilihan_kons_beton` varchar(10) DEFAULT NULL,
  `dokumen_tanggal` date DEFAULT NULL,
  `dokumen_nomor` varchar(100) DEFAULT NULL,
  `jumlah` bigint(21) NOT NULL DEFAULT '0',
  `totalharga` double(19,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 */;

/*Table structure for table `kibd` */

DROP TABLE IF EXISTS `kibd`;

/*!50001 DROP VIEW IF EXISTS `kibd` */;
/*!50001 DROP TABLE IF EXISTS `kibd` */;

/*!50001 CREATE TABLE `kibd` (
  `asal_usul` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `keterangan_pengadaan` varchar(200) DEFAULT NULL,
  `keadaan_barang` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `id_ruangan` int(11) DEFAULT NULL,
  `harga` double(10,2) DEFAULT NULL,
  `id_cl_phc` char(12) DEFAULT NULL,
  `register` int(11) DEFAULT NULL,
  `pilihan_status_invetaris` varchar(10) DEFAULT NULL,
  `uraian` varchar(200) DEFAULT NULL,
  `tanah` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `barang_kembar_proc` varchar(50) DEFAULT NULL,
  `id_pengadaan` int(11) DEFAULT NULL,
  `id_inventaris_barang` int(11) NOT NULL DEFAULT '0',
  `id_mst_inv_barang` varchar(30) NOT NULL DEFAULT '',
  `konstruksi` text,
  `panjang` double(10,2) DEFAULT NULL,
  `lebar` double(10,2) DEFAULT NULL,
  `luas` double(10,2) DEFAULT NULL,
  `letak_lokasi_alamat` text,
  `dokumen_tanggal` date DEFAULT NULL,
  `dokumen_nomor` varchar(100) DEFAULT NULL,
  `pilihan_status_tanah` varchar(10) DEFAULT NULL,
  `nomor_kode_tanah` varchar(100) DEFAULT NULL,
  `jumlah` bigint(21) NOT NULL DEFAULT '0',
  `totalharga` double(19,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 */;

/*Table structure for table `kibe` */

DROP TABLE IF EXISTS `kibe`;

/*!50001 DROP VIEW IF EXISTS `kibe` */;
/*!50001 DROP TABLE IF EXISTS `kibe` */;

/*!50001 CREATE TABLE `kibe` (
  `asal_usul` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `keterangan_pengadaan` varchar(200) DEFAULT NULL,
  `keadaan_barang` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `id_ruangan` int(11) DEFAULT NULL,
  `harga` double(10,2) DEFAULT NULL,
  `id_cl_phc` char(12) DEFAULT NULL,
  `register` int(11) DEFAULT NULL,
  `pilihan_status_invetaris` varchar(10) DEFAULT NULL,
  `uraian` varchar(200) DEFAULT NULL,
  `bahan` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `satuan` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `barang_kembar_proc` varchar(50) DEFAULT NULL,
  `id_pengadaan` int(11) DEFAULT NULL,
  `id_inventaris_barang` int(11) NOT NULL DEFAULT '0',
  `id_mst_inv_barang` varchar(30) NOT NULL DEFAULT '',
  `buku_judul_pencipta` varchar(200) DEFAULT NULL,
  `buku_spesifikasi` text,
  `budaya_asal_daerah` varchar(200) DEFAULT NULL,
  `budaya_pencipta` varchar(200) DEFAULT NULL,
  `pilihan_budaya_bahan` varchar(10) DEFAULT NULL,
  `flora_fauna_jenis` varchar(200) DEFAULT NULL,
  `flora_fauna_ukuran` varchar(200) DEFAULT NULL,
  `pilihan_satuan` varchar(10) DEFAULT NULL,
  `tahun_cetak_beli` date DEFAULT NULL,
  `jumlah` bigint(21) NOT NULL DEFAULT '0',
  `totalharga` double(19,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 */;

/*Table structure for table `kibf` */

DROP TABLE IF EXISTS `kibf`;

/*!50001 DROP VIEW IF EXISTS `kibf` */;
/*!50001 DROP TABLE IF EXISTS `kibf` */;

/*!50001 CREATE TABLE `kibf` (
  `asal_usul` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `keterangan_pengadaan` varchar(200) DEFAULT NULL,
  `keadaan_barang` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `id_ruangan` int(11) DEFAULT NULL,
  `harga` double(10,2) DEFAULT NULL,
  `id_cl_phc` char(12) DEFAULT NULL,
  `register` int(11) DEFAULT NULL,
  `pilihan_status_invetaris` varchar(10) DEFAULT NULL,
  `uraian` varchar(200) DEFAULT NULL,
  `tingkat` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `beton` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `tanah` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `barang_kembar_proc` varchar(50) DEFAULT NULL,
  `id_pengadaan` int(11) DEFAULT NULL,
  `id_inventaris_barang` int(11) NOT NULL DEFAULT '0',
  `id_mst_inv_barang` varchar(30) NOT NULL DEFAULT '',
  `bangunan` varchar(200) DEFAULT NULL,
  `pilihan_konstruksi_bertingkat` varchar(10) DEFAULT NULL,
  `pilihan_konstruksi_beton` varchar(10) DEFAULT NULL,
  `luas` varchar(200) DEFAULT NULL,
  `lokasi` text,
  `dokumen_tanggal` date DEFAULT NULL,
  `dokumen_nomor` varchar(200) DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `pilihan_status_tanah` varchar(10) DEFAULT NULL,
  `jumlah` bigint(21) NOT NULL DEFAULT '0',
  `totalharga` double(19,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 */;

/*View structure for view get_all_inventaris */

/*!50001 DROP TABLE IF EXISTS `get_all_inventaris` */;
/*!50001 DROP VIEW IF EXISTS `get_all_inventaris` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `get_all_inventaris` AS (select `inv_inventaris_distribusi`.`id_ruangan` AS `id_ruangan`,`inv_inventaris_distribusi`.`id_cl_phc` AS `id_cl_phc`,`inv_inventaris_distribusi`.`register` AS `register`,`mst_inv_pilihan`.`value` AS `value`,`inv_inventaris_barang`.`id_inventaris_barang` AS `id_inventaris_barang`,`inv_inventaris_barang`.`id_mst_inv_barang` AS `id_mst_inv_barang`,`inv_inventaris_barang`.`id_pengadaan` AS `id_pengadaan`,`inv_inventaris_barang`.`pilihan_keadaan_barang` AS `pilihan_keadaan_barang`,`inv_inventaris_barang`.`nama_barang` AS `nama_barang`,`inv_inventaris_barang`.`pilihan_komponen` AS `pilihan_komponen`,`inv_inventaris_barang`.`harga` AS `harga`,`inv_inventaris_barang`.`keterangan_pengadaan` AS `keterangan_pengadaan`,`inv_inventaris_barang`.`pilihan_status_invetaris` AS `pilihan_status_invetaris`,`inv_inventaris_barang`.`tanggal_pembelian` AS `tanggal_pembelian`,`inv_inventaris_barang`.`foto_barang` AS `foto_barang`,`inv_inventaris_barang`.`barang_kembar_proc` AS `barang_kembar_proc`,`inv_inventaris_barang`.`keterangan_inventory` AS `keterangan_inventory`,`inv_inventaris_barang`.`tanggal_pengadaan` AS `tanggal_pengadaan`,`inv_inventaris_barang`.`tanggal_diterima` AS `tanggal_diterima`,`inv_inventaris_barang`.`tanggal_dihapus` AS `tanggal_dihapus`,`inv_inventaris_barang`.`alasan_penghapusan` AS `alasan_penghapusan`,`inv_inventaris_barang`.`pilihan_asal` AS `pilihan_asal`,`inv_inventaris_barang`.`waktu_dibuat` AS `waktu_dibuat`,`inv_inventaris_barang`.`terakhir_diubah` AS `terakhir_diubah`,count(`inv_inventaris_barang`.`id_inventaris_barang`) AS `jumlah`,sum(`inv_inventaris_barang`.`harga`) AS `totalharga` from ((`inv_inventaris_barang` join `mst_inv_pilihan` on(((convert(`inv_inventaris_barang`.`pilihan_status_invetaris` using utf8) = `mst_inv_pilihan`.`code`) and (`mst_inv_pilihan`.`tipe` = 'status_inventaris')))) left join `inv_inventaris_distribusi` on((`inv_inventaris_barang`.`id_inventaris_barang` = `inv_inventaris_distribusi`.`id_inventaris_barang`))) where (`inv_inventaris_barang`.`id_pengadaan` = 0) group by `inv_inventaris_barang`.`barang_kembar_proc`) union (select `inv_inventaris_distribusi`.`id_ruangan` AS `id_ruangan`,`inv_inventaris_distribusi`.`id_cl_phc` AS `id_cl_phc`,`inv_inventaris_distribusi`.`register` AS `register`,`mst_inv_pilihan`.`value` AS `value`,`inv_inventaris_barang`.`id_inventaris_barang` AS `id_inventaris_barang`,`inv_inventaris_barang`.`id_mst_inv_barang` AS `id_mst_inv_barang`,`inv_inventaris_barang`.`id_pengadaan` AS `id_pengadaan`,`inv_inventaris_barang`.`pilihan_keadaan_barang` AS `pilihan_keadaan_barang`,`inv_inventaris_barang`.`nama_barang` AS `nama_barang`,`inv_inventaris_barang`.`pilihan_komponen` AS `pilihan_komponen`,`inv_inventaris_barang`.`harga` AS `harga`,`inv_inventaris_barang`.`keterangan_pengadaan` AS `keterangan_pengadaan`,`inv_inventaris_barang`.`pilihan_status_invetaris` AS `pilihan_status_invetaris`,`inv_inventaris_barang`.`tanggal_pembelian` AS `tanggal_pembelian`,`inv_inventaris_barang`.`foto_barang` AS `foto_barang`,`inv_inventaris_barang`.`barang_kembar_proc` AS `barang_kembar_proc`,`inv_inventaris_barang`.`keterangan_inventory` AS `keterangan_inventory`,`inv_inventaris_barang`.`tanggal_pengadaan` AS `tanggal_pengadaan`,`inv_inventaris_barang`.`tanggal_diterima` AS `tanggal_diterima`,`inv_inventaris_barang`.`tanggal_dihapus` AS `tanggal_dihapus`,`inv_inventaris_barang`.`alasan_penghapusan` AS `alasan_penghapusan`,`inv_inventaris_barang`.`pilihan_asal` AS `pilihan_asal`,`inv_inventaris_barang`.`waktu_dibuat` AS `waktu_dibuat`,`inv_inventaris_barang`.`terakhir_diubah` AS `terakhir_diubah`,count(`inv_inventaris_barang`.`id_inventaris_barang`) AS `jumlah`,sum(`inv_inventaris_barang`.`harga`) AS `totalharga` from (((`inv_inventaris_barang` join `inv_pengadaan` on(((`inv_pengadaan`.`id_pengadaan` = `inv_inventaris_barang`.`id_pengadaan`) and (`inv_pengadaan`.`pilihan_status_pengadaan` = 4)))) join `mst_inv_pilihan` on(((convert(`inv_inventaris_barang`.`pilihan_status_invetaris` using utf8) = `mst_inv_pilihan`.`code`) and (`mst_inv_pilihan`.`tipe` = 'status_inventaris')))) left join `inv_inventaris_distribusi` on((`inv_inventaris_barang`.`id_inventaris_barang` = `inv_inventaris_distribusi`.`id_inventaris_barang`))) group by `inv_inventaris_barang`.`barang_kembar_proc`) */;

/*View structure for view kiba */

/*!50001 DROP TABLE IF EXISTS `kiba` */;
/*!50001 DROP VIEW IF EXISTS `kiba` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kiba` AS (select `asal_usul`.`value` AS `asal_usul`,`inv_inventaris_barang`.`keterangan_pengadaan` AS `keterangan_pengadaan`,`inv_inventaris_distribusi`.`id_ruangan` AS `id_ruangan`,`inv_inventaris_barang`.`harga` AS `harga`,`inv_inventaris_distribusi`.`id_cl_phc` AS `id_cl_phc`,`inv_inventaris_distribusi`.`register` AS `register`,`inv_inventaris_barang`.`pilihan_status_invetaris` AS `pilihan_status_invetaris`,`mst_inv_barang`.`uraian` AS `uraian`,`satuan`.`value` AS `satuan`,`hak`.`value` AS `hak`,`penggunaan`.`value` AS `penggunaan`,`inv_inventaris_barang`.`barang_kembar_proc` AS `barang_kembar_proc`,`inv_inventaris_barang`.`id_pengadaan` AS `id_pengadaan`,`inv_inventaris_barang_a`.`id_inventaris_barang` AS `id_inventaris_barang`,`inv_inventaris_barang_a`.`id_mst_inv_barang` AS `id_mst_inv_barang`,`inv_inventaris_barang_a`.`luas` AS `luas`,`inv_inventaris_barang_a`.`alamat` AS `alamat`,`inv_inventaris_barang_a`.`pilihan_satuan_barang` AS `pilihan_satuan_barang`,`inv_inventaris_barang_a`.`pilihan_status_hak` AS `pilihan_status_hak`,`inv_inventaris_barang_a`.`status_sertifikat_tanggal` AS `status_sertifikat_tanggal`,`inv_inventaris_barang_a`.`status_sertifikat_nomor` AS `status_sertifikat_nomor`,`inv_inventaris_barang_a`.`pilihan_penggunaan` AS `pilihan_penggunaan`,count(`inv_inventaris_barang`.`id_inventaris_barang`) AS `jumlah`,sum(`inv_inventaris_barang`.`harga`) AS `totalharga` from (((((((`inv_inventaris_barang_a` join `inv_inventaris_barang` on(((`inv_inventaris_barang`.`id_inventaris_barang` = `inv_inventaris_barang_a`.`id_inventaris_barang`) and (`inv_inventaris_barang`.`id_mst_inv_barang` = `inv_inventaris_barang_a`.`id_mst_inv_barang`)))) join `mst_inv_barang` on((`mst_inv_barang`.`code` = `inv_inventaris_barang_a`.`id_mst_inv_barang`))) left join `mst_inv_pilihan` `satuan` on(((convert(`inv_inventaris_barang_a`.`pilihan_satuan_barang` using utf8) = `satuan`.`code`) and (`satuan`.`tipe` = 'satuan')))) left join `mst_inv_pilihan` `hak` on(((convert(`inv_inventaris_barang_a`.`pilihan_status_hak` using utf8) = `hak`.`code`) and (`hak`.`tipe` = 'status_hak')))) left join `mst_inv_pilihan` `penggunaan` on(((convert(`inv_inventaris_barang_a`.`pilihan_penggunaan` using utf8) = `penggunaan`.`code`) and (`penggunaan`.`tipe` = 'penggunaan')))) left join `mst_inv_pilihan` `asal_usul` on(((convert(`inv_inventaris_barang`.`pilihan_asal` using utf8) = `asal_usul`.`code`) and (`asal_usul`.`tipe` = 'asal_usul')))) left join `inv_inventaris_distribusi` on((`inv_inventaris_barang`.`id_inventaris_barang` = `inv_inventaris_distribusi`.`id_inventaris_barang`))) where (`inv_inventaris_barang`.`id_pengadaan` = 0) group by `inv_inventaris_barang`.`barang_kembar_proc`) union (select `asal_usul`.`value` AS `asal_usul`,`inv_inventaris_barang`.`keterangan_pengadaan` AS `keterangan_pengadaan`,`inv_inventaris_distribusi`.`id_ruangan` AS `id_ruangan`,`inv_inventaris_barang`.`harga` AS `harga`,`inv_inventaris_distribusi`.`id_cl_phc` AS `id_cl_phc`,`inv_inventaris_distribusi`.`register` AS `register`,`inv_inventaris_barang`.`pilihan_status_invetaris` AS `pilihan_status_invetaris`,`mst_inv_barang`.`uraian` AS `uraian`,`satuan`.`value` AS `satuan`,`hak`.`value` AS `hak`,`penggunaan`.`value` AS `penggunaan`,`inv_inventaris_barang`.`barang_kembar_proc` AS `barang_kembar_proc`,`inv_inventaris_barang`.`id_pengadaan` AS `id_pengadaan`,`inv_inventaris_barang_a`.`id_inventaris_barang` AS `id_inventaris_barang`,`inv_inventaris_barang_a`.`id_mst_inv_barang` AS `id_mst_inv_barang`,`inv_inventaris_barang_a`.`luas` AS `luas`,`inv_inventaris_barang_a`.`alamat` AS `alamat`,`inv_inventaris_barang_a`.`pilihan_satuan_barang` AS `pilihan_satuan_barang`,`inv_inventaris_barang_a`.`pilihan_status_hak` AS `pilihan_status_hak`,`inv_inventaris_barang_a`.`status_sertifikat_tanggal` AS `status_sertifikat_tanggal`,`inv_inventaris_barang_a`.`status_sertifikat_nomor` AS `status_sertifikat_nomor`,`inv_inventaris_barang_a`.`pilihan_penggunaan` AS `pilihan_penggunaan`,count(`inv_inventaris_barang`.`id_inventaris_barang`) AS `jumlah`,sum(`inv_inventaris_barang`.`harga`) AS `totalharga` from ((((((((`inv_inventaris_barang_a` join `inv_inventaris_barang` on(((`inv_inventaris_barang`.`id_inventaris_barang` = `inv_inventaris_barang_a`.`id_inventaris_barang`) and (`inv_inventaris_barang`.`id_mst_inv_barang` = `inv_inventaris_barang_a`.`id_mst_inv_barang`)))) join `mst_inv_barang` on((`mst_inv_barang`.`code` = `inv_inventaris_barang_a`.`id_mst_inv_barang`))) left join `mst_inv_pilihan` `satuan` on(((convert(`inv_inventaris_barang_a`.`pilihan_satuan_barang` using utf8) = `satuan`.`code`) and (`satuan`.`tipe` = 'satuan')))) left join `mst_inv_pilihan` `hak` on(((convert(`inv_inventaris_barang_a`.`pilihan_status_hak` using utf8) = `hak`.`code`) and (`hak`.`tipe` = 'status_hak')))) left join `mst_inv_pilihan` `penggunaan` on(((convert(`inv_inventaris_barang_a`.`pilihan_penggunaan` using utf8) = `penggunaan`.`code`) and (`penggunaan`.`tipe` = 'penggunaan')))) left join `mst_inv_pilihan` `asal_usul` on(((convert(`inv_inventaris_barang`.`pilihan_asal` using utf8) = `asal_usul`.`code`) and (`asal_usul`.`tipe` = 'asal_usul')))) join `inv_pengadaan` on(((`inv_pengadaan`.`id_pengadaan` = `inv_inventaris_barang`.`id_pengadaan`) and (`inv_pengadaan`.`pilihan_status_pengadaan` = 4)))) left join `inv_inventaris_distribusi` on((`inv_inventaris_barang`.`id_inventaris_barang` = `inv_inventaris_distribusi`.`id_inventaris_barang`))) group by `inv_inventaris_barang`.`barang_kembar_proc`) */;

/*View structure for view kibb */

/*!50001 DROP TABLE IF EXISTS `kibb` */;
/*!50001 DROP VIEW IF EXISTS `kibb` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kibb` AS (select `asal_usul`.`value` AS `asal_usul`,`inv_inventaris_barang`.`keterangan_pengadaan` AS `keterangan_pengadaan`,`keadaan_barang`.`value` AS `keadaan_barang`,`inv_inventaris_distribusi`.`id_ruangan` AS `id_ruangan`,`inv_inventaris_barang`.`harga` AS `harga`,`inv_inventaris_distribusi`.`id_cl_phc` AS `id_cl_phc`,`inv_inventaris_distribusi`.`register` AS `register`,`inv_inventaris_barang`.`pilihan_status_invetaris` AS `pilihan_status_invetaris`,`mst_inv_barang`.`uraian` AS `uraian`,`satuan`.`value` AS `satuan`,`bahan`.`value` AS `bahan`,`inv_inventaris_barang`.`barang_kembar_proc` AS `barang_kembar_proc`,`inv_inventaris_barang`.`id_pengadaan` AS `id_pengadaan`,`inv_inventaris_barang_b`.`id_inventaris_barang` AS `id_inventaris_barang`,`inv_inventaris_barang_b`.`id_mst_inv_barang` AS `id_mst_inv_barang`,`inv_inventaris_barang_b`.`merek_type` AS `merek_type`,`inv_inventaris_barang_b`.`identitas_barang` AS `identitas_barang`,`inv_inventaris_barang_b`.`pilihan_bahan` AS `pilihan_bahan`,`inv_inventaris_barang_b`.`ukuran_barang` AS `ukuran_barang`,`inv_inventaris_barang_b`.`pilihan_satuan` AS `pilihan_satuan`,`inv_inventaris_barang_b`.`tanggal_bpkb` AS `tanggal_bpkb`,`inv_inventaris_barang_b`.`nomor_bpkb` AS `nomor_bpkb`,`inv_inventaris_barang_b`.`no_polisi` AS `no_polisi`,`inv_inventaris_barang_b`.`tanggal_perolehan` AS `tanggal_perolehan`,count(`inv_inventaris_barang`.`id_inventaris_barang`) AS `jumlah`,sum(`inv_inventaris_barang`.`harga`) AS `totalharga` from (((((((`inv_inventaris_barang_b` join `inv_inventaris_barang` on(((`inv_inventaris_barang`.`id_inventaris_barang` = `inv_inventaris_barang_b`.`id_inventaris_barang`) and (`inv_inventaris_barang`.`id_mst_inv_barang` = `inv_inventaris_barang_b`.`id_mst_inv_barang`)))) join `mst_inv_barang` on((`mst_inv_barang`.`code` = `inv_inventaris_barang_b`.`id_mst_inv_barang`))) left join `mst_inv_pilihan` `satuan` on(((convert(`inv_inventaris_barang_b`.`pilihan_satuan` using utf8) = `satuan`.`code`) and (`satuan`.`tipe` = 'satuan')))) left join `mst_inv_pilihan` `bahan` on(((convert(`inv_inventaris_barang_b`.`pilihan_bahan` using utf8) = `bahan`.`code`) and (`bahan`.`tipe` = 'bahan')))) left join `mst_inv_pilihan` `asal_usul` on(((convert(`inv_inventaris_barang`.`pilihan_asal` using utf8) = `asal_usul`.`code`) and (`asal_usul`.`tipe` = 'asal_usul')))) left join `mst_inv_pilihan` `keadaan_barang` on(((convert(`inv_inventaris_barang`.`pilihan_keadaan_barang` using utf8) = `keadaan_barang`.`code`) and (`keadaan_barang`.`tipe` = 'keadaan_barang')))) left join `inv_inventaris_distribusi` on((`inv_inventaris_barang`.`id_inventaris_barang` = `inv_inventaris_distribusi`.`id_inventaris_barang`))) where (`inv_inventaris_barang`.`id_pengadaan` = 0) group by `inv_inventaris_barang`.`barang_kembar_proc`) union (select `asal_usul`.`value` AS `asal_usul`,`inv_inventaris_barang`.`keterangan_pengadaan` AS `keterangan_pengadaan`,`keadaan_barang`.`value` AS `keadaan_barang`,`inv_inventaris_distribusi`.`id_ruangan` AS `id_ruangan`,`inv_inventaris_barang`.`harga` AS `harga`,`inv_inventaris_distribusi`.`id_cl_phc` AS `id_cl_phc`,`inv_inventaris_distribusi`.`register` AS `register`,`inv_inventaris_barang`.`pilihan_status_invetaris` AS `pilihan_status_invetaris`,`mst_inv_barang`.`uraian` AS `uraian`,`satuan`.`value` AS `satuan`,`bahan`.`value` AS `bahan`,`inv_inventaris_barang`.`barang_kembar_proc` AS `barang_kembar_proc`,`inv_inventaris_barang`.`id_pengadaan` AS `id_pengadaan`,`inv_inventaris_barang_b`.`id_inventaris_barang` AS `id_inventaris_barang`,`inv_inventaris_barang_b`.`id_mst_inv_barang` AS `id_mst_inv_barang`,`inv_inventaris_barang_b`.`merek_type` AS `merek_type`,`inv_inventaris_barang_b`.`identitas_barang` AS `identitas_barang`,`inv_inventaris_barang_b`.`pilihan_bahan` AS `pilihan_bahan`,`inv_inventaris_barang_b`.`ukuran_barang` AS `ukuran_barang`,`inv_inventaris_barang_b`.`pilihan_satuan` AS `pilihan_satuan`,`inv_inventaris_barang_b`.`tanggal_bpkb` AS `tanggal_bpkb`,`inv_inventaris_barang_b`.`nomor_bpkb` AS `nomor_bpkb`,`inv_inventaris_barang_b`.`no_polisi` AS `no_polisi`,`inv_inventaris_barang_b`.`tanggal_perolehan` AS `tanggal_perolehan`,count(`inv_inventaris_barang`.`id_inventaris_barang`) AS `jumlah`,sum(`inv_inventaris_barang`.`harga`) AS `totalharga` from ((((((((`inv_inventaris_barang_b` join `inv_inventaris_barang` on(((`inv_inventaris_barang`.`id_inventaris_barang` = `inv_inventaris_barang_b`.`id_inventaris_barang`) and (`inv_inventaris_barang`.`id_mst_inv_barang` = `inv_inventaris_barang_b`.`id_mst_inv_barang`)))) join `mst_inv_barang` on((`mst_inv_barang`.`code` = `inv_inventaris_barang_b`.`id_mst_inv_barang`))) left join `mst_inv_pilihan` `satuan` on(((convert(`inv_inventaris_barang_b`.`pilihan_satuan` using utf8) = `satuan`.`code`) and (`satuan`.`tipe` = 'satuan')))) left join `mst_inv_pilihan` `bahan` on(((convert(`inv_inventaris_barang_b`.`pilihan_bahan` using utf8) = `bahan`.`code`) and (`bahan`.`tipe` = 'bahan')))) left join `inv_pengadaan` on(((`inv_pengadaan`.`id_pengadaan` = `inv_inventaris_barang`.`id_pengadaan`) and (`inv_pengadaan`.`pilihan_status_pengadaan` = 4)))) left join `mst_inv_pilihan` `asal_usul` on(((convert(`inv_inventaris_barang`.`pilihan_asal` using utf8) = `asal_usul`.`code`) and (`asal_usul`.`tipe` = 'asal_usul')))) left join `mst_inv_pilihan` `keadaan_barang` on(((convert(`inv_inventaris_barang`.`pilihan_keadaan_barang` using utf8) = `keadaan_barang`.`code`) and (`keadaan_barang`.`tipe` = 'keadaan_barang')))) left join `inv_inventaris_distribusi` on((`inv_inventaris_barang`.`id_inventaris_barang` = `inv_inventaris_distribusi`.`id_inventaris_barang`))) group by `inv_inventaris_barang`.`barang_kembar_proc`) */;

/*View structure for view kibc */

/*!50001 DROP TABLE IF EXISTS `kibc` */;
/*!50001 DROP VIEW IF EXISTS `kibc` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kibc` AS (select `asal_usul`.`value` AS `asal_usul`,`inv_inventaris_barang`.`keterangan_pengadaan` AS `keterangan_pengadaan`,`keadaan_barang`.`value` AS `keadaan_barang`,`inv_inventaris_distribusi`.`id_ruangan` AS `id_ruangan`,`inv_inventaris_barang`.`harga` AS `harga`,`inv_inventaris_distribusi`.`id_cl_phc` AS `id_cl_phc`,`inv_inventaris_distribusi`.`register` AS `register`,`inv_inventaris_barang`.`pilihan_status_invetaris` AS `pilihan_status_invetaris`,`mst_inv_barang`.`uraian` AS `uraian`,`hak`.`value` AS `hak`,`tingkat`.`value` AS `tingkat`,`beton`.`value` AS `beton`,`inv_inventaris_barang`.`barang_kembar_proc` AS `barang_kembar_proc`,`inv_inventaris_barang`.`id_pengadaan` AS `id_pengadaan`,`inv_inventaris_barang_c`.`id_inventaris_barang` AS `id_inventaris_barang`,`inv_inventaris_barang_c`.`id_mst_inv_barang` AS `id_mst_inv_barang`,`inv_inventaris_barang_c`.`luas_lantai` AS `luas_lantai`,`inv_inventaris_barang_c`.`letak_lokasi_alamat` AS `letak_lokasi_alamat`,`inv_inventaris_barang_c`.`pillihan_status_hak` AS `pillihan_status_hak`,`inv_inventaris_barang_c`.`nomor_kode_tanah` AS `nomor_kode_tanah`,`inv_inventaris_barang_c`.`pilihan_kons_tingkat` AS `pilihan_kons_tingkat`,`inv_inventaris_barang_c`.`pilihan_kons_beton` AS `pilihan_kons_beton`,`inv_inventaris_barang_c`.`dokumen_tanggal` AS `dokumen_tanggal`,`inv_inventaris_barang_c`.`dokumen_nomor` AS `dokumen_nomor`,count(`inv_inventaris_barang`.`id_inventaris_barang`) AS `jumlah`,sum(`inv_inventaris_barang`.`harga`) AS `totalharga` from ((((((((`inv_inventaris_barang_c` join `inv_inventaris_barang` on(((`inv_inventaris_barang`.`id_inventaris_barang` = `inv_inventaris_barang_c`.`id_inventaris_barang`) and (`inv_inventaris_barang`.`id_mst_inv_barang` = `inv_inventaris_barang_c`.`id_mst_inv_barang`)))) join `mst_inv_barang` on((`mst_inv_barang`.`code` = `inv_inventaris_barang_c`.`id_mst_inv_barang`))) left join `mst_inv_pilihan` `hak` on(((convert(`inv_inventaris_barang_c`.`pillihan_status_hak` using utf8) = `hak`.`code`) and (`hak`.`tipe` = 'status_hak')))) left join `mst_inv_pilihan` `tingkat` on(((convert(`inv_inventaris_barang_c`.`pillihan_status_hak` using utf8) = `tingkat`.`code`) and (`tingkat`.`tipe` = 'kons_tingkat')))) left join `mst_inv_pilihan` `beton` on(((convert(`inv_inventaris_barang_c`.`pilihan_kons_beton` using utf8) = `beton`.`code`) and (`beton`.`tipe` = 'kons_beton')))) left join `mst_inv_pilihan` `asal_usul` on(((convert(`inv_inventaris_barang`.`pilihan_asal` using utf8) = `asal_usul`.`code`) and (`asal_usul`.`tipe` = 'asal_usul')))) left join `mst_inv_pilihan` `keadaan_barang` on(((convert(`inv_inventaris_barang`.`pilihan_keadaan_barang` using utf8) = `keadaan_barang`.`code`) and (`keadaan_barang`.`tipe` = 'keadaan_barang')))) left join `inv_inventaris_distribusi` on((`inv_inventaris_barang`.`id_inventaris_barang` = `inv_inventaris_distribusi`.`id_inventaris_barang`))) where (`inv_inventaris_barang`.`id_pengadaan` = 0) group by `inv_inventaris_barang`.`barang_kembar_proc`) union (select `asal_usul`.`value` AS `asal_usul`,`inv_inventaris_barang`.`keterangan_pengadaan` AS `keterangan_pengadaan`,`keadaan_barang`.`value` AS `keadaan_barang`,`inv_inventaris_distribusi`.`id_ruangan` AS `id_ruangan`,`inv_inventaris_barang`.`harga` AS `harga`,`inv_inventaris_distribusi`.`id_cl_phc` AS `id_cl_phc`,`inv_inventaris_distribusi`.`register` AS `register`,`inv_inventaris_barang`.`pilihan_status_invetaris` AS `pilihan_status_invetaris`,`mst_inv_barang`.`uraian` AS `uraian`,`hak`.`value` AS `hak`,`tingkat`.`value` AS `tingkat`,`beton`.`value` AS `beton`,`inv_inventaris_barang`.`barang_kembar_proc` AS `barang_kembar_proc`,`inv_inventaris_barang`.`id_pengadaan` AS `id_pengadaan`,`inv_inventaris_barang_c`.`id_inventaris_barang` AS `id_inventaris_barang`,`inv_inventaris_barang_c`.`id_mst_inv_barang` AS `id_mst_inv_barang`,`inv_inventaris_barang_c`.`luas_lantai` AS `luas_lantai`,`inv_inventaris_barang_c`.`letak_lokasi_alamat` AS `letak_lokasi_alamat`,`inv_inventaris_barang_c`.`pillihan_status_hak` AS `pillihan_status_hak`,`inv_inventaris_barang_c`.`nomor_kode_tanah` AS `nomor_kode_tanah`,`inv_inventaris_barang_c`.`pilihan_kons_tingkat` AS `pilihan_kons_tingkat`,`inv_inventaris_barang_c`.`pilihan_kons_beton` AS `pilihan_kons_beton`,`inv_inventaris_barang_c`.`dokumen_tanggal` AS `dokumen_tanggal`,`inv_inventaris_barang_c`.`dokumen_nomor` AS `dokumen_nomor`,count(`inv_inventaris_barang`.`id_inventaris_barang`) AS `jumlah`,sum(`inv_inventaris_barang`.`harga`) AS `totalharga` from (((((((((`inv_inventaris_barang_c` join `inv_inventaris_barang` on(((`inv_inventaris_barang`.`id_inventaris_barang` = `inv_inventaris_barang_c`.`id_inventaris_barang`) and (`inv_inventaris_barang`.`id_mst_inv_barang` = `inv_inventaris_barang_c`.`id_mst_inv_barang`)))) join `mst_inv_barang` on((`mst_inv_barang`.`code` = `inv_inventaris_barang_c`.`id_mst_inv_barang`))) left join `mst_inv_pilihan` `hak` on(((convert(`inv_inventaris_barang_c`.`pillihan_status_hak` using utf8) = `hak`.`code`) and (`hak`.`tipe` = 'status_hak')))) left join `mst_inv_pilihan` `tingkat` on(((convert(`inv_inventaris_barang_c`.`pilihan_kons_tingkat` using utf8) = `tingkat`.`code`) and (`tingkat`.`tipe` = 'kons_tingkat')))) left join `mst_inv_pilihan` `beton` on(((convert(`inv_inventaris_barang_c`.`pilihan_kons_beton` using utf8) = `beton`.`code`) and (`beton`.`tipe` = 'kons_beton')))) left join `mst_inv_pilihan` `asal_usul` on(((convert(`inv_inventaris_barang`.`pilihan_asal` using utf8) = `asal_usul`.`code`) and (`asal_usul`.`tipe` = 'asal_usul')))) left join `mst_inv_pilihan` `keadaan_barang` on(((convert(`inv_inventaris_barang`.`pilihan_keadaan_barang` using utf8) = `keadaan_barang`.`code`) and (`keadaan_barang`.`tipe` = 'keadaan_barang')))) join `inv_pengadaan` on(((`inv_pengadaan`.`id_pengadaan` = `inv_inventaris_barang`.`id_pengadaan`) and (`inv_pengadaan`.`pilihan_status_pengadaan` = 4)))) left join `inv_inventaris_distribusi` on((`inv_inventaris_barang`.`id_inventaris_barang` = `inv_inventaris_distribusi`.`id_inventaris_barang`))) group by `inv_inventaris_barang`.`barang_kembar_proc`) */;

/*View structure for view kibd */

/*!50001 DROP TABLE IF EXISTS `kibd` */;
/*!50001 DROP VIEW IF EXISTS `kibd` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kibd` AS (select `asal_usul`.`value` AS `asal_usul`,`inv_inventaris_barang`.`keterangan_pengadaan` AS `keterangan_pengadaan`,`keadaan_barang`.`value` AS `keadaan_barang`,`inv_inventaris_distribusi`.`id_ruangan` AS `id_ruangan`,`inv_inventaris_barang`.`harga` AS `harga`,`inv_inventaris_distribusi`.`id_cl_phc` AS `id_cl_phc`,`inv_inventaris_distribusi`.`register` AS `register`,`inv_inventaris_barang`.`pilihan_status_invetaris` AS `pilihan_status_invetaris`,`mst_inv_barang`.`uraian` AS `uraian`,`tanah`.`value` AS `tanah`,`inv_inventaris_barang`.`barang_kembar_proc` AS `barang_kembar_proc`,`inv_inventaris_barang`.`id_pengadaan` AS `id_pengadaan`,`inv_inventaris_barang_d`.`id_inventaris_barang` AS `id_inventaris_barang`,`inv_inventaris_barang_d`.`id_mst_inv_barang` AS `id_mst_inv_barang`,`inv_inventaris_barang_d`.`konstruksi` AS `konstruksi`,`inv_inventaris_barang_d`.`panjang` AS `panjang`,`inv_inventaris_barang_d`.`lebar` AS `lebar`,`inv_inventaris_barang_d`.`luas` AS `luas`,`inv_inventaris_barang_d`.`letak_lokasi_alamat` AS `letak_lokasi_alamat`,`inv_inventaris_barang_d`.`dokumen_tanggal` AS `dokumen_tanggal`,`inv_inventaris_barang_d`.`dokumen_nomor` AS `dokumen_nomor`,`inv_inventaris_barang_d`.`pilihan_status_tanah` AS `pilihan_status_tanah`,`inv_inventaris_barang_d`.`nomor_kode_tanah` AS `nomor_kode_tanah`,count(`inv_inventaris_barang`.`id_inventaris_barang`) AS `jumlah`,sum(`inv_inventaris_barang`.`harga`) AS `totalharga` from ((((((`inv_inventaris_barang_d` join `inv_inventaris_barang` on(((`inv_inventaris_barang`.`id_inventaris_barang` = `inv_inventaris_barang_d`.`id_inventaris_barang`) and (`inv_inventaris_barang`.`id_mst_inv_barang` = `inv_inventaris_barang_d`.`id_mst_inv_barang`)))) join `mst_inv_barang` on((`mst_inv_barang`.`code` = `inv_inventaris_barang_d`.`id_mst_inv_barang`))) left join `mst_inv_pilihan` `tanah` on(((convert(`inv_inventaris_barang_d`.`pilihan_status_tanah` using utf8) = `tanah`.`code`) and (`tanah`.`tipe` = 'status_hak')))) left join `mst_inv_pilihan` `asal_usul` on(((convert(`inv_inventaris_barang`.`pilihan_asal` using utf8) = `asal_usul`.`code`) and (`asal_usul`.`tipe` = 'asal_usul')))) left join `mst_inv_pilihan` `keadaan_barang` on(((convert(`inv_inventaris_barang`.`pilihan_keadaan_barang` using utf8) = `keadaan_barang`.`code`) and (`keadaan_barang`.`tipe` = 'keadaan_barang')))) left join `inv_inventaris_distribusi` on((`inv_inventaris_barang`.`id_inventaris_barang` = `inv_inventaris_distribusi`.`id_inventaris_barang`))) where (`inv_inventaris_barang`.`id_pengadaan` = 0) group by `inv_inventaris_barang`.`barang_kembar_proc`) union (select `asal_usul`.`value` AS `asal_usul`,`inv_inventaris_barang`.`keterangan_pengadaan` AS `keterangan_pengadaan`,`keadaan_barang`.`value` AS `keadaan_barang`,`inv_inventaris_distribusi`.`id_ruangan` AS `id_ruangan`,`inv_inventaris_barang`.`harga` AS `harga`,`inv_inventaris_distribusi`.`id_cl_phc` AS `id_cl_phc`,`inv_inventaris_distribusi`.`register` AS `register`,`inv_inventaris_barang`.`pilihan_status_invetaris` AS `pilihan_status_invetaris`,`mst_inv_barang`.`uraian` AS `uraian`,`tanah`.`value` AS `tanah`,`inv_inventaris_barang`.`barang_kembar_proc` AS `barang_kembar_proc`,`inv_inventaris_barang`.`id_pengadaan` AS `id_pengadaan`,`inv_inventaris_barang_d`.`id_inventaris_barang` AS `id_inventaris_barang`,`inv_inventaris_barang_d`.`id_mst_inv_barang` AS `id_mst_inv_barang`,`inv_inventaris_barang_d`.`konstruksi` AS `konstruksi`,`inv_inventaris_barang_d`.`panjang` AS `panjang`,`inv_inventaris_barang_d`.`lebar` AS `lebar`,`inv_inventaris_barang_d`.`luas` AS `luas`,`inv_inventaris_barang_d`.`letak_lokasi_alamat` AS `letak_lokasi_alamat`,`inv_inventaris_barang_d`.`dokumen_tanggal` AS `dokumen_tanggal`,`inv_inventaris_barang_d`.`dokumen_nomor` AS `dokumen_nomor`,`inv_inventaris_barang_d`.`pilihan_status_tanah` AS `pilihan_status_tanah`,`inv_inventaris_barang_d`.`nomor_kode_tanah` AS `nomor_kode_tanah`,count(`inv_inventaris_barang`.`id_inventaris_barang`) AS `jumlah`,sum(`inv_inventaris_barang`.`harga`) AS `totalharga` from (((((((`inv_inventaris_barang_d` join `inv_inventaris_barang` on(((`inv_inventaris_barang`.`id_inventaris_barang` = `inv_inventaris_barang_d`.`id_inventaris_barang`) and (`inv_inventaris_barang`.`id_mst_inv_barang` = `inv_inventaris_barang_d`.`id_mst_inv_barang`)))) join `mst_inv_barang` on((`mst_inv_barang`.`code` = `inv_inventaris_barang_d`.`id_mst_inv_barang`))) left join `mst_inv_pilihan` `tanah` on(((convert(`inv_inventaris_barang_d`.`pilihan_status_tanah` using utf8) = `tanah`.`code`) and (`tanah`.`tipe` = 'status_hak')))) left join `mst_inv_pilihan` `asal_usul` on(((convert(`inv_inventaris_barang`.`pilihan_asal` using utf8) = `asal_usul`.`code`) and (`asal_usul`.`tipe` = 'asal_usul')))) left join `mst_inv_pilihan` `keadaan_barang` on(((convert(`inv_inventaris_barang`.`pilihan_keadaan_barang` using utf8) = `keadaan_barang`.`code`) and (`keadaan_barang`.`tipe` = 'keadaan_barang')))) join `inv_pengadaan` on(((`inv_pengadaan`.`id_pengadaan` = `inv_inventaris_barang`.`id_pengadaan`) and (`inv_pengadaan`.`pilihan_status_pengadaan` = 4)))) left join `inv_inventaris_distribusi` on((`inv_inventaris_barang`.`id_inventaris_barang` = `inv_inventaris_distribusi`.`id_inventaris_barang`))) group by `inv_inventaris_barang`.`barang_kembar_proc`) */;

/*View structure for view kibe */

/*!50001 DROP TABLE IF EXISTS `kibe` */;
/*!50001 DROP VIEW IF EXISTS `kibe` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kibe` AS (select `asal_usul`.`value` AS `asal_usul`,`inv_inventaris_barang`.`keterangan_pengadaan` AS `keterangan_pengadaan`,`keadaan_barang`.`value` AS `keadaan_barang`,`inv_inventaris_distribusi`.`id_ruangan` AS `id_ruangan`,`inv_inventaris_barang`.`harga` AS `harga`,`inv_inventaris_distribusi`.`id_cl_phc` AS `id_cl_phc`,`inv_inventaris_distribusi`.`register` AS `register`,`inv_inventaris_barang`.`pilihan_status_invetaris` AS `pilihan_status_invetaris`,`mst_inv_barang`.`uraian` AS `uraian`,`bahan`.`value` AS `bahan`,`satuan`.`value` AS `satuan`,`inv_inventaris_barang`.`barang_kembar_proc` AS `barang_kembar_proc`,`inv_inventaris_barang`.`id_pengadaan` AS `id_pengadaan`,`inv_inventaris_barang_e`.`id_inventaris_barang` AS `id_inventaris_barang`,`inv_inventaris_barang_e`.`id_mst_inv_barang` AS `id_mst_inv_barang`,`inv_inventaris_barang_e`.`buku_judul_pencipta` AS `buku_judul_pencipta`,`inv_inventaris_barang_e`.`buku_spesifikasi` AS `buku_spesifikasi`,`inv_inventaris_barang_e`.`budaya_asal_daerah` AS `budaya_asal_daerah`,`inv_inventaris_barang_e`.`budaya_pencipta` AS `budaya_pencipta`,`inv_inventaris_barang_e`.`pilihan_budaya_bahan` AS `pilihan_budaya_bahan`,`inv_inventaris_barang_e`.`flora_fauna_jenis` AS `flora_fauna_jenis`,`inv_inventaris_barang_e`.`flora_fauna_ukuran` AS `flora_fauna_ukuran`,`inv_inventaris_barang_e`.`pilihan_satuan` AS `pilihan_satuan`,`inv_inventaris_barang_e`.`tahun_cetak_beli` AS `tahun_cetak_beli`,count(`inv_inventaris_barang`.`id_inventaris_barang`) AS `jumlah`,sum(`inv_inventaris_barang`.`harga`) AS `totalharga` from (((((((`inv_inventaris_barang_e` join `inv_inventaris_barang` on(((`inv_inventaris_barang`.`id_inventaris_barang` = `inv_inventaris_barang_e`.`id_inventaris_barang`) and (`inv_inventaris_barang`.`id_mst_inv_barang` = `inv_inventaris_barang_e`.`id_mst_inv_barang`)))) join `mst_inv_barang` on((`mst_inv_barang`.`code` = `inv_inventaris_barang_e`.`id_mst_inv_barang`))) left join `mst_inv_pilihan` `bahan` on(((convert(`inv_inventaris_barang_e`.`pilihan_budaya_bahan` using utf8) = `bahan`.`code`) and (`bahan`.`tipe` = 'bahan')))) left join `mst_inv_pilihan` `satuan` on(((convert(`inv_inventaris_barang_e`.`pilihan_satuan` using utf8) = `satuan`.`code`) and (`satuan`.`tipe` = 'satuan')))) left join `mst_inv_pilihan` `asal_usul` on(((convert(`inv_inventaris_barang`.`pilihan_asal` using utf8) = `asal_usul`.`code`) and (`asal_usul`.`tipe` = 'asal_usul')))) left join `mst_inv_pilihan` `keadaan_barang` on(((convert(`inv_inventaris_barang`.`pilihan_keadaan_barang` using utf8) = `keadaan_barang`.`code`) and (`keadaan_barang`.`tipe` = 'keadaan_barang')))) left join `inv_inventaris_distribusi` on((`inv_inventaris_barang`.`id_inventaris_barang` = `inv_inventaris_distribusi`.`id_inventaris_barang`))) where (`inv_inventaris_barang`.`id_pengadaan` = 0) group by `inv_inventaris_barang`.`barang_kembar_proc`) union (select `asal_usul`.`value` AS `asal_usul`,`inv_inventaris_barang`.`keterangan_pengadaan` AS `keterangan_pengadaan`,`keadaan_barang`.`value` AS `keadaan_barang`,`inv_inventaris_distribusi`.`id_ruangan` AS `id_ruangan`,`inv_inventaris_barang`.`harga` AS `harga`,`inv_inventaris_distribusi`.`id_cl_phc` AS `id_cl_phc`,`inv_inventaris_distribusi`.`register` AS `register`,`inv_inventaris_barang`.`pilihan_status_invetaris` AS `pilihan_status_invetaris`,`mst_inv_barang`.`uraian` AS `uraian`,`bahan`.`value` AS `bahan`,`satuan`.`value` AS `satuan`,`inv_inventaris_barang`.`barang_kembar_proc` AS `barang_kembar_proc`,`inv_inventaris_barang`.`id_pengadaan` AS `id_pengadaan`,`inv_inventaris_barang_e`.`id_inventaris_barang` AS `id_inventaris_barang`,`inv_inventaris_barang_e`.`id_mst_inv_barang` AS `id_mst_inv_barang`,`inv_inventaris_barang_e`.`buku_judul_pencipta` AS `buku_judul_pencipta`,`inv_inventaris_barang_e`.`buku_spesifikasi` AS `buku_spesifikasi`,`inv_inventaris_barang_e`.`budaya_asal_daerah` AS `budaya_asal_daerah`,`inv_inventaris_barang_e`.`budaya_pencipta` AS `budaya_pencipta`,`inv_inventaris_barang_e`.`pilihan_budaya_bahan` AS `pilihan_budaya_bahan`,`inv_inventaris_barang_e`.`flora_fauna_jenis` AS `flora_fauna_jenis`,`inv_inventaris_barang_e`.`flora_fauna_ukuran` AS `flora_fauna_ukuran`,`inv_inventaris_barang_e`.`pilihan_satuan` AS `pilihan_satuan`,`inv_inventaris_barang_e`.`tahun_cetak_beli` AS `tahun_cetak_beli`,count(`inv_inventaris_barang`.`id_inventaris_barang`) AS `jumlah`,sum(`inv_inventaris_barang`.`harga`) AS `totalharga` from ((((((((`inv_inventaris_barang_e` join `inv_inventaris_barang` on(((`inv_inventaris_barang`.`id_inventaris_barang` = `inv_inventaris_barang_e`.`id_inventaris_barang`) and (`inv_inventaris_barang`.`id_mst_inv_barang` = `inv_inventaris_barang_e`.`id_mst_inv_barang`)))) join `mst_inv_barang` on((`mst_inv_barang`.`code` = `inv_inventaris_barang_e`.`id_mst_inv_barang`))) left join `mst_inv_pilihan` `bahan` on(((convert(`inv_inventaris_barang_e`.`pilihan_budaya_bahan` using utf8) = `bahan`.`code`) and (`bahan`.`tipe` = 'bahan')))) left join `mst_inv_pilihan` `satuan` on(((convert(`inv_inventaris_barang_e`.`pilihan_satuan` using utf8) = `satuan`.`code`) and (`satuan`.`tipe` = 'satuan')))) left join `inv_pengadaan` on(((`inv_pengadaan`.`id_pengadaan` = `inv_inventaris_barang`.`id_pengadaan`) and (`inv_pengadaan`.`pilihan_status_pengadaan` = 4)))) left join `mst_inv_pilihan` `asal_usul` on(((convert(`inv_inventaris_barang`.`pilihan_asal` using utf8) = `asal_usul`.`code`) and (`asal_usul`.`tipe` = 'asal_usul')))) left join `mst_inv_pilihan` `keadaan_barang` on(((convert(`inv_inventaris_barang`.`pilihan_keadaan_barang` using utf8) = `keadaan_barang`.`code`) and (`keadaan_barang`.`tipe` = 'keadaan_barang')))) left join `inv_inventaris_distribusi` on((`inv_inventaris_barang`.`id_inventaris_barang` = `inv_inventaris_distribusi`.`id_inventaris_barang`))) group by `inv_inventaris_barang`.`barang_kembar_proc`) */;

/*View structure for view kibf */

/*!50001 DROP TABLE IF EXISTS `kibf` */;
/*!50001 DROP VIEW IF EXISTS `kibf` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `kibf` AS (select `asal_usul`.`value` AS `asal_usul`,`inv_inventaris_barang`.`keterangan_pengadaan` AS `keterangan_pengadaan`,`keadaan_barang`.`value` AS `keadaan_barang`,`inv_inventaris_distribusi`.`id_ruangan` AS `id_ruangan`,`inv_inventaris_barang`.`harga` AS `harga`,`inv_inventaris_distribusi`.`id_cl_phc` AS `id_cl_phc`,`inv_inventaris_distribusi`.`register` AS `register`,`inv_inventaris_barang`.`pilihan_status_invetaris` AS `pilihan_status_invetaris`,`mst_inv_barang`.`uraian` AS `uraian`,`tingkat`.`value` AS `tingkat`,`beton`.`value` AS `beton`,`tanah`.`value` AS `tanah`,`inv_inventaris_barang`.`barang_kembar_proc` AS `barang_kembar_proc`,`inv_inventaris_barang`.`id_pengadaan` AS `id_pengadaan`,`inv_inventaris_barang_f`.`id_inventaris_barang` AS `id_inventaris_barang`,`inv_inventaris_barang_f`.`id_mst_inv_barang` AS `id_mst_inv_barang`,`inv_inventaris_barang_f`.`bangunan` AS `bangunan`,`inv_inventaris_barang_f`.`pilihan_konstruksi_bertingkat` AS `pilihan_konstruksi_bertingkat`,`inv_inventaris_barang_f`.`pilihan_konstruksi_beton` AS `pilihan_konstruksi_beton`,`inv_inventaris_barang_f`.`luas` AS `luas`,`inv_inventaris_barang_f`.`lokasi` AS `lokasi`,`inv_inventaris_barang_f`.`dokumen_tanggal` AS `dokumen_tanggal`,`inv_inventaris_barang_f`.`dokumen_nomor` AS `dokumen_nomor`,`inv_inventaris_barang_f`.`tanggal_mulai` AS `tanggal_mulai`,`inv_inventaris_barang_f`.`pilihan_status_tanah` AS `pilihan_status_tanah`,count(`inv_inventaris_barang`.`id_inventaris_barang`) AS `jumlah`,sum(`inv_inventaris_barang`.`harga`) AS `totalharga` from ((((((((`inv_inventaris_barang_f` join `inv_inventaris_barang` on(((`inv_inventaris_barang`.`id_inventaris_barang` = `inv_inventaris_barang_f`.`id_inventaris_barang`) and (`inv_inventaris_barang`.`id_mst_inv_barang` = `inv_inventaris_barang_f`.`id_mst_inv_barang`)))) join `mst_inv_barang` on((`mst_inv_barang`.`code` = `inv_inventaris_barang_f`.`id_mst_inv_barang`))) left join `mst_inv_pilihan` `tingkat` on(((convert(`inv_inventaris_barang_f`.`pilihan_konstruksi_bertingkat` using utf8) = `tingkat`.`code`) and (`tingkat`.`tipe` = 'kons_tingkat')))) left join `mst_inv_pilihan` `beton` on(((convert(`inv_inventaris_barang_f`.`pilihan_konstruksi_beton` using utf8) = `beton`.`code`) and (`beton`.`tipe` = 'kons_beton')))) left join `mst_inv_pilihan` `tanah` on(((convert(`inv_inventaris_barang_f`.`pilihan_status_tanah` using utf8) = `tanah`.`code`) and (`tanah`.`tipe` = 'status_hak')))) left join `mst_inv_pilihan` `asal_usul` on(((convert(`inv_inventaris_barang`.`pilihan_asal` using utf8) = `asal_usul`.`code`) and (`asal_usul`.`tipe` = 'asal_usul')))) left join `mst_inv_pilihan` `keadaan_barang` on(((convert(`inv_inventaris_barang`.`pilihan_keadaan_barang` using utf8) = `keadaan_barang`.`code`) and (`keadaan_barang`.`tipe` = 'keadaan_barang')))) left join `inv_inventaris_distribusi` on((`inv_inventaris_barang`.`id_inventaris_barang` = `inv_inventaris_distribusi`.`id_inventaris_barang`))) where (`inv_inventaris_barang`.`id_pengadaan` = 0) group by `inv_inventaris_barang`.`barang_kembar_proc`) union (select `asal_usul`.`value` AS `asal_usul`,`inv_inventaris_barang`.`keterangan_pengadaan` AS `keterangan_pengadaan`,`keadaan_barang`.`value` AS `keadaan_barang`,`inv_inventaris_distribusi`.`id_ruangan` AS `id_ruangan`,`inv_inventaris_barang`.`harga` AS `harga`,`inv_inventaris_distribusi`.`id_cl_phc` AS `id_cl_phc`,`inv_inventaris_distribusi`.`register` AS `register`,`inv_inventaris_barang`.`pilihan_status_invetaris` AS `pilihan_status_invetaris`,`mst_inv_barang`.`uraian` AS `uraian`,`tingkat`.`value` AS `tingkat`,`beton`.`value` AS `beton`,`tanah`.`value` AS `tanah`,`inv_inventaris_barang`.`barang_kembar_proc` AS `barang_kembar_proc`,`inv_inventaris_barang`.`id_pengadaan` AS `id_pengadaan`,`inv_inventaris_barang_f`.`id_inventaris_barang` AS `id_inventaris_barang`,`inv_inventaris_barang_f`.`id_mst_inv_barang` AS `id_mst_inv_barang`,`inv_inventaris_barang_f`.`bangunan` AS `bangunan`,`inv_inventaris_barang_f`.`pilihan_konstruksi_bertingkat` AS `pilihan_konstruksi_bertingkat`,`inv_inventaris_barang_f`.`pilihan_konstruksi_beton` AS `pilihan_konstruksi_beton`,`inv_inventaris_barang_f`.`luas` AS `luas`,`inv_inventaris_barang_f`.`lokasi` AS `lokasi`,`inv_inventaris_barang_f`.`dokumen_tanggal` AS `dokumen_tanggal`,`inv_inventaris_barang_f`.`dokumen_nomor` AS `dokumen_nomor`,`inv_inventaris_barang_f`.`tanggal_mulai` AS `tanggal_mulai`,`inv_inventaris_barang_f`.`pilihan_status_tanah` AS `pilihan_status_tanah`,count(`inv_inventaris_barang`.`id_inventaris_barang`) AS `jumlah`,sum(`inv_inventaris_barang`.`harga`) AS `totalharga` from (((((((((`inv_inventaris_barang_f` join `inv_inventaris_barang` on(((`inv_inventaris_barang`.`id_inventaris_barang` = `inv_inventaris_barang_f`.`id_inventaris_barang`) and (`inv_inventaris_barang`.`id_mst_inv_barang` = `inv_inventaris_barang_f`.`id_mst_inv_barang`)))) join `mst_inv_barang` on((`mst_inv_barang`.`code` = `inv_inventaris_barang_f`.`id_mst_inv_barang`))) left join `mst_inv_pilihan` `tingkat` on(((convert(`inv_inventaris_barang_f`.`pilihan_konstruksi_bertingkat` using utf8) = `tingkat`.`code`) and (`tingkat`.`tipe` = 'kons_tingkat')))) left join `mst_inv_pilihan` `beton` on(((convert(`inv_inventaris_barang_f`.`pilihan_konstruksi_beton` using utf8) = `beton`.`code`) and (`beton`.`tipe` = 'kons_beton')))) left join `mst_inv_pilihan` `tanah` on(((convert(`inv_inventaris_barang_f`.`pilihan_status_tanah` using utf8) = `tanah`.`code`) and (`tanah`.`tipe` = 'status_hak')))) left join `mst_inv_pilihan` `asal_usul` on(((convert(`inv_inventaris_barang`.`pilihan_asal` using utf8) = `asal_usul`.`code`) and (`asal_usul`.`tipe` = 'asal_usul')))) left join `mst_inv_pilihan` `keadaan_barang` on(((convert(`inv_inventaris_barang`.`pilihan_keadaan_barang` using utf8) = `keadaan_barang`.`code`) and (`keadaan_barang`.`tipe` = 'keadaan_barang')))) join `inv_pengadaan` on(((`inv_pengadaan`.`id_pengadaan` = `inv_inventaris_barang`.`id_pengadaan`) and (`inv_pengadaan`.`pilihan_status_pengadaan` = 4)))) left join `inv_inventaris_distribusi` on((`inv_inventaris_barang`.`id_inventaris_barang` = `inv_inventaris_distribusi`.`id_inventaris_barang`))) group by `inv_inventaris_barang`.`barang_kembar_proc`) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
