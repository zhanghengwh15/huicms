-- phpMyAdmin SQL Dump
-- version 3.5.8.1deb1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 06 月 17 日 00:09
-- 服务器版本: 5.5.31-0ubuntu0.13.04.1
-- PHP 版本: 5.4.9-4ubuntu2

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
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, '127.0.0.1', 'upload/photo/515321a73e88d.jpg', '王辉', 0, '13817918575', 'shuaige@52sum.com', '466209365', '', 245, 1, '2013-06-16 23:46:02', '0000-00-00 00:00:00', '2013-05-28 10:23:34');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='管理员日志' AUTO_INCREMENT=18 ;

--
-- 转存表中的数据 `hui_admin_log`
--

INSERT INTO `hui_admin_log` (`id`, `u_id`, `u_name`, `log_create`, `log_ip`) VALUES
(4, 1, 'admin', '2013-06-09 15:59:01', '127.0.0.1'),
(5, 1, 'admin', '2013-06-10 19:55:10', '127.0.0.1'),
(6, 1, 'admin', '2013-06-12 00:44:05', '127.0.0.1'),
(7, 1, 'admin', '2013-06-15 17:10:11', '127.0.0.1'),
(8, 1, 'admin', '2013-06-15 18:56:32', '127.0.0.1'),
(9, 1, 'admin', '2013-06-15 19:14:21', '127.0.0.1'),
(10, 1, 'admin', '2013-06-15 19:14:40', '127.0.0.1'),
(11, 1, 'admin', '2013-06-15 19:19:03', '127.0.0.1'),
(12, 1, 'admin', '2013-06-15 22:54:42', '127.0.0.1'),
(13, 1, 'admin', '2013-06-16 17:05:09', '127.0.0.1'),
(14, 1, 'admin', '2013-06-16 18:22:07', '127.0.0.1'),
(15, 1, 'admin', '2013-06-16 21:22:17', '127.0.0.1'),
(16, 1, 'admin', '2013-06-16 22:02:39', '127.0.0.1'),
(17, 1, 'admin', '2013-06-16 23:46:02', '127.0.0.1');

-- --------------------------------------------------------

--
-- 表的结构 `hui_category`
--

CREATE TABLE IF NOT EXISTS `hui_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '文章分类ID',
  `title` varchar(50) NOT NULL COMMENT '分类标题',
  `alias` varchar(32) NOT NULL COMMENT '分类别名',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父ID',
  `description` text NOT NULL COMMENT '分类描述',
  `order` int(5) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否显示',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='文章分类' AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `hui_category`
--

INSERT INTO `hui_category` (`id`, `title`, `alias`, `pid`, `description`, `order`, `status`, `create_time`, `update_time`) VALUES
(2, 'MVC', 'mvc', 1, 'MVC', 10, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

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
  KEY `c_key` (`c_key`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='系统配置表，配置值使用序列化数组存储' AUTO_INCREMENT=54 ;

--
-- 转存表中的数据 `hui_config`
--

INSERT INTO `hui_config` (`c_id`, `c_module`, `c_key`, `c_value`, `c_value_desc`, `c_create_time`, `c_update_time`) VALUES
(1, 'ADMIN_ACCESS', 'EXPIRED_TIME', '500', '登陆超时时间', '2013-05-03 02:25:45', '0000-00-00 00:00:00'),
(2, 'ADMIN_ACCESS', 'SYS_ADMIN', 'admin', '系统管理员', '2013-03-25 16:43:50', '0000-00-00 00:00:00'),
(3, '', '', NULL, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'WEBSITE', 'WEBSITE', '{"site_name":"HuiCMS\\u5185\\u5bb9\\u7ba1\\u7406\\u7cfb\\u7edf","site_title":"HuiCms","site_keyword":"HuiCMS,\\u5f00\\u6e90cms,\\u514d\\u8d39cms,\\u5c0f\\u5de7cms,\\u7b80\\u5355cms","site_description":"HuiCMS,\\u5f00\\u6e90cms,\\u514d\\u8d39cms,\\u5c0f\\u5de7cms,\\u7b80\\u5355cms","site_icp":"\\u6caaICP\\u590712019677\\u53f7","site_code":"","site_status":"1","site_close":""}', '站点信息配置', '2013-06-09 09:19:12', '2013-06-09 09:19:12'),
(45, 'CODE_SET', 'MREGISTER', '1', '会员注册', '2013-06-15 14:54:52', '2013-06-15 14:54:52'),
(46, 'CODE_SET', 'RELOGIN', '1', '前台登陆', '2013-06-15 14:54:53', '2013-06-15 14:54:53'),
(47, 'CODE_SET', 'BALOGIN', '1', '后台登陆', '2013-06-15 14:54:53', '2013-06-15 14:54:53'),
(48, 'CODE_SET', 'BUILDTYPE', '1', '验证码生成类型', '2013-06-15 14:54:53', '2013-06-15 14:54:53'),
(49, 'CODE_SET', 'EXPANDTYPE', 'png', '选择验证码文件类型', '2013-06-15 14:54:53', '2013-06-15 14:54:53'),
(50, 'CODE_SET', 'RECODESIZE', '{"width":"70","height":"30"}', '前台验证码图片大小', '2013-06-15 14:54:53', '2013-06-15 14:54:53'),
(51, 'CODE_SET', 'BACODESIZE', '{"width":"100","height":"38"}', '后台验证码图片大小', '2013-06-15 14:54:53', '2013-06-15 14:54:53'),
(52, 'CODE_SET', 'RECODENUMS', '4', '前台验证码字数', '2013-06-15 14:54:53', '2013-06-15 14:54:53'),
(53, 'CODE_SET', 'BACODENUMS', '6', '后台验证码字数', '2013-06-15 14:54:53', '2013-06-15 14:54:53');

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
(4, '普通', 'upload/photo/515321a73e88d.jpg', 'http://www.huicms.cn', '', '#1D1363', 1, 30, 1, '2013-04-14 07:46:02', '2013-06-04 15:05:03');

-- --------------------------------------------------------

--
-- 表的结构 `hui_members`
--

CREATE TABLE IF NOT EXISTS `hui_members` (
  `m_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `m_name` varchar(50) NOT NULL DEFAULT '' COMMENT '用户名',
  `m_nickname` varchar(50) DEFAULT '' COMMENT '用户昵称',
  `m_passwd` varchar(32) NOT NULL COMMENT '密码',
  `ml_id` int(11) NOT NULL COMMENT '会员等级ID',
  `m_balance` decimal(8,2) NOT NULL DEFAULT '0.00' COMMENT '账户余额',
  `m_sex` tinyint(1) NOT NULL DEFAULT '0' COMMENT '性别：0.保密，1.男，2.女',
  `m_pic` varchar(200) DEFAULT NULL COMMENT '会员头像',
  `m_email` varchar(60) NOT NULL COMMENT '邮箱',
  `m_login_ip` varchar(60) DEFAULT NULL COMMENT '登陆IP',
  `m_login_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP COMMENT '登陆时间',
  `m_weibo_uid` varchar(20) DEFAULT NULL COMMENT '对应的新浪微博uid',
  `m_tencent_uid` varchar(20) DEFAULT NULL COMMENT '腾讯微博UID',
  `m_verify_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '电子邮件验证标示 0未验证，1已验证',
  `m_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否审核，0未审核，1已审核',
  `m_reg_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '注册时间',
  `m_reg_ip` varchar(15) NOT NULL COMMENT '注册IP',
  `m_qq` int(15) DEFAULT NULL COMMENT '用户QQ',
  PRIMARY KEY (`m_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='会员表' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `hui_members`
--

INSERT INTO `hui_members` (`m_id`, `m_name`, `m_nickname`, `m_passwd`, `ml_id`, `m_balance`, `m_sex`, `m_pic`, `m_email`, `m_login_ip`, `m_login_time`, `m_weibo_uid`, `m_tencent_uid`, `m_verify_status`, `m_status`, `m_reg_time`, `m_reg_ip`, `m_qq`) VALUES
(1, 'sje410', '快乐DE小子3', '585b66ed3c06f4cadcb3084c0a621437', 0, 0.00, 2, 'upload/photo/515321a73e88d.jpg', 'admin@huicms.cn', '127.0.0.1', '2013-06-02 08:10:48', NULL, NULL, 0, 0, '2013-06-01 06:24:34', '127.0.0.1', 466209365);

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
-- 表的结构 `hui_nav`
--

CREATE TABLE IF NOT EXISTS `hui_nav` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '菜单ID',
  `name` varchar(50) NOT NULL COMMENT '菜单名称',
  `alias_name` varchar(50) NOT NULL COMMENT '导航别名',
  `url` text COMMENT '菜单URL',
  `order` int(11) NOT NULL DEFAULT '10' COMMENT '排序',
  `type` varchar(25) NOT NULL DEFAULT 'main' COMMENT '导航类型:main.主导航,bottom.底部导航',
  `target` varchar(15) NOT NULL DEFAULT '_blank' COMMENT '是否新窗口打开:0.否,1是',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否显示',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='前台菜单' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `hui_nav`
--

INSERT INTO `hui_nav` (`id`, `name`, `alias_name`, `url`, `order`, `type`, `target`, `status`, `create_time`, `update_time`) VALUES
(1, '首页', 'index', '/', 10, 'main', '0', 1, '2013-05-18 16:00:00', '2013-05-30 08:06:19');

-- --------------------------------------------------------

--
-- 表的结构 `hui_oauth`
--

CREATE TABLE IF NOT EXISTS `hui_oauth` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '第三方登陆ID',
  `code` varchar(50) NOT NULL COMMENT '代码(唯一标识)',
  `name` varchar(50) NOT NULL COMMENT '名称',
  `config` text NOT NULL COMMENT '以json格式存储配置信息',
  `description` text NOT NULL COMMENT '描述',
  `order` int(11) NOT NULL DEFAULT '10' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `author` varchar(50) NOT NULL COMMENT '作者',
  `version` varchar(50) NOT NULL COMMENT '版本',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='第三方登陆表' AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `hui_oauth`
--

INSERT INTO `hui_oauth` (`id`, `code`, `name`, `config`, `description`, `order`, `status`, `author`, `version`) VALUES
(1, 'Sina', '新浪微薄登录', '{"app_key":"","app_secret":""}', '申请地址：http://open.weibo.com/', 10, 1, 'HUICMS研发团队', '1.0'),
(2, 'Qq', 'QQ登录', '{"app_key":"","app_secret":""}', '申请地址：http://connect.opensns.qq.com/', 10, 1, 'HuiCms研发团队', '1.0'),
(3, 'Tqq', 'QQ微博登录', '{"app_key":"","app_secret":""}', '申请地址：http://open.t.qq.com/', 10, 1, 'HuiCms研发团队', '1.0');

-- --------------------------------------------------------

--
-- 表的结构 `hui_payment`
--

CREATE TABLE IF NOT EXISTS `hui_payment` (
  `pay_id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL COMMENT '支付方式名称',
  `pay_name` varchar(120) NOT NULL COMMENT '支付方式',
  `pay_code` varchar(20) NOT NULL COMMENT '支付代码',
  `pay_desc` text NOT NULL COMMENT '支付描述',
  `pay_fee` varchar(10) NOT NULL DEFAULT '0' COMMENT '手续费用',
  `pay_config` text NOT NULL COMMENT '配置信息以json格式存入',
  `pay_is_cod` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '支付手续费类型',
  `pay_is_online` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否在线支付',
  `pay_order` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '支付排序',
  `pay_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '支付是否启用',
  `pay_author` varchar(100) NOT NULL COMMENT '作者',
  `pay_website` varchar(100) NOT NULL COMMENT '支付网址',
  `pay_version` varchar(20) NOT NULL COMMENT '版本号',
  PRIMARY KEY (`pay_id`),
  UNIQUE KEY `pay_code` (`pay_code`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='支付方式' AUTO_INCREMENT=14 ;

--
-- 转存表中的数据 `hui_payment`
--

INSERT INTO `hui_payment` (`pay_id`, `name`, `pay_name`, `pay_code`, `pay_desc`, `pay_fee`, `pay_config`, `pay_is_cod`, `pay_is_online`, `pay_order`, `pay_status`, `pay_author`, `pay_website`, `pay_version`) VALUES
(13, '支付宝', '支付宝', 'Alipay', '支付宝是国内领先的独立第三方支付平台，由阿里巴巴集团创办。致力于为中国电子商务提供“简单、安全、快速”的在线支付解决方案。<a href="http://b.alipay.com/" target="_blank"><font color="red">立即在线申请</font></a>', '0', '{"alipay_account":{"name":"\\u652f\\u4ed8\\u5b9d\\u5e10\\u6237","type":"text","value":""},"alipay_key":{"name":"\\u4ea4\\u6613\\u5b89\\u5168\\u6821\\u9a8c\\u7801(key)","type":"text","value":""},"alipay_partner":{"name":"\\u5408\\u4f5c\\u8005\\u8eab\\u4efd(parterID)","type":"text","value":""},"service_type":{"name":"\\u9009\\u62e9\\u63a5\\u53e3\\u7c7b\\u578b","type":"select","value":"0","range":["\\u4f7f\\u7528\\u62c5\\u4fdd\\u4ea4\\u6613\\u63a5\\u53e3","\\u4f7f\\u7528\\u6807\\u51c6\\u53cc\\u63a5\\u53e3","\\u4f7f\\u7528\\u5373\\u65f6\\u5230\\u8d26\\u4ea4\\u6613\\u63a5\\u53e3"]}}', 0, 1, 10, 1, 'HUICMS研发团队', 'http://www.alipay.com', '1.0');

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
(6, '商品管理', 0, 90),
(7, '模板管理', 1, 100),
(8, '数据', 1, 110),
(9, '全局', 1, 120),
(10, '订单管理', 0, 85);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='节点表' AUTO_INCREMENT=107 ;

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
(42, '', '', 'MemberLevel', '会员等级管理', 4, 1, 10, 1, 1),
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
(100, 'editCustomer', '编辑客服', 'Customer', '在线客服', 2, 1, 10, 0, 0),
(101, '', '', 'Oauth', '登陆接口', 2, 1, 10, 1, 1),
(102, 'index', '接口列表', 'Oauth', '登陆接口', 2, 1, 10, 0, 1),
(103, '', '', 'Nav', '导航管理', 7, 1, 10, 1, 1),
(104, 'index', '导航设置', 'Nav', '导航管理', 7, 1, 10, 0, 1),
(105, 'addNav', '添加导航', 'Nav', '导航管理', 7, 1, 10, 0, 1),
(106, 'editNav', '编辑导航', 'Nav', '导航管理', 7, 1, 10, 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
