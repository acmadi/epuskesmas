/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50624
Source Host           : 127.0.0.1:3306
Source Database       : epus_org_3172100

Target Server Type    : MYSQL
Target Server Version : 50624
File Encoding         : 65001

Date: 2015-11-19 10:45:58
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for keu_bku_penerimaan
-- ----------------------------
DROP TABLE IF EXISTS `keu_bku_penerimaan`;
CREATE TABLE `keu_bku_penerimaan` (
  `id_bku` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `uraian` varchar(255) DEFAULT NULL,
  `kode_rekening` varchar(255) DEFAULT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `penerimaan` int(11) DEFAULT NULL,
  `pengeluaran` int(11) DEFAULT NULL,
  `tgl_keu_sts` date DEFAULT NULL,
  `code_cl_phc_keu_sts` varchar(255) DEFAULT NULL,
  `is_bku` tinyint(4) DEFAULT '0',
  `is_setor` varchar(255) DEFAULT '0',
  PRIMARY KEY (`tgl`,`id_bku`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
