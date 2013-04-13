/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50516
Source Host           : localhost:3306
Source Database       : huicms

Target Server Type    : MYSQL
Target Server Version : 50516
File Encoding         : 65001

Date: 2013-04-12 20:37:18
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `hui_admin`
-- ----------------------------
DROP TABLE IF EXISTS `hui_admin`;
CREATE TABLE `hui_admin` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '管理员ID',
  `u_name` varchar(50) NOT NULL COMMENT '管理员用户名',
  `u_passwd` varchar(32) NOT NULL COMMENT '管理员密码',
  `role_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '角色ID',
  `u_ip` varchar(15) NOT NULL COMMENT '管理员登陆IP',
  `u_photo` varchar(100) DEFAULT NULL COMMENT '管理员头像',
  `u_username` varchar(50) DEFAULT NULL COMMENT '姓名',
  `u_sex` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '性别 0：保密 1：男 2：女',
  `u_phone` varchar(11) NOT NULL COMMENT '手机',
  `u_email` varchar(50) NOT NULL COMMENT 'Email',
  `u_qq` varchar(13) DEFAULT NULL COMMENT 'QQ',
  `u_description` text COMMENT '描述',
  `u_countlog` int(11) NOT NULL COMMENT '登陆次数',
  `u_status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '启用/停用,1：启用，0：停用',
  `u_lastlogin_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '最后登陆时间',
  `u_create_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `u_update_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '更新时间',
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='管理员';

-- ----------------------------
-- Records of hui_admin
-- ----------------------------
INSERT INTO `hui_admin` VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', '2', '127.0.0.1', '/Public/upload/photo/51552c0566f9d.png', '王辉', '0', '13817918575', 'shuaige@52sum.com', '466209365', '', '70', '1', '2013-04-12 19:13:40', '0000-00-00 00:00:00', '2013-03-29 13:52:05');
INSERT INTO `hui_admin` VALUES ('2', 'terry', '585b66ed3c06f4cadcb3084c0a621437', '2', '127.0.0.1', null, '王辉', '1', '13817918575', 'admin@52sum.com', '466209365', '', '29', '1', '2013-04-02 10:56:22', '2013-03-28 00:00:00', '2013-04-02 01:01:04');

-- ----------------------------
-- Table structure for `hui_admin_log`
-- ----------------------------
DROP TABLE IF EXISTS `hui_admin_log`;
CREATE TABLE `hui_admin_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '登陆日志ID',
  `u_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '登陆者ID',
  `u_name` varchar(60) NOT NULL DEFAULT '' COMMENT '登陆管理员',
  `log_create` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '登陆时间',
  `log_ip` varchar(15) NOT NULL COMMENT '登陆IP',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8 COMMENT='管理员日志';

-- ----------------------------
-- Records of hui_admin_log
-- ----------------------------
INSERT INTO `hui_admin_log` VALUES ('45', '1', 'admin', '2013-03-26 09:19:12', '127.0.0.1');
INSERT INTO `hui_admin_log` VALUES ('46', '1', 'admin', '2013-03-26 09:49:42', '127.0.0.1');
INSERT INTO `hui_admin_log` VALUES ('47', '1', 'admin', '2013-03-26 10:17:12', '127.0.0.1');
INSERT INTO `hui_admin_log` VALUES ('48', '1', 'admin', '2013-03-26 10:31:40', '127.0.0.1');
INSERT INTO `hui_admin_log` VALUES ('49', '1', 'admin', '2013-03-26 10:54:49', '127.0.0.1');
INSERT INTO `hui_admin_log` VALUES ('50', '1', 'admin', '2013-03-26 11:02:52', '127.0.0.1');
INSERT INTO `hui_admin_log` VALUES ('51', '1', 'admin', '2013-03-26 11:11:38', '127.0.0.1');
INSERT INTO `hui_admin_log` VALUES ('52', '1', 'admin', '2013-03-26 11:30:13', '127.0.0.1');
INSERT INTO `hui_admin_log` VALUES ('53', '1', 'admin', '2013-03-26 11:31:47', '127.0.0.1');
INSERT INTO `hui_admin_log` VALUES ('54', '1', 'admin', '2013-03-26 11:33:47', '127.0.0.1');
INSERT INTO `hui_admin_log` VALUES ('55', '1', 'admin', '2013-03-26 14:14:22', '127.0.0.1');
INSERT INTO `hui_admin_log` VALUES ('56', '1', 'admin', '2013-03-26 20:00:24', '127.0.0.1');
INSERT INTO `hui_admin_log` VALUES ('57', '1', 'admin', '2013-03-26 21:05:14', '127.0.0.1');
INSERT INTO `hui_admin_log` VALUES ('58', '1', 'admin', '2013-03-26 21:05:36', '127.0.0.1');
INSERT INTO `hui_admin_log` VALUES ('59', '1', 'admin', '2013-03-26 22:13:32', '127.0.0.1');
INSERT INTO `hui_admin_log` VALUES ('60', '1', 'admin', '2013-03-27 01:28:33', '127.0.0.1');
INSERT INTO `hui_admin_log` VALUES ('61', '1', 'admin', '2013-03-27 09:10:42', '127.0.0.1');
INSERT INTO `hui_admin_log` VALUES ('62', '1', 'admin', '2013-03-27 13:28:21', '127.0.0.1');
INSERT INTO `hui_admin_log` VALUES ('63', '1', 'admin', '2013-03-27 20:19:25', '127.0.0.1');
INSERT INTO `hui_admin_log` VALUES ('64', '1', 'admin', '2013-03-27 21:30:28', '127.0.0.1');
INSERT INTO `hui_admin_log` VALUES ('65', '1', 'admin', '2013-03-27 22:34:50', '127.0.0.1');
INSERT INTO `hui_admin_log` VALUES ('66', '1', 'admin', '2013-03-27 22:44:34', '127.0.0.1');
INSERT INTO `hui_admin_log` VALUES ('67', '1', 'admin', '2013-03-27 22:44:55', '127.0.0.1');
INSERT INTO `hui_admin_log` VALUES ('68', '1', 'admin', '2013-03-27 22:58:58', '127.0.0.1');
INSERT INTO `hui_admin_log` VALUES ('69', '1', 'admin', '2013-03-28 01:13:17', '127.0.0.1');
INSERT INTO `hui_admin_log` VALUES ('70', '1', 'admin', '2013-03-28 09:38:12', '127.0.0.1');
INSERT INTO `hui_admin_log` VALUES ('71', '1', 'admin', '2013-03-28 13:08:47', '127.0.0.1');
INSERT INTO `hui_admin_log` VALUES ('72', '1', 'admin', '2013-03-29 00:16:41', '127.0.0.1');
INSERT INTO `hui_admin_log` VALUES ('73', '1', 'admin', '2013-03-29 09:50:23', '127.0.0.1');
INSERT INTO `hui_admin_log` VALUES ('74', '1', 'admin', '2013-03-29 13:51:38', '127.0.0.1');
INSERT INTO `hui_admin_log` VALUES ('75', '1', 'admin', '2013-04-02 00:55:56', '127.0.0.1');
INSERT INTO `hui_admin_log` VALUES ('76', '2', 'terry', '2013-04-02 01:01:25', '127.0.0.1');
INSERT INTO `hui_admin_log` VALUES ('77', '1', 'admin', '2013-04-02 09:54:11', '127.0.0.1');
INSERT INTO `hui_admin_log` VALUES ('78', '1', 'admin', '2013-04-02 09:57:12', '127.0.0.1');
INSERT INTO `hui_admin_log` VALUES ('79', '2', 'terry', '2013-04-02 09:57:36', '127.0.0.1');
INSERT INTO `hui_admin_log` VALUES ('80', '1', 'admin', '2013-04-02 10:09:34', '127.0.0.1');
INSERT INTO `hui_admin_log` VALUES ('81', '2', 'terry', '2013-04-02 10:13:22', '127.0.0.1');
INSERT INTO `hui_admin_log` VALUES ('82', '2', 'terry', '2013-04-02 10:34:20', '127.0.0.1');
INSERT INTO `hui_admin_log` VALUES ('83', '2', 'terry', '2013-04-02 10:38:29', '127.0.0.1');
INSERT INTO `hui_admin_log` VALUES ('84', '2', 'terry', '2013-04-02 10:53:49', '127.0.0.1');
INSERT INTO `hui_admin_log` VALUES ('85', '2', 'terry', '2013-04-02 10:56:22', '127.0.0.1');
INSERT INTO `hui_admin_log` VALUES ('86', '1', 'admin', '2013-04-03 11:32:09', '127.0.0.1');
INSERT INTO `hui_admin_log` VALUES ('87', '1', 'admin', '2013-04-04 14:46:57', '127.0.0.1');
INSERT INTO `hui_admin_log` VALUES ('88', '1', 'admin', '2013-04-12 09:35:17', '127.0.0.1');
INSERT INTO `hui_admin_log` VALUES ('89', '1', 'admin', '2013-04-12 14:18:12', '127.0.0.1');
INSERT INTO `hui_admin_log` VALUES ('90', '1', 'admin', '2013-04-12 15:34:08', '127.0.0.1');
INSERT INTO `hui_admin_log` VALUES ('91', '1', 'admin', '2013-04-12 15:48:42', '127.0.0.1');
INSERT INTO `hui_admin_log` VALUES ('92', '1', 'admin', '2013-04-12 19:07:34', '127.0.0.1');
INSERT INTO `hui_admin_log` VALUES ('93', '1', 'admin', '2013-04-12 19:10:20', '127.0.0.1');
INSERT INTO `hui_admin_log` VALUES ('94', '1', 'admin', '2013-04-12 19:13:40', '127.0.0.1');

-- ----------------------------
-- Table structure for `hui_config`
-- ----------------------------
DROP TABLE IF EXISTS `hui_config`;
CREATE TABLE `hui_config` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自动增长id',
  `c_module` varchar(100) NOT NULL DEFAULT '' COMMENT '配置模块名称',
  `c_key` varchar(100) NOT NULL DEFAULT '' COMMENT '配置key必须是唯一',
  `c_value` text COMMENT '配置值,多值以逗号分割',
  `c_value_desc` varchar(100) NOT NULL DEFAULT '' COMMENT '配置值描述',
  `c_create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP COMMENT '记录创建时间',
  `c_update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '记录最后更新时间',
  PRIMARY KEY (`c_id`),
  UNIQUE KEY `c_key` (`c_key`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='系统配置表';

-- ----------------------------
-- Records of hui_config
-- ----------------------------
INSERT INTO `hui_config` VALUES ('1', 'ADMIN_ACCESS', 'EXPIRED_TIME', '3600', '登陆超时时间', '2013-03-26 11:12:33', '0000-00-00 00:00:00');
INSERT INTO `hui_config` VALUES ('2', 'ADMIN_ACCESS', 'SYS_ADMIN', 'admin', '系统管理员', '2013-03-26 00:43:50', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for `hui_links`
-- ----------------------------
DROP TABLE IF EXISTS `hui_links`;
CREATE TABLE `hui_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键，自增',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '友情链接文字，显示在友情链接上的文字',
  `image_path` varchar(255) NOT NULL DEFAULT '' COMMENT '友情链接图片地址',
  `link_url` varchar(255) NOT NULL DEFAULT '' COMMENT '友情链接地址，url',
  `is_image_link` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否是图片链接:0否，1是',
  `order` int(11) NOT NULL DEFAULT '0' COMMENT '排序，升序规定前台友情链接的显示顺序',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '友情链接状态，默认1，正常；0，废弃；2，进入回收站',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '友情链接添加时间',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '友情链接最后修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='友情链接表';

-- ----------------------------
-- Records of hui_links
-- ----------------------------

-- ----------------------------
-- Table structure for `hui_role`
-- ----------------------------
DROP TABLE IF EXISTS `hui_role`;
CREATE TABLE `hui_role` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户组ID',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '用户组名称',
  `status` smallint(2) NOT NULL DEFAULT '1' COMMENT '该用户组是否显示：0为不显示，1为显示',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='角色表';

-- ----------------------------
-- Records of hui_role
-- ----------------------------
INSERT INTO `hui_role` VALUES ('1', '超级管理员', '1');
INSERT INTO `hui_role` VALUES ('2', '普通', '1');

-- ----------------------------
-- Table structure for `hui_role_access`
-- ----------------------------
DROP TABLE IF EXISTS `hui_role_access`;
CREATE TABLE `hui_role_access` (
  `role_id` smallint(6) NOT NULL DEFAULT '0' COMMENT '节点id',
  `node_id` smallint(6) unsigned NOT NULL COMMENT '角色id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='角色节点关系表';

-- ----------------------------
-- Records of hui_role_access
-- ----------------------------
INSERT INTO `hui_role_access` VALUES ('2', '2');
INSERT INTO `hui_role_access` VALUES ('2', '4');

-- ----------------------------
-- Table structure for `hui_role_nav`
-- ----------------------------
DROP TABLE IF EXISTS `hui_role_nav`;
CREATE TABLE `hui_role_nav` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '菜单id',
  `name` varchar(50) NOT NULL COMMENT '菜单名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '菜单启用及停用：1.启用，0.停用',
  `sort` int(11) NOT NULL DEFAULT '10' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='菜单表';

-- ----------------------------
-- Records of hui_role_nav
-- ----------------------------
INSERT INTO `hui_role_nav` VALUES ('2', '系统', '1', '100');

-- ----------------------------
-- Table structure for `hui_role_node`
-- ----------------------------
DROP TABLE IF EXISTS `hui_role_node`;
CREATE TABLE `hui_role_node` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '节点ID',
  `action` varchar(60) NOT NULL DEFAULT '' COMMENT '节点控制器',
  `action_name` varchar(60) NOT NULL DEFAULT '' COMMENT '节点控制器名称',
  `module` varchar(60) NOT NULL DEFAULT '' COMMENT '节点模型',
  `module_name` varchar(60) NOT NULL DEFAULT '' COMMENT '节点模型名称',
  `nav_id` int(11) unsigned NOT NULL COMMENT '菜单ID',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '节点是否可用:0为禁用,1为禁用',
  `sort` smallint(6) NOT NULL DEFAULT '0' COMMENT '节点排序',
  `auth_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '授权模式：1:模块授权(module) 2:操作授权(action) 0:节点授权(node)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='节点表';

-- ----------------------------
-- Records of hui_role_node
-- ----------------------------
INSERT INTO `hui_role_node` VALUES ('1', '', '', 'System', '管理员', '2', '1', '10', '1');
INSERT INTO `hui_role_node` VALUES ('2', 'index', '管理员列表', 'System', '管理员', '2', '1', '10', '0');
INSERT INTO `hui_role_node` VALUES ('3', '', '', 'RoleNode', '节点管理', '2', '1', '10', '1');
INSERT INTO `hui_role_node` VALUES ('4', 'index', '节点列表', 'RoleNode', '节点管理', '2', '1', '10', '0');
