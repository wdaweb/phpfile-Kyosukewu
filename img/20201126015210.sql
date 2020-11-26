-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1:3306
-- 產生時間： 2020-11-08 16:09:32
-- 伺服器版本： 10.4.14-MariaDB
-- PHP 版本： 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `daily_record`
--

-- --------------------------------------------------------

--
-- 資料表結構 `daily_record`
--

CREATE TABLE `daily_record` (
  `id` int(11) UNSIGNED NOT NULL COMMENT '序列號',
  `item` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '項目',
  `date` date NOT NULL COMMENT '日期',
  `time` time NOT NULL COMMENT '時間',
  `type` tinyint(2) UNSIGNED NOT NULL DEFAULT 1 COMMENT '收入/支出類別',
  `account` smallint(5) UNSIGNED NOT NULL COMMENT '付款方式',
  `category` smallint(5) UNSIGNED NOT NULL COMMENT '類別',
  `payment` int(11) UNSIGNED NOT NULL COMMENT '金額',
  `plan` smallint(5) UNSIGNED DEFAULT NULL COMMENT '預算科目',
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '備註'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `daily_record`
--

INSERT INTO `daily_record` (`id`, `item`, `date`, `time`, `type`, `account`, `category`, `payment`, `plan`, `note`) VALUES
(1, '午餐', '2020-11-02', '11:45:41', 1, 1, 0, 100, NULL, NULL),
(2, '機車加油', '2020-11-03', '16:40:17', 1, 2, 0, 107, NULL, NULL),
(3, '晚餐', '2020-11-03', '19:01:25', 1, 1, 0, 150, NULL, NULL),
(4, '網購取貨付款', '2020-11-04', '18:03:07', 1, 1, 0, 480, NULL, NULL),
(5, '午餐', '2020-11-04', '11:04:13', 1, 1, 0, 75, NULL, NULL),
(6, '晚餐', '2020-11-04', '19:05:55', 1, 2, 0, 750, NULL, NULL),
(7, '午餐', '2020-11-05', '11:06:39', 1, 1, 0, 65, NULL, NULL),
(8, '晚餐', '2020-11-05', '18:06:39', 1, 1, 0, 120, NULL, NULL),
(9, '午餐', '2020-11-06', '11:08:26', 1, 1, 0, 80, NULL, NULL),
(10, '晚餐', '2020-11-06', '18:08:26', 1, 1, 0, 150, NULL, NULL);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `daily_record`
--
ALTER TABLE `daily_record`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `daily_record`
--
ALTER TABLE `daily_record`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '序列號', AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
