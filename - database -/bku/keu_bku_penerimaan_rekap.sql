/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50624
Source Host           : 127.0.0.1:3306
Source Database       : epus_org_3172100

Target Server Type    : MYSQL
Target Server Version : 50624
File Encoding         : 65001

Date: 2015-11-19 10:46:06
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for keu_bku_penerimaan_rekap
-- ----------------------------
DROP TABLE IF EXISTS `keu_bku_penerimaan_rekap`;
CREATE TABLE `keu_bku_penerimaan_rekap` (
  `periode` varchar(255) NOT NULL,
  `total_pemasukan` int(11) DEFAULT NULL,
  `total_pengeluaran` int(11) DEFAULT NULL,
  `saldo` int(11) DEFAULT NULL,
  PRIMARY KEY (`periode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
