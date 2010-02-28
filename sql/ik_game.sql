/*
Navicat MySQL Data Transfer

Source Server         : MySQL
Source Server Version : 50024
Source Host           : localhost:3306
Source Database       : ik_game

Target Server Type    : MYSQL
Target Server Version : 50024
File Encoding         : 65001

Date: 2010-02-28 20:52:44
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `alpha_islands`
-- ----------------------------
DROP TABLE IF EXISTS `alpha_islands`;
CREATE TABLE `alpha_islands` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) character set utf8 NOT NULL default 'Остров',
  `x` int(11) NOT NULL,
  `y` int(11) NOT NULL,
  `type` int(11) NOT NULL default '1',
  `trade_resource` int(11) NOT NULL,
  `towns` varchar(255) collate latin1_general_ci NOT NULL default '1 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0',
  PRIMARY KEY  (`id`,`name`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- ----------------------------
-- Records of alpha_islands
-- ----------------------------
INSERT INTO `alpha_islands` VALUES ('1', 'Остров', '1', '2', '1', '4', '1 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0');

-- ----------------------------
-- Table structure for `alpha_towns`
-- ----------------------------
DROP TABLE IF EXISTS `alpha_towns`;
CREATE TABLE `alpha_towns` (
  `id` int(11) NOT NULL auto_increment,
  `user` int(11) NOT NULL,
  `island` int(11) NOT NULL,
  `name` varchar(255) character set utf8 NOT NULL default 'Полис',
  `wood` varchar(255) character set utf8 NOT NULL default '160',
  `wine` varchar(255) character set utf8 NOT NULL default '0',
  `marble` varchar(255) character set utf8 NOT NULL default '0',
  `crystal` varchar(255) character set utf8 NOT NULL default '0',
  `sulfur` varchar(255) character set utf8 NOT NULL default '0',
  `buildings` varchar(255) collate latin1_general_ci NOT NULL default '1,1;0,0;0,0;0,0;0,0;0,0;0,0;0,0;0,0;0,0;0,0;0,0;0,0;0,0;0,0',
  `build_line` varchar(255) collate latin1_general_ci NOT NULL,
  `build_start` int(11) NOT NULL default '0',
  `peoples` varchar(255) character set utf8 NOT NULL default '40',
  `actions` varchar(255) character set utf8 NOT NULL default '3',
  PRIMARY KEY  (`id`,`user`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- ----------------------------
-- Records of alpha_towns
-- ----------------------------
INSERT INTO `alpha_towns` VALUES ('1', '1', '1', 'Аместрис', '1540', '0', '0', '0', '0', '1,2;0,0;0,0;0,0;0,0;0,0;0,0;0,0;0,0;0,0;0,0;0,0;0,0;0,0;0,0', '', '0', '40', '3');

-- ----------------------------
-- Table structure for `alpha_users`
-- ----------------------------
DROP TABLE IF EXISTS `alpha_users`;
CREATE TABLE `alpha_users` (
  `id` int(11) NOT NULL auto_increment,
  `login` varchar(255) character set utf8 NOT NULL,
  `password` varchar(255) character set utf8 NOT NULL,
  `last_visit` int(11) NOT NULL,
  `town` int(11) NOT NULL,
  `gold` varchar(255) character set utf8 NOT NULL default '100',
  `ambrosy` int(11) NOT NULL default '0',
  `tutorial` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`,`login`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- ----------------------------
-- Records of alpha_users
-- ----------------------------
INSERT INTO `alpha_users` VALUES ('1', 'Player', '12345', '1267379541', '1', '2550', '25', '0');
