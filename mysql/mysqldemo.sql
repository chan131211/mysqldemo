/*
Navicat MySQL Data Transfer

Source Server         : imooc_shop
Source Server Version : 80012
Source Host           : localhost:3306
Source Database       : mysqldemo

Target Server Type    : MYSQL
Target Server Version : 80012
File Encoding         : 65001

Date: 2020-03-11 12:45:06
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for student
-- ----------------------------
DROP TABLE IF EXISTS `student`;
CREATE TABLE `student` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `number` char(8) NOT NULL,
  `email` varchar(50) NOT NULL,
  `money` decimal(6,2) unsigned NOT NULL DEFAULT '0.00',
  `info` varchar(60) NOT NULL,
  `face` varchar(60) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of student
-- ----------------------------
