/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50624
Source Host           : 127.0.0.1:3306
Source Database       : epus_org_3172100

Target Server Type    : MYSQL
Target Server Version : 50624
File Encoding         : 65001

Date: 2015-11-05 12:51:15
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for app_menus
-- ----------------------------
DROP TABLE IF EXISTS `app_menus`;
CREATE TABLE `app_menus` (
  `position` int(10) NOT NULL,
  `id` int(10) NOT NULL,
  `sub_id` int(10) NOT NULL DEFAULT '0',
  `sort` int(10) NOT NULL DEFAULT '0',
  `file_id` int(10) NOT NULL,
  `id_theme` int(10) DEFAULT NULL,
  PRIMARY KEY (`position`,`id`),
  KEY `fk_menus_files` (`file_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of app_menus
-- ----------------------------
INSERT INTO `app_menus` VALUES ('1', '14', '10', '4', '63', '2');
INSERT INTO `app_menus` VALUES ('1', '13', '10', '3', '62', '2');
INSERT INTO `app_menus` VALUES ('1', '12', '10', '2', '61', '2');
INSERT INTO `app_menus` VALUES ('1', '11', '10', '1', '60', '2');
INSERT INTO `app_menus` VALUES ('1', '10', '0', '5', '59', '2');
INSERT INTO `app_menus` VALUES ('1', '8', '0', '4', '57', '2');
INSERT INTO `app_menus` VALUES ('1', '7', '6', '1', '56', '2');
INSERT INTO `app_menus` VALUES ('1', '2', '1', '1', '1', '2');
INSERT INTO `app_menus` VALUES ('1', '9', '8', '1', '58', '2');
INSERT INTO `app_menus` VALUES ('1', '15', '10', '5', '64', '2');
INSERT INTO `app_menus` VALUES ('1', '6', '0', '3', '55', '2');
INSERT INTO `app_menus` VALUES ('1', '1', '0', '1', '39', '2');
INSERT INTO `app_menus` VALUES ('1', '3', '1', '2', '40', '2');
INSERT INTO `app_menus` VALUES ('1', '4', '0', '2', '74', '2');
INSERT INTO `app_menus` VALUES ('1', '17', '0', '6', '41', '2');
INSERT INTO `app_menus` VALUES ('1', '5', '4', '1', '54', '2');
INSERT INTO `app_menus` VALUES ('1', '16', '10', '6', '65', '2');
INSERT INTO `app_menus` VALUES ('1', '18', '17', '1', '66', '2');
INSERT INTO `app_menus` VALUES ('1', '19', '0', '7', '49', '2');
INSERT INTO `app_menus` VALUES ('1', '20', '19', '1', '50', '2');
INSERT INTO `app_menus` VALUES ('1', '21', '19', '2', '2', '2');
INSERT INTO `app_menus` VALUES ('1', '22', '19', '3', '37', '2');
INSERT INTO `app_menus` VALUES ('1', '23', '19', '4', '38', '2');
INSERT INTO `app_menus` VALUES ('1', '24', '19', '5', '36', '2');
INSERT INTO `app_menus` VALUES ('1', '25', '19', '6', '75', '2');
INSERT INTO `app_menus` VALUES ('1', '26', '0', '8', '6', '2');
INSERT INTO `app_menus` VALUES ('1', '27', '26', '1', '52', '2');
INSERT INTO `app_menus` VALUES ('1', '28', '26', '2', '67', '2');
INSERT INTO `app_menus` VALUES ('1', '29', '26', '3', '68', '2');
INSERT INTO `app_menus` VALUES ('1', '30', '26', '4', '69', '2');
INSERT INTO `app_menus` VALUES ('1', '31', '26', '5', '70', '2');
INSERT INTO `app_menus` VALUES ('1', '32', '26', '6', '71', '2');
INSERT INTO `app_menus` VALUES ('1', '33', '26', '7', '72', '2');
INSERT INTO `app_menus` VALUES ('1', '34', '26', '8', '73', '2');
