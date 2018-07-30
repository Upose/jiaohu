/*
Navicat MySQL Data Transfer

Source Server         : mysql127.0.0.1
Source Server Version : 50547
Source Host           : localhost:3306
Source Database       : ec_demo

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2018-06-05 11:44:15
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `test`
-- ----------------------------
DROP TABLE IF EXISTS `test`;
CREATE TABLE `test` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `timete` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `times` datetime DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of test
-- ----------------------------
INSERT INTO `test` VALUES ('1', '2018-06-05 11:43:50', '2018-06-28 11:43:43');
