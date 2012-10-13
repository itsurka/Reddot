-- phpMyAdmin SQL Dump
-- version 3.3.2deb1ubuntu1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Окт 02 2012 г., 20:04
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
-- Структура таблицы `act`
--

CREATE TABLE IF NOT EXISTS `act` (
  `id_act` int(11) NOT NULL AUTO_INCREMENT,
  `paid` int(11) NOT NULL DEFAULT '0' COMMENT 'parent action Id',
  `name_act` varchar(500) NOT NULL,
  `short_url` varchar(32) DEFAULT NULL COMMENT 'ЧПУ',
  `seo_title` varchar(128) DEFAULT NULL,
  `seo_keywords` text,
  `seo_description` text,
  `url_name` varchar(64) NOT NULL DEFAULT '',
  `photo_act` varchar(500) NOT NULL,
  `short_text_act` text NOT NULL,
  `full_text_act` text NOT NULL,
  `terms` text COMMENT 'Условия акции',
  `id_org_act` int(11) NOT NULL,
  `id_town_act` int(11) NOT NULL,
  `id_themes_act` int(11) NOT NULL,
  `id_tag_act` int(11) DEFAULT NULL,
  `price_old` float NOT NULL,
  `price_new` float DEFAULT NULL,
  `price_new_description` text,
  `coupon_count` int(11) NOT NULL,
  `coupon_purchased` int(11) NOT NULL DEFAULT '0' COMMENT 'Сколько купонов было куплено',
  `coupon_need` int(11) NOT NULL,
  `is_bonus` int(11) NOT NULL,
  `date_start_act` datetime NOT NULL,
  `date_end_act` datetime NOT NULL,
  `date_end_coupon_act` datetime NOT NULL COMMENT 'Дата действия купонов',
  `is_active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Активна ли акция',
  PRIMARY KEY (`id_act`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `act`
--

INSERT INTO `act` (`id_act`, `paid`, `name_act`, `short_url`, `seo_title`, `seo_keywords`, `seo_description`, `url_name`, `photo_act`, `short_text_act`, `full_text_act`, `terms`, `id_org_act`, `id_town_act`, `id_themes_act`, `id_tag_act`, `price_old`, `price_new`, `price_new_description`, `coupon_count`, `coupon_purchased`, `coupon_need`, `is_bonus`, `date_start_act`, `date_end_act`, `date_end_coupon_act`, `is_active`) VALUES
(1, 0, 'aaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaa', '', '', '', '', '6e12cc3c6a35bdfab73c175f93f36be2', 'aaaaaaaaaaaaaaaaaa', '<p>\r\n	aaaaaaaaaaaaaaaaaa</p>\r\n', '<p>\r\n	asdasd a da</p>\r\n', 17, 1, 1, NULL, 0, 20, '<p>\r\n	sdsa dsd</p>\r\n', 500, 15, 0, 0, '2012-09-01 00:00:00', '2012-10-31 00:00:00', '2012-10-31 00:00:00', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `action`
--

CREATE TABLE IF NOT EXISTS `action` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `comment` text,
  `subject` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `action`
--


-- --------------------------------------------------------

--
-- Структура таблицы `act_tag`
--

CREATE TABLE IF NOT EXISTS `act_tag` (
  `id_tag` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id_tag`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `act_tag`
--


-- --------------------------------------------------------

--
-- Структура таблицы `coupon`
--

CREATE TABLE IF NOT EXISTS `coupon` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `act_id` int(11) NOT NULL COMMENT 'ID Акции',
  `title` varchar(256) DEFAULT NULL COMMENT 'Название купона',
  `total_cost` varchar(32) DEFAULT NULL COMMENT 'Стоимость купона',
  `first_cost` varchar(32) DEFAULT NULL COMMENT 'Изначальная стоимость купона',
  `last_cost` varchar(32) DEFAULT NULL COMMENT 'Итоговая цена купона',
  `discount` int(11) DEFAULT NULL COMMENT 'Размер скидки (в процентах)',
  `created` int(11) DEFAULT NULL,
  `modified` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `coupon`
--

INSERT INTO `coupon` (`id`, `act_id`, `title`, `total_cost`, `first_cost`, `last_cost`, `discount`, `created`, `modified`) VALUES
(1, 1, 'czxcx', '300', '500', '400', 100, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `favorites`
--

CREATE TABLE IF NOT EXISTS `favorites` (
  `id_fav` int(11) NOT NULL AUTO_INCREMENT,
  `id_user_fav` int(11) NOT NULL,
  `id_act_fav` int(11) NOT NULL,
  PRIMARY KEY (`id_fav`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `favorites`
--


-- --------------------------------------------------------

--
-- Структура таблицы `mailing`
--

CREATE TABLE IF NOT EXISTS `mailing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `type` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `town_id` int(11) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `modified` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `mailing`
--


-- --------------------------------------------------------

--
-- Структура таблицы `newsletter`
--

CREATE TABLE IF NOT EXISTS `newsletter` (
  `id_user` int(11) NOT NULL,
  `email_user` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `newsletter`
--


-- --------------------------------------------------------

--
-- Структура таблицы `operation`
--

CREATE TABLE IF NOT EXISTS `operation` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL COMMENT 'Название операцции, товара и т.п.',
  `description` varchar(255) DEFAULT NULL COMMENT 'Описание операции, товара и т.п.',
  `user_id` int(11) DEFAULT NULL COMMENT 'Пользователь, баланс которого изменился',
  `summ` int(11) DEFAULT NULL COMMENT 'Сумма на которую изменился баланс',
  `type` tinyint(2) DEFAULT NULL COMMENT 'Тип операции (пополнение баланса, покупка товара и т.п.)',
  `status` tinyint(2) NOT NULL DEFAULT '3' COMMENT 'Статус операции',
  `object_id` int(11) DEFAULT NULL COMMENT 'ID конкретного товара',
  `object_type` varchar(64) DEFAULT NULL COMMENT 'Тип товар (например Act)',
  `extra` text COMMENT 'Дополнтельное поле',
  `created` int(11) DEFAULT NULL,
  `modified` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

--
-- Дамп данных таблицы `operation`
--

INSERT INTO `operation` (`id`, `title`, `description`, `user_id`, `summ`, `type`, `status`, `object_id`, `object_type`, `extra`, `created`, `modified`) VALUES
(1, 'Оплата товара', NULL, 16, 300, 1, 1, 1, 'Acts', NULL, 1348782425, 1348782425),
(2, 'Оплата товара', NULL, 16, 300, 1, 1, 1, 'Acts', NULL, 1348782425, 1348782425),
(3, 'Оплата товара', NULL, 16, 300, 1, 1, 1, 'Acts', NULL, 1348782425, 1348782425),
(4, 'Оплата товара', NULL, 16, 300, 1, 2, 1, 'Acts', 'Закончились купоны', 1348782425, 1348782425),
(5, 'Оплата товара', NULL, 16, 300, 1, 2, 1, 'Acts', 'Закончились купоны', 1348782425, 1348782425),
(6, 'Оплата товара', NULL, 16, 300, 1, 1, 1, 'Acts', NULL, 1348782838, 1348782838),
(7, 'Оплата товара', NULL, 16, 300, 1, 1, 1, 'Acts', NULL, 1348782838, 1348782838),
(8, 'Оплата товара', NULL, 16, 300, 1, 1, 1, 'Acts', NULL, 1348782838, 1348782838),
(9, 'Оплата товара', NULL, 16, 300, 1, 1, 1, 'Acts', NULL, 1348782839, 1348782839),
(10, 'Оплата товара', NULL, 16, 300, 1, 1, 1, 'Acts', NULL, 1348782839, 1348782839),
(11, 'Оплата товара', NULL, 16, 300, 1, 1, 1, 'Acts', NULL, 1348782839, 1348782839),
(12, 'Оплата товара', NULL, 16, 300, 1, 1, 1, 'Acts', NULL, 1348782839, 1348782839),
(13, 'Оплата товара', NULL, 16, 300, 1, 1, 1, 'Acts', NULL, 1348782839, 1348782839),
(14, 'Оплата товара', NULL, 16, 300, 1, 1, 1, 'Acts', NULL, 1348782839, 1348782839),
(15, 'Оплата товара', NULL, 16, 300, 1, 1, 1, 'Acts', NULL, 1348782839, 1348782839),
(16, 'Оплата товара', NULL, 16, 300, 1, 1, 1, 'Acts', NULL, 1348782839, 1348782839),
(17, 'Оплата товара', NULL, 16, 300, 1, 1, 1, 'Acts', NULL, 1348782839, 1348782839),
(18, 'Оплата товара', NULL, 16, 300, 1, 2, 1, 'Acts', 'Не достаточно средств на счете', 1348782839, 1348782839),
(19, 'Оплата товара', NULL, 16, 300, 1, 2, 1, 'Acts', 'Не достаточно средств на счете', 1348782839, 1348782839),
(20, 'Оплата товара', NULL, 16, 300, 1, 2, 1, 'Acts', 'Не достаточно средств на счете', 1348782839, 1348782839),
(21, 'Оплата товара', NULL, 16, 300, 1, 2, 1, 'Acts', 'Не достаточно средств на счете', 1348782839, 1348782839),
(22, 'Оплата товара', NULL, 16, 300, 1, 2, 1, 'Acts', 'Не достаточно средств на счете', 1348782839, 1348782839),
(23, 'Оплата товара', NULL, 16, 300, 1, 2, 1, 'Acts', 'Не достаточно средств на счете', 1348782839, 1348782839),
(24, 'Оплата товара', NULL, 16, 300, 1, 2, 1, 'Acts', 'Не достаточно средств на счете', 1348782839, 1348782839),
(25, 'Оплата товара', NULL, 16, 300, 1, 2, 1, 'Acts', 'Не достаточно средств на счете', 1348782839, 1348782839),
(26, 'Оплата товара', NULL, 16, 300, 1, 2, 1, 'Acts', 'Не достаточно средств на счете', 1349128316, 1349128316),
(27, 'Оплата товара', NULL, 16, 300, 1, 2, 1, 'Acts', 'Не достаточно средств на счете', 1349128317, 1349128317),
(28, 'Оплата товара', NULL, 16, 300, 1, 2, 1, 'Acts', 'Не достаточно средств на счете', 1349128368, 1349128368),
(29, 'Оплата товара', NULL, 16, 300, 1, 2, 1, 'Acts', 'Не достаточно средств на счете', 1349128368, 1349128368),
(30, 'Оплата товара', NULL, 16, 300, 1, 2, 1, 'Acts', 'Не достаточно средств на счете', 1349128368, 1349128368),
(31, 'Оплата товара', NULL, 16, 300, 1, 2, 1, 'Acts', 'Не достаточно средств на счете', 1349129012, 1349129012),
(32, 'Оплата товара', NULL, 16, 300, 1, 2, 1, 'Acts', 'Не достаточно средств на счете', 1349129157, 1349129157),
(33, 'Оплата товара', NULL, 16, 300, 1, 2, 1, 'Acts', 'Не достаточно средств на счете', 1349129183, 1349129183),
(34, 'Оплата товара', NULL, 16, 300, 1, 2, 1, 'Acts', 'Не достаточно средств на счете', 1349129316, 1349129316),
(35, 'Оплата товара', NULL, 16, 300, 1, 2, 1, 'Acts', 'Не достаточно средств на счете', 1349129432, 1349129432),
(36, 'Оплата товара', NULL, 16, 300, 1, 2, 1, 'Acts', 'Не достаточно средств на счете', 1349129600, 1349129600),
(37, 'Оплата товара', NULL, 16, 300, 1, 2, 1, 'Acts', 'Не достаточно средств на счете', 1349129600, 1349129600),
(38, 'Оплата товара', NULL, 16, 300, 1, 2, 1, 'Acts', 'Не достаточно средств на счете', 1349129626, 1349129626),
(39, 'Оплата товара', NULL, 16, 300, 1, 2, 1, 'Acts', 'Не достаточно средств на счете', 1349129626, 1349129626);

-- --------------------------------------------------------

--
-- Структура таблицы `option`
--

CREATE TABLE IF NOT EXISTS `option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT 'алиас опции',
  `title` varchar(255) NOT NULL COMMENT 'человекочитаемое название опции',
  `default_value` varchar(255) NOT NULL COMMENT 'стандартное значение',
  `type` enum('global','local') NOT NULL DEFAULT 'global' COMMENT 'тип опции',
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `option`
--


-- --------------------------------------------------------

--
-- Структура таблицы `option_value`
--

CREATE TABLE IF NOT EXISTS `option_value` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option_id` int(11) NOT NULL,
  `towns_id` int(11) NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `option_id` (`option_id`),
  KEY `towns_id` (`towns_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `option_value`
--


-- --------------------------------------------------------

--
-- Структура таблицы `org`
--

CREATE TABLE IF NOT EXISTS `org` (
  `id_org` int(11) NOT NULL,
  `name_org` varchar(255) NOT NULL,
  `login_org` varchar(255) NOT NULL,
  `pass_org` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `org`
--


-- --------------------------------------------------------

--
-- Структура таблицы `page`
--

CREATE TABLE IF NOT EXISTS `page` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(128) DEFAULT NULL COMMENT 'Заголовок страницы',
  `name` varchar(32) DEFAULT NULL COMMENT 'Для ЧПУ',
  `text` text NOT NULL COMMENT 'Текст страницы',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `seo_title` varchar(128) DEFAULT NULL,
  `seo_description` text,
  `seo_keywords` text,
  `created` int(11) DEFAULT NULL,
  `modified` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `page`
--

INSERT INTO `page` (`id`, `title`, `name`, `text`, `type`, `seo_title`, `seo_description`, `seo_keywords`, `created`, `modified`) VALUES
(1, 'О сервисе', 'about', 'weqweasdqweqweq<p>weASDasdas<br>ASDfqweqwe</p>\r\n', 1, 'О сервисе', 'О сервисе', 'О сервисе', 1344322650, 1344654937),
(2, 'Обратная связь', 'feedback', '', 2, 'Обратная связь', 'Обратная связь', 'Обратная связь', 1344322728, 1344322728);

-- --------------------------------------------------------

--
-- Структура таблицы `profile`
--

CREATE TABLE IF NOT EXISTS `profile` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `privacy` enum('protected','private','public') NOT NULL,
  `lastname` varchar(50) NOT NULL DEFAULT '',
  `firstname` varchar(50) NOT NULL DEFAULT '',
  `show_friends` tinyint(1) DEFAULT '1',
  `allow_comments` tinyint(1) DEFAULT '1',
  `email` varchar(255) NOT NULL DEFAULT '',
  `street` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `about` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `profile`
--


-- --------------------------------------------------------

--
-- Структура таблицы `profile_comment`
--

CREATE TABLE IF NOT EXISTS `profile_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `createtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `profile_comment`
--


-- --------------------------------------------------------

--
-- Структура таблицы `profile_field`
--

CREATE TABLE IF NOT EXISTS `profile_field` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `varname` varchar(50) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `hint` text NOT NULL,
  `field_type` varchar(50) NOT NULL DEFAULT '',
  `field_size` int(3) NOT NULL DEFAULT '0',
  `field_size_min` int(3) NOT NULL DEFAULT '0',
  `required` int(1) NOT NULL DEFAULT '0',
  `match` varchar(255) NOT NULL DEFAULT '',
  `range` varchar(255) NOT NULL DEFAULT '',
  `error_message` varchar(255) NOT NULL DEFAULT '',
  `other_validator` varchar(255) NOT NULL DEFAULT '',
  `default` varchar(255) NOT NULL DEFAULT '',
  `position` int(3) NOT NULL DEFAULT '0',
  `visible` int(1) NOT NULL DEFAULT '0',
  `related_field_name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `varname` (`varname`,`visible`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `profile_field`
--


-- --------------------------------------------------------

--
-- Структура таблицы `profile_visit`
--

CREATE TABLE IF NOT EXISTS `profile_visit` (
  `visitor_id` int(11) NOT NULL,
  `visited_id` int(11) NOT NULL,
  `timestamp_first_visit` int(11) NOT NULL,
  `timestamp_last_visit` int(11) NOT NULL,
  `num_of_visits` int(11) NOT NULL,
  PRIMARY KEY (`visitor_id`,`visited_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `profile_visit`
--


-- --------------------------------------------------------

--
-- Структура таблицы `purchase`
--

CREATE TABLE IF NOT EXISTS `purchase` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `act_id` int(11) NOT NULL COMMENT 'ID Акции',
  `org_id` int(11) DEFAULT NULL COMMENT 'ID организации которой принадлежит акция',
  `secret_key` varchar(9) DEFAULT NULL COMMENT 'Секретный код купона',
  `user_id` int(11) DEFAULT NULL COMMENT 'ID покупателя',
  `operation_id` int(11) DEFAULT NULL COMMENT 'ID Покупки',
  `status` tinyint(1) DEFAULT '0' COMMENT 'Статус покупки (новая, использованная, удалена и т.п.)',
  `picture` varchar(64) DEFAULT NULL COMMENT 'Код купона в виде изображения',
  `created` int(11) DEFAULT NULL,
  `modified` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Дамп данных таблицы `purchase`
--

INSERT INTO `purchase` (`id`, `act_id`, `org_id`, `secret_key`, `user_id`, `operation_id`, `status`, `picture`, `created`, `modified`) VALUES
(1, 1, 17, '05E2-T9MN', 16, NULL, 2, NULL, 1348782425, 1348782558),
(2, 1, 17, '1LGD-QAWC', 16, NULL, 2, NULL, 1348782425, 1348782556),
(3, 1, 17, 'F517-P23G', 16, NULL, 2, 'a671e7b7eb8948a7617f7860a0fb1d10.jpg', 1348782425, 1348782554),
(4, 1, 17, 'PUSU-635N', 16, NULL, 1, NULL, 1348782838, 1348782838),
(5, 1, 17, '8N5C-8589', 16, NULL, 1, NULL, 1348782838, 1348782838),
(6, 1, 17, 'O49Z-5N15', 16, NULL, 1, NULL, 1348782838, 1348782838),
(7, 1, 17, '2AK6-ZLDI', 16, NULL, 1, NULL, 1348782839, 1348782839),
(8, 1, 17, 'WBBH-U9NP', 16, NULL, 2, NULL, 1348782839, 1348782923),
(9, 1, 17, 'P26P-OVZ6', 16, NULL, 1, NULL, 1348782839, 1348782839),
(10, 1, 17, 'JPIV-TIT1', 16, NULL, 1, NULL, 1348782839, 1348782839),
(11, 1, 17, 'VBW5-1MI6', 16, NULL, 1, NULL, 1348782839, 1348782839),
(12, 1, 17, 'NBAZ-FROT', 16, NULL, 1, NULL, 1348782839, 1348782839),
(13, 1, 17, 'MTI4-WB98', 16, NULL, 1, NULL, 1348782839, 1348782839),
(14, 1, 17, 'VDE0-WYW3', 16, NULL, 1, NULL, 1348782839, 1348782839),
(15, 1, 17, 'GCVL-VQ4S', 16, NULL, 2, NULL, 1348782839, 1348782920);

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `is_membership_possible` tinyint(1) NOT NULL DEFAULT '0',
  `price` double DEFAULT NULL COMMENT 'Price (when using membership module)',
  `duration` int(11) DEFAULT NULL COMMENT 'How long a membership is valid',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `role`
--


-- --------------------------------------------------------

--
-- Структура таблицы `sale`
--

CREATE TABLE IF NOT EXISTS `sale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start` int(11) NOT NULL,
  `finish` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `sale`
--

INSERT INTO `sale` (`id`, `start`, `finish`) VALUES
(1, 1348693200, 1348866000);

-- --------------------------------------------------------

--
-- Структура таблицы `sale_subscribe`
--

CREATE TABLE IF NOT EXISTS `sale_subscribe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `sale_subscribe`
--


-- --------------------------------------------------------

--
-- Структура таблицы `test_operations`
--

CREATE TABLE IF NOT EXISTS `test_operations` (
  `id` int(10) NOT NULL,
  `type` enum('rbkmoney','qiwi','visa','mastercard') NOT NULL,
  `summ` float NOT NULL,
  `status` enum('paid','notpaid') DEFAULT 'notpaid',
  `date` int(10) NOT NULL,
  KEY `orders` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `test_operations`
--


-- --------------------------------------------------------

--
-- Структура таблицы `themes`
--

CREATE TABLE IF NOT EXISTS `themes` (
  `id_themes` int(11) NOT NULL AUTO_INCREMENT,
  `name_themes` varchar(255) NOT NULL,
  `l_name_themes` varchar(255) NOT NULL,
  `ico_themes` varchar(255) NOT NULL,
  PRIMARY KEY (`id_themes`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `themes`
--

INSERT INTO `themes` (`id_themes`, `name_themes`, `l_name_themes`, `ico_themes`) VALUES
(1, 'Красота', '', ''),
(2, 'Отдых', '', ''),
(3, 'Здоровье', '', ''),
(4, 'Еда', '', ''),
(5, 'Авто', '', ''),
(6, 'Товары', '', ''),
(7, 'Прочее', '', '');

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

-- --------------------------------------------------------

--
-- Структура таблицы `translation`
--

CREATE TABLE IF NOT EXISTS `translation` (
  `message` varbinary(255) NOT NULL,
  `translation` varchar(255) NOT NULL,
  `language` varchar(5) NOT NULL,
  `category` varchar(50) NOT NULL,
  PRIMARY KEY (`message`,`language`,`category`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `translation`
--


-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(128) NOT NULL,
  `soc_uid` varchar(50) DEFAULT NULL,
  `soc_network` varchar(50) DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `working_time` text COMMENT 'Рабочее время компании',
  `phone` varchar(25) DEFAULT NULL COMMENT 'Номера телефонов компании',
  `website` varchar(255) DEFAULT NULL,
  `active` enum('Y','N') NOT NULL DEFAULT 'Y',
  `activationKey` varchar(128) DEFAULT '',
  `createtime` int(10) NOT NULL DEFAULT '0',
  `lastvisit` int(10) NOT NULL DEFAULT '0',
  `lastaction` int(10) NOT NULL DEFAULT '0',
  `lastpasswordchange` int(10) NOT NULL DEFAULT '0',
  `superuser` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `avatar` varchar(255) DEFAULT NULL,
  `notifyType` enum('None','Digest','Instant','Threshold') DEFAULT 'Instant',
  `id_towns_user` int(10) DEFAULT NULL,
  `address` text,
  `role` enum('administrator','organisation','locale_administrator','user','guest') DEFAULT 'user',
  `balance` int(11) unsigned NOT NULL DEFAULT '0',
  `bonus` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `superuser` (`superuser`),
  KEY `id_towns_user` (`id_towns_user`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `soc_uid`, `soc_network`, `first_name`, `last_name`, `company_name`, `working_time`, `phone`, `website`, `active`, `activationKey`, `createtime`, `lastvisit`, `lastaction`, `lastpasswordchange`, `superuser`, `status`, `avatar`, `notifyType`, `id_towns_user`, `address`, `role`, `balance`, `bonus`) VALUES
(1, 'Артем', 'ru.crtv@gmail.com', '', '100002740865398', 'facebook', 'Артем', 'Филатов', '', NULL, NULL, NULL, 'Y', '', 1344281674, 0, 0, 0, 1, 0, NULL, 'Instant', 1, '[]', 'administrator', 0, 200),
(2, 'qwe', 'qwe@zxc.ru', 'qweqwe', NULL, NULL, 'Организация 1', 'Организация 1', 'Организация 1', '09:00 - 18:00', '7 903 555 55 55', '', 'Y', '', 1344281958, 0, 0, 1344281958, 0, 0, '', 'Instant', 18, '[{"address":"\\u0433. \\u041a\\u0440\\u0430\\u0441\\u043d\\u043e\\u0434\\u0430\\u0440, \\u0443\\u043b. \\u0410\\u044d\\u0440\\u043e\\u0434\\u0440\\u043e\\u043c\\u043d\\u0430\\u044f, \\u0434. 7"},{"address":"\\u0433. \\u041a\\u0440\\u0430\\u0441\\u043d\\u043e\\u0434\\u0430\\u0440, \\u0443\\u043b. \\u0410\\u044d\\u0440\\u043e\\u0434\\u0440\\u043e\\u043c\\u043d\\u0430\\u044f, \\u0434. 7"},{"address":"\\u0433. \\u041a\\u0440\\u0430\\u0441\\u043d\\u043e\\u0434\\u0430\\u0440, \\u0443\\u043b. \\u0410\\u044d\\u0440\\u043e\\u0434\\u0440\\u043e\\u043c\\u043d\\u0430\\u044f, \\u0434. 7"}]', 'organisation', 0, 0),
(14, 'васькино', 'asdfwe@mail.ru', '122334', NULL, NULL, '', '', '54', '345', '345', '', 'Y', '', 1347627966, 0, 0, 1347627966, 0, 0, '', 'Instant', NULL, '[{"address":"\\u0433. \\u041c\\u043e\\u0441\\u043a\\u0432\\u0430, \\u0443\\u043b. \\u041b\\u0435\\u043d\\u0438\\u043d\\u0430, \\u0434. 15"}]', 'organisation', 0, 0),
(3, 'asd', 'asdasd@qqq.ru', 'qweqwe', NULL, NULL, 'Организация 2', 'Организация 2', 'Организация 2', '', '', '', 'Y', '', 1344282121, 0, 0, 1344282121, 0, 0, '', 'Instant', 18, '[{"address":"\\u0433. \\u041c\\u043e\\u0441\\u043a\\u0432\\u0430, \\u0443\\u043b. \\u041e\\u043a\\u0442\\u044f\\u0431\\u0440\\u044c\\u0441\\u043a\\u0430\\u044f, \\u0434. 1"},{"address":"\\u0433. \\u041a\\u0430\\u0437\\u0430\\u043d\\u044c, \\u0443\\u043b. \\u0422\\u044b\\u043d\\u044b\\u0447, \\u0434. 1"}]', 'organisation', 0, 0),
(4, 'asdasd', 'zxc@asd.ru', 'qweqwe', NULL, NULL, 'Организация 3', 'Организация 3', 'Организация 3', '', '', '', 'Y', '', 1344282266, 0, 0, 1344282266, 0, 0, '', 'Instant', 18, '[{"address":"\\u0433. \\u041a\\u0430\\u0437\\u0430\\u043d\\u044c, \\u0443\\u043b. \\u041c\\u0443\\u0441\\u0438\\u043d\\u0430, \\u0434. 14"},{"address":"\\u0433. \\u041a\\u0430\\u0437\\u0430\\u043d\\u044c, \\u0443\\u043b. \\u041c\\u0438\\u0440\\u0430, \\u0434. 7"},{"address":"\\u0433. \\u041a\\u0430\\u0437\\u0430\\u043d\\u044c, \\u0443\\u043b. \\u041d\\u043e\\u0432\\u0430\\u044f, \\u0434. 1"}]', 'user', 0, 0),
(5, 'qqq', 'xxx@aaa.rry', 'qweqwe', NULL, NULL, 'qwqwe', 'wwq', 'qwwqe', '', '', '', 'Y', '', 1344286458, 0, 0, 1344286458, 0, 0, '', 'Instant', NULL, '[{"address":"\\u0433. \\u041c\\u043e\\u0441\\u043a\\u0432\\u0430, \\u0443\\u043b. \\u041b\\u0435\\u043d\\u0438\\u043d\\u0430, \\u0434. 36"}]', 'organisation', 0, 0),
(6, 'Ник', 'dosia03@mail.ru', '', '145905902', 'vkontakte', 'Ник', 'Тесла', '', NULL, NULL, NULL, 'Y', '', 1344412850, 0, 0, 0, 1, 0, NULL, 'Instant', 1, '[]', 'administrator', 7996, 100),
(7, 'qweqwe', 'qwesad@asd.rtu', 'qweqwe', NULL, NULL, '', '', '', '', '', '', 'Y', '', 1344848098, 0, 0, 1344848098, 0, 0, '', 'Instant', NULL, '[{"address":"\\u0433. \\u041c\\u043e\\u0441\\u043a\\u0432\\u0430, \\u0443\\u043b. \\u041b\\u0435\\u043d\\u0438\\u043d\\u0430, \\u0434. 23"}]', 'organisation', 0, 0),
(8, '', 'ru.crtv@ya.ru', '221c655927b30efdd19dec05ed0ca021', NULL, NULL, '', '', '', NULL, NULL, NULL, 'Y', '', 1345019262, 0, 0, 0, 0, 0, NULL, 'Instant', 1, '[]', 'user', 0, 0),
(9, '', 'mailpicker@yandex.ru', '61b28224c347cc0ef54faabd9bd78e84', NULL, NULL, '', '', '', NULL, NULL, NULL, 'Y', '', 1345020807, 0, 0, 0, 0, 0, NULL, 'Instant', 1, '[]', 'user', 0, 0),
(10, '', 'ru.crtv@yaaa.ru', 'efe6398127928f1b2e9ef3207fb82663', NULL, NULL, '', '', '', NULL, NULL, NULL, 'Y', '', 1345020859, 0, 0, 0, 0, 0, NULL, 'Instant', 1, '[]', 'user', 0, 0),
(11, '', 'dag777@ukr.net', '4fcbff10b8cc9dcd5fb2d3b5d5c186c2', NULL, NULL, '', '', '', NULL, NULL, NULL, 'Y', '', 1345815770, 0, 0, 0, 0, 0, NULL, 'Instant', 1, '[]', 'user', 0, 0),
(12, 'Ангелина', 'zxz325@gmail.com', '', '158966191', 'vkontakte', 'Ангелина', 'Костикова', '', NULL, NULL, NULL, 'Y', '', 1346331067, 0, 0, 0, 1, 0, NULL, 'Instant', NULL, '[]', 'administrator', 0, 0),
(13, 'Алексеевские бани', 'nastasi193@mail.ru', '123456', NULL, NULL, '', '', 'Алексеевские бани в Краснодаре', '', '+7 (861) 237-37-37', '', 'Y', '', 1347626571, 0, 0, 1347626571, 0, 0, '5204457d2aee9590cabf53f054c14e14', 'Instant', 22, '[{"address":"\\u0433. \\u041a\\u0440\\u0430\\u0441\\u043d\\u043e\\u0434\\u0430\\u0440, \\u0443\\u043b. \\u041e\\u043d\\u0435\\u0436\\u0441\\u043a\\u0430\\u044f, \\u0434. 7"}]', 'organisation', 0, 0),
(15, 'Владимир', 'tomminokk@gmail.com', '', '9487691', 'vkontakte', 'Владимир', 'Ливкин', '', NULL, NULL, NULL, 'Y', '', 1347630267, 0, 0, 0, 0, 0, NULL, 'Instant', NULL, '[]', 'user', 0, 0),
(16, 'Tsurka', 'turcaigor@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, '', '', '', '', '', '', 'Y', '93b6deed95aca08ab22dae75e28592b1', 1347817076, 0, 0, 0, 1, 0, NULL, 'Instant', 1, '[]', 'administrator', 50, 5800),
(17, 'Большая Организация', 'bigorganizatoin@mail.ru', '25d55ad283aa400af464c76d713c07ad', NULL, NULL, '', '', 'Большая Организация', '2434 24234', '23423423434', 'dsadsddd.dd', 'Y', '', 1348782327, 0, 0, 0, 0, 0, '', 'Instant', NULL, '[{"address":"\\u0433. \\u041c\\u043e\\u0441\\u043a\\u0432\\u0430, \\u0443\\u043b. \\u041b\\u0435\\u043d\\u0438\\u043d\\u0430, \\u0434. 22"},{"address":"\\u0433. \\u041c\\u043e\\u0441\\u043a\\u0432\\u0430, \\u0443\\u043b. \\u041b\\u0435\\u043d\\u0438\\u043d\\u0430, \\u0434. 22"}]', 'organisation', 0, 0),
(18, '', 'test@test.te', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, '', '', '', NULL, NULL, NULL, 'Y', '', 1349130273, 0, 0, 0, 0, 0, NULL, 'Instant', 1, '[]', 'user', 0, 0),
(19, '', 'wwww@ssss.ddd', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, '', '', '', NULL, NULL, NULL, 'Y', '', 1349130965, 0, 0, 0, 0, 0, NULL, 'Instant', 1, '[]', 'user', 0, 0);
