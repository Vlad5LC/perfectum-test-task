-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 19 2022 г., 17:14
-- Версия сервера: 10.5.15-MariaDB-10+deb11u1
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `perfectum_test_project`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categr`
--

CREATE TABLE `categr` (
  `id` int(11) NOT NULL,
  `name` varchar(55) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `categr`
--

INSERT INTO `categr` (`id`, `name`) VALUES
(1, 'Список 1'),
(2, 'Термінові покупки'),
(3, 'На Новий Рік'),
(4, 'Щоденні покупки'),
(8, 'На День Перемоги'),
(13, 'Для тварин');

-- --------------------------------------------------------

--
-- Структура таблицы `lists`
--

CREATE TABLE `lists` (
  `id` int(11) NOT NULL,
  `bought` int(11) DEFAULT NULL,
  `creating_date` date DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `buylist` text DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `lists`
--

INSERT INTO `lists` (`id`, `bought`, `creating_date`, `category_id`, `buylist`, `name`) VALUES
(45, 0, '2022-05-19', 4, '1. Хліб\n2. Масло\n3. Яйця\n4. Олія\n5. Майонез', 'Щоденні покупки'),
(44, 1, '2022-05-19', 1, '1. Свічки\n2. Шапочки\n3. Хлопавки\n4. Салюти\n5. Торт\n6.  Шампанське', 'На День Народження'),
(46, 0, '2022-05-19', 2, '- канапки;\n- оливки;\n- віскі;\n- кола;\n- спрайт;\n- шампанське;\n- суші;', 'Корпоратив');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categr`
--
ALTER TABLE `categr`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `lists`
--
ALTER TABLE `lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categr`
--
ALTER TABLE `categr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `lists`
--
ALTER TABLE `lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
