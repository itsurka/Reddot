-- phpMyAdmin SQL Dump
-- version 3.3.2deb1ubuntu1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Сен 26 2012 г., 23:39
-- Версия сервера: 5.1.63
-- Версия PHP: 5.3.2-1ubuntu4.18

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `reddot`
--

-- --------------------------------------------------------

--
-- Структура таблицы `towns`
--

CREATE TABLE IF NOT EXISTS `towns` (
  `id_towns` int(11) NOT NULL AUTO_INCREMENT,
  `name_towns` varchar(255) NOT NULL,
  `description` text COMMENT 'Выводим в футере контактную информацию и тп.',
  `email` varchar(50) DEFAULT NULL COMMENT 'Емайл города',
  PRIMARY KEY (`id_towns`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Дамп данных таблицы `towns`
--

INSERT INTO `towns` (`id_towns`, `name_towns`, `description`, `email`) VALUES
(1, 'Москва', 'г. Москва, тел. 8 (9495) 123-45-67', 'moscowemail@email.com'),
(2, 'Тольятти', 'г. Краснодар, тел. 8 (909) 355-55-55', NULL),
(3, 'Белгород', NULL, NULL),
(4, 'Курск', NULL, NULL),
(5, 'Воронеж', NULL, NULL),
(6, 'Самара', NULL, NULL),
(7, 'Саратов', NULL, NULL),
(8, 'Екатеринбург', NULL, NULL),
(9, 'Нижний Новгород', NULL, NULL),
(10, 'Владимир', NULL, NULL),
(11, 'Брянск', NULL, NULL),
(12, 'Смоленск', NULL, NULL),
(13, 'Иваново', NULL, NULL),
(14, 'Тула', NULL, NULL),
(15, 'Калуга', NULL, NULL),
(16, 'Магадан', NULL, NULL),
(17, 'Пенза', NULL, NULL),
(18, 'Казань', 'г. Казань, тел. 8 (909) 355-55-55', NULL),
(19, 'Чебоксары', NULL, NULL),
(20, 'Ярославль', NULL, NULL),
(21, 'Другой город', 'фывфыв', NULL),
(22, 'Краснодар', 'г. Краснодар, тел. +7 (985) 319-05-09', NULL);
