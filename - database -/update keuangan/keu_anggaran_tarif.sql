/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50624
Source Host           : 127.0.0.1:3306
Source Database       : epus_org_3172100

Target Server Type    : MYSQL
Target Server Version : 50624
File Encoding         : 65001

Date: 2015-11-06 09:30:28
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for keu_anggaran_tarif
-- ----------------------------
DROP TABLE IF EXISTS `keu_anggaran_tarif`;
CREATE TABLE `keu_anggaran_tarif` (
  `id` int(11) NOT NULL,
  `id_keu_anggaran` int(11) DEFAULT NULL,
  `tarif` double(10,2) DEFAULT NULL,
  `code_cl_phc` char(11) NOT NULL,
  PRIMARY KEY (`id`,`code_cl_phc`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of keu_anggaran_tarif
-- ----------------------------
