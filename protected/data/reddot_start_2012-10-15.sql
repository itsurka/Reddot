-- phpMyAdmin SQL Dump
-- version 3.3.2deb1ubuntu1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Окт 15 2012 г., 19:51
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
  `is_published` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Опубликована ли акция (опубликована если is_active приймет значение 1)',
  `sent_past_notification` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Отправлено уведомление что акция перешла в прощедшие',
  `sent_expired_coupons_date_notification` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Отправлено уведомление об окончании срока действия купонов',
  `additional_images` text,
  PRIMARY KEY (`id_act`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `act`
--


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
  `ntf_2` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Смотреть в CMailer(Типы уведомлений)',
  `ntf_3` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Смотреть в CMailer(Типы уведомлений)',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `coupon`
--


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
  `recipientEmail` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT 'E-mail получателя',
  `created` int(11) DEFAULT NULL,
  `modified` int(11) DEFAULT NULL,
  `send_since_date` int(11) NOT NULL COMMENT 'Можно отправить начиная с этой даты',
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `operation`
--


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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `option`
--

INSERT INTO `option` (`id`, `name`, `title`, `default_value`, `type`) VALUES
(1, 'website_url', 'Адрес сайта', 'http://dev.reddot.com', 'global'),
(2, 'company_name', 'Название компании', 'RedDotCoupon.ru', 'global'),
(3, 'company_phone', 'Основной телефон организации', '+7 (909) 123-45-67', 'global'),
(4, 'company_email', 'Основной е-мэйл', 'company@mail.ru', 'global'),
(5, 'company_skype', 'Skype', 'company_skype', 'global'),
(6, 'company_url', 'Адрес сайта компании', 'RedDotKupon.ru', 'global');

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
-- Структура таблицы `phplist_admin`
--

CREATE TABLE IF NOT EXISTS `phplist_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `loginname` varchar(25) NOT NULL,
  `namelc` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modifiedby` varchar(25) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `passwordchanged` date DEFAULT NULL,
  `superuser` tinyint(4) DEFAULT '0',
  `disabled` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `loginname` (`loginname`),
  KEY `loginnameidx` (`loginname`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `phplist_admin`
--

INSERT INTO `phplist_admin` (`id`, `loginname`, `namelc`, `email`, `created`, `modified`, `modifiedby`, `password`, `passwordchanged`, `superuser`, `disabled`) VALUES
(1, 'admin', 'admin', '', '2012-10-02 20:08:24', '2012-10-02 20:08:24', '', 'phplist', '2012-10-02', 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `phplist_adminattribute`
--

CREATE TABLE IF NOT EXISTS `phplist_adminattribute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` varchar(30) DEFAULT NULL,
  `listorder` int(11) DEFAULT NULL,
  `default_value` varchar(255) DEFAULT NULL,
  `required` tinyint(4) DEFAULT NULL,
  `tablename` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `phplist_adminattribute`
--


-- --------------------------------------------------------

--
-- Структура таблицы `phplist_admintoken`
--

CREATE TABLE IF NOT EXISTS `phplist_admintoken` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adminid` int(11) NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  `entered` int(11) NOT NULL,
  `expires` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

--
-- Дамп данных таблицы `phplist_admintoken`
--

INSERT INTO `phplist_admintoken` (`id`, `adminid`, `value`, `entered`, `expires`) VALUES
(1, 1, '5e6ea4ab171bb7e647b9d02a6d5050d2', 1349197853, '2012-10-02 21:10:53'),
(2, 1, '6a0a2f15ef0fee542edcef7b7920b31f', 1349198703, '2012-10-02 21:25:03'),
(3, 1, 'f23c70413762dff5d7f10d996c1c0ec6', 1349198918, '2012-10-02 21:28:38'),
(4, 1, 'dd1782692d535cfcb2030bc057d354fe', 1349198921, '2012-10-02 21:28:41'),
(5, 1, 'd8e05c1dac58fe1c0d9d9858fee3e732', 1349198972, '2012-10-02 21:29:32'),
(6, 1, '3310537ca045f88cee78baad4ad0c702', 1349198990, '2012-10-02 21:29:50'),
(7, 1, '0f5f5952c417a7e7794dbd9bfcecaf58', 1349198995, '2012-10-02 21:29:55'),
(8, 1, 'e064c91592313309444cf7337bd50170', 1349199072, '2012-10-02 21:31:12'),
(9, 1, '09493f979382c36770bbcb48340e2fa7', 1349199088, '2012-10-02 21:31:28'),
(10, 1, 'f31bcbe538e597fb4bff2b9d88052401', 1349199164, '2012-10-02 21:32:44'),
(11, 1, '17f98f528759f224e0dfd3372bbb18e0', 1349199198, '2012-10-02 21:33:18'),
(13, 1, '74230ddfb52b3ba4d41a4cf7f80c1739', 1349199219, '2012-10-02 21:33:39'),
(14, 1, 'cac6cf0f4c5e6bf05ee1c6e796e1ee2a', 1349199224, '2012-10-02 21:33:44'),
(15, 1, '2fbe3cb0554a3bd1592241d71c903060', 1349199232, '2012-10-02 21:33:52'),
(16, 1, 'a125f15a9305979e7f8352cb4d8d62cf', 1349199235, '2012-10-02 21:33:55'),
(17, 1, 'bf5feec7acc1d063f902c8eb7513cc9b', 1349199235, '2012-10-02 21:33:55'),
(19, 1, 'efc57697aeca0891c8338cb11c5a3a14', 1349199246, '2012-10-02 21:34:06'),
(20, 1, 'b5c7396b94b8e271da0708f99d635543', 1349199274, '2012-10-02 21:34:34'),
(21, 1, '2286c910621efb5a7289d68504188452', 1349199413, '2012-10-02 21:36:53'),
(22, 1, '639e125693587df701b8593b72a694e8', 1349199433, '2012-10-02 21:37:13'),
(23, 1, '0ff0e5d09838df0f547304a6f9ef1045', 1349199436, '2012-10-02 21:37:16'),
(24, 1, '32107dffb27e94d7eac1e6aa24c39c1b', 1349199441, '2012-10-02 21:37:21'),
(25, 1, 'eabbb95c4542fa6d305e0d3d190fa110', 1349199444, '2012-10-02 21:37:24'),
(26, 1, '4739c449be34d8d87d2a4003578b2de9', 1349199452, '2012-10-02 21:37:32'),
(27, 1, '2d3f3af47a3cb43aa1209d4d88637bb5', 1349199458, '2012-10-02 21:37:38'),
(28, 1, 'cdb82ae1799d9f2b3113401b4fade3a4', 1349199483, '2012-10-02 21:38:03'),
(29, 1, 'ef8756dca2c3cdfe3e8c83ff9fbc796c', 1349199647, '2012-10-02 21:40:47'),
(30, 1, '4a746e0c3e07e7e57ab6db9362abd6d0', 1349199650, '2012-10-02 21:40:50'),
(31, 1, '8b66b3b8b054945f0009d003a1ae988e', 1349199652, '2012-10-02 21:40:52'),
(32, 1, '76b26b13d78f0d4ae7f0090ea01e85be', 1349199654, '2012-10-02 21:40:54'),
(33, 1, '5ad8e16db07087774566106069aa4cbd', 1349199656, '2012-10-02 21:40:56'),
(34, 1, 'dc127e69c9acadff97ea787026a5e60b', 1349199657, '2012-10-02 21:40:57'),
(35, 1, '5b9339b035adebd9b7ac284c050d18ba', 1349199658, '2012-10-02 21:40:58'),
(36, 1, '09b6d13f242dbeaf11a2f1ef6f6eafdb', 1349199909, '2012-10-02 21:45:09'),
(37, 1, 'b0fd6073435721459413d86e88c4436e', 1349199912, '2012-10-02 21:45:12'),
(38, 1, '2251aa168c752b7df631bbc0efdbf0c0', 1349199940, '2012-10-02 21:45:40'),
(39, 1, 'f598a27b0801483bcc71f8a8bcc2b753', 1349199951, '2012-10-02 21:45:51'),
(40, 1, 'e6e7e6813dc703ed35e676ce4bfc1ea2', 1349200041, '2012-10-02 21:47:21'),
(41, 1, '220949349a1c3f111c79457aaa8edcc1', 1349200283, '2012-10-02 21:51:23'),
(42, 1, 'db7cb02dd43e9827c4d885d814da802c', 1349200287, '2012-10-02 21:51:27'),
(43, 1, '2de968ef35fef73a6d14c5edfd1efeb9', 1349200291, '2012-10-02 21:51:31'),
(44, 1, '4127106a91a8eb38082d18dde1e87312', 1349200304, '2012-10-02 21:51:44'),
(45, 1, 'ee78a7ca7bd27b267534814eeef81957', 1349200363, '2012-10-02 21:52:43'),
(46, 1, '24299a3779322763b448d829bd16f59d', 1349200487, '2012-10-02 21:54:47');

-- --------------------------------------------------------

--
-- Структура таблицы `phplist_admin_attribute`
--

CREATE TABLE IF NOT EXISTS `phplist_admin_attribute` (
  `adminattributeid` int(11) NOT NULL,
  `adminid` int(11) NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`adminattributeid`,`adminid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `phplist_admin_attribute`
--


-- --------------------------------------------------------

--
-- Структура таблицы `phplist_admin_task`
--

CREATE TABLE IF NOT EXISTS `phplist_admin_task` (
  `adminid` int(11) NOT NULL,
  `taskid` int(11) NOT NULL,
  `level` int(11) DEFAULT NULL,
  PRIMARY KEY (`adminid`,`taskid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `phplist_admin_task`
--


-- --------------------------------------------------------

--
-- Структура таблицы `phplist_attachment`
--

CREATE TABLE IF NOT EXISTS `phplist_attachment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) DEFAULT NULL,
  `remotefile` varchar(255) DEFAULT NULL,
  `mimetype` varchar(255) DEFAULT NULL,
  `description` text,
  `size` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `phplist_attachment`
--


-- --------------------------------------------------------

--
-- Структура таблицы `phplist_bounce`
--

CREATE TABLE IF NOT EXISTS `phplist_bounce` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `header` text,
  `data` blob,
  `status` varchar(255) DEFAULT NULL,
  `comment` text,
  PRIMARY KEY (`id`),
  KEY `dateindex` (`date`),
  KEY `statusindex` (`status`(10))
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `phplist_bounce`
--


-- --------------------------------------------------------

--
-- Структура таблицы `phplist_bounceregex`
--

CREATE TABLE IF NOT EXISTS `phplist_bounceregex` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `regex` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `listorder` int(11) DEFAULT '0',
  `admin` int(11) DEFAULT NULL,
  `comment` text,
  `status` varchar(255) DEFAULT NULL,
  `count` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `regex` (`regex`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `phplist_bounceregex`
--


-- --------------------------------------------------------

--
-- Структура таблицы `phplist_bounceregex_bounce`
--

CREATE TABLE IF NOT EXISTS `phplist_bounceregex_bounce` (
  `regex` int(11) NOT NULL,
  `bounce` int(11) NOT NULL,
  PRIMARY KEY (`regex`,`bounce`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `phplist_bounceregex_bounce`
--


-- --------------------------------------------------------

--
-- Структура таблицы `phplist_config`
--

CREATE TABLE IF NOT EXISTS `phplist_config` (
  `item` varchar(35) NOT NULL,
  `value` longtext,
  `editable` tinyint(4) DEFAULT '1',
  `type` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`item`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `phplist_config`
--

INSERT INTO `phplist_config` (`item`, `value`, `editable`, `type`) VALUES
('version', '2.10.18', 0, NULL),
('updatelastcheck', '2012-10-02 20:08:25', 0, NULL),
('website', 'dev.reddot.com', 1, NULL),
('domain', 'dev.reddot.com', 1, NULL),
('xormask', '9cdde782bc5053fcc6c2d5f04bc6d835', 0, NULL),
('check_new_version', '7', 1, NULL),
('defaultmessagetemplate', '1', 1, NULL),
('fckeditor_height', '600', 1, NULL),
('messagefooter', '--\nIf you do not want to receive any more newsletters,  [UNSUBSCRIBE]\n\nTo update your preferences and to unsubscribe visit [PREFERENCES]\nForward a Message to Someone [FORWARD]', 1, NULL),
('message_from_name', 'Webmaster', 1, NULL),
('message_from_address', 'noreply@[DOMAIN]', 1, NULL),
('fckeditor_width', '600', 1, NULL),
('admin_address', 'webmaster@[DOMAIN]', 1, NULL),
('admin_addresses', '', 1, NULL),
('report_address', 'listreports@[DOMAIN]', 1, NULL),
('message_replyto_address', 'noreply@[DOMAIN]', 1, NULL),
('hide_single_list', '1', 1, NULL),
('textline_width', '40', 1, NULL),
('textarea_dimensions', '10,40', 1, NULL),
('send_admin_copies', '0', 1, NULL),
('defaultsubscribepage', '1', 1, NULL),
('subscribeurl', 'http://[WEBSITE]/lists/?p=subscribe', 1, NULL),
('unsubscribeurl', 'http://[WEBSITE]/lists/?p=unsubscribe', 1, NULL),
('blacklisturl', 'http://[WEBSITE]/lists/?p=blacklist', 1, NULL),
('confirmationurl', 'http://[WEBSITE]/lists/?p=confirm', 1, NULL),
('preferencesurl', 'http://[WEBSITE]/lists/?p=preferences', 1, NULL),
('forwardurl', 'http://[WEBSITE]/lists/?p=forward', 1, NULL),
('subscribesubject', 'Request for confirmation', 1, NULL),
('subscribemessage', '\r\n\r\n  Almost welcome to our newsletter(s) ...\r\n\r\n  Someone, hopefully you, has subscribed your email address to the following newsletters:\r\n  \r\n  [LISTS]\r\n\r\n  If this is correct, please click the following link to confirm your subscription.\r\n  Without this confirmation, you will not receive any newsletters.\r\n  \r\n  [CONFIRMATIONURL]\r\n  \r\n  If this is not correct, you do not need to do anything, simply delete this message.\r\n\r\n  Thank you\r\n  \r\n    ', 1, NULL),
('unsubscribesubject', 'Goodbye from our Newsletter', 1, NULL),
('unsubscribemessage', '\r\n  \r\n  Goodbye from our Newsletter, sorry to see you go.\r\n\r\n  You have been unsubscribed from our newsletters.\r\n\r\n  This is the last email you will receive from us. We have added you to our\r\n  "blacklist", which means that our newsletter system will refuse to send\r\n  you any other email, without manual intervention by our administrator.\r\n\r\n  If there is an error in this information, you can re-subscribe:\r\n  please go to [SUBSCRIBEURL] and follow the steps.\r\n\r\n  Thank you\r\n  \r\n  ', 1, NULL),
('confirmationsubject', 'Welcome to our Newsletter', 1, NULL),
('confirmationmessage', '\r\n  \r\n  Welcome to our Newsletter\r\n\r\n  Please keep this email for later reference.\r\n\r\n  Your email address has been added to the following newsletter(s):\r\n  [LISTS]\r\n\r\n  To update your details and preferences please go to [PREFERENCESURL].\r\n  If you do not want to receive any more messages, please go to [UNSUBSCRIBEURL].\r\n\r\n  Thank you\r\n  \r\n  ', 1, NULL),
('updatesubject', '[notify] Change of List-Membership details', 1, NULL),
('updatemessage', '\r\n  \r\n  This message is to inform you of a change of your details on our newsletter database\r\n\r\n  You are currently member of the following newsletters:\r\n  \r\n  [LISTS]\r\n  \r\n  [CONFIRMATIONINFO]\r\n  \r\n  The information on our system for you is as follows:\r\n  \r\n  [USERDATA]\r\n  \r\n  If this is not correct, please update your information at the following location:\r\n  \r\n  [PREFERENCESURL]\r\n  \r\n  Thank you\r\n  \r\n    ', 1, NULL),
('emailchanged_text', '\r\n  When updating your details, your email address has changed.\r\n  Please confirm your new email address by visiting this webpage:\r\n  \r\n  [CONFIRMATIONURL]\r\n  \r\n  ', 1, NULL),
('emailchanged_text_oldaddress', '\r\n  Please Note: when updating your details, your email address has changed.\r\n\r\n  A message has been sent to your new email address with a URL\r\n  to confirm this change. Please visit this website to activate\r\n  your membership.\r\n  ', 1, NULL),
('personallocation_subject', 'Your personal location', 1, NULL),
('personallocation_message', '\r\n  \r\n  You have requested your personal location to update your details from our website.\r\n  The location is below. Please make sure that you use the full line as mentioned below.\r\n  Sometimes email programme can wrap the line into multiple lines.\r\n  \r\n  Your personal location is:\r\n  [PREFERENCESURL]\r\n  \r\n  Thank you.\r\n  ', 1, NULL),
('forwardfooter', '--\nThis message has been forwarded to you by [FORWARDEDBY].\r\n  You have not been automatically subscribed to this newsletter.\r\n  To subscribe to this newsletter go to\n\n [SUBSCRIBE]\nClick [BLACKLIST] to refuse further email from this website', 1, NULL),
('pageheader', '<link href="styles/phplist.css" type="text/css" rel="stylesheet">\r\n</head>\r\n<body bgcolor="#ffffff" background="images/bg.png">\r\n<a name="top"></a>\r\n<div align=center>\r\n<table cellspacing=0 cellpadding=0 width=710 border=0>\r\n<tr>\r\n<td bgcolor="#000000" rowspan=3><img height=1 alt="" src="images/transparent.png" width=1 border=0></td>\r\n<td bgcolor="#000000"><img height=1 alt="" src="images/transparent.png" width=708 border=0></td>\r\n<td bgcolor="#000000" rowspan=3><img height=1 alt="" src="images/transparent.png" width=1 border=0></td>\r\n</tr>\r\n\r\n<tr valign="top" align="left">\r\n<td>\r\n<!--TOP TABLE starts-->\r\n<TABLE cellSpacing=0 cellPadding=0 width=708 bgColor=#ffffff border=0>\r\n  <TR vAlign=top>\r\n    <TD colSpan=2 rowspan="2" height="63" background="images/topstrip.png"><a href="http://www.phplist.com" target="_blank"><img src="images/masthead.png" border=0 width=577 height=75></a></TD>\r\n    <TD align=left\r\n      background="images/topstrip.png" bgcolor="#F0D1A3"><FONT\r\n      size=-2>&nbsp;<I>powered by: </I><BR>&nbsp;<B>[<A class=powered\r\n      href="http://www.php.net/" target=_new><I>PHP</I></A>]</B> + <B>[<A\r\n      class=powered href="http://www.mysql.com/"\r\n      target=_new>mySQL</A>]</B></FONT></TD></TR>\r\n  <TR vAlign=bottom>\r\n    <TD vAlign=bottom width=132\r\n    background="images/topright.png" bgcolor="#F0D1A3"><SPAN\r\n      class=webblermenu>PHPlist</SPAN></TD></TR>\r\n  <TR>\r\n    <TD bgColor=#000000><IMG height=1 alt=""\r\n      src="images/transparent.png" width=20\r\n      border=0></TD>\r\n    <TD bgColor=#000000><IMG height=1 alt=""\r\n      src="images/transparent.png" width=576\r\n      border=0></TD>\r\n    <TD bgColor=#000000><IMG height=1 alt=""\r\n      src="images/transparent.png" width=132\r\n      border=0></TD></TR>\r\n  <TR vAlign=top>\r\n    <TD>&nbsp;</TD>\r\n<td><div align=left>\r\n<br />\r\n', 1, NULL),
('pagefooter', '</div>\r\n</td>\r\n<td>\r\n<div class="menutableright">\r\n\r\n</div>\r\n</td>\r\n</tr>\r\n\r\n\r\n\r\n\r\n<tr><td colspan="4">&nbsp;</td></tr>\r\n\r\n\r\n\r\n<tr><td colspan="4">&nbsp;</td></tr>\r\n</table>\r\n<!--TOP TABLE ends-->\r\n\r\n</td></tr>\r\n\r\n\r\n<tr>\r\n<td bgcolor="#000000" colspan=3><img height=1 alt="" src="images/transparent.png" width=1 border=0></td>\r\n</tr>\r\n\r\n<tr>\r\n<td bgcolor="#000000"><img height=1 alt="" src="images/transparent.png" width=1 border=0></td>\r\n<td bgcolor="#ff9900" class="bottom">&copy; <a href="http://phplist.com" target="_phplist" class="urhere">phpList limited</a> | <a class="urhere" href="http://www.phplist.com" target="_blank">phplist</a></td>\r\n<td bgcolor="#000000"><img height=1 alt="" src="images/transparent.png" width=1 border=0></td>\r\n</tr>\r\n\r\n<tr>\r\n<td bgcolor="#000000" colspan=3><img height=1 alt="" src="images/transparent.png" width=1 border=0></td>\r\n</tr>\r\n\r\n<tr>\r\n<td colspan=3><img height=3 alt="" src="images/transparent.png" width=1 border=0></td>\r\n</tr>\r\n\r\n<tr>\r\n<td colspan=3>\r\n&nbsp;\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n\r\n</div>\r\n</body></html>\r\n', 1, NULL),
('html_charset', 'UTF-8', 1, NULL),
('text_charset', 'UTF-8', 1, NULL),
('html_email_style', '\r\n  <style type="text/css">\r\n  body { font-size : 11px; font-family: Verdana, Arial, Helvetica, sans-serif; }\r\n  a { font-size: 11px; color: #ff6600; font-style: normal; font-family: verdana, sans-serif; text-decoration: none; }\r\n  a:visited { color: #666666; }\r\n  a:hover {  text-decoration: underline; }\r\n  p { font-weight: normal; font-size: 11px; color: #666666; font-style: normal; font-family: verdana, sans-serif; text-decoration: none; }\r\n  h1 {font-weight: bold; font-size: 14px; color: #666666; font-style: normal; font-family: verdana, sans-serif; text-decoration: none;}\r\n  h2 {font-weight: bold; font-size: 13px; color: #666666; font-style: normal; font-family: verdana, sans-serif; text-decoration: none;}\r\n  h3 {font-weight: bold; font-size: 12px; color: #666666; font-style: normal; font-family: verdana, sans-serif; text-decoration: none; margin:0px; padding:0px;}\r\n  h4 {font-weight: bold; font-size: 11px; color: #666666; font-style: normal; font-family: verdana, sans-serif; text-decoration: none; margin:0px; padding:0px;}\r\n  hr {width : 100%; height : 1px; color: #ff9900; size:1px;}\r\n  .forwardform {margin: 0 0 0 0; padding: 0 0 0 0;}\r\n  .forwardinput {margin: 0 0 0 0; padding: 0 0 0 0;}\r\n  .forwardsubmit {margin: 0 0 0 0; padding: 0 0 0 0;}\r\n  div.emailfooter { font-size : 11px; font-family: Verdana, Arial, Helvetica, sans-serif; }\r\n  div.emailfooter a { font-size: 11px; color: #ff6600; font-style: normal; font-family: verdana, sans-serif; text-decoration: none; }\r\n  </style>\r\n  ', 1, NULL),
('alwayssendtextto', 'mail.com\nemail.com', 1, NULL),
('membership_columns', '', 1, NULL),
('rssthreshold', '', 1, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `phplist_eventlog`
--

CREATE TABLE IF NOT EXISTS `phplist_eventlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entered` datetime DEFAULT NULL,
  `page` varchar(100) DEFAULT NULL,
  `entry` text,
  PRIMARY KEY (`id`),
  KEY `enteredidx` (`entered`),
  KEY `pageidx` (`page`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Дамп данных таблицы `phplist_eventlog`
--

INSERT INTO `phplist_eventlog` (`id`, `entered`, `page`, `entry`) VALUES
(1, '2012-10-02 20:10:15', 'login', 'invalid login from 127.0.0.1, tried logging in as root'),
(2, '2012-10-02 20:38:03', 'processqueue', 'Processing has started, 1 message(s) to process.'),
(3, '2012-10-02 20:38:03', 'processqueue', 'It is safe to click your &quot;stop&quot; button now, report will be sent by email to listreports@dev.reddot.com'),
(4, '2012-10-02 20:38:03', 'processqueue', 'Processing message 3'),
(5, '2012-10-02 20:38:03', 'processqueue', 'Looking for users'),
(6, '2012-10-02 20:38:03', 'processqueue', 'Found them: 1 to process'),
(7, '2012-10-02 20:39:04', 'processqueue', 'Processed 1 out of 1 users'),
(8, '2012-10-02 20:39:04', 'processqueue', 'It took  1 mins 1 secs to send this message'),
(9, '2012-10-02 20:39:04', 'processqueue', '1 messages sent in 60.59 seconds (59 msgs/hr)'),
(10, '2012-10-02 20:39:04', 'processqueue', 'Finished this run'),
(11, '2012-10-02 20:40:04', 'processqueue', 'Waiting for 100 seconds before reloading');

-- --------------------------------------------------------

--
-- Структура таблицы `phplist_linktrack`
--

CREATE TABLE IF NOT EXISTS `phplist_linktrack` (
  `linkid` int(11) NOT NULL AUTO_INCREMENT,
  `messageid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `forward` text,
  `firstclick` datetime DEFAULT NULL,
  `latestclick` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `clicked` int(11) DEFAULT '0',
  PRIMARY KEY (`linkid`),
  UNIQUE KEY `messageid` (`messageid`,`userid`,`url`),
  KEY `midindex` (`messageid`),
  KEY `uidindex` (`userid`),
  KEY `urlindex` (`url`),
  KEY `miduidindex` (`messageid`,`userid`),
  KEY `miduidurlindex` (`messageid`,`userid`,`url`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `phplist_linktrack`
--


-- --------------------------------------------------------

--
-- Структура таблицы `phplist_linktrack_userclick`
--

CREATE TABLE IF NOT EXISTS `phplist_linktrack_userclick` (
  `linkid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `messageid` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `data` text,
  `date` datetime DEFAULT NULL,
  KEY `linkindex` (`linkid`),
  KEY `uidindex` (`userid`),
  KEY `midindex` (`messageid`),
  KEY `linkuserindex` (`linkid`,`userid`),
  KEY `linkusermessageindex` (`linkid`,`userid`,`messageid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `phplist_linktrack_userclick`
--


-- --------------------------------------------------------

--
-- Структура таблицы `phplist_list`
--

CREATE TABLE IF NOT EXISTS `phplist_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `entered` datetime DEFAULT NULL,
  `listorder` int(11) DEFAULT NULL,
  `prefix` varchar(10) DEFAULT NULL,
  `rssfeed` varchar(255) DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active` tinyint(4) DEFAULT NULL,
  `owner` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nameidx` (`name`),
  KEY `listorderidx` (`listorder`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `phplist_list`
--

INSERT INTO `phplist_list` (`id`, `name`, `description`, `entered`, `listorder`, `prefix`, `rssfeed`, `modified`, `active`, `owner`) VALUES
(1, 'test', 'List for testing.', '2012-10-02 20:08:25', 0, NULL, NULL, '2012-10-02 20:31:28', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `phplist_listmessage`
--

CREATE TABLE IF NOT EXISTS `phplist_listmessage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `messageid` int(11) NOT NULL,
  `listid` int(11) NOT NULL,
  `entered` datetime DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `messageid` (`messageid`,`listid`),
  KEY `listmessageidx` (`listid`,`messageid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `phplist_listmessage`
--

INSERT INTO `phplist_listmessage` (`id`, `messageid`, `listid`, `entered`, `modified`) VALUES
(1, 3, 1, '2012-10-02 20:37:48', '2012-10-02 20:37:48');

-- --------------------------------------------------------

--
-- Структура таблицы `phplist_listrss`
--

CREATE TABLE IF NOT EXISTS `phplist_listrss` (
  `listid` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `entered` datetime NOT NULL,
  `info` text,
  KEY `listididx` (`listid`),
  KEY `enteredidx` (`entered`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `phplist_listrss`
--


-- --------------------------------------------------------

--
-- Структура таблицы `phplist_listuser`
--

CREATE TABLE IF NOT EXISTS `phplist_listuser` (
  `userid` int(11) NOT NULL,
  `listid` int(11) NOT NULL,
  `entered` datetime DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`userid`,`listid`),
  KEY `userenteredidx` (`userid`,`entered`),
  KEY `userlistenteredidx` (`userid`,`listid`,`entered`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `phplist_listuser`
--

INSERT INTO `phplist_listuser` (`userid`, `listid`, `entered`, `modified`) VALUES
(1, 1, NULL, '2012-10-02 20:34:06');

-- --------------------------------------------------------

--
-- Структура таблицы `phplist_message`
--

CREATE TABLE IF NOT EXISTS `phplist_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) NOT NULL DEFAULT '(no subject)',
  `fromfield` varchar(255) NOT NULL DEFAULT '',
  `tofield` varchar(255) NOT NULL DEFAULT '',
  `replyto` varchar(255) NOT NULL DEFAULT '',
  `message` longtext,
  `textmessage` longtext,
  `footer` text,
  `entered` datetime DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `embargo` datetime DEFAULT NULL,
  `repeatinterval` int(11) DEFAULT '0',
  `repeatuntil` datetime DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `userselection` text,
  `sent` datetime DEFAULT NULL,
  `htmlformatted` tinyint(4) DEFAULT '0',
  `sendformat` varchar(20) DEFAULT NULL,
  `template` int(11) DEFAULT NULL,
  `processed` mediumint(8) unsigned DEFAULT '0',
  `astext` int(11) DEFAULT '0',
  `ashtml` int(11) DEFAULT '0',
  `astextandhtml` int(11) DEFAULT '0',
  `aspdf` int(11) DEFAULT '0',
  `astextandpdf` int(11) DEFAULT '0',
  `viewed` int(11) DEFAULT '0',
  `bouncecount` int(11) DEFAULT '0',
  `sendstart` datetime DEFAULT NULL,
  `rsstemplate` varchar(100) DEFAULT NULL,
  `owner` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `phplist_message`
--

INSERT INTO `phplist_message` (`id`, `subject`, `fromfield`, `tofield`, `replyto`, `message`, `textmessage`, `footer`, `entered`, `modified`, `embargo`, `repeatinterval`, `repeatuntil`, `status`, `userselection`, `sent`, `htmlformatted`, `sendformat`, `template`, `processed`, `astext`, `ashtml`, `astextandhtml`, `aspdf`, `astextandpdf`, `viewed`, `bouncecount`, `sendstart`, `rsstemplate`, `owner`) VALUES
(1, '(no subject)', '', '', '', NULL, NULL, NULL, '2012-10-02 20:10:53', '2012-10-02 20:10:53', '2012-10-02 20:10:53', 0, '2012-10-02 20:10:53', 'draft', NULL, NULL, 0, 'HTML', 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1),
(2, 'test', 'Webmaster noreply@dev.reddot.com', '', '', '<p>Hello!!! &#1055;&#1088;&#1080;&#1074;&#1077;&#1090;! &#1064;&#1072;&#1083;&#1086;&#1084;!</p>', '', '--\r\nIf you do not want to receive any more newsletters,  [UNSUBSCRIBE]\r\n\r\nTo update your preferences and to unsubscribe visit [PREFERENCES]\r\nForward a Message to Someone [FORWARD]', '2012-10-02 20:28:41', '2012-10-02 20:29:32', '2012-10-02 20:28:00', 0, '2012-10-02 20:28:41', 'draft', NULL, NULL, 1, 'HTML', 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, '', 1),
(3, 'Test', 'Webmaster noreply@dev.reddot.com', '', '', '<p>Hello!!!</p>', '', '--\r\nIf you do not want to receive any more newsletters,  [UNSUBSCRIBE]\r\n\r\nTo update your preferences and to unsubscribe visit [PREFERENCES]\r\nForward a Message to Someone [FORWARD]', '2012-10-02 20:34:34', '2012-10-02 20:45:08', '2012-10-02 20:34:00', 0, '2012-10-02 20:34:34', 'suspended', NULL, '2012-10-02 20:39:04', 1, 'HTML', 0, 1, 2, 1, 0, 0, 0, 0, 0, '2012-10-02 20:45:06', '', 1),
(4, '(no subject)', '', '', '', NULL, NULL, NULL, '2012-10-02 20:40:47', '2012-10-02 20:40:47', '2012-10-02 20:40:47', 0, '2012-10-02 20:40:47', 'draft', NULL, NULL, 0, 'HTML', 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, 1),
(5, 'Test', 'Webmaster noreply@dev.reddot.com', '', '', '<p>saasdf asa dsad sa asd sa d</p>', '', '--\r\nIf you do not want to receive any more newsletters,  [UNSUBSCRIBE]\r\n\r\nTo update your preferences and to unsubscribe visit [PREFERENCES]\r\nForward a Message to Someone [FORWARD]', '2012-10-02 20:51:44', '2012-10-02 20:53:47', '2012-10-02 20:51:00', 0, '2012-10-02 20:51:44', 'draft', NULL, NULL, 1, 'HTML', 1, 0, 1, 1, 0, 0, 0, 0, 0, NULL, '', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `phplist_messagedata`
--

CREATE TABLE IF NOT EXISTS `phplist_messagedata` (
  `name` varchar(100) NOT NULL,
  `id` int(11) NOT NULL,
  `data` text,
  PRIMARY KEY (`name`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `phplist_messagedata`
--

INSERT INTO `phplist_messagedata` (`name`, `id`, `data`) VALUES
('to process', 3, '0'),
('ETA', 3, 'Tue 2 Oct 20:39'),
('msg/hr', 3, '59.430190269221');

-- --------------------------------------------------------

--
-- Структура таблицы `phplist_message_attachment`
--

CREATE TABLE IF NOT EXISTS `phplist_message_attachment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `messageid` int(11) NOT NULL,
  `attachmentid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `messageidx` (`messageid`),
  KEY `messageattidx` (`messageid`,`attachmentid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `phplist_message_attachment`
--


-- --------------------------------------------------------

--
-- Структура таблицы `phplist_rssitem`
--

CREATE TABLE IF NOT EXISTS `phplist_rssitem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `link` varchar(100) NOT NULL,
  `source` varchar(255) DEFAULT NULL,
  `list` int(11) NOT NULL,
  `added` datetime DEFAULT NULL,
  `processed` mediumint(8) unsigned DEFAULT '0',
  `astext` int(11) DEFAULT '0',
  `ashtml` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `titlelinkidx` (`title`,`link`),
  KEY `titleidx` (`title`),
  KEY `listidx` (`list`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `phplist_rssitem`
--


-- --------------------------------------------------------

--
-- Структура таблицы `phplist_rssitem_data`
--

CREATE TABLE IF NOT EXISTS `phplist_rssitem_data` (
  `itemid` int(11) NOT NULL,
  `tag` varchar(100) NOT NULL,
  `data` text,
  PRIMARY KEY (`itemid`,`tag`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `phplist_rssitem_data`
--


-- --------------------------------------------------------

--
-- Структура таблицы `phplist_rssitem_user`
--

CREATE TABLE IF NOT EXISTS `phplist_rssitem_user` (
  `itemid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `entered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`itemid`,`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `phplist_rssitem_user`
--


-- --------------------------------------------------------

--
-- Структура таблицы `phplist_sendprocess`
--

CREATE TABLE IF NOT EXISTS `phplist_sendprocess` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `started` datetime DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `alive` int(11) DEFAULT '1',
  `ipaddress` varchar(50) DEFAULT NULL,
  `page` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `phplist_sendprocess`
--


-- --------------------------------------------------------

--
-- Структура таблицы `phplist_subscribepage`
--

CREATE TABLE IF NOT EXISTS `phplist_subscribepage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `active` tinyint(4) DEFAULT '0',
  `owner` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `phplist_subscribepage`
--


-- --------------------------------------------------------

--
-- Структура таблицы `phplist_subscribepage_data`
--

CREATE TABLE IF NOT EXISTS `phplist_subscribepage_data` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `data` text,
  PRIMARY KEY (`id`,`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `phplist_subscribepage_data`
--


-- --------------------------------------------------------

--
-- Структура таблицы `phplist_task`
--

CREATE TABLE IF NOT EXISTS `phplist_task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page` varchar(25) NOT NULL,
  `type` varchar(25) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `page` (`page`),
  KEY `pageidx` (`page`),
  KEY `pagetypeidx` (`page`,`type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

--
-- Дамп данных таблицы `phplist_task`
--

INSERT INTO `phplist_task` (`id`, `page`, `type`) VALUES
(1, 'adminattributes', 'system'),
(2, 'attributes', 'system'),
(3, 'upgrade', 'system'),
(4, 'configure', 'system'),
(5, 'spage', 'system'),
(6, 'spageedit', 'system'),
(7, 'defaultconfig', 'system'),
(8, 'defaults', 'system'),
(9, 'initialise', 'system'),
(10, 'bounces', 'system'),
(11, 'bounce', 'system'),
(12, 'processbounces', 'system'),
(13, 'eventlog', 'system'),
(14, 'reconcileusers', 'system'),
(15, 'getrss', 'system'),
(16, 'viewrss', 'system'),
(17, 'purgerss', 'system'),
(18, 'setup', 'system'),
(19, 'dbcheck', 'system'),
(20, 'list', 'list'),
(21, 'editlist', 'list'),
(22, 'members', 'list'),
(23, 'user', 'user'),
(24, 'users', 'user'),
(25, 'dlusers', 'user'),
(26, 'editattributes', 'user'),
(27, 'usercheck', 'user'),
(28, 'import1', 'user'),
(29, 'import2', 'user'),
(30, 'import3', 'user'),
(31, 'import4', 'user'),
(32, 'import', 'user'),
(33, 'export', 'user'),
(34, 'massunconfirm', 'user'),
(35, 'message', 'message'),
(36, 'messages', 'message'),
(37, 'processqueue', 'message'),
(38, 'send', 'message'),
(39, 'preparesend', 'message'),
(40, 'sendprepared', 'message'),
(41, 'template', 'message'),
(42, 'templates', 'message'),
(43, 'statsmgt', 'clickstats'),
(44, 'mclicks', 'clickstats'),
(45, 'uclicks', 'clickstats'),
(46, 'userclicks', 'clickstats'),
(47, 'mviews', 'clickstats'),
(48, 'statsoverview', 'clickstats'),
(49, 'admins', 'admin'),
(50, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Структура таблицы `phplist_template`
--

CREATE TABLE IF NOT EXISTS `phplist_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `template` longblob,
  `listorder` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `phplist_template`
--

INSERT INTO `phplist_template` (`id`, `title`, `template`, `listorder`) VALUES
(1, 'Test message subject', 0x3c703e54657374206d65737361676520746578743c2f703e, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `phplist_templateimage`
--

CREATE TABLE IF NOT EXISTS `phplist_templateimage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `template` int(11) NOT NULL DEFAULT '0',
  `mimetype` varchar(100) DEFAULT NULL,
  `filename` varchar(100) DEFAULT NULL,
  `data` longblob,
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `templateidx` (`template`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `phplist_templateimage`
--

INSERT INTO `phplist_templateimage` (`id`, `template`, `mimetype`, `filename`, `data`, `width`, `height`) VALUES
(1, 0, 'image/png', 'powerphplist.png', 0x6956424f5277304b47676f414141414e5355684555674141414559414141416543414d414141436d4c5a6773414141444146424d564558597836666d664758666e6d43636847643356445069706d726f755949484277653371704e6c566b546d635748646d4672665254656f6a57334970586e32354c376d6f335461476865366d584c436d6d2b376c476e6e746e377378355378683175736b33616b6445664269465074794a66676f32626a7157376b726e546a716e4470726f4b3170496e764f44525254454b46656d6e757a614174495258656e46374b714948666e324b4863566a74795a6a6e7148726e6b6e4c6870476a6e743448654d797a6c6e6e487231724c6b6d5733574141446c6c477555666d50634b534d6346784c6e754943556431663033376b714a69447176343773785a4c594151484c744a4c664f5449374b6872496e6e4871775937685455487a327247446256547a3237586b7233584a764b506e6733487579707a6f756f5072776f2f68586b337831717a71774976697a6176727770447530617471595654716e6f4264547a37516c46767174596267535431346357506172333368596b727730715a4b516a6a646d6c3132586b50537635324e6848506f76496a6a72484c5a44517a3033626273785a486371336667516a73554567393259556d55696e6a67704762767a36505a74596a63703354723262574561557a7a334c5878314b68464f693770766f6a79324b333134727a6a76597a6a663245774c43627730715276557a6232354d426f536933676f6d58646d46766c735868424f7a496948787277303669386f487a78317172717749766d6a57743461566146586a6e6f70487a757935373234722f7375704d354d797a656d6c337176347278314b626f7534626d7559546f736f48687961546970576e676f57546d7448766d7333726a72584c6d736e32796630374f6b46663133377a7378356277314b766d73586a6f713333757a7154737870546f756f6a646c31766c5a6c76737770447931367244745a726b624671336a6d486855555868706d72624878726958302f6c736e7269726e663134722f747936425a5069586f7559666c736e6a6d735876696d6d5a6151536a6971477669706d6e68706d6e323437336d736e6a6f7649627478356e656d3133773061524b4e434469705772727735547376593771766f6b4f4441726857556e7177492f69703276656d567a6c706e54727735486a7133447931374469686c2f7853555076626c334e75353367554550665144506870576e6c68326e776933546f6958446f7559587432376e30334c4f316e5833624642486a6c6d626143416e726f485859434166427335665771585873785a626e77497a6a594650727735446477703370765979556144374f6e323752706e6a5870584473774a545770472f67736e336c774a4879344c763033376a69614662646d567a636c316b4441674545417749414141434a4a7a43734141414141574a4c52305141694155645341414141416c7753466c7a4141414c45674141437849423074312b2f414141414164305355314642394d4b46516f6c4377652f39355141414158755355524256486963725a4635584a4a33484d6456486f646d5a68636d4371627a52464e525362477043486b32744634367936795179697570374c444470536c67706f566d486a4e41586933545773304f6a3871743071784a7879686e314c5a676131753274566f75323930496e33312f44376a31393759507a2b2f372b78362f37357676383373736a50394234784d79576868662f6d737867745367307362727377456a4d52676b426f6d6442497a425947646e6b4944737a4c76456c4a57677750425341736c6a45454c434474597878516671306c4b4251504252446d41672b346c424b42516154444c7451736b7276726c4545496d616b43684a41414d516453574247525457312f4e777646636f302b446c67327a6e4d6678645753386b63437173336e6f4d4c4161473754785958772b2b544f6739567538394e6a68594c3653397078616f533957434a2b696c66454138716a507572446d59775a503179737035592b5579486857797549387a376f4e68506f5049594c302b5670435258665535794d61756f715a422f62504b526f4767636374314f6d43735150446e355653656c5257476a5a587a714a6833427072474373316868616168597067564b7073795670676d417a55785a6c2f66676c5435724e4e6f4d6334413861674d4270724757356242347a4634336b534367544f755967774d4177384d647048494f4f4d4d4270574865686930487138746a594252422b6e484c635956437247595231556f464f687578417076544d777256356a75527047684f5468784e39374f6341373869776f786c53635751304450726b54445650476c4e4d4451614f765877364c5261494777694944592f2f614a4b764c455968534b616159546e5433385252315656523156555671453065763163726e2b6b76776132755236666144386b7435616a724c36546e44312b76352b6553637136432f702b2f58366134487951446a5a4c33654e7175796f36756a59666f54536831374b756d396f614d6836434a6b2b61324c7647304c4f5244525237594f444b49334f77365036716e41373071493036644151594f69677556774f68385869734f496530756b5064527769594e366c3938306a697a5a447559394f6e79556133376d52506d4d723341354f4a763036447a596a576d79766f42773648544261726261477938714e4f2f6d306978555871745665304846794d2f3963474d37712b6b34625274596b61416e4e457545375a2f2b3042493963757a494c392f7435567554572f57536358564868455357464b6d4263566170755474654f344f445179617a544431577143354d35334a7268304c7336316d647253475252676b71566f314b70547248484e3674493550307a6e6a2b66627a2f2f7a504c644d6536525274755947462b4b613436724b3243536b704b36574e3344734f6c596d63464a53634d36546b457a524474597232386b6155522b535951414d2b2f4d5874795743467179612b506a44355159393862584a6b7452416a413955696d5464544e59657236396d336c795474763564706a47726131743667725770327351526e705a32765a6847357047476b5975435a76352f48484572535078386474586c65447035374b5655756e6c79314c41744c516f76786835744842507750314a5479666433784d51454d6370434a69365a38556a7a70633938464a2b5371577952616b38785461753750484e777645733277536e41305866784d636a7a444d4b64437462576742446f564361622b6243312b486b6a6e774c686a755a5535413544527a645567724355416a4e424d78766c4f6b6c496731386f4e556865586c46674c454e4d68557067496b414e56737952365a314d626e4d7270487765356d63676e766875557a4c3878455259534b525877516868486b63394e6f47587966507248474e5456356548734a51676b78567743516a4262574842732b315050376d334b6e446f584763754941356f584d6f6b435942427056665377624d3275585a73667933516b4a535066426c49532b4b59694a68476c4d78475442586d7378794f7a337465484254557a744d553966556c4978534a4247625a43704f46786e582f6e34754e65534e46792b4b6250483054596c48664f474476305055726a514235754e745a6a5872574b6472746d3044444c634f5170516e6954547054766232396b3554707250487730495770432b7a575856694e56746a6b2b68316577704d30325275425577316f596271616a63754b374f6d75727064783248574e565154767a414e72696d4a334c577278472b3343462f3939546f63332b3952675a4d395532747656302f5a68532f4a4a6a6f624767415461314a4b374e4c75384a4e754b6246756353787558596f7036565152435244416548366556624a7530344a6c575242376550376f667a76326c6d39575a4d495052474e734c4742477a55714c6167397769306f627662453433504b5830625452305a5355305130506e4234386348643374374859394c323778522f4678616b6e46746859654c6e6b7036536c76623362337466556d66492b594b4b6a382f4f6a7a59617754786266414876553063572f7472447954754b6866513444447355446f4f4a69423466695241472f4e5272712b6559323467474d4936476a61434535746a71322b76767a76516f4669776745614d426859414474446d566e457975392b4843474f50685059797467584d7a7968325a2b626131586f627279384a334576454e6e7938724b4846355632623745773456386c31666b622b357a41637a2f6f72384167336f7a5a465a5833473041414141415355564f524b35435949493d, 70, 30),
(2, 1, 'image/png', 'powerphplist.png', 0x6956424f5277304b47676f414141414e5355684555674141414559414141416543414d414141436d4c5a6773414141444146424d564558597836666d664758666e6d43636847643356445069706d726f755949484277653371704e6c566b546d635748646d4672665254656f6a57334970586e32354c376d6f335461476865366d584c436d6d2b376c476e6e746e377378355378683175736b33616b6445664269465074794a66676f32626a7157376b726e546a716e4470726f4b3170496e764f44525254454b46656d6e757a614174495258656e46374b714948666e324b4863566a74795a6a6e7148726e6b6e4c6870476a6e743448654d797a6c6e6e487231724c6b6d5733574141446c6c477555666d50634b534d6346784c6e754943556431663033376b714a69447176343773785a4c594151484c744a4c664f5449374b6872496e6e4871775937685455487a327247446256547a3237586b7233584a764b506e6733487579707a6f756f5072776f2f68586b337831717a71774976697a6176727770447530617471595654716e6f4264547a37516c46767174596267535431346357506172333368596b727730715a4b516a6a646d6c3132586b50537635324e6848506f76496a6a72484c5a44517a3033626273785a486371336667516a73554567393259556d55696e6a67704762767a36505a74596a63703354723262574561557a7a334c5878314b68464f693770766f6a79324b333134727a6a76597a6a663245774c43627730715276557a6232354d426f536933676f6d58646d46766c735868424f7a496948787277303669386f487a78317172717749766d6a57743461566146586a6e6f70487a757935373234722f7375704d354d797a656d6c337176347278314b626f7534626d7559546f736f48687961546970576e676f57546d7448766d7333726a72584c6d736e32796630374f6b46663133377a7378356277314b766d73586a6f713333757a7154737870546f756f6a646c31766c5a6c76737770447931367244745a726b624671336a6d486855555868706d72624878726958302f6c736e7269726e663134722f747936425a5069586f7559666c736e6a6d735876696d6d5a6151536a6971477669706d6e68706d6e323437336d736e6a6f7649627478356e656d3133773061524b4e434469705772727735547376593771766f6b4f4441726857556e7177492f69703276656d567a6c706e54727735486a7133447931374469686c2f7853555076626c334e75353367554550665144506870576e6c68326e776933546f6958446f7559587432376e30334c4f316e5833624642486a6c6d626143416e726f485859434166427335665771585873785a626e77497a6a594650727735446477703370765979556144374f6e323752706e6a5870584473774a545770472f67736e336c774a4879344c763033376a69614662646d567a636c316b4441674545417749414141434a4a7a43734141414141574a4c52305141694155645341414141416c7753466c7a4141414c45674141437849423074312b2f414141414164305355314642394d4b46516f6c4377652f39355141414158755355524256486963725a4635584a4a33484d6456486f646d5a68636d4371627a52464e525362477043486b32744634367936795179697570374c444470536c67706f566d486a4e41586933545773304f6a3871743071784a7879686e314c5a676131753274566f75323930496e33312f44376a31393759507a2b2f372b78362f37357676383373736a50394234784d79576868662f6d737867745367307362727377456a4d52676b426f6d6442497a425947646e6b4944737a4c76456c4a57677750425341736c6a45454c434474597878516671306c4b4251504252446d41672b346c424b42516154444c7451736b7276726c4545496d616b43684a41414d516453574247525457312f4e777646636f302b446c67327a6e4d6678645753386b63437173336e6f4d4c4161473754785958772b2b544f6739567538394e6a68594c3653397078616f533957434a2b696c66454138716a507572446d59775a503179737035592b5579486857797549387a376f4e68506f5049594c302b5670435258665535794d61756f715a422f62504b526f4767636374314f6d43735150446e355653656c5257476a5a587a714a6833427072474373316868616168597067564b7073795670676d417a55785a6c2f66676c5435724e4e6f4d6334413861674d4270724757356242347a4634336b534367544f755967774d4177384d647048494f4f4d4d4270574865686930487138746a594252422b6e484c635956437247595231556f464f687578417076544d777256356a75527047684f5468784e39374f6341373869776f786c53635751304450726b54445650476c4e4d4451614f765877364c5261494777694944592f2f614a4b764c455968534b616159546e5433385252315656523156555671453065763163726e2b6b76776132755236666144386b7435616a724c36546e44312b76352b6553637136432f702b2f58366134487951446a5a4c33654e7175796f36756a59666f54536831374b756d396f614d6836434a6b2b61324c7647304c4f5244525237594f444b49334f77365036716e41373071493036644151594f69677556774f68385869734f496530756b5064527769594e366c3938306a697a5a447559394f6e79556133376d52506d4d723341354f4a763036447a596a576d79766f42773648544261726261477938714e4f2f6d306978555871745665304846794d2f3963474d37712b6b34625274596b61416e4e457545375a2f2b3042493963757a494c392f7435567554572f57536358564868455357464b6d4263566170755474654f344f445179617a544431577143354d35334a7268304c7336316d647253475252676b71566f314b70547248484e3674493550307a6e6a2b66627a2f2f7a504c644d6536525274755947462b4b613436724b3243536b704b36574e3344734f6c596d63464a53634d36546b457a524474597232386b6155522b535951414d2b2f4d5874795743467179612b506a44355159393862584a6b7452416a413955696d5464544e59657236396d336c795474763564706a47726131743667725770327351526e705a32765a6847357047476b5975435a76352f48484572535078386474586c65447035374b5655756e6c79314c41744c516f76786835744842507750314a5479666433784d51454d6370434a69365a38556a7a70633938464a2b5371577952616b38785461753750484e777645733277536e41305866784d636a7a444d4b64437462576742446f564361622b6243312b486b6a6e774c686a755a5535413544527a645567724355416a4e424d78766c4f6b6c496731386f4e556865586c46674c454e4d68557067496b414e56737952365a314d626e4d7270487765356d63676e766875557a4c3878455259534b525877516868486b63394e6f47587966507248474e5456356548734a51676b78567743516a4262574842732b315050376d334b6e446f584763754941356f584d6f6b435942427056665377624d3275585a73667933516b4a535066426c49532b4b59694a68476c4d78475442586d7378794f7a337465484254557a744d553966556c4978534a4247625a43704f46786e582f6e34754e65534e46792b4b6250483054596c48664f474476305055726a514235754e745a6a5872574b6472746d3044444c634f5170516e6954547054766232396b3554707250487730495770432b7a575856694e56746a6b2b68316577704d30325275425577316f596271616a63754b374f6d75727064783248574e565154767a414e72696d4a334c577278472b3343462f3939546f63332b3952675a4d395532747656302f5a68532f4a4a6a6f624767415461314a4b374e4c75384a4e754b6246756353787558596f7036565152435244416548366556624a7530344a6c575242376550376f667a76326c6d39575a4d495052474e734c4742477a55714c6167397769306f627662453433504b5830625452305a5355305130506e4234386348643374374859394c323778522f4678616b6e46746859654c6e6b7036536c76623362337466556d66492b594b4b6a382f4f6a7a59617754786266414876553063572f7472447954754b6866513444447355446f4f4a69423466695241472f4e5272712b6559323467474d4936476a61434535746a71322b76767a76516f4669776745614d426859414474446d566e457975392b4843474f50685059797467584d7a7968325a2b626131586f627279384a334576454e6e7938724b4846355632623745773456386c31666b622b357a41637a2f6f72384167336f7a5a465a5833473041414141415355564f524b35435949493d, 70, 30);

-- --------------------------------------------------------

--
-- Структура таблицы `phplist_urlcache`
--

CREATE TABLE IF NOT EXISTS `phplist_urlcache` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `lastmodified` int(11) DEFAULT NULL,
  `added` datetime DEFAULT NULL,
  `content` mediumtext,
  PRIMARY KEY (`id`),
  KEY `urlindex` (`url`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `phplist_urlcache`
--


-- --------------------------------------------------------

--
-- Структура таблицы `phplist_usermessage`
--

CREATE TABLE IF NOT EXISTS `phplist_usermessage` (
  `messageid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `entered` datetime NOT NULL,
  `viewed` datetime DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`userid`,`messageid`),
  KEY `messageidindex` (`messageid`),
  KEY `useridindex` (`userid`),
  KEY `enteredindex` (`entered`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `phplist_usermessage`
--

INSERT INTO `phplist_usermessage` (`messageid`, `userid`, `entered`, `viewed`, `status`) VALUES
(3, 1, '2012-10-02 20:39:04', NULL, 'sent');

-- --------------------------------------------------------

--
-- Структура таблицы `phplist_userstats`
--

CREATE TABLE IF NOT EXISTS `phplist_userstats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unixdate` int(11) DEFAULT NULL,
  `item` varchar(255) DEFAULT NULL,
  `listid` int(11) DEFAULT '0',
  `value` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `entry` (`unixdate`,`item`,`listid`),
  KEY `dateindex` (`unixdate`),
  KEY `itemindex` (`item`),
  KEY `listindex` (`listid`),
  KEY `listdateindex` (`listid`,`unixdate`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `phplist_userstats`
--


-- --------------------------------------------------------

--
-- Структура таблицы `phplist_user_attribute`
--

CREATE TABLE IF NOT EXISTS `phplist_user_attribute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` varchar(30) DEFAULT NULL,
  `listorder` int(11) DEFAULT NULL,
  `default_value` varchar(255) DEFAULT NULL,
  `required` tinyint(4) DEFAULT NULL,
  `tablename` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nameindex` (`name`),
  KEY `idnameindex` (`id`,`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `phplist_user_attribute`
--


-- --------------------------------------------------------

--
-- Структура таблицы `phplist_user_blacklist`
--

CREATE TABLE IF NOT EXISTS `phplist_user_blacklist` (
  `email` varchar(100) NOT NULL,
  `added` datetime DEFAULT NULL,
  UNIQUE KEY `email` (`email`),
  KEY `emailidx` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `phplist_user_blacklist`
--


-- --------------------------------------------------------

--
-- Структура таблицы `phplist_user_blacklist_data`
--

CREATE TABLE IF NOT EXISTS `phplist_user_blacklist_data` (
  `email` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `data` text,
  UNIQUE KEY `email` (`email`),
  KEY `emailidx` (`email`),
  KEY `emailnameidx` (`email`,`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `phplist_user_blacklist_data`
--


-- --------------------------------------------------------

--
-- Структура таблицы `phplist_user_message_bounce`
--

CREATE TABLE IF NOT EXISTS `phplist_user_message_bounce` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `message` int(11) NOT NULL,
  `bounce` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `umbindex` (`user`,`message`,`bounce`),
  KEY `useridx` (`user`),
  KEY `msgidx` (`message`),
  KEY `bounceidx` (`bounce`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `phplist_user_message_bounce`
--


-- --------------------------------------------------------

--
-- Структура таблицы `phplist_user_message_forward`
--

CREATE TABLE IF NOT EXISTS `phplist_user_message_forward` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `message` int(11) NOT NULL,
  `forward` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `usermessageidx` (`user`,`message`),
  KEY `useridx` (`user`),
  KEY `messageidx` (`message`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `phplist_user_message_forward`
--


-- --------------------------------------------------------

--
-- Структура таблицы `phplist_user_rss`
--

CREATE TABLE IF NOT EXISTS `phplist_user_rss` (
  `userid` int(11) NOT NULL,
  `last` datetime DEFAULT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `phplist_user_rss`
--


-- --------------------------------------------------------

--
-- Структура таблицы `phplist_user_user`
--

CREATE TABLE IF NOT EXISTS `phplist_user_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `confirmed` tinyint(4) DEFAULT '0',
  `blacklisted` tinyint(4) DEFAULT '0',
  `bouncecount` int(11) DEFAULT '0',
  `entered` datetime DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `uniqid` varchar(255) DEFAULT NULL,
  `htmlemail` tinyint(4) DEFAULT '0',
  `subscribepage` int(11) DEFAULT NULL,
  `rssfrequency` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `passwordchanged` date DEFAULT NULL,
  `disabled` tinyint(4) DEFAULT '0',
  `extradata` text,
  `foreignkey` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `foreignkey` (`foreignkey`),
  KEY `idx_phplist_user_user_uniqid` (`uniqid`),
  KEY `emailidx` (`email`),
  KEY `enteredindex` (`entered`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `phplist_user_user`
--

INSERT INTO `phplist_user_user` (`id`, `email`, `confirmed`, `blacklisted`, `bouncecount`, `entered`, `modified`, `uniqid`, `htmlemail`, `subscribepage`, `rssfrequency`, `password`, `passwordchanged`, `disabled`, `extradata`, `foreignkey`) VALUES
(1, 'turcaigor@gmail.com', 1, 0, 0, '2012-10-02 20:33:39', '2012-10-02 20:33:39', '8fdd50a7191c86c468eccc11e19fb243', 0, NULL, '', '', '2012-10-02', 0, '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `phplist_user_user_attribute`
--

CREATE TABLE IF NOT EXISTS `phplist_user_user_attribute` (
  `attributeid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `value` text,
  PRIMARY KEY (`attributeid`,`userid`),
  KEY `userindex` (`userid`),
  KEY `attindex` (`attributeid`),
  KEY `userattid` (`attributeid`,`userid`),
  KEY `attuserid` (`userid`,`attributeid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `phplist_user_user_attribute`
--


-- --------------------------------------------------------

--
-- Структура таблицы `phplist_user_user_history`
--

CREATE TABLE IF NOT EXISTS `phplist_user_user_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `summary` varchar(255) DEFAULT NULL,
  `detail` text,
  `systeminfo` text,
  PRIMARY KEY (`id`),
  KEY `userididx` (`userid`),
  KEY `dateidx` (`date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `phplist_user_user_history`
--


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
  `ntf_3` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Смотреть в CMailer(Типы уведомлений)',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `purchase`
--


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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `towns`
--

INSERT INTO `towns` (`id_towns`, `name_towns`, `description`, `email`) VALUES
(1, 'Другой город', 'фывфыв', NULL),
(2, 'Краснодар', 'г. Краснодар, тел. +7 (985) 319-05-09', NULL);

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
  `ntf_1` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Смотреть в CMailer(Типы уведомлений)',
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `superuser` (`superuser`),
  KEY `id_towns_user` (`id_towns_user`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `soc_uid`, `soc_network`, `first_name`, `last_name`, `company_name`, `working_time`, `phone`, `website`, `active`, `activationKey`, `createtime`, `lastvisit`, `lastaction`, `lastpasswordchange`, `superuser`, `status`, `avatar`, `notifyType`, `id_towns_user`, `address`, `role`, `balance`, `bonus`, `ntf_1`) VALUES
(1, 'Tsurka', 'turcaigor@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, '', '', '', '', '', '', 'Y', '93b6deed95aca08ab22dae75e28592b1', 1347817076, 0, 0, 0, 1, 0, NULL, 'Instant', 1, '[]', 'administrator', 998233, 1000000, 0),
(2, 'Большая Организация', 'bigorganizatoin@mail.ru', '550e1bafe077ff0b0b67f4e32f29d751', NULL, NULL, '', '', 'Большая Организация', '2434 24234', '0123456789,0123456789,012', 'dsadsddd.dd', 'Y', '', 1348782327, 0, 0, 0, 0, 0, '', 'Instant', NULL, '[{"address":"\\u0433. \\u041c\\u043e\\u0441\\u043a\\u0432\\u0430, \\u0443\\u043b. \\u041b\\u0435\\u043d\\u0438\\u043d\\u0430, \\u0434. 22"},{"address":"\\u0433. \\u041c\\u043e\\u0441\\u043a\\u0432\\u0430, \\u0443\\u043b. \\u041b\\u0435\\u043d\\u0438\\u043d\\u0430, \\u0434. 22"}]', 'organisation', 0, 0, 1);
