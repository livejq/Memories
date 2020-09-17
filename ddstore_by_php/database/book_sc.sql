-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 2020-09-17 08:08:52
-- 服务器版本： 5.7.21
-- PHP Version: 7.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book_sc`
--

-- --------------------------------------------------------

--
-- 表的结构 `图书`
--

DROP TABLE IF EXISTS `图书`;
CREATE TABLE IF NOT EXISTS `图书` (
  `ISBN` varchar(50) NOT NULL,
  `序号` int(11) NOT NULL AUTO_INCREMENT,
  `作者` varchar(50) NOT NULL,
  `书名` varchar(50) NOT NULL,
  `出版` varchar(50) NOT NULL,
  `catid` int(10) UNSIGNED NOT NULL,
  `定价` int(10) UNSIGNED NOT NULL,
  `折扣` float(5,2) DEFAULT NULL,
  `库存` int(11) NOT NULL DEFAULT '0',
  `字数` varchar(100) NOT NULL DEFAULT '105410',
  `纸张` varchar(100) NOT NULL DEFAULT '胶版纸',
  `包装` varchar(100) NOT NULL DEFAULT '平装',
  `编辑推荐` text,
  `内容简介` text,
  `作者简介` text,
  `是否推荐` int(10) UNSIGNED NOT NULL,
  `是否新书` int(10) UNSIGNED NOT NULL,
  `是否促销` int(10) UNSIGNED NOT NULL,
  `是否降价` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `index` (`序号`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `图书`
--

INSERT INTO `图书` (`ISBN`, `序号`, `作者`, `书名`, `出版`, `catid`, `定价`, `折扣`, `库存`, `字数`, `纸张`, `包装`, `编辑推荐`, `内容简介`, `作者简介`, `是否推荐`, `是否新书`, `是否促销`, `是否降价`) VALUES
('0-212-452', 1, '(美)弗里曼', 'HTML5权威指南', '人民邮电出版社 2014年01月', 1, 102, 6.50, 0, '105410', '胶版纸', '平装', 'Freeman专门为网页开发新手和网页设计师打造的经典参考书，这本书秉承作者的一贯风格，幽默风趣、简约凝练、逻辑性强，是广大Web开发人员的必读经典。', NULL, NULL, 0, 1, 1, 0),
('0-221-425', 2, '(美)弗兰纳根', 'JavaScript权威指南', '机械工业出版社 2012年04月', 1, 111, 5.50, 0, '105410', '胶版纸', '平装', '经典的JavaScript工具书，从1996年以来，本书已经成为JavaScript程序员心中的圣经。', NULL, NULL, 1, 0, 1, 0),
('0-231-432', 3, '李东博', 'HTML5+CSS3从入门到精通', '清华大学出版社', 1, 49, 7.00, 0, '105410', '胶版纸', '平装', '相对于权威指南、高级程序设计、开发指南同类图书，本书是一本快速入手的自学教程。', NULL, NULL, 0, 1, 0, 1),
('0-132-567', 4, 'Ben Frain', '响应式Web设计', '人民邮电出版社', 1, 88, 6.00, 10, '444100', '胶版纸', '平装', '为读者全面深入地讲解了针对各种屏幕大小设计和开发现代网站的各种技术，适合各个层次的Web开发和设计人员阅读。', NULL, NULL, 1, 1, 0, 0),
('0-532-567', 5, '（美）加洛韦 等', 'ASP.NET MVC 5高级编程(第5版)', '清华大学出版社 2015年02月', 1, 60, 7.00, 14, '525410', '胶版纸', '平装', 'Wrox精品红皮书，Microsoft 内部编写，创建数据驱动型动态Web程序的新框架， ASP.NET MVC 5，超值畅销版', NULL, NULL, 0, 1, 0, 0),
('0-432-527', 6, '软件开发技术联盟　著', 'ASP.NET开发实例大全（基础卷）', '清华大学出版社 2016年01月', 1, 128, 9.00, 54, '105410', '胶版纸', '平装', '600经典实例及源码分析 23个应用方向 两卷共1200例 43个方向 分门别类实例一应俱全 供学习、速查、实践练习的超全参考手册 asp.net开发实战1200例 asp.net范例大全 全新升级', NULL, NULL, 0, 0, 1, 0),
('0-142-567', 7, '(美)施瓦茨,(美)扎伊采夫,(美)特卡琴科', '高性能MySQL（第3版）', '电子工业出版社 2013年05月', 2, 128, 7.00, 52, '254410', '胶版纸', '平装', '只要你不敢以MySQL专家自诩，又岂敢错过这本神书？ 一言以蔽之，写得好，编排得好，需要参考时容易到爆！ 我可是从头到尾看了一遍上一版，可还是毫不犹豫拿起了这本《高性能MySQL（第3版）》，而且看完后一点都不后悔 ', NULL, NULL, 0, 0, 1, 0),
('0-162-567', 8, '刘增杰', 'MySQL 5.7从入门到精通（视频教学版）', '清华大学出版社 2016年09月 ', 2, 98, 4.00, 0, '105410', '胶版纸', '平装', '通过本书的学习,帮您快速掌握MySQL的管理与开发的方法和技巧', NULL, NULL, 0, 1, 0, 0),
('0-132-547', 9, '丁士锋 著', 'Oracle数据库管理从入门到精通（套装全2册）', '清华大学出版社 2015年05月', 2, 209, 7.00, 0, '105410', '胶版纸', '平装', '【Oracle畅销书经典套装！一套书彻底搞定Oracle数据库管理和PL/SQL开发的所有常见技术和技术细节，并对各种技术原理做了分析和实战演练；900多个示例、4个有高价值案例、21小时配套教育视频，配教学PPT】', NULL, NULL, 0, 0, 1, 0),
('0-132-569', 10, '欧阳燊', 'Android Studio开发实战：从零基础到App上线', ':清华大学出版社 2017年06月', 3, 128, 7.85, 100, '14510', '胶版纸', '平装', '《Android Studio开发实战：从零基础到App上线》是一本非常实用的指导手册，它几乎包含了 Android Studio 所有的实用功能和操作技巧，适合放在你的电脑旁经常翻阅。本书以通俗易懂的语言描述工具的使用技巧，并且每个操作都有实例演示，让读者感觉是在跟一个有经验的人聊天。', NULL, NULL, 0, 0, 1, 0),
('0-332-567', 11, '明日学院', 'Android开发从入门到精通（项目案例版）', '水利水电出版社 2017年09月', 3, 90, 6.65, 0, '105410', '胶版纸', '平装', '手机扫码看视频重印30次销售12万册全新再造， 232节视频 150小时节在线课程 职业规划及500道面试真题1093个源码分析 16个移植模块 15个项目案例 第1行代码Android书籍疯狂讲义', NULL, NULL, 0, 0, 1, 0),
('0-232-561', 12, '陈爱军', '深入浅出通信原理', '出版社:清华大学出版社 2018年02月', 4, 89, 7.00, 0, '245710', '胶版纸', '平装', '通信人家园论坛总点击量800万的神帖 七年磨一剑 被网友称为通信界的《明朝那些事儿》 与《大话通信》《大话无线通信》《大话移动通信》同基础全面的计算机IT学科普及书', NULL, NULL, 0, 0, 0, 1),
('0-732-567', 13, '凯文 R.福尔', 'TCP/IP详解 卷1：协议（原书第2版）', '机械工业出版社 2016年06月 ', 4, 129, 7.20, 50, '105410', '胶版纸', '平装', 'Stevens经典网络名著的整体重组和彻底更新；掌握当代网络协议原理及实现技术必备参考书；全面阐述和透彻分析网络常用协议的工作过程和实现细节。 涵盖新的网络协议和实践方法，显著加强安全方面内容', NULL, NULL, 1, 0, 0, 0),
('0-532-167', 14, '唯美世界', 'Photoshop CC从入门到精通PS教程（全彩视频版）重印30次销售12万册', '水利水电出版社出版  2017年11月', 5, 100, 9.90, 41, '105410', '胶版纸', '平装', '重印30次畅销12万册 339集PS视频教程 Adobe专家作品 PS抠图 修图 调色 合成 特效 PS平面设计 淘宝美工 照片处理 网页设计 插画 UI 赠配色/构图/商业设计宝典', NULL, NULL, 0, 1, 0, 1),
('0-832-527', 15, '[美]安德鲁 福克纳（Andrew Faulkner）、康拉德 查韦斯', 'Adobe Photoshop CC 2017经典教程 彩色版', '人民邮电出版社', 5, 99, 7.90, 100, '896410', '胶版纸', '平装', 'Adobe官方编写授权的PS学习教程 累计销量逾30万册的photoshop入门教材 近300所培训机构Photoshop教材 附赠大量素材资源', NULL, NULL, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `用户`
--

DROP TABLE IF EXISTS `用户`;
CREATE TABLE IF NOT EXISTS `用户` (
  `用户名` varchar(20) NOT NULL,
  `密码` varchar(100) NOT NULL,
  `邮箱` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `用户`
--

INSERT INTO `用户` (`用户名`, `密码`, `邮箱`) VALUES
('朱洪龙', '7c4a8d09ca3762af61e59520943dc26494f8941b', '1325286933@qq.com');

-- --------------------------------------------------------

--
-- 表的结构 `目录`
--

DROP TABLE IF EXISTS `目录`;
CREATE TABLE IF NOT EXISTS `目录` (
  `catid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `catname` varchar(30) NOT NULL,
  PRIMARY KEY (`catid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `目录`
--

INSERT INTO `目录` (`catid`, `catname`) VALUES
(1, '程序设计'),
(2, '数据库'),
(3, 'Android'),
(4, '数据通信'),
(5, '图形图像');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
