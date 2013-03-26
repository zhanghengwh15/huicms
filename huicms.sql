-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 03 月 26 日 09:19
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
  `u_ip` varchar(15) NOT NULL COMMENT '管理员登陆IP',
  `u_countlog` int(11) NOT NULL COMMENT '登陆次数',
  `u_lastlogin_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '最后登陆时间',
  `u_create_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `u_update_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '更新时间',
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `hui_admin`
--

INSERT INTO `hui_admin` (`u_id`, `u_name`, `u_passwd`, `u_ip`, `u_countlog`, `u_lastlogin_time`, `u_create_time`, `u_update_time`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '127.0.0.1', 28, '2013-03-26 09:19:12', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='管理员日志' AUTO_INCREMENT=46 ;

--
-- 转存表中的数据 `hui_admin_log`
--

INSERT INTO `hui_admin_log` (`id`, `u_id`, `u_name`, `log_create`, `log_ip`) VALUES
(45, 1, 'admin', '2013-03-26 09:19:12', '127.0.0.1');

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
(1, 'ADMIN_ACCESS', 'EXPIRED_TIME', '3600', '登陆超时时间', '2013-03-25 16:43:42', '0000-00-00 00:00:00'),
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='角色表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `hui_role_access`
--

CREATE TABLE IF NOT EXISTS `hui_role_access` (
  `role_id` smallint(6) NOT NULL DEFAULT '0' COMMENT '节点id',
  `node_id` smallint(6) unsigned NOT NULL COMMENT '角色id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='角色节点关系表';

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
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '节点是否可用:0为禁用,1为禁用',
  `sort` smallint(6) NOT NULL DEFAULT '0' COMMENT '节点排序',
  `auth_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '授权模式：1:模块授权(module) 2:操作授权(action) 0:节点授权(node)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='节点表' AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
