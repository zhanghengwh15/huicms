-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 04 月 01 日 11:04
-- 服务器版本: 5.5.29
-- PHP 版本: 5.4.6-1ubuntu1.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `huicms`
--

-- --------------------------------------------------------

--
-- 表的结构 `hui_admin`
--

CREATE TABLE IF NOT EXISTS `hui_admin` (
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='管理员' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `hui_admin`
--

INSERT INTO `hui_admin` (`u_id`, `u_name`, `u_passwd`, `role_id`, `u_ip`, `u_photo`, `u_username`, `u_sex`, `u_phone`, `u_email`, `u_qq`, `u_description`, `u_countlog`, `u_status`, `u_lastlogin_time`, `u_create_time`, `u_update_time`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 0, '127.0.0.1', '/Public/upload/photo/5153a43aa1aee.jpg', '王辉', 0, '13817918575', 'shuaige@52sum.com', '466209365', '', 61, 1, '2013-04-01 09:12:04', '0000-00-00 00:00:00', '2013-03-29 09:50:40'),
(2, 'terry', '585b66ed3c06f4cadcb3084c0a621437', 1, '127.0.0.1', NULL, '王辉', 1, '13817918575', 'admin@52sum.com', '466209365', '', 22, 1, '2013-03-28 00:00:00', '2013-03-28 00:00:00', '2013-03-29 01:43:17');

-- --------------------------------------------------------

--
-- 表的结构 `hui_admin_log`
--

CREATE TABLE IF NOT EXISTS `hui_admin_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '登陆日志ID',
  `u_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '登陆者ID',
  `u_name` varchar(60) NOT NULL DEFAULT '' COMMENT '登陆管理员',
  `log_create` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '登陆时间',
  `log_ip` varchar(15) NOT NULL COMMENT '登陆IP',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='管理员日志' AUTO_INCREMENT=79 ;

--
-- 转存表中的数据 `hui_admin_log`
--

INSERT INTO `hui_admin_log` (`id`, `u_id`, `u_name`, `log_create`, `log_ip`) VALUES
(45, 1, 'admin', '2013-03-26 09:19:12', '127.0.0.1'),
(46, 1, 'admin', '2013-03-26 09:49:42', '127.0.0.1'),
(47, 1, 'admin', '2013-03-26 10:17:12', '127.0.0.1'),
(48, 1, 'admin', '2013-03-26 10:31:40', '127.0.0.1'),
(49, 1, 'admin', '2013-03-26 10:54:49', '127.0.0.1'),
(50, 1, 'admin', '2013-03-26 11:02:52', '127.0.0.1'),
(51, 1, 'admin', '2013-03-26 11:11:38', '127.0.0.1'),
(52, 1, 'admin', '2013-03-26 11:30:13', '127.0.0.1'),
(53, 1, 'admin', '2013-03-26 11:31:47', '127.0.0.1'),
(54, 1, 'admin', '2013-03-26 11:33:47', '127.0.0.1'),
(55, 1, 'admin', '2013-03-26 14:14:22', '127.0.0.1'),
(56, 1, 'admin', '2013-03-26 20:00:24', '127.0.0.1'),
(57, 1, 'admin', '2013-03-26 21:05:14', '127.0.0.1'),
(58, 1, 'admin', '2013-03-26 21:05:36', '127.0.0.1'),
(59, 1, 'admin', '2013-03-26 22:13:32', '127.0.0.1'),
(60, 1, 'admin', '2013-03-27 01:28:33', '127.0.0.1'),
(61, 1, 'admin', '2013-03-27 09:10:42', '127.0.0.1'),
(62, 1, 'admin', '2013-03-27 13:28:21', '127.0.0.1'),
(63, 1, 'admin', '2013-03-27 20:19:25', '127.0.0.1'),
(64, 1, 'admin', '2013-03-27 21:30:28', '127.0.0.1'),
(65, 1, 'admin', '2013-03-27 22:34:50', '127.0.0.1'),
(66, 1, 'admin', '2013-03-27 22:44:34', '127.0.0.1'),
(67, 1, 'admin', '2013-03-27 22:44:55', '127.0.0.1'),
(68, 1, 'admin', '2013-03-27 22:58:58', '127.0.0.1'),
(69, 1, 'admin', '2013-03-28 01:13:17', '127.0.0.1'),
(70, 1, 'admin', '2013-03-28 09:38:12', '127.0.0.1'),
(71, 1, 'admin', '2013-03-28 13:08:47', '127.0.0.1'),
(72, 1, 'admin', '2013-03-29 00:16:41', '127.0.0.1'),
(73, 1, 'admin', '2013-03-29 09:50:23', '127.0.0.1'),
(74, 1, 'admin', '2013-03-29 11:42:02', '127.0.0.1'),
(75, 1, 'admin', '2013-03-29 13:10:23', '127.0.0.1'),
(76, 1, 'admin', '2013-03-31 23:39:30', '127.0.0.1'),
(77, 1, 'admin', '2013-04-01 00:18:36', '127.0.0.1'),
(78, 1, 'admin', '2013-04-01 09:12:04', '127.0.0.1');

-- --------------------------------------------------------

--
-- 表的结构 `hui_config`
--

CREATE TABLE IF NOT EXISTS `hui_config` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自动增长id',
  `c_module` varchar(100) NOT NULL DEFAULT '' COMMENT '配置模块名称',
  `c_key` varchar(100) NOT NULL DEFAULT '' COMMENT '配置key必须是唯一',
  `c_value` text COMMENT '配置值,多值以逗号分割',
  `c_value_desc` varchar(100) NOT NULL DEFAULT '' COMMENT '配置值描述',
  `c_create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP COMMENT '记录创建时间',
  `c_update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '记录最后更新时间',
  PRIMARY KEY (`c_id`),
  UNIQUE KEY `c_key` (`c_key`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='系统配置表，配置值使用序列化数组存储' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `hui_config`
--

INSERT INTO `hui_config` (`c_id`, `c_module`, `c_key`, `c_value`, `c_value_desc`, `c_create_time`, `c_update_time`) VALUES
(1, 'ADMIN_ACCESS', 'EXPIRED_TIME', '3600', '登陆超时时间', '2013-03-26 03:12:33', '0000-00-00 00:00:00'),
(2, 'ADMIN_ACCESS', 'SYS_ADMIN', 'admin', '系统管理员', '2013-03-25 16:43:50', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- 表的结构 `hui_links`
--

CREATE TABLE IF NOT EXISTS `hui_links` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='友情链接表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `hui_role`
--

CREATE TABLE IF NOT EXISTS `hui_role` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户组ID',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '用户组名称',
  `status` smallint(2) NOT NULL DEFAULT '1' COMMENT '该用户组是否显示：0为不显示，1为显示',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='角色表' AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `hui_role`
--

INSERT INTO `hui_role` (`id`, `name`, `status`) VALUES
(1, '超级管理员', 1),
(3, '普通', 1);

-- --------------------------------------------------------

--
-- 表的结构 `hui_role_access`
--

CREATE TABLE IF NOT EXISTS `hui_role_access` (
  `role_id` smallint(6) NOT NULL DEFAULT '0' COMMENT '节点id',
  `node_id` smallint(6) unsigned NOT NULL COMMENT '角色id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='角色节点关系表';

--
-- 转存表中的数据 `hui_role_access`
--

INSERT INTO `hui_role_access` (`role_id`, `node_id`) VALUES
(3, 5),
(3, 6);

-- --------------------------------------------------------

--
-- 表的结构 `hui_role_nav`
--

CREATE TABLE IF NOT EXISTS `hui_role_nav` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '菜单id',
  `name` varchar(50) NOT NULL COMMENT '菜单名称',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '菜单启用及停用：1.启用，0.停用',
  `sort` int(11) NOT NULL DEFAULT '10' COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='菜单表' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `hui_role_nav`
--

INSERT INTO `hui_role_nav` (`id`, `name`, `status`, `sort`) VALUES
(1, '权限', 1, 10);

-- --------------------------------------------------------

--
-- 表的结构 `hui_role_node`
--

CREATE TABLE IF NOT EXISTS `hui_role_node` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '节点ID',
  `action` varchar(60) NOT NULL DEFAULT '' COMMENT '节点控制器',
  `action_name` varchar(60) NOT NULL DEFAULT '' COMMENT '节点控制器名称',
  `module` varchar(60) NOT NULL DEFAULT '' COMMENT '节点模型',
  `module_name` varchar(60) NOT NULL DEFAULT '' COMMENT '节点模型名称',
  `nav_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '所属菜单ID',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '节点是否可用:0为禁用,1为启用',
  `sort` smallint(6) NOT NULL DEFAULT '0' COMMENT '节点排序',
  `auth_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '授权模式：1:模块授权(module) 2:操作授权(action) 0:节点授权(node)',
  `is_show` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否菜单显示:0.不显示,1.显示',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='节点表' AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `hui_role_node`
--

INSERT INTO `hui_role_node` (`id`, `action`, `action_name`, `module`, `module_name`, `nav_id`, `status`, `sort`, `auth_type`, `is_show`) VALUES
(4, '', '', 'RoleNode', '节点', 0, 1, 10, 1, 1),
(5, 'addRoleNode', '添加节点', 'RoleNode', '节点', 0, 1, 10, 0, 1),
(6, 'editRoleNode', '编辑节点', 'RoleNode', '节点', 0, 1, 10, 0, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
