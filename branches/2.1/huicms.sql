-- phpMyAdmin SQL Dump
-- version 3.5.8.1deb1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 12 月 11 日 13:03
-- 服务器版本: 5.5.34-0ubuntu0.13.04.1
-- PHP 版本: 5.4.9-4ubuntu2.3

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
(2, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, '127.0.0.1', 'upload/photo/515321a73e88d.jpg', '王辉', 1, '13817918575', 'shuaige@52sum.com', '466209365', '', 7, 1, '2013-12-11 11:51:15', '2013-12-10 00:00:00', '2013-12-11 09:51:22');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='管理员日志' AUTO_INCREMENT=271 ;

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
(151, 1, 'admin', '2013-04-17 21:19:51', '127.0.0.1'),
(152, 1, 'admin', '2013-04-18 09:12:56', '127.0.0.1'),
(153, 1, 'admin', '2013-04-18 11:48:32', '127.0.0.1'),
(154, 1, 'admin', '2013-04-18 17:02:50', '127.0.0.1'),
(155, 1, 'admin', '2013-04-19 14:21:04', '127.0.0.1'),
(156, 1, 'admin', '2013-04-23 22:44:36', '127.0.0.1'),
(157, 1, 'admin', '2013-04-25 23:18:43', '127.0.0.1'),
(158, 1, 'admin', '2013-04-26 09:29:43', '127.0.0.1'),
(159, 1, 'admin', '2013-04-26 14:10:49', '127.0.0.1'),
(160, 1, 'admin', '2013-04-26 20:51:53', '127.0.0.1'),
(161, 1, 'admin', '2013-04-26 21:49:16', '127.0.0.1'),
(162, 1, 'admin', '2013-04-27 09:24:12', '127.0.0.1'),
(163, 1, 'admin', '2013-04-27 09:45:20', '127.0.0.1'),
(164, 1, 'admin', '2013-04-27 23:35:16', '127.0.0.1'),
(165, 1, 'admin', '2013-04-28 09:23:11', '127.0.0.1'),
(166, 1, 'admin', '2013-04-28 09:58:28', '127.0.0.1'),
(167, 1, 'admin', '2013-04-28 16:09:29', '127.0.0.1'),
(168, 1, 'admin', '2013-04-30 13:17:08', '127.0.0.1'),
(169, 1, 'admin', '2013-05-02 17:16:14', '127.0.0.1'),
(170, 1, 'admin', '2013-05-07 16:15:30', '127.0.0.1'),
(171, 1, 'admin', '2013-05-08 09:43:21', '127.0.0.1'),
(172, 1, 'admin', '2013-05-08 13:24:41', '127.0.0.1'),
(173, 1, 'admin', '2013-05-08 19:33:13', '127.0.0.1'),
(174, 1, 'admin', '2013-05-08 20:10:53', '127.0.0.1'),
(175, 1, 'admin', '2013-05-08 21:10:20', '127.0.0.1'),
(176, 1, 'admin', '2013-05-08 23:00:55', '127.0.0.1'),
(177, 1, 'admin', '2013-05-08 23:05:32', '127.0.0.1'),
(178, 1, 'admin', '2013-05-09 09:35:10', '127.0.0.1'),
(179, 1, 'admin', '2013-05-09 11:16:33', '127.0.0.1'),
(180, 1, 'admin', '2013-05-09 13:26:37', '127.0.0.1'),
(181, 1, 'admin', '2013-05-10 01:58:11', '127.0.0.1'),
(182, 1, 'admin', '2013-05-10 10:17:43', '127.0.0.1'),
(183, 1, 'admin', '2013-05-10 14:24:20', '127.0.0.1'),
(184, 1, 'admin', '2013-05-10 20:54:12', '127.0.0.1'),
(185, 1, 'admin', '2013-05-10 22:46:47', '127.0.0.1'),
(186, 1, 'admin', '2013-05-11 00:49:08', '127.0.0.1'),
(187, 1, 'admin', '2013-05-11 01:26:38', '127.0.0.1'),
(188, 1, 'admin', '2013-05-11 02:14:43', '127.0.0.1'),
(189, 1, 'admin', '2013-05-11 14:52:25', '127.0.0.1'),
(190, 1, 'admin', '2013-05-11 14:56:10', '127.0.0.1'),
(191, 1, 'admin', '2013-05-11 16:15:08', '127.0.0.1'),
(192, 1, 'admin', '2013-05-11 16:20:25', '127.0.0.1'),
(193, 1, 'admin', '2013-05-12 00:21:29', '127.0.0.1'),
(194, 1, 'admin', '2013-05-12 13:49:22', '127.0.0.1'),
(195, 1, 'admin', '2013-05-12 14:01:25', '127.0.0.1'),
(196, 1, 'admin', '2013-05-12 23:17:45', '127.0.0.1'),
(197, 1, 'admin', '2013-05-13 10:41:47', '127.0.0.1'),
(198, 1, 'admin', '2013-05-13 20:41:40', '127.0.0.1'),
(199, 1, 'admin', '2013-05-14 11:19:04', '127.0.0.1'),
(200, 1, 'admin', '2013-05-14 15:11:06', '127.0.0.1'),
(201, 1, 'admin', '2013-05-15 00:02:49', '127.0.0.1'),
(202, 1, 'admin', '2013-05-15 10:31:27', '127.0.0.1'),
(203, 1, 'admin', '2013-05-15 13:13:35', '127.0.0.1'),
(204, 1, 'admin', '2013-05-15 16:49:51', '127.0.0.1'),
(205, 1, 'admin', '2013-05-15 22:48:15', '127.0.0.1'),
(206, 1, 'admin', '2013-05-16 00:20:13', '127.0.0.1'),
(207, 1, 'admin', '2013-05-16 00:49:03', '127.0.0.1'),
(208, 1, 'admin', '2013-05-16 11:24:23', '127.0.0.1'),
(209, 1, 'admin', '2013-05-16 13:48:30', '127.0.0.1'),
(210, 1, 'admin', '2013-05-16 16:11:11', '127.0.0.1'),
(211, 1, 'admin', '2013-05-16 16:11:34', '127.0.0.1'),
(212, 1, 'admin', '2013-05-16 16:12:32', '127.0.0.1'),
(213, 1, 'admin', '2013-05-16 16:13:39', '127.0.0.1'),
(214, 1, 'admin', '2013-05-16 16:15:07', '127.0.0.1'),
(215, 1, 'admin', '2013-05-16 16:15:12', '127.0.0.1'),
(216, 1, 'admin', '2013-05-16 16:15:13', '127.0.0.1'),
(217, 1, 'admin', '2013-05-16 16:15:13', '127.0.0.1'),
(218, 1, 'admin', '2013-05-16 16:15:13', '127.0.0.1'),
(219, 1, 'admin', '2013-05-16 16:15:13', '127.0.0.1'),
(220, 1, 'admin', '2013-05-16 16:15:14', '127.0.0.1'),
(221, 1, 'admin', '2013-05-16 16:18:28', '127.0.0.1'),
(222, 1, 'admin', '2013-05-16 16:19:27', '127.0.0.1'),
(223, 1, 'admin', '2013-05-16 16:20:43', '127.0.0.1'),
(224, 1, 'admin', '2013-05-16 16:22:45', '127.0.0.1'),
(225, 1, 'admin', '2013-05-16 17:07:48', '127.0.0.1'),
(226, 1, 'admin', '2013-05-16 23:53:24', '127.0.0.1'),
(227, 1, 'admin', '2013-05-17 01:18:37', '127.0.0.1'),
(228, 1, 'admin', '2013-05-17 13:16:55', '127.0.0.1'),
(229, 1, 'admin', '2013-05-17 14:46:29', '127.0.0.1'),
(230, 1, 'admin', '2013-05-18 18:29:27', '127.0.0.1'),
(231, 1, 'admin', '2013-05-19 14:35:01', '127.0.0.1'),
(232, 1, 'admin', '2013-05-19 20:27:15', '127.0.0.1'),
(233, 1, 'admin', '2013-05-19 20:32:56', '127.0.0.1'),
(234, 1, 'admin', '2013-05-19 22:52:14', '127.0.0.1'),
(235, 1, 'admin', '2013-05-19 23:51:06', '127.0.0.1'),
(236, 1, 'admin', '2013-05-20 10:43:54', '127.0.0.1'),
(237, 1, 'admin', '2013-05-20 11:46:37', '127.0.0.1'),
(238, 1, 'admin', '2013-05-20 13:34:56', '127.0.0.1'),
(239, 1, 'admin', '2013-05-20 14:34:30', '127.0.0.1'),
(240, 1, 'admin', '2013-05-20 23:01:55', '127.0.0.1'),
(241, 1, 'admin', '2013-05-21 11:04:35', '127.0.0.1'),
(242, 1, 'admin', '2013-05-21 14:37:56', '127.0.0.1'),
(243, 1, 'admin', '2013-05-23 00:00:20', '127.0.0.1'),
(244, 1, 'admin', '2013-05-23 14:51:31', '127.0.0.1'),
(245, 1, 'admin', '2013-05-29 09:16:04', '127.0.0.1'),
(246, 1, 'admin', '2013-05-29 17:28:25', '127.0.0.1'),
(247, 1, 'admin', '2013-06-03 09:12:17', '127.0.0.1'),
(248, 1, 'admin', '2013-06-19 23:38:20', '127.0.0.1'),
(249, 1, 'admin', '2013-06-19 23:39:20', '127.0.0.1'),
(250, 1, 'admin', '2013-06-26 17:47:54', '127.0.0.1'),
(251, 1, 'admin', '2013-06-29 15:44:04', '127.0.0.1'),
(252, 1, 'admin', '2013-06-29 15:48:03', '127.0.0.1'),
(253, 1, 'admin', '2013-07-01 11:06:13', '127.0.0.1'),
(254, 1, 'admin', '2013-08-26 10:45:07', '127.0.0.1'),
(255, 1, 'admin', '2013-08-26 21:28:37', '127.0.0.1'),
(256, 1, 'admin', '2013-08-30 13:32:05', '127.0.0.1'),
(257, 1, 'admin', '2013-08-30 13:32:41', '127.0.0.1'),
(258, 1, 'admin', '2013-08-30 13:34:57', '127.0.0.1'),
(259, 1, 'admin', '2013-08-30 13:38:28', '127.0.0.1'),
(260, 1, 'admin', '2013-08-30 14:13:05', '127.0.0.1'),
(261, 1, 'admin', '2013-08-30 21:33:56', '127.0.0.1'),
(262, 1, 'admin', '2013-08-30 21:35:08', '127.0.0.1'),
(263, 1, 'admin', '2013-08-30 21:36:49', '127.0.0.1'),
(264, 1, 'admin', '2013-08-31 11:29:25', '127.0.0.1'),
(265, 2, 'admin', '2013-12-10 09:19:43', '127.0.0.1'),
(266, 2, 'admin', '2013-12-10 17:43:09', '127.0.0.1'),
(267, 2, 'admin', '2013-12-11 01:05:32', '127.0.0.1'),
(268, 2, 'admin', '2013-12-11 09:17:16', '127.0.0.1'),
(269, 2, 'admin', '2013-12-11 10:37:33', '127.0.0.1'),
(270, 2, 'admin', '2013-12-11 11:51:15', '127.0.0.1');

-- --------------------------------------------------------

--
-- 表的结构 `hui_announce`
--

CREATE TABLE IF NOT EXISTS `hui_announce` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '编号ID',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '公告标题',
  `content` text NOT NULL COMMENT '公告内容',
  `starttime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '开始时间',
  `endtime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '结束时间',
  `order` int(5) NOT NULL DEFAULT '1' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否启用：0.否，1.是',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='公告表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `hui_article`
--

CREATE TABLE IF NOT EXISTS `hui_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL COMMENT '文章标题',
  `content` text NOT NULL COMMENT '文章内容',
  `cid` int(11) NOT NULL COMMENT '文章分类ID',
  `uid` int(11) NOT NULL COMMENT '发布者ID',
  `flag` varchar(20) DEFAULT NULL COMMENT '属性',
  `source` varchar(60) DEFAULT NULL COMMENT '文章来源',
  `author` varchar(50) DEFAULT 'admin' COMMENT '文章作者',
  `colorval` varchar(20) DEFAULT NULL COMMENT '标题颜色',
  `boldval` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否加粗：1.是，0否',
  `keyword` varchar(255) DEFAULT NULL COMMENT '文章关键词（多关键词之间用空格或者“,”隔开）',
  `description` varchar(255) DEFAULT NULL COMMENT '文章描述',
  `hits` int(10) NOT NULL DEFAULT '0' COMMENT '点击数',
  `order` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否审核',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='文章表' AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `hui_article`
--

INSERT INTO `hui_article` (`id`, `title`, `content`, `cid`, `uid`, `flag`, `source`, `author`, `colorval`, `boldval`, `keyword`, `description`, `hits`, `order`, `status`, `create_time`, `update_time`) VALUES
(3, '爱佑华夏联合百度在京举办“爱由心生”慈善晚宴', '<p style="word-wrap:break-word;font-family:&#39;sans serif&#39;, tahoma, verdana, helvetica;font-size:12px;line-height:18px;">2011年5月14日晚，国内首家非公募基金会爱佑华夏慈善基金会（简称爱佑华夏）联合百度公司在北京盘古酒店4层大宴会厅举办了以2011“爱由心生”为主题的慈善晚宴。出席此次晚宴的嘉宾有爱佑华夏慈善基金会理事长王兵、百度公司董事长兼CEO李彦宏、新浪网CEO曹国伟、腾讯公司董事长马化腾、北京万通实业股份有限公司董事长冯仑、上海巨人网络科技有限公司董事长史玉柱、恒基兆业地产集团副主席李家杰等众多中国知名企业家，此次晚宴旨在向基金会的发起人、捐赠人和社会各界展示基金会7年多的发展历程和极致透明的特点，探讨爱佑华夏以及中国慈善基金会未来的发展前景。</p><p style="word-wrap:break-word;font-family:&#39;sans serif&#39;, tahoma, verdana, helvetica;font-size:12px;line-height:18px;">目前，爱佑华夏慈善基金会已完成1万名先天心脏病儿童的救助工作，下一阶段将重点关注白血病儿童的救治和援助。今年是爱佑华夏基金成立七周年，百度公司董事长兼CEO李彦宏、新浪网CEO曹国伟受邀正式加入爱佑华夏慈善基金会并成为新的理事。爱佑华夏基金会理事、恒基兆业副主席李家杰宣布向基金会捐款1000万。</p><p style="word-wrap:break-word;font-family:&#39;sans serif&#39;, tahoma, verdana, helvetica;font-size:12px;line-height:18px;">爱佑华夏慈善基金会理事长王兵表示，爱佑华夏已经成长为产品型基金会，随着基金会的发展规模和法律法规的完善，爱佑华夏也会出现新的变化。在未来5 到10年，爱佑华夏致力于发展为平台型的基金会，让更多的慈善组织都能通过这个平台找到合适的公益项目。把爱佑华夏打造为社区型的基金会，为慈善基金会的发展提供一个新的视角。愿意始终坚持以企业家的精神，让每一份捐赠不留遗憾的使命，以热忱、正直、高效、创新的价值观不断提醒每一位热心公益的爱心人士，给生命一次机会，给孩子一个未来，推动中国慈善事业的发展。</p><hr class="ke-pagebreak" style="border-style:dotted;border-color:#aaaaaa;font-size:0px;height:2px;font-family:&#39;sans serif&#39;, tahoma, verdana, helvetica;page-break-after:always;" /><p style="word-wrap:break-word;font-family:&#39;sans serif&#39;, tahoma, verdana, helvetica;font-size:12px;line-height:18px;">较早前，爱佑华夏基金也加入了百度公益开放平台，通过互联网的开放平台，为基金会及其下爱佑童心等公益项目在全国范围进行免费推广，集结全社会的爱心力量，让更多需要帮助的孩子通过网络平台得到救助。据悉，百度公益开放平台旨在为全国公益组织提供免费推广，将公益组织的官方权威信息及资源与公众直接对接，为公众了解公益信息提供便利；目前已有包括中国扶贫基金会、红十字会基金会、宋庆龄基金会等5A级基金会在内的首批公益机构加入。百度公益基金会秘书长张东晨表示：“百度公益基金会还将持续关注并支持爱佑华夏基金会各类慈善项目，在资助青少年、弱势群体、贫困地区与公益机构提高信息技术应用水平方面做更多贡献。”</p><p><br /></p>', 7, 2, NULL, 'HuiCMS', 'admin', '#898989', 0, '', '', 0, 10, 1, '2013-12-10 08:17:22', '2013-12-10 08:50:21');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='文章分类' AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `hui_category`
--

INSERT INTO `hui_category` (`id`, `title`, `alias`, `pid`, `description`, `order`, `status`, `create_time`, `update_time`) VALUES
(6, '特色服务', '', 0, '', 10, 1, '2013-12-10 07:16:36', '0000-00-00 00:00:00'),
(7, '测试2', 'test', 6, '', 10, 1, '2013-12-10 07:18:26', '0000-00-00 00:00:00'),
(8, '测试', '', 0, '', 10, 1, '2013-12-10 07:20:27', '2013-12-10 08:18:04');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='系统配置表，配置值使用序列化数组存储' AUTO_INCREMENT=16 ;

--
-- 转存表中的数据 `hui_config`
--

INSERT INTO `hui_config` (`c_id`, `c_module`, `c_key`, `c_value`, `c_value_desc`, `c_create_time`, `c_update_time`) VALUES
(1, 'ADMIN_ACCESS', 'EXPIRED_TIME', '500', '登陆超时时间', '2013-05-03 02:25:45', '0000-00-00 00:00:00'),
(2, 'ADMIN_ACCESS', 'SYS_ADMIN', 'admin', '系统管理员', '2013-03-25 16:43:50', '0000-00-00 00:00:00'),
(3, '', '', NULL, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'CODE_SET', 'MREGISTER', '1', '会员注册', '2013-08-31 04:08:07', '2013-08-31 04:08:07'),
(6, 'CODE_SET', 'RELOGIN', '1', '前台登陆', '2013-08-31 04:08:07', '2013-08-31 04:08:07'),
(7, 'CODE_SET', 'BALOGIN', '1', '后台登陆', '2013-08-31 04:08:07', '2013-08-31 04:08:07'),
(8, 'CODE_SET', 'BUILDTYPE', '1', '验证码生成类型', '2013-08-31 04:08:07', '2013-08-31 04:08:07'),
(9, 'CODE_SET', 'EXPANDTYPE', 'png', '选择验证码文件类型', '2013-08-31 04:08:07', '2013-08-31 04:08:07'),
(10, 'CODE_SET', 'RECODESIZE', '{"width":"70","height":"30"}', '前台验证码图片大小', '2013-08-31 04:08:07', '2013-08-31 04:08:07'),
(11, 'CODE_SET', 'BACODESIZE', '{"width":"70","height":"38"}', '后台验证码图片大小', '2013-08-31 04:08:07', '2013-08-31 04:08:07'),
(12, 'CODE_SET', 'RECODENUMS', '4', '前台验证码字数', '2013-08-31 04:08:07', '2013-08-31 04:08:07'),
(13, 'CODE_SET', 'BACODENUMS', '6', '后台验证码字数', '2013-08-31 04:08:07', '2013-08-31 04:08:07'),
(14, 'MAILSET', 'MAILSET', '{"email_type":"1","mail_address":"wangguifang.1990@163.com","smtp":"smtp.163.com","smtp_user":"wangguifang.1990","smtp_pwd":"466209365","smtp_port":"25","test_address":"admin@huicms.cn"}', '站点信息配置', '2013-12-10 09:54:03', '2013-12-10 09:54:03'),
(15, 'WEBSITE', 'WEBSITE', '{"site_name":"HuiCMS\\u5185\\u5bb9\\u7ba1\\u7406\\u7cfb\\u7edf","site_title":"HuiCMS","site_keyword":"HuiCMS,\\u5f00\\u6e90cms,\\u514d\\u8d39cms,\\u5c0f\\u5de7cms,\\u7b80\\u5355cms","site_description":"HuiCMS\\u662f\\u4e00\\u6b3e\\u57fa\\u4e8ePHP+MYSQL\\uff0c\\u91c7\\u7528THINKPHP\\u6846\\u67b6\\u7f16\\u5199\\u7684\\u4e00\\u6b3e\\u9488\\u5bf9\\u5927\\u5c0f\\u578b\\u516c\\u53f8\\u4f01\\u4e1a\\u7b49\\u901a\\u7528\\u7684cms\\u7a0b\\u5e8f","site_icp":"\\u6caaICP\\u590712019677\\u53f7-3","site_code":"","site_status":"1","site_close":""}', '站点信息配置', '2013-12-10 01:26:02', '0000-00-00 00:00:00');

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
(4, '普通', 'upload/photo/515321a73e88d.jpg', 'http://www.huicms.cn', '', '#FF0000', 1, 30, 1, '2013-04-14 07:46:02', '2013-04-14 10:16:39');

-- --------------------------------------------------------

--
-- 表的结构 `hui_members`
--

CREATE TABLE IF NOT EXISTS `hui_members` (
  `m_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `m_name` varchar(50) NOT NULL DEFAULT '' COMMENT '用户名',
  `m_nickname` varchar(50) DEFAULT '' COMMENT '用户昵称',
  `m_enname` varchar(50) NOT NULL COMMENT '英文名',
  `m_passwd` varchar(32) NOT NULL COMMENT '密码',
  `ml_id` int(11) NOT NULL COMMENT '会员等级ID',
  `m_balance` decimal(8,2) NOT NULL DEFAULT '0.00' COMMENT '账户余额',
  `m_sex` tinyint(1) NOT NULL DEFAULT '0' COMMENT '性别：0.保密，1.男，2.女',
  `m_pic` varchar(200) DEFAULT NULL COMMENT '会员头像',
  `m_birthtype` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '生日类型:0.公历生日，1.农历生日',
  `m_email` varchar(60) NOT NULL COMMENT '邮箱',
  `m_intro` text NOT NULL COMMENT '个人说明',
  `m_login_ip` varchar(60) DEFAULT NULL COMMENT '登陆IP',
  `m_login_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP COMMENT '登陆时间',
  `m_weibo_uid` varchar(20) DEFAULT NULL COMMENT '对应的新浪微博uid',
  `m_tencent_uid` varchar(20) DEFAULT NULL COMMENT '腾讯微博UID',
  `m_verify_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '电子邮件验证标示 0未验证，1已验证',
  `m_status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否审核，0未审核，1已审核',
  `m_reg_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '注册时间',
  `m_reg_ip` varchar(15) NOT NULL COMMENT '注册IP',
  `m_qq` int(15) DEFAULT NULL COMMENT '用户QQ',
  `m_enteruser` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '认证用户:0.未认证，1.已认证',
  PRIMARY KEY (`m_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='会员表' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `hui_members`
--

INSERT INTO `hui_members` (`m_id`, `m_name`, `m_nickname`, `m_enname`, `m_passwd`, `ml_id`, `m_balance`, `m_sex`, `m_pic`, `m_birthtype`, `m_email`, `m_intro`, `m_login_ip`, `m_login_time`, `m_weibo_uid`, `m_tencent_uid`, `m_verify_status`, `m_status`, `m_reg_time`, `m_reg_ip`, `m_qq`, `m_enteruser`) VALUES
(1, 'sje410', '快乐DE小子', '', '901beedccbfd05a7a4cf96f5fd133257', 0, 0.00, 1, NULL, 0, 'admin@huicms.cn', '', '127.0.0.1', '2013-12-11 02:58:12', NULL, NULL, 0, 1, '2013-08-31 09:54:40', '127.0.0.1', NULL, 0);

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
-- 表的结构 `hui_message_tpl`
--

CREATE TABLE IF NOT EXISTS `hui_message_tpl` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `type` varchar(20) NOT NULL COMMENT '通知模版类型：0.邮件模版，1.短消息模版',
  `name` varchar(50) NOT NULL COMMENT '名称',
  `alias` varchar(50) NOT NULL COMMENT '别名',
  `content` text COMMENT '内容',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态：0.停用，1启用',
  `is_sys` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否系统内置：0否，1是',
  `create_time` timestamp NULL DEFAULT '0000-00-00 00:00:00' COMMENT '添加时间',
  `update_time` timestamp NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `hui_message_tpl`
--

INSERT INTO `hui_message_tpl` (`id`, `type`, `name`, `alias`, `content`, `status`, `is_sys`, `create_time`, `update_time`) VALUES
(1, 'mail', '找回密码', 'findpwd', '<p>\r\n	尊敬的{$username}:\r\n</p>\r\n<p style="padding-left:30px;">\r\n	您好, 您刚才在 {$site_name} 申请了重置密码，请点击下面的链接进行重置：\r\n</p>\r\n<p style="padding-left:30px;">\r\n	<a href="{$reset_url}">{$reset_url}</a> \r\n</p>\r\n<p style="padding-left:30px;">\r\n	此链接只能使用一次, 如果失效请重新申请. 如果以上链接无法点击，请将它拷贝到浏览器(例如IE)的地址栏中。\r\n</p>\r\n<p style="text-align:right;">\r\n	{$site_name}\r\n</p>\r\n<p style="text-align:right;">\r\n	{$send_time}\r\n</p>', 1, 1, '2013-08-31 08:28:04', '2013-08-31 09:00:43');

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
  `target` varchar(15) NOT NULL DEFAULT '_blank' COMMENT '打开方式',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否显示',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='前台菜单' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `hui_nav`
--

INSERT INTO `hui_nav` (`id`, `name`, `alias_name`, `url`, `order`, `type`, `target`, `status`, `create_time`, `update_time`) VALUES
(1, '首页', 'index', 'http://www.baidu.com', 10, 'main', '1', 1, '2013-05-18 16:00:00', '2013-05-18 16:00:00'),
(2, '留言', 'guestbook', '/Guestbook', 10, 'main', '0', 1, '2013-05-29 09:29:33', '0000-00-00 00:00:00');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='第三方登陆表' AUTO_INCREMENT=1 ;

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
  PRIMARY KEY (`pay_id`)
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
(7, '模板管理', 0, 100),
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='节点表' AUTO_INCREMENT=109 ;

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
(42, '', '', 'MemberLevel', '等级管理', 4, 1, 10, 1, 1),
(43, 'index', '等级列表', 'MemberLevel', '等级管理', 4, 1, 10, 0, 1),
(44, 'addMemberLevel', '添加等级', 'MemberLevel', '等级管理', 4, 1, 10, 0, 1),
(45, '', '', 'Article', '文章管理', 5, 1, 10, 1, 1),
(46, 'index', '文章列表', 'Article', '文章管理', 5, 1, 10, 0, 1),
(47, 'addArticle', '添加文章', 'Article', '文章管理', 5, 1, 10, 0, 1),
(48, 'editArticle', '编辑文章', 'Article', '文章管理', 5, 1, 10, 0, 0),
(49, 'doDelete', '删除文章', 'Article', '文章管理', 5, 1, 10, 0, 0),
(50, '', '', 'ArticleCategory', '分类管理', 5, 1, 10, 1, 1),
(51, 'index', '分类列表', 'ArticleCategory', '分类管理', 5, 1, 10, 0, 1),
(52, 'add', '添加分类', 'ArticleCategory', '分类管理', 5, 1, 10, 0, 1),
(53, 'edit', '编辑分类', 'ArticleCategory', '分类管理', 5, 1, 10, 0, 0),
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
(77, '', '', 'Download', '资源下载', 5, 0, 10, 1, 0),
(78, 'index', '资源列表', 'Download', '资源下载', 5, 0, 10, 0, 0),
(79, 'addDownload', '添加资源', 'Download', '资源下载', 5, 0, 10, 0, 0),
(80, 'editDownload', '编辑资源', 'Download', '资源下载', 5, 0, 10, 0, 0),
(81, 'logDatabase', '数据操作日志', 'Database', '数据库管理', 8, 1, 100, 0, 1),
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
(106, 'editNav', '编辑导航', 'Nav', '导航管理', 7, 1, 10, 0, 0),
(107, 'index', '通知模版列表', 'MessageTpl', '通知设置', 9, 1, 10, 0, 1),
(108, '', '', 'MessageTpl', '通知设置', 9, 1, 0, 1, 1);
