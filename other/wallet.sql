-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2019 年 06 月 09 日 10:31
-- 伺服器版本： 10.1.38-MariaDB
-- PHP 版本： 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `wallet`
--
CREATE DATABASE IF NOT EXISTS `wallet` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `wallet`;

-- --------------------------------------------------------

--
-- 資料表結構 `member`
--

CREATE TABLE `member` (
  `account` char(20) NOT NULL,
  `password` char(20) NOT NULL,
  `name` char(20) NOT NULL,
  `img` char(100) NOT NULL,
  `message` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `member`
--

INSERT INTO `member` (`account`, `password`, `name`, `img`, `message`) VALUES
('54bp6cl6', 'maxzheng041716', 'MaxZheng', 'logo.png', '哈囉~'),
('a106223012', '54bp6cl6', 'ZenHow', '2014-08-17_18-04-27_220633_org.jpg', 'Yo!Yo!Check it out!!!'),
('assppp', 'a99999', 'youngMAN', '', '這個人很懶~什麼都沒有留下~\r\n這個人很懶~什麼都沒有留下~\r\n這個人很懶~什麼都沒有留下~'),
('sys', '', '系統', '', '');

-- --------------------------------------------------------

--
-- 資料表結構 `record`
--

CREATE TABLE `record` (
  `date` date NOT NULL,
  `pay` char(20) NOT NULL,
  `collect` char(20) NOT NULL,
  `dollar` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `pcancel` tinyint(1) NOT NULL,
  `ccancel` tinyint(1) NOT NULL,
  `cancel` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `record`
--

INSERT INTO `record` (`date`, `pay`, `collect`, `dollar`, `count`, `pcancel`, `ccancel`, `cancel`) VALUES
('2019-04-03', 'sys', 'a106223012', 5000000, 5, 0, 0, 0),
('2019-04-04', 'sys', 'assppp', 500, 9, 0, 0, 0),
('2019-04-06', 'assppp', 'a106223012', 500, 10, 0, 0, 0),
('2019-04-15', 'a106223012', 'assppp', 10000, 11, 1, 1, 1),
('2019-04-15', 'a106223012', 'assppp', 100, 12, 0, 0, 0),
('2019-04-17', 'a106223012', 'assppp', 111, 13, 0, 0, 0),
('2019-04-18', 'a106223012', 'assppp', 222, 14, 0, 0, 0),
('2019-04-22', 'a106223012', 'assppp', 333, 15, 0, 0, 0),
('2019-04-24', 'a106223012', 'assppp', 444, 16, 0, 0, 0),
('2019-04-26', 'a106223012', 'assppp', 555, 17, 0, 0, 0),
('2019-04-30', 'a106223012', 'assppp', 666, 18, 0, 0, 0),
('2019-05-01', 'a106223012', 'assppp', 777, 19, 0, 0, 0),
('2019-05-03', 'a106223012', 'assppp', 888, 20, 0, 0, 0),
('2019-05-06', 'a106223012', 'assppp', 999, 21, 0, 0, 0),
('2019-05-08', 'a106223012', 'assppp', 111, 22, 1, 1, 1),
('2019-05-10', 'assppp', 'a106223012', 111, 23, 0, 0, 0),
('2019-05-11', 'assppp', 'a106223012', 222, 24, 0, 0, 0),
('2019-05-15', 'assppp', 'a106223012', 333, 25, 1, 1, 1),
('2019-05-16', 'assppp', 'a106223012', 444, 26, 0, 0, 0),
('2019-05-23', 'a106223012', 'assppp', 200, 27, 1, 1, 1),
('2019-05-24', 'a106223012', 'assppp', 1, 28, 0, 0, 0),
('2019-05-24', 'a106223012', 'assppp', 1234, 29, 0, 0, 0),
('2019-05-25', 'a106223012', 'assppp', 500, 30, 1, 1, 1),
('2019-05-27', 'a106223012', 'assppp', 212121, 31, 0, 0, 0),
('2019-05-28', 'sys', 'assppp', 8, 32, 0, 0, 0),
('2019-05-29', 'sys', 'assppp', 40, 33, 0, 0, 0),
('2019-05-29', 'sys', 'assppp', 800, 34, 0, 0, 0),
('2019-06-01', 'sys', 'assppp', 10, 35, 0, 0, 0),
('2019-06-02', 'assppp', 'sys', 200, 36, 0, 0, 0),
('2019-06-02', 'assppp', 'sys', 200, 37, 0, 0, 0),
('2019-06-03', 'assppp', 'sys', 1456, 38, 0, 0, 0),
('2019-06-04', 'assppp', 'sys', 16691, 39, 0, 0, 0),
('2019-06-05', 'assppp', 'sys', 18544, 40, 0, 0, 0),
('2019-06-06', 'assppp', 'sys', 100, 41, 0, 0, 0),
('2019-06-07', 'assppp', 'sys', 819, 42, 0, 0, 0),
('2019-06-08', 'assppp', 'sys', 100, 43, 0, 0, 0),
('2019-06-08', 'assppp', 'sys', 10, 44, 0, 0, 0),
('2019-06-08', 'sys', 'assppp', 20000, 45, 0, 0, 0),
('2019-06-09', 'assppp', 'sys', 10000, 46, 0, 0, 0),
('2019-06-09', 'sys', '54bp6cl6', 500, 47, 0, 0, 0),
('2019-06-09', '54bp6cl6', 'a106223012', 200, 48, 1, 0, 0),
('2019-06-09', 'sys', '54bp6cl6', 200000, 49, 0, 0, 0),
('2019-06-09', '54bp6cl6', 'sys', 28, 50, 0, 0, 0),
('2019-06-09', '54bp6cl6', 'sys', 17, 51, 0, 0, 0),
('2019-06-09', '54bp6cl6', 'sys', 21, 52, 0, 0, 0),
('2019-06-09', 'a106223012', '54bp6cl6', 548, 53, 0, 0, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `name` varchar(10) NOT NULL,
  `rate` double NOT NULL,
  `avaNum` int(11) NOT NULL,
  `description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `transaction`
--

INSERT INTO `transaction` (`id`, `name`, `rate`, `avaNum`, `description`) VALUES
(1, '新台幣', 1, -1, '台灣政府發行的法定貨幣'),
(2, '貓貓幣', 1.6, 36500, '愛貓人士發行的不知道甚麼東東'),
(3, '狗狗幣', 0.2, 652400, '愛狗人士看到貓貓幣後仿造出來的虛擬貨幣'),
(4, '鱷魚幣', 4.4, 62400, '錢財就像鱷魚，會狠狠把你吞噬'),
(5, '海盜幣', 2.3, 94200, '來自維京的虛擬貨幣，廣泛應用於港口');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`account`);

--
-- 資料表索引 `record`
--
ALTER TABLE `record`
  ADD PRIMARY KEY (`count`),
  ADD KEY `index` (`count`);

--
-- 資料表索引 `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動增長(AUTO_INCREMENT)
--

--
-- 使用資料表自動增長(AUTO_INCREMENT) `record`
--
ALTER TABLE `record`
  MODIFY `count` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- 使用資料表自動增長(AUTO_INCREMENT) `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
