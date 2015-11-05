/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50624
Source Host           : 127.0.0.1:3306
Source Database       : epus_org_3172100

Target Server Type    : MYSQL
Target Server Version : 50624
File Encoding         : 65001

Date: 2015-11-05 12:51:01
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for app_files
-- ----------------------------
DROP TABLE IF EXISTS `app_files`;
CREATE TABLE `app_files` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `lang` varchar(10) NOT NULL DEFAULT 'ina',
  `filename` varchar(100) NOT NULL,
  `module` varchar(100) DEFAULT NULL,
  `id_theme` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`,`lang`)
) ENGINE=MyISAM AUTO_INCREMENT=76 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of app_files
-- ----------------------------
INSERT INTO `app_files` VALUES ('1', 'ina', 'Home', 'disbun', '2');
INSERT INTO `app_files` VALUES ('3', 'ina', 'Permohonan', 'permohonan', '2');
INSERT INTO `app_files` VALUES ('2', 'en', 'Users', 'user', '2');
INSERT INTO `app_files` VALUES ('4', 'en', 'Pemeriksaan', 'pemeriksaan', '2');
INSERT INTO `app_files` VALUES ('3', 'en', 'Permohonan', 'permohonan', '2');
INSERT INTO `app_files` VALUES ('4', 'ina', 'Pemeriksaan', 'pemeriksaan', '2');
INSERT INTO `app_files` VALUES ('5', 'en', 'Sertifikat', 'sertifikat', '2');
INSERT INTO `app_files` VALUES ('5', 'ina', 'Sertifikat', 'sertifikat', '2');
INSERT INTO `app_files` VALUES ('6', 'ina', 'Master Data', 'prm', '2');
INSERT INTO `app_files` VALUES ('6', 'en', 'Master Data', 'prm', '2');
INSERT INTO `app_files` VALUES ('2', 'ina', 'Users', 'user', '2');
INSERT INTO `app_files` VALUES ('1', 'en', 'Home', 'disbun', '2');
INSERT INTO `app_files` VALUES ('31', 'ina', 'Admin', 'admin', '3');
INSERT INTO `app_files` VALUES ('31', 'en', 'Admin', 'admin', '3');
INSERT INTO `app_files` VALUES ('36', 'ina', 'Menu', 'admin_menu', '2');
INSERT INTO `app_files` VALUES ('36', 'en', 'Menu', 'admin_menu', '2');
INSERT INTO `app_files` VALUES ('37', 'ina', 'File', 'admin_file', '2');
INSERT INTO `app_files` VALUES ('37', 'en', 'Files', 'admin_file', '2');
INSERT INTO `app_files` VALUES ('38', 'ina', 'Hak Akses', 'admin_role', '2');
INSERT INTO `app_files` VALUES ('38', 'en', 'Role', 'admin_role', '2');
INSERT INTO `app_files` VALUES ('39', 'ina', 'Dashboard', '#', '2');
INSERT INTO `app_files` VALUES ('39', 'en', 'Dashboard', '#', '2');
INSERT INTO `app_files` VALUES ('40', 'ina', 'Profil', 'profile', '2');
INSERT INTO `app_files` VALUES ('40', 'en', 'Profile', 'profile', '2');
INSERT INTO `app_files` VALUES ('41', 'ina', 'Laporan', '#', '2');
INSERT INTO `app_files` VALUES ('41', 'en', 'Report', '#', '2');
INSERT INTO `app_files` VALUES ('42', 'ina', 'Daftar Produsen Benih', 'lap_penangkar', '2');
INSERT INTO `app_files` VALUES ('42', 'en', 'List of Seed Producers', 'lap_penangkar', '2');
INSERT INTO `app_files` VALUES ('43', 'ina', 'Rekapitulasi Sertifikasi', 'lap_rekap', '2');
INSERT INTO `app_files` VALUES ('43', 'en', 'Recapitulation Certification', 'lap_rekap', '2');
INSERT INTO `app_files` VALUES ('44', 'ina', 'Daftar Komoditi', 'lap_komoditi', '2');
INSERT INTO `app_files` VALUES ('44', 'en', 'Commodity List', 'lap_komoditi', '2');
INSERT INTO `app_files` VALUES ('45', 'ina', 'Charts', '#', '2');
INSERT INTO `app_files` VALUES ('45', 'en', 'Charts', '#', '2');
INSERT INTO `app_files` VALUES ('46', 'ina', 'Daerah Produsen Benih', 'chart_penangkar', '2');
INSERT INTO `app_files` VALUES ('46', 'en', 'Regional Seed Producers', 'chart_penangkar', '2');
INSERT INTO `app_files` VALUES ('47', 'ina', 'Rekapitulasi Sertifikat', 'chart_sert', '2');
INSERT INTO `app_files` VALUES ('47', 'en', 'Recapitulation Certificate', 'chart_sert', '2');
INSERT INTO `app_files` VALUES ('48', 'ina', 'Rekapitulasi Komoditi', 'chart_komd', '2');
INSERT INTO `app_files` VALUES ('48', 'en', 'Commodity recapitulation', 'chart_komd', '2');
INSERT INTO `app_files` VALUES ('49', 'ina', 'Admin Panel', '#', '2');
INSERT INTO `app_files` VALUES ('49', 'en', 'Admin Panel', '#', '2');
INSERT INTO `app_files` VALUES ('50', 'ina', 'Konfigurasi', 'config', '2');
INSERT INTO `app_files` VALUES ('50', 'en', 'Configuration', 'config', '2');
INSERT INTO `app_files` VALUES ('51', 'ina', 'Data Master', '#', '2');
INSERT INTO `app_files` VALUES ('51', 'en', 'Master Data', '#', '2');
INSERT INTO `app_files` VALUES ('52', 'ina', 'Puskesmas', 'mst/puskesmas', '2');
INSERT INTO `app_files` VALUES ('52', 'en', 'Puskesmas', 'mst/puskesmas', '2');
INSERT INTO `app_files` VALUES ('53', 'ina', 'Kepegawaian', '#', '2');
INSERT INTO `app_files` VALUES ('53', 'en', 'officialdom', '#', '2');
INSERT INTO `app_files` VALUES ('54', 'ina', 'Daftar Riwayat Hidup', '#', '2');
INSERT INTO `app_files` VALUES ('54', 'en', 'Curriculum Vitae', '#', '2');
INSERT INTO `app_files` VALUES ('55', 'ina', 'Keuangan', '#', '2');
INSERT INTO `app_files` VALUES ('55', 'en', 'Finansial', '#', '2');
INSERT INTO `app_files` VALUES ('56', 'ina', 'BKU', '#', '2');
INSERT INTO `app_files` VALUES ('56', 'en', 'BKU', '#', '2');
INSERT INTO `app_files` VALUES ('57', 'ina', 'Inventory', '#', '2');
INSERT INTO `app_files` VALUES ('57', 'en', 'Inventory', '#', '2');
INSERT INTO `app_files` VALUES ('58', 'ina', 'Aset', '#', '2');
INSERT INTO `app_files` VALUES ('58', 'en', 'Asset', '#', '2');
INSERT INTO `app_files` VALUES ('59', 'ina', 'SMS Gateway', '#', '2');
INSERT INTO `app_files` VALUES ('59', 'en', 'SMS Gateway', '#', '2');
INSERT INTO `app_files` VALUES ('60', 'ina', 'Dashboard', 'sms/home', '2');
INSERT INTO `app_files` VALUES ('60', 'en', 'Dashboard', 'sms/home', '2');
INSERT INTO `app_files` VALUES ('61', 'ina', 'Kotak Masuk', 'sms/inbox', '2');
INSERT INTO `app_files` VALUES ('61', 'en', 'Inbox', 'sms/inbox', '2');
INSERT INTO `app_files` VALUES ('62', 'ina', 'Buku Telepon', 'sms/pbk', '2');
INSERT INTO `app_files` VALUES ('62', 'en', 'Phonebook', 'sms/pbk', '2');
INSERT INTO `app_files` VALUES ('63', 'ina', 'Grup', 'sms/group', '2');
INSERT INTO `app_files` VALUES ('63', 'en', 'Group', 'sms/group', '2');
INSERT INTO `app_files` VALUES ('64', 'ina', 'Balas Otomatis', 'sms/autoreply', '2');
INSERT INTO `app_files` VALUES ('64', 'en', 'Autoreply', 'sms/autoreply', '2');
INSERT INTO `app_files` VALUES ('65', 'ina', 'Jadwal', 'sms/schedule', '2');
INSERT INTO `app_files` VALUES ('65', 'en', 'Schedule', 'sms/schedule', '2');
INSERT INTO `app_files` VALUES ('66', 'ina', 'Daftar Pegawai', 'lap_pegawai', '2');
INSERT INTO `app_files` VALUES ('66', 'en', '22', 'lap_pegawai', '2');
INSERT INTO `app_files` VALUES ('67', 'ina', 'Agama', 'mst/agama', '2');
INSERT INTO `app_files` VALUES ('67', 'en', 'Religion', 'mst/agama', '2');
INSERT INTO `app_files` VALUES ('68', 'ina', 'Desa / Kelurahan', 'mst/desa', '2');
INSERT INTO `app_files` VALUES ('68', 'en', 'Village / Sub', 'mst/desa', '2');
INSERT INTO `app_files` VALUES ('69', 'ina', 'Kota / Kabupaten', 'mst/kabupatenkota', '2');
INSERT INTO `app_files` VALUES ('69', 'en', 'City / County', 'mst/kabupatenkota', '2');
INSERT INTO `app_files` VALUES ('70', 'ina', 'Kecamatan', 'mst/kecamatan', '2');
INSERT INTO `app_files` VALUES ('70', 'en', 'Districts', 'mst/kecamatan', '2');
INSERT INTO `app_files` VALUES ('71', 'ina', 'Provinsi', 'mst/provinsi', '2');
INSERT INTO `app_files` VALUES ('71', 'en', 'Province', 'mst/provinsi', '2');
INSERT INTO `app_files` VALUES ('72', 'ina', 'Inv Barang', 'mst/invbarang', '2');
INSERT INTO `app_files` VALUES ('72', 'en', 'Inventory', 'mst/invbarang', '2');
INSERT INTO `app_files` VALUES ('73', 'ina', 'Inv Kondisi Barang', 'mst/invkondisibarang', '2');
INSERT INTO `app_files` VALUES ('73', 'en', 'Inventory Conditions', 'mst/invkondisibarang', '2');
INSERT INTO `app_files` VALUES ('74', 'ina', 'Kepegawaian', '#', '2');
INSERT INTO `app_files` VALUES ('74', 'en', 'Employee Affair', '#', '2');
INSERT INTO `app_files` VALUES ('75', 'ina', 'SMS Setting', 'sms_setting', '2');
INSERT INTO `app_files` VALUES ('75', 'en', 'SMS Setting', 'sms_setting', '2');
