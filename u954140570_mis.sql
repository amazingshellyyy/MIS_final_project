
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- 主機: localhost
-- 產生日期: 2017 年 06 月 06 日 17:00
-- 伺服器版本: 10.1.22-MariaDB
-- PHP 版本: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 資料庫: `u954140570_mis`
--

-- --------------------------------------------------------

--
-- 表的結構 `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `ComId` int(11) NOT NULL AUTO_INCREMENT,
  `UserId` int(11) NOT NULL,
  `ProjectId` int(11) NOT NULL,
  `ComText` varchar(200) NOT NULL,
  `ComTime` datetime NOT NULL,
  PRIMARY KEY (`ComId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=181 ;

--
-- 轉存資料表中的資料 `comment`
--

INSERT INTO `comment` (`ComId`, `UserId`, `ProjectId`, `ComText`, `ComTime`) VALUES
(180, 31, 94, '很小\r\n', '2017-06-05 03:36:46'),
(179, 31, 94, '大家記得明天開會！', '2017-06-05 03:11:03');

-- --------------------------------------------------------

--
-- 表的結構 `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=35 ;

--
-- 轉存資料表中的資料 `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `created_at`, `updated_at`) VALUES
(34, 'roger', 'roger@yahoo.com', NULL, NULL),
(31, 'jerry', 'jerry@yahoo.com', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的結構 `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=Active, 0=Block',
  `userId` int(100) DEFAULT NULL,
  `projectId` int(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `projectId` (`projectId`) USING BTREE,
  KEY `userId` (`userId`) USING BTREE
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=11 ;

--
-- 轉存資料表中的資料 `events`
--

INSERT INTO `events` (`id`, `title`, `date`, `created`, `modified`, `status`, `userId`, `projectId`) VALUES
(1, 'mission', '2017-09-08', '2017-05-24 00:00:00', '0000-00-00 00:00:00', 1, 30, 88),
(3, '開會', '2017-06-02', '2017-05-27 00:00:00', '0000-00-00 00:00:00', 1, 31, 89),
(4, '提早資料蒐集', '2017-06-07', '2017-05-27 00:00:00', '0000-00-00 00:00:00', 1, 31, NULL),
(5, '開會', '2017-06-01', '2017-06-03 00:00:00', '0000-00-00 00:00:00', 1, 31, 93),
(6, '聚餐', '2017-06-03', '2017-06-03 00:00:00', '0000-00-00 00:00:00', 1, 31, NULL),
(10, '導生聚', '2017-05-05', '2017-06-05 00:00:00', '0000-00-00 00:00:00', 1, 31, NULL),
(9, '開會', '2017-05-04', '2017-06-05 00:00:00', '0000-00-00 00:00:00', 1, 31, 94);

-- --------------------------------------------------------

--
-- 表的結構 `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `hash` varchar(255) NOT NULL DEFAULT '',
  `total` float NOT NULL,
  `paid` tinyint(1) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=7 ;

--
-- 轉存資料表中的資料 `orders`
--

INSERT INTO `orders` (`id`, `hash`, `total`, `paid`, `customer_id`, `created_at`, `updated_at`) VALUES
(1, '1e9d232faa3b50b82f2a365704ff33f11201253d9e9dbecdfb159103e0627349', 120, 1, 34, '2017-04-22 23:32:41', '2017-04-22 23:32:43'),
(2, '36ca8b0442b7b167358691e2ef17f67b1738ca43e0fd175665ede610fc5e8fab', 205, 1, 31, '2017-04-23 01:58:36', '2017-04-23 01:58:37'),
(3, '4195c37e90ef181e801be0129031e5d8ee25bf6b0cb7d9b7ac5fcbf8c759d874', 205, 1, 3, '2017-04-24 06:46:17', '2017-04-24 06:46:18'),
(4, '8916bca4a6b3fbe7ff50c14cbfa36f71a89152615aecfd3ff7573eeb2c4047a5', 205, 1, 4, '2017-04-26 05:49:24', '2017-04-26 05:49:30'),
(5, '4025fc05bfb6653fa79cb70a364086991749f5ea9d550c147315aa2eda9a4f75', 100, 0, 21, '2017-05-01 09:23:47', '2017-05-01 09:23:47'),
(6, '8b8911b50e142b3d45bb958fb2a458c926975232b96bafd8acf8c020d3eb9244', 225, 1, 5, '2017-05-01 09:25:05', '2017-05-01 09:25:07');

-- --------------------------------------------------------

--
-- 表的結構 `orders_products`
--

CREATE TABLE IF NOT EXISTS `orders_products` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=20 ;

--
-- 轉存資料表中的資料 `orders_products`
--

INSERT INTO `orders_products` (`id`, `order_id`, `product_id`, `quantity`) VALUES
(1, 1, 4, 1),
(3, 2, 4, 1),
(4, 3, 1, 1),
(5, 4, 1, 1),
(6, 5, 1, 3),
(7, 5, 2, 1),
(8, 5, 3, 1),
(9, 5, 4, 1),
(10, 5, 5, 1),
(11, 5, 33, 1),
(12, 5, 39, 1),
(13, 6, 1, 3),
(14, 6, 2, 1),
(15, 6, 3, 1),
(16, 6, 4, 1),
(17, 6, 5, 1),
(18, 6, 33, 1),
(19, 6, 39, 1);

-- --------------------------------------------------------

--
-- 表的結構 `payments`
--

CREATE TABLE IF NOT EXISTS `payments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `failed` tinyint(1) NOT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `transaction_id` (`transaction_id`(191))
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的結構 `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `postId` int(11) NOT NULL AUTO_INCREMENT,
  `postSource` text NOT NULL,
  `postText` text NOT NULL,
  `postUserId` int(100) DEFAULT NULL,
  `postProjectId` int(100) DEFAULT NULL,
  `postInvolvedMembers` char(100) DEFAULT NULL,
  PRIMARY KEY (`postId`),
  KEY `postUserId` (`postUserId`),
  KEY `postProjectId` (`postProjectId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=33 ;

--
-- 轉存資料表中的資料 `post`
--

INSERT INTO `post` (`postId`, `postSource`, `postText`, `postUserId`, `postProjectId`, `postInvolvedMembers`) VALUES
(32, '修改任務區', 'Jerry在<a href="project_home.php?id=94">會計學報告</a>修改了任務區', 31, 94, 'tina@yahoo.com,tom@yahoo.com'),
(31, '修改任務區', 'Jerry在<a href="project_home.php?id=94">會計學報告</a>修改了任務區', 31, 94, 'tina@yahoo.com,tom@yahoo.com'),
(30, '貼文發布', 'Jerry 已發佈一則貼文至 <a href="project_home.php?id=94">會計學報告</a>', 31, 94, 'tina@yahoo.com,tom@yahoo.com'),
(29, '專案行事曆', 'Jerry在<a href="project_home.php?id=94">會計學報告</a>新增了一項事件', 31, 94, 'tina@yahoo.com,tom@yahoo.com'),
(28, '修改任務區', 'Jerry在<a href="project_home.php?id=94">會計學報告</a>修改了任務區', 31, 94, 'tina@yahoo.com,tom@yahoo.com'),
(27, '貼文發布', 'Jerry 已發佈一則貼文至 <a href="project_home.php?id=94">會計學報告</a>', 31, 94, 'tina@yahoo.com,tom@yahoo.com');

-- --------------------------------------------------------

--
-- 表的結構 `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userName` varchar(30) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL DEFAULT '',
  `description` text,
  `tag1` text,
  `tag2` text,
  `tag3` text,
  `tag4` text,
  `tag5` text,
  `rating` decimal(3,2) DEFAULT NULL,
  `price` float NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `projectName` varchar(11) DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=41 ;

--
-- 轉存資料表中的資料 `products`
--

INSERT INTO `products` (`id`, `userName`, `title`, `slug`, `description`, `tag1`, `tag2`, `tag3`, `tag4`, `tag5`, `rating`, `price`, `image`, `projectName`, `stock`, `created_at`, `updated_at`) VALUES
(1, 'Tom', '國文：古今中外', 'Chi_Tom', '國文：古今中外', '國文', '古今中外\r\n', '', '', NULL, '3.00', 200, 'http://i.imgur.com/TBKMTRP.png', NULL, 6, '2017-03-12 08:00:00', '2017-05-01 09:25:07'),
(2, 'Tom', '英文：演講', 'Eng_Tom', '英文演講\r\n', '英文\r\n', '演講', NULL, NULL, NULL, '1.00', 150, 'http://i.imgur.com/w35xiVj.png', NULL, 9, '2014-03-14 08:00:00', '2017-05-01 09:25:07'),
(4, 'Tina', '資訊管理期末報告', 'mis', '資訊管理期末報告', '資訊管理', 'Mis', NULL, NULL, NULL, '4.22', 120, 'http://i.imgur.com/TBKMTRP.png\r\n', '資訊管理期末報告', 5, '2017-04-12 08:00:00', '2017-05-01 09:25:07'),
(5, 'Jack', '資訊管理期末專案', 'Mis_Jack', '資訊管理期末專案', '資管', '畢業專案', 'Mis', NULL, NULL, '3.50', 80, 'http://i.imgur.com/TBKMTRP.png\r\n', '資訊管理期末專案', 100, '2016-02-24 08:00:00', '2017-05-01 09:25:07'),
(6, 'Maple', '資管期末專案', 'Mis_Maple', '資管期末專案', '資管', '期末專案', 'Final', 'Mis', NULL, '0.00', 90, 'http://i.imgur.com/TBKMTRP.png\r\n', '資管期末專案', 1, '2017-03-24 08:00:00', NULL),
(27, 'Rub', 'Mis_Final_Project', 'Mis_Rub', '資管期末專案', 'Mis', '資訊管理', '資管', 'Final', '', NULL, 110, 'http://i.imgur.com/MJVIY3W.png', '資管期末專案', 1, NULL, NULL),
(28, 'Tina', '微積分期末報告', 'Math_Tina', '微積分期末報告', 'Math', '微積分', '', '', '', NULL, 220, 'http://i.imgur.com/TBKMTRP.png', NULL, 1, NULL, NULL),
(29, 'Tina', '歷史思維讀書報告', 'His_Tina', '歷史思維讀書報告', 'History', '歷史', '', '', '', NULL, 120, 'http://i.imgur.com/TBKMTRP.png', NULL, 1, NULL, NULL),
(33, 'Jack', '統計學報告', 'sta_Jack', '統計學報告', 'Statistic', '統計', '', '', '', '4.40', 80, 'http://i.imgur.com/w35xiVj.png', NULL, 2, NULL, '2017-05-01 09:25:07'),
(40, 'Jerry', '', '', '', '', '', '', '', '', NULL, 0, '/assets/images/documents/word.png', '', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的結構 `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `projectId` int(100) NOT NULL AUTO_INCREMENT,
  `projectCreatorId` int(100) NOT NULL,
  `projectMembersId` varchar(200) DEFAULT NULL,
  `projectName` varchar(30) NOT NULL,
  `projectClassName` varchar(30) NOT NULL,
  `projectTeacher` varchar(30) NOT NULL,
  `projectCreatetime` date NOT NULL,
  `projectDeadline` date NOT NULL,
  PRIMARY KEY (`projectId`),
  KEY `IDX_projects_projectCreatorId` (`projectCreatorId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=96 ;

--
-- 轉存資料表中的資料 `projects`
--

INSERT INTO `projects` (`projectId`, `projectCreatorId`, `projectMembersId`, `projectName`, `projectClassName`, `projectTeacher`, `projectCreatetime`, `projectDeadline`) VALUES
(87, 30, '103306052@nccu.edu.tw', '經濟學期末報告', '經濟學', '翁永和', '2017-05-24', '2017-06-30'),
(88, 30, '103306052@nccu.edu.tw', '經濟學期末報告', '經濟學', '翁永和', '2017-05-24', '2017-06-30'),
(95, 31, 'tina@yahoo.com,tom@yahoo.com', '資訊管理專案', '資訊管理', '林老師', '2017-06-05', '2017-07-30'),
(94, 31, 'tina@yahoo.com,tom@yahoo.com', '會計學報告', '會計學', '林宛瑩', '2017-06-04', '2017-07-30');

-- --------------------------------------------------------

--
-- 表的結構 `projects_stage`
--

CREATE TABLE IF NOT EXISTS `projects_stage` (
  `projects_stageId` int(100) NOT NULL AUTO_INCREMENT,
  `projectId` int(100) NOT NULL,
  `project_stageStart` date NOT NULL,
  `project_stageEnd` date NOT NULL,
  `project_stageName` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`projects_stageId`),
  KEY `projectId` (`projectId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=16 ;

--
-- 轉存資料表中的資料 `projects_stage`
--

INSERT INTO `projects_stage` (`projects_stageId`, `projectId`, `project_stageStart`, `project_stageEnd`, `project_stageName`) VALUES
(1, 88, '2017-05-25', '2017-06-07', '書面資料'),
(2, 88, '2017-06-08', '2017-06-30', 'ppt統整'),
(15, 95, '2017-07-01', '2017-07-31', 'ppt報告'),
(12, 94, '2017-06-05', '2017-06-30', '書面報告'),
(13, 94, '2017-07-01', '2017-07-05', 'ppt呈現'),
(14, 95, '2017-06-05', '2017-06-30', '書面報告');

-- --------------------------------------------------------

--
-- 表的結構 `projects_stage_missions`
--

CREATE TABLE IF NOT EXISTS `projects_stage_missions` (
  `missionId` int(11) NOT NULL AUTO_INCREMENT,
  `projects_stageId` int(11) NOT NULL,
  `missionName` varchar(100) CHARACTER SET utf8 NOT NULL,
  `missionMembers` varchar(100) NOT NULL,
  `missionDate` date NOT NULL,
  `missionContent` varchar(100) NOT NULL,
  `file_upload` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`missionId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=35 ;

--
-- 轉存資料表中的資料 `projects_stage_missions`
--

INSERT INTO `projects_stage_missions` (`missionId`, `projects_stageId`, `missionName`, `missionMembers`, `missionDate`, `missionContent`, `file_upload`) VALUES
(1, 1, '資料', '', '2017-05-27', '資料搜集', 1),
(2, 1, '分類資料', '', '2017-05-31', '資料搜集', 1),
(3, 1, '完整報告', '', '2017-06-01', '資料搜集', 1),
(4, 2, '白片整理', '', '2017-06-03', '白片整理', 1),
(5, 2, '繳交ppt', '', '2017-06-22', '繳交ppt', 1),
(6, 3, '資料蒐集', 'Tom,Tina', '2017-05-28', '蒐集相關資料', 1),
(7, 3, '資料整合', 'Jerry', '2017-05-30', '資料整合', 1),
(8, 3, '紙本呈現', 'Tom', '2017-06-02', '紙本呈現', 1),
(9, 4, '白片準備', 'Jerry,Tom,Tina', '2017-06-07', '白片', 1),
(10, 4, '白片整合', 'Jerry', '2017-06-14', '整合白片', 1),
(11, 4, '最終呈現', 'Tom', '2017-06-30', '整合白片', 1),
(12, 5, '開會討論', 'Jerry, Tom, Tina', '2017-05-31', '討論劇本構想', 1),
(13, 5, '寫台詞', 'Tom', '2017-06-06', '寫台詞', 1),
(14, 5, '上傳檔案', 'Tom', '2017-06-07', '上傳檔案', 1),
(15, 6, '拍攝影片', 'Jerry, Tom, Tina', '2017-06-15', '', 1),
(16, 6, '上台發表', 'Jerry, Tom, Tina', '2017-06-24', '', 1),
(17, 7, '講稿1', 'sean,tina', '2017-05-31', 'upload', 1),
(18, 7, '講稿2', 'fish', '2017-06-03', 'upload', 1),
(19, 7, '講稿3', 'jess', '2017-06-16', 'script', 1),
(20, 7, '講稿4', 'lissan', '2017-06-28', 'audio', 1),
(21, 8, '資料蒐集', 'tina', '2017-06-02', '資料蒐集', 1),
(22, 8, '資料整理', 'tina', '2017-06-05', '資料整理', 1),
(23, 9, '期末發表', 'tina', '2017-06-11', '期末發表', 1),
(24, 10, '書面統整', 'jerry,tom', '0000-00-00', '', 1),
(25, 11, '白片1', 'tina', '0000-00-00', '', 1),
(26, 11, 'ppt統整繳交', 'jerry', '0000-00-00', '', 1),
(27, 12, '資料蒐集', 'tom', '2017-06-05', '資料蒐集', 1),
(28, 12, '資料統整', 'tina', '2017-06-11', '', 1),
(29, 13, '白片1', 'tina', '2017-07-01', '白片', 1),
(30, 13, 'ppt最終版本', 'jerry', '2017-07-26', 'ppt最終版本', 1),
(31, 14, '資料蒐集', 'tina', '2017-06-10', '資料蒐集', 1),
(32, 14, '書面資料統整', 'tom', '2017-06-30', '資料統整', 1),
(33, 15, '白片1', 'jerry', '2017-07-01', '白片', 1),
(34, 15, 'ppt統整', 'tom,tina', '2017-07-31', '統整', 1);

-- --------------------------------------------------------

--
-- 表的結構 `rating`
--

CREATE TABLE IF NOT EXISTS `rating` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `userName` varchar(30) NOT NULL DEFAULT '',
  `product_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `feedback` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=10 ;

--
-- 轉存資料表中的資料 `rating`
--

INSERT INTO `rating` (`id`, `userName`, `product_id`, `score`, `feedback`) VALUES
(1, 'Jerry', 4, 4, 'ldlsf'),
(2, 'Jerry', 4, 4, 'ldlsf'),
(3, 'Jerry', 4, 4, '很棒！'),
(4, 'Jerry', 4, 5, '很棒'),
(5, 'Jerry', 4, 5, '很棒'),
(6, 'Jerry', 4, 4, '很棒'),
(7, 'Jerry', 4, 4, 'good'),
(8, 'Jerry', 4, 4, '很好'),
(9, 'Jerry', 4, 4, 'GOOD');

-- --------------------------------------------------------

--
-- 表的結構 `subcomment`
--

CREATE TABLE IF NOT EXISTS `subcomment` (
  `SubComId` int(11) NOT NULL AUTO_INCREMENT,
  `ComId` int(11) NOT NULL,
  `SubComText` text NOT NULL,
  `UserId` int(11) NOT NULL,
  PRIMARY KEY (`SubComId`),
  KEY `ComId` (`ComId`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=12 ;

--
-- 轉存資料表中的資料 `subcomment`
--

INSERT INTO `subcomment` (`SubComId`, `ComId`, `SubComText`, `UserId`) VALUES
(6, 169, 'Jerry：看到的請回復哦！', 31),
(7, 170, 'Jerry：看到的人留言「OK!」', 31),
(8, 172, 'Jerry：Hi', 31),
(9, 172, 'Tina：嗨', 33),
(10, 174, 'Jerry：看過請留言！', 31),
(11, 179, 'Jerry：大家看完留個言', 31);

-- --------------------------------------------------------

--
-- 表的結構 `tbl_uploads`
--

CREATE TABLE IF NOT EXISTS `tbl_uploads` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `file` varchar(100) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `type` varchar(30) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `size` int(11) NOT NULL,
  `projectId` int(100) DEFAULT NULL,
  `userId` int(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=5 ;

--
-- 轉存資料表中的資料 `tbl_uploads`
--

INSERT INTO `tbl_uploads` (`id`, `file`, `type`, `size`, `projectId`, `userId`) VALUES
(2, '新聞.docx', 'docx', 14, 0, 31);

-- --------------------------------------------------------

--
-- 表的結構 `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `userName` varchar(11) CHARACTER SET utf8 NOT NULL DEFAULT '',
  `userEmail` varchar(60) CHARACTER SET utf8 NOT NULL,
  `userPass` varchar(255) CHARACTER SET utf8 NOT NULL,
  `userDepartment` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `userStudentid` int(10) DEFAULT NULL,
  `userCellphone` int(11) DEFAULT NULL,
  `userIntroduction` varchar(300) CHARACTER SET utf8 DEFAULT NULL,
  `user_projectId_invited` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `user_coin` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`userId`),
  UNIQUE KEY `userEmail` (`userEmail`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=34 ;

--
-- 轉存資料表中的資料 `users`
--

INSERT INTO `users` (`userId`, `userName`, `userEmail`, `userPass`, `userDepartment`, `userStudentid`, `userCellphone`, `userIntroduction`, `user_projectId_invited`, `user_coin`) VALUES
(30, 'Jerry', 'jerry123@yahoo.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '資管三', 103306052, 921234567, '大家好', NULL, 500),
(31, 'Jerry', 'jerry@yahoo.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '資管三', 103306052, 921264857, '大家好，我喜歡寫程式。', NULL, 500),
(32, 'Tom', 'Tom@yahoo.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', NULL, NULL, NULL, NULL, NULL, 500),
(33, 'Tina', 'Tina@yahoo.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', NULL, NULL, NULL, NULL, '500,94', 500);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
