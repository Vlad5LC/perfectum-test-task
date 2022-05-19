-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Час створення: Трв 19 2022 р., 13:49
-- Версія сервера: 10.4.24-MariaDB
-- Версія PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `newshop`
--

-- --------------------------------------------------------

--
-- Структура таблиці `categr`
--

CREATE TABLE `categr` (
  `id` int(11) NOT NULL,
  `name` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп даних таблиці `categr`
--

INSERT INTO `categr` (`id`, `name`) VALUES
(1, 'Список 1'),
(2, 'Термінові покупки'),
(3, 'На Новий Рік'),
(4, 'Щоденні покупки'),
(8, 'На День Перемоги'),
(9, 'Собаки');

-- --------------------------------------------------------

--
-- Структура таблиці `lists`
--

CREATE TABLE `lists` (
  `id` int(11) NOT NULL,
  `bought` int(11) DEFAULT NULL,
  `creating_date` date DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `buylist` text DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп даних таблиці `lists`
--

INSERT INTO `lists` (`id`, `bought`, `creating_date`, `category_id`, `buylist`, `name`) VALUES
(30, 0, '2022-05-18', 1, 'Муркотики', 'Котики'),
(36, 1, '2022-05-18', 1, '1\n2\n3\n4\n5', 'Владислав'),
(37, 1, '2022-05-18', 8, 'Наполеон\nКиъвський', 'Торти'),
(44, 0, '2022-05-19', 1, '1. Свічки\n2. Шапочки\n3. Хлопавки\n4. Салюти\n5. Торт\n6.  Шампанське', 'На День Народження');

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `categr`
--
ALTER TABLE `categr`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `lists`
--
ALTER TABLE `lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `categr`
--
ALTER TABLE `categr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблиці `lists`
--
ALTER TABLE `lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Обмеження зовнішнього ключа збережених таблиць
--

--
-- Обмеження зовнішнього ключа таблиці `lists`
--
ALTER TABLE `lists`
  ADD CONSTRAINT `lists_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categr` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
