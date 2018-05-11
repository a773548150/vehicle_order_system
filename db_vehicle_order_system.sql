/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : db_vehicle_order_system

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-05-11 21:58:26
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for t_log
-- ----------------------------
DROP TABLE IF EXISTS `t_log`;
CREATE TABLE `t_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `log` varchar(50) NOT NULL,
  `create_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_log
-- ----------------------------
INSERT INTO `t_log` VALUES ('1', 'admin', 'admin：添加了 \"{\'角色名为：扫地\'}\"', '2018-05-11 09:33:42', '2018-05-11 09:52:16', '0');

-- ----------------------------
-- Table structure for t_manager
-- ----------------------------
DROP TABLE IF EXISTS `t_manager`;
CREATE TABLE `t_manager` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `role_id` int(11) NOT NULL,
  `create_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `m_r` (`role_id`),
  CONSTRAINT `m_r` FOREIGN KEY (`role_id`) REFERENCES `t_role` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_manager
-- ----------------------------
INSERT INTO `t_manager` VALUES ('1', 'admin', '202cb962ac59075b964b07152d234b70', '1', '2018-05-11 19:19:12', '0000-00-00 00:00:00');
INSERT INTO `t_manager` VALUES ('5', 'xiaoming', '202cb962ac59075b964b07152d234b70', '2', '2018-05-11 09:05:57', '2018-05-11 09:14:37');

-- ----------------------------
-- Table structure for t_oil
-- ----------------------------
DROP TABLE IF EXISTS `t_oil`;
CREATE TABLE `t_oil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(20) NOT NULL,
  `type` varchar(10) NOT NULL,
  `name` varchar(10) NOT NULL,
  `delete_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `create_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_oil
-- ----------------------------

-- ----------------------------
-- Table structure for t_order
-- ----------------------------
DROP TABLE IF EXISTS `t_order`;
CREATE TABLE `t_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_status` tinyint(4) NOT NULL DEFAULT '0',
  `vehicle_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rank` int(11) NOT NULL COMMENT '''0'' 表示在大门内，非零表示在大门外',
  `create_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `o_v` (`vehicle_id`),
  KEY `o_u` (`user_id`),
  CONSTRAINT `o_u` FOREIGN KEY (`user_id`) REFERENCES `t_user` (`id`),
  CONSTRAINT `o_v` FOREIGN KEY (`vehicle_id`) REFERENCES `t_vehicle` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_order
-- ----------------------------

-- ----------------------------
-- Table structure for t_role
-- ----------------------------
DROP TABLE IF EXISTS `t_role`;
CREATE TABLE `t_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `manage_order` tinyint(4) NOT NULL DEFAULT '1',
  `manage_user` tinyint(4) NOT NULL DEFAULT '1',
  `manage_vehicle` tinyint(4) NOT NULL DEFAULT '1',
  `manage_oil` tinyint(4) NOT NULL DEFAULT '1',
  `manage_notice` tinyint(4) NOT NULL DEFAULT '1',
  `manage_role` tinyint(4) NOT NULL DEFAULT '1',
  `manage_log` tinyint(4) NOT NULL DEFAULT '1',
  `update_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `create_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_role
-- ----------------------------
INSERT INTO `t_role` VALUES ('1', '超级管理员', '1', '1', '1', '1', '1', '1', '1', '0000-00-00 00:00:00', '2018-05-11 19:17:23', '0000-00-00 00:00:00', '1');
INSERT INTO `t_role` VALUES ('2', '门卫', '0', '0', '0', '1', '1', '0', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1');
INSERT INTO `t_role` VALUES ('3', '保安', '0', '0', '0', '0', '0', '1', '0', '0000-00-00 00:00:00', '2018-05-11 09:18:07', '0000-00-00 00:00:00', '1');
INSERT INTO `t_role` VALUES ('4', '扫地', '1', '0', '1', '1', '1', '0', '0', '0000-00-00 00:00:00', '2018-05-11 09:33:42', '0000-00-00 00:00:00', '1');

-- ----------------------------
-- Table structure for t_user
-- ----------------------------
DROP TABLE IF EXISTS `t_user`;
CREATE TABLE `t_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wechat_id` int(11) NOT NULL,
  `number` varchar(20) NOT NULL,
  `mobile_number` int(11) NOT NULL,
  `company` varchar(20) NOT NULL,
  `create_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `W_U` (`wechat_id`),
  CONSTRAINT `W_U` FOREIGN KEY (`wechat_id`) REFERENCES `t_wechat` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_user
-- ----------------------------

-- ----------------------------
-- Table structure for t_vehicle
-- ----------------------------
DROP TABLE IF EXISTS `t_vehicle`;
CREATE TABLE `t_vehicle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(20) NOT NULL,
  `license_plate` varchar(7) NOT NULL,
  `delete_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `create_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(4) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `v_u` (`user_id`),
  CONSTRAINT `v_u` FOREIGN KEY (`user_id`) REFERENCES `t_user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_vehicle
-- ----------------------------

-- ----------------------------
-- Table structure for t_vehicle_oil
-- ----------------------------
DROP TABLE IF EXISTS `t_vehicle_oil`;
CREATE TABLE `t_vehicle_oil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(11) NOT NULL,
  `oil_id` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `vo_v` (`vehicle_id`),
  KEY `vo_o` (`oil_id`),
  CONSTRAINT `vo_o` FOREIGN KEY (`oil_id`) REFERENCES `t_oil` (`id`),
  CONSTRAINT `vo_v` FOREIGN KEY (`vehicle_id`) REFERENCES `t_vehicle` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_vehicle_oil
-- ----------------------------

-- ----------------------------
-- Table structure for t_vehicle_user
-- ----------------------------
DROP TABLE IF EXISTS `t_vehicle_user`;
CREATE TABLE `t_vehicle_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `v_q` (`vehicle_id`) USING BTREE,
  KEY `vu_u` (`user_id`),
  CONSTRAINT `vu_u` FOREIGN KEY (`user_id`) REFERENCES `t_user` (`id`),
  CONSTRAINT `vu_v` FOREIGN KEY (`vehicle_id`) REFERENCES `t_vehicle` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_vehicle_user
-- ----------------------------

-- ----------------------------
-- Table structure for t_wechat
-- ----------------------------
DROP TABLE IF EXISTS `t_wechat`;
CREATE TABLE `t_wechat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subscribe` tinyint(4) NOT NULL,
  `openid` varchar(30) NOT NULL,
  `nickname` varchar(30) NOT NULL,
  `sex` tinyint(4) NOT NULL,
  `language` varchar(5) NOT NULL,
  `city` varchar(20) NOT NULL,
  `province` varchar(20) NOT NULL,
  `headimgurl` text NOT NULL,
  `subscribe_time` datetime NOT NULL,
  `unionid` varchar(30) NOT NULL,
  `remark` varchar(20) NOT NULL,
  `groupid` int(11) NOT NULL,
  `create_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_wechat
-- ----------------------------
