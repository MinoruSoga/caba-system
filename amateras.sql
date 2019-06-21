-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: 2019 年 6 月 16 日 21:59
-- サーバのバージョン： 5.7.25
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `amateras`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `bottle`
--

CREATE TABLE `bottle` (
  `bottle_id` int(50) NOT NULL,
  `bottle_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `bottle`
--

INSERT INTO `bottle` (`bottle_id`, `bottle_name`) VALUES
(1, '吉四六'),
(2, '鏡月'),
(3, '黒霧島'),
(4, '鍛高譚');

-- --------------------------------------------------------

--
-- テーブルの構造 `cast_name`
--

CREATE TABLE `cast_name` (
  `cast_id` int(50) NOT NULL,
  `cast_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `cast_name`
--

INSERT INTO `cast_name` (`cast_id`, `cast_name`) VALUES
(1, 'あみる'),
(2, 'らん');

-- --------------------------------------------------------

--
-- テーブルの構造 `guest`
--

CREATE TABLE `guest` (
  `name_id` int(255) NOT NULL,
  `name` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `guest`
--

INSERT INTO `guest` (`name_id`, `name`) VALUES
(25, 'test1_name'),
(26, 'test2'),
(27, 'test_1');

-- --------------------------------------------------------

--
-- テーブルの構造 `guest_bottle`
--

CREATE TABLE `guest_bottle` (
  `guest_bottle` int(11) NOT NULL,
  `name_id` int(11) NOT NULL,
  `bottle_id` int(11) NOT NULL,
  `No` int(11) NOT NULL,
  `daytime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `guest_bottle`
--

INSERT INTO `guest_bottle` (`guest_bottle`, `name_id`, `bottle_id`, `No`, `daytime`) VALUES
(1, 27, 1, 12, 20190714),
(2, 27, 2, 4, 20190922);

-- --------------------------------------------------------

--
-- テーブルの構造 `guest_cast`
--

CREATE TABLE `guest_cast` (
  `guest_cast` int(11) NOT NULL,
  `name_id` int(11) NOT NULL,
  `cast_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `guest_cast`
--

INSERT INTO `guest_cast` (`guest_cast`, `name_id`, `cast_id`) VALUES
(1, 27, 1);

-- --------------------------------------------------------

--
-- テーブルの構造 `guest_date`
--

CREATE TABLE `guest_date` (
  `guest_date_id` int(11) NOT NULL,
  `name_id` int(255) NOT NULL,
  `bottle_id` int(50) NOT NULL,
  `No` int(11) NOT NULL,
  `cast_id` int(100) NOT NULL,
  `daytime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `guest_date`
--

INSERT INTO `guest_date` (`guest_date_id`, `name_id`, `bottle_id`, `No`, `cast_id`, `daytime`) VALUES
(6, 25, 1, 12, 1, 20190101),
(7, 25, 1, 12, 2, 20190101),
(8, 26, 2, 4, 1, 20190513);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bottle`
--
ALTER TABLE `bottle`
  ADD PRIMARY KEY (`bottle_id`);

--
-- Indexes for table `cast_name`
--
ALTER TABLE `cast_name`
  ADD PRIMARY KEY (`cast_id`);

--
-- Indexes for table `guest`
--
ALTER TABLE `guest`
  ADD PRIMARY KEY (`name_id`);

--
-- Indexes for table `guest_bottle`
--
ALTER TABLE `guest_bottle`
  ADD PRIMARY KEY (`guest_bottle`);

--
-- Indexes for table `guest_cast`
--
ALTER TABLE `guest_cast`
  ADD PRIMARY KEY (`guest_cast`);

--
-- Indexes for table `guest_date`
--
ALTER TABLE `guest_date`
  ADD PRIMARY KEY (`guest_date_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bottle`
--
ALTER TABLE `bottle`
  MODIFY `bottle_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cast_name`
--
ALTER TABLE `cast_name`
  MODIFY `cast_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `guest`
--
ALTER TABLE `guest`
  MODIFY `name_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `guest_bottle`
--
ALTER TABLE `guest_bottle`
  MODIFY `guest_bottle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `guest_cast`
--
ALTER TABLE `guest_cast`
  MODIFY `guest_cast` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `guest_date`
--
ALTER TABLE `guest_date`
  MODIFY `guest_date_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
