/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50624
Source Host           : 127.0.0.1:3306
Source Database       : epus_org_3172100

Target Server Type    : MYSQL
Target Server Version : 50624
File Encoding         : 65001

Date: 2015-11-06 09:30:15
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for keu_anggaran
-- ----------------------------
DROP TABLE IF EXISTS `keu_anggaran`;
CREATE TABLE `keu_anggaran` (
  `id_anggaran` int(11) NOT NULL AUTO_INCREMENT,
  `sub_id` int(11) DEFAULT NULL,
  `kode_rekening` varchar(35) DEFAULT NULL,
  `kode_anggaran` varchar(35) DEFAULT NULL,
  `uraian` varchar(200) DEFAULT NULL,
  `type` enum('kel','kec') DEFAULT NULL,
  PRIMARY KEY (`id_anggaran`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of keu_anggaran
-- ----------------------------
