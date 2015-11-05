/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50624
Source Host           : 127.0.0.1:3306
Source Database       : epus_org_3172100

Target Server Type    : MYSQL
Target Server Version : 50624
File Encoding         : 65001

Date: 2015-11-05 12:51:26
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for app_users_access
-- ----------------------------
DROP TABLE IF EXISTS `app_users_access`;
CREATE TABLE `app_users_access` (
  `file_id` int(10) NOT NULL,
  `level_id` varchar(100) NOT NULL,
  `doshow` int(1) NOT NULL DEFAULT '0',
  `doadd` int(1) NOT NULL DEFAULT '0',
  `doedit` int(1) NOT NULL DEFAULT '0',
  `dodel` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`file_id`,`level_id`),
  KEY `fk_users_access_users_level` (`level_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of app_users_access
-- ----------------------------
INSERT INTO `app_users_access` VALUES ('39', 'administrator', '1', '1', '1', '1');
INSERT INTO `app_users_access` VALUES ('31', 'admin', '1', '1', '1', '1');
INSERT INTO `app_users_access` VALUES ('6', 'admin', '1', '1', '1', '1');
INSERT INTO `app_users_access` VALUES ('5', 'admin', '1', '1', '1', '1');
INSERT INTO `app_users_access` VALUES ('4', 'admin', '1', '1', '1', '1');
INSERT INTO `app_users_access` VALUES ('3', 'admin', '1', '1', '1', '1');
INSERT INTO `app_users_access` VALUES ('1', 'admin', '1', '1', '1', '1');
INSERT INTO `app_users_access` VALUES ('2', 'admin', '1', '1', '1', '1');
INSERT INTO `app_users_access` VALUES ('38', 'administrator', '1', '1', '1', '1');
INSERT INTO `app_users_access` VALUES ('37', 'administrator', '1', '1', '1', '1');
INSERT INTO `app_users_access` VALUES ('36', 'administrator', '1', '1', '1', '1');
INSERT INTO `app_users_access` VALUES ('31', 'administrator', '1', '1', '1', '1');
INSERT INTO `app_users_access` VALUES ('6', 'administrator', '1', '1', '1', '1');
INSERT INTO `app_users_access` VALUES ('4', 'administrator', '1', '1', '1', '1');
INSERT INTO `app_users_access` VALUES ('5', 'member', '1', '0', '0', '0');
INSERT INTO `app_users_access` VALUES ('4', 'member', '1', '0', '0', '0');
INSERT INTO `app_users_access` VALUES ('3', 'member', '1', '1', '1', '1');
INSERT INTO `app_users_access` VALUES ('2', 'member', '1', '1', '1', '1');
INSERT INTO `app_users_access` VALUES ('1', 'member', '1', '1', '1', '1');
INSERT INTO `app_users_access` VALUES ('5', 'administrator', '1', '1', '1', '1');
INSERT INTO `app_users_access` VALUES ('3', 'administrator', '1', '1', '1', '1');
INSERT INTO `app_users_access` VALUES ('2', 'administrator', '1', '1', '1', '1');
INSERT INTO `app_users_access` VALUES ('1', 'administrator', '1', '1', '1', '1');
INSERT INTO `app_users_access` VALUES ('40', 'administrator', '1', '1', '1', '1');
INSERT INTO `app_users_access` VALUES ('41', 'administrator', '1', '1', '1', '1');
INSERT INTO `app_users_access` VALUES ('42', 'administrator', '1', '1', '1', '1');
INSERT INTO `app_users_access` VALUES ('43', 'administrator', '1', '1', '1', '1');
INSERT INTO `app_users_access` VALUES ('44', 'administrator', '1', '1', '1', '1');
INSERT INTO `app_users_access` VALUES ('45', 'administrator', '1', '1', '1', '1');
INSERT INTO `app_users_access` VALUES ('46', 'administrator', '1', '1', '1', '1');
INSERT INTO `app_users_access` VALUES ('47', 'administrator', '1', '1', '1', '1');
INSERT INTO `app_users_access` VALUES ('48', 'administrator', '1', '1', '1', '1');
INSERT INTO `app_users_access` VALUES ('49', 'administrator', '1', '1', '1', '1');
INSERT INTO `app_users_access` VALUES ('50', 'administrator', '1', '1', '1', '1');
INSERT INTO `app_users_access` VALUES ('51', 'administrator', '1', '1', '1', '1');
INSERT INTO `app_users_access` VALUES ('52', 'administrator', '1', '1', '1', '1');
INSERT INTO `app_users_access` VALUES ('53', 'administrator', '1', '1', '1', '1');
INSERT INTO `app_users_access` VALUES ('54', 'administrator', '1', '1', '1', '1');
INSERT INTO `app_users_access` VALUES ('55', 'administrator', '1', '1', '1', '1');
INSERT INTO `app_users_access` VALUES ('56', 'administrator', '1', '1', '1', '1');
INSERT INTO `app_users_access` VALUES ('57', 'administrator', '1', '1', '1', '1');
INSERT INTO `app_users_access` VALUES ('58', 'administrator', '1', '1', '1', '1');
INSERT INTO `app_users_access` VALUES ('59', 'administrator', '1', '1', '1', '1');
INSERT INTO `app_users_access` VALUES ('60', 'administrator', '1', '1', '1', '1');
INSERT INTO `app_users_access` VALUES ('61', 'administrator', '1', '1', '1', '1');
INSERT INTO `app_users_access` VALUES ('62', 'administrator', '1', '1', '1', '1');
INSERT INTO `app_users_access` VALUES ('63', 'administrator', '1', '1', '1', '1');
INSERT INTO `app_users_access` VALUES ('64', 'administrator', '1', '1', '1', '1');
INSERT INTO `app_users_access` VALUES ('65', 'administrator', '1', '1', '1', '1');
INSERT INTO `app_users_access` VALUES ('66', 'administrator', '1', '1', '1', '1');
INSERT INTO `app_users_access` VALUES ('67', 'administrator', '1', '1', '1', '1');
INSERT INTO `app_users_access` VALUES ('68', 'administrator', '1', '1', '1', '1');
INSERT INTO `app_users_access` VALUES ('69', 'administrator', '1', '1', '1', '1');
INSERT INTO `app_users_access` VALUES ('70', 'administrator', '1', '1', '1', '1');
INSERT INTO `app_users_access` VALUES ('71', 'administrator', '1', '1', '1', '1');
INSERT INTO `app_users_access` VALUES ('72', 'administrator', '1', '1', '1', '1');
INSERT INTO `app_users_access` VALUES ('73', 'administrator', '1', '1', '1', '1');
INSERT INTO `app_users_access` VALUES ('74', 'administrator', '1', '1', '1', '1');
INSERT INTO `app_users_access` VALUES ('75', 'administrator', '1', '1', '1', '1');
