-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Час створення: Лис 14 2018 р., 21:59
-- Версія сервера: 5.6.25
-- Версія PHP: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `modera_test`
--

-- --------------------------------------------------------

--
-- Структура таблиці `trees`
--

CREATE TABLE IF NOT EXISTS `trees` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `parent_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `trees`
--

INSERT INTO `trees` (`id`, `name`, `parent_id`) VALUES
(1, 'Top category', 0),
(2, 'Subcategory1', 1),
(3, 'Subcategory2', 1),
(4, 'Top category2', 0),
(5, 'Subcategory3', 4),
(6, 'Subcategory4', 4),
(7, 'Top category3', 0);

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `trees`
--
ALTER TABLE `trees`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `trees`
--
ALTER TABLE `trees`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
