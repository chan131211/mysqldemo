/*
Navicat MySQL Data Transfer

Source Server         : imooc_shop
Source Server Version : 80012
Source Host           : localhost:3306
Source Database       : mysqldemo

Target Server Type    : MYSQL
Target Server Version : 80012
File Encoding         : 65001

Date: 2020-03-11 20:09:40
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of student
-- ----------------------------
INSERT INTO `student` VALUES ('1', '小白', '10001000', '111@163.cn', '90.00', 'hello !', './upload/5e68ce64a7250.jpg', '2020-03-11 19:41:24');
INSERT INTO `student` VALUES ('2', '小黑', '10001001', '222@163.cn', '200.00', '有趣的灵魂', './upload/5e68ce8c837a6.jpg', '2020-03-11 19:42:04');
INSERT INTO `student` VALUES ('3', '张三', '10001003', '333@163.cn', '400.00', '学到很多东西的决窍，就是不要一下子学很多的东西。', './upload/5e68cf3d7758b.jpg', '2020-03-11 19:45:01');
INSERT INTO `student` VALUES ('4', '李四', '10001004', '444@163.cn', '2999.50', '一个志在有大成就的人，他必须如歌德所说，知道限制自己。反之，什么事都想做的人，其实什么事都不能做，而终归于失败。', './upload/5e68cf6a11375.jpg', '2020-03-11 19:45:46');
INSERT INTO `student` VALUES ('5', '王五', '10001005', '555@163.cn', '2521.00', '存在即合理。', './upload/5e68cfa773596.gif', '2020-03-11 19:46:47');
INSERT INTO `student` VALUES ('6', '古月', '10001006', '666@163.cn', '510.00', '一个人只有在独处时才能成为自己。谁要是不爱独处，那他就不爱自由，因为一个人只有在独处时才是真正自由的。', './upload/5e68cff70cd3d.jpg', '2020-03-11 19:48:07');
