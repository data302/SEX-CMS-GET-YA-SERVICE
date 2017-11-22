-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Ноя 22 2017 г., 16:23
-- Версия сервера: 5.5.56
-- Версия PHP: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `admin_sexcms`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cat`
--

CREATE TABLE `cat` (
  `id` int(11) NOT NULL,
  `title` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `get-ya`
--

CREATE TABLE `get-ya` (
  `id` int(11) NOT NULL,
  `title` varchar(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `get-ya`
--

INSERT INTO `get-ya` (`id`, `title`) VALUES
(1, 'MEDIAFIRE'),
(2, 'ЯНДЕКС.ДИСК'),
(3, 'GOOGLE DRIVE');

-- --------------------------------------------------------

--
-- Структура таблицы `system`
--

CREATE TABLE `system` (
  `id` int(11) NOT NULL,
  `keywords` text NOT NULL,
  `description` text NOT NULL,
  `copy` text NOT NULL,
  `ads_foot` text NOT NULL,
  `ads_head` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `system`
--

INSERT INTO `system` (`id`, `keywords`, `description`, `copy`, `ads_foot`, `ads_head`) VALUES
(1, 'Ключевые слова', 'Описание сайта', 'SEX-CMS', '[url=http://get-ya.mxis.ru/]GET-YA сервис[/url]\r\n[url=http://mxis.ru/]Хостинг по низким ценм[/url]\r\n', '[url=http://mxis.ru/]Хостинг по низким ценм[/url]\r\n');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(5) NOT NULL,
  `login` varchar(12) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `pass` varchar(32) DEFAULT NULL,
  `level` int(1) NOT NULL,
  `regtime` int(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `email`, `pass`, `level`, `regtime`) VALUES
(1, 'admin', 'admin@mxis.ru', 'c3284d0f94606de1fd2af172aba15bf3', 1, 1511060177);

-- --------------------------------------------------------

--
-- Структура таблицы `video`
--

CREATE TABLE `video` (
  `id` int(11) NOT NULL,
  `id_cat` int(11) NOT NULL,
  `title` text NOT NULL,
  `src` text NOT NULL,
  `strana` text NOT NULL,
  `act` text NOT NULL,
  `get-ya` text NOT NULL,
  `dlina` text NOT NULL,
  `url` text NOT NULL,
  `note` text NOT NULL,
  `look` int(11) NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cat`
--
ALTER TABLE `cat`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `get-ya`
--
ALTER TABLE `get-ya`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `system`
--
ALTER TABLE `system`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cat`
--
ALTER TABLE `cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `get-ya`
--
ALTER TABLE `get-ya`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT для таблицы `system`
--
ALTER TABLE `system`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `video`
--
ALTER TABLE `video`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
