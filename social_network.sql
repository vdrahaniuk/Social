/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50140
Source Host           : localhost:3306
Source Database       : social_network

Target Server Type    : MYSQL
Target Server Version : 50140
File Encoding         : 65001

Date: 2012-01-25 15:02:31
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `e-mail` text NOT NULL,
  `password` text NOT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `registerDate` date DEFAULT NULL,
  `firstName` text,
  `lastName` text,
  `sex` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('sfssfds', '3d9446918266a283875ece471e87d9c7', '1', null, null, null, null);
INSERT INTO `users` VALUES ('sfssfds', '7196ee5f35366dedfa34243040ff2521', '2', null, null, null, null);
INSERT INTO `users` VALUES ('sfssfds', '7196ee5f35366dedfa34243040ff2521', '3', null, null, null, null);
INSERT INTO `users` VALUES ('sfssfds', '7196ee5f35366dedfa34243040ff2521', '4', null, null, null, null);
INSERT INTO `users` VALUES ('sfssfdssfs', 'b181a2ab21e3b2d698ea5f4eec7da318', '5', '2012-01-25', null, null, null);
INSERT INTO `users` VALUES ('vvvirus@ukr.net', 'b54aec7aa025d07993c1e95ce57fce91', '6', '2012-01-25', null, null, null);
INSERT INTO `users` VALUES ('vvvirus@gmail.com', '770a8a5aa5fe04fcab770d4e3c3211f4', '7', '2012-01-25', null, null, null);
INSERT INTO `users` VALUES ('vvvirus@gmail.com', '5b282e1c69b6444c7c0e3f2f1fea5c83', '8', '2012-01-25', null, null, null);
INSERT INTO `users` VALUES ('vvvirus@gmail.com', 'a8f5f167f44f4964e6c998dee827110c', '9', '2012-01-25', '', '', null);
INSERT INTO `users` VALUES ('vvvirus@gmail.com', '57478bdd6cc0d1aeef78b98f8f1a4220', '10', '2012-01-25', null, null, null);
INSERT INTO `users` VALUES ('vvvirus@gmail.com', 'd58e3582afa99040e27b92b13c8f2280', '11', '2012-01-25', null, null, null);
INSERT INTO `users` VALUES ('vvvirus@gmail.com', 'd58e3582afa99040e27b92b13c8f2280', '12', '2012-01-25', 'rsdfsdf', 'sdfsf', null);
INSERT INTO `users` VALUES ('dgdg@ukr.net', '14b4d93b44db88667c3f5b305e596471', '13', '2012-01-25', 'sgsdg', 'sdgsdg', null);
