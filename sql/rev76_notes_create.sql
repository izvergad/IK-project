/*
Navicat MySQL Data Transfer

Source Server         : MySQL
Source Server Version : 50024
Source Host           : localhost:3306
Source Database       : ik_game

Target Server Type    : MYSQL
Target Server Version : 50024
File Encoding         : 65001

Date: 2010-04-03 00:11:35
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `alpha_notes`
-- ----------------------------
DROP TABLE IF EXISTS `alpha_notes`;
CREATE TABLE `alpha_notes` (
  `user` int(11) NOT NULL,
  `text` text character set utf8 NOT NULL,
  PRIMARY KEY  (`user`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- ----------------------------
-- Records of alpha_notes
-- ----------------------------
