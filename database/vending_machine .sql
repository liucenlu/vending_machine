-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2024-06-03 21:26:11
-- 服务器版本： 5.7.26
-- PHP 版本： 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `vending_machine`
--

-- --------------------------------------------------------

--
-- 表的结构 `administrators`
--

CREATE TABLE `administrators` (
  `id` char(3) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `mail_ID` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `username` int(12) NOT NULL,
  `password` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `administrators`
--

INSERT INTO `administrators` (`id`, `name`, `mail_ID`, `phone_number`, `username`, `password`) VALUES
('001', '张三', '2414328758@qq', '13447497832', 202200201, 'SZtu@202200201'),
('002', '李四', '2389584758@qq', '14678855454', 202300406, 'SZtu@202300406'),
('003', '王五', '2596784934@qq', '13567854563', 202506004, 'SZtu@202506004'),
('004', 'cen', 'm12345@163.com', '1234567890', 202212345, '888888');

-- --------------------------------------------------------

--
-- 表的结构 `drink`
--

CREATE TABLE `drink` (
  `dID` char(4) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `price` float NOT NULL,
  `Shelf_life` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `Production-date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `drink`
--

INSERT INTO `drink` (`dID`, `name`, `price`, `Shelf_life`, `Production-date`) VALUES
('001', '喜茶爆汁杨梅绿妍果汁茶', 6, '2个月', '2024-05-25'),
('002', '奈雪的茶葡萄味气泡水', 5, '6个月', '2024-05-27'),
('003', '新奇士橙汁汽水', 3, '4个月', '2024-04-25'),
('004', '椰汁', 4, '6个月', '2024-05-13'),
('005', '水溶C100(青皮桔味)', 4.5, '12个月', '2024-04-10'),
('006', '百岁山天然矿泉水348ML', 1.5, '8个月', '2024-04-09'),
('007', '统一鲜橙多', 3, '2个月', '2024-05-29'),
('008', '茶π柚子绿茶', 4.5, '16个月', '2023-09-10'),
('009', '茶π柠檬红茶', 4.5, '4个月', '2024-03-13'),
('010', '茶π西柚茉莉花茶', 4.5, '8个月', '2024-04-22'),
('011', '蒙牛真果粒黄桃味', 3.5, '8个月', '2024-06-01'),
('012', '雀巢丝滑拿铁咖啡饮料', 5, '4个月', '2023-12-29'),
('013', '雪碧(细长高罐)', 2.5, '10个月', '2023-10-01'),
('014', '喜茶伊比利西柚绿妍果汁茶', 6, '10个月', '2023-11-13'),
('016', '大瓶怡宝纯净水', 2, '6个月', '2024-01-06'),
('017', '康师傅冰红茶', 3, '4个月', '2024-04-18'),
('018', '康师傅茉莉蜜茶', 3, '2个月', '2024-05-11'),
('021', '罐装王老吉', 3.5, '10个月', '2023-12-09');

-- --------------------------------------------------------

--
-- 表的结构 `includes`
--

CREATE TABLE `includes` (
  `dID` char(4) COLLATE utf8_unicode_ci NOT NULL,
  `vID` char(4) COLLATE utf8_unicode_ci NOT NULL,
  `inventory` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `includes`
--

INSERT INTO `includes` (`dID`, `vID`, `inventory`) VALUES
('001', '1001', 14),
('002', '1002', 50),
('003', '1003', 4),
('004', '1004', 17),
('005', '1002', 13),
('006', '1002', 41),
('007', '1004', 29),
('008', '1002', 3),
('009', '1001', 24),
('010', '1004', 87),
('011', '1003', 6),
('012', '1003', 16),
('013', '1001', 5),
('014', '1002', 18),
('001', '1003', 20),
('016', '1004', 9),
('017', '1001', 20),
('018', '1003', 4),
('003', '1004', 32),
('005', '1001', 22),
('021', '1001', 11),
('008', '1004', 16),
('009', '1004', 10),
('010', '1001', 4),
('007', '1003', 23),
('002', '1003', 19),
('006', '1003', 33);

-- --------------------------------------------------------

--
-- 表的结构 `machine`
--

CREATE TABLE `machine` (
  `vID` char(4) COLLATE utf8_unicode_ci NOT NULL,
  `places` varchar(7) COLLATE utf8_unicode_ci NOT NULL,
  `Total_inventory` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `machine`
--

INSERT INTO `machine` (`vID`, `places`, `Total_inventory`) VALUES
('1001', 'C1-1-1', 99),
('1002', 'C5-3-4', 125),
('1003', 'A4-2-3', 125),
('1004', 'D2-1-3', 200);

-- --------------------------------------------------------

--
-- 表的结构 `orderform`
--

CREATE TABLE `orderform` (
  `o_id` int(6) NOT NULL,
  `dID` char(4) COLLATE utf8_unicode_ci NOT NULL,
  `consumer` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(10) NOT NULL,
  `time` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `orderform`
--

INSERT INTO `orderform` (`o_id`, `dID`, `consumer`, `quantity`, `time`) VALUES
(100, '1001', '路人甲', 2, '2024-05-06 00:00:00'),
(101, '1002', 'Yu', 1, '2024-05-06 00:00:00');

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE `users` (
  `name` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `balance` float NOT NULL,
  `password` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`name`, `username`, `balance`, `password`) VALUES
('张三', '202300101', 500, '123456'),
('lin', '202211111', 250, '66666'),
('Yu', '202222222', 222, '22222');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
