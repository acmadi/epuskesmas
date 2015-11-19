/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50624
Source Host           : 127.0.0.1:3306
Source Database       : epus_org_3172100

Target Server Type    : MYSQL
Target Server Version : 50624
File Encoding         : 65001

Date: 2015-11-19 10:46:11
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for keu_bku_rekap_rekening
-- ----------------------------
DROP TABLE IF EXISTS `keu_bku_rekap_rekening`;
CREATE TABLE `keu_bku_rekap_rekening` (
  `periode` varchar(255) DEFAULT NULL,
  `code_mst_keu_kode_rekening` varchar(255) DEFAULT NULL,
  `jumlah` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
