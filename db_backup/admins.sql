-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- 主机: 127.0.0.1
-- 生成日期: 2013 年 09 月 18 日 07:29
-- 服务器版本: 5.5.32
-- PHP 版本: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `cards_hao123`
--

-- --------------------------------------------------------

--
-- 表的结构 `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `admin_id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(30) NOT NULL,
  `admin_pass` varchar(40) NOT NULL,
  `operator` mediumint(8) NOT NULL,
  `game_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `last_login_time` datetime NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='管理员表' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_name`, `admin_pass`, `operator`, `game_id`, `status`, `last_login_time`) VALUES
(1, 'admin', '96e79218965eb72c92a549dd5a330112', 0, 0, 1, '2013-09-17 11:00:39');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
