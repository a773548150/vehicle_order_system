/*
Navicat MySQL Data Transfer

Source Server         : hiaocong
Source Server Version : 50721
Source Host           : localhost:3306
Source Database       : db_vehicle_order_system

Target Server Type    : MYSQL
Target Server Version : 50721
File Encoding         : 65001

Date: 2018-05-15 17:11:09
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for t_driver
-- ----------------------------
DROP TABLE IF EXISTS `t_driver`;
CREATE TABLE `t_driver` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wechat_id` int(11) NOT NULL,
  `number` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `mobile_number` varchar(13) NOT NULL,
  `license_plate` varchar(7) NOT NULL,
  `company` varchar(20) NOT NULL,
  `create_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `W_U` (`wechat_id`),
  CONSTRAINT `W_U` FOREIGN KEY (`wechat_id`) REFERENCES `t_wechat` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_driver
-- ----------------------------
INSERT INTO `t_driver` VALUES ('1', '1', '13415', '林晓聪', '13794578316', '粤A13145', '202', '2018-05-14 13:28:49', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1');
INSERT INTO `t_driver` VALUES ('2', '2', '58443', '凯', '13794578346', '粤A13759', '203', '2018-05-14 21:55:21', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1');

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
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_log
-- ----------------------------
INSERT INTO `t_log` VALUES ('1', 'admin', 'admin：添加了 \"{\'角色名为：扫地\'}\"', '2018-05-11 09:33:42', '2018-05-11 09:52:16', '0');
INSERT INTO `t_log` VALUES ('3', 'admin', 'admin：“xiaoming”的角色名修改为：', '2018-05-12 04:36:39', '2018-05-12 04:41:53', '0');
INSERT INTO `t_log` VALUES ('4', 'admin', 'admin：“xiaoming”的角色名修改为：xiaoming', '2018-05-12 04:42:04', '2018-05-12 04:42:32', '0');
INSERT INTO `t_log` VALUES ('5', 'admin', 'admin：“xiaoming”的角色名修改为：扫地', '2018-05-12 04:42:43', '0000-00-00 00:00:00', '1');
INSERT INTO `t_log` VALUES ('6', 'admin', '添加了角色名为：老师', '2018-05-12 04:59:32', '0000-00-00 00:00:00', '1');
INSERT INTO `t_log` VALUES ('7', 'admin', '“”的角色名修改为：老师', '2018-05-12 04:59:57', '2018-05-12 05:06:06', '0');
INSERT INTO `t_log` VALUES ('8', 'admin', '“”的角色名修改为：老师', '2018-05-12 05:01:39', '2018-05-12 05:06:03', '0');
INSERT INTO `t_log` VALUES ('9', 'admin', '“”的角色名修改为：老师', '2018-05-12 05:04:27', '2018-05-12 05:05:59', '0');
INSERT INTO `t_log` VALUES ('10', 'admin', '修改角色名：“老师”的权限', '2018-05-12 05:05:40', '0000-00-00 00:00:00', '1');
INSERT INTO `t_log` VALUES ('11', 'admin', '删除了角色名为：老师', '2018-05-12 05:06:18', '0000-00-00 00:00:00', '1');
INSERT INTO `t_log` VALUES ('12', 'admin', '添加了用户名为：xiaohong', '2018-05-12 05:09:22', '2018-05-12 05:15:28', '0');
INSERT INTO `t_log` VALUES ('13', 'admin', '删除了角色名为：', '2018-05-12 05:11:35', '2018-05-12 05:12:21', '0');
INSERT INTO `t_log` VALUES ('14', 'admin', '添加了用户名为：xiaohong', '2018-05-12 05:12:37', '2018-05-12 05:14:47', '0');
INSERT INTO `t_log` VALUES ('15', 'admin', '删除了角色名为：', '2018-05-12 05:13:16', '2018-05-12 05:14:44', '0');
INSERT INTO `t_log` VALUES ('16', 'admin', '添加了用户名为：xiaohong', '2018-05-12 05:15:02', '0000-00-00 00:00:00', '1');
INSERT INTO `t_log` VALUES ('17', 'admin', '删除了角色名为：xiaohong', '2018-05-12 05:15:16', '0000-00-00 00:00:00', '1');
INSERT INTO `t_log` VALUES ('18', 'admin', '添加了编号为：20180515123551236093  油名为：二甲苯', '2018-05-15 12:35:51', '0000-00-00 00:00:00', '1');
INSERT INTO `t_log` VALUES ('19', 'admin', '添加了编号为：20180515123639457659  油名为：三甲苯', '2018-05-15 12:36:39', '0000-00-00 00:00:00', '1');
INSERT INTO `t_log` VALUES ('20', 'admin', '删除了编号为：20180515123639457659  油名名为：三甲苯', '2018-05-15 12:40:13', '0000-00-00 00:00:00', '1');
INSERT INTO `t_log` VALUES ('21', 'admin', '添加了编号为：20180515124125977120  油名为：ss', '2018-05-15 12:41:25', '0000-00-00 00:00:00', '1');
INSERT INTO `t_log` VALUES ('22', 'admin', '删除了编号为：20180515124125977120  油名名为：ss', '2018-05-15 12:41:32', '0000-00-00 00:00:00', '1');
INSERT INTO `t_log` VALUES ('23', 'admin', '添加了标题为：213  的公告', '2018-05-15 09:25:41', '0000-00-00 00:00:00', '1');
INSERT INTO `t_log` VALUES ('24', 'admin', '添加了标题为：\'43\'的公告', '2018-05-15 09:35:18', '0000-00-00 00:00:00', '1');
INSERT INTO `t_log` VALUES ('25', 'admin', '删除了标题为：43的公告', '2018-05-15 09:36:04', '0000-00-00 00:00:00', '1');
INSERT INTO `t_log` VALUES ('26', 'admin', '修改公告标题：“213”的信息', '2018-05-15 09:40:45', '0000-00-00 00:00:00', '1');
INSERT INTO `t_log` VALUES ('27', 'admin', '修改公告标题：“2131”的信息', '2018-05-15 09:40:54', '0000-00-00 00:00:00', '1');

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
INSERT INTO `t_manager` VALUES ('5', 'xiaoming', '202cb962ac59075b964b07152d234b70', '4', '2018-05-11 09:05:57', '2018-05-12 04:42:43');

-- ----------------------------
-- Table structure for t_notice
-- ----------------------------
DROP TABLE IF EXISTS `t_notice`;
CREATE TABLE `t_notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(30) NOT NULL,
  `content` varchar(255) NOT NULL,
  `create_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_notice
-- ----------------------------
INSERT INTO `t_notice` VALUES ('1', '2131', 'dsfsdf21661', '2018-05-15 09:25:41', '2018-05-15 09:40:54');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_oil
-- ----------------------------
INSERT INTO `t_oil` VALUES ('1', '20180515123551236093', '油品类', '二甲苯', '0000-00-00 00:00:00', '2018-05-15 12:35:51', '0000-00-00 00:00:00', '1');
INSERT INTO `t_oil` VALUES ('3', '20180515124125977120', '化工类', 'ss', '0000-00-00 00:00:00', '2018-05-15 12:41:25', '0000-00-00 00:00:00', '0');

-- ----------------------------
-- Table structure for t_order
-- ----------------------------
DROP TABLE IF EXISTS `t_order`;
CREATE TABLE `t_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(20) NOT NULL,
  `order_status` tinyint(4) NOT NULL DEFAULT '0',
  `driver_id` int(11) NOT NULL,
  `oil_id` int(11) DEFAULT NULL,
  `rank` int(11) NOT NULL COMMENT '''0'' 表示在大门内，非零表示在大门外',
  `create_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `o_u` (`driver_id`),
  KEY `o_o` (`oil_id`),
  CONSTRAINT `o_d` FOREIGN KEY (`driver_id`) REFERENCES `t_driver` (`id`),
  CONSTRAINT `o_o` FOREIGN KEY (`oil_id`) REFERENCES `t_oil` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_order
-- ----------------------------
INSERT INTO `t_order` VALUES ('1', '42354235', '0', '1', '1', '1', '2018-05-15 01:31:16', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1');
INSERT INTO `t_order` VALUES ('2', '87564523', '1', '2', '3', '2', '2018-05-15 01:31:19', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1');

-- ----------------------------
-- Table structure for t_role
-- ----------------------------
DROP TABLE IF EXISTS `t_role`;
CREATE TABLE `t_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `manage_order` tinyint(4) NOT NULL DEFAULT '1',
  `manage_driver` tinyint(4) NOT NULL DEFAULT '1',
  `manage_data` tinyint(4) NOT NULL DEFAULT '1',
  `manage_oil` tinyint(4) NOT NULL DEFAULT '1',
  `manage_notice` tinyint(4) NOT NULL DEFAULT '1',
  `manage_role` tinyint(4) NOT NULL DEFAULT '1',
  `manage_log` tinyint(4) NOT NULL DEFAULT '1',
  `update_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `create_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `n_q` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_role
-- ----------------------------
INSERT INTO `t_role` VALUES ('1', '超级管理员', '1', '1', '1', '1', '1', '1', '1', '0000-00-00 00:00:00', '2018-05-11 19:17:23', '0000-00-00 00:00:00', '1');
INSERT INTO `t_role` VALUES ('2', '门卫', '0', '0', '0', '1', '1', '0', '1', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1');
INSERT INTO `t_role` VALUES ('3', '保安', '0', '0', '0', '0', '0', '1', '0', '0000-00-00 00:00:00', '2018-05-11 09:18:07', '0000-00-00 00:00:00', '1');
INSERT INTO `t_role` VALUES ('4', '扫地', '1', '0', '1', '1', '1', '0', '0', '0000-00-00 00:00:00', '2018-05-11 09:33:42', '0000-00-00 00:00:00', '1');
INSERT INTO `t_role` VALUES ('5', '老师', '1', '1', '1', '1', '1', '1', '1', '2018-05-12 05:05:40', '2018-05-12 04:59:32', '2018-05-12 05:06:18', '0');

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
  `country` varchar(30) NOT NULL,
  `headimgurl` text NOT NULL,
  `subscribe_time` varchar(20) NOT NULL,
  `remark` varchar(20) NOT NULL,
  `groupid` int(11) NOT NULL,
  `subscribe_scene` varchar(20) NOT NULL,
  `qr_scene` int(11) NOT NULL,
  `qr_scene_str` varchar(30) NOT NULL,
  `create_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of t_wechat
-- ----------------------------
INSERT INTO `t_wechat` VALUES ('1', '1', 'oyur_1GhybMGLZZ5xc1-LxSO39T8', 'HiAoC', '1', 'zh_CN', '揭阳', '广东', '中国', 'http://thirdwx.qlogo.cn/mmopen/6Zzu4IicyEE7ar2kVTlu6ZgPpINE6aslAgWTNIibCMPvDib3LgRFxnnC07kR2aaL9hiau0caichC0zhFweQBDj60objmmuAt7O2DK/132', '1525483135', '0', '0', 'ADD_SCENE_QR_CODE', '0', '', '2018-05-14 13:23:58', '0000-00-00 00:00:00');
INSERT INTO `t_wechat` VALUES ('2', '1', 'oyur_1GhybMGLZZ5xc1-LxSO39T8', 'kkk', '1', 'zh_CN', '珠海', '广东', '中国', 'http://thirdwx.qlogo.cn/mmopen/6Zzu4IicyEE5xptsib9Kia11eibwQciblhnUEVlyhu4UNK5BMqs47kYbYYG4dlRa8NRhw3iciaybyO2vUGJnB8CYJM2ya2q1gjldx9ib/132', '1525483135', '0', '0', 'ADD_SCENE_QR_CODE', '0', '', '2018-05-14 13:23:58', '0000-00-00 00:00:00');
