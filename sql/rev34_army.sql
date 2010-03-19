/*
Navicat MySQL Data Transfer

Source Server         : MySQL
Source Server Version : 50024
Source Host           : localhost:3306
Source Database       : ik_game

Target Server Type    : MYSQL
Target Server Version : 50024
File Encoding         : 65001

Date: 2010-03-19 15:58:20
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `alpha_army`
-- ----------------------------
DROP TABLE IF EXISTS `alpha_army`;
CREATE TABLE `alpha_army` (
  `city` int(11) NOT NULL,
  `army_line` varchar(255) character set utf8 NOT NULL,
  `army_start` int(11) NOT NULL,
  `phalanx` int(11) NOT NULL,
  `steamgiant` int(11) NOT NULL,
  `spearman` int(11) NOT NULL,
  `swordsman` int(11) NOT NULL,
  `slinger` int(11) NOT NULL,
  `archer` int(11) NOT NULL,
  `marksman` int(11) NOT NULL,
  `ram` int(11) NOT NULL,
  `catapult` int(11) NOT NULL,
  `mortar` int(11) NOT NULL,
  `gyrocopter` int(11) NOT NULL,
  `bombardier` int(11) NOT NULL,
  `cook` int(11) NOT NULL,
  `medic` int(11) NOT NULL,
  `varvar` int(11) NOT NULL,
  PRIMARY KEY  (`city`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- ----------------------------
-- Records of alpha_army
-- ----------------------------
