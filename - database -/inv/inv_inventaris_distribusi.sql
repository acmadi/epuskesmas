/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50624
Source Host           : 127.0.0.1:3306
Source Database       : epus_org_3172100

Target Server Type    : MYSQL
Target Server Version : 50624
File Encoding         : 65001

Date: 2015-11-26 14:19:01
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for inv_inventaris_distribusi
-- ----------------------------
DROP TABLE IF EXISTS `inv_inventaris_distribusi`;
CREATE TABLE `inv_inventaris_distribusi` (
  `id_inventaris_distribusi` int(11) NOT NULL,
  `id_inventaris_barang` int(11) NOT NULL,
  `register` varchar(11) DEFAULT NULL,
  `id_cl_phc` char(12) DEFAULT NULL,
  `id_ruangan` int(11) DEFAULT NULL,
  `barang_kembar_inv` varchar(50) DEFAULT NULL,
  `tgl_distribusi` date DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id_inventaris_distribusi`,`id_inventaris_barang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of inv_inventaris_distribusi
-- ----------------------------
INSERT INTO `inv_inventaris_distribusi` VALUES ('1', '121', '0001', 'P3172100201', '2', '0101030102013', '2015-11-26', '1');
INSERT INTO `inv_inventaris_distribusi` VALUES ('1', '120', '0002', 'P3172100201', '2', '0101030102013', '2015-11-26', '0');
INSERT INTO `inv_inventaris_distribusi` VALUES ('1', '119', '0001', 'P3172100102', '3', '0101030102013', '2015-11-26', '1');
INSERT INTO `inv_inventaris_distribusi` VALUES ('1', '118', '0002', 'P3172100102', '3', '0101030102013', '2015-11-26', '0');
INSERT INTO `inv_inventaris_distribusi` VALUES ('2', '118', '0001', 'P3172100206', '1', '0101030102013', '2015-11-26', '1');
INSERT INTO `inv_inventaris_distribusi` VALUES ('1', '117', '0002', 'P3172100103', '1', '0101030102013', '2015-11-26', '1');
INSERT INTO `inv_inventaris_distribusi` VALUES ('1', '116', '0003', 'P3172100204', '1', '0101030102013', '2015-11-26', '1');
INSERT INTO `inv_inventaris_distribusi` VALUES ('1', '115', '0004', 'P3172100204', '1', '0101030102013', '2015-11-26', '0');
INSERT INTO `inv_inventaris_distribusi` VALUES ('2', '115', '0004', 'P3172100205', '1', '0101030102013', '2015-11-26', '1');
INSERT INTO `inv_inventaris_distribusi` VALUES ('2', '120', '0003', 'P3172100103', '1', '0101030102013', '2015-11-26', '1');
