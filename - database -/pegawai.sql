/*
SQLyog Enterprise - MySQL GUI v8.1 
MySQL - 5.6.11 : Database - epus_org_3172100
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `pegawai` */

DROP TABLE IF EXISTS `pegawai`;

CREATE TABLE `pegawai` (
  `nip_nit` varchar(30) NOT NULL,
  `nip_lama` varchar(30) DEFAULT NULL,
  `nip_baru` varchar(30) DEFAULT NULL,
  `nrk` varchar(20) DEFAULT NULL,
  `karpeg` varchar(20) DEFAULT NULL,
  `nit` varchar(20) DEFAULT NULL,
  `nit_phl` varchar(20) DEFAULT NULL,
  `gelar` varchar(10) DEFAULT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `tar_sex` enum('L','P') DEFAULT NULL,
  `tgl_lhr` date DEFAULT NULL,
  `tmp_lahir` varchar(50) DEFAULT NULL,
  `kode_mst_agama` int(11) DEFAULT NULL,
  `kode_mst_nikah` int(11) DEFAULT NULL,
  `tar_npwp` varchar(30) DEFAULT NULL,
  `tar_npwp_tgl` date DEFAULT NULL,
  `ktp` varchar(50) DEFAULT NULL,
  `goldar` enum('A','B','AB','O') DEFAULT NULL,
  `code_cl_phc` varchar(12) DEFAULT NULL,
  `status_masuk` enum('pns','nonpns') DEFAULT NULL,
  PRIMARY KEY (`nip_nit`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
