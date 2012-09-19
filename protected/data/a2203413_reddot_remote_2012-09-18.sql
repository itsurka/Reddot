
-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 18, 2012 at 02:29 PM
-- Server version: 5.1.57
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `a2203413_reddot`
--

-- --------------------------------------------------------

--
-- Table structure for table `act`
--

CREATE TABLE `act` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `act`
--

INSERT INTO `act` VALUES(3, 0, 'тестфыв', 'qweqwe', '', '', '', '', 'f2399034f3fcf10ccebd435920a30450', 'qweqweqwe', '<p>qwe</p>', '<p>qwe</p>', 2, 1, 1, NULL, 0, 999, 'Какая-то замануха...', 10, 10, 0, 0, '2012-08-01 00:00:00', '2012-09-29 00:00:00', '2012-09-30 00:00:00');
INSERT INTO `act` VALUES(4, 0, 'Вторая акция', 'second', '', '', '', '', 'f2399034f3fcf10ccebd435920a30450', 'qq', '<p>qqwe</p>', '<p>asd</p>', 3, 1, 7, NULL, 0, 0, '<p><br></p>', 20, 9, 0, 0, '2012-08-01 00:00:00', '2012-08-30 00:00:00', '2012-08-31 00:00:00');
INSERT INTO `act` VALUES(5, 0, 'Ещё одна тестовая акция...', 'testtest', '', '', '', '', 'e18642d45c4ca9c321bd9a00ad42ac24', 'Это краткое описание тестовой акции', '<p>Здесь будет полное описание тестовой акции. Много текста...&nbsp;Здесь будет полное описание тестовой акции. Много текста...&nbsp;Здесь будет полное описание тестовой акции. Много текста...&nbsp;Здесь будет полное описание тестовой акции. Много текста...&nbsp;Здесь будет полное описание тестовой акции. Много текста...&nbsp;Здесь будет полное описание тестовой акции. Много текста...&nbsp;Здесь будет полное описание тестовой акции. Много текста...&nbsp;</p>', '<p>Условия акции..&nbsp;Условия акции..&nbsp;Условия акции.. акции&nbsp;Условия акции..&nbsp;Условия акции..&nbsp;Условия акции.. акции усовияУсловия акции..&nbsp;Условия акции..&nbsp;Условия акции.. акции&nbsp;Условия акции..&nbsp;Условия акции..&nbsp;Условия акции.. акции усовияУсловия акции..&nbsp;Условия акции..&nbsp;Условия акции.. акции&nbsp;Условия акции..&nbsp;Условия акции..&nbsp;Условия акции.. акции усовияУсловия акции..&nbsp;Условия акции..&nbsp;Условия акции.. акции&nbsp;Условия акции..&nbsp;Условия акции..&nbsp;Условия акции.. акции усовия</p>', 3, 1, 1, NULL, 0, 999, '<p>Привет, я самая заебатая акция. Купи меня!</p>', 150, 2, 0, 0, '2012-08-01 00:00:00', '2012-08-31 00:00:00', '2012-08-31 00:00:00');
INSERT INTO `act` VALUES(6, 0, 'В «Алексеевские бани» со скидкой 30%!', 'alexeevskie_bani_akciya_30_prcnt', 'Акция: В «Алексеевские бани» со скидкой 30%!', '', 'Алексеевские бани со скидкой 30%! Спешите купить скидку!', '', '5204457d2aee9590cabf53f054c14e14', 'Путешествие, в котором вы с головой окунётесь в мир\r\nздоровья, отдыха и веселья!', '<p>"Алексеевские бани" приглашают Вас в путешествие, в котором вы не встретите&nbsp;привычные туристические достопримечательности, но с головой окунётесь в мир&nbsp;здоровья, отдыха и веселья!</p>\r\n\r\n<p>Кому-то банька по плечу, а кому-то сон по нраву! Романтические номера&nbsp;"Алексеевских бань" - это райский уголок для утомившихся гостей!</p>\r\n\r\n<p>Алексеевские бани - это самый крупный комплекс бань в Краснодаре. Уровень&nbsp;сервиса порадует самых взыскательных любителей отдыха в бане.</p>\r\n\r\n<p>Мало кто знает, что на крыше "Алексеевских бань" только для клиентов, которые&nbsp;арендовали какой-либо из залов комплекса, открыто оборудованное футбольное&nbsp;поле! Вы всё ещё не знаете, как всё это совместить - легко! Чередуйте активный&nbsp;отдых с расслабляющим! А чтобы переход был более плавным, к вашим услугам&nbsp;лифт.</p>\r\n\r\n<p>Для клиентов "Алексеевских бань" КРУГЛОСУТОЧНО работает собственный ресторан.&nbsp;Шеф-повар готов поразить кулинарными изысками самого искушённого гурмана. Вы&nbsp;можете отведать бесподобные блюда как в самом ресторане, так и заказать в&nbsp;любой из банных залов.</p>\r\n\r\n<p>Парильщики-массажисты Русская банька без веничного массажа - это не дело!&nbsp;Поэтому, к Вашим услугам настоящие мастера своего дела!</p>\r\n\r\n<p>Цена и&nbsp;продолжительность оговариваются индивидуально.</p>\r\n<h2>Особенности</h2>\r\n\r\n<ul>\r\n	<li>«Алексеевские бани» - лучшие бани в городе<br>\r\n<br>\r\n</li>\r\n	<li>Удобное место расположения<br>\r\n<br>\r\n</li>\r\n	<li>Приветливый персонал<br>\r\n<br>\r\n</li>\r\n	<li>Каждая сауна выполнена в оригинальном стиле и отличается эксклюзивным&nbsp;дизайном<br>\r\n<br>\r\n</li>\r\n	<li>Караоке<br>\r\n<br>\r\n</li>\r\n	<li>Бильярд<br>\r\n<br>\r\n</li>\r\n	<li>Изысканная европейская кухня<br>\r\n<br>\r\n</li>\r\n	<li>Услуги массажиста<br>\r\n<br>\r\n</li>\r\n	<li>Фитобар<br>\r\n<br>\r\n</li>\r\n	<li>Для гостей сауны есть открытое футбольное поле на крыше здания «Алексеевских&nbsp;бань», куда Вы сможете подняться на специальном лифте<br>\r\n<br>\r\n</li>\r\n	<li>Сделайте Ваш отдых незабываемым вместе с «Алексеевскими банями»!<br>\r\n</li>\r\n</ul>', '678', 13, 22, 2, NULL, 0, 70, '<p><b><span style="background-color: rgb(255, 255, 0);">30%</span> </b>скидка</p>\r\n', 99, 0, 0, 0, '2012-09-14 00:00:07', '2012-09-14 00:00:10', '2012-09-14 00:00:15');

-- --------------------------------------------------------

--
-- Table structure for table `action`
--

CREATE TABLE `action` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `comment` text,
  `subject` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `action`
--


-- --------------------------------------------------------

--
-- Table structure for table `act_tag`
--

CREATE TABLE `act_tag` (
  `id_tag` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id_tag`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `act_tag`
--


-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE `coupon` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `coupon`
--

INSERT INTO `coupon` VALUES(1, 3, 'asdas', '123', '123', '123', 123, NULL, NULL);
INSERT INTO `coupon` VALUES(2, 4, 'первый купон', '1111', '2222', '1111', 50, NULL, NULL);
INSERT INTO `coupon` VALUES(5, 5, 'Название тестового купона', '999', '1998', '999', 50, NULL, NULL);
INSERT INTO `coupon` VALUES(4, 4, 'третий купон', '2222', '4444', '2222', 50, NULL, NULL);
INSERT INTO `coupon` VALUES(6, 6, 'В «Алексеевские бани» со скидкой 30%!', '70', '', '', 30, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `id_fav` int(11) NOT NULL AUTO_INCREMENT,
  `id_user_fav` int(11) NOT NULL,
  `id_act_fav` int(11) NOT NULL,
  PRIMARY KEY (`id_fav`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `favorites`
--


-- --------------------------------------------------------

--
-- Table structure for table `mailing`
--

CREATE TABLE `mailing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `type` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `town_id` int(11) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `modified` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `mailing`
--

INSERT INTO `mailing` VALUES(1, 'Тестовая рассылка', '<p>Тест письма для тестовой рассылки...</p>', 1, 'user', 1, 1344655536, 1344655536);

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE `newsletter` (
  `id_user` int(11) NOT NULL,
  `email_user` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `newsletter`
--

INSERT INTO `newsletter` VALUES(1, 'ru.crtv@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `operation`
--

CREATE TABLE `operation` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `operation`
--

INSERT INTO `operation` VALUES(1, 'Пополнение баланса', 'Пополнение баланса для приобретения товаров', 1, 999, 1, 3, NULL, NULL, '{"5":{"id":"5","quantity":1}}', 1345395691, 1345395691);

-- --------------------------------------------------------

--
-- Table structure for table `option`
--

CREATE TABLE `option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL COMMENT 'алиас опции',
  `title` varchar(255) NOT NULL COMMENT 'человекочитаемое название опции',
  `default_value` varchar(255) NOT NULL COMMENT 'стандартное значение',
  `type` enum('global','local') NOT NULL DEFAULT 'global' COMMENT 'тип опции',
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `option`
--

INSERT INTO `option` VALUES(1, 'test234', 'Арарарара', 'tset', 'global');
INSERT INTO `option` VALUES(2, '???????? ????2', 'test2', 'tset111', 'global');
INSERT INTO `option` VALUES(3, 'test1111', 'Тест1111', 'тест', 'global');
INSERT INTO `option` VALUES(5, 'onemoretime', 'We gonna celebrate', 'daft', 'global');
INSERT INTO `option` VALUES(6, 'localvar1', 'Local variable 1', '1111222', 'local');
INSERT INTO `option` VALUES(7, 'localvar2', 'Local variable 2', 'some val', 'local');
INSERT INTO `option` VALUES(8, 'localvar3', 'Local variable 3', 'мимммм4', 'local');
INSERT INTO `option` VALUES(9, 'localvar3', 'Local variable 4', '8457398579835798345', 'local');
INSERT INTO `option` VALUES(10, 'rss_feed_name', 'Название RSS фида', 'Список последних акций', 'global');
INSERT INTO `option` VALUES(11, 'rss_feed_desc', 'Описание для RSS фида', 'Тестовое описание RSS фида', 'global');
INSERT INTO `option` VALUES(12, 'rss_feed_img', 'Картина для RSS фида', '/images/logo.png', 'global');
INSERT INTO `option` VALUES(13, 'rss_feed_img_desc', 'Описание для картинки RSS фида', 'Описание для картинки', 'global');
INSERT INTO `option` VALUES(14, 'filter', 'Фильтры акций', 'filter', 'global');

-- --------------------------------------------------------

--
-- Table structure for table `option_value`
--

CREATE TABLE `option_value` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option_id` int(11) NOT NULL,
  `towns_id` int(11) NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `option_id` (`option_id`),
  KEY `towns_id` (`towns_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `option_value`
--

INSERT INTO `option_value` VALUES(1, 6, 2, 'йцуйцу');

-- --------------------------------------------------------

--
-- Table structure for table `org`
--

CREATE TABLE `org` (
  `id_org` int(11) NOT NULL,
  `name_org` varchar(255) NOT NULL,
  `login_org` varchar(255) NOT NULL,
  `pass_org` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `org`
--


-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
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
-- Dumping data for table `page`
--

INSERT INTO `page` VALUES(1, 'О сервисе', 'about', 'weqweasdqweqweq<p>weASDasdas<br>ASDfqweqwe</p>\r\n', 1, 'О сервисе', 'О сервисе', 'О сервисе', 1344322650, 1344654937);
INSERT INTO `page` VALUES(2, 'Обратная связь', 'feedback', '', 2, 'Обратная связь', 'Обратная связь', 'Обратная связь', 1344322728, 1344322728);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
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
-- Dumping data for table `profile`
--


-- --------------------------------------------------------

--
-- Table structure for table `profile_comment`
--

CREATE TABLE `profile_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `createtime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `profile_comment`
--


-- --------------------------------------------------------

--
-- Table structure for table `profile_field`
--

CREATE TABLE `profile_field` (
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
-- Dumping data for table `profile_field`
--


-- --------------------------------------------------------

--
-- Table structure for table `profile_visit`
--

CREATE TABLE `profile_visit` (
  `visitor_id` int(11) NOT NULL,
  `visited_id` int(11) NOT NULL,
  `timestamp_first_visit` int(11) NOT NULL,
  `timestamp_last_visit` int(11) NOT NULL,
  `num_of_visits` int(11) NOT NULL,
  PRIMARY KEY (`visitor_id`,`visited_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profile_visit`
--


-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `purchase`
--


-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `is_membership_possible` tinyint(1) NOT NULL DEFAULT '0',
  `price` double DEFAULT NULL COMMENT 'Price (when using membership module)',
  `duration` int(11) DEFAULT NULL COMMENT 'How long a membership is valid',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `role`
--


-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start` int(11) NOT NULL,
  `finish` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` VALUES(1, 1346198400, 1346371200);

-- --------------------------------------------------------

--
-- Table structure for table `sale_subscribe`
--

CREATE TABLE `sale_subscribe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `sale_subscribe`
--


-- --------------------------------------------------------

--
-- Table structure for table `test_operations`
--

CREATE TABLE `test_operations` (
  `id` int(10) NOT NULL,
  `type` enum('rbkmoney','qiwi','visa','mastercard') NOT NULL,
  `summ` float NOT NULL,
  `status` enum('paid','notpaid') DEFAULT 'notpaid',
  `date` int(10) NOT NULL,
  KEY `orders` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `test_operations`
--


-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

CREATE TABLE `themes` (
  `id_themes` int(11) NOT NULL AUTO_INCREMENT,
  `name_themes` varchar(255) NOT NULL,
  `l_name_themes` varchar(255) NOT NULL,
  `ico_themes` varchar(255) NOT NULL,
  PRIMARY KEY (`id_themes`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `themes`
--

INSERT INTO `themes` VALUES(1, 'Красота', '', '');
INSERT INTO `themes` VALUES(2, 'Отдых', '', '');
INSERT INTO `themes` VALUES(3, 'Здоровье', '', '');
INSERT INTO `themes` VALUES(4, 'Еда', '', '');
INSERT INTO `themes` VALUES(5, 'Авто', '', '');
INSERT INTO `themes` VALUES(6, 'Товары', '', '');
INSERT INTO `themes` VALUES(7, 'Прочее', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `towns`
--

CREATE TABLE `towns` (
  `id_towns` int(11) NOT NULL AUTO_INCREMENT,
  `name_towns` varchar(255) NOT NULL,
  `description` text COMMENT 'Выводим в футере контактную информацию и тп.',
  PRIMARY KEY (`id_towns`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `towns`
--

INSERT INTO `towns` VALUES(1, 'Москва', 'г. Москва, тел. 8 (909) 355-55-55');
INSERT INTO `towns` VALUES(2, 'Тольятти', 'г. Краснодар, тел. 8 (909) 355-55-55');
INSERT INTO `towns` VALUES(3, 'Белгород', NULL);
INSERT INTO `towns` VALUES(4, 'Курск', NULL);
INSERT INTO `towns` VALUES(5, 'Воронеж', NULL);
INSERT INTO `towns` VALUES(6, 'Самара', NULL);
INSERT INTO `towns` VALUES(7, 'Саратов', NULL);
INSERT INTO `towns` VALUES(8, 'Екатеринбург', NULL);
INSERT INTO `towns` VALUES(9, 'Нижний Новгород', NULL);
INSERT INTO `towns` VALUES(10, 'Владимир', NULL);
INSERT INTO `towns` VALUES(11, 'Брянск', NULL);
INSERT INTO `towns` VALUES(12, 'Смоленск', NULL);
INSERT INTO `towns` VALUES(13, 'Иваново', NULL);
INSERT INTO `towns` VALUES(14, 'Тула', NULL);
INSERT INTO `towns` VALUES(15, 'Калуга', NULL);
INSERT INTO `towns` VALUES(16, 'Магадан', NULL);
INSERT INTO `towns` VALUES(17, 'Пенза', NULL);
INSERT INTO `towns` VALUES(18, 'Казань', 'г. Казань, тел. 8 (909) 355-55-55');
INSERT INTO `towns` VALUES(19, 'Чебоксары', NULL);
INSERT INTO `towns` VALUES(20, 'Ярославль', NULL);
INSERT INTO `towns` VALUES(21, 'Другой город', 'фывфыв');
INSERT INTO `towns` VALUES(22, 'Краснодар', 'г. Краснодар, тел. +7 (985) 319-05-09');

-- --------------------------------------------------------

--
-- Table structure for table `translation`
--

CREATE TABLE `translation` (
  `message` varbinary(255) NOT NULL,
  `translation` varchar(255) NOT NULL,
  `language` varchar(5) NOT NULL,
  `category` varchar(50) NOT NULL,
  PRIMARY KEY (`message`,`language`,`category`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `translation`
--


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
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
-- Dumping data for table `users`
--

INSERT INTO `users` VALUES(1, 'Артем', 'ru.crtv@gmail.com', '', '100002740865398', 'facebook', 'Артем', 'Филатов', '', NULL, NULL, NULL, 'Y', '', 1344281674, 0, 0, 0, 1, 0, NULL, 'Instant', 1, '[]', 'administrator', 0, 200);
INSERT INTO `users` VALUES(2, 'qwe', 'qwe@zxc.ru', 'qweqwe', NULL, NULL, 'Организация 1', 'Организация 1', 'Организация 1', '', '', '', 'Y', '', 1344281958, 0, 0, 1344281958, 0, 0, '', 'Instant', 18, '[{"address":"\\u0433. \\u041a\\u0440\\u0430\\u0441\\u043d\\u043e\\u0434\\u0430\\u0440, \\u0443\\u043b. \\u041e\\u043d\\u0435\\u0436\\u0441\\u043a\\u0430\\u044f, \\u0434. 7"},{"address":"\\u0433. \\u041a\\u0440\\u0430\\u0441\\u043d\\u043e\\u0434\\u0430\\u0440, \\u0443\\u043b. \\u0410\\u044d\\u0440\\u043e\\u0434\\u0440\\u043e\\u043c\\u043d\\u0430\\u044f, \\u0434. 7"}]', 'organisation', 0, 0);
INSERT INTO `users` VALUES(14, 'васькино', 'asdfwe@mail.ru', '122334', NULL, NULL, '', '', '54', '345', '345', '', 'Y', '', 1347627966, 0, 0, 1347627966, 0, 0, '', 'Instant', NULL, '[{"address":"\\u0433. \\u041c\\u043e\\u0441\\u043a\\u0432\\u0430, \\u0443\\u043b. \\u041b\\u0435\\u043d\\u0438\\u043d\\u0430, \\u0434. 15"}]', 'organisation', 0, 0);
INSERT INTO `users` VALUES(3, 'asd', 'asdasd@qqq.ru', 'qweqwe', NULL, NULL, 'Организация 2', 'Организация 2', 'Организация 2', '', '', '', 'Y', '', 1344282121, 0, 0, 1344282121, 0, 0, '', 'Instant', 18, '[{"address":"\\u0433. \\u041c\\u043e\\u0441\\u043a\\u0432\\u0430, \\u0443\\u043b. \\u041e\\u043a\\u0442\\u044f\\u0431\\u0440\\u044c\\u0441\\u043a\\u0430\\u044f, \\u0434. 1"},{"address":"\\u0433. \\u041a\\u0430\\u0437\\u0430\\u043d\\u044c, \\u0443\\u043b. \\u0422\\u044b\\u043d\\u044b\\u0447, \\u0434. 1"}]', 'organisation', 0, 0);
INSERT INTO `users` VALUES(4, 'asdasd', 'zxc@asd.ru', 'qweqwe', NULL, NULL, 'Организация 3', 'Организация 3', 'Организация 3', '', '', '', 'Y', '', 1344282266, 0, 0, 1344282266, 0, 0, '', 'Instant', 18, '[{"address":"\\u0433. \\u041a\\u0430\\u0437\\u0430\\u043d\\u044c, \\u0443\\u043b. \\u041c\\u0443\\u0441\\u0438\\u043d\\u0430, \\u0434. 14"},{"address":"\\u0433. \\u041a\\u0430\\u0437\\u0430\\u043d\\u044c, \\u0443\\u043b. \\u041c\\u0438\\u0440\\u0430, \\u0434. 7"},{"address":"\\u0433. \\u041a\\u0430\\u0437\\u0430\\u043d\\u044c, \\u0443\\u043b. \\u041d\\u043e\\u0432\\u0430\\u044f, \\u0434. 1"}]', 'user', 0, 0);
INSERT INTO `users` VALUES(5, 'qqq', 'xxx@aaa.rry', 'qweqwe', NULL, NULL, 'qwqwe', 'wwq', 'qwwqe', '', '', '', 'Y', '', 1344286458, 0, 0, 1344286458, 0, 0, '', 'Instant', NULL, '[{"address":"\\u0433. \\u041c\\u043e\\u0441\\u043a\\u0432\\u0430, \\u0443\\u043b. \\u041b\\u0435\\u043d\\u0438\\u043d\\u0430, \\u0434. 36"}]', 'organisation', 0, 0);
INSERT INTO `users` VALUES(6, 'Ник', 'dosia03@mail.ru', '', '145905902', 'vkontakte', 'Ник', 'Тесла', '', NULL, NULL, NULL, 'Y', '', 1344412850, 0, 0, 0, 1, 0, NULL, 'Instant', 1, '[]', 'administrator', 7996, 100);
INSERT INTO `users` VALUES(7, 'qweqwe', 'qwesad@asd.rtu', 'qweqwe', NULL, NULL, '', '', '', '', '', '', 'Y', '', 1344848098, 0, 0, 1344848098, 0, 0, '', 'Instant', NULL, '[{"address":"\\u0433. \\u041c\\u043e\\u0441\\u043a\\u0432\\u0430, \\u0443\\u043b. \\u041b\\u0435\\u043d\\u0438\\u043d\\u0430, \\u0434. 23"}]', 'organisation', 0, 0);
INSERT INTO `users` VALUES(8, '', 'ru.crtv@ya.ru', '221c655927b30efdd19dec05ed0ca021', NULL, NULL, '', '', '', NULL, NULL, NULL, 'Y', '', 1345019262, 0, 0, 0, 0, 0, NULL, 'Instant', 1, '[]', 'user', 0, 0);
INSERT INTO `users` VALUES(9, '', 'mailpicker@yandex.ru', '61b28224c347cc0ef54faabd9bd78e84', NULL, NULL, '', '', '', NULL, NULL, NULL, 'Y', '', 1345020807, 0, 0, 0, 0, 0, NULL, 'Instant', 1, '[]', 'user', 0, 0);
INSERT INTO `users` VALUES(10, '', 'ru.crtv@yaaa.ru', 'efe6398127928f1b2e9ef3207fb82663', NULL, NULL, '', '', '', NULL, NULL, NULL, 'Y', '', 1345020859, 0, 0, 0, 0, 0, NULL, 'Instant', 1, '[]', 'user', 0, 0);
INSERT INTO `users` VALUES(11, '', 'dag777@ukr.net', '4fcbff10b8cc9dcd5fb2d3b5d5c186c2', NULL, NULL, '', '', '', NULL, NULL, NULL, 'Y', '', 1345815770, 0, 0, 0, 0, 0, NULL, 'Instant', 1, '[]', 'user', 0, 0);
INSERT INTO `users` VALUES(12, 'Ангелина', 'zxz325@gmail.com', '', '158966191', 'vkontakte', 'Ангелина', 'Костикова', '', NULL, NULL, NULL, 'Y', '', 1346331067, 0, 0, 0, 1, 0, NULL, 'Instant', NULL, '[]', 'administrator', 0, 0);
INSERT INTO `users` VALUES(13, 'Алексеевские бани', 'nastasi193@mail.ru', '123456', NULL, NULL, '', '', 'Алексеевские бани в Краснодаре', '', '+7 (861) 237-37-37', '', 'Y', '', 1347626571, 0, 0, 1347626571, 0, 0, '5204457d2aee9590cabf53f054c14e14', 'Instant', 22, '[{"address":"\\u0433. \\u041a\\u0440\\u0430\\u0441\\u043d\\u043e\\u0434\\u0430\\u0440, \\u0443\\u043b. \\u041e\\u043d\\u0435\\u0436\\u0441\\u043a\\u0430\\u044f, \\u0434. 7"}]', 'organisation', 0, 0);
INSERT INTO `users` VALUES(15, 'Владимир', 'tomminokk@gmail.com', '', '9487691', 'vkontakte', 'Владимир', 'Ливкин', '', NULL, NULL, NULL, 'Y', '', 1347630267, 0, 0, 0, 0, 0, NULL, 'Instant', NULL, '[]', 'user', 0, 0);
INSERT INTO `users` VALUES(16, '', 'turcaigor@gmail.com', '25d55ad283aa400af464c76d713c07ad', NULL, NULL, '', '', '', NULL, NULL, NULL, 'Y', '', 1347817076, 0, 0, 0, 1, 0, NULL, 'Instant', 1, '[]', 'administrator', 0, 0);