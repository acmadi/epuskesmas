/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50624
Source Host           : 127.0.0.1:3306
Source Database       : epus_org_3172100

Target Server Type    : MYSQL
Target Server Version : 50624
File Encoding         : 65001

Date: 2015-11-26 14:18:53
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for inv_inventaris_barang
-- ----------------------------
DROP TABLE IF EXISTS `inv_inventaris_barang`;
CREATE TABLE `inv_inventaris_barang` (
  `id_inventaris_barang` int(11) NOT NULL AUTO_INCREMENT,
  `id_mst_inv_barang` varchar(30) NOT NULL,
  `id_pengadaan` int(11) DEFAULT NULL COMMENT 'opsional',
  `pilihan_keadaan_barang` varchar(10) DEFAULT 'B',
  `nama_barang` varchar(200) DEFAULT NULL,
  `pilihan_komponen` varchar(10) DEFAULT NULL COMMENT 'opsional',
  `harga` double(20,2) DEFAULT NULL,
  `keterangan_pengadaan` varchar(200) DEFAULT NULL COMMENT 'diisi saat pengadaan',
  `pilihan_status_invetaris` varchar(10) DEFAULT '1',
  `tanggal_pembelian` date DEFAULT NULL COMMENT 'untuk barang C dan A, Display : Tanggal Perolehan',
  `foto_barang` varchar(200) DEFAULT NULL,
  `barang_kembar_proc` varchar(50) DEFAULT NULL COMMENT 'id barang yang digroup, untuk Proses pengadaan',
  `keterangan_inventory` varchar(200) DEFAULT NULL COMMENT 'diisi pada saat inventory (Hanya ada di menu Inventory)',
  `tanggal_pengadaan` date DEFAULT NULL COMMENT 'Tanggal kapan barang mulai dilakukan pengadaan (Sumber dari data pengadaan)',
  `tanggal_diterima` date DEFAULT NULL,
  `tanggal_dihapus` date DEFAULT NULL,
  `alasan_penghapusan` varchar(200) DEFAULT NULL COMMENT 'JIka barang dihapus, form ini di Isi',
  `pilihan_asal` varchar(10) DEFAULT NULL,
  `waktu_dibuat` date DEFAULT NULL COMMENT 'by system',
  `terakhir_diubah` date DEFAULT NULL COMMENT 'by system',
  `status` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id_inventaris_barang`)
) ENGINE=MyISAM AUTO_INCREMENT=122 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of inv_inventaris_barang
-- ----------------------------
INSERT INTO `inv_inventaris_barang` VALUES ('121', '0101030102', '4', 'B', 'Kopi', null, '900.00', '-', '1', '2015-11-20', null, '0101030102013', null, '2015-11-20', '2015-11-19', null, null, null, null, null, '1');
INSERT INTO `inv_inventaris_barang` VALUES ('120', '0101030102', '4', 'B', 'Kopi', null, '900.00', '-', '1', '2015-11-20', null, '0101030102013', null, '2015-11-20', '2015-11-19', null, null, null, null, null, '1');
INSERT INTO `inv_inventaris_barang` VALUES ('119', '0101030102', '4', 'B', 'Kopi', null, '900.00', '-', '1', '2015-11-20', null, '0101030102013', null, '2015-11-20', '2015-11-19', null, null, null, null, null, '1');
INSERT INTO `inv_inventaris_barang` VALUES ('118', '0101030102', '4', 'B', 'Kopi', null, '900.00', '-', '1', '2015-11-20', null, '0101030102013', null, '2015-11-20', '2015-11-19', null, null, null, null, null, '1');
INSERT INTO `inv_inventaris_barang` VALUES ('117', '0101030102', '4', 'B', 'Kopi', null, '900.00', '-', '1', '2015-11-20', null, '0101030102013', null, '2015-11-20', '2015-11-19', null, null, null, null, null, '1');
INSERT INTO `inv_inventaris_barang` VALUES ('116', '0101030102', '4', 'B', 'Kopi', null, '900.00', '-', '1', '2015-11-20', null, '0101030102013', null, '2015-11-20', '2015-11-19', null, null, null, null, null, '1');
INSERT INTO `inv_inventaris_barang` VALUES ('115', '0101030102', '4', 'B', 'Kopi', null, '900.00', '-', '1', '2015-11-20', null, '0101030102013', null, '2015-11-20', '2015-11-19', null, null, null, null, null, '1');
INSERT INTO `inv_inventaris_barang` VALUES ('114', '0101030102', '4', 'B', 'Kopi', null, '900.00', '-', '1', '2015-11-20', null, '0101030102013', null, '2015-11-20', '2015-11-19', null, null, null, null, null, '1');
INSERT INTO `inv_inventaris_barang` VALUES ('113', '0101030102', '4', 'B', 'Kopi', null, '900.00', '-', '1', '2015-11-20', null, '0101030102013', null, '2015-11-20', '2015-11-19', null, null, null, null, null, '1');
INSERT INTO `inv_inventaris_barang` VALUES ('112', '0101030102', '4', 'B', 'Kopi', null, '900.00', '-', '1', '2015-11-20', null, '0101030102013', null, '2015-11-20', '2015-11-19', null, null, null, null, null, '1');
INSERT INTO `inv_inventaris_barang` VALUES ('111', '0101030102', '4', 'B', 'Kopi', null, '2200.00', '-', '1', '2015-11-20', null, '0101030102012', null, '2015-11-20', '2015-11-19', null, null, null, null, null, '1');
INSERT INTO `inv_inventaris_barang` VALUES ('110', '0101030102', '4', 'B', 'Kopi', null, '2200.00', '-', '1', '2015-11-20', null, '0101030102012', null, '2015-11-20', '2015-11-19', null, null, null, null, null, '1');
INSERT INTO `inv_inventaris_barang` VALUES ('109', '0101030102', '4', 'B', 'Kopi', null, '2200.00', '-', '1', '2015-11-20', null, '0101030102012', null, '2015-11-20', '2015-11-19', null, null, null, null, null, '1');
INSERT INTO `inv_inventaris_barang` VALUES ('108', '0101030102', '4', 'B', 'Kopi', null, '2200.00', '-', '1', '2015-11-20', null, '0101030102012', null, '2015-11-20', '2015-11-19', null, null, null, null, null, '1');
INSERT INTO `inv_inventaris_barang` VALUES ('107', '0101030102', '4', 'B', 'Kopi', null, '2200.00', '-', '1', '2015-11-20', null, '0101030102012', null, '2015-11-20', '2015-11-19', null, null, null, null, null, '1');
INSERT INTO `inv_inventaris_barang` VALUES ('106', '0101030102', '4', 'B', 'Kopi', null, '2200.00', '-', '1', '2015-11-20', null, '0101030102012', null, '2015-11-20', '2015-11-19', null, null, null, null, null, '1');
INSERT INTO `inv_inventaris_barang` VALUES ('105', '0101030102', '4', 'B', 'Kopi', null, '2200.00', '-', '1', '2015-11-20', null, '0101030102012', null, '2015-11-20', '2015-11-19', null, null, null, null, null, '1');
INSERT INTO `inv_inventaris_barang` VALUES ('104', '0101030102', '4', 'B', 'Kopi', null, '2200.00', '-', '1', '2015-11-20', null, '0101030102012', null, '2015-11-20', '2015-11-19', null, null, null, null, null, '1');
