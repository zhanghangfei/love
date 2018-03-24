/*
Navicat MySQL Data Transfer

Source Server         : back
Source Server Version : 50547
Source Host           : localhost:3306
Source Database       : love

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2018-03-23 23:35:20
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `love_admin_herocate`
-- ----------------------------
DROP TABLE IF EXISTS `love_admin_herocate`;
CREATE TABLE `love_admin_herocate` (
  `cateid` int(11) NOT NULL AUTO_INCREMENT,
  `catename` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`cateid`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of love_admin_herocate
-- ----------------------------
INSERT INTO `love_admin_herocate` VALUES ('28', '约尔旦人');

-- ----------------------------
-- Table structure for `love_admin_user`
-- ----------------------------
DROP TABLE IF EXISTS `love_admin_user`;
CREATE TABLE `love_admin_user` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `logined_time` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of love_admin_user
-- ----------------------------
INSERT INTO `love_admin_user` VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', '2018-03-23 23:13:27');
