-- phpMyAdmin SQL Dump
-- version 3.3.2deb1ubuntu1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Сен 21 2012 г., 23:11
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
  PRIMARY KEY (`id_act`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `act`
--

INSERT INTO `act` (`id_act`, `paid`, `name_act`, `short_url`, `seo_title`, `seo_keywords`, `seo_description`, `url_name`, `photo_act`, `short_text_act`, `full_text_act`, `terms`, `id_org_act`, `id_town_act`, `id_themes_act`, `id_tag_act`, `price_old`, `price_new`, `price_new_description`, `coupon_count`, `coupon_purchased`, `coupon_need`, `is_bonus`, `date_start_act`, `date_end_act`, `date_end_coupon_act`) VALUES
(1, 0, 'test1', 'test1', '', '', '', '', 'f00204d834de5b07f2cfd1c7970e38df', 'test1', '<blockquote><p>&nbsp;test1</p></blockquote>', '<p>&nbsp;test1</p>', 2, 1, 1, NULL, 0, NULL, '', 25, 2, 0, 0, '2012-09-21 00:00:00', '2012-09-30 00:00:00', '2012-09-30 00:00:00');

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
(1, 1, 'test1', '150', '100', '50', 50, NULL, NULL);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `operation`
--

INSERT INTO `operation` (`id`, `title`, `description`, `user_id`, `summ`, `type`, `status`, `object_id`, `object_type`, `extra`, `created`, `modified`) VALUES
(1, 'Оплата товара', NULL, 16, 150, 1, 1, 1, 'Acts', NULL, 1348254614, 1348254614),
(2, 'Оплата товара', NULL, 16, 150, 1, 1, 1, 'Acts', NULL, 1348256279, 1348256279);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `purchase`
--

INSERT INTO `purchase` (`id`, `act_id`, `org_id`, `secret_key`, `user_id`, `operation_id`, `status`, `picture`, `created`, `modified`) VALUES
(1, 1, 2, '5DXS-3YF2', 16, NULL, 1, '67d1a448ea02f46c2eb173aeb153f268.jpg', 1348254614, 1348257193),
(2, 1, 2, 'E1SZ-UXI4', 16, NULL, 2, NULL, 1348256279, 1348256400);

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `sale`
--


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
  PRIMARY KEY (`id_towns`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Дамп данных таблицы `towns`
--

INSERT INTO `towns` (`id_towns`, `name_towns`, `description`) VALUES
(1, 'Москва', 'г. Москва, тел. 8 (909) 355-55-55'),
(2, 'Тольятти', 'г. Краснодар, тел. 8 (909) 355-55-55'),
(3, 'Белгород', NULL),
(4, 'Курск', NULL),
(5, 'Воронеж', NULL),
(6, 'Самара', NULL),
(7, 'Саратов', NULL),
(8, 'Екатеринбург', NULL),
(9, 'Нижний Новгород', NULL),
(10, 'Владимир', NULL),
(11, 'Брянск', NULL),
(12, 'Смоленск', NULL),
(13, 'Иваново', NULL),
(14, 'Тула', NULL),
(15, 'Калуга', NULL),
(16, 'Магадан', NULL),
(17, 'Пенза', NULL),
(18, 'Казань', 'г. Казань, тел. 8 (909) 355-55-55'),
(19, 'Чебоксары', NULL),
(20, 'Ярославль', NULL),
(21, 'Другой город', 'фывфыв'),
(22, 'Краснодар', 'г. Краснодар, тел. +7 (985) 319-05-09');

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
  `activationKey` varchar(128) NOT NULL DEFAULT '',
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `soc_uid`, `soc_network`, `first_name`, `last_name`, `company_name`, `working_time`, `phone`, `website`, `active`, `activationKey`, `createtime`, `lastvisit`, `lastaction`, `lastpasswordchange`, `superuser`, `status`, `avatar`, `notifyType`, `id_towns_user`, `address`, `role`, `balance`, `bonus`) VALUES
(1, 'Артем', 'ru.crtv@gmail.com', '', '100002740865398', 'facebook', 'Артем', 'Филатов', '', NULL, NULL, NULL, 'Y', '', 1344281674, 0, 0, 0, 1, 0, NULL, 'Instant', 1, '[]', 'administrator', 0, 200),
(2, 'qwe', 'qwe@zxc.ru', 'qweqwe', NULL, NULL, 'Организация 1', 'Организация 1', 'Организация 1', '', '', '', 'Y', '', 1344281958, 0, 0, 1344281958, 0, 0, '', 'Instant', 18, '[{"address":"\\u0433. \\u041a\\u0440\\u0430\\u0441\\u043d\\u043e\\u0434\\u0430\\u0440, \\u0443\\u043b. \\u041e\\u043d\\u0435\\u0436\\u0441\\u043a\\u0430\\u044f, \\u0434. 7"},{"address":"\\u0433. \\u041a\\u0440\\u0430\\u0441\\u043d\\u043e\\u0434\\u0430\\u0440, \\u0443\\u043b. \\u0410\\u044d\\u0440\\u043e\\u0434\\u0440\\u043e\\u043c\\u043d\\u0430\\u044f, \\u0434. 7"}]', 'organisation', 0, 0),
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
(16, 'Tsurka', 'turcaigor@gmail.com', '25d55ad283aa400af464c76d713c07ad', NULL, NULL, '', '', '', '', '', '', 'Y', '', 1347817076, 0, 0, 0, 1, 0, NULL, 'Instant', 1, '[]', 'administrator', 9700, 5000);
