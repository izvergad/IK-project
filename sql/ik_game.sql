/*
Navicat MySQL Data Transfer

Source Server         : MySQL
Source Server Version : 50024
Source Host           : localhost:3306
Source Database       : ik_game

Target Server Type    : MYSQL
Target Server Version : 50024
File Encoding         : 65001

Date: 2010-03-11 22:12:23
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
  `trade_resource` int(11) NOT NULL default '3',
  `wood_level` int(11) NOT NULL default '1',
  `trade_level` int(11) NOT NULL default '1',
  `wood_count` int(11) NOT NULL default '0',
  `trade_count` int(11) NOT NULL default '0',
  `city0` int(11) NOT NULL default '0',
  `city1` int(11) NOT NULL default '0',
  `city2` int(11) NOT NULL default '0',
  `city3` int(11) NOT NULL default '0',
  `city4` int(11) NOT NULL default '0',
  `city5` int(11) NOT NULL default '0',
  `city6` int(11) NOT NULL default '0',
  `city7` int(11) NOT NULL default '0',
  `city8` int(11) NOT NULL default '0',
  `city9` int(11) NOT NULL default '0',
  `city10` int(11) NOT NULL default '0',
  `city11` int(11) NOT NULL default '0',
  `city12` int(11) NOT NULL default '0',
  `city13` int(11) NOT NULL default '0',
  `city14` int(11) NOT NULL default '0',
  `city15` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`,`name`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- ----------------------------
-- Records of alpha_islands
-- ----------------------------
INSERT INTO `alpha_islands` VALUES ('1', 'Остров', '1', '2', '1', '3', '2', '2', '0', '0', '0', '1', '0', '2', '0', '3', '0', '0', '0', '0', '4', '0', '0', '0', '0', '0');

-- ----------------------------
-- Table structure for `alpha_towns`
-- ----------------------------
DROP TABLE IF EXISTS `alpha_towns`;
CREATE TABLE `alpha_towns` (
  `id` int(11) NOT NULL auto_increment,
  `user` int(11) NOT NULL,
  `island` int(11) NOT NULL,
  `last_update` int(11) NOT NULL,
  `name` varchar(255) character set utf8 NOT NULL default 'Полис',
  `wood` varchar(255) character set utf8 NOT NULL default '160',
  `wine` varchar(255) character set utf8 NOT NULL default '0',
  `marble` varchar(255) character set utf8 NOT NULL default '0',
  `crystal` varchar(255) character set utf8 NOT NULL default '0',
  `sulfur` varchar(255) character set utf8 NOT NULL default '0',
  `pos0_type` int(11) NOT NULL default '1',
  `pos0_level` int(11) NOT NULL default '1',
  `pos1_type` int(11) NOT NULL default '0',
  `pos1_level` int(11) NOT NULL default '0',
  `pos2_type` int(11) NOT NULL default '0',
  `pos2_level` int(11) NOT NULL default '0',
  `pos3_type` int(11) NOT NULL default '0',
  `pos3_level` int(11) NOT NULL default '0',
  `pos4_type` int(11) NOT NULL default '0',
  `pos4_level` int(11) NOT NULL default '0',
  `pos5_type` int(11) NOT NULL default '0',
  `pos5_level` int(11) NOT NULL default '0',
  `pos6_type` int(11) NOT NULL default '0',
  `pos6_level` int(11) NOT NULL default '0',
  `pos7_type` int(11) NOT NULL default '0',
  `pos7_level` int(11) NOT NULL default '0',
  `pos8_type` int(11) NOT NULL default '0',
  `pos8_level` int(11) NOT NULL default '0',
  `pos9_type` int(11) NOT NULL default '0',
  `pos9_level` int(11) NOT NULL,
  `pos10_type` int(11) NOT NULL default '0',
  `pos10_level` int(11) NOT NULL default '0',
  `pos11_type` int(11) NOT NULL default '0',
  `pos11_level` int(11) NOT NULL default '0',
  `pos12_type` int(11) NOT NULL default '0',
  `pos12_level` int(11) NOT NULL default '0',
  `pos13_type` int(11) NOT NULL default '0',
  `pos13_level` int(11) NOT NULL default '0',
  `pos14_type` int(11) NOT NULL default '0',
  `pos14_level` int(11) NOT NULL default '0',
  `build_line` varchar(255) collate latin1_general_ci NOT NULL,
  `build_start` int(11) NOT NULL default '0',
  `peoples` varchar(255) character set utf8 NOT NULL default '40',
  `workers` varchar(255) character set utf8 NOT NULL default '0',
  `actions` varchar(255) character set utf8 NOT NULL default '3',
  PRIMARY KEY  (`id`,`user`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- ----------------------------
-- Records of alpha_towns
-- ----------------------------
INSERT INTO `alpha_towns` VALUES ('1', '1', '1', '1268334628', 'Аместрис', '4402.88499994', '0', '0', '0', '0', '1', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '3', '2', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '', '0', '22', '38', '3');
INSERT INTO `alpha_towns` VALUES ('2', '1', '1', '1268334628', 'Дзержинск', '20.7422222212', '0', '0', '0', '0', '1', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '3', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '', '0', '49.0962063234', '0', '3');
INSERT INTO `alpha_towns` VALUES ('3', '2', '1', '1268332295', 'Полис', '160', '0', '0', '0', '0', '1', '2', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '', '0', '41.5822234216', '0', '3');
INSERT INTO `alpha_towns` VALUES ('4', '2', '1', '1268332295', 'Полис', '160', '0', '0', '0', '0', '1', '1', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '', '0', '41.5822234216', '0', '3');

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
  `capital` int(11) NOT NULL,
  `gold` varchar(255) character set utf8 NOT NULL default '100',
  `ambrosy` int(11) NOT NULL default '0',
  `tutorial` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`,`login`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- ----------------------------
-- Records of alpha_users
-- ----------------------------
INSERT INTO `alpha_users` VALUES ('1', 'Player', '12345', '1268334628', '1', '1', '107236.853549', '25', '7');
INSERT INTO `alpha_users` VALUES ('2', 'Player2', '12345', '1268332295', '3', '3', '472.498291388', '0', '0');
