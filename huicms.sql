-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 04 月 17 日 23:39
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='管理员' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `hui_admin`
--

INSERT INTO `hui_admin` (`u_id`, `u_name`, `u_passwd`, `role_id`, `u_ip`, `u_photo`, `u_username`, `u_sex`, `u_phone`, `u_email`, `u_qq`, `u_description`, `u_countlog`, `u_status`, `u_lastlogin_time`, `u_create_time`, `u_update_time`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, '127.0.0.1', 'upload/images/20130413/13658436934230.png', '王辉', 0, '13817918575', 'shuaige@52sum.com', '466209365', '', 122, 1, '2013-04-17 21:19:51', '0000-00-00 00:00:00', '2013-04-13 17:02:13');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='管理员日志' AUTO_INCREMENT=152 ;

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
(78, 1, 'admin', '2013-04-01 09:12:04', '127.0.0.1'),
(79, 3, '测试', '2013-04-01 11:16:51', '127.0.0.1'),
(80, 1, 'admin', '2013-04-01 12:52:00', '127.0.0.1'),
(81, 1, 'admin', '2013-04-01 19:48:47', '127.0.0.1'),
(82, 1, 'admin', '2013-04-01 20:09:19', '127.0.0.1'),
(83, 1, 'admin', '2013-04-01 20:14:02', '127.0.0.1'),
(84, 3, '测试', '2013-04-01 20:14:25', '127.0.0.1'),
(85, 3, '测试', '2013-04-01 22:41:32', '127.0.0.1'),
(86, 3, '测试', '2013-04-01 22:43:22', '127.0.0.1'),
(87, 3, '测试', '2013-04-01 22:46:32', '127.0.0.1'),
(88, 3, '测试', '2013-04-01 22:47:59', '127.0.0.1'),
(89, 1, 'admin', '2013-04-01 22:48:12', '127.0.0.1'),
(90, 3, '测试', '2013-04-01 22:50:05', '127.0.0.1'),
(91, 1, 'admin', '2013-04-01 23:36:03', '127.0.0.1'),
(92, 3, '测试', '2013-04-01 23:36:49', '127.0.0.1'),
(93, 1, 'admin', '2013-04-01 23:37:49', '127.0.0.1'),
(94, 3, '测试', '2013-04-01 23:39:30', '127.0.0.1'),
(95, 1, 'admin', '2013-04-01 23:48:37', '127.0.0.1'),
(96, 3, '测试', '2013-04-01 23:53:05', '127.0.0.1'),
(97, 3, '测试', '2013-04-02 00:00:31', '127.0.0.1'),
(98, 3, '测试', '2013-04-02 00:02:59', '127.0.0.1'),
(99, 1, 'admin', '2013-04-02 00:13:33', '127.0.0.1'),
(100, 1, 'admin', '2013-04-02 00:20:31', '127.0.0.1'),
(101, 4, 'demo', '2013-04-02 00:26:15', '127.0.0.1'),
(102, 1, 'admin', '2013-04-02 00:28:34', '127.0.0.1'),
(103, 1, 'admin', '2013-04-02 23:10:22', '127.0.0.1'),
(104, 1, 'admin', '2013-04-04 18:35:16', '127.0.0.1'),
(105, 1, 'admin', '2013-04-07 22:56:36', '127.0.0.1'),
(106, 1, 'admin', '2013-04-09 19:51:55', '127.0.0.1'),
(107, 1, 'admin', '2013-04-09 20:30:54', '127.0.0.1'),
(108, 1, 'admin', '2013-04-09 21:17:28', '127.0.0.1'),
(109, 1, 'admin', '2013-04-09 22:14:21', '127.0.0.1'),
(110, 1, 'admin', '2013-04-09 23:15:56', '127.0.0.1'),
(111, 1, 'admin', '2013-04-10 23:06:38', '127.0.0.1'),
(112, 1, 'admin', '2013-04-13 16:01:57', '127.0.0.1'),
(113, 1, 'admin', '2013-04-13 16:11:51', '127.0.0.1'),
(114, 1, 'admin', '2013-04-13 22:41:50', '127.0.0.1'),
(115, 1, 'admin', '2013-04-13 23:50:37', '127.0.0.1'),
(116, 1, 'admin', '2013-04-13 23:59:47', '127.0.0.1'),
(117, 1, 'admin', '2013-04-14 00:33:29', '127.0.0.1'),
(118, 1, 'admin', '2013-04-14 14:27:09', '127.0.0.1'),
(119, 1, 'admin', '2013-04-14 17:24:40', '127.0.0.1'),
(120, 1, 'admin', '2013-04-14 22:14:25', '127.0.0.1'),
(121, 1, 'admin', '2013-04-15 01:14:32', '127.0.0.1'),
(122, 1, 'admin', '2013-04-15 01:39:16', '127.0.0.1'),
(123, 1, 'admin', '2013-04-15 01:42:29', '127.0.0.1'),
(124, 1, 'admin', '2013-04-15 01:43:18', '127.0.0.1'),
(125, 1, 'admin', '2013-04-15 01:44:38', '127.0.0.1'),
(126, 1, 'admin', '2013-04-15 01:52:48', '127.0.0.1'),
(127, 1, 'admin', '2013-04-15 01:59:51', '127.0.0.1'),
(128, 1, 'admin', '2013-04-15 02:21:59', '127.0.0.1'),
(129, 1, 'admin', '2013-04-15 09:30:49', '127.0.0.1'),
(130, 1, 'admin', '2013-04-15 12:02:48', '127.0.0.1'),
(131, 1, 'admin', '2013-04-15 12:55:32', '127.0.0.1'),
(132, 1, 'admin', '2013-04-15 13:11:22', '127.0.0.1'),
(133, 1, 'admin', '2013-04-15 19:43:07', '127.0.0.1'),
(134, 1, 'admin', '2013-04-15 20:05:06', '127.0.0.1'),
(135, 1, 'admin', '2013-04-15 20:09:08', '127.0.0.1'),
(136, 1, 'admin', '2013-04-15 20:14:26', '127.0.0.1'),
(137, 1, 'admin', '2013-04-15 20:36:49', '127.0.0.1'),
(138, 1, 'admin', '2013-04-15 20:41:36', '127.0.0.1'),
(139, 1, 'admin', '2013-04-15 22:44:26', '127.0.0.1'),
(140, 1, 'admin', '2013-04-16 00:11:45', '127.0.0.1'),
(141, 1, 'admin', '2013-04-16 01:46:21', '127.0.0.1'),
(142, 1, 'admin', '2013-04-16 21:29:12', '127.0.0.1'),
(143, 1, 'admin', '2013-04-16 22:09:27', '127.0.0.1'),
(144, 1, 'admin', '2013-04-16 22:31:55', '127.0.0.1'),
(145, 1, 'admin', '2013-04-16 23:26:41', '127.0.0.1'),
(146, 1, 'admin', '2013-04-17 00:35:47', '127.0.0.1'),
(147, 1, 'admin', '2013-04-17 00:49:10', '127.0.0.1'),
(148, 1, 'admin', '2013-04-17 01:10:13', '127.0.0.1'),
(149, 1, 'admin', '2013-04-17 09:53:10', '127.0.0.1'),
(150, 1, 'admin', '2013-04-17 20:41:24', '127.0.0.1'),
(151, 1, 'admin', '2013-04-17 21:19:51', '127.0.0.1');

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
  PRIMARY KEY (`c_id`)
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
  `image_path` varchar(255) DEFAULT '' COMMENT '友情链接图片地址',
  `link_url` varchar(255) NOT NULL DEFAULT '' COMMENT '友情链接地址，url',
  `description` text COMMENT '链接描述',
  `color` varchar(50) DEFAULT NULL COMMENT '链接颜色',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '链接类型:0.文字类型,1.图片类型',
  `order` int(11) NOT NULL DEFAULT '0' COMMENT '排序，升序规定前台友情链接的显示顺序',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '友情链接状态，默认1，正常；0，废弃；2，进入回收站',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '友情链接添加时间',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '友情链接最后修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='友情链接表' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `hui_links`
--

INSERT INTO `hui_links` (`id`, `name`, `image_path`, `link_url`, `description`, `color`, `type`, `order`, `status`, `create_time`, `update_time`) VALUES
(1, 'PHP工作室', '/Public/Lib/ueditor/php/../../../upload//photo/5153214e77636.jpg', 'http://www.baidu.com', '', '#2F3192', 1, 10, 1, '0000-00-00 00:00:00', '2013-04-14 10:14:09'),
(3, '中文站', '', 'http://www.baidu.com', '', '#707070', 0, 20, 1, '2013-04-14 07:44:22', '0000-00-00 00:00:00'),
(4, '普通', 'upload/photo/515321a73e88d.jpg', 'http://www.huicms.cn', '', '#FF0000', 1, 30, 1, '2013-04-14 07:46:02', '2013-04-14 10:16:39');

-- --------------------------------------------------------

--
-- 表的结构 `hui_message`
--

CREATE TABLE IF NOT EXISTS `hui_message` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '留言id',
  `title` varchar(50) NOT NULL COMMENT '留言标题',
  `content` text NOT NULL COMMENT '留言内容',
  `m_id` int(11) NOT NULL DEFAULT '0' COMMENT '留言者',
  `nickname` varchar(50) NOT NULL COMMENT '留言姓名',
  `email` varchar(50) NOT NULL COMMENT '留言EMAIL',
  `qq` varchar(14) DEFAULT NULL COMMENT '留言QQ',
  `visible` tinyint(1) NOT NULL COMMENT '是否管理员只能可看:0.否,1.是',
  `ip` varchar(15) NOT NULL COMMENT '留言者IP',
  `audit` tinyint(1) NOT NULL DEFAULT '0' COMMENT '审核:0.未审核,1,已审核',
  `u_id` int(11) DEFAULT NULL COMMENT '留言者id',
  `replyid` int(11) DEFAULT NULL COMMENT '回复id',
  `addtime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '留言时间',
  `updatetime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '留言更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='留言表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `hui_role`
--

CREATE TABLE IF NOT EXISTS `hui_role` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户组ID',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '用户组名称',
  `status` smallint(2) NOT NULL DEFAULT '1' COMMENT '该用户组是否显示：0为不显示，1为显示',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='角色表' AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `hui_role`
--

INSERT INTO `hui_role` (`id`, `name`, `status`) VALUES
(1, '超级管理员', 1),
(3, '普通', 1),
(4, '测试', 1);

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
(4, 5),
(4, 6),
(4, 7),
(4, 22),
(4, 10),
(4, 11),
(4, 12),
(4, 23),
(4, 24),
(4, 14),
(4, 15),
(4, 16),
(4, 25),
(4, 18),
(4, 19),
(4, 20),
(4, 21),
(3, 7),
(3, 12),
(3, 16),
(3, 20);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='菜单表' AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `hui_role_nav`
--

INSERT INTO `hui_role_nav` (`id`, `name`, `status`, `sort`) VALUES
(1, '系统管理', 1, 10),
(2, '模块管理', 1, 60),
(3, '控制台', 1, 0),
(4, '用户管理', 1, 70),
(5, '内容管理', 1, 80),
(6, '商品管理', 1, 90),
(7, '模板管理', 0, 100),
(8, '数据', 1, 110),
(9, '全局', 1, 120),
(10, '订单管理', 1, 85);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='节点表' AUTO_INCREMENT=101 ;

--
-- 转存表中的数据 `hui_role_node`
--

INSERT INTO `hui_role_node` (`id`, `action`, `action_name`, `module`, `module_name`, `nav_id`, `status`, `sort`, `auth_type`, `is_show`) VALUES
(4, '', '', 'RoleNode', '节点管理', 1, 1, 30, 1, 1),
(5, 'addRoleNode', '添加节点', 'RoleNode', '节点管理', 1, 1, 30, 0, 1),
(6, 'editRoleNode', '编辑节点', 'RoleNode', '节点管理', 1, 1, 30, 0, 0),
(7, 'index', '节点列表', 'RoleNode', '节点管理', 1, 1, 30, 0, 1),
(9, '', '', 'System', '管理员', 1, 1, 10, 1, 1),
(10, 'index', '管理员列表', 'System', '管理员', 1, 1, 10, 0, 1),
(11, 'pageAddAdmin', '添加管理员', 'System', '管理员', 1, 1, 20, 0, 1),
(12, 'pageEditAdmin', '编辑管理员', 'System', '管理员', 1, 1, 10, 0, 0),
(13, '', '', 'Role', '角色管理', 1, 1, 20, 1, 1),
(14, 'index', '角色列表', 'Role', '角色管理', 1, 1, 20, 0, 1),
(15, 'addRole', '添加角色', 'Role', '角色管理', 1, 1, 20, 0, 1),
(16, 'editRole', '编辑角色', 'Role', '角色管理', 1, 1, 20, 0, 0),
(17, '', '', 'RoleNav', '菜单管理', 1, 1, 40, 1, 1),
(18, 'index', '菜单列表', 'RoleNav', '菜单管理', 1, 1, 40, 0, 1),
(19, 'addRoleNav', '添加菜单', 'RoleNav', '菜单管理', 1, 1, 40, 0, 1),
(20, 'editRoleNav', '编辑菜单', 'RoleNav', '菜单管理', 1, 1, 40, 0, 0),
(21, 'doDelete', '删除菜单', 'RoleNav', '菜单管理', 1, 1, 40, 0, 0),
(22, 'doDelete', '删除节点', 'RoleNode', '节点管理', 1, 1, 30, 0, 0),
(23, 'pageLogList', '管理员登陆日志', 'System', '管理员', 1, 1, 10, 0, 1),
(24, 'doDelete', '删除管理员', 'System', '管理员', 1, 1, 10, 0, 0),
(25, 'doDelete', '删除角色', 'Role', '角色管理', 1, 1, 20, 0, 0),
(26, '', '', 'Links', '友情链接管理', 2, 1, 60, 1, 1),
(27, 'index', '链接列表', 'Links', '友情链接管理', 2, 1, 10, 0, 1),
(28, 'addLinks', '添加链接', 'Links', '友情链接管理', 2, 1, 10, 0, 1),
(29, 'editLinks', '编辑链接', 'Links', '友情链接', 2, 1, 0, 0, 0),
(33, '', '', 'Message', '留言管理', 2, 1, 10, 1, 1),
(34, 'index', '留言列表', 'Message', '留言管理', 2, 1, 10, 0, 1),
(35, '', '', 'Index', '控制台', 3, 1, 10, 1, 1),
(36, 'index', '欢迎页面', 'Index', '控制台', 3, 1, 10, 0, 1),
(37, 'aboutUs', '关于我们', 'Index', '控制台', 3, 1, 10, 0, 1),
(38, 'index', '会员列表', 'Member', '会员管理', 4, 1, 10, 0, 1),
(39, 'addMember', '添加会员', 'Member', '会员管理', 4, 1, 10, 0, 1),
(40, 'editMember', '编辑会员', 'Member', '会员管理', 4, 1, 10, 0, 0),
(41, '', '', 'MemberGroup', '会员组管理', 4, 1, 10, 1, 1),
(42, '', '', '会员等级管理', 'MemberLevel', 4, 1, 10, 1, 1),
(43, 'index', '会员等级列表', 'MemberLevel', '会员等级管理', 4, 1, 10, 0, 1),
(44, 'addMemberLevel', '添加会员等级', 'MemberLevel', '会员等级管理', 4, 1, 10, 0, 1),
(45, '', '', 'Article', '文章管理', 5, 1, 10, 1, 1),
(46, 'index', '文章列表', 'Article', '文章管理', 5, 1, 10, 0, 1),
(47, 'addArticle', '添加文章', 'Article', '文章管理', 5, 1, 10, 0, 1),
(48, 'editArticle', '编辑文章', 'Article', '文章管理', 5, 1, 10, 0, 0),
(49, 'doDelete', '删除文章', 'Article', '文章管理', 5, 1, 10, 0, 0),
(50, '', '', 'ArticleCategory', '文章分类管理', 5, 1, 10, 1, 1),
(51, 'index', '文章分类列表', 'ArticleCategory', '文章分类管理', 5, 1, 10, 0, 1),
(52, 'addArticleCategory', '添加文章分类', 'ArticleCategory', '文章分类管理', 5, 1, 10, 0, 1),
(53, 'editArticleCategory', '编辑文章分类', 'ArticleCategory', '文章分类管理', 5, 1, 10, 0, 0),
(54, '', '', 'Goods', '商品管理', 6, 1, 10, 1, 1),
(55, 'index', '商品列表', 'Goods', '商品管理', 6, 1, 10, 0, 1),
(56, 'addGoods', '添加商品', 'Goods', '商品管理', 6, 1, 10, 0, 1),
(57, 'editGoods', '编辑商品', 'Goods', '商品管理', 6, 1, 10, 0, 0),
(58, '', '', 'Theme', '模板管理', 7, 1, 10, 1, 1),
(59, 'index', '模板列表', 'Theme', '模板管理', 7, 1, 10, 0, 1),
(60, '', '', 'Orders', '订单管理', 10, 1, 10, 1, 1),
(61, 'index', '订单列表', 'Orders', '订单管理', 10, 1, 10, 0, 1),
(62, '', '', 'Ad', '广告管理', 2, 1, 10, 1, 1),
(63, 'index', '广告列表', 'Ad', '广告管理', 2, 1, 10, 0, 1),
(64, 'addAd', '添加广告', 'Ad', '广告管理', 2, 1, 10, 0, 1),
(65, 'editAd', '编辑广告', 'Ad', '广告管理', 2, 1, 10, 0, 0),
(66, '', '', 'Database', '数据库管理', 8, 1, 10, 1, 1),
(67, 'backup', '数据备份', 'Database', '数据库管理', 8, 1, 10, 0, 1),
(68, 'restore', '数据恢复', 'Database', '数据库管理', 8, 1, 10, 0, 1),
(69, '', '', 'Delivery', '配送设置', 10, 1, 10, 1, 1),
(70, 'index', '配送公司列表', 'Delivery', '配送设置', 10, 1, 10, 0, 1),
(71, 'addDelivery', '添加配送公司', 'Delivery', '配送设置', 10, 1, 10, 0, 1),
(72, 'editDelivery', '编辑配送公司', 'Delivery', '配送设置', 10, 1, 10, 0, 0),
(73, '', '', 'GoodsCategory', '商品分类管理', 6, 1, 10, 1, 1),
(74, 'index', '商品分类列表', 'GoodsCategory', '商品分类管理', 6, 1, 10, 0, 1),
(75, 'addGoodsCategory', '添加商品分类', 'GoodsCategory', '商品分类管理', 6, 1, 10, 0, 1),
(76, 'editGoodsCategory', '编辑商品分类', 'GoodsCategory', '商品分类管理', 6, 1, 10, 0, 0),
(77, '', '', 'Download', '资源下载', 2, 1, 10, 1, 1),
(78, 'index', '资源列表', 'Download', '资源下载', 5, 1, 10, 0, 1),
(79, 'addDownload', '添加资源', 'Download', '资源下载', 5, 1, 10, 0, 1),
(80, 'editDownload', '编辑资源', 'Download', '资源下载', 0, 1, 10, 0, 0),
(81, 'logDatabase', '数据操作日志', 'Database', '数据库管理', 8, 1, 1, 0, 1),
(82, '', '', 'Payment', '支付设置', 10, 1, 10, 1, 1),
(83, 'index', '支付列表', 'Payment', '支付设置', 10, 1, 10, 0, 1),
(84, 'addPayment', '添加支付', 'Payment', '支付设置', 10, 1, 10, 0, 1),
(85, 'editPayment', '编辑支付接口', 'Payment', '支付设置', 10, 1, 10, 0, 0),
(86, '', '', 'Comment', '商品评论', 6, 1, 10, 1, 1),
(87, 'index', '评论列表', 'Comment', '商品评论', 6, 1, 10, 0, 1),
(88, 'Set', '评论设置', 'Comment', '商品评论', 6, 1, 1, 0, 1),
(89, '', '', 'Brand', '品牌管理', 6, 1, 10, 1, 1),
(90, 'index', '品牌列表', 'Brand', '品牌管理', 6, 1, 10, 0, 1),
(91, 'addBrand', '添加品牌', 'Brand', '品牌管理', 6, 1, 10, 0, 1),
(92, 'editBrand', '编辑品牌', 'Brand', '品牌管理', 6, 1, 10, 0, 0),
(93, '', '', 'Setting', '核心设置', 9, 1, 10, 1, 1),
(94, 'index', '站点设置', 'Setting', '核心设置', 9, 1, 10, 0, 1),
(95, 'Case', '缓存设置', 'Setting', '核心设置', 9, 1, 10, 0, 1),
(96, 'Security', '安全设置', 'Setting', '核心设置', 9, 1, 10, 0, 1),
(97, '', '', 'Customer', '在线客服', 2, 1, 10, 1, 1),
(98, 'index', '客服列表', 'Customer', '在线客服', 2, 1, 10, 0, 1),
(99, 'addCustomer', '添加客服', 'Customer', '在线客服', 2, 1, 10, 0, 1),
(100, 'editCustomer', '编辑客服', 'Customer', '在线客服', 2, 1, 10, 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
