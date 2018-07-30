/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 100121
Source Host           : localhost:3306
Source Database       : test

Target Server Type    : MYSQL
Target Server Version : 100121
File Encoding         : 65001

Date: 2018-06-05 17:04:17
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for import_file_log
-- ----------------------------
DROP TABLE IF EXISTS `import_file_log`;
CREATE TABLE `import_file_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '导入文件日志',
  `file_name` varchar(255) DEFAULT NULL COMMENT '文件名称',
  `import_person` varchar(20) DEFAULT NULL COMMENT '导入人',
  `import_time` datetime DEFAULT NULL COMMENT '导入时间',
  `description` varchar(1000) DEFAULT NULL COMMENT '描述',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='导入文件日志';

-- ----------------------------
-- Records of import_file_log
-- ----------------------------
